<?php

namespace AtolOnlineClient;

use AtolOnlineClient\Configuration\Connection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;

class Configuration implements ConfigurationInterface
{
    /** @var Connection[] */
    public $connections;

    /** @var boolean */
    public $enabled;

    /** @var bool */
    public $debug;

    /**
     * @param ClassMetadata $metadata
     */
    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('connections', new Assert\NotBlank());
        $metadata->addPropertyConstraint('connections', new Assert\Valid());
    }

//    public function loadConnections($connections)
//    {
//        if (!$connections) {
//            return;
//        }
//        foreach ($connections as $connectionItem) {
//            $connection = new Connection();
//            $connection->login = $connectionItem['login'];
//            $connection->pass = $connectionItem['pass'];
//            $connection->group = $connectionItem['group'];
////            $connection->legalEntity = $connectionItem['legalEntity'];
//            $connection->sno = $connectionItem['sno'];
//            $connection->enabled = (bool) $connectionItem['enabled'];
////            $connection->paymentTypes = $connectionItem['paymentTypes'];
////            $connection->paymentStatuses = $connectionItem['paymentStatuses'];
//            $connection->ofd = $connectionItem['ofd'];
//            $connection->version = $connectionItem['version'];
//            $this->connections[] = $connection;
//        }
//    }

    /**
     * @param bool $enabled
     */
    public function setEnabled($enabled)
    {
        $this->enabled = (bool) $enabled;
    }

    /**
     * @param mixed $debug
     */
    public function setDebug($debug)
    {
        $this->debug = $debug;
    }

    /**
     * @return bool
     */
    public function isEnabled()
    {
        return (bool) $this->enabled;
    }

    /**
     * @return mixed
     */
    public function isDebug()
    {
        return $this->debug;
    }
}
