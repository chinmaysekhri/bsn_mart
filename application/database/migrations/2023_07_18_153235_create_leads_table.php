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
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
			$table->string('first_name',50)->nullable();
			$table->string('last_name', 50)->nullable();
			$table->string('email',191)->unique()->nullable();
			$table->string('mobile', 50)->nullable();
			$table->string('pin_code', 50)->nullable();
			$table->string('country', 50)->nullable();
			$table->string('state', 50)->nullable();
			$table->string('city', 50)->nullable();
            $table->string('status')->default(0);			
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
