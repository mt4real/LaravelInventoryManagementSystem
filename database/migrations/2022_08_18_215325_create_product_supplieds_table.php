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

        Schema::create('product_supplieds', function (Blueprint $table) {
            $table->id();
            $table->string('company_supplied');
            $table->string('brand');
            $table->foreignId('user_id')->constrained('users');
            $table->string('product_supplied');
            $table->string('phone_supplied');
            $table->decimal('quantity_supplied',15,2);
            $table->decimal('unit_price',15,2);
            $table->decimal('total_amount_supplied',15,2);
            $table->string('supplied_receipt')->unique();
            $table->text('address_supplied');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_supplieds');
    }
};
