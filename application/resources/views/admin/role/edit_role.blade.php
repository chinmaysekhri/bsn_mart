@extends('admin.layouts.app')
@section('title','Edit Role')
@section('content')
<div class="container-fluid">
<div class="breadcrumb-wrapper row">
<div class="col-12 col-lg-3 col-md-6">
<h4 class="page-title">Create Role</h4>
</div>
<div class="col-12 col-lg-9 col-md-6">
<ol class="breadcrumb float-right">
<li><a href="{{route('dashboard')}}">Home</a></li>
<li class="active"> / Edit Role</li>
</ol>
</div>
</div>
</div>

<div class="container-fluid">
<div class="row">
<div class="col-12 grid-margin">
<div class="card">
<div class="card-header border-bottom">
<h4 class="card-title">Enter Role Details</h4>
</div>
<div class="card-body">
<form class="form-sample" action="" method="POST" enctype="multipart/form-data">
@csrf
<p class="card-description">
Basic info
</p>
<div class="row">
<div class="col-md-6">
<div class="form-group row">
<label class="col-sm-3 col-form-label">Role Name :</label>
<div class="col-sm-9">
<input type="text" name="role_name" class="form-control" value="Manager" placeholder="Enter role name" required>
</div>
</div>
</div>

<div class="col-md-6">
<div class="form-group row">
<label class="col-sm-3 col-form-label">Status :</label>
<div class="col-sm-9">
<select class="form-control" name="status"  required>
	<option value=""  >Select Status</option>
	<option value="0">Deactive</option>
	<option value="1">Active</option> 
 </select> 
</div>
</div>
</div>
</div><br>
<div class="text-center">
<button type="submit" class="btn btn-success mr-3">Submit</button>
<button type="reset" class="btn btn-danger">Cancel</button>
</div>
</form>
</div>
</div>
</div>
</div>
</div>
@endsection