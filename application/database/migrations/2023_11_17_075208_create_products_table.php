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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
			$table->bigInteger('created_by')->nullable();
			$table->bigInteger('seller_id')->nullable();
			$table->bigInteger('cat_id')->nullable();
			$table->bigInteger('subcat_id')->nullable();
			$table->string('product_id',100)->nullable();
			$table->string('created_date',25)->nullable();
			$table->string('brand_name',50)->nullable();
			$table->string('dont_show_brand',50)->nullable();
			$table->string('product_name',50)->nullable();
			$table->string('launch_date',25)->nullable();
			$table->string('category_name',100)->nullable();
			$table->string('subcategory_name',100)->nullable();
			$table->string('model_number',100)->nullable();
			$table->string('master_packing',100)->nullable();
			$table->string('product_image',100)->nullable();
			$table->string('product_video',100)->nullable();
			$table->string('price',100)->nullable();
			$table->string('discount',100)->nullable();
			$table->string('minimum_order_quantity',100)->nullable();
			$table->string('stock_available',100)->nullable();
			$table->string('black_listed_district',100)->nullable();
			$table->text('product_tag')->nullable();
			$table->longText('product_description');
			$table->string('product_status',100)->nullable();
			$table->string('product_size',100)->nullable();
			$table->string('product_guarantee_type',100)->nullable();
			$table->string('warranty_period',100)->nullable();
			$table->string('no_warranty',100)->nullable();
			$table->string('product_warranty_type',100)->nullable();
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
        Schema::dropIfExists('products');
    }
};
