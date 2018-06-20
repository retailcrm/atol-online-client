<?php

namespace AtolOnlineClient\Response;

use JMS\Serializer\Annotation as Serializer;

class Payload
{
    /**
     * Номер чека в смене
     * @var "integer"
     *
     * @Serializer\Groups({"get"})
     * @Serializer\SerializedName("fiscal_receipt_number")
     * @Serializer\Type("integer")
     */
    private $fiscalReceiptNumber;

    /**
     * Номер смены
     * @var "integer"
     *
     * @Serializer\Groups({"get"})
     * @Serializer\SerializedName("shift_number")
     * @Serializer\Type("integer")
     */
    private $shiftNumber;

    /**
     * Дата и время документа из ФН
     * @var string
     *
     * @Serializer\Groups({"get"})
     * @Serializer\SerializedName("receipt_datetime")
     * @Serializer\Type("string")
     */
    private $receiptDatetime;

    /**
     * Итоговая сумма документа
     * @var float
     *
     * @Serializer\Groups({"get"})
     * @Serializer\SerializedName("total")
     * @Serializer\Type("float")
     */
    private $total;

    /**
     * Номер ФН
     * @var string
     *
     * @Serializer\Groups({"get"})
     * @Serializer\SerializedName("fn_number")
     * @Serializer\Type("string")
     */
    private $fnNumber;

    /**
     * Регистрационный номер ККМ
     * @var string
     *
     * @Serializer\Groups({"get"})
     * @Serializer\SerializedName("ecr_registration_number")
     * @Serializer\Type("string")
     */
    private $ecrRegistrationNumber;

    /**
     * Фискальный номер документа
     * @var integer
     *
     * @Serializer\Groups({"get"})
     * @Serializer\SerializedName("fiscal_document_number")
     * @Serializer\Type("integer")
     */
    private $fiscalDocumentNumber;

    /**
     * Фискальный признак документа
     * @var integer
     *
     * @Serializer\Groups({"get"})
     * @Serializer\SerializedName("fiscal_document_attribute")
     * @Serializer\Type("integer")
     */
    private $fiscalDocumentAttribute;

    /**
     * @return mixed
     */
    public function getFiscalReceiptNumber()
    {
        return $this->fiscalReceiptNumber;
    }

    /**
     * @param mixed $fiscalReceiptNumber
     *
     * @return $this
     */
    public function setFiscalReceiptNumber($fiscalReceiptNumber)
    {
        $this->fiscalReceiptNumber = $fiscalReceiptNumber;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getShiftNumber()
    {
        return $this->shiftNumber;
    }

    /**
     * @param mixed $shiftNumber
     *
     * @return $this
     */
    public function setShiftNumber($shiftNumber)
    {
        $this->shiftNumber = $shiftNumber;

        return $this;
    }

    /**
     * @return string
     */
    public function getReceiptDatetime()
    {
        return $this->receiptDatetime;
    }

    /**
     * @param string $receiptDatetime
     *
     * @return $this
     */
    public function setReceiptDatetime($receiptDatetime)
    {
        $this->receiptDatetime = $receiptDatetime;

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
     * @return string
     */
    public function getFnNumber()
    {
        return $this->fnNumber;
    }

    /**
     * @param string $fnNumber
     *
     * @return $this
     */
    public function setFnNumber($fnNumber)
    {
        $this->fnNumber = $fnNumber;

        return $this;
    }

    /**
     * @return string
     */
    public function getEcrRegistrationNumber()
    {
        return $this->ecrRegistrationNumber;
    }

    /**
     * @param string $ecrRegistrationNumber
     *
     * @return $this
     */
    public function setEcrRegistrationNumber($ecrRegistrationNumber)
    {
        $this->ecrRegistrationNumber = $ecrRegistrationNumber;

        return $this;
    }

    /**
     * @return int
     */
    public function getFiscalDocumentNumber()
    {
        return $this->fiscalDocumentNumber;
    }

    /**
     * @param int $fiscalDocumentNumber
     *
     * @return $this
     */
    public function setFiscalDocumentNumber($fiscalDocumentNumber)
    {
        $this->fiscalDocumentNumber = $fiscalDocumentNumber;

        return $this;
    }

    /**
     * @return int
     */
    public function getFiscalDocumentAttribute()
    {
        return $this->fiscalDocumentAttribute;
    }

    /**
     * @param int $fiscalDocumentAttribute
     *
     * @return $this
     */
    public function setFiscalDocumentAttribute($fiscalDocumentAttribute)
    {
        $this->fiscalDocumentAttribute = $fiscalDocumentAttribute;

        return $this;
    }
}
