<?php

namespace AtolOnlineClient\Response;

use JMS\Serializer\Annotation as Serializer;

class Error
{

    /**
     * @var integer
     *
     * @Serializer\Groups({"post", "get"})
     * @Serializer\SerializedName("code")
     * @Serializer\Type("integer")
     */
    private $code;

    /**
     * @var string
     * @Serializer\Groups({"post", "get"})
     * @Serializer\SerializedName("text")
     * @Serializer\Type("string")
     */
    private $text;

    /**
     * @var string
     * "enum": ["none", "unknown", "system", "driver", "timeout"]
     *
     * @Serializer\Groups({"post", "get"})
     * @Serializer\SerializedName("type")
     * @Serializer\Type("string")
     */
    private $type;

    /**
     * @return int
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param int $code
     *
     * @return $this
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param string $text
     *
     * @return $this
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     *
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }
}
