<!DOCTYPE html>
<html>

<head>
    <title>Contact Us</title>
    <meta charset="utf-8">
    <meta name="robots" content="noindex">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="author" content="">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <link rel="icon" type="image/x-icon" href="./images/SmallLogo.png">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@300;400;500&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #010712;
            --secondary-color: #818386;
            --bg-color: #FCFDFD;
            --button-color: #3B3636;
            --h1-color: #3F444C;
        }

        [data-theme="dark"] {
            --primary-color: #FCFDFD;
            --secondary-color: #818386;
            --bg-color: #010712;
            --button-color: #818386;
            --h1-color: #FCFDFD;
        }


        .contact-container {
            display: flex;
            width: 100vw;
            height: 100vh;
            background: var(--bg-color);
        }

        .left-col {
            width: 45vw;
            height: 100%;
            background-image: url("https://images.pexels.com/photos/931018/pexels-photo-931018.jpeg?auto=compress&cs=tinysrgb&dpr=2&w=500");
            background-size: cover;
            background-repeat: no-repeat;
        }

        .right-col {
            background: var(--bg-color);
            width: 50vw;
            height: 100vh;
            padding: 5rem 3.5rem;
        }



        label,
        .description {
            color: var(--secondary-color);
            text-transform: uppercase;
            font-size: 0.625rem;
        }

        form {
            width: 31.25rem;
            position: relative;
            margin-top: 2rem;
            padding: 1rem 0;
        }

        input,
        textarea,
        label {
            width: 40vw;
            display: block;
        }

        /* p,
        placeholder,
        input,
        textarea {
            font-family: 'Helvetica Neue', sans-serif;
        } */

        input::placeholder,
        textarea::placeholder {
            color: var(--primary-color);
        }

        input,
        textarea {
            color: var(--primary-color);
            font-weight: 500;
            background: var(--bg-color);
            border: none;
            border-bottom: 1px solid var(--secondary-color);
            padding: 0.5rem 0;
            margin-bottom: 1rem;
            outline: none;
        }

        textarea {
            resize: none;
        }

        button {
            text-transform: uppercase;
            font-weight: 300;
            background: var(--button-color);
            color: var(--bg-color);
            width: 10rem;
            height: 2.25rem;
            border: none;
            border-radius: 2px;
            outline: none;
            cursor: pointer;
        }

        input:hover,
        textarea:hover,
        button:hover {
            opacity: 0.5;
        }

        button:active {
            opacity: 0.8;
        }

        /* Toggle Switch */

        .theme-switch-wrapper {
            display: flex;
            align-items: center;
            text-align: center;
            width: 160px;
            position: absolute;
            top: 0.5rem;
            right: 0;
        }

        .description {
            margin-left: 1.25rem;
        }

        .theme-switch {
            display: inline-block;
            height: 34px;
            position: relative;
            width: 60px;
        }

        .theme-switch input {
            display: none;
        }

        .slider {
            background-color: #ccc;
            bottom: 0;
            cursor: pointer;
            left: 0;
            position: absolute;
            right: 0;
            top: 0;
            transition: .4s;
        }

        .slider:before {
            background-color: #fff;
            bottom: 0.25rem;
            content: "";
            width: 26px;
            height: 26px;
            left: 0.25rem;
            position: absolute;
            transition: .4s;
        }

        input:checked+.slider {
            background-color: var(--button-color);
        }

        input:checked+.slider:before {
            transform: translateX(26px);
        }

        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }

        #error,
        #success-msg {
            width: 40vw;
            margin: 0.125rem 0;
            font-size: 0.75rem;
            text-transform: uppercase;
            /* font-family: 'Jost'; */
            color: var(--secondary-color);
        }


        #success-msg {
            transition-delay: 3s;
        }

        @media only screen and (max-width: 950px) {
            .logo {
                width: 8rem;
            }

            h1 {
                font-size: 1.75rem;
            }

            p {
                font-size: 0.7rem;
            }

            input,
            textarea,
            button {
                font-size: 0.65rem;
            }

            .description {
                font-size: 0.3rem;
                margin-left: 0.4rem;
            }

            button {
                width: 7rem;
            }

            .theme-switch-wrapper {
                width: 120px;
            }

            .theme-switch {
                height: 28px;
                width: 50px;
            }

            .theme-switch input {
                display: none;
            }

            .slider:before {
                background-color: #fff;
                bottom: 0.25rem;
                content: "";
                width: 20px;
                height: 20px;
                left: 0.25rem;
                position: absolute;
                transition: .4s;
            }

            input:checked+.slider:before {
                transform: translateX(16px);
            }

            .slider.round {
                border-radius: 15px;
            }

            .slider.round:before {
                border-radius: 50%;
            }

        }
    </style>

<body>
    <?php include 'header.php'; ?>
    <!-- Responsive Contact Page with Dark Mode and Form Validation (vanilla JS).

    *Designed & built for desktop and tablets with viewport width >= 720px and in landscape orientation. -->

    <!-- <div class="contact-container">
        <div class="left-col">
        </div>
        <div class="right-col">
            <h1>Contact us</h1>
            <p>Planning to visit Indonesia soon? Get insider tips on where to go, things to do and find best deals for
                your
                next adventure.</p>
            <form id="contact-form" method="post">
                <label for="name">Full name</label>
                <input type="text" id="name" name="name" placeholder="Your Full Name" required>
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" placeholder="Your Email Address" required>
                <label for="message">Message</label>
                <textarea rows="6" placeholder="Your Message" id="message" name="message" required></textarea>
               <button type="submit" id="submit" name="submit">Send</button>
            </form>
            <div id="error"></div>
            <div id="success-msg"></div>
        </div>
    </div> -->
    <div class="container ">
        <div class="row">
            <div class="col">
                <img src="images/5138237.jpg" class="img-fluid" alt="">
            </div>
            <div class="col">
                <h1>Contact us</h1>
                <!-- <p>Planning to visit Indonesia soon? Get insider tips on where to go, things to do and find best deals for
                        your
                        next adventure.</p> -->

                <form id="contact-form" method="post">
                    <label for="name">Full name</label>
                    <input type="text" id="name" name="name" placeholder="Your Full Name" required>
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" placeholder="Your Email Address" required>
                    <label for="message">Message</label>
                    <textarea rows="6" placeholder="Your Message" id="message" name="message" required></textarea>
                    <!--<a href="javascript:void(0)">-->
                    <button type="submit" id="submit" class="btn-primary" name="submit">Send</button><!--</a>-->

                </form>
                <div id="error"></div>
                <div id="success-msg"></div>
            </div>
        </div>
    </div>
    <!-- Image credit: Oliver Sjöström https://www.pexels.com/photo/body-of-water-near-green-mountain-931018/  -->

    <?php include 'footer.php'; ?>
</body>
<script>
    const toggleSwitch = document.querySelector('.theme-switch input[type="checkbox"]');

    function switchTheme(e) {
        if (e.target.checked) {
            document.documentElement.setAttribute('data-theme', 'dark');
        } else {
            document.documentElement.setAttribute('data-theme', 'light');
        }
    }

    toggleSwitch.addEventListener('change', switchTheme, false);


    const name = document.getElementById('name');
    const email = document.getElementById('email');
    const message = document.getElementById('message');
    const contactForm = document.getElementById('contact-form');
    const errorElement = document.getElementById('error');
    const successMsg = document.getElementById('success-msg');
    const submitBtn = document.getElementById('submit');

    const validate = (e) => {
        e.preventDefault();

        if (name.value.length < 3) {
            errorElement.innerHTML = 'Your name should be at least 3 characters long.';
            return false;
        }

        if (!(email.value.includes('.') && (email.value.includes('@')))) {
            errorElement.innerHTML = 'Please enter a valid email address.';
            return false;
        }

        if (!emailIsValid(email.value)) {
            errorElement.innerHTML = 'Please enter a valid email address.';
            return false;
        }

        if (message.value.length < 15) {
            errorElement.innerHTML = 'Please write a longer message.';
            return false;
        }

        errorElement.innerHTML = '';
        successMsg.innerHTML = 'Thank you! I will get back to you as soon as possible.';

        e.preventDefault();
        setTimeout(function() {
            successMsg.innerHTML = '';
            document.getElementById('contact-form').reset();
        }, 6000);

        return true;

    }

    const emailIsValid = email => {
        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
    }

    submitBtn.addEventListener('click', validate);
    k
</script>
<script src="js/jquery-1.11.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
<script type="text/javascript" src="js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="js/plugins.js"></script>
<script type="text/javascript" src="js/script.js"></script>
</body>

</html>