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
    
class ProductController extends Controller
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
    public function index(Request $request): View
      {
        $per_page  = 15;
     
        $auth_user = Auth::user();
    
        $is_admin  = $auth_user->for;
        
        if($is_admin == 'super_admin'){
        
        $buyerSellerData   = User::where('for','=','seller')
                            // ->orWhere('id','=','seller_id')
                               ->orderBy('id','DESC')->get();
          
        }else{
          
         $buyerSellerData  = User::where('for','=','seller')
                                  ->where('id','=',$auth_user->id)
                                  ->orderBy('id','DESC')
                                  ->get();
                                 // dd($buyerSellerData);
            } 
      $data_collection = Product::when($request->q,function (Builder $builder) use ($request) {
             $builder->where('first_name', 'like', "%{$request->q}%")
             ->orWhere('last_name', 'like', "%{$request->q}%")
             ->orWhere('email', 'like', "%{$request->q}%")
             ->orWhere('mobile', 'like', "%{$request->q}%")
             ->orWhere('gender ', 'like', "%{$request->q}%")
             ->orWhere('esi_no', 'like', "%{$request->q}%")
             ->orWhere('present_address', 'like', "%{$request->q}%")
             ->orWhere('permanent_address', 'like', "%{$request->q}%");
              
                }
             )


       

        ->when($request->today_applied_on,function (Builder $builder) use ($request) {

        // dd($request->today_applied_on);

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
              $builder->where('product_type', '=', $request->today_applied_status);
         }
                 }
              )

           ->when($request->seller_buyer_data,function (Builder $builder) use ($request) {

            $user_data      = User::find($request->seller_buyer_data);
     
           $seller_id_data = $user_data->seller_id;
           
           if(!empty($seller_id_data)){
                      $builder->where('seller_id', '=', $seller_id_data);
                              //->orWhere('managed_by', '=', $request->seller_buyer_data);
                    }
                 }
              )
     
         ->orderBy('id','DESC'); 
          
         if($is_admin == 'super_admin'){
            
              $data = $data_collection->paginate($per_page)->appends($request->query());
             
            
         }else{
            
          $user_ids = User::where('created_by','=',$auth_user->id)->orWhere('managed_by','=',$auth_user->id)
                            ->pluck('id')->toArray();
                  
                 array_push($user_ids,$auth_user->id);
            
        //  $data = $data_collection->whereIn('created_by',$user_ids)->orWhere('seller_id','=',$auth_user->seller_id)->paginate($per_page);

          $data = $data_collection->where('seller_id',$auth_user->seller_id)->paginate($per_page)->appends($request->query());
                  
               }
 
        $requested_input = $request->all();
		
        return view('products.index',compact('requested_input','data','buyerSellerData'))
            ->with('i', ($request->input('page', 1) - 1) * $per_page);  
 
      }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
      {
		$auth_user    = Auth::user();	
		
			if(!empty($auth_user->seller_id)){
				
			$sellerData         = Seller::find($auth_user->seller_id);
			
			$sellerCategoryIDS  = json_decode($sellerData->category_id,true);
			
			$sellerData         = Seller::where('id','=',$sellerData->id)->orderBy('id','DESC')->get();
			
			$categoryData       = Categories::whereIn('id',$sellerCategoryIDS)->orderBy('id','DESC')->get();
				//dd($sellerCategoryIDS);
			}else{
				$sellerData    = Seller::orderBy('id','DESC')->get();
				
				$categoryData  = Categories::orderBy('id','DESC')->get();
			}
		
        $status = ['0'=>'Deactive','1'=>'Active'];
		 
        return view('products.create',compact('sellerData','status','categoryData'));
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
    
        $input = $request->all();
         //dd($input);
	    if(empty($input['other_brand']) || $input['other_brand'] !="Non Brand" && $input['other_brand'] !="Third Party Sourcing"){
			 
            $input['other_brand'] ="Brand";
		 }
			 
		 
        $auth_user = Auth::user();
		
		$slug_test = ($request->brand_name.'-'.$request->model_number);
		
        $input['created_by']   = $auth_user->id;
		$input['product_slug'] = Str::slug($request->product_name.'-'.$slug_test);		
        $input['black_listed_district'] = json_encode($request->black_listed_district);

		//20-11-2023
		
		if($request->hasfile('product_image')) {
			foreach($request->file('product_image') as $file)
			{
				$name = time().".".$file->getClientOriginalName();
				$file->move(public_path().'/uploads/product/product_image', $name);  
				$imgData[] = $name;  
			}
			$input['product_image']=json_encode($imgData);
		}
		
		//20-11-2023
		
		
        //product_video//
        if($request->hasfile('product_video')){
            
            $fileName_product_video = time().'.'.$request->product_video->extension();  

            $request->product_video->move(public_path('uploads/product/product_video'), $fileName_product_video);
            
            $input['product_video'] = $fileName_product_video;
            
        }else{
            unset($input['product_video']);         
        }
		
		//product single image//
		
        if($request->hasfile('product_photo')){
            
            $fileName_product_photo = time().'.'.$request->product_photo->extension();  

            $request->product_photo->move(public_path('uploads/product/product_photo'), $fileName_product_photo);
            
            $input['product_photo'] = $fileName_product_photo;
            
        }else{
            unset($input['product_photo']);         
        }
		
       // dd($input);
	   
	   
        $product = Product::create($input);

        return redirect()->route('products.index')
                        ->with('success','Product created successfully');
		  
      }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
      {
	   //$sellerData = Seller::orderBy('id','DESC')->get();
	   
		 
		 
		 $product      = Product::find($id);
		 
		// dd($product);
		 /* $product = Product::select('products.*','sellers.business_name')
		                 ->leftjoin('sellers', 'sellers.id', 'products.seller_id')
		                 ->where('products.id', '=', $id)->get(); */
		 
       //  $sellercate = json_decode($product->category_id);
        return view('products.show',compact('product'));  
       // return view('products.show');
      }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
      {
		// $sellerData   = Seller::orderBy('id','DESC')->get();		 
		 //$categoryData = Categories::orderBy('id','DESC')->get();
		
		$auth_user    = Auth::user();	
		
			if(!empty($auth_user->seller_id)){
				
			$sellerData  = Seller::find($auth_user->seller_id);
			
			$sellerCategoryIDS  = json_decode($sellerData->category_id,true);
			
			$sellerData   = Seller::where('id','=',$sellerData->id)->orderBy('id','DESC')->get();
			
			$categoryData = Categories::whereIn('id',$sellerCategoryIDS)->orderBy('id','DESC')->get();
				
			}else{
				
				$sellerData   = Seller::orderBy('id','DESC')->get();
				
				$categoryData = Categories::orderBy('id','DESC')->get();
			}
		 
		    $product          = Product::find($id);  
		 
		//date 23-05-2024
		 $subCategoryData = SubCategories::where('category_id','=',$product->category_id)->orderBy('id','DESC')->get();
		
        return view('products.edit',compact('product','sellerData','categoryData','subCategoryData'));
		
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
    
        $input = $request->all();	
 		//dd($input);
		 if(empty($input['other_brand']) || $input['other_brand'] !="Non Brand" && $input['other_brand'] !="Third Party Sourcing"){
			 
            $input['other_brand'] ="Brand";
		 }
        $auth_user=Auth::user();
        $slug_test = ($request->brand_name.'-'.$request->model_number);
        $input['created_by'] = $auth_user->id;
	    $input['product_slug'] =  Str::slug($request->product_name.'-'.$slug_test);		
        $input['black_listed_district'] = json_encode($request->black_listed_district);

		//20-11-2023
		
		if($request->hasfile('product_image')) {
			foreach($request->file('product_image') as $file)
			{
				$name = time().".".$file->getClientOriginalName();
				$file->move(public_path().'/uploads/product/product_image', $name);  
				$imgData[] = $name;  
			}
			$input['product_image']=json_encode($imgData);
		}
		//20-11-2023
		
        //product_video//
        if($request->hasfile('product_video')){
            
            $fileName_product_video = time().'.'.$request->product_video->extension();  

            $request->product_video->move(public_path('uploads/product/product_video'), $fileName_product_video);
            
            $input['product_video'] = $fileName_product_video;
            
        }else{
            unset($input['product_video']);         
        }
		
		//product Photo//
		
        if($request->hasfile('product_photo')){
            
            $fileName_product_photo = time().'.'.$request->product_photo->extension();  

            $request->product_photo->move(public_path('uploads/product/product_photo'), $fileName_product_photo);
            
            $input['product_photo'] = $fileName_product_photo;
            
			}else{
				unset($input['product_photo']);         
			}
		
		 $product = Product::find($id);
		 
		 $product->update($input);
		 
         return redirect()->route('products.index')->with('success','Product updated successfully');
      }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {
        
		Product::find($id)->delete();
	
        return redirect()->route('products.index')->with('success','Product Deleted Successfully!!');
   
   }
      
/* 
    public function manageproductShow()
      {
       return view('products.manageproduct_show');
      }
	  
    public function manageproductEdit()
      {
       return view('products.manageproduct_edit');
      } */
	  
	  
   public function getSellerData(Request $request)
    {
		 $input = $request->all();
       
	     $seller_data = Seller::find($input['seller_id']);
		 
	     $seller_cat_data = Seller::where('id','=',$seller_data->id)->pluck('category_id')->toArray();
		 
		 $seller_cat_ids = json_decode($seller_cat_data[0]);
		 
		 $cat_data = Categories::whereIn('id',$seller_cat_ids)->pluck('category_name','id')->toArray();

         return response()->json(['seller_data' => $seller_data, 'cat_data'=>$cat_data]);
    }
	
    public function productList(Request $request)
    {
	$per_page = 10;
		 
		 $auth_user = Auth::user();
		
		 $is_admin  = $auth_user->for;
		 
		 $reqData  = $request->all();
	    
		if($is_admin == 'super_admin'){
			
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
                            $builder->where('category_id', 'like', "%{$request->cat_id}%");
                           }
                        )
					    ->when($request->subcat_id,function (Builder $builder) use ($request){
                            $builder->where('subcat_id', 'like', "%{$request->subcat_id}%"); 
                           }
                        )	

						->when($request->brand_name,function (Builder $builder) use ($request) {
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
			
		}else{
			
			 		 $productListCollection = Product::when($request->q,function (Builder $builder) use ($request,$auth_user) {
                            $builder->where('product_name', 'like', "%{$request->q}%")
							        ->where('seller_id','=',$auth_user->seller_id)
							        ->orWhere(function($query) use ($request,$auth_user) {
									$query->where('product_description', 'like', "%{$request->q}%")
									       ->where('seller_id','=',$auth_user->seller_id);
								})
								->orWhere(function($query) use ($request,$auth_user) {
									$query->where('product_tag', 'like', "%{$request->q}%")
									       ->where('seller_id','=',$auth_user->seller_id);
								});
						
                           }
                        )
					   ->when($request->cat_id,function (Builder $builder) use ($request) {
                            $builder->where('category_id', 'like', "%{$request->cat_id}%");
                           }
                        )
					   ->when($request->subcat_id,function (Builder $builder) use ($request){
                            $builder->where('subcat_id', 'like', "%{$request->subcat_id}%"); 
                           }
                        )	

						->when($request->brand_name,function (Builder $builder) use ($request) {
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
			
		}

			//dd($request->all());		
					//->paginate($per_page); 
					
					//->get()->toArray();
		
	//$productList  = Product::orderBy('id','DESC')->get();
	
	 $productList2 = $productListCollection;
	 
	 if($is_admin == 'super_admin'){
		 
	   $sellerData    = [];
	   $category_ids2 = [];
	   $sellerBrand2  = [];
		 
	 }else{
		 
	    $sellerData   = Seller::where('id','=',$auth_user->seller_id)->first();
	 // dd($sellerData);
	  
	  if(!empty($sellerData)){
		  	    $category_ids2 = json_decode($sellerData->category_id,true);
	    $sellerBrand2  = [$sellerData->brand_name];
	  }else{
		 	  	    $category_ids2 = [];
	    $sellerBrand2  = []; 
	  }

	 }
	 
	
		//dd($sellerBrand);
	 
	 if(!empty($request->q)){
		$category_ids = $productList2->pluck('category_id')->toArray();
		$brand_names = $productList2->pluck('brand_name')->toArray();
		
		 if($is_admin == 'super_admin'){
			 
			 $categoryData    = Categories::whereIn('id',$category_ids)->orderBy('id','ASC')->get();
			 
			 $brandData       = Seller::whereIn('brand_name',$brand_names)->orderBy('id','ASC')->get();
			 
		     
			}else{
				
				$categoryData = Categories::whereIn('id',$category_ids)
				                             ->whereIn('id',$category_ids2)
				                             ->orderBy('id','ASC')->get();
											 
		        $brandData    = Seller::whereIn('brand_name',$brand_names)
                                           ->whereIn('brand_name',$sellerBrand2)
				                           ->orderBy('id','ASC')->get();
			}
		
		
		
	 }else{
		 
		 	if($is_admin == 'super_admin'){
			 
			 $categoryData = Categories::orderBy('id','ASC')->get(); 
			 
			 $brandData    = Seller::orderBy('id','ASC')->get();
			 		     
			}else{
				
				$categoryData   = Categories::whereIn('id',$category_ids2)
				                             ->orderBy('id','ASC')->get();
											 
				$brandData      = Seller::whereIn('brand_name',$sellerBrand2)
				                           ->orderBy('id','ASC')->get();
			}
		
	 }
	   
	   
	   if(isset($reqData['cat_id'])){
		   
		$category_id   = $reqData['cat_id'];
	  
	   }else{
		   
	    $category_id  = '';
	   }
	   //09-08-2024
	 
	    $sellerBlackListedDistrict = json_decode($auth_user->black_listed_district);
		
	  
	     if($is_admin == 'super_admin'){
			 
			 $productList = $productListCollection->paginate($per_page)->appends($request->query());
			 
		     
			}else{
				
			// multile district pass is users table black_listed_district 10-08-2024 start
			if(!empty($sellerBlackListedDistrict)){
							foreach($sellerBlackListedDistrict as  $district){
			
			 $productListCollection->whereJsonDoesntContain('black_listed_district',$district);
			              
			}
			}

			
		   // multile district pass is users table black_listed_district 10-08-2024 end
		   
			
			$productList = $productListCollection->where('seller_id','=',$auth_user->seller_id)
			              // ->whereJsonContains('black_listed_district',$sellerBlackListedDistrict)
			              // ->whereJsonDoesntContain('black_listed_district',$sellerBlackListedDistrict)
			               ->paginate($per_page)->appends($request->query());
			 
			}

       //09-08-2024	
	   
	  // $productList = $productListCollection->paginate($per_page)->appends($request->query());
	   
	   $subCategoryData = SubCategories::where('category_id','=',$category_id)->orderBy('id','ASC')->get();
	   
	   $requested_input = $request->all();
	   
       return view('products.product_list',compact('requested_input','productList','categoryData','subCategoryData','brandData','reqData'));
    
	}
	
//  Date 31-03-2024

   public function product_autocomplete(Request $request)
    {
		$search_val = $request->get('query').'%';
		
        $data       = Product::select("product_name as name")
                    ->where('product_name', 'LIKE', $search_val)
                    ->get();
     
        return response()->json($data);
    }
	
  	 
  //  public function getProductSearchData(Request $request)
  //   {
		//   $input = $request->all();
		  
  //         //dd($input);
		  
	 //      $product_data  = Product::where('product_name','=',$input['product_name'])->first();
		  
		  
		//   if(!empty($product_data)){
		   
		//   $product_cate_data = $product_data->toArray();
		  
		//   $categoryData = Categories::where('id','=',$product_data['category_id'])->first();
		  
		//   $brandData     = Seller::where('brand_name','=',$product_data['brand_name'])->get();
		  
	 //      }else{
		   
		//   $product_cate_data  = [];
	 //      }
		  
		//   if(!empty($brandData)){
		   
		//   $brand_data = $brandData->toArray();
		
	 //      }else{
		   
		//   $brand_data  = [];
	 //      }
		  
		//   //$categoryData        = Categories::where('id','=',$productID['category_id'])->get()->toArray();
		  
		//   if(!empty($categoryData)){
		   
		//   $categorySearchData = $categoryData->toArray(); 
		  
		//   $product_subcat_data = SubCategories::where('category_id','=',$categorySearchData['id'])->get();
	      
		//   }else{
		   
		//   $categorySearchData  = [];
	 //      }
		 
		//   //$product_subcat_data = SubCategories::where('category_id','=',$categorySearchData->id)->get()->toArray();
		  
  //         if(!empty($product_subcat_data)){
		   
		//   $product_subcategory_data = $product_subcat_data->toArray() ;
		  
	 //      }else{
		   
		//   $product_subcategory_data  = [];
	 //      }
		// // dd($product_search_data);
		
  //        return response()->json(['product_subcategory_data' => $product_subcategory_data,'brand_data'=>$brand_data,'product_cate_data'=>$product_cate_data,'categorySearchData'=>$categorySearchData]);
  //   }
    // Date: 26-06-2024 

   public function getProductSearchData(Request $request)
    {
        $input = $request->all();
      
        // dd($input);
		 
        $auth_user  = Auth::user();

		$is_admin  = $auth_user->for;

	  if($is_admin == 'super_admin'){
		  
        $product_data  = Product::where('product_name','=',$input['product_name'])->first();
		
      }else{
		  
		$product_data  = Product::where('product_name','=',$input['product_name'])
		                           ->where('seller_id','=',$auth_user->seller_id)
								   ->first();  
		  
	  }
      
      if(!empty($product_data)){
       
      $product_cate_data = $product_data->toArray();
      
      $all_product_data_category_ids  = Product::where('product_name','=',$input['product_name'])->pluck('category_id')->toArray();
      $all_product_data_sub_category_ids  = Product::where('product_name','=',$input['product_name'])->pluck('subcat_id')->toArray();
      $all_product_data_brand_names  = Product::where('product_name','=',$input['product_name'])->pluck('brand_name')->toArray();
      
      $all_categoryData = Categories::whereIn('id',$all_product_data_category_ids)->get()->toArray();
      
      $all_product_subcat_data = SubCategories::whereIn('id',$all_product_data_sub_category_ids)->get()->toArray();
      
      $categoryData = Categories::where('id','=',$product_data['category_id'])->first();
      
      $brandData     = Seller::where('brand_name','=',$product_data['brand_name'])->get();
      
      $all_brandData     = Seller::whereIn('brand_name',$all_product_data_brand_names)->get();
      
        }else{
       
      $product_cate_data  = [];
      $all_categoryData  = [];
      $all_product_subcat_data  = [];
      $all_brandData  = [];
        }
      
      if(!empty($brandData)){
       
      $brand_data = $brandData->toArray();
    
        }else{
       
      $brand_data  = [];
        }
      
      //$categoryData        = Categories::where('id','=',$productID['category_id'])->get()->toArray();
      
      if(!empty($categoryData)){
       
      $categorySearchData = $categoryData->toArray(); 
      
      $product_subcat_data = SubCategories::where('category_id','=',$categorySearchData['id'])->get();
        
      }else{
       
      $categorySearchData  = [];
        }
     
      //$product_subcat_data = SubCategories::where('category_id','=',$categorySearchData->id)->get()->toArray();
      
          if(!empty($product_subcat_data)){
       
      $product_subcategory_data = $product_subcat_data->toArray() ;
      
        }else{
       
      $product_subcategory_data  = [];
        }
    // dd($product_subcategory_data);
    
         return response()->json(['product_subcategory_data' => $product_subcategory_data,'brand_data'=>$brand_data,'product_cate_data'=>$product_cate_data,'categorySearchData'=>$categorySearchData,'all_categoryData'=>$all_categoryData,'all_product_subcat_data'=>$all_product_subcat_data,'all_brandData'=>$all_brandData]);
    } 
	
//  Date 31-03-2024 End	
	
    public function productDetail($product_slug)
     {
       $productDetail=Product::where('product_slug','=',$product_slug)->first();
	   
       return view('products.product_detail',compact('productDetail'));
     }
 
	public function getSubcategoryData(Request $request)
    {
		
		 $auth_user = Auth::user();
		
		  $is_admin  = $auth_user->for;
		
		  $input          = $request->all();
       
	     //$category_data  = Categories::find($input['category_id']);
		 
		 	if($is_admin == 'super_admin'){
			 
			  $categoryID     = $input['category_id'];
		 
		      $subcat_data    = SubCategories::where('category_id','=',$categoryID)->pluck('sub_category_name','id')->toArray(); 
			 		     
			}else{
		 
		      $categoryID     = $input['category_id'];
		 
		      $subcat_data    = SubCategories::where('category_id','=',$categoryID)
			                                   ->where('created_by','=',$auth_user->id)
			                                   ->pluck('sub_category_name','id')->toArray();
			}
		//dd($subcat_data);
         return response()->json(['subcat_data' => $subcat_data]);
    }
	// Add sub category (if not found)
	
   public function storeSubcategoryData(Request $request)
    {
        $this->validate($request, [
        ]);
    
        $input   = $request->all();
        $product = SubCategories::create($input);
        return redirect()->route('products.create')
                        ->with('success','Sub category created successfully');
    }
	
 
 //Add To Cart Functionality method Start date 01-12-2023
		 
   public function cart()
    {
        return view('products.cart');
    }
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function addToCart($id)
     {
        $product = Product::findOrFail($id);
       
        $cart    = session()->get('cart', []);
         
		// dd($cart);
		 
         if(isset($cart[$id])) {
            $cart[$id][]++;
        } else {
            $cart[$id] = [
                "product_name" => $product->product_name,
                "master_packing" => $product->master_packing,
                //"quantity" => 1,
                "price" => $product->price,
                "product_photo" => $product->product_photo
            ];
        } 
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function updateCart(Request $request)
    {
        if($request->id && $request->master_packing){
            $cart = session()->get('cart');
            $cart[$request->id]["product_name"]  = $request->product_name;
            $cart[$request->id]["master_packing"]  = $request->master_packing;
            $cart[$request->id]["price"]         = $request->price;
            $cart[$request->id]["product_photo"] = $request->product_photo;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart updated successfully');
        }
    }
  
    /**
     * Write code on Method
     *
     * @return response()
     */
   public function remove(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product removed successfully');
        }
    }
    
   public function checkout(Request $request)
    {
		
		//dd($request->all());
		
		$cart_buy_data = Helper::getBuyCartData($request);
	
        // dd($cart_buy_data);

		 $auth_user  = Auth::user();
		 
		 $userId     = $auth_user->buyer_id;	
		 
		 if($auth_user->for == 'buyer'){
			 
			 $employeeBuyerSellerData = User::select('users.*')
		                                  ->where('for', '=','buyer')
		                                 //->where('for', '=','seller')
										 ->where('id','=',$auth_user->id)
										 ->orderBy('id','DESC')
										 ->get();
			 
		 }elseif($auth_user->for == 'seller'){
			
              $employeeBuyerSellerData = User::select('users.*')
		                                 // ->where('for', '=','buyer')
		                                 ->where('for', '=','seller')
										 ->where('id','=',$auth_user->id)
										 ->orderBy('id','DESC')
										 ->get();	
                                         //dd($employeeBuyerSellerData);		
		 }else{
			 
			$employeeBuyerSellerData = User::select('users.*')
		                                  ->where('for', '=','buyer')
		                                 ->orWhere('for', '=','seller')
										 ->where('created_by','=',$auth_user->id)
										 ->orderBy('id','DESC')
										 ->get();
		 }
		 
        // dd($employeeBuyerSellerData);
		
         $wallet_amt = Wallet::where('id','=',$userId)->first();
		 
         return view('products.checkout',compact('wallet_amt', 'cart_buy_data','employeeBuyerSellerData'));
    }
	
   // get buyers  seller emp data using ajax 29-12-2023
	
   public function getBuyerSellerEmpData(Request $request)
    {
		 $input   = $request->all();
		 
		 $buyerSellerID      = $input['buyer_seller_emp_id'];
		 
		 $wallet_data   = Helper::getWalletData($buyerSellerID);
		 
	     $user_data = User::where('id','=',$buyerSellerID)->first();

		 if($user_data->for == 'buyer'){
			 
			$buyer_data = User::where('id','=',$user_data->id)->first();
			
			$buyer_address_data = TransportAddress::where('buyer_id','=',$buyer_data->id)->pluck('transport_address','id')->toArray();
			
			$buyer_seller_data = ['buyer_seller_data'=>$buyer_data,'buyer_seller_address_data'=>$buyer_address_data, 'user_data'=>$user_data, 'wallet_data'=>$wallet_data];
			
		 }elseif($user_data->for == 'seller'){
			 
			 $seller_data = User::where('id','=',$user_data->id)->first();
			
			 $seller_address_data = SellerTransportAddress::where('seller_id','=',$seller_data->id)->pluck('transport_address','id')->toArray();
			 
			 $buyer_seller_data = ['buyer_seller_data'=>$seller_data,'buyer_seller_address_data'=>$seller_address_data, 'user_data'=>$user_data, 'wallet_data'=>$wallet_data];
		 }
		 
         return response()->json($buyer_seller_data); 
    }
	
	 // get buyers data using ajax
   public function getBuyerAddress(Request $request)
    {
		 $input   = $request->all();
		 
		 $buyerID = $input['buyer_id'];
		 
	     //$buyer_address = TransportAddress::find($buyerID);
		 
	     $buyer_address = TransportAddress::where('buyer_id','=',$buyerID)->pluck('transport_address','id')->toArray();
		 
         return response()->json(['buyer_address' => $buyer_address]);
    }
	
   public function chooseBuyerAddress(Request $request)
    {
		 $input              = $request->all();
		 //dd($input);
		 $buyer_seller_emp_id = $input['buyer_seller_emp_id'];
		 $user_data = User::where('id', '=', $buyer_seller_emp_id)->first();
		 
		 if($user_data->for == 'buyer'){
			$buyer_address_data = TransportAddress::find($input['transport_address']); 
		 }elseif($user_data->for == 'seller'){
			 $buyer_address_data = SellerTransportAddress::find($input['transport_address']); 
		 }
		 
	     
		
         return response()->json(['buyer_address_data' => $buyer_address_data]);
    } 
	
  // save  buynow  form data 09-12-2023 Start
 
   public function buyNow(Request $request)
    {
         $input         = $request->all();
         
	  	 $orderdate     = date("Y-m-d");
	  	 
	  	 $paymentMethod = 'Wallet';
		
		 //dd($input,$orderdate,$paymentMethod);
		
		 $auth_user                      = Auth::user();
		   
         $input['created_by']            = $auth_user->id;

         $buyerSelleID                   = $input['buyer_seller_emp_id'];
		 
		 $input['buyer_seller_id']       = $buyerSelleID;
		 
		 $userData                       = User::where('id','=',$buyerSelleID)->first();

 	     $cart_buy_data                  = Helper::getBuyCartData($request);
		
		 $wallet_data                    = Helper::getWalletData($buyerSelleID);
		 
	   	 $input['cart_product_detail']   = json_encode($cart_buy_data['cart_product_detail_arr']);

	   	 $input['subtotal_price']        = $cart_buy_data['subtotal_price'];
	   	 $input['shipping_estimate']     = $cart_buy_data['shipping_estimate'];
	   	 $input['total_buy_price']       = $cart_buy_data['total_buy_price']; 

	    $input['order_id'] = IdGenerator::generate(['table' => 'orders', 'length' => 20,'field' => 'first_name', 'prefix' =>'OD'.''.date('Y').''.date('m').''.date('d').''.date('i').''.rand(0, 9999).''.$buyerSelleID]);
	   
		   
        $withdrawal_input['created_by'] = $auth_user->id;
		
		$withdrawal_input['withdrawal_date']  = date('Y-m-d');
		
		if($userData->for == 'buyer'){
			$withdrawal_input['buyer_id']         = $userData->buyer_id;
			//date-03-04-2024
			//$withdrawal_input['withdrawal_for']   = 'buyer';
			$withdrawal_input['withdrawal_for']   = 'Order';
			
			
		}elseif($userData->for == 'seller'){
			$withdrawal_input['seller_id']        = $userData->seller_id;
			//date-03-04-2024
			//$withdrawal_input['withdrawal_for']   = 'seller';
			$withdrawal_input['withdrawal_for']   = 'Order';
			
		}

        $withdrawal_input['withdrawal_type']  = 'Debit';
		
        $paymentWithdrawalId = $input['order_id'];
		
		$withdrawal_input['payment_withdrawal_id']  = $paymentWithdrawalId;
		$withdrawal_input['withdrawal_amount']      = $input['total_buy_price'];
		$withdrawal_input['withdrawal_status']      = 'Paid';
		$withdrawal_input['withdrawal_from']        = $buyerSelleID;
		
		if($wallet_data['total_wallet_amount'] < $input['total_buy_price']){

          return redirect()->route('cart')
                ->withInput()
                ->withErrors(['Insufficient balance in wallet']);
		}
		
	   //  dd($input,$cart_buy_data, $wallet_data, $withdrawal_input);
		
	   $buynow     = Order::create($input);

	   //dd($buynow->id);
	   
	   $withdrawal = Withdrawal::create($withdrawal_input);
	   
	   
	   //Update Data Ledger Table Date-22-07-2024 Start

		 $ledger_arr = [
                      'created_by'        => $withdrawal_input['created_by'],
                      'order_id'          => $buynow->id,
                      'buyer_seller_id'   => $input['buyer_seller_id'],
                      'ledger_order_id'   => $input['order_id'], 
                      'ledger_type'       => $withdrawal_input['withdrawal_type'],
                      'ledger_for'        => $withdrawal_input['withdrawal_for'],
					  'ledger_date'       => $withdrawal_input['withdrawal_date'],
					  'ledger_amount'     => intval($input['total_buy_price']), 
                    ];
		
        $ledger = Ledger::create($ledger_arr); 
		
	
	  //Update Data Ledger Table Date-22-07-2024 End
	   
	   
	   //mail send 17-01-2024
     
        $mailData = [
         
              'first_name'       => $buynow->first_name,
              'last_name'        => $buynow->last_name,
              'order_id'         => $paymentWithdrawalId,
              'order_date'       => $orderdate,
              'total_buy_price'  => $input['total_buy_price'],
              'shipping_address' => $buynow->transport_address_name,
              'payment_method'   => $paymentMethod,
        ];
         
        Mail::to($input['email'])->send(new OrderMail($mailData));
            
     //mail send End 17-01-2024

       return redirect()->route('buynow_success')->with('success', 'Congratulations your order has been placed successfully!');

    }

   public function buynowSuccess()
    {
      return view ('products.buynow_success');
    }
// save  buynow  form data 09-12-2023 End
	 
	 
//Add To Cart Functionality method End 01-12-2023
	
	
}