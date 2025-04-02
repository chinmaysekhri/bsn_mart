<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Employee;
use App\Models\Seller;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Ledger;
use App\Models\Task;
use App\Models\Fund;
use App\Models\Withdrawal;
use App\Models\PurchaseProduct;
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

class PurchaseController extends Controller
{
   function __construct()
     {
         $this->middleware('permission:purchases-list|purchases-create|purchases-edit|purchases-delete', ['only' => ['index','store']]);
         $this->middleware('permission:purchases-create', ['only' => ['create','store']]);
         $this->middleware('permission:purchases-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:purchases-delete', ['only' => ['destroy']]);
     }
	
	/**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {

	//date01-08-2024				  
					  
	    $per_page    = 15;
        
        $auth_user   = Auth::user();
        
        $is_admin    = $auth_user->for;

/*	   if($is_admin == 'super_admin'){
        
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
						   
            }
	  
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
            
        $data_collection = Purchase::when($request->q,function (Builder $builder) use ($request) {
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
     
             return view('purchases.index',compact('requested_input','buyerSellerData','data'))
            ->with('i', ($request->input('page', 1) - 1) * $per_page); 


			

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
		 $auth_user    = Auth::user();	
		
		// $sellerData   = Seller::orderBy('id','DESC')->where('status','!=',0)->get();
		
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
		 
		 //$productName  = Product::orderBy('id','DESC')->get();
		 
         return view('purchases.create',compact('sellerData','productID'));
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
    
        $input        = $request->all();
		
		
		
		$auth_user    = Auth::user();
		
		$sellerId     = $input['seller_id'][0];
		
		//dd($input,intval($sellerId));
		
		$userSellerData      = User::where('seller_id','=',$sellerId)->first();
		
		$auth_sellerid       = $userSellerData->id;
	
		$input['created_by'] = $auth_user->id;
		
        //$input['buyer_id']   = $auth_user->id;
		
		//$input['buyer_id']          = json_encode($request->seller_id);
		
		$input['seller_id']           = json_encode($request->seller_id);
		$input['product_id']          = json_encode($request->product_id);
		$input['product_name']        = json_encode($request->product_name);
		$input['product_quantity']    = json_encode($request->product_quantity);
		$input['product_price']       = json_encode($request->product_price);
		$input['total_product_price'] = json_encode($request->total_product_price);
		
		//dd($input);
		
	    $purchase = Purchase::create($input);
		
	   // for product stock maintain date 21-01-2025 Start

            $product_ids = $request->product_id;
		
			$product_quantitys = $request->product_quantity;	

			$ipq = 0;

			foreach($product_ids as $product_id){

			if(!empty($product_quantitys[$ipq])){

			$product_quantity = $product_quantitys[$ipq];

			}else{
			  $product_quantity = 0;
			}

			$input_create = ['product_id'=>$product_id, 'purchase_product_qty'=>$product_quantity, 'created_by'=>$auth_user->id, 'purchase_id'=>$purchase->id];

			PurchaseProduct::create($input_create);

			unset($input_create);
			$ipq = ($ipq +1);

			}
	  // for product stock maintain date21-01-2025 End
		
		
	  //Update Data Withdrawal Table Date-09-07-04-2024 Start
	  
         $fundDate            = date("Y-m-d");
         $fundStatus          = 'Confirmed';
		 $paymentPurchaseId   = IdGenerator::generate(['table' => 'purchases', 'length' => 20,'field' => 'product_id', 'prefix' =>'PID'.''.date('Y').''.date('m').''.date('d').''.date('i').''.rand(0, 9999).''.$auth_user->id]);
	
		 $fund_arr = [
                      'created_by'        => $input['created_by'],
                      'buyer_id'          => $auth_sellerid,
                      'fund_to'           => $auth_sellerid, 
                      'payment_fund_id'   => $paymentPurchaseId,
                      'purchases_id'      => $purchase->id,
					  'fund_for'          => 'Purchase',
					  'fund_type'         => 'Credit',
					  'fund_date'         => $fundDate,
					  'fund_status'       => $fundStatus,
					  //'fund_amount'       => $input['total_product_price'],
					 'fund_amount'        => intval($request->purchase_final_total), 
                    ];
			
        $funds = Fund::create($fund_arr); 
	  
	  //Update Data Withdrawal Table Date-09-07-04-2024 End
	  
	  
	  //Update Data Ledger Table Date-29-07-2024 Start
	  
	    
		 $purchaseSellerID   = User::where('seller_id','=',$sellerId)->first();	
		
	     $purchaseId      = $purchase->id;	
	     $buyer_seller_id = $purchaseSellerID->id;		 	     
	     $ledgerFundType  = 'Credit';
	     $ledgerFundFor   = 'Purchase';
	     $ledgerDate      = $fundDate;
	     $ledgerAmount    = intval($request->purchase_final_total);
		 
		 $ledger_arr = [
                      'created_by'        => $input['created_by'],
                      'purchase_id'       => $purchaseId,
                      'buyer_seller_id'   => $buyer_seller_id,
                      'ledger_order_id'   => $paymentPurchaseId, 
                      'ledger_type'       => $ledgerFundType,
                      'ledger_for'        => $ledgerFundFor,
					  'ledger_date'       => $ledgerDate,
					  'ledger_amount'     => $ledgerAmount, 
                    ];
		   
         $ledger   = Ledger::create($ledger_arr); 
	 
	   
	   //Update Data Ledger Table Date-29-07-2024 End
	  
        return redirect()->route('purchases.index')
                        ->with('success','Purchases created successfully');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
		$auth_user    = Auth::user();
		
		$purchase     = Purchase::find($id);
        //$user_emp_manage = User::where('id','=',$user->managed_by)->first();
        return view('purchases.show',compact('purchase'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
		
		 $auth_user    = Auth::user();	
		
		// $sellerData   = Seller::orderBy('id','DESC')->get();
		 
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
		 
		 $purchase     = Purchase::find($id);
		 
		 $seller_ids = json_decode($purchase->seller_id, true);
		 
		 $purchaseProductData = Product::orderby('id', 'desc')
	                         ->whereIn('seller_id', $seller_ids)  
							//->pluck('seller_id')			 
							->get();
		// dd($purchase);
	
	    // 11-03-2025 for hold value after search data hold 
		
        $request         = request();
		
        $requested_input = $request->all();
		
	   // 11-03-2025 for hold value after search data hold	
		
      return view('purchases.edit',compact('sellerData','productID','purchase', 'purchaseProductData','requested_input'));
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
    
	    $purchase  = Purchase::find($id);
	   
        $input     = $request->all();
        
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
		
		$auth_user = Auth::user();	
		
	    $sellerId         = $input['seller_id'][0];
		
		$userSellerData   = User::where('seller_id','=',$sellerId)->first();
		
		$auth_sellerid    = $userSellerData->id;
		//dd($auth_sellerid);
		
		$input['created_by'] = $auth_user->id;
		
		$input['seller_id']           = json_encode($request->seller_id);
		$input['product_id']          = json_encode($request->product_id);
		$input['product_name']        = json_encode($request->product_name);
		$input['product_quantity']    = json_encode($request->product_quantity);
		$input['product_price']       = json_encode($request->product_price);
		$input['total_product_price'] = json_encode($request->total_product_price);
	   
        $purchase->update($input);
		
		
	    // for product stock maintain date 22-01-2025 Start
	  
            PurchaseProduct::where('purchase_id','=',$purchase->id)->forceDelete();
			
            $product_ids = $request->product_id;
		
			$product_quantitys = $request->product_quantity;	

			$ipq = 0;

			foreach($product_ids as $product_id){

			if(!empty($product_quantitys[$ipq])){

			$product_quantity = $product_quantitys[$ipq];

			}else{
			  $product_quantity = 0;
			}

			$input_create = ['product_id'=>$product_id, 'purchase_product_qty'=>$product_quantity, 'created_by'=>$auth_user->id, 'purchase_id'=>$purchase->id];

			PurchaseProduct::create($input_create);

			unset($input_create);
			$ipq = ($ipq +1);

			}
	  
	    // for product stock maintain date 22-01-2025 End
	  
      //Update Data Withdrawal Table Date-10-07-2024 Start
	  
	    // $fund       = Fund::find($id);
		
	     $fund       = Fund::where('purchases_id','=',$purchase->id);
		 
	     $fundDate            = date("Y-m-d");
		 
         $fundStatus          = 'Confirmed';
		 
		 $paymentPurchaseId   = IdGenerator::generate(['table' => 'purchases', 'length' => 20,'field' => 'product_id', 'prefix' =>'PID'.''.date('Y').''.date('m').''.date('d').''.date('i').''.rand(0, 9999).''.$auth_user->id]);
	
		 $fund_arr = [
                      'created_by'        => $input['created_by'],
                      'buyer_id'          => $auth_sellerid,
                      'fund_to'           => $auth_sellerid, 
                     // 'payment_fund_id'   => $paymentPurchaseId,
					 // 'fund_for'          => 'Purchase',
					  'fund_type'         => 'Credit',
					  'fund_date'         => $fundDate,
					  'fund_status'       => $fundStatus,
					  'fund_amount'       => intval($purchase->purchase_final_total), 
                    ];
		
		$fund->update($fund_arr);
		
		
      //Update Data Withdrawal Table Date-10-07-2024 End
	  
	  
	  //Update Data Ledger Table Date-29-07-2024 Start
	  
	   // $ledger      = Ledger::where('purchase_id','=',$purchase->id)->first();
	    $ledger      = Ledger::where('purchase_id','=',$purchase->id);
	    
		//dd($ledger);
		
	     //$purchaseId      = $purchase->id;	
	     $buyer_seller_id = $auth_sellerid;		 	     
	     $ledgerFundType  = "Credit";
	     $ledgerFundFor   = "Purchase";
	     $ledgerDate      = $fundDate;
	     $ledgerAmount    = intval($purchase->purchase_final_total);
		 
		 $ledger_arr = [
                      'created_by'        => $input['created_by'],
                     // 'purchase_id'       => $purchaseId,
                      'buyer_seller_id'   => $buyer_seller_id,
                    //'ledger_order_id'   => $paymentPurchaseId, 
                      'ledger_type'       => $ledgerFundType,
                      'ledger_for'        => $ledgerFundFor,
					  'ledger_date'       => $ledgerDate,
					  'ledger_amount'     => $ledgerAmount, 
                    ];
		   
        // $ledger   = Ledger::create($ledger_arr); 
	   // dd($ledger_arr);
		 $ledger->update($ledger_arr);

	   //Update Data Ledger Table Date-29-07-2024 End
		 
        return redirect()->route('purchases.index',$requested_input)
                        ->with('success','Update Purchases Successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Purchase::find($id)->delete();
        return redirect()->route('purchases.index')->with('success','Add Purchase Deleted Successfully!');
    }
	
	//
   public function purchaseEdit()
    {
         return view('purchases.edit');
    }
     public function purchaseShow()
    {
        return view('purchases.show');
    }
	//16-02-2025
	
	public function getPurchaseProductData(Request $request)
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
	
	//Date 21-01-2025
	public function productStockList(Request $request)
	{
	 
     $per_page = 2;
	 
     $stockProduct = PurchaseProduct::orderBy('id','DESC')->paginate($per_page);
	 
     return view('purchases.stock_product_list',compact('stockProduct'));
	
    }
	
}
