# API клиент для сервиса фискализации платежей АТОЛ Онлайн

Пример использования:

```php
$atol = new \AtolOnlineClient\AtolOnline();

$client = new \Guzzle\Http\Client();
$connection = new \AtolOnlineClient\Configuration\Connection();
$connection->version = \AtolOnlineClient\AtolOnlineApi::API_VERSION_V4;
$connection->login = 'login';
$connection->pass = 'pass';
$connection->group = 'group';

$config = new \AtolOnlineClient\Configuration();
$config->connections = [$connection];

$api = $this->atol->createApi($client, $connection);
//$api->setLogger();
//$api->setCache();
$request = new \AtolOnlineClient\Request\V4\PaymentReceiptRequest();
/// ...
/// собираем объект запроса
///
$paymentReceiptRequest = $atol->serializeOperationRequest($request);

$response = $atol->getApi()->sell($paymentReceiptRequest);

if ($response) {
    $postOperationResponse = $atol->deserializeOperationResponse($response);
}
```
