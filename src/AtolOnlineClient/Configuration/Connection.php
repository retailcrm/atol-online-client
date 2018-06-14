<?php

namespace AtolOnlineClient\Configuration;

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

    const PLATFORMA_OFD = 'platforma_ofd';
    const PERVIY_OFD = 'perviy_ofd';
    const TAXCOM_OFD = 'taxcom_ofd';

    const V3 = 'v3';
    const V4 = 'v4';

    const snoTypes = [
        self::SNO_GENERAL,
        self::SNO_USN_INCOME,
        self::SNO_USN_INCOME_OUTCOME,
        self::SNO_ENVD,
        self::SNO_ESN,
        self::SNO_PATENT,
    ];

    const ofdList = [
        self::PLATFORMA_OFD,
        self::PERVIY_OFD,
        self::TAXCOM_OFD,
    ];

    const versions = [
        self::V3,
        self::V4,
    ];

    protected $url;
    /** @var bool */
    protected $debug;

    /** @var string */
    public $login;

    /** @var string */
    public $pass;

    /** @var string */
    public $group;

    /** @var int */
    public $legalEntity;

    /** @var array */
    public $paymentTypes;

    /** @var array */
    public $paymentStatuses;

    /** @var boolean */
    public $enabled;

    /** @var string */
    public $sno;

    /** @var string */
    public $ofd;

    /** @var string */
    public $version;

    /**
     * @param mixed $url
     */
    public function setUrl($url): void
    {
        $this->url = $url;
    }


    public function __construct()
    {
        $this->setUrl('');
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
    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('login', new Assert\NotBlank());
        $metadata->addPropertyConstraint('pass', new Assert\NotBlank());
        $metadata->addPropertyConstraint('group', new Assert\NotBlank());
        $metadata->addPropertyConstraint('legalEntity', new Assert\NotBlank());
        $metadata->addPropertyConstraints('sno', [
            new Assert\Choice([
                'choices'   => self::snoTypes,
            ])
        ]);
        $metadata->addPropertyConstraints('ofd', [
            new Assert\Choice([
                'choices'   => self::ofdList,
            ])
        ]);
        $metadata->addPropertyConstraints('version', [
            new Assert\Choice([
                'choices'   => self::versions,
            ])
        ]);
        $metadata->addPropertyConstraint('paymentTypes', new Assert\NotBlank());
        $metadata->addPropertyConstraint('paymentStatuses', new Assert\NotBlank());
    }

    /**
     * @return string
     */
    public function getOfdAddress()
    {
        switch ($this->ofd) {
            case self::PLATFORMA_OFD:
                return 'platformaofd.ru';
            case self::PERVIY_OFD:
                return 'www.1-ofd.ru';
            case self::TAXCOM_OFD:
                return 'taxcom.ru/ofd/';
        }

        return null;
    }

    /**
     * @return string
     */
    public function getVersion()
    {
        return $this->version;
    }
}
