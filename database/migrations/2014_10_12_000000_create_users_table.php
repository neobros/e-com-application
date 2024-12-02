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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('fname');
            $table->string('lname')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->integer('role')->comment('0 Customer, 1 Super Admin, 2 Admin');
            $table->integer('contact')->nullable();
            $table->integer('status')->default(1)->comment('0 Deactivate, 1 Active');
            $table->string('address')->nullable();
            $table->integer('user_permissions')->default(1)->nullable()->comment('0 Deactivate, 1 Active');
            $table->integer('product_permissions')->default(1)->nullable()->comment('0 Deactivate, 1 Active');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
