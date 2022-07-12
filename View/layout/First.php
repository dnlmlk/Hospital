<?php
\App\Core\Application::$app->session->remove("email");
\App\Core\Application::$app->session->remove("role");
\App\Core\Application::$app->session->remove("name");
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with Ollie landing page.">
    <meta name="author" content="Devcrud">
    <title>Wellcome</title>

    <!-- font icons -->
    <link rel="stylesheet" href="First/assets/vendors/themify-icons/css/themify-icons.css">
    
    <!-- owl carousel -->
    <link rel="stylesheet" href="First/assets/vendors/owl-carousel/css/owl.carousel.css">
    <link rel="stylesheet" href="First/assets/vendors/owl-carousel/css/owl.theme.default.css">

    <!-- Bootstrap + Ollie main styles -->
	<link rel="stylesheet" href="First/assets/css/ollie.css">

</head>
<body data-spy="scroll" data-target=".navbar" data-offset="40" id="home">

    <header id="home" class="header">
        <div class="overlay"></div>

        <div id="header-carousel" class="carousel slide carousel-fade" data-ride="carousel">  
            <div class="container">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="carousel-caption d-none d-md-block">
                            <h1 class="carousel-title">Wellcome to<br> Our Clinic</h1>
                            
                            <a href="/Loginn" class="btn btn-primary btn-rounded">Login</a>
                            <a href="/Register" class="btn btn-primary btn-rounded">Register</a>
                            <a href="/Guests" class="btn btn-primary btn-rounded">Guest</a>


                        </div>
                    </div>
                </div>
            </div>        
        </div>

        <div class="infos container mb-4 mb-md-2">
            <div class="title">
                <h6 class="subtitle font-weight-normal">We are so</h6>
                <h5>Happy</h5>
                <p class="font-small">that you choose our clinic</p>
            </div>
            <div class="socials text-right">
                <div class="row justify-content-between">
                    <div class="col">
                        <a class="d-block subtitle"><i class="ti-microphone pr-2"></i> (123) 456-7890</a>
                        <a class="d-block subtitle"><i class="ti-email pr-2"></i> info@website.com</a>
                    </div>
                    <div class="col">
                        <h6 class="subtitle font-weight-normal mb-2">Social Media</h6>
                        <div class="social-links">
                            <a href="javascript:void(0)" class="link pr-1"><i class="ti-facebook"></i></a>
                            <a href="javascript:void(0)" class="link pr-1"><i class="ti-twitter-alt"></i></a>
                            <a href="javascript:void(0)" class="link pr-1"><i class="ti-google"></i></a>
                            <a href="javascript:void(0)" class="link pr-1"><i class="ti-pinterest-alt"></i></a>
                            <a href="javascript:void(0)" class="link pr-1"><i class="ti-instagram"></i></a>
                            <a href="javascript:void(0)" class="link pr-1"><i class="ti-rss"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <script src="First/assets/vendors/jquery/jquery-3.4.1.js"></script>
    <script src="First/assets/vendors/bootstrap/bootstrap.bundle.js"></script>

    <!-- bootstrap 3 affix -->
	<script src="First/assets/vendors/bootstrap/bootstrap.affix.js"></script>
    
    <!-- Owl carousel  -->
    <script src="First/assets/vendors/owl-carousel/js/owl.carousel.js"></script>


    <!-- Ollie js -->
    <script src="First/assets/js/Ollie.js"></script>

</body>
</html>
