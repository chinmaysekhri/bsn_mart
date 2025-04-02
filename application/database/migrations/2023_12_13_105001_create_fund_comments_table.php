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
        Schema::create('fund_comments', function (Blueprint $table) {
            $table->id();
			$table->bigInteger('fund_id')->nullable();
			$table->bigInteger('created_by')->nullable();
			$table->text('comment')->nullable();
			$table->string('fund_status',50)->nullable();
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
        Schema::dropIfExists('fund_comments');
    }
};
