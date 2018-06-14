<?php

namespace AtolOnlineClient\Request\V4;

use JMS\Serializer\Annotation as Serializer;

class ServiceRequest
{

    /**
     * @var string
     * @Serializer\Groups({"set", "get"})
     * @Serializer\SerializedName("callback_url")
     * @Serializer\Type("string")
     */
    private $callbackUrl;

    /**
     * @return string
     */
    public function getCallbackUrl(): string
    {
        return $this->callbackUrl;
    }

    /**
     * @param string $callbackUrl
     */
    public function setCallbackUrl(string $callbackUrl): void
    {
        $this->callbackUrl = $callbackUrl;
    }
}
