<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name');
            $table->integer('user_id');
            $table->string('customer_email');
            $table->string('customer_phone_number');
            $table->integer('customer_country_id');
            $table->integer('customer_city_id');
            $table->string('customer_address');
            $table->string('customer_postcode');
            $table->longText('customer_message');
            $table->float('subtotal');
            $table->integer('discount');
            $table->float('total');
            $table->integer('payment_option')->comment('1=credit card, 2=COD');
            $table->integer('payment_status')->comment('1=done, 2=panding');
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
        Schema::dropIfExists('orders');
    }
}
