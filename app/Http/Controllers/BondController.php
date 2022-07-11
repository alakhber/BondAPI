<?php

namespace App\Http\Controllers;

use App\Http\Resources\PaymentDatesResource;
use App\Models\Bond;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BondController extends Controller
{
    public function payouts($id)
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

    public function purchaseOrderStore(Request $request,$id){
        
    }
}
