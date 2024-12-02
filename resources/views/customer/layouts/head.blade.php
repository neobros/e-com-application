<!DOCTYPE html>
<html lang="en">


<!-- molla/index-4.html  22 Nov 2019 09:53:08 GMT -->

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Molla - Bootstrap eCommerce Template</title>
    <meta name="keywords" content="HTML5 Template">
    <meta name="description" content="Molla - Bootstrap eCommerce Template">
    <meta name="author" content="p-themes">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="/customer/assets/images/icons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/customer/assets/images/icons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/customer/assets/images/icons/favicon-16x16.png">
    <link rel="manifest" href="/customer/assets/images/icons/site.html">
    <link rel="mask-icon" href="/customer/assets/images/icons/safari-pinned-tab.svg" color="#666666">
    <link rel="shortcut icon" href="/customer/assets/images/icons/favicon.ico">
    <meta name="apple-mobile-web-app-title" content="Molla">
    <meta name="application-name" content="Molla">
    <meta name="msapplication-TileColor" content="#cc9966">
    <meta name="msapplication-config" content="/customer/assets/images/icons/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">
    <link rel="stylesheet" href="/customer/assets/vendor/line-awesome/line-awesome/line-awesome/css/line-awesome.min.css">
    <!-- Plugins CSS File -->
    <link rel="stylesheet" href="/customer/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/customer/assets/css/plugins/owl-carousel/owl.carousel.css">
    <link rel="stylesheet" href="/customer/assets/css/plugins/magnific-popup/magnific-popup.css">
    <link rel="stylesheet" href="/customer/assets/css/plugins/jquery.countdown.css">
    <!-- Main CSS File -->
    <link rel="stylesheet" href="/customer/assets/css/style.css">
    <link rel="stylesheet" href="/customer/assets/css/skins/skin-demo-4.css">
    <link rel="stylesheet" href="/customer/assets/css/demos/demo-4.css">
    <link rel="stylesheet" href="/customer/assets/css/dark.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<link rel="stylesheet" href="/simple-datatables/style.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    
</head>

<body>


<div class="page-wrapper">
    @include('customer.layouts.header')

    @yield('content')


</div><!-- End .page-wrapper -->


    @include('customer.layouts.footer')

    <button id="scroll-top" title="Back to Top"><i class="icon-arrow-up"></i></button>

    <!-- Mobile Menu -->
    <div class="mobile-menu-overlay"></div><!-- End .mobil-menu-overlay -->

    <div class="mobile-menu-container mobile-menu-light">
        <div class="mobile-menu-wrapper">
            <span class="mobile-menu-close"><i class="icon-close"></i></span>

            <!-- <form action="#" method="get" class="mobile-search">
                <label for="mobile-search" class="sr-only">Search</label>
                <input type="search" class="form-control" name="mobile-search" id="mobile-search"
                    placeholder="Search in..." required>
                <button class="btn btn-primary" type="submit"><i class="icon-search"></i></button>
            </form> -->

            <ul class="nav nav-pills-mobile nav-border-anim" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="mobile-menu-link" data-toggle="tab" href="#mobile-menu-tab"
                        role="tab" aria-controls="mobile-menu-tab" aria-selected="true">Menu</a>
                </li>
              
            </ul>

            <div class="tab-content">
                <div class="tab-pane fade show active" id="mobile-menu-tab" role="tabpanel"
                    aria-labelledby="mobile-menu-link">
                    <nav class="mobile-nav">
                        <ul class="mobile-menu">
                            <li class="active">
                                <a href="/">Home</a>                              
                            </li>
                 
                            <li class="">
                                <a href="#">Shop</a>                              
                            </li>
                            <li class="">
                                <a href="/about">About</a>                              
                            </li>
                            <li class="">
                                <a href="/contact">Contact</a>                              
                            </li>
                         
                            
                 
                        </ul>
                    </nav><!-- End .mobile-nav -->
                </div><!-- .End .tab-pane -->
                <div class="tab-pane fade" id="mobile-cats-tab" role="tabpanel" aria-labelledby="mobile-cats-link">
                    <nav class="mobile-cats-nav">
                        <ul class="mobile-cats-menu">
                            <li><a class="mobile-cats-lead" href="#">Daily offers</a></li>
                            <li><a class="mobile-cats-lead" href="#">Gift Ideas</a></li>
                            <li><a href="#">Beds</a></li>
                            <li><a href="#">Lighting</a></li>
                            <li><a href="#">Sofas & Sleeper sofas</a></li>
                            <li><a href="#">Storage</a></li>
                            <li><a href="#">Armchairs & Chaises</a></li>
                            <li><a href="#">Decoration </a></li>
                            <li><a href="#">Kitchen Cabinets</a></li>
                            <li><a href="#">Coffee & Tables</a></li>
                            <li><a href="#">Outdoor Furniture </a></li>
                        </ul><!-- End .mobile-cats-menu -->
                    </nav><!-- End .mobile-cats-nav -->
                </div><!-- .End .tab-pane -->
            </div><!-- End .tab-content -->

            <div class="social-icons">
                <a href="#" class="social-icon" target="_blank" title="Facebook"><i class="icon-facebook-f"></i></a>
                <a href="#" class="social-icon" target="_blank" title="Twitter"><i class="icon-twitter"></i></a>
                <a href="#" class="social-icon" target="_blank" title="Instagram"><i class="icon-instagram"></i></a>
                <a href="#" class="social-icon" target="_blank" title="Youtube"><i class="icon-youtube"></i></a>
            </div><!-- End .social-icons -->
        </div><!-- End .mobile-menu-wrapper -->
    </div><!-- End .mobile-menu-container -->



    @include('customer.layouts.registerModal')


    @if( \Request::is('home') || \Request::is('/') )
        <div class="container newsletter-popup-container mfp-hide" id="newsletter-popup-form">
            <div class="row justify-content-center">
                <div class="col-10">
                    <div class="row no-gutters bg-white newsletter-popup-content">
                        <div class="col-xl-3-5col col-lg-7 banner-content-wrap">
                            <div class="banner-content text-center">
                                <img src="/customer/assets/images/popup/newsletter/logo.png" class="logo" alt="logo" width="60" height="15">
                                <h2 class="banner-title">get <span>25<light>%</light></span> off</h2>
                                <p>Subscribe to the Molla eCommerce newsletter to receive timely updates from your favorite products.</p>
                                <form action="#">
                                    <div class="input-group input-group-round">
                                        <input type="email" class="form-control form-control-white" placeholder="Your Email Address" aria-label="Email Adress" required>
                                        <div class="input-group-append">
                                            <button class="btn" type="submit"><span>go</span></button>
                                        </div><!-- .End .input-group-append -->
                                    </div><!-- .End .input-group -->
                                </form>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="register-policy-2" required>
                                    <label class="custom-control-label" for="register-policy-2">Do not show this popup again</label>
                                </div><!-- End .custom-checkbox -->
                            </div>
                        </div>
                        <div class="col-xl-2-5col col-lg-5 ">
                            <img src="/customer/assets/images/popup/newsletter/img-1.jpg" class="newsletter-img" alt="newsletter">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if(\Request::is('/'))
    <script>
       function toggleDarkMode() {
        document.body.classList.toggle('dark-mode');
        const elements = document.querySelectorAll('.mode-toggle-btn');
        elements.forEach(el => el.classList.toggle('dark-mode'));


            if (document.body.classList.contains('dark-mode')) {
                elements.forEach(el => el.innerHTML = 'Switch to Light Mode'); // You can change text or icons
                localStorage.setItem('darkMode', 'enabled');
            } else {
                elements.forEach(el => el.innerHTML = 'Switch to Dark Mode');
                localStorage.removeItem('darkMode');
            }
        }

        // Check if dark mode was previously enabled and apply it on page load
        if (localStorage.getItem('darkMode') === 'enabled') {
            document.body.classList.add('dark-mode');
            const elements = document.querySelectorAll('.mode-toggle-btn');
            elements.forEach(el => el.classList.add('dark-mode'));
           
            elements.forEach(el => el.innerHTML = 'Switch to Light Mode');
        } else {
            // Set default button text to "Switch to Dark Mode" when dark mode is off
            const elements = document.querySelectorAll('.mode-toggle-btn');
            elements.forEach(el => el.innerHTML = 'Switch to Dark Mode');
        }

    </script>
    active @endif
 

    <!-- Plugins JS File -->
    <script src="/customer/assets/js/jquery.min.js"></script>
    <script src="/customer/assets/js/bootstrap.bundle.min.js"></script>
    <script src="/customer/assets/js/jquery.hoverIntent.min.js"></script>
    <script src="/customer/assets/js/jquery.waypoints.min.js"></script>
    <script src="/customer/assets/js/superfish.min.js"></script>
    <script src="/customer/assets/js/bootstrap-input-spinner.js"></script>
    <script src="/customer/assets/js/owl.carousel.min.js"></script>
    <script src="/customer/assets/js/jquery.plugin.min.js"></script>
    <script src="/customer/assets/js/jquery.magnific-popup.min.js"></script>
    <script src="/customer/assets/js/jquery.countdown.min.js"></script>
    <!-- Main JS File -->
    <script src="/customer/assets/js/main.js"></script>
    <script src="/customer/assets/js/demos/demo-7.js"></script>
</body>

<script src="simple-datatables/simple-datatables.js"></script>
	<script>
			let table1 = document.querySelector('#table_filter');
			let dataTable = new simpleDatatables.DataTable(table1);	
	</script>


    <script>
            function needLogin()
        {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Please login is required!",
                footer: ''
                });
        }
    </script>

<!-- molla/index-7.html  22 Nov 2019 09:56:58 GMT -->
</html>



