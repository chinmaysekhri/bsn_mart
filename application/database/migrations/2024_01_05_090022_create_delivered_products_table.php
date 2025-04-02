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
        Schema::create('delivered_products', function (Blueprint $table) {
            $table->id();
			$table->bigInteger('order_id')->nullable();	
			$table->bigInteger('product_id')->nullable();	
			$table->bigInteger('created_by')->nullable();	
			$table->bigInteger('delivered_product_qty')->nullable();	
            $table->timestamps();
            $table->softDeletes();
			
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delivered_products');
    }
};
