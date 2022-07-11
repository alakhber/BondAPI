<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PaymentDatesResource extends JsonResource
{
    public function __construct($resource)
    {
        self::$wrap = 'dates';
        
        $this->resource = $resource;
    }

    public function toArray($request)
    {
        return [
            'date' => $this['date'],
        ];
    }
}
