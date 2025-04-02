<?php
  
namespace App\Imports;
  
use App\Models\Lead;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Hash;
use Auth; 

class LeadsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
		//dd($row);
		$auth_user = Auth::user();
		
		$email_data = Lead::where('email','=',$row['email'])->first();
		$mobile_data = Lead::where('mobile','=',$row['mobile'])->first();
       
	   if($email_data == null && $mobile_data ==null){
		   
			  return new Lead([
				'created_by'  => $auth_user->id,
				'first_name'  => $row['first_name'],
				'last_name'   => $row['last_name'],
				'email'       => $row['email'], 
				'mobile'      => $row['mobile'], 
				'pin_code'    => $row['pin_code'], 
			   // 'country'     => $row['country'], 
				//'state'       => $row['state'], 
				//'city'        => $row['city'], 
				//'password' => Hash::make($row['password']),
			]);
		
	   }		
		
    }
}