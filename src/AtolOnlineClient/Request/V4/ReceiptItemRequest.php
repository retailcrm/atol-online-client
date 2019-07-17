<?php

namespace AtolOnlineClient\Request\V4;

use JMS\Serializer\Annotation as Serializer;

/**
 * @Serializer\AccessType("public_method")
 */
class ReceiptItemRequest
{

    const PAYMENT_METHOD_FULL_PREPAYMENT = 'full_prepayment';
    const PAYMENT_METHOD_PREPAYMENT = 'prepayment';
    const PAYMENT_METHOD_ADVANCE = 'advance';
    const PAYMENT_METHOD_FULL_PAYMENT = 'full_payment';
    const PAYMENT_METHOD_partial_payment = 'partial_payment';
    const PAYMENT_METHOD_CREDIT = 'credit';
    const PAYMENT_METHOD_CREDIT_PAYMENT = 'credit_payment';


    const PAYMENT_OBJECT_COMMODITY = 'commodity';
    const PAYMENT_OBJECT_EXCISE = 'excise';
    const PAYMENT_OBJECT_JOB = 'job';
    const PAYMENT_OBJECT_SERVICE = 'service';
    const PAYMENT_OBJECT_GAMBLING_BET = 'gambling_bet';
    const PAYMENT_OBJECT_GAMBLING_PRIZE = 'gambling_prize';
    const PAYMENT_OBJECT_LOTTERY = 'lottery';
    const PAYMENT_OBJECT_LOTTERY_PRIZE = 'lottery_prize';
    const PAYMENT_OBJECT_INTELLECTUAL_ACTIVITY = 'intellectual_activity';
    const PAYMENT_OBJECT_PAYMENT = 'payment';
    const PAYMENT_OBJECT_AGENT_COMMISSION = 'agent_commission';
    const PAYMENT_OBJECT_COMPOSITE = 'composite';
    const PAYMENT_OBJECT_ANOTHER = 'another';


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
     * @var string|null
     *
     * required
     * @Serializer\Groups({"set", "get"})
     * @Serializer\SerializedName("measurement_unit")
     * @Serializer\Type("string")
     */
    private $measurementUnit;


    /**
     * required
     * Признак способа расчёта. Возможные значения:
     * «full_prepayment» – предоплата 100%. Полная предварительная оплата до момента передачи предмета расчета.
     * «prepayment» – предоплата. Частичная предварительная оплата до момента передачи предмета расчета.
     * «advance» – аванс.
     * «full_payment» – полный расчет. Полная оплата, в том числе с учетом аванса (предварительной оплаты) в момент передачи предмета расчета.
     * «partial_payment» – частичный расчет и кредит. Частичная оплата предмета расчета в момент его передачи с последующей оплатой в кредит.
     * «credit» – передача в кредит. Передача предмета расчета без его оплаты в момент его передачи с последующей оплатой в кредит.
     * «credit_payment» – оплата кредита. Оплата предмета расчета после его передачи с оплатой в кредит (оплата кредита).
     * @var string|null
     *
     * @Serializer\Groups({"set", "get"})
     * @Serializer\SerializedName("payment_method")
     * @Serializer\Type("string")
     */
    private $paymentMethod;


    /**
     * Признак предмета расчёта:
     *  «commodity» – товар. О реализуемом товаре, за исключением подакцизного товара (наименование и иные сведения, описывающие товар).
     *  «excise» – подакцизный товар. О реализуемом подакцизном товаре (наименование и иные сведения, описывающие товар).
     *  «job» – работа. О выполняемой работе (наименование и иные сведения, описывающие работу).
     *  «service» – услуга. Об оказываемой услуге (наименование и иные сведения, описывающие услугу).
     *  «gambling_bet» – ставка азартной игры. О приеме ставок при осуществлении деятельности по проведению азартных игр.
     *  «gambling_prize» – выигрыш азартной игры. О выплате денежных средств в виде выигрыша при осуществлении деятельности по проведению азартных игр.
     *  «lottery» – лотерейный билет. О приеме денежных средств при реализации лотерейных билетов, электронных лотерейных билетов, приеме лотерейных ставок при осуществлении деятельности по проведению лотерей.
     *  «lottery_prize» – выигрыш лотереи. О выплате денежных средств в виде выигрыша при осуществлении деятельности по проведению лотерей.
     *  «intellectual_activity» – предоставление результатов интеллектуальной деятельности. О предоставлении прав на использование результатов интеллектуальной деятельности или средств индивидуализации.
     *  «payment» – платеж. Об авансе, задатке, предоплате, кредите, взносе в счет оплаты, пени, штрафе, вознаграждении, бонусе и ином аналогичном предмете расчета.
     *  «agent_commission» – агентское вознаграждение. О вознаграждении пользователя, являющегося платежным агентом (субагентом), банковским платежным агентом (субагентом), комиссионером, поверенным или иным агентом.
     *  «composite» – составной предмет расчета. О предмете расчета, состоящем из предметов, каждому из которых может быть присвоено значение выше перечисленных признаков.
     *  «another» – иной предмет расчета. О предмете расчета, не относящемуся к выше перечисленным предметам расчета
     *
     * @var string|null
     *
     * @Serializer\Groups({"set", "get"})
     * @Serializer\SerializedName("payment_object")
     * @Serializer\Type("string")
     */
    private $paymentObject;


    /**
     * @var VatReceiptRequest
     *
     * @Serializer\Groups({"set", "get"})
     * @Serializer\SerializedName("vat")
     * @Serializer\Type("AtolOnlineClient\Request\V4\VatReceiptRequest")
     */
    private $vat;

    /**
     * @var string|null
     * @Serializer\Groups({"set", "get"})
     * @Serializer\SerializedName("nomenclature_code")
     * @Serializer\Type("string")
     */
    private $nomenclatureCode;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     */
    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }

    /**
     * @return float
     */
    public function getSum(): float
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

    /**
     * @return string|null
     */
    public function getMeasurementUnit(): ?string
    {
        return $this->measurementUnit;
    }

    /**
     * @param string|null $measurementUnit
     */
    public function setMeasurementUnit(?string $measurementUnit): void
    {
        $this->measurementUnit = $measurementUnit;
    }

    /**
     * @return string|null
     */
    public function getPaymentMethod(): ?string
    {
        return $this->paymentMethod;
    }

    /**
     * @param string|null $paymentMethod
     */
    public function setPaymentMethod(?string $paymentMethod): void
    {
        $this->paymentMethod = $paymentMethod;
    }

    /**
     * @return string|null
     */
    public function getPaymentObject(): ?string
    {
        return $this->paymentObject;
    }

    /**
     * @param string|null $paymentObject
     */
    public function setPaymentObject(?string $paymentObject): void
    {
        $this->paymentObject = $paymentObject;
    }

    /**
     * @return VatReceiptRequest
     */
    public function getVat(): VatReceiptRequest
    {
        return $this->vat;
    }

    /**
     * @param VatReceiptRequest $vat
     */
    public function setVat(VatReceiptRequest $vat): void
    {
        $this->vat = $vat;
    }

    /**
     * @return string|null
     */
    public function getNomenclatureCode(): ?string
    {
        return $this->nomenclatureCode;
    }

    /**
     * @param string|null $nomenclatureCode
     */
    public function setNomenclatureCode(?string $nomenclatureCode): void
    {
        $this->nomenclatureCode = $nomenclatureCode;
    }
}
