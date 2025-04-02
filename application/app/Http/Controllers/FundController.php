<?php
    
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Fund;
use App\Models\Wallet;
use App\Models\FundComment;
use App\Models\Ledger;
use App\Models\User;
//use Spatie\Permission\Models\Fund;
use Spatie\Permission\Models\Permission;
use DB;
use Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Database\Eloquent\Builder;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Spatie\Permission\Models\Role;
    
class FundController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:fund-list|fund-create|fund-edit|fund-delete', ['only' => ['index','store']]);
         $this->middleware('permission:fund-create', ['only' => ['create','store']]);
         $this->middleware('permission:fund-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:fund-delete', ['only' => ['destroy']]); 
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request): View
    {


     //03-08-2024     

        $per_page = 10;
						
		$auth_user  = Auth::user();

		$is_admin  = $auth_user->for;

			
	//01-02-2025 start
			
            
	 /* if($is_admin == 'super_admin'){
        
                $buyerSellerData   = User::where('for','=','seller')
                                          ->orWhere('for','=','buyer')
                                         //->orWhere('for','=','employee')
                                         ->where('status','!=',0)
				                         ->whereNull('deleted_at')
                                         ->orderBy('id','DESC')->get();
    
        }elseif($is_admin == 'buyer'){
          
             $buyerSellerData  = User::where('for','=','buyer')
                                        // ->orWhere('for','=','seller')
                                         ->where(function ($query) use ($auth_user){ 
                                          $query->where('created_by','=',$auth_user->id)
                                         ->orWhere('managed_by','=',$auth_user->id)
                                         ->orWhere('id','=',$auth_user->id)
                                         ->where('status','!=',0)
				                         ->whereNull('deleted_at');
                                         })->orderBy('id','DESC')->get();


            }elseif($is_admin == 'seller'){
				
				$buyerSellerData  = User::where('for','=','seller')
                                         //->orWhere('for','=','seller')
                                         ->where(function ($query) use ($auth_user){ 
                                          $query->where('created_by','=',$auth_user->id)
                                         ->orWhere('managed_by','=',$auth_user->id)
                                         ->orWhere('id','=',$auth_user->id)
                                         ->where('status','!=',0)
				                         ->whereNull('deleted_at');
                                         })->orderBy('id','DESC')->get();
                                         
			}elseif($is_admin == 'employee'){
			
			
				//01-02-2025  employee code only variable error ke liye h Withdrawal only Buyer & seller ke liye h	.
				
				$buyerSellerData  = User::where('for','=','employee')
                                         //->orWhere('for','=','seller')
                                         ->where(function ($query) use ($auth_user){ 
                                          $query->where('created_by','=',$auth_user->id)
                                         ->orWhere('managed_by','=',$auth_user->id)
                                         ->orWhere('id','=',$auth_user->id)
                                         ->where('status','!=',0)
				                         ->whereNull('deleted_at');
                                         })->orderBy('id','DESC')->get();
			}
            
            //01-02-2025  employee code only variable error ke liye h Withdrawal only Buyer & seller ke liye h	.
            //01-02-2025 end
            */
            
        // New Code Update 07-03-2025
		
		 $is_admin    = $auth_user->for;
		 
		 if($is_admin == 'super_admin'){
        
         $buyerSellerData   = User::where('for','=','seller')
                               ->orWhere('for','=','buyer')
                             //  ->orWhere('for','=','employee')
							   ->where('status','!=',0)
				               ->whereNull('deleted_at')
                               ->orderBy('id','DESC')->get();
    
         }elseif($is_admin == 'buyer'){
          
         $buyerSellerData  = User::where('for','=','buyer')
                                        // ->orWhere('for','=','seller')
                                          ->where(function ($query) use ($auth_user){ 
                                          $query->where('created_by','=',$auth_user->id)
                                          ->orWhere('managed_by','=',$auth_user->id)
                                          ->orWhere('id','=',$auth_user->id)
                                        //  ->where('id','!=',$auth_user->id)
										  ->where('status','!=',0)
				                          ->whereNull('deleted_at');
                                         })->orderBy('id','DESC')->get();

          }elseif($is_admin == 'seller'){
				
		   $buyerSellerData  = User::where('for','=','seller')
                                         //->orWhere('for','=','seller')
                                         ->where(function ($query) use ($auth_user){ 
                                          $query->where('created_by','=',$auth_user->id)
                                          ->orWhere('managed_by','=',$auth_user->id)
                                          ->orWhere('id','=',$auth_user->id)
										  ->where('status','!=',0)
				                          ->whereNull('deleted_at');
                                         })->orderBy('id','DESC')->get();
			
			
			
	        }elseif(($is_admin == 'employee')){
		
			
			$user_ids = User::where('created_by','=',$auth_user->id)->orWhere('managed_by','=',$auth_user->id)->pluck('id')->toArray();
			          
			array_push($user_ids,$auth_user->id);
			
			$user_ids2 = User::whereIn('created_by',$user_ids)->orWhereIn('managed_by',$user_ids)->pluck('id')->toArray();
		      
			array_push($user_ids2,$auth_user->id);


		    $buyerSellerData = User::whereIn('id',$user_ids2) 
		                              ->whereIn('for',['seller','buyer'])
		                              ->where('status','!=',0)
								      // ->where('id','!=',$auth_user->id)
				                      ->whereNull('deleted_at')
			                          ->orderBy('id','DESC')
			                          ->get();
		
				
            }
            

            $fundData = Fund::when($request->q,function (Builder $builder) use ($request) {
                                   $builder->where('payment_fund_id', 'like', "%{$request->q}%");
                                }
                            )
            ->when($request->today_applied_on,function (Builder $builder) use ($request) {
         
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
             
       ->when($request->seller_buyer_data,function (Builder $builder) use ($request) {
         // dd($request->seller_buyer_data,$request->all());
          $sellerbuyer_id = intval($request->seller_buyer_data);
       // dd($sellerbuyer_id);
           if(!empty($sellerbuyer_id)){
                      $builder->where('fund_to', '=', $sellerbuyer_id);
                              // ->orWhere('managed_by', '=', $request->team_member_data);
                    }
                 }
              )
           
         ->orderBy('id','DESC');

           if($is_admin == 'super_admin'){
          
          
            $fundData = $fundData->where('fund_for', '=', 'Payment')->paginate($per_page)->appends($request->query());
              
            }else{
                
           if($is_admin == 'buyer'){ 
               
             $fundData = $fundData->where('fund_for', '=', 'Payment')->where('buyer_id','=',$auth_user->id)->paginate($per_page)->appends($request->query());
           
                //dd($fundData);
           }else{
               
          $user_ids = User::where('created_by','=',$auth_user->id)->orWhere('managed_by','=',$auth_user->id)->pluck('id')->toArray();
                      
             array_push($user_ids,$auth_user->id);
            
             $user_ids2 = User::whereIn('created_by',$user_ids)->orWhereIn('managed_by',$user_ids)->pluck('id')->toArray();
                   
             array_push($user_ids2,$auth_user->id);
                        
             $fundData = $fundData->where('fund_for', '=', 'Payment')->whereIn('created_by',$user_ids2)->paginate($per_page)->appends($request->query());  
             
			 }
          
            }
      
            $requested_input = $request->all();							
            return view('funds.index',compact('fundData','requested_input','buyerSellerData'))
                         ->with('i', ($request->input('page', 1) - 1) * $per_page); 
        
		
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
		  $request = request();
		  
          $this->validate($request, [
           
		   'buyer_seller_id' => 'required',
		   
		   ], [
            'buyer_seller_id.required' => 'Select Buyer or Seller',
         ]);
		 
        $buyerSellerID = $request->buyer_seller_id;
		
		//dd($buyerSellerID);
      
        return view('funds.create',compact('buyerSellerID'));
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
          //  'name' => 'required|unique:funds,name',
            'fund_date' => 'required',
            'fund_amount' => 'required',
            'fund_receipt_no' => 'required',
        ]);
         
		$input      = $request->all();
		
        $auth_user  = Auth::user();
		
        $authUserID = $auth_user->id;
		     
        $input['created_by'] = $auth_user->id;
		
        $input['buyer_id']   = $auth_user->id;
		
		
        $input['fund_for']   = 'Payment';
		
        $input['fund_type']  = 'Credit';
		
// for ledger data input 23-07-2024 Start
		
		$buyerSellerData = implode(',',$input);
		 
	    $buyer_seller_id = intval(explode(',',$buyerSellerData)[4]);
		
        $ledgerDate      = date("Y-m-d");
		
		$ledgerAmount    =  intval(explode(',',$buyerSellerData)[2]);
		
// for ledger data input 23-07-2024 End
		
        $paymentFundId = IdGenerator::generate(['table' => 'funds', 'length' => 20,'field' => 'fund_receipt_no', 'prefix' =>'PM'.''.date('Y').''.date('m').''.date('d').''.date('i').''.rand(0, 9999).''.$auth_user->id]);
		
		$input['payment_fund_id']  = $paymentFundId;
		
		if($request->hasfile('upload_fund_receipt')){
            
            $fileName_upload_fund_receipt = time().'.'.$request->upload_fund_receipt->extension();  

            $request->upload_fund_receipt->move(public_path('uploads/funds/upload_fund_receipt'), $fileName_upload_fund_receipt);
            
            $input['upload_fund_receipt'] = $fileName_upload_fund_receipt;
            
        }else{
			
            unset($input['upload_fund_receipt']);          
        }
		
        $fund = Fund::create($input);
      
	   //Update Data Ledger Table Date-23-07-2024 Start

     /*     $ledger_arr = [
                      'created_by'        => $input['created_by'],
                      'buyer_seller_id'   => $buyer_seller_id,
                      'ledger_order_id'   => $paymentFundId, 
                      'ledger_type'       => $input['fund_type'],
                      'ledger_for'        => $input['fund_for'],
					  'ledger_date'       => $ledgerDate,
					  'ledger_amount'     => $ledgerAmount, 
                    ];
		
	
         $ledger   = Ledger::create($ledger_arr); 
		 
		 */
	
	   //Update Data Ledger Table Date-23-07-2024 End
	  
    
        return redirect()->route('funds.index')
                        ->with('success','Fund created successfully');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id): View
    {
        $fund = Fund::find($id);
		
	    $fundCommentBy = Fund::select('funds.*', 'users.first_name', 'users.last_name')
		                   ->leftjoin('users', 'users.id','=', 'funds.created_by')
		                 //->where('funds.buyer_id', '=', $id)
						 //->orderBy('funds.id','DESC')
						   ->first();
       //dd($fund);
       //dd($fundCommentBy);
        return view('funds.show',compact('fund','fundCommentBy'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id): View
    {
        $fund = Fund::find($id);
       
        return view('funds.edit',compact('fund'));
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
            'name' => 'required',
            'permission' => 'required',
        ]);
    
        $fund = Fund::find($id);
        $fund->name = $request->input('name');
        $fund->save();
    
        return redirect()->route('funds.index')
                        ->with('success','Fund updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id): RedirectResponse
    {
        DB::table("funds")->where('id',$id)->delete();
        return redirect()->route('funds.index')
                        ->with('success','Fund deleted successfully');
    }
	
	public function fundLog()
    {
	    $auth_user    = Auth::user();
		$fundComments = FundComment::select('fund_comments.*', 'users.first_name', 'users.last_name')
		                   ->leftjoin('users', 'users.id','=', 'fund_comments.created_by')
						 //->where('fund_comments.fund_id', '=', $auth_user->id)
		                   ->where('users.id', '=', $auth_user->id)
						   ->get();
       return view('funds.fund_log',compact('fundComments')); 
    }
	
		
	public function addFundComment(Request $request, $id)
	{
	   $input            = $request->all();
	   
	  // dd($input);
	  
	   $auth_user        = Auth::user();
	   
	   $input['fund_to'] = $auth_user->id;

	   //dd($input['created_by']);
	   
	   //dd($input['fund_to']);
       //$input['fund_id']    = $id;   
	   //$input['created_by'] = $auth_user->id; 
	   //FundComment::create($input);
	   
	    DB::table('funds')->where('id','=',$id)->update(['comment'=>$request->comment,'fund_status'=>$request->fund_status]);
	   
	  
	  //Update Data Ledger Table Date-24-07-2024 Start
		
		$fundData = DB::table('funds')->where('id','=',$id)->where('fund_status','=','Confirmed')->first();
	   

		if(!empty($fundData)){
			 
	     $fundID          = $fundData->id;	
	     $buyer_seller_id = $fundData->fund_to;		 
	     $paymentFundId   = $fundData->payment_fund_id;
	     $ledgerFundType  = $fundData->fund_type;
	     $ledgerFundFor   = $fundData->fund_for;
	     $ledgerDate      = $fundData->fund_date;
	     $ledgerAmount    = $fundData->fund_amount;
		 
		 $ledger_arr = [
                      'created_by'        => $fundData->created_by,
                      'fund_id'           => $fundID,
                      'buyer_seller_id'   => $buyer_seller_id,
                      'ledger_order_id'   => $paymentFundId, 
                      'ledger_type'       => $ledgerFundType,
                      'ledger_for'        => $ledgerFundFor,
					  'ledger_date'       => $ledgerDate,
					  'ledger_amount'     => $ledgerAmount, 
                    ];
	
	   
         $ledger   = Ledger::create($ledger_arr); 
	   }
	   
	   //Update Data Ledger Table Date-24-07-2024 End
	   
	   return back()->with('success','Fund Added Successfully!');
   }
}
