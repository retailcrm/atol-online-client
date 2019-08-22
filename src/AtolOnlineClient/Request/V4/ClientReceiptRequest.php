<?php

namespace AtolOnlineClient\Request\V4;

use JMS\Serializer\Annotation as Serializer;

/**
 * В запросе обязательно должно быть заполнено хотя бы одно из полей: email или phone.
 * Если заполнены оба поля, ОФД отправит электронный чек только на email.
 * @Serializer\AccessType("public_method")
 */
class ClientReceiptRequest
{
    /**
     * @var string|null
     * @Serializer\Groups({"set", "get"})
     * @Serializer\SerializedName("email")
     * @Serializer\Type("string")
     */
    private $email;

    /**
     * @var string|null
     * @Serializer\Groups({"set", "get"})
     * @Serializer\SerializedName("phone")
     * @Serializer\Type("string")
     */
    private $phone;


    /**
     * @var string|null
     *
     * @Serializer\Groups({"set", "get"})
     * @Serializer\SerializedName("name")
     * @Serializer\Type("string")
     */
    private $name;

    /**
     * @var string|null
     *
     * @Serializer\Groups({"set", "get"})
     * @Serializer\SerializedName("inn")
     * @Serializer\Type("string")
     */
    private $inn;

    public function __construct(string $email = null, string $phone = null)
    {
        $this->email = $email;
        $this->phone = $phone;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     */
    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string|null
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * @param string|null $phone
     */
    public function setPhone(?string $phone): void
    {
        $this->phone = $phone;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string|null
     */
    public function getInn(): ?string
    {
        return $this->inn;
    }

    /**
     * @param string|null $inn
     */
    public function setInn(?string $inn): void
    {
        $this->inn = $inn;
    }
}
