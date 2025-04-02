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
        Schema::create('customer_payments', function (Blueprint $table) {
            $table->id();
			
			$table->bigInteger('customer_id')->nullable();
			$table->bigInteger('created_by')->nullable();
			$table->bigInteger('managed_by')->nullable();
			$table->bigInteger('product_id')->nullable();
			$table->string('product_name',100)->nullable();
			$table->text('feedback')->nullable();
			$table->string('follow_up_date',50)->nullable();
			$table->bigInteger('amount_paid')->nullable();
			$table->bigInteger('final_cost_of_product')->nullable();
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
        Schema::dropIfExists('customer_payments');
    }
};
