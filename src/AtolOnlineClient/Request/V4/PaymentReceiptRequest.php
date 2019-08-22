<?php

namespace AtolOnlineClient\Request\V4;

use JMS\Serializer\Annotation as Serializer;

/**
 * @Serializer\AccessType("public_method")
 */
class PaymentReceiptRequest
{
    /**
     * @var string
     * required
     * @Serializer\Groups({"set", "get"})
     * @Serializer\SerializedName("external_id")
     * @Serializer\Type("string")
     */
    private $externalId;

    /**
     * @var ReceiptRequest
     * required
     * @Serializer\Groups({"set", "get"})
     * @Serializer\SerializedName("receipt")
     * @Serializer\Type("AtolOnlineClient\Request\V4\ReceiptRequest")
     */
    private $receipt;

    /**
     * @var string
     * required
     * @Serializer\Groups({"set", "get"})
     * @Serializer\SerializedName("timestamp")
     * @Serializer\Type("string")
     */
    private $timestamp;


    /**
     * @var ServiceRequest
     * required
     * @Serializer\Groups({"set", "get"})
     * @Serializer\SerializedName("service")
     * @Serializer\Type("AtolOnlineClient\Request\V4\ServiceRequest")
     */
    private $service;


    public function __construct()
    {
        $this->timestamp = (new \DateTime())->format('d.m.Y H:i:s');
    }

    /**
     * @return string
     */
    public function getExternalId(): string
    {
        return $this->externalId;
    }

    /**
     * @param string $externalId
     */
    public function setExternalId(string $externalId): void
    {
        $this->externalId = $externalId;
    }

    /**
     * @return ReceiptRequest
     */
    public function getReceipt(): ReceiptRequest
    {
        return $this->receipt;
    }

    /**
     * @param ReceiptRequest $receipt
     */
    public function setReceipt(ReceiptRequest $receipt): void
    {
        $this->receipt = $receipt;
    }

    /**
     * @return string
     */
    public function getTimestamp(): string
    {
        return $this->timestamp;
    }

    /**
     * @param string $timestamp
     */
    public function setTimestamp(string $timestamp): void
    {
        $this->timestamp = $timestamp;
    }

    /**
     * @return ServiceRequest
     */
    public function getService(): ServiceRequest
    {
        return $this->service;
    }

    /**
     * @param ServiceRequest $service
     */
    public function setService(ServiceRequest $service): void
    {
        $this->service = $service;
    }
}
