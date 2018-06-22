<?php

namespace AtolOnlineClient;

use AtolOnlineClient\Configuration\Connection;
use AtolOnlineClient\Response\OperationResponse;
use Guzzle\Http\Client;
use JMS\Serializer\DeserializationContext;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerBuilder;

class AtolOnline
{

    private $serializer;

    /** @var AtolOnlineApi */
    private $api;

    public function __construct()
    {
        $this->serializer = SerializerBuilder::create()->build();
    }

    public function createConfiguration()
    {
        return new Configuration();
    }

    /**
     * @param $response
     * @return OperationResponse
     */
    public function deserializeOperationResponse($response)
    {
        return $this->serializer->deserialize(
            $response,
            OperationResponse::class,
            'json',
            DeserializationContext::create()->setGroups(['post'])
        );
    }

    /**
     * @param $response
     * @return OperationResponse
     */
    public function deserializeCheckStatusResponse($response)
    {
        return $this->serializer->deserialize(
            $response,
            OperationResponse::class,
            'json',
            DeserializationContext::create()->setGroups(['get'])
        );
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
     * @param $client
     * @param Connection $connection
     * @return AtolOnlineApi
     */
    public function createApi(Client $client, Connection $connection)
    {
        if (!$this->api) {
            $this->api = new AtolOnlineApi($client, $connection);
        }

        return $this->api;
    }

    /**
     * @return AtolOnlineApi
     */
    public function getApi()
    {
        return $this->api;
    }
}