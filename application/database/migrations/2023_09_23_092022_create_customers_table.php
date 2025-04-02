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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
			$table->bigInteger('lead_id')->nullable();
			$table->bigInteger('created_by')->nullable();
			$table->bigInteger('managed_by')->nullable();
			$table->string('first_name', 50)->nullable();
			$table->string('last_name', 50)->nullable();
			$table->string('mobile', 50)->nullable();
			$table->string('email',191)->unique()->nullable();
			$table->string('present_address', 50)->nullable();
			$table->string('pin_code', 25)->nullable();
			$table->string('city', 50)->nullable();
			$table->string('state', 50)->nullable();
			$table->string('country', 50)->nullable();
			$table->string('product_type', 50)->nullable();
			$table->string('investment', 50)->nullable();
			$table->string('slot', 50)->nullable();
			$table->string('product_name', 50)->nullable();
			$table->string('product_photo', 50)->nullable();
			$table->string('guaranteed_profit', 50)->nullable();
			$table->string('gst_no', 50)->nullable();
			$table->string('total', 50)->nullable();
			$table->string('discount', 50)->nullable();
			$table->string('final_cost_of_product', 50)->nullable();
			$table->string('feedback', 50)->nullable();
			$table->string('status')->default(0);
			$table->string('follow_up_date', 50)->nullable();
			$table->string('amount_paid', 50)->nullable();
			$table->string('payment_receipt_no', 50)->nullable();
			$table->string('payment_receipt', 50)->nullable();
            $table->timestamps();
			$table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
