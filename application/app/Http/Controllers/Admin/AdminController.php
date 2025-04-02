<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use DB;
use Auth;
use Session;

class AdminController extends Controller
{
    public function login()
    {
        return view('admin.login');
         
     }
    
    public function dashboard()
     {
          
        return view('admin.dashboard');
        
     }
	public function addRole()
     {
          
        return view('admin.role.add_role');
        
     }
	 
	 public function listRole()
     {
          
        return view('admin.role.list_role');
        
     }
	 
	public function viewRole()
     {
          
        return view('admin.role.view_role');
        
     }
	 
	 public function editRole()
     {
          
        return view('admin.role.edit_role');
        
     }
	 
	public function addUser()
     {
          
        return view('admin.users.add_user');
        
     }
	 
	 public function listUser()
     {
          
        return view('admin.users.list_user');
        
     }
	 public function editUser()
     {
          
        return view('admin.users.edit_user');
        
     }
	 public function viewUser()
     {
          
        return view('admin.users.view_user');
        
     }

	public function addLead()
     {
          
        return view('admin.lead.add_lead');
        
     }
	public function viewLead()
     {
          
        return view('admin.lead.view_lead');
        
     }
	 
	public function listLead()
     {
        $totalLeads = DB::table('leads')->get();
        return view('admin.lead.list_lead', compact('totalLeads'));
        
     }
	 
	public function editLead()
     {
          
        return view('admin.lead.edit_lead');
        
     }
	 
	public function profile()
     {
          
        return view('admin.profile.profile');
        
     }
	 
	 //contact form
	 
	 
	  public function getState(Request $request)
    {
		
        $state_data = DB::table('states')
			                         ->whereIn('country_id',$request->country_id)
									 ->orderBy('name','ASC')
			                         ->pluck('id','name')->toArray();
									    
        
         return response()->json(['states' => $state_data]);
    }
	
	/**
     * Find the application City.
     *
     * @return json response
     */
    public function getCity(Request $request)
    {
		
        $city_data = DB::table('cities')
			                         ->whereIn('state_id',$request->state_id)
									 ->orderBy('name','ASC')
			                         ->pluck('id','name')->toArray();
									    
        
         return response()->json(['city' => $city_data]);
    }
	

	
	public function contact(Request $request){
		
		$countries = DB::table('countries')->get();

		return view('admin.contact',compact('countries'));
	}
	
	 public function storeContact(Request $request)
    {
        $this->validate($request, [
            'firstname' => 'required',
           // 'email' => 'required|email|unique:users,email',
           // 'password' => 'required|same:confirm-password',
           // 'roles' => 'required'
        ]);
    

        $input = $request->all();
        unset($input['_token']);
        $leave = DB::table('leads')->insert($input);

    
        return back()->with('success','Data created successfully');
    }
	
     public function getStateCity(Request $request)
    {
		
        $state_city_data = DB::table('bsneltd_pincode')
			                         ->where('pincode',$request->pincode)
									 ->orderBy('post_office','ASC')
			                         ->get()->toArray();
									    
        
         return response()->json(['state_city_data' => $state_city_data]);
    }
	 
}
