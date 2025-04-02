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
        Schema::create('purchasereturns', function (Blueprint $table) {
            $table->id();
			$table->text('seller_id')->nullable();
			$table->bigInteger('created_by')->nullable();
			$table->text('product_id')->nullable();
			$table->string('purchase_date', 50)->nullable();	
			$table->string('warehouse_name', 100)->nullable();	
			$table->text('product_name')->nullable();
			$table->string('product_quantity', 100)->nullable();	
			$table->string('product_price', 100)->nullable();	
			$table->text('purchase_subtotal')->nullable();	
			$table->text('purchase_service_fee')->nullable();	
			$table->text('purchase_final_total')->nullable();	
			$table->text('total_product_price')->nullable();	
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
        Schema::dropIfExists('purchasereturns');
    }
};
