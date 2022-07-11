<?php
namespace App\Repositories\Bond;

use App\Http\Requests\PurchaseOrderStoreRequest;
use App\Http\Resources\InterestPaymentsResource;
use App\Http\Resources\PaymentDatesResource;
use App\Models\Bond;
use App\Models\PurchaseOrder;
use Carbon\Carbon;

class BondRepository implements BondInterface
{
    public function payouts(int $id)
    {
        $bond = Bond::findOrFail($id);
        switch ($bond->interest_calculation_period) {
            case 360:
                $periodDurationWithDay = 12 / $bond->coupon_redemption_frequency * 30;
                break;
            case 364:
                $periodDurationWithDay = 364 / $bond->coupon_redemption_frequency;
                break;
            case 365:
                $periodDurationWithDay = 12 / $bond->coupon_redemption_frequency;
                break;
        }

        $emissionDateWithAddDays = Carbon::parse($bond->emission_date)->addDays($periodDurationWithDay);
        $emiisonDate = Carbon::parse($bond->emission_date);

        $calcWithOutStrdayAndSnday = collect($emiisonDate->monthsUntil($emissionDateWithAddDays))->filter(function ($date) {
            if (Carbon::parse($date)->isSaturday()) {
                $date->addDays(2);
            } elseif (Carbon::parse($date)->isSunday()) {
                $date->addDays(1);
            }

            return $date;
        })->map(function ($date) {
            return ['date' => $date->format('Y-m-d')];
        });

        return PaymentDatesResource::collection($calcWithOutStrdayAndSnday);
    }

    public function purchaseOrderStore(PurchaseOrderStoreRequest $request, int $id)
    {
       PurchaseOrder::create($request->validated());
        return response()->json([
            'message'=>'Order Created',
            'status'=>201,
        ]); 
    }

    public function bondInterestPayments(int $id)
    {
        $purchaseOrder = PurchaseOrder::with('bond')->findOrFail($id);
        switch ($purchaseOrder->bond->interest_calculation_period) {
            case 360:
                $periodDurationWithDay = 12 / $purchaseOrder->bond->coupon_redemption_frequency * 30;
                break;
            case 364:
                $periodDurationWithDay = 364 / $purchaseOrder->bond->coupon_redemption_frequency;
                break;
            case 365:
                $periodDurationWithDay = 12 / $purchaseOrder->bond->coupon_redemption_frequency;
                break;
        }

        $emissionDateWithAddDays = Carbon::parse($purchaseOrder->bond->emission_date)->addDays($periodDurationWithDay);
        $emiisonDate = Carbon::parse($purchaseOrder->bond->emission_date);

        $bondPaymentDates = collect($emiisonDate->monthsUntil($emissionDateWithAddDays))->filter(function ($date) {
            if (Carbon::parse($date)->isSaturday()) {
                $date->addDays(2);
            } elseif (Carbon::parse($date)->isSunday()) {
                $date->addDays(1);
            }

            return $date;
        })->map(function ($date) {
            return ['date' => $date->format('Y-m-d')];
        });

        $interestPayments = [];
        $interestPaymentsWithAmount = $bondPaymentDates->map(function ($item, $key) use ($purchaseOrder, $bondPaymentDates, $interestPayments) {
            $interestPayments['date'] = $item['date'];
            $itemDate = Carbon::parse($item['date']);
            if ($key == 0) {
                $orderDate = Carbon::parse($purchaseOrder->order_date);
                $interestPayments['amount'] = number_format(($purchaseOrder->bond->nominal / 100 * $purchaseOrder->bond->coupon_redemption_frequency) / $purchaseOrder->bond->interest_calculation_period * $itemDate->diffInDays($orderDate) * $purchaseOrder->bond_received, 2);
            }
            if ($key != 0 && $key < count($bondPaymentDates) - 1) {
                $bondPaymentDate = Carbon::parse($bondPaymentDates[$key + 1]['date']);
                $interestPayments['amount'] = number_format(($purchaseOrder->bond->nominal / 100 * $purchaseOrder->bond->coupon_redemption_frequency) / $purchaseOrder->bond->interest_calculation_period * $itemDate->diffInDays($bondPaymentDate) * $purchaseOrder->bond_received, 2);
            }
            
            return $interestPayments;
        })->filter(function ($item) {
            return isset($item['amount']);
        });

        return InterestPaymentsResource::collection($interestPaymentsWithAmount);
    }
}