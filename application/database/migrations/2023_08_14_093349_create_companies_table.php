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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
		    $table->string('date_of_incorporation',50)->nullable();
			$table->string('company_name',50)->nullable();
			$table->string('mobile',50)->nullable();
			$table->string('company_email', 50)->nullable();
			$table->string('coi', 50)->nullable();
			$table->string('mca_llp', 50)->nullable();
			$table->string('pan_card', 50)->nullable();
			$table->string('gst_certificate', 50)->nullable();
			$table->string('rent_agrement',191)->unique()->nullable();
			$table->string('moa', 50)->nullable();
			$table->string('msme_certificate', 50)->nullable();
			$table->string('aoa', 50)->nullable();
			$table->string('tan_no', 50)->nullable();
			$table->string('pf_no', 50)->nullable();
			$table->string('esi_no', 50)->nullable();
			$table->string('ngo_darpan', 50)->nullable();
			$table->string('iso_certificate', 50)->nullable();
			$table->string('dipp', 50)->nullable();
			$table->string('bank_name', 50)->nullable();
			$table->string('ifsc_code', 50)->nullable();
			$table->string('account_no', 50)->nullable();
			$table->string('cheque_copy', 50)->nullable();
			$table->string('account_login_url', 50)->nullable();
			$table->string('user_id', 50)->nullable();
			$table->string('company_password', 50)->nullable();
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
        Schema::dropIfExists('companies');
    }
};
