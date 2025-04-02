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
        Schema::create('company_comments', function (Blueprint $table) {
            $table->id();
			$table->bigInteger('company_id')->nullable();
			$table->bigInteger('created_by')->nullable();
			$table->text('comment')->nullable();
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
        Schema::dropIfExists('company_comments');
    }
};
