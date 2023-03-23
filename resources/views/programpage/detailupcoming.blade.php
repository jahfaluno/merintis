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
                <li class="menu-active roboto-condensed let-space-08" id="upcoming-program">
                    <a href="javascript:void(0)" class="link-none">UPCOMING PROGRAM</a>
                </li>
                <li class="roboto-condensed let-space-08" id="ongoing-program"></li>
            </ul>
        </div>
        <!-- DATA PROGRAM -->
        <div id="data-program" class="d-block mx-auto">
            <div class="desc-program mt-32">
                <h3 class="text-gold roboto-condensed">{{ $upcoProg[0]['nama_program'] }}<br>
                    <span class="text-green">{{ $upcoProg[0]['nama_kegiatan'] }}</span>
                </h3>
                <div class="text-muted">
                    <?php
                    // Tanggal
                    $tgl_mulai = $upcoProg[0]['tgl_mulai'];
                    $tgl_mulai = date_create($tgl_mulai);
                    $fnTgl_mulai = date_format($tgl_mulai,"d M Y");
                    $tgl_selesai = $upcoProg[0]['tgl_selesai'];
                    $fnTgl_selesai = '';
                    if ($tgl_selesai) {
                        $tgl_selesai = date_create($tgl_selesai);
                        $fnTgl_selesai = date_format($tgl_selesai,"d M Y");
                        $fnTgl_selesai = " - ".$fnTgl_selesai;
                    }
                    $jamTambah = ($upcoProg[0]['jam_tambahan']) ? ' & '.$upcoProg[0]['jam_tambahan'] : '';
                ?>
                    <span>
                        {{ $fnTgl_mulai }} {{ $fnTgl_selesai }} | {{ $upcoProg[0]['jam_mulai'] }} - {{ $upcoProg[0]['jam_selesai'] }} {{ $jamTambah }} WIB | {{ $upcoProg[0]['metode_pelaksanaan'] }}
                        <br>
                        <?= ($upcoProg[0]['link_map']) ? '<a href="'.$upcoProg[0]['link_map'].'" target="_blank" style="color: #10307a; font-size: small;"> [ Click To Check Maps ] </a>' : '' ?>
                    </span>
                </div>
                <div class="box-register">
                    <img src="{{ asset('storage/images/programs').'/'.$upcoProg[0]['link_pamflet'] }}" alt="img-upcoming" class="img-295 border-gold-mis d-768 my-4">
                    <div class="d-768">
                        <div class="row mx-auto">
                            <div class="col-6 text-right">
                                <s><small class="numeric">{{ $upcoProg[0]['harga_normal'] }}</small></s><br>
                                <b class="roboto-condensed numeric">{{ $upcoProg[0]['harga_promo'] }}</b><br>
                                <small>per orang</small>
                            </div>
                            <div class="col-6 my-auto p-0">
                                <a href="{{ url('/program/daftar').'/'.$upcoProg[0]['link_daftar'].'/'.$upcoProg[0]['id'] }}" class="btn btn-success roboto-condensed let-space-08">Daftar Sekarang</a>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <hr style="border-bottom: 3px solid #f9a932; width:70%;">
                            <div class="col-12 text-center">
                                <span class="roboto">
                                <i class="fas fa-exclamation-circle text-gold mr-1"></i> Limited Seats Available
                                </span>
                            </div>
                            <hr style="border-top: 3px solid #f9a932; width:70%">
                        </div>
                    </div>
                </div>
                <h5 class="text-gold roboto-condensed mt-3">Curriculum</h5>
                {!! $upcoProg[0]['desc_program'] !!}
                <h5 class="text-gold roboto-condensed mt-3">Requirements</h5>
                {{ $upcoProg[0]['sasaran_program'] }}
                <h5 class="text-gold roboto-condensed mt-3">What to Bring</h5>
                {{ $upcoProg[0]['perlengkapan'] }}
                <h5 class="text-gold roboto-condensed mt-3">Mentor</h5>
                <span class="roboto"><b>{{ $upcoProg[0]['mentor'] }}</b><span class="text-muted"> | {{ $upcoProg[0]['profesi'] }}</span></span>
                <br>
                <a href="{{ $upcoProg[0]['link_cv'] }}" target="_blank" style="color: #10307a; font-size: small">[ Click to See Digital CV ]</a>
            </div>
        </div>

        <!-- ASIDE IMAGE-->
        {{-- FLOAT KANAN di sini --}}
        <div class="img-program mt-4">
            <img src="{{ asset('storage/images/programs').'/'.$upcoProg[0]['link_pamflet'] }}" alt="gambar-sementara" class="img-295 border-gold-mis d-block-big mx-auto my-4">
            <div class="d-block-big">
                <div class="row mx-auto">
                    <div class="col-6 col-md-6 text-right">
                        <s><small class="numeric">{{ $upcoProg[0]['harga_normal'] }}</small></s><br>
                        <b class="roboto-condensed numeric">{{ $upcoProg[0]['harga_promo'] }}</b><br>
                        <small>per orang</small>
                    </div>
                    <div class="col-6 col-md-6 my-auto p-0">
                        <a href="{{ url('/program/daftar/').'/'.$upcoProg[0]['link_daftar'].'/'.$upcoProg[0]['id'] }}" class="btn btn-success roboto-condensed let-space-08">Daftar Sekarang</a>
                    </div>
                </div>
                <div class="row mt-4">
                    <hr style="border-bottom: 3px solid #f9a932; width:70%;">
                    <div class="col-12 text-center">
                        <span class="roboto">
                        <i class="fas fa-exclamation-circle text-gold mr-1"></i> Limited Seats Available
                        </span>
                    </div>
                    <hr style="border-top: 3px solid #f9a932; width:70%">
                </div>
            </div>
        </div>

        <!-- END DATA PROGRAM -->
        <div class="block-kembali my-4">
            <a href="javascript:void(0)" onclick="goBack()" class="btn-kembali">
                <i class="fas fa-arrow-circle-left"></i> Kembali
            </a>
        </div>
    </div>

</section>
@endsection

@section('addScript')
<script src="https://unpkg.com/currency.js@~2.0.0/dist/currency.min.js"></script>
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
        if (window.pageYOffset > 90) {
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

//   ============== KEMBALI
function goBack() {
    window.location.href = "{{ url('/#program') }}"
}

// ===== NUMERIC ====
const IDR = value => currency(value, { symbol: "Rp", precision: 0, separator: ".", decimal: "," })
$(document).ready(function() {
    $('.numeric').each(function(i, obj) {
        let harga = IDR($('.numeric').eq(i).text()).format()
        $('.numeric').eq(i).text(harga)
    })
})
// ===== END NUMERIC ====
</script>
@endsection
