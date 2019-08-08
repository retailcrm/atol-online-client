<?php

namespace AtolOnlineClient\Response;

use JMS\Serializer\Annotation as Serializer;

/**
 * @Serializer\AccessType("public_method")
 */
class OperationResponse
{

    /**
     * Поле отсутсвует в ответе а операцию sell с ошибкой начиная с 4й версии
     * @var string
     *
     * @Serializer\Groups({"post", "get"})
     * @Serializer\SerializedName("uuid")
     * @Serializer\Type("string")
     */
    private $uuid;

    /**
     * @var Error
     *
     * @Serializer\Groups({"post", "get"})
     * @Serializer\SerializedName("error")
     * @Serializer\Type("AtolOnlineClient\Response\Error")
     */
    private $error;

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
     * @var Payload
     *
     * @Serializer\Groups({"get"})
     * @Serializer\SerializedName("payload")
     * @Serializer\Type("AtolOnlineClient\Response\Payload")
     */
    private $payload;

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
     * @Serializer\Groups({"get"})
     * @Serializer\SerializedName("group_code")
     * @Serializer\Type("string")
     */
    private $groupCode;

    /**
     * @var string
     *
     * @Serializer\Groups({"get"})
     * @Serializer\SerializedName("daemon_code")
     * @Serializer\Type("string")
     */
    private $daemonCode;

    /**
     * @var string
     *
     * @Serializer\Groups({"get"})
     * @Serializer\SerializedName("device_code")
     * @Serializer\Type("string")
     */
    private $deviceCode;


    /**
     * @var string
     *
     * @Serializer\Groups({"get"})
     * @Serializer\SerializedName("callback_url")
     * @Serializer\Type("string")
     */
    private $callbackUrl;

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

    /**
     * @return string
     */
    public function getGroupCode()
    {
        return $this->groupCode;
    }

    /**
     * @param string $groupCode
     */
    public function setGroupCode(?string $groupCode)
    {
        $this->groupCode = $groupCode;
    }

    /**
     * @return string
     */
    public function getDaemonCode()
    {
        return $this->daemonCode;
    }

    /**
     * @param string $daemonCode
     */
    public function setDaemonCode(?string $daemonCode)
    {
        $this->daemonCode = $daemonCode;
    }

    /**
     * @return string
     */
    public function getDeviceCode()
    {
        return $this->deviceCode;
    }

    /**
     * @param string $deviceCode
     */
    public function setDeviceCode(?string $deviceCode)
    {
        $this->deviceCode = $deviceCode;
    }
}
