@extends('admin.layouts.app')
@section('title','Add User')
@section('content')
<div class="container-fluid">
<div class="breadcrumb-wrapper row">
<div class="col-12 col-lg-3 col-md-6">
<h4 class="page-title">Create User</h4>
</div>
<div class="col-12 col-lg-9 col-md-6">
<ol class="breadcrumb float-right">
<li><a href="{{route('dashboard')}}">Home</a></li>
<li class="active"> / Add User</li>
</ol>
</div>
</div>
</div>

<div class="container-fluid">
<div class="row">
<div class="col-12 grid-margin">
<div class="card">
<div class="card-header border-bottom">
<h4 class="card-title">Enter Users Details</h4>
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
<label class="col-sm-3 col-form-label">Name :</label>
<div class="col-sm-9">
<input type="text" name="name" class="form-control" placeholder="Enter your name" required>
</div>
</div>
</div>

<div class="col-md-6">
<div class="form-group row">
<label class="col-sm-3 col-form-label">Email :</label>
<div class="col-sm-9">
<input type="text" name="email" class="form-control" placeholder="Enter email" required>
</div>
</div>
</div>

<div class="col-md-6">
<div class="form-group row">
<label class="col-sm-3 col-form-label">Mobile No :</label>
<div class="col-sm-9">
<input type="text" name="mobile" class="form-control" placeholder="Enter mobile no" required>
</div>
</div>
</div>

<div class="col-md-6">
<div class="form-group row">
<label class="col-sm-3 col-form-label">Password :</label>
<div class="col-sm-9">
<input type="password" name="password" class="form-control" placeholder="Enter Password" required>
</div>
</div>
</div>
<div class="col-md-6">
<div class="form-group row">
<label class="col-sm-3 col-form-label">Confirm Password :</label>
<div class="col-sm-9">
<input type="passowrd" name="c_password" class="form-control" placeholder="Enter confirm password" required>
</div>
</div>
</div>

<div class="col-md-6">
<div class="form-group row">
<label class="col-sm-3 col-form-label">Select Role Name :</label>
<div class="col-sm-9">
<select class="form-control" name="role" required>
	<option value="">Select Role</option>
	<option value="0">Admin</option>
	<option value="1">Sub Admin</option> 
	<option value="2">Manager </option> 
	<option value="3">Team Lead</option> 
 </select> 
</div>
</div>
</div>

<div class="col-md-6">
<div class="form-group row">
<label class="col-sm-3 col-form-label">Status :</label>
<div class="col-sm-9">
<select class="form-control" name="status" required>
	<option value=""  >Select Status</option>
	<option value="0">Deactive</option>
	<option value="1">Active</option> 
 </select> 
</div>
</div>
</div>

</div>
<br>
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