<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="robots" content="noindex">
  <title>Lupa Password | Merintis Indonesia 2021</title>

  <!-- Favicons -->
  <link href="{{ asset('favicon.png') }}" type="image/png" rel="icon">
  <link href="{{ asset('apple-touch-icon.png') }}" rel="apple-touch-icon">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendors/fontawesome/css/all.min.css') }}">
  <script src="https://use.fontawesome.com/60a313a36b.js"></script>

  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  <style>
    .kuning {
      color: #f9aa32;
    }
    .red {
      color: red;
    }
    .hijau {
      color: #45b54b;
    }
    .size-100px {
      font-size: 100px;
    }
    .logo {
      max-width: 100px;
    }
    .bg-kuning {
      background-color: #ffd9a1;
    }
    .sponsor img {
      max-height: 50px;
      border-radius: 7px;
    }
    .fluid {
      max-width: 165px;
      max-height: 165px;
    }
    .img-small {
      max-width: 100px;
      padding-right: 20px;
    }
    .pd-top {
      padding-top: 20px;
    }
    .padding-top-small {
      padding-top: 15px;
    }
    .has-error input, select{
      border-width: 1px;
      border-color: red;
      border-style: solid;
    }
    @media (min-height:1000px) {
      .padding-top-content {
        padding-top: 100px;
      }
    }
    @media (max-height:999px) {
      .padding-top-content {
        padding-top: 80px;
      }
    }
    table.table-custom {
      /* table-layout: fixed; */
      width: 100%;
    }
    table.table-custom td {
      padding: 10px;
      /* word-wrap: break-word; */
    }
    table.table-contact {
      table-layout: fixed;
      width: 100%;
    }
    table.table-contact td {
      padding: 10px;
      word-wrap: break-word;
    }
    .text-center {
      text-align: center;
    }
  </style>
</head>
<body class="bg-light">
{{-- ============================ NAVBAR  --}}
<nav class="navbar navbar-light bg-light px-sm-5 shadow-sm mb-5">
  <div class="d-inline-block">
    <a class="navbar-brand" href="{{ url('/') }}">
      <img src="{{ asset('assets/img/Logo-MI.png') }}" class="logo" alt="logo-mis">
      <span class="heading hijau">Merintis</span> <span class="heading kuning">Indonesia</span>
    </a>
  </div>
</nav>
{{-- ============================ END NAVBAR --}}

<div class="container">
  <div class="row justify-content-center mb-5">
    <div class="col-md-7 col-lg-5">
      {{-- ============================ CARD DAFTAR --}}
      <div class="card text-center">
        <div class="card-body px-3">
          <h5 class="card-title">Ubah Password</h5>
          <div id="alert-ubahpass"></div>
          <form id="formLupa" class="mt-5 custom-form">
            @csrf
            <div class="row">
              <div class="col-md-12 col-sm-12">
                <div class="form-group">
                  <input type="text" class="form-control" placeholder="Email" name="email">
                  <div class="invalid-feedback">
                    Pesan error email
                  </div>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" placeholder="Kode" name="kodereset">
                  <div class="invalid-feedback">
                    Pesan error kode reset
                  </div>
                </div>
                <div class="form-group">
                  <div class="lay-password-outline">
                    <input type="password" class="form-control password" placeholder="Password baru" name="passwd">
                    <a href="javascript:void(0)">
                      <i class="fa fa-eye-slash"></i>
                    </a>
                  </div>
                  <div id="err-passwd" class="invalid-feedback">
                    Pesan error password
                  </div>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Konfirmasi Password" name="konfpasswd">
                    <div class="invalid-feedback">
                      Pesan error konfirmasi password
                    </div>
                </div>
              </div>
            </div>
          </form>
          <div class="form-group">
            <button class="button button-biru-tua mx-3 my-2" id="btnKirimKode">Kirim Kode</button>
            <button class="button button-hero" id="btnSimpan">Simpan</button>
          </div>
        </div>
        {{-- ============================ END CARD DAFTAR --}}
      </div>
    </div>
  </div>
</div>

<script src="{{ asset('assets/vendors/jquery/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('assets/vendors/bootstrap/bootstrap.bundle.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/gh/cferdinandi/smooth-scroll@15/dist/smooth-scroll.polyfills.min.js"></script>
<script type="text/javascript">
// --------------------- KIRIM TOKEN
$("#btnKirimKode").on("click", function() {
  let email = $("input[name=email]").val();
  $("#alert-ubahpass").html("Tunggu sebentar...");
  window.scrollTo(0, 0);
  $.ajax({
    type: "post",
    url: "{{ url('/akun/lupapass') }}",
    data: {"email": email, "_token": "{{ csrf_token() }}" },
    beforeSend: function () {
      //------DISABLED BUTTON
      $("#btnKirimKode").attr('disabled', true);
      $("#btnKirimKode").addClass('wait');
    },
    success: function(data) {
      console.log(data);
      if (data.success === true) {
        alBerhasil(data.message);
        // REMOVE ERR TEXT
        $(".form-control").eq(0).removeClass("is-invalid");
        //------ENABLED BUTTON
        $("#btnKirimKode").attr('disabled', false);
        $("#btnKirimKode").removeClass('wait');
      } else {
        //------ENABLED BUTTON
        $("#btnKirimKode").attr('disabled', false);
        $("#btnKirimKode").removeClass('wait');
        // REMOVE LOADER
        $("#alert-ubahpass").html("");
        // PESAN GAGAL
        if (data.message) {
          alGagal(data.message);
        }
        // TEXT ERROR EMAIL
        if (data.errors && data.errors.email[0]) {
          $(".form-control").eq(0).addClass("is-invalid");
          $(".invalid-feedback").eq(0).html(data.errors.email[0]);
        } else {
          $(".form-control").eq(0).removeClass("is-invalid");
        }
      }
    },
    error: function(response) {
      console.log(response);
      if (typeof response.responseJSON !== "undefined") {
        alGagal(response.responseJSON.message);
      }
      alGagal(response.statusText);
      //------ENABLED BUTTON
      $("#btnKirimKode").attr('disabled', false);
      $("#btnKirimKode").removeClass('wait');
    }
  })
})
// --------------------- END KIRIM TOKEN

// --------------------- UBAH PASSWORD
$("#btnSimpan").on("click", function() {
  $("#alert-ubahpass").html("Tunggu sebentar...");
  window.scrollTo(0, 0);
  $.ajax({
    type: "post",
    url: "{{ url('/akun/ubahpass') }}",
    data: $("#formLupa").serialize(),
    beforeSend: function() {
      //------DISABLED BUTTON
      $("#btnSimpan").attr('disabled', true);
      $("#btnSimpan").addClass('wait');
    },
    success: function(data) {
      console.log(data);
      if (data.success === true) {
        alBerhasil(data.message);
        //------ENABLED BUTTON
        $("#btnSimpan").attr('disabled', false);
        $("#btnSimpan").removeClass('wait');
        // REMOVE ERR TEXT
        $(".form-control").eq(0).removeClass("is-invalid");
        $(".form-control").eq(1).removeClass("is-invalid");
        $(".lay-password-outline").removeClass("password-invalid");
        passwdErr();
        $(".form-control").eq(3).removeClass("is-invalid");
      } else {
        // REMOVE LOADER
        $("#alert-ubahpass").html("");
        //------ENABLED BUTTON
        $("#btnSimpan").attr('disabled', false);
        $("#btnSimpan").removeClass('wait');
        // PESAN GAGAL
        if (data.message) {
          alGagal(data.message);
        }
        // TEXT ERROR EMAIL
        if (data.errors && data.errors.email) {
          $(".form-control").eq(0).addClass("is-invalid");
          $(".invalid-feedback").eq(0).html(data.errors.email);
        } else {
          $(".form-control").eq(0).removeClass("is-invalid");
        }
        // TEXT ERROR KODE RESET
        if (data.errors && data.errors.kodereset) {
          $(".form-control").eq(1).addClass("is-invalid");
          $(".invalid-feedback").eq(1).html(data.errors.kodereset);
        } else {
          $(".form-control").eq(1).removeClass("is-invalid");
        }
        // TEXT ERROR PASSWD
        if (data.errors && data.errors.passwd) {
          $(".lay-password-outline").addClass("password-invalid");
          $(".invalid-feedback").eq(2).html(data.errors.passwd);
          passwdErr();
        } else {
          $(".lay-password-outline").removeClass("password-invalid");
          passwdErr();
        }
        // TEXT ERROR KONFIRMASI PASSWD
        if (data.errors && data.errors.konfpasswd) {
          $(".form-control").eq(3).addClass("is-invalid");
          $(".invalid-feedback").eq(3).html(data.errors.konfpasswd);
        } else {
          $(".form-control").eq(3).removeClass("is-invalid");
        }
      }
    },
    error: function(response) {
      //console.log(response.responseJSON.message);
      alGagal(response.responseJSON.message);
      //------ENABLED BUTTON
      $("#btnSimpan").attr('disabled', false);
      $("#btnSimpan").removeClass('wait');
    }
  })
})
// --------------------- END UBAH PASSWORD
//------------ SHOW PASSWORD ---------------
$(document).ready(function() {
  $(".lay-password-outline a").on('click', function(event) {
    event.preventDefault();
    if($('.lay-password-outline input').attr("type") == "text"){
      $('.lay-password-outline input').attr('type', 'password');
      $('.lay-password-outline i').addClass( "fa-eye-slash" );
      $('.lay-password-outline i').removeClass( "fa-eye" );
    }else if($('.lay-password-outline input').attr("type") == "password"){
      $('.lay-password-outline input').attr('type', 'text');
      $('.lay-password-outline i').removeClass( "fa-eye-slash" );
      $('.lay-password-outline i').addClass( "fa-eye" );
    }
  });
});
//------------ END-SHOW PASSWORD ---------------

// ----------------- KUMPULAN ALERT ----------------
function alBerhasil(pesan) {
  let alert =
  `
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    ${pesan}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  `
  $("#alert-ubahpass").html(alert);
}

function alGagal(pesan) {
  let alert =
  `
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    ${pesan}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  `
  $("#alert-ubahpass").html(alert);
}
// ----------------- END KUMPULAN ALERT ----------------

// ----------- FUNCTION PASSWORD SHOW INVALID MSG -----------------
function passwdErr() {
  if($(".lay-password-outline").hasClass("password-invalid"))
  {
    $("#err-passwd").show();
  } else {
    $("#err-passwd").hide();
  }
}
// ----------- END FUNCTION PASSWORD SHOW INVALID MSG -----------------

</script>
</body>
</html>
