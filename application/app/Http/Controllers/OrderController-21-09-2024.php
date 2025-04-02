<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use App\Models\User;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Purchasereturn;
use App\Models\Wallet;
use App\Models\TransportAddress;
use App\Models\Buyer;
use App\Models\Seller;
use App\Models\Ledger;
use App\Models\Order;
use App\Models\Categories;
use App\Models\SubCategories;
use App\Models\DeliveredProduct;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Arr;
use Illuminate\View\View;
use App\Models\HasApiTokens;
use Illuminate\Http\RedirectResponse;
use Illuminate\Database\Eloquent\Builder;
use Auth;
use DB;
use Hash;
use Carbon\Carbon;

class OrderController extends Controller
{
  
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function index(Request $request): View
    {
/*      $per_page = 1000;
		
		$orders   = Order::when($request->q,function (Builder $builder) use ($request) {
									$builder->where('name', 'like', "%{$request->q}%");
										//->orWhere('email', 'like', "%{$request->q}%");
								}
							)
							->orderBy('id','DESC')
							->paginate($per_page);	
            return view('orders.index',compact('orders'))
            ->with('i', ($request->input('page', 1) - 1) * $per_page); */
			
			
  //       $per_page = 100000;

		// $auth_user = Auth::user();
		
		// $is_admin  = $auth_user->for;
		
		
		// $data_collection = Order::when($request->q,function (Builder $builder) use ($request) {
		// 							$builder->where('name', 'like', "%{$request->q}%");
		// 								//->orWhere('email', 'like', "%{$request->q}%");
		// 						}
		// 					)
		// 					->orderBy('id','DESC');
							
		// 					//->paginate($per_page);
							
		// 			if($is_admin == 'super_admin'){
						
		// 			$orders = $data_collection->paginate($per_page);
						
		// 			}else{
		// 			$orders = $data_collection
		// 			//->where('managed_by','=',$auth_user->id)	
		// 			->where('created_by','=',$auth_user->id)
		// 			->paginate($per_page);	
		// 			}
							
					
  //           return view('orders.index',compact('orders'))
  //           ->with('i', ($request->input('page', 1) - 1) * $per_page);

//Date: 03-08-2024

          
    	   $per_page  = 15;
     
        $auth_user = Auth::user();
   //dd($auth_user->seller_id);
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
			
			$data_collection = Order::when($request->q,function (Builder $builder) use ($request) {
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
               ->when($request->today_applied_status,function (Builder $builder) use ($request) {
         
         if(!empty($request->today_applied_status)){
              $builder->where('order_status', '=', $request->today_applied_status);
                  }
                 }
              )
      
       
          ->when($request->seller_buyer_data,function (Builder $builder) use ($request) {
           
           if(!empty($request->seller_buyer_data)){
                      $builder->where('buyer_seller_id', '=', $request->seller_buyer_data);
                             // ->orWhere('managed_by', '=', $request->seller_buyer_data);
                    }
                 }
              )
        
         
         // ->orderBy('id','DESC')->paginate($per_page);
          ->orderBy('id','DESC');
      
           if($is_admin == 'super_admin'){
          
          
            $orders = $data_collection->paginate($per_page)->appends($request->query());
              
            }else{
                
           if($is_admin == 'seller'){ 
               
             $orders = $data_collection->where('buyer_seller_id','=',$auth_user->id)->paginate($per_page)->appends($request->query());
           
               
           }else{
               
          $user_ids = User::where('created_by','=',$auth_user->id)->orWhere('managed_by','=',$auth_user->id)->pluck('id')->toArray();
                      
             array_push($user_ids,$auth_user->id);
            
             $user_ids2 = User::whereIn('created_by',$user_ids)->orWhereIn('managed_by',$user_ids)->pluck('id')->toArray();
                   
             array_push($user_ids2,$auth_user->id);
                        
             $orders = $data_collection->whereIn('created_by',$user_ids2)->paginate($per_page)->appends($request->query()); 
               
               
           }
           //Customer::whereIntegerInRaw('id', $array)->get();
            
  
            }
      
      
        $requested_input = $request->all();
     
        return view('orders.index',compact('requested_input','buyerSellerData','orders'))
            ->with('i', ($request->input('page', 1) - 1) * $per_page); 

                    
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        $permission = Permission::get();
		
        return view('orders.create',compact('permission'));
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
            //'name' => 'required|unique:roles,name',
            //'permission' => 'required',
        ]);
    
        $input = $request->all();
		
		//dd($input);
		
		$input['transaction_type']  = 'Order';
		
        $order = Order::create($input);
        
    
        return redirect()->route('orders.index')
                        ->with('success','Order created successfully');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id): View
    {
        $order = Order::find($id);
       
        return view('orders.show',compact('order'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id): View
    {
        $order = Order::find($id);
		
        return view('orders.edit',compact('order'));
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
           
        ]);
    
        $order = Order::find($id);
        
		$order->name = $request->input('name');
        $order->save();
        return redirect()->route('orders.index')
                        ->with('success','order updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id): RedirectResponse
    {
        DB::table("orders")->where('id',$id)->delete();
        return redirect()->route('orders.index')
                        ->with('success','Orders deleted successfully');
    } 
	
	
	//
   public function updateOrderStatus(Request $request, $id)
	{
	   $input            = $request->all(); 
	   
	   $auth_user        = Auth::user();
	   
	  // $input['status_updated_by'] = $auth_user->id;
	
	   	if($request->hasfile('upload_lr_receipt')){
            
            $fileName_upload_lr_receipt = time().'.'.$request->upload_lr_receipt->extension();  

            $request->upload_lr_receipt->move(public_path('uploads/order/upload_lr_receipt'), $fileName_upload_lr_receipt);
            
            $input['upload_lr_receipt'] = $fileName_upload_lr_receipt;
            
        }else{
            unset($input['upload_lr_receipt']);          
        } 
		
		if($request->order_status == 'Dispatched'){
			
			 DB::table('orders')->where('id','=',$id)->update(['order_status'=>$request->order_status,'order_update_date'=>$request->order_update_date,'lr_number'=>$request->lr_number,'upload_lr_receipt'=>$input['upload_lr_receipt'],'order_status_comment'=>$request->order_status_comment]);
			
		}else{
			
			DB::table('orders')->where('id','=',$id)->update(['order_status'=>$request->order_status,'order_status_comment'=>$request->order_status_comment]);
		}
		//dd($input);
		
	  
	   
	   return back()->with('success','Order Status Successfully!');
   }
  
  //date 21-12-2023 start dummy page add method
  
    public function taxInvoice(){
	   
	   return view('orders.tax_invoice');
    } 
	
/* 	public function buyerOrder(){
	   
	   return view('orders.buyer_order');
    } */
	
	public function sellerOrder(){
	   
	  $auth_user   = Auth::user();
		 
       $is_admin  = $auth_user->for;
		 //dd($is_admin);
		 if($is_admin == 'super_admin'){
			 
		$sellerOrder = Order::orderby('id', 'desc')
						->pluck('cart_product_detail')
						->toArray();
						
						
			//dd($sellerOrder);			
		 }
		 else{
			$sellerOrder = Order::where('buyer_seller_id','=',$auth_user->id)
			           // ->where('order_status','=','Delivered')
	                    ->orderby('id', 'desc')
						->pluck('cart_product_detail')
						
						->toArray(); 
			 
		 } 
		
		 $sellerOrder = implode(',', $sellerOrder);
		 $sellerOrder = str_replace('[', '', $sellerOrder);
		 $sellerOrder = str_replace(']', '', $sellerOrder);
		 $sellerOrder = '['.$sellerOrder.']';
		 
		 $sellerOrder = json_decode($sellerOrder, true);
		// dd($sellerOrder);
		 $myArr       = $sellerOrder;
		
		 // $myArr is your origional array.
		 
			$result_arr = [];
			
			array_walk($myArr,function($v,$k) use (&$result_arr){
				
			$result_arr[key($v)][] = $v[key($v)]; 
			
			});
		//	dd($result_arr,$myArr);
			$productOrderData =[];
			
            if(!empty($result_arr)){
			
			$productIDS       = $result_arr['product_id'];

			$uniqueProductIDS = array_unique($productIDS);
			
			$productIDSCount  = array_count_values($productIDS);
			


           // $productOrderData =[];

			foreach($uniqueProductIDS as $product_id){

			$productDetail           = Product::find($product_id);
			
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
		      //get total order (Order Table) in seller order page 20-07-2024 
			
			
			 //get total order (Order Table) in seller order page 20-07-2024 End
			  
			  
			
			//get total delivred order (purchase add) in seller order page 15-07-2024 
			
			$productSellerID         = json_encode(array(''.$productDetail->seller_id));
			
			
			$purchaseProductID       = ''.$productDetail->id;
			
			$purchaseProductIdArr  = Purchase::where('seller_id','=',$productSellerID)->where('product_id', 'like', "%{$purchaseProductID}%")->pluck('product_id')->toArray();
			
			$purchaseProductQtyArr  = Purchase::where('seller_id','=',$productSellerID)->where('product_id', 'like', "%{$purchaseProductID}%")->pluck('product_quantity')->toArray();
			
			$pro_qty = 0;
			
			foreach($purchaseProductIdArr as $pro_key=>$pro_val){
				
				$pro_val_arr = json_decode($pro_val,true);
				
				$i_key = array_search($purchaseProductID, $pro_val_arr);
				
				$pro_qty_arr = json_decode($purchaseProductQtyArr[$pro_key]);
				
				$pro_qty += $pro_qty_arr[$i_key];
				
			}
			
			
			//get total delivred order (Purchase Return) in seller order page 15-07-2024 
			
			$productSellerPurchaseReturnID  = json_encode(array(''.$productDetail->seller_id));
			
			
			$purchaseReturnProductID    = ''.$productDetail->id;
			
			$purchaseReturnProductIdArr = Purchasereturn::where('seller_id','=',$productSellerPurchaseReturnID)->where('product_id', 'like', "%{$purchaseReturnProductID}%")->pluck('product_id')->toArray();
			
			$purchaseReturnProductQtyArr      = Purchasereturn::where('seller_id','=',$productSellerPurchaseReturnID)->where('product_id', 'like', "%{$purchaseReturnProductID}%")->pluck('product_quantity')->toArray();
			
			$pro_return_qty = 0;
			
			foreach($purchaseReturnProductIdArr as $pro_return_key=>$pro_return_val){
				
				$pro_return_val_arr = json_decode($pro_return_val,true);
				
				$preturn_key = array_search($purchaseReturnProductID, $pro_return_val_arr);
				
				$pro_return_qty_arr = json_decode($purchaseReturnProductQtyArr[$pro_return_key]);
				
				$pro_return_qty += $pro_return_qty_arr[$preturn_key];
				
				//dd($pro_key, $pro_val, $pro_val_arr, $i_key, $purchaseProductID, $pro_val_arr, $pro_qty_arr, $pro_qty);
			}

			//get total delivred order in seller order page 15-07-2024 
			
			
			//dd($productDetail,$productSellerID,$purchaseProductID,$purchaseProductIdArr,$purchaseProductQtyArr);
			
			$productOrderData[]  = ['product_img'=>$productDetail->product_photo,'product_id'=>$productDetail->id,'product_name'=>$productDetail->product_name,'total_order'=>$product_delivered_qty,'total_delivered'=>$pro_qty,'pending_order'=>($productIDSCount[$product_id]- $productIDSCount[$product_id]),'total_returned'=>$pro_return_qty,'final_sales'=>$productIDSCount[$product_id]];
          
			unset($productDetail);
        }
       
	   }
	
	   return view('orders.seller_order',compact('productOrderData'));
    }
	
	
public function todaySingleProductOrder(Request $request)
    {
	     $input   = $request->all();
	
	     $auth_user   = Auth::user();
	  
	     $from_date   = date('Y-m-d').'00:00:00';
	     $to_date     = date('Y-m-d').'23:59:59';
	     $currentDate = date('Y-m-d');
		 
         $is_admin  = $auth_user->for;
		 
		 $product_id = $input['product_id'];
		 
		 $product_data = Product::find($product_id)->toArray();
		 
		$DeliveredProduct = DeliveredProduct::select(DB::raw('DATE(created_at) as created_date'), DB::raw('SUM(delivered_product_qty) AS delivered_product_qty_total'))
     ->where('product_id','=',$product_id)
	 ->groupBy('created_date')
      ->get()->toArray();
	  
		 
		 //dd($orderDateCount);
		
         return response()->json(['order_data' => $DeliveredProduct, 'product_data'=>$product_data]);
    }
	//Date 13-08-2024
	public function purchaseProductOrder(Request $request)
    {
	    $input   = $request->all();
	
	    $auth_user   = Auth::user();
	  
	    $from_date   = date('Y-m-d').'00:00:00';
	    $to_date     = date('Y-m-d').'23:59:59';
	    $currentDate = date('Y-m-d');
		 
        $is_admin  = $auth_user->for;
		 
		$product_id = $input['product_id'];
		 
		$product_data = Product::find($product_id)->toArray();
        //dd($product_data);
        //$product_id_key = $product_data ;
		$purchaseProduct = Purchase::select(DB::raw('DATE(created_at) as created_date'), 'purchases.*')
                           
                                ->whereJsonContains('product_id',$product_id)						  
							// ->where('product_id','=',$product_id)
						   //  ->groupBy('created_date')
						       ->get()->groupBy('created_date')->toArray();
	  
		 foreach($purchaseProduct as $purchaseData){
			 $pro_qty = 0;
			
			 foreach($purchaseData as $purchaseQty){
			// dd($purchaseQty);
			 $productIDS         = json_decode($purchaseQty['product_id'],true);
			 $productQuantity    = json_decode($purchaseQty['product_quantity'],true);
			 
			 $pro_key   = array_search($product_id,$productIDS);
			 
			 $pro_qty += $productQuantity[$pro_key];
			 
			 $pro_qty_date = $purchaseQty['created_date'];
		     //dd($pro_qty_date);
			 
		 }
		 
		 $purchase_data = array('created_date'=>$pro_qty_date,'product_qty'=>$pro_qty);
		 
		 $purchase_data_arr[] = $purchase_data;
		 
			 unset($purchaseData);
			 unset($purchaseQty);
			 unset($productIDS);
			 unset($productQuantity);
			 unset($pro_key);
			 unset($pro_qty);
			 unset($pro_qty_date);
			 unset($purchase_data);
		 }
		// dd($purchaseProduct);
		
         return response()->json(['purchase_data' => $purchase_data_arr, 'product_data'=>$product_data]);
    }
	
	public function purchaseReturnProductOrder(Request $request)
    {
	    $input   = $request->all();
	
	    $auth_user   = Auth::user();
	  
	    $from_date   = date('Y-m-d').'00:00:00';
	    $to_date     = date('Y-m-d').'23:59:59';
	    $currentDate = date('Y-m-d');
		 
        $is_admin  = $auth_user->for;
		 
		$product_id = $input['product_id'];
		 
		$product_data = Product::find($product_id)->toArray();
       
		$purchaseReturnProduct = Purchasereturn::select(DB::raw('DATE(created_at) as created_date'), 'purchasereturns.*')
                           
                                ->whereJsonContains('product_id',$product_id)						  
							// ->where('product_id','=',$product_id)
						   //  ->groupBy('created_date')
						       ->get()->groupBy('created_date')->toArray();
	
		 foreach($purchaseReturnProduct as $purchaseReturnProductData){
			
			 $pro_qty = 0;
			
			 foreach($purchaseReturnProductData as $purchaseReturnQty){
			
			 $productIDS         = json_decode($purchaseReturnQty['product_id'],true);
			 $productQuantity    = json_decode($purchaseReturnQty['product_quantity'],true);
			 
			 $pro_key    = array_search($product_id,$productIDS);
			 
			 $pro_qty += $productQuantity[$pro_key];
			
			 $pro_qty_date = $purchaseReturnQty['created_date'];
		    
			 
		 }
		 
		 $purchase_return_data = array('created_date'=>$pro_qty_date,'product_qty'=>$pro_qty);
		 
		 $purchase_return_data_arr[] = $purchase_return_data;
		 
			 unset($purchaseReturnProductData);
			 unset($purchaseReturnQty);
			 unset($productIDS);
			 unset($productQuantity);
			 unset($pro_key);
			 unset($pro_qty);
			 unset($pro_qty_date);
			 unset($purchase_return_data);
		 }
		// dd($purchaseProduct);
		
         return response()->json(['purchase_return_data' => $purchase_return_data_arr, 'product_data'=>$product_data]);
    }
 //Date 13-08-2024

	public function myProductOrder(){
			
	   $auth_user      = Auth::user();
		
       $is_admin       = $auth_user->for;
		 
		 if($is_admin == 'super_admin'){
			 
			 $myProductOrder = Order::orderby('id', 'desc')
							->pluck('cart_product_detail')
							->toArray();
			 
		 }else{
			 
			 $myProductOrder = Order::where('buyer_seller_id','=',$auth_user->id)
							 ->orderby('id', 'desc')
							 ->pluck('cart_product_detail')
							 ->toArray(); 
			 
		 } 
		 
 		/* $myProductOrder = Order::where('buyer_seller_id','=',$auth_user->id)
							->orderby('id', 'desc')
							->pluck('cart_product_detail')
							->toArray();  */
		 
		 $myProductOrder = implode(',', $myProductOrder);
		 $myProductOrder = str_replace('[', '', $myProductOrder);
		 $myProductOrder = str_replace(']', '', $myProductOrder);
		 $myProductOrder = '['.$myProductOrder.']';
		 
		 $myProductOrder = json_decode($myProductOrder, true);
		
		 $myArr       = $myProductOrder;
		 
		 //date 14-07-2024
		 $myArr2       = $myProductOrder;
		
		 $result2 = array_reduce($myArr2, function($carry, $item){ 
			if(!isset($carry[$item['product_id']])){ 
				$carry[$item['product_id']] = ['product_id'=>$item['product_id'],'prod_qty'=>$item['prod_qty']]; 
			} else { 
				$carry[$item['product_id']]['prod_qty'] += $item['prod_qty']; 
			} 
			return $carry; 
		});
		 //date 14-07-2024
		 
		//dd($result2);
		
		 // $myArr is your origional array.
		 
			$result_arr = [];
			
			array_walk($myArr,function($v,$k) use (&$result_arr){
				
			$result_arr[key($v)][] = $v[key($v)]; 
			
			});
			
			$productOrderData =[];
			
            if(!empty($result_arr)){
				
			$productIDS       = $result_arr['product_id'];

			$uniqueProductIDS = array_unique($productIDS);
			
			$productIDSCount  = array_count_values($productIDS);

		
			foreach($uniqueProductIDS as $product_id){

			$productDetail           = Product::find($product_id);
		
			$totalProductQty  = (!empty($result2[$product_id]['prod_qty'])) ? $result2[$product_id]['prod_qty']:0;
			
			$totalProductQty  = ($totalProductQty * $productDetail->master_packing);
			
			
			$productOrderData[] = ['product_img'=>$productDetail->product_photo,'product_id'=>$productDetail->id,'product_name'=>$productDetail->product_name,'total_order'=>$productIDSCount[$product_id],'total_qty'=>$totalProductQty,'total_delivered'=>$productIDSCount[$product_id],'pending_order'=>($productIDSCount[$product_id]- $productIDSCount[$product_id]),'total_returned'=>($productIDSCount[$product_id]- $productIDSCount[$product_id]),'final_sales'=>$productIDSCount[$product_id]];

			unset($productDetail);
        }
	}
	   return view('orders.my_product_order',compact('productOrderData'));	
	     
    }

  //29-01-2024
  public function getTodayMyProductOrder(Request $request)
    {
		  $input       = $request->all();
		
		  $from_date   = date('Y-m-d').'00:00:00';
		  $to_date     = date('Y-m-d').'23:59:59';
		  $currentDate = date('Y-m-d');
		  
		  $product_id  = $input['product_id'];
		  
		  $auth_user   = Auth::user();
		 
         $is_admin     = $auth_user->for;
		 
		 if($is_admin == 'super_admin'){
			 
			 $buyerSellerMyProduct = Order::where('cart_product_detail', 'like',  '%"product_id":"'.$input['product_id'].'"%')->get()->toArray();
		
		 }else{
			 
			 $buyerSellerMyProduct = Order::where('buyer_seller_id','=',$auth_user->id)
		                 ->where('cart_product_detail', 'like',  '%"product_id":"'.$input['product_id'].'"%')
						 ->get()->toArray();
			 
		 } 
		 
      /*   $buyerSellerMyProduct = Order::where('buyer_seller_id','=',$auth_user->id)
		                      ->where('cart_product_detail', 'like',  '%"product_id":"'.$input['product_id'].'"%')
						      ->get()->toArray(); */
							  
		// dd($buyerSellerMyProduct);				  
      
         $orderDataArr = [];
	  
		 foreach($buyerSellerMyProduct as $order){
			 
			 $product_quienty = 0;
			 
			 $cart_product_detail = json_decode($order['cart_product_detail'], true);
			 
			 foreach($cart_product_detail as $cart_product_detail_row){
				 
				 if($cart_product_detail_row['product_id'] == $product_id){
					
                    $product_quienty = 	($cart_product_detail_row['prod_qty'] * $cart_product_detail_row['master_packing']);		
					 
				 }
				 
			 }
			 
			$orderDate      = Carbon::parse($order['created_at'])->format('d-m-Y');
			 
			$orderDataArr[] = ['order_id'=>$order['order_id'], 'order_date'=>$orderDate, 'product_quienty'=>$product_quienty, 'buyer_or_seller_name'=>$order['first_name'].' '.$order['last_name']]; 
			 
			unset($order);   
			unset($cart_product_detail);   
			unset($cart_product_detail_row);   
			unset($orderDate);   
		 }
		 
		//date 18-07-2024
		
		$order_date_keys = array();
		
		foreach ($orderDataArr AS $k => $sub_array)
		{
		  $this_order_date = $sub_array['order_date'];
		  $order_date_keys[$this_order_date][$k] = $sub_array;//array('cust' => $sub_array['cust'], 'type' => $sub_array['type']);
		}
		 
		 $orderDataArr2 = [];
		 
		 foreach($order_date_keys as $date_key=>$date_val_arr){
			 
			  $product_quienty_sum = array_sum(array_column($date_val_arr,'product_quienty'));
			  
			  foreach($date_val_arr as $date_val_arr2){
				  
				  $date_val_arr2['product_quienty'] = $product_quienty_sum;
				
                  $arr_data   =  	$date_val_arr2;
                 unset($date_val_arr2);				 
                				  
			  }
			  
			  $orderDataArr2[] = $arr_data;
			  
			  unset($arr_data);
			  
			unset($date_val_arr); 
		 }
		 
		 //date 18-07-2024
		// dd($orderDataArr2);
		
         return response()->json(['order_data' => $orderDataArr2]);
    }
  
	public function deliveredProduct(Request $request ,$order_id, $product_id){
	   
	   $auth_user = Auth::user();
	   
	   $input['order_id']              = $order_id;
	   
	   $input['product_id']            = $product_id;
	   
	   $input['delivered_product_qty'] = $request->delivered_product_qty;
	   
	   $input['created_by']            = $auth_user->id;
	   
	   $deliveredProductQty      = Helper::deliveredProductQty($order_id, $product_id);
	   
	   $finalDeliveredProductQty = ($request->delivered_product_qty + $deliveredProductQty);
	   
	   $packTotalQty             = Helper::getOrderPackProductTotalQty($order_id, $product_id);
	  
	  if($finalDeliveredProductQty > $packTotalQty ){
		    
	   return back()->withErrors(['Delivered Product Quantity Should Be Less Than Packing Quantity']);
		   
}
	   DeliveredProduct::create($input);
	  
	   return back()->with('success','Product Delivered Successfullly !!');
	  // return view('orders.edit_order');
    }
  
	//date 21-12-2023 end
}
