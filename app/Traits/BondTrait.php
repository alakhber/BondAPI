<?php

namespace App\Traits;

use App\Models\Bond;
use App\Models\PurchaseOrder;

trait BondTrait
{
    public function bondPaymentDates(Bond $bond)
    {
    }

    public function interestPaymentsWithAmount(PurchaseOrder $purchaseOrder, $bondPaymentDates)
    {
    }

    public function accruedInterest(PurchaseOrder $purchaseOrder, $numberOfDaysPast)
    {
        return number_format(($purchaseOrder->bond->nominal / 100 * $purchaseOrder->bond->coupon_redemption_frequency) / $purchaseOrder->bond->interest_calculation_period * $numberOfDaysPast * $purchaseOrder->bond_received, 2);
    }
}
