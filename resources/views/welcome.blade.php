<!DOCTYPE html>
<html lang="id">
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
                            <h1>E - Tiket
                                SejukPool
                            </h1>
                            <p class="p-large">Aplikasi Web pemesanan tiket kolam renang hulu cai endah, Bogor</p>
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
                    <h2 class="h2-heading">Tentang SejukPool</h2>
                </div>
            </div>
            <div class="row align-items-center">
                <!-- Gambar di kiri -->
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <div class="image-container">
                        <img class="img-fluid" src="{{ asset('content/images/foto1.jpeg') }}" alt="alternative">
                    </div>
                </div>

                <!-- Teks di kanan -->
                <div class="col-lg-6">
                    <div class="text-container">
                        <h2>SejukPool?</h2>
                        <p class="text-justify">Selamat datang di e-Ticket SejukPool, website resmi penjualan tiket online untuk kolam renang Hulu Cai Endah! 
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
            Melalui halaman Galeri ini, kamu bisa melihat berbagai momen seru 
            dan fasilitas lengkap yang tersedia di tempat kami.
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

<!-- Location Map -->
<div class="map-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="text-container text-center">
                    <h2>LOKASI KAMI</h2>
                    
                    <!-- Map Container -->
                    <div class="map-container">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3963.605250789945!2d106.71488677410142!3d-6.571402564237241!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69dbcc6cd45bcb%3A0x993405b063eccca!2sKOLAM%20RENANG%20HULU%20CAI%20ENDAH!5e0!3m2!1sid!2sid!4v1744692709771!5m2!1sid!2sid" 
                            width="100%" 
                            height="450" 
                            style="border:0; border-radius:8px;" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                    
                    <div class="location-details">
                        <div class="row mt-4">
                            <div class="col-md-4">
                                <div class="location-item">
                                    <i class="fas fa-map-marker-alt fa-2x mb-2" style="color: #5f4dee;"></i>
                                    <h4>Alamat</h4>
                                    <p>Taman Dramaga Permai 3 Blok F7, Cihideung Udik, Kec. Ciampea, Kabupaten Bogor, Jawa Barat 16620</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="location-item">
                                    <i class="fas fa-clock fa-2x mb-2" style="color: #5f4dee;"></i>
                                    <h4>Jam Operasional</h4>
                                    <p>Setiap Hari<br>07.00 - 17.00 WIB</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="location-item">
                                    <i class="fas fa-phone-alt fa-2x mb-2" style="color: #5f4dee;"></i>
                                    <h4>Kontak</h4>
                                    <p>Telp: +62 899-076-4770</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- end of text-container -->
            </div> <!-- end of col -->
        </div> <!-- end of row -->
    </div> <!-- end of container -->
</div> <!-- end of map-section -->
<!-- end of location map -->

    @include('components.footer')

    @include('components.scripts')
</body>
</html>