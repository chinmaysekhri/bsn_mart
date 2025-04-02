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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
			$table->bigInteger('order_id')->nullable();	
            $table->bigInteger('buyer_id')->nullable();	
            $table->bigInteger('seller_id')->nullable();	
            $table->bigInteger('created_by')->nullable();	
            $table->string('product_name',100)->nullable();
            $table->bigInteger('order_quantity')->nullable();
            $table->bigInteger('order_price')->nullable();
            $table->string('first_name',50)->nullable();
            $table->string('last_name',50)->nullable();
            $table->string('mobile',25)->nullable();
            $table->string('email',25)->nullable();
            $table->string('present_address',191)->nullable();
            $table->string('private_marka',50)->nullable();
            $table->string('transport_name',50)->nullable();
            $table->string('transport_address',191)->nullable();
            $table->string('transport_contact_number',50)->nullable();
            $table->string('delivery_place',50)->nullable();
            $table->string('lr_copy_upload',50)->nullable();
            $table->string('status')->default(0);
            $table->string('order_status',50)->nullable();
            $table->timestamps();
            $table->softDeletes();
			
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
