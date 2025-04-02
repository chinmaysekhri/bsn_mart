<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Eloquent\Builder;
use Auth;
use DB;
use Hash;
use App\Models\Employee;
use Illuminate\Support\Arr;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Maatwebsite\Excel\Facades\Excel;
use Mail;
use App\Mail\RegisterMail;
use App\Models\Sellerapplication;
use App\Models\User;
use App\Models\ProspectiveSeller;

class SellerApplicationController extends Controller
{
     /**
     * Display a listing of the resource.
     */
      function __construct()
    {
         $this->middleware('permission:sellerapplication-list|sellerapplication-edit|sellerapplication-delete', ['only' => ['index','store']]);
         $this->middleware('permission:sellerapplication-create', ['only' => ['create','store']]);
         $this->middleware('permission:sellerapplication-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:sellerapplication-delete', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {
          $per_page  = 15;
         
         $auth_user = Auth::user();
         
         $is_admin  = $auth_user->for;
          
       /* 01-03-2025  if($auth_user->for == 'super_admin'){
            
         $employeeData = User::where('for','=','employee')->orderBy('id','DESC')->get();
        }
        elseif($auth_user->for == 'employee'){
           
         $employeeData = User::where('for','=','employee')->where('managed_by','=',$auth_user->id)
                    ->orWhere('created_by','=',$auth_user->id)->orderBy('id','DESC')->get();  
           
       }  */ 
       
       	 $is_designation  = $auth_user->designation;
		  
		  if($is_admin == 'super_admin' || $is_designation == 'HR Manager'){
	       
		   //$employeeData = Employee::where('for','=','employee')
		   
	       $employeeData = User::where('status','!=',0)
	                             ->where('for','=','employee')
				                 ->whereNull('deleted_at')
			                     ->orderBy('id','DESC')
								 ->get();
			
		   }else{
		
	        $user_ids = User::where('created_by','=',$auth_user->id)->orWhere('managed_by','=',$auth_user->id)->pluck('id')->toArray();
			          
			array_push($user_ids,$auth_user->id);
			
			$user_ids2 = User::whereIn('created_by',$user_ids)->orWhereIn('managed_by',$user_ids)->pluck('id')->toArray();
		      
			array_push($user_ids2,$auth_user->id);

	     
	      
		   $employeeData = User::whereIn('managed_by',$user_ids2)
			                     ->where('for','=','employee')
							    // ->orWhereIn('created_by',$user_ids2)
		                         ->where('status','!=',0)
								// ->where('id','!=',$auth_user->id)
				                 ->whereNull('deleted_at')
			                     ->orderBy('id','DESC')
			                     ->get(); 
	       // dd($user_ids,$user_ids2,$employeeData);
    	   }
         
        
         // = Employee::where('created_by','=',$auth_user->id)->orderBy('id','DESC')->get();
    
         $data_collection = Sellerapplication::when($request->q,function (Builder $builder) use ($request) {
                            $builder->where('first_name', 'like', "%{$request->q}%")
                            ->orWhere('last_name', 'like', "%{$request->q}%")
                            ->orWhere('email', 'like', "%{$request->q}%")
                            ->orWhere('mobile', 'like', "%{$request->q}%")
                            ->orWhere('gender', 'like', "%{$request->q}%")
                            ->orWhere('pin_code', 'like', "%{$request->q}%")
                            ->orWhere('country', 'like', "%{$request->q}%")
                            ->orWhere('state', 'like', "%{$request->q}%")
                            ->orWhere('district', 'like', "%{$request->q}%")
                            ->orWhere('city', 'like', "%{$request->q}%");
                            
                           }
                        )
                    ->where('status', '!=', 'appclient-assigned')    
                    ->orderBy('id','DESC'); 
                   // dd($data_collection->get()->toArray());
                    if($is_admin == 'super_admin'){
                        
                    $data=$data_collection
                    ->paginate($per_page);
                        
                    }else{
                        
                    $data = $data_collection->where('created_by','=',$auth_user->id)  
                        
                    ->paginate($per_page); 
                    
                    }
                   return view('sellerapplications.index',compact('data','employeeData'))
                   ->with('i', ($request->input('page', 1) - 1) * $per_page); 
        //return view('sellerapplications.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         return view('sellerapplications.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
          'first_name' => 'required',
          'last_name' => 'required',
          'email' => 'required|email|unique:sellerapplications,email',
             ]);

              $input = $request->all();
            // dd($input);
              $auth_user=Auth::user();
              $input['created_by'] = $auth_user->id;  
              $sellerapplication = Sellerapplication::create($input);

                return redirect()->route('sellerapplications.index')
                        ->with('success','Seller Application created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
        $auth_user = Auth::user();
        
        $request = request();

        $sellerapplication = Sellerapplication::find($id);
       
        $user_emp = User::where('id','=',$sellerapplication->created_by)->first();
        
        if($sellerapplication->managed_by == 'self'){
            
           if($auth_user->for == 'employee'){
                $user_emp_manage = Sellerapplication::where('id','=',$auth_user->emp_id)->first();
            }else{
                $user_emp_manage = User::where('id','=',$auth_user->id)->first();
            }
            
        }else{
            $user_emp_manage = Sellerapplication::where('id','=',$sellerapplication->managed_by)->first();
        }
      
            //$candidate = Candidate::find($id);
        return view('sellerapplications.show',compact('sellerapplication','user_emp'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
         $auth_user=Auth::user();
        
        $sellerapplication = Sellerapplication::find($id);
        

         return view('sellerapplications.edit',compact('sellerapplication'));
         //return view('sellerapplications.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $this->validate($request, [
            //'name' => 'required',
            //'email' => 'required|email|unique:sellerapplications,email,'.$id,
            //'password' => 'same:confirm-password',
            //'roles' => 'required'
        ]);
        
        $sellerapplication = Sellerapplication::find($id);
        
         $input = $request->all();
        
         $auth_user=Auth::user();
        
         $input['created_by'] = $auth_user->id;
          $sellerapplication->update($input);
          
         return redirect()->route('sellerapplications.index')
                        ->with('success','Seller Application updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         Sellerapplication::find($id)->delete();
          return redirect()->route('sellerapplications.index')
                        ->with('success','Seller Application deleted successfully');
    }


    public function sellerWebApplication(Request $request)
    {
        
        //dd('hi');
                 $this->validate($request, [
          'first_name' => 'required',
          'last_name'  => 'required',
          'email'      => 'required|email|unique:sellerapplications,email',
        ]);

              $input                 = $request->all();
             //dd($input);
              //$auth_user           = Auth::user();
             // $input['created_by'] = $auth_user->id;
             
              $input['web_status']       = 'website'; 
            
              $sellerapplication     = Sellerapplication::create($input);

             // return redirect()->route('sellerapplications.index')
                       // ->with('success','Seller Application created successfully');
             return redirect()->route('login')->with('success','Congratulations your application has been submitted successfully. our executive will contact you shortly!');      
         
    }


     public function applicationSellerAssignEmployee(Request $request) 
    {
        $auth_user = Auth::user();
       
        $input = $request->all();
       // dd($input);
        if(empty($input['application_seller_data'])){
          return back()->withErrors(['success' => 'Application Seller Data Should Not Be Empty']);
        }

        $app_seller_ids = explode(',',$input['application_seller_data']);
        
        foreach($app_seller_ids as $app_seller_id){
            
            $appSellerData = Sellerapplication::find($app_seller_id);
             //dd($appSellerData);
           if(!empty($appSellerData)){
                $appSellerDataArr = $appSellerData->toArray();
                
                $appSellerDataArr['assign_to']     = $input['emp_id'];
                $appSellerDataArr['web_name']      = $appSellerDataArr['web_status'];
                //dd($appSellerDataArr['web_name']);
                $appSellerDataArr['app_seller_id'] = $appSellerDataArr['id'];
                $appSellerDataArr['assign_by']     = $auth_user->id;
                $appSellerDataArr['data_from']     = 'app_seller';
                unset($appSellerDataArr['id']);
            }else{
                
                $appSellerDataArr = [];
            }
            
            if(!empty($appSellerDataArr)){

                
                ProspectiveSeller::create($appSellerDataArr);
                
                Sellerapplication::where('id','=',$app_seller_id)->update(['status'=>'appclient-assigned']);
            }
            
        }       


        
        return redirect()->route('sellerapplications.index')->with('success','Application Buyer Data Assign Employee Successfully');   
        
        //return back();
    }

    
}
