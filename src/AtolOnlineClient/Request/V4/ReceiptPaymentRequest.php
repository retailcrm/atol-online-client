<?php

namespace AtolOnlineClient\Request\V4;

use JMS\Serializer\Annotation as Serializer;

/**
 * @Serializer\AccessType("public_method")
 */
class ReceiptPaymentRequest
{
    const TYPE_CASH = 0;
    const TYPE_ELECTRON = 1;
    //аванс
    const TYPE_PREPAY = 2;
    const TYPE_CREDIT = 3;
    const TYPE_OTHER = 4;

    /**
     * @var int
     * "enum": 0..9
     * required
     * @Serializer\Groups({"set", "get"})
     * @Serializer\SerializedName("type")
     * @Serializer\Type("integer")
     */
    private $type;

    /**
     * @var float
     * required
     * @Serializer\Groups({"set", "get"})
     * @Serializer\SerializedName("sum")
     * @Serializer\Type("float")
     */
    private $sum;

    /**
     * @param int $type
     * @param float $sum
     */
    public function __construct($type, $sum)
    {
        $this->type = $type;
        $this->sum = $sum;
    }

    /**
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param int $type
     */
    public function setType(int $type): void
    {
        $this->type = $type;
    }

    /**
     * @return float
     */
    public function getSum()
    {
        return $this->sum;
    }

    /**
     * @param float $sum
     */
    public function setSum(float $sum): void
    {
        $this->sum = $sum;
    }
}
