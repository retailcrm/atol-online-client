<?php

namespace AtolOnlineClient\Tests;

use AtolOnlineClient\AtolOnline;
use AtolOnlineClient\Configuration;
use PHPUnit\Framework\TestCase;

class AtolOnlineTest extends TestCase
{

    public function testCreateConfiguration()
    {
        $atol = new AtolOnline();
        $this->assertInstanceOf(Configuration::class, $atol->createConfiguration());
    }
}