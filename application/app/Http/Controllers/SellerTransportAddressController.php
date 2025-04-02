<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Seller;
use App\Models\Employee;
use App\Models\User;
//use App\Models\TransportAddress;
use App\Models\SellerTransportAddress;
use Auth;
use DB;
use Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Arr;
use Illuminate\View\View;
use App\Models\HasApiTokens;
use Illuminate\Http\RedirectResponse;
use Illuminate\Database\Eloquent\Builder;
use Mail;
use App\Mail\RegisterMail;


class SellerTransportAddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
  public function index(Request $request): View
    {
              
 //Date 01-08-2024
 
 $per_page  = 15;
     
         $auth_user = Auth::user();
    
         $is_admin  = $auth_user->for;
   
   /*      if($is_admin == 'super_admin'){
        
        $buyerSellerData   = User::where('for','=','seller')
                         //->orWhere('for','=','buyer')
                           ->orderBy('id','DESC')->get();
          
        }else{
         
         $buyerSellerData  = User::where('for','=','seller')
                                  // ->where('id','=',$auth_user->id)
                                  // ->orderBy('id','DESC')
                                  // ->get();
                                         ->where(function ($query) use ($auth_user){ 
                                           $query->where('created_by','=',$auth_user->id)
                                      ->orWhere('managed_by','=',$auth_user->id)
                                      ->orWhere('id','=',$auth_user->id);
                                      })->orderBy('id','DESC')
                                     
                                      ->get();
            } */
            
        // New Code Update 07-03-2025 
	
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
           
           
            $data_collection = SellerTransportAddress::when($request->q,function (Builder $builder) use ($request) {
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
             ->when($request->today_updated_on,function (Builder $builder) use ($request) {
        if(!empty($request->today_updated_on)){  
              $builder->whereDate('updated_at', 'like', "%{$request->today_updated_on}%");
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
        ->when($request->today_updated_from,function (Builder $builder) use ($request) {
           
       if(!empty($request->today_updated_from)){
              $builder->whereDate('updated_at', '>=', $request->today_updated_from)
                      ->whereDate('updated_at', '<=', $request->today_updated_to);
           }
                 }
              )
       
          ->when($request->seller_buyer_data,function (Builder $builder) use ($request) {
          // dd($request->seller_buyer_data,$request->all());
           if(!empty($request->seller_buyer_data)){
                      $builder->where('seller_id', '=', $request->seller_buyer_data);
                              // ->orWhere('managed_by', '=', $request->team_member_data);
                    }
                 }
              )
        
         
         // ->orderBy('id','DESC')->paginate($per_page);
          ->orderBy('id','DESC');
      
    
     // dd($data,$is_admin);
      if($is_admin == 'super_admin'){
          
          
            $data = $data_collection->paginate($per_page)->appends($request->query());
              
            }else{
                
           if($is_admin == 'seller'){ 
               
             $data = $data_collection->where('seller_id','=',$auth_user->id)->paginate($per_page)->appends($request->query());
           
               
           }else{
               
          $user_ids = User::where('created_by','=',$auth_user->id)->orWhere('managed_by','=',$auth_user->id)->pluck('id')->toArray();
                      
             array_push($user_ids,$auth_user->id);
            
             $user_ids2 = User::whereIn('created_by',$user_ids)->orWhereIn('managed_by',$user_ids)->pluck('id')->toArray();
                   
             array_push($user_ids2,$auth_user->id);
                        
             $data = $data_collection->whereIn('created_by',$user_ids2)->paginate($per_page)->appends($request->query()); 
               
               
           }
           //Customer::whereIntegerInRaw('id', $array)->get();
            
  
            }
     
      
        $requested_input = $request->all();
     
        return view('sellertransportaddresses.index',compact('requested_input','buyerSellerData','data'))
            ->with('i', ($request->input('page', 1) - 1) * $per_page);  
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        //$auth_user     = Auth::user();
        //$is_admin   = $auth_user->for;
           
       /* if(!empty($auth_user->seller_id)){
                
            $sellerData1  = Seller::find($auth_user->seller_id);
            
            $sellerData   = Seller::where('id','=',$sellerData1->id)->get();
            
            }else{
                
                $sellerData  = Seller::get();
                
            } */
            
        
        $auth_user     = Auth::user();
        $is_admin   = $auth_user->for;
         
     /*     if($is_admin == 'super_admin'){
                
              $sellerData   = User::where('for','=','seller')->get();
                    
                }else{
                    
               $sellerData  = User::where('for','=','seller')
               
                                ->where(function ($query) use ($auth_user){ 
                                           $query->where('created_by','=',$auth_user->id)
                                            ->orWhere('managed_by','=',$auth_user->id)
                                            ->orWhere('id','=',$auth_user->id);
                                      })     
                                    ->get();  
                                    //dd($sellerData);             
            }*/
            
    // New Code Update 07-03-2025 
		
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
            
        
        return view('sellertransportaddresses.create',compact('sellerData'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
             $input = $request->all();
             $auth_user=Auth::user();
        
             $input['created_by'] = $auth_user->id;
        //lr_copy_upload//
/*          if($request->hasfile('lr_copy_upload')){
            
            $fileName_lr_copy_upload = time().'.'.$request->lr_copy_upload->extension();  

            $request->lr_copy_upload->move(public_path('uploads/seller_transport_address/lr_copy_upload'), $fileName_lr_copy_upload);
            
            $input['lr_copy_upload'] = $fileName_lr_copy_upload;
            
        }else{
            unset($input['lr_copy_upload']);          
        } */

       //lr_copy_upload//
         if($request->hasfile('lr_copy_upload')){
            
            $fileName_lr_copy_upload = time().'.'.$request->lr_copy_upload->extension();  

            $request->lr_copy_upload->move(public_path('uploads/transport_address/lr_copy_upload'), $fileName_lr_copy_upload);
            
            $input['lr_copy_upload'] = $fileName_lr_copy_upload;
            
        }else{
            unset($input['lr_copy_upload']);          
        }


        //dd($input);
             $seller_transport_address = SellerTransportAddress::create($input);
             return redirect()->route('sellertransportaddresses.index')->with('success','Seller Transport Address created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $seller_transport_address = SellerTransportAddress::find($id);
        //dd($seller_transport_address);
        $seller_transp_address    = SellerTransportAddress::select('seller_transport_addresses.*', 'sellers.first_name as FirstName','sellers.last_name as LastName')
                            ->leftjoin('sellers', 'sellers.id', 'seller_transport_addresses.seller_id')
                            ->where('seller_transport_addresses.id','=',$seller_transport_address->id)->first();
                            //dd($seller_transp_address);
         return view('sellertransportaddresses.show',compact('seller_transport_address','seller_transp_address'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $auth_user     = Auth::user();
        
        $is_admin      = $auth_user->for;
         
        $employeeData  = Employee::where('created_by','=',$auth_user->id)->get();
        
        $seller_transport_address = SellerTransportAddress::find($id);
        //date18-05-2024
        
       /* if(!empty($auth_user->seller_id)){
                
            $sellerData1  = Seller::find($auth_user->seller_id);
            
            $sellerData   = Seller::where('id','=',$sellerData1->id)->get();
            
            }else{
                
             $sellerData  = Seller::orderBy('id', 'DESC')->get();
            } */
            
        //date18-05-2024
        
        //$sellerData= Seller::orderBy('first_name', 'DESC')->get();
        
        //Date19-06-2024
    /*     if($is_admin == 'super_admin'){
                
              $sellerData   = User::where('for','=','seller')->get();
                    
                }else{
                    
               $sellerData  = User::where('for','=','seller')
               
                                ->where(function ($query) use ($auth_user){ 
                                           $query->where('created_by','=',$auth_user->id)
                                            ->orWhere('managed_by','=',$auth_user->id)
                                            ->orWhere('id','=',$auth_user->id);
                                      })     
                                    ->get();               
            }*/
    
    // New Code Update 07-03-2025 
	
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
    
       // 11-03-2025 for hold value after search data hold 
		
        $request         = request();
		
        $requested_input = $request->all();
		
	   // 11-03-2025 for hold value after search data hold
	   
        return view('sellertransportaddresses.edit', compact('seller_transport_address','sellerData','employeeData','requested_input'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
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
        
         $input['created_by'] = $auth_user->id;
        /*  
         if($request->hasfile('lr_copy_upload')){
            
            $fileName_lr_copy_upload = time().'.'.$request->lr_copy_upload->extension();  

            $request->lr_copy_upload->move(public_path('uploads/seller_transport_address/lr_copy_upload'), $fileName_lr_copy_upload);
            
            $input['lr_copy_upload'] = $fileName_lr_copy_upload;
                            
        }else{
            unset($input['lr_copy_upload']);          
        } */


         //lr_copy_upload//
         if($request->hasfile('lr_copy_upload')){
            
            $fileName_lr_copy_upload = time().'.'.$request->lr_copy_upload->extension();  

            $request->lr_copy_upload->move(public_path('uploads/transport_address/lr_copy_upload'), $fileName_lr_copy_upload);
            
            $input['lr_copy_upload'] = $fileName_lr_copy_upload;
            
        }else{
            unset($input['lr_copy_upload']);          
        }

 
         $trans_address = SellerTransportAddress::find($id);
         $trans_address->update($input);
         return redirect()->route('sellertransportaddresses.index',$requested_input)->with('success','Seller Transport Address updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        SellerTransportAddress::find($id)->delete();
        return redirect()->route('sellertransportaddresses.index')->with('success','Seller Transport Address deleted successfully');
    }




    

}
