<?php

namespace App\Traits;

use App\Models\Bond;
use App\Models\PurchaseOrder;

trait BondTrait
{
    public function bondPaymentDates(Bond $bond)
    {
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

        $emissionDateWithAddDays = _parseDate($bond->emission_date)->addDays($periodDurationWithDay);
        $emiisonDate = _parseDate($bond->emission_date);

        $calcWithOutStrdayAndSnday = collect($emiisonDate->monthsUntil($emissionDateWithAddDays))->filter(function ($date) {
            if (_parseDate($date)->isSaturday()) {
                $date->addDays(2);
            } elseif (_parseDate($date)->isSunday()) {
                $date->addDays(1);
            }

            return $date;
        })->map(function ($date) {
            return ['date' => $date->format('Y-m-d')];
        });

        return $calcWithOutStrdayAndSnday;
    }

    public function interestPaymentsWithAmount(PurchaseOrder $purchaseOrder, $bondPaymentDates)
    {
        $interestPayments = [];
        $interestPaymentsWithAmount = $bondPaymentDates->map(function ($item, $key) use ($purchaseOrder, $bondPaymentDates, $interestPayments) {
            $interestPayments['date'] = $item['date'];
            $itemDate = _parseDate($item['date']);
            if ($key == 0) {
                $orderDate = _parseDate($purchaseOrder->order_date);
                $interestPayments['amount'] = $this->accruedInterest($purchaseOrder, $itemDate->diffInDays($orderDate));
            }
            if ($key != 0 && $key < count($bondPaymentDates) - 1) {
                $bondPaymentDate = _parseDate($bondPaymentDates[$key + 1]['date']);
                $interestPayments['amount'] = $this->accruedInterest($purchaseOrder, $itemDate->diffInDays($bondPaymentDate));
            }

            return $interestPayments;
        })->filter(function ($item) {
            return isset($item['amount']);
        });

        return $interestPaymentsWithAmount;
    }

    public function accruedInterest(PurchaseOrder $purchaseOrder, $numberOfDaysPast)
    {
        return number_format(($purchaseOrder->bond->nominal / 100 * $purchaseOrder->bond->coupon_redemption_frequency) / $purchaseOrder->bond->interest_calculation_period * $numberOfDaysPast * $purchaseOrder->bond_received, 2);
    }
}
