<?php
  
namespace Database\Seeders;
  
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
  
class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
           'role-list',
           'role-create',
           'role-edit',
           'role-delete',
        'product-list',
           'product-create',
           'product-edit',
           'product-delete',
		   'user-list',
           'user-create',
           'user-edit',
           'user-delete',
	       'employee-list',
           'employee-create',
           'employee-edit',
           'employee-delete',
		   'task-list',
           'task-create',
           'task-edit',
           'task-delete',
		   'buyer-list',
           'buyer-create',
           'buyer-edit',
           'buyer-delete',
		   'seller-list',
           'seller-create',
           'seller-edit',
           'seller-delete',
		   'category-list',
           'category-create',
           'category-edit',
           'category-delete',
		   'subcategory-list',
           'subcategory-create',
           'subcategory-edit',
           'subcategory-delete',	  
		   'prospective-seller-list',
           'prospective-seller-create',
           'prospective-seller-edit',
           'prospective-seller-delete',
		   'prospective-buyer-list',
           'prospective-buyer-create',
           'prospective-buyer-edit',
           'prospective-buyer-delete',
		   'buyer-order-list',
           'buyer-order-create',
           'buyer-order-edit',
           'buyer-order-delete',
		   'seller-order-list',
           'seller-order-create',
           'seller-order-edit',
           'seller-order-delete',
      'designation-list',
           'designation-create',
           'designation-edit',
           'designation-delete',
        'order-list',
           'order-create',
           'order-edit',
           'order-delete',
        'transportaddresse-list',
           'transportaddresse-create',
           'transportaddresse-edit',
           'transportaddresse-delete',
        'sellertransportaddresse-list',
           'sellertransportaddresse-create',
           'sellertransportaddresse-edit',
           'sellertransportaddresse-delete',
        'fund-list',
           'fund-create',
           'fund-edit',
           'fund-delete',
        'withdraw-list',
           'withdraw-create',
           'withdraw-edit',
           'withdraw-delete',
        'wallet-list',
           'wallet-create',
           'wallet-edit',
           'wallet-delete',
		'sellerapplication-list',
           'sellerapplication-create',
           'sellerapplication-edit',
           'sellerapplication-delete',
        'buyerapplication-list',
           'buyerapplication-create',
           'buyerapplication-edit',
           'buyerapplication-delete',   
	   'purchases-list',
           'purchases-create',
           'purchases-edit',
           'purchases-delete',
	   'purchasereturn-list',
           'purchasereturn-create',
           'purchasereturn-edit',
           'purchasereturn-delete'
        ];
        
        foreach ($permissions as $permission) {
			
			$PermissionData = Permission::where(['name' => $permission])->first(); 
			
			if($PermissionData == null){
				 Permission::create(['name' => $permission]);
			}
            
        }
    }
}