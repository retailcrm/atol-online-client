<?php

namespace AtolOnlineClient\Configuration;

use AtolOnlineClient\AtolOnlineApi;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;

class Connection
{
    const SNO_GENERAL = 'osn';
    const SNO_USN_INCOME = 'usn_income';
    const SNO_USN_INCOME_OUTCOME = 'usn_income_outcome';
    const SNO_ENVD = 'envd';
    const SNO_ESN = 'esn';
    const SNO_PATENT = 'patent';

    const snoTypes = [
        self::SNO_GENERAL,
        self::SNO_USN_INCOME,
        self::SNO_USN_INCOME_OUTCOME,
        self::SNO_ENVD,
        self::SNO_ESN,
        self::SNO_PATENT,
    ];

    const versions = [
        AtolOnlineApi::API_VERSION_V4,
    ];

    /** @var bool */
    protected $debug = false;

    /** @var string */
    public $login;

    /** @var string */
    public $pass;

    /** @var string */
    public $group;

    /** @var string */
    public $sno;

    /** @var string */
    public $version = AtolOnlineApi::API_VERSION_V4;

    /** @var bool */
    public $testMode = false;

    /**
     * @return bool
     */
    public function isTestMode(): bool
    {
        return $this->testMode;
    }

    /**
     * @param bool $testMode
     */
    public function setTestMode(bool $testMode): void
    {
        $this->testMode = $testMode;
    }

    /**
     * @return bool
     */
    public function isDebug(): bool
    {
        return $this->debug;
    }

    /**
     * @param bool $debug
     */
    public function setDebug(bool $debug): void
    {
        $this->debug = $debug;
    }

    /**
     * @param ClassMetadata $metadata
     */
    public static function loadValidatorMetadata(ClassMetadata $metadata): void
    {
        $metadata->addPropertyConstraint('login', new Assert\NotBlank());
        $metadata->addPropertyConstraint('pass', new Assert\NotBlank());
        $metadata->addPropertyConstraint('group', new Assert\NotBlank());
        $metadata->addPropertyConstraints('sno', [
            new Assert\Choice([
                'choices'   => self::snoTypes,
            ])
        ]);

        $metadata->addPropertyConstraints('version', [
            new Assert\Choice([
                'choices'   => self::versions,
            ])
        ]);
    }

    /**
     * @return string
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @return bool
     */
    public function isVersion4()
    {
        return $this->getVersion() === AtolOnlineApi::API_VERSION_V4;
    }
}
