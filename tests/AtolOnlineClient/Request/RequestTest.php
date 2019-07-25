<?php

namespace AtolOnlineClient\AtolOnlineClient\Response;

use AtolOnlineClient\Request\V4\PaymentReceiptRequest;
use JMS\Serializer\SerializerBuilder;
use PHPUnit\Framework\TestCase;

/**
 */
class RequestTest extends TestCase
{
    /**
     * @return void
     * @covers \AtolOnlineClient\Request\V4\ClientReceiptRequest
     * @covers \AtolOnlineClient\Request\V4\CompanyReceiptRequest
     * @covers \AtolOnlineClient\Request\V4\PaymentReceiptRequest
     * @covers \AtolOnlineClient\Request\V4\ReceiptItemRequest
     * @covers \AtolOnlineClient\Request\V4\ReceiptPaymentRequest
     * @covers \AtolOnlineClient\Request\V4\ReceiptRequest
     * @covers \AtolOnlineClient\Request\V4\ServiceRequest
     * @covers \AtolOnlineClient\Request\V4\VatReceiptRequest
     */
    public function testRequest(): void
    {
        $serializer = SerializerBuilder::create()->build();

        $request = '{
  "external_id": "17052917561851307",
  "receipt": {
    "client": {
      "name": "name",
      "email": "kkt@kkt.ru",
      "phone": "88002000600",
      "inn": "111111111"
    },
    "company": {
      "email": "chek@romashka.ru",
      "sno": "osn",
      "inn": "1234567891",
      "payment_address": "http://magazin.ru/"
    },
    "items": [
      {
        "name": "колбаса Клинский Брауншвейгская с/к в/с ",
        "price": 1000,
        "quantity": 0.3,
        "sum": 300,
        "measurement_unit": "кг",
        "payment_method": "full_payment",
        "payment_object": "commodity",
        "vat": {
          "type": "vat18"
        }
      },
      {
        "name": "яйцоОкскоекуриноеС0 белое",
        "price": 100,
        "quantity": 1,
        "sum": 100,
        "measurement_unit": "Упаковка10 шт.",
        "payment_method": "full_payment",
        "payment_object": "commodity",
        "vat": {
          "type": "vat10"
        }
      }
    ],
    "payments": [
      {
        "type": 1,
        "sum": 400
      }
    ],
    "vats": [
      {
        "type": "vat18",
        "sum": 45.76
      },
      {
        "type": "vat10",
        "sum": 9.09
      }
    ],
    "total": 400
  },
  "service": {
    "callback_url": "http://testtest"
  },
  "timestamp": "01.02.1713:45:00"
}';

        /** @var PaymentReceiptRequest $request */
        $request = $serializer->deserialize(
            $request,
            PaymentReceiptRequest::class,
            'json'
        );

        $this->assertSame('17052917561851307', $request->getExternalId());
    }
}
