<!DOCTYPE HTML>
@include('author.whoami')
<html>
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Heartteam</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="medical site of heart team. Медицинский сайт про сердце." />
    <meta name="keywords" content="сердце, медицина, серлце, medic, heartteam" />
    <meta name="author" content="muhammadumarsotvoldiev@gmail.com" />

  <!-- Facebook and Twitter integration -->
    <meta property="og:title" content="Heartteam"/>
    <meta property="og:image" content=""/>
    <meta property="og:url" content=""/>
    <meta property="og:site_name" content="Heartteam.uz"/>
    <meta property="og:author" content="muhammadumarsotvoldiev@gmail.com"/>
    <meta property="og:description" content="medical site of heart team. Медицинский сайт про сердце."/>
    <meta name="twitter:title" content="Heartteam" />
    <meta name="twitter:image" content="" />
    <meta name="twitter:url" content="" />
    <meta name="twitter:card" content="сердце, медицина, серлце, medic, heartteam" />
    <meta name="twitter:author" content="muhammadumarsotvoldiev@gmail.com" />

    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
    <link rel="shortcut icon" href="favicon.ico">

    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,700&display=swap&subset=cyrillic" rel="stylesheet">
    
    <!-- Animate.css -->
    <link rel="stylesheet" href="/assets/css/animate.css">
    <!-- Icomoon Icon Fonts-->
    <link rel="stylesheet" href="/assets/css/icomoon.css">
    <!-- Bootstrap  -->
    <link rel="stylesheet" href="/assets/css/bootstrap.css">
    <!-- Flexslider  -->
    <link rel="stylesheet" href="/assets/css/flexslider.css">
    <!-- Flaticons  -->
    <link rel="stylesheet" href="/assets/fonts/flaticon/font/flaticon.css">
    <!-- Owl Carousel -->
    <link rel="stylesheet" href="/assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="/assets/css/owl.theme.default.min.css">
    <!-- Theme style  -->
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/our.css">

    <!-- Modernizr JS -->
    <script src="/assets/js/modernizr-2.6.2.min.js"></script>
    <!-- FOR IE9 below -->
    <!--[if lt IE 9]>
    <script src="js/respond.min.js"></script>
    <![endif]-->
    @yield('extra_css')

    </head>
    <body>
    <div id="colorlib-page">

        @include('layouts.frontend.sidebar')

        <div id="colorlib-main">
            @yield('main')

            @include('layouts.frontend.footer')
            
        </div>

    </div>



    <!-- Javascript -->
    <!-- jQuery -->
    <script src="/assets/js/jquery.min.js"></script>
    <!-- jQuery Easing -->
    <script src="/assets/js/jquery.easing.1.3.js"></script>
    <!-- Bootstrap -->
    <script src="/assets/js/bootstrap.min.js"></script>
    <!-- Waypoints -->
    <script src="/assets/js/jquery.waypoints.min.js"></script>
    <!-- Flexslider -->
    <script src="/assets/js/jquery.flexslider-min.js"></script>
    <!-- Sticky Kit -->
    <script src="/assets/js/sticky-kit.min.js"></script>
    <!-- Owl carousel -->
    <script src="/assets/js/owl.carousel.min.js"></script>
    <!-- Counters -->
    <script src="/assets/js/jquery.countTo.js"></script>
    
    
    <!-- MAIN JS -->
    <script src="/assets/js/main.js"></script>
    <script>
        var msg = '{{Session::get('alert')}}';
        var exist = '{{Session::has('alert')}}';
        if(exist){
            alert(msg);
        }
    </script>
    @yield('extra_js')

    </body>
</html>