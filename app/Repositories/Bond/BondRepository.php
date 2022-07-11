<?php

namespace App\Repositories\Bond;

use App\Http\Requests\PurchaseOrderStoreRequest;
use App\Http\Resources\InterestPaymentsResource;
use App\Http\Resources\PaymentDatesResource;
use App\Models\Bond;
use App\Models\PurchaseOrder;
use App\Traits\BondTrait;

class BondRepository implements BondInterface
{
    use BondTrait;
    public function payouts(int $id)
    {
        $bond = Bond::findOrFail($id);
        $bondPaymentDates = $this->bondPaymentDates($bond);

        return PaymentDatesResource::collection($bondPaymentDates);
    }

    public function purchaseOrderStore(PurchaseOrderStoreRequest $request, int $id)
    {
        PurchaseOrder::create($request->validated());
        
        return response()->json([
            'message' => 'Order Created',
            'status' => 201,
        ]);
    }

    public function bondInterestPayments(int $id)
    {
        $purchaseOrder = PurchaseOrder::with('bond')->findOrFail($id);

        $bondPaymentDates = $this->bondPaymentDates($purchaseOrder->bond);
        $interestPaymentsWithAmount = $this->interestPaymentsWithAmount($purchaseOrder, $bondPaymentDates);

        return InterestPaymentsResource::collection($interestPaymentsWithAmount);
    }
}
