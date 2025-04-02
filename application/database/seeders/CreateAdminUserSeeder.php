<?php
  
namespace Database\Seeders;
  
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
  
class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
	   $user = User::where(['email' => 'admin@gmail.com',])->first();
		
		if($user == null){	
		
			$user = User::create([
            'name' => 'Rajesh Kumar', 
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123456')
        ]);
        
		}
		
         $role = Role::where(['name' => 'Admin'])->first();

		if($role == null){
			$role = Role::create(['name' => 'Admin']);
		}
                
        $permissions = Permission::pluck('id','id')->all();
       
        $role->syncPermissions($permissions);
        
        DB::table('model_has_roles')->where('model_id',$user->id)->delete();
				
        $user->assignRole([$role->id]);
    }
}