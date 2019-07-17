<?php

namespace AtolOnlineClient\Request\V4;

use JMS\Serializer\Annotation as Serializer;

/**
 * @Serializer\AccessType("public_method")
 */
class VatReceiptRequest
{
    /**
     *
     * "enum": [
     *   "none",
     *   "vat0",
     *   "vat10",
     *   "vat20",
     *   "vat110",
     *   "vat120"
     * ]
     *
     * @var string
     * required
     * @Serializer\Groups({"set", "get"})
     * @Serializer\SerializedName("type")
     * @Serializer\Type("string")
     */
    private $type;

    /**
     * @var float|null
     *
     * @Serializer\Groups({"set", "get"})
     * @Serializer\SerializedName("sum")
     * @Serializer\Type("float")
     */
    private $sum;

    /**
     * VatReceiptRequest constructor.
     * @param string $type
     * @param float $sum
     */
    public function __construct(string $type, $sum)
    {
        $this->type = $type;
        $this->sum = (float) $sum;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
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
