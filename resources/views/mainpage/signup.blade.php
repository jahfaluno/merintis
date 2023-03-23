@extends('template_merintis.merintis')

@section('head-title', 'Sign Up | Merintis Indonesia')

@section('meta-description')
<meta name="description" content="Merintis Indonesia - Merintis Indonesia adalah ekosistem kreatif muda/i daerah untuk saling terhubung, berkolaborasi, dan melahirkan bisnis-bisnis yang inovatif, solutif dan aplikatif dari proses hulu ke hilir.">
@endsection

@section('addCSS')
<link rel="stylesheet" href="{{ asset('assets/css/signup.css') }}">
@endsection

@section('content')
{{-- ================ FIXED ALERT ================= --}}
<div class='fixed-alert'></div>
{{-- ================ END FIXED ALERT ================= --}}
<div class="container-signIn">
    <aside id="tentang" class="bg-coffee">
        <div class="desc-tentang">
            <img src="{{ asset('assets/img/Logo-MI.png') }}" alt="logo-mi" class="mx-auto">
            <p class="text-white text-left let-space-08 mt-4 text-16">
                <b>Merintis Indonesia</b> merupakan ekosistem kreatif muda/i daerah untuk saling terhubung, berkolaborasi dan melahirkan bisnis-bisnis yang inovatif, solutif dan aplikatif dari proses hulu ke hilir.
            </p>
            <a href="{{ url('/#tentang') }}" class="mt-4 btn-kuning d-block mx-auto text-center text-white">Selengkapnya</a>
        </div>
    </aside>

    <section id="signIn">
        <div class="back-nav text-right p-2">
        <a href="{{ url('/') }}" class="text-grey mr-4">
        <i class="fas fa-arrow-circle-left"></i>
            Back to Homepage
        </a>
        </div>
        <div class="signIn-side">
            <div class="nav-signIn">
                <ul class="text-18">
                    <li>
                        <a href="{{ url('/signin') }}" class="text-grey nav-link-custom">Sign In</a>
                    </li>
                    <li>
                        <span class="text-grey nav-link-custom active">Sign Up</span>
                    </li>
                </ul>

                <div class="form-wrapper d-block">
                    <h3 class="text-green let-space-08 mb-4">Hai, Sedulur!</h3>
                    <form id="formSignup">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="nm_lengkap">NAME</label>
                                    <input type="text" name="nm_lengkap" id="nm_lengkap" class="form-control" placeholder="Your full name, please?">
                                    <div class="invalid-feedback">
                                        error name
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="nama">EMAIL ADDRESS</label>
                                    <input type="text" name="email" id="email" class="form-control" placeholder="Your email address">
                                    <div class="invalid-feedback">
                                        Error email address
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="nama">PHONE NUMBER</label>
                                    <input type="number" name="no_hp" id="no_hp" class="form-control" placeholder="Your phone number">
                                    <div class="invalid-feedback">
                                        Error phone number
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label for="nama">PASSWORD</label>
                                    <input type="password" name="password" id="password" class="form-control" placeholder="Enter the magic spell">
                                    <div class="invalid-feedback">
                                        Error password
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label for="nama">REPEAT PASSWORD</label>
                                    <input type="password" name="pass_confirm" id="pass_confirm" class="form-control" placeholder="Enter the magic spell">
                                    <div class="invalid-feedback">
                                        Error password confirm
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <p class="text-grey text-11 let-space-08">By clicking "Sign Up" I agree to lingkaran <b>Terms of service</b> and <b>Privacy Policy</b>.</p>
                    <button class="d-block mx-auto btn-kuning my-3" id="signUp">SIGN UP</button>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('addScript')
<script>
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

$('#signUp').on('click', function() {
    $.ajax({
        type: "post",
        url: "{{ url('/akun/buatakun') }}",
        data: $('#formSignup').serialize(),
        beforeSend: function() {
            $('#signUp').attr('disabled', true)
            $('#signUp').addClass('wait')
        },
        success: function(data) {
            console.log(data)
            $('#signUp').attr('disabled', false)
            $('#signUp').removeClass('wait')
            // nm_lengkap
            if (!data.success) {
                if (data.errors) {
                    if(data.errors.nm_lengkap && data.errors.nm_lengkap[0] ) {
                        $('#nm_lengkap').addClass('is-invalid')
                        $('#nm_lengkap + .invalid-feedback').html(data.errors.nm_lengkap[0])
                    } else {
                        $('#nm_lengkap').removeClass('is-invalid')
                    }

                    // email
                    if(data.errors.email && data.errors.email[0]) {
                        $('#email').addClass('is-invalid')
                        $('#email + .invalid-feedback').html(data.errors.email[0])
                    } else {
                        $('#email').removeClass('is-invalid')
                    }

                    // no_hp
                    if(data.errors.no_hp && data.errors.no_hp[0]) {
                        $('#no_hp').addClass('is-invalid')
                        $('#no_hp + .invalid-feedback').html(data.errors.no_hp[0])
                    } else {
                        $('#no_hp').removeClass('is-invalid')
                    }

                    // password
                    if(data.errors.password && data.errors.password[0]) {
                        $('#password').addClass('is-invalid')
                        $('#password + .invalid-feedback').html(data.errors.password[0])
                    } else {
                        $('#password').removeClass('is-invalid')
                    }

                    // confirm password
                    if(data.errors.pass_confirm && data.errors.pass_confirm[0]) {
                        $('#pass_confirm').addClass('is-invalid')
                        $('#pass_confirm + .invalid-feedback').html(data.errors.pass_confirm[0])
                    } else {
                        $('#pass_confirm').removeClass('is-invalid')
                    }
                } else {
                    alFixedGagal(data.error);
                }
            } else {
                // Jika Berhasil Buat Local Storage Pesan   dan kembalikan ke SignIn
                $('#pass_confirm').removeClass('is-invalid')
                $('#password').removeClass('is-invalid')
                $('#no_hp').removeClass('is-invalid')
                $('#email').removeClass('is-invalid')
                $('#nm_lengkap').removeClass('is-invalid')
                sessionStorage.setItem("daftar", "berhasil")
                window.location.href = "{{ url('/signin') }}"
            }
        },
        error: function(err) {
            console.error(err)
            $('#signUp').attr('disabled', false)
            $('#signUp').removeClass('wait')
            alFixedGagal(err.responseJSON.message)
        }
    })
})
</script>
@endsection