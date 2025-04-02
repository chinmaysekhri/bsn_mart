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
        Schema::create('live_machines', function (Blueprint $table) {
            $table->id();
			$table->bigInteger('emp_id')->nullable();
			$table->bigInteger('managed_by')->nullable();
			$table->bigInteger('created_by')->nullable();
			$table->string('date', 50)->nullable();
			$table->string('machine_id', 50)->nullable();
			$table->string('product_name', 50)->nullable();
			$table->string('machine_name', 50)->nullable();
			$table->string('machine_cost', 50)->nullable();
			$table->string('guaranteed_income', 50)->nullable();
			$table->string('machine_type', 50)->nullable();
			$table->string('pin_code', 50)->nullable();
			$table->string('country', 50)->nullable();
			$table->string('state', 50)->nullable();
			$table->string('city', 50)->nullable();
			$table->string('customer_name', 50)->nullable();
			$table->string('product_type', 50)->nullable();
			$table->string('first_name', 50)->nullable();
			$table->string('last_name', 50)->nullable();
			$table->string('present_address', 50)->nullable();
			$table->string('split_into', 50)->nullable();
			$table->string('available_slots', 50)->nullable();
			$table->string('total_slots', 50)->nullable();
			$table->string('today_earning', 50)->nullable();
			$table->string('total_earning', 50)->nullable();
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
        Schema::dropIfExists('live_machines');
    }
};
