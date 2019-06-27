<?php

namespace AtolOnlineClient;

use AtolOnlineClient\Configuration\Connection;
use AtolOnlineClient\Exception\InvalidResponseException;
use AtolOnlineClient\Response\OperationResponse;
use GuzzleHttp\Client;
use JMS\Serializer\DeserializationContext;
use JMS\Serializer\Exception\RuntimeException;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializerInterface;

class AtolOnline
{
    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * @var AtolOnlineApi
     */
    private $api;

    public function __construct()
    {
        $this->serializer = SerializerBuilder::create()->build();
    }

    /**
     * @return Configuration
     */
    public function createConfiguration(): ConfigurationInterface
    {
        return new Configuration();
    }

    /**
     * @param string $response
     * @return OperationResponse
     */
    public function deserializeOperationResponse(string $response): OperationResponse
    {
        try {
            return $this->serializer->deserialize(
                $response,
                OperationResponse::class,
                'json',
                DeserializationContext::create()->setGroups(['post'])
            );
        } catch (RuntimeException $exception) {
            throw new InvalidResponseException($exception->getMessage());
        }
    }

    /**
     * @param $response
     * @return OperationResponse
     */
    public function deserializeCheckStatusResponse($response): OperationResponse
    {
        try {
            return $this->serializer->deserialize(
                $response,
                OperationResponse::class,
                'json',
                DeserializationContext::create()->setGroups(['get'])
            );
        } catch (RuntimeException $exception) {
            throw new InvalidResponseException($exception->getMessage());
        }
    }

    /**
     * @param $request
     * @return mixed|string
     */
    public function serializeOperationRequest($request)
    {
        return $this->serializer->serialize(
            $request,
            'json',
            SerializationContext::create()->setGroups(['set'])
        );
    }

    /**
     * @param Client $client
     * @param Connection $connection
     * @return AtolOnlineApi
     */
    public function createApi(Client $client, Connection $connection): AtolOnlineApi
    {
        if (!$this->api) {
            $this->api = new AtolOnlineApi($client, $connection);
        }

        return $this->api;
    }

    /**
     * @return AtolOnlineApi
     */
    public function getApi(): AtolOnlineApi
    {
        return $this->api;
    }
}
