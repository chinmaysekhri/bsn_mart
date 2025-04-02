@php 
use App\Helpers\Helper;

@endphp

@extends('admin.layouts.app')
@section('title','Show Prospective Buyer Detail')
@section('content')
<div x-data="form">
   <ul class="flex space-x-2 rtl:space-x-reverse">
      <li>
         <a href="{{ route('prospectivebuyers.index') }}" class="text-primary hover:underline">Prospective Buyer</a>
      </li>
      <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
         <span>Show Details</span>  
      </li>
   </ul>
   <div class="grid grid-cols-1 gap-6 pt-5 lg:grid-cols-1">
      <!-- Grid -->
      <div class="panel">
         <!-- Flash  Message  start -->
         <center id="alertMessageHide">@if ($message = Session::get('success'))
            <font style="color: #f5f5f5;background-color: #011d9d  ;padding: 9px 52px;border-radius: 10px;">{{ $message }}</font>
            @endif
         </center>
         <!-- Flash  Message  End  -->
         <div class="mb-5 flex items-center justify-between">
            <h5 class="text-lg font-semibold dark:text-white-light">Show Prospective Buyer Detail</h5>
         </div>
         <div class="mb-5">
            @if (count($errors) > 0)
            <div class="flex items-center p-3.5 rounded text-danger bg-danger-light dark:bg-danger-dark-light">
               <span class="ltr:pr-2 rtl:pl-2">
                  <strong class="ltr:mr-1 rtl:ml-1">Whoops!</strong>There were some problems with your input.
                  <ul>
                     @foreach ($errors->all() as $error)
                     <li>{{ $error }}</li>
                     @endforeach
                  </ul>
               </span>
               <button type="button" class="ltr:ml-auto rtl:mr-auto hover:opacity-80">
                  <svg> ... </svg>
               </button>
            </div>
            @endif
           <div class="mb-5">
            @if (count($errors) > 0)
            <div class="flex items-center p-3.5 rounded text-danger bg-danger-light dark:bg-danger-dark-light">
               <span class="ltr:pr-2 rtl:pl-2">
                  <strong class="ltr:mr-1 rtl:ml-1">Whoops!</strong>There were some problems with your input.
                  <ul>
                     @foreach ($errors->all() as $error)
                     <li>{{ $error }}</li>
                     @endforeach
                  </ul>
               </span>
               <button type="button" class="ltr:ml-auto rtl:mr-auto hover:opacity-80">
                  <svg> ... </svg>
               </button>
            </div>
            @endif
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div>
                        <label for="Address">
                            <strong>Created By:</strong>
                            @if(!empty($user_emp))
                  {{ $user_emp->first_name .' '. $user_emp->last_name }}
                  @endif
                        </label>
                    </div>
                
                </div>
         
           <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
               <div>
                  <label for="UserID">
                  <strong>Seller Id:</strong>
                     JBNPB000{{ $pros_buyer->id }}
                  </label>
               </div>
                <div>
                  <label for="business_name">
                  <strong>Business Name:</strong>
                 {{ $pros_buyer->business_name }}
                  </label>
               </div>
            </div>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                @php
      
      $cat_data =json_decode($pros_buyer->category_id,true);
      if(empty($cat_data)){
        
         $cat_data=[];
      }
      
      @endphp
                 <div>
                  <label for="Enrollment">
                  <strong>Category:</strong>
                 @if(!empty($pros_buyer->category_id))
                   @foreach($cat_data as $category_id)
                  
          {{ Helper::getcategoryeData($category_id)->category_name}},
          
          @endforeach
          @endif
                  </label>
               </div>
                 <div>
                  <label for="First">
                  <strong> Name:</strong>
                   {{ $pros_buyer->first_name.' '.$pros_buyer->last_name}}
                  </label>
               </div>
            </div>

              <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

                    <div>
                        <label for="Contact"> </label>
                            <strong>Buyer Application Company Name:</strong>
                          {{ $pros_buyer->company_name }}

                      
                    </div>
                    <div>
                        <label for="gridEmail"></label>
                            <strong>Buyer Application Website Name:</strong>
                          {{ $pros_buyer->web_name }}
                      
                    </div>
                </div>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
             
                 <div>
                  <label for="Mobile">
                  <strong>Contact:</strong>
                  {{ $pros_buyer->contact }}
                  </label>
               </div>
             <div>
                  <label for="Gender">
                  <strong>Gender:</strong>
                  {{ $pros_buyer->gender }}
                  </label>
               </div>
            </div>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                
               <div>
                  <label for="Email">
                  <strong>Email:</strong>
                 {{ $pros_buyer->email }}
                  </label>
               </div>
                <div>
                  <label for="Present">
                  <strong>Present Address:</strong>
                 {{ $pros_buyer->present_address }}
                  </label>
               </div>
            </div>
           
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
              
               <div>
                  <label for="pin_code">
                  <strong>Pin Code:</strong>
                  {{ $pros_buyer->pin_code }}
                  </label>
               </div>
                 <div>
                  <label for="city">
                  <strong>City:</strong>
                  {{ $pros_buyer->city }}
                  </label>
               </div>
            </div>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
             
               <div>
                  <label for="State">
                  <strong>State:</strong>
                 {{ $pros_buyer->state }}
                  </label>
               </div>
                 <div>
                  <label for="country">
                  <strong>Cuntry:</strong>
                  {{ $pros_buyer->country }}
                  </label>
               </div>
            </div>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
             
               <div>
                  <label for="status_name">
                  <strong>Status:</strong>
                  {{ $pros_buyer->status_name }}
                  </label>
               </div>
                <div>
                  <label for="date_of_enrollment">
                  <strong>Next Action Date:</strong>
                  {{ $pros_buyer->date_of_enrollment }}
                  </label>
               </div>
            </div>
           <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
               
               <div>
                  <label for="comment">
                  <strong>Comment:</strong>
                  {{ $pros_buyer->comment }}
                  </label>
               </div>
            </div>
         </div>
      </div>
</div>
<div x-data="form" >
   <button onclick="myFunction()" class="badge bg-info" style="padding: 10px 42px 10px 42px;font-size: 17px">Buyer Logs</button>
    <a href="{{ route('prospectivebuyers.edit',array_merge([$pros_buyer->id],$requested_input)) }}"><button class="badge bg-info" style="padding: 10px 42px 10px 42px;font-size: 17px">Edit</button></a>
   
   <!--  <button onclick="myComment()" class="badge bg-success" style="padding: 10px 42px 10px 42px;font-size: 17px">Add Comment</button>-->
   
   <div class="grid grid-cols-1 gap-6 pt-5 lg:grid-cols-1">
      <div class="panel" style="display: none;" id="myDIV">
         <div class="mb-5 flex" style="text-align: center" >
            <h4 class="text-lg font-semibold dark:text-white-light" style="margin-left: 400px;">Buyer Logs History</h4>
         </div>
         <div class="mb-5">
            <div class="dataTable-container">
               <table id="myTable1" class="whitespace-nowrap dataTable-table">
                  <thead>
                     <tr style="background: radial-gradient(#7fd9a7f7, transparent);">
                        <th>S.No</th>
                        <th>User Name</th>
                        <th>Updated Date</th>
                        <th>Buyer Status</th>
                        <th>Enrollment Date</th>
                        <th>Comment</th>
                     </tr>
                  </thead>
                  
                     <tbody>
                     @php
                     $i =0;
                     @endphp
                     @foreach($prospectivebuyer_comments as $comment)
                     <tr>
                        <td>{{++$i}}</td>
                        <td>{{$comment->first_name.' '.$comment->last_name}}</td>
                       <td>{{$comment->updated_at}}</td>
                        <td>{{$comment->status_name}}</td>
                         <td>{{ $comment->date_of_enrollment }}</td>
                         <td>  {{ $comment->comment }}</td>
                     </tr>
                     @endforeach 
                  </tbody>
               </table>
            </div>
         </div>
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
   function myFunction() {
     var x = document.getElementById("myDIV");
     if (x.style.display === "none") {
       x.style.display = "block";
     } else {
       x.style.display = "none";
     }
   }
</script>
@endpush

