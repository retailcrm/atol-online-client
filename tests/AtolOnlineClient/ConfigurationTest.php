<?php

namespace AtolOnlineClient\AtolOnlineClient;

use AtolOnlineClient\Configuration;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\Validation;

/**
 * Class ConfigurationTest
 *
 * @package AtolOnlineClient\AtolOnlineClient
 */
class ConfigurationTest extends TestCase
{
    /**
     * @var Configuration
     */
    private $configuration;

    public function setUp(): void
    {
        $this->configuration = new Configuration();
    }

    /**
     * @return void
     * @covers \AtolOnlineClient\Configuration::isDebug
     * @covers \AtolOnlineClient\Configuration::setDebug
     */
    public function testDebug(): void
    {
        $this->assertFalse($this->configuration->isDebug());

        $this->configuration->setDebug(true);
        $this->assertTrue($this->configuration->isDebug());
    }

    /**
     * @return void
     * @covers \AtolOnlineClient\Configuration::isEnabled
     * @covers \AtolOnlineClient\Configuration::setEnabled
     */
    public function testEnabled(): void
    {
        $this->assertTrue($this->configuration->isEnabled());

        $this->configuration->setEnabled(false);
        $this->assertFalse($this->configuration->isEnabled());
    }

    /**
     * @return void
     * @covers \AtolOnlineClient\Configuration::loadValidatorMetadata
     */
    public function testValidator(): void
    {

        $validator = Validation::createValidatorBuilder()
            ->addMethodMapping('loadValidatorMetadata')
            ->getValidator();

        $list = $validator->validate($this->configuration);

        $this->assertEquals(1, $list->count());

        $connection = new Configuration\Connection();
        $connection->login = 'login';
        $connection->pass = 'login';
        $connection->group = 'group';

        $this->configuration->connections[] = $connection;

        $list = $validator->validate($this->configuration);

        $this->assertEquals(0, $list->count());
    }
}
