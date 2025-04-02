<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Lead;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Product;
use App\Models\CustomerComment;
use App\Models\CustomerPayment;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LeadsExport;
use App\Imports\LeadsImport;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Str;
use Auth;
use DB;
use Hash;

class CustomerController extends Controller
{
	
  function __construct()
     {
         $this->middleware('permission:customer-list|customer-create|customer-edit|customer-delete', ['only' => ['index','store']]);
         $this->middleware('permission:customer-create', ['only' => ['create','store']]);
         $this->middleware('permission:customer-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:customer-delete', ['only' => ['destroy']]);
     }
	
	
	 /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	 
    public function index(Request $request): View
    {
        $per_page = 15;
		
		$auth_user = Auth::user();
		
		$is_admin= $auth_user->for;
		
		$data_collection = Customer::select('customers.*', 'employees.id as emp_id', 'employees.first_name as emp_first_name', 'employees.last_name as emp_last_name',  'employees.email as emp_email')
		              ->leftJoin('employees','employees.id','=','customers.managed_by')
		                   ->when($request->q,function (Builder $builder) use ($request) {
							$builder->where('customers.first_name', 'like', "%{$request->q}%")
							->orWhere('customers.last_name', 'like', "%{$request->q}%")
							->orWhere('customers.email', 'like', "%{$request->q}%")
							->orWhere('customers.mobile', 'like', "%{$request->q}%")
							->orWhere('customers.pin_code', 'like', "%{$request->q}%")
							->orWhere('customers.country', 'like', "%{$request->q}%")
							->orWhere('customers.state', 'like', "%{$request->q}%")
							->orWhere('customers.city', 'like', "%{$request->q}%");
					       }
					    )
						
					->orderBy('customers.id','DESC');
				
					if($is_admin == 'super_admin'){
						
					$data=$data_collection->paginate($per_page);
						
					}else{
						
					$data=$data_collection->where('customers.managed_by','=',$auth_user->id)
					
					->orWhere('customers.created_by','=',$auth_user->id)->paginate($per_page);	
					}
					
				return view('customers.index',compact('data'))
					->with('i', ($request->input('page', 1) - 1) * $per_page);		
			
			
/* 		$auth_user = Auth::user();
		
	    $per_page = 10;
		
		$all_data_list_to_users = [48,21];
		
		$data_collection = Customer::select('customers.*', 'employees.id as emp_id', 'employees.first_name as emp_first_name', 'employees.last_name as emp_last_name',  'employees.email as emp_email')
		              ->leftJoin('employees','employees.id','=','customers.managed_by')
		                   ->when($request->q,function (Builder $builder) use ($request) {
							$builder->where('customers.first_name', 'like', "%{$request->q}%")
							->orWhere('customers.last_name', 'like', "%{$request->q}%")
							->orWhere('customers.email', 'like', "%{$request->q}%")
							->orWhere('customers.mobile', 'like', "%{$request->q}%")
							->orWhere('customers.pin_code', 'like', "%{$request->q}%")
							->orWhere('customers.country', 'like', "%{$request->q}%")
							->orWhere('customers.state', 'like', "%{$request->q}%")
							->orWhere('customers.city', 'like', "%{$request->q}%");
					       }
					    )
					->orderBy('customers.id','DESC');
				//dd($auth_user->id);
                if($auth_user->for == 'employee' && !in_array($auth_user->emp_id,$all_data_list_to_users)){
				//dd('hi');
				$data_collection->where('customers.managed_by', '=', $auth_user->emp_id);
			  }	  			
			$data =	$data_collection->paginate($per_page);
            // dd($data);
        return view('customers.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * $per_page); */
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
		
		$auth_user = Auth::user();
		
		//$productData = Product::first();
		$productData = Product::orderBy('id','DESC')->get();
		
        $status = ['0'=>'Deactive','1'=>'Active'];
		
        return view('customers.create',compact('status','productData'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): RedirectResponse
    {
		   $input = $request->all();
         
		  
        $this->validate($request, [
            //'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'mobile' => 'required|unique:users,mobile',
            //'password' => 'required|same:confirm-password',
            //'roles' => 'required'
			'status' => 'required'
        ]);
    
 //dd($input);
        $auth_user=Auth::user();
		
		
        $input['created_by'] = $auth_user->id;
        $input['managed_by'] = $auth_user->id;

        if($request->hasfile('product_photo')){
			
		$fileName_product_photo = time() . '.'. $request->product_photo->extension();  
    
		   $request->product_photo->move(public_path('uploads/customer/product_photo'), $fileName_product_photo);
			
			$input['product_photo'] = $fileName_product_photo;
		}


        if($request->hasfile('payment_receipt')){
			
		$fileName_payment_receipt = time() . '.'. $request->payment_receipt->extension();  
    
		   $request->payment_receipt->move(public_path('uploads/customer/payment_receipt'), $fileName_payment_receipt);
			
		    $input['payment_receipt'] = $fileName_payment_receipt;
		}

        $customer = Customer::create($input);
		
		// customer payment table data 27-09-2023
		$orderIDGenerator = IdGenerator::generate(['table' => 'customer_payments', 'length' => 5, 'prefix' =>date('ym').''.rand(0, 99999).''.$customer->id]);
		//$orderIDGenerator1=rand(0, 99999).''.$customer->id;
		//dd($orderIDGenerator,$orderIDGenerator1);
        //output: 1910000001
		$customerPaymentData = [
			  'customer_id'=>$customer->id,
			  'created_by'=>$auth_user->id,
			  'managed_by'=>$auth_user->id,
			  'product_id'=>$request->product_name,
			  //'product_name'=>$input['product_name'],
			  'feedback'=>$input['feedback'],
			  'follow_up_date'=>$input['follow_up_date'],
			  'amount_paid'=>$input['amount_paid'],
			  'final_cost_of_product'=>$input['final_cost_of_product'],
			  'payment_order_id'=>$orderIDGenerator,
			  'status'=>$input['status'],
			  'payment_status'=>'pending',
			  
			];
					
		$customerPayment = CustomerPayment::create($customerPaymentData);
		
       // customer payment table data End27-09-2023
	   
	   
	   // customer detail add users table data 27-09-2023
		
		$customer_password = Hash::make(rand());
		
		$userData = [
			  'customer_id'=>$customer->id,
			  'first_name'=>$input['first_name'],
			  'last_name'=>$input['last_name'],
			  'mobile'=>$input['mobile'],
			  'present_address'=>$input['present_address'],
			  'email'=>$input['email'],
			  'password'=>$customer_password,
			  'for'=>'normal_user',
			  //'payment_status'=>'pending',
			   // 'for'=>'customer',
			];
					
		$user= User::create($userData);
		
       // customer detail user table data End 27-09-2023
	   
	   
        return redirect()->route('customers.index')
                        ->with('success','Customer created successfully');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id): View
    {
        $customer = Customer::find($id);

	    
	    $customer_payment = DB::table('customer_payments')->select('customer_payments.*','users.first_name as user_firstname', 'users.last_name as user_lastname','products.product_name as productName')
            ->join('users', 'users.id', '=', 'customer_payments.created_by')
            ->join('products', 'products.id', '=', 'customer_payments.product_id')
            ->where('customer_payments.customer_id', '=', $customer->id)
            ->get()->toArray();	

		   
	    // $customer_payment = CustomerPayment::get();	
		
		
       // dd($customer_payment);
        return view('customers.show',compact('customer','customer_payment'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id): View
    {
        $customer = Customer::find($id);
		$status = ['0'=>'Deactive','1'=>'Active'];
    
        return view('customers.edit',compact('customer','status'));
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
		
		
		$customer = Customer::find($id);
		
		$user_data = User::where('customer_id', '=', $id)->first();
		
        $this->validate($request, [
          // 'name' => 'required',
          //  'email' => 'required|email|unique:users,email,'.$user_data->id,
           // 'mobile' => 'required|unique:users,mobile,'.$user_data->id,
          //  'password' => 'same:confirm-password',
          //  'roles' => 'required'
        ]);
    
        $input = $request->all();
     
	   
	     $productID = $request->product_name;	   
	//     dd($input, $productID);
	   //for paid amt get start
		
		 $amount_paid=CustomerPayment::where('customer_id','=',$customer->id)
		                                   ->where('product_id','=',$productID)
										   ->where('payment_status','!=','Rejected')
										   ->groupBY('product_id')->sum('amount_paid');
										   
		//dd($input,$amount_paid);
		
		$customerPayment=CustomerPayment::select('gst_no', 'total', 'discount','final_cost_of_product')
		                                ->where('customer_id','=',$customer->id)
		                                ->where('product_id','=',$productID)->orderBy('id', 'ASC')->first();
										
		  
          if($customerPayment == null){
			  	$customerFirstPayment = ['gst_no'=>'0', 'total'=>'0', 'discount'=>'0', 'final_cost_of_product'=>'0'];
		  }else{
			$customerFirstPayment = ['gst_no'=>$customerPayment->gst_no, 'total'=>$customerPayment->total, 'discount'=>$customerPayment->discount, 'final_cost_of_product'=>$customerPayment->final_cost_of_product];	  
		  }
		  
		  $amt_tobe_paid=$request->amount_paid;
		  
		  if($customerFirstPayment['final_cost_of_product']!=0){
			
			$due_amount=($customerFirstPayment['final_cost_of_product']-$amount_paid);
			
			if($amt_tobe_paid > $due_amount){
				
				return back()->withInput()->withErrors(['amount_paid'=>'Payable amount should be less than or equql to due amount']);
			}
			
			if($amt_tobe_paid == $due_amount && $input['status'] != 'Order Made'){
				
				return back()->withInput()->withErrors(['status'=>'Final Status should be Order Made']);
			}
			//return back()->withErrors([''=>'']);
		}
		else{
			
			$due_amount=($request->final_cost_of_product-$amount_paid);
			
			if($amt_tobe_paid > $due_amount){
				
				return back()->withInput()->withErrors(['amount_paid'=>'Payable amount should be less than or equql to due amount']);
			}
			
		}
		//dd($input,$amount_paid,$customerFirstPayment);
		//for paid amt get end

         
        $auth_user=Auth::user();
		
        $input['created_by'] = $auth_user->id;

      if($request->hasfile('product_photo')){
			
		$fileName_product_photo = time() . '.'. $request->product_photo->extension();  
    
		   $request->product_photo->move(public_path('uploads/customer/product_photo'), $fileName_product_photo);
			
			$input['product_photo'] = $fileName_product_photo;
		}


        if($request->hasfile('payment_receipt')){
			
		$fileName_payment_receipt = time() . '.'. $request->payment_receipt->extension();  
    
		   $request->payment_receipt->move(public_path('uploads/customer/payment_receipt'), $fileName_payment_receipt);
		   $input['payment_receipt'] = $fileName_payment_receipt;
		}

        $customer->update($input);
        
	    // customer payment table data 27-09-2023
				
	    //$orderIDGenerator = IdGenerator::generate(['table' => 'customer_payments', 'length' => 10, 'prefix' =>date('ym')]);
        $orderIDGenerator = IdGenerator::generate(['table' => 'customer_payments', 'length' => 5, 'prefix' =>date('ym').''.rand(0, 99999).''.$customer->id]);
		//output: 1910000001
		
		$customerPaymentData = [
			  'customer_id'=>$customer->id,
			  'created_by'=>$auth_user->id,
			  'managed_by'=>$auth_user->id,
			  'product_id'=>$customer->product_name,
			  'slot'=>$input['slot'],
			  'investment'=>$input['investment'],
			  'guaranteed_profit'=>$input['guaranteed_profit'],
			  'gst_no'=>$input['gst_no'],
			  'total'=>$input['total'],
			  'discount'=>$input['discount'],
			  'final_cost_of_product'=>$input['final_cost_of_product'],
			  'status'=>$input['status'],
			  'follow_up_date'=>$input['follow_up_date'],
			  'feedback'=>$input['feedback'],
			  'amount_paid'=>$input['amount_paid'],
			  'payment_receipt_no'=>$input['payment_receipt_no'],
			  'payment_receipt'=>$input['payment_receipt'],
			  'payment_order_id'=>$orderIDGenerator,
			  'payment_status'=>'pending',
			  
			];
					
		$customerPayment = CustomerPayment::create($customerPaymentData);
		
       // customer payment table data End27-09-2023
	   
	  // customer detail add users table data 05-10-2023
		
/* 		$customer_password = Hash::make(rand());
		
		$userData = [
			  'customer_id'=>$customer->id,
			  'first_name'=>$input['first_name'],
			  'last_name'=>$input['last_name'],
			  'mobile'=>$input['mobile'],
			  'present_address'=>$input['present_address'],
			  'email'=>$input['email'],
			  'password'=>$customer_password,
			  'for'=>'normal_user',
			  //'payment_status'=>'pending',
			  // 'for'=>'customer',
			];
					
		$user= User::create($userData); */
		
       // customer detail user table data End 05-10-2023
		
        return redirect()->route('customers.index')
                        ->with('success','Customer updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id): RedirectResponse
    {
        Customer::find($id)->delete();
        return redirect()->route('customers.index')
                        ->with('success','Customer deleted successfully');
    }
	
	/**
    * @return \Illuminate\Support\Collection
    */
	
	
/* 	 public function addCustomerComment(Request $request, $id){
	   
	   $auth_user = Auth::user();
	   
	   $input     = $request->all();
	   
	   $input['customer_id'] = $id;
	   
	   $input['created_by']  = $auth_user->id;
	  // dd($input);
	   CustomerComment::create($input);
	   
	   return back()->with('success','Customer comment added successfully');
   }  */
   
   
   //date24-09-2023
   
   public function getProductTypeData(Request $request){
	   
   		  $auth_user = Auth::user();
		  //15-102023
          $is_admin= $auth_user->for;
		  
		  if($is_admin == 'super_admin'){
						
				$productTypeData   = Product::where('product_type','=',$request->product_type)->pluck('product_name','id')->toArray();
						
					}else{
						
                 $productTypeData   = Product::where('created_by','=',$auth_user->id)->where('product_type','=',$request->product_type)->pluck('product_name','id')->toArray();
				 
					}
			//15-102023		
		   
	      return response()->json(['product_data'=>$productTypeData]);
	  
   }
   
   public function getProductDetail(Request $request){
	   
   		  $auth_user = Auth::user();
		  
		  $amount_paid=CustomerPayment::where('customer_id','=',$request->customerId)
		                                   ->where('product_id','=',$request->productId)
										   ->where('payment_status','!=','Rejected')
										   ->groupBY('product_id')->sum('amount_paid');
										   
		  $customerPayment=CustomerPayment::select('gst_no', 'total', 'discount','final_cost_of_product')->where('customer_id','=',$request->customerId)
		                                   ->where('product_id','=',$request->productId)->orderBy('id', 'ASC')->first();
		  
          if($customerPayment == null){
			  	$customerFirstPayment = ['gst_no'=>'0', 'total'=>'0', 'discount'=>'0', 'final_cost_of_product'=>'0'];
		  }else{
			$customerFirstPayment = ['gst_no'=>$customerPayment->gst_no, 'total'=>$customerPayment->total, 'discount'=>$customerPayment->discount, 'final_cost_of_product'=>$customerPayment->final_cost_of_product];	  
		  }		  
          
		  
         // return response()->json(['product_detail'=>$customerFirstPayment]);
		  
		  $productDetail   = Product::where('id','=',$request->productId)->first()->toArray();
         
	      return response()->json(['product_detail'=>$productDetail, 'amount_paid'=>$amount_paid, 'customerFirstPayment'=>$customerFirstPayment]);
	  
   }

}