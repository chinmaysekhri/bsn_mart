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
        Schema::create('ledgers', function (Blueprint $table) {
            $table->id();
			$table->bigInteger('created_by')->nullable();
			$table->bigInteger('product_id')->nullable();
			$table->bigInteger('buyer_seller_id')->nullable();
			$table->bigInteger('ledger_order_id')->nullable();
			$table->string('ledger_type', 100)->nullable();	
			$table->string('ledger_for', 50)->nullable();	
			$table->string('ledger_date', 100)->nullable();	
			$table->string('ledger_amount', 100)->nullable();		
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
        Schema::dropIfExists('ledgers');
    }
};
