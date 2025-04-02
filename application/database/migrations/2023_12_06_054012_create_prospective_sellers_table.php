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
        Schema::create('prospective_sellers', function (Blueprint $table) {
            $table->id();
            $table->string('date_of_enrollment',50)->nullable();
            $table->string('category_id',100)->nullable();
            $table->string('brand_name',50)->nullable();
            $table->string('business_name',50)->nullable();
            $table->string('email',50)->nullable();
            $table->string('contact',25)->nullable();
            $table->string('present_address',50)->nullable();
            $table->string('first_name',50)->nullable();
            $table->string('last_name',50)->nullable();
            $table->string('gender',50)->nullable();
            $table->string('pin_code',50)->nullable();
            $table->string('country',50)->nullable();
            $table->string('state',50)->nullable();
            $table->string('city',50)->nullable();
            $table->string('comment',50)->nullable();
            $table->string('status_name',50)->nullable();
            $table->timestamps();
            $table->softDeletes();
			
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prospective_sellers');
    }
};
