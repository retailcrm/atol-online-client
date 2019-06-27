<?php

namespace AtolOnlineClient;

use AtolOnlineClient\Configuration\Connection;
use Doctrine\Common\Cache\Cache;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;

class AtolOnlineApi
{
    public const API_VERSION_V4 = 'v4';
    public const API_VERSION_V3 = 'v3';

    public const TOKEN_CACHE_KEY = 'crm_fiscal_atol_online_token';
    public const TOKEN_CACHE_TIME = 86400;

    private $baseApiUrl = 'https://online.atol.ru/possystem';
    private $testApiUrl = 'https://testonline.atol.ru/possystem';

    /**
     * @var LoggerInterface|null
     */
    private $logger;

    /**
     * @var Cache|null
     */
    private $cache;

    /**
     * @var Client
     */
    private $client;

    /**
     * @var Connection
     */
    private $connection;

    /**
     * @var int
     */
    private $attempts;

    /**
     * @var int
     */
    private $attemptsCheckStatus;

    /**
     * @param Client $client
     * @param Connection $connectionConfig
     */
    public function __construct(Client $client, Connection $connectionConfig)
    {
        $this->client = $client;
        $this->connection = $connectionConfig;

        $this->attempts = 0;
    }

    /**
     * @param LoggerInterface $logger
     */
    public function setLogger(LoggerInterface $logger): void
    {
        $this->logger = $logger;
    }

    /**
     * @param Cache $cache
     */
    public function setCache(Cache $cache): void
    {
        $this->cache = $cache;
    }

    /**
     * @param string $version
     * @return AtolOnlineApi
     */
    public function setVersion(string $version): AtolOnlineApi
    {
        $this->connection->version = $version;

        return $this;
    }

    /**
     * @return string
     */
    public function getVersion(): string
    {
        return $this->connection->version;
    }

    /**
     * Приход
     *
     * @param $paymentReceiptRequest
     * @return string
     */
    public function sell($paymentReceiptRequest): ?string
    {
        return $this->sendOperationRequest('sell', $paymentReceiptRequest);
    }

    /**
     * Возврат прихода
     *
     * @param $paymentReceiptRequest
     * @return string
     */
    public function sellRefund($paymentReceiptRequest): ?string
    {
        return $this->sendOperationRequest('sell_refund', $paymentReceiptRequest);
    }

    /**
     * Запрос для проверки статуса
     *
     * @param string $uuid
     * @return mixed
     */
    public function checkStatus($uuid)
    {
        $token = $this->getToken();

        $url = $this->buildUrl('report/'.$uuid, $token);

        try {
            $this->attemptsCheckStatus++;
            $response = $this->client->get($url);
        } catch (BadResponseException $exception) {
            if ($this->cache) {
                $this->cache->delete($this->getTokenCacheKey());
            }

            $response = $exception->getResponse();
            $body = json_decode($response->getBody(), false);

            if ($this->attemptsCheckStatus <= 1 && $this->isTokenExpired($body)) {
                return $this->checkStatus($uuid);
            }
        }

        $this->logDebug($url, $uuid, $response);

        return $response->getBody()->__toString();
    }

    /**
     * @return string
     */
    protected function getUri(): string
    {
        return $this->connection->isTestMode() ? $this->testApiUrl : $this->baseApiUrl;
    }

    /**
     * @return bool|mixed
     * @throws \Exception
     */
    protected function getToken()
    {
        $data = [
            'login' => $this->connection->login,
            'pass' => $this->connection->pass,
        ];

        if ($this->cache && ($token = $this->cache->fetch($this->getTokenCacheKey()))) {
            return $token;
        }

        $dataJson = json_encode((object)$data, JSON_UNESCAPED_UNICODE);

        $url = $this->getUri().'/'.$this->connection->version.'/getToken';

        $response = false;
        try {
            $response = $this->client->post($url, ['body' => $dataJson]);
        } catch (BadResponseException $exception) {
            if ($this->logger && $exception->getResponse()) {
                $this->logger->error((string) $exception->getResponse()->getBody());
            }
        }

        if ($response) {
            $response = json_decode($response->getBody(), true);

            if ($this->connection->isVersion4()) {
                if ($this->cache && !isset($response['error'])) {
                    $this->cache->save($this->getTokenCacheKey(), $response['token'], self::TOKEN_CACHE_TIME);
                }

                if ($this->logger && isset($response['error'])) {
                    $this->logger->error($response['error']['code'] . ' '. $response['error']['text']);
                }

                if (!isset($response['error'])) {
                    return $response['token'];
                }

               return false;
            }

            if (isset($response['code']) && in_array($response['code'], [0, 1], true)) {
                if ($this->cache) {
                    $this->cache->save($this->getTokenCacheKey(), $response['token'], self::TOKEN_CACHE_TIME);
                }

                return $response['token'];
            }
        }


        return false;
    }

    /**
     * @param string $operation
     * @param string|null $token
     * @return string
     */
    protected function buildUrl(string $operation, string $token = null): string
    {
        $url = $this->getUri()
            .'/'.$this->connection->version
            .'/'.$this->connection->group
            .'/'.$operation;

        if (!$token) {
            return $url;
        }

        if ($this->getVersion() === self::API_VERSION_V4) {
            return $url.'?token='.$token;
        }

        return $url.'?tokenid='.$token;
    }

    /**
     * @param string $operation
     * @param mixed $data
     * @return string
     */
    protected function sendOperationRequest(string $operation, $data): string
    {
        $token = $this->getToken();

        $url = $this->buildUrl($operation, $token);

        try {
            $this->attempts++;
            $response = $this->client->post($url, ['body' => $data]);
        } catch (BadResponseException $e) {
            if ($this->cache) {
                $this->cache->delete($this->getTokenCacheKey());
            }

            $response = $e->getResponse();

            $body = json_decode($response->getBody()->__toString(), false);

            if ($this->isTokenExpired($body) && $this->attempts <= 1) {
                return $this->sendOperationRequest($operation, $data);
            }
        }

        if ($response) {
            $this->logDebug($url, $data, $response);
        }

        return $response->getBody()->__toString();
    }

    /**
     * @param string $url
     * @param string $data
     * @param ResponseInterface $response
     */
    protected function logDebug(string $url, string $data, ResponseInterface $response): void
    {
        if ($this->logger && $this->connection->isDebug()) {
            $headers = [];

            foreach ($response->getHeaders() as $key => $value) {
                $headers[] = implode(': ', [$key, $value[0]]);
            }

            $v = '* URL: '.$url;
            $v .= "\n * POSTFIELDS: ".$data;
            $v .= "\n * RESPONSE HEADERS: ".implode(', ', $headers);
            $v .= "\n * RESPONSE BODY: ".$response->getBody();
            $v .= "\n * ATTEMPTS: ".$this->attempts;
            $this->logger->debug($v);
        }
    }

    /**
     * @return string
     */
    protected function getTokenCacheKey(): string
    {
        return self::TOKEN_CACHE_KEY.'_'.md5($this->connection->login.$this->connection->pass).'_'.$this->connection->version;
    }

    /**
     * @param object $body
     * @return bool
     */
    private function isTokenExpired($body): bool
    {
        return isset($body->error) && in_array($body->error->code, [4, 5, 6, 12, 13, 14], true);
    }
}
