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
        Schema::create('withdrawal_comments', function (Blueprint $table) {
            $table->id();
			
			$table->bigInteger('withdrawal_id')->nullable();
			$table->bigInteger('created_by')->nullable();
			$table->string('withdrawal_request_date',50)->nullable();
			$table->string('withdrawal_amount',191)->nullable();
			$table->string('withdrawal_receipt_no',100)->nullable();
			$table->string('upload_withdrawal_receipt',100)->nullable();
			$table->text('withdrawal_comment')->nullable();
			$table->string('withdrawal_status',50)->nullable();
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
        Schema::dropIfExists('withdrawal_comments');
    }
};
