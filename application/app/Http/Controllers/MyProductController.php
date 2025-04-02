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
use App\Models\Wallet;
use App\Models\Withdrawal;
use App\Models\TransportAddress;
use App\Models\SellerTransportAddress;
use App\Models\Buyer;
use App\Models\Seller;
use App\Models\Order;
use App\Models\Categories;
use App\Models\SubCategories;
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
use Illuminate\Support\Facades\Crypt;
    
class MyProductController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   

 /*   function __construct()
      {
         $this->middleware('permission:product-list|product-create|product-edit|product-delete', ['only' => ['index','show']]);
         $this->middleware('permission:product-create', ['only' => ['create','store']]);
         $this->middleware('permission:product-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:product-delete', ['only' => ['destroy']]);
      } */
    
	
	 /**
     * Display a listing of the resource.
     */

   public function myProduct(Request $request,$id)
    {

/*
      $id = Crypt::decrypt($id);
      
      $per_page  = 15; 
      
      if($request->has('product_filter')){
          
          
          $productFilter = $request->product_filter;
          
          $productType = array(); 
          
          $productCategory = array(); 
          
          $productSubCategory = array(); 
          
          foreach($productFilter as $productData){
              
            if (str_contains($productData,'product_type_')) { 
                
                $product_type_text = str_replace("product_type_","",$productData);
                
                  array_push($productType,$product_type_text);
           }
           
            elseif (str_contains($productData,'product_category_')) { 
                
                $product_type_text1 = str_replace("product_category_","",$productData);
                
                array_push($productCategory,$product_type_text1);
           }
           
            elseif (str_contains($productData,'product_subcategory_')) { 
                
                $product_type_text2 = str_replace("product_subcategory_","",$productData);
                
                array_push($productSubCategory,$product_type_text2);
                
          }
          

        }
      
       $myProduct = Product::
                   where('seller_id','=',$id)
                  ->when($request->product_filter,function (Builder $builder) use ($request,$productType,$productCategory,$productSubCategory) {
                    
                     if(!empty($productType)){
                        $builder->whereIn('product_type',$productType); 
                      }
                      
                    if(!empty($productCategory)){
                        $builder->whereIn('category_id',$productCategory);
                      }
                      
                    if(!empty($productSubCategory)){
                        $builder->whereIn('subcat_id',$productSubCategory);
                      }
             
                  }
                 )
                 ->whereNotIn('product_status',['On Hold','Out Of Stock'])
	             ->whereNotIn('user_product_status',['On Hold'])
                 ->orderBy('id','DESC')->paginate($per_page);
      
       return view('myproduct.myproduct_index',compact('myProduct'));
      
         //  return response()->json(['req_data' =>[$productType,$productCategory,$productSubCategory,$request->all(),$myProduct]]);
         // return response()->json(['req_data'=>$request->all()]);
    }  
    
        $myProduct = DB::table('products')->where('seller_id','=',$id)
                                         ->whereNull('deleted_at')
        				                 ->whereNotIn('product_status',['On Hold','Out Of Stock'])
	                                     ->whereNotIn('user_product_status',['On Hold'])
                                         ->orderBy('id','DESC')->paginate($per_page);
        
		$sellerData = DB::table('sellers')->where('id','=',$id)->orderBy('id','DESC')->first();
        
		$myProductCount = Product::where('seller_id','=',$id)->whereNotIn('product_status',['On Hold','Out Of Stock'])
	                                                         ->whereNotIn('user_product_status',['On Hold'])
		                                                     ->orderBy('id','DESC')->count();	
        
		$productTypeArr = Product::where('seller_id','=',$id)
						   ->whereNotNull('product_type')
						   ->groupBy('product_type')
						   ->pluck('product_type')
						   //->orderBy('id','DESC')
						   ->toArray();
						  
         $productCategoryArr = Product::where('seller_id','=',$id)
						   ->whereNotNull('category_id')
						   ->groupBy('category_id')
						   ->pluck('category_id')
						   //->orderBy('id','DESC')
						   ->toArray();
						   
		 $productSubCategoryArr = Product::where('seller_id','=',$id)
						   ->whereNotNull('subcat_id')
						   ->groupBy('subcat_id')
						   ->pluck('subcat_id')
						   //->orderBy('id','DESC')
						   ->toArray();				   

	      $categoryData     = Categories::orderBy('id','DESC')->first();
		  
	      $subCategoryData  = SubCategories::orderBy('id','DESC')->first();
		  
          $categoryList     = Product::where('seller_id','=',$categoryData->id)->get();
		  
          $subcategoryList  = Product::where('subcat_id','=',$subCategoryData->id)->get();
    
          return view('myproduct.index',compact('myProduct','sellerData','myProductCount','productTypeArr','productCategoryArr','productSubCategoryArr')); */
          
          
    $id = Crypt::decrypt($id);
     
      $per_page  = 16; 
      
      if($request->has('product_filter')){
          
          $productFilter         = $request->product_filter;
          
          $productType           = array(); 
          
          $productCategory       = array(); 
          
          $productSubCategory    = array(); 
		  
          $productStatusActive   = array();
		  
          $productStatusInactive = array();
		  
          $productStatusOnHold   = array(); 
          
          foreach($productFilter as $productData){
              
            if (str_contains($productData,'product_type_')) { 
                
                $product_type_text = str_replace("product_type_","",$productData);
                
                  array_push($productType,$product_type_text);
           }
           
            elseif (str_contains($productData,'product_category_')) { 
                
                $product_type_text1 = str_replace("product_category_","",$productData);
                
                array_push($productCategory,$product_type_text1);
           }
           
            elseif (str_contains($productData,'product_subcategory_')) { 
                
                $product_type_text2 = str_replace("product_subcategory_","",$productData);
                
                array_push($productSubCategory,$product_type_text2);
                
          }
		  
		   elseif (str_contains($productData,'product_status_')) { 
                
                $product_status_text3 = str_replace("product_status_","",$productData);
                
                array_push($productStatusActive,$product_status_text3);
                
          }
		  elseif (str_contains($productData,'out_of_stock_data')) { 
                
                $product_status_inactive_text4 = str_replace("out_of_stock_data","",$productData);
                
                array_push($productStatusInactive,$product_status_inactive_text4);
                
          }
		  elseif (str_contains($productData,'on_hold_data_')) { 
                
                $product_status_onhold_text5 = str_replace("on_hold_data_","",$productData);
                
                array_push($productStatusOnHold,$product_status_onhold_text5);
                
          }
          

        }
		
		//dd($id,$productType,  $productCategory,$productSubCategory,$productStatusActive,$productStatusInactive,$productStatusOnHold);
      
       $myProduct = Product::where('seller_id','=',$id)
                  ->when($request->product_filter,function (Builder $builder) use ($request,$productType,  $productCategory,$productSubCategory,$productStatusActive,$productStatusInactive,$productStatusOnHold) {
                    
                    if(!empty($productType)){
                        $builder->whereIn('product_type',$productType); 
                      }
                      
                    if(!empty($productCategory)){
                        $builder->whereIn('category_id',$productCategory);
                      }
                      
                    if(!empty($productSubCategory)){
                        $builder->whereIn('subcat_id',$productSubCategory);
                      }
					  
                    if(!empty($productStatusActive)){
                        $builder->whereIn('product_status',$productStatusActive);
                      }
					  
					if(!empty($productStatusInactive)){
                        $builder->whereIn('product_status',$productStatusInactive);
                      }
					  
					if(!empty($productStatusOnHold)){
                        $builder->whereIn('product_status',$productStatusOnHold);
                      }
             
                  }
                 )
				 //->whereNotIn('product_status',['On Hold'])
	            //->whereNotIn('user_product_status',['On Hold'])
                 ->orderBy('id','DESC')->paginate($per_page);
    
       return view('myproduct.myproduct_index',compact('myProduct'));
      
    }  
    
        $myProduct = DB::table('products')->where('seller_id','=',$id)
		                                  ->whereNull('deleted_at')
		                                 ->whereNotIn('product_status',['On Hold','Out Of Stock'])
	                                      ->whereNotIn('user_product_status',['On Hold'])
		                                  ->orderBy('id','DESC')->paginate($per_page);
        //dd($myProduct);
		$sellerData = DB::table('sellers')->where('id','=',$id)->orderBy('id','DESC')->first();
     
	 //10-03-2025   for get count
	 $productCountActive = Product::where('seller_id','=',$id)
		                    ->whereNull('deleted_at')
		                    ->where('product_status','=','Active')
							->orderBy('id','DESC')
							->count();	
							
	  $productCountInactive = Product::where('seller_id','=',$id)
		                    ->whereNull('deleted_at')
		                    ->where('product_status','=','Out Of Stock')
							->orderBy('id','DESC')
							->count();
							
	  $productCountOnhold = Product::where('seller_id','=',$id)
		                    ->whereNull('deleted_at')
		                    ->where('product_status','=','On Hold')
							->orderBy('id','DESC')
							->count();	
        //10-03-2025  End
		
		$productTypeArr = Product::where('seller_id','=',$id)
						   ->whereNotNull('product_type')
						   ->groupBy('product_type')
						   ->pluck('product_type')
						   ->toArray();
						  
        $productCategoryArr = Product::where('seller_id','=',$id)
						   ->whereNotNull('category_id')
						   ->groupBy('category_id')
						   ->pluck('category_id')
						   ->toArray();
						   
		$productSubCategoryArr = Product::where('seller_id','=',$id)
						   ->whereNotNull('subcat_id')
						   ->groupBy('subcat_id')
						   ->pluck('subcat_id')
						   ->toArray();	
						   
	    $productStatusArr = Product::where('seller_id','=',$id)
						   ->where('product_status','=','Active')
						   ->groupBy('product_status')
						   ->pluck('product_status')
						   ->toArray();	
	    $productStatusInactiveArr = Product::where('seller_id','=',$id)
						   ->where('product_status','=','Out Of Stock')
						   ->groupBy('product_status')
						   ->pluck('product_status')
						   ->toArray();	
					   
	     $productStatusOnHoldArr = Product::where('seller_id','=',$id)
						    ->where('product_status','=','On Hold')
						   ->groupBy('product_status')
						   ->pluck('product_status')
						   ->toArray();
                      
	      $categoryData     = Categories::orderBy('id','DESC')->first();
		  
	      $subCategoryData  = SubCategories::orderBy('id','DESC')->first();
		  
	      $productData      = Product::orderBy('id','DESC')->first();
		  
          $categoryList     = Product::where('seller_id','=',$categoryData->id)->get();
		  
          $subcategoryList  = Product::where('subcat_id','=',$subCategoryData->id)->get();
		  
          $productStatusList  = Product::where('product_status','=',$productData->id)->get();
    
          return view('myproduct.index',compact('myProduct','sellerData','productCountActive','productCountInactive','productCountOnhold','productTypeArr','productCategoryArr','productSubCategoryArr','productStatusArr','productStatusInactiveArr','productStatusOnHoldArr')); 
         
          
          
         
    }
    
    public function shareMyProduct(Request $request)
    {

       
		$per_page = 15;
		 
		 $auth_user = Auth::user();
		
		 //  = $auth_user->for;
		 
		 $reqData  = $request->all();
	    
			 		$productListCollection = Product::when($request->q,function (Builder $builder) use ($request,$auth_user) {
                            $builder->where('product_name', 'like', "%{$request->q}%")
							        //->where('seller_id','=',$auth_user->seller_id)
							        ->orWhere(function($query) use ($request,$auth_user) {
									$query->where('product_description', 'like', "%{$request->q}%");
									      // ->where('seller_id','=',$auth_user->seller_id);
								})
								->orWhere(function($query) use ($request,$auth_user) {
									$query->where('product_tag', 'like', "%{$request->q}%");
									      // ->where('seller_id','=',$auth_user->seller_id);
								});
						
                           }
                        )
					    ->when($request->cat_id,function (Builder $builder) use ($request) {
							//dd($request->cat_id);
                            $builder->where('category_id', 'like', "%{$request->cat_id}%");
                           }
                        )
					    ->when($request->subcat_id,function (Builder $builder) use ($request){
                           //dd($request->subcat_id);
						   $builder->where('subcat_id', 'like', "%{$request->subcat_id}%"); 
                           }
                        )	

						->when($request->brand_name,function (Builder $builder) use ($request) {
                           // dd($request->brand_name);
						   $builder->where('brand_name', 'like', "%{$request->brand_name}%"); 
                           }
                        )

						->when($request->today_applied_status,function (Builder $builder) use ($request) {
								 
									   if(!empty($request->today_applied_status)){
									  $builder->where('product_type', '=', $request->today_applied_status);
										  }
										 }
									  )

						->when($request->price,function (Builder $builder) use ($request) {
							
							$priceData = explode('-',$request->price);
							
							$min = $priceData[0];
							$max = $priceData[1];
							
                            $builder->where('price', '>=',$min) 
                                    ->where('price', '<=',$max); 
                           }
                        )	
                    ->orderBy('id','DESC');

	 $productList2 = $productListCollection;
	
	 $sellerData    = [];
	 $category_ids2 = [];
	 $sellerBrand2  = [];
	

	if(!empty($request->q)){
		
		$category_ids = $productList2->pluck('category_id')->toArray();
		
		   if(!empty($request->subcat_id)){
			  
              $subCatID     = $request->subcat_id;
			  
		      $brand_names    = Product::where('subcat_id','=',$subCatID)->groupBy('brand_name')->pluck('brand_name')->toArray();
			  
		   }else{
			   $brand_names = $productList2->pluck('brand_name')->toArray();
		   }

		
			 $categoryData    = Categories::whereIn('id',$category_ids)->orderBy('id','ASC')->get();
			 
			 $brandData       = Seller::whereIn('brand_name',$brand_names)->groupBy('brand_name')->orderBy('brand_name','ASC')->get('brand_name');
			
	 }else{
		 
		 	$category_ids = $productList2->pluck('category_id')->toArray();
		     
			 if(!empty($request->subcat_id)){
			  
              $subCatID     = $request->subcat_id;
			  
		      $brand_names    = Product::where('subcat_id','=',$subCatID)->groupBy('brand_name')->pluck('brand_name')->toArray();
			  
		   }else{
			   $brand_names = $productList2->pluck('brand_name')->toArray();
		   }
		 
			    $categoryData = Categories::whereIn('id',$category_ids)->orderBy('id','ASC')->get(); 
			 
			    $brandData    = Seller::where('status','!=',0)->whereIn('brand_name',$brand_names)->groupBy('brand_name')->orderBy('brand_name','ASC')->get('brand_name');
			 		     
			
		
	 }
	      
	if(isset($reqData['cat_id'])){
		   
		$category_id   = $reqData['cat_id'];
	  
	}else{
		   
        $category_id   = '';
	}
	 
	   $productList = $productListCollection->whereNotIn('product_status',['On Hold','Out Of Stock'])
	                                        ->whereNotIn('user_product_status',['On Hold'])
	                                        ->paginate($per_page)->appends($request->query());
	  
	   $subCategoryData = SubCategories::where('category_id','=',$category_id)->orderBy('id','ASC')->get();
	   
	   $requested_input = $request->all();
	    //dd($productList);
		
	   return view('myproduct.share_my_product',compact('requested_input','productList','categoryData','subCategoryData','brandData','reqData'));
		 
		//$myProduct = DB::table('products')->orderBy('id','DESC')->paginate($per_page);
    
        //return view('myproduct.share_my_product',compact('myProduct')); 
         
    }
    
    
    public function shareProductDetail($product_slug)
    {
		 $productDetail = Product::where('product_slug','=',$product_slug)->first();
		 
        return view('myproduct.share_product_detail',compact('productDetail')); 
         
    }
	
}