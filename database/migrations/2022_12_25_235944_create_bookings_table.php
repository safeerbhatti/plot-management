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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->decimal('price_square_feet');
            $table->decimal('total_amount');
            $table->decimal('down_payment');
            $table->decimal('development_charges');
            $table->decimal('instalment_per_month');
            $table->string('khata_number');
            $table->string('agreement_number');
            $table->decimal('remaining_amount');
            $table->integer('instalment_duration');
            $table->integer('remaining_duration');
            $table->integer('bi-yearly-fee');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookings');
    }
};
