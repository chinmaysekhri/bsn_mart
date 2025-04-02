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
        Schema::create('assign_lead_to_employees', function (Blueprint $table) {
            $table->id();
			$table->bigInteger('lead_id')->nullable();
			$table->bigInteger('emp_id')->nullable();
			$table->bigInteger('customer_id')->nullable();
			$table->bigInteger('created_by')->nullable();
			$table->bigInteger('managed_by')->nullable();
			$table->string('lead_title', 100)->nullable();
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
        Schema::dropIfExists('assign_lead_to_employees');
    }
};
