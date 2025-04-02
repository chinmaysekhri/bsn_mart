@extends('admin.layouts.app')
@section('title','Users List')
@section('content')

<div class="container-fluid">
<div class="breadcrumb-wrapper row">
<div class="col-12 col-lg-3 col-md-6">
<h4 class="page-title">Manage Users</h4>
</div>
<div class="col-12 col-lg-9 col-md-6">
<ol class="breadcrumb float-right">
<li><a href="{{route('dashboard')}}">Home</a></li>
<li class="active"> / View Users</li>
</ol>
</div>
</div>
</div>


<div class="container-fluid">

<div class="row">
<div class="col-12">
<div class="card">
<div class="card-header border-bottom">
<a href="{{ route('add_user') }}" class="btn btn-primary"><span class="fa fa-plus"></span> Add User</a>
</div>


<div class="card-body">

<div class="table-responsive">
<table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
<thead>
<tr>
<th>Name</th>
<th>Email</th>
<th>Mobile</th>
<th>Role Name</th>
<th>Status</th>
<th>Action</th>
</tr>
</thead>
<tbody>

<tr>
<td>Rajesh</td>
<td>rajesh@gmail.com</td>
<td>8383019093</td>
<td>Admin</td>
<td><a href="#" class="badge badge-success">Active</a></td>
<td>
<a href="{{route('edit_user')}}" class="text-info"><i  class="fa fa-edit  fa-lg"></i ></a>&nbsp;&nbsp

<a href="{{route('view_user')}}" class="text-success"><i class="fa fa-eye fa-lg"></i></a> 
&nbsp;&nbsp
<a href="#" onClick="return confirm('Are you sure want to delete?');" class="text-danger"><span class="fa fa-trash fa-lg"></span></a>	
</td>
</tr>

<tr>
<td>Gaurav</td>
<td>gav@gmail.com</td>
<td>8383019095</td>
<td>Manager</td>
<td><a href="#" class="badge badge-danger">Deactive</a></td>

<td>
<a href="{{route('edit_user')}}" class="text-info"><i  class="fa fa-edit  fa-lg"></i ></a>&nbsp;&nbsp

<a href="{{route('view_user')}}" class="text-success"><i class="fa fa-eye fa-lg"></i></a> 
&nbsp;&nbsp
<a href="#" onClick="return confirm('Are you sure want to delete?');" class="text-danger"><span class="fa fa-trash fa-lg"></span></a>	
</td>
</tr>

</tbody>
</table>
</div>
</div>


</div> 
</div> 
</div>
</div>
@endsection

