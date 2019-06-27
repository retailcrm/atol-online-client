<?php

namespace AtolOnlineClient;

use AtolOnlineClient\Configuration\Connection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;

class Configuration implements ConfigurationInterface
{
    /**
     * @var Connection[]
     */
    public $connections;

    /**
     * @var boolean
     */
    public $enabled = true;

    /**
     * @var bool
     */
    public $debug = false;

    /**
     * @param ClassMetadata $metadata
     */
    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('connections', new Assert\NotBlank());
        $metadata->addPropertyConstraint('connections', new Assert\Valid());
    }

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
