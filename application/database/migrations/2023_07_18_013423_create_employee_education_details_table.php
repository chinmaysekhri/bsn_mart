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
        Schema::create('employee_education_details', function (Blueprint $table) {
            $table->id();			
			$table->bigInteger('emp_id')->nullable();
			$table->string('qualification', 191)->nullable();
			$table->string('passing_year', 10)->nullable();
			$table->string('mark_percentage', 10)->nullable();
			$table->string('board_name', 191)->nullable();
			$table->string('attached_document', 70)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_education_details');
    }
};
