<!DOCTYPE html>
<html lang="en">
<body data-spy="scroll" data-target=".fixed-top">

    @include('components.head')
    
    @include('components.navbar')

    <!-- Header -->
    <header id="header" class="header">
        <div class="header-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-xl-5">
                        <div class="text-container">
                            <h1>E - Tiket</h1>
                            <h1>SejukPool</h1>
                            <p class="p-large">Aplikasi Web pemesanan tiket kolam renang hulu cai endah, Bogor</p>
                            <a class="btn-solid-lg page-scroll" href="{{ route('login') }}">MASUK</a>
                        </div> <!-- end of text-container -->
                    </div> <!-- end of col -->
                    <div class="col-lg-6 col-xl-7">
                        <div class="image-container">
                            <div class="img-wrapper">
                                <img class="img-fluid" src="{{ asset('content/images/landing-1.png') }}" alt="alternative">
                            </div> <!-- end of img-wrapper -->
                        </div> <!-- end of image-container -->
                    </div> <!-- end of col -->
                </div> <!-- end of row -->
            </div> <!-- end of container -->
        </div> <!-- end of header-content -->
    </header> <!-- end of header -->
    <svg class="header-frame" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" viewBox="0 0 1920 310"><defs><style>.cls-1{fill:#4E73DF;}</style></defs><title>header-frame</title><path class="cls-1" d="M0,283.054c22.75,12.98,53.1,15.2,70.635,14.808,92.115-2.077,238.3-79.9,354.895-79.938,59.97-.019,106.17,18.059,141.58,34,47.778,21.511,47.778,21.511,90,38.938,28.418,11.731,85.344,26.169,152.992,17.971,68.127-8.255,115.933-34.963,166.492-67.393,37.467-24.032,148.6-112.008,171.753-127.963,27.951-19.26,87.771-81.155,180.71-89.341,72.016-6.343,105.479,12.388,157.434,35.467,69.73,30.976,168.93,92.28,256.514,89.405,100.992-3.315,140.276-41.7,177-64.9V0.24H0V283.054Z"/></svg>
    <!-- end of header -->
<!-- Details -->
<div class="cards-1">
    <div class="container">
        <div id="details" class="basic-1">
            <div class="row mb-4 text-center">
                <div class="col-lg-12">
                    <div class="above-heading">TENTANG</div>
                    <h2 class="h2-heading">Tentang SejukPool</h2>
                </div>
            </div>
            <div class="row align-items-center">
                <!-- Gambar di kiri -->
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <div class="image-container">
                        <img class="img-fluid" src="{{ asset('content/images/landing-1.png') }}" alt="alternative">
                    </div>
                </div>

                <!-- Teks di kanan -->
                <div class="col-lg-6">
                    <div class="text-container">
                        <h2>SejukPool?</h2>
                        <p>Selamat datang di e-Ticket SejukPool, website resmi penjualan tiket online untuk kolam renang Hulu Cai Endah! 
                            Nikmati kemudahan dalam merencanakan liburan Anda bersama keluarga dengan membeli tiket secara praktis, cepat, dan aman 
                            hanya melalui genggaman tangan. Melalui e-Ticket SejukPool, Anda bisa melihat informasi lengkap seputar harga tiket, jam operasional, 
                            hingga promo menarik yang tersedia. Tak perlu antre, cukup pesan tiket dari rumah dan langsung menikmati kesejukan alami kolam renang Hulu Cai Endah yang asri dan menyegarkan!</p>
                        <a class="btn-solid-reg page-scroll" href="{{ route('ticket') }}">BELI TIKET !!</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end of details -->

<!-- GALERI -->
<section id="gallery" class="gallery-section py-5" style="background-color: #f6faff;">
    <div class="container text-center">
      <!-- Judul -->
      <div class="mb-5">
        <h2 class="font-weight-bold mb-3">GALLERY</h2>
        <p class="text-muted mb-0 mx-auto" style="max-width: 600px;">
          Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; 
          Proin sodales ultrices nulla blandit volutpat.
        </p>
      </div>
  
<!-- Swiper Slider -->
<div class="swiper image-slider mb-4">
    <div class="swiper-wrapper">
      @for($i = 0; $i < 10; $i++)
      <div class="swiper-slide">
        <div class="gallery-item">
          <div class="img-container">
            <img src="{{ asset('content/images/landing-1.png') }}" class="img-fluid rounded shadow-sm" alt="Gallery Image">
          </div>
          <div class="gallery-info d-flex justify-content-between align-items-center px-3 py-2">
            <div class="location">
              <i class="fas fa-map-marker-alt mr-1"></i>
              <span>Bogor</span>
            </div>
            <div class="price">
              <i class="fas fa-ticket-alt mr-1"></i>
              <span>12000</span>
            </div>
          </div>
        </div>
      </div>
      @endfor
    </div>
  </div>
  
  <!-- Tombol Navigasi (icon) -->
  <div class="swiper-nav text-center">
    <button class="btn btn-outline-primary swiper-button-prev-custom mx-2">
      <i class="fas fa-chevron-left"></i>
    </button>
    <button class="btn btn-outline-primary swiper-button-next-custom mx-2">
      <i class="fas fa-chevron-right"></i>
    </button>
  </div>
  
    <!-- Modal Lightbox -->
    <div class="modal fade" id="galleryModal" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content bg-transparent border-0">
          <img id="galleryModalImage" src="" class="img-fluid rounded shadow" alt="Preview">
        </div>
      </div>
    </div>
  </section>
  
  
    <!-- Video -->
    <div id="video" class="basic-2">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">

                    <!-- Video Preview -->
                    <div class="image-container">
                        <div class="video-wrapper">
                            <a class="popup-youtube" href="https://www.youtube.com/watch?v=fLCjQJCekTs" data-effect="fadeIn">
                                <img class="img-fluid" src="{{ asset('content/images/video-image.png') }}" alt="alternative">
                                <span class="video-play-button">
                                    <span></span>
                                </span>
                            </a>
                        </div> <!-- end of video-wrapper -->
                    </div> <!-- end of image-container -->
                    <!-- end of video preview -->

                    <div class="p-heading">What better way to show off Tivo marketing automation saas app than presenting you some great situations of each module and tool available to users in a video</div>        
                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </div> <!-- end of basic-2 -->
    <!-- end of video -->

    <!-- Newsletter -->
    <div class="form">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-container">
                        <div class="above-heading">NEWSLETTER</div>
                        <h2>Stay Updated With The Latest News To Get More Qualified Leads</h2>

                        <!-- Newsletter Form -->
                        <form id="newsletterForm" data-toggle="validator" data-focus="false">
                            <div class="form-group">
                                <input type="email" class="form-control-input" id="nemail" required>
                                <label class="label-control" for="nemail">Email</label>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group checkbox">
                                <input type="checkbox" id="nterms" value="Agreed-to-Terms" required>I've read and agree to Tivo's written <a href="privacy-policy.html">Privacy Policy</a> and <a href="terms-conditions.html">Terms Conditions</a> 
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="form-control-submit-button">SUBSCRIBE</button>
                            </div>
                            <div class="form-message">
                                <div id="nmsgSubmit" class="h3 text-center hidden"></div>
                            </div>
                        </form>
                        <!-- end of newsletter form -->

                    </div> <!-- end of text-container -->
                </div> <!-- end of col -->
            </div> <!-- end of row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="icon-container">
                        <span class="fa-stack">
                            <a href="#your-link">
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fab fa-facebook-f fa-stack-1x"></i>
                            </a>
                        </span>
                        <span class="fa-stack">
                            <a href="#your-link">
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fab fa-twitter fa-stack-1x"></i>
                            </a>
                        </span>
                        <span class="fa-stack">
                            <a href="#your-link">
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fab fa-pinterest-p fa-stack-1x"></i>
                            </a>
                        </span>
                        <span class="fa-stack">
                            <a href="#your-link">
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fab fa-instagram fa-stack-1x"></i>
                            </a>
                        </span>
                        <span class="fa-stack">
                            <a href="#your-link">
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fab fa-linkedin-in fa-stack-1x"></i>
                            </a>
                        </span>
                    </div> <!-- end of col -->
                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </div> <!-- end of form -->
    <!-- end of newsletter -->

    @include('components.footer')

    @include('components.scripts')
</body>
</html>