<!DOCTYPE html>
<html>

<head>
  <title>Home | BSN Mart</title>
  <meta name="robots" content="noindex">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="format-detection" content="telephone=no">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="author" content="">
  <meta name="keywords" content="">
  <meta name="description" content="">
  <link rel="icon" type="image/x-icon" href="./images/LongLogo.png">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Jost:wght@300;400;500&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
  <!-- script    ================================================== -->
  <script src="js/modernizr.js"></script>
  <style>
    .bg-grey {
      background-color: lightgray;

    }

    .h-100 {
      height: 100px !important;
    }

    .h5-font {
      font-size: 1.8rem;
      font-weight: 200;
      margin-bottom: 2%;
    }

    .h2-font {
      font-size: 3rem;
      font-weight: 400;
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      background: #f2f2f2;
    }

    @keyframes slide {
      from {
        transform: translateX(0);
      }

      to {
        transform: translateX(-100%);
      }
    }

    .logos {
      overflow: hidden;
      padding: 60px 0;
      /* background: white; */
      white-space: nowrap;
      position: relative;
    }

    .logos:before,
    .logos:after {
      position: absolute;
      top: 0;
      width: 250px;
      height: 100%;
      content: "";
      z-index: 2;
    }

    .logos:before {
      left: 0;
      background: linear-gradient(to left, rgba(255, 255, 255, 0), lightgray);
    }

    .logos:after {
      right: 0;
      background: linear-gradient(to right, rgba(255, 255, 255, 0), lightgray);
    }

    .logos:hover .logos-slide {
      animation-play-state: paused;
    }

    .logos-slide {
      display: inline-block;
      animation: 35s slide infinite linear;
    }

    .logos-slide img {
      height: 50px;
      margin: 0 40px;
    }

    ul {
      list-style-type: none;
    }

    @keyframes marquee {
      0% {
        margin-left: 100%;
        transform: translateX(0%);
      }

      100% {
        margin-left: 0;
        transform: translateX(-100%);
      }
    }

    .section {
      overflow: hidden;
      position: fixed;
      background-color: #f2f2f2;
      top: 0;
      z-index: 999;


      .marquee {
        animation: marquee 50s linear infinite;
        display: inline-block;
        white-space: nowrap;

        &:hover {
          animation-play-state: paused;
        }
      }
    }
  </style>
</head>

<body data-bs-spy="scroll" data-bs-target="#navbar" data-bs-root-margin="0px 0px -40%" data-bs-smooth-scroll="true" tabindex="0">
  <?php include 'header.php'; ?>
  <section class="section">
    <p class="marquee text-styling mb-0 text-danger">For a seamless and secure transaction experience, we exclusively accept non-cash payments. Please note that any transactions involving cash will not be the responsibility or liability of our company. Thank you for your understanding & cooperation.</p>
  </section>
  <div class="container-fluid">
    <div class="row bg-img">
      <div class="col m-auto">
        <div class="text-content  padding-small">
          <h1 class=" text-white">Navigate the Future of B2B: <br>We Guaranteed</h1>
          <p class="text-white offset-1"> - Delivery <br>- Return & Replacement <br>- Payout<br>- Price Confidentiality <br></p>

          <!-- <ul>
            <li class="text-white"> Delivery </li>
            <li class="text-white"> Return & Replacement</li>
            <li class="text-white"> Payout</li>
            <li class="text-white"> Price Confidentiality</li>
          </ul> -->

          <!-- <div class="row text-white">
            <div class="col-2 ">
              <p class="text-white">Guaranteed</p>
            </div>
            <div class="col">
              <p class="text-white"> - Delivery <br>- Return & Replacement <br>- Payout<br>- Price Confidentiality <br></p>
            </div>
          </div> -->
          <a href="https://bsnmart.com/application/login" class="btn  btn-purple text-uppercase btn-rounded-none ">Search Product</a>
        </div>
        <!-- <h1 class=" text-white">Navigate the Future of B2B: <br> Range Of Products</h1>
        <a href="https://bsnmart.com/application/login" class="btn  btn-purple  btn-rounded-none">Search Product</a> -->
      </div>
      <div class="col">
        <!-- <img src="images/product.png" alt="" class="img-fluid"> -->
      </div>
    </div>
  </div>
  <section id="company-services">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-lg-2 col-md-6 pb-3">
          <div class="icon-box text-center">
            <div class="icon-box-icon pe-3 pb-3">
              <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24" width="512" height="512">
                <path d="M11.914,11.829c-.218,.616-.796,1-1.414,1-.166,0-.335-.027-.5-.086-.565-.2-1.072-.506-1.501-.891-.797,.713-1.848,1.148-2.999,1.148h-1c-.169,0-.336-.01-.5-.028v3.028h5.5c.828,0,1.5,.672,1.5,1.5s-.672,1.5-1.5,1.5H4v.5c0,.827,.673,1.5,1.5,1.5h4c.828,0,1.5,.672,1.5,1.5s-.672,1.5-1.5,1.5H5.5c-2.481,0-4.5-2.019-4.5-4.5,0,0,.003-8.11,.009-8.164-.63-.775-1.009-1.762-1.009-2.836,0-.133,1.183-4.568,1.183-4.568C1.912,1.56,4.024,0,6.454,0h11.092c2.43,0,4.542,1.56,5.257,3.882l.604,2.227c.216,.8-.257,1.623-1.057,1.84-.799,.212-1.624-.257-1.84-1.057l-.589-2.177c-.311-1.006-1.271-1.715-2.375-1.715h-.546v.5c0,.828-.672,1.5-1.5,1.5s-1.5-.672-1.5-1.5v-.5h-4v.5c0,.828-.672,1.5-1.5,1.5s-1.5-.672-1.5-1.5v-.5h-.546c-1.104,0-2.064,.709-2.39,1.765l-1.056,3.901c.083,.749,.72,1.334,1.491,1.334h1c.827,0,1.5-.673,1.5-1.5s.672-1.5,1.5-1.5,1.5,.672,1.5,1.5c0,.635,.402,1.203,1,1.415,.781,.276,1.19,1.133,.914,1.914Zm12.086,6.171v3c0,1.657-1.343,3-3,3h-5c-1.657,0-3-1.343-3-3v-3c0-.888,.386-1.686,1-2.235v-2.265c0-2.481,2.019-4.5,4.5-4.5s4.5,2.019,4.5,4.5v2.265c.614,.549,1,1.347,1,2.235Zm-4,1.5c0-.828-.672-1.5-1.5-1.5s-1.5,.672-1.5,1.5,.672,1.5,1.5,1.5,1.5-.672,1.5-1.5Zm0-6c0-.827-.673-1.5-1.5-1.5s-1.5,.673-1.5,1.5v1.5h3v-1.5Z" />
              </svg>
              <!-- <svg class="cart-outline">
                <use xlink:href="#cart-outline" />
              </svg> -->
            </div>
            <div class="icon-box-content">
              <h6 class="card-title  text-dark">Secured Payment </h6>
              <p class='justify'>Enjoy peace of mind with our robust secured payment system, ensuring your transactions are safe and
                secure</p>
            </div>
          </div>
        </div>
        <div class="col-lg-2 col-md-6 pb-3">
          <div class="icon-box text-center">
            <div class="icon-box-icon pe-3 pb-3">

              <svg xmlns="http://www.w3.org/2000/svg" id="Isolation_Mode" data-name="Isolation Mode" viewBox="0 0 24 24" width="512" height="512">
                <path d="M11.16,11.693,9.4,9.866,7.24,11.945l2.2,2.287a2.363,2.363,0,0,0,1.674.74h.037a2.368,2.368,0,0,0,1.662-.688l5.021-5.023L15.712,7.141Z" />
                <path d="M11.922,24l-.531-.237C11.007,23.589,2,19.5,2,12V5.525A3,3,0,0,1,4.052,2.679L12,.03l7.949,2.65A2.994,2.994,0,0,1,22,5.525V12c0,8.539-9.137,11.682-9.526,11.812ZM12,3.192,5,5.525V12c0,4.67,5.344,7.847,7.077,8.753C13.819,20.026,19,17.408,19,12V5.525Z" />
              </svg>
              <!-- <svg class="quality">
                <use xlink:href="#quality" />
              </svg> -->
            </div>
            <div class="icon-box-content">
              <h6 class="card-title  text-dark">Quality Assurance</h6>
              <p  class='justify'>Our commitment to quality guarantees that every product you receive meets the highest standards of
                excellence</p>
            </div>
          </div>
        </div>
        <div class="col-lg-2 col-md-6 pb-3">
          <div class="icon-box text-center">
            <div class="icon-box-icon pe-3 pb-3">
              <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24" width="512" height="512">
                <path d="M17.42,13.41l-2.91,2.91-1.41-1.41,1.9-1.9h-6l1.91,1.9-1.41,1.41-2.91-2.91c-.77-.78-.77-2.04,0-2.81l2.92-2.92,1.41,1.41-1.91,1.91h6l-1.92-1.91,1.41-1.41,2.92,2.92c.77,.78,.77,2.04,0,2.81ZM5,5c1.38,0,2.5-1.12,2.5-2.5S6.38,0,5,0,2.5,1.12,2.5,2.5s1.12,2.5,2.5,2.5Zm.17,4.17l2.95-2.95c-.35-.14-.73-.22-1.13-.22H3c-1.66,0-3,1.34-3,3v8H2v7h2v-7h2v7h2v-6.35l-2.83-2.83c-1.56-1.56-1.56-4.09,0-5.65Zm13.83-4.17c1.38,0,2.5-1.12,2.5-2.5s-1.12-2.5-2.5-2.5-2.5,1.12-2.5,2.5,1.12,2.5,2.5,2.5Zm2,1h-4c-.4,0-.78,.08-1.13,.22l2.95,2.95c1.56,1.56,1.56,4.09,0,5.65l-2.83,2.83v6.35h2v-7h2v7h2v-7h2V9c0-1.66-1.34-3-3-3Z" />
              </svg>
              <!-- <svg class="price-tag">
                <use xlink:href="#price-tag" />
              </svg> -->
            </div>
            <div class="icon-box-content">
              <h6 class="card-title  text-dark">Dispatch Responsibility</h6>
              <p  class='justify'>Relax as we take on the responsibility of timely and efficient dispatch, ensuring your orders reach you promptly.</p>
            </div>
          </div>
        </div>
        <div class="col-lg-2 col-md-6 pb-3">
          <div class="icon-box text-center">
            <div class="icon-box-icon pe-3 pb-3">
              <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24">
                <path d="m17.5,7.5c.256,0,.512-.098.707-.293l.629-.629c.495.269,1.062.422,1.664.422,1.93,0,3.5-1.57,3.5-3.5s-1.57-3.5-3.5-3.5-3.5,1.57-3.5,3.5c0,.602.153,1.169.422,1.664l-.629.629c-.391.391-.391,1.023,0,1.414.195.195.451.293.707.293Zm3-5.5c.827,0,1.5.673,1.5,1.5s-.673,1.5-1.5,1.5-1.5-.672-1.5-1.5.673-1.5,1.5-1.5Zm0,15c-.602,0-1.169.153-1.664.422l-.629-.629c-.391-.391-1.023-.391-1.414,0s-.391,1.023,0,1.414l.629.629c-.269.495-.422,1.062-.422,1.664,0,1.93,1.57,3.5,3.5,3.5s3.5-1.57,3.5-3.5-1.57-3.5-3.5-3.5Zm0,5c-.827,0-1.5-.673-1.5-1.5s.672-1.5,1.5-1.5,1.5.673,1.5,1.5-.673,1.5-1.5,1.5ZM6.578,5.164c.269-.495.422-1.062.422-1.664,0-1.93-1.57-3.5-3.5-3.5S0,1.57,0,3.5s1.57,3.5,3.5,3.5c.602,0,1.169-.153,1.664-.422l.629.629c.195.195.451.293.707.293s.512-.098.707-.293c.391-.391.391-1.023,0-1.414l-.629-.629Zm-3.078-.164c-.827,0-1.5-.673-1.5-1.5s.673-1.5,1.5-1.5,1.5.673,1.5,1.5-.672,1.5-1.5,1.5Zm2.293,11.793l-.629.629c-.495-.269-1.062-.422-1.664-.422-1.93,0-3.5,1.57-3.5,3.5s1.57,3.5,3.5,3.5,3.5-1.57,3.5-3.5c0-.602-.153-1.169-.422-1.664l.629-.629c.391-.391.391-1.023,0-1.414s-1.023-.391-1.414,0Zm-2.293,5.207c-.827,0-1.5-.673-1.5-1.5s.673-1.5,1.5-1.5,1.5.672,1.5,1.5-.673,1.5-1.5,1.5Zm6.5-12c0,.378.271.698.644.76l3.041.507c1.342.223,2.315,1.373,2.315,2.733,0,1.654-1.346,3-3,3v1c0,.552-.447,1-1,1s-1-.448-1-1v-1.002h-.27c-1.066,0-2.061-.574-2.596-1.496-.277-.478-.114-1.09.364-1.367.477-.276,1.089-.113,1.366.364.179.308.51.499.866.499l2.27.002c.551,0,.999-.449.999-1,0-.378-.271-.698-.644-.76l-3.041-.507c-1.342-.223-2.315-1.373-2.315-2.733,0-1.654,1.346-3,3-3v-1c0-.552.447-1,1-1s1,.448,1,1v1.003h.271c1.063,0,2.058.573,2.594,1.495.278.477.116,1.089-.361,1.367-.478.278-1.09.115-1.367-.362-.183-.312-.506-.5-.866-.5l-2.271-.003c-.551,0-.999.449-.999,1Z" />
              </svg> <!-- <svg class="shield-plus">
                <use xlink:href="#shield-plus" />
              </svg> -->
            </div>
            <div class="icon-box-content">
              <h6 class="card-title  text-dark">Direct Sourcing</h6>
              <p  class='justify'>Cut out the middleman – benefit from direct sourcing (cost-effective products)
              </p>
            </div>
          </div>
        </div>
        <div class="col-lg-2 col-md-6 pb-3">
          <div class="icon-box text-center">
            <div class="icon-box-icon pe-3 pb-3">
              <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24" width="512" height="512">
                <path d="M24,15.87l-3.51,3.51c-.4,.4-.92,.62-1.49,.62s-1.09-.22-1.49-.62l-3.48-3.48,1.41-1.41,2.55,2.55V7c0-.55-.45-1-1-1h-6.3l-2-2h8.3c1.65,0,3,1.35,3,3v10.04l2.59-2.59,1.41,1.41Zm-17,2.13c-.55,0-1-.45-1-1V6.96l2.55,2.55,1.41-1.41-3.48-3.48c-.79-.79-2.18-.79-2.97,0L0,8.13l1.41,1.41,2.59-2.59v10.04c0,1.65,1.35,3,3,3H15.3l-2-2H7Z" />
              </svg> <!-- <svg class="shield-plus">
                <use xlink:href="#shield-plus" />
              </svg> -->
            </div>
            <div class="icon-box-content">
              <h6 class="card-title  text-dark">Replacement Management</h6>
              <p  class='justify'>Hassle-free shopping with our replacement management. Ensuring your satisfaction is our top priority </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section id="mobile-products" class="product-store position-relative padding-small no-padding-top">
    <div class="container">
      <div class="row">
        <div class="display-header d-flex justify-content-between pb-3">
          <h3 class="display-7 text-dark ">Electronic</h3>
          <!-- <div class="btn-right">
            <a href="https://bsnmart.com/application/login" class="btn btn-medium btn-normal text-uppercase">Go to Shop</a>
          </div> -->
        </div>

        <div class="swiper product-swiper">
          <div class="swiper-wrapper">
            <div class="swiper-slide">
              <div class="product-card position-relative">
                <div class="image-holder">
                  <img src="images/Electronic/led_tv.png" alt="product-item" class="img-fluid2">
                </div>
                <div class="cart-concern position-absolute">
                  <div class="cart-button d-flex">
                    <a href="https://bsnmart.com/application/login" class="btn  btn-purple">View More<svg class="cart-outline">
                        <use xlink:href="#cart-outline"></use>
                      </svg></a>
                  </div>
                </div>
                <div class="card-detail d-flex justify-content-center align-items-baseline pt-3">
                  <h6 class="card-title text-uppercase">
                    <a href="https://bsnmart.com/application/login">Led Tv</a>
                  </h6>
                </div>
              </div>
            </div>
            <div class="swiper-slide">
              <div class="product-card position-relative">
                <div class="image-holder">
                  <img src="images/Electronic/car_androids.png" alt="product-item" class="img-fluid2">
                </div>
                <div class="cart-concern position-absolute">
                  <div class="cart-button d-flex">
                    <a href="https://bsnmart.com/application/login" class="btn  btn-purple">View More<svg class="cart-outline">
                        <use xlink:href="#cart-outline"></use>
                      </svg></a>
                  </div>
                </div>
                <div class="card-detail d-flex justify-content-center align-items-baseline pt-3">
                  <h6 class="card-title text-uppercase">
                    <a href="https://bsnmart.com/application/login">Car Androids</a>
                  </h6>
                </div>
              </div>
            </div>

            <div class="swiper-slide">
              <div class="product-card position-relative">
                <div class="image-holder">
                  <img src="images/Electronic/towers.png" alt="product-item" class="img-fluid2">
                </div>
                <div class="cart-concern position-absolute">
                  <div class="cart-button d-flex">
                    <a href="https://bsnmart.com/application/login" class="btn  btn-purple">View More<svg class="cart-outline">
                        <use xlink:href="#cart-outline"></use>
                      </svg></a>
                  </div>
                </div>
                <div class="card-detail d-flex justify-content-center align-items-baseline pt-3">
                  <h6 class="card-title text-uppercase">
                    <a href="https://bsnmart.com/application/login">Towers Speakers</a>
                  </h6>
                </div>
              </div>
            </div>
            <div class="swiper-slide">
              <div class="product-card position-relative">
                <div class="image-holder">
                  <img src="images/Electronic/home-theaters.png" alt="product-item" class="img-fluid2">
                </div>
                <div class="cart-concern position-absolute">
                  <div class="cart-button d-flex">
                    <a href="https://bsnmart.com/application/login" class="btn  btn-purple">View More<svg class="cart-outline">
                        <use xlink:href="#cart-outline"></use>
                      </svg></a>
                  </div>
                </div>
                <div class="card-detail d-flex justify-content-center align-items-baseline pt-3">
                  <h6 class="card-title text-uppercase">
                    <a href="https://bsnmart.com/application/login">Home Theaters</a>
                  </h6>
                </div>
              </div>
            </div>
            <div class="swiper-slide">
              <div class="product-card position-relative">
                <div class="image-holder">
                  <img src="images/Electronic/speaker_wires.png" alt="product-item" class="img-fluid2">
                </div>
                <div class="cart-concern position-absolute">
                  <div class="cart-button d-flex">
                    <a href="https://bsnmart.com/application/login" class="btn  btn-purple">View More<svg class="cart-outline">
                        <use xlink:href="#cart-outline"></use>
                      </svg></a>
                  </div>
                </div>
                <div class="card-detail d-flex justify-content-center align-items-baseline pt-3">
                  <h6 class="card-title text-uppercase">
                    <a href="https://bsnmart.com/application/login">Speaker Wires</a>
                  </h6>
                </div>
              </div>
            </div>
            <div class="swiper-slide">
              <div class="product-card position-relative">
                <div class="image-holder">
                  <img src="images/Electronic/multimeters.png" alt="product-item" class="img-fluid2">
                </div>
                <div class="cart-concern position-absolute">
                  <div class="cart-button d-flex">
                    <a href="https://bsnmart.com/application/login" class="btn  btn-purple">View More<svg class="cart-outline">
                        <use xlink:href="#cart-outline"></use>
                      </svg></a>
                  </div>
                </div>
                <div class="card-detail d-flex justify-content-center align-items-baseline pt-3">
                  <h6 class="card-title text-uppercase">
                    <a href="https://bsnmart.com/application/login">MultiMeters</a>
                  </h6>
                </div>
              </div>
            </div>
            <div class="swiper-slide">
              <div class="product-card position-relative">
                <div class="image-holder">
                  <img src="images/Electronic/amplifie.png" alt="product-item" class="img-fluid2">
                </div>
                <div class="cart-concern position-absolute">
                  <div class="cart-button d-flex">
                    <a href="https://bsnmart.com/application/login" class="btn  btn-purple">View More<svg class="cart-outline">
                        <use xlink:href="#cart-outline"></use>
                      </svg></a>
                  </div>
                </div>
                <div class="card-detail d-flex justify-content-center align-items-baseline pt-3">
                  <h6 class="card-title text-uppercase">
                    <a href="https://bsnmart.com/application/login">Amplifier</a>
                  </h6>
                </div>
              </div>
            </div>
            <div class="swiper-slide">
              <div class="product-card position-relative">
                <div class="image-holder">
                  <img src="images/Electronic/audio_ics.png" alt="product-item" class="img-fluid2">
                </div>
                <div class="cart-concern position-absolute">
                  <div class="cart-button d-flex">
                    <a href="https://bsnmart.com/application/login" class="btn  btn-purple">View More<svg class="cart-outline">
                        <use xlink:href="#cart-outline"></use>
                      </svg></a>
                  </div>
                </div>
                <div class="card-detail d-flex justify-content-center align-items-baseline pt-3">
                  <h6 class="card-title text-uppercase">
                    <a href="https://bsnmart.com/application/login">Audio Ics</a>
                  </h6>

                </div>
              </div>
            </div>
            <div class="swiper-slide">
              <div class="product-card position-relative">
                <div class="image-holder">
                  <img src="images/Electronic/adopters.png" alt="product-item" class="img-fluid2">
                </div>
                <div class="cart-concern position-absolute">
                  <div class="cart-button d-flex">
                    <a href="https://bsnmart.com/application/login" class="btn  btn-purple">View More<svg class="cart-outline">
                        <use xlink:href="#cart-outline"></use>
                      </svg></a>
                  </div>
                </div>
                <div class="card-detail d-flex justify-content-center align-items-baseline pt-3">
                  <h6 class="card-title text-uppercase">
                    <a href="https://bsnmart.com/application/login">Adopters</a>
                  </h6>
                </div>
              </div>
            </div>
            <div class="swiper-slide">
              <div class="product-card position-relative">
                <div class="image-holder">
                  <img src="images/Electronic/dish_antenna.png" alt="product-item" class="img-fluid2">
                </div>
                <div class="cart-concern position-absolute">
                  <div class="cart-button d-flex">
                    <a href="https://bsnmart.com/application/login" class="btn  btn-purple">View More<svg class="cart-outline">
                        <use xlink:href="#cart-outline"></use>
                      </svg></a>
                  </div>
                </div>
                <div class="card-detail d-flex justify-content-center align-items-baseline pt-3">
                  <h6 class="card-title text-uppercase">
                    <a href="https://bsnmart.com/application/login">Dish Antenna</a>
                  </h6>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- <div class="swiper-pagination position-absolute text-center swiper-pagination-clickable swiper-pagination-bullets swiper-pagination-horizontal">
      <span class="swiper-pagination-bullet" tabindex="0" role="button" aria-label="Go to slide 1"></span><span class="swiper-pagination-bullet swiper-pagination-bullet-active" tabindex="0" role="button" aria-label="Go to slide 2" aria-current="true"></span>
    </div> -->
  </section>
  <section id="smart-watches" class="product-store  position-relative">
    <div class="container">
      <div class="row">
        <div class="display-header d-flex justify-content-between pb-3">
          <h2 class="display-7 text-dark e">Electrical</h2>
          <!-- <div class="btn-right">
            <a href="https://bsnmart.com/application/login" class="btn  btn-normal text-uppercase">Go to Shop</a>
          </div> -->
        </div>
        <div class="swiper product-watch-swiper">
          <div class="swiper-wrapper">
            <div class="swiper-slide">
              <div class="product-card position-relative">
                <div class="image-holder">
                  <img src="images/Electricals/dc-bulbs.png" alt="product-item" class="img-fluid2">
                </div>
                <div class="cart-concern position-absolute">
                  <div class="cart-button d-flex">
                    <a href="https://bsnmart.com/application/login" class="btn  btn-purple">View More<svg class="cart-outline">
                        <use xlink:href="#cart-outline"></use>
                      </svg></a>
                  </div>
                </div>
                <div class="card-detail d-flex justify-content-center align-items-baseline pt-3">
                  <h6 class="card-title text-uppercase">
                    <a href="https://bsnmart.com/application/login">DC Bulbs</a>
                  </h6>
                </div>
              </div>
            </div>
            <div class="swiper-slide">
              <div class="product-card position-relative">
                <div class="image-holder">
                  <img src="images/Electricals/strip-lights.png" alt="product-item" class="img-fluid2">
                </div>
                <div class="cart-concern position-absolute">
                  <div class="cart-button d-flex">
                    <a href="https://bsnmart.com/application/login" class="btn  btn-purple">View More<svg class="cart-outline">
                        <use xlink:href="#cart-outline"></use>
                      </svg></a>
                  </div>
                </div>
                <div class="card-detail d-flex justify-content-center align-items-baseline pt-3">
                  <h6 class="card-title text-uppercase">
                    <a href="https://bsnmart.com/application/login">Led Strip Lights</a>
                  </h6>
                </div>
              </div>
            </div>
            <div class="swiper-slide">
              <div class="product-card position-relative">
                <div class="image-holder">
                  <img src="images/socket.png" alt="product-item" class="img-fluid2">
                </div>
                <div class="cart-concern position-absolute">
                  <div class="cart-button d-flex">
                    <a href="https://bsnmart.com/application/login" class="btn  btn-purple">View More<svg class="cart-outline">
                        <use xlink:href="#cart-outline"></use>
                      </svg></a>
                  </div>
                </div>
                <div class="card-detail d-flex justify-content-center pt-3">
                  <h6 class="card-title text-uppercase">
                    <a href="https://bsnmart.com/application/login">Socket</a>
                  </h6>
                </div>
              </div>
            </div>
            <div class="swiper-slide">
              <div class="product-card position-relative">
                <div class="image-holder">
                  <img src="images/Electricals/electrical-wires.png" alt="product-item" class="img-fluid2">
                </div>
                <div class="cart-concern position-absolute">
                  <div class="cart-button d-flex">
                    <a href="https://bsnmart.com/application/login" class="btn  btn-purple">View More<svg class="cart-outline">
                        <use xlink:href="#cart-outline"></use>
                      </svg></a>
                  </div>
                </div>
                <div class="card-detail d-flex justify-content-center align-items-baseline pt-3">
                  <h6 class="card-title text-uppercase">
                    <a href="https://bsnmart.com/application/login">Electrical Wires</a>
                  </h6>
                </div>
              </div>
            </div>
            <div class="swiper-slide">
              <div class="product-card position-relative">
                <div class="image-holder">
                  <img src="images/Electricals/gang-boxes.png" alt="product-item" class="img-fluid2">
                </div>
                <div class="cart-concern position-absolute">
                  <div class="cart-button d-flex">
                    <a href="https://bsnmart.com/application/login" class="btn  btn-purple">View More<svg class="cart-outline">
                        <use xlink:href="#cart-outline"></use>
                      </svg></a>
                  </div>
                </div>
                <div class="card-detail d-flex justify-content-center align-items-baseline pt-3">
                  <h6 class="card-title text-uppercase">
                    <a href="https://bsnmart.com/application/login">Gang Boxes</a>
                  </h6>

                </div>
              </div>
            </div>
            <div class="swiper-slide">
              <div class="product-card position-relative">
                <div class="image-holder">
                  <img src="images/Electricals/led-bulbs.png" alt="product-item" class="img-fluid2">
                </div>
                <div class="cart-concern position-absolute">
                  <div class="cart-button d-flex">
                    <a href="https://bsnmart.com/application/login" class="btn  btn-purple">View More<svg class="cart-outline">
                        <use xlink:href="#cart-outline"></use>
                      </svg></a>
                  </div>
                </div>
                <div class="card-detail d-flex justify-content-center align-items-baseline pt-3">
                  <h6 class="card-title text-uppercase">
                    <a href="https://bsnmart.com/application/login">LED Bulbs</a>
                  </h6>
                </div>
              </div>
            </div>
            <div class="swiper-slide">
              <div class="product-card position-relative">
                <div class="image-holder">
                  <img src="images/Electricals/mcb.png" alt="product-item" class="img-fluid2">
                </div>
                <div class="cart-concern position-absolute">
                  <div class="cart-button d-flex">
                    <a href="https://bsnmart.com/application/login" class="btn  btn-purple">View More<svg class="cart-outline">
                        <use xlink:href="#cart-outline"></use>
                      </svg></a>
                  </div>
                </div>
                <div class="card-detail d-flex justify-content-center align-items-baseline pt-3">
                  <h6 class="card-title text-uppercase">
                    <a href="https://bsnmart.com/application/login">Mcb</a>
                  </h6>
                </div>
              </div>
            </div>
            <div class="swiper-slide">
              <div class="product-card position-relative">
                <div class="image-holder">
                  <img src="images/Electricals/flexible-pipes.png" alt="product-item" class="img-fluid2">
                </div>
                <div class="cart-concern position-absolute">
                  <div class="cart-button d-flex">
                    <a href="https://bsnmart.com/application/login" class="btn  btn-purple">View More<svg class="cart-outline">
                        <use xlink:href="#cart-outline"></use>
                      </svg></a>
                  </div>
                </div>
                <div class="card-detail d-flex justify-content-center align-items-baseline pt-3">
                  <h6 class="card-title text-uppercase">
                    <a href="https://bsnmart.com/application/login">Flexible Pipes</a>
                  </h6>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- <div class="swiper-pagination position-absolute text-center"></div> -->
  </section>
  <section id="yearly-sale" class="bg-light-blue overflow-hidden mt-5 ">
    <div class="row d-flex flex-wrap align-items-center">
      <div class="col-md-6 col-sm-12 p-3">
        <div class="text-content offset-2 padding-medium">
          <h3 class="h3-font text-dark">Our Product Portfolio</h3>
          <ul>
            <li class="h5-font">-Precision</li>
            <li class="h5-font">-Innovation</li>
            <li class="h5-font">-Reliability</li>
          </ul>
          <a href="https://bsnmart.com/application/login" class="btn  btn-purple text-uppercase btn-rounded-none ">Search Product</a>
        </div>
      </div>
      <div class="col-md-6 col-sm-12">
        <img src="images/ourproduct.png" class="img-fluid" alt="">
      </div>
    </div>
  </section>
  <section id="mobile-products" class="product-store position-relative padding-small no-padding-top">
    <div class="container padding-small">
      <div class="row">
        <div class="display-header d-flex justify-content-between pb-3">
          <h2 class="display-7 text-dark ">Home Appliances</h2>
          <!-- <div class="btn-right">
            <a href="https://bsnmart.com/application/login" class="btn  btn-normal text-uppercase">Go to Shop</a>
          </div> -->
        </div>
        <div class="swiper product-swiper">
          <div class="swiper-wrapper">
            <div class="swiper-slide">
              <div class="product-card position-relative">
                <div class="image-holder">
                  <img src="images/Home Appliances/coolers.png" alt="product-item" class="img-fluid2">
                </div>
                <div class="cart-concern position-absolute">
                  <div class="cart-button d-flex">
                    <a href="https://bsnmart.com/application/login" class="btn  btn-purple">View More<svg class="cart-outline">
                        <use xlink:href="#cart-outline"></use>
                      </svg></a>
                  </div>
                </div>
                <div class="card-detail d-flex justify-content-center align-items-baseline pt-3">
                  <h6 class="card-title text-uppercase">
                    <a href="https://bsnmart.com/application/login">Coolers</a>
                  </h6>
                  <!-- <span class="item-price text-primary">$980</span> -->
                </div>
              </div>
            </div>
            <div class="swiper-slide">
              <div class="product-card position-relative">
                <div class="image-holder">
                  <img src="images/Home Appliances/fan_heaters.png" alt="product-item" class="img-fluid2">
                </div>
                <div class="cart-concern position-absolute">
                  <div class="cart-button d-flex">
                    <a href="https://bsnmart.com/application/login" class="btn  btn-purple">View More<svg class="cart-outline">
                        <use xlink:href="#cart-outline"></use>
                      </svg></a>
                  </div>
                </div>
                <div class="card-detail d-flex justify-content-center align-items-baseline pt-3">
                  <h6 class="card-title text-uppercase">
                    <a href="https://bsnmart.com/application/login">Fan Heaters</a>
                  </h6>
                  <!-- <span class="item-price text-primary">$980</span> -->
                </div>
              </div>
            </div>
            <div class="swiper-slide">
              <div class="product-card position-relative">
                <div class="image-holder">
                  <img src="images/Home Appliances/fan.png" alt="product-item" class="img-fluid2">
                </div>
                <div class="cart-concern position-absolute">
                  <div class="cart-button d-flex">
                    <a href="https://bsnmart.com/application/login" class="btn  btn-purple">View More<svg class="cart-outline">
                        <use xlink:href="#cart-outline"></use>
                      </svg></a>
                  </div>
                </div>
                <div class="card-detail d-flex justify-content-center align-items-baseline pt-3">
                  <h6 class="card-title text-uppercase">
                    <a href="https://bsnmart.com/application/login">Fans</a>
                  </h6>
                  <!-- <span class="item-price text-primary">$1100</span> -->
                </div>
              </div>
            </div>

            <div class="swiper-slide">
              <div class="product-card position-relative">
                <div class="image-holder">
                  <img src="images/Home Appliances/farrata_fans.png" alt="product-item" class="img-fluid2">
                </div>
                <div class="cart-concern position-absolute">
                  <div class="cart-button d-flex">
                    <a href="https://bsnmart.com/application/login" class="btn  btn-purple">View More<svg class="cart-outline">
                        <use xlink:href="#cart-outline"></use>
                      </svg></a>
                  </div>
                </div>
                <div class="card-detail d-flex justify-content-center align-items-baseline pt-3">
                  <h6 class="card-title text-uppercase">
                    <a href="https://bsnmart.com/application/login">Farrata Fans</a>
                  </h6>
                  <!-- <span class="item-price text-primary">$1100</span> -->
                </div>
              </div>
            </div>
            <div class="swiper-slide">
              <div class="product-card position-relative">
                <div class="image-holder">
                  <img src="images/Home Appliances/geasers.png" alt="product-item" class="img-fluid2">
                </div>
                <div class="cart-concern position-absolute">
                  <div class="cart-button d-flex">
                    <a href="https://bsnmart.com/application/login" class="btn  btn-purple">View More<svg class="cart-outline">
                        <use xlink:href="#cart-outline"></use>
                      </svg></a>
                  </div>
                </div>
                <div class="card-detail d-flex justify-content-center align-items-baseline pt-3">
                  <h6 class="card-title text-uppercase">
                    <a href="https://bsnmart.com/application/login">Geasers</a>
                  </h6>
                  <!-- <span class="item-price text-primary">$780</span> -->
                </div>
              </div>
            </div>
            <div class="swiper-slide">
              <div class="product-card position-relative">
                <div class="image-holder">
                  <img src="images/Home Appliances/induction_cooktops.png" alt="product-item" class="img-fluid2">
                </div>
                <div class="cart-concern position-absolute">
                  <div class="cart-button d-flex">
                    <a href="https://bsnmart.com/application/login" class="btn  btn-purple">View More<svg class="cart-outline">
                        <use xlink:href="#cart-outline"></use>
                      </svg></a>
                  </div>
                </div>
                <div class="card-detail d-flex justify-content-center align-items-baseline pt-3">
                  <h6 class="card-title text-uppercase">
                    <a href="https://bsnmart.com/application/login">Induction Cooktops</a>
                  </h6>
                  <!-- <span class="item-price text-primary">$1500</span> -->
                </div>
              </div>
            </div>
            <div class="swiper-slide">
              <div class="product-card position-relative">
                <div class="image-holder">
                  <img src="images/Home Appliances/toasters.png" alt="product-item" class="img-fluid2">
                </div>
                <div class="cart-concern position-absolute">
                  <div class="cart-button d-flex">
                    <a href="https://bsnmart.com/application/login" class="btn  btn-purple">View More<svg class="cart-outline">
                        <use xlink:href="#cart-outline"></use>
                      </svg></a>
                  </div>
                </div>
                <div class="card-detail d-flex justify-content-center align-items-baseline pt-3">
                  <h6 class="card-title text-uppercase">
                    <a href="https://bsnmart.com/application/login">Toasters</a>
                  </h6>
                  <!-- <span class="item-price text-primary">$1100</span> -->
                </div>
              </div>
            </div>
            <div class="swiper-slide">
              <div class="product-card position-relative">
                <div class="image-holder">
                  <img src="images/Home Appliances/induction_grill.png" alt="product-item" class="img-fluid2">
                </div>
                <div class="cart-concern position-absolute">
                  <div class="cart-button d-flex">
                    <a href="https://bsnmart.com/application/login" class="btn  btn-purple">View More<svg class="cart-outline">
                        <use xlink:href="#cart-outline"></use>
                      </svg></a>
                  </div>
                </div>
                <div class="card-detail d-flex justify-content-center align-items-baseline pt-3">
                  <h6 class="card-title text-uppercase">
                    <a href="https://bsnmart.com/application/login">Induction Grill</a>
                  </h6>
                  <!-- <span class="item-price text-primary">$1300</span> -->
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- <div class="swiper-pagination position-absolute text-center"></div> -->
  </section>
  <section id="mobile-products" class="product-store position-relative  no-padding-top">
    <div class="container ">
      <div class="row">
        <div class="display-header d-flex justify-content-between pb-3">
          <h2 class="display-7 text-dark">Mobile Accesories</h2>
          <!-- <div class="btn-right">
            <a href="https://bsnmart.com/application/login" class="btn  btn-normal text-uppercase">Go to Shop</a>
          </div> -->
        </div>
        <div class="swiper product-swiper">
          <div class="swiper-wrapper">
            <div class="swiper-slide">
              <div class="product-card position-relative">
                <div class="image-holder">
                  <img src="images/Mobile Accesories/earpods.png" alt="product-item" class="img-fluid2">
                </div>
                <div class="cart-concern position-absolute">
                  <div class="cart-button d-flex">
                    <a href="https://bsnmart.com/application/login" class="btn  btn-purple">View More<svg class="cart-outline">
                        <use xlink:href="#cart-outline"></use>
                      </svg></a>
                  </div>
                </div>
                <div class="card-detail d-flex justify-content-center align-items-baseline pt-3">
                  <h6 class="card-title text-uppercase">
                    <a href="https://bsnmart.com/application/login">EarPods</a>
                  </h6>
                  <!-- <span class="item-price text-primary">$980</span> -->
                </div>
              </div>
            </div>
            <div class="swiper-slide">
              <div class="product-card position-relative">
                <div class="image-holder">
                  <img src="images/Mobile Accesories/mobile-charger.png" alt="product-item" class="img-fluid2">
                </div>
                <div class="cart-concern position-absolute">
                  <div class="cart-button d-flex">
                    <a href="https://bsnmart.com/application/login" class="btn  btn-purple">View More<svg class="cart-outline">
                        <use xlink:href="#cart-outline"></use>
                      </svg></a>
                  </div>
                </div>
                <div class="card-detail d-flex justify-content-center align-items-baseline pt-3">
                  <h6 class="card-title text-uppercase">
                    <a href="https://bsnmart.com/application/login">Mobile Charger</a>
                  </h6>
                  <!-- <span class="item-price text-primary">$1100</span> -->
                </div>
              </div>
            </div>
            <div class="swiper-slide">
              <div class="product-card position-relative">
                <div class="image-holder">
                  <img src="images/Mobile Accesories/mobile_cover.png" alt="product-item" class="img-fluid2">
                </div>
                <div class="cart-concern position-absolute">
                  <div class="cart-button d-flex">
                    <a href="https://bsnmart.com/application/login" class="btn  btn-purple">View More<svg class="cart-outline">
                        <use xlink:href="#cart-outline"></use>
                      </svg></a>
                  </div>
                </div>
                <div class="card-detail d-flex justify-content-center align-items-baseline pt-3">
                  <h6 class="card-title text-uppercase">
                    <a href="https://bsnmart.com/application/login">Mobile Cover</a>
                  </h6>
                  <!-- <span class="item-price text-primary">$780</span> -->
                </div>
              </div>
            </div>
            <div class="swiper-slide">
              <div class="product-card position-relative">
                <div class="image-holder">
                  <img src="images/Mobile Accesories/mobile_stand.png" alt="product-item" class="img-fluid2">
                </div>
                <div class="cart-concern position-absolute">
                  <div class="cart-button d-flex">
                    <a href="https://bsnmart.com/application/login" class="btn  btn-purple">View More<svg class="cart-outline">
                        <use xlink:href="#cart-outline"></use>
                      </svg></a>
                  </div>
                </div>
                <div class="card-detail d-flex justify-content-center align-items-baseline pt-3">
                  <h6 class="card-title text-uppercase">
                    <a href="https://bsnmart.com/application/login">Mobile Stand</a>
                  </h6>
                </div>
              </div>
            </div>
            <div class="swiper-slide">
              <div class="product-card position-relative">
                <div class="image-holder">
                  <img src="images/Mobile Accesories/tempered_glass.png" alt="product-item" class="img-fluid2">
                </div>
                <div class="cart-concern position-absolute">
                  <div class="cart-button d-flex">
                    <a href="https://bsnmart.com/application/login" class="btn  btn-purple">View More<svg class="cart-outline">
                        <use xlink:href="#cart-outline"></use>
                      </svg></a>
                  </div>
                </div>
                <div class="card-detail d-flex justify-content-center align-items-baseline pt-3">
                  <h6 class="card-title text-uppercase">
                    <a href="https://bsnmart.com/application/login">Tempered Glass</a>
                  </h6>
                  <!-- <span class="item-price text-primary">$1300</span> -->
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- <div class="swiper-pagination position-absolute text-center"></div> -->
  </section>
  <section id="mobile-products" class="product-store position-relative  no-padding-top">
    <div class="container ">
      <div class="row">
        <div class="display-header d-flex justify-content-between pb-3">
          <h2 class="display-7 text-dark ">Kids and Gift Items</h2>
        </div>
        <div class="swiper product-swiper">
          <div class="swiper-wrapper">
            <div class="swiper-slide">
              <div class="product-card position-relative">
                <div class="image-holder">
                  <img src="images/Kids and Gift Items/baby_chairs.png" alt="product-item" class="img-fluid2">
                </div>
                <div class="cart-concern position-absolute">
                  <div class="cart-button d-flex">
                    <a href="https://bsnmart.com/application/login" class="btn  btn-purple">View More<svg class="cart-outline">
                        <use xlink:href="#cart-outline"></use>
                      </svg></a>
                  </div>
                </div>
                <div class="card-detail d-flex justify-content-center align-items-baseline pt-3">
                  <h6 class="card-title text-uppercase">
                    <a href="https://bsnmart.com/application/login">Baby Chairs</a>
                  </h6>
                  <!-- <span class="item-price text-primary">$980</span> -->
                </div>
              </div>
            </div>
            <div class="swiper-slide">
              <div class="product-card position-relative">
                <div class="image-holder">
                  <img src="images/Kids and Gift Items/ball_pool.png" alt="product-item" class="img-fluid2">
                </div>
                <div class="cart-concern position-absolute">
                  <div class="cart-button d-flex">
                    <a href="https://bsnmart.com/application/login" class="btn  btn-purple">View More<svg class="cart-outline">
                        <use xlink:href="#cart-outline"></use>
                      </svg></a>
                  </div>
                </div>
                <div class="card-detail d-flex justify-content-center align-items-baseline pt-3">
                  <h6 class="card-title text-uppercase">
                    <a href="https://bsnmart.com/application/login">Ball Pools</a>
                  </h6>
                  <!-- <span class="item-price text-primary">$1100</span> -->
                </div>
              </div>
            </div>
            <div class="swiper-slide">
              <div class="product-card position-relative">
                <div class="image-holder">
                  <img src="images/Kids and Gift Items/sports_kits.png" alt="product-item" class="img-fluid2">
                </div>
                <div class="cart-concern position-absolute">
                  <div class="cart-button d-flex">
                    <a href="https://bsnmart.com/application/login" class="btn  btn-purple">View More<svg class="cart-outline">
                        <use xlink:href="#cart-outline"></use>
                      </svg></a>
                  </div>
                </div>
                <div class="card-detail d-flex justify-content-center align-items-baseline pt-3">
                  <h6 class="card-title text-uppercase">
                    <a href="https://bsnmart.com/application/login">Sports Kits</a>
                  </h6>
                  <!-- <span class="item-price text-primary">$1100</span> -->
                </div>
              </div>
            </div>
            <div class="swiper-slide">
              <div class="product-card position-relative">
                <div class="image-holder">
                  <img src="images/Kids and Gift Items/indoor_games_for_kids.png" alt="product-item" class="img-fluid2">
                </div>
                <div class="cart-concern position-absolute">
                  <div class="cart-button d-flex">
                    <a href="https://bsnmart.com/application/login" class="btn  btn-purple">View More<svg class="cart-outline">
                        <use xlink:href="#cart-outline"></use>
                      </svg></a>
                  </div>
                </div>
                <div class="card-detail d-flex justify-content-center align-items-baseline pt-3">
                  <h6 class="card-title text-uppercase">
                    <a href="https://bsnmart.com/application/login">Indoor Games for Kids</a>
                  </h6>
                  <!-- <span class="item-price text-primary">$1100</span> -->
                </div>
              </div>
            </div>
            <div class="swiper-slide">
              <div class="product-card position-relative">
                <div class="image-holder">
                  <img src="images/Kids and Gift Items/flying_toys.png" alt="product-item" class="img-fluid2">
                </div>
                <div class="cart-concern position-absolute">
                  <div class="cart-button d-flex">
                    <a href="https://bsnmart.com/application/login" class="btn  btn-purple">View More<svg class="cart-outline">
                        <use xlink:href="#cart-outline"></use>
                      </svg></a>
                  </div>
                </div>
                <div class="card-detail d-flex justify-content-center align-items-baseline pt-3">
                  <h6 class="card-title text-uppercase">
                    <a href="https://bsnmart.com/application/login">Flying Toys</a>
                  </h6>
                  <!-- <span class="item-price text-primary">$1100</span> -->
                </div>
              </div>
            </div>
            <div class="swiper-slide">
              <div class="product-card position-relative">
                <div class="image-holder">
                  <img src="images/Kids and Gift Items/battery_cars.png" alt="product-item" class="img-fluid2">
                </div>
                <div class="cart-concern position-absolute">
                  <div class="cart-button d-flex">
                    <a href="https://bsnmart.com/application/login" class="btn  btn-purple">View More<svg class="cart-outline">
                        <use xlink:href="#cart-outline"></use>
                      </svg></a>
                  </div>
                </div>
                <div class="card-detail d-flex justify-content-center align-items-baseline pt-3">
                  <h6 class="card-title text-uppercase">
                    <a href="https://bsnmart.com/application/login">Battery Cars</a>
                  </h6>
                  <!-- <span class="item-price text-primary">$780</span> -->
                </div>
              </div>
            </div>
            <div class="swiper-slide">
              <div class="product-card position-relative">
                <div class="image-holder">
                  <img src="images/Kids and Gift Items/kids_cradle.png" alt="product-item" class="img-fluid2">
                </div>
                <div class="cart-concern position-absolute">
                  <div class="cart-button d-flex">
                    <a href="https://bsnmart.com/application/login" class="btn  btn-purple">View More<svg class="cart-outline">
                        <use xlink:href="#cart-outline"></use>
                      </svg></a>
                  </div>
                </div>
                <div class="card-detail d-flex justify-content-center align-items-baseline pt-3">
                  <h6 class="card-title text-uppercase">
                    <a href="https://bsnmart.com/application/login">Kids Cradles</a>
                  </h6>
                  <!-- <span class="item-price text-primary">$1500</span> -->
                </div>
              </div>
            </div>
            <div class="swiper-slide">
              <div class="product-card position-relative">
                <div class="image-holder">
                  <img src="images/Kids and Gift Items/tricycles.png" alt="product-item" class="img-fluid2">
                </div>
                <div class="cart-concern position-absolute">
                  <div class="cart-button d-flex">
                    <a href="https://bsnmart.com/application/login" class="btn  btn-purple">View More<svg class="cart-outline">
                        <use xlink:href="#cart-outline"></use>
                      </svg></a>
                  </div>
                </div>
                <div class="card-detail d-flex justify-content-center align-items-baseline pt-3">
                  <h6 class="card-title text-uppercase">
                    <a href="https://bsnmart.com/application/login">Tricycles</a>
                  </h6>
                  <!-- <span class="item-price text-primary">$1300</span> -->
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- <div class="swiper-pagination position-absolute text-center"></div> -->
  </section>

  <section id="subscribe" class="container-grid padding-small position-relative overflow-hidden">
    <section class=" bg-grey">
      <!-- <div class="container text-center">
        <div class="display-header d-flex justify-content-between pb-3">
          <h2 class="display-7 text-dark">Brand Associated With</h2>
         
        </div>
        <div class="row">
          <div class="col-1">
            <img src="images/bigcool.png" class="h-100 img-fluid" alt="">
          </div>
          <div class="col-1">
            <img src="images/nestgen.png" class="h-100 img-fluid" alt="">
          </div>
          <div class="col-1">
            <img src="images/jdm.png" class="h-100 img-fluid" alt="">
          </div>
          <div class="col-1">
            <img src="images/radisson.png" class="h-100 img-fluid" alt="">
          </div>
          <div class="col-1">
            <img src="images/baby_comfort.png" class="h-100 img-fluid" alt="">
          </div>
          <div class="col-1">
            <img src="images/eskot.png" class="h-100 img-fluid" alt="">
          </div>
          <div class="col-1">
            <img src="images/fenatastic.png" class="h-100 img-fluid" alt="">
          </div>
        </div>
      </div> -->
      <div class="logos">
        <div class="logos-slide">
          <img src="images/bigcool.png" />
          <img src="images/nestgen.png" />
          <img src="images/jdm.png" />
          <img src="images/radisson.png" />
          <img src="images/baby_comfort.png" />
          <img src="images/eskot.png" />
          <img src="images/fenatastic.png" />

        </div>

        <div class="logos-slide">
          <img src="images/bigcool.png" />
          <img src="images/nestgen.png" />
          <img src="images/jdm.png" />
          <img src="images/radisson.png" />
          <img src="images/baby_comfort.png" />
          <img src="images/eskot.png" />
          <img src="images/fenatastic.png" />

        </div>
      </div>
    </section>
    <!-- <div class="container-fluid">
      <div class="row">
        <div class="subscribe-content bg-dark d-flex flex-wrap justify-content-center align-items-center padding-medium">
          <div class="col-md-6 col-sm-12">
            <div class="display-header pe-3">
              <h2 class="display-7 text-uppercase text-light">Register Now</h2>
              <p>Get latest news, updates and deals directly mailed to your inbox.</p>
            </div>
          </div>
          <div class="col-md-5 col-sm-12">
            <form class="subscription-form validate">
              <div class="input-group flex-wrap">
                <input class="form-control btn-rounded-none" type="email" name="EMAIL" placeholder="Your email address here" required="">
                <button class="btn  btn-purple text-uppercase btn-rounded-none" type="submit" name="subscribe">Subscribe</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div> -->
  </section>


  <?php include 'footer.php'; ?>

  <script src="js/jquery-1.11.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.bundle.min.js"></script>
  <script type="text/javascript" src="js/plugins.js"></script>
  <script type="text/javascript" src="js/script.js"></script>
</body>

</html>