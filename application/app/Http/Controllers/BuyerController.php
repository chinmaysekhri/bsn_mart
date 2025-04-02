<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buyer;
use App\Models\Categories;
use App\Models\Employee;
use App\Models\User;	
use App\Models\Wallet;
use Auth;
use DB;
use Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Arr;
use Illuminate\View\View;
use App\Models\HasApiTokens;
use Illuminate\Http\RedirectResponse;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Mail;
use App\Mail\RegisterMail;
use App\Mail\BuyerMail;

class BuyerController extends Controller
{
	 /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	 
/* 	function __construct()
    {
         $this->middleware('permission:buyer-list|buyer-create|buyer-edit|buyer-delete', ['only' => ['index','store']]);
         $this->middleware('permission:buyer-create', ['only' => ['create','store']]);
         $this->middleware('permission:buyer-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:buyer-delete', ['only' => ['destroy']]);
    }
	 */
	 
    public function index(Request $request): View
    {
        
        $per_page = 25;
        
        $auth_user = Auth::user();
        
        $is_admin  = $auth_user->for;
		
		$reqData  = $request->all();
        
        $data_collection = Buyer::when($request->q,function (Builder $builder) use ($request) {
                            $builder->where('first_name', 'like', "%{$request->q}%")
                            ->orWhere('last_name', 'like', "%{$request->q}%")
                            ->orWhere('email', 'like', "%{$request->q}%")
                            ->orWhere('mobile', 'like', "%{$request->q}%")
                            ->orWhere('business_name', 'like', "%{$request->q}%")
                            ->orWhere('pin_code', 'like', "%{$request->q}%")
                            ->orWhere('country', 'like', "%{$request->q}%")
                            ->orWhere('state', 'like', "%{$request->q}%")
                            ->orWhere('district', 'like', "%{$request->q}%")
                            ->orWhere('city', 'like', "%{$request->q}%")
                            ->orWhere('aadhar_no', 'like', "%{$request->q}%")
                            ->orWhere('pan_no', 'like', "%{$request->q}%")
                            ->orWhere('gst_no', 'like', "%{$request->q}%")
                            ->orWhere('bank_name', 'like', "%{$request->q}%")
                            ->orWhere('ifsc_code', 'like', "%{$request->q}%")
                            ->orWhere('account_no', 'like', "%{$request->q}%")
                            ->orWhere('present_address', 'like', "%{$request->q}%");
                           }
                        )
						
		//10-02-2025 Start	  
		 
		   ->when($request->today_applied_on,function (Builder $builder) use ($request) {
			 
			 if(!empty($request->today_applied_on)){
				$builder->whereDate('created_at', 'like', "%{$request->today_applied_on}%"); 
			           }
				 
					 }
				  )
			->when($request->today_updated_on,function (Builder $builder) use ($request) {
			  if(!empty($request->today_updated_on)){  
				  $builder->whereDate('updated_at', 'like', "%{$request->today_updated_on}%");
			           }
			
					 }
				  )
		   
			 ->when($request->today_applied_from,function (Builder $builder) use ($request) {
			   
			   if(!empty($request->today_applied_from)){
				  $builder->whereDate('created_at', '>=', $request->today_applied_from)
						  ->whereDate('created_at', '<=', $request->today_applied_to);
			           }
					 }
				  ) 
				  
				 
		  ->when($request->today_applied_status,function (Builder $builder) use ($request) {
			
			$status = $request->today_applied_status;
			
			if($status == 'Active' ){
				$status2 = 1;
			} else{
				
				$status2 = 0;
			}
 
            if(!empty($request->today_applied_status)){
			  
              $builder->where('status', '=', $status2);

              }
             }
            )  
				  
	//10-02-2025 End	
						
						
                    ->orderBy('id','DESC'); 
                    
                    if($is_admin == 'super_admin'){
                        
                    $data = $data_collection->paginate($per_page);
                        
                    }else{
						
                    $data = $data_collection->where('managed_by','=',$auth_user->id)  
                    ->orWhere('created_by','=',$auth_user->id)->paginate($per_page);    
                    }
                   
                   $requested_input = $request->all();
				   
                   return view('buyers.index',compact('data','reqData','requested_input'))
                   ->with('i', ($request->input('page', 1) - 1) * $per_page);    
        
              
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         $auth_user     = Auth::user();
		 
         $categoryData  = Categories::get();
		 
         //$employeeData  = Employee::where('created_by','=',$auth_user->id)->get();
		 
		 $is_admin= $auth_user->for;
		 
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
								// ->where('id','!=',$auth_user->id)
				                 ->whereNull('deleted_at')
			                     ->orderBy('id','DESC')
			                     ->get(); 
	       // dd($user_ids,$user_ids2,$employeeData);
	}
		  
	/*	01-02-2025  if($is_admin == 'super_admin'){
				
			  $employeeData   = User::where('for','=','employee')
			                        ->where('status','!=',0)
				                    ->whereNull('deleted_at')
			                        ->orderBy('id','DESC')
			                        ->get();
					
				}else{
					
			   $employeeData  = User::where('for','=','employee')
			   
			                    ->where(function ($query) use ($auth_user){ 
                                           $query->where('created_by','=',$auth_user->id)
			                                ->orWhere('managed_by','=',$auth_user->id);
                                      })
			                    ->where('status','!=',0)
				                ->whereNull('deleted_at')
			                    ->orderBy('id','DESC')     
								->get();
			          }
		 */
		 
		 $status        = ['0'=>'Deactive','1'=>'Active'];
         return view('buyers.create',compact('categoryData','employeeData','status'));
       
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $this->validate($request, [
          'first_name' => 'required',
          'last_name'  => 'required',
          'email' => 'required|unique:buyers,email',
          'mobile' => 'required|unique:buyers,mobile',
        ]);

         
    
        $input = $request->all();
      //  dd($input);
        $auth_user=Auth::user();
        
        $input['created_by'] = $auth_user->id;
        
      // $buyerManageBy = Employee::where('managed_by','=',$request->managed_by)->first();
       //dd($buyerManageBy);
       //Adhar//
         if($request->hasfile('upload_aadhar_no')){
            
            $fileName_upload_aadhar_no = time().'.'.$request->upload_aadhar_no->extension();  

            $request->upload_aadhar_no->move(public_path('uploads/buyer/upload_aadhar_no'), $fileName_upload_aadhar_no);
            
            $input['upload_aadhar_no'] = $fileName_upload_aadhar_no;
            
        }else{
            unset($input['upload_aadhar_no']);          
        }
        //Pan//
        if($request->hasfile('upload_pan_no')){
            
            $fileName_upload_pan_no = time().'.'.$request->upload_pan_no->extension();  

            $request->upload_pan_no->move(public_path('uploads/buyer/upload_pan_no'), $fileName_upload_pan_no);
            
            $input['upload_pan_no'] = $fileName_upload_pan_no;
            
        }else{
            unset($input['upload_pan_no']);         
        }
        //12-10-23//
        
        //GST//
        if($request->hasfile('upload_gst_no')){
            
            $fileName_upload_gst_no = time().'.'.$request->upload_gst_no->extension();  

            $request->upload_gst_no->move(public_path('uploads/buyer/upload_gst_no'), $fileName_upload_gst_no);
            
            $input['upload_gst_no'] = $fileName_upload_gst_no;
            
        }else{
            unset($input['upload_gst_no']);         
        }    


        if($request->hasfile('cheque_copy')){
            
            $fileName_cheque_copy = time().'.'.$request->cheque_copy->extension();  

            $request->cheque_copy->move(public_path('uploads/buyer/cheque_copy'),$fileName_cheque_copy);
            
            $input['cheque_copy'] = $fileName_cheque_copy;
            
        }else{
            unset($input['cheque_copy']);           
        }     


        if($request->hasfile('contract_img')){
            
            $fileName_contract_img = time().'.'.$request->contract_img->extension();  

             $request->contract_img->move(public_path('uploads/buyer/contract_img'), $fileName_contract_img);
            
            $input['contract_img'] = $fileName_contract_img;
            
        }else{
            unset($input['contract_img']);           
        } 

       
        $input['category_id'] = json_encode($request->category_id);

        $buyer = Buyer::create($input);
        
        $buyer_passwords = (Str::random(8));
		
	    $buyer_password  =  Hash::make($buyer_passwords);
        
       // $buyer_password = Hash::make($input['mobile']);
        
     
        $user_arr = [
                      'buyer_id'   => $buyer->id,
					  'created_by' => $input['created_by'],
					  'managed_by' => $input['managed_by'],
                      'first_name' => $input['first_name'],
					  'last_name'  => $input['last_name'],
					  'status'      => $input['status'],
					  'district'    => $input['district'],
					  'mobile'     => $input['mobile'],
                      'email'      => $input['email'],
                      'password'   => $buyer_password,
                      'for'        => 'buyer',
                    ];
          
        //dd($user_arr);
		  
        $user = User::create($user_arr);
        $role = ['Buyer'];
        $user->assignRole($role);
     // $role = [$input['designation']];
        
      // $user->assignRole(['Buyer']);  
        
       // $user->assignRole($role);   
	   
	   //create wallet 06-12-2023 Start
		
		$wallet_arr_data = [
                      'created_by'=>$auth_user->id,
                      'buyer_id'=>$buyer->id,
                     // 'total_wallet_amount'=>25,
                      ];
               
        $wallet = Wallet::create($wallet_arr_data);
           $user->assignRole(['Buyer']);  
	  
	   //create wallet 06-12-2023 End	
	   
       //$buyerManageBy = Employee::where('managed_by','=',$buyer->managed_by)->first();
	   
	   //15-02-2024
	   
	   $buyerManageBy = User::where('id','=',$buyer->managed_by)->first(); 
       
        //mail send 12-09-2023
     
        $mailData = [
         
             'first_name' => $buyer->first_name,
             'last_name'  => $buyer->last_name,
             'user_id'    => $input['email'],
             'password'   => $buyer_passwords,
             'manager_first_name' => $buyerManageBy->first_name,
             'manager_last_name'  => $buyerManageBy->last_name,
             'manager_mobile'     => $buyerManageBy->mobile,
             'manager_email'      => $buyerManageBy->email,
          // 'password'   => $input['mobile'],
        ];
         
      Mail::to($input['email'])->send(new BuyerMail($mailData));
            
     //mail send End
       
      return redirect()->route('buyers.index')
                        ->with('success','Buyer created successfully!!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {  
        $buyer     = Buyer::find($id);
		
        $buyercate = json_decode($buyer->category_id);
		
		$buyerCreatedBy  = User::where('id','=',$buyer->created_by)->first();
		
		$user_emp_manage = User::where('id','=',$buyer->managed_by)->first();
			
        return view('buyers.show',compact('buyer','buyercate','buyerCreatedBy','user_emp_manage')); 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $auth_user     = Auth::user();
		
		$buyer         = Buyer::find($id);
		
        //$employeeData  = Employee::where('created_by','=',$auth_user->id)->get();
		
		$is_admin= $auth_user->for;
		
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
								 ->where('id','!=',$auth_user->id)
				                 ->whereNull('deleted_at')
			                     ->orderBy('id','DESC')
			                     ->get(); 
	       // dd($user_ids,$user_ids2,$employeeData);
	}
		 
	/*	  if($is_admin == 'super_admin'){
				
			  $employeeData   = User::where('for','=','employee')
			                        ->where('status','!=',0)
				                    ->whereNull('deleted_at')
			                        ->orderBy('id','DESC')
			                        ->get();
					
				}else{
					
			   $employeeData  = User::where('for','=','employee')
			   
			                    ->where(function ($query) use ($auth_user){ 
                                           $query->where('created_by','=',$auth_user->id)
			                                ->orWhere('managed_by','=',$auth_user->id);
                                  })
			                    ->where('status','!=',0)
				                ->whereNull('deleted_at')
			                    ->orderBy('id','DESC')        
					            ->get();
			   
			}*/
		
        $categoryData  = Categories::orderBy('category_name', 'DESC')->get();
        
        // 11-03-2025 for hold value after search data hold 
		
        $request         = request();
		
        $requested_input = $request->all();
		
	   // 11-03-2025 for hold value after search data hold
		$status        = ['0'=>'Deactive','1'=>'Active'];
        return view('buyers.edit', compact('buyer','categoryData','employeeData','status','requested_input'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
         $this->validate($request, [
            //'name' => 'required',
            //'email' => 'required|email|unique:employees,email,'.$id,
            //'password' => 'same:confirm-password',
            //'roles' => 'required'
        ]);
		
		  $input     = $request->all();
		  
		 // 11-03-2025 for hold value after search data hold in search
        
		 $requested_input = []; 
         
        foreach($input as $req_key => $req_val){
             
             if(str_contains($req_key, 'req_')){
                 
                 unset($input[$req_key]);
                 $req_key = str_replace("req_","",$req_key);
                 $requested_input[$req_key] = $req_val;
			
             }            
         }
		
	  	// 11-03-2025 for hold value after search data hold in search
		 
		  $auth_user = Auth::user();
		  
		  $input['created_by'] = $auth_user->id;
		   
		 // dd($input);
		  
          if($request->hasfile('upload_aadhar_no')){
            
            $fileName_upload_aadhar_no = time().'.'.$request->upload_aadhar_no->extension();  

            $request->upload_aadhar_no->move(public_path('uploads/buyer/upload_aadhar_no'), $fileName_upload_aadhar_no);
            
            $input['upload_aadhar_no'] = $fileName_upload_aadhar_no;
            
        }else{
            unset($input['upload_aadhar_no']);          
        }
        //Pan//
        if($request->hasfile('upload_pan_no')){
            
            $fileName_upload_pan_no = time().'.'.$request->upload_pan_no->extension();  

            $request->upload_pan_no->move(public_path('uploads/buyer/upload_pan_no'), $fileName_upload_pan_no);
            
            $input['upload_pan_no'] = $fileName_upload_pan_no;
            
        }else{
            unset($input['upload_pan_no']);         
        }
        //12-10-23//
        
        //GST//
        if($request->hasfile('upload_gst_no')){
            
            $fileName_upload_gst_no = time().'.'.$request->upload_gst_no->extension();  

            $request->upload_gst_no->move(public_path('uploads/buyer/upload_gst_no'), $fileName_upload_gst_no);
            
            $input['upload_gst_no'] = $fileName_upload_gst_no;
            
        }else{
            unset($input['upload_gst_no']);         
        }    



        if($request->hasfile('cheque_copy')){
            
            $fileName_cheque_copy = time().'.'.$request->cheque_copy->extension();  

            $request->cheque_copy->move(public_path('uploads/buyer/cheque_copy'),$fileName_cheque_copy);
            
            $input['cheque_copy'] = $fileName_cheque_copy;
            
        }else{
            unset($input['cheque_copy']);           
        }     


        if($request->hasfile('contract_img')){
            
            $fileName_contract_img = time().'.'.$request->contract_img->extension();  

             $request->contract_img->move(public_path('uploads/buyer/contract_img'), $fileName_contract_img);
            
            $input['contract_img'] = $fileName_contract_img;
            
        }else{
            unset($input['contract_img']);           
        } 
      $buyer = Buyer::find($id);

      $buyer->update($input);
	  
	  	  
	  $user = User::where('for','=','buyer')->where('buyer_id','=',$buyer->id)->first();
	  
	  $user_arr = [
					  'created_by'  => $input['created_by'],
					  'managed_by'  => $input['managed_by'],
					  'status'      => $input['status'],
					  'district'    => $input['district'],
					//'designation' => $input['designation'],
					  'buyer_id'    => $buyer->id,
					  'email'       => $input['email'],
					 //'password'  => $employ_password,
					  'for'         =>'buyer',
				  ];
		
	  $user->update($user_arr);

         DB::table('model_has_roles')->where('model_id',$user->id)->delete();
    
        $role = ['Buyer'];
        
        //$user->assignRole(['Employee']);  
        
        $user->assignRole($role);
	  
      return redirect()->route('buyers.index',$requested_input)->with('success','Buyer updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Buyer::find($id)->delete();
        
        //code update date 30-01-2025
        
        User::where('buyer_id','=',$id)->delete();
        
        return redirect()->route('buyers.index')->with('success','Buyer deleted successfully');
    }
    
	//Seller Profile Section  15-11-2023
	
	public function buyer_profile()
     {
		   $auth_user = Auth::User();
           //dd($auth_user);
		   $buyer = Buyer::find($auth_user->buyer_id);
		  // dd($buyer);
		   
		   return view('buyers.view_buyer_profile',compact('buyer'));
        
     } 

    public function edit_buyer_profile()
     {
			$auth_user = Auth::User();
			
			$buyer = Buyer::find($auth_user->buyer_id);

			return view('buyers.buyer_profile',compact('buyer'));
			
     } 
	 
	 //15.11.2023//
	 
   public function update_buyer_profile(Request $request, $id)
      {
		$input = $request->all();
		
		//dd($input);
        
		$buyer = Buyer::find($id);
		
		if($request->hasfile('profile_img')){
			
			$fileName_profile_img = time().'.'.$request->profile_img->extension();  
           
			$request->profile_img->move(public_path('uploads/buyer/profile_img'), $fileName_profile_img);
			
			$input['profile_img'] = $fileName_profile_img;
			
		}else{
			unset($input['profile_img']);			
		}

                     //Adhar//
         if($request->hasfile('upload_aadhar_no')){
            
            $fileName_upload_aadhar_no = time().'.'.$request->upload_aadhar_no->extension();  

            $request->upload_aadhar_no->move(public_path('uploads/buyer/upload_aadhar_no'), $fileName_upload_aadhar_no);
            
            $input['upload_aadhar_no'] = $fileName_upload_aadhar_no;
            
        }else{
            unset($input['upload_aadhar_no']);          
        }
        //Pan//
        if($request->hasfile('upload_pan_no')){
            
            $fileName_upload_pan_no = time().'.'.$request->upload_pan_no->extension();  

            $request->upload_pan_no->move(public_path('uploads/buyer/upload_pan_no'), $fileName_upload_pan_no);
            
            $input['upload_pan_no'] = $fileName_upload_pan_no;
            
        }else{
            unset($input['upload_pan_no']);         
        }
        //12-10-23//
        
        //GST//
        if($request->hasfile('upload_gst_no')){
            
            $fileName_upload_gst_no = time().'.'.$request->upload_gst_no->extension();  

            $request->upload_gst_no->move(public_path('uploads/buyer/upload_gst_no'), $fileName_upload_gst_no);
            
            $input['upload_gst_no'] = $fileName_upload_gst_no;
            
        }else{
            unset($input['upload_gst_no']);         
        }    

         //brand_registration_upload//

        if($request->hasfile('brand_registration_upload')){
            
            $fileName_brand_registration_upload = time().'.'.$request->brand_registration_upload->extension();  

            $request->brand_registration_upload->move(public_path('uploads/buyer/brand_registration_upload'), $fileName_brand_registration_upload);
            
            $input['brand_registration_upload'] = $fileName_brand_registration_upload;
            
        }else{
            unset($input['brand_registration_upload']);         
        } 


        if($request->hasfile('cheque_copy')){
            
            $fileName_cheque_copy = time().'.'.$request->cheque_copy->extension();  

            $request->cheque_copy->move(public_path('uploads/buyer/cheque_copy'),$fileName_cheque_copy);
            
            $input['cheque_copy'] = $fileName_cheque_copy;
            
        }else{
            unset($input['cheque_copy']);           
        }     


        if($request->hasfile('contract_img')){
            
            $fileName_contract_img = time().'.'.$request->contract_img->extension();  

             $request->contract_img->move(public_path('uploads/buyer/contract_img'), $fileName_contract_img);
            
            $input['contract_img'] = $fileName_contract_img;
            
        }else{
            unset($input['contract_img']);           
        } 

        $buyer->update($input);

       return redirect()->route('edit_buyer_profile',['active_tab'=>$request->active_tab])
                        ->with('success','Buyer Profile Updated Successfully');
    }

  
   
}
