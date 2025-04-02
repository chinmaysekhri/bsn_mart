<?php
  
namespace App\Helpers;
 
use App\Models\User;
use App\Models\Employee;
use App\Models\Company;
use App\Models\Seller;
use App\Models\Buyer;
use App\Models\Customer;
use App\Models\CustomerPayment;
use App\Models\Categories;
use App\Models\SubCategories;
use App\Models\Product;
use App\Models\Wallet;
use App\Models\Withdrawal;
use App\Models\WithdrawalComment;
use App\Models\FundComment;
use App\Models\Fund;
use App\Models\Order;
use App\Models\Designation;
use App\Models\TransportAddress;
use App\Models\DeliveredProduct;
use App\Models\SellerTransportAddress;
use Auth;
use DB;

class Helper
{
	public static function getProfile(){
		
		$auth_user = Auth::User();
		//dd($auth_user);
		if($auth_user->for == 'company'){
			
			$profile = Company::where('id', '=', $auth_user->company_id)->first();
		}
		elseif($auth_user->for == 'employee'){
			
			$profile = Employee::where('id', '=', $auth_user->emp_id)->first();
		}
		elseif($auth_user->for == 'seller'){
			
			$profile = Seller::where('id', '=', $auth_user->seller_id)->first();
		}
		elseif($auth_user->for == 'buyer'){
			
			$profile = Buyer::where('id', '=', $auth_user->buyer_id)->first();
		}
		else{
			
			$profile = $auth_user;
		}
		
		return ['auth_user'=>$auth_user, 'profile'=>$profile];
	}
	public static function getDueAmount($customer_id,$product_id,$total_cost_of_product){
		
		$auth_user = Auth::User();
		
	    $amount_paid=CustomerPayment::where('customer_id','=',$customer_id)
		             ->where('product_id','=',$product_id)
					 ->where('payment_status','=','Confirm')
					 ->groupBY('product_id')->sum('amount_paid');

		$dueAmount =($total_cost_of_product-$amount_paid);
		
		return $dueAmount;
	}
	
	public static function getOrderPendingCount($customer_id,$product_id){
		
		$auth_user = Auth::User();
		
	    $getOrderPendingCount=CustomerPayment::where('customer_id','=',$customer_id)
		             ->where('product_id','=',$product_id)
					 ->where('payment_status','=','pending')
					 ->count();

		return $getOrderPendingCount;
	}
	
    public static function getcategoryeData($cat_id){
		
	//$catDate = Categories::where('status','=','1')->orderBy('id','DESC');
	
	    $catDate = Categories::where('id','=',$cat_id)->orderBy('id','DESC')->first();
		
		return $catDate;
	}
	public static function getSubcategoryeData(){
		
		$subcatDate = SubCategories::orderBy('id','DESC')->first();
		
		//$subcatDate = SubCategories::where('status','=','1')->where('is_deleted','=','1')->orderBy('id','DESC');
		//dd($subcatDate);
		return $subcatDate;
	}
	//code by karishma
  public static function get_buyer_name($id)
	{

		$user_record = User::where('id',$id)->first();

		if($user_record != '')
		{
			$buyer_id = $user_record->buyer_id;

			$buyer_record=Buyer::where('id',$buyer_id)->first();
			
			return $buyer_name = $buyer_record->first_name." ". $buyer_record->last_name;
		}
		//return $burer_record;
		
	}
	
	public static function getBuyCartData($request){
		
	    $product_qty_data = $request->all();
 
         $word = 'prod_id_';

		foreach($product_qty_data as $product_qty_data_key=>$product_qty_data_row){
			
			$sentence = $product_qty_data_key;
			
			if(!str_contains($sentence, $word)){
				unset($product_qty_data[$product_qty_data_key]);
			}
		}
		//dd($product_qty_data);
		//unset($product_qty_data['_token']);
		
		$all_product_sub_total = 0;
		$cart_product_detail_arr = [];
		
		foreach($product_qty_data as $prod_id=>$prod_qty){
			
			$product_id = explode('_', $prod_id)[2];
			
			$details = Product::where('id', '=', $product_id)->first()->toArray();
            
            $single_prod_sub_total = ($details['price']*$details['master_packing'])*$prod_qty;
			
			$product_photo         =   $details['product_photo'];
			
            $all_product_sub_total += $single_prod_sub_total;
			
			$cart_product_detail_arr[] = ['product_id'=>$product_id, 'prod_qty'=>$prod_qty, 'single_prod_sub_total'=>$single_prod_sub_total, 'unit_price'=>$details['price'], 'master_packing'=>$details['master_packing'],'product_photo'=>$product_photo];
			
			unset($prod_id);
			unset($prod_qty);
			unset($details);
			unset($product_id);
			unset($single_prod_sub_total);
			
		}
		
		$subtotal_price = $all_product_sub_total;
		
		$shipping_estimate = round($subtotal_price*2/100);
		
		$total_buy_price = round($subtotal_price + $shipping_estimate);
		 
		 $cart_buy_data = array('cart_product_detail_arr'=>$cart_product_detail_arr, 'subtotal_price'=>$subtotal_price, 'shipping_estimate'=>$shipping_estimate, 'total_buy_price'=>$total_buy_price);
		 
		return $cart_buy_data;
	}
	
	public static function getWalletData($buyer_seller_id){
		
		$auth_user = Auth::user();
		
	    //dd($buyer_seller_id);
		
		$totalAddFund = Fund::where('fund_status', '=', 'Confirmed')
		                      //->where('created_by', '=', $auth_user->id)
		                       ->where('fund_to', '=', $buyer_seller_id)
                              ->sum('fund_amount');
			//dd($totalAddFund);			
		$totalWithdrawal = Withdrawal::where('withdrawal_status', 'Paid')
		                              // ->where('created_by', '=', $auth_user->id)
		                               ->where('withdrawal_from', '=', $buyer_seller_id)
                                       ->sum('withdrawal_amount');
	   //dd($totalWithdrawal);
	   
		$totalWalletAmount = ($totalAddFund-$totalWithdrawal);
		
		$wallet_data = ['total_added_fund'=>$totalAddFund, 'total_withdrawal_fund'=>$totalWithdrawal, 'total_wallet_amount'=>$totalWalletAmount];
		
		return $wallet_data;
	}
	
	
	// Date: 30-12-2024 start
	
	public static function getWithdrawalRequestedAmt($buyer_seller_id){
		
		$auth_user = Auth::user();
				
		$withdrawalPendingData = Withdrawal::where('withdrawal_status', 'Pending')
		                              // ->where('created_by', '=', $auth_user->id)
		                               ->where('withdrawal_from', '=', $buyer_seller_id)
                                       ->sum('withdrawal_request_amount');
									   
	   $withdrawalPaidData = Withdrawal::where('withdrawal_status', 'Paid')
		                              // ->where('created_by', '=', $auth_user->id)
		                               ->where('withdrawal_from', '=', $buyer_seller_id)
                                       ->sum('account_paid_amount');
	  // dd($withdrawalReqData,$withdrawalPaidData);
	  
		$withdrawal_requested_data = ['total_request_pending'=>$withdrawalPendingData,'total_request_paid'=>$withdrawalPaidData,];
		
		return $withdrawal_requested_data;
	}
	
	// Date: 30-12-2024 End	
	
   // Date: 24-12-2024 start
	
	public static function getAllWalletData(){
		
		$auth_user = Auth::user();
		
		$getAllWalletData = User::select('users.*')
								 ->whereIn('for', ['seller','buyer'])
								 ->get();

								 
		foreach($getAllWalletData as $buyer_seller){
			
			$buyer_seller_wallet_data[] = self::getWalletData($buyer_seller->id);
			
		}
		
		//dd($buyer_seller_wallet_data);
		return $buyer_seller_wallet_data;
	} 
	
	// Date: 24-12-2024 End
	
	
		public static function getBuyerSellerData($buyer_seller_id){
		
		$auth_user = Auth::user();
		
		$user_buyer_seller_data = User::select('users.*')
								 ->where('id', '=',$buyer_seller_id)
								 ->first(); 
		$data      =	$user_buyer_seller_data;							 
			
		//Update Code 08-07-2024
		
/* 		$user_buyer_seller_data = User::select('users.*')
								 ->where('id', '=',$auth_user->id)
								 ->first();
        $data = [];
		
		if($user_buyer_seller_data->for == 'buyer'){
		
				$data = Buyer::select('buyers.*')
				               ->where('id','=',$user_buyer_seller_data->buyer_id)
                               ->first();	
     							   
		}elseif($user_buyer_seller_data->for == 'seller'){
			
			   $data = Seller::select('sellers.*')
				               ->where('id','=',$user_buyer_seller_data->seller_id)
                               ->first();	
		} */
		
		return $data;
	}
	
	public static function productDetail($pdoduct_id){
		
		$productDetail = Product::where('id','=', $pdoduct_id)->first();
		
		
		return $productDetail;
	}	
	
	public static function shareButtons($pdoduct_id){
		
		    $productShareDetail = Product::where('id','=', $pdoduct_id)->first();
			//dd($productShareDetail,$pdoduct_id);
		    $productNameSocialLink  = $productShareDetail->product_name;
			$productSlugSocialLink  = $productShareDetail->product_slug;
			$productPriceSocialLink = $productShareDetail->price;
			$productPhotoSocialLink = $productShareDetail->product_photo;
			
			//.asset('public/uploads/product/product_photo/'.$productPhotoSocialLink).
			
			$product_link = route('product_detail',$productSlugSocialLink); 
			$Product_share_data = "
			                        <div><img src=".'https://bsnmart.com/images/Electronic/led_tv.png'.">
			                        <h3>".$productNameSocialLink."</h3>
			                        <h3>".$productPriceSocialLink."</h3>
			                        </div>";

			
	       // $productShareData = 'Product Name '.$productNameSocialLink.', Puoduct Price '.$productPriceSocialLink .''.$productPriceSocialLink.''.productPhotoSocialLink;
		
		$shareButtons = \Share::page(
            $product_link,
            $Product_share_data
        )
		->whatsapp()
        ->facebook()
        ->twitter()
        ->linkedin();
		
		return $shareButtons;
	}

	public static function shareProduct($pdoduct_id){
		
		    $productShareDetail = Product::where('id','=', $pdoduct_id)->first();
		    
			if(!empty($productShareDetail->product_name)){
			    
		    $productNameSocialLink  = urlencode($productShareDetail->product_name);
		    
			}else{
			    
				$productNameSocialLink ='';
			}
			
			if(!empty($productShareDetail->product_slug)){
			    
		        $productSlugSocialLink  =  urlencode($productShareDetail->product_slug);
		        
			}else{
			    
				$productSlugSocialLink ='';
			}
			
			if(!empty($productShareDetail->price)){
			    
		        $productPriceSocialLink  = $productShareDetail->price;
		        
			}else{
			    
				$productPriceSocialLink ='';
			}
			
			if(!empty($productShareDetail->product_photo)){
			    
		        $productPhotoSocialLink  = urlencode($productShareDetail->product_photo);
		
			}else{
			    
				$productPhotoSocialLink ='';
			}
		   
			$product_link = urlencode(route('share_product_detail',$productSlugSocialLink)); 

		    $Product_share_data = urlencode($productNameSocialLink);
		    
		    $shareProduct = \Share::page(
            $product_link
        )
		->whatsapp()
        ->facebook()
        ->twitter()
        ->linkedin();
		
		return $shareProduct;
	}
	public static function transportAddress($transport_address){

        /* $transport_address_data = User::select('users.*')
								 ->where('id', '=',$transport_address)
								 ->first();
        $transportAddress = [];
			
		if($transport_address_data->for == 'buyer'){
		
				$transportAddress = TransportAddress::select('transport_addresses.*')
				               ->where('id','=',$transport_address->buyer_id)
                               ->first();	
              						   
		}elseif($transport_address_data->for == 'seller'){
			
			   $transportAddress = SellerTransportAddress::select('seller_transport_addresses.*')
				               ->where('id','=',$transport_address->seller_id)
                               ->first();	
		}
		
		return $transportAddress; */
		
		$transportAddress = TransportAddress::where('id','=', $transport_address)->first();
		
		return $transportAddress; 
	}
	
	public static function deliveredProductQty($order_id,$pdoduct_id){
		
		$deliveredProductQty = DeliveredProduct::select(DB::raw('sum(delivered_product_qty) as totalDeliveredQty '))
							  ->where('order_id','=', $order_id)
							  ->where('product_id','=', $pdoduct_id)
							  ->groupBy('order_id')
							  ->get()->toArray();
							  
							 // dd($deliveredProductQty);
							 
							  if(empty($deliveredProductQty))
							  {
								return 0;  
							  }else{
								  
								return $deliveredProductQty[0]['totalDeliveredQty'];  
							  }
						  
		
	     }
	     
	//	06-10-2024  using my-product-order Total Received 
	
	public static function productDeliveredQty($pdoduct_id){
		
		$productDeliveredQty = DeliveredProduct::select(DB::raw('sum(delivered_product_qty) as totalReceivedQty'))
							  ->where('product_id','=', $pdoduct_id)
							  ->groupBy('product_id')
							  ->get()->toArray();
			           // dd($productDeliveredQty);	
             if(!empty($productDeliveredQty)){
				return $productDeliveredQty[0]['totalReceivedQty'];	   
			 }else{
				 return 0;
			 }					   
						
							 
						  
		
	     }
		 
	//	06-10-2024  using my-product-order Total Received 
	     
	public static function getOrderPackProductTotalQty($order_id,$pdoduct_id){
		
		$orderData = Order::where('id','=', $order_id)->first();
							  
		$cartProductDetail = json_decode($orderData->cart_product_detail , true);
		
		$packTotalQty = 0;
		
			foreach($cartProductDetail as $cart_row){
				
				if($cart_row['product_id'] == $pdoduct_id){
					
				$packTotalQty = ($cart_row['master_packing']*$cart_row['prod_qty']);
				
					
				}
				else{
					
				unset($cart_row);	
				}
			}
		return $packTotalQty;		
   }
   
   //11-01-2024
   
   public static function getDesignationName($designation){
		
		$getDesignationName = Designation::where('id','=', $designation)->first();
	
		return $getDesignationName; 
   }
   
      
 //09-02-2024  
    public static function getSellerName($seller_id){
		
		$getSellerName = Seller::where('id','=', $seller_id)->first();
	 
		return $getSellerName; 
   } 
  
   public static function getCategoryName($category_id){
		
		$getCategoryName = Categories::where('id','=', $category_id)->first();
	  
		return $getCategoryName; 
   }
  
   public static function getSubcategoryName($subcat_id){
		
		$getSubcategoryName = SubCategories::where('id','=', $subcat_id)->first();
	 
		return $getSubcategoryName; 
   }
   //19-04-2024 
   
   	 public static function getAssignUserNameData($created_by)
	 {
	 	$getAssignUserNameData = User::where('id','=',$created_by)->orderBy('id','DESC')->first();
		
	    return $getAssignUserNameData; 
	 }
   
   //18-4-24//
    public static function getUserDataByID($created_by)
	 {
	 	$getUserDataByID = User::where('id','=',$created_by)->orderBy('id','DESC')->first();
		//dd($getUserDataByID);
	    return $getUserDataByID; 
	 } 
	 
	public static function getSellerDataByID($created_by)
	 {
	 	$getSellerDataByID   = User::where('id','=',$created_by)->orderBy('id','DESC')->first();
		
	    return $getSellerDataByID; 
	 } 
	 public static function getBuyerDataByID($created_by)
	 {
	 	$getBuyerDataByID = User::where('id','=',$created_by)->orderBy('id','DESC')->first();
		
	    return $getBuyerDataByID; 
	 } 
   
   	//Date04-07-2024
	 
	 public static function getProductCategoryName($category_id)
	 {
	 	$getProductCategoryName = Categories::where('id','=',$category_id)->orderBy('id','DESC')->first();
		
	    return $getProductCategoryName; 
	 } 
	
	public static function getProductSubCategoryName($subcat_id)
	 {
	 	$getProductSubCategoryName = SubCategories::where('id','=',$subcat_id)->orderBy('id','DESC')->first();
		
	    return $getProductSubCategoryName; 
	 } 
	
	//Date:06-07-2024
	 
	public static function getOrderSellerName($seller_id)
	 {
	 	$getOrderSellerName = User::where('seller_id','=',$seller_id)->orderBy('id','DESC')->first();
		
	    return $getOrderSellerName; 
	 }  
	 
	 public static function getOrderBuyerName($buyer_id)
	 {
	 	$getOrderBuyerName = User::where('seller_id','=',$buyer_id)->orderBy('id','DESC')->first();
		
	    return $getOrderBuyerName; 
	 }  
	 //date 10-12-2024
	 
	 public static function getProductById($id){
		
		$getProductById = Product::where('id','=', $id)->first();
	 
		return $getProductById; 
   } 
   
   
   	//12-03-2025 seller Cataelouge Search Data
	 
	 public static function getSellerProductActive()
	 {
	 	//$getSellerProductActive = Product::where('product_status','=','Active')->where('user_product_status','=','Active')->orderBy('id','DESC')->first();
	 	$getSellerProductActive = Product::where('product_status','=','Active')->orderBy('id','DESC')->first();
		
	    return $getSellerProductActive; 
	 } 
	 
	 public static function getSellerProductInctive()
	 {
	 	//$getSellerProductInctive = Product::where('product_status','=','Out Of Stock')->where('user_product_status','=','Out Of Stock')->orderBy('id','DESC')->first();
	 	  $getSellerProductInctive = Product::where('product_status','=','Out Of Stock')->orderBy('id','DESC')->first();
		
	    return $getSellerProductInctive; 
	 } 
	 
	 public static function getSellerProductOnHold()
	 {
	 //$getSellerProductOnHold = Product::where('product_status','=','On Hold')->where('user_product_status','=','On Hold')->orderBy('id','DESC')->first();
	 	$getSellerProductOnHold = Product::where('product_status','=','On Hold')->orderBy('id','DESC')->first();
		
	    return $getSellerProductOnHold; 
	 }
	 
	//12-03-2025 Seller Cataelouge Search Data End
   
}