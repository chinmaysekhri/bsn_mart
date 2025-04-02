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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('task_assign_to', 50)->nullable();
			$table->string('task_assign_by', 50)->nullable();
			$table->string('task_title', 50)->nullable();
			$table->text('task_detail')->nullable();
			$table->string('task_close_date',100)->nullable();
			$table->text('task_comment')->nullable();
			$table->string('managed_by', 50)->nullable();
			$table->string('created_by', 50)->nullable();
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
        Schema::dropIfExists('tasks');
    }
};
