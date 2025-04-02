@extends('admin.layouts.app')
@section('title','Reset Password')
@section('content')

<!-- scroll to top button -->
        <div class="fixed bottom-6 right-6 z-50" x-data="scrollToTop">
            <template x-if="showTopButton">
                <button type="button" class="btn btn-outline-primary animate-pulse rounded-full p-2" @click="goToTop">
                    <svg width="24" height="24" class="h-4 w-4" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            opacity="0.5"
                            fill-rule="evenodd"
                            clip-rule="evenodd"
                            d="M12 20.75C12.4142 20.75 12.75 20.4142 12.75 20L12.75 10.75L11.25 10.75L11.25 20C11.25 20.4142 11.5858 20.75 12 20.75Z"
                            fill="currentColor"
                        />
                        <path
                            d="M6.00002 10.75C5.69667 10.75 5.4232 10.5673 5.30711 10.287C5.19103 10.0068 5.25519 9.68417 5.46969 9.46967L11.4697 3.46967C11.6103 3.32902 11.8011 3.25 12 3.25C12.1989 3.25 12.3897 3.32902 12.5304 3.46967L18.5304 9.46967C18.7449 9.68417 18.809 10.0068 18.6929 10.287C18.5768 10.5673 18.3034 10.75 18 10.75L6.00002 10.75Z"
                            fill="currentColor"
                        />
                    </svg>
                </button>
            </template>
        </div>

        <div class="main-container min-h-screen text-black dark:text-white-dark">
		
			<div class="" id="alertMessageHide"><center style="margin-bottom: 20px;">
				@if(Session::has('password'))
				 <font class="alert" style="color: #f5f5f5;background-color:#009688;padding: 15px 159px;border-radius: 24px;">{!!session('password')!!}</font>
				@endif</center>
			</div>
			
            <!-- start main content section -->
            <div class="flex min-h-screen items-center justify-center bg-[url('../images/map.svg')] bg-cover bg-center dark:bg-[url('../images/map-dark.svg')]">
                <div class="panel m-6 w-full max-w-lg sm:w-[480px]">
                    <h2 class="mb-3 text-2xl font-bold text-center">Reset Password</h2>
					<br>
					
                    	@foreach ($errors->all() as $error)
                        <p class="text-danger">{{ $error }}</p>
                        @endforeach   
                    
					<form class="space-y-5" method="POST" action="{{ route('update_reset.password') }}">
					
					 @csrf
                        <div>
                            <label for="Email">Email</label>
							
                            <input id="email" type="email" class="form-input"  name="email" placeholder="Enter Email Address" autocomplete="" />
                        </div>
						
                        <div>
                            <label for="new_password">New Password</label>
                            <input id="new_password" type="password" class="form-input" name="new_password" placeholder="Enter New Password" autocomplete="current-password" />
                        </div>
						
                        <div>
                            <label for="new_confirm_password">Confirm Password</label>
                            <input id="new_confirm_password" type="password" class="form-input" name="new_confirm_password" placeholder="Enter Confirm Password" autocomplete="current-password" />
                        </div>
                       
                        <button type="submit" class="btn btn-primary w-full">Reset Password</button>
                    </form>
                   
                   
                </div>
            </div>
            <!-- end main content section -->
        </div>

        
@endsection

@push('script')
    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
    <script type="text/javascript"> 
      $(function(){
       $('#alertMessageHide').delay(5000).fadeOut();
      });
    </script>

@endpush