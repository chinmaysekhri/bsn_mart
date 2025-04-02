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
			$table->string('company_id',50)->nullable();
			$table->string('for',50)->nullable();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
			$table->string('contact',50)->nullable();
			$table->string('alt_contact',50)->nullable();
			$table->string('address',50)->nullable();
			$table->string('total_invested',50)->nullable();
			$table->string('first_name',50)->nullable();
			$table->string('last_name',50)->nullable();
			$table->string('mobile',50)->nullable();
			$table->string('profile_img',50)->nullable();
			$table->string('gender',50)->nullable();
			$table->string('aadhar_no',50)->nullable();
			$table->string('pan_no',50)->nullable();
			$table->string('gst_no',50)->nullable();
			$table->string('permanent_address',50)->nullable();
			$table->string('bank_name',50)->nullable();
			$table->string('ifsc_code',50)->nullable();
			$table->string('account_no',50)->nullable();
			$table->string('cheque_copy',50)->nullable();
            $table->rememberToken();
			$table->string('password',50)->nullable();
			$table->string('confirm_password',50)->nullable();
		    $table->string('managed_by', 50)->nullable();
			$table->string('created_by', 50)->nullable();
            $table->string('status')->default(0);
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
