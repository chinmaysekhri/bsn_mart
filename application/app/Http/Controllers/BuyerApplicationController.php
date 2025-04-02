<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Eloquent\Builder;
use Auth;
use DB;
use Hash;
use Illuminate\Support\Arr;
use App\Models\Employee;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Maatwebsite\Excel\Facades\Excel;
use Mail;
use App\Mail\RegisterMail;
use App\Models\Buyerapplication;
use App\Models\User;
use App\Models\ProspectiveBuyer;

class BuyerApplicationController extends Controller
{
   /**
     * Display a listing of the resource.
     */

    function __construct()
    {
         $this->middleware('permission:buyerapplication-list|buyerapplication-buyerapplication|client-edit|buyerapplication-delete', ['only' => ['index','store']]);
         $this->middleware('permission:buyerapplication-create', ['only' => ['create','store']]);
         $this->middleware('permission:buyerapplication-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:buyerapplication-delete', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {
         $per_page  = 15;
         
         $auth_user = Auth::user();
         
         $is_admin  = $auth_user->for;
          
     /*    if($auth_user->for == 'super_admin'){
            
         $employeeData = User::where('for','=','employee')->orderBy('id','DESC')->get();
        }
        elseif($auth_user->for == 'employee'){
           
         $employeeData = User::where('for','=','employee')->where('managed_by','=',$auth_user->id)
                    ->orWhere('created_by','=',$auth_user->id)->orderBy('id','DESC')->get();  
           
       }  */   
       
       
       	  $is_designation  = $auth_user->designation;
		  
		  if($is_admin == 'super_admin' || $is_designation == 'HR Manager'){
	       
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
								 //->where('id','!=',$auth_user->id)
				                 ->whereNull('deleted_at')
			                     ->orderBy('id','DESC')
			                     ->get(); 
	      
	                 }
         
        
      //  $employeeData = Employee::where('created_by','=',$auth_user->id)->orderBy('id','DESC')->get();
        
        $data_collection = Buyerapplication::when($request->q,function (Builder $builder) use ($request) {
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
                   return view('buyerapplications.index',compact('data','employeeData'))
                   ->with('i', ($request->input('page', 1) - 1) * $per_page); 
        //return view('buyerapplications.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         return view('buyerapplications.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
          'first_name' => 'required',
          'last_name' => 'required',
           'email' => 'required|email|unique:buyerapplications,email',
             ]);

              $input = $request->all();
             // dd($input);
              $auth_user=Auth::user();
              $input['created_by'] = $auth_user->id;  
              $buyerapplication = Buyerapplication::create($input);

               
        return redirect()->route('buyerapplications.index')
                        ->with('success','Buyer Application created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $auth_user = Auth::user();
        
        $request = request();

        $buyerapplication = Buyerapplication::find($id);
       
        $user_emp = User::where('id','=',$buyerapplication->created_by)->first();
        
        if($buyerapplication->managed_by == 'self'){
            
           if($auth_user->for == 'employee'){
                $user_emp_manage = Buyerapplication::where('id','=',$auth_user->emp_id)->first();
            }else{
                $user_emp_manage = User::where('id','=',$auth_user->id)->first();
            }
            
        }else{
            $user_emp_manage = Buyerapplication::where('id','=',$buyerapplication->managed_by)->first();
        }
      
            //$candidate = Candidate::find($id);
        return view('buyerapplications.show',compact('buyerapplication','user_emp'));
      // return view('buyerapplications.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
         $auth_user=Auth::user();
        
        $buyerapplication = Buyerapplication::find($id);
        

         return view('buyerapplications.edit',compact('buyerapplication'));
         //return view('buyerapplications.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $this->validate($request, [
            //'name' => 'required',
            //'email' => 'required|email|unique:employees,email,'.$id,
            //'password' => 'same:confirm-password',
            //'roles' => 'required'
        ]);
        
        $buyerapplication = Buyerapplication::find($id);
        
         $input = $request->all();
        
         $auth_user=Auth::user();
        
         $input['created_by'] = $auth_user->id;
          $buyerapplication->update($input);
          
         return redirect()->route('buyerapplications.index')
                        ->with('success','Buyer Application updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         Buyerapplication::find($id)->delete();
        return redirect()->route('buyerapplications.index')
                        ->with('success','Buyer Application deleted successfully');
    }

 public function buyerWebApplication(Request $request)
    {
       //dd('hi');
           $this->validate($request, [
          'first_name' => 'required',
          'last_name'  => 'required',
          'email'      => 'required|email|unique:buyerapplications,email',
        ]);

              $input                 = $request->all();
          // dd($input);
              //$auth_user           = Auth::user();
             // $input['created_by'] = $auth_user->id;
             
              $input['web_status']       = 'website';  
              
              $buyerapplication      = Buyerapplication::create($input);
           
             return redirect()->route('login')->with('success','Congratulations your application has been submitted successfully. our executive will contact you shortly!'); 
   
    }

   


    public function applicationBuyerAssignEmployee(Request $request) 
    {
        $auth_user = Auth::user();
       
        $input = $request->all();
        //dd($input);
        if(empty($input['application_buyer_data'])){
          return back()->withErrors(['success' => 'Application Buyer Data Should Not Be Empty']);
        }

        $app_buyer_ids = explode(',',$input['application_buyer_data']);
        
        foreach($app_buyer_ids as $app_buyer_id){
            
            $appBuyerData = Buyerapplication::find($app_buyer_id);
             //dd($appBuyerData);
           if(!empty($appBuyerData)){
                $appBuyerDataArr = $appBuyerData->toArray();
                
                $appBuyerDataArr['assign_to']     = $input['emp_id'];
                $appBuyerDataArr['web_name']      = $appBuyerDataArr['web_status'];
                $appBuyerDataArr['app_buyer_id'] = $appBuyerDataArr['id'];
                $appBuyerDataArr['assign_by']     = $auth_user->id;
                $appBuyerDataArr['data_from']     = 'app_buyer';
                unset($appBuyerDataArr['id']);
            }else{
                
                $appBuyerDataArr = [];
            }
            
            if(!empty($appBuyerDataArr)){

                
                ProspectiveBuyer::create($appBuyerDataArr);
                
                Buyerapplication::where('id','=',$app_buyer_id)->update(['status'=>'appclient-assigned']);
            }
            
        }       


        
        return redirect()->route('buyerapplications.index')->with('success','Application Buyer Data Assign Employee Successfully');   
        
        //return back();
    }


}
