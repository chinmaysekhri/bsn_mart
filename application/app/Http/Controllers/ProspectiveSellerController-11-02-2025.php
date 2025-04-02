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
       
	   //dd($request->all());  
		
        $per_page  = 15;
     
        $auth_user = Auth::user();
    
         $is_admin  = $auth_user->for;
         //dd($is_admin);
       //  $employeeData = Employee::where('created_by','=',$auth_user->id)->orderBy('id','DESC')->get();
		 
		 
		 //01-06-2024 
		  if($is_admin == 'super_admin'){
				
			  $teamData   = User::where('for','=','employee')->orderBy('id','DESC')->get();
					
				}else{
					
			   $teamData  = User::where('for','=','employee')
			   
			                    ->where(function ($query) use ($auth_user){ 
                                           $query->where('created_by','=',$auth_user->id)
			                                ->orWhere('managed_by','=',$auth_user->id);
                                      })->orderBy('id','DESC')
			                               
									->get();
			   
			}
		 //01-06-2024 End

         //$teamData     = User::where('for','=','employee')->orderBy('id','DESC')->get();
     //dd($request->all());
         $data = ProspectiveSeller::when($request->updated_q,function (Builder $builder) use ($request) {
              $builder->where('brand_name', 'like', "%{$request->updated_q}%")
              ->orWhere('business_name', 'like', "%{$request->updated_q}%")
              ->orWhere('email', 'like', "%{$request->updated_q}%")
              ->orWhere('next_action_date', 'like', "%{$request->updated_q}%")
              ->orWhere('status_name', 'Like', "%{$request->updated_q}%")
              ->orWhere('first_name', 'like', "%{$request->updated_q}%")
              ->orWhere('last_name', 'like', "%{$request->updated_q}%")
              ->orWhere('web_name', 'like', "%{$request->updated_q}%")
              ->orWhere('web_status', 'like', "%{$request->updated_q}%")
              ->orWhere('pin_code', 'like', "%{$request->updated_q}%")
              ->orWhere('present_address', 'like', "%{$request->q}%")
              ->orWhere('comment', 'like', "%{$request->updated_q}%")
              ->orWhere('contact', 'like', "%{$request->updated_q}%");
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
              $builder->whereDate('next_action_date', 'like', "%{$request->today_next_action}%");
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
              $builder->where('status_name', '=', $request->today_applied_status);
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
              $builder->where('email', 'like', "%{$request->updated_q}%")
              ->orWhere('brand_name', 'like', "%{$request->updated_q}%")
              ->orWhere('business_name', 'like', "%{$request->updated_q}%")
			  ->orWhere('status_name', 'Like', "%{$request->updated_q}%")
              ->orWhere('first_name', 'like', "%{$request->updated_q}%")
              ->orWhere('last_name', 'like', "%{$request->updated_q}%")
              ->orWhere('contact', 'like', "%{$request->updated_q}%")
			  ->orWhere('pin_code', 'like', "%{$request->updated_q}%")
              ->orWhere('present_address', 'like', "%{$request->q}%")
              ->orWhere('next_action_date', 'like', "%{$request->updated_q}%");
                 }
                }
              ) 
        ->when($request->next_action_from,function (Builder $builder) use ($request) {
           
           if(!empty($request->next_action_from)){
                      $builder->whereDate('next_action_date', '>=', $request->next_action_from)
                      ->whereDate('next_action_date', '<=', $request->next_action_to);
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
              
            }else{
				
			//Customer::whereIntegerInRaw('id', $array)->get();
			
			$user_ids = User::where('created_by','=',$auth_user->id)->orWhere('managed_by','=',$auth_user->id)->pluck('id')->toArray();
			          
			array_push($user_ids,$auth_user->id);
			
			$user_ids2 = User::whereIn('created_by',$user_ids)->orWhereIn('managed_by',$user_ids)->pluck('id')->toArray();
			       
			array_push($user_ids2,$auth_user->id);
						
			$prosSellerData = $data->whereIn('created_by',$user_ids2)->paginate($per_page)->appends($request->query());	
			
            }
      
      
        $requested_input = $request->all();
     
        return view('prospectivesellers.index',compact('prosSellerData', 'requested_input','teamData'))
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
            $input['category_id'] = json_encode($request->category_id);
         $pros_seller = ProspectiveSeller::create($input);
           $prosseller_arr = [
                
                
                      'prospectiveseller_id'     => $pros_seller->id,
                      'created_by'              => $input['created_by'],
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
        
        $request = request();

        $pros_seller = ProspectiveSeller::find($id);
       
        $user_emp = User::where('id','=',$pros_seller->created_by)->first();
        //dd($user_emp);
    $sellercate = json_decode($pros_seller->category_id);
     $prospectiveseller_comments = ProspectiveSellerComment::select('prospective_seller_comments.*', 'users.first_name', 'users.last_name')
                           ->leftjoin('users', 'users.id', 'prospective_seller_comments.created_by')
                           ->where('prospective_seller_comments.prospectiveseller_id', '=', $id)
                           ->orderBy('prospective_seller_comments.id','DESC')
                           ->get(); 
        return view('prospectivesellers.show',compact('pros_seller','sellercate','user_emp','prospectiveseller_comments'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
       // $employeeData  =Employee::where('created_by','=',$auth_user->id)->get();
         $pros_seller= ProspectiveSeller::find($id);
         $categoryData= Categories::orderBy('category_name', 'DESC')->get();
		 
		// 29-05-2024 for hold value after serch next action date
		
        $request         = request();
        $requested_input = $request->all();
		// 29-05-2024 for hold value after serch next action date
		
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
		 
		 // 29-05-2024 for hold value after serch next action date
		 

         $auth_user           = Auth::user();
        
         $input['created_by'] = $auth_user->id;
		 
         $pros_seller = ProspectiveSeller::find($id);

          $prosseller_data = [
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
                      'next_action_date'  => $input['next_action_date'], 
                      'comment'             => $input['comment'], 
             
                     
                     
                    ];
    $pros_seller->update($prosseller_data);
    
   $prosseller_arr = [
                
                
                      'prospectiveseller_id'    => $pros_seller->id,
                      'created_by'              => $input['created_by'],
                      'comment'                 => $input['comment'],
                      'status_name'             => $input['status_name'],
                       'next_action_date'        => $input['next_action_date'],
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
  
}
