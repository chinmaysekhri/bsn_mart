<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>BSN Mart Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" type="image/x-icon" href="admin/assets/images/favicon.png" />
    <!--03-02-2024  -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!--03-02-2024  -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap');

        * {
            margin: 0;
            padding: 2px;
            box-sizing: border-box;
            font-family: 'Montserrat', sans-serif;
        }

        body {
            background-color: #c9d6ff;
            /* background: linear-gradient(to right, #e2e2e2, #c9d6ff); */
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            border-radius: 30px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.35);
            position: relative;
            overflow: hidden;
            width: 768px;
            max-width: 100%;
            min-height: 480px;
        }

        .container p {
            font-size: 14px;
            line-height: 20px;
            letter-spacing: 0.3px;
            margin: 20px 0;
        }

        .container span {
            font-size: 12px;
        }

        .container a {
            color: #333;
            font-size: 13px;
            text-decoration: none;
            margin: 15px 0 10px;
        }

        .btn-primary {
            background-color: #2b70e5;
        }

        .btn-dark {
            background-color: #333;
        }

        .container button {
            color: #fff;
            font-size: 12px;
            padding: 10px 45px;
            border: 1px solid transparent;
            border-radius: 8px;
            font-weight: 600;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            margin-top: 10px;
            cursor: pointer;
        }


        .container button.hidden {
            background-color: transparent;
            border-color: #fff;
        }

        .container form {
            background-color: #fff;
            display: flex;
            /* align-items: center; */
            justify-content: center;
            flex-direction: column;
            padding: 0 40px;
            height: 100%;
        }

        .container input {
            background-color: #eee;
            border: none;
            margin: 8px 0;
            padding: 10px 15px;
            font-size: 13px;
            border-radius: 8px;
            width: 100%;
            outline: none;
        }

        .form-container {
            position: absolute;
            top: 0;
            height: 100%;
            transition: all 0.6s ease-in-out;
        }

        .sign-in {
            left: 0;
            width: 50%;
            z-index: 2;
        }

        .container.active .sign-in {
            transform: translateX(100%);
        }

        .sign-up {
            left: 0;
            width: 50%;
            opacity: 0;
            z-index: 1;
        }

        .container.active .sign-up {
            transform: translateX(100%);
            opacity: 1;
            z-index: 5;
            animation: move 0.6s;
        }

        @keyframes move {

            0%,
            49.99% {
                opacity: 0;
                z-index: 1;
            }

            50%,
            100% {
                opacity: 1;
                z-index: 5;
            }
        }


        .social-icons a {
            border: 1px solid #ccc;
            border-radius: 20%;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            margin: 0 3px;
            width: 40px;
            height: 40px;
        }

        .toggle-container {
            position: absolute;
            top: 0;
            left: 50%;
            width: 50%;
            height: 100%;
            overflow: hidden;
            transition: all 0.6s ease-in-out;
            border-radius: 150px 0 0 100px;
            z-index: 1000;
        }

        .container.active .toggle-container {
            transform: translateX(-100%);
            border-radius: 0 150px 100px 0;
        }

        /* .toggle{
    background-color: #512da8;
    height: 100%;
    background: linear-gradient(to right, #5c6bc0, #512da8);
    color: #fff;
    position: relative;
    left: -100%;
    height: 100%;
    width: 200%;
    transform: translateX(0);
    transition: all 0.6s ease-in-out;
    } */
        .toggle {
            background-color: #2b70e5;
            height: 100%;
            color: #fff;
            position: relative;
            left: -100%;
            height: 100%;
            width: 200%;
            transform: translateX(0);
            transition: all 0.6s ease-in-out;
        }

        .container.active .toggle {
            transform: translateX(50%);
        }

        .toggle-panel {
            position: absolute;
            width: 50%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 0 30px;
            text-align: center;
            top: 0;
            transform: translateX(0);
            transition: all 0.6s ease-in-out;
        }

        .toggle-left {
            transform: translateX(-200%);
        }

        .container.active .toggle-left {
            transform: translateX(0);
        }

        .toggle-right {
            right: 0;
            transform: translateX(0);
        }

        .container.active .toggle-right {
            transform: translateX(200%);
        }

        .text-center {
            text-align: center;
        }

        .cursor-pointer {
            display: inline-flex;
        }

        .w3-bar :focus {
            background-color: #002667;
        }
    </style>
</head>

<body x-data="main" class="relative overflow-x-hidden font-nunito text-sm font-normal antialiased" :class="[ $store.app.sidebar ? 'toggle-sidebar' : '', $store.app.theme, $store.app.menu, $store.app.layout,$store.app.rtlClass]">
    <div class="container" id="container">
        <div class="form-container sign-up text-center">   
            <h1 class="space-y-5">Create Account</h1>

            <!-- <span>or use your email for registeration</span> -->
            <div class="w3-bar w3-black">
                <button class="w3-bar-item btn-primary w3-button " onclick="openCity('Seller')">Seller</button>
                <button class="w3-bar-item btn-primary w3-button" onclick="openCity('Buyer')">Buyer</button>
            </div>
            
            <div id="Seller" class="w3-container city">
                 {!! Form::open(array('route' => 'seller_web_application','method'=>'POST', 'enctype'=>'multipart/form-data')) !!}
                    
                    <input type="text" name="first_name" placeholder="First Name" required/>
                    <input type="text" name="last_name" placeholder="Last Name" required/>
                    <input type="email" name="email" placeholder="Email" required/>
                    <input type="text" name="mobile" placeholder="Mobile Number" required/>
                    <input type="text" name="pin_code" placeholder="Pin Code" required/>
                   
                    <button type="submit" class="btn btn-primary w-full">SIGN IN AS SELLER</button>
                 {!! Form::close() !!}
            </div>
            
            <div id="Buyer" class="w3-container city" style="display:none">
                <form method="POST" action="{{route('buyer_web_application')}}">
                    @csrf
                    <input type="text" name="first_name" placeholder="First Name" required/>
                    <input type="text" name="last_name" placeholder="Last Name" required/>
                    <input type="email" name="email" placeholder="Email" required/>
                    <input type="text" name="mobile" placeholder="Mobile Number"required/>
                    <input type="text" name="pin_code" placeholder="Pin Code" required/>
                    
                    <button type="submit" class="btn btn-primary w-full">SIGN IN AS BUYER</button>
                </form>
            </div>

        </div>
       
        <div class="form-container sign-in">
        <!-- Flash  Message  start -->
  
    		
    	 @if (session()->has('success'))
        <div class="fixed text-white bg-blue-500 rounded-lg shadow bottom-3 text-lg py-2 px-2 mr-5" id="successMessage">
            <p style="color: green;border-radius: 0px;">{{ session('success')}}</p>
        </div>
            
        @endif

    		
         <!-- Flash  Message  End  -->
         
            <form class="space-y-5" method="POST" action="{{ route('login') }}">
                <h1 class="text-center">Log In</h1>
                <span class="text-center">or use your email password</span>
                @csrf
                <div>
                    <!-- <label for="email">Email</label> -->
                    <input id="email" type="email" class="form-input" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Enter Email">
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong style="color:red;">{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div>
                    <!-- <label for="password">Password</label> -->
                    <input id="password" type="password" class="form-input" name="password" required autocomplete="current-password" placeholder="Enter Password">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong style="color:red;">{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="float-right">
                    <a href="{{route('forget.password.get')}}" class="text-muted" style="color:#769995;"><i class="lni-lock"></i> Forgot your password?</a>
                </div>
                <button type="submit" class="btn btn-primary w-full">Log IN</button>

            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Welcome Back!</h1>
                    <p>Enter your personal details to use all of site features</p>
                    <button class="hidden" id="login">Log In</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Hello, Friend!</h1>
                    <p>Register with your personal details to use all of site features</p>
                    <button class="hidden" id="register">Sign Up</button>
                </div>
            </div>
        </div>
    </div>
  
    <!--03-02-2024  -->
    
    <script>
      setTimeout(function() {
       $('#successMessage').remove();
      }, 5000); 
    </script>
    
    <!--03-02-2024  -->  
    
    
    <script>
        function openCity(cityName) {
            var i;
            var x = document.getElementsByClassName("city");
            for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";
                event.preventDefault();
            }
            document.getElementById(cityName).style.display = "block";
            event.preventDefault();
        }
    </script>
    <script>
        const container = document.getElementById('container');
        const registerBtn = document.getElementById('register');
        const loginBtn = document.getElementById('login');

        registerBtn.addEventListener('click', () => {
            container.classList.add("active");
        });

        loginBtn.addEventListener('click', () => {
            container.classList.remove("active");
        });
    </script>
</body>

</html>