<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\User;
use App\Models\Ledger;
use App\Models\ProspectiveBuyer;
use App\Models\Buyerapplication;
use App\Models\Categories;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use App\Models\Employee;
use App\Models\ProspectiveBuyerComment;
use Auth;
use DB;
use Hash;
use App\Models\HasApiTokens;
use Mail;
use App\Mail\RegisterMail;

class ProspectiveBuyerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
  
    function __construct()
    {
         $this->middleware('permission:prospective-buyer-list|prospective-buyer-create|prospective-buyer-edit|prospective-buyer-delete', ['only' => ['index','store']]);
         $this->middleware('permission:prospective-buyer-create', ['only' => ['create','store']]);
         $this->middleware('permission:prospective-buyer-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:prospective-buyer-delete', ['only' => ['destroy']]);
    }
    
    public function index(Request $request): View
    {
         $per_page  = 25;
     
         $auth_user = Auth::user();
    
         $is_admin  = $auth_user->for;
		 		
		//08-02-2025 Start
		
		/* 01-03-2025  if($is_admin == 'super_admin'){
				
			  $teamData = User::where('for','=','employee')
			                      //->orWhere('for','=','super_admin')
			                      ->where('status','!=','0')
				                  ->whereNull('deleted_at')
			                      ->orderBy('id','DESC')
								  ->get();
					
			}else{
					
			 $teamData = User::where('for','=','employee')
			                           ->where(function ($query) use ($auth_user){ 
                                        $query->where('created_by','=',$auth_user->id)
			                            ->orWhere('managed_by','=',$auth_user->id);
                                        })->where('status','!=',0)
				                        ->whereNull('deleted_at')
										->orderBy('id','DESC')
			                            ->get();
			   
			  }*/
			  
		 $is_designation  = $auth_user->designation;
		  
		  if($is_admin == 'super_admin' || $is_designation == 'HR Manager'){
	       
		   
	       $teamData = User::where('status','!=',0)
	                             ->where('for','=','employee')
				                 ->whereNull('deleted_at')
			                     ->orderBy('id','DESC')
								 ->get();
			
		   }else{
		
	        $user_ids = User::where('created_by','=',$auth_user->id)->orWhere('managed_by','=',$auth_user->id)->pluck('id')->toArray();
			          
			array_push($user_ids,$auth_user->id);
			
			$user_ids2 = User::whereIn('created_by',$user_ids)->orWhereIn('managed_by',$user_ids)->pluck('id')->toArray();
		      
			array_push($user_ids2,$auth_user->id);

		    $teamData = User::whereIn('managed_by',$user_ids2)
			                     ->where('for','=','employee')
							    // ->orWhereIn('created_by',$user_ids2)
		                         ->where('status','!=',0)
								 //->where('id','!=',$auth_user->id)
				                 ->whereNull('deleted_at')
			                     ->orderBy('id','DESC')
			                     ->get(); 
	       
	        }	  
			  
		 //08-02-2025  End
		 
		 
		 //08-02-2025 Assign To employee Start
		 
		 if($is_admin == 'super_admin' || $is_designation == 'HR Manager'){
	       
		   $assignEmployeeData = User::where('status','!=',0)
		                         ->where('for','=','employee')
				                 ->whereNull('deleted_at')
			                     ->orderBy('id','DESC')
								 ->get();
			
		   }else{
		
	        $user_ids = User::where('created_by','=',$auth_user->id)->orWhere('managed_by','=',$auth_user->id)->pluck('id')->toArray();
			          
			array_push($user_ids,$auth_user->id);
			
			$user_ids2 = User::whereIn('created_by',$user_ids)->orWhereIn('managed_by',$user_ids)->pluck('id')->toArray();
		      
			array_push($user_ids2,$auth_user->id);

	     
		   $assignEmployeeData = User::whereIn('managed_by',$user_ids2)
			                     ->where('for','=','employee')
							    // ->orWhereIn('created_by',$user_ids2)
		                         ->where('status','!=',0)
								 ->where('id','=',$auth_user->id)
				                 ->whereNull('deleted_at')
			                     ->orderBy('id','DESC')
			                     ->get();
	        } 
		 
		 
	/* 01-03-2025	 if($is_admin == 'super_admin'){
            
         $assignEmployeeData = User::where('for','=','employee')
		                      ->where('status','!=',0)
				              ->whereNull('deleted_at')
							  ->orderBy('id','DESC')->get();
        }
        elseif($is_admin == 'employee'){
           
         $assignEmployeeData = User::where('for','=','employee')->where('managed_by','=',$auth_user->id)
                             ->orWhere('created_by','=',$auth_user->id)
					         ->where('status','!=',0)
				             ->whereNull('deleted_at')
					         ->orderBy('id','DESC')->get();  
           
       }*/
		 //08-02-2025 Assign To employee End
		
		 
		 
     //dd($is_admin);
         $employeeData = Employee::where('created_by','=',$auth_user->id)->orderBy('id','DESC')->get();
     
         $data = ProspectiveBuyer::when($request->updated_q,function (Builder $builder) use ($request) {
                    $builder->where('contact', '=', $request->updated_q)
                            ->orWhere('business_name', '=', $request->updated_q)
                            ->orWhere('email', '=', $request->updated_q)
                            ->orWhere('pin_code', '=', $request->updated_q)
                            ->orWhere('id', '=', $request->updated_q);
                 }
              )
        ->when($request->today_applied_on,function (Builder $builder) use ($request) {
        // dd($request->today_applied_on,$request->all());
         if(!empty($request->today_applied_on)){
            $builder->whereDate('created_at', '=', $request->today_applied_on); 
          }
             
                 }
              )
        ->when($request->today_updated_on,function (Builder $builder) use ($request) {
        if(!empty($request->today_updated_on)){  
              $builder->whereDate('updated_at', '=', $request->today_updated_on);
        }
        
                 }
              )
        ->when($request->today_next_action,function (Builder $builder) use ($request) {
          
          if(!empty($request->today_next_action)){
              $builder->whereDate('date_of_enrollment', '=', $request->today_next_action);
          }
                 }
              )
         ->when($request->today_applied_from,function (Builder $builder) use ($request) {
             
           //dd($request->today_applied_from,$request->all());
           
           if(!empty($request->today_applied_from)){
               
              $builder->whereDate('created_at', '>=', $request->today_applied_from);
              }
            }
        )
              
          ->when($request->today_applied_to,function (Builder $builder) use ($request) {
          
           if(!empty($request->today_applied_to)){
              $builder->whereDate('created_at', '<=', $request->today_applied_to);
                }
            }
        )    
        
       ->when($request->today_applied_status,function (Builder $builder) use ($request) {
         
      if(!empty($request->today_applied_status)){
		  
              $builder->where('status_name', '=',$request->today_applied_status);
         }
                 }
              )
        ->when($request->today_updated_from,function (Builder $builder) use ($request) {
           
       if(!empty($request->today_updated_from)){
              $builder->whereDate('updated_at', '>=', $request->today_updated_from);
           }
                 }
              )
              
         ->when($request->today_updated_to,function (Builder $builder) use ($request) {
           
          if(!empty($request->today_updated_to)){
              $builder->whereDate('updated_at', '<=', $request->today_updated_to);
            }
                 }
              )    
        
       ->when($request->updated_q,function (Builder $builder) use ($request) {
         
      if(!empty($request->updated_q)){
               $builder->where('contact', '=', $request->updated_q)
                            ->orWhere('business_name', '=', $request->updated_q)
                            ->orWhere('email', '=', $request->updated_q)
                            ->orWhere('pin_code', '=', $request->updated_q)
                            ->orWhere('id', '=', $request->updated_q);
                  }
				  
                 }
              )
			  
			//  dd($request->updated_q);
        
            ->when($request->next_action_from,function (Builder $builder) use ($request) {
                
               //dd($request->next_action_from,$request->next_action_to);
               
              if(!empty($request->next_action_from)){
                      $builder->whereDate('date_of_enrollment', '>=', $request->next_action_from);
                              
                   }
                 }
              )  
              
             ->when($request->next_action_to,function (Builder $builder) use ($request) {
                
                if(!empty($request->next_action_to)){
                      $builder->whereDate('date_of_enrollment', '<=', $request->next_action_to);
                   }
                 }
              )   
              
              
		//08-02-2025 
         ->when($request->team_member_data,function (Builder $builder) use ($request) {
           
           if(!empty($request->team_member_data)){
                      $builder->where('created_by', '=', $request->team_member_data);
                              //->orWhere('managed_by', '=', $request->team_member_data);
                    }
                 }
              )
      
	     //08-02-2025 
		 
         // ->orderBy('id','DESC')->paginate($per_page);
		 
		// ->where('web_status', '!=', 'prospective_buyer_data_assigned') 
         
           ->orderBy('id','DESC');
           
          // dd($request->all(), $data->toSql());
      
      if($is_admin == 'super_admin'){
              
            $prosBuyerData = $data->paginate($per_page)->appends($request->query());
              
            }else{
              
            //$data = $taskData->where('tasks.task_assign_to','=',$auth_user->emp_id)->paginate($per_page); 
            
            $prosBuyerData = $data->where('created_by','=',$auth_user->id)
			
			//12-02-2025
			
			->orWhere(function ($filtered_table) use ($request,$auth_user){ 
			  
			 $filtered_table->where('assign_to','=',$auth_user->id)
			 
		//05-03-2025
			 
			->when($request->today_applied_on,function (Builder $builder) use ($request) {
		  
			 if(!empty($request->today_applied_on)){
				$builder->whereDate('created_at', '=', $request->today_applied_on); 
					   }
				 
					 }
				  )
			->when($request->today_updated_on,function (Builder $builder) use ($request) {
			     if(!empty($request->today_updated_on)){  
				  $builder->whereDate('updated_at', '=', $request->today_updated_on);
					   }
			
					 }
				  )
				  
			->when($request->today_applied_from,function (Builder $builder) use ($request) {
			   
			   if(!empty($request->today_applied_from)){
				   $builder->whereDate('created_at', '>=', $request->today_applied_from);
				  }
				}
			)
				  
			->when($request->today_applied_to,function (Builder $builder) use ($request) {
			  
			   if(!empty($request->today_applied_to)){
				  $builder->whereDate('created_at', '<=', $request->today_applied_to);
					}
				}
			)      
				  
			->when($request->today_next_action,function (Builder $builder) use ($request) {
			  
			  if(!empty($request->today_next_action)){
				  $builder->whereDate('date_of_enrollment', '=', $request->today_next_action);
					   }
					 }
				  )	
				  
			->when($request->next_action_from,function (Builder $builder) use ($request) {
					
					if(!empty($request->next_action_from)){
						  $builder->whereDate('date_of_enrollment', '>=', $request->next_action_from);
								  
					   }
					 }
				  )  
				  
			->when($request->next_action_to,function (Builder $builder) use ($request) {
					
					if(!empty($request->next_action_to)){
						  $builder->whereDate('date_of_enrollment', '<=', $request->next_action_to);
					   }
					 }
				  )   
                
	        //05-03-2025
		
			->when($request->today_applied_status,function (Builder $builder) use ($request) {
				  // dd('hi');
                  $builder->where('status_name', '=', $request->today_applied_status);
                 }
              )
              
            ->when($request->team_member_data,function (Builder $builder) use ($request) {
           
                 if(!empty($request->team_member_data)){
                      $builder->where('created_by', '=', $request->team_member_data);
                              //->orWhere('managed_by', '=', $request->team_member_data);
                    }
                 }
              ) 
            
	       ->when($request->updated_q,function (Builder $builder) use ($request) {
         
             if(!empty($request->updated_q)){
               $builder->where('contact', '=', $request->updated_q)
                            ->orWhere('business_name', '=', $request->updated_q)
                            ->orWhere('email', '=', $request->updated_q)
                            ->orWhere('pin_code', '=', $request->updated_q)
                            ->orWhere('id', '=', $request->updated_q);
                    }
                  }
                  
              ); 
			 
			})
                
		   //12-02-2025
		  
            ->paginate($per_page)->appends($request->query());

           // dd($request->all(), $data->toSql());
         }
      
          $requested_input = $request->all();
        
           return view('prospectivebuyers.index',compact('prosBuyerData','requested_input','teamData','assignEmployeeData'))
            ->with('i', ($request->input('page', 1) - 1) * $per_page);
			
			 
       //return view('prospectiveclients.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categoryData  = Categories::get();
        return view('prospectivebuyers.create',compact('categoryData'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
       $this->validate($request, [
              'first_name' => 'required',
              'last_name'  => 'required',
              'email'      => 'required|unique:prospective_buyers,email',
              'contact'    => 'required|unique:prospective_buyers,contact',
             
             ]);
    
         $input = $request->all();
        //dd($input);
         $auth_user=Auth::user();
         $input['created_by'] = $auth_user->id;
         $input['updated_by'] = $auth_user->id;
         //$input['first_comment'] = $request->comment; 
         $input['category_id'] = json_encode($request->category_id);
         $pros_buyer = ProspectiveBuyer::create($input);

         $prosclient_arr = [
                
                
                      'prospectivebuyer_id'     => $pros_buyer->id,
                      'created_by'              => $input['created_by'],
                      'updated_by'              => $input['updated_by'],
                      'comment'                 => $input['comment'],
                      'status_name'             => $input['status_name'],
                      'date_of_enrollment'      => $input['date_of_enrollment'],
                      'for'                     =>'pros_buyer',
                    ];
                    
        $prosclient = ProspectiveBuyerComment::create($prosclient_arr);

         return redirect()->route('prospectivebuyers.index')
                        ->with('success','Prospective Buyer created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
      
        $auth_user = Auth::user();
        
        $request   = request();
		
		$requested_input = $request->all();
		
        $pros_buyer = ProspectiveBuyer::find($id);
		
        $user_emp   = User::where('id','=',$pros_buyer->created_by)->first();
     
        $sellercate = json_decode($pros_buyer->category_id);
		 
         //$prospectivebuyer_comments = ProspectiveBuyerComment::get();
		 
        $prospectivebuyer_comments = ProspectiveBuyerComment::select('prospective_buyer_comments.*', 'users.first_name', 'users.last_name')
                           ->leftjoin('users', 'users.id', 'prospective_buyer_comments.updated_by')
                           ->where('prospective_buyer_comments.prospectivebuyer_id', '=', $id)
                           ->orderBy('prospective_buyer_comments.id','DESC')
                           ->get();   
           //dd($prospectivebuyer_comments);requested_input
        return view('prospectivebuyers.show',compact('pros_buyer','sellercate','user_emp','prospectivebuyer_comments','requested_input'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id):View
    {
         $pros_buyer = ProspectiveBuyer::find($id);
        
		$categoryData = Categories::orderBy('category_name', 'DESC')->get();
		 
		// 31-01-2025 for hold value after search next action date
		
        $request         = request();
		
        $requested_input = $request->all();
		
		// 31-01-2025 for hold value after search next action date 
		 
        return view('prospectivebuyers.edit', compact('pros_buyer','categoryData','requested_input'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
          $input     = $request->all();
      
	     // 31-01-2025 for hold value after serch next action date
        
		$requested_input = []; 
         
         foreach($input as $req_key => $req_val){
             
             if(str_contains($req_key, 'req_')){
                 
                 unset($input[$req_key]);
                 $req_key = str_replace("req_","",$req_key);
                 $requested_input[$req_key] = $req_val;
				 //dd($requested_input);
             }            
         }
		
		 // dd($requested_input);
		 
		 // 31-01-2025 for hold value after search next action date
	   
         $auth_user = Auth::user();
        
       // $input['created_by'] = $auth_user->id;
        
        $input['updated_by'] = $auth_user->id;
        
        $pros_buyer = ProspectiveBuyer::find($id);
        
        $prosbuyer_data = [
                      'business_name'       => $input['business_name'],
                      'updated_by'          => $input['updated_by'],
                      'category_id'         => $input['category_id'],
                      'first_name'          => $input['first_name'], 
                      'last_name'           => $input['last_name'], 
                      'contact'             => $input['contact'], 
                      'email'               => $input['email'], 
                      'gender'              => $input['gender'], 
                      'present_address'     => $input['present_address'], 
                      'pin_code'            => $input['pin_code'], 
                      'state'               => $input['state'], 
                      'status_name'         => $input['status_name'], 
                      'date_of_enrollment'  => $input['date_of_enrollment'], 
                      'comment'             => $input['comment'], 
             
                    ];
        $pros_buyer->update($prosbuyer_data);
    
        $prosclient_arr = [
                
                      'prospectivebuyer_id'     => $pros_buyer->id,
                      //'created_by'              => $input['created_by'],
                      'updated_by'              => $input['updated_by'],
                      'comment'                 => $input['comment'],
                      'status_name'             => $input['status_name'],
                      'date_of_enrollment'      => $input['date_of_enrollment'],
                      'for'                     =>'pros_buyer',
                    ];
                    
         $prosclient = ProspectiveBuyerComment::create($prosclient_arr);

         $pros_buyer->update($input);
		 
         //return redirect()->route('prospectivebuyers.index')->with('success','Prospective Buyer updated successfully');
         
         return redirect()->route('prospectivebuyers.index',$requested_input)->with('success','Prospective Buyer updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        ProspectiveBuyer::find($id)->delete();
        return redirect()->route('prospectivebuyers.index')->with('success','Prospective Buyer deleted successfully');
    }

  public function prospectiveBuyersAssignEmployee(Request $request) 
    {
        $auth_user = Auth::user();
       
        $input = $request->all();
      
        if(empty($input['prospective_buyer_data'])){
          return back()->withErrors(['success' => 'Prospective Buyer Data Should Not Be Empty']);
        }

        $prospective_buyer_ids = explode(',',$input['prospective_buyer_data']);
      
        foreach($prospective_buyer_ids as $prospective_buyer_id){
            
            $prospectiveBuyerData = ProspectiveBuyer::find($prospective_buyer_id);
           
           if(!empty($prospectiveBuyerData)){
                
				$prosBuyerDataArr = $prospectiveBuyerData->toArray();
            
                $prosBuyerDataArr['assign_to']     = $input['emp_id'];
				
               // $prosBuyerDataArr['web_name']      = $prosBuyerDataArr['web_status'];
                //dd($appSellerDataArr['web_name']);
                //$prosBuyerDataArr['app_seller_id'] = $prosBuyerDataArr['id'];
               // $prosBuyerDataArr['assign_by']     = $auth_user->id;
               // $prosBuyerDataArr['data_from']     = 'prospective_buyer';
                unset($prosBuyerDataArr['id']);
            }else{
                
                $prosBuyerDataArr = [];
            }
            
            if(!empty($prosBuyerDataArr)){
				
                //ProspectiveSeller::create($prosBuyerDataArr);
                
                //ProspectiveBuyer::where('id','=',$prospective_buyer_id)->update(['status'=>'appclient-assigned','assign_to'=>$prosBuyerDataArr['id']]);
				
                  ProspectiveBuyer::where('id','=',$prospective_buyer_id)->update(['web_status'=>'prospective_buyer_data_assigned','assign_to'=>$input['emp_id'],'assign_by'=>$auth_user->id ]);
            }
        }       

        return redirect()->route('prospectivebuyers.index')->with('success',' Prospective Buyer Data Assign Successfully');   
        
    }



}