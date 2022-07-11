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
    }
}
