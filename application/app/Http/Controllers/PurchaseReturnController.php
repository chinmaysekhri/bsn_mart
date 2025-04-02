<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Employee;
use App\Models\Seller;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Purchasereturn;
use App\Models\Ledger;
use App\Models\Task;
use App\Models\Fund;
use App\Models\Withdrawal;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Arr;
use Illuminate\View\View;
use App\Models\HasApiTokens;
use Illuminate\Http\RedirectResponse;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\Builder;
use Auth;
use DB;
use Hash;

class PurchaseReturnController extends Controller
{
    
	
 	 function __construct()
     {
         $this->middleware('permission:purchasereturn-list|purchasereturn-create|purchasereturn-edit|purchasereturn-delete', ['only' => ['index','store']]);
         $this->middleware('permission:purchasereturn-create', ['only' => ['create','store']]);
         $this->middleware('permission:purchasereturn-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:purchasereturn-delete', ['only' => ['destroy']]);
     } 
	
	/**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {

		//Date	01-08-2024		  
					  
	    $per_page    = 15;
        
        $auth_user   = Auth::user();
        
        $is_admin    = $auth_user->for;

    /*    if($is_admin == 'super_admin'){
        
        $buyerSellerData   = User::where('for','=','seller')
                         //->orWhere('for','=','buyer')
                           ->orderBy('id','DESC')->get();
              
           
        }else{
          
        $buyerSellerData  = User::where('for','=','seller')
                        
                                    ->where(function ($query) use ($auth_user){ 
                                       $query->where('created_by','=',$auth_user->id)
                                      ->orWhere('managed_by','=',$auth_user->id)
                                      ->orWhere('id','=',$auth_user->id);
                                      })->orderBy('id','DESC')
                                     
                                      ->get();
            } */ 
            
        // New Code Update 07-03-2025
		
	
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
        
			$data_collection = Purchasereturn::when($request->q,function (Builder $builder) use ($request) {
									$builder->where('warehouse_name', 'like', "%{$request->q}%");
									
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
           
           //dd(intval($request->seller_buyer_data));
		   
				   $user_data      = User::find($request->seller_buyer_data);
				  
				   $seller_id_data = json_encode([''.$user_data->seller_id]);
				 
				   if(!empty($seller_id_data)){
							  $builder->where('seller_id', '=', $seller_id_data);
									 // ->orWhere('managed_by', '=', $request->seller_buyer_data);
							}
						 }
					  )
        
                    ->orderBy('id','DESC'); 
          
      
                    if($is_admin == 'super_admin'){
                        
                    $data = $data_collection->paginate($per_page);
                        
                    }elseif($is_admin == 'seller'){
            
            
      
          
                    $sellerId = json_encode([''.$auth_user->seller_id]);
          
            
                    $data = $data_collection->where('seller_id','=',$sellerId)->paginate($per_page);

          
                    }
                    
               
     
            $requested_input = $request->all();
     
            return view('purchasereturns.index',compact('requested_input','buyerSellerData','data'))
            ->with('i', ($request->input('page', 1) - 1) * $per_page); 		  
					  
					  
					  

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
		 $auth_user    = Auth::user();	
		
		 //$sellerData   = Seller::where('created_by','=',$auth_user->id)->orderBy('id','DESC')->get();
		
		 // 07-03-2025 $sellerData   = Seller::orderBy('id','DESC')->get();
		
		 // New Code Update 07-03-2025
		
		 $is_admin    = $auth_user->for;
		 
		 if($is_admin == 'super_admin'){
        
         $sellerData   = User::where('for','=','seller')
                               ->orWhere('for','=','buyer')
                             //  ->orWhere('for','=','employee')
							   ->where('status','!=',0)
				               ->whereNull('deleted_at')
                               ->orderBy('id','DESC')->get();
    
         }elseif($is_admin == 'buyer'){
          
         $sellerData  = User::where('for','=','buyer')
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
				
		   $sellerData  = User::where('for','=','seller')
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

		    $sellerData = User::whereIn('id',$user_ids2) 
		                              ->whereIn('for',['seller','buyer'])
		                              ->where('status','!=',0)
								      // ->where('id','!=',$auth_user->id)
				                      ->whereNull('deleted_at')
			                          ->orderBy('id','DESC')
			                          ->get();
		
            }
		 
		 $productID    = Product::orderBy('id','DESC')->get();
		 
         return view('purchasereturns.create',compact('sellerData','productID'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $this->validate($request, [
          // 'first_name' => 'required',
           //'last_name' => 'required',
        ]);
    
        $input               = $request->all();
		
		$auth_user           = Auth::user();
		
	    $sellerId            = $input['seller_id'][0];
		
		$userSellerData      = User::where('seller_id','=',$sellerId)->first();
		
		$auth_sellerid       = $userSellerData->id;
		
		$input['created_by'] = $auth_user->id;
   
		$input['seller_id']           = json_encode($request->seller_id);
		//$input['seller_id']           = $request->seller_id);
		$input['product_id']          = json_encode($request->product_id);
		$input['product_name']        = json_encode($request->product_name);
		$input['product_quantity']    = json_encode($request->product_quantity);
		$input['product_price']       = json_encode($request->product_price);
		$input['total_product_price'] = json_encode($request->total_product_price);
		
		$purchase_return     = Purchasereturn::create($input);	
		
		//dd($purchase_return->id);
		
		
        //Update data fund table date-25-04-2024 Start
	  
	     /* $purchase_return  = Purchasereturn::create($input);		
         $fundDate            = date("Y-m-d");
         $fundStatus          = 'Confirmed';
		 $paymentPurchaseId   = IdGenerator::generate(['table' => 'purchasereturns', 'length' => 20,'field' => 'product_id', 'prefix' =>'PRID'.''.date('Y').''.date('m').''.date('d').''.date('i').''.rand(0, 9999).''.$auth_user->id]);
	
		 $fund_arr = [
                      'created_by'        => $input['created_by'],
                      //'seller_id'         => implode(",",$request->seller_id),
                     // 'buyer_id'          => implode(",",$request->seller_id),
                      'buyer_id'          => $auth_sellerid,
                      'fund_to'           => $auth_sellerid, 
                      'payment_fund_id'   => $paymentPurchaseId,
					  'fund_for'          => 'Purchase Return',
					  'fund_type'         => 'Credit',
					  'fund_date'         => $fundDate,
					  'fund_status'       => $fundStatus,
					  //'fund_amount'       => $input['total_product_price'],
					 'fund_amount'        => $request->purchase_final_total, 
                    ];
			 
        $funds = Fund::create($fund_arr); */
		
	  //Update data fund table date-25-04-2024 End	
	  
	  
		
	 //Update data fund table date 09-07-2024 Start
		
		$withdrawalDate      =  date("Y-m-d");
		
        $withdrawalStatus    = 'Paid';
		
        $paymentPurchaseId   = IdGenerator::generate(['table' => 'purchasereturns', 'length' => 20,'field' => 'product_id', 'prefix' =>'PRID'.''.date('Y').''.date('m').''.date('d').''.date('i').''.rand(0, 9999).''.$auth_user->id]);
	
		$withdrawal_arr = [
		 
                      'created_by'             => $input['created_by'],
					  'buyer_id'               => $auth_sellerid,
                      'withdrawal_from'        => $auth_sellerid, 
                      'payment_withdrawal_id'  => $paymentPurchaseId,
					  'purchase_returns_id'    => $purchase_return->id,
					  'withdrawal_for'         => 'Purchase Return',
					  'withdrawal_type'        => 'Debit',
					  'withdrawal_date'        => $withdrawalDate,
					  'withdrawal_status'      => $withdrawalStatus,
					  'account_paid_amount'    => intval($purchase_return->purchase_final_total),
                      'withdrawal_amount'      => intval($purchase_return->purchase_final_total),
                      
                    ];
		
        $withdrawal = Withdrawal::create($withdrawal_arr);
		
		
		 //Update data fund table date 09-07-2024 End
		
       
	     //Update Data Ledger Table Date-30-07-2024 Start
	  
	    
		 $purchaseSellerID  = User::where('seller_id','=',$sellerId)->first();	
		
	     $purchaseReturnId  = $purchase_return->id;	
	     //$buyer_seller_id = $purchaseSellerID->id;		 	     
	     $buyer_seller_id   = $auth_sellerid;		 	     
	     $ledgerFundType    = 'Debit';
	     $ledgerFundFor     = 'Purchase Return';
	     $ledgerDate        = $withdrawalDate;
	     $ledgerAmount      = intval($purchase_return->purchase_final_total);
		 
		 $ledger_arr = [
                      'created_by'        => $input['created_by'],
                      'purchase_return_id'=> $purchaseReturnId,
                      'buyer_seller_id'   => $buyer_seller_id,
                      'ledger_order_id'   => $paymentPurchaseId, 
                      'ledger_type'       => $ledgerFundType,
                      'ledger_for'        => $ledgerFundFor,
					  'ledger_date'       => $ledgerDate,
					  'ledger_amount'     => $ledgerAmount, 
                    ];
		   
         $ledger   = Ledger::create($ledger_arr); 
	 
	   
	   //Update Data Ledger Table Date-30-07-2024 End
	   
	  
        return redirect()->route('purchasereturns.index')
                        ->with('success','Purchasereturn created successfully');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
		$auth_user    = Auth::user();
		
		$purchasereturn     = Purchasereturn::find($id);
        //$user_emp_manage = User::where('id','=',$user->managed_by)->first();
        return view('purchasereturns.show',compact('purchasereturn'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
		
		 $auth_user    = Auth::user();
		 
		 $is_admin  = $auth_user->for;
		 
		 //$sellerData   = Seller::orderBy('id','DESC')->get();
		 
		 // New Code Update 07-03-2025
		
		 $is_admin    = $auth_user->for;
		 
		 if($is_admin == 'super_admin'){
        
         $sellerData   = User::where('for','=','seller')
                               ->orWhere('for','=','buyer')
                             //  ->orWhere('for','=','employee')
							   ->where('status','!=',0)
				               ->whereNull('deleted_at')
                               ->orderBy('id','DESC')->get();
    
         }elseif($is_admin == 'buyer'){
          
         $sellerData  = User::where('for','=','buyer')
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
				
		   $sellerData  = User::where('for','=','seller')
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

		    $sellerData = User::whereIn('id',$user_ids2) 
		                              ->whereIn('for',['seller','buyer'])
		                              ->where('status','!=',0)
								      // ->where('id','!=',$auth_user->id)
				                      ->whereNull('deleted_at')
			                          ->orderBy('id','DESC')
			                          ->get();
		
            }
		 
		 $productID    = Product::orderBy('id','DESC')->get();
		 
		 $purchasereturn     = Purchasereturn::find($id);
		 
		 $seller_ids = json_decode($purchasereturn->seller_id, true);
		 
		 $purchaseProductData = Product::orderby('id', 'desc')
	                         ->whereIn('seller_id', $seller_ids)  
							//->pluck('seller_id')			 
							->get();
		// dd($purchase);
		
	   // 11-03-2025 for hold value after search data hold 
		
        $request         = request();
		
        $requested_input = $request->all();
		
	   // 11-03-2025 for hold value after search data hold
      return view('purchasereturns.edit',compact('sellerData','productID','purchasereturn', 'purchaseProductData','requested_input'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
       $this->validate($request, [
           // 'first_name' => 'required',
           //'last_name' => 'required',
        ]);
    
	    $purchasereturn      = Purchasereturn::find($id);
	   
        $input               = $request->all();
        
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
		
		$sellerId            = $input['seller_id'][0];
		
		$userSellerData      = User::where('seller_id','=',$sellerId)->first();
		
		$auth_sellerid       = $userSellerData->id;
		
		$auth_user           = Auth::user();
		
		$input['created_by'] = $auth_user->id;
		
		$input['seller_id']           = json_encode($request->seller_id);
		$input['product_id']          = json_encode($request->product_id);
		$input['product_name']        = json_encode($request->product_name);
		$input['product_quantity']    = json_encode($request->product_quantity);
		$input['product_price']       = json_encode($request->product_price);
		$input['total_product_price'] = json_encode($request->total_product_price);
	
		
        $purchasereturn->update($input);
		
	    //Update data fund table date-27-04-2024 Start
		
		// $fund       = Fund::where('buyer_id','=',$purchasereturn->buyer_id)->first();
						   
		// $fund       = Fund::find($id);			   	
        // $fundDate   = date("Y-m-d");
        // $fundStatus = 'Confirmed';
		 
		//$paymentPurchaseId   = IdGenerator::generate(['table' => 'purchasereturns', 'length' => 20,'field' => 'product_id', 'prefix' =>'PRID'.''.date('Y').''.date('m').''.date('d').''.date('i').''.rand(0, 9999).''.$auth_user->id]);
	
/* 		 $fund_arr = [
                      'created_by'        => $input['created_by'],
                      'buyer_id'          => $auth_sellerid,
                      'fund_to'           => $auth_sellerid, 
                    //  'payment_fund_id'   => $paymentPurchaseId,
					  'fund_for'          => 'Purchase Return',
					  'fund_type'         => 'Credit',
					  'fund_date'         => $fundDate,
					  'fund_status'       => $fundStatus,
					  //'fund_amount'     => $input['total_product_price'],
					 'fund_amount'        => $purchasereturn->purchase_final_total, 
                    ];
       
		$fund->update($fund_arr); */
		
       //Update data fund table date-27-04-2024 End
		
		 
	//Update data fund table date-12-04-2024 Start
	
	    $withdrawal         = Withdrawal::where('purchase_returns_id','=',$purchasereturn->id);
	
	    $withdrawalDate      =  date("Y-m-d");
		
        $withdrawalStatus    = 'Paid';
		
       // $paymentPurchaseId   = IdGenerator::generate(['table' => 'purchasereturns', 'length' => 20,'field' => 'product_id', 'prefix' =>'PRID'.''.date('Y').''.date('m').''.date('d').''.date('i').''.rand(0, 9999).''.$auth_user->id]);
	
		$withdrawal_arr = [
		 
                      'created_by'             => $input['created_by'],
					  'buyer_id'               => $auth_sellerid,
                      'withdrawal_from'        => $auth_sellerid, 
                      //'payment_withdrawal_id'  => $paymentPurchaseId,
					  //'purchase_returns_id'    => $purchasereturn->id,
					  'withdrawal_for'         => 'Purchase Return',
					  'withdrawal_type'        => 'Debit',
					  'withdrawal_date'        => $withdrawalDate,
					  'withdrawal_status'      => $withdrawalStatus,
					  'account_paid_amount'    => intval($purchasereturn->purchase_final_total),
                      'withdrawal_amount'      => intval($purchasereturn->purchase_final_total),
                      
                    ];
		
		//dd($withdrawal_arr,$purchase_return->purchase_final_total);	
	
		$withdrawal->update($withdrawal_arr);
	
	   //Update data fund table date-12-04-2024 End
	   
	   
		 
	  //Update Data Ledger Table Date-30-07-2024 Start
	  
	     $ledger      = Ledger::where('purchase_return_id','=',$purchasereturn->id);
	 
	     $buyer_seller_id = $auth_sellerid;		 	     
	     $ledgerFundType  = "Debit";
	     $ledgerFundFor   = "Purchase Return";
	     $ledgerDate      = $withdrawalDate;
	     $ledgerAmount    = intval($purchasereturn->purchase_final_total);
		 
		 $ledger_arr = [
                      'created_by'        => $input['created_by'],
                      'buyer_seller_id'   => $buyer_seller_id,
                     //'ledger_order_id'   => $paymentPurchaseId, 
                      'ledger_type'       => $ledgerFundType,
                      'ledger_for'        => $ledgerFundFor,
					  'ledger_date'       => $ledgerDate,
					  'ledger_amount'     => $ledgerAmount, 
                    ];

		 $ledger->update($ledger_arr);

	   //Update Data Ledger Table Date-30-07-2024 End	 
		 
        return redirect()->route('purchasereturns.index',$requested_input)
                        ->with('success','Update Purchase Return Successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Purchasereturn::find($id)->delete();
		
        return redirect()->route('purchasereturns.index',$requested_input)->with('success','Purchase Return Deleted Successfully!');
    }
	
// 24-04-2024

    public function purchaseEdit()
     {
         return view('purchasereturns.edit');
     }
	 
    public function purchaseShow()
    {
        return view('purchasereturns.show');
    }
	
	//16-02-2025
	
	public function getPurchaseReturnProductData(Request $request)
    {
       $input      = $request->all();
	   
       //dd($input);
	   
	   if($request->has('action_for') && $request->action_for == 'get_product_name'){
		   
		$purchaseProductData = Product::orderby('id', 'desc')
	                         ->where('id','=',$request->product_id)  
							//->pluck('seller_id')			 
							->get()->toArray();	
							
		$action_for =    $request->action_for;
		$position =    $request->position;
		
	   }else{
		   
	   $purchaseProductData = Product::orderby('id', 'desc')
	                         ->where('seller_id','=',$request->seller_id)  
							//->pluck('seller_id')			 
							->get()->toArray();

		$action_for =    '';
		$position =    '';							
	   }

							
		//dd($purchaseProductData);
		
         return response()->json(['purchaseProductData' =>$purchaseProductData,'action_for'=>$action_for, 'position'=>$position]);
    }
	
	
}
