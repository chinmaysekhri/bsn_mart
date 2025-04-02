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
        Schema::create('wallets', function (Blueprint $table) {
            $table->id();
		    $table->bigInteger('seller_id')->nullable();
			$table->bigInteger('buyer_id')->nullable();
			$table->bigInteger('credit_amount')->nullable();
			$table->bigInteger('debit_amount')->nullable();
			$table->bigInteger('total_wallet_amount')->nullable();
			$table->string('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wallets');
    }
};
