@extends('admin.layouts.app')
@section('title','Show Task')
@section('content')
<div x-data="form">
   <ul class="flex space-x-2 rtl:space-x-reverse">
      <li>
         <a href="{{route('tasks.index')}}" class="text-primary hover:underline">Task</a>
      </li>
      <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
         <span> Task Detail</span>
      </li>
   </ul>
</div>
<div class="grid grid-cols-1 gap-6 pt-5 lg:grid-cols-1" >
   <!-- Grid -->
   <div class="panel" style="border-style: ridge;" >
      <div class="mb-5 flex items-center justify-between" >
         <h5 class="text-lg font-semibold dark:text-white-light text-align:center" >Task Detail</h5>
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
         <div class="grid grid-cols-1 gap-4 sm:grid-cols-2" >
           
            <div>
               <label for="taskDetail">
               <strong>Task Create Date:</strong>
                {{$task->created_at}}
               </label>
            </div> 
		   <div>
               <label for="taskAssignto">
               <strong>Task Assign To:</strong>
			   {{$task->empFirstName.' '.$task->empLastName}}
               </label>
            </div>
             <div>
               <label for="taskAssignby">
               <strong>Task Assign By:</strong>
			    {{$task->firstName.''.$task->lastaName}}
               <?php //{{Auth::user()->first_name.' '.Auth::user()->last_name }} ?>
               </label>
            </div>
			
			<div>
               <label for="taskTiile">
               <strong>Task Titile:</strong>
               {{$task->task_title}}
               </label>
            </div>
            <div>
               <label for="taskDetail">
               <strong>Task Detail:</strong>
                {{$task->task_detail}}
               </label>
            </div> 
			
			<div>
               <label for="taskDetail">
               <strong>Task Comment:</strong>
                {{$task->task_comment}}
               </label>
            </div>
			
			<div>
               <label for="taskDetail">
               <strong>Task Clode Date:</strong>
                {{$task->task_close_date}}
               </label>
            </div>
			<div>
			  <label for="Status">
				 <strong>Status:</strong>
				 @if($task->status==1)
					 <span class="text-success">Close</<span>
					 @else 
					 <span class="text-danger">Pending</span>
				 @endif
				 
			  </label>
             </div>
         </div>
      </div>
   </div>
</div>
<br>
<!--Task Comment start  -->  
<!-- Product Logs -->

<div x-data="form" >
   <button onclick="myFunction()" class="badge bg-info" style="padding: 10px 42px 10px 42px;font-size: 17px">Task Logs</button>
   
   <!--  <button onclick="myComment()" class="badge bg-success" style="padding: 10px 42px 10px 42px;font-size: 17px">Add Comment</button>-->
   
   <div class="grid grid-cols-1 gap-6 pt-5 lg:grid-cols-1">
      <div class="panel" onclick="mymanagelead()" style="display: none;" id="myDIV">
         <div class="mb-5 flex" style="text-align: center" >
            <h4 class="text-lg font-semibold dark:text-white-light" style="margin-left: 400px;">Task Logs History</h4>
         </div>
         <div class="mb-5">
            <div class="dataTable-container">
               <table id="myTable1" class="whitespace-nowrap dataTable-table">
                  <thead>
                     <tr style="background: radial-gradient(#7fd9a7f7, transparent);">
                        <th>S.No</th>
                        <th>Task Submit Date</th>
                        <th>Task Comment</th>
                        <th>Task Status</th>
                        <th>Task Update By</th>
                     </tr>
                  </thead>
                  
                     <tbody>
                     @php
                     $i =0;
                     @endphp
                     @foreach($taskCommentData as $comment)
                     <tr>
                        <td>{{++$i}}</td>
                        <td>{{$comment->created_at}}</td>
                        <td>{{$comment->comment}}</td>
                      
					    @if($comment->status==1)
					    <td><button type="button" class="btn btn-outline-success">Close</button></td> 
						@else
						<td><button type="button" class="btn btn-outline-danger">Pending</button></td> 
						@endif
						
						<td>{{$comment->first_name.' '.$comment->last_name}}</td>
                     </tr>
                     @endforeach 
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
</div>

<!--Applid On Button hidden and show Script  -->

<!--<div class="grid grid-cols-1 gap-4 sm:grid-cols-1"> 

<div class="panel" style="display: none;" id="myCommentDIV">

 <form action="{{route('add_task_comment', $task->id)}}" method="POST">
 @csrf
     <div>
      <label for="Comment">Task Comment</label>
      
      {!! Form::text('comment', null , array('placeholder' => 'Enter Task Comment','class' => 'form-input','id'=>'Comment')) !!}
     </div>
   
    <div>
      <button type="submit" class="btn btn-primary !mt-6">Submit Comment</button>
    </div>
</form>
</div>   
</div>-->

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

<script>

function myComment() {
  var x = document.getElementById("myCommentDIV");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}
</script>

<!--Applid On  button hidden and show Script End  -->  
                                          
<!--Task Comment end -->                                            
@endsection       