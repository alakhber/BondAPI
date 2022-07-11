<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bond extends Model
{
    use HasFactory;
    
    protected $fillable  = [
        'emission_date',
        'turnover_end_date',
        'nominal',
        'coupon_redemption_frequency',
        'interest_calculation_period',
        'coupon_interest'
    ];
}
