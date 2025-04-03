<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Seller;
use App\Models\Employee;
use App\Models\Categories;
use App\Models\User;
use App\Models\Wallet;
use App\Models\Company;
use App\Models\Designation;
use App\Models\Product;
use Auth;
use DB;
use Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Arr;
use Illuminate\View\View;
use App\Models\HasApiTokens;
use Illuminate\Http\RedirectResponse;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Mail;
use App\Mail\RegisterMail;
use App\Mail\SellerMail;
use Illuminate\Support\Facades\Crypt;


class SellerController extends Controller
{

    /* 	
 	 function __construct()
     {
         $this->middleware('permission:seller-list|seller-create|seller-edit|seller-delete', ['only' => ['index','store']]);
         $this->middleware('permission:seller-create', ['only' => ['create','store']]);
         $this->middleware('permission:seller-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:seller-delete', ['only' => ['destroy']]);
     }  */


    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {

        $per_page = 15;

        $auth_user = Auth::user();

        $is_admin  = $auth_user->for;

        $is_designation  = $auth_user->designation;

        $reqData  = $request->all();
        //dd($reqData);
        $data_collection = Seller::when(
            $request->q,
            function (Builder $builder) use ($request) {
                $builder->where('first_name', 'like', "%{$request->q}%")
                    ->orWhere('last_name', 'like', "%{$request->q}%")
                    ->orWhere('email', 'like', "%{$request->q}%")
                    ->orWhere('mobile', 'like', "%{$request->q}%")
                    ->orWhere('gender', 'like', "%{$request->q}%")
                    ->orWhere('date_of_enrollment', 'like', "%{$request->q}%")
                    ->orWhere('business_name', 'like', "%{$request->q}%")
                    ->orWhere('brand_name', 'like', "%{$request->q}%")
                    ->orWhere('pin_code', 'like', "%{$request->q}%")
                    ->orWhere('country', 'like', "%{$request->q}%")
                    ->orWhere('state', 'like', "%{$request->q}%")
                    ->orWhere('district', 'like', "%{$request->q}%")
                    ->orWhere('city', 'like', "%{$request->q}%")
                    ->orWhere('aadhar_no', 'like', "%{$request->q}%")
                    ->orWhere('pan_no', 'like', "%{$request->q}%")
                    ->orWhere('gst_no', 'like', "%{$request->q}%")
                    ->orWhere('bank_name', 'like', "%{$request->q}%")
                    ->orWhere('ifsc_code', 'like', "%{$request->q}%")
                    ->orWhere('account_no', 'like', "%{$request->q}%")
                    // ->orWhere('status', 'like', "%{$request->q}%")
                    ->orWhere('present_address', 'like', "%{$request->q}%");
            }
        )

            //10-02-2025 Start	  
            ->when(
                $request->today_applied_on,
                function (Builder $builder) use ($request) {

                    if (!empty($request->today_applied_on)) {
                        $builder->whereDate('created_at', 'like', "%{$request->today_applied_on}%");
                    }
                }
            )
            ->when(
                $request->today_updated_on,
                function (Builder $builder) use ($request) {
                    if (!empty($request->today_updated_on)) {
                        $builder->whereDate('updated_at', 'like', "%{$request->today_updated_on}%");
                    }
                }
            )

            ->when(
                $request->today_applied_from,
                function (Builder $builder) use ($request) {

                    if (!empty($request->today_applied_from)) {
                        $builder->whereDate('created_at', '>=', $request->today_applied_from)
                            ->whereDate('created_at', '<=', $request->today_applied_to);
                    }
                }
            )


            //10-02-2025 End 

            ->when(
                $request->today_applied_status,
                function (Builder $builder) use ($request) {

                    $status = $request->today_applied_status;

                    if ($status == 'Active') {
                        $status2 = 1;
                    } else {

                        $status2 = 0;
                    }

                    if (!empty($request->today_applied_status)) {

                        $builder->where('status', '=', $status2);
                    }
                }
            )
            ->when(
                $request->employee_pincode,
                function (Builder $builder) use ($request) {
                    $pin_code = $request->employee_pincode;

                    if (!empty($request->employee_pincode)) {
                        $builder->where('pin_code', '=', $pin_code);
                    }
                }
            )
            ->when(
                $request->employee_users,
                function (Builder $builder) use ($request) {
                    $manager_id = $request->employee_users;
                    if (!empty($request->employee_users)) {
                        $builder->where('managed_by', '=', $manager_id);
                    }
                }
            )
            ->orderBy('id', 'DESC');
        //   dd($data_collection->toSql(), $data_collection->getBindings());

        //update code 01-06-2024   

        if ($is_admin == 'super_admin' || $is_designation == 'HR Manager') {

            $data = $data_collection->paginate($per_page)->appends($request->query());
        } else {

            $user_ids = User::where('created_by', '=', $auth_user->id)->orWhere('managed_by', '=', $auth_user->id)->pluck('id')->toArray();

            array_push($user_ids, $auth_user->id);

            $data = $data_collection->whereIn('created_by', $user_ids)->orWhereIn('managed_by', $user_ids)

                // 22-02-2025	

                ->where(function ($filtered_table) use ($request, $user_ids) {

                    $filtered_table->when(
                        $request->q,
                        function (Builder $builder) use ($request) {

                            $builder->where('first_name', 'like', "%{$request->q}%")
                                ->orWhere('last_name', 'like', "%{$request->q}%")
                                ->orWhere('email', 'like', "%{$request->q}%")
                                ->orWhere('mobile', 'like', "%{$request->q}%");
                        }

                    );
                })

                // 22-02-2025

                ->paginate($per_page)->appends($request->query());
        }
        $pincodes = Seller::distinct()->pluck('pin_code');
        $managers = Seller::whereIn('id', function ($query) {
            $query->select('managed_by')
                ->from('sellers')
                ->groupBy('managed_by');
        })
            ->select('id', 'first_name')
            ->orderBy('first_name', 'ASC')
            ->get();

        $requested_input = $request->all();

        return view('sellers.index', compact('data', 'reqData', 'requested_input', 'pincodes', 'managers'))
            ->with('i', ($request->input('page', 1) - 1) * $per_page);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $auth_user     = Auth::user();

        $categoryData  = Categories::get();

        $is_admin = $auth_user->for;

        $is_designation  = $auth_user->designation;

        if ($is_admin == 'super_admin' || $is_designation == 'HR Manager') {

            //$employeeData = Employee::where('for','=','employee')

            $employeeData = User::where('status', '!=', 0)
                ->where('for', '=', 'employee')
                ->whereNull('deleted_at')
                ->orderBy('id', 'DESC')
                ->get();
        } else {

            $user_ids = User::where('created_by', '=', $auth_user->id)->orWhere('managed_by', '=', $auth_user->id)->pluck('id')->toArray();

            array_push($user_ids, $auth_user->id);

            $user_ids2 = User::whereIn('created_by', $user_ids)->orWhereIn('managed_by', $user_ids)->pluck('id')->toArray();

            array_push($user_ids2, $auth_user->id);



            $employeeData = User::whereIn('managed_by', $user_ids2)
                ->where('for', '=', 'employee')
                // ->orWhereIn('created_by',$user_ids2)
                ->where('status', '!=', 0)
                // ->where('id','!=',$auth_user->id)
                ->whereNull('deleted_at')
                ->orderBy('id', 'DESC')
                ->get();
            // dd($user_ids,$user_ids2,$employeeData);
        }


        /* 01-03-2025	  if($is_admin == 'super_admin'){
				
			  $employeeData   = User::where('for','=','employee')
			                     ->where('status','!=',0)
				                 ->whereNull('deleted_at')
			                     ->orderBy('id','DESC')
			                     ->get();
					
				}else{
					
			   $employeeData  = User::where('for','=','employee')
			   
			                    ->where(function ($query) use ($auth_user){ 
                                           $query->where('created_by','=',$auth_user->id)
			                                ->orWhere('managed_by','=',$auth_user->id);
                                      })
			                     ->where('status','!=',0)
				                 ->whereNull('deleted_at')
			                     ->orderBy('id','DESC')           
									->get();
			   
			}*/

        //dd($categoryData);

        //$employeeData  = Employee::where('created_by','=',$auth_user->id)->get();

        $designationData = Designation::orderBy('designation_name', 'DESC')->get();

        $status = ['0' => 'Deactive', '1' => 'Active'];

        return view('sellers.create', compact('employeeData', 'categoryData', 'status', 'designationData'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name'  => 'required',
            'email' => 'required|unique:sellers,email',
            'mobile' => 'required|unique:sellers,mobile',
        ]);

        $input = $request->all();

        //  dd($input,$request->managed_by);

        //  $sellerManageBy = Employee::where('managed_by','=',$request->managed_by)->first();

        // dd($sellerManageBy);

        //dd($input);
        $auth_user = Auth::user();

        $input['created_by'] = $auth_user->id;

        $input['category_id'] = json_encode($request->category_id);

        // $input['black_listed_district'] = json_encode($request->black_listed_district);
        //Adhar//
        if ($request->hasfile('upload_aadhar_no')) {

            $fileName_upload_aadhar_no = time() . '.' . $request->upload_aadhar_no->extension();

            $request->upload_aadhar_no->move(public_path('uploads/seller/upload_aadhar_no'), $fileName_upload_aadhar_no);

            $input['upload_aadhar_no'] = $fileName_upload_aadhar_no;
        } else {
            unset($input['upload_aadhar_no']);
        }
        //Pan//
        if ($request->hasfile('upload_pan_no')) {

            $fileName_upload_pan_no = time() . '.' . $request->upload_pan_no->extension();

            $request->upload_pan_no->move(public_path('uploads/seller/upload_pan_no'), $fileName_upload_pan_no);

            $input['upload_pan_no'] = $fileName_upload_pan_no;
        } else {
            unset($input['upload_pan_no']);
        }
        //12-10-23//

        //GST//
        if ($request->hasfile('upload_gst_no')) {

            $fileName_upload_gst_no = time() . '.' . $request->upload_gst_no->extension();

            $request->upload_gst_no->move(public_path('uploads/seller/upload_gst_no'), $fileName_upload_gst_no);

            $input['upload_gst_no'] = $fileName_upload_gst_no;
        } else {
            unset($input['upload_gst_no']);
        }

        //brand_registration_upload//

        if ($request->hasfile('brand_registration_upload')) {

            $fileName_brand_registration_upload = time() . '.' . $request->brand_registration_upload->extension();

            $request->brand_registration_upload->move(public_path('uploads/seller/brand_registration_upload'), $fileName_brand_registration_upload);

            $input['brand_registration_upload'] = $fileName_brand_registration_upload;
        } else {
            unset($input['brand_registration_upload']);
        }


        if ($request->hasfile('cheque_copy')) {

            $fileName_cheque_copy = time() . '.' . $request->cheque_copy->extension();

            $request->cheque_copy->move(public_path('uploads/seller/cheque_copy'), $fileName_cheque_copy);

            $input['cheque_copy'] = $fileName_cheque_copy;
        } else {
            unset($input['cheque_copy']);
        }


        if ($request->hasfile('contract_img')) {

            $fileName_contract_img = time() . '.' . $request->contract_img->extension();

            $request->contract_img->move(public_path('uploads/seller/contract_img'), $fileName_contract_img);

            $input['contract_img'] = $fileName_contract_img;
        } else {
            unset($input['contract_img']);
        }
        if ($request->hasfile('seller_brand_logo')) {

            $fileName_seller_brand_logo = time() . '.' . $request->seller_brand_logo->extension();

            $request->seller_brand_logo->move(public_path('uploads/seller/seller_brand_logo'), $fileName_seller_brand_logo);

            $input['seller_brand_logo'] = $fileName_seller_brand_logo;
        } else {
            unset($input['seller_brand_logo']);
        }

        $input['category_id'] = json_encode($request->category_id);
        //dd($input); 
        //$input['password'] = Hash::make($input['password']);

        $seller = Seller::create($input);

        //$input['password'] = Hash::make($input['mobile']);

        $seller_passwords = (Str::random(8));

        $seller_password =  Hash::make($seller_passwords);

        //   $seller_password = Hash::make($input['mobile']);

        $user_arr = [

            'seller_id'             => $seller->id,
            'email'                 => $input['email'],
            'first_name'            => $input['first_name'],
            'last_name'             => $input['last_name'],
            'mobile'                => $input['mobile'],
            'created_by'            => $input['created_by'],
            'managed_by'            => $input['managed_by'],
            'status'                => $input['status'],
            'district'              => $input['district'],
            'password'              => $seller_password,
            'for'                   => 'seller',
            //  'black_listed_district' =>$input['black_listed_district'],
        ];
        //dd($input);       
        $user = User::create($user_arr);

        //date16-05-2024 Start

        $role = ['Seller'];

        //$user->assignRole(['Employee']);	

        $user->assignRole($role);

        //date16-05-2024 End


        //create wallet 05-12-2023 Start

        $wallet_arr_data = [
            'created_by'  => $auth_user->id,
            'seller_id'   => $seller->id,
            //'total_wallet_amount'=>25,
        ];

        $wallet = Wallet::create($wallet_arr_data);

        //create wallet 05-12-2023 End


        // $role = [$input['designation']];

        $user->assignRole(['Seller']);

        // $user->assignRole($role);   

        //  $sellerManageBy = Employee::where('managed_by','=',$seller->managed_by)->first();
        $sellerManageBy = User::where('id', '=', $seller->managed_by)->first();
        //mail send 12-09-2023

        $mailData = [

            'first_name' => $seller->first_name,
            'last_name'  => $seller->last_name,
            'user_id'    => $input['email'],
            'password'   => $seller_passwords,
            'manager_first_name' => $sellerManageBy->first_name,
            'manager_last_name'  => $sellerManageBy->last_name,
            'manager_mobile'     => $sellerManageBy->mobile,
            'manager_email'      => $sellerManageBy->email,
            // 'password'   => $input['mobile'],
        ];

        Mail::to($input['email'])->send(new SellerMail($mailData));

        //mail send End

        return redirect()->route('sellers.index')
            ->with('success', 'Seller created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user        = Seller::find($id);

        $auth_user   = Auth::user();

        $sellercate = json_decode($user->category_id);

        $sellerCreatedBy = User::where('id', '=', $user->created_by)->first();

        //$user_emp = User::where('id','=',$emp->created_by)->first();

        //if($emp->managed_by == 'self'){

        /*   if($user->managed_by == $auth_user->id){
			
			if($auth_user->for == 'company'){
				$user_emp_manage = Company::where('id','=',$auth_user->company_id)->first();
			}elseif($auth_user->for == 'employee'){
				$user_emp_manage = Employee::where('id','=',$auth_user->emp_id)->first();
			}else{
				$user_emp_manage = User::where('id','=',$auth_user->id)->first();
			}
			
		}else{
			$user_emp_manage = User::where('id','=',$user->managed_by)->first();
		} */

        $user_emp_manage = User::where('id', '=', $user->managed_by)->first();
        //dd($user_emp_manage);
        // dd($user_emp_manage,$user->managed_by,$user);

        return view('sellers.show', compact('user', 'sellercate', 'sellerCreatedBy', 'user_emp_manage'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $auth_user       = Auth::user();

        //08-02-2024

        $is_admin = $auth_user->for;

        $is_designation  = $auth_user->designation;

        if ($is_admin == 'super_admin' || $is_designation == 'HR Manager') {

            //$employeeData = Employee::where('for','=','employee')

            $employeeData = User::where('status', '!=', 0)
                ->where('for', '=', 'employee')
                ->whereNull('deleted_at')
                ->orderBy('id', 'DESC')
                ->get();
        } else {

            $user_ids = User::where('created_by', '=', $auth_user->id)->orWhere('managed_by', '=', $auth_user->id)->pluck('id')->toArray();

            array_push($user_ids, $auth_user->id);

            $user_ids2 = User::whereIn('created_by', $user_ids)->orWhereIn('managed_by', $user_ids)->pluck('id')->toArray();

            array_push($user_ids2, $auth_user->id);



            $employeeData = User::whereIn('managed_by', $user_ids2)
                ->where('for', '=', 'employee')
                // ->orWhereIn('created_by',$user_ids2)
                ->where('status', '!=', 0)
                ->where('id', '!=', $auth_user->id)
                //->whereNull('deleted_at')
                ->orderBy('id', 'DESC')
                ->get();
            // dd($user_ids,$user_ids2,$employeeData);
        }


        /* 01-03-2025	  if($is_admin == 'super_admin'){
				
			  $employeeData   = User::where('for','=','employee')
			                         ->where('status','!=',0)
				                     ->whereNull('deleted_at')
			                         ->orderBy('id','DESC')
			                         ->get();
					
				}else{
					
			   $employeeData  = User::where('for','=','employee')
			   
			                    ->where(function ($query) use ($auth_user){ 
                                           $query->where('created_by','=',$auth_user->id)
			                                ->orWhere('managed_by','=',$auth_user->id);
                                      })
			                    ->where('status','!=',0)
				                ->whereNull('deleted_at')
			                    ->orderBy('id','DESC')      
					            ->get();
			   
			}*/

        // $employeeData   = Employee::where('created_by','=',$auth_user->id)->get();

        // 24-01-2024
        //  $employeeData  = Employee::where('managed_by','=',$auth_user->id)->get();

        $designationData = Designation::orderBy('designation_name', 'DESC')->get();

        $user            = Seller::find($id);

        $categoryData    = Categories::orderBy('category_name', 'DESC')->get();

        // 11-03-2025 for hold value after search data hold 

        $request         = request();

        $requested_input = $request->all();

        // 11-03-2025 for hold value after search data hold


        $status          = ['0' => 'Deactive', '1' => 'Active'];

        return view('sellers.edit', compact('user', 'categoryData', 'employeeData', 'status', 'designationData', 'requested_input'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $this->validate($request, [
            //'name' => 'required',
            'email' => 'required|email|unique:employees,email,' . $id,
            //'password' => 'same:confirm-password',
            //'roles' => 'required'
        ]);

        $seller    = Seller::find($id);

        $input = $request->all();

        // 11-03-2025 for hold value after search data hold in search

        $requested_input = [];

        foreach ($input as $req_key => $req_val) {

            if (str_contains($req_key, 'req_')) {

                unset($input[$req_key]);
                $req_key = str_replace("req_", "", $req_key);
                $requested_input[$req_key] = $req_val;
                //dd($requested_input);
            }
        }

        // 11-03-2025 for hold value after search data hold in search


        $auth_user = Auth::user();

        $input['created_by'] = $auth_user->id;

        $input['category_id'] = json_encode($request->category_id);

        if ($request->hasfile('upload_aadhar_no')) {

            $fileName_upload_aadhar_no = time() . '.' . $request->upload_aadhar_no->extension();

            $request->upload_aadhar_no->move(public_path('uploads/seller/upload_aadhar_no'), $fileName_upload_aadhar_no);

            $input['upload_aadhar_no'] = $fileName_upload_aadhar_no;
        } else {
            unset($input['upload_aadhar_no']);
        }
        //Pan//
        if ($request->hasfile('upload_pan_no')) {

            $fileName_upload_pan_no = time() . '.' . $request->upload_pan_no->extension();

            $request->upload_pan_no->move(public_path('uploads/seller/upload_pan_no'), $fileName_upload_pan_no);

            $input['upload_pan_no'] = $fileName_upload_pan_no;
        } else {
            unset($input['upload_pan_no']);
        }
        //12-10-23//

        //GST//
        if ($request->hasfile('upload_gst_no')) {

            $fileName_upload_gst_no = time() . '.' . $request->upload_gst_no->extension();

            $request->upload_gst_no->move(public_path('uploads/seller/upload_gst_no'), $fileName_upload_gst_no);

            $input['upload_gst_no'] = $fileName_upload_gst_no;
        } else {
            unset($input['upload_gst_no']);
        }

        //brand_registration_upload//

        if ($request->hasfile('brand_registration_upload')) {

            $fileName_brand_registration_upload = time() . '.' . $request->brand_registration_upload->extension();

            $request->brand_registration_upload->move(public_path('uploads/seller/brand_registration_upload'), $fileName_brand_registration_upload);

            $input['brand_registration_upload'] = $fileName_brand_registration_upload;
        } else {
            unset($input['brand_registration_upload']);
        }


        if ($request->hasfile('cheque_copy')) {

            $fileName_cheque_copy = time() . '.' . $request->cheque_copy->extension();

            $request->cheque_copy->move(public_path('uploads/seller/cheque_copy'), $fileName_cheque_copy);

            $input['cheque_copy'] = $fileName_cheque_copy;
        } else {
            unset($input['cheque_copy']);
        }


        if ($request->hasfile('contract_img')) {

            $fileName_contract_img = time() . '.' . $request->contract_img->extension();

            $request->contract_img->move(public_path('uploads/seller/contract_img'), $fileName_contract_img);

            $input['contract_img'] = $fileName_contract_img;
        } else {
            unset($input['contract_img']);
        }

        if ($request->hasfile('seller_brand_logo')) {

            $fileName_seller_brand_logo = time() . '.' . $request->seller_brand_logo->extension();

            $request->seller_brand_logo->move(public_path('uploads/seller/seller_brand_logo'), $fileName_seller_brand_logo);

            $input['seller_brand_logo'] = $fileName_seller_brand_logo;
        } else {
            unset($input['seller_brand_logo']);
        }
        //$user = Seller::find($id);
        $seller->update($input);

        $user = User::where('for', '=', 'seller')->where('seller_id', '=', $seller->id)->first();

        $user_arr = [

            'first_name'  => $input['first_name'],
            'last_name'   => $input['last_name'],
            'mobile'      => $input['mobile'],
            'created_by'  => $input['created_by'],
            'managed_by'  => $input['managed_by'],
            'status'      => $seller->status,
            // 'designation'=> $input['designation'],
            'district'    => $input['district'],
            'seller_id'   => $seller->id,
            'email'       => $input['email'],
            //'password'=>$employ_password,
            'for' => 'seller',
            // 'black_listed_district' =>$input['black_listed_district'],

        ];

        $user->update($user_arr);

        //26-10-2024d

        if ($seller->status == 0) {
            $seller_product = Product::where('seller_id', '=', $seller->id)->update(['user_product_status' => 'On Hold']);
        } else {

            $seller_product = Product::where('seller_id', '=', $seller->id)->update(['user_product_status' => 'Active']);
        }

        //26-10-2024

        //date16-05-2024 Start


        DB::table('model_has_roles')->where('model_id', $user->id)->delete();

        $role = ['Seller'];

        //$user->assignRole(['Employee']);	

        $user->assignRole($role);

        //date16-05-2024 End

        return redirect()->route('sellers.index', $requested_input)->with('success', 'Seller updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Seller::find($id)->delete();

        //code update date 30-01-2025
        User::where('seller_id', '=', $id)->delete();

        return redirect()->route('sellers.index')->with('success', 'Seller deleted successfully');
    }


    //Seller Profile Section  14-11-2023

    public function seller_profile()
    {
        $auth_user = Auth::User();

        $seller    = Seller::find($auth_user->seller_id);

        return view('sellers.view_seller_profile', compact('seller'));
    }

    public function edit_seller_profile()
    {
        $auth_user = Auth::User();

        $seller    = Seller::find($auth_user->seller_id);

        return view('sellers.seller_profile', compact('seller'));
    }

    //14.11.2023//

    public function update_seller_profile(Request $request, $id)
    {
        $input = $request->all();
        //dd($input);

        $seller = Seller::find($id);

        if ($request->hasfile('profile_img')) {

            $fileName_profile_img = time() . '.' . $request->profile_img->extension();

            $request->profile_img->move(public_path('uploads/seller/profile_img'), $fileName_profile_img);

            $input['profile_img'] = $fileName_profile_img;
        } else {
            unset($input['profile_img']);
        }

        //Adhar//
        if ($request->hasfile('upload_aadhar_no')) {

            $fileName_upload_aadhar_no = time() . '.' . $request->upload_aadhar_no->extension();

            $request->upload_aadhar_no->move(public_path('uploads/seller/upload_aadhar_no'), $fileName_upload_aadhar_no);

            $input['upload_aadhar_no'] = $fileName_upload_aadhar_no;
        } else {
            unset($input['upload_aadhar_no']);
        }
        //Pan//
        if ($request->hasfile('upload_pan_no')) {

            $fileName_upload_pan_no = time() . '.' . $request->upload_pan_no->extension();

            $request->upload_pan_no->move(public_path('uploads/seller/upload_pan_no'), $fileName_upload_pan_no);

            $input['upload_pan_no'] = $fileName_upload_pan_no;
        } else {
            unset($input['upload_pan_no']);
        }
        //12-10-23//

        //GST//
        if ($request->hasfile('upload_gst_no')) {

            $fileName_upload_gst_no = time() . '.' . $request->upload_gst_no->extension();

            $request->upload_gst_no->move(public_path('uploads/seller/upload_gst_no'), $fileName_upload_gst_no);

            $input['upload_gst_no'] = $fileName_upload_gst_no;
        } else {
            unset($input['upload_gst_no']);
        }

        //brand_registration_upload//

        if ($request->hasfile('brand_registration_upload')) {

            $fileName_brand_registration_upload = time() . '.' . $request->brand_registration_upload->extension();

            $request->brand_registration_upload->move(public_path('uploads/seller/brand_registration_upload'), $fileName_brand_registration_upload);

            $input['brand_registration_upload'] = $fileName_brand_registration_upload;
        } else {
            unset($input['brand_registration_upload']);
        }


        if ($request->hasfile('cheque_copy')) {

            $fileName_cheque_copy = time() . '.' . $request->cheque_copy->extension();

            $request->cheque_copy->move(public_path('uploads/seller/cheque_copy'), $fileName_cheque_copy);

            $input['cheque_copy'] = $fileName_cheque_copy;
        } else {
            unset($input['cheque_copy']);
        }


        if ($request->hasfile('contract_img')) {

            $fileName_contract_img = time() . '.' . $request->contract_img->extension();

            $request->contract_img->move(public_path('uploads/seller/contract_img'), $fileName_contract_img);

            $input['contract_img'] = $fileName_contract_img;
        } else {
            unset($input['contract_img']);
        }

        $seller->update($input);

        return redirect()->route('edit_seller_profile', ['active_tab' => $request->active_tab])
            ->with('success', 'Seller Profile Updated Successfully');
    }
}
