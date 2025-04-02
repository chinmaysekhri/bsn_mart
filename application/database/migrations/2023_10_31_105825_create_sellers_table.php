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
        Schema::create('sellers', function (Blueprint $table) {
            $table->id();
            $table->string('for',50)->nullable();
            $table->string('email')->unique();
            $table->string('date_of_enrollment')->nullable();
            $table->string('category_id',50)->nullable();
            $table->string('business_name')->nullable();
            $table->string('brand_name',50)->nullable();
            $table->string('brand_registration_upload',50)->nullable();
            $table->string('pin_code')->nullable();
            $table->string('country')->nullable();
            $table->string('state',50)->nullable();
            $table->string('city',50)->nullable();
            $table->string('email_verified_at')->nullable();
            $table->string('contact',50)->nullable();
            $table->string('present_address',50)->nullable();
            $table->string('first_name',50)->nullable();
            $table->string('last_name',50)->nullable();
            $table->string('mobile',50)->nullable();
            $table->string('profile_img',50)->nullable();
            $table->string('gender',50)->nullable();
            $table->string('aadhar_no',50)->nullable();
            $table->string('upload_aadhar_no',50)->nullable();
            $table->string('pan_no',50)->nullable();
            $table->string('upload_pan_no',50)->nullable();
            $table->string('gst_no',50)->nullable();
            $table->string('upload_gst_no',50)->nullable();
            $table->string('bank_name',50)->nullable();
            $table->string('ifsc_code',50)->nullable();
            $table->string('account_no',50)->nullable();
            $table->string('cheque_copy',50)->nullable();
            $table->string('contract_img',50)->nullable();
            $table->rememberToken();
            $table->string('password',50)->nullable();
            $table->string('confirm_password',50)->nullable();
            $table->string('managed_by', 50)->nullable();
            $table->string('created_by', 50)->nullable();
            $table->string('status')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sellers');
    }
};
