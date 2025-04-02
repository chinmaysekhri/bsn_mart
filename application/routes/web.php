<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\DataTableController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ProductController;  
use App\Http\Controllers\MailController;
use App\Http\Controllers\LiveMachineController;
use App\Http\Controllers\MachineUserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\BuyerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\ProspectiveSellerController;
use App\Http\Controllers\ProspectiveBuyerController;
use App\Http\Controllers\TransportAddressController;
use App\Http\Controllers\SellerTransportAddressController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\WithdrawalController;
use App\Http\Controllers\FundController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\SellerApplicationController;
use App\Http\Controllers\BuyerApplicationController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\PurchaseReturnController;
use App\Http\Controllers\MyProductController;
use App\Http\Controllers\SocialShareController;
use App\Http\Controllers\CartReturnController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
| Delopved By: Rajesh Kumar
| Contact: 8383019093
| Email:rajeshcert08@gmail.com

|
*/

 Route::controller(UserController::class)->group(function(){
    // Route::get('users', 'index');
    // Route::get('users-export', 'export')->name('users.export');
    // Route::post('users-import', 'import')->name('users.import');
}); 


Route::get('send-mail', [MailController::class, 'index']);

Route::post('/datatable', [DataTableController::class, 'getData'])->name('datatable.data');

// 03-07-2023 Start

Auth::routes();
  
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Date:11-10-2024


Route::any('myproduct/{id}', [MyProductController::class, 'myProduct'])->name('myproduct');

Route::any('share-my-product', [MyProductController::class, 'shareMyProduct'])->name('share_my_product');


Route::get('share-product-detail/{product_slug}', [MyProductController::class, 'shareProductDetail'])->name('share_product_detail');


//03-02-2024

Route::post('seller-web-pplication',[SellerApplicationController::class, 'sellerWebApplication'])->name('seller_web_application');

Route::post('buyer-web-pplication',[BuyerApplicationController::class, 'buyerWebApplication'])->name('buyer_web_application');


Route::group(['middleware' => ['auth']], function() {
	
	Route::get('/dashboard',[AdminController::class, 'dashboard'])->name('dashboard');
	
    Route::resource('roles', RoleController::class);
		//08-01-2024
	Route::resource('designations', DesignationController::class);
    Route::resource('users', UserController::class);
    Route::resource('employees', EmployeeController::class);
    Route::resource('companies', CompanyController::class);
	Route::resource('tasks', TaskController::class);
	Route::resource('livemachines', LiveMachineController::class);
	Route::resource('machineusers', MachineUserController::class);
	Route::resource('complainants', ComplainantController::class);
	Route::resource('cartreturns', CartReturnController::class);

	//date 15-09-2024
	
	Route::get('social-share', [SocialShareController::class, 'index']);
	
	//Date 09-02-2024
	
	Route::resource('purchases', PurchaseController::class);
	
	//Route::get('purchase-edit',[PurchaseController::class, 'purchaseEdit'])->name('purchase_edit');
    // Route::get('purchase-show',[PurchaseController::class, 'purchaseShow'])->name('purchase_show');
	
	//16-02-2024
	
	Route::post('get-purchase-product-data', [PurchaseController::class, 'getPurchaseProductData'])->name('get_purchase_product_data');
	
	//21-01-2025
	Route::get('get-product-stock-data', [PurchaseController::class, 'productStockList'])->name('product_stock_data');
	
	
	
	Route::resource('purchasereturns', PurchaseReturnController::class);
	

	// Route::get('purchasereturn-edit',[PurchaseReturnController::class, 'purchaseReturnEdit'])->name('purchasereturn_edit');
    // Route::get('purchasereturn-show',[PurchaseReturnController::class, 'purchaseReturnShow'])->name('purchasereturn_show');
	
	Route::post('get-purchase-return-product-data', [PurchaseReturnController::class, 'getPurchaseReturnProductData'])->name('get_purchase_return_product_data');
	
	//date05-02-2024
	Route::resource('tasks', TaskController::class);
	
	Route::any('add-task-comment/{id}',[TaskController::class, 'addTaskComment'])->name('add_task_comment');
	
	//9-1-24  
	Route::resource('sellerapplications', SellerApplicationController::class);
	
    Route::post('/applicationseller-assign-to-employee',[SellerApplicationController::class, 'applicationSellerAssignEmployee'])->name('applicationSeller_assign_employee');
	
	Route::resource('buyerapplications', BuyerApplicationController::class);
   
    Route::post('/applicationbuyer-assign-to-employee',[BuyerApplicationController::class, 'applicationBuyerAssignEmployee'])->name('applicationBuyer_assign_employee');
    
	Route::resource('orders', OrderController::class);
	
	Route::post('update-order-status/{id}',[OrderController::class, 'updateOrderStatus'])->name('update_order_status');
	Route::any('delivered-product/order_id/{order_id}/product_id/{product_id}',[OrderController::class, 'deliveredProduct'])->name('delivered_product');
	
	Route::any('modify-order/{id}',[OrderController::class, 'modifyOrder'])->name('modify_order');
	
	Route::any('update-modify-order/{id}',[OrderController::class, 'UpdateModifyOrder'])->name('update_modify_order');
	
	
	Route::any('tax-invoice',[OrderController::class, 'taxInvoice'])->name('tax_invoice');
	Route::get('buyer-order',[OrderController::class, 'buyerOrder'])->name('buyer_order');
	
	Route::get('seller-order',[OrderController::class, 'sellerOrder'])->name('seller_order');
	
	Route::post('/get-today-single-product-order',[OrderController::class, 'todaySingleProductOrder'])->name('get_today_single_product_order');
	
	//date 13-08-2024
	
	Route::post('/get-purchase-product-order',[OrderController::class, 'purchaseProductOrder'])->name('get_purchase_product_order');
	
	Route::post('/get-purchase-return-product-order',[OrderController::class, 'purchaseReturnProductOrder'])->name('get_purchase_return_product_order');
	
	//date 13-08-2024
	
	Route::get('my-product-order',[OrderController::class, 'myProductOrder'])->name('my_product_order');
	
	//22-01-2024
	Route::post('/get-today-my-product-order',[OrderController::class, 'getTodayMyProductOrder'])->name('get_today_my_product_order');
	
   //21-12-2023 End
   
	Route::resource('wallets', WalletController::class);
	
	//date 18-12-2023
	
	Route::get('view-wallet-history',[WalletController::class, 'viewWalletHistory'])->name('view_wallet_history');
	
	Route::resource('funds', FundController::class);
	
	//Route::get('fund-log', [FundController::class, 'fundLog'])->name('fund_log');
	
	Route::any('add-fund-comment/{id}',[FundController::class, 'addFundComment'])->name('add_fund_comment');
	
	//14-12-2023
	
	Route::resource('withdraws', WithdrawalController::class);
	
	Route::get('withdrawal-log', [WithdrawalController::class, 'withdrawalLog'])->name('withdrawal_log');
	
	Route::any('add-withdrawal-comment/{id}',[WithdrawalController::class, 'addWithdrawalComment'])->name('add_withdrawal_comment');
	
    // Date : 12-12-2023

    //Route::get('wallet',[WalletController::class, 'wallet'])->name('wallet');
	
	//13-11-2023
	
	Route::resource('sellers', SellerController::class);
	
    Route::get('/seller-profile',[SellerController::class, 'seller_profile'])->name('seller_profile');
	
	Route::get('/edit-seller-profile',[SellerController::class, 'edit_seller_profile'])->name('edit_seller_profile');
	
	Route::post('/update-seller-profile/{id}',[SellerController::class, 'update_seller_profile'])->name('update_seller_profile');
	
	//Route::post('/get-seller-data',[SellerController::class, 'getSellerData'])->name('get_seller_data');
	
	
    Route::resource('buyers', BuyerController::class);
	
	Route::get('/buyer-profile',[BuyerController::class, 'buyer_profile'])->name('buyer_profile');
	
	Route::get('/edit-buyer-profile',[BuyerController::class, 'edit_buyer_profile'])->name('edit_buyer_profile');
	
	Route::post('/update-buyer-profile/{id}',[BuyerController::class, 'update_buyer_profile'])->name('update_buyer_profile');
	
	
    Route::resource('categories', CategoryController::class);
	
    Route::resource('subcategories', SubCategoryController::class);
	// date 31-03-2024
	Route::get('category-autocomplete', [SubCategoryController::class, 'category_autocomplete'])->name('category_autocomplete');
	
	//06-12-2023
    Route::resource('prospectivesellers', ProspectiveSellerController::class);
    
     //10-02-2025
	Route::post('/prospective-seller-assign-employee',[ProspectiveSellerController::class, 'prospectiveSellersAssignEmployee'])->name('prospective_seller_assign_employee');
	
    
    Route::resource('prospectivebuyers', ProspectiveBuyerController::class);
    
    	//08-02-2025
	Route::post('/prospective-buyers-assign-employee',[ProspectiveBuyerController::class, 'prospectiveBuyersAssignEmployee'])->name('prospective_buyers_assign_employee');
	
    //08-06-2024 task assign to employee
	
    Route::post('/prosseller-assign-to-employee',[ProspectiveSellerController::class, 'prosSellerAssignEmployee'])->name('prosseller_assign_employee');
   
    //08-06-2024 task assign to employee
	Route::resource('transportaddresses', TransportAddressController::class);
	
	Route::resource('sellertransportaddresses', SellerTransportAddressController::class);
	
	//Company  05.09.23

	Route::get('/company-profile',[CompanyController::class, 'company_profile'])->name('company_profile');
	Route::get('/edit-company-profile',[CompanyController::class, 'edit_company_profile'])->name('edit_company_profile');
	Route::post('/update-company-profile/{id}',[CompanyController::class, 'update_company_profile'])->name('update_company_profile');
	
	//Company  05.09.23 end
	
	Route::any('employee-detail/{id}',[EmployeeController::class, 'employeeDetail'])->name('employees_detail');
	Route::any('add-employee-comment/{id}',[EmployeeController::class, 'addEmployeeComment'])->name('add_employees_comment');
	Route::any('employee-verify/{id}',[EmployeeController::class, 'employeeVerify'])->name('employee_verify');
	Route::any('add-user-comment/{id}',[UserController::class, 'addUserComment'])->name('add_users_comment');
	Route::patch('employee-detail-update/{id}',[EmployeeController::class, 'employeeDetailUpdate'])->name('employees_detail_update');
	
	Route::get('/profile',[UserController::class, 'profile'])->name('profile');

	Route::get('/show-profile',[UserController::class, 'viewProfile'])->name('view_profile');
	
	Route::post('/update-profile/{id}',[UserController::class, 'update_profile'])->name('update_profile');
	
	Route::get('/employee-profile',[EmployeeController::class, 'employee_profile'])->name('employee_profile');
	
	Route::get('/edit-employee-profile',[EmployeeController::class, 'edit_employee_profile'])->name('edit_employee_profile');
	
	Route::post('/update-employee-profile/{id}',[EmployeeController::class, 'update_employee_profile'])->name('update_employee_profile');

	//date 03-08-2024
	
	Route::get('reset-password',[UserController::class, 'usersResetPassword'])->name('reset_password');
	
    Route::post('update-reset-password',[UserController::class, 'updateResetPassword'])->name('update_reset.password');
	
	//Customer route start 22-08-23
	
	// 08-09-2023
	
    Route::resource('customers', CustomerController::class);
	
	Route::any('add-customer-comment/{id}',[CustomerController::class, 'addCustomerComment'])->name('add_customer_comment');
  
  // get product data using product type 25-09-2023
		
    Route::post('get-product-type-data', [CustomerController::class, 'getProductTypeData'])->name('get_product_type_data');
   
    Route::post('get-product-detail', [CustomerController::class, 'getProductDetail'])->name('get_product_detail');

	//Customer route end
	
	//16-11-2023 
	
    Route::resource('products', ProductController::class);
	Route::post('get-product-data', [ProductController::class, 'getProductData'])->name('get_product_data');

   
	
  //02-01-2025

    Route::post('suggest-product', [ProductController::class, 'suggestProduct'])->name('suggest_product');
    Route::get('suggest-product-list', [ProductController::class, 'suggestProductList'])->name('suggest_product_list');
    
    Route::post('update-exclusive-status/{id}', [ProductController::class, 'updateExclusiveStatus'])->name('update_exclusive_status');
    Route::post('product-exclusive/{product_id}', [ProductController::class, 'productExclusive'])->name('product_exclusive');
    

   //02-01-2025 End
   
	//27-11-2023
	Route::any('store-subcategory-data', [ProductController::class, 'storeSubcategoryData'])->name('store_subcategory_data');

	//20-11-2023
	
	Route::any('product-list',[ProductController::class,'productList'])->name('product_list');
	
	// date 31-03-2024
	
	Route::get('product-autocomplete', [ProductController::class, 'product_autocomplete'])->name('product_autocomplete');
	
	Route::post('get-product-search-data', [ProductController::class, 'getProductSearchData'])->name('get_product_search_data');
	
	// date 31-03-2024 End
	
	Route::get('product-detail/{product_slug}',[ProductController::class,'productDetail'])->name('product_detail');
	
	//get subcategory data 23-11-2023
	
	Route::post('get-subcategory-data', [ProductController::class, 'getSubcategoryData'])->name('get_subcategory_data');
		//Date 19-10-2024
	
	Route::post('get-brand-data', [ProductController::class, 'getBrandData'])->name('get_brand_data');
	
	//18-11-2023
	
	Route::post('get-seller-data', [ProductController::class, 'getSellerData'])->name('get_seller_data');
	
	// 29-12-2023
	
	Route::post('/get-buyer-seller-emp-data',[ProductController::class, 'getBuyerSellerEmpData'])->name('get_buyer_seller_emp_data');
	
	// 07-12-2023
	
	Route::post('/get-buyer-address',[ProductController::class, 'getBuyerAddress'])->name('get_buyer_address');
	
	Route::post('/choose-buyer-address',[ProductController::class, 'chooseBuyerAddress'])->name('choose_buyer_address');
	
	//09-12-2023
	Route::post('buynow', [ProductController::class, 'buyNow'])->name('buynow');
	
    Route::get('buynow-success', [ProductController::class, 'buynowSuccess'])->name('buynow_success');
    
    // 14-02-2025
	
    Route::any('update-plateform-fee-status/{id}', [ProductController::class, 'updatePlateformFeeStatus'])->name('update_plateform_fee_status');


	 //product add to cart route 30-11-2023
	
     Route::get('cart', [ProductController::class, 'cart'])->name('cart');
     Route::any('checkout', [ProductController::class, 'checkout'])->name('checkout');
     Route::get('add-to-cart/{id}', [ProductController::class, 'addToCart'])->name('add.to.cart');
     Route::patch('update-cart', [ProductController::class, 'updateCart'])->name('update.cart');
     Route::delete('remove-from-cart', [ProductController::class, 'remove'])->name('remove.from.cart');
  
    //27-12-2024 Start
    Route::any('/cart-return/{product_id}',[CartReturnController::class, 'cartReturn'])->name('cart_return');
    Route::get('returncart', [CartReturnController::class, 'returnCart'])->name('returncart');
    Route::any('return-checkout', [CartReturnController::class, 'rectrnCheckout'])->name('return_checkout');
	Route::post('return_buynow', [CartReturnController::class, 'returnBuyNow'])->name('return_buynow');
	Route::get('return-buynow-success', [CartReturnController::class, 'returnBuynowSuccess'])->name('return_buynow_success');

    Route::get('return-to-cart/{product_id}/{product_qty}', [CartReturnController::class, 'returnToCart'])->name('return.to.cart');
	Route::patch('update-cart', [CartReturnController::class, 'updateReturnCart'])->name('update.cart');
	Route::delete('remove-from-cart', [CartReturnController::class, 'removeCart'])->name('remove.from.cart');
	
    Route::post('update-return-status/{id}',[CartReturnController::class, 'updateReturnStatus'])->name('update_return_status');
    Route::post('update-lr-status/{id}',[CartReturnController::class, 'updateLrStatus'])->name('update_lr_status');
	Route::any('received-product/cart_return_id/{cart_return_id}/product_id/{product_id}',[CartReturnController::class, 'receivedProduct'])->name('received_product');
	//07-02-2025
	Route::any('update-received-quantity-status/cart_return_id/{cart_return_id}/product_id/{product_id}',[CartReturnController::class, 'updateReceivedQuantityStatus'])->name('update_received_quantity_status');
	
	Route::post('add-review/{product_id}',[CartReturnController::class, 'addReview'])->name('add_review');
	Route::any('product-review-list',[CartReturnController::class, 'productReviewList'])->name('product_review_list');
	Route::post('review-rating-status/{id}',[CartReturnController::class, 'reviewRatingStatus'])->name('review_rating_status');

    //27-12-2024 End

	//30-11-2023
	Route::resource('carts', CartController::class);
});

// 03-07-2023 End

//Change Password 18-10-2023

Route::get('change-password',[UserController::class, 'changePassword'])->name('change_password');


Route::post('update-password',[UserController::class, 'updatePassword'])->name('change.password');

 Route::get('/', function () {
    return redirect()->route('login');
}); 


Route::get('contact', function () {

    return redirect()->route('contact');

})->name('index_contact');


Route::any('/contact', [AdminController::class, 'contact'])->name('contact');

Route::post('get-state', [AdminController::class, 'getState'])->name('get_state');

Route::post('get-city', [AdminController::class, 'getCity'])->name('get_city');

Route::post('store-contact', [AdminController::class, 'storeContact'])->name('store_contact');

Route::post('get-state-city', [AdminController::class, 'getStateCity'])->name('get_state_city');

// product route 16-8-2023

//forget password 11-01-24

Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post'); 
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');
