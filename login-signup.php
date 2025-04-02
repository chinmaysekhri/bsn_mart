<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="robots" content="noindex">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/l ibs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="css/style2.css">
    <title>BSN Mart</title>
    <style>
        .w3-bar button:focus {
            background-color: #002667;
        }
    </style>
</head>

<body style="background-image: url(./images/0077.png);">
    <div class="container" id="container">
        <div class="form-container sign-up">
            <form>
                <h1>Create Account</h1>

                <span>or use your email for registeration</span>
                <div class="w3-bar w3-black">
                    <button class="w3-bar-item w3-button" onclick="openCity('Seller')" onclick="event.preventDefault();">Seller</button>
                    <button class="w3-bar-item w3-button" onclick="openCity('Buyer')">Buyer</button>
                </div>

                <div id="Seller" class="w3-container city">
                    <input type="text" placeholder="Buisness Name">
                    <input type="text" placeholder="Brand Name">
                    <input type="email" placeholder="Email">
                    <input type="text" placeholder="Mobile Number">
                    <input type="text" placeholder="Pin Code">
                </div>

                <div id="Buyer" class="w3-container city" style="display:none">
                    <input type="text" placeholder="Buisness Name">
                    <input type="email" placeholder="Email">
                    <input type="text" placeholder="Mobile Number">
                    <input type="text" placeholder="Pin Code">
                </div>


                <button>Sign Up</button>

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
            </form>
        </div>
        <div class="form-container sign-in">
            <form>
                <h1>Sign In</h1>

                <span>or use your email password</span>
                <input type="email" placeholder="Email">
                <input type="password" placeholder="Password">
                <a href="#" class="">Forget Your Password?</a>
                <button>Sign In</button>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Welcome Back!</h1>
                    <p>Enter your personal details to use all of site features</p>
                    <button class="hidden" id="login">Sign In</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Hello, Friend!</h1>
                    <p>Register with your personal details to use all of site features</p>
                    <button class="hidden" id="register">Sign Up</button>
                </div>
            </div>
        </div>
    </div>

    <script src="js/script2.js"></script>
</body>

</html>