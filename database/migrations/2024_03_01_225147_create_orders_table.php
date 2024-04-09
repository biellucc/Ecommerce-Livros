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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('type_payment', '20');
            $table->decimal('value',10,2);
            $table->foreignId('customer_id')->constrained('customers');
            $table->foreignId('wallet_id')->constrained('wallets');
            $table->foreignId('transporter_id')->constrained('transporters');
            $table->foreignId('cart_id')->constrained('carts');
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
};
