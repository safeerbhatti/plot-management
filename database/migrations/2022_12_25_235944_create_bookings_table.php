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
            $table->integer('userId');
            $table->integer('plotId');
            $table->decimal('price_square_feet');
            $table->decimal('total_amount');
            $table->decimal('down_payment');
            $table->decimal('development_charges');
            $table->decimal('instalment_per_month');
            $table->string('khata_number');
            $table->string('agreement_number');
            $table->string('number_of_dev_charges');
            $table->string('paid_number_of_dev_charges');
            $table->integer('instalment_duration');
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
