<?php

namespace AtolOnlineClient\Request\V3;

use JMS\Serializer\Annotation as Serializer;

class PaymentReceiptRequest
{
    /**
     * @var string
     * required
     * @Serializer\Groups({"set", "get"})
     * @Serializer\SerializedName("timestamp")
     * @Serializer\Type("string")
     */
    private $timestamp;

    /**
     * @var string
     * required
     * @Serializer\Groups({"set", "get"})
     * @Serializer\SerializedName("external_id")
     * @Serializer\Type("string")
     */
    private $externalId;

    /**
     * @var ServiceRequest
     * required
     * @Serializer\Groups({"set", "get"})
     * @Serializer\SerializedName("service")
     * @Serializer\Type("AtolOnlineClient\Request\V3\ServiceRequest")
     */
    private $service;

    /**
     * @var ReceiptRequest
     * required
     * @Serializer\Groups({"set", "get"})
     * @Serializer\SerializedName("receipt")
     * @Serializer\Type("AtolOnlineClient\Request\V3\ReceiptRequest")
     */
    private $receipt;

    public function __construct()
    {
        $this->timestamp = (new \DateTime())->format('d.m.Y H:i:s');
    }

    /**
     * @return string
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * @param string $timestamp
     *
     * @return $this
     */
    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;

        return $this;
    }

    /**
     * @return string
     */
    public function getExternalId()
    {
        return $this->externalId;
    }

    /**
     * @param string $externalId
     *
     * @return $this
     */
    public function setExternalId($externalId)
    {
        $this->externalId = $externalId;

        return $this;
    }

    /**
     * @return \AtolOnlineClient\Request\V3\ServiceRequest
     */
    public function getService()
    {
        return $this->service;
    }

    /**
     * @param \AtolOnlineClient\Request\V3\ServiceRequest $service
     *
     * @return $this
     */
    public function setService($service)
    {
        $this->service = $service;

        return $this;
    }

    /**
     * @return ReceiptRequest
     */
    public function getReceipt()
    {
        return $this->receipt;
    }

    /**
     * @param ReceiptRequest $receipt
     *
     * @return $this
     */
    public function setReceipt($receipt)
    {
        $this->receipt = $receipt;

        return $this;
    }
}
