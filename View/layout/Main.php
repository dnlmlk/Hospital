<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Clinic</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="Main/assets/img/favicon.png" rel="icon">
  <link href="Main/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="Main/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="Main/assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="Main/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="Main/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="Main/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="Main/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="Main/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="Main/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">


    <!-- Template Main CSS File -->
  <link href="Main/assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Medilab - v4.7.1
  * Template URL: https://bootstrapmade.com/medilab-free-medical-bootstrap-theme/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Top Bar ======= -->
  <div id="topbar" class="d-flex align-items-center fixed-top">
    <div class="container d-flex justify-content-between">
      <div class="contact-info d-flex align-items-center">
        <i class="bi bi-envelope"></i> <a href="mailto:contact@example.com">contact@example.com</a>
        <i class="bi bi-phone"></i> +1 5589 55488 55
      </div>
      <div class="d-none d-lg-flex social-links align-items-center">
        <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
        <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
        <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
        <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></i></a>
      </div>
    </div>
  </div>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top mb-5">
    <div class="container d-flex align-items-center">

      <h1 class="logo me-auto"> <?= \App\Core\Application::$app->session->get("name") ?: "Clinic"?></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->


        <?php if (\App\Core\Application::$app->session->get('role') == "Patient") {?>
            <a href="/VisitListPatients" class="appointment-btn scrollto"><span class="d-none d-md-inline">Visit List</a>
        <?php }?>


        <?php if (\App\Core\Application::$app->session->get('email')) {?>
        <a href="/Profil" class="appointment-btn scrollto"><span class="d-none d-md-inline">Profile</a>
        <?php }?>

        <a href="/" class="appointment-btn scrollto"><span class="d-none d-md-inline">Logout</a>


    </div>
  </header><!-- End Header -->
  <div class="" style="margin-top: 108px">
      <?php if (\App\Core\Application::$app->session->getFlash("register")){?>
          <div class="alert alert-success" style="margin-top: 85px;">
              <?= \App\Core\Application::$app->session->getFlash("register");?>
          </div>
      <?php }?>

      <?php if (\App\Core\Application::$app->session->getFlash("login")){?>
          <div class="alert alert-success" style="margin-top: 85px;">
              <?= \App\Core\Application::$app->session->getFlash("login");?>
          </div>
      <?php }?>


  {{content}}

  <!-- End Footer -->

  <div id="preloader mt-5"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="Main/assets/vendor/purecounter/purecounter.js"></script>
  <script src="Main/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="Main/assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="Main/assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="Main/assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="Main/assets/js/main.js"></script>

</body>

</html>