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
        Schema::create('sellerapplications', function (Blueprint $table) {
             $table->id();
            $table->bigInteger('managed_by')->nullable();
            $table->bigInteger('created_by')->nullable();   
            $table->string('first_name',100)->nullable();    
            $table->string('last_name',100)->nullable();
            $table->string('mobile',100)->nullable();
            $table->string('email',50)->nullable();
            $table->string('gender',50)->nullable();
            $table->string('present_address',100)->nullable();
            $table->string('pin_code',50)->nullable();
            $table->string('country',50)->nullable();
            $table->string('state',50)->nullable();
            $table->string('city',50)->nullable();
            $table->string('district',50)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sellerapplications');
    }
};
