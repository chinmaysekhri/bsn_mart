<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Seller;
use App\Models\Employee;
use App\Models\Categories;
use App\Models\User;
use App\Models\Ledger;
use App\Models\ProspectiveSeller;
use App\Models\ProspectiveSellerComment;
use Auth;
use DB;
use Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Arr;
use Illuminate\View\View;
use App\Models\HasApiTokens;
use Illuminate\Http\RedirectResponse;
use Illuminate\Database\Eloquent\Builder;
use Mail;
use App\Mail\RegisterMail;


class ProspectiveSellerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    function __construct()
    {
         $this->middleware('permission:prospective-seller-list|prospective-seller-create|prospective-seller-edit|prospective-seller-delete', ['only' => ['index','store']]);
         $this->middleware('permission:prospective-seller-create', ['only' => ['create','store']]);
         $this->middleware('permission:prospective-seller-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:prospective-seller-delete', ['only' => ['destroy']]);
    }
    
    public function index(Request $request): View
    {
       
	          
        $per_page  = 50;
     
        $auth_user = Auth::user();
    
        $is_admin  = $auth_user->for;
        
		 //01-06-2024
		 
		 //01-03-2025 start
		 
		  $is_designation  = $auth_user->designation;
		  
		  if($is_admin == 'super_admin' || $is_designation == 'HR Manager'){
	       
		   //$employeeData = Employee::where('for','=','employee')
		   
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
								 ->where('id','!=',$auth_user->id)
				                 ->whereNull('deleted_at')
			                     ->orderBy('id','DESC')
			                     ->get(); 
	       
	      }
		 /* if($is_admin == 'super_admin'){
				
			  $teamData   = User::where('for','=','employee')
			                      ->where('status','!=',0)
				                  ->whereNull('deleted_at')
			                      ->orderBy('id','DESC')->get();
					
				}else{
					
			   $teamData  = User::where('for','=','employee')
			   
			                    ->where(function ($query) use ($auth_user){ 
                                           $query->where('created_by','=',$auth_user->id)
			                                ->orWhere('managed_by','=',$auth_user->id);
                                      })->where('status','!=',0)
				                        ->whereNull('deleted_at')
										->orderBy('id','DESC')
			                            ->get();
			   
			}*/
			
			
		 //01-06-2024 End
		 
		 //10-02-2025 Assign To employee Start
		 
		 
		 
		 
	/* 01-02-2025	 if($is_admin == 'super_admin'){
            
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
								// ->where('id','=',$auth_user->id)
				                 ->whereNull('deleted_at')
			                     ->orderBy('id','DESC')
			                     ->get();
			                     
			                // dd($auth_user->id);
	        } 
       
     
	 //10-02-2025 Assign To employee End
	 
     //$teamData     = User::where('for','=','employee')->orderBy('id','DESC')->get();
     //dd($request->all());
         $data = ProspectiveSeller::when($request->updated_q,function (Builder $builder) use ($request) {
                 $builder->where('contact', '=', $request->updated_q)
                            ->orWhere('business_name', '=', $request->updated_q)
                            ->orWhere('email', '=', $request->updated_q)
                            ->orWhere('pin_code', '=', $request->updated_q)
                            ->orWhere('id', '=', $request->updated_q);
                 }
              )
        ->when($request->today_applied_on,function (Builder $builder) use ($request){
           if(!empty($request->today_applied_on)){
              $builder->whereDate('created_at', '=', $request->today_applied_on); 
                   }
                 }
              )
        ->when($request->today_updated_on,function (Builder $builder) use ($request){
            if(!empty($request->today_updated_on)){  
              $builder->whereDate('updated_at', '=', $request->today_updated_on);
                   }
                 }
              )
        ->when($request->today_next_action,function (Builder $builder) use ($request){
          
          if(!empty($request->today_next_action)){
              $builder->whereDate('next_action_date', '=', $request->today_next_action);
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
			 
        ->when($request->today_applied_status,function (Builder $builder) use ($request) {
             if(!empty($request->today_applied_status)){
                   $builder->where('status_name', '=', $request->today_applied_status);
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
         //dd($request->updated_q);
      if(!empty($request->updated_q)){
              $builder->where('contact', '=', $request->updated_q)
                            ->orWhere('business_name', '=', $request->updated_q)
                            ->orWhere('email', '=', $request->updated_q)
                            ->orWhere('pin_code', '=', $request->updated_q)
                            ->orWhere('id', '=', $request->updated_q);
                 }
                }
              ) 
        ->when($request->next_action_from,function (Builder $builder) use ($request) {
           
           if(!empty($request->next_action_from)){
                      $builder->whereDate('next_action_date', '>=', $request->next_action_from);
                    }
                 }
              )
	    ->when($request->next_action_to,function (Builder $builder) use ($request) {
           
           if(!empty($request->next_action_to)){
                      $builder->whereDate('next_action_date', '<=', $request->next_action_to);
                    }
                 }
              )	  
			  
        ->when($request->team_member_data,function (Builder $builder) use ($request) {
           
           if(!empty($request->team_member_data)){
                      $builder->where('created_by', '=', $request->team_member_data)
                              ->orWhere('managed_by', '=', $request->team_member_data);
                    }
                 }
              )
		 
         // ->orderBy('id','DESC')->paginate($per_page);
          ->orderBy('id','DESC');
      
      if($is_admin == 'super_admin'){
          
          
            $prosSellerData = $data->paginate($per_page)->appends($request->query());
              //dd($prosSellerData);
            }else{
				
			//Customer::whereIntegerInRaw('id', $array)->get();
			
			$user_ids = User::where('created_by','=',$auth_user->id)->orWhere('managed_by','=',$auth_user->id)->pluck('id')->toArray();
			          
			array_push($user_ids,$auth_user->id);
			
			$user_ids2 = User::whereIn('created_by',$user_ids)->orWhereIn('managed_by',$user_ids)->pluck('id')->toArray();
			       
			array_push($user_ids2,$auth_user->id);
						
			$prosSellerData = $data->whereIn('created_by',$user_ids2)
			
			// 12-02-2025
			->orWhere(function ($filtered_table) use ($request,$auth_user){ 
			
			$filtered_table->where('assign_to','=',$auth_user->id)
			  
			 //05-03-2025
				->when($request->today_applied_on,function (Builder $builder) use ($request){
				   if(!empty($request->today_applied_on)){
					  $builder->whereDate('created_at', '=', $request->today_applied_on); 
						   }
						 }
					  )
				->when($request->today_updated_on,function (Builder $builder) use ($request){
					if(!empty($request->today_updated_on)){  
					  $builder->whereDate('updated_at', '=', $request->today_updated_on);
						   }
						 }
					  )
				->when($request->today_next_action,function (Builder $builder) use ($request){
				  
				  if(!empty($request->today_next_action)){
					  $builder->whereDate('next_action_date', '=', $request->today_next_action);
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
					 
				->when($request->today_applied_status,function (Builder $builder) use ($request) {
					 if(!empty($request->today_applied_status)){
						   $builder->where('status_name', '=', $request->today_applied_status);
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
			   ->when($request->next_action_from,function (Builder $builder) use ($request) {
           
                if(!empty($request->next_action_from)){
                      $builder->whereDate('next_action_date', '>=', $request->next_action_from);
                    }
                 }
              )
	          ->when($request->next_action_to,function (Builder $builder) use ($request) {
           
                if(!empty($request->next_action_to)){
                      $builder->whereDate('next_action_date', '<=', $request->next_action_to);
                    }
                 }
              )	  
			  
              ->when($request->team_member_data,function (Builder $builder) use ($request){
                   if(!empty($request->team_member_data)){
                      $builder->where('created_by', '=', $request->team_member_data)
                              ->orWhere('managed_by', '=', $request->team_member_data);
                    }
                 }
              )
		 		  
					  
					  
			
			 //05-03-2025
			  
			  
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
			
			// 12-02-2025
			->paginate($per_page)->appends($request->query());	
		//	dd($request->all(), $data->toSql());
            }
      
      
        $requested_input = $request->all();
     
       
        return view('prospectivesellers.index',compact('prosSellerData', 'requested_input','teamData','assignEmployeeData'))
            ->with('i', ($request->input('page', 1) - 1) * $per_page); 
                    
      }
       
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
     
        $categoryData  = Categories::get();
        return view('prospectivesellers.create',compact('categoryData'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

         $this->validate($request, [
              'first_name' => 'required',
              'last_name'  => 'required',
              //'email'      => 'required|unique:prospective_sellers,email',
              'contact'    => 'required|unique:prospective_sellers,contact',
             
             ]);
    
        $input = $request->all();
       //dd($input);
        $auth_user=Auth::user();
        $input['created_by'] = $auth_user->id;
        $input['updated_by'] = $auth_user->id;
        $input['category_id'] = json_encode($request->category_id);
        $pros_seller = ProspectiveSeller::create($input);
        $prosseller_arr = [
                
                
                      'prospectiveseller_id'     => $pros_seller->id,
                      'created_by'              => $input['created_by'],
                      'updated_by'              => $input['updated_by'],
                      'comment'                 => $input['comment'],
                      'status_name'             => $input['status_name'],
                      'next_action_date'      => $input['next_action_date'],
                      'for'                     =>'pros_seller',
                    ];
                    
        $prosseller = ProspectiveSellerComment::create($prosseller_arr);
         return redirect()->route('prospectivesellers.index')
                        ->with('success','Prospective Seller created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $auth_user = Auth::user();
        
		// 04-02-2025 for hold value after search next action date
        
		$request = request();
		
        $requested_input = $request->all();
		
		// 04-02-2025 for hold value after search next action date
		
        $pros_seller = ProspectiveSeller::find($id);
       
        $user_emp = User::where('id','=',$pros_seller->created_by)->first();
        //dd($user_emp);
    $sellercate = json_decode($pros_seller->category_id);
     $prospectiveseller_comments = ProspectiveSellerComment::select('prospective_seller_comments.*', 'users.first_name', 'users.last_name')
                           ->leftjoin('users', 'users.id', 'prospective_seller_comments.updated_by')
                           ->where('prospective_seller_comments.prospectiveseller_id', '=', $id)
                           ->orderBy('prospective_seller_comments.id','DESC')
                           ->get(); 
        return view('prospectivesellers.show',compact('pros_seller','sellercate','user_emp','prospectiveseller_comments','requested_input'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
       // $employeeData  =Employee::where('created_by','=',$auth_user->id)->get();
         $pros_seller= ProspectiveSeller::find($id);
         $categoryData= Categories::orderBy('category_name', 'DESC')->get();
		 
		// 29-05-2024 for hold value after search next action date
		
        $request         = request();
        $requested_input = $request->all();
		// 29-05-2024 for hold value after search next action date
		
        return view('prospectivesellers.edit', compact('pros_seller','categoryData','requested_input'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

         $input     = $request->all();
		 
         // 29-05-2024 for hold value after serch next action date
		 
         $requested_input = []; 
         
         foreach($input as $req_key => $req_val){
             
             if(str_contains($req_key, 'req_')){
                 
                 unset($input[$req_key]);
                 $req_key = str_replace("req_","",$req_key);
                 $requested_input[$req_key] = $req_val;
             }
            
         }
		 
		 // 29-05-2024 for hold value after search next action date
		 

        $auth_user           = Auth::user();
        
        $input['updated_by'] = $auth_user->id;
		 
        $pros_seller = ProspectiveSeller::find($id);

          $prosseller_data = [
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
                      'next_action_date'    => $input['next_action_date'], 
                      'comment'             => $input['comment'], 
             
                    ];
                    
    $pros_seller->update($prosseller_data);
   
    $prosseller_arr = [
                
                      'prospectiveseller_id'    => $pros_seller->id,
                      'updated_by'              => $input['updated_by'],
                      'comment'                 => $input['comment'],
                      'status_name'             => $input['status_name'],
                       'next_action_date'       => $input['next_action_date'],
                      'for'                     =>'pros_seller',
                    ];
                    
        $prosseller = ProspectiveSellerComment::create($prosseller_arr);

         $pros_seller->update($input);

         return redirect()->route('prospectivesellers.index',$requested_input)->with('success','Prospective Seller updated successfully');

        //return redirect('prospectivesellers.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        ProspectiveSeller::find($id)->delete();
        
		return redirect()->route('prospectivesellers.index')->with('success','Prospective Seller deleted successfully');
       
	   //return redirect('prospectivesellers.index');
    }
 
// assign to prospective seller dat to employee 10-02-2025 Start
 
    public function prospectiveSellersAssignEmployee(Request $request) 
    {
        $auth_user = Auth::user();
       
        $input = $request->all();
       //dd($input);
        if(empty($input['prospective_seller_data'])){
         
		 return back()->withErrors(['success' => 'Prospective Buyer Data Should Not Be Empty']);
       
	   }

        $prospective_seller_ids = explode(',',$input['prospective_seller_data']);
        
        foreach($prospective_seller_ids as $prospective_seller_id){
            
            $prospectiveSellerData = ProspectiveSeller::find($prospective_seller_id);
          
           if(!empty($prospectiveSellerData)){
             
			   
                $prosSellerDataArr = $prospectiveSellerData->toArray();
               
                $prosSellerDataArr['assign_to']     = $input['emp_id'];
				
               // $prosSellerDataArr['web_name']      = $prosSellerDataArr['web_status'];
                //dd($prosSellerDataArr['web_name']);
                //$prosSellerDataArr['app_seller_id'] = $prosSellerDataArr['id'];
               // $prosSellerDataArr['assign_by']     = $auth_user->id;
               // $prosSellerDataArr['data_from']     = 'prospective_buyer';
                unset($prosSellerDataArr['id']);
           
		   }else{
                
                $prosSellerDataArr = [];
            }
            
            if(!empty($prosSellerDataArr)){
				
                ProspectiveSeller::where('id','=',$prospective_seller_id)->update(['web_status'=>'prospective_seller_data_assigned','assign_to'=>$input['emp_id'],'assign_by'=>$auth_user->id ]);
            }
        }       

        return redirect()->route('prospectivesellers.index')->with('success',' Prospective Seller Data Assign Successfully');   
        
    }
	
	// assign to prospective seller dat to employee 10-02-2025 End
 
}
