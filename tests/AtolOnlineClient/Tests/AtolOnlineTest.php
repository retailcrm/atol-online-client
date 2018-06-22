<?php

namespace AtolOnlineClient\Tests;

use AtolOnlineClient\AtolOnline;
use AtolOnlineClient\Configuration;
use AtolOnlineClient\Response\OperationResponse;
use PHPUnit\Framework\TestCase;

class AtolOnlineTest extends TestCase
{

    public function testCreateConfiguration()
    {
        $atol = new AtolOnline();
        $this->assertInstanceOf(Configuration::class, $atol->createConfiguration());
    }


    /**
     * @dataProvider dataSellErrorResponse
     */
    public function testDeserializeOperationResponse($file)
    {
        $response = file_get_contents(__DIR__ . '/data/'. $file);
        $atol = new AtolOnline();
        $operationResponse = $atol->deserializeOperationResponse($response);
        $this->assertInstanceOf(OperationResponse::class, $operationResponse);
        $this->assertEquals('12.04.2017 06:15:06', $operationResponse->getTimestamp());
        $this->assertEquals('fail', $operationResponse->getStatus());
        $this->assertEquals(30, $operationResponse->getError()->getCode());
        $this->assertEquals('system', $operationResponse->getError()->getType());
        $this->assertEquals(
            ' Передан некорректный UUID : "{0}". Необходимо повторить запрос с корректными данными ',
            $operationResponse->getError()->getText()
        );
    }

    public function dataSellErrorResponse()
    {
        return [
            ['sell_error_response_v3.json'],
            ['sell_error_response_v3.json']
        ];
    }
}
