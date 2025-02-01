<!DOCTYPE html>
<html lang="{{ app()->currentLocale() }}" dir="{{ app()->currentLocale() == 'ar' ? 'rtl' : 'ltr' }}">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">



    <title>@yield('title', env('APP_NAME'))</title>


    <!-- Additional CSS Files -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/font-awesome.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/templatemo-hexashop.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/owl-carousel.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/lightbox.css') }}">
    @yield('css')

    <style>
        .item .thumb img {
            height: 350px;
            object-fit: cover
        }
        .page-links ul {
            justify-content: center;
            column-gap: 15px;
        }

        .page-links ul .page-link {
            border-radius: 0 !important;
            width: 45px;
            height: 45px;
            display: flex;
            justify-content: center;
            align-items: center;
            border-color: #2a2a2a !important;
            color: #2a2a2a;
        }

        .page-links ul .page-link:hover,.page-links ul li.active .page-link {

            color: #fff;
        }
        .item .down-content h4 a {
            color: inherit;
        }
    </style>

    @if (app()->currentLocale() == 'ar')
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap');
            body {
                direction: rtl;
                text-align: right;
                font-family: 'Cairo', sans-serif;
            }
            .header-area .main-nav .logo {
                float: right;
            }
            .header-area .main-nav .nav {
                float: left;
            }
            .header-area .main-nav .nav li a {
                letter-spacing: 0
            }
            .header-area .main-nav .nav li.submenu ul li a {
                padding-right: 20px;

            }
            .header-area .main-nav .nav li.submenu ul li a:hover {
                padding-right: 25px;
                background-color: #2a2a2a;
            }
        </style>
    @endif

    </head>

    <body>

    <!-- ***** Preloader Start ***** -->
    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
    <!-- ***** Preloader End ***** -->


    <!-- ***** Header Area Start ***** -->
    <header class="header-area header-sticky">
        <div class="container-fluid">
            <div class="row">
                <div class="col-11">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->
                        <a href="{{ route('front.index') }}" class="logo">
                            <img style="width: 230px" src="{{ asset('assets/images/MyNewLogoTrove2.png') }}">
                        </a>


                        <!-- ***** Logo End ***** -->


                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                            <li class="scroll-to-section"><a href="{{ route('front.index') }}" {{ request()->routeIs('front.index') ? 'class=active' : '' }}>{{ __('front.home') }}</a></li>
                            <li class="scroll-to-section"><a href="{{ route('front.about') }}" {{ request()->routeIs('front.about') ? 'class=active' : '' }}>{{ __('front.about') }}</a></li>
                            <li class="scroll-to-section"><a href="{{ route('front.products') }}" {{ request()->routeIs('front.products') ? 'class=active' : '' }}>{{ __('front.products') }}</a></li>

                            <li class="submenu">
                                <a href="javascript:;">{{ __('front.cat') }}</a>
                                <ul>
                                    @foreach (\App\Models\Category::all() as $item)
                                        <li><a href="{{ route('front.category', $item->id) }}">{{ $item->trans_name }}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                            <li class="scroll-to-section"><a href="{{ route('front.contact') }}" {{ request()->routeIs('front.contact') ? 'class=active' : '' }}>{{ __('front.contact') }}</a></li>


                            <li class="submenu">
                                <a href="javascript:;"><i class="fa fa-shopping-cart"></i> {{ __('front.cart') }}</a>
                                <ul style="background-color: #fff;">
                                    @php
                                    $total=0;
                                    @endphp
                                    @auth
                                        @if(Auth::user()->carts->count())
                                            @foreach (Auth::user()->carts as $cart)
                                                <li class="dropdown-item d-flex align-items-center">
                                                    <a class="pull-left me-2" href="#!">
                                                        <img width="50px" class="media-object rounded" src="{{ asset('images/'.$cart->product->image->path) }}" alt="image">
                                                    </a>
                                                    <div class="media-body" style="margin:10px;">
                                                        <div class="cart-details">
                                                            <p class="mb-1 fw-bold">{{ $cart->product->trans_name }}</p>
                                                            <p class="text-muted small">Quantity : {{ $cart->quantity }}</p>
                                                            <p class="text-muted small">Price : {{ $cart->product->price }}</p>
                                                            <p class="text-muted small">Total :{{ $cart->quantity * $cart->price }}$</p>
                                                        </div>
                                                    </div>
                                                </li>






                                                <hr class="dropdown-divider">
                                                    @php
                                                    $total += $cart->quantity * $cart->price;
                                                    @endphp
                                                    @endforeach



                                            <div class="cart-summary" style="margin:10px">
                                                <span class="mb-3">Total : </span>
                                                <span class="total-price">{{number_format($total)}} $</span>

                                                <li><a href="{{route('front.cart')}}">View Cart</a></li>
                                                <li><a href="">Checkout</a></li>

                                            </div>

{{--
                                            <span class="mb-3">Total : </span>
                                            <span class="total-price">{{number_format($total)}}</span>

                                            <div class="row">

                                                <div class="col-lg-6">
                                                    <li><a href="{{route('front.cart')}}">View Cart</a></li>
                                                </div>
                                                <div class="col-lg-6">
                                                    <li><a href="">Checkout</a></li>
                                                </div>
                                              </div> --}}




                                            {{-- <ul class="text-center cart-buttons">
                                                <li><a href="" class="btn btn-small">View Cart</a></li>
                                                <li><a href="" class="btn btn-solid">Checkout</a></li>
                                            </ul> --}}

                                        @else
                                            <li class="dropdown-item text-muted text-center">Your cart is empty</li>
                                        @endif
                                    @else
                                        <li class="dropdown-item text-muted text-center">Please log in to view your cart</li>
                                    @endauth



                                </ul>




                            </li>


                            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            @if (app()->currentLocale() != $localeCode)
                            <li class="scroll-to-section"><a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                {{ $properties['native'] }}
                            </a></li>
                            @endif



                             @endforeach


                               <!-----------Search--------------->
                                <li class="submenu">
                                    <a href="#!"><i class="fa-solid fa-magnifying-glass"></i></a>
                                    <ul class="search">

                                            <li>

                                                <form action="{{route('front.search')}}" method="get">
                                                    <input type="search" class="form-control" placeholder="Search..." name="keyword">
                                                </form>
                                            </li>


                                    </ul>
                                </li>
                                @auth


                                <!-- Nav Item - User Information -->
                                <li class="nav-item dropdown no-arrow">
                                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>

                                        {{-- يمكنك إضافة صورة الملف الشخصي هنا إذا كانت متوفرة --}}
                                        @php
                                            if(Auth::user()->image) {
                                                $src = asset('images/'.Auth::user()->image->path);
                                            } else {
                                                $src = 'https://ui-avatars.com/api/?background=random&name='.Auth::user()->name;
                                            }
                                        @endphp
                                        <img style="width: 40px;  height:38px" class="img-profile rounded-circle" src="{{ $src }}" alt="User Image">
                                    </a>
                                    <!-- Dropdown - User Information -->
                                    <div  class="dropdown-menu dropdown-menu-right shadow animated--grow-in mt-4"
                                        aria-labelledby="userDropdown">

                                        @if(Auth::check() && Auth::user()->name == 'Admin')
                                        <a class="dropdown-item" href="{{ route('admin.index') }}">
                                            <i class="fas fa-dashboard fa-sm fa-fw mr-2 text-gray-400"></i>
                                            {{__('admin.dashadmin')}}
                                        </a>
                                        @endif


                                        @if (Auth::check() && Auth::user()->name == 'Admin')
                                        <a class="dropdown-item" href="{{ route('admin.profile') }}">
                                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                            {{__('admin.profile')}}
                                        </a>
                                        @else

                                        <a class="dropdown-item" href="{{ route('front.profile') }}">
                                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                            {{__('admin.profile')}}
                                        </a>
                                        @endif
                                        {{-- <a class="dropdown-item" href="#">
                                            <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Settings
                                        </a>
                                        <a class="dropdown-item" href="#">
                                            <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Activity Log
                                        </a> --}}
                                        <div class="dropdown-divider"></div>
                                        <form action="{{ route('logout') }}" method="POST">
                                            @csrf
                                            <button class="dropdown-item">
                                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> {{ __('admin.out') }}
                                            </button>
                                        </form>
                                    </div>
                                </li>
                            @endauth

                            @if (!Auth::check())
                            <li class="border "><a href="{{route('register')}}">{{__('front.signup')}}</a></li>
                            @endif
                        </ul>
                        <a class='menu-trigger'>
                            <span>Menu</span>
                        </a>
                        <!-- ***** Menu End ***** -->
                    </nav>





                </div>
            </div>

        </div>  <!-- /.container -->

    </header>
    <!-- ***** Header Area End ***** -->

    @yield('content')

    <!-- ***** Footer Start ***** -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="first-item">
                        <div class="logo">
                            <img style="width:220px" src="{{ asset('assets/images/LogoTroveWhite.png') }}" alt="hexashop ecommerce templatemo">
                        </div>
                        <ul>
                            <li><a href="#">16501 Collins Ave, Sunny Isles Beach, FL 33160, United States</a></li>
                            <li><a href="#">TroveShop@company.com</a></li>
                            <li><a href="#">010-020-0340</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3">
                    <h4>Shopping &amp; Categories</h4>
                    <ul>
                        <li><a href="#">Men’s Shopping</a></li>
                        <li><a href="#">Women’s Shopping</a></li>
                        <li><a href="#">Kid's Shopping</a></li>
                    </ul>
                </div>
                <div class="col-lg-3">
                    <h4>Useful Links</h4>
                    <ul>
                        <li><a href="#">Homepage</a></li>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Help</a></li>
                        <li><a href="#">Contact Us</a></li>
                    </ul>
                </div>
                <div class="col-lg-3">
                    <h4>Help &amp; Information</h4>
                    <ul>
                        <li><a href="#">Help</a></li>
                        <li><a href="#">FAQ's</a></li>
                        <li><a href="#">Shipping</a></li>
                        <li><a href="#">Tracking ID</a></li>
                    </ul>
                </div>
                <div class="col-lg-12">
                    <div class="under-footer">
                        <p>Copyright © 2025 TroveShop Co., Ltd. All Rights Reserved.

                        <ul>
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="#"><i class="fa fa-behance"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>


    <!-- jQuery -->
    <script src="{{ asset('assets/js/jquery-2.1.0.min.js') }}"></script>

    <!-- Bootstrap -->
    <script src="{{ asset('assets/js/popper.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>

    <!-- Plugins -->
    <script src="{{ asset('assets/js/owl-carousel.js') }}"></script>
    <script src="{{ asset('assets/js/accordions.js') }}"></script>
    <script src="{{ asset('assets/js/datepicker.js') }}"></script>
    <script src="{{ asset('assets/js/scrollreveal.min.js') }}"></script>
    <script src="{{ asset('assets/js/waypoints.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('assets/js/imgfix.min.js') }}"></script>
    <script src="{{ asset('assets/js/slick.js') }}"></script>
    <script src="{{ asset('assets/js/lightbox.js') }}"></script>
    <script src="{{ asset('assets/js/isotope.js') }}"></script>

    <!-- Global Init -->
    <script src="{{ asset('assets/js/custom.js') }}"></script>

    <script>

        $(function() {
            var selectedClass = "";
            $("p").click(function(){
            selectedClass = $(this).attr("data-rel");
            $("#portfolio").fadeTo(50, 0.1);
                $("#portfolio div").not("."+selectedClass).fadeOut();
            setTimeout(function() {
              $("."+selectedClass).fadeIn();
              $("#portfolio").fadeTo(50, 1);
            }, 500);

            });
        });

    </script>
    @yield('js')
  </body>
</html>
