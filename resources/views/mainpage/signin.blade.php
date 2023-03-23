@extends('template_merintis.merintis')

@section('head-title', 'Sign In | Merintis Indonesia')

@section('meta-description')
<meta name="description" content="Merintis Indonesia - Merintis Indonesia adalah ekosistem kreatif muda/i daerah untuk saling terhubung, berkolaborasi, dan melahirkan bisnis-bisnis yang inovatif, solutif dan aplikatif dari proses hulu ke hilir.">
@endsection

@section('addCSS')
<link rel="stylesheet" href="{{ asset('assets/css/signin.css') }}">
@endsection

@section('content')
<!--================ FIXED ALERT =================-->
<div class='fixed-alert'></div>
<!--================ END FIXED ALERT =================-->
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
                        <span class="text-grey nav-link-custom active">Sign In</span>
                    </li>
                    <li>
                        <a href="{{ url('/signup') }}" class="text-grey nav-link-custom">Sign Up</a>
                    </li>
                </ul>

                <div class="form-wrapper d-block">
                    <h3 class="text-green let-space-08 mb-4">Hai, Sedulur!</h3>
                    <form id="formSignIn">
                    @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="nama">EMAIL ADDRESS</label>
                                    <input type="text" name="email" id="email" class="form-control" placeholder="Enter your mail">
                                    <div class="invalid-feedback">error email</div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="nama">PASSWORD</label>
                                    <input type="password" name="passwd" id="passwd" class="form-control" placeholder="Enter the magic spell">
                                    <div class="invalid-feedback">error password</div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 col-md-4">
                                <div class="form-check ">
                                    <input type="checkbox" class="form-check-input" name="remember">
                                    <label for="remember" class="form-check-label text-11 text-grey let-space-08">REMEMBER ME?</label>
                                </div>
                            </div>
                            <div class="col-6 col-md-4">
                                <a href="{{ url('/lupapass') }}" class="let-space-08 text-11 text-grey link-none">FORGET PASSWORD?</a>
                            </div>
                        </div>
                    </form>
                    <button class="d-block mx-auto btn-kuning my-4" id="btnSignIn">SIGN IN</button>
                    <p class="text-grey text-16 text-center let-space-08">Is this your first time? Join us now!</p>
                    <a href="{{ url('/signup') }}" class="d-block mx-auto btn-kuning w-200 mb-4 link-none text-white text-center">CREATE NEW ACCOUNT</a
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

//   CEK DARI HALAMAN SIGNUP
if(sessionStorage.getItem('daftar') === 'berhasil') {
    alFixedBerhasil('Daftar Akun Berhasil<br>Silahkan Login')
    sessionStorage.removeItem('daftar')
}

// PROSES SIGNIN
$('#btnSignIn').on('click', function() {
    $.ajax({
        type: "post",
        url: "{{ url('/akun/loginakun') }}",
        data: $('#formSignIn').serialize(),
        beforeSend: function() {
            $('#btnSignIn').attr('disabled', true)
            $('#btnSignIn').addClass('wait')
        },
        success: function(data) {
            console.log(data)

            if (!data.success)
            {
                // CEK EMAIL
                if (data.errors && data.errors.email)
                {
                    $('#email').addClass('is-invalid')
                    $('#email + .invalid-feedback').html(data.errors.email)
                } else {
                    $('#email').removeClass('is-invalid')
                }

                // CEK PASSWORD
                if (data.errors && data.errors.passwd)
                {
                    $('#passwd').addClass('is-invalid')
                    $('#passwd + .invalid-feedback').html(data.errors.passwd)
                } else {
                    $('#passwd').removeClass('is-invalid')
                }

                // Jika Belum Daftar
                if (data.message)
                {
                    alFixedGagal(data.message)
                }

                $('#btnSignIn').attr('disabled', false)
                $('#btnSignIn').removeClass('wait')
            } else {
                $('#email').removeClass('is-invalid')
                $('#passwd').removeClass('is-invalid')
                sessionStorage.setItem("login", "berhasil")
                window.location.href = "{{ url('/') }}"
            }
        },
        error: function(err) {
            console.error(err)
            $('#btnSignIn').attr('disabled', false)
            $('#btnSignIn').removeClass('wait')
            alFixedGagal(err.responseJSON.message)
        }
    })
})
</script>
@endsection