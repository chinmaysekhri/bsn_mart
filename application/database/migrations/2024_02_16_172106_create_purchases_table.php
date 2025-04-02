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
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
			$table->bigInteger('seller_id')->nullable();
			$table->bigInteger('created_by')->nullable();
			$table->bigInteger('product_id')->nullable();
			$table->string('warehouse_name', 100)->nullable();	
			$table->text('product_name')->nullable();
			$table->string('product_quantity', 50)->nullable();	
			$table->string('product_price', 100)->nullable();	
			$table->string('single_product_total', 100)->nullable();	
			$table->string('sub_total', 100)->nullable();	
			$table->string('service_fees', 100)->nullable();	
			$table->string('total', 100)->nullable();	
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
        Schema::dropIfExists('purchases');
    }
};
