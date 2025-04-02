<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles ,SoftDeletes;
	
	 /**
     * The attributes that are mass assignable.
     *	
     * @var array
     */
  
     protected $fillable = [
        'created_by',
        'seller_id',
        'cat_id',
        'category_id',
        'subcat_id',
        'created_date',
        'brand_name',
        'other_brand',
        'non_brand',
        'third_party_manufacturer',
        'dont_show_brand',
        'product_type',
        'used_in',
        'product_name',
        'product_slug',
        'launch_date',
        'category_name',
        'subcategory_name',
        'model_number',
        'master_packing',
        'carton_packing',
        'product_image',
        'product_photo',
        'product_video',
        'seller_price',
        'price',
        'plateform_fee_status',
        'packaging_charges',
        'dont_show_price',
        'discount',
        'available_for_oem',
        'oem_description',
        'minimum_order_quantity',
        'stock_available',
        'black_listed_district',
        'product_tag',
        'product_description',
        'user_product_status',
        'product_status',
        'product_size',
        'product_guarantee_type',
        'warranty_period',
        'no_warranty',
        'product_warranty_type',
        'only_spare_parts',
        'status',
    ];
}
