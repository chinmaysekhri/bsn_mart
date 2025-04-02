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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
			$table->bigInteger('emp_id')->nullable();
			$table->bigInteger('managed_by')->nullable();
			$table->bigInteger('created_by')->nullable();
			$table->bigInteger('customer_id')->nullable();
			$table->string('customer_name', 50)->nullable();
			$table->string('first_name', 50)->nullable();
			$table->string('last_name', 50)->nullable();
			$table->string('mobile', 50)->nullable();
			$table->string('email', 50)->nullable();
			$table->string('present_address', 50)->nullable();
			$table->string('pin_code', 50)->nullable();
			$table->string('country', 50)->nullable();
			$table->string('state', 50)->nullable();
			$table->string('city', 50)->nullable();
			$table->string('product_type', 50)->nullable();
			$table->string('split_into', 50)->nullable();
			$table->string('slot', 50)->nullable();
			$table->string('machine_name', 50)->nullable();
			$table->string('machine_cost', 50)->nullable();
			$table->string('payment_received', 50)->nullable();
			$table->string('payment_mode', 50)->nullable();
			$table->string('payment_date', 50)->nullable();
			$table->string('reference_number', 50)->nullable();
			$table->string('payment_reciept', 50)->nullable();
			$table->string('comment', 50)->nullable();
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
        Schema::dropIfExists('orders');
    }
};
