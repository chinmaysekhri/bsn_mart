@extends('admin.layouts.app')
@section('title','List Lead')
@section('content')

<div class="container-fluid">
<div class="breadcrumb-wrapper row">
<div class="col-12 col-lg-3 col-md-6">
<h4 class="page-title"> Manage Lead</h4>
</div>
<div class="col-12 col-lg-9 col-md-6">
<ol class="breadcrumb float-right">
<li><a href="{{route('dashboard')}}">Home</a></li>
<li class="active"> / View Lead</li>
</ol>
</div>
</div>
</div>


<div class="container-fluid">

<div class="row">
<div class="col-12">
<div class="card">
<div class="card-header border-bottom">
<a href="{{ route('add_lead') }}" class="btn btn-primary"><span class="fa fa-plus"></span> Add Lead</a>

<a href="#" class="btn btn-success"><span class="fa fa-plus"></span>Bulk Upload Lead</a>

</div>

<div class="card-body">
<div class="table-responsive">
<table id="datatable" class="table table-bordered">
<thead>
<tr>
<th>S.No</th>
<th>Name</th>
<th>Email</th>
<th>Contact</th>
<th>Pin </th>
<th>Date</th>
<th>Action</th>
</tr>
</thead>
<tbody>
<tr>
<?php $i=0; ?>
	 @foreach($totalLeads as $lead) 
	<?php $i++ ;?>
<td>{{$i}}</td>
<td>{{$lead->firstname." ".$lead->lastname}}</td>
<td>{{$lead->email}}</td>
<td>{{$lead->mobile}}</td>
<td>{{$lead->pin_code}}</td>
<td>{{$lead->created_at}}</td>

<!--<td><a href="#" class="badge badge-success">Active</a></td>-->

<td>
<a href="{{route('edit_lead')}}" class="text-info"><i  class="fa fa-edit  fa-lg"></i ></a>&nbsp;&nbsp

<a href="{{route('view_lead')}}" class="text-success"><i class="fa fa-eye fa-lg"></i></a> 
&nbsp;&nbsp
<a href="#" onClick="return confirm('Are you sure want to delete?');" class="text-danger"><span class="fa fa-trash fa-lg"></span></a>	
</td>
</tr>
@endforeach
 
</tbody>

</table>
</div>
</div>
</div>
</div> 
 </div> 
</div>


@endsection

