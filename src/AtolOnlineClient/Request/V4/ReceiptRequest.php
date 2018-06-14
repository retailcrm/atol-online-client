<?php

namespace AtolOnlineClient\Request\V4;

use JMS\Serializer\Annotation as Serializer;

class ReceiptRequest
{

    /**
     * @var ClientReceiptRequest
     *
     * @Serializer\Groups({"set", "get"})
     * @Serializer\SerializedName("client")
     * @Serializer\Type("AtolOnlineClient\Request\V4\ClientReceiptRequest")
     *
     */
    private $client;

    /**
     * @var CompanyReceiptRequest
     *
     * @Serializer\Groups({"set", "get"})
     * @Serializer\SerializedName("company")
     * @Serializer\Type("AtolOnlineClient\Request\V4\CompanyReceiptRequest")
     */
    private $company;

    /**
     * @var ReceiptItemRequest[]
     * "minItems": 1, "maxItems": 100,
     * required
     * @Serializer\Groups({"set", "get"})
     * @Serializer\SerializedName("items")
     * @Serializer\Type("array<AtolOnlineClient\Request\V4\ReceiptItemRequest>")
     */
    private $items;

    /**
     * @var \AtolOnlineClient\Request\V4\ReceiptPaymentRequest[]
     * "minItems": 1, "maxItems": 10,
     * required
     * @Serializer\Groups({"set", "get"})
     * @Serializer\SerializedName("payments")
     * @Serializer\Type("array<AtolOnlineClient\Request\V4\ReceiptPaymentRequest>")
     */
    private $payments;

    /**
     * @var \AtolOnlineClient\Request\V4\VatReceiptRequest[]
     * "minItems": 1, "maxItems": 6,
     * required
     * @Serializer\Groups({"set", "get"})
     * @Serializer\SerializedName("vats")
     * @Serializer\Type("array<AtolOnlineClient\Request\V4\VatReceiptRequest>")
     */
    private $vats;

    /**
     * @var float
     * required
     * @Serializer\Groups({"set", "get"})
     * @Serializer\SerializedName("total")
     * @Serializer\Type("float")
     */
    private $total;

    /**
     * @return ClientReceiptRequest
     */
    public function getClient(): ClientReceiptRequest
    {
        return $this->client;
    }

    /**
     * @param ClientReceiptRequest $client
     */
    public function setClient(ClientReceiptRequest $client): void
    {
        $this->client = $client;
    }

    /**
     * @return CompanyReceiptRequest
     */
    public function getCompany(): CompanyReceiptRequest
    {
        return $this->company;
    }

    /**
     * @param CompanyReceiptRequest $company
     */
    public function setCompany(CompanyReceiptRequest $company): void
    {
        $this->company = $company;
    }

    /**
     * @return ReceiptItemRequest[]
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @param ReceiptItemRequest[] $items
     */
    public function setItems(array $items): void
    {
        $this->items = $items;
    }

    /**
     * @return ReceiptPaymentRequest[]
     */
    public function getPayments(): array
    {
        return $this->payments;
    }

    /**
     * @param ReceiptPaymentRequest[] $payments
     */
    public function setPayments(array $payments): void
    {
        $this->payments = $payments;
    }

    /**
     * @return VatReceiptRequest[]
     */
    public function getVats(): array
    {
        return $this->vats;
    }

    /**
     * @param VatReceiptRequest[] $vats
     */
    public function setVats(array $vats): void
    {
        $this->vats = $vats;
    }

    /**
     * @return float
     */
    public function getTotal(): float
    {
        return $this->total;
    }

    /**
     * @param float $total
     */
    public function setTotal(float $total): void
    {
        $this->total = $total;
    }
}
