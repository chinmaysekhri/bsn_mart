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
         $per_page  = 15;
     
     $auth_user = Auth::user();
    
     $is_admin  = $auth_user->for;
     //dd($is_admin);
         $employeeData = Employee::where('created_by','=',$auth_user->id)->orderBy('id','DESC')->get();
     
         $data = ProspectiveBuyer::when($request->updated_q,function (Builder $builder) use ($request) {
              $builder->where('first_name', 'like', "%{$request->updated_q}%")
                            ->orWhere('last_name', 'like', "%{$request->updated_q}%")
                            ->orWhere('email', 'like', "%{$request->updated_q}%")
                            ->orWhere('contact', 'like', "%{$request->updated_q}%")
                            ->orWhere('gender', 'like', "%{$request->updated_q}%")
                            ->orWhere('business_name', 'like', "%{$request->updated_q}%")
                            ->orWhere('comment', 'like', "%{$request->updated_q}%")
                            ->orWhere('status_name', '=', $request->updated_q)
                            ->orWhere('date_of_enrollment', 'like', "%{$request->updated_q}%")
                            ->orWhere('category_id', 'like', "%{$request->updated_q}%")
                            ->orWhere('present_address', 'like', "%{$request->updated_q}%");
                 }
              )
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
        ->when($request->today_next_action,function (Builder $builder) use ($request) {
          
          if(!empty($request->today_next_action)){
              $builder->whereDate('date_of_enrollment', 'like', "%{$request->today_next_action}%");
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
         
      if(!empty($request->today_applied_status)){
		  
              $builder->where('status_name', '=',$request->today_applied_status);
         }
                 }
              )
        ->when($request->today_updated_from,function (Builder $builder) use ($request) {
           
       if(!empty($request->today_updated_from)){
              $builder->whereDate('updated_at', '>=', $request->today_updated_from)
                      ->whereDate('updated_at', '<=', $request->today_updated_to);
           }
                 }
              )
        
       ->when($request->updated_q,function (Builder $builder) use ($request) {
         
      if(!empty($request->updated_q)){
               $builder->where('first_name', 'like', "%{$request->updated_q}%")
                            ->orWhere('last_name', 'like', "%{$request->updated_q}%")
                            ->orWhere('email', 'like', "%{$request->updated_q}%")
                            ->orWhere('contact', 'like', "%{$request->updated_q}%")
                            ->orWhere('gender', 'like', "%{$request->updated_q}%")
                            ->orWhere('business_name', 'like', "%{$request->updated_q}%")
                            ->orWhere('comment', 'like', "%{$request->updated_q}%")
                            ->orWhere('status_name', '=', $request->updated_q)
                            ->orWhere('date_of_enrollment', 'like', "%{$request->updated_q}%")
                            ->orWhere('category_id', 'like', "%{$request->updated_q}%")
                            ->orWhere('present_address', 'like', "%{$request->updated_q}%");
                  }
                 }
              )
			//  dd($request->updated_q);
        ->when($request->next_action_from,function (Builder $builder) use ($request) {
           
           if(!empty($request->next_action_from)){
                      $builder->whereDate('date_of_enrollment', '>=', $request->next_action_from)
                      ->whereDate('date_of_enrollment', '<=', $request->next_action_to);
           }
                 }
              )
        
         
         // ->orderBy('id','DESC')->paginate($per_page);
          ->orderBy('id','DESC');
      
      if($is_admin == 'super_admin'){
              
            $prosBuyerData = $data->paginate($per_page)->appends($request->query());
              
            }else{
              
            //$data = $taskData->where('tasks.task_assign_to','=',$auth_user->emp_id)->paginate($per_page); 
            
            $prosBuyerData = $data->where('created_by','=',$auth_user->id)
                ->orWhere('assign_to','=',$auth_user->id)
            ->paginate($per_page)->appends($request->query());  
            }
      
      
        $requested_input = $request->all();
         //dd($requested_input);
        return view('prospectivebuyers.index',compact('prosBuyerData','requested_input'))
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
         //$input['first_comment'] = $request->comment; 
          $input['category_id'] = json_encode($request->category_id);
         $pros_buyer = ProspectiveBuyer::create($input);

         $prosclient_arr = [
                
                
                      'prospectivebuyer_id'                => $pros_buyer->id,
                      'created_by'              => $input['created_by'],
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
        
        $request = request();
		
		$requested_input = $request->all();
		
        $pros_buyer=ProspectiveBuyer::find($id);
        $user_emp = User::where('id','=',$pros_buyer->created_by)->first();
      //dd($user_emp);
         $sellercate = json_decode($pros_buyer->category_id);
         //$prospectivebuyer_comments = ProspectiveBuyerComment::get();
        $prospectivebuyer_comments = ProspectiveBuyerComment::select('prospective_buyer_comments.*', 'users.first_name', 'users.last_name')
                           ->leftjoin('users', 'users.id', 'prospective_buyer_comments.created_by')
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
        
         $input['created_by'] = $auth_user->id;
         $pros_buyer = ProspectiveBuyer::find($id);

          $prosbuyer_data = [
                      'business_name'       => $input['business_name'],
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
                      'created_by'              => $input['created_by'],
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




}
