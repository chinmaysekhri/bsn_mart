<?php
    
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Wallet;
use App\Models\Withdrawal;
use App\Models\WithdrawalComment;
use App\Models\FundComment;
use App\Models\Ledger;
use App\Models\Fund;
use App\Models\Order;
use App\Models\Purchase;
use App\Models\Purchasereturn;
use App\Models\Product;
use App\Models\DeliveredProduct;
use App\Models\User;
use App\Helpers\Helper;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use DB;
use Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Database\Eloquent\Builder;
    
class WalletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:wallet-list|wallet-create|wallet-edit|wallet-delete', ['only' => ['index','store']]);
         $this->middleware('permission:wallet-create', ['only' => ['create','store']]);
         $this->middleware('permission:wallet-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:wallet-delete', ['only' => ['destroy']]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request): View
    {
	    
		$auth_user = Auth::user();
		
		
		
		if($request->has('buyer_seller_id')){
		
		$buyer_seller_id    = $request->buyer_seller_id;	
		}
		else
		{
		  $buyer_seller_id  = "";	
		}
		
		$wallet_data       = Helper::getWalletData($buyer_seller_id);	
		
		$totalAddFund      = $wallet_data['total_added_fund'];
						
		$totalWithdrawal   = $wallet_data['total_withdrawal_fund'];
									   
		$totalWalletAmount = $wallet_data['total_wallet_amount'];
			
/*		if($auth_user->for == 'buyer'){
				
			$getEmployeeData   = User::select('users.*')
		                       ->where('id', '=',$auth_user->id)
		                       ->orderBy('id','DESC')
							   ->get(); 
			}
			
			elseif($auth_user->for == 'seller'){
			
			$getEmployeeData  = User::select('users.*')
		                      ->where('id', '=',$auth_user->id)
		                       ->orderBy('id','DESC')
							   ->get(); 
			}
			else{
				
			$getEmployeeData = User::select('users.*')
		                     ->where('for','buyer')
		                     ->orWhere('for','seller')
		                     ->orderBy('id','DESC')
							 ->get(); 
			}*/	
		// New Code Update 07-03-2025
		
		 $is_admin    = $auth_user->for;
		 
		 if($is_admin == 'super_admin'){
        
         $getEmployeeData   = User::where('for','=','seller')
                               ->orWhere('for','=','buyer')
                             //  ->orWhere('for','=','employee')
							   ->where('status','!=',0)
				               ->whereNull('deleted_at')
                               ->orderBy('id','DESC')->get();
    
         }elseif($is_admin == 'buyer'){
          
         $getEmployeeData  = User::where('for','=','buyer')
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
				
		   $getEmployeeData  = User::where('for','=','seller')
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

		    $getEmployeeData = User::whereIn('id',$user_ids2) 
		                              ->whereIn('for',['seller','buyer'])
		                              ->where('status','!=',0)
								      // ->where('id','!=',$auth_user->id)
				                      ->whereNull('deleted_at')
			                          ->orderBy('id','DESC')
			                          ->get();
		
				
            }	
			
			
        
		// Admin show total add fund and total withdrwal amount 17-09-2024
		// Update date-03-12-2024
		$adminTotalAddFund  = Fund::where('fund_status', '=', 'Confirmed')
		                            ->where('fund_for', '=', 'Payment')
		                             //->where('created_by', '=', $auth_user->id)
		                             // ->where('fund_to', '=', $buyer_seller_id)
                                    ->sum('fund_amount');
						
						
						
		$adminTotalWithdrawal = Withdrawal::where('withdrawal_status', 'Paid')
		                              ->where('withdrawal_for', '=', 'Withdraw')
		                              // ->where('created_by', '=', $auth_user->id)
		                              // ->where('withdrawal_from', '=', $buyer_seller_id)
                                       ->sum('withdrawal_amount');
									   		
		// Admin show total add fund and total withdrwal amount 17-09-2024 End	
  		
	
	   // Admin show total add fund and total Order amount 23-12-2024 Start
	   
	
		$all_buyer_seller_wallet_data = Helper::getAllWalletData();
		
      
	    $totalAvailabeFund           =  array_sum(array_column($all_buyer_seller_wallet_data, 'total_wallet_amount'));
		
		//$totalAvailabeFund         = Fund::sum('fund_amount');
				
		$totalPurchaseInPending      = Order::where('order_status','Pending')->sum('total_buy_price');
		
	
	  // Admin show total add fund and total Order amount 23-12-2024 End
	  
	  
	// Date 23-01-2025 Total Pending Purchase Start 
			
		 $sellerOrder = Order::orderby('id', 'desc')
						->pluck('cart_product_detail')
						->toArray();
		 $sellerOrder = implode(',', $sellerOrder);
		 $sellerOrder = str_replace('[', '', $sellerOrder);
		 $sellerOrder = str_replace(']', '', $sellerOrder);
		 $sellerOrder = '['.$sellerOrder.']';
		 
		 $sellerOrder = json_decode($sellerOrder, true);
		// dd($sellerOrder);
		 $myArr       = $sellerOrder;
		
		 $myArr2         = $sellerOrder;
		
		 $result2 = array_reduce($myArr2, function($carry, $item){ 
			if(!isset($carry[$item['product_id']])){ 
				
			//	$carry[$item['product_id']] = ['product_id'=>$item['product_id'],'prod_qty'=>$item['prod_qty']]; 
				
				$carry[$item['product_id']] = ['product_id'=>$item['product_id'],'prod_qty'=>$item['prod_qty'] ,'master_packing'=>$item['master_packing']];
			} else { 
				$carry[$item['product_id']]['prod_qty'] += $item['prod_qty']; 
			} 
			return $carry; 
		});
		
		
		 // $myArr is your origional array.
		 
			$result_arr = [];
			
			array_walk($myArr,function($v,$k) use (&$result_arr){
				
			$result_arr[key($v)][] = $v[key($v)]; 
			
			});
			//dd($result_arr,$myArr, $result2);
			$productOrderData =[];
			
            if(!empty($result_arr)){
			
			$productIDS       = $result_arr['product_id'];

			$uniqueProductIDS = array_unique($productIDS);
			
			$productIDSCount  = array_count_values($productIDS);
			
			foreach($uniqueProductIDS as $product_id){

			$productDetail           = Product::find($product_id);
			
			$totalProductQty  = (!empty($result2[$product_id]['prod_qty'])) ? $result2[$product_id]['prod_qty']:0;
			
			$productMasterPacking  = (!empty($result2[$product_id]['master_packing'])) ? $result2[$product_id]['master_packing']:0;
			
			if(!empty($productDetail->master_packing)){
				
		//	$totalProductQty  = ($totalProductQty * $productDetail->master_packing);
			
			$totalProductQty  = ($totalProductQty * $productMasterPacking);
			
			}
			
			
			$productIDSCount2 = Order::where('order_status','=','Delivered')
		                 ->where('cart_product_detail', 'like',  '%"product_id":"'.$product_id.'"%')
						 ->count();
						 
			$product_delivered_qty_arr = DeliveredProduct::select('product_id', DB::raw('SUM(delivered_product_qty) AS delivered_product_qty_total'))
			                         ->where('product_id','=',$product_id)->groupBy('product_id')
									 ->pluck('delivered_product_qty_total')->toArray();
									 
									
			if(!empty($product_delivered_qty_arr)){
				
				 $product_delivered_qty = $product_delivered_qty_arr[0];
			 }
			 else{
				 
				$product_delivered_qty = 0;
			 }
		   
			if(!empty($productDetail->seller_id)){
				
			$productSellerID         = json_encode(array(''.$productDetail->seller_id));
		
			}
			if(!empty($productDetail->id)){
			    
			$purchaseProductID       = ''.$productDetail->id;
			
			}
			$purchaseProductIdArr   = Purchase::where('seller_id','=',$productSellerID)->where('product_id', 'like', "%{$purchaseProductID}%")->pluck('product_id')->toArray();
			
			$purchaseProductQtyArr  = Purchase::where('seller_id','=',$productSellerID)->where('product_id', 'like', "%{$purchaseProductID}%")->pluck('product_quantity')->toArray();
		
			$pro_qty = 0;
			
			foreach($purchaseProductIdArr as $pro_key=>$pro_val){
				
				$pro_val_arr = json_decode($pro_val,true);
				
				$i_key = array_search($purchaseProductID, $pro_val_arr);
				
				$pro_qty_arr = json_decode($purchaseProductQtyArr[$pro_key]);
				
	          //dd($pro_val_arr,$i_key,$pro_qty_arr);
				
				$pro_qty += ($pro_qty_arr[$i_key]);
				
		
			}
			
			if(!empty($productDetail->id) || !empty($productDetail->product_photo) || !empty($productDetail->price)){
				
			$productOrderData[]  = ['total_order'=>$totalProductQty, 'total_delivered'=>$pro_qty,'product_price'=>$productDetail->price];
		
			}
			unset($productDetail);
        }
       
	   }
	  
	   // Date 23-01-2025 Get Total Pending Purchase End  
	  
		
	  return view('wallets.index',compact('productOrderData','totalAvailabeFund','totalPurchaseInPending','adminTotalAddFund','adminTotalWithdrawal','totalAddFund','totalWithdrawal','totalWalletAmount', 'wallet_data','getEmployeeData'));
    }

    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
       
        return view('wallets.create');
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
            'name' => 'required|unique:wallets,name',
            'permission' => 'required',
        ]);
    
        $wallet = Wallet::create(['name' => $request->input('name')]);
      
    
        return redirect()->route('wallets.index')
                        ->with('success','Wallet created successfully');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id): View
    {
        $wallet = Wallet::find($id);
       
        return view('wallets.show',compact('wallet'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id): View
    {
        $wallet = Wallet::find($id);
       
        return view('wallets.edit',compact('wallet'));
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
    
        $wallet = Wallet::find($id);
        $wallet->name = $request->input('name');
        $wallet->save();
    
        return redirect()->route('wallets.index')
                        ->with('success','Wallet updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id): RedirectResponse
    {
        DB::table("wallets")->where('id',$id)->delete();
        return redirect()->route('wallets.index')
                        ->with('success','Wallet deleted successfully');
    }
	
	
   public function viewWalletHistory()
    {
          $request = request();
		  
          $this->validate($request, [
           
		   'buyer_seller_id' => 'required',
		   
		   ], [
            'buyer_seller_id.required' => 'Select Buyer or Seller',
         ]);
		 
        $buyerSellerID = $request->buyer_seller_id;
		
       //dd($buyerSellerID);

/* 

	   $withdrawalHistory = Withdrawal::select('withdrawals.*')
	                       ->where('withdrawal_status', 'Paid')
		                   ->where('withdrawal_from', '=', $buyerSellerID)
						   ->orderBy('withdrawals.id','DESC')
						   ->get(); 
		//dd($withdrawalHistory);
		
	   $fundHistory = Fund::select('funds.*')
	                       ->where('fund_status', 'Confirmed')
		                   ->where('fund_to', '=', $buyerSellerID)
						   ->orderBy('funds.id','DESC')
						   ->get();  */
		
        $ledgerHistory = Ledger::select('ledgers.*')
		                   ->where('buyer_seller_id', '=', $buyerSellerID)
						   ->orderBy('id','DESC')
						   ->get();

		
        return view('wallets.view_wallet_history',compact('ledgerHistory'));
    }
	
}

