<?php

namespace AtolOnlineClient\Request\V3;

use JMS\Serializer\Annotation as Serializer;

class ReceiptAttributesRequest
{

    /**
     * @var string
     *
     * "enum": [
     *   "osn",
     *   "usn_income",
     *   "usn_income_outcome",
     *   "envd",
     *   "esn",
     *   "patent"
     * ]
     * @Serializer\Groups({"set", "get"})
     * @Serializer\SerializedName("sno")
     * @Serializer\Type("string")
     */
    private $sno;

    /**
     * @var string
     * required
     * @Serializer\Groups({"set", "get"})
     * @Serializer\SerializedName("email")
     * @Serializer\Type("string")
     */
    private $email;

    /**
     * @var string
     * required
     * @Serializer\Groups({"set", "get"})
     * @Serializer\SerializedName("phone")
     * @Serializer\Type("string")
     */
    private $phone;

    /**
     * ReceiptAttributesRequest constructor.
     * @param string $email
     * @param string $phone
     */
    public function __construct($email, $phone)
    {
        $this->email = $email;
        if ($email == null) {
            $this->email = '';
        }

        $this->phone = $phone;
        if ($phone == null) {
            $this->phone = '';
        }
    }

    /**
     * @return string
     */
    public function getSno()
    {
        return $this->sno;
    }

    /**
     * @param string $sno
     *
     * @return $this
     */
    public function setSno($sno)
    {
        $this->sno = $sno;

        return $this;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }
}
