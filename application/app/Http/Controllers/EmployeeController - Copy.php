<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Employee;
use App\Models\EmployeeComment;
use App\Models\Company;
use App\Models\Designation;
use App\Models\Ledger;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Arr;
use Illuminate\View\View;
use App\Models\HasApiTokens;
use Illuminate\Http\RedirectResponse;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Mail;
use App\Mail\RegisterMail;
use App\Mail\EmployeeMail;
use Auth;
use DB;
use Hash;

class EmployeeController extends Controller
{
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	 
	function __construct()
    {
         $this->middleware('permission:employee-list|employee-create|employee-edit|employee-delete', ['only' => ['index','store']]);
         $this->middleware('permission:employee-create', ['only' => ['create','store']]);
         $this->middleware('permission:employee-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:employee-delete', ['only' => ['destroy']]);
    }
	
   public function index(Request $request): View
    {

	//	Date: 03-08-2024
	
         $per_page = 15;
		
		 $auth_user = Auth::user();
		
		 $is_admin  = $auth_user->for;
		
		 $is_designation  = $auth_user->designation;

		 if($is_admin == 'super_admin'){
        
         $employeeData   = User::where('for','=','employee')->orderBy('id','DESC')->get();
          
        }
		
        else{
            
         $employeeData   = User::where('for','=','employee')
			   
					   ->where(function ($query) use ($auth_user){ 
						   $query->where('created_by','=',$auth_user->id)
							->orWhere('managed_by','=',$auth_user->id)
							->orWhere('id','=',$auth_user->id);
					  })->orderBy('id','DESC')
						   
					->get();
            
            } 
			
			
	 /*  if($is_admin == 'super_admin'){
        
        $employeeData   = User::where('for','=','seller')
                              ->orWhere('for','=','buyer')
                             // ->orWhere('for','=','employee')
                              ->orderBy('id','DESC')->get();
    
        }elseif($is_admin == 'buyer'){
          
         $employeeData  = User::where('for','=','buyer')
                                        // ->orWhere('for','=','seller')
                                         ->where(function ($query) use ($auth_user){ 
                                          $query->where('created_by','=',$auth_user->id)
                                         ->orWhere('managed_by','=',$auth_user->id)
                                         ->orWhere('id','=',$auth_user->id);
                                         })->orderBy('id','DESC')->get();

            }elseif($is_admin == 'seller'){
				
				$employeeData  = User::where('for','=','seller')
                                         //->orWhere('for','=','seller')
                                         ->where(function ($query) use ($auth_user){ 
                                          $query->where('created_by','=',$auth_user->id)
                                         ->orWhere('managed_by','=',$auth_user->id)
                                         ->orWhere('id','=',$auth_user->id);
                                         })->orderBy('id','DESC')->get();
			}elseif($is_admin == 'employee'){
				
				$employeeData  = User::where('for','=','buyer')
                                         ->orWhere('for','=','seller')
                                         ->where(function ($query) use ($auth_user){ 
                                          $query->where('created_by','=',$auth_user->id)
                                         ->orWhere('managed_by','=',$auth_user->id)
                                         ->orWhere('id','=',$auth_user->id);
                                         })->orderBy('id','DESC')->get();
			} */
     
         $data = Employee::when($request->q,function (Builder $builder) use ($request) {
			 
							$builder->where('first_name', 'like', "%{$request->q}%")
							->orWhere('last_name', 'like', "%{$request->q}%")
							->orWhere('email', 'like', "%{$request->q}%")
							->orWhere('mobile', 'like', "%{$request->q}%")
							->orWhere('gender	', 'like', "%{$request->q}%")
							->orWhere('esi_no', 'like', "%{$request->q}%")
							->orWhere('present_address', 'like', "%{$request->q}%")
							->orWhere('status', 'like', "%{$request->q}%")
							->orWhere('permanent_address', 'like', "%{$request->q}%");
							
                 }
				
              )
			  
        ->when($request->today_applied_on,function (Builder $builder) use ($request) {
         //dd($request->today_applied_on);
         if(!empty($request->today_applied_on)){
            $builder->whereDate('created_at', 'like', "%{$request->today_applied_on}%"); 
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
				$status2 = '1';
			} else{
				
				$status2 = '0';
			}
 
            if(!empty($request->today_applied_status)){
			  
              $builder->where('status', '=', $status2);

              }
             }
            )
        
        ->when($request->team_member_data,function (Builder $builder) use ($request) {
           
            if(!empty($request->team_member_data)){
			   
            $builder->where('created_by', '=', $request->team_member_data)
                              //->orWhere('managed_by', '=', $request->team_member_data);
							  //04-08-2024
							  ->orWhere(function ($query) use($request) {
									 //  use function to pass data inside
							       $query->where('managed_by', '=', $request->team_member_data)
								        ->when($request->today_applied_status,function (Builder $builder) use ($request) {
			
			$status = $request->today_applied_status;
			
			if($status == 'Active' ){
				$status2 = '1';
			} else{
				
				$status2 = '0';
			}
   //dd($request->today_applied_status);
		
            if(!empty($request->today_applied_status)){
			  
              $builder->where('status', '=', $status2);

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
		->when($request->today_applied_on,function (Builder $builder) use ($request) {
         
         if(!empty($request->today_applied_on)){
            $builder->whereDate('created_at', 'like', "%{$request->today_applied_on}%"); 
							  }
						 
							}
						   );
						//04-08-2024		   
					   });
							  
                    }
                 }
              )
        
    
          ->orderBy('id','DESC');
        
            if($is_admin == 'super_admin' || $is_designation == 'HR Manager'){
						
				//dd($request->all(),$is_admin);	   
		    $data = $data->paginate($per_page)->appends($request->query());
		    //$data = $data->get()->toArray();
			//dd( $data);			
			}else{
						
			$user_ids = User::where('created_by','=',$auth_user->id)->orWhere('managed_by','=',$auth_user->id)->pluck('id')->toArray();
			          
			array_push($user_ids,$auth_user->id);
			
			$user_ids2 = User::whereIn('created_by',$user_ids)->orWhereIn('managed_by',$user_ids)->pluck('id')->toArray();
			       
			array_push($user_ids2,$auth_user->id);

						
			//$data = $data->whereIn('created_by',$user_ids2)->paginate($per_page)->appends($request->query());	
						
		    $data = $data->whereIn('created_by',$user_ids)
			
			             //->orWhereIn('managed_by',$user_ids)
              						// 04-08-2024
						 
						 			->orWhere(function ($query) use($request,$user_ids) {
									 //  use function to pass data inside
							       $query->whereIn('managed_by',$user_ids)
								            ->when($request->today_applied_status,function (Builder $builder) use ($request) {
			
								$status = $request->today_applied_status;
								
								if($status == 'Active' ){
									$status2 = '1';
								} else{
									
									$status2 = '0';
								}
					   //dd($request->today_applied_status);
							
							  if(!empty($request->today_applied_status)){
								  
								  $builder->where('status', '=', $status2);

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
							->when($request->today_applied_on,function (Builder $builder) use ($request) {
							 
							 if(!empty($request->today_applied_on)){
								$builder->whereDate('created_at', 'like', "%{$request->today_applied_on}%"); 
												  }
											 
												}
											   );
											//04-08-2024		   
										   })
			
			              ->paginate($per_page)->appends($request->query());
				
			}
      
      
             $requested_input = $request->all();
             return view('employees.index',compact('data','requested_input','employeeData'))
            ->with('i', ($request->input('page', 1) - 1) * $per_page); 	
		
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
	 
    public function create(): View
    {
      //16-10-2023
	  
		  $auth_user = Auth::user();
		
          $is_admin= $auth_user->for;
		  
		  $is_designation  = $auth_user->designation;
		  
		  if($is_admin == 'super_admin' || $is_designation == 'HR Manager'){
				
			  $employeeData = Employee::get();
					
				}else{
				
               $user_ids = User::where('created_by','=',$auth_user->id)->pluck('id')->toArray();
			  
			     array_push($user_ids,$auth_user->id);

			   $employeeData = Employee::whereIn('created_by',$user_ids)->get();
			 
			}
		 

		  $data['usersData'] = User::select('first_name','last_name')->orderBy('id','DESC')->get();
		  
		  $designationData  = Designation::orderBy('designation_name', 'DESC')->get();
		
		 //$data['designation'] =Role::select('name')->orderBy('id','DESC')->get();
		 //dd($data['usersData'] );
         //$roles = Role::pluck('name','name')->get();
         //dd($data['designation']);
		 
        $status = ['0'=>'Deactive','1'=>'Active'];
		
        $qualification = ['10th'=>'10th','12th'=>'12th','Graduate'=>'Graduate','Post Graduate'=>'Post Graduate','PHD'=>'PHD'];
		
        return view('employees.create',compact('status','qualification','employeeData','designationData'),$data);
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
        	 'first_name' => 'required',
             'last_name' => 'required',
            'email' => 'required|unique:employees,email',
            'mobile' => 'required|unique:employees,mobile',
        ]);


    
        $input     = $request->all();
		
	    $auth_user = Auth::user();
		
        $input['created_by'] = $auth_user->id;
		
		if($request->managed_by == 'self'){
			
			$request->managed_by = $auth_user->id;
			
			$emp_user = User::where('id','=',$request->managed_by)->first();
		}else{
		  $emp_user = User::where('emp_id','=',$request->managed_by)->first();	
		}
		
		//$input['managed_by'] = $request->managed_by;
		//dd($emp_user,$request->managed_by);
		
		//$input['managed_by'] = $emp_user->id;
		
		
		if(!empty($emp_user)){
			
           $input['managed_by'] = $emp_user->id;
           
           $managed_by_name     =  $emp_user->first_name.' '.$emp_user->last_name;
		   
		   $managed_by_mobile   = $emp_user->mobile;
		 
		 }else{
		
	      $input['managed_by'] = $auth_user->id; 
	      
	      $managed_by_name     =  $auth_user->first_name.' '.$auth_user->last_name;
		   
		  $managed_by_mobile   = $auth_user->mobile;
	      
		 } 
          
		  // dd($input['managed_by']);
		
	     if($request->hasfile('resume')){
			
		   $fileName_resume = time().'.'.$request->resume->extension();  

		   $request->resume->move(public_path('uploads/employee/resume'), $fileName_resume);
			
		   $input['resume'] = $fileName_resume;
		   }	
		
		//dd($input);
		
        //$input['password'] = Hash::make($input['password']);
    
        $employee = Employee::create($input);
		
		//$input['password'] = Hash::make($input['mobile']);
		
		$employee_passwords = (Str::random(8));
		
	    $employee_password =  Hash::make($employee_passwords );
		
	//	$employee_password = Hash::make($input['mobile']);
		
		$user_arr = [
				
				
					  'emp_id'            => $employee->id,
					  'created_by'        => $input['created_by'],
					  'managed_by'        => $input['managed_by'],
					  'email'             => $input['email'],
					  'first_name'        => $input['first_name'],
					  'last_name'         => $input['last_name'],
					  'mobile'            => $input['mobile'],
					  'status'            => $input['status'],
					  'designation'       => $input['designation'],
					  'salary'            => $input['salary'],
					  'official_email'    => $input['official_email'],
					  'official_password' => $input['official_password'],
					  'official_contact'  => $input['official_contact'],
					  'password'          => $employee_password,
					  'for'                =>'employee',
					];
					
		$user = User::create($user_arr);
		
		$role = [$input['designation']];
		
		//$user->assignRole(['Employee']);	
		
		$user->assignRole($role);	
		
		
		 //mail send 12-09-2023
	 
	    $mailData = [
         
             'first_name'        => $employee->first_name,
             'last_name'         => $employee->last_name,
             'user_id'           => $input['email'],
			 'password'          => $employee_passwords,
			 'mobile'            => $input['mobile'],
			 'designation'       => $input['designation'],
			 'salary'            => $input['salary'],
			 'official_email'    => $input['official_email'],
			 'official_password' => $input['official_password'],
		     'official_contact'  => $input['official_contact'],
		     'managed_by_name'   => $managed_by_name,
		     'managed_by_mobile' => $managed_by_mobile,
        ];
         
      Mail::to($input['email'])->send(new EmployeeMail($mailData));
			
	//mail send End
		
		
		if($request->hasfile('resume')){  

		     $request->resume->move(public_path('uploads/employee/'.$employee->id.'/resume'), $fileName_resume);

		   }
		   
      //  $user->assignRole($request->input('roles'));
    
        return redirect()->route('employees.index')
                        ->with('success','Employee created successfully');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $auth_user = Auth::user();
		
		$request = request();
		
		$emp = Employee::find($id);
		
		if($request->has('action') && $request->action == 'delete_img'){
			
			if($request->has('column') && $request->column == 'other_offer_letter'){
				
				$other_offer_letter_arr = json_decode($emp->other_offer_letter, true);
				
				foreach($other_offer_letter_arr as $img){
					
					if($img == $request->img){
						$other_offer_letter_arr2[] = '';
					}else{
						$other_offer_letter_arr2[] = $img;
					}
				}
				
				$emp->update([$request->column=>json_encode($other_offer_letter_arr2)]);
			
			}elseif($request->has('column') && $request->column == 'other_relieving_letter'){
				
				$other_relieving_letter_arr = json_decode($emp->other_relieving_letter, true);
				
				foreach($other_relieving_letter_arr as $img){
					
					if($img == $request->img){
						$other_relieving_letter_arr2[] = '';
					}else{
						$other_relieving_letter_arr2[] = $img;
					}
				}
				
				$emp->update([$request->column=>json_encode($other_offer_letter_arr2)]);
			
			}else{
				$emp->update([$request->column=>'']);
			}
			
			
			
			unlink($request->img_val);
			
			return back()->with('success','Employee image deleted successfully');
		}
		
		$user_emp = User::where('id','=',$emp->created_by)->first();
		
		//if($emp->managed_by == 'self'){
			
	  if($emp->managed_by == $auth_user->id){
			
			if($auth_user->for == 'company'){
				$user_emp_manage = Company::where('id','=',$auth_user->company_id)->first();
			}elseif($auth_user->for == 'employee'){
				$user_emp_manage = Employee::where('id','=',$auth_user->emp_id)->first();
			}else{
				$user_emp_manage = User::where('id','=',$auth_user->id)->first();
			}
			
		}else{
			$user_emp_manage = User::where('id','=',$emp->managed_by)->first();
		}
		
	   $emp_comments = EmployeeComment::select('employee_comments.*', 'users.first_name', 'users.last_name')
		                   ->leftjoin('users', 'users.id', 'employee_comments.created_by')
		                   ->where('employee_comments.emp_id', '=', $id)->get();
		//dd($emp_comments);
        return view('employees.show',compact('emp', 'user_emp', 'user_emp_manage', 'emp_comments'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id): View
    {
 
	    $auth_user = Auth::user();
		
		$is_admin= $auth_user->for;
		  
		$is_designation  = $auth_user->designation;
		
		//$employ    = Employee::find($id);
		$employ    = Employee::select('employees.*','users.emp_id as user_emp_id','users.id as user_id')
										->join('users','employees.managed_by','=','users.id')
										->where('employees.id','=',$id)
										->first();
		
		$designationData = Designation::orderBy('designation_name', 'DESC')->get();
		
/* 		
        //23-05-2024
        $employeeData    =  Employee::select('employees.*','users.emp_id as user_emp_id','users.id as user_id')
										->join('users','employees.managed_by','=','users.id')
										->where('employees.created_by','=',$auth_user->id)
										->orWhere('employees.managed_by','=',$auth_user->id)
										->get(); */
										
    //23-05-2024 Start								
	    if($is_admin == 'super_admin' || $is_designation == 'HR Manager'){
				
			  $employeeData = Employee::get();
					
				}else{
				
               $user_ids = User::where('created_by','=',$auth_user->id)->pluck('id')->toArray();
			  
			     array_push($user_ids,$auth_user->id);

			   //$employeeData = Employee::whereIn('created_by',$user_ids)->get();
			   
			   $employeeData    =  Employee::select('employees.*','users.emp_id as user_emp_id','users.id as user_id')
										->join('users','employees.managed_by','=','users.id')
										->where('employees.created_by','=',$user_ids)
										->orWhere('employees.managed_by','=',$user_ids)
										->get();
			 
			}								
	//23-05-2024 End						
		
		$status = ['0'=>'Deactive','1'=>'Active'];
    
        return view('employees.edit',compact('employ' ,'employeeData' ,'status','designationData'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $this->validate($request, [
            //'name' => 'required',
            //'email' => 'required|email|unique:employees,email,'.$id,
            //'password' => 'same:confirm-password',
            //'roles' => 'required'
        ]);
		
        $employ    = Employee::find($id);

		$input     = $request->all();

		$auth_user = Auth::user();
		
        $input['created_by'] = $auth_user->id;
		
	   if($request->managed_by == 'self'){
			
	      $request->managed_by = $auth_user->id;
			
		  $emp_user = User::where('id','=',$request->managed_by)->first();
		}else{
		  $emp_user = User::where('emp_id','=',$request->managed_by)->first();	
		}
		
		//$emp_user = User::where('emp_id','=',$request->managed_by)->first();
		
        //$input['managed_by'] = $emp_user->id;
        
		if(!empty($emp_user)){
			
           $input['managed_by'] = $emp_user->id;
		 
		 }else{
		
	      $input['managed_by'] = $auth_user->id; 
		 } 
		
       //dd($input);
	   
     		if($request->hasfile('resume')){
			
			$fileName_resume = time().'.'.$request->resume->extension();  

			$request->resume->move(public_path('uploads/employee/'.$employ->id.'/resume'), 
			$fileName_resume);
			
			$input['resume'] = $fileName_resume;
			
		}else{
			unset($input['resume']);			
		
		}
        
        $employ->update($input);
		
		$user = User::where('for','=','employee')->where('emp_id','=',$employ->id)->first();
     
		$employ_password = Hash::make(rand());
		
		$user_arr = [
					  'created_by'  => $input['created_by'],
					  'managed_by'  => $input['managed_by'],
					  'designation' => $input['designation'],
					  'status'      => $input['status'],
					  'emp_id'      => $employ->id,
					  'email'       => $input['email'],
					  //'password'=>$employ_password,
					  'for'=>'employee',
					];
					
					
		$user->update($user_arr);
		
        DB::table('model_has_roles')->where('model_id',$user->id)->delete();
    
	    $role = [$input['designation']];
		
		//$user->assignRole(['Employee']);	
		
		$user->assignRole($role);

        return redirect()->route('employees.index')
                        ->with('success','Employee updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id): RedirectResponse
    {
        Employee::find($id)->delete();
        return redirect()->route('employees.index')
                        ->with('success','Employee deleted successfully');
    }
	
	
   //Employee Profile 29-08-2023
	 
	 public function employee_profile()
     {
       $auth_user = Auth::user();
	    
	   $employee = Employee::find($auth_user->emp_id);
	  // dd($auth_user->emp_id);
	   
	  // $user_emp_manage = User::where('id','=',$employee->managed_by)->first();
	   
	   if(empty($employee->managed_by)){
		   
		   // $user_emp_manage = User::where('id','=',$employee->managed_by)->first();
			
			$user_emp_manage = User::where('id','=',$auth_user->id)->first();
		}
		else{
			
			$user_emp_manage = User::where('id','=',$employee->managed_by)->first();
			
			//$user_emp_manage = User::where('id','=',$auth_user->id)->first();
		} 
	  // dd($employee);
        return view('employees.view_employee_profile',compact('employee','user_emp_manage'));
        
     } 
	 
	 public function edit_employee_profile()
     {
       $auth_user = Auth::user();
	    
	   $employee = Employee::find($auth_user->emp_id);
	   
	 //  $user_emp_manage = User::where('id','=',$employee->managed_by)->first();
	   
	      if(empty($employee->managed_by)){
		   
		    //$user_emp_manage = User::where('id','=',$employee->managed_by)->first();
			
			$user_emp_manage = User::where('id','=',$auth_user->id)->first();
		}
		else{
			
			$user_emp_manage = User::where('id','=',$employee->managed_by)->first();
			
			//$user_emp_manage = User::where('id','=',$auth_user->id)->first();
		}
	   
	  // dd($user_emp_manage);
	   
       return view('employees.employee_profile',compact('employee','user_emp_manage'));
        
     } 
	 
	public function update_employee_profile(Request $request, $id)
    {
		$input = $request->all();
        
		$emp = Employee::find($id);
		
		if($request->hasfile('profile_img')){
			
			$fileName_profile_img = time().'.'.$request->profile_img->extension();  
           
			$request->profile_img->move(public_path('uploads/employee/'.$emp->id.'/profile_img'), $fileName_profile_img);
			
			$input['profile_img'] = $fileName_profile_img;
			
		}else{
			unset($input['profile_img']);			
		}
		
	    if($request->hasfile('cheque_copy')){
			
			$fileName_cheque_copy = time().'.'.$request->cheque_copy->extension();  

			$request->cheque_copy->move(public_path('uploads/users/employee'), $fileName_cheque_copy);
			
			$input['cheque_copy'] = $fileName_cheque_copy;
			
		}else{
			unset($input['cheque_copy']);			
		}  
	//12-10-23//
        		  //Adhar//
		 if($request->hasfile('upload_aadhar_no')){
			
			$fileName_upload_aadhar_no = time().'.'.$request->upload_aadhar_no->extension();  

			$request->upload_aadhar_no->move(public_path('uploads/employee/'.$emp->id.'/upload_aadhar_no'), $fileName_upload_aadhar_no);
			
			$input['upload_aadhar_no'] = $fileName_upload_aadhar_no;
			
		}else{
			unset($input['upload_aadhar_no']);			
		}
		//Pan//
		if($request->hasfile('upload_pan_no')){
			
			$fileName_upload_pan_no = time().'.'.$request->upload_pan_no->extension();  

			$request->upload_pan_no->move(public_path('uploads/employee/'.$emp->id.'/upload_pan_no'), $fileName_upload_pan_no);
			
			$input['upload_pan_no'] = $fileName_upload_pan_no;
			
		}else{
			unset($input['upload_pan_no']);			
		}
		//12-10-23//
		
		//GST//
		if($request->hasfile('upload_gst_no')){
			
			$fileName_upload_gst_no = time().'.'.$request->upload_gst_no->extension();  

			$request->upload_gst_no->move(public_path('uploads/employee/upload_gst_no'), $fileName_upload_gst_no);
			
			$input['upload_gst_no'] = $fileName_upload_gst_no;
			
		}else{
			unset($input['upload_gst_no']);			
		}		
		
		//10th//
		if($request->hasfile('ten_board_school_document')){
			
			$fileName_ten_board_school_document = time().'.'.$request->ten_board_school_document->extension();  

			$request->ten_board_school_document->move(public_path('uploads/employee/'.$emp->id.'/ten_board_school_document'), $fileName_ten_board_school_document);
			
			$input['ten_board_school_document'] = $fileName_ten_board_school_document;
			
		}else{
			unset($input['ten_board_school_document']);			
		}	
		//12th//
		if($request->hasfile('twelve_board_school_document')){
			
			$fileName_twelve_board_school_document = time().'.'.$request->twelve_board_school_document->extension();  

			$request->twelve_board_school_document->move(public_path('uploads/employee/'.$emp->id.'/twelve_board_school_document'), $fileName_twelve_board_school_document);
			
			$input['twelve_board_school_document'] = $fileName_twelve_board_school_document;
			
		}else{
			unset($input['twelve_board_school_document']);			
		}

		//         Graduate //
		if($request->hasfile('graduate_board_school_document')){
			
			$fileName_graduate_board_school_document = time().'.'.$request->graduate_board_school_document->extension();  

			$request->graduate_board_school_document->move(public_path('uploads/employee/'.$emp->id.'/graduate_board_school_document'), $fileName_graduate_board_school_document);
			
			$input['graduate_board_school_document'] = $fileName_graduate_board_school_document;
			
		}else{
			unset($input['graduate_board_school_document']);			
		}		

		// post Graduate //
		if($request->hasfile('post_graduate_board_school_document')){
			
			$fileName_post_graduate_board_school_document = time().'.'.$request->post_graduate_board_school_document->extension();  

			$request->post_graduate_board_school_document->move(public_path('uploads/employee/'.$emp->id.'/post_graduate_board_school_document'), $fileName_post_graduate_board_school_document);
			
			$input['post_graduate_board_school_document'] = $fileName_post_graduate_board_school_document;
			
		}else{
			unset($input['post_graduate_board_school_document']);			
		}	

		

		//PHD //
		if($request->hasfile('phd_board_school_document')){
			
			$fileName_phd_board_school_document = time().'.'.$request->phd_board_school_document->extension();  

			$request->phd_board_school_document->move(public_path('uploads/employee/'.$emp->id.'/phd_board_school_document'), $fileName_phd_board_school_document);
			
			$input['phd_board_school_document'] = $fileName_phd_board_school_document;
			
		}else{
			unset($input['phd_board_school_document']);			
		}
        //08.09.23//
        
        //other offer letter//	
		if(isset($input['other_offer_letter']) && is_array($input['other_offer_letter'])){
			
			$other_offer_letter_arr = $input['other_offer_letter'];
			
			$fileName_other_offer_letter_arr = [];
			
			foreach($other_offer_letter_arr as $other_offer_letter_val){
				
				if(!empty($other_offer_letter_val)){
					
				   $fileName_other_offer_letter = time().'.'.$other_offer_letter_val->extension();
				   
				   $other_offer_letter_val->move(public_path('uploads/employee/'.$emp->id.'/other_offer_letter'), $fileName_other_offer_letter);
				   
				   $fileName_other_offer_letter_arr[] = $fileName_other_offer_letter;
				}

			}

            $input['other_offer_letter'] = json_encode($fileName_other_offer_letter_arr);
			
		}


		//other relieving letter//
		 if(isset($input['other_relieving_letter']) && is_array($input['other_relieving_letter'])){
			
			$other_relieving_letter_arr = $input['other_relieving_letter'];
			
			$fileName_other_relieving_letter_arr = [];
			
			foreach($other_relieving_letter_arr as $other_relieving_letter_val){
				
				if(!empty($other_relieving_letter_val)){
					
				   $fileName_other_relieving_letter = time().'.'.$other_relieving_letter_val->extension();
				   
				   $other_relieving_letter_val->move(public_path('uploads/employee/'.$emp->id.'/other_relieving_letter'), $fileName_other_relieving_letter);
				   
				   $fileName_other_relieving_letter_arr[] = $fileName_other_relieving_letter;
				}

			}

            $input['other_relieving_letter'] = json_encode($fileName_other_relieving_letter_arr);
			
		}

		//company_offer_letter//
		if($request->hasfile('company_offer_letter')){
			
			$fileName_company_offer_letter = time().'.'.$request->company_offer_letter->extension();  

			$request->company_offer_letter->move(public_path('uploads/employee/'.$emp->id.'/company_offer_letter'), $fileName_company_offer_letter);
			
			$input['company_offer_letter'] = $fileName_company_offer_letter;
			
		}else{
			unset($input['company_offer_letter']);			
		}
			
		

        //Comapny relieving Letter//
       	if($request->hasfile('company_relieving_letter')){
			
			$fileName_company_relieving_letter = time().'.'.$request->company_relieving_letter->extension();  

			$request->company_relieving_letter->move(public_path('uploads/employee/'.$emp->id.'/company_relieving_letter'), $fileName_company_relieving_letter);
			
			$input['company_relieving_letter'] = $fileName_company_relieving_letter;
			
		}else{
			unset($input['company_relieving_letter']);			
		}
			
			//other_upload_document//
      if(isset($input['other_upload_document']) && is_array($input['other_upload_document'])){
			
			$other_upload_document_arr = $input['other_upload_document'];
			
			$fileName_other_upload_document_arr = [];
			
			foreach($other_upload_document_arr as $other_upload_document_val){
				
				if(!empty($other_upload_document_val)){
					
				   $fileName_other_upload_document = time().'.'.$other_upload_document_val->extension();
				   
				   $other_upload_document_val->move(public_path('uploads/employee/'.$emp->id.'/other_upload_document'), $fileName_other_upload_document);
				   
				   $fileName_other_upload_document_arr[] = $fileName_other_upload_document;
				}

			}

            $input['other_upload_document'] = json_encode($fileName_other_upload_document_arr);
			
		}


		//Upload Salary Slip First//
		if($request->hasfile('salary_slip_first')){
			
			$fileName_salary_slip_first = time().'.'.$request->salary_slip_first->extension();  

			$request->salary_slip_first->move(public_path('uploads/employee/'.$emp->id.'/salary_slip_first'), $fileName_salary_slip_first);
			
			$input['salary_slip_first'] = $fileName_salary_slip_first;
			
		}else{
			unset($input['salary_slip_first']);			
		}
		//Upload Slary Slip Second//
		if($request->hasfile('salary_slip_second')){
			
			$fileName_salary_slip_second = time().'.'.$request->salary_slip_second->extension();  

			$request->salary_slip_second->move(public_path('uploads/employee/'.$emp->id.'/salary_slip_second'), $fileName_salary_slip_second);
			
			$input['salary_slip_second'] = $fileName_salary_slip_second;
			
		}else{
			unset($input['salary_slip_second']);			
		}
		//Upload Slary Slip Third//
		if($request->hasfile('salary_slip_third')){
			
			$fileName_salary_slip_third = time().'.'.$request->salary_slip_third->extension();  

			$request->salary_slip_third->move(public_path('uploads/employee/'.$emp->id.'/salary_slip_third'), $fileName_salary_slip_third);
			
			$input['salary_slip_third'] = $fileName_salary_slip_third;
			
		}else{
			unset($input['salary_slip_third']);			
		}


		//dd($input, $emp);
		
        $emp->update($input);
		
		return redirect()->route('edit_employee_profile',['active_tab'=>$request->active_tab])
                        ->with('success','Employee Profile updated successfully');

    }
	
	public function employeeDetail(Request $request, $id)
    {
      $emp = Employee::find($id);
	  	
		$auth_user=Auth::user();
		$employeeData  =Employee::where('created_by','=',$auth_user->id)->get();
		
	$data['usersData'] =User::select('first_name','last_name')->orderBy('id','DESC')->get();
	$data['designation'] =Role::select('name')->orderBy('id','DESC')->get();

    $status = ['0'=>'Deactive','1'=>'Active'];
		
    $qualification = ['10th'=>'10th','12th'=>'12th','Graduate'=>'Graduate','Post Graduate'=>'Post Graduate','PHD'=>'PHD'];
		
    return view('employees.employee_detail',compact('status','qualification','emp', 'employeeData'),$data);
   }
   
   	public function employeeDetailUpdate(Request $request, $id)
    {
        $this->validate($request, [
/*          'name' => 'required',
            'email' => 'required|email|unique:employees,email,'.$id,
            'password' => 'same:confirm-password',
            'roles' => 'required' */
        ]);
    
        $input = $request->all();
		//dd($input);
		$employee = Employee::find($id);
				
		$input['other_company_name'] = json_encode($input['other_company_name']);
		$input['other_from_duration'] = json_encode($input['other_from_duration']);
		$input['other_to_duration'] = json_encode($input['other_to_duration']);
		$input['other_company_ctc'] = json_encode($input['other_company_ctc']);
		$input['other_document_name'] = json_encode($input['other_document_name']);
		
	    if(isset($input['other_offer_letter']) && is_array($input['other_offer_letter'])){
			
			$other_offer_letter_arr = $input['other_offer_letter'];
			
			$fileName_other_offer_letter_arr = [];
			
			foreach($other_offer_letter_arr as $other_offer_letter_val){
				
				if(!empty($other_offer_letter_val)){
					
				   $fileName_other_offer_letter = time().'.'.$other_offer_letter_val->extension();
				   
				   $other_offer_letter_val->move(public_path('uploads/employee/'.$employee->id.'/other_offer_letter'), $fileName_other_offer_letter);
				   
				   $fileName_other_offer_letter_arr[] = $fileName_other_offer_letter;
				}

			}

            $input['other_offer_letter'] = json_encode($fileName_other_offer_letter_arr);
			
		}
		
	   if(isset($input['other_relieving_letter']) && is_array($input['other_relieving_letter'])){
			
			$other_relieving_letter_arr = $input['other_relieving_letter'];
			
			$fileName_other_relieving_letter_arr = [];
			
			foreach($other_relieving_letter_arr as $other_relieving_letter_val){
				
				if(!empty($other_relieving_letter_val)){
					
				   $fileName_other_relieving_letter = time().'.'.$other_relieving_letter_val->extension();
				   
				   $other_relieving_letter_val->move(public_path('uploads/employee/'.$employee->id.'/other_relieving_letter'), $fileName_other_relieving_letter);
				   
				   $fileName_other_relieving_letter_arr[] = $fileName_other_relieving_letter;
				}

			}

            $input['other_relieving_letter'] = json_encode($fileName_other_relieving_letter_arr);
			
		}

	   if(isset($input['other_upload_document']) && is_array($input['other_upload_document'])){
			
			$other_upload_document_arr = $input['other_upload_document'];
			
			$fileName_other_upload_document_arr = [];
			
			foreach($other_upload_document_arr as $other_upload_document_val){
				
				if(!empty($other_upload_document_val)){
					
				   $fileName_other_upload_document = time().'.'.$other_upload_document_val->extension();
				   
				   $other_upload_document_val->move(public_path('uploads/employee/'.$employee->id.'/other_upload_document'), $fileName_other_upload_document);
				   
				   $fileName_other_upload_document_arr[] = $fileName_other_upload_document;
				}

			}

            $input['other_upload_document'] = json_encode($fileName_other_upload_document_arr);
			
		}

	     if($request->hasfile('company_offer_letter')){
			
			$fileName_company_offer_letter = time().'.'.$request->company_offer_letter->extension();  
			
			$input['company_offer_letter'] = $fileName_company_offer_letter;
			
		}
		
		if($request->hasfile('ten_board_school_document')){
			
			$fileName_ten_board_school_document = time().'.'.$request->ten_board_school_document->extension();  
			
			$input['ten_board_school_document'] = $fileName_ten_board_school_document;
			
		}
		if($request->hasfile('twelve_board_school_document')){
			
			$fileName_twelve_board_school_document = time().'.'.$request->twelve_board_school_document->extension();  
			
			$input['twelve_board_school_document'] = $fileName_twelve_board_school_document;
			
		}
		if($request->hasfile('graduate_board_school_document')){
			
			$fileName_graduate_board_school_document = time().'.'.$request->graduate_board_school_document->extension();  
			
			$input['graduate_board_school_document'] = $fileName_graduate_board_school_document;
			
		}
		if($request->hasfile('post_graduate_board_school_document')){
			
			$fileName_post_graduate_board_school_document = time().'.'.$request->post_graduate_board_school_document->extension();  
			
			$input['post_graduate_board_school_document'] = $fileName_post_graduate_board_school_document;
			
		}
		if($request->hasfile('phd_board_school_document')){
			
			$fileName_phd_board_school_document = time().'.'.$request->phd_board_school_document->extension();  
			
			$input['phd_board_school_document'] = $fileName_phd_board_school_document;
			
		}
		
		if($request->hasfile('company_relieving_letter')){
			
			$fileName_company_relieving_letter = time().'.'.$request->company_relieving_letter->extension();  
			
			$input['company_relieving_letter'] = $fileName_company_relieving_letter;
			
		}
		
		if($request->hasfile('salary_slip_first')){
			
			$fileName_salary_slip_first = time().'.'.$request->salary_slip_first->extension();  
			
			$input['salary_slip_first'] = $fileName_salary_slip_first;
			
		}
		if($request->hasfile('salary_slip_second')){
			
			$fileName_salary_slip_second = time().'.'.$request->salary_slip_second->extension();  
			
			$input['salary_slip_second'] = $fileName_salary_slip_second;
			
		}
		
		if($request->hasfile('salary_slip_third')){
			
			$fileName_salary_slip_third = time().'.'.$request->salary_slip_third->extension();  
			
			$input['salary_slip_third'] = $fileName_salary_slip_third;
			
		}

		if($request->hasfile('other_company_offer_letter')){
			
			$fileName_other_company_offer_letter = time().'.'.$request->other_company_offer_letter->extension();  

			$input['other_company_offer_letter'] = $fileName_other_company_offer_letter;
			
		}

        //12-10-23//
		if($request->hasfile('upload_aadhar_no')){
			
			$fileName_upload_aadhar_no = time().'.'.$request->upload_aadhar_no->extension();  

			$input['upload_aadhar_no'] = $fileName_upload_aadhar_no;
			
		}

         if($request->hasfile('upload_pan_no')){
			
			$fileName_upload_pan_no = time().'.'.$request->upload_pan_no->extension();  

			$input['upload_pan_no'] = $fileName_upload_pan_no;
			
		}
       //12-10-23//
	
        $employee->update($input);
		
		//12-10-23//
		if($request->hasfile('upload_aadhar_no')){
			$request->upload_aadhar_no->move(public_path('uploads/employee/'.$employee->id.'/upload_aadhar_no'), $fileName_upload_aadhar_no);
		}
		if($request->hasfile('upload_pan_no')){
			$request->upload_pan_no->move(public_path('uploads/employee/'.$employee->id.'/upload_pan_no'), $fileName_upload_pan_no);
		}

		//12-10-23//
		
		if($request->hasfile('company_offer_letter')){
			$request->company_offer_letter->move(public_path('uploads/employee/'.$employee->id.'/company_offer_letter'), $fileName_company_offer_letter);
		}
		
		if($request->hasfile('ten_board_school_document')){
			$request->ten_board_school_document->move(public_path('uploads/employee/'.$employee->id.'/ten_board_school_document'), $fileName_ten_board_school_document);
		}
		
		if($request->hasfile('twelve_board_school_document')){
			$request->twelve_board_school_document->move(public_path('uploads/employee/'.$employee->id.'/twelve_board_school_document'), $fileName_twelve_board_school_document);
		}
		if($request->hasfile('graduate_board_school_document')){
			$request->graduate_board_school_document->move(public_path('uploads/employee/'.$employee->id.'/graduate_board_school_document'), $fileName_graduate_board_school_document);
		}
		
		if($request->hasfile('post_graduate_board_school_document')){
			$request->post_graduate_board_school_document->move(public_path('uploads/employee/'.$employee->id.'/post_graduate_board_school_document'), $fileName_post_graduate_board_school_document);
		}
		if($request->hasfile('phd_board_school_document')){
			$request->phd_board_school_document->move(public_path('uploads/employee/'.$employee->id.'/phd_board_school_document'), $fileName_phd_board_school_document);
		}
		
		if($request->hasfile('company_relieving_letter')){
			$request->company_relieving_letter->move(public_path('uploads/employee/'.$employee->id.'/company_relieving_letter'), $fileName_company_relieving_letter);
		}
		if($request->hasfile('salary_slip_first')){
			$request->salary_slip_first->move(public_path('uploads/employee/'.$employee->id.'/salary_slip_first'), $fileName_salary_slip_first);
		}
		if($request->hasfile('salary_slip_second')){
			$request->salary_slip_second->move(public_path('uploads/employee/'.$employee->id.'/salary_slip_second'), $fileName_salary_slip_second);
		}
		if($request->hasfile('salary_slip_third')){
			$request->salary_slip_third->move(public_path('uploads/employee/'.$employee->id.'/salary_slip_third'), $fileName_salary_slip_third);
		}

		if($request->hasfile('other_company_offer_letter')){
			$request->other_company_offer_letter->move(public_path('uploads/employee/'.$employee->id.'/other_company_offer_letter'), $fileName_other_company_offer_letter);
		}


        return redirect()->route('employees.index')
                        ->with('success','Employee updated successfully');
   }
   
   public function addEmployeeComment(Request $request, $id){
	   
	   $auth_user = Auth::user();
	   
	   $input     = $request->all();
	   
	   $input['emp_id'] = $id;
	   $input['created_by'] = $auth_user->id;
	 
	   EmployeeComment::create($input);
	   
	   return back()->with('success','Employee comment added successfully');
   }

   public function employeeVerify(Request $request, $id){
	 
	   $empData= Employee::find($id);
	
	   $empData->update(['final_verified'=>'Verified']);

	   return back()->with('success','Employee Verified Successfully');
   }
	
	
}
