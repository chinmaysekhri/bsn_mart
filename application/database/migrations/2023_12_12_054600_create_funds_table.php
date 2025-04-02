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
        Schema::create('funds', function (Blueprint $table) {
            $table->id();
			$table->bigInteger('buyer_id')->nullable();
			$table->bigInteger('seller_id')->nullable();
			$table->bigInteger('created_by')->nullable();
			$table->string('fund_date',100)->nullable();
			$table->string('fund_amount',100)->nullable();
			$table->string('fund_receipt_no',100)->nullable();
			$table->string('upload_fund_receipt',100)->nullable();
			$table->string('status')->default(0);
			$table->string('fund_status')->default('Pending');
            $table->timestamps();
			$table->softDeletes();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('funds');
    }
};
