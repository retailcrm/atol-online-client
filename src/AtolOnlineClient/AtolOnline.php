<?php

namespace AtolOnlineClient;

use AtolOnlineClient\Configuration\Connection;
use AtolOnlineClient\Response\OperationResponse;
use JMS\Serializer\DeserializationContext;
use JMS\Serializer\SerializerBuilder;

class AtolOnline
{

    private $serializer;

    public function __construct()
    {
        $this->serializer = SerializerBuilder::create()->build();
    }

    public function createConfiguration()
    {
        return new Configuration();
    }

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
     * @param $client
     * @param Connection $connection
     * @param $isDebug
     * @return AtolOnlineApi
     */
    public function getApi($client, Connection $connection, $isDebug)
    {
        return new AtolOnlineApi($client, $connection, $isDebug);
    }
}