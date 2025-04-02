<?php
    
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Fund;
use App\Models\Wallet;
use App\Models\Withdrawal;
use App\Models\Ledger;
use App\Models\WithdrawalComment;
use App\Models\FundComment;
use App\Models\User;
use App\Helpers\Helper;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use DB;
use Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Database\Eloquent\Builder;
use Haruncpi\LaravelIdGenerator\IdGenerator;
    
class WithdrawalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:withdraw-list|withdraw-create|withdraw-edit|withdraw-delete', ['only' => ['index','store']]);
         $this->middleware('permission:withdraw-create', ['only' => ['create','store']]);
         $this->middleware('permission:withdraw-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:withdraw-delete', ['only' => ['destroy']]); 
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request): View
    {
      
     $per_page  = 10;
     
            $auth_user = Auth::user();  

            $is_admin  = $auth_user->for;

	  if($is_admin == 'super_admin'){
        
        $buyerSellerData   = User::where('for','=','seller')
                              ->orWhere('for','=','buyer')
                              ->orderBy('id','DESC')->get();
    
        }elseif($is_admin == 'buyer'){
          
         $buyerSellerData  = User::where('for','=','buyer')
                                        // ->orWhere('for','=','seller')
                                         ->where(function ($query) use ($auth_user){ 
                                          $query->where('created_by','=',$auth_user->id)
                                         ->orWhere('managed_by','=',$auth_user->id)
                                         ->orWhere('id','=',$auth_user->id);
                                         })->orderBy('id','DESC')->get();

            }elseif($is_admin == 'seller'){
				
				$buyerSellerData  = User::where('for','=','seller')
                                         //->orWhere('for','=','seller')
                                         ->where(function ($query) use ($auth_user){ 
                                          $query->where('created_by','=',$auth_user->id)
                                         ->orWhere('managed_by','=',$auth_user->id)
                                         ->orWhere('id','=',$auth_user->id);
                                         })->orderBy('id','DESC')->get();
			}
       //dd('admin');
        
         $withdrawal = Withdrawal::when($request->q,function (Builder $builder) use ($request) {
                                    $builder->where('name', 'like', "%{$request->q}%");
                                    //->orWhere('email', 'like', "%{$request->q}%");
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
           if(!empty($request->seller_buyer_data)){
                      $builder->where('withdrawal_from', '=', $request->seller_buyer_data);
                              // ->orWhere('managed_by', '=', $request->team_member_data);
                    }
                 }
              )
        
           
         ->orderBy('id','DESC');

       if($is_admin == 'super_admin'){
          
          
            $withdrawal = $withdrawal->where('withdrawal_for', '=', 'Withdraw')->paginate($per_page)->appends($request->query());
              
            }else{
                
           if($is_admin == 'buyer'){ 
               
             $withdrawal = $withdrawal->where('withdrawal_for', '=', 'Withdraw')->where('buyer_id','=',$auth_user->id)->paginate($per_page)->appends($request->query());
           
               
           }else{
               
          $user_ids = User::where('created_by','=',$auth_user->id)->orWhere('managed_by','=',$auth_user->id)->pluck('id')->toArray();
                      
             array_push($user_ids,$auth_user->id);
            
             $user_ids2 = User::whereIn('created_by',$user_ids)->orWhereIn('managed_by',$user_ids)->pluck('id')->toArray();
                   
             array_push($user_ids2,$auth_user->id);
                        
             $withdrawal = $withdrawal->where('withdrawal_for', '=', 'Withdraw')->whereIn('created_by',$user_ids2)->paginate($per_page)->appends($request->query()); 
               
               
           }
           //Customer::whereIntegerInRaw('id', $array)->get();
            
  
            }
      
        $requested_input = $request->all();
     
        return view('withdraws.index',compact('requested_input','withdrawal','buyerSellerData'))
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
		
        return view('withdraws.create',compact('buyerSellerID'));
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
          //  'withdrawal_date' => 'required',
          //  'withdrawal_amount' => 'required',
          //  'withdrawal_payment_type' => 'required',
        ]);
         
		$input       = $request->all();

     //25-11-2024
		
		if($request->has('withdrawal_from')){
		
		$buyer_seller_id    = $request->withdrawal_from;	
		}
		else
		{
		  $buyer_seller_id  = "";	
		}
		
		$wallet_data       = Helper::getWalletData($buyer_seller_id);
		
		$totalWalletAmount = $wallet_data['total_wallet_amount'];
		
		  
		$withdrwal_amt = $input['withdrawal_amount'];  //23-11-2024
		
		//dd($totalWalletAmount,$withdrwal_amt);
		
		if($withdrwal_amt > $totalWalletAmount){
			
			return back()->with('errors',['Withdrawal amount should be less than or equal to wallet amount']);
		}
				
		//25-11-2024
		
				
		//Check widthrawal requested amount 30-12-2024 start
		
		$withdrawal_requested_data = Helper::getWithdrawalRequestedAmt($buyer_seller_id);
		
		$totalRequestedPending = $withdrawal_requested_data['total_request_pending'];
		
		$totalRequestedPaid    = $withdrawal_requested_data['total_request_paid'];
				
				
	     $totalPendingPaidAmount = ($totalRequestedPaid+$totalRequestedPending);
		
		 $totalCurrentBalance   = ($totalWalletAmount-$totalRequestedPending);
			
		if($withdrwal_amt > $totalCurrentBalance){
			
			return back()->with('errors',["Withdrawal Requested amount should be less than .$totalCurrentBalance"]);
		}
		
		//Check widthrawal requested amount 30-12-2024 end
		
        
        $auth_user   = Auth::user();
		   
        $input['created_by'] = $auth_user->id;
		
        $input['buyer_id']   = $auth_user->id;
		
        //$input['seller_id']  = $auth_user->id;
		
		//$input['verified_by'] = $auth_user->id;
		
        $input['withdrawal_for']  = 'Withdraw';
		
        $input['withdrawal_type']  = 'Debit';
		
		
        $paymentWithdrawalId = IdGenerator::generate(['table' => 'withdrawals', 'length' => 20,'field' => 'withdrawal_for', 'prefix' =>'WD'.''.date('Y').''.date('m').''.date('d').''.date('i').''.rand(0, 9999).''.$auth_user->id]);
		
		$input['payment_withdrawal_id']  = $paymentWithdrawalId;
		
        $withdrawal = Withdrawal::create($input);
     
        return redirect()->route('withdraws.index')
                        ->with('success','Withdrawal Request Created Successfully');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id): View
    {
        //$withdrawal = Withdrawal::find($id);
		
        $withdrawalComments = Withdrawal::find($id);
		
	
	   // $auth_user    = Auth::user();
		
/* 		$commentedBy = WithdrawalComment::select('withdrawal_comments.*', 'users.first_name', 'users.last_name')
		                ->leftjoin('users', 'users.id', 'withdrawal_comments.created_by')
		                  
						->where('withdrawal_comments.withdrawal_id', '=', $id)
						  
		               // ->where('users.id', '=',$id)
						->first();  */
					//	dd($ommentBy);
						
						
/* 		$withdrawalComments = Withdrawal::select('withdrawals.*', 'withdrawal_comments.withdrawal_request_date', 'withdrawal_comments.upload_withdrawal_receipt','withdrawal_comments.withdrawal_receipt_no','withdrawal_comments.withdrawal_comment','withdrawal_comments.withdrawal_status')
		         ->leftjoin('withdrawal_comments', 'withdrawal_comments.withdrawal_id', 'withdrawals.id')
		         ->where('withdrawal_comments.withdrawal_id', '=',$id)
				 ->orderBy('withdrawals.id','DESC')
				 ->first(); */
				 
				 
/* 	   $withdrawalComments = Withdrawal::select('withdrawals.*', 'users.first_name', 'users.last_name')
		                   ->leftjoin('users', 'users.id','=', 'withdrawals.created_by')
		                 // ->where('withdrawals.buyer_id', '=', $id)
						  // ->orderBy('withdrawals.id','DESC')
						   ->first(); */
				 
		//dd($withdrawalComments);		
       
        return view('withdraws.show',compact('withdrawalComments'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id): View
    {
        $withdrawal = Withdrawal::find($id);
       
        return view('withdraws.edit',compact('withdrawal'));
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
    
        $withdrawal = Withdrawal::find($id);
        $withdrawal->name = $request->input('name');
        $withdrawal->save();
    
        return redirect()->route('withdraws.index')
                        ->with('success','Withdrawal updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id): RedirectResponse
    {
        DB::table("withdrawals")->where('id',$id)->delete();
		
        return redirect()->route('withdraws.index')
                        ->with('success','Withdrawal deleted successfully');
    }
	
	public function withdrawalLog()
    {
	    $auth_user    = Auth::user();
		
		$withdrawalComments = WithdrawalComment::select('withdrawal_comments.*', 'users.first_name', 'users.last_name')
		                ->leftjoin('users', 'users.id', 'withdrawal_comments.created_by')
		                  
						   // ->where('withdrawal_comment.fund_id', '=', $auth_user->id)
						  
		                ->where('users.id', '=', $auth_user->id)
						->get();
		
       return view('withdraws.withdraw_log',compact('withdrawalComments')); 
    }

//date 30-12-2023 

public function addWithdrawalComment(Request $request, $id){
	    
	   $input     = $request->all();
	   
	   unset($input['_token']);
	   
	   $auth_user = Auth::user();
	   
	   //$input['withdrawal_from'] = $auth_user->id;
	   
	  // $input['created_by']    = $auth_user->id;
	   
	   $input['verified_by'] = $auth_user->id;
	   	
	   if($request->hasfile('upload_withdrawal_receipt')){
            
            $fileName_upload_withdrawal_receipt = time().'.'.$request->upload_withdrawal_receipt->extension();  

            $request->upload_withdrawal_receipt->move(public_path('uploads/withdrawal/upload_withdrawal_receipt'), $fileName_upload_withdrawal_receipt);
            
            $input['upload_withdrawal_receipt'] = $fileName_upload_withdrawal_receipt;
			//dd($input);
            
        }else{
            unset($input['upload_withdrawal_receipt']);          
        }
        
        $withdrawalReqData = DB::table('withdrawals')->where('id','=',$id)->first();
        	
         //dd($request->account_paid_amount,$withdrawalReqData->withdrawal_request_amount);
        
        if($request->account_paid_amount > $withdrawalReqData->withdrawal_request_amount){
        			
          return back()->with('success','Withdrawal requested amount should be less than or equal to paid amount');
        	
        }   
        	   
        if($request->withdrawal_status == 'Paid'){
        	
         DB::table('withdrawals')->where('id','=',$id)->update(['withdrawal_status'=>$request->withdrawal_status,
        														'withdrawal_date'=>$request->withdrawal_date,
        														'account_paid_amount'=>$request->account_paid_amount,
        														'withdrawal_amount'=>$request->account_paid_amount,
        														'withdrawal_receipt_no'=>$request->withdrawal_receipt_no,
        														'upload_withdrawal_receipt'=>$input['upload_withdrawal_receipt'], 
        														'verified_by'=>$request->verified_by,
        														'withdrawal_comment'=>$request->withdrawal_comment]);
        														
        }else{
        	
        DB::table('withdrawals')->where('id','=',$id)->update(['withdrawal_status'=>$request->withdrawal_status,'withdrawal_comment'=>$request->withdrawal_comment]);
        	
        }
     //DB::table('withdrawals')->where('id','=',$id)->update($input);
	  
	 //Update Data Ledger Table Date-24-07-2024 Start
		
		 $withdrawalData = DB::table('withdrawals')->where('id','=',$id)->where('withdrawal_status','=','Paid')->first();
	    
		if(!empty($withdrawalData)){
			
		 $withdrawalID    = $withdrawalData->id;
	     $buyer_seller_id = $withdrawalData->withdrawal_from;		 
	     $paymentFundId   = $withdrawalData->payment_withdrawal_id;
	     $ledgerFundType  = $withdrawalData->withdrawal_type;
	     $ledgerFundFor   = $withdrawalData->withdrawal_for;
	     $ledgerDate      = $withdrawalData->withdrawal_date;
	     $ledgerAmount    = intval($withdrawalData->withdrawal_amount);
		 
		 $ledger_arr = [
                      'created_by'        => $withdrawalData->created_by,
                      'withdrawal_id'     => $withdrawalID,
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
	   
	   return back()->with('success','Withdrawal Amount Status Updated Successfully!!');
    
   }

}
