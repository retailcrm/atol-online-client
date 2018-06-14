<?php

namespace AtolOnlineClient\Request\V3;

use JMS\Serializer\Annotation as Serializer;

class ServiceRequest
{

    /**
     * @var string
     * required
     * @Serializer\Groups({"set", "get"})
     * @Serializer\SerializedName("inn")
     * @Serializer\Type("string")
     */
    private $inn;

    /**
     * @var string
     * @Serializer\Groups({"set", "get"})
     * @Serializer\SerializedName("callback_url")
     * @Serializer\Type("string")
     */
    private $callbackUrl;

    /**
     * @var string
     * required
     * @Serializer\Groups({"set", "get"})
     * @Serializer\SerializedName("payment_address")
     * @Serializer\Type("string")
     */
    private $paymentAddress;

    /**
     * Service constructor.
     * @param string $inn
     * @param string $paymentAddress
     */
    public function __construct($inn, $paymentAddress)
    {
        $this->inn = $inn;
        $this->paymentAddress = $paymentAddress;
    }

    /**
     * @return string
     */
    public function getCallbackUrl()
    {
        return $this->callbackUrl;
    }

    /**
     * @param string $callbackUrl
     *
     * @return $this
     */
    public function setCallbackUrl($callbackUrl)
    {
        $this->callbackUrl = $callbackUrl;

        return $this;
    }

    /**
     * @return string
     */
    public function getInn()
    {
        return $this->inn;
    }

    /**
     * @param string $inn
     *
     * @return $this
     */
    public function setInn($inn)
    {
        $this->inn = $inn;

        return $this;
    }

    /**
     * @return string
     */
    public function getPaymentAddress()
    {
        return $this->paymentAddress;
    }

    /**
     * @param string $paymentAddress
     *
     * @return $this
     */
    public function setPaymentAddress($paymentAddress)
    {
        $this->paymentAddress = $paymentAddress;

        return $this;
    }
}
