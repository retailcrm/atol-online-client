[![Build Status](https://img.shields.io/travis/retailcrm/atol-online-client/master.svg?style=flat-square)](https://travis-ci.org/retailcrm/atol-online-client)

[![Latest stable](https://img.shields.io/packagist/v/retailcrm/atol-online-client.svg?style=flat-square)](https://packagist.org/packages/retailcrm/atol-online-client)

# API-клиент для АТОЛ.Онлайн

API-клиент на PHP для сервиса онлайн-фискализации платежей АТОЛ.Онлайн.

## Требования

* PHP 7.1 и выше
* PHP extension cURL

## Пример использования

```php
$atol = new \AtolOnlineClient\AtolOnline();

$connection = new \AtolOnlineClient\Configuration\Connection();
$connection->version = \AtolOnlineClient\AtolOnlineApi::API_VERSION_V4;
$connection->login = 'login';
$connection->pass = 'pass';
$connection->group = 'group';

$config = new \AtolOnlineClient\Configuration();
$config->connections = [$connection];

$client = new \Guzzle\Http\Client();

$api = $atol->createApi($client, $connection);

// $api->setLogger(...);
// $api->setCache(...);

// собираем объект запроса
$request = new \AtolOnlineClient\Request\V4\PaymentReceiptRequest();
$paymentReceiptRequest = $atol->serializeOperationRequest($request);

$response = $atol->getApi()->sell($paymentReceiptRequest);

if ($response) {
    $postOperationResponse = $atol->deserializeOperationResponse($response);
}
```
