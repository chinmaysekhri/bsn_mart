@extends('admin.layouts.app')
@section('title','Return Order List')
@section('content')

<div x-data="form">
   <div class="panel">
      <!-- Flash  Message  start -->
      <center id="alertMessageHide">@if ($message = Session::get('success'))
         <font style="color: #f5f5f5;background-color: #011d9d  ;padding: 9px 52px;border-radius: 10px;">{{ $message }}</font>
         @endif
      </center>
      <!-- Flash  Message  End  -->
      <h5 class="mb-5 text-lg font-semibold dark:text-white-light md:absolute md:top-[25px] md:mb-0">              
         <a class="badge bg-success" href="#">Return Orders</a>
          <a href=""  class="btn btn-primary" style="margin-left: 775px;margin-top: -24px; padding: 1px 16px 1px 16px;">Reset Search</a>

       <a href="#"><button  class="btn btn-info" onclick="mystatusFunction()" style="margin-left:111px;margin-top: -24px;padding: 1px 16px 1px 16px;">Search By</button></a>
      </h5>
    
      <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
         <br>
          <form method="GET" action

            <div class="mb-5" id="mystatusDIV" style="display: none;">
                 
               <div class="mb-5 grid grid-cols-1 gap-4 sm:grid-cols-5">
                  <label style="margin-top:50px;">Applied On:</label>
                  <div style="margin-top:35px;">
                  <a href="" class="btn btn-outline-secondary" style="padding-right:40px;padding-left:40px;" >Today</a></div>
                  <div class="" style="margin-top:7px;">
                      
                     <input class="search-input form-input" type="date" name="today_applied_from" value="" style="margin-top:29px;"/>
                  </div>
                  <div class="" style="margin-top:7px;">
                      
                     <input class="search-input form-input" type="date" name="today_applied_to" value="" style="margin-top:29px;"/>
                  </div>
                  <div style="margin-top: 36px;">
                     <div class="search-date-group ms-5 d-flex align-items-center">
                        <select class="form-input" name="seller_buyer_data" id="seller_buyer_data" value="">
                           <option value="">Select Buyer/Seller</option>
                           <option value="">Divyansh Sales</option>
                           <option value="">Vijay Banshal</option>
                         
                        </select>
                     </div>
                  </div>
                </div>
            
                   <div class="mb-5 grid grid-cols-1 gap-4 sm:grid-cols-3">
                
                <div>
                     <div class="search-date-group ms-5 d-flex align-items-center">
                        <select class="form-input" name="today_applied_status" id="order_status">
                           <option value="">Select Seller Status</option>
                           <option value="">Return Done</option>
                           <option value="">Pending</option>
                           
                           
                        </select>
                     </div>
                  </div>
               
                 <div>
                     <button type="submit" class="btn btn-outline-success" style="padding-right: 64px;padding-left:64px;" >Submit</button>
                  </div>
                   </div>
                 
            </div>

         </form>
         <div class="dataTable-container">
            <table id="myTable1" class="whitespace-nowrap dataTable-table" style="margin-top:60px;">
               <thead>
                  <tr>
                     <th>S.No</th>
                     <th>Date</th>
                     <th>Order ID</th>
                     <th>Party Name</th>
                     <th>Amount</th>
                     <th>Status</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody>
                
                  <tr>
                     <td>1</td>
                     <td>11-11-2024</td>
                     <td>RID0001</td>
                     <td>Rajesh kumar</td>
                     <td>2006</td>
                   
                     <td class="btn btn-outline-danger" style="margin-top: 15px;">Received</td>
                     
                    
                     <td>
                        <a class="badge bg-info" href="#">View</a>
                        <a class="badge bg-primary" href="#">Edit</a>
                     </td>
                  </tr>
				  <tr>
                     <td>2</td>
                     <td>11-11-2024</td>
                     <td>RID0002</td>
                     <td>Ranjeet Singh</td>
                     <td>2006</td>
                   
                     <td class="btn btn-outline-danger" style="margin-top: 15px;">Pending</td>
                     
                    
                     <td>
                        <a class="badge bg-info" href="#">View</a>
                        <a class="badge bg-primary" href="#">Edit</a>
                     </td>
                  </tr>
                
               </tbody>
            </table>
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
   function confirmDelete( varForm ) {
           var r = confirm("Are you sure you wish to delete this entry?");
   
           if (r == true) {
               document.getElementById("form" + varForm).submit();
           }
       }
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
@endpush