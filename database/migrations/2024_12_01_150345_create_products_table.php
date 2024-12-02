<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('product_id');
            $table->string('item_name');
            $table->string('storage');
            $table->string('image');
            $table->integer('cost_price');
            $table->integer('sell_price');
            $table->integer('quantity');
            $table->longText('description');
            $table->integer('status')->default(1)->comment('0 Deactivate, 1 Active');
            $table->integer('brand_id');
            $table->integer('admin_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
