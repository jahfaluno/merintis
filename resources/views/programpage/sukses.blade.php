@extends('template_merintis.merintis')

@section('head-title', 'Sukses | Merintis Indonesia')

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
<section id="program">
    <div class="container text-center mt-120">
        <h3 class="text-green roboto-condensed">Proses Pendaftaran Selesai!</h3>
        <p>
            Cek inbox emailmu untuk informasi selanjutnya.<br>
            Semangat, Sedulur! Sampai jumpa!
        </p>
        <div class="text-center my-4">
            <a href="{{ url('') }}" class="roboto-condensed btn-daftar my-3 text-white" id="btnDaftarMIS">Selesai</a>
        </div>
        <div class="mt-120">
            <a href="{{ url('') }}" class="text-muted">Back to Homepage</a>
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

// ====== CEK BERHASIL
let cekNotif = sessionStorage.getItem("daftarMistalk")
let cekNotifClinic = sessionStorage.getItem("daftarClinic")
let cekNotifKubis = sessionStorage.getItem("daftarKubis")

if (cekNotif) {
    sessionStorage.removeItem("daftarMistalk")
} else if (cekNotifClinic) {
    sessionStorage.removeItem("daftarClinic")
} else if (cekNotifKubis) {
    sessionStorage.removeItem("daftarKubis")
} else {
    window.history.back()
}

</script>
@endsection
