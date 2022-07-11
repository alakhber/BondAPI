<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    use HasFactory;
    protected $fillable = [
        'bond_id',
        'order_date',
        'bond_received'
    ];

    public function bond()
    {
        return $this->hasOne(Bond::class, 'id');
    }
}
