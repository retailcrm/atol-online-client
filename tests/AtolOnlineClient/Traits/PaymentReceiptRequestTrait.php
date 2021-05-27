<?php

namespace AtolOnlineClient\AtolOnlineClient\Traits;

use AtolOnlineClient\Request\V4\ClientReceiptRequest;
use AtolOnlineClient\Request\V4\CompanyReceiptRequest;
use AtolOnlineClient\Request\V4\PaymentReceiptRequest;
use AtolOnlineClient\Request\V4\ReceiptItemRequest;
use AtolOnlineClient\Request\V4\ReceiptPaymentRequest;
use AtolOnlineClient\Request\V4\ReceiptRequest;
use AtolOnlineClient\Request\V4\ServiceRequest;
use AtolOnlineClient\Request\V4\VatReceiptRequest;

trait PaymentReceiptRequestTrait
{
    /**
     * @return PaymentReceiptRequest
     */
    protected function getPaymentReceiptRequest(): PaymentReceiptRequest
    {
        $service = new ServiceRequest();
        $service->setCallbackUrl('test.local');

        $client = new ClientReceiptRequest('test@test.local');

        $company = new CompanyReceiptRequest();
        $company->setEmail('test@test.local');
        $company->setInn('11111111');
        $company->setPaymentAddress('address');

        $item = new ReceiptItemRequest();
        $item->setName('test item');
        $item->setPrice(100.1);
        $item->setQuantity(1.1);
        $item->setSum(100.1);
        $item->setMeasurementUnit('kg');
        $item->setPaymentMethod(ReceiptItemRequest::PAYMENT_METHOD_ADVANCE);
        $item->setPaymentObject(ReceiptItemRequest::PAYMENT_OBJECT_AGENT_COMMISSION);
        $item->setVat(new VatReceiptRequest('vat20', 20.2));
        $item->setNomenclatureCode('00');

        $receipt = new ReceiptRequest();
        $receipt->setTotal(100.1);
        $receipt->setClient($client);
        $receipt->setCompany($company);
        $receipt->setItems([$item]);
        $receipt->setPayments([new ReceiptPaymentRequest(0, 100.1)]);
        $receipt->setVats([new VatReceiptRequest('vat20', 20.2)]);

        /** @var PaymentReceiptRequest $request */
        $request = new PaymentReceiptRequest();
        $request->setExternalId('test');
        $request->setService($service);
        $request->setReceipt($receipt);

        return $request;
    }
}
