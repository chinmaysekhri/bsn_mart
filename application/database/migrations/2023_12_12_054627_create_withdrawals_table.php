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
        Schema::create('withdrawals', function (Blueprint $table) {
            $table->id();
			$table->bigInteger('buyer_id')->nullable();
			$table->bigInteger('seller_id')->nullable();
			$table->bigInteger('created_by')->nullable();
			$table->string('withdrawal_date',100)->nullable();
			$table->string('withdrawal_amount',100)->nullable();
			$table->string('withdrawal_payment_type',100)->nullable();
			$table->string('acount_holder_name',100)->nullable();
			$table->string('bank_name',100)->nullable();
			$table->string('bank_account_no',100)->nullable();
			$table->string('bank_ifsc_code',100)->nullable();
			$table->string('status')->default(0);
			$table->string('withdrawal_status')->default('Pending');
            $table->timestamps();
			$table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('withdrawals');
    }
};
