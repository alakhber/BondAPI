<?php
namespace App\Repositories\Bond;

use App\Http\Requests\PurchaseOrderStoreRequest;

interface BondInterface{
    public function payouts(int $id);
    public function purchaseOrderStore(PurchaseOrderStoreRequest $request,int $id);
    public function bondInterestPayments(int $id);
}