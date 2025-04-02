@extends('admin.layouts.app')
@section('title','Customer Lead List')
@section('content')
<!--<div x-data="multipleTable">-->
<div x-data="form">
   <div class="panel">
   
      <!-- Flash  Message  start -->
      <center id="alertMessageHide">@if ($message = Session::get('success'))
         <font style="color: #f5f5f5;background-color: #011d9d  ;padding: 9px 52px;border-radius: 10px;">{{ $message }}</font>
         @endif
      </center>
      <!-- Flash  Message  End  -->
	  
      <h5 class="mb-5 text-lg font-semibold dark:text-white-light md:absol
         ute md:top-[25px] md:mb-0">
        <a class="badge bg-success" href="{{route('customers.create')}}">Create New Customer</a>
         <!-- <button onclick="myFunction()" class="badge bg-info">Applied On</button> -->
         <div class="dropdown">
            <button  class="badge bg-info">Search By</button>
            <div class="dropdown-content" style="font-size: 15px">
               <a href="#"onclick="myfollowFunction()">Follow Up date</a>
               <a href="#"onclick="mystatusFunction()">Follow Up Status</a>
               <a href="#"onclick="mycommentFunction()">Comment On</a>
               <a href="#" onclick="myteamFunction()">By Team Member</a>
               <a href="#" onclick="myFunction()">Applied On</a>
            </div>
         </div>
      </h5>
   
      <!-- search Bar  -->
      <form method="" action="">
         <div class="mb-5" id="myDIV" style="display: none;">
            <div class="flex flex-wrap items-center justify-center gap-2" style="margin-top:49px;margin-left: 99px;">
               <button type="text" class="btn" style="margin-bottom: 5px;">Today</button>
               <div class="search-date-group ms-5 d-flex align-items-center " style="display: contents;">
                  <label class="btn" for="" style="font-size:18px;"> from:</label>
                  <input class="btn" type="date" name="" id="" class="form-input"
                     style="width:15%;">
               </div>
               <div class="search-date-group ms-5 d-flex align-items-center" style="display: contents;">
                  <label class="btn" for="" style="font-size:18px;"> To:</label>
                  <input class="btn" type="date" name="" id="" class="form-input" style="width:15%;">
               </div>
               <div class="search-wrapper ms-5 d-flex align-items-center" style="margin-top: 20px;">
                  <input class="btn" type="text" class="search-input form-input" placeholder="search" style="padding: 8px 8px 8px 8px;">
                  <button class="search-button"><i class="ri-search-line"></i></button>
               </div>
            </div>
         </div>
      </form>
      <!-- Search Bar End -->
      <!-- Search Bar comment  -->
      <form method="" action="" style="margin-top: -59px;">
         <div class="mb-5" id="mycommentDIV" style="display: none;">
            <div class="flex flex-wrap items-center justify-center gap-2" style="margin-top:49px;margin-left: 99px;">
               <div class="search-date-group ms-5 d-flex align-items-center" style="display: contents;">
                  <label class="btn" for="">Today</label>
               </div>
               <div class="search-date-group ms-5 d-flex align-items-center " style="display: contents;">
                  <label class="btn" for="" style="font-size:18px;"> from:</label>
                  <input class="btn" type="date" name="" id="" class="form-input"
                     style="width:15%;">
               </div>
               <div class="search-date-group ms-5 d-flex align-items-center" style="display: contents;">
                  <label class="btn" for="" style="font-size:18px;"> To:</label>
                  <input class="btn" type="date" name="" id="" class="form-input" style="width:15%;">
               </div>
               <div class="search-wrapper ms-5 d-flex align-items-center" style="margin-top: 20px;">
                  <input class="btn" type="text" class="search-input form-input" placeholder="search" >
                  <button class="search-button"><i class="ri-search-line"></i></button>
               </div>
            </div>
         </div>
      </form>
      <!-- Search Bar comment End -->
      <!-- Search Bar status  -->
      <form method="" action="" style="margin-top: -59px;">
         <div class="mb-5" id="mystatusDIV" style="display: none;">
            <div class="flex flex-wrap items-center justify-center gap-2" style="margin-top:49px;margin-left: 99px;">
               <div class="search-date-group ms-5 d-flex align-items-center" style="display: contents;">
                  <label class="btn" for="">Status</label>
                  <select class="btn" class="form-select text-white-dark"  id="Status" value="0" name="status" style="width: 170px;">
                     <option value="" >Status</option>
                     <option value="0">Active</option>
                     <option value="1">Deactive</option>
                  </select>
               </div>
               <div class="search-wrapper ms-5 d-flex align-items-center" style="margin-top: 20px;">
                  <input class="btn" type="text" class="search-input form-input" placeholder="search" >
                  <button class="search-button"><i class="ri-search-line"></i></button>
               </div>
            </div>
         </div>
      </form>
      <!-- Search Bar status End -->
      <!-- Search Bar role Type End -->
      <form method="" action="" style="margin-top: -59px;">
         <div class="mb-5" id="myteamDIV" style="display: none;">
            <div class="flex flex-wrap items-center justify-center gap-2" style="margin-top:49px;margin-left: 99px;">
               <div class="search-date-group ms-5 d-flex align-items-center" style="display: contents;">
                  <label class="btn" for="">Team Member</label>
                  <select class="btn" class="form-select text-white-dark"  id="Status" value="0" name="status" style="width: 170px;">
                     <option value="" >Team Member</option>
                     <option value="0">karishma</option>
                     <option value="1">rajesh</option>
                     <option value="1">arnab</option>
                     <option value="1">ajay</option>
                  </select>
               </div>
               <div class="search-wrapper ms-5 d-flex align-items-center" style="margin-top: 20px;">
                  <input class="btn" type="text" class="search-input form-input" placeholder="search" >
                  <button class="search-button"><i class="ri-search-line"></i></button>
               </div>
            </div>
         </div>
      </form>
      <!-- Search Bar role type End -->
      <!-- Search Bar comment  -->
      <form method="" action="" style="margin-top: -59px;">
         <div class="mb-5" id="myfollowDIV" style="display: none;">
            <div class="flex flex-wrap items-center justify-center gap-2" style="margin-top:49px;margin-left: 99px;">
               <div class="search-date-group ms-5 d-flex align-items-center" style="display: contents;">
                  <label class="btn" for="">Today</label>
               </div>
               <div class="search-date-group ms-5 d-flex align-items-center " style="display: contents;">
                  <label class="btn" for="" style="font-size:18px;"> from:</label>
                  <input class="btn" type="date" name="" id="" class="form-input"
                     style="width:15%;">
               </div>
               <div class="search-date-group ms-5 d-flex align-items-center" style="display: contents;">
                  <label class="btn" for="" style="font-size:18px;"> To:</label>
                  <input class="btn" type="date" name="" id="" class="form-input" style="width:15%;">
               </div>
               <div class="search-wrapper ms-5 d-flex align-items-center" style="margin-top: 20px;">
                  <input class="btn" type="text" class="search-input form-input" placeholder="search" >
                  <button class="search-button"><i class="ri-search-line"></i></button>
               </div>
            </div>
         </div>
      </form>
      <!-- Search Bar comment End -->
	  
      <!-- search Bar follow -->
      <form method="" action="">
         <div class="mb-5" id="myfollowDIV" style="display: none;">
            <div class="flex flex-wrap items-center justify-center gap-2" style="margin-top:49px;margin-left: 99px;">
               <button type="text" class="btn" style="margin-bottom: 5px;">Today</button>
               <div class="search-date-group ms-5 d-flex align-items-center " style="display: contents;">
                  <label class="btn" for="" style="font-size:18px;"> from:</label>
                  <input class="btn" type="date" name="" id="" class="form-input"
                     style="width:15%;">
               </div>
               <div class="search-date-group ms-5 d-flex align-items-center" style="display: contents;">
                  <label class="btn" for="" style="font-size:18px;"> To:</label>
                  <input class="btn" type="date" name="" id="" class="form-input" style="width:15%;">
               </div>
               <div class="search-wrapper ms-5 d-flex align-items-center" style="margin-top: 20px;">
                  <input class="btn" type="text" class="search-input form-input" placeholder="search" style="padding: 8px 8px 8px 8px;">
                  <button class="search-button"><i class="ri-search-line"></i></button>
               </div>
            </div>
         </div>
      </form>
      <!-- Search Bar follow End -->
      <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
         <div class="dataTable-top">
         </div>
         <div class="dataTable-container" style="margin-top: 80px;">
            <table id="myTable1" class="whitespace-nowrap dataTable-table" style="margin-top:48px">
               <thead>
                  <tr>
                     <th scope="col" >
                        <div class="form-check">
                           <input  type="checkbox" onclick="checkBoxHandle();" id="all-checkbox-handle" >
                        </div>
                     </th>
                    
                     <th>S.No</th>
                     <th>Customer ID</th>
                     <th>Name</th>
                     <th>Email</th>
                     <th>Contact</th>
                     <th>Download Payment Receipt</th>
                     <th width="280px">Action</th>
                  </tr>
               </thead>
               <tbody>

	            @foreach ($data as $key => $customer)
                  <tr>
                     <td scope="row">
                        <div class="form-check">
                           <input  type="checkbox"  name="checkbox" >
                        </div>
                     </td>
                        <td>{{ ++$i }}</td>
                        <td><a href="{{ route('customers.show',$customer->id) }}" class="text-primary underline font-semibold hover:no-underline">FAC00{{ $customer->id }}</a></td>
                        
						<td>{{ $customer->first_name ." ".$customer->last_name}}</td>
						<td>{{ $customer->email }}</td>
						<td>{{ $customer->mobile }}</td>
                    
                     <td>
                        <a href="{{asset('public/uploads/customer/payment_receipt/'.$customer->payment_receipt)}}" download="{{$customer->payment_receipt}}">
                           <button type="button" class="btn btn-success gap-2" style="padding: 1px 20px 1px 20px;">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5">
                                    <path
                                        opacity="0.5"
                                        d="M17 9.00195C19.175 9.01406 20.3529 9.11051 21.1213 9.8789C22 10.7576 22 12.1718 22 15.0002V16.0002C22 18.8286 22 20.2429 21.1213 21.1215C20.2426 22.0002 18.8284 22.0002 16 22.0002H8C5.17157 22.0002 3.75736 22.0002 2.87868 21.1215C2 20.2429 2 18.8286 2 16.0002L2 15.0002C2 12.1718 2 10.7576 2.87868 9.87889C3.64706 9.11051 4.82497 9.01406 7 9.00195"
                                        stroke="currentColor"
                                        stroke-width="1.5"
                                        stroke-linecap="round"
                                    ></path>
                                    <path
                                        d="M12 2L12 15M12 15L9 11.5M12 15L15 11.5"
                                        stroke="currentColor"
                                        stroke-width="1.5"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                    ></path>
                                </svg>
                                Download
                            </button></a>
                         </td>
                   
                     <td class="flex gap-4 items-center">
                     @can('customer-edit')
                        <a href="{{ route('customers.edit',$customer->id) }}" class="hover:text-info">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5">
                           <path
                              opacity="0.5"
                              d="M22 10.5V12C22 16.714 22 19.0711 20.5355 20.5355C19.0711 22 16.714 22 12 22C7.28595 22 4.92893 22 3.46447 20.5355C2 19.0711 2 16.714 2 12C2 7.28595 2 4.92893 3.46447 3.46447C4.92893 2 7.28595 2 12 2H13.5"
                              stroke="currentColor"
                              stroke-width="1.5"
                              stroke-linecap="round"
                              ></path>
                           <path
                              d="M17.3009 2.80624L16.652 3.45506L10.6872 9.41993C10.2832 9.82394 10.0812 10.0259 9.90743 10.2487C9.70249 10.5114 9.52679 10.7957 9.38344 11.0965C9.26191 11.3515 9.17157 11.6225 8.99089 12.1646L8.41242 13.9L8.03811 15.0229C7.9492 15.2897 8.01862 15.5837 8.21744 15.7826C8.41626 15.9814 8.71035 16.0508 8.97709 15.9619L10.1 15.5876L11.8354 15.0091C12.3775 14.8284 12.6485 14.7381 12.9035 14.6166C13.2043 14.4732 13.4886 14.2975 13.7513 14.0926C13.9741 13.9188 14.1761 13.7168 14.5801 13.3128L20.5449 7.34795L21.1938 6.69914C22.2687 5.62415 22.2687 3.88124 21.1938 2.80624C20.1188 1.73125 18.3759 1.73125 17.3009 2.80624Z"
                              stroke="currentColor"
                              stroke-width="1.5"
                              ></path>
                           <path
                              opacity="0.5"
                              d="M16.6522 3.45508C16.6522 3.45508 16.7333 4.83381 17.9499 6.05034C19.1664 7.26687 20.5451 7.34797 20.5451 7.34797M10.1002 15.5876L8.4126 13.9"
                              stroke="currentColor"
                              stroke-width="1.5"
                              ></path>
                        </svg>
                     </a>

                     @endcan

                    

                        <a href="{{ route('customers.show',$customer->id) }}" class="hover:text-primary">
                           <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5">
                              <path
                                 opacity="0.5"
                                 d="M3.27489 15.2957C2.42496 14.1915 2 13.6394 2 12C2 10.3606 2.42496 9.80853 3.27489 8.70433C4.97196 6.49956 7.81811 4 12 4C16.1819 4 19.028 6.49956 20.7251 8.70433C21.575 9.80853 22 10.3606 22 12C22 13.6394 21.575 14.1915 20.7251 15.2957C19.028 17.5004 16.1819 20 12 20C7.81811 20 4.97196 17.5004 3.27489 15.2957Z"
                                 stroke="currentColor"
                                 stroke-width="1.5"
                                 ></path>
                              <path d="M15 12C15 13.6569 13.6569 15 12 15C10.3431 15 9 13.6569 9 12C9 10.3431 10.3431 9 12 9C13.6569 9 15 10.3431 15 12Z" stroke="currentColor" stroke-width="1.5"></path>
                           </svg>
                        </a>
                    
						
                        
                
                {!! Form::open(['method' => 'DELETE','route' => ['customers.destroy', $customer->id],'style'=>'display:inline', 'id'=>"form".$customer->id]) !!}
                        
                     <button type="button" class="hover:text-danger" onclick="confirmDelete({{$customer->id}})">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5">
                           <path d="M20.5001 6H3.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                           <path
                              d="M18.8334 8.5L18.3735 15.3991C18.1965 18.054 18.108 19.3815 17.243 20.1907C16.378 21 15.0476 21 12.3868 21H11.6134C8.9526 21 7.6222 21 6.75719 20.1907C5.89218 19.3815 5.80368 18.054 5.62669 15.3991L5.16675 8.5"
                              stroke="currentColor"
                              stroke-width="1.5"
                              stroke-linecap="round"
                              ></path>
                           <path opacity="0.5" d="M9.5 11L10 16" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                           <path opacity="0.5" d="M14.5 11L14 16" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                           <path
                              opacity="0.5"
                              d="M6.5 6C6.55588 6 6.58382 6 6.60915 5.99936C7.43259 5.97849 8.15902 5.45491 8.43922 4.68032C8.44784 4.65649 8.45667 4.62999 8.47434 4.57697L8.57143 4.28571C8.65431 4.03708 8.69575 3.91276 8.75071 3.8072C8.97001 3.38607 9.37574 3.09364 9.84461 3.01877C9.96213 3 10.0932 3 10.3553 3H13.6447C13.9068 3 14.0379 3 14.1554 3.01877C14.6243 3.09364 15.03 3.38607 15.2493 3.8072C15.3043 3.91276 15.3457 4.03708 15.4286 4.28571L15.5257 4.57697C15.5433 4.62992 15.5522 4.65651 15.5608 4.68032C15.841 5.45491 16.5674 5.97849 17.3909 5.99936C17.4162 6 17.4441 6 17.5 6"
                              stroke="currentColor"
                              stroke-width="1.5"
                              ></path>
                        </svg>
                     </button>
                
                {!! Form::close() !!}
             
                       
                     </td>
                  </tr>
                 @endforeach
               </tbody>
            </table>
         </div>
        {{ $data->links('admin.partials.pagination')}}
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
<!--Applid On Button hidden and show Script  -->
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
<!--Applid On  button hidden and show Script End  -->

<!-- checkbox script  -->
<script>
   function checkBoxHandle (){
       var allcheckbox = document.getElementById("all-checkbox-handle");
       if(allcheckbox.checked == true){
       var mycheckbox = document.getElementsByName("checkbox");
   
           for( var i = 0; i< mycheckbox.length; i++){
               mycheckbox[i].checked=true;
           }
       }
       else{
       var mycheckbox = document.getElementsByName("checkbox");
   
           for( var i = 0; i< mycheckbox.length; i++){
               mycheckbox[i].checked=false;
           }
       }
   
   }
   
</script>
<!-- Checkbox Script End  -->
<script>
   function confirmDelete( varForm ) {
      var r = confirm("Are you sure you want to delete!");
   
      if (r == true) {
        document.getElementById("form" + varForm).submit();
      }
    }
    
   <!--Datatable Ckeckbox  Script Start-->
   
   const mainbox = document.querySelector('.mainbox');
   const inputs = document.querySelectorAll('.custom-input');
   
   const update = () => inputs.forEach((input) => input.checked = mainbox.checked);
   
   mainbox.addEventListener('input',update,false);
   
   <!--Datatable Ckeckbox  Script End -->
   
   
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
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
<!-- Search Bar comment  -->
<script>
   function mycommentFunction() {
     var x = document.getElementById("mycommentDIV");
     if (x.style.display === "none") {
       x.style.display = "block";
     } else {
       x.style.display = "none";
     }
   }
</script>
<!-- Search Bar comment End -->
<!-- Search Bar team  -->
<script>
   function myteamFunction() {
     var x = document.getElementById("myteamDIV");
     if (x.style.display === "none") {
       x.style.display = "block";
     } else {
       x.style.display = "none";
     }
   }
</script>
<!-- Search Bar team End -->
<!-- Search Bar follow  -->
<script>
   function myfollowFunction() {
     var x = document.getElementById("myfollowDIV");
     if (x.style.display === "none") {
       x.style.display = "block";
     } else {
       x.style.display = "none";
     }
   }
</script>
<!-- Search Bar follow End -->

<!-- Search Bar status  -->
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
<!-- Search Bar status End -->
<style>
   .dropbtn {
   background-color: #4CAF50;
   color: white;
   font-size: 16px;
   border: none;
   cursor: pointer;
   }
   .dropdown {
   position: relative;
   display: inline-block;
   }
   .dropdown-content {
   display: none;
   position: absolute;
   background-color: #f9f9f9;
   min-width: 160px;
   box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
   z-index: 1;
   }
   .dropdown-content a {
   color: black;
   padding: 6px;
   text-decoration: none;
   display: block;
   }
   .dropdown-content a:hover {background-color: #f1f1f1}
   .dropdown:hover .dropdown-content {
   display: block;
   }
   .dropdown:hover .dropbtn {
   background-color: #3e8e41;
   }
</style>
@endpush