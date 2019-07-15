<?php

namespace AtolOnlineClient\AtolOnlineClient;

use AtolOnlineClient\AtolOnline;
use AtolOnlineClient\AtolOnlineApi;
use AtolOnlineClient\Configuration\Connection;
use AtolOnlineClient\Request\V4\PaymentReceiptRequest;
use AtolOnlineClient\Request\V4\ReceiptRequest;
use AtolOnlineClient\Request\V4\ServiceRequest;
use Doctrine\Common\Cache\ArrayCache;
use Guzzle\Http\Client;
use Guzzle\Http\Message\Response;
use Guzzle\Plugin\Mock\MockPlugin;
use PHPUnit\Framework\TestCase;
use Psr\Log\NullLogger;
use Psr\Log\Test\TestLogger;

/**
 * Class AtolOnlineApiTest
 *
 * @package AtolOnlineClient\AtolOnlineClient
 */
class AtolOnlineApiTest extends TestCase
{
    /**
     * @return void
     * @covers \AtolOnlineClient\AtolOnlineApi::__construct
     * @covers \AtolOnlineClient\AtolOnlineApi::setLogger
     * @covers \AtolOnlineClient\AtolOnlineApi::setCache
     * @covers \AtolOnlineClient\AtolOnlineApi::setVersion
     * @covers \AtolOnlineClient\AtolOnlineApi::getVersion
     */
    public function testCreateApi(): void
    {
        $api = new AtolOnlineApi(new Client(), new Connection());

        $this->assertInstanceOf(AtolOnlineApi::class, $api);

        $this->assertSame(AtolOnlineApi::API_VERSION_V3, $api->getVersion());

        $api->setVersion(AtolOnlineApi::API_VERSION_V4);
        $this->assertSame(AtolOnlineApi::API_VERSION_V4, $api->getVersion());

        $api->setLogger(new NullLogger());
        $this->assertInstanceOf(NullLogger::class, $this->getProperty($api, 'logger'));

        $api->setCache(new ArrayCache());
        $this->assertInstanceOf(ArrayCache::class, $this->getProperty($api, 'cache'));
    }

    /**
     * @return void
     * @covers \AtolOnlineClient\AtolOnlineApi::sell
     */
    public function testSell(): void
    {
        $responses = [
            new Response(200, [], $this->getTokenSuccessResponseV4()),
            new Response(200, [], $this->getReportSuccessReportV4()),
        ];

        $request = (new AtolOnline())->serializeOperationRequest($this->getPaymentRecepientRequest());

        $api = $this->getApi($responses);
        $api->setCache(new ArrayCache());

        $response = $api->sell($request);

        $this->assertSame('2ea26f17–0884–4f08–b120–306fc096a58f', json_decode($response, true)['uuid']);
    }

    /**
     * @return void
     * @covers \AtolOnlineClient\AtolOnlineApi::sellRefund
     */
    public function testSellRefund(): void
    {
        $responses = [
            new Response(200, [], $this->getTokenSuccessResponseV4()),
            new Response(200, [], $this->getReportSuccessReportV4()),
        ];

        $request = (new AtolOnline())->serializeOperationRequest($this->getPaymentRecepientRequest());

        $api = $this->getApi($responses);
        $api->setCache(new ArrayCache());

        $response = $api->sellRefund($request);

        $this->assertSame('2ea26f17–0884–4f08–b120–306fc096a58f', json_decode($response, true)['uuid']);
    }

    /**
     * @return void
     * @covers \AtolOnlineClient\AtolOnlineApi::checkStatus
     */
    public function testCheckStatusSuccessResponse(): void
    {
        $responses = [
            new Response(200, [], $this->getTokenSuccessResponseV4()),
            new Response(200, [], $this->getReportSuccessReportV4()),
        ];

        $api = $this->getApi($responses);
        $api->setCache(new ArrayCache());

        $response = $this->callMethod($api, 'checkStatus', [
            'uuid' => '2ea26f17–0884–4f08–b120–306fc096a58f',
        ]);

        $this->assertSame('2ea26f17–0884–4f08–b120–306fc096a58f', json_decode($response, true)['uuid']);
    }

    /**
     * @return void
     * @covers \AtolOnlineClient\AtolOnlineApi::getToken
     */
    public function testGetTokenSuccessResponse(): void
    {
        $api = $this->getApi([new Response(200, [], $this->getTokenSuccessResponseV4())]);
        $api->setCache(new ArrayCache());

        $this->assertSame('fj45u923j59ju42395iu9423i59243u0', $this->callMethod($api, 'getToken'));
    }

    /**
     * @return void
     * @covers \AtolOnlineClient\AtolOnlineApi::getToken
     */
    public function testGetTokenErrorResponseWithLogger(): void
    {
        $logger = new TestLogger();

        $api = $this->getApi([new Response(200, [], $this->getErrorResponseV4())]);
        $api->setLogger($logger);
        $api->setCache(new ArrayCache());

        $this->assertFalse($this->callMethod($api, 'getToken'));
        $this->assertTrue($logger->hasError('12 Неверный логин или пароль'));
    }

    /**
     * @return void
     * @covers \AtolOnlineClient\AtolOnlineApi::getToken
     */
    public function testGetTokenSuccessResponseWithCache(): void
    {
        $cache = new ArrayCache();

        $api = $this->getApi([new Response(200, [], $this->getTokenSuccessResponseV4())]);
        $api->setCache($cache);

        $this->assertSame('fj45u923j59ju42395iu9423i59243u0', $this->callMethod($api, 'getToken'));
        $this->assertTrue($cache->contains($this->callMethod($api, 'getTokenCacheKey')));

        $this->assertSame('fj45u923j59ju42395iu9423i59243u0', $this->callMethod($api, 'getToken'));
    }

    /**
     * @return void
     * @covers \AtolOnlineClient\AtolOnlineApi::getToken
     */
    public function testGetTokenSuccessResponseV3(): void
    {
        $api = $this->getApi([new Response(200, [], $this->getTokenSuccessResponseV3())]);
        $api->setVersion(AtolOnlineApi::API_VERSION_V3);
        $api->setCache(new ArrayCache());

        $this->assertSame('fj45u923j59ju42395iu9423i59243u0', $this->callMethod($api, 'getToken'));
    }

    /**
     * @return void
     * @covers \AtolOnlineClient\AtolOnlineApi::getToken
     */
    public function testGetTokenSuccessResponseV3WithCache(): void
    {
        $cache = new ArrayCache();

        $api = $this->getApi([new Response(200, [], $this->getTokenSuccessResponseV3())]);
        $api->setCache($cache);
        $api->setVersion(AtolOnlineApi::API_VERSION_V3);

        $this->assertSame('fj45u923j59ju42395iu9423i59243u0', $this->callMethod($api, 'getToken'));
        $this->assertTrue($cache->contains($this->callMethod($api, 'getTokenCacheKey')));

        $this->assertSame('fj45u923j59ju42395iu9423i59243u0', $this->callMethod($api, 'getToken'));
    }

    /**
     * @return void
     * @covers \AtolOnlineClient\AtolOnlineApi::buildUrl
     */
    public function testBuildUrlWithoutToken(): void
    {
        $args = ['operation' => 'test'];

        $this->assertSame('https://online.atol.ru/possystem/v4/group/test', $this->callMethod($this->getApi(), 'buildUrl', $args));

        $api = $this->getApi();
        $api->setVersion(AtolOnlineApi::API_VERSION_V3);
        $this->assertSame('https://online.atol.ru/possystem/v3/group/test', $this->callMethod($api, 'buildUrl', $args));
    }

    /**
     * @return void
     * @covers \AtolOnlineClient\AtolOnlineApi::buildUrl
     */
    public function testBuildUrlWithToken(): void
    {
        $args = ['operation' => 'test', 'token' => 'test'];

        $this->assertSame('https://online.atol.ru/possystem/v4/group/test?token=test', $this->callMethod($this->getApi(), 'buildUrl', $args));

        $api = $this->getApi();
        $api->setVersion(AtolOnlineApi::API_VERSION_V3);
        $this->assertSame('https://online.atol.ru/possystem/v3/group/test?tokenid=test', $this->callMethod($api, 'buildUrl', $args));
    }

    /**
     * @return void
     * @covers \AtolOnlineClient\AtolOnlineApi::sendOperationRequest
     */
    public function testSendOperationRequestSuccessResponse(): void
    {
        $responses = [
            new Response(200, [], $this->getTokenSuccessResponseV4()),
            new Response(200, [], $this->getTokenSuccessResponseV4())
        ];

        $request = (new AtolOnline())->serializeOperationRequest($this->getPaymentRecepientRequest());

        $api = $this->getApi($responses);
        $api->setCache(new ArrayCache());

        $response = $this->callMethod($api, 'sendOperationRequest', [
            'operation' => 'sell',
            'data' => $request,
        ]);

        $this->assertSame('fj45u923j59ju42395iu9423i59243u0', json_decode($response->getBody(), true)['token']);
    }

    /**
     * @return void
     * @covers \AtolOnlineClient\AtolOnlineApi::logDebug
     */
    public function testLogDebug(): void
    {
        $logger = new TestLogger();

        $api = $this->getApi();
        $api->setLogger($logger);

        $this->callMethod($api, 'logDebug', [
            'url' => '/test',
            'data' => 'test',
            'response' => new Response(200, ['X-Foo' => 'Bar', 'X-Foo2' => 'Bar2'], 'test'),
        ]);

        $this->assertTrue($logger->hasDebug("* URL: /test\n * POSTFIELDS: test\n * RESPONSE HEADERS: HTTP/1.1 200 OK\r\nX-Foo: Bar\r\nX-Foo2: Bar2\r\n\r\n\n * RESPONSE BODY: test\n * ATTEMPTS: 0"));
    }

    /**
     * @return void
     * @covers \AtolOnlineClient\AtolOnlineApi::getTokenCacheKey
     */
    public function testGetTokenCacheKey(): void
    {
        $this->assertSame('crm_fiscal_atol_online_token_68526766e6751745b52ae70b7bd3c6fe_v4', $this->callMethod($this->getApi(), 'getTokenCacheKey'));


        $api = $this->getApi();
        $api->setVersion(AtolOnlineApi::API_VERSION_V3);

        $this->assertSame('crm_fiscal_atol_online_token_68526766e6751745b52ae70b7bd3c6fe_v3', $this->callMethod($api, 'getTokenCacheKey'));
    }

    /**
     * @return void
     * @covers \AtolOnlineClient\AtolOnlineApi::isTokenExpired
     */
    public function testIsTokenExpired(): void
    {
        $body = new \stdClass();
        $body->error = new \stdClass();
        $body->error->code = 4;

        $this->assertTrue($this->callMethod($this->getApi(), 'isTokenExpired', ['body' => $body]));

        $body = new \stdClass();
        $this->assertFalse($this->callMethod($this->getApi(), 'isTokenExpired', ['body' => $body]));
    }

    /**
     * @param array $responses
     * @param bool $debug
     * @param bool $test
     * @return AtolOnlineApi
     */
    private function getApi(array $responses = [], bool $debug = true, bool $test = false): AtolOnlineApi
    {
        $connection = new Connection();
        $connection->login = 'login';
        $connection->pass = 'pass';
        $connection->group = 'group';
        $connection->sno = Connection::SNO_GENERAL;
        $connection->version = AtolOnlineApi::API_VERSION_V4;
        $connection->setDebug($debug);
        $connection->setTestMode($test);

        $plugin = new MockPlugin();

        foreach ($responses as $response) {
            $plugin->addResponse($response);
        }

        $client = new Client();
        $client->addSubscriber($plugin);

        return new AtolOnlineApi($client, $connection);
    }

    /**
     * @param mixed $object
     * @param string $name
     * @param array $args
     * @return mixed
     */
    private function callMethod($object, string $name, array $args = [])
    {
        $reflection = new \ReflectionClass($object);
        $method = $reflection->getMethod($name);
        $method->setAccessible(true);

        return $method->invokeArgs($object, $args);
    }

    /**
     * @param mixed $object
     * @param string $name
     * @return mixed
     */
    private function getProperty($object, string $name)
    {
        $reflection = new \ReflectionClass($object);
        $property = $reflection->getProperty($name);
        $property->setAccessible(true);

        return $property->getValue($object);
    }

    /**
     * @return false|string
     */
    private function getTokenSuccessResponseV3()
    {
        return json_encode([
            'token' => 'fj45u923j59ju42395iu9423i59243u0',
            'code' => 1,
        ]);
    }

    /**
     * @return false|string
     */
    private function getTokenSuccessResponseV4()
    {
        return json_encode([
            'error' => null,
            'token' => 'fj45u923j59ju42395iu9423i59243u0',
            'timestamp' => '30.11.2017 17:58:53',
        ]);
    }

    /**
     * @return false|string
     */
    private function getErrorResponseV4()
    {
        return json_encode([
            'error' => [
                'error_id' => '4475d6d8d-844d-4d05-aa8b-e3dbdf3defd5',
                'code' => 12,
                'text' => 'Неверный логин или пароль',
                'type' => 'system',
            ],
            'timestamp' => '30.11.2017 17:58:53',
        ]);
    }

    /**
     * @return string
     */
    private function getReportSuccessReportV4(): string
    {
        return file_get_contents(__DIR__.'/../fixtures/success_response_v4_3.json');
    }

    /**
     * @return PaymentReceiptRequest
     */
    private function getPaymentRecepientRequest(): PaymentReceiptRequest
    {
        $service = new ServiceRequest();
        $service->setCallbackUrl('test.local');

        $receipt = new ReceiptRequest();
        $receipt->setTotal('100');

        /** @var PaymentReceiptRequest $request */
        $request = new PaymentReceiptRequest();
        $request->setExternalId('test');
        $request->setService($service);
        $request->setReceipt($receipt);

        return $request;
    }
}
