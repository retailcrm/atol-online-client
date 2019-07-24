<?php

namespace AtolOnlineClient\Exception;

/**
 * Class InvalidResponseException
 *
 * @package AtolOnlineClient\Exception
 */
class InvalidResponseException extends AtolException
{
    /**
     * @var int|null
     */
    protected $codeError;

    /**
     * @var string|null
     */
    protected $messageError;

    /**
     * @return int|null
     */
    public function getCodeError(): ?int
    {
        return $this->codeError;
    }

    /**
     * @param int|null $codeError
     * @return InvalidResponseException
     */
    public function setCodeError(?int $codeError): InvalidResponseException
    {
        $this->codeError = $codeError;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getMessageError(): ?string
    {
        return $this->messageError;
    }

    /**
     * @param string|null $messageError
     * @return InvalidResponseException
     */
    public function setMessageError(?string $messageError): InvalidResponseException
    {
        $this->messageError = $messageError;

        return $this;
    }
}
