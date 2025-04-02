<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Employee;
use App\Models\Task;
use App\Models\TaskComment;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Arr;
use Illuminate\View\View;
use App\Models\HasApiTokens;
use Illuminate\Http\RedirectResponse;
use Illuminate\Database\Eloquent\Builder;
use Auth;
use DB;
use Hash;


class TaskController extends Controller
{
   public function index(Request $request): View
    {
		
	    $per_page  = 10;
		
		$auth_user = Auth::user();
		
		$is_admin  = $auth_user->for;
		
		$is_designation  = $auth_user->designation;
		
    //18-09-2024
 /*	 01-03-2025 if($is_admin == 'super_admin'){
        
         $employeeData1   = User::where('for','=','employee')
                                 ->where('status','!=',0)
				                 ->whereNull('deleted_at')
                                 ->orderBy('id','DESC')->get();
          
        }
		
        else{
            
         $employeeData1 = User::where('for','=','employee')
			   
					    ->where(function ($query) use ($auth_user){ 
						    $query->where('created_by','=',$auth_user->id)
							->orWhere('managed_by','=',$auth_user->id)
							->orWhere('id','=',$auth_user->id)
							->where('status','!=',0)
				            ->whereNull('deleted_at');
					    })->orderBy('id','DESC')
						   
					->get();
            
            } 
			
		if($is_admin == 'super_admin'){
			
			  $employeeData      = Employee::where('status','!=',0)
				                             ->whereNull('deleted_at')
				                             ->orderBy('id','DESC')
				                             ->get();
					
				}else{
					
			   $employeeData      = Employee::where('managed_by','=',$auth_user->id)
			                                  ->where('status','!=',0)
				                              ->whereNull('deleted_at')
				                              ->orderBy('id','DESC')
			                                  ->get();
			 
			} 
			
			*/
			
	
		  if($is_admin == 'super_admin' || $is_designation == 'HR Manager'){
	       
	       $employeeData1 = User::where('status','!=',0)
	                            ->where('for','=','employee')
				                 ->whereNull('deleted_at')
			                     ->orderBy('id','DESC')
								 ->get();
			
		   }else{
		
	        $user_ids = User::where('created_by','=',$auth_user->id)->orWhere('managed_by','=',$auth_user->id)->pluck('id')->toArray();
			          
			array_push($user_ids,$auth_user->id);
			
			$user_ids2 = User::whereIn('created_by',$user_ids)->orWhereIn('managed_by',$user_ids)->pluck('id')->toArray();
		      
			array_push($user_ids2,$auth_user->id);

	     
	      
		   $employeeData1 = User::whereIn('managed_by',$user_ids2)
			                     ->where('for','=','employee')
							    // ->orWhereIn('created_by',$user_ids2)
		                         ->where('status','!=',0)
								 //->where('id','!=',$auth_user->id)
				                 ->whereNull('deleted_at')
			                     ->orderBy('id','DESC')
			                     ->get(); 
	       // dd($user_ids,$user_ids2,$employeeData);
	}
	
		
		  
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
			
		
		
    //18-09-2024
		
		
		$taskData  = Task::select('tasks.*', 'users.first_name as firstName', 'users.last_name as lastaName','employees.first_name as empFirstName','employees.last_name as empLastName')
		                   ->leftjoin('users', 'users.id', 'tasks.created_by')
		                   ->leftjoin('employees', 'employees.id', 'tasks.task_assign_to')
						   
						   ->when($request->status,function (Builder $builder) use ($request) {
                               
							   if($request->status == 'Pending'){
								   $status = '0';
							   }elseif($request->status == 'Close'){
								   $status = '1';
							   }
								$builder->where('tasks.status', '=', $status); 
							  
								 
							 }
						    )
							->when($request->task_assign_to,function (Builder $builder) use ($request) {

							
								$builder->where('tasks.task_assign_to', '=', $request->task_assign_to); 
							
								 
							 }
						    )
							
							->when($request->task_assign_by,function (Builder $builder) use ($request) {

							 
								$builder->where('tasks.created_by', '=', $request->task_assign_by); 
							  
								 
							 }
						    )

		                   ->orderBy('tasks.id','DESC');
						   //->get()->toArray();
						   
						   //dd($auth_user->id,);
						   
						if($is_admin == 'super_admin'){
							
						$data = $taskData->paginate($per_page);
							
						}else{
							
						$data = $taskData->where('tasks.task_assign_to','=',$auth_user->emp_id)
						        ->orWhere(function ($query) use($request,$auth_user) {
                                    $query->where('tasks.created_by','=',$auth_user->id)
							        ->when($request->status,function (Builder $builder) use ($request) {
                               
									   if($request->status == 'Pending'){
										   $status = '0';
									   }elseif($request->status == 'Close'){
										   $status = '1';
									   }
										$builder->where('tasks.status', '=', $status); 
									   
									 }
									)
									->when($request->task_assign_to,function (Builder $builder) use ($request) {

										$builder->where('tasks.task_assign_to', '=', $request->task_assign_to); 
									 
									 }
									)
									
									->when($request->task_assign_by,function (Builder $builder) use ($request) {

										$builder->where('tasks.created_by', '=', $request->task_assign_by); 
										 
									 }
									);
									  
								})
											   
							->paginate($per_page);	
						}
				$requested_input = $request->all();	
				
                return view('tasks.index',compact('data','employeeData','employeeData1','requested_input'))
                        ->with('i', ($request->input('page', 1) - 1) * $per_page);
		
		
//07-11-2023

  
    } 
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
	 
    public function create(): View
    {
		
      $auth_user = Auth::user();
	
	  $is_admin  = $auth_user->for;
	  
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
	  
	  
/*	   if($is_admin == 'super_admin'){
			
			  $employeeData  = Employee::where('status','!=',0)
				                             ->whereNull('deleted_at')
				                             ->orderBy('id','DESC')
			                                 ->get();
					
				}else{
					
			   $employeeData   = Employee::where('managed_by','=',$auth_user->id)
			                                  ->where('status','!=',0)
				                              ->whereNull('deleted_at')
				                              ->orderBy('id','DESC')
			                                  ->get();
			 
			} 
			
			*/
	
	/* 	if($is_admin == 'super_admin'){
        
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
            
            } */
	
	  // $employeeData = Employee::where('created_by','=',$auth_user->id)->get();
      
	   
       $status = ['0'=>'Pending','1'=>'Close'];
      
       return view('tasks.create',compact('employeeData'));
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
          // 'name' => 'required',
          //  'email' => 'required|email|unique:employees,email',
          //  'password' => 'required|same:confirm-password',
          //  'roles' => 'required'
        ]);
    
        $input     = $request->all();
		
		$auth_user = Auth::user();
		
        $input['created_by'] = $auth_user->id;
       
        $task = Task::create($input);
		
        return redirect()->route('tasks.index')
                        ->with('success','Task created successfully');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id): View
    {
            $taskID = Task::find($id);
		
		    $task  = Task::select('tasks.*', 'users.first_name as firstName', 'users.last_name as lastaName','employees.first_name as empFirstName','employees.last_name as empLastName')
		                   ->leftjoin('users', 'users.id', 'tasks.created_by')
		                   ->leftjoin('employees', 'employees.id', 'tasks.task_assign_to')
		                   ->where('tasks.id','=',$id)
						   ->orderBy('tasks.id','DESC')
						   ->first();

	        $taskCommentData = TaskComment::select('task_comments.*', 'users.first_name', 'users.last_name')
		                   ->leftjoin('users', 'users.id', 'task_comments.created_by')
		                   ->where('task_comments.task_id', '=', $id)->get();			   
	
		//dd($taskCommentData);
        return view('tasks.show',compact('task','taskCommentData'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id): View
    {
         $task         = Task::find($id);
         
         $auth_user    = Auth::user();
	
	     $is_admin     = $auth_user->for;
	     
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
							//	 ->where('id','!=',$auth_user->id)
				                 ->whereNull('deleted_at')
			                     ->orderBy('id','DESC')
			                     ->get(); 
	       // dd($user_ids,$user_ids2,$employeeData);
	}
	  
	 /*    if($is_admin == 'super_admin'){
			
			    $employeeData  = Employee::where('status','!=',0)
				                          ->whereNull('deleted_at')
				                          ->orderBy('id','DESC')
			                              ->get();
					
				}else{
					
			   $employeeData   = Employee::where('created_by','=',$auth_user->id)
			                               ->where('status','!=',0)
				                           ->whereNull('deleted_at')
				                           ->orderBy('id','DESC')
			                               ->get();
			 
			}
			
			*/
	    
		// $employeeData  = Employee::where('created_by','=',$auth_user->id)->get();
		
	   // 11-03-2025 for hold value after search data hold 
		
        $request         = request();
		
        $requested_input = $request->all();
		
	   // 11-03-2025 for hold value after search data hold
		
		 $status = ['0'=>'Pending','1'=>'Close'];
    
         return view('tasks.edit',compact('task','status','employeeData','requested_input'));
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
           // 'name' => 'required',
           // 'email' => 'required|email|unique:tasks,email,'.$id,
           // 'password' => 'same:confirm-password',
           // 'roles' => 'required'
        ]);
    
        $input = $request->all();
        
    // 11-03-2025 for hold value after search data hold in search
        
		 $requested_input = []; 
         
         foreach($input as $req_key => $req_val){
             
             if(str_contains($req_key, 'req_')){
                 
                 unset($input[$req_key]);
                 $req_key = str_replace("req_","",$req_key);
                 $requested_input[$req_key] = $req_val;
				 //dd($requested_input);
             }            
         }
		
		// 11-03-2025 for hold value after search data hold in search
        
		$auth_user = Auth::user();
        $input['created_by'] = $auth_user->id;
		
		//$input['task_comment']    = $request->task_comment;
		//$input['status']          = $request->status;
		$task = Task::find($id);
		//dd($input);
		$task_data = [
                      'task_comment'   => $input['task_comment'],
                      'task_close_date'   => $input['task_close_date'],
                      'status'         => $input['status'], 
                    ];
        $task->update($task_data);
		$task_comments = [
                      'task_id'      => $id, 
                      'created_by'   => $input['created_by'],
                      'comment'      => $input['task_comment'], 
                      'status'       => $input['status'], 
                    ];
        //dd($task_comments);       
        $tasks= TaskComment::create($task_comments);
		
        return redirect()->route('tasks.index',$requested_input)
                        ->with('success','Task updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id): RedirectResponse
    {
        Task::find($id)->delete();
        
        return redirect()->route('tasks.index')
                        ->with('success','task deleted successfully');
    }
	
 
	 
   public function asignTask()
     {
       
        return view('tasks.assign_task');
        
     }
	 
  public function addTaskComment(Request $request, $id){
	   
	   $auth_user = Auth::user();
	   
	   $input     = $request->all();
	   
	   $input['task_id'] = $id;
	   
	   $input['created_by'] = $auth_user->id;
	 
	   TaskComment::create($input);
	   
	   return back()->with('success','Employee comment added successfully');
   }
	
	
}