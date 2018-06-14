<?php

namespace AtolOnlineClient\Response;

use JMS\Serializer\Annotation as Serializer;

class OperationResponse
{

    /**
     * @var string
     *
     * @Serializer\Groups({"post", "get"})
     * @Serializer\SerializedName("uuid")
     * @Serializer\Type("string")
     */
    private $uuid;

    /**
     * @var string
     *
     * @Serializer\Groups({"post", "get"})
     * @Serializer\SerializedName("timestamp")
     * @Serializer\Type("string")
     */
    private $timestamp;

    /**
     * @var string
     *
     * "enum": ["wait", "done", "fail"]
     *
     * @Serializer\Groups({"post", "get"})
     * @Serializer\SerializedName("status")
     * @Serializer\Type("string")
     */
    private $status;

    /**
     * @var string
     *
     * @Serializer\Groups({"get"})
     * @Serializer\SerializedName("callback_url")
     * @Serializer\Type("string")
     */
    private $callbackUrl;

    /**
     * @var Payload
     *
     * @Serializer\Groups({"get"})
     * @Serializer\SerializedName("payload")
     * @Serializer\Type("Intaro\CRMFiscalBundle\FiscalService\AtolOnline\Response\Payload")
     */
    private $payload;

    /**
     * @var Error
     *
     * @Serializer\Groups({"post", "get"})
     * @Serializer\SerializedName("error")
     * @Serializer\Type("Intaro\CRMFiscalBundle\FiscalService\AtolOnline\Response\Error")
     */
    private $error;

    /**
     * @return string
     */
    public function getUuid()
    {
        return $this->uuid;
    }

    /**
     * @param string $uuid
     *
     * @return $this
     */
    public function setUuid($uuid)
    {
        $this->uuid = $uuid;

        return $this;
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
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     *
     * @return $this
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return Error
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * @param Error $error
     *
     * @return $this
     */
    public function setError($error)
    {
        $this->error = $error;

        return $this;
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
     * @return Payload
     */
    public function getPayload()
    {
        return $this->payload;
    }

    /**
     * @param Payload $payload
     *
     * @return $this
     */
    public function setPayload($payload)
    {
        $this->payload = $payload;

        return $this;
    }
}
