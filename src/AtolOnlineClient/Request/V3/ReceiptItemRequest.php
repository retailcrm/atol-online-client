<?php

namespace AtolOnlineClient\Request\V3;

use JMS\Serializer\Annotation as Serializer;

class ReceiptItemRequest
{

    /**
     * @var string
     * required
     * @Serializer\Groups({"set", "get"})
     * @Serializer\SerializedName("name")
     * @Serializer\Type("string")
     */
    private $name;

    /**
     * @var float
     * required
     * @Serializer\Groups({"set", "get"})
     * @Serializer\SerializedName("price")
     * @Serializer\Type("float")
     */
    private $price;

    /**
     * @var integer
     * required
     * @Serializer\Groups({"set", "get"})
     * @Serializer\SerializedName("quantity")
     * @Serializer\Type("integer")
     */
    private $quantity;

    /**
     * @var float
     * required
     * @Serializer\Groups({"set", "get"})
     * @Serializer\SerializedName("sum")
     * @Serializer\Type("float")
     */
    private $sum;

    /**
     * @var string
     *
     * "enum": [
     *   "none",
     *   "vat0",
     *   "vat10",
     *   "vat18",
     *   "vat110",
     *   "vat118"
     * ]
     * required
     * @Serializer\Groups({"set", "get"})
     * @Serializer\SerializedName("tax")
     * @Serializer\Type("string")
     */
    private $tax;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param float $price
     *
     * @return $this
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return integer
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     *
     * @return $this
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
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
     *
     * @return $this
     */
    public function setSum($sum)
    {
        $this->sum = $sum;

        return $this;
    }

    /**
     * @return string
     */
    public function getTax()
    {
        return $this->tax;
    }

    /**
     * @param string $tax
     *
     * @return $this
     */
    public function setTax($tax)
    {
        $this->tax = $tax;

        return $this;
    }
}
