<?php

namespace AtolOnlineClient\Request\V4;

use JMS\Serializer\Annotation as Serializer;

class VatReceiptRequest
{
    /**
     *
     * "enum": [
     *   "none",
     *   "vat0",
     *   "vat10",
     *   "vat18",
     *   "vat110",
     *   "vat118"
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
     * @var float
     * required
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
     * @return float
     */
    public function getSum()
    {
        return $this->sum;
    }
}
