@php
 
use App\Helpers\Helper;

$auth_user  = Auth::user();

@endphp

@extends('admin.layouts.app')
@section('title','Withdraw List')
@section('content')
<div x-data="form">
   <div class="panel">
      <ul class="flex space-x-2 rtl:space-x-reverse">
         <li>
            <a href="{{route('wallets.index')}}" class="text-primary hover:underline">Wallet</a>
         </li>
         <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
            <span>Withdrawal</span>
         </li>
      </ul>
        <a href="{{route('withdraws.index')}}"  class="btn btn-primary" style="margin-left:955px;margin-top: -24px; padding: 1px 16px 1px 16px;">Reset Search</a>

       <a href="#"><button  class="btn btn-info" onclick="mystatusFunction()" style="margin-left:150px;margin-top: -24px;padding: 1px 16px 1px 16px;">Search By</button></a>
	  <br>
      <!-- Flash  Message  start -->
      <center id="alertMessageHide">
         @if ($message = Session::get('success'))
         <font style="color: #f5f5f5;background-color: #011d9d  ;padding: 9px 52px;border-radius: 10px;">{{ $message }}</font>
         @endif
      </center>
      <!-- Flash  Message  End  -->
	  <br>
      <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns" x-data="modal">
          <div class="">
         <form method="GET" action="{{route('withdraws.index')}}">

            <div class="mb-5" id="mystatusDIV" style="display: none;">
                 
               <div class="mb-5 grid grid-cols-1 gap-4 sm:grid-cols-5">
                  <label style="margin-top:50px;">Applied On:</label>
                  <div style="margin-top:35px;">
                  <a href="{{route('withdraws.index',['today_applied_on'=>date('Y-m-d')])}}" class="btn btn-outline-secondary" style="padding-right:40px;padding-left:40px;" >Today</a></div>
                  <div class="" style="margin-top:7px;">
                      
                     <input class="search-input form-input" type="date" name="today_applied_from" value="{{Request::input('today_applied_from')}}" style="margin-top:29px;"/>
                  </div>
                  <div class="" style="margin-top:7px;">
                      
                     <input class="search-input form-input" type="date" name="today_applied_to" value="{{Request::input('today_applied_to')}}" style="margin-top:29px;"/>
                  </div>
                  <div style="margin-top: 36px;">
                     <div class="search-date-group ms-5 d-flex align-items-center">
                         <select class="form-input" name="seller_buyer_data" id="seller_buyer_data" value="{{Request::input('seller_buyer_data')}}">
                           <option value="">Select Seller/Buyer Name</option>
                           @foreach($buyerSellerData as $buyerseller)
                            <option value="{{ $buyerseller->id }}" @if(Request::input('seller_buyer_data')  == $buyerseller->id) selected @endif >{{ ucwords($buyerseller->first_name.' '.$buyerseller->last_name)}}({{ ucwords($buyerseller->for) }})</option>
                           @endforeach
                        </select>
                     </div>
                  </div>
                </div>
            
                  
                
              
               
                 <div>
                     <button type="submit" class="btn btn-outline-success" style="padding-right: 64px;padding-left:64px;margin-left: 451px;" >Submit</button>
                  </div>
                 
                   <hr>
            </div>
        </form>
		
         </div>
         <div class="dataTable-container">
            <table id="myTable1" class="whitespace-nowrap dataTable-table">
               <thead>
                  <tr>
                     <th>S.No</th>
                     <th>Date</th>
                     <th>Withdrawal ID</th>
                     <th>Buyer/Seller Name</th>
                     <th>Amount </th>
                     <th>Payment Mode</th>
                     <th>Account Details </th>
                     <th>Status</th>
					 @if($auth_user->for == 'super_admin')
                     <th>Update Status</th>
				     @endif
                     <th>Recipt</th>
                     <th>Comment</th>
                  </tr>
               </thead>
               <tbody>
			   
                  @php $i=1; @endphp
				  
                  @foreach($withdrawal as $withdra)
				    
					@php
					
					$buyerSellerData= Helper::getBuyerSellerData($withdra->withdrawal_from);
					
					if(!empty($buyerSellerData)){
						
					   $buyerSellerName = $buyerSellerData->first_name.' '.$buyerSellerData->last_name;	
					
					}else{
						 
				        $buyerSellerName =  "";
					}
					
				 @endphp
                  <tr>
                     <td>{{$i++}}</td>
                     <td>{{$withdra->updated_at->format('Y-m-d') }}</td>
                     <td>{{$withdra->payment_withdrawal_id}}</td>
                     <td>{{$buyerSellerName}}</td>
                     <td>{{$withdra->withdrawal_amount}}</td>
                     <td>{{$withdra->withdrawal_payment_type}}</td>
                     <td>
                        <div x-data="modal" class="">
                           <div class="flex items-center ">
                              <a href="#">
                                 <button class="badge bg-secondary inline-flex" href="#" @click="toggle">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill mr-2" viewBox="0 0 16 16">
                                       <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0" />
                                       <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7" />
                                    </svg>
                                    View
                                 </button>
                              </a>
                           </div>
                           <div class="fixed inset-0 bg-[black]/60 z-[999] hidden overflow-y-auto" :class="open && '!block'">
                              <div class="flex items-start justify-center min-h-screen px-4">
                                 <div x-show="open" x-transition x-transition.duration.300 class="panel border-0 p-0 rounded-lg overflow-hidden w-full max-w-lg my-8">
                                    <div class="flex items-center justify-between bg-[#fbfbfb] px-5 py-3 dark:bg-[#121c2c]">
                                       <h5 class="text-lg font-bold">Acount Details</h5>
                                       <button type="button" class="text-white-dark hover:text-dark" @click="toggle">
                                          <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6">
                                             <line x1="18" y1="6" x2="6" y2="18"></line>
                                             <line x1="6" y1="6" x2="18" y2="18"></line>
                                          </svg>
                                       </button>
                                    </div>
                                    <div class="p-5">
                                       <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                          <div>
                                             <label for="Address">
                                             <strong>Account Holder Name:</strong><br>
                                             {{$withdra->acount_holder_name}}
                                             </label>
                                          </div>
                                          <div>
                                             <label for="Contact">
                                             <strong>Bank Name:</strong><br>
                                             {{$withdra->bank_name}}
                                             </label>
                                          </div>
                                          <div>
                                             <label for="Address">
                                             <strong>Bank Account Number:</strong><br>
                                             {{$withdra->bank_account_no}}
                                             </label>
                                          </div>
                                          <div>
                                             <label for="Contact">
                                             <strong>IFSC Code:</strong><br>
                                             {{$withdra->bank_ifsc_code}}
                                             </label>
                                          </div>
                                       </div>
                                       <div class="flex justify-end items-center mt-8">
                                          <button type="button" class="btn btn-outline-danger" @click="toggle">Discard</button>
                                          <!-- <button type="submit" class="btn btn-primary ltr:ml-4 rtl:mr-4" @click="toggle">Save</button> -->
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </td>
                     <td>{{$withdra->withdrawal_status}}</td>
					 
				   @if($auth_user->for == 'super_admin')
                     <td>
                        <a href="#" onclick="updateWithdrawalStatus('{{$withdra->id}}');">
                           <button class="badge bg-success inline-flex" href="#" @click="toggle">
                              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill mr-2" viewBox="0 0 16 16">
                                 <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
                              </svg>
                              Update
                           </button>
                        </a>
                     </td>
				   @endif
				  
                     <td>
                        <a href="{{asset('public/uploads/withdrawal/upload_withdrawal_receipt/'.$withdra->upload_withdrawal_receipt)}}" target="_blank">
                           <button class="badge bg-info inline-flex ">
                              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill mr-2" viewBox="0 0 16 16">
                                 <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0" />
                                 <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7" />
                              </svg>
                              Recipt
                           </button>
                        </a>
                     </td>
                     <td>
                      
                        <a href="{{route('withdraws.show',$withdra->id)}}">
                           <button class="badge bg-primary inline-flex" href="#">
                              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill mr-2" viewBox="0 0 16 16">
                                 <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0" />
                                 <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7" />
                              </svg>
                              View Comments
                           </button>
                        </a>
					
                     </td>
                  </tr>
                  @endforeach
               </tbody>
            </table>
         </div>
		 
		 {{ $withdrawal->links('admin.partials.pagination')}}
         <!-- Update Status-->
         <div class="fixed inset-0 bg-[black]/60 z-[999]  hidden" :class="open && '!block'">
            <div class="flex items-start justify-center min-h-screen px-4" @click.self="open = false">
               <div x-show="open" x-transition x-transition.duration.300 class="panel border-0 p-0 rounded-lg overflow-hidden  w-full max-w-xl my-8" style="margin-top:5px;">
                 
               @if(!empty($withdra))
				 <div class="p-5">
                     <form method="POST" enctype="multipart/form-data" id="update_withdrawal_action">
                        @csrf
                        <div class="dark:text-white-dark/70 text-base font-medium text-[#1f2937]">
                           <div>
                              <div class="flex items-center justify-between bg-[#fbfbfb] px-5 py-3 dark:bg-[#121c2c]">
                                 <h5 class="text-lg font-bold">Update Status</h5>
                                 <button type="button" class="text-white-dark hover:text-dark" @click="toggle">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6">
                                       <line x1="18" y1="6" x2="6" y2="18"></line>
                                       <line x1="6" y1="6" x2="18" y2="18"></line>
                                    </svg>
                                 </button>
                              </div>
                              <label for="withdrawal_status">Payment Type</label>
                              <select class="form-select text-white-dark" id="withdrawal_status" name="withdrawal_status" onchange="getWithdrawData(this);">
                                 <option value="">Payment Type</option>
                                 <option value="Paid">Paid</option>
                                 <option value="Rejected">Rejected</option>
                              </select>
                           </div>
                           <br>
                           <div class="grid grid-cols-1 gap-4 sm:grid-cols-2" id="paidContent" style="display:none">
                              <div>
                                 <label for="withdrawal_date">Date</label>
                                 {!! Form::date('withdrawal_date', null, array('placeholder' => 'Date','class' => 'form-input','id'=>'withdrawal_date','required' => 'required')) !!}
                              </div>
                              <div>
                                 <label for="account_paid_amount">Amount</label>
                                 {!! Form::text('account_paid_amount', null, array('placeholder' => 'Enter Amount','class' => 'form-input','id'=>'account_paid_amount','required' => 'required')) !!}
                              </div>
                              <div>
                                 <label for="withdrawal_receipt_no">Receipt No.</label>
                                 {!! Form::text('withdrawal_receipt_no', null, array('placeholder' => 'Enter Receipt No','class' => 'form-input','id'=>'withdrawal_receipt_no','required' => 'required')) !!}
                              </div>
                              <div>
                                 <label for="upload_withdrawal_receipt">Upload Withdrawal Receipt</label>
                                 {!! Form::file('upload_withdrawal_receipt', null, array('placeholder' => 'Upload Withdrawal Receipt','class' => 'form-input','id'=>'upload_withdrawal_receipt','required' => 'required')) !!}
                              </div>
                           </div>
                           <div>
                              <label for="comment">Comment</label>
                              <textarea id="comment" rows="3" class="form-textarea" placeholder="Enter Comment" style="height: 100px;" name="withdrawal_comment" required></textarea>
                           </div>
                        </div>
                        <div class="flex justify-end items-center mt-8">
                           <button type="button" class="btn btn-outline-danger" @click="toggle">Discard</button>
                           <button type="submit" class="btn btn-primary ltr:ml-4 rtl:mr-4" @click="toggle">Save</button>
                        </div>
                     </form>
                  </div>
				  @endif
				  
               </div>
            </div>
         </div>
         <!-- Update Status-->
      </div>
   </div>
</div>
@endsection
@push('script')
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
<script type="text/javascript"> 
   $(function(){
    $('#alertMessageHide').delay(5000).fadeOut();
   });
</script>
<script>
   function mystatusFunction() {
     var x = document.getElementById("mystatusDIV");
     if (x.style.display === "none") {
       x.style.display = "block";
     } else {
       x.style.display = "none";
     }
   }
</script>
<!-- script -->
<script>
   document.addEventListener("alpine:init", () => {
       Alpine.data("modal", (initialOpenState = false) => ({
           open: initialOpenState,
   
           toggle() {
               this.open = !this.open;
           },
       }));
   });
</script>
<script>
   function getWithdrawData(element){
      
     var paidData = element.value;
     
     if(paidData=='Paid'){
        
        $('#paidContent').show();
     }else{
        $('#paidContent').hide();
     }
   }
</script>

<script>
   function updateWithdrawalStatus(withdrawal_id){
      
     var updateWithdrawalUrl = '{{url("/")}}'+'/add-withdrawal-comment/'+withdrawal_id;
	 
     $('#update_withdrawal_action').attr('action',updateWithdrawalUrl);
   }
</script>
@endpush