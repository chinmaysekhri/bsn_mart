<?php
    
namespace App\Http\Controllers;
    
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\User;
use App\Models\Lead;
use App\Models\Product;
use App\Models\Ledger;
use App\Models\Fund;
use App\Models\Wallet;
use App\Models\Withdrawal;
use App\Models\TransportAddress;
use App\Models\SellerTransportAddress;
use App\Models\Buyer;
use App\Models\Seller;
use App\Models\Order;
use App\Models\Categories;
use App\Models\SubCategories;
use App\Models\CartReturn;
use App\Models\Review;
use App\Models\ReceivedProduct;
use App\Helpers\Helper;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Auth;
use DB;
use Hash;
use Session;
use Mail;
use App\Mail\RegisterMail;
use App\Mail\OrderMail;
use Illuminate\Support\Facades\Validator;
//use Validator;
    
class CartReturnController extends Controller
{ 

	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	 
/*	function __construct()
    {
         $this->middleware('permission:cartreturn-list|cartreturn-create|cartreturn-edit|cartreturn-delete', ['only' => ['index','store']]);
         $this->middleware('permission:cartreturn-create', ['only' => ['create','store']]);
         $this->middleware('permission:cartreturn-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:cartreturn-delete', ['only' => ['destroy']]);
    } */

    public function index(Request $request): View
    {
	   	$per_page    = 15;
        
        $auth_user   = Auth::user();
        
        $is_admin    = $auth_user->for;
		
		//$reviewData = Review::orderBy('id','DESC')->get();
		//dd($reviewData->id);

	   if($is_admin == 'super_admin'){
        
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
	  
        
        $data_collection = CartReturn::when($request->q,function (Builder $builder) use ($request) {
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
           
           $sellerData = intval($request->seller_buyer_data);
		   
		   $user_data      = User::find(intval($request->seller_buyer_data));
	      
           if(!empty($user_data->seller_id)){
                      $builder->where('seller_id', '=',$user_data->seller_id);
                             
                    }
                 }
              )
			  
		->when($request->today_applied_status,function (Builder $builder) use ($request) {
			
            if(!empty($request->today_applied_status)){
			  
              $builder->where('cartreturn_status', '=', $request->today_applied_status);

              }
             }
            )  
			
			->orderBy('id','DESC'); 


//comment date 18-12-2024
	/* 		if($is_admin == 'super_admin'){
				
			$cartReturnOrder = $data_collection->paginate($per_page);
				
			}elseif($is_admin == 'seller'){



			 $sellerId = json_encode([''.$auth_user->seller_id]);


			$cartReturnOrder = $data_collection->where('seller_id','=',$sellerId)->paginate($per_page);
     

			}
	*/
   //comment date 18-12-2024  
   
         if($is_admin == 'super_admin'){
            
              $cartReturnOrder = $data_collection->paginate($per_page)->appends($request->query());
             
            
         }else{
            
          $user_ids = User::where('created_by','=',$auth_user->id)->orWhere('managed_by','=',$auth_user->id)
                            ->pluck('id')->toArray();
                  
                 array_push($user_ids,$auth_user->id);
            
        //  $data = $data_collection->whereIn('created_by',$user_ids)->orWhere('seller_id','=',$auth_user->seller_id)->paginate($per_page);

          $cartReturnOrder = $data_collection->where('seller_id',$auth_user->seller_id)->paginate($per_page)->appends($request->query());
                  
               }

             $requested_input = $request->all();
     
             return view('cartreturns.index',compact('requested_input','buyerSellerData','cartReturnOrder'))
            ->with('i', ($request->input('page', 1) - 1) * $per_page);
	   
	   
                
    }
    
    public function create(): View
    {
      
        return view('cartreturns.create');
    }
    
    
    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
            //'name' => 'required|unique:roles,name',
            'buyer_seller_id' => 'required',
        ]);
    
         $input      = $request->all();
		 //dd($input);
		 $auth_user  = Auth::user();
		//dd($auth_user);
		 $cart_buy_data = Helper::getReturnCartData($request);
		 
		// $buyerSellerID = Helper::getOrderPackProductTotalQty($request);
		 
	
		 $input['cart_product_detail'] = json_encode($cart_buy_data['cart_product_detail_arr']);
		 
		 $input['subtotal_price']      = $cart_buy_data['subtotal_price'];
	   	 $input['shipping_estimate']   = $cart_buy_data['shipping_estimate'];
	   	 $input['total_buy_price']     = $cart_buy_data['total_buy_price'];
		 
	   	 $input['product_name']        = json_encode($input['product_name']);
	   	 $input['product_photo']       = json_encode($input['product_photo']);
	   	 $input['unit_price']          = json_encode($input['unit_price']);
	   	 $input['product_guarantee_type'] = json_encode($input['product_guarantee_type']);
	   	 $input['product_warranty_type']  = json_encode($input['product_warranty_type']);

	
	   // dd($employeeBuyerSellerData->id);
	   //$RCID      = ($input['product_total_qty']);
	   
		$input['created_by']        = $auth_user->id;
		//$input['buyer_seller_id']  = $auth_user->id;
		
		//dd($input['buyer_seller_id']);
		
		$input['transaction_type'] = 'Cart Return';
		$input['return_date']      = date("d-m-Y");
		
		
		//$input['cart_return_id']   = IdGenerator::generate(['table' => 'cart_returns', 'length' => 20,'field' => 'product_name', 'prefix' =>'CRID'.''.date('Y').''.date('m').''.date('d').''.date('i').''.rand(0, 9999).''.$RCID]);
		
		$input['cart_return_id']   = IdGenerator::generate(['table' => 'cart_returns', 'length' => 20,'field' => 'product_name', 'prefix' =>'CRID'.''.date('Y').''.date('m').''.date('d').''.date('i').''.rand(0, 99999)]);
	   
	 // dd($input);
	   
        $cartReturn = CartReturn::create($input);
        
        return redirect()->route('cartreturns.index')
                        ->with('success','Cart Return Successfully!!');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id): View
    {
        $cartReturnOrder = CartReturn::find($id);
       
        return view('cartreturns.show',compact('cartReturnOrder'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		$request = request();
		//date 18-12-2024 start
		$auth_user  = Auth::user();
		
		 if($auth_user->for == 'buyer'){
			 
			 $buyerSellerData = User::select('users.*')
		                                 ->where('for', '=','buyer')
		                                 ->where('id','=',$auth_user->id)
										 ->orderBy('id','DESC')
										 ->get();
			 
		 }elseif($auth_user->for == 'seller'){
			
             $buyerSellerData = User::select('users.*')
		                                 ->where('for', '=','seller')
										 ->where('id','=',$auth_user->id)
										 ->orderBy('id','DESC')
										 ->get();	
                                         		
		 }else{
			 
			 $buyerSellerData = User::select('users.*')
		                                  ->where('for', '=','buyer')
		                                  ->orWhere('for', '=','seller')
										  ->where('created_by','=',$auth_user->id)
										  ->orderBy('id','DESC')
										  ->get();
										  
		    //dd($buyerSellerData);							  
		 }
		 
		//date 18-12-2024 start
        $cartReturnOrder = CartReturn::find($id);
		
		$cart_product_data = json_decode($cartReturnOrder->cart_product_detail,true);
		//dd($cart_product_data);
		
		if($request->has('action_for') && $request->action_for =='delete-product'){
			$product_id = $request->product_id;
			foreach($cart_product_data as $product_row_data){
				
				if($product_row_data['product_id'] != $product_id){
					$product_row_data2[] = $product_row_data;
				}
			}
			
			$cartReturnOrder->update(['cart_product_detail'=>json_encode($product_row_data2)]);
			
			return back()->with('success','Cart Return Deleted Successfully!!');
		}
		foreach($cart_product_data as $product_row_data){
			
			$product_data= Product::find($product_row_data['product_id']);
			
			$session_cart[$product_row_data['product_id']] = ['product_name'=>$product_data->product_name,
			                                                'product_guarantee_type'=>$product_data->product_guarantee_type,
			                                                'product_warranty_type'=>$product_data->product_warranty_type,
															'master_packing'=>$product_row_data['master_packing'],
															'price'=>$product_row_data['unit_price'],
															'product_photo'=>$product_row_data['product_photo'],
															'product_total_qty'=>$product_row_data['product_total_qty'],
															'prod_qty'=>$product_row_data['prod_qty'],
															'product_id'=>$product_row_data['product_id']];
			
		}
		//dd($session_cart);
        return view('cartreturns.edit',compact('cartReturnOrder','session_cart','buyerSellerData'));
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
            //'name' => 'required|unique:roles,name',
            'buyer_seller_id' => 'required',
        ]);
    
         $input     = $request->all();
		
		 $auth_user  = Auth::user();
		
		 $cart_buy_data = Helper::getReturnCartData($request);
	
		 $input['cart_product_detail'] = json_encode($cart_buy_data['cart_product_detail_arr']);
		 
		 $input['subtotal_price']      = $cart_buy_data['subtotal_price'];
	   	 $input['shipping_estimate']   = $cart_buy_data['shipping_estimate'];
	   	 $input['total_buy_price']     = $cart_buy_data['total_buy_price'];
		 
	   	 $input['product_name']        = json_encode($input['product_name']);
	   	 $input['product_photo']       = json_encode($input['product_photo']);
	   	 $input['unit_price']          = json_encode($input['unit_price']);
		 $input['product_guarantee_type'] = json_encode($input['product_guarantee_type']);
	   	 $input['product_warranty_type']  = json_encode($input['product_warranty_type']);
	   	 
		 //dd($input);
		 
		//$userId     = $auth_user->buyer_id;

		//dd($input);
		//$input['product_quantity'] = $input[$input['product_qty']];
		//dd($input['product_quantity']);
		//unset($input[$input['product_qty']]);
		//unset($input['product_qty']);
		
		//dd($input);
		
	   //$RCID      = ($input['product_total_qty']);
		
		//$input['created_by']       = $auth_user->id;
		//$input['buyer_seller_id']  = $auth_user->id;
		//$input['transaction_type'] = 'Cart Return';
		//$input['return_date']      = date("d-m-Y");
		
		
		//$input['cart_return_id']   = IdGenerator::generate(['table' => 'cart_returns', 'length' => 20,'field' => 'product_name', 'prefix' =>'CRID'.''.date('Y').''.date('m').''.date('d').''.date('i').''.rand(0, 9999)]);
	   
	  
	   
         $cartReturn = CartReturn::find($id);
         $cartReturn->update($input);
        
        return redirect()->route('cartreturns.index')
                        ->with('success','Cart Return Updated Successfully!!');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id): RedirectResponse
    {
        DB::table("cart_returns")->where('id',$id)->delete();
        return redirect()->route('cartreturns.index')
                        ->with('success','cart returns deleted successfully');
    }	
	
   public function cartReturn(Request $request,$product_id)
    {
		
		//$productDetail    = Product::find($product_id);
	
		//$productQty       = $request->product_qty;
		
		$input       = $request->all();
		
		//dd($input);
		
		$auth_user  = Auth::user();
		
		 if($auth_user->for == 'buyer'){
			 
			 $buyerSellerData = User::select('users.*')
		                                 ->where('for', '=','buyer')
		                                 ->where('id','=',$auth_user->id)
										 ->orderBy('id','DESC')
										 ->get();
			 
		 }elseif($auth_user->for == 'seller'){
			
             $buyerSellerData = User::select('users.*')
		                                 ->where('for', '=','seller')
										 ->where('id','=',$auth_user->id)
										 ->orderBy('id','DESC')
										 ->get();	
                                         		
		 }else{
			 
			 $buyerSellerData = User::select('users.*')
		                                  ->where('for', '=','buyer')
		                                  ->orWhere('for', '=','seller')
										  ->where('created_by','=',$auth_user->id)
										  ->orderBy('id','DESC')
										  ->get();
										  
		    //dd($buyerSellerData);							  
		 }
		
		//dd($buyerSellerData);
		
        return view('cartreturns.cart_return',compact('buyerSellerData'));
    }
  
 //21-11-2024
 
   
   
 //Return cart 27-11-2024
 
  //Add To Cart Functionality method Start date 01-12-2023
		 
   public function returnCart(Request $request)
    {
		 $cart = session()->get('cart');
		 //dd($cart);
		 $auth_user  = Auth::user();
		
		 if($auth_user->for == 'buyer'){
			 
			 $buyerSellerData = User::select('users.*')
		                                 ->where('for', '=','buyer')
		                                 ->where('id','=',$auth_user->id)
										 ->orderBy('id','DESC')
										 ->get();
			 
		 }elseif($auth_user->for == 'seller'){
			
             $buyerSellerData = User::select('users.*')
		                                 ->where('for', '=','seller')
										 ->where('id','=',$auth_user->id)
										 ->orderBy('id','DESC')
										 ->get();	
                                         		
		 }else{
			 
			 $buyerSellerData = User::select('users.*')
		                                  ->where('for', '=','buyer')
		                                  ->orWhere('for', '=','seller')
										  ->where('created_by','=',$auth_user->id)
										  ->orderBy('id','DESC')
										  ->get();
										  
		    //dd($buyerSellerData);							  
		 }
		 
        return view('cartreturns.return_cart',compact('cart','buyerSellerData'));
    }
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function returnToCart($product_id,$product_qty)
     {
		 $request = request();
		
		 if($request->product_guarantee_type == 'No Guarantee & Warranty'){
			 
			return back()->with('success','No Guarantee & Warranty Product Not Return Cart!'); 
		 }
        $product = Product::findOrFail($product_id);
		//dd($product_qty);
		//$productQty       = session()->$request->product_qty;
       
        $cart    = session()->get('cart', []);
         
		//dd($cart);
		 
         if(isset($cart[$product_id])) {
            $cart[$product_id][]++;
        } else {
            $cart[$product_id] = [
                "product_name" => $product->product_name,
                "master_packing" => $product->master_packing,
                //"quantity" => 1,
                "price" => $product->price,
                "product_photo" => $product->product_photo,
                "product_guarantee_type" => $product->product_guarantee_type,
                "product_warranty_type" => $product->product_warranty_type,
                "product_total_qty" => $product_qty
            ];
        } 
        session()->put('cart', $cart);
		
        return redirect()->back()->with('success', 'Product Added to Return Cart Successfully!');
    }
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function updateReturnCart(Request $request)
    {
        if($request->id && $request->master_packing){
            $cart = session()->get('cart');
            $cart[$request->id]["product_name"]  = $request->product_name;
            $cart[$request->id]["master_packing"]  = $request->master_packing;
            $cart[$request->id]["price"]         = $request->price;
            $cart[$request->id]["product_photo"] = $request->product_photo;
            session()->put('cart', $cart);
            session()->flash('success', 'Product Updated to Return Cart Successfully!');
        }
    }
  
    /**
     * Write code on Method
     *
     * @return response()
     */
   public function removeCart(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product Removed to Return Cart Successfully!');
        }
    }

 //Return cart 27-11-2024
 
     public function updateReturnStatus(Request $request, $id)
	{
	   $input      = $request->all(); 
	   
	   $auth_user  = Auth::user();
	   
	   DB::table('cart_returns')->where('id','=',$id)->update(['cartreturn_status'=>$request->cartreturn_status,'return_status_comment'=>$request->return_status_comment]);
		
	   return back()->with('success','Return Cart Status Successfully!');
   }
	

   //Date 19-12-2024
   public function updateLrStatus(Request $request, $id)
	{
	   $input      = $request->all(); 
	   
	   $auth_user  = Auth::user();
	   
	  // DB::table('cart_returns')->where('id','=',$id)->update(['cartreturn_status'=>$request->cartreturn_status,'return_lr_date'=>$request->return_lr_date,'return_lr_no'=>$request->return_lr_no,'return_lr_copy'=>$request->return_lr_copy,'return_lr_comment'=>$request->return_lr_comment]);
		
	// Date 19-12-2024 Start
		
	  if($request->hasfile('return_lr_copy')){
            
            $fileName_return_lr_copy = time().'.'.$request->return_lr_copy->extension();  

            $request->return_lr_copy->move(public_path('uploads/order/return_lr_copy'), $fileName_return_lr_copy);
            
            $input['return_lr_copy'] = $fileName_return_lr_copy;
            
        }else{
            unset($input['return_lr_copy']);          
        }

	     if($request->hasfile('dispatched_lr_copy')){
            
            $fileName_dispatched_lr_copy = time().'.'.$request->dispatched_lr_copy->extension();  

            $request->dispatched_lr_copy->move(public_path('uploads/order/dispatched_lr_copy'), $fileName_dispatched_lr_copy);
            
            $input['dispatched_lr_copy'] = $fileName_dispatched_lr_copy;
            
        }else{
            unset($input['dispatched_lr_copy']);          
        }		
		//dd($input);
		if($request->cartreturn_status == 'Dispatched'){
			
			
        DB::table('cart_returns')->where('id','=',$id)->update(['cartreturn_status'=>$request->cartreturn_status,'dispatched_lr_date'=>$request->dispatched_lr_date,'dispatched_lr_no'=>$request->dispatched_lr_no,'dispatched_lr_copy'=>$input['dispatched_lr_copy'],'return_lr_comment'=>$request->return_lr_comment]);
		
		}
		elseif($request->cartreturn_status == 'Returned'){
			
			
        DB::table('cart_returns')->where('id','=',$id)->update(['cartreturn_status'=>$request->cartreturn_status,'return_lr_date'=>$request->return_lr_date,'return_lr_no'=>$request->return_lr_no,'return_lr_copy'=>$input['return_lr_copy'],'return_lr_comment'=>$request->return_lr_comment]);
		
		}else{
			
        DB::table('cart_returns')->where('id','=',$id)->update(['cartreturn_status'=>$request->cartreturn_status,'return_lr_comment'=>$request->return_lr_comment]);
		
	}
		
	 // Date 19-12-2024 End
		
	   return back()->with('success','Return Cart LR Data Updated Successfully!');
   }
  

	//14-12-2024
	
	public function addReview(Request $request, $product_id)
	{
	   
	   $input      = $request->all(); 
	   
	   $auth_user  = Auth::user();
	   
	   $input['product_id']      = $product_id;
	   
	   //$input['buyer_seller_id'] = $auth_user->id;
	   
	   $input['buyer_seller_id'] = $request->buyer_seller_id;
	   
	   $input['created_by']      = $auth_user->id;
	   
	   $input['review_rating']   = $request->review_rating;
	   
	   $input['review_comment']  = $request->review_comment;
	   
	   $input['status']          = 'Reject';
	  //dd($input);
	   $review  = Review::create($input);
        
       return back()->with('success','Product Review Created Successfully!!');
	
	  
   }
   public function productReviewList(Request $request)
	{
	 $per_page = 10;
	 
     $reviewProduct = Review::orderBy('id','DESC')->paginate($per_page);
	 
     return view('reviews.review_list',compact('reviewProduct'));
	}
   public function reviewRatingStatus(Request $request, $id)
	{
	   $input      = $request->all(); 
	  
	   $auth_user  = Auth::user();
	   
	   $reviewData = Review::orderBy('id','DESC')->get();
	   
	   DB::table('reviews')->where('id','=',$id)->update(['status'=>$request->status]);
		
	   return back()->with('success','Review Status Update Successfully!');
   }
	  //Date 16-12-2024 for edit return page receivedProduct
	  
  public function receivedProduct(Request $request ,$cart_return_id, $product_id){
	   
	   $auth_user = Auth::user();
	   
	   $input['cart_return_id']       = $cart_return_id;
	   
	   $input['product_id']           = $product_id;
	   
	   $input['received_product_qty'] = $request->received_product_qty;
	   
	   $input['created_by']           = $auth_user->id;
	   
	  // $deliveredProductQty      = Helper::deliveredProductQty($order_id, $product_id);
	   
	   //$finalDeliveredProductQty = ($request->delivered_product_qty + $deliveredProductQty);
	   
	   //$packTotalQty             = Helper::getOrderPackProductTotalQty($order_id, $product_id);
	  
	 // if($finalDeliveredProductQty > $packTotalQty ){
		    
	  // return back()->withErrors(['Delivered Product Quantity Should Be Less Than Packing Quantity']);
		   
    //}
//	dd($input);
	
	ReceivedProduct::create($input);
	  
	   return back()->with('success','Product Received Successfullly !!');
	  // return view('orders.edit_order');
    }
}