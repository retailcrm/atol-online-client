<?php

namespace AtolOnlineClient\Request\V3;

use JMS\Serializer\Annotation as Serializer;

class ReceiptRequest
{

    /**
     * @var ReceiptAttributesRequest
     * required
     * @Serializer\Groups({"set", "get"})
     * @Serializer\SerializedName("attributes")
     * @Serializer\Type("AtolOnlineClient\Request\ReceiptAttributesRequest")
     */
    private $attributes;

    /**
     * @var ReceiptItemRequest[]
     * "minItems": 1, "maxItems": 100,
     * required
     * @Serializer\Groups({"set", "get"})
     * @Serializer\SerializedName("items")
     * @Serializer\Type("array<AtolOnlineClient\Request\ReceiptItemRequest>")
     */
    private $items;

    /**
     * @var float
     * required
     * @Serializer\Groups({"set", "get"})
     * @Serializer\SerializedName("total")
     * @Serializer\Type("float")
     */
    private $total;

    /**
     * @var \AtolOnlineClient\Request\V3\ReceiptPaymentRequest[]
     * "minItems": 1, "maxItems": 10,
     * required
     * @Serializer\Groups({"set", "get"})
     * @Serializer\SerializedName("payments")
     * @Serializer\Type("array<AtolOnlineClient\Request\ReceiptPaymentRequest>")
     */
    private $payments;

    /**
     * @return ReceiptAttributesRequest
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * @param ReceiptAttributesRequest $attributes
     *
     * @return $this
     */
    public function setAttributes($attributes)
    {
        $this->attributes = $attributes;

        return $this;
    }

    /**
     * @return ReceiptItemRequest[]
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @param ReceiptItemRequest[] $items
     *
     * @return $this
     */
    public function setItems($items)
    {
        $this->items = $items;

        return $this;
    }

    /**
     * @return float
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * @param float $total
     *
     * @return $this
     */
    public function setTotal($total)
    {
        $this->total = $total;

        return $this;
    }

    /**
     * @return \AtolOnlineClient\Request\V3\ReceiptPaymentRequest[]
     */
    public function getPayments()
    {
        return $this->payments;
    }

    /**
     * @param \AtolOnlineClient\Request\V3\ReceiptPaymentRequest[] $payments
     *
     * @return $this
     */
    public function setPayments($payments)
    {
        $this->payments = $payments;

        return $this;
    }
}
