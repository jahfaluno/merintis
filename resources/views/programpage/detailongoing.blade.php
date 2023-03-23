@extends('template_merintis.merintis')

@section('head-title', 'Program | Merintis Indonesia')

@section('meta-description')
<meta name="description" content="Merintis Indonesia - Merintis Indonesia adalah ekosistem kreatif muda/i daerah untuk saling terhubung, berkolaborasi, dan melahirkan bisnis-bisnis yang inovatif, solutif dan aplikatif dari proses hulu ke hilir.">
@endsection

@section('addCSS')
<link rel="stylesheet" href="{{ asset('assets/css/program.css') }}">
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
<header>
    <nav class="navbar navbar-expand-sm navbar-dark ">
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
                    <a class="nav-link" href="{{ url('/#beranda') }}">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/#tentang') }}">Tentang</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="#program">Program</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/#team') }}">Team</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/#content') }}">Content</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="https://info-merintisindonesia.medium.com/">Blog</a>
                </li>
                <li class="nav-item">
                    <!-- Login/Logout -->
                    <div id="link-log">
                        <?= ($isLogin ? '<a class="nav-link" href="javascript:void(0)" onclick="logout()">Sign Out</a>' : '<a class="nav-link" id="btnSignIn" href="'.url('/signin').'">Sign In</a>'); ?>
                    </div>
                    <!-- End Login/Logout -->
                </li>
            </ul>
        </div>
    </nav>
</header>
@endsection

@section('content')
<section id="program" class="mt-48">
    <div class="container">
        <div class="menu-program">
            <ul class="text-center">
                <li class="roboto-condensed let-space-08" id="past-program"></li>
                <li class="menu-active roboto-condensed let-space-08" id="ongoing-program">
                    <a href="javascript:void(0)" class="link-none">ON-GOING PROGRAM</a>
                </li>
                <li class="roboto-condensed let-space-08" id="upcoming-program"></li>
            </ul>
        </div>
        <!-- DATA PROGRAM -->
        <div id="data-program" class="d-block mx-auto">
            <div class="desc-program mt-32">
                <h3 class="text-green">{{ $detailOngo[0]['nama_program'] }}:<br>
                    {{ $detailOngo[0]['nama_kegiatan'] }}
                </h3>
                <img src="{{ asset('storage/images/programs/'.$detailOngo[0]['link_pamflet']) }}" alt="{{ $detailOngo[0]['nama_program'] }}" class="img-295 border-gold-mis d-768 my-4">
                <div class="row text-muted">
                <?php
                    // Tanggal
                    $tgl_mulai = $detailOngo[0]['tgl_mulai'];
                    $tgl_mulai = date_create($tgl_mulai);
                    $fnTgl_mulai = date_format($tgl_mulai,"d M Y");
                    $tgl_selesai = $detailOngo[0]['tgl_selesai'];
                    $fnTgl_selesai = '';
                    if ($tgl_selesai) {
                        $tgl_selesai = date_create($tgl_selesai);
                        $fnTgl_selesai = date_format($tgl_selesai,"d M Y");
                    } else {
                        $tgl_selesai = '';
                    }
                ?>
                    <div class="col-12">
                        {{ ($fnTgl_selesai !== '') ? $fnTgl_mulai." - ".$fnTgl_selesai : $fnTgl_mulai }}
                    </div>
                    <div class="col-12">
                    {{ $detailOngo[0]['jam_mulai'] }} - {{ $detailOngo[0]['jam_selesai'] }} WIB
                    </div>
                </div>
                <p class="roboto-condensed let-space-08 mt-2">*{{ $detailOngo[0]['sasaran_program'] }}</p>
                    {!! $detailOngo[0]['desc_program'] !!}
                <ul class="list-button-program mt-4">
                    <?php if($detailOngo[0]['link_jadwal']): ?>
                    <li>
                        <a href="{{ $detailOngo[0]['link_jadwal'] }}" target="_blank" class="btn-kuning mr-2 text-center text-white">Cek Jadwal</a>
                    </li>
                    <?php
                        endif;
                        if($detailOngo[0]['link_dokumentasi']):
                     ?>
                    <li>
                        <a href="{{ $detailOngo[0]['link_dokumentasi'] }}" target="_blank" class="btn-kuning text-center text-white">Dokumentasi</a>
                    </li>
                    <?php endif ?>
                </ul>
            </div>
            <div class="img-program mt-32">
                <img src="{{ asset('storage/images/programs/'.$detailOngo[0]['link_pamflet']) }}" alt="{{ $detailOngo[0]['nama_program'] }}" class="img-295 border-gold-mis d-block-big mx-auto my-4">
            </div>
        </div>
        <!-- END DATA PROGRAM -->
        <div class="block-kembali">
            <a href="javascript:void(0)" onclick="goBack()" class="btn-kembali">
                <i class="fas fa-arrow-circle-left"></i> Kembali
            </a>
        </div>
    </div>

</section>
@endsection

@section('addScript')
<script>
    // Tambahan Script

    // SMOOTH SCROLL
    $(document).ready(function() {
        $("a").on("click", function(event) {
            if (this.hash == "#program") {
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

    // SHOW NAVBAR FIXED
    window.onscroll = changeNav;

    function changeNav() {
        let navbar = $('nav');
        if (window.pageYOffset > 120) {
            navbar.addClass('navbar-fixed')
        } else {
            navbar.removeClass('navbar-fixed');
        }
    }

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
        }
      })
      // ------ END MENGHAPUS SESSION DI DATABASE
    })
  }
  // ==================== END LOGOUT ===============

  // ========== BTN SIGNIN
  $('#btnSignIn').on("click", function() {
    $('#link-log').addClass("active");
  })
  // ========== END BTN SIGNIN

//   ============== KMEBALI
function goBack() {
    window.location.href = "{{ url('/#program') }}"
}
</script>
@endsection
