<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InterestPaymentsResource extends JsonResource
{
    public function __construct($resource)
    {
        self::$wrap = 'payouts';
        
        $this->resource = $resource;
    }

    public function toArray($request)
    {
        return [
            'date' => $this['date'],
            'amount' => $this['amount'],
        ];
    }
}
