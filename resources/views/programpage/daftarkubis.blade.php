@extends('template_merintis.merintis')

@section('head-title', 'Kuliah Bisnis | Merintis Indonesia')

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
<!--================ FIXED ALERT =================-->
<div class = 'fixed-alert'></div>
<!--================ END FIXED ALERT =================-->
<section id="program">
    <div class="container">
        {{-- DAFTAR PROGRAM KULIAH BISNIS --}}
        <form id="formMistalk" class="mt-32" enctype="multipart/form-data">
        <div class="wrap_form_daftar pr-4">
            <h3 class="text-green roboto-condensed">Form Pendaftaran<br></h3>
            @csrf
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <input type="text" name="nm_lengkap" id="nm_lengkap" class="form-control" placeholder="Nama Lengkap" value="{{ Auth::user()->nm_lengkap }}">
                        <div class="invalid-feedback">
                            error name
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <input type="text" name="ttl" id="ttl" class="form-control" placeholder="Tempat, Tanggal Lahir (Kota, DD/MM/YY)">
                        <div class="invalid-feedback">
                            error TTL
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <input type="text" name="kota_domisili" id="kota_domisili" class="form-control" placeholder="Kota Domisili">
                        <div class="invalid-feedback">
                            error kota domisili
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <input type="text" name="ide_bisnis" id="ide_bisnis" class="form-control" placeholder="Nama Ide Bisnis">
                        <div class="invalid-feedback">
                            error ide bisnis
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <input list="opsi_bisnis" name="bidang_bisnis" id="bidang_bisnis" class="form-control" placeholder="Bidang Ide Bisnis">
                        <div class="invalid-feedback">
                            error bidang bisnis
                        </div>
                        <datalist id="opsi_bisnis">
                            <option value="Food & Beverages">
                            <option value="Fashion/Konveksi">
                            <option value="Edukasi">
                            <option value="Agrikultur">
                            <option value="Teknologi">
                        </datalist>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label for="masalah">Uraikan secara detail masalah yang ingin diselesaikan oleh ide bisnis tersebut</label>
                        <textarea class="form-control" id="masalah" name="masalah" rows="3"></textarea>
                        <div class="invalid-feedback">
                            error masalah
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label for="solusi">Ceritakan apa yang ditawarkan oleh ide bisnismu untuk mengatasi masalah tersebut</label>
                        <textarea class="form-control" id="solusi" name="solusi" rows="3"></textarea>
                        <div class="invalid-feedback">
                            error solusi
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label for="target">Siapa target konsumennya?</label>
                        <textarea class="form-control" id="target" name="target" rows="3"></textarea>
                        <div class="invalid-feedback">
                            error target
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label for="kebutuhan">Apa yang saat ini kamu sangat butuhkan untuk mengimplementasikan ide tersebut?</label>
                        <textarea class="form-control" id="kebutuhan" name="kebutuhan" rows="3"></textarea>
                        <div class="invalid-feedback">
                            error kebutuhan
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-12">
                    <b class="roboto-condensed let-space-08">Metode Bayar</b>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="metode_bayar" id="bankTransfer" value="Bank Transfer">
                        <label class="form-check-label" for="bankTransfer">Bank Transfer</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="metode_bayar" id="gopay" value="Gopay">
                        <label class="form-check-label" for="gopay">Gopay</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="metode_bayar" id="dana" value="Dana">
                        <label class="form-check-label" for="dana">Dana</label>
                    </div>
                    <div class="custom-err d-none">error metode</div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 mt-3 my-4">
                    <a class="btn btn-info roboto" data-toggle="collapse" href="#petunjukBayar" role="button" aria-expanded="false" aria-controls="petunjukBayar">
                        Petunjuk Pembayaran <i class="fas fa-chevron-down mx-2"></i>
                    </a>
                    <div class="collapse" id="petunjukBayar">
                        <div class="card card-body text-14 pt-3">
                            <ol type="1">
                                <li>
                                    E-Payment
                                    <p>Dana & Gopay <b>0857 8503 6770</b> (a.n Roro Mega Cahyaning 'Azmi Riyandani)</p>
                                </li>
                                <li>
                                    Bank Transfer
                                    <p>CIMB <b>705656836300</b> (a.n Roro Mega Cahyaning 'Azmi Riyandani)</p>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="wrap_form_aside mb-4">
            <div class="row">
                <div class="col-12">
                    <div class="border-grey text-gold roboto-condensed let-space-08">Item Summary</div>
                </div>
                <div class="col-12">
                    <div class="border-grey">
                        <div class="desc-program-mis mt-3 my-2">
                            <b class="roboto-condensed let-space-08">{{ $upcoProg[0]['nama_program'] }}</b><br>
                            <b class="roboto-condensed let-space-08">{{ $upcoProg[0]['nama_kegiatan'] }}</b><br>
                            <span class="text-muted">{{ $upcoProg[0]['metode_pelaksanaan'] }}</span>
                        </div>
                        <div class="mx-2">
                            <img src="{{ asset('storage/images/programs').'/'.$upcoProg[0]['link_pamflet'] }}" class="border-gold img-100 m-3" alt="program-pict">
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="border-grey text-gold roboto-condensed let-space-08">Order Summary</div>
                </div>
                <div class="col-12">
                    <div class="border-grey">
                        <span id="free-regist" class="d-none">Free</span>
                        <div id="pay-regist">
                            <div class="row my-2">
                                <div class="col-sm-12 col-md-6">
                                    Subtotal
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <span class="text-right numeric">{{ $upcoProg[0]['harga_normal'] }}</span>
                                </div>
                            </div>
                            <div class="row my-2">
                                <div class="col-sm-12 col-md-6">
                                    Discount(<span id="perDisc"></span>%)
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <span class="text-right numeric" id="ttlDisc"></span>
                                </div>
                            </div>
                            <div class="row my-2">
                                <div class="col-sm-12 col-md-6">
                                    Total
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <span class="text-right numeric">{{ $upcoProg[0]['harga_promo'] }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 my-2">
                    <b class="roboto-condensed let-space-08">Upload Bukti Pembayaran</b>
                </div>
                <div class="col-12">
                    <button id="btnFile" onclick="document.getElementById('bukti_bayar').click(); return false;" class="text-muted border-grey">
                        <i class="fas fa-camera mx-2"></i>Upload foto ....
                    </button>
                    <small id="descBukti"></small>
                    <div id="errBukti" class="text-left custom-err d-none">Error Bukti bayar</div>
                </div>
                <div class="col-12">
                    <small class="text-muted">
                        <input type="file" id="bukti_bayar" name="bukti_bayar" style="visibility: hidden" accept="image/*">
                    </small>
                </div>
            </div>
            <input type="hidden" name="id_akun" value="{{ Auth::user()->id }}">
            <input type="hidden" name="id_program" value="{{ $upcoProg[0]['id'] }}">
        </form>
        </div>
        <div class="clear-both text-center">
            <button class="roboto-condensed btn-daftar mb-5" id="btnDaftarKubis">Submit</button>
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
        if (window.pageYOffset > 20) {
            navbar.addClass('navbar-fixed')
        } else {
            navbar.removeClass('navbar-fixed');
        }
    }

// ------------------ FIXED ALERT
function alFixedBerhasil(pesan) {
    let alBerhasil = `
    <div class="alert alert-success shadow alert-dismissible fade show" role="alert">
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
    <div class="alert alert-danger shadow alert-dismissible fade show" role="alert">
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

// ================ SUBMIT REGISTRATION MISTALK ==========
$('#btnDaftarKubis').on('click', function() {
    let formData = new FormData($('#formMistalk')[0])
    formData.append('_token', '{{ csrf_token() }}')
    $.ajax({
        type: 'post',
        url: '{{ url("/program/proses/kubis") }}',
        contentType: false,
        cache: false,
        processData: false,
        data: formData,
        beforeSend: function() {
            $('#btnDaftarKubis').addClass('not-allowed')
            $('#btnDaftarKubis').attr('disabled', true)
        },
        success: function(data) {
            //console.log(data)
            if (!data.success) {
                // Error nama lengkap
                if (data.errors && data.errors.nm_lengkap) {
                    $('#nm_lengkap').addClass('is-invalid')
                    $('#nm_lengkap + .invalid-feedback').html(data.errors.nm_lengkap)
                } else {
                    $('#nm_lengkap').removeClass('is-invalid')
                    $('#nm_lengkap + .invalid-feedback').html('')
                }

                // Error TTL
                if (data.errors && data.errors.ttl) {
                    $('#ttl').addClass('is-invalid')
                    $('#ttl + .invalid-feedback').html(data.errors.ttl)
                } else {
                    $('#ttl').removeClass('is-invalid')
                    $('#ttl + .invalid-feedback').html('')
                }

                // Error Gender
                if (data.errors && data.errors.gender) {
                    $('#gender').addClass('is-invalid')
                    $('#gender + .invalid-feedback').html(data.errors.gender)
                } else {
                    $('#gender').removeClass('is-invalid')
                    $('#gender + .invalid-feedback').html('')
                }

                // Error Domisili
                if (data.errors && data.errors.kota_domisili) {
                    $('#kota_domisili').addClass('is-invalid')
                    $('#kota_domisili + .invalid-feedback').html(data.errors.kota_domisili)
                } else {
                    $('#kota_domisili').removeClass('is-invalid')
                    $('#kota_domisili + .invalid-feedback').html('')
                }

                // Error Ide Bisnis
                if (data.errors && data.errors.ide_bisnis) {
                    $('#ide_bisnis').addClass('is-invalid')
                    $('#ide_bisnis + .invalid-feedback').html(data.errors.ide_bisnis)
                } else {
                    $('#ide_bisnis').removeClass('is-invalid')
                    $('#ide_bisnis + .invalid-feedback').html('')
                }

                // Error Bidang Bisnis
                if (data.errors && data.errors.bidang_bisnis) {
                    $('#bidang_bisnis').addClass('is-invalid')
                    $('#bidang_bisnis + .invalid-feedback').html(data.errors.bidang_bisnis)
                } else {
                    $('#bidang_bisnis').removeClass('is-invalid')
                    $('#bidang_bisnis + .invalid-feedback').html('')
                }

                // Error Masalah
                if (data.errors && data.errors.masalah) {
                    $('#masalah').addClass('is-invalid')
                    $('#masalah + .invalid-feedback').html(data.errors.masalah)
                } else {
                    $('#masalah').removeClass('is-invalid')
                    $('#masalah + .invalid-feedback').html('')
                }

                // Error Solusi
                if (data.errors && data.errors.solusi) {
                    $('#solusi').addClass('is-invalid')
                    $('#solusi + .invalid-feedback').html(data.errors.solusi)
                } else {
                    $('#solusi').removeClass('is-invalid')
                    $('#solusi + .invalid-feedback').html('')
                }

                // Error Target
                if (data.errors && data.errors.target) {
                    $('#target').addClass('is-invalid')
                    $('#target + .invalid-feedback').html(data.errors.target)
                } else {
                    $('#target').removeClass('is-invalid')
                    $('#target + .invalid-feedback').html('')
                }

                // Error Kebutuhan
                if (data.errors && data.errors.kebutuhan) {
                    $('#kebutuhan').addClass('is-invalid')
                    $('#kebutuhan + .invalid-feedback').html(data.errors.kebutuhan)
                } else {
                    $('#kebutuhan').removeClass('is-invalid')
                    $('#kebutuhan + .invalid-feedback').html('')
                }

                // Id Akun
                if (data.errors && data.errors.id_akun) {
                    console.log(data.errors.id_akun)
                }

                // Id Program
                if (data.errors && data.errors.id_program) {
                    console.log(data.errors.id_program)
                }

                // Error Metode Bayar
                if (data.errors && data.errors.metode_bayar) {
                    $('.custom-err').eq(0).removeClass('d-none')
                    $('.custom-err').eq(0).html(data.errors.metode_bayar)
                } else {
                    $('.custom-err').eq(0).addClass('d-none')
                    $('.custom-err').eq(0).html('')
                }

                // Bukti Bayar
                if (data.errors && data.errors.bukti_bayar) {
                    $('.custom-err').eq(1).removeClass('d-none')
                    $('.custom-err').eq(1).html(data.errors.bukti_bayar)
                } else {
                    $('.custom-err').eq(1).addClass('d-none')
                    $('.custom-err').eq(1).html('')
                }

                // Id Akun
                if (data.errors && data.errors.id_akun) {
                    console.log(data.errors.id_akun)
                }

                // Id Program
                if (data.errors && data.errors.id_program) {
                    console.log(data.errors.id_program)
                }

                // Reset Button Style
                $('#btnDaftarKubis').removeClass('not-allowed')
                $('#btnDaftarKubis').attr('disabled', false)
                // Alert
                alFixedGagal('Periksa form kembali!')
            } else {
                // Hapus Error
                $('#nm_lengkap').removeClass('is-invalid')
                $('#nm_lengkap + .invalid-feedback').html('')
                $('#ttl').removeClass('is-invalid')
                $('#ttl + .invalid-feedback').html('')
                $('#kota_domisili').removeClass('is-invalid')
                $('#kota_domisili + .invalid-feedback').html('')
                $('#ide_bisnis').removeClass('is-invalid')
                $('#ide_bisnis + .invalid-feedback').html('')
                $('#bidang_bisnis').removeClass('is-invalid')
                $('#bidang_bisnis + .invalid-feedback').html('')
                $('#masalah').removeClass('is-invalid')
                $('#masalah + .invalid-feedback').html('')
                $('#solusi').removeClass('is-invalid')
                $('#solusi + .invalid-feedback').html('')
                $('#target').removeClass('is-invalid')
                $('#target + .invalid-feedback').html('')
                $('#kebutuhan').removeClass('is-invalid')
                $('#kebutuhan + .invalid-feedback').html('')
                $('.custom-err').eq(0).addClass('d-none')
                $('.custom-err').eq(0).html('')
                $('.custom-err').eq(1).addClass('d-none')
                $('.custom-err').eq(1).html('')

                // Notif Berhasil
                sessionStorage.setItem("daftarKubis", true)
                window.location.href = "{{ url('/program/daftar/sukses') }}";

                // Reset Button Style
                $('#btnDaftarKubis').removeClass('not-allowed')
                $('#btnDaftarKubis').attr('disabled', false)
            }
        },
        error: function(err) {
            // Reset Button Style
            //console.error(err)
            $('#btnDaftarKubis').removeClass('not-allowed')
            $('#btnDaftarKubis').attr('disabled', false)
        }
    })
})
// ================ END SUBMIT REGISTRATION MISTALK ==========

// ====== SHOW FILE NAME ON INPUT CLICK ========
$('#bukti_bayar').change(function() {
    let file = $('#bukti_bayar')[0].files[0].name
    $('#descBukti').text(file)
})
// ====== END SHOW FILE NAME ON INPUT CLICK ========

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
// ========= END KEMBALI

// ===== NUMERIC ====
const IDR = value => currency(value, { symbol: "Rp", precision: 0, separator: ".", decimal: "," })
$(document).ready(function() {
    $('.numeric').each(function(i, obj) {
        let harga = IDR($('.numeric').eq(i).text()).format()
        $('.numeric').eq(i).text(harga)
    })
})
// ===== END NUMERIC ====

// == CALCULATE DISCOUNT ===
let hrgNormal = "{{ $upcoProg[0]['harga_normal'] }}"
hrgNormal = parseInt(hrgNormal)
let hrgPromo = "{{ $upcoProg[0]['harga_promo'] }}"
hrgPromo = parseInt(hrgPromo)
let ttlDiscount = hrgNormal - hrgPromo
let persen = (ttlDiscount/hrgNormal)*100
$('#perDisc').text(persen.toFixed(2))
$('#ttlDisc').text(ttlDiscount)
// == END CALCULATE DISCOUNT ===
</script>
@endsection
