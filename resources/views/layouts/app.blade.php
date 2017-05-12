<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <style type="text/css">
        #preloader {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #fff;
            z-index: 99999;
            height: 100%;
        }
        #status {
            position: absolute;
            left: 50%;
            top: 50%;
            width: 64px;
            height: 64px;
            margin: -32px 0 0 -32px;
            padding: 0;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">

    <link rel="icon" type="image/png" href="{{ asset('img/favicon.png') }}">
    @yield('header')
</head>
<body>

    <div id='preloader'>
       <div id='status'>
          <img alt='' height='64' src="{{ asset('img/loader.gif') }}" width='64'/>
       </div>
    </div>

    <div id="app">

        <div id="mySidenav" class="sidenav">
          <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
          <a href="{{ url('/') }}">Home</a>
          <a href="{{ url('/term-and-conditions') }}">Syarat &amp; Ketentuan</a>
          <a href="{{ url('/download') }}">Download</a>
        </div>

        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="navbar-header">
                            <!-- Collapsed Hamburger -->
                            <button type="button" class="navbar-toggle collapsed" onclick="openNav()">
                                <span class="sr-only">Toggle Navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>

                        <div class="collapse navbar-collapse" id="app-navbar-collapse">
                            <!-- Left Side Of Navbar -->
                            <ul class="nav navbar-nav">
                                <li><a href="{{ url('/') }}">Home</a></li>
                                <li><a href="{{ url('/term-and-conditions') }}">Syarat &amp; Ketentuan</a></li>
                                <li><a href="{{ url('/download') }}">Download</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <div class="container-fluid">
            <div class="row">
                @yield('content')
            </div>
        </div>


        <div class="site-footer" style="padding-top: 80px; padding-bottom: 40px;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2" style="border-top: 1px solid #dfe1e3; padding-top: 20px;">
                        <section class="site-footer-brand-logo">
                            <p class="local-brand-logo"><a href="https://www.dulux.co.id/id"><img id="footerLocalBrandLogo" src="{{ asset('img/footer-logo.png') }}" alt="Logo dulux"></a></p>
                            <nav class="link-container">
                                <div class="row">
                                    <div class="col-md-4 col-xs-6">
                                        <ul class="local-links">
                                            <li><a class="about" href="https://www.dulux.co.id/id/tentang-kami">Tentang Kami</a></li>
                                            <li><a id="contact-footer" class="contact" href="https://www.dulux.co.id/id/hubungi-kami">Contact Us</a></li>
                                            <li><a class="stockist" href="https://www.dulux.co.id/id/storefinder">Temukan toko</a></li>

                                            <li><a class="sustainability" href="https://www.dulux.co.id/id/sustainability">Sustainability</a></li>
                                            <li><a class="sitemap" href="https://www.dulux.co.id/id/peta-situs-html">Sitemap</a></li>

                                        </ul>
                                    </div>
                                    <div class="col-md-4 col-xs-6">
                                        <ul class="local-links">
                                            <li><a class="privacy-policy" href="https://www.dulux.co.id/id/kebijakan-privasi">Kebijakan Privasi</a></li>
                                            <li><a class="cookies" href="https://www.dulux.co.id/id/kebijakan-cookie">Kebijakan Cookie</a></li>
                                            <li><a class="accessibility" href="https://www.dulux.co.id/id/aksesibilitas">Aksesibilitas</a></li>
                                            <li><a class="colour-accuracy" href="https://www.dulux.co.id/id/akurasi-warna">Akurasi Warna</a></li>
                                            <li><a class="legal" href="https://www.dulux.co.id/id/hukum">Hukum</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </nav>

                        </section>
                        <article class="social-media-sharing">
                            <p><strong>Follow Dulux</strong></p>
                            <ul>
                                <li>
                                    <a href="https://www.facebook.com/LetsColourIndonesia" target="_blank" data-ga-label="Facebook" class="social-media-link"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                </li>
                                <li>
                                    <a href="https://twitter.com/LetsColourID" target="_blank" data-ga-label="Twitter" class="social-media-link"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                </li>
                                <li>
                                    <a href="http://www.pinterest.com/letscolourid" target="_blank" data-ga-label="Pinterest" class="social-media-link"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a>
                                </li>
                            </ul>
                        </article>
                        <article class="site-credit">
                            <div class="grid">
                                <div class="pull-left">
                                    <p> &nbsp; <a target="_blank" href="http://www.akzonobel.com/websites_overview.aspx">Situs Akzonobel Lainnya</a></p>
                                </div>
                                <div class="pull-right">
                                    <a target="_blank" href="http://www.akzonobel.com"><img id="footerAkzonobelLogo" src="{{ asset('img/akzonobel-blue.png') }}" alt="Merek dari AkzoNobel"></a>
                                </div>
                            </div>
                        </article>
                      <!--14Mar2017/16Mar2017- FLOURISH-4145/FLOURISH-5464 Requirement- END-->
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script>  

    $(window).on('load', function(){
           $("#status").fadeOut("slow");
           $("#preloader").delay(100).fadeOut("slow").remove(); 
         });

    function openNav() {
        document.getElementById("mySidenav").style.width = "250px";
    }

    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
    }
    </script>

    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-99039397-1', 'auto');
      ga('send', 'pageview');

    </script>

    @yield('script')

</body>
</html>
