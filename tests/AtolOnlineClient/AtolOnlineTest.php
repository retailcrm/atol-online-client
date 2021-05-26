<?php

namespace AtolOnlineClient\Tests;

use AtolOnlineClient\AtolOnline;
use AtolOnlineClient\AtolOnlineClient\Traits\PaymentReceiptRequestTrait;
use AtolOnlineClient\Configuration\Connection;
use AtolOnlineClient\ConfigurationInterface;
use AtolOnlineClient\Exception\InvalidResponseException;
use GuzzleHttp\Client;
use JMS\Serializer\Exception\RuntimeException;
use JMS\Serializer\SerializerInterface;
use PHPUnit\Framework\TestCase;

class AtolOnlineTest extends TestCase
{
    use PaymentReceiptRequestTrait;

    /**
     * @var AtolOnline
     */
    protected $atol;

    /**
     * @return void
     */
    public function setUp(): void
    {
        $this->atol =  new AtolOnline();
    }

    /**
     * @return void
     * @covers \AtolOnlineClient\AtolOnline::__construct
     */
    public function testConstructor(): void
    {
        $reflection = new \ReflectionClass(get_class($this->atol));

        $property = $reflection->getProperty('serializer');
        $property->setAccessible(true);

        $this->assertInstanceOf(SerializerInterface::class, $property->getValue($this->atol));
    }

    /**
     * @covers \AtolOnlineClient\AtolOnline::createConfiguration
     * @return void
     */
    public function testCreateConfiguration(): void
    {
        $this->assertInstanceOf(ConfigurationInterface::class, $this->atol->createConfiguration());
    }

    /**
     * @param string $file
     * @covers \AtolOnlineClient\AtolOnline::deserializeOperationResponse
     * @dataProvider dataSuccessResponse
     */
    public function testSuccessDeserializeOperationResponse(string $file): void
    {
        $response = file_get_contents(__DIR__.'/../fixtures/'. $file);

        $operationResponse = $this->atol->deserializeOperationResponse($response);

        $this->assertEquals('12.04.2017 06:15:06', $operationResponse->getTimestamp());
    }

    /**
     * @param string $file
     * @covers \AtolOnlineClient\AtolOnline::deserializeOperationResponse
     * @dataProvider dataErrorResponse
     */
    public function testErrorDeserializeOperationResponse(string $file): void
    {
        $response = file_get_contents(__DIR__.'/../fixtures/'. $file);

        $operationResponse = $this->atol->deserializeOperationResponse($response);

        $this->assertEquals('12.04.2017 06:15:06', $operationResponse->getTimestamp());
        $this->assertEquals('fail', $operationResponse->getStatus());
        $this->assertEquals(30, $operationResponse->getError()->getCode());
        $this->assertEquals('system', $operationResponse->getError()->getType());

        $this->assertEquals(
            ' Передан некорректный UUID : "{0}". Необходимо повторить запрос с корректными данными ',
            $operationResponse->getError()->getText()
        );
    }

    /**
     * @covers \AtolOnlineClient\AtolOnline::deserializeOperationResponse
     */
    public function testFailDeserializeOperationResponse(): void
    {
        $this->expectException(InvalidResponseException::class);

        $this->atol->deserializeOperationResponse('<html></html>');
    }

    /**
     * @param string $file
     * @covers \AtolOnlineClient\AtolOnline::deserializeCheckStatusResponse
     * @dataProvider dataSuccessResponse
     */
    public function testSuccessDeserializeCheckStatusResponse(string $file): void
    {
        $response = file_get_contents(__DIR__.'/../fixtures/'. $file);

        $operationResponse = $this->atol->deserializeCheckStatusResponse($response);

        $this->assertEquals('12.04.2017 06:15:06', $operationResponse->getTimestamp());
    }

    /**
     * @covers \AtolOnlineClient\AtolOnline::deserializeCheckStatusResponse
     */
    public function testFailDeserializeCheckStatusResponse(): void
    {
        $this->expectException(InvalidResponseException::class);

        $this->atol->deserializeCheckStatusResponse('<html></html>');
    }

    /**
     * @param int|null $code
     * @param string|null $message
     * @param string $html
     * @covers       \AtolOnlineClient\AtolOnline::createInvalidResponseException
     * @covers       \AtolOnlineClient\Exception\InvalidResponseException
     * @dataProvider dataInvalidResponse
     */
    public function testCreateInvalidResponseException(?int $code, ?string $message, string $html): void
    {
        /** @var InvalidResponseException $exception */
        $exception = $this->callMethod($this->atol, 'createInvalidResponseException', [
            'response' => $html,
            'previous' => new RuntimeException()
        ]);

        $this->assertInstanceOf(InvalidResponseException::class, $exception);
        $this->assertEquals($code, $exception->getCodeError());
        $this->assertEquals($message, $exception->getMessageError());
    }

    /**
     * @covers \AtolOnlineClient\AtolOnline::serializeOperationRequest
     * @covers \AtolOnlineClient\Request\V4\ClientReceiptRequest
     * @covers \AtolOnlineClient\Request\V4\CompanyReceiptRequest
     * @covers \AtolOnlineClient\Request\V4\PaymentReceiptRequest
     * @covers \AtolOnlineClient\Request\V4\ReceiptItemRequest
     * @covers \AtolOnlineClient\Request\V4\ReceiptPaymentRequest
     * @covers \AtolOnlineClient\Request\V4\ReceiptRequest
     * @covers \AtolOnlineClient\Request\V4\ServiceRequest
     * @covers \AtolOnlineClient\Request\V4\VatReceiptRequest
     */
    public function testSerializeOperationRequest(): void
    {
        $request = $this->getPaymentReceiptRequest();
        $request->setTimestamp('17.07.2019 10:14:22');

        $this->assertEquals(
            '{"external_id":"test","receipt":{"client":{"email":"test@test.local"},"company":{"email":"test@test.local","inn":"11111111","payment_address":"address"},"items":[{"name":"test item","price":100.1,"quantity":1.1,"sum":100.1,"measurement_unit":"kg","payment_method":"advance","payment_object":"agent_commission","vat":{"type":"vat20","sum":20.2},"nomenclature_code":"00"}],"payments":[{"type":0,"sum":100.1}],"vats":[{"type":"vat20","sum":20.2}],"total":100.1},"timestamp":"17.07.2019 10:14:22","service":{"callback_url":"test.local"}}',
            $this->atol->serializeOperationRequest($request)
        );
    }

    /**
     * @return void
     *
     * @covers \AtolOnlineClient\AtolOnline::createApi
     */
    public function testCreateApi(): void
    {
        $api1 =  $this->atol->createApi(new Client(), new Connection());
        $api2 =  $this->atol->createApi(new Client(), new Connection());

        $this->assertSame($api1, $api2);
    }

    /**
     * @return void
     *
     * @covers \AtolOnlineClient\AtolOnline::getApi
     */
    public function testGetApi(): void
    {
        $api1 =  $this->atol->createApi(new Client(), new Connection());
        $api2 =  $this->atol->getApi();

        $this->assertSame($api1, $api2);
    }

    /**
     * @return array
     */
    public function dataSuccessResponse(): array
    {
        return [
            ['success_response_v4_1.json'],
            ['success_response_v4_2.json'],
            ['success_response_v4_3.json'],
        ];
    }

    /**
     * @return array
     */
    public function dataErrorResponse(): array
    {
        return [
            ['error_response_v4.json']
        ];
    }

    /**
     * @return array
     */
    public function dataInvalidResponse(): array
    {
        return [
            [
                'code' => 404,
                'message' => 'Not Found',
                'html' => '<html><head><title>404 Not Found</title></head><body><center><h1>404 Not Found</h1></center><hr><center>openresty/1.15.8.1rc1</center></body></html>',
            ],
            [
                'code' => 502,
                'message' => 'Bad Gateway',
                'html' => '<html><head><title>502 Bad Gateway</title></head><body><center><h1>502 Bad Gateway</h1></center><hr><center>nginx/1.15.8</center></body></html>',
            ],
            [
                'code' => null,
                'message' => null,
                'html' => '<html></html>',
            ],
            [
                'code' => null,
                'message' => null,
                'html' => '',
            ],
        ];
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
}
