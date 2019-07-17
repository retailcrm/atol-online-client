<?php

namespace AtolOnlineClient\AtolOnlineClient\Response;

use AtolOnlineClient\Response\OperationResponse;
use JMS\Serializer\SerializerBuilder;
use PHPUnit\Framework\TestCase;

/**
 */
class ResponseTest extends TestCase
{
    /**
     * @return void
     * @covers \AtolOnlineClient\Response\OperationResponse
     * @covers \AtolOnlineClient\Response\Error
     * @covers \AtolOnlineClient\Response\Payload
     */
    public function testResponse(): void
    {
        $serializer = SerializerBuilder::create()->build();

        $response = '{
  "uuid": "4355",
  "timestamp": "12.04.2017 06:15:06",
  "status": "fail",
  "error": {
    "error_id": "475d6d8d-844d-4d05-aa8b-e3dbdf4defd6",
    "code": 30,
    "text": " Передан некорректный UUID : \"{0}\". Необходимо повторить запрос с корректными данными ",
    "type": "system"
  },
  "payload": {
    "total": 1598,
    "fns_site": "www.nalog.ru",
    "fn_number": "1110000100238211",
    "shift_number": 23,
    "receipt_datetime": "12.04.2017 20:16:00",
    "fiscal_receipt_number": 6,
    "fiscal_document_number": 133,
    "ecr_registration_number": "0000111118041361",
    "fiscal_document_attribute": 3449555941
  },
  "group_code": " MyCompany_MyShop",
  "daemon_code": "prod–agent–1",
  "device_code": "KSR13.00–1–11",
  "external_id": "TRF10601_1",
  "callback_url": ""
}';
        /** @var OperationResponse $response */
        $response = $serializer->deserialize(
            $response,
            OperationResponse::class,
            'json'
        );

        $serializer->serialize(
            $response,
            'json'
        );

        $this->assertSame('4355', $response->getUuid());
    }
}
