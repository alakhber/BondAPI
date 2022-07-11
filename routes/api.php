<?php

use App\Http\Controllers\BondController;
use Illuminate\Support\Facades\Route;

Route::prefix('bond')->controller(BondController::class)->group(function () {
    Route::get('{id}/payouts', 'payouts');
    Route::post('{id}/order', 'purchaseOrderStore');
    Route::post('order/{id}', 'bondInterestPayments');
});