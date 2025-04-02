@extends('admin.layouts.app')
@section('title','Edit Lead')
@section('content')
<div class="container-fluid">
<div class="breadcrumb-wrapper row">
<div class="col-12 col-lg-3 col-md-6">
<h4 class="page-title">Update Lead</h4>
</div>
<div class="col-12 col-lg-9 col-md-6">
<ol class="breadcrumb float-right">
<li><a href="{{route('dashboard')}}">Home</a></li>
<li class="active"> / Edit Lead</li>
</ol>
</div>
</div>
</div>

<div class="container-fluid">
<div class="row">
<div class="col-12 grid-margin">
<div class="card">
<div class="card-header border-bottom">
<h4 class="card-title">Enter Update Lead Details</h4>
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
<label class="col-sm-3 col-form-label">First Name :</label>
<div class="col-sm-9">
<input type="text" name="first_name" class="form-control" value='Rajesh' placeholder="Enter first name" required>
</div>
</div>
</div>

<div class="col-md-6">
<div class="form-group row">
<label class="col-sm-3 col-form-label">Last Name :</label>
<div class="col-sm-9">
<input type="text" name="last_name" class="form-control" value='Kumar' placeholder="Enter last name" required>
</div>
</div>
</div>

<div class="col-md-6">
<div class="form-group row">
<label class="col-sm-3 col-form-label">Email :</label>
<div class="col-sm-9">
<input type="text" name="email" class="form-control" value='rajesh"gmail.com' placeholder="Enter email" required>
</div>
</div>
</div>

<div class="col-md-6">
<div class="form-group row">
<label class="col-sm-3 col-form-label">Mobile :</label>
<div class="col-sm-9">
<input type="text" name="mobile" class="form-control" value='8383019093' placeholder="Enter mobile" required>
</div>
</div>
</div>

<div class="col-md-6">
<div class="form-group row">
<label class="col-sm-3 col-form-label">Area Pin:</label>
<div class="col-sm-9">
<input type="text" name="pin_code" class="form-control" value='201014' placeholder="Enter Area Pin Code" required>
</div>
</div>
</div>

<div class="col-md-6">
<div class="form-group row">
<label class="col-sm-3 col-form-label">Country :</label>
<div class="col-sm-9">
<select class="form-control" name="country" value='India' required>
	<option value="">Select Country</option>
	<option value="0">INDIA</option>
	<option value="1">USA</option> 
	<option value="1">CHINA</option> 
 </select> 
</div>
</div>
</div>

<div class="col-md-6">
<div class="form-group row">
<label class="col-sm-3 col-form-label">State :</label>
<div class="col-sm-9">
<select class="form-control" name="state" value='UP' required>
	<option value="">Select State</option>
	<option value="0">UP</option>
	<option value="1">MP</option> 
	<option value="1">DELHI</option> 
 </select> 
</div>
</div>
</div>

<div class="col-md-6">
<div class="form-group row">
<label class="col-sm-3 col-form-label">City :</label>
<div class="col-sm-9">
<select class="form-control" name="city" value='Pryagraj' required>
	<option value="">Select City</option>
	<option value="0">Pryagraj </option>
	<option value="1">Ghaziabad</option> 
	<option value="1">Gautam Budh Nagar</option> 
 </select> 
</div>
</div>
</div>

<!--<div class="col-md-6">
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
</div>-->


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