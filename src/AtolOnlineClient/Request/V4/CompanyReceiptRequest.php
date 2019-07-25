<?php

namespace AtolOnlineClient\Request\V4;

use JMS\Serializer\Annotation as Serializer;

/**
 * @Serializer\AccessType("public_method")
 */
class CompanyReceiptRequest
{
    /**
     * @var string
     * required
     * @Serializer\Groups({"set", "get"})
     * @Serializer\SerializedName("email")
     * @Serializer\Type("string")
     */
    private $email;

    /**
     * @var string|null
     * Поле необязательно, если у организации один тип налогообложения
     * @Serializer\Groups({"set", "get"})
     * @Serializer\SerializedName("sno")
     * @Serializer\Type("string")
     */
    private $sno;

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
     * required
     * @Serializer\Groups({"set", "get"})
     * @Serializer\SerializedName("payment_address")
     * @Serializer\Type("string")
     */
    private $paymentAddress;

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string|null
     */
    public function getSno(): ?string
    {
        return $this->sno;
    }

    /**
     * @param string|null $sno
     */
    public function setSno(?string $sno): void
    {
        $this->sno = $sno;
    }

    /**
     * @return string
     */
    public function getInn(): string
    {
        return $this->inn;
    }

    /**
     * @param string $inn
     */
    public function setInn(string $inn): void
    {
        $this->inn = $inn;
    }

    /**
     * @return string
     */
    public function getPaymentAddress(): string
    {
        return $this->paymentAddress;
    }

    /**
     * @param string $paymentAddress
     */
    public function setPaymentAddress(string $paymentAddress): void
    {
        $this->paymentAddress = $paymentAddress;
    }
}
