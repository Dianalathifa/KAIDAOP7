<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>KAI DAOP 7 Sistem Informasi</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/kai.png" rel="icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Jost:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">

  <!-- =======================================================
  *Template Name: Arsha
  * Template URL: https://bootstrapmade.com/arsha-free-bootstrap-html-template-corporate/
  * Updated: Jun 14 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>
<style>
           .footer {
             background-color: #FF6D00; /* This is a standard orange color */
             color: #ffffff; /* This sets the text color to white for better contrast */
           }
           
           .footer a {
             color: #ffffff; /* This ensures links are also white */
           }
           
           .footer .social-links a {
             background-color: rgba(255, 255, 255, 0.2); /* This makes social icons slightly visible */
           }
          .navmenu > ul > li {
            position: relative;
            margin: 0 10px;
          }

          .dropdown > ul {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            background-color: #fff;
            padding: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
          }

          .dropdown:hover > ul {
            display: block;
          }
             </style>
<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="index.html" class="logo d-flex align-items-center me-auto">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!--<img src="assets/img/kai.jpg" alt=""> -->
        <h1 class="sitename">Sistem Informasi</h1>
      </a>

      
      <ul>
      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="{{ route('index') }}" class="active">HOME</a></li>
          <li class="dropdown"><a href=""><span>PROFIL</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
            <li><a href="{{ route('tentangkami') }}">Tentang Kami</a></li>
              <li><a href="{{ route('struktur') }}">Struktur Organisasi</a></li>
              <li><a href="{{ route('visimisi') }}">Visi dan Misi</a></li>
              <li><a href="{{ route('tugaspokok') }}">Tugas Pokok</a></li>
              <li><a href="{{ route('petawilayahkerja') }}">Peta Wilayah Kerja</a></li>
                <ul>
                  <li><a href="{{ route('struktur') }}">Struktur Organisasi</a></li>
                  <li><a href="{{ route('visimisi') }}">Visi dan Misi</a></li>
                </ul>
              </li>
             
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      
          
          <li> <img src="assets/img/download.jpeg" width="30px" height="30px"  onclick="window.location='{{ route('login') }}'">
                </li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>
    </div>
  </header>


<body>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var headerHeight = document.querySelector('header').offsetHeight;
        document.querySelector('main').style.paddingTop = (headerHeight + 20) + 'px';
    });
</script>
<main class="main">
  <div class="container section-title" data-aos="fade-up">
    <h2>Tugas Pokok</h2>
  </div><!-- End Section Title -->

      
</main>

<footer id="footer" class="footer">
  <div class="container footer-top">
    <div class="row gy-4">
      <div class="col-lg-4 col-md-6 footer-about">
        <a href="index.html" class="d-flex align-items-center">
          <span class="sitename">KAI DAOP 7 Sistem Informasi</span>
        </a>
        <div class="footer-contact pt-3">
          <p>ALAMAT</p>
          <p>Jl.Kompol Sunaryo</p>
          <p class="mt-3"><strong>Phone:</strong> <span>0351</span></p>
          <p><strong>Email:</strong> <span>info@example.com</span></p>
        </div>
      </div>

      <div class="col-lg-2 col-md-3 footer-links">
        <h4>Useful Links</h4>
        <ul>
          <li><i class="bi bi-chevron-right"></i> <a href="#">Home</a></li>
          <li><i class="bi bi-chevron-right"></i> <a href="#">Tentang Kami</a></li>
          <li><i class="bi bi-chevron-right"></i> <a href="#">Struktur Organisasi</a></li>
          <li><i class="bi bi-chevron-right"></i> <a href="#">Visi Misi</a></li>
        </ul>
      </div>

      <div class="col-lg-4 col-md-12">
        <h4>Follow Kami</h4>
        <p>di bawah ini</p>
        <div class="social-links d-flex">
          <a href=""><i class="bi bi-twitter-x"></i></a>
          <a href=""><i class="bi bi-facebook"></i></a>
          <a href=""><i class="bi bi-instagram"></i></a>
          <a href=""><i class="bi bi-linkedin"></i></a>
        </div>
      </div>
    </div>
  </div>

  <div class="container copyright text-center mt-4">
    <p>© <span>Copyright</span> <strong class="px-1 sitename">Sistem Informasi</strong></p>
  </div>
  </main>
</footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
  <script src="assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    @yield('scripts')
</body>
</html>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>