<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nail Art</title>
    <!-- Animate Css -->
    <link rel="stylesheet" type="text/css" href="css/animate.min.css">
    <!-- Bootstrap Css -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <!-- Font Awesome Css -->
    <link rel="stylesheet" type="text/css" href="css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="css/swiper.min.css">
    <!-- Owl Carousel Css -->
    <link rel="stylesheet" type="text/css" href="css/owl.carousel.min.css">
    <link rel="stylesheet" type="text/css" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" type="text/css" href="css/magnific-popup.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap-datepicker3.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap-iso.css">
    <!-- Custome Css -->
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/responsive.css">
    <link rel="shortcut icon" type="image/png" href="images/favicon.png">
    @yield('css')

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <a href="javascript:;" id="return-to-top"> <i class="fas fa-angle-double-up"></i></a>
    <!--  Index-one -->
    <!-- preloader start -->
    <div id="preloader">
        <div id="status">
            <img src="images/loader.gif" id="preloader_image" alt="loader">
        </div>
    </div>
    <!-- preloder end -->

    <!-- Index-one -->
    <!--  header-start  -->
    <!-- top-header -->
    <div class="top-header-wrapper float-left">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12 text-center text-lg-left">
                    <div class="top-location float-left">
                        <ul class="d-flex justify-content-center justify-content-lg-start">
                            <li><a href="javascript:;">
                                    <i class="fas fa-map-marker-alt"></i>
                                    121 Waldeck Street, NY, USA
                                </a></li>
                            <li><a href="javascript:;">
                                    <i class="far fa-clock"></i>
                                    Mon-Sat: 9am to 6pm
                                </a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 d-none d-lg-block">
                    <div class="social-icon float-left">
                        <ul class="float-left">
                            <li><a href="javascript:;">
                                    <i class="fab fa-facebook-f"></i>
                                </a></li>
                            <li><a href="javascript:;">
                                    <i class="fab fa-twitter"></i>
                                </a></li>
                            <li><a href="javascript:;">
                                    <i class="fab fa-instagram"></i>
                                </a></li>
                            <li><a href="javascript:;">
                                    <i class="fab fa-pinterest-p"></i>
                                </a></li>
                            <li><a href="javascript:;">
                                    <span data-bs-toggle="modal" data-bs-target="#staticBackdrop">Login</span>
                                    /
                                    <span data-bs-toggle="modal" data-bs-target="#staticBackdrop1">Register</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- main-header -->
    <div class="main-header-wrapper float-left">
        <div class="main-menu float-left">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-2 col-md-6 col-sm-6 col-6">
                        <a class="navbar-brand" href="index.html">
                            <img src="images/logo-three.png" alt="logo">
                        </a>
                    </div>
                    <div class="col-lg-10 col-md-6 d-xl-block d-lg-block d-md-none d-sm-none d-none">
                        <nav class="navbar navbar-expand-lg navbar-light">
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav mb-2 mb-lg-0">
                                    
                                    <li class="nav-item">
                                        <a class="nav-link" href="javascript:;">Page
                                            <i class="fas fa-chevron-right"></i>
                                        </a>
                                        <ul class="sub-menu">
                                            <li><a href="about.html">About Us</a></li>
                                            <li><a href="our-team.html">Team</a></li>
                                        </ul>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="javascript:;">Services
                                            <i class="fas fa-chevron-right"></i>
                                        </a>
                                        <ul class="sub-menu">
                                            <li><a href="service.html">Service page</a></li>
                                            <li><a href="service-mani.html"> Manicure Service</a></li>
                                            <li><a href="service-padi.html"> Pedicure Service</a></li>
                                            <li><a href="service-nailart.html"> Nail Art Service</a></li>
                                            <li><a href="service-parahand.html">Paraffin Hand Service </a></li>
                                        </ul>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="javascript:;">Gallery
                                            <i class="fas fa-chevron-right"></i>
                                        </a>
                                        <ul class="sub-menu">
                                            <li><a href="gallery.html">3 Column</a></li>
                                            <li><a href="gallery2.html">4 Column</a></li>
                                            <li><a href="gallery3.html">5 Column</a></li>
                                            <li><a href="gallery4.html">Masonry Gallery</a></li>
                                        </ul>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="javascript:;">Blog
                                            <i class="fas fa-chevron-right"></i>
                                        </a>
                                        <ul class="sub-menu">
                                            <li><a href="blog.html">Blog Left Sidebar</a></li>
                                            <li><a href="blog-detail.html">Blog Details</a></li>
                                            <li><a href="blog-rightsidebar.html">Blog Right Sidebar</a></li>
                                        </ul>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="javascript:;">Shortcode
                                            <i class="fas fa-chevron-right"></i>
                                        </a>
                                        <div class="sub-menu mega-menu">
                                            <ul>
                                                <li><a href="accordion.html">
                                                        Accordion
                                                    </a></li>
                                                <li><a href="alert.html">
                                                        Alert
                                                    </a></li>
                                                <li><a href="button.html">
                                                        Button
                                                    </a></li>
                                                <li><a href="client.html">
                                                        Client
                                                    </a></li>
                                                <li><a href="counter.html">
                                                        Counter
                                                    </a></li>
                                            </ul>
                                            <ul>
                                                <li><a href="form.html">
                                                        Form
                                                    </a></li>
                                                <li><a href="icon.html">
                                                        Icon
                                                    </a></li>
                                                <li><a href="list.html">
                                                        List
                                                    </a></li>
                                                <li><a href="pricing.html">
                                                        Pricing Table
                                                    </a></li>
                                                <li><a href="social-icon.html">
                                                        Social Icon
                                                    </a></li>
                                            </ul>
                                            <ul>
                                                <li><a href="tab.html">
                                                        Tab
                                                    </a></li>
                                                <li><a href="team.html">
                                                        Team
                                                    </a></li>
                                                <li><a href="testimonial.html">
                                                        Testimonial
                                                    </a></li>
                                                <li><a href="gallery-short.html">
                                                        Gallery
                                                    </a></li>
                                            </ul>
                                        </div>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="contact.html">Contact Us</a>
                                    </li>
                                    <li class="nav-item">
                                        <div class="search">
                                            <div class="search-box">
                                                <input type="search" class="search-input" placeholder="Search Here">
                                                <a href="javascript:;" class="search-btn"><i
                                                        class="fas fa-search"></i></a>

                                            </div>
                                        </div>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="appointment.html">
                                            <div class="main-btn">
                                                <em><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i></em><span>Get
                                                    An Appointment</span>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                    <div class="col-md-6 col-sm-6 col-6 d-xl-none d-lg-none">
                        <button class="nav-toggle" type="button" data-bs-toggle="collapse"
                            data-bs-target="#sidebar" aria-controls="sidebar" aria-expanded="false"
                            aria-label="Toggle navigation">
                            <span class="nav-toggle__text">Toggle Menu</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- sidebar-start -->
    <div class="mobile-menu-wrapper">
        <div id="sidebar">
            <div class="logo">
                <img src="images/logo.png" alt="logo">
            </div>
            <div id="toggle-close">&times;</div>
            <div id="cssmenu">
                <input type="search" placeholder="Search Here....">
                <ul class="float-left">
                    <li class="has-sub">
                        <a href="javascript:;">Home</a>
                        <ul>
                            <li><a href="index.html">Home 1</a></li>
                            <li><a href="index-two.html">Home 2</a></li>
                            <li><a href="index-three.html">Home 3</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="about.html">About Us</a>
                    </li>
                    <li class="has-sub">
                        <a href="javascript:;">Services</a>
                        <ul>
                            <li><a href="service.html">Service page</a></li>
                            <li><a href="service-mani.html"> Manicure Service</a></li>
                            <li><a href="service-padi.html"> Pedicure Service</a></li>
                            <li><a href="service-nailart.html"> Nail Art Service</a></li>
                            <li><a href="service-parahand.html">Paraffin Hand Service </a></li>
                        </ul>
                    </li>
                    <li class="has-sub">
                        <a href="javascript:;">Gallery</a>
                        <ul>
                            <li><a href="gallery.html">3 Column</a></li>
                            <li><a href="gallery2.html">4 Column</a></li>
                            <li><a href="gallery3.html">5 Column</a></li>
                            <li><a href="gallery4.html">Masonry Gallery</a></li>
                        </ul>
                    </li>
                    <li class="has-sub">
                        <a href="javascript:;">Blog</a>
                        <ul>
                            <li><a href="blog.html">Blog</a></li>
                            <li><a href="blog-detail.html">Blog Details</a></li>
                            <li><a href="blog-rightsidebar.html">Blog Right Sidebar</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="our-team.html">Team</a>
                    </li>
                    <li>
                        <a href="team-single.html">Expert</a>
                    </li>
                    <li class="has-sub">
                        <a href="javascript:;">Shortcode</a>
                        <ul>
                            <li><a href="accordion.html"> Accordion</a></li>
                            <li><a href="alert.html"> Alert</a></li>
                            <li><a href="button.html">Button</a></li>
                            <li><a href="client.html">Client</a></li>
                            <li><a href="counter.html">Counter</a></li>
                            <li><a href="form.html"> Form</a></li>
                            <li><a href="icon.html"> Icon</a></li>
                            <li><a href="list.html">List</a></li>
                            <li><a href="pricing.html">Pricing Table</a></li>
                            <li><a href="social-icon.html">Social Icon</a></li>
                            <li><a href="tab.html">Tab</a></li>
                            <li><a href="team.html">Team</a></li>
                            <li><a href="testimonial.html">Testimonial</a></li>
                            <li><a href="gallery-short.html">Gallery</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="contact.html">Contact Us</a>
                    </li>
                </ul>
                <div class="sidebar-social float-left">
                    <ul class="float-left">
                        <li><a href="javascript:;">
                                <i class="fab fa-facebook-f"></i>
                            </a></li>
                        <li><a href="javascript:;">
                                <i class="fab fa-twitter"></i>
                            </a></li>
                        <li><a href="javascript:;">
                                <i class="fab fa-instagram"></i>
                            </a></li>
                        <li><a href="javascript:;">
                                <i class="fab fa-pinterest-p"></i>
                            </a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>


    @yield('content')
    

    <!-- team-section-end -->

    <!-- footer-section-start -->

    <div class="footer-wrapper float-left">
        <div class="container">
            <div class="row footer-main  animated wow fade-up">
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div>
                        <div class="footer-logo">
                            <img src="images/footer-logo.png" alt="img">
                        </div>
                        <div class="footer-pera">
                            <p>Lorem Ipsum is simply dummy text of the printing and
                                typesetting industry. Lorem Ipsum has been the industry's
                                standard dummy text ever since.</p>
                        </div>
                        <div class="footer-icon">
                            <ul>
                                <li><a href="javascript:;">
                                        <i class="fab fa-facebook-f"></i>
                                    </a></li>
                                <li><a href="javascript:;">
                                        <i class="fab fa-twitter"></i>
                                    </a></li>
                                <li><a href="javascript:;">
                                        <i class="fab fa-instagram"></i>
                                    </a></li>
                                <li><a href="javascript:;">
                                        <i class="fab fa-pinterest-p"></i>
                                    </a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-12">
                    <div class="footer-link-wrapper">
                        <h5>Useful links</h5>
                        <ul>
                            <li><a href="index.html">
                                    <span><i class="fas fa-chevron-right"></i></span> Home
                                </a></li>
                            <li><a href="about.html">
                                    <span><i class="fas fa-chevron-right"></i></span> About Us
                                </a></li>
                            <li><a href="our-team.html">
                                    <span><i class="fas fa-chevron-right"></i></span> Our Team
                                </a></li>
                            <li><a href="appointment.html">
                                    <span><i class="fas fa-chevron-right"></i></span> Booking
                                </a></li>
                            <li><a href="contact.html">
                                    <span><i class="fas fa-chevron-right"></i></span> Contact Us
                                </a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="footer-insta">
                        <h5>Instagram post</h5>
                        <ul>
                            <li>
                                <a href="javascript:;"><img src="images/insta-blog1.png" alt="img">
                                    <span><i class="fab fa-instagram"></i></span>
                                </a>

                            </li>
                            <li class="insta-post-gap">
                                <a href="javascript:;"> <img src="images/insta-blog4.png" alt="img">
                                    <span><i class="fab fa-instagram"></i></span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:;"><img src="images/insta-blog2.png" alt="img">
                                    <span><i class="fab fa-instagram"></i></span>
                                </a>

                            </li>
                            <li class="insta-post-gap">
                                <a href="javascript:;"> <img src="images/insta-blog5.png" alt="img">
                                    <span><i class="fab fa-instagram"></i></span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:;"><img src="images/insta-blog3.png" alt="img">
                                    <span><i class="fab fa-instagram"></i></span>
                                </a>
                            </li>
                            <li class="insta-post-gap">
                                <a href="javascript:;"><img src="images/insta-blog6.png" alt="img">
                                    <span><i class="fab fa-instagram"></i></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="footer-contact">
                        <h5>Contact Info</h5>
                        <ul>
                            <li>
                                <div class="address-icon">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div class="address-content">
                                    <a href="javascript:;">
                                        <span>Address</span>
                                        121 Waldeck Street, NY, USA
                                    </a>
                                </div>
                            </li>
                            <li>
                                <div class="address-icon">
                                    <i class="fas fa-phone"></i>
                                </div>
                                <div class="address-content">
                                    <a href="javascript:;">
                                        <span>PHONE</span>
                                        0800-123456, 0800-123489
                                    </a>
                                </div>
                            </li>
                            <li>
                                <div class="address-icon">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div class="address-content">
                                    <a href="javascript:;">
                                        <span>EMAIL</span>
                                        nailsalon@example.com
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="bottom-footer">
                <p>Copyright © 2023 Nail Salon Template Designed By <a href="javascript:;">Webstrot.</a></p>
            </div>
        </div>
    </div>

    <!-- footer-section-end -->

    <!-- Login Modal -->
    <div class="login-wrapper">
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <button type="button" class="btn-close login-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                    <div class="modal-header">
                        <h3 class="modal-title" id="staticBackdropLabel1"><span>Login</span></h3>
                    </div>
                    <div class="modal-body">
                        <div class="register-body">
                            <form>
                                <div>
                                    <input type="text" placeholder="User Name*">
                                </div>
                                <div>
                                    <input type="password" placeholder="Password*">
                                </div>
                                <div>
                                    <ul>
                                        <li>
                                            <input type="checkbox" class="form-check-input" id="exampleCheck2">
                                            <label class="form-check-label" for="exampleCheck2">Remember Me</label>
                                        </li>
                                        <li>
                                            <a href="javascript:;">Forgot Password?</a>
                                        </li>
                                    </ul>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="sign-btn">
                            <a href="javascript:;" class="main-btn-red">
                                <em><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i></em><span>Log In
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Register Modal -->
    <div class="login-wrapper">
        <div class="modal fade" id="staticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <button type="button" class="btn-close login-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                    <div class="modal-header">
                        <h3 class="modal-title" id="staticBackdropLabel"><span>Register</span></h3>
                    </div>
                    <div class="modal-body">
                        <div class="register-body">
                            <form>
                                <div>
                                    <input type="text" placeholder="User Name*">
                                </div>
                                <div>
                                    <input type="email" placeholder="Email*">
                                </div>
                                <div>
                                    <input type="password" placeholder="Password*">
                                </div>
                                <div>
                                    <input type="password" placeholder="Confirm Password*">
                                </div>
                                <div>
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                    <label class="form-check-label" for="exampleCheck1">Yes, I understand and agree
                                        <a href="javascript:;">Terms & Conditions.</a> </label>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="sign-btn">
                            <a href="javascript:;" class="main-btn-red">
                                <em><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i></em><span>Sign Up
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>







    <script src="js/jquery-3.6.4.min.js"></script>
    <script src="js/jquery.magnific-popup.js"></script>
    <!-- Bootstrap JS-->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/swiper.min.js"></script>
    <script src="js/bootstrap-datepicker.min.js"></script>
    <!-- Owl Carousel JS -->
    <script src="js/owl.carousel.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <!-- Animation Js -->
    <script src="js/wow.js"></script>
    <!-- Custom Js -->
    <script src="js/custom.js"></script>
    <!-- contact form js start -->
    <script src="js/contact_form.js"></script>
    <script>
        function BtnLoading(elem) {
            $(elem).attr("data-original-text", $(elem).html());
            $(elem).prop("disabled", true);
            $(elem).html('<i class="spinner-border spinner-border-sm"></i> Loading...');
        }

        function BtnReset(elem) {
            $(elem).prop("disabled", false);
            $(elem).html($(elem).attr("data-original-text"));
        }

        function alertError(message = "") {

            Swal.fire({
                icon: 'error',
                title: 'Ops...Error',
                html: message,
                // timer: 3000,
                timerProgressBar: true
            })
        }

        function alertSuccess(message = "Saved!!!!", redirect = "") {
            Swal.fire({
                icon: 'success',
                title: 'success',
                html: message,
                // timer: 3000,
                timerProgressBar: true
            })
            if (redirect) {
                location.href = redirect
            }
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-top-center",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }

        @if (session()->has('toast_success'))
            toastr.success("", "{{ session('toast_success') }}");
        @endif
    </script>
    @yield('javascript')
</body>

</html>
