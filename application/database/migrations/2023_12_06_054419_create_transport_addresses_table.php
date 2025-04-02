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
        Schema::create('transport_addresses', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('created_by')->nullable();	
            $table->bigInteger('buyer_id')->nullable();	
            $table->string('private_marka',100)->nullable();
            $table->string('transport_name',100)->nullable();
            $table->string('transport_contact_number',25)->nullable();
            $table->string('transport_address',100)->nullable();
            $table->string('delivery_place',100)->nullable();
            $table->string('lr_copy_upload',100)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transport_addresses');
    }
};
