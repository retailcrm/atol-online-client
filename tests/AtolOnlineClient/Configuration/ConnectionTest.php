<?php

namespace AtolOnlineClient\AtolOnlineClient\Connection;

use AtolOnlineClient\AtolOnlineApi;
use AtolOnlineClient\Configuration\Connection;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\Validation;

class ConnectionTest extends TestCase
{
    /**
     * @var Connection
     */
    private $connection;

    /**
     * @return void
     */
    public function setUp(): void
    {
        $this->connection = new Connection();
    }

    /**
     * @return void
     * @covers \AtolOnlineClient\Configuration\Connection::setDebug
     * @covers \AtolOnlineClient\Configuration\Connection::isDebug
     */
    public function testDebug(): void
    {
        $this->assertFalse($this->connection->isDebug());

        $this->connection->setDebug(true);
        $this->assertTrue($this->connection->isDebug());
    }

    /**
     * @return void
     * @covers \AtolOnlineClient\Configuration\Connection::isTestMode
     * @covers \AtolOnlineClient\Configuration\Connection::setTestMode
     */
    public function testTestMode(): void
    {
        $this->assertFalse($this->connection->isTestMode());

        $this->connection->setTestMode(true);
        $this->assertTrue($this->connection->isTestMode());
    }

    /**
     * @return void
     * @covers \AtolOnlineClient\Configuration\Connection::getVersion
     * @covers \AtolOnlineClient\Configuration\Connection::isVersion4
     * @covers \AtolOnlineClient\Configuration\Connection::isVersion3
     */
    public function testVersion(): void
    {
        $this->connection->version = AtolOnlineApi::API_VERSION_V3;
        $this->assertEquals(AtolOnlineApi::API_VERSION_V3, $this->connection->getVersion());
        $this->assertTrue($this->connection->isVersion3());

        $this->connection->version = AtolOnlineApi::API_VERSION_V4;
        $this->assertTrue($this->connection->isVersion4());
    }

    /**
     * @return void
     * @covers \AtolOnlineClient\Configuration\Connection::loadValidatorMetadata
     */
    public function testValidator(): void
    {

        $validator = Validation::createValidatorBuilder()
            ->addMethodMapping('loadValidatorMetadata')
            ->getValidator();

        $list = $validator->validate($this->connection);

        $this->assertEquals(3, $list->count());

        $this->connection->login = 'login';
        $this->connection->pass = 'login';
        $this->connection->group = 'group';

        $list = $validator->validate($this->connection);

        $this->assertEquals(0, $list->count());
    }
}
