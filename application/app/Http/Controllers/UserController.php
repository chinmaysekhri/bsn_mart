<?php
    
namespace App\Http\Controllers;
    
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\UserComment;
use App\Models\EmployeeComment;
use App\Models\Employee;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Arr;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Database\Eloquent\Builder;
use Auth;
use App\Exports\UsersExport;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;
use Mail;
use App\Mail\RegisterMail;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Validator;
use Session;

class UserController extends Controller
{
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index','show']]);
         $this->middleware('permission:user-create', ['only' => ['create','store']]);
         $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request): View
    {

	    $per_page = 15;
		
		$auth_user = Auth::user();
		
		$is_admin = $auth_user->for;
		
		$data_collection = User::when($request->q,function (Builder $builder) use ($request) {
							$builder->where('first_name', 'like', "%{$request->q}%")
							->orWhere('last_name', 'like', "%{$request->q}%")
							->orWhere('email', 'like', "%{$request->q}%")
							->orWhere('contact', 'like', "%{$request->q}%")
							->orWhere('alt_contact', 'like', "%{$request->q}%")
							->orWhere('address', 'like', "%{$request->q}%")
							->orWhere('address', 'like', "%{$request->q}%");
					       }
					    )
						->orderBy('id','DESC');	
						
						if($is_admin == 'super_admin'){
							
						$data=$data_collection->paginate($per_page);
							
						}else{
							
						$data=$data_collection->where('managed_by','=',$auth_user->id)	
						
						->orWhere('created_by','=',$auth_user->id)->paginate($per_page);	
						}
					
                return view('users.index',compact('data'))
                        ->with('i', ($request->input('page', 1) - 1) * $per_page);
	 
	   
/* 	13-102023	$per_page = 10;
		
		$data = User::when($request->q,function (Builder $builder) use ($request) {
							$builder->where('first_name', 'like', "%{$request->q}%")
							->orWhere('last_name', 'like', "%{$request->q}%")
							->orWhere('email', 'like', "%{$request->q}%")
							->orWhere('contact', 'like', "%{$request->q}%")
							->orWhere('alt_contact', 'like', "%{$request->q}%")
							->orWhere('address', 'like', "%{$request->q}%")
							->orWhere('address', 'like', "%{$request->q}%");
					       }
					    )
					->orderBy('id','DESC')->paginate($per_page);
					
                return view('users.index',compact('data'))
                   ->with('i', ($request->input('page', 1) - 1) * $per_page); */
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        $auth_user         = Auth::user();
		
		$employeeData      = Employee::where('created_by','=',$auth_user->id)->get();

		$data['usersData'] = User::select('first_name','last_name')->orderBy('id','DESC')->get();
		
		$roles = Role::pluck('name','name')->all();
		
        $status = ['0'=>'Deactive','1'=>'Active'];   
		
        return view('users.create',compact('roles','status' ,'employeeData'),$data);
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
		
            'first_name'  => 'required',
            'last_name'   => 'required',
            'email'       => 'required|email|unique:users,email',
           // 'password'    => 'required|same:confirm-password',
            //'roles'       => 'required'
        ]);
    
        $input = $request->all();
		//dd($input);
		
		    $auth_user=Auth::user();
		
            $input['created_by'] = $auth_user->id;
			
		    $input['for'] ='normal_user';
			
            $input['password'] = Hash::make($input['mobile']);
		
			if($request->hasfile('cheque_copy')){
					
			$fileName_cheque_copy = time().'.'.$request->cheque_copy->extension();  

			$request->cheque_copy->move(public_path('uploads/users/cheque/'), $fileName_cheque_copy);
			
			$input['cheque_copy'] = $fileName_cheque_copy;
		   }
		   
		  if($request->hasfile('contract_img')){
					
			$fileName_contract_img = time().'.'.$request->contract_img->extension();  

			$request->contract_img->move(public_path('uploads/users/contract_img/'), $fileName_contract_img);
			
			$input['contract_img'] = $fileName_contract_img;
		   }
		  
           if($request->hasfile('upload_aadhar_no')){
					
			$fileName_upload_aadhar_no = time().'.'.$request->upload_aadhar_no->extension();  

			$request->upload_aadhar_no->move(public_path('uploads/users/upload_aadhar_no/'), $fileName_upload_aadhar_no);
			
			$input['upload_aadhar_no'] = $fileName_upload_aadhar_no;
		}
		
         if($request->hasfile('upload_pan_no')){
					
			$fileName_upload_pan_no = time().'.'.$request->upload_pan_no->extension();  

			$request->upload_pan_no->move(public_path('uploads/users/upload_pan_no/'), $fileName_upload_pan_no);
			
			$input['upload_pan_no'] = $fileName_upload_pan_no;
		}
		
        if($request->hasfile('upload_gst_no')){
					
			$fileName_upload_gst_no = time().'.'.$request->upload_gst_no->extension();  

			$request->upload_gst_no->move(public_path('uploads/users/upload_gst_no/'), $fileName_upload_gst_no);
			
			$input['upload_gst_no'] = $fileName_upload_gst_no;
		}
    
        $user = User::create($input);
		//mail send 12-09-2023
		$mailData = [
            'title' => 'Thank You for Visiting Our Website',
            'body' => "I hope this message finds you well. We want to express our gratitude for visiting our website. Your interest in our product means a lot to us, and we're excited to have the opportunity to connect with you.' ",
			
            'user_id' => $input['email'],
			
            'password' => $input['mobile'],
        ];
         
       // Mail::to($input['email'])->send(new RegisterMail($mailData));
         
	   // mail send End 12-09-2023 
		
       // dd("Email is sent successfully.");
		
        $user->assignRole(['Customer']);
     
        return redirect()->route('users.index')
                        ->with('success','User created successfully');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id): View
    {
		
		$auth_user  = Auth::user();
        $user       = User::find($id);
	    $user_emp   = User::where('id','=',$user->created_by)->first();
		
		
		//dd($user_emp_manage)
		
		if($user->managed_by == 'self'){
			
			if($user->for == 'company'){
				$user_emp_manage = Company::where('id','=',$user->company_id)->first();
			}elseif($user->for == 'employee'){
				$user_emp_manage = Employee::where('id','=',$user->emp_id)->first();
			}else{
				$user_emp_manage = User::where('id','=',$user->created_by)->first();
			}
			
		}else{
			$user_emp_manage = Employee::where('id','=',$user->managed_by)->first();
		}
		 
	// dd($user_emp_manage, $user);
		$user_comments = UserComment::select('user_comments.*', 'users.first_name', 'users.last_name')
		                 ->leftjoin('users', 'users.id', 'user_comments.created_by')
		                 ->where('user_comments.user_id', '=', $id)->get();
		//dd($emp_comments);
		
        return view('users.show',compact('user','user_emp','user_emp_manage','user_comments'));
    }
	
	 public function addUserComment(Request $request, $id){
	   
	   $auth_user           = Auth::user();
	   $input               = $request->all();
	   $input['user_id']    = $id;
	   $input['created_by'] = $auth_user->id;
	  // dd($input);
	   UserComment::create($input);
	   
	   return back()->with('success','User comment added successfully');
   }
	
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id): View
    {
		
		$auth_user    = Auth::user();		
        $user         = User::find($id);
		$employeeData = Employee::where('created_by','=',$auth_user->id)->get();
        $roles        = Role::pluck('name','name')->all();
        $userRole     = $user->roles->pluck('name','name')->all();
		$status       = ['0'=>'Deactive','1'=>'Active'];
    
        return view('users.edit',compact('user','employeeData','roles','userRole','status'));
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
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            //'password' => 'same:confirm-password',
            // 'roles' => 'required'
        ]);
    
          $input = $request->all();
          //dd($input);
		  $auth_user=Auth::user();
		
          $input['created_by'] = $auth_user->id;
		  
		 // $input['for'] ='normal_user';
		
     /*    if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
          $input = Arr::except($input,array('password'));    
        } */
    
	   /*  if($request->hasfile('cheque_copy')){
					
			$fileName_cheque_copy = time().'.'.$request->cheque_copy->extension();  

			$request->cheque_copy->move(public_path('uploads/users/cheque/'), $fileName_cheque_copy);
			
			$input['cheque_copy'] = $fileName_cheque_copy;
		}else{
			
			unset($input['cheque_copy']);
		} */
		
		
		if($request->hasfile('cheque_copy')){
					
			$fileName_cheque_copy = time().'.'.$request->cheque_copy->extension();  

			$request->cheque_copy->move(public_path('uploads/users/cheque/'), $fileName_cheque_copy);
			
			$input['cheque_copy'] = $fileName_cheque_copy;
		   }
		   
		   if($request->hasfile('contract_img')){
					
			$fileName_contract_img = time().'.'.$request->contract_img->extension();  

			$request->contract_img->move(public_path('uploads/users/contract_img/'), $fileName_contract_img);
			
			$input['contract_img'] = $fileName_contract_img;
		   }
		
		
		if($request->hasfile('upload_aadhar_no')){
					
			$fileName_upload_aadhar_no = time().'.'.$request->upload_aadhar_no->extension();  

			$request->upload_aadhar_no->move(public_path('uploads/users/upload_aadhar_no/'), $fileName_upload_aadhar_no);
			
			$input['upload_aadhar_no'] = $fileName_upload_aadhar_no;
		}else{
			
			unset($input['upload_aadhar_no']);
		}
		
         if($request->hasfile('upload_pan_no')){
					
			$fileName_upload_pan_no = time().'.'.$request->upload_pan_no->extension();  

			$request->upload_pan_no->move(public_path('uploads/users/upload_pan_no/'), $fileName_upload_pan_no);
			
			$input['upload_pan_no'] = $fileName_upload_pan_no;
		}
		else{
			unset($input['upload_pan_no']);
		}
          if($request->hasfile('upload_gst_no')){
					
			$fileName_upload_gst_no = time().'.'.$request->upload_gst_no->extension();  

			$request->upload_gst_no->move(public_path('uploads/users/upload_gst_no/'), $fileName_upload_gst_no);
			
			$input['upload_gst_no'] = $fileName_upload_gst_no;
		}else{
			unset($input['upload_gst_no']);
		}
		
		
        $user = User::find($id);
        $user->update($input);
		
        DB::table('model_has_roles')->where('model_id',$id)->delete();
    
        $user->assignRole(['Customer']);
    
        return redirect()->route('users.index')
                        ->with('success','User updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id): RedirectResponse
    {
        User::find($id)->delete();
        return redirect()->route('users.index')
                        ->with('success','User deleted successfully');
    }
	
   public function profile()
     {
       $auth_user = Auth::user();
	    
	   $user = User::find($auth_user->id);
	   
        return view('users.profile',compact('user'));
        
     }

	 public function viewProfile()
     {
       $auth_user = Auth::user();
	    
	   $user = User::find($auth_user->id);
	   
       return view('users.view_profile',compact('user'));
        
     }
	 
    public function update_profile(Request $request, $id)
      {
		$input = $request->all();

		if($request->hasfile('profile_img')){
			
			$fileName_profile_img = time().'.'.$request->profile_img->extension();  

			$request->profile_img->move(public_path('uploads/users/profile'), $fileName_profile_img);
			
			$input['profile_img'] = $fileName_profile_img;
			
		}else{
			unset($input['profile_img']);			
		}
		
	    if($request->hasfile('cheque_copy')){
			
			$fileName_cheque_copy = time().'.'.$request->cheque_copy->extension();  

			$request->cheque_copy->move(public_path('uploads/users/cheque'), $fileName_cheque_copy);
			
			$input['cheque_copy'] = $fileName_cheque_copy;
			
		}else{
			unset($input['cheque_copy']);			
		}
		
		if($request->hasfile('contract_img')){
			
			$fileName_contract_img = time().'.'.$request->contract_img->extension();  

			$request->contract_img->move(public_path('uploads/users/contract_img'), $fileName_contract_img);
			
			$input['contract_img'] = $fileName_contract_img;
			
		}else{
			unset($input['contract_img']);			
		}

         //Adhar//
		 if($request->hasfile('upload_aadhar_no')){
			
			$fileName_upload_aadhar_no = time().'.'.$request->upload_aadhar_no->extension();  

			$request->upload_aadhar_no->move(public_path('uploads/users/upload_aadhar_no'), $fileName_upload_aadhar_no);
			
			$input['upload_aadhar_no'] = $fileName_upload_aadhar_no;
			
		}else{
			unset($input['upload_aadhar_no']);			
		}
		//Pan//
		 if($request->hasfile('upload_pan_no')){
			
			$fileName_upload_pan_no = time().'.'.$request->upload_pan_no->extension();  

			$request->upload_pan_no->move(public_path('uploads/users/upload_pan_no'), $fileName_upload_pan_no);
			
			$input['upload_pan_no'] = $fileName_upload_pan_no;
			
		}else{
			unset($input['upload_pan_no']);			
		}
		//GST//
		if($request->hasfile('upload_gst_no')){
			
			$fileName_upload_gst_no = time().'.'.$request->upload_gst_no->extension();  

			$request->upload_gst_no->move(public_path('uploads/users/upload_gst_no'), $fileName_upload_gst_no);
			
			$input['upload_gst_no'] = $fileName_upload_gst_no;
			
		}else{
			unset($input['upload_gst_no']);			
		}
		
        $user = User::find($id);
        $user->update($input);

        return redirect()->route('profile')
                        ->with('success','Profile updated successfully');
    }
	
    /**
    * @return \Illuminate\Support\Collection
    */
    public function export() 
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }
       
    /**
    * @return \Illuminate\Support\Collection
    */
    public function import() 
    {
        Excel::import(new UsersImport,request()->file('file'));
               
        return back();
    }
	
	
	// profile pages
	
    public function employeeProfile()
    {
        
        return view('users.employee_profile');
    } 
	
	public function customerProfile()
    {
        
        return view('users.customer_profile');
    }
	
	public function companyProfile()
    {
        
        return view('users.company_profile');
    }
	
	
	public function changePassword()
    {
        
        return view('users.change_password');
    }
		
	public function updatePassword(Request $request)
    {
	$request->validate([
		'current_password' => ['required', new MatchOldPassword],
		'new_password'     => ['required'],
		'new_confirm_password' => ['same:new_password'],
     ]);   
	    User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
			 $request->session()->flash('password','Password changed successfully !!');
			 return view('users.change_password');
    }
 
 
 //Date-03-08-2024
   public function usersResetPassword()
    {
        
        return view('users.reset_password');
    }
		
	public function updateResetPassword(Request $request)
    {
	$request->validate([
		//'current_password' => ['required', new MatchOldPassword],
		'email'                => ['required'],
		'new_password'         => ['required'],
		'new_confirm_password' => ['same:new_password'],
     ]);   
	   // User::update(['email'=>$request->email,'password'=> Hash::make($request->new_password)]);
		  User::where('email', $request->email)
                       ->update(['password' => Hash::make($request->new_password)]);
		
			  $request->session()->flash('password','Password Resset Successfully !!');
			  return view('users.reset_password');
    }
	
	
}