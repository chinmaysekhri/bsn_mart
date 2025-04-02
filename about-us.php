<!DOCTYPE html>
<html>

<head>
    <title>About us</title>
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
    <script src="js/modernizr.js"></script>
    <style>
        * {
            box-sizing: border-box;
        }

        body,
        html {
            overflow-x: hidden;
        }

        body {
            margin: 0;
            width: 100%;
            /* font-family: "Oswald", sans-serif; */
            font-size: 12pt;
            font-weight: 400;
        }



        a {
            text-decoration: none;
            transition: all 0.5s ease-in-out;
        }

        a:hover {
            transition: all 0.5s ease-in-out;
        }

        .we-are-block {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            flex-wrap: nowrap;
            width: 100%;
            height: 900px;
        }



        .col {
            margin: auto;
        }

        @media screen and (max-width: 860px) {
            .we-are-block {
                height: 2200px;
            }
        }

        @media screen and (max-width: 500px) {
            .we-are-block {
                height: 2300px;
            }
        }

        #about-us-section {
            background: #0c4c91;
            width: 100%;
            height: 50%;
            display: flex;
            flex-direction: row;
            flex-wrap: nowrap;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        @media screen and (max-width: 860px) {
            #about-us-section {
                flex-direction: column;
                justify-content: space-between;
            }
        }

        .about-us-image {
            position: absolute;
            top: 0;
            right: 0;
            height: 100%;
            overflow: hidden;
        }

        @media screen and (max-width: 860px) {
            .about-us-image {
                position: relative;
                width: 100%;
                height: 45%;
            }
        }

        @media screen and (max-width: 747px) {
            .about-us-image {
                height: 35%;
            }
        }

        @media screen and (max-width: 644px) {
            .about-us-image img {
                position: absolute;
                left: -220px;
            }
        }

        .about-us-info {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            justify-content: space-evenly;
            width: 40%;
            height: 80%;
            margin-right: 850px;
            margin-left: 12px;
            z-index: 2;
        }

        @media screen and (max-width: 1353px) {
            .about-us-info {
                margin-right: 400px;
                width: 60%;
                background: #0c4c9199;
                padding: 0px 25px 0px 0px;
            }
        }

        @media screen and (max-width: 1238px) {
            .about-us-info {
                margin-right: 340px;
                width: 100%;
            }
        }

        @media screen and (max-width: 1111px) {
            .about-us-info {
                margin-right: 270px;
            }
        }

        @media screen and (max-width: 910px) {
            .about-us-info {
                margin-right: 150px;
            }
        }

        @media screen and (max-width: 860px) {
            .about-us-info {
                margin: 0px 0px 0px 0px !important;
                padding: 0px 20px 0px 20px !important;
                width: 100%;
                height: 55%;
                align-items: center;
            }
        }

        @media screen and (max-width: 747px) {
            .about-us-info {
                height: 65%;
            }
        }

        .about-us-info h2 {
            color: white;
            font-size: 40pt;
            text-align: right;
        }

        @media screen and (max-width: 860px) {
            .about-us-info h2 {
                text-align: center;
            }
        }

        .about-us-info p {
            color: white;
            font-size: 14pt;
            text-align: right;
        }

        @media screen and (max-width: 860px) {
            .about-us-info p {
                text-align: center;
            }
        }

        .about-us-info a {
            background-color: white;
            color: #0c4c91;
            width: 180px;
            text-align: center;
            padding: 15px 0px 15px 0px;
            font-size: 14pt;
            box-shadow: rgb(38, 57, 77) 0px 20px 30px -10px;
        }

        .about-us-info a:hover {
            background: #404140;
            color: white;
            box-shadow: rgba(0, 0, 0, 0.56) 0px 22px 70px 4px;
            transform: translateY(10px);
        }

        #history-section {
            width: 100%;
            height: 50%;
            display: flex;
            flex-direction: row;
            flex-wrap: nowrap;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        @media screen and (max-width: 860px) {
            #history-section {
                flex-direction: column;
                justify-content: space-between;
            }
        }

        .history-image {
            position: absolute;
            top: 0;
            left: 0;
            max-width: 820px;
            height: 100%;
            overflow: hidden;
        }

        @media screen and (max-width: 860px) {
            .history-image {
                position: relative;
                width: 100%;
                height: 40%;
            }
        }

        @media screen and (max-width: 747px) {
            .history-image {
                height: 35%;
            }
        }

        @media screen and (max-width: 644px) {
            .history-image img {
                position: absolute;
                right: -220px;
            }
        }

        .history-info {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            justify-content: space-evenly;
            width: 40%;
            height: 80%;
            margin-left: 850px;
            margin-right: 12px;
            z-index: 2;
        }

        @media screen and (max-width: 1353px) {
            .history-info {
                margin-left: 400px;
                width: 60%;
                background: #ffffff99;
                padding: 0px 0px 0px 25px;
            }
        }

        @media screen and (max-width: 1238px) {
            .history-info {
                margin-left: 340px;
                width: 100%;
            }
        }

        @media screen and (max-width: 1111px) {
            .history-info {
                margin-left: 270px;
            }
        }

        @media screen and (max-width: 910px) {
            .history-info {
                margin-left: 150px;
            }
        }

        @media screen and (max-width: 860px) {
            .history-info {
                margin: 0px 0px 0px 0px !important;
                padding: 0px 40px 0px 40px !important;
                width: 100%;
                height: 60%;
                align-items: center;
            }
        }

        @media screen and (max-width: 747px) {
            .history-info {
                height: 65%;
            }
        }

        .history-info h2 {
            color: #0c4c91;
            font-size: 40pt;
            text-align: left;
        }

        @media screen and (max-width: 860px) {
            .history-info h2 {
                text-align: center;
            }
        }

        .history-info p {
            color: #0c4c91;
            font-size: 14pt;
            text-align: left;
        }

        @media screen and (max-width: 860px) {
            .history-info p {
                text-align: center;
            }
        }

        .history-info a {
            background-color: #0c4c91;
            color: white;
            width: 180px;
            text-align: center;
            padding: 15px 0px 15px 0px;
            font-size: 14pt;
            box-shadow: rgb(38, 57, 77) 0px 20px 30px -10px;
        }

        .history-info a:hover {
            background: #404140;
            color: white;
            box-shadow: rgba(0, 0, 0, 0.56) 0px 22px 70px 4px;
            transform: translateY(10px);
        }
    </style>

<body>
    <?php include 'header.php'; ?>
    <div class="container-fluid ">
        <div class="row m-5">
            <div class="col">
                <h2 class="text-center">BSN MART</h2>
                <p class="text-center">Welcome to BSN Mart, your gateway to a dynamic and thriving e-commerce ecosystem. <br> At BSN Mart, we're not just a platform; we're a community-driven marketplace <br> that believes in the power of commerce to transform lives and businesses.</p>
            </div>
        </div>
        <div class="row m-5">
            <div class="col text-center">
                <img src="images/sss.png" alt="">
            </div>
            <div class="col">
                <h3 class="text-center">Our Vision</h3>
                <p>BSN Mart was founded with a vision to create more than just a transactional space. We aim to cultivate an environment where BSN, sellers, and buyers come together to forge connections, exchange ideas, and propel each other towards success. Our vision is rooted in the belief that e-commerce will be a catalyst for empowerment and growth.
                </p>
            </div>
        </div>
        <div class="row m-5">
            <div class="col">
                <h3 class="text-center">Why Choose BSN Mart?</h3>
                <ul>
                    <li><b>Diverse Marketplace:
                        </b>Explore a diverse range of categories, from cutting-edge electronics to fashion-forward apparel and lifestyle products. BSN Mart is your one-stop destination for a vast array of quality goods.</li>
                    <li><b>User-Friendly Experience: </b> We understand the importance of a seamless and user-friendly experience. Our platform is designed with you in mind, making navigation easy for both seasoned BSN and those new to the e-commerce landscape.</li>
                    <li><b>Community Collaboration: </b> At BSN Mart, we value the strength of community collaboration. Our platform is more than just a place to buy and sell; it's a space for like-minded individuals to connect, share knowledge, and build lasting relationships.</li>
                </ul>
            </div>
            <div class="col text-center">
                <img src="images/whychooseus.png" alt="">
            </div>

        </div>
        <div class="row m-5">
            <div class="col text-center">
                <img src="images/20943572.jpg" class="img-fluid" alt="">
            </div>
            <div class="col">
                <h3 class="text-center">Our Commitment</h3>
                <ul>
                    <li><b>Security and Privacy: </b>Your security is our top priority. BSN Mart employs robust security measures to ensure a safe and trustworthy trading environment. Shop and sell with confidence, knowing that your privacy is protected.</li>
                    <li><b>Transparent Transactions: </b> We believe in transparency in every transaction. From clear product listings to straightforward communication between buyers and sellers, we strive to create an environment where trust is built naturally.</li>
                </ul>
            </div>

        </div>
    </div>

    <hr>
    <section id="company-services">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-2 col-md-6 pb-3">
                    <div class="icon-box text-center">
                        <div class="icon-box-icon pe-3 pb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24" width="512" height="512">
                                <path d="m19.5,0h-5c-2.481,0-4.5,2.019-4.5,4.5v15c0,2.481,2.019,4.5,4.5,4.5h5c2.481,0,4.5-2.019,4.5-4.5V4.5c0-2.481-2.019-4.5-4.5-4.5Zm3.5,19.5c0,1.93-1.57,3.5-3.5,3.5h-5c-1.93,0-3.5-1.57-3.5-3.5V4.5c0-1.93,1.57-3.5,3.5-3.5h5c1.93,0,3.5,1.57,3.5,3.5v15Zm-6-7.5c-2.206,0-4,1.794-4,4s1.794,4,4,4,4-1.794,4-4-1.794-4-4-4Zm0,7c-1.654,0-3-1.346-3-3s1.346-3,3-3,3,1.346,3,3-1.346,3-3,3Zm-10-7c.194,0,.385.014.571.041.273.04.463.293.424.566-.04.273-.299.458-.566.424-.14-.021-.283-.031-.429-.031-1.654,0-3,1.346-3,3s1.346,3,3,3c.146,0,.289-.01.429-.031.268-.039.526.15.566.424.039.273-.15.527-.424.566-.187.026-.377.041-.571.041-2.206,0-4-1.794-4-4s1.794-4,4-4Zm10-2.5c1.379,0,2.5-1.122,2.5-2.5s-1.121-2.5-2.5-2.5-2.5,1.122-2.5,2.5,1.121,2.5,2.5,2.5Zm0-4c.827,0,1.5.673,1.5,1.5s-.673,1.5-1.5,1.5-1.5-.673-1.5-1.5.673-1.5,1.5-1.5Zm-11.5,1.5c0,.955.952,1.689,1.876,1.453.271-.071.54.093.608.36s-.093.54-.36.608c-.204.052-.414.079-.624.079-1.379,0-2.5-1.122-2.5-2.5s1.121-2.5,2.5-2.5c.21,0,.42.026.624.079.268.068.429.341.36.608-.067.268-.336.429-.608.36-.925-.235-1.876.499-1.876,1.453Zm2.5,9c0,.552-.448,1-1,1s-1-.448-1-1,.448-1,1-1,1,.448,1,1Zm10,0c0,.552-.448,1-1,1s-1-.448-1-1,.448-1,1-1,1,.448,1,1ZM8.5,1h-4c-1.93,0-3.5,1.57-3.5,3.5v15c0,1.93,1.57,3.5,3.5,3.5h4c.276,0,.5.224.5.5s-.224.5-.5.5h-4c-2.481,0-4.5-2.019-4.5-4.5V4.5C0,2.019,2.019,0,4.5,0h4c.276,0,.5.224.5.5s-.224.5-.5.5Z" />
                            </svg>
                        </div>
                        <div class="icon-box-content">
                            <h6 class="card-title text-uppercase text-dark">Electronic Products</h6>
                            <!-- <p>Enjoy peace of mind with our robust secured payment system, ensuring your transactions are safe and
                                secure</p> -->
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 pb-3">
                    <div class="icon-box text-center">
                        <div class="icon-box-icon pe-3 pb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24">
                                <path d="m20.004,3.059C17.428.753,14.097-.306,10.636.075,5.125.684.684,5.125.075,10.636c-.67,6.074,3.154,11.78,8.896,13.273.236.061.474.091.711.091.613,0,1.214-.203,1.716-.591.7-.541,1.102-1.358,1.102-2.241v-3.193c2.523-.252,4.5-2.387,4.5-4.975v-2h.5c.276,0,.5-.224.5-.5s-.224-.5-.5-.5h-2.5v-3.5c0-.276-.224-.5-.5-.5s-.5.224-.5.5v3.5h-4v-3.5c0-.276-.224-.5-.5-.5s-.5.224-.5.5v3.5h-2.5c-.276,0-.5.224-.5.5s.224.5.5.5h.5v2c0,2.588,1.977,4.723,4.5,4.975v3.193c0,.571-.26,1.1-.713,1.45-.449.348-1.021.467-1.563.322C3.958,21.572.453,16.329,1.069,10.745,1.627,5.696,5.696,1.627,10.745,1.069c3.179-.35,6.23.62,8.591,2.734,2.329,2.086,3.664,5.073,3.664,8.196,0,4.808-3.075,9.021-7.652,10.481-.263.084-.408.365-.324.629.084.262.363.406.629.324,4.993-1.595,8.348-6.189,8.348-11.435,0-3.407-1.457-6.666-3.996-8.941Zm-12.004,9.941v-2h8v2c0,2.206-1.794,4-4,4s-4-1.794-4-4Z" />
                            </svg>
                        </div>
                        <div class="icon-box-content">
                            <h6 class="card-title text-uppercase text-dark">Electrical Products</h6>
                            <!-- <p>Our commitment to quality guarantees that every product you receive meets the highest standards of
                                excellenceg</p> -->
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 pb-3">
                    <div class="icon-box text-center">
                        <div class="icon-box-icon pe-3 pb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24">
                                <path d="m18.077,18.048L20.912,0H4.5C2.57,0,1,1.57,1,3.5v7c0,1.93,1.57,3.5,3.5,3.5h1.5v4.036c-1.694.243-3,1.704-3,3.464v2.5h18v-2.5c0-1.733-1.267-3.176-2.923-3.452Zm-11.077-4.048h3v-1h-3v-3h3v-1h-3v-3h3v-1h-3V1h12.742l-2.67,17H7v-4Zm-2.5-1c-1.378,0-2.5-1.122-2.5-2.5V3.5c0-1.378,1.122-2.5,2.5-2.5h1.5v12h-1.5Zm15.5,10H4v-1.5c0-1.378,1.122-2.5,2.5-2.5h11c1.379,0,2.5,1.122,2.5,2.5v1.5Z" />
                            </svg>

                        </div>
                        <div class="icon-box-content">
                            <h6 class="card-title text-uppercase text-dark">Home Appliances</h6>
                            <!-- <p>Relax as we take on the responsibility of timely and efficient dispatch, ensuring your orders reach you
                                promptly.</p> -->
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 pb-3">
                    <div class="icon-box text-center">
                        <div class="icon-box-icon pe-3 pb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24" width="512" height="512">
                                <path d="M21.776,14.115c.088-.221,.159-.449,.194-.69,.113-.794-.089-1.584-.57-2.226-.992-1.321-2.877-1.591-4.2-.599-.508,.38-.898,.851-1.2,1.34-.302-.489-.692-.959-1.2-1.34-.641-.48-1.431-.683-2.224-.57-.793,.113-1.495,.528-1.977,1.17-.48,.641-.683,1.431-.569,2.225,.034,.241,.106,.469,.194,.69-1.277,.345-2.224,1.501-2.224,2.885v7h7v-8h2v8h7v-7c0-1.384-.947-2.541-2.224-2.885Zm-9.005-.115c-.131-.06-.263-.12-.371-.201-.213-.159-.352-.394-.39-.657-.038-.265,.029-.528,.189-.741,.161-.214,.395-.353,.659-.391s.527,.03,.742,.19c.614,.461,.964,1.189,1.162,1.8h-1.992Zm6.828-.199c-.107,.08-.238,.14-.369,.199h-1.992c.198-.611,.548-1.339,1.162-1.8,.213-.16,.475-.229,.742-.19,.264,.038,.498,.177,.658,.39,.161,.214,.228,.478,.19,.742-.038,.264-.176,.498-.391,.659Zm-10.599-3.801c-.661,.882-1.006,1.932-1,3.015-1.229,.924-1.999,2.387-1.999,3.985v7H0V7c0-1.657,1.343-3,3-3h2.586L3.543,1.957l1.414-1.414,2.043,2.043V0h2V2.586L11.043,.543l1.414,1.414-2.043,2.043h2.586c1.654,0,3,1.346,3,3v2h0c-1.067-.8-2.383-1.14-3.706-.95-1.322,.188-2.492,.881-3.294,1.949Z" />
                            </svg>

                        </div>
                        <div class="icon-box-content">
                            <h6 class="card-title text-uppercase text-dark">Kids and Gift Items</h6>
                            <!-- <p>Cut out the middleman – benefit from direct sourcing, bringing you cost-effective and quality products
                            </p> -->
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 pb-3">
                    <div class="icon-box text-center">
                        <div class="icon-box-icon pe-3 pb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24" width="512" height="512">
                                <path d="m18,3.76V.5c0-.276-.224-.5-.5-.5s-.5.224-.5.5v2.757c-.469-.166-.974-.257-1.5-.257h-7c-.526,0-1.031.09-1.5.256V.499C7,.223,6.776,0,6.5,0s-.5.224-.5.5v3.26c-1.205.808-2,2.183-2,3.74v9c0,1.557.795,2.932,2,3.74v3.26c0,.276.224.5.5.5s.5-.224.5-.5v-2.757c.469.166.974.257,1.5.257h7c.526,0,1.031-.09,1.5-.256v2.757c0,.276.224.5.5.5s.5-.224.5-.5v-3.26c1.205-.808,2-2.183,2-3.74V7.5c0-1.557-.795-2.932-2-3.74Zm1,12.74c0,1.93-1.57,3.5-3.5,3.5h-7c-1.93,0-3.5-1.571-3.5-3.501V7.499c0-1.93,1.57-3.5,3.5-3.5h7c1.93,0,3.5,1.571,3.5,3.501v9Zm-11-4v1c0,.276-.224.5-.5.5s-.5-.224-.5-.5v-1c0-.276.224-.5.5-.5s.5.224.5.5Zm3,0v1c0,.276-.224.5-.5.5s-.5-.224-.5-.5v-1c0-.276.224-.5.5-.5s.5.224.5.5Zm3,0v1c0,.276-.224.5-.5.5s-.5-.224-.5-.5v-1c0-.276.224-.5.5-.5s.5.224.5.5Zm-6,4v1c0,.276-.224.5-.5.5s-.5-.224-.5-.5v-1c0-.276.224-.5.5-.5s.5.224.5.5Zm3,0v1c0,.276-.224.5-.5.5s-.5-.224-.5-.5v-1c0-.276.224-.5.5-.5s.5.224.5.5Zm3,0v1c0,.276-.224.5-.5.5s-.5-.224-.5-.5v-1c0-.276.224-.5.5-.5s.5.224.5.5Zm3-4v1c0,.276-.224.5-.5.5s-.5-.224-.5-.5v-1c0-.276.224-.5.5-.5s.5.224.5.5Zm0,4v1c0,.276-.224.5-.5.5s-.5-.224-.5-.5v-1c0-.276.224-.5.5-.5s.5.224.5.5Zm-1.5-10.5h-7c-.827,0-1.5.673-1.5,1.5v1c0,.827.673,1.5,1.5,1.5h7c.827,0,1.5-.673,1.5-1.5v-1c0-.827-.673-1.5-1.5-1.5Zm.5,2.5c0,.276-.225.5-.5.5h-7c-.275,0-.5-.224-.5-.5v-1c0-.276.225-.5.5-.5h7c.275,0,.5.224.5.5v1Z" />
                            </svg>

                        </div>
                        <div class="icon-box-content">
                            <h6 class="card-title text-uppercase text-dark">Mobile Accesories</h6>
                            <!-- <p>Experience hassle-free shopping with our dedicated replacement management, ensuring your satisfaction
                                is our top
                                priority </p> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <hr>

    <?php include 'footer.php'; ?>


</body>

<script src="js/jquery-1.11.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
<script type="text/javascript" src="js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="js/plugins.js"></script>
<script type="text/javascript" src="js/script.js"></script>
</body>

</html>