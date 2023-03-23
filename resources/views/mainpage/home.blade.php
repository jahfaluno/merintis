@extends('template_merintis.merintis')

@section('head-title', 'Merintis Indonesia')

@section('meta-description')
<meta name="description" content="Merintis Indonesia - Merintis Indonesia adalah ekosistem kreatif muda/i daerah untuk saling terhubung, berkolaborasi, dan melahirkan bisnis-bisnis yang inovatif, solutif dan aplikatif dari proses hulu ke hilir.">
@endsection

@section('addCSS')
<link rel="stylesheet" href="{{ asset('assets/css/home.css') }}">
@endsection

<?php
  $isLogin = false;
  $idAkun = '';
  if (Auth::check()) {
    $isLogin = true;
  } else if (Auth::viaRemember()) {
    $isLogin = true;
  }
?>

@section('header')
{{-- ================ Header Menu Area start ================= --}}
<div class="bg-coffee">
  <header>
    <div class="mis-header">
      <div class="mis-header-logo-100">
        <a href="#">
          <img src="{{ asset('assets/img/Logo-MI.png') }}" alt="logo-mi">
        </a>
      </div>
    </div>
     {{-- BATAS NAVBAR  --}}
    <nav class="navbar navbar-expand-sm navbar-dark">
      <div class="mx-auto">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarMis" aria-controls="navbarMis" aria-expanded="false" aria-label="Toggle navigation">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
      </div>
      <div class="collapse navbar-collapse" id="navbarMis">
        <ul class="navbar-nav mx-auto">
          <li class="nav-item">
            <a class="nav-link" href="#beranda">Beranda</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#tentang">Tentang</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#program">Program</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#team">Team</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#content">Content</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="https://info-merintisindonesia.medium.com/">Blog</a>
          </li>
          <li class="nav-item">
             {{-- Login/Logout  --}}
            <div id="link-log">
              <?= ($isLogin ? '<a class="nav-link" href="javascript:void(0)" onclick="logout()">Sign Out</a>' : '<a class="nav-link" id="btnSignIn" href="'.url('/signin').'">Sign In</a>'); ?>
            </div>
             {{-- End Login/Logout  --}}
          </li>
        </ul>
      </div>
    </nav>
  </header>
  {{-- ================ END Header Menu Area ================= --}}
  @endsection

  @section('content')
  {{-- ================ FIXED ALERT ================= --}}
  <div class='fixed-alert'></div>
  {{-- ================ END FIXED ALERT ================= --}}

  {{-- ================ Section Area ================= --}}
  {{-- ============ SECTION BERANDA --}}
  <section id="beranda">
    <div class="container text-center">
      <h1 class="roboto-condensed text-white h1">Mau Bangun Bisnis Secara Praktis?</h1>
      <h1 class="roboto-condensed text-white h1 mb-4">Wujudkan bersama Merintis Indonesia!</h1>
      <div class="d-flex flex-wrap justify-content-center">
      {{-- BTN PROGRAM AND SIGNUP  --}}
      <?php
        if($isLogin) {
          echo '<a class="btn-kuning link-none my-2 mx-3" href="'.url('/#program').'">Ikuti Program</a>';
        } else {
          echo '
          <a class="btn-kuning link-none my-2 mx-3" href="'.url('/#program').'">Ikuti Program</a>
          <a href="'.url('/signup').'" class="btn-kuning link-none my-2 mx-3">Sign Up</a>
          ';
        }
      ?>
      {{-- END BTN PROGRAM AND SIGNUP --}}
      </div>
      <a href="#contact">
        <div class="box-talks">
          <span class="roboto-condensed">Talk <br>To Us!</span>
          <img src="{{ asset('assets/img/talk-to-us.png') }}" alt="talk-to-us">
        </div>
      </a>
    </div>
  </section>
</div>

{{-- ============ SECTION TENTANG --}}
<section id="tentang">
  <div class="container text-center mt-48">
    <figure class="px-48">
      <img src="{{ asset('assets/img/logo-mis-color.png') }}" alt="logo-mis" class="img-100 mb-4">
      <figcaption class="text-18 let-space-08 text-left">
        <p><b>Merintis Indonesia</b> adalah ekosistem kreatif muda/i daerah untuk saling terhubung,
          berkolaborasi, dan melahirkan bisnis-bisnis yang inovatif, solutif dan aplikatif dari proses hulu ke hilir.</p>
      </figcaption>
    </figure>

    <div class="d-flex flex-wrap justify-content-center roboto-condensed">
      <div class="mx-3 pt-2">
        <h2 class="text-gold"><span class="countA">40</span>+</h2>
        <h5 class="text-green">Communities</h5>
      </div>
      <div class="mx-3 pt-2">
        <h2 class="text-gold"><span class="countA">10</span>+</h2>
        <h5 class="text-green">Cities</h5>
      </div>
      <div class="mx-3 pt-2">
        <h2 class="text-gold"><span class="countA">30</span>+</h2>
        <h5 class="text-green">Universities</h5>
      </div>
    </div>

    <div class="d-flex flex-wrap justify-content-around roboto-condensed mt-2">
      <div class="mt-1 mx-2 pt-2">
        <h1 class="text-gold"><span class="countB">900</span>+<span class="text-green text-32">/16 Talks</span></h2>
      </div>
      <div class="mt-1 mx-2 pt-2">
        <h1 class="text-gold"><span class="countB">200</span>+<span class="text-green text-32"> Intern</span></h2>
      </div>
    </div>

    <p class="roboto-condensed text-green text-18">OUR PARTNERS</p>
    <div class="d-flex flex-wrap justify-content-center">
      <img src="{{ asset('assets/img/Picture11.png') }}" alt="madiun-muda" class="img-50 mx-3">
      <img src="{{ asset('assets/img/Picture24.png') }}" alt="maesa-group" class="img-50 mx-3">
    </div>
  </div>
</section>

{{-- ============== SECTION PROGRAM  --}}
<section id="program" class="mt-48">
  <h1 class="roboto-condensed text-center text-green mt-64">Program</h1>
  <div class="container">
      <div class="menu-program">
          <ul class="text-center">
              <li class="menu-active roboto-condensed let-space-08" id="past-program">
                  <a href="javascript:void(0)" class="link-none">PAST PROGRAM</a>
              </li>
              <li class="roboto-condensed let-space-08" id="ongoing-program">
                  <a href="javascript:void(0)" class="link-none">ON-GOING PROGRAM</a>
              </li>
              <li class="roboto-condensed let-space-08" id="upcoming-program">
                  <a href="javascript:void(0)" class="link-none">UPCOMING PROGRAM</a>
              </li>
          </ul>
      </div>
      <!-- DATA PROGRAM -->
      <div id="data-program" class="mt-32 mb-4">
          <!-- ON LOADING -->
          <div class="my-4 d-flex justify-content-center" id="loader">
              <strong class="text-center">Loading...</strong>
              <div class="mx-4 loader"></div>
          </div>

          <div class="d-flex flex-wrap justify-content-center" id="loc-data">
          </div>

          <div id="loc-btn-program" class="text-center mt-4">
          </div>
      </div>
      <!-- END DATA PROGRAM -->
  </div>
</section>

{{-- ============ SECTION TEAM --}}
<section id="team" class="mt-120">
  <div class="container roboto-condensed text-center">
    <h1 class="text-green">FOUNDER</h1>
    <h5 class="text-gold ">MERINTIS INDONESIA</h5>
    <div class="d-flex flex-wrap justify-content-center mt-3">
      <img src="{{ asset('assets/img/ceo-mi.png') }}" alt="CEO Merintis Indonesia" class="img-295 mx-4 my-1">
      <img src="{{ asset('assets/img/advisor-mi.png') }}" alt="CSO Merintis Indonesia" class="img-295 mx-4 my-1">
      <img src="{{ asset('assets/img/cmo-mi.png') }}" alt="CMO Merintis Indonesia" class="img-295 mx-4 my-1">
    </div>

    {{-- VIP TEAM  --}}
    <h1 class="text-green mt-64 roboto-condensed">Internship Program</h1>
      <div class="d-flex flex-wrap justify-content-left mt-3">
        {{-- BARIS 1  --}}
        <div class="card border-none mx-2">
          <img src="{{ asset('assets/img/intern/vip1.png') }}" alt="vip1" class="img-180 my-2">
          <div class="text-right mx-2">
            <span class="block text-green text-18">Miftahul Fauza R</span>
            <span class="block text-gold text-12">Universitas PGRI Madiun</span>
            <span class="block roboto text-grey text-10">Teknik Informatika</span>
          </div>
        </div>
        <div class="card border-none mx-2">
          <img src="{{ asset('assets/img/intern/vip2.png') }}" alt="vip2" class="img-180 my-2">
          <div class="text-right mx-2">
            <span class="block text-green text-18">Jahfal Uno S L</span>
            <span class="block text-gold text-12">Universitas Gunadarma</span>
            <span class="block roboto text-grey text-10">Teknik Informatika</span>
          </div>
        </div>
        <div class="card border-none mx-2">
          <img src="{{ asset('assets/img/intern/vip3.png') }}" alt="vip3" class="img-180 my-2">
          <div class="text-left mx-2">
            <span class="block text-green text-18">Jeffrens Tanadi</span>
            <span class="block text-gold text-12">Binus University</span>
            <span class="block roboto text-grey text-9">Business Information Technology</span>
          </div>
        </div>
        <div class="card border-none mx-2">
          <img src="{{ asset('assets/img/intern/vip4.png') }}" alt="vip4" class="img-180 my-2">
          <div class="text-left mx-2">
            <span class="block text-green text-18">Pedro Ozora</span>
            <span class="block text-gold text-12">Institut Teknologi Del</span>
            <span class="block roboto text-grey text-10">Teknologi Komputer</span>
          </div>
        </div>
        <div class="card border-none mx-2">
          <img src="{{ asset('assets/img/intern/vip5.png') }}" alt="vip5" class="img-180 my-2">
          <div class="text-left mx-2">
            <span class="block text-green text-18">Audrey Dian F</span>
            <span class="block text-gold text-12">Institut Teknologi Bandung</span>
            <span class="block roboto text-grey text-10">Matematika</span>
          </div>
        </div>
        <div class="card border-none mx-2">
          <img src="{{ asset('assets/img/intern/vip6.png') }}" alt="vip6" class="img-180 my-2">
          <div class="text-left mx-2">
            <span class="block text-green text-18">Mutia Mahhal</span>
            <span class="block text-gold text-12">Universitas Andalas</span>
            <span class="block roboto text-grey text-10">Ilmu Komunikasi</span>
          </div>
        </div>
        <div class="card border-none mx-2">
          <img src="{{ asset('assets/img/intern/vip7.png') }}" alt="vip7" class="img-180 my-2">
          <div class="text-left mx-2">
            <span class="block text-green text-18">Firdausyi Nuzulah</span>
            <span class="block text-gold text-12">Politeknik Negeri Jakarta</span>
            <span class="block roboto text-grey text-10">Manajemen Keuangan</span>
          </div>
        </div>

        {{-- BARIS 2  --}}
        <div class="card border-none mx-2">
          <img src="{{ asset('assets/img/intern/vip8.png') }}" alt="vip8" class="img-180 my-2">
          <div class="text-left mx-2">
            <span class="block text-green text-18">Dedi</span>
            <span class="block text-gold text-12">Universitas Padjajaran</span>
            <span class="block roboto text-grey text-10">Sastra Indonesia</span>
          </div>
        </div>
        <div class="card border-none mx-2">
          <img src="{{ asset('assets/img/intern/vip9.png') }}" alt="vip9" class="img-180 my-2">
          <div class="text-right mx-2">
            <span class="block text-green text-18">Dian Rahmadani L</span>
            <span class="block text-gold text-10">Universitas Negeri Surabaya</span>
            <span class="block roboto text-grey text-10">Ilmu Komunikasi</span>
          </div>
        </div>
        <div class="card border-none mx-2">
          <img src="{{ asset('assets/img/intern/vip10.png') }}" alt="vip10" class="img-180 my-2">
          <div class="text-right mx-2">
            <span class="block text-green text-18">Cindy Marilyn C</span>
            <span class="block text-gold text-10">Universitas Darma Persada</span>
            <span class="block roboto text-grey text-10">Sastra Jepang</span>
          </div>
        </div>
        <div class="card border-none mx-2">
          <img src="{{ asset('assets/img/intern/vip11.png') }}" alt="vip11" class="img-180 my-2">
          <div class="text-right mx-2">
            <span class="block text-green text-18">Eldiastari Putri A</span>
            <span class="block text-gold text-12">Universitas Gunadarma</span>
            <span class="block roboto text-grey text-10">Ilmu Komunikasi</span>
          </div>
        </div>
        <div class="card border-none mx-2">
          <img src="{{ asset('assets/img/intern/vip12.png') }}" alt="vip12" class="img-180 my-2">
          <div class="text-right mx-2">
            <span class="block text-green text-18">Adhini Bintang P</span>
            <span class="block text-gold text-12">Universitas Diponegoro</span>
            <span class="block roboto text-grey text-10">Administrasi Bisnis</span>
          </div>
        </div>
        <div class="card border-none mx-2">
          <img src="{{ asset('assets/img/intern/vip13.png') }}" alt="vip13" class="img-180 my-2">
          <div class="text-right mx-2">
            <span class="block text-green text-18">Chenny Chang</span>
            <span class="block text-gold text-8">Institut Pariwisata dan Bisnis Internasional</span>
            <span class="block roboto text-grey text-10">Hospitality Management</span>
          </div>
        </div>
        <div class="card border-none mx-2">
          <img src="{{ asset('assets/img/intern/vip14.png') }}" alt="vip14" class="img-180 my-2">
          <div class="text-right mx-2">
            <span class="block text-green text-18">Al-Hanaan</span>
            <span class="block text-gold text-12">Universitas Terbuka</span>
            <span class="block roboto text-grey text-10">Ekonomi Pembangunan</span>
          </div>
        </div>

        {{-- DISEMBUNYIKAN  --}}
          {{-- BARIS 3 --}}
          <div class="card border-none collapse hide-vip mx-2">
            <img src="{{ asset('assets/img/intern/vip15.png') }}" alt="vip15" class="img-180 my-2">
            <div class="text-left mx-2">
              <span class="block text-green text-18">Aldo Putra</span>
              <span class="block text-gold text-12">Universitas Gadjah Mada</span>
              <span class="block roboto text-grey text-10">Teknik Fisika</span>
            </div>
          </div>
          <div class="card border-none collapse hide-vip mx-2">
            <img src="{{ asset('assets/img/intern/vip16.png') }}" alt="vip16" class="img-180 my-2">
            <div class="text-left mx-2">
              <span class="block text-green text-18">Leonardo Anthony</span>
              <span class="block text-gold text-12">Universitas Gadjah Mada</span>
              <span class="block roboto text-grey text-10">Teknik Kimia</span>
            </div>
          </div>
          <div class="card border-none collapse hide-vip mx-2">
            <img src="{{ asset('assets/img/intern/vip17.png') }}" alt="vip17" class="img-180 my-2">
            <div class="text-left mx-2">
              <span class="block text-green text-18">Dwi Khoiriyah</span>
              <span class="block text-gold text-12">Politeknik Negeri Jakarta</span>
              <span class="block roboto text-grey text-10">Administrasi Bisnis Terapan</span>
            </div>
          </div>
          <div class="card border-none collapse hide-vip mx-2">
            <img src="{{ asset('assets/img/intern/vip18.png') }}" alt="vip18" class="img-180 my-2">
            <div class="text-left mx-2">
              <span class="block text-green text-18">Raihan Ariq</span>
              <span class="block text-gold text-12">Binus University</span>
              <span class="block roboto text-grey text-10">IT dan Statistika</span>
            </div>
          </div>
          <div class="card border-none collapse hide-vip mx-2">
            <img src="{{ asset('assets/img/intern/vip19.png') }}" alt="vip19" class="img-180 my-2">
            <div class="text-left mx-2">
              <span class="block text-green text-18">Novitriana Gadis</span>
              <span class="block text-gold text-12">Telkom University</span>
              <span class="block roboto text-grey text-10">Sistem Informasi</span>
            </div>
          </div>
          <div class="card border-none collapse hide-vip mx-2">
            <img src="{{ asset('assets/img/intern/vip20.png') }}" alt="vip20" class="img-180 my-2">
            <div class="text-left mx-2">
              <span class="block text-green text-18">Asna Af'idatul</span>
              <span class="block text-gold text-12">Universitas Brawijaya</span>
              <span class="block roboto text-grey text-10">Ilmu Administrasi Bisnis</span>
            </div>
          </div>
          <div class="card border-none collapse hide-vip mx-2">
            <img src="{{ asset('assets/img/intern/vip21.png') }}" alt="vip21" class="img-180  my-2">
            <div class="text-right mx-2">
              <span class="block text-green text-18">Yuwinda Meysella</span>
              <span class="block text-gold text-12">Universitas Negeri Malang</span>
              <span class="block roboto text-grey text-10">Manajemen</span>
            </div>
          </div>

          {{-- BARIS 4 --}}
          <div class="card border-none collapse hide-vip mx-2">
            <img src="{{ asset('assets/img/intern/vip22.png') }}" alt="vip22" class="img-180  my-2">
            <div class="text-left mx-2">
              <span class="block text-green text-18">Mutiara Suci R</span>
              <span class="block text-gold text-12">IKOPIN</span>
              <span class="block roboto text-grey text-10">Manajemen</span>
            </div>
          </div>
          <div class="card border-none collapse hide-vip mx-2">
            <img src="{{ asset('assets/img/intern/vip23.png') }}" alt="vip23" class="img-180 my-2">
            <div class="text-right mx-2">
              <span class="block text-green text-18">Jovita Aurelia</span>
              <span class="block text-gold text-10">Universitas Katolik Atma Jaya</span>
              <span class="block roboto text-grey text-10">Teknologi Pangan</span>
            </div>
          </div>
          <div class="card border-none collapse hide-vip mx-2">
            <img src="{{ asset('assets/img/intern/vip24.png') }}" alt="vip24" class="img-180 my-2">
            <div class="text-right mx-2">
              <span class="block text-green text-18">Bagus Pamungkas</span>
              <span class="block text-gold text-12">UNMUH Prof Dr Hamka</span>
              <span class="block roboto text-grey text-10">Manajemen</span>
            </div>
          </div>
          <div class="card border-none collapse hide-vip mx-2">
            <img src="{{ asset('assets/img/intern/vip25.png') }}" alt="vip25" class="img-180  my-2">
            <div class="text-right mx-2">
              <span class="block text-green text-18">Reni Ridayanti</span>
              <span class="block text-gold text-12">Universitas Negeri Malang</span>
              <span class="block roboto text-grey text-10">Ekonomi Pembangunan</span>
            </div>
          </div>
          <div class="card border-none collapse hide-vip mx-2">
            <img src="{{ asset('assets/img/intern/vip26.png') }}" alt="vip26" class="img-180 my-2">
            <div class="text-left mx-2">
              <span class="block text-green text-18">Maasa Sunreza M</span>
              <span class="block text-gold text-12">Universitas Airlangga</span>
              <span class="block roboto text-grey text-10">Fakultas Kedokteran</span>
            </div>
          </div>

          {{-- BARIS 5 --}}
          <div class="card border-none collapse hide-vip mx-2">
            <img src="{{ asset('assets/img/intern/vip27.png') }}" alt="vip27" class="img-180 my-2">
            <div class="text-left mx-2">
              <span class="block text-green text-18">Asmawi Anwar</span>
              <span class="block text-gold text-12">Universitas PGRI Madiun</span>
              <span class="block roboto text-grey text-10">Pendidikan Guru Sekolah Dasar</span>
            </div>
          </div>
          <div class="card border-none collapse hide-vip mx-2">
            <img src="{{ asset('assets/img/intern/vip28.png') }}" alt="vip28" class="img-180  my-2">
            <div class="text-left mx-2">
              <span class="block text-green text-18">Rr. Nektara Titan</span>
              <span class="block text-gold text-12">Universitas Jember</span>
              <span class="block roboto text-grey text-10">Pendidikan Dokter Gigi</span>
            </div>
          </div>
          <div class="card border-none collapse hide-vip mx-2">
            <img src="{{ asset('assets/img/intern/vip29.png') }}" alt="vip29" class="img-180 my-2">
            <div class="text-right mx-2">
              <span class="block text-green text-18">Emi Yanti P</span>
              <span class="block text-gold text-12">Universitas Diponegoro</span>
              <span class="block roboto text-grey text-10">Manajemen</span>
            </div>
          </div>
          <div class="card border-none collapse hide-vip mx-2">
            <img src="{{ asset('assets/img/intern/vip30.png') }}" alt="vip30" class="img-180  my-2">
            <div class="text-right mx-2">
              <span class="block text-green text-18">Mujahid Najib</span>
              <span class="block text-gold text-12">Universitas Indonesia</span>
              <span class="block roboto text-grey text-10">Geofisika</span>
            </div>
          </div>
          <div class="card border-none collapse hide-vip mx-2">
            <img src="{{ asset('assets/img/intern/vip31.png') }}" alt="vip31" class="img-180 my-2">
            <div class="text-left mx-2">
              <span class="block text-green text-18">Haryadi Bagus</span>
              <span class="block text-gold text-12">Universitas Brawijaya</span>
              <span class="block roboto text-grey text-10">Peternakan</span>
            </div>
          </div>
          <div class="card border-none collapse hide-vip mx-2">
            <img src="{{ asset('assets/img/intern/vip32.png') }}" alt="vip32" class="img-180  my-2">
            <div class="text-left mx-2">
              <span class="block text-green text-18">Syachfara N</span>
              <span class="block text-gold text-12">Universitas Bina Nusantara</span>
              <span class="block roboto text-grey text-10">Public Relations</span>
            </div>
          </div>
          <div class="card border-none collapse hide-vip mx-2">
            <img src="{{ asset('assets/img/intern/vip33.png') }}" alt="vip33" class="img-180 my-2">
            <div class="text-right mx-2">
              <span class="block text-green text-18">Diva Zulfania T</span>
              <span class="block text-gold text-12">Universitas Negeri Malang</span>
              <span class="block roboto text-grey text-10">Teknik Mesin</span>
            </div>
          </div>
          <div class="card border-none collapse hide-vip mx-2">
            <img src="{{ asset('assets/img/intern/vip34.png') }}" alt="vip34" class="img-180 my-2">
            <div class="text-right mx-2">
              <span class="block text-green text-18">Syafira Nur Alifah</span>
              <span class="block text-gold text-12">Universitas Padjajaran</span>
              <span class="block roboto text-grey text-10">Hubungan Internasional</span>
            </div>
          </div>
          <div class="card border-none collapse hide-vip mx-2">
            <img src="{{ asset('assets/img/intern/vip35.png') }}" alt="vip35" class="img-180 my-2">
            <div class="text-right mx-2">
              <span class="block text-green text-18">Anggraeni Dwi A</span>
              <span class="block text-gold text-12">Griffith University Australia</span>
              <span class="block roboto text-grey text-10">Hubungan Internasional</span>
            </div>
          </div>

        {{-- BARIS 6 --}}
        <div class="card border-none collapse hide-vip mx-2">
          <img src="{{ asset('assets/img/intern/vip36.png') }}" alt="vip36" class="img-180 my-2">
          <div class="text-right mx-2">
            <span class="block text-green text-18">Husein Wisnu</span>
            <span class="block text-gold text-12">Universitas Brawijaya</span>
            <span class="block roboto text-grey text-10">Statistika</span>
          </div>
        </div>
        <div class="card border-none collapse hide-vip mx-2">
          <img src="{{ asset('assets/img/intern/vip37.png') }}" alt="vip37" class="img-180  my-2">
          <div class="text-left mx-2">
            <span class="block text-green text-18">Salsa-Billa S.</span>
            <span class="block text-gold text-10">Universitas Negeri Yogyakarta</span>
            <span class="block roboto text-grey text-10">Statistika</span>
          </div>
        </div>
        <div class="card border-none collapse hide-vip mx-2">
          <img src="{{ asset('assets/img/intern/vip38.png') }}" alt="vip38" class="img-180  my-2">
          <div class="text-right mx-2">
            <span class="block text-green text-16">Melfin Aufatussafa</span>
            <span class="block text-gold text-10">Universitas Muh. Semarang</span>
            <span class="block roboto text-grey text-10">Statistika</span>
          </div>
        </div>
        <div class="card border-none collapse hide-vip mx-2">
          <img src="{{ asset('assets/img/intern/vip39.png') }}" alt="vip39" class="img-180 my-2">
          <div class="text-right mx-2">
            <span class="block text-green text-16">Corrine Clarabelle</span>
            <span class="block text-gold text-12">Monash University</span>
            <span class="block roboto text-grey text-9">Bachelor of Computer Science</span>
          </div>
        </div>
        <div class="card border-none collapse hide-vip mx-2">
          <img src="{{ asset('assets/img/intern/vip40.png') }}" alt="vip40" class="img-180 my-2">
          <div class="text-left mx-2">
            <span class="block text-green text-18">Lalita Gale</span>
            <span class="block text-gold text-12">Universitas Airlangga</span>
            <span class="block roboto text-grey text-10">English Literature</span>
          </div>
        </div>
        <div class="card border-none collapse hide-vip mx-2">
          <img src="{{ asset('assets/img/intern/vip41.png') }}" alt="vip41" class="img-180  my-2">
          <div class="text-left mx-2">
            <span class="block text-green text-18">Lavenia P.</span>
            <span class="block text-gold text-12">Universitas PGRI Madiun</span>
            <span class="block roboto text-grey text-10">Manajemen</span>
          </div>
        </div>
        <div class="card border-none collapse hide-vip mx-2">
          <img src="{{ asset('assets/img/intern/vip42.png') }}" alt="vip42" class="img-180 my-2">
          <div class="text-right mx-2">
            <span class="block text-green text-18">Mella Purwati</span>
            <span class="block text-gold text-12">Universitas PGRI Madiun</span>
            <span class="block roboto text-grey text-10">Manajemen</span>
          </div>
        </div>

        {{-- BARIS 7 --}}
        <div class="card border-none collapse hide-vip mx-2">
          <img src="{{ asset('assets/img/intern/vip43.png') }}" alt="vip43" class="img-180 my-2">
          <div class="text-right mx-2">
            <span class="block text-green text-18">Adhie Satria</span>
            <span class="block text-gold text-12">SMK Negeri 1 Madiun</span>
            <span class="block roboto text-grey text-10">Teknik Bangunan</span>
          </div>
        </div>
        <div class="card border-none collapse hide-vip mx-2">
          <img src="{{ asset('assets/img/intern/vip44.png') }}" alt="vip44" class="img-180  my-2">
          <div class="text-left mx-2">
            <span class="block text-green text-18">Alif Masykhuri</span>
            <span class="block text-gold text-12">Universitas PGRI Madiun</span>
            <span class="block roboto text-grey text-10">PGSD</span>
          </div>
        </div>
        <div class="card border-none collapse hide-vip mx-2">
          <img src="{{ asset('assets/img/intern/vip45.png') }}" alt="vip45" class="img-180  my-2">
          <div class="text-right mx-2">
            <span class="block text-green text-16">Ervina N.</span>
            <span class="block text-gold text-12">Universitas Brawijaya</span>
            <span class="block roboto text-grey text-9">Pendidikan Teknologi Informasi</span>
          </div>
        </div>
        <div class="card border-none collapse hide-vip mx-2">
          <img src="{{ asset('assets/img/intern/vip46.png') }}" alt="vip46" class="img-180 my-2">
          <div class="text-right mx-2">
            <span class="block text-green text-16">Ayu Safitri</span>
            <span class="block text-gold text-12">Universitas PGRI Madiun</span>
            <span class="block roboto text-grey text-10">Matematika</span>
          </div>
        </div>
        <div class="card border-none collapse hide-vip mx-2">
          <img src="{{ asset('assets/img/intern/vip47.png') }}" alt="vip47" class="img-180 my-2">
          <div class="text-left mx-2">
            <span class="block text-green text-18">Anandieto Akbar</span>
            <span class="block text-gold text-12">SMA Negeri 2 Madiun</span>
            <span class="block roboto text-grey text-10">MIPA</span>
          </div>
        </div>
        <div class="card border-none collapse hide-vip mx-2">
          <img src="{{ asset('assets/img/intern/vip48.png') }}" alt="vip48" class="img-180  my-2">
          <div class="text-left mx-2">
            <span class="block text-green text-18">Gigih Prima Dilah</span>
            <span class="block text-gold text-9">Poltek. Elektronika Negeri Surabaya</span>
            <span class="block roboto text-grey text-10">Teknik Elektro Industri</span>
          </div>
        </div>
        <div class="card border-none collapse hide-vip mx-2">
          <img src="{{ asset('assets/img/intern/vip49.png') }}" alt="vip49" class="img-180 my-2">
          <div class="text-right mx-2">
            <span class="block text-green text-18">Fahrudin Nur K.</span>
            <span class="block text-gold text-12">Universitas PGRI Madiun</span>
            <span class="block roboto text-grey text-10">Manajemen</span>
          </div>
        </div>

        {{-- BARIS 8 --}}
        <div class="card border-none collapse hide-vip mx-2">
          <img src="{{ asset('assets/img/intern/vip50.png') }}" alt="vip50" class="img-180 my-2">
          <div class="text-right mx-2">
            <span class="block text-green text-18">Reya Noer R.</span>
            <span class="block text-gold text-9">Unv. Swadaya Gunung Jati Cirebon</span>
            <span class="block roboto text-grey text-10">Manajemen</span>
          </div>
        </div>
        <div class="card border-none collapse hide-vip mx-2">
          <img src="{{ asset('assets/img/intern/vip51.png') }}" alt="vip51" class="img-180  my-2">
          <div class="text-left mx-2">
            <span class="block text-green text-18">Muhamad Asnul</span>
            <span class="block text-gold text-12">Universitas PGRI Madiun</span>
            <span class="block roboto text-grey text-10">Manajemen</span>
          </div>
        </div>
        <div class="card border-none collapse hide-vip mx-2">
          <img src="{{ asset('assets/img/intern/vip52.png') }}" alt="vip52" class="img-180  my-2">
          <div class="text-right mx-2">
            <span class="block text-green text-16">Putri C.</span>
            <span class="block text-gold text-12">Universitas PGRI Madiun</span>
            <span class="block roboto text-grey text-9">Teknik Industri</span>
          </div>
        </div>
        <div class="card border-none collapse hide-vip mx-2">
          <img src="{{ asset('assets/img/intern/vip53.png') }}" alt="vip53" class="img-180 my-2">
          <div class="text-right mx-2">
            <span class="block text-green text-16">Fitria Haqsari</span>
            <span class="block text-gold text-12">Universitas Negeri Malang</span>
            <span class="block roboto text-grey text-10">Pendidikan Akuntansi</span>
          </div>
        </div>
        <div class="card border-none collapse hide-vip mx-2">
          <img src="{{ asset('assets/img/intern/vip54.png') }}" alt="vip54" class="img-180 my-2">
          <div class="text-left mx-2">
            <span class="block text-green text-18">Febry Heri S.</span>
            <span class="block text-gold text-12">Politeknik Negeri Madiun</span>
            <span class="block roboto text-grey text-10">Komputer Akuntansi</span>
          </div>
        </div>
        <div class="card border-none collapse hide-vip mx-2">
          <img src="{{ asset('assets/img/intern/vip55.png') }}" alt="vip55" class="img-180  my-2">
          <div class="text-left mx-2">
            <span class="block text-green text-18">Demas Wilman</span>
            <span class="block text-gold text-12">Universitas PGRI Madiun</span>
            <span class="block roboto text-grey text-10">Pendidikan Biologi</span>
          </div>
        </div>
        <div class="card border-none collapse hide-vip mx-2">
          <img src="{{ asset('assets/img/intern/vip56.png') }}" alt="vip56" class="img-180 my-2">
          <div class="text-right mx-2">
            <span class="block text-green text-18">Firdausyi R.</span>
            <span class="block text-gold text-12">Universitas Gadjah Mada</span>
            <span class="block roboto text-grey text-8">Pembangunan Ekonomi Kewilayahan</span>
          </div>
        </div>

          {{-- BARIS 9 --}}
          <div class="card border-none collapse hide-vip mx-2">
            <img src="{{ asset('assets/img/intern/vip57.png') }}" alt="vip57" class="img-180 my-2">
            <div class="text-right mx-2">
              <span class="block text-green text-18">Fairuz Zahira</span>
              <span class="block text-gold text-12">Poltekesos Bandung</span>
              <span class="block roboto text-grey text-10">Pekerja Sosial</span>
            </div>
          </div>
          <div class="card border-none collapse hide-vip mx-2">
            <img src="{{ asset('assets/img/intern/vip58.png') }}" alt="vip58" class="img-180  my-2">
            <div class="text-left mx-2">
              <span class="block text-green text-18">Sarah Fahira</span>
              <span class="block text-gold text-10">Universitas Merdeka Madiun</span>
              <span class="block roboto text-grey text-10">Hukum</span>
            </div>
          </div>
          <div class="card border-none collapse hide-vip mx-2">
            <img src="{{ asset('assets/img/intern/vip59.png') }}" alt="vip59" class="img-180  my-2">
            <div class="text-right mx-2">
              <span class="block text-green text-16">Ira Dhamayanti</span>
              <span class="block text-gold text-12">Universitas Brawijaya</span>
              <span class="block roboto text-grey text-9">Ilmu Administrasi Bisnis</span>
            </div>
          </div>
          <div class="card border-none collapse hide-vip mx-2">
            <img src="{{ asset('assets/img/intern/vip60.png') }}" alt="vip60" class="img-180 my-2">
            <div class="text-right mx-2">
              <span class="block text-green text-16">Rifka Jamalia</span>
              <span class="block text-gold text-12">Universitas Indonesia</span>
              <span class="block roboto text-grey text-10">Sosiologi</span>
            </div>
          </div>
        {{-- END DISEMBUNYIKAN  --}}

    </div>
    {{-- BUTTON_SELENGKAPNYA --}}
    <button type="button" class="button-kuning border-none roboto-condensed let-space-08 my-4" data-toggle="collapse" data-target=".hide-vip" id="btnMore">Selengkapnya</button>
</section>

{{-- ============ SECTION CONTENT --}}
<section id="content" class="my-4">
  <div class="container roboto-condensed text-center">
  <h1 class="text-green mt-64">Our Content</h1>
      <div class="d-flex flex-wrap justify-content-center mt-3">
      <div class="card-content mx-2 my-2">
          <a href="https://www.instagram.com/merintis.indonesia/guide/mis-talkshow/17857178675481615/" target="_blank">
              <div class="overlay-content text-white text-left p-4">
                <h6 class="text-content">MIS TALKSHOW</h6>
              </div>
              <img src="{{ asset('assets/img/mistalkshow.png') }}" alt="mistalkshow" class="img-295">
          </a>
        </div>
        <div class="card-content  mx-2 my-2">
            <a href="https://www.instagram.com/merintis.indonesia/guide/podcast-merintis-indonesia/18146108674127830/" target="_blank">
              <div class="overlay-content text-white text-left p-4">
                <h6 class="text-content">PODCAST MERINTIS INDONESIA</h6>
              </div>
            <img src="{{ asset('assets/img/podcast.png') }}" alt="podcast" class="img-295">
          </a>
        </div>
        <div class="card-content  mx-2 my-2">
            <a href="https://www.instagram.com/merintis.indonesia/guide/berita-bisnis-merintis-indonesia/17896639051763833/" target="_blank">
            <div class="overlay-content text-white text-left p-4">
              <h6 class="text-content">BERITA BISNIS MERINTIS INDONESIA</h6>
            </div>
            <img src="{{ asset('assets/img/berita_bisnis.png') }}" alt="berita-bisnis" class="img-295">
          </a>
        </div>
        <div class="card-content  mx-2 my-2">
          <a href="https://www.instagram.com/merintis.indonesia/guide/intern-talks/18152822482113725/" target="_blank">
            <div class="overlay-content text-white text-left p-4">
              <h6 class="text-content">INTERN TALKS</h6>
            </div>
            <img src="{{ asset('assets/img/intern_talk.png') }}" alt="intern-talk" class="img-295">
          </a>
        </div>
      </div>
  </div>
</section>
{{-- ============ END SECTION CONTENT --}}

{{-- ============ SECTION CONTACT US --}}
<section id="contact" class="text-center">
  <div class="mis-header-logo-100">
    <img src="{{ asset('assets/img/mis-white.png') }}" alt="logo-mis">
  </div>
  <h3 class="roboto-condensed text-white mt-2">MERINTIS INDONESIA</h3>
  <h3 class="roboto-condensed text-white mb-4">BERSAMA PENGUSAHA MUDA</h3>
  <span class="btn-hijau px-4">Contact Us</span>
  <div class="d-flex justify-content-center flex-nowrap mt-4">
    <span class="sosmed">
      <a class="overlay" href="https://wa.me/+6285785036770" target="_blank"></a>
      <img src="{{ asset('assets/img/sosmed1.svg') }}" alt="WA">
    </span>
    <span class="sosmed">
      <a class="overlay" href="https://www.facebook.com/merintisindonesia/" target="_blank"></a>
      <img src="{{ asset('assets/img/sosmed2.svg') }}" alt="fb">
    </span>
    <span class="sosmed">
      <a class="overlay" href="https://open.spotify.com/show/2v1GGLrQU076JQ9LZTLi52?si=nf_wLH8JTUOSOcStfSdZ-w" target="_blank"></a>
      <img src="{{ asset('assets/img/sosmed3.svg') }}" alt="spotify">
    </span>
  </div>
  <div class="d-flex justify-content-center flex-nowrap mt-2">
    <span class="sosmed">
      <a class="overlay" href="https://www.instagram.com/merintis.indonesia/" target="_blank"></a>
      <img src="{{ asset('assets/img/sosmed4.svg') }}" alt="IG">
    </span>
    <span class="sosmed">
      <a class="overlay" href="https://twitter.com/MerintisID?s=08" target="_blank"></a>
      <img src="{{ asset('assets/img/sosmed5.svg') }}" alt="twitter" >
    </span>
    <span class="sosmed">
      <a class="overlay" href="https://vt.tiktok.com/ZStJL8Gp/" target="_blank"></a>
      <img src="{{ asset('assets/img/sosmed6.svg') }}" alt="tiktok"}>
    </span>
  </div>
  <div class="d-flex justify-content-center flex-nowrap mt-2">
    <span class="sosmed">
      <a class="overlay" href="mailto:info.merintisindonesia@gmail.com" target="_blank"></a>
      <img src="{{ asset('assets/img/sosmed7.svg') }}" alt="email">
    </span>
    <span class="sosmed">
      <a class="overlay" href="https://www.linkedin.com/company/merintis-indonesia" target="_blank"></a>
      <img src="{{ asset('assets/img/sosmed8.svg') }}" alt="linkedin">
    </span>
    <span class="sosmed">
      <a class="overlay" href="https://info-merintisindonesia.medium.com/" target="_blank"></a>
      <img src="{{ asset('assets/img/sosmed9.svg') }}" target="_blank" alt="link">
    </span>
  </div>
</section>
{{-- ================ END Section Area ================= --}}
@endsection

@section('footer')
{{-- ================ Footer Area ================= --}}
<footer class="roboto py-2">
  <div class="container text-center">
    <span class="text-grey">Copyright &copy; <span id="yearNow">tahun</span> All rights reserved</span>
  </div>
</footer>
{{-- ================ END Footer Area ================= --}}
@endsection

@section('addScript')
<script>
  // Tambahan Script

  // SMOOTH SCROLL
  $(document).ready(function() {
    $("a").on("click", function(event) {
      if (this.hash !== "") {
        event.preventDefault();
        let hash = this.hash;

        $("html, body").animate({
          scrollTop: $(hash).offset().top
        }, 800, function() {
          window.location.hash = hash;
        });
      }
    });
  });

  // ----------- CEK JIKA DARI HALAMAN DAFTAR -----------
  $(document).ready(function() {
    let params = (new URL(document.location)).searchParams;
    let stat = parseInt(params.get('stat'));
    if (stat) {
      $("#modalLogin").modal('toggle');
    }
  });
  // ----------- END CEK JIKA DARI HALAMAN DAFTAR -----------

  // SHOW NAVBAR FIXED
  window.onscroll = changeNav;

  function changeNav() {
    let navbar = $('nav');
    if (window.pageYOffset > 90) {
      navbar.addClass('navbar-fixed')
    } else {
      navbar.removeClass('navbar-fixed');
    }
  }

  // GET YEAR NOW
  let date = new Date();
  let now = date.getFullYear();
  document.getElementById("yearNow").innerHTML = now;

  // COUNT UP ANIMATION
  $(document).ready(function() {
    countUp(".countA");
    countUp(".countB");

    function countUp(target) {
      let a = 0;
      $(window).scroll(function() {

        let oTop = $(target).offset().top - window.innerHeight;
        if (a == 0 && $(window).scrollTop() > oTop) {
          $(target).each(function() {
            let $this = $(this);
            jQuery({
              Counter: 0
            }).animate({
              Counter: $this.text()
            }, {
              duration: 1250,
              easing: 'swing',
              step: function() {
                $this.text(Math.ceil(this.Counter));
              }
            });
          });
          a = 1;
        }
      });
    }
  });

  // ==================== LOGOUT ===================
  function logout() {
    //console.log("Berhasil logout");
    // --------------- LOGOUT -------------------
    $(this).on("click", function() {
      // ------ MENGHAPUS SESSION DI DATABASE
      $('#link-log').addClass("active");
      $.ajax({
        type: "post",
        url: "{{ url('/akun/hapussession') }}",
        data: {"_token": "{{ csrf_token() }}" },
        success: function() {
          window.location.replace("{{ url('/') }}");
        },
        error: function(err) {
          // console.error(err)
        }
      })
      // ------ END MENGHAPUS SESSION DI DATABASE
    })
  }
  // ==================== END LOGOUT ===============

  // ------------------ FIXED ALERT
  function alFixedBerhasil(pesan) {
    let alBerhasil = `
      <div class="alert alert-success alert-dismissible fade show" role="alert">
      <div id="text-berhasil">${pesan}</div>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
      </button>
      </div>
      `
    $('.fixed-alert').html(alBerhasil)
    $('.fixed-alert').html(alBerhasil).animate({
      right: '12px'
    })

    $('.fixed-alert .close').on("click", function() {
      $('.fixed-alert').animate({
        right: '-100px'
      });
      $('.fixed-alert .alert').removeClass('.show');
    })
  }

  function alFixedGagal(pesan) {
    let alGagal = `
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <div id="text-berhasil">${pesan}</div>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
      </button>
      </div>
      `
    $('.fixed-alert').html(alGagal).animate({
      right: '12px'
    })

    $('.fixed-alert .close').on("click", function() {
      $('.fixed-alert').animate({
        right: '-100px'
      });
      $('.fixed-alert .alert').removeClass('.show');
    })
  }
  // -------------------------- END FIXED ALERT

  // ------------------ BTN COLLAPSE VIP ----------------
  $('.hide-vip').on('show.bs.collapse', function() {
    $('#btnMore').html('Sedikit')
  })
  $('.hide-vip').on('hide.bs.collapse', function() {
    $('#btnMore').html('Selengkapnya')
  })
  // ------------------ END BTN COLLAPSE VIP ----------------

  // SHOW MESSAGE SUCCESS LOGIN
      if(sessionStorage.getItem("login") === "berhasil") {
        alFixedBerhasil('Login Berhasil')
        sessionStorage.removeItem("login")
      }
  // END SHOW MESSAGE SUCCESS LOGIN

  // -------- SCROLL SPY
  let beranda = document.querySelector("#beranda");
  let tentang = document.querySelector("#tentang");
  let program = document.querySelector("#program");
  let team = document.querySelector("#team");
  let content = document.querySelector("#content");
  let contact = document.querySelector("#contact");

  window.addEventListener("scroll", () => {
    var windo = window.pageYOffset;
    if (beranda.offsetTop <= windo && tentang.offsetTop - 100 > windo) {
      $(".nav-item").eq(1).removeClass("active");
      $(".nav-item").eq(0).addClass("active");
      $(".box-talks").css({"position": "absolute", "color": "#ffffff"});
      // console.log("beranda");
    } else if (tentang.offsetTop - 100 <= windo && program.offsetTop - 100 > windo) {
      $(".nav-item").eq(0).removeClass("active");
      $(".nav-item").eq(2).removeClass("active");
      $(".nav-item").eq(1).addClass("active");
      $(".box-talks").css({"position": "fixed", "color": "#3a3434"});
      // console.log("tentang");
    } else if (program.offsetTop - 100 <= windo && team.offsetTop - 100 > windo) {
      $(".nav-item").eq(1).removeClass("active");
      $(".nav-item").eq(3).removeClass("active");
      $(".nav-item").eq(2).addClass("active");
      $(".box-talks").css({"position": "fixed", "color": "#3a3434"});
      // console.log("program");
    } else if (team.offsetTop - 100 <= windo && content.offsetTop - 100 > windo) {
      $(".nav-item").eq(2).removeClass("active");
      $(".nav-item").eq(4).removeClass("active");
      $(".nav-item").eq(3).addClass("active");
      // $(".box-talks").css({"position": "fixed", "color": "#3a3434", "display": "block"});
      $(".box-talks").css({"position": "fixed", "color": "#3a3434"});
      // console.log("kriteria");
    } else if (content.offsetTop - 100 <= windo && contact.offsetTop - 300 > windo) {
      $(".nav-item").eq(5).removeClass("active");
      $(".nav-item").eq(4).addClass("active");
      $(".nav-item").eq(3).removeClass("active");
      $(".box-talks").css({"position": "fixed", "color": "#3a3434", "display": "block"});
    } else if (contact.offsetTop - 300 <= windo) {
      $(".box-talks").css({"display": "none"});
    }

  })
  // -------- SCROLL SPY

  // ========== BTN SIGNIN
  $('#btnSignIn').on("click", function() {
    $('#link-log').addClass("active");
  })
  // ========== END BTN SIGNIN

  // ============ PROSES MENGOLAH DATA
  function getPastProg() {
    // Ambil Data PAST PROGRAM
    $.ajax({
        type: "get",
        url: "{{ url('/home/pastprogram/0') }}",
        beforeSend: function() {
                $("#loader").addClass('d-flex');
                $("#loader").removeClass('d-none');
                $("#btnNextProgram").addClass('wait');
                $("#btnNextProgram").attr('disabled', true);
            },
        success: function(data) {
            //console.log(data)
            let dtPast = ''
            $.each(data.pastProg, (index, val) => {
                dtPast +=
                `
                <div class="card-prog border-none">
                    <div class="custom-card">
                        <span class="roboto-condensed">${val.nama_program}</span>
                        <a href="${val.link_dokumentasi}" target="_blank">
                            <img src="{{ asset('storage/images/programs/') }}/${val.link_pamflet}" loading="lazy" alt="${val.nama_program}" class="img-prog-180 border-gold-mis mx-2 mx-md-4 my-2">
                        </a>
                    </div>
                </div>
                `
            })
            const btnNextprev = `
            <button id="btnPrevProgram" class="btn-prevNext mx-2" onclick="prevProgram(${data.next})" disabled><i class="mr-2 fas fa-chevron-left"></i> Prev</button>
            <button id="btnNextProgram" class="btn-prevNext" onclick="nextProgram(${data.next})">Next <i class="ml-2 fas fa-chevron-right"></i></button>
            `
            $("#btnNextProgram").removeClass('wait');
            $("#btnNextProgram").attr('disabled', false);
            $('#loc-data').html(dtPast)
            $('#loc-btn-program').html(btnNextprev)
            $('#loader').removeClass('d-flex')
            $('#loader').addClass('d-none')
        },
        error: function(err) {
            console.error(err)
        }
    })
  }

  function getOngoingProg() {
    $.ajax({
        type:"get",
        url:"{{ url('/home/ongoingprogram') }}",
        beforeSend: function() {
            $("#loader").addClass('d-flex');
            $("#loader").removeClass('d-none');
        },
        success: function(data) {
            // console.log(data)
            let dtOngo = ''
            $.each(data, function(index, val) {
                let endDate = new Date(val.tgl_selesai)
                let startDate = new Date(val.tgl_mulai)
                startDate = startDate.toDateString()
                endDate = (val.tgl_selesai === null) ? "" : "- "+endDate.toDateString()

                dtOngo +=
                `
                <div class="card-prog border-none m-sm-2 bg-white rounded">
                    <div class="card-body-prog px-1 px-2 py-2 border-gold">
                    <img src="{{ asset('storage/images/programs/') }}/${val.link_pamflet}" alt="${val.nama_program}" class="img-prog-180 mx-1 x-md-4 my-2">
                        <p class="roboto" style="width: 150px;">
                        ${val.nama_program}: <br>
                        <span class="roboto-condensed">${val.nama_kegiatan}</span>
                        </p>
                        <table style="width: 160px; font-size: 14px;">
                            <tr>
                                <td><small>${startDate}</small></td>
                                <td><small>${val.jam_mulai}</small></td>
                            </tr>
                            <tr>
                                <td><small>${endDate}</small></td>
                                <td><small>- ${val.jam_selesai} WIB</small></td>
                            </tr>
                        </table>
                        <p class="roboto-condensed" style="width: 150px; font-size: 12px;">*${val.sasaran_program}</p>
                    </div>
                    <a href="javascript:void(0)" onclick="secureIDProgram(${val.id})" class="btn-kuning link-none text-white d-block mx-auto my-2 text-center">DETAIL</a>
                </div>
                `
            })
            $('#loc-data').html(dtOngo)
            $('#loc-btn-program').html('')
            $("#loader").removeClass('d-flex');
            $("#loader").addClass('d-none');
        },
        error: function(err) {
            console.error(err)
        }
    })
  }

  function getUpcomProg() {
    $.ajax({
      type:"get",
      url:"{{ url('/home/upcomingprogram') }}",
      beforeSend: function() {
          $("#loader").addClass('d-flex');
          $("#loader").removeClass('d-none');
      },
      success: function(data) {
          // console.log(data)
          let dtUpco = ''
          $.each(data, function(index, val) {
              let endDate = new Date(val.tgl_selesai)
              let startDate = new Date(val.tgl_mulai)
              startDate = startDate.toDateString()
              endDate = (val.tgl_selesai === null) ? "" : "- "+endDate.toDateString()
              let jamTambah = (val.jam_tambahan) ? ` & ${val.jam_tambahan}` : ''
              //console.log(endDate)

              dtUpco +=
                `<div class="card border-none mx-2 my-2">
                    <div class="program-card radius-12px bg-upcoming p-3">
                        <h5 class="roboto-condensed">${val.nama_program}</h5>
                        <h6 class="roboto-condensed">${val.nama_kegiatan}</h6>
                        <b class="text-14 roboto-condensed">Yang akan kamu pelajari</b>
                        ${val.desc_program}
                        <div class="mx-1 mx-sm-2 row roboto-condensed">
                            <div class="col-7">
                              ${startDate} ${endDate}
                            </div>
                            <div class="col-5">
                                Limited Seats
                            </div>
                        </div>
                        <div class="mx-2 row roboto text-11">
                            <div class="col-7">
                                ${val.jam_mulai} - ${val.jam_selesai} ${jamTambah}
                            </div>
                            <div class="col-5">
                              ${val.metode_pelaksanaan}
                            </div>
                        </div>
                    </div>
                    <a href="javascript:void(0)" onclick="secureIDUpcoming(${val.id})" class="btn-kuning link-none text-white d-block mx-auto my-2 text-center">Daftar Sekarang</a>
                </div>
                `
          })
          $('#loc-data').html(dtUpco)
          $('#loc-btn-program').html('')
          $("#loader").removeClass('d-flex')
          $("#loader").addClass('d-none')
      },
      error: function(err) {
          console.error(err)
      }
    })
  }

  // MOVE TAB PROGRAM
  $(document).ready(function() {
      // PAST PROGRAM
      $('#past-program').on("click", function() {
        $('#past-program').addClass('menu-active')
        $('#ongoing-program').removeClass('menu-active')
        $('#upcoming-program').removeClass('menu-active')
        // AMBIL PAST PROGRAM
        getPastProg()
      })
      // ONGOING PROGRAM
      $('#ongoing-program').on("click", function() {
        $('#past-program').removeClass('menu-active')
        $('#ongoing-program').addClass('menu-active')
        $('#upcoming-program').removeClass('menu-active')
        // AMBIL ONGOING PROGRAM
        getOngoingProg()
      })

      // UPCOMING PROGRAM
      $('#upcoming-program').on("click", function() {
        $('#past-program').removeClass('menu-active')
        $('#ongoing-program').removeClass('menu-active')
        $('#upcoming-program').addClass('menu-active')
        // AMBIL UPCOMING PROGRAM
        getUpcomProg()
      })
    })

  // === AMBIL PARAMETER
  const urlParams = new URLSearchParams(window.location.search)
  const params = urlParams.get('program')
  //console.log(params)
  if (params === 'upcoming') {
    window.location.hash = 'program'
    $('#past-program').removeClass('menu-active')
    $('#ongoing-program').removeClass('menu-active')
    $('#upcoming-program').addClass('menu-active')
    getUpcomProg()
  } else if (params === 'ongoing') {
    window.location.hash = 'program'
    $('#past-program').removeClass('menu-active')
    $('#ongoing-program').addClass('menu-active')
    $('#upcoming-program').removeClass('menu-active')
    getOngoingProg()
  } else if (params === 'past') {
    window.location.hash = 'program'
    $('#past-program').addClass('menu-active')
    $('#ongoing-program').removeClass('menu-active')
    $('#upcoming-program').removeClass('menu-active')
    getPastProg()
  } else {
    getPastProg()
  }
  // === END AMBIL PARAMETER

  // SECURE DETAIL ONGOING
  function secureIDProgram(id) {
    let isLogin = '<?= ($isLogin ? $isLogin: 'false') ?>'
    if(isLogin === 'false') {
      alFixedGagal('Silahkan sign in dahulu!')
    } else {
      window.location.href = `{{ url('/program/detail/ongoing') }}/${id}`
    }
  }

  // SECURE DETAIL UPCOMING
  function secureIDUpcoming(id) {
    let isLogin = '<?= ($isLogin ? $isLogin: 'false') ?>'
    if(isLogin === 'false') {
      alFixedGagal('Silahkan sign in dahulu!')
    } else {
      window.location.href = `{{ url('/program/detail/upcoming') }}/${id}`
    }
  }

  //BUTTON NEXT PAST PROGRAM
  function nextProgram(nextPage) {
    let page = parseInt(nextPage)+12
    $.ajax({
        type: "get",
        url: `{{ url('/home/pastprogram/${page}') }}`,
        beforeSend: function() {
                $("#loader").addClass('d-flex');
                $("#loader").removeClass('d-none');
                $("#btnNextProgram").addClass('wait');
                $("#btnNextProgram").attr('disabled', true);
            },
        success: function(data) {
            //console.log(data)
            let dtPast = ''
            $.each(data.pastProg, (index, val) => {
                dtPast +=
                `
                <div class="card-prog border-none">
                    <div class="custom-card">
                        <span class="roboto-condensed">${val.nama_program}</span>
                        <a href="${val.link_dokumentasi}" target="_blank">
                            <img src="{{ asset('storage/images/programs/') }}/${val.link_pamflet}" loading="lazy" alt="${val.nama_program}" class="img-prog-180 border-gold-mis mx-2 mx-md-4 my-2">
                        </a>
                    </div>
                </div>
                `
            })

            let btnNextprev = `
            <button id="btnPrevProgram" class="btn-prevNext mx-2" onclick="prevProgram(${data.next})"><i class="mr-2 fas fa-chevron-left"></i> Prev</button>
            <button id="btnNextProgram" class="btn-prevNext" onclick="nextProgram(${data.next})">Next <i class="ml-2 fas fa-chevron-right"></i></button>
            `
            $("#btnNextProgram").removeClass('wait');
            $("#btnNextProgram").attr('disabled', false);

            if(data.ttlPastProg < page+12) {
                btnNextprev = `
                <button id="btnPrevProgram" class="btn-prevNext mx-2" onclick="prevProgram(${data.next})"><i class="mr-2 fas fa-chevron-left"></i> Prev</button>
                <button id="btnNextProgram" class="btn-prevNext" onclick="nextProgram(${data.next})" disabled>Next <i class="ml-2 fas fa-chevron-right"></i></button>
                `
            }

            $('#loc-data').html(dtPast)
            $('#loc-btn-program').html(btnNextprev)
            $('#loader').removeClass('d-flex')
            $('#loader').addClass('d-none')
        },
        error: function(err) {
            console.error(err)
        }
    })
  }

  //BUTTON PREVIOUS PAST PROGRAM
  function prevProgram(prevPage) {
    let page = parseInt(prevPage)-12
    $.ajax({
        type: "get",
        url: `{{ url('/home/pastprogram/${page}') }}`,
        beforeSend: function() {
                $("#loader").addClass('d-flex');
                $("#loader").removeClass('d-none');
                $("#btnPrevProgram").addClass('wait');
                $("#btnPrevProgram").attr('disabled', true);
            },
        success: function(data) {
            //console.log(data)
            let dtPast = ''
            $.each(data.pastProg, (index, val) => {
                dtPast +=
                `
                <div class="card-prog border-none">
                    <div class="custom-card">
                        <span class="roboto-condensed">${val.nama_program}</span>
                        <a href="${val.link_dokumentasi}" target="_blank">
                            <img src="{{ asset('storage/images/programs/') }}/${val.link_pamflet}" loading="lazy" alt="${val.nama_program}" class="img-prog-180 border-gold-mis mx-2 mx-md-4 my-2">
                        </a>
                    </div>
                </div>
                `
            })

            let btnNextprev = `
            <button id="btnPrevProgram" class="btn-prevNext mx-2" onclick="prevProgram(${data.next})"><i class="mr-2 fas fa-chevron-left"></i> Prev</button>
            <button id="btnNextProgram" class="btn-prevNext" onclick="nextProgram(${data.next})">Next <i class="ml-2 fas fa-chevron-right"></i></button>
            `
            $("#btnPrevProgram").removeClass('wait');
            $("#btnPrevProgram").attr('disabled', false);
            if(page == 0) {
                btnNextprev = `
                <button id="btnPrevProgram" class="btn-prevNext mx-2" onclick="prevProgram(${data.next})" disabled><i class="mr-2 fas fa-chevron-left"></i> Prev</button>
                <button id="btnNextProgram" class="btn-prevNext" onclick="nextProgram(${data.next})">Next <i class="ml-2 fas fa-chevron-right"></i></button>
                `
            }
            $('#loc-data').html(dtPast)
            $('#loc-btn-program').html(btnNextprev)
            $('#loader').removeClass('d-flex')
            $('#loader').addClass('d-none')
        },
        error: function(err) {
            console.error(err)
        }
    })
  }


</script>
@endsection
