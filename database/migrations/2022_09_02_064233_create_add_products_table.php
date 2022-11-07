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
        Schema::create('add_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('category_id')->constrained('categories');
            $table->string('product_name')->unique();
            $table->decimal('product_defect',15,2)->nullable();
            $table->decimal('product_quantity',15,2);
            $table->decimal('sale_price',15,2);
            $table->decimal('total_amount',15,2);
            $table->enum('product_status',['ACTIVE','INACTIVE'])->default('ACTIVE');
            $table->string('product_sessionId');
            $table->softDeletes();
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
        Schema::dropIfExists('add_products');
    }
};
