@extends('admin.layouts.app')
@section('title','Profile')
@section('content')
<div class="main-content">
<div class="container-fluid">

<div class="breadcrumb-wrapper row">
<div class="col-12 col-lg-3 col-md-6">
<h4 class="page-title">Profile</h4>
</div>
<div class="col-12 col-lg-9 col-md-6">
<ol class="breadcrumb float-right">
<li><a href="#">Home</a></li>
<li class="active"> / Profile</li>
</ol>
</div>
</div>
 
</div>

<div class="container-fluid">
<div class="row">

<div class="col-12 col-md-4">
<div class="profile-bg">
<div class="user-profile">
<figure class="profile-wall-img">
<img class="img-fluid" src="assets/img/profile/user-bg.jpg" alt="User Wall">
</figure>
<div class="profile-body">
<figure class="profile-user-avatar">
<img src="assets/img/profile/user1.jpg" alt="User Wall">
</figure>
<h3 class="profile-user-name">Michael A. Franklin</h3>
<small class="profile-user-address">California, United States</small>
<div class="profile-user-description">
<p>I have 10 years of experience designing for the web, and specialize in the areas of user interface design, interaction design, visual design and prototyping. I’ve worked with notable startups including Pearl Street Software.</p>
</div>
<div class="m-t-5">
<a href="#" class="btn btn-common">Edit Profile</a>
</div>
</div>
<div class="row border-top m-t-20">
<div class="col-4 border-right d-flex flex-column justify-content-center align-items-center py-4">
<h3>274</h3>
<small>Comments</small>
</div>
<div class="col-4 border-right d-flex flex-column justify-content-center align-items-center py-4">
<h3>2,483</h3>
<small>Followers</small>
</div>
<div class="col-4 border-right d-flex flex-column justify-content-center align-items-center py-4">
<h3>146</h3>
<small>Following</small>
</div>
</div>
</div>
</div>
</div>

<div class="col-12 col-md-8">
<div class="timeline-view bg-white p-20">
<h4 class="box-title">User Timeline</h4>
<div class="row">
<div class="col-12">
<form class="form">
<div class="form-group floating-label">
<textarea class="form-control form-control" row="7" placeholder="What's on your mind"></textarea>
</div>
</form>
<div class="m-b-20">
<div class="float-left">
<a class="btn bg-transparent"><i class="lni-camera" aria-hidden="true"></i></a>
<a class="btn bg-transparent"><i class="lni-map-marker" aria-hidden="true"></i></a>
<a class="btn bg-transparent"><i class="lni-paperclip" aria-hidden="true"></i></a>
</div>
<a href="#" class="btn btn-common float-right">Post</a>
</div>
</div>
<div class="col-12">
<div id="activity" class="m-t-20">
<ul class="timeline timeline-hairline">
<li class="timeline-inverted">
<div class="timeline-circle rounded-circle text-primary text-center"><i class="lni-envelope"></i></div>
<div class="timeline-entry">
<div class="card">
<div class="card-body timeline-entry-content">
 <p class="mb-0">Received a <a class="text-primary" href="#">message</a> from <span class="text-primary">Samuel Nelson</span></p>
<p class="mb-0">
<span>
Sunday, March 25, 2018
</span>
</p>
</div>
</div>
</div>
</li>
<li>
<div class="timeline-circle rounded-circle text-warning text-center"><i class="lni-alarm-clock"></i></div>
<div class="timeline-entry">
<div class="card">
<div class="card-body timeline-entry-content">
<p class="mb-0">
User apply for refund at <span class="text-warning">9:15 pm</span>
</p>
<p class="mb-0">
<span>
Thursday, March 15, 2018
</span>
</p>
</div>
</div>
</div>
</li>
<li>
<div class="timeline-circle rounded-circle text-success text-center"><i class="lni-map-marker"></i></div>
<div class="timeline-entry">
<div class="card">
<div class="card-body timeline-entry-content">
<img class="rounded-circle float-left" src="assets/img/profile/avatar.jpg" alt="Profile Image">
<div class="m-l-50">
<p class="mb-0">User receives order in the <span class="text-success">Office Place</span></p>
<p class="mb-0">
<span>
Monday, March 5, 2018
</span>
</p>
</div>
<div class="mt-2">
<p>Thank you for a good service.</p>
<div class="text-center">
<img class="img-fluid" src="assets/img/profile/shopping-bag.png" alt="Shopping Bag">
</div>
</div>
</div>
</div>
</div>
</li>
</ul>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
@endsection