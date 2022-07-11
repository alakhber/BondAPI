<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bonds', function (Blueprint $table) {
            Schema::create('bonds', function (Blueprint $table) {
                $table->id();
                $table->date('emission_date');
                $table->date('turnover_end_date');
                $table->unsignedBigInteger('nominal');
                $table->enum('coupon_redemption_frequency', [1, 2, 4, 12]);
                $table->enum('interest_calculation_period', [360, 364, 365]);
                $table->unsignedtinyinteger('coupon_interest');
                $table->timestamps();
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bonds');
    }
};
