<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="robots" content="noindex">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Merintis Indonesia - Login Admin</title>

  <!-- Favicons -->
  <link href="{{ asset('favicon.png') }}" type="image/png" rel="icon">
  <link href="{{ asset('apple-touch-icon.png') }}" rel="apple-touch-icon">

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
<!--============================ NAVBAR -->
<nav class="navbar navbar-light bg-light px-sm-5 shadow-sm mb-5">
  <div class="d-flex justify-content-center">
    <a class="navbar-brand" href="{{ url('/') }}">
      <img src="{{ asset('assets/img/logo-mis-color.png') }}" class="logo" alt="logo-mis">
    </a>
    <a class="navbar-brand my-auto" href="{{ url('/') }}">
      <span><span class="heading hijau">Merintis</span> <span class="heading kuning">Indonesia</span>
    </a>
    
  </div>
</nav>
<!--============================ END NAVBAR -->

<div class="container">
  <div class="row justify-content-center mb-5">
    <div class="col-md-7 col-lg-5">
      <!--============================ CARD DAFTAR -->
      <div class="card text-center">
        <div class="card-body px-5">
          <h5 class="card-title">Login MI-Admin</h5>
          <!--================ ALERT -->
          <div id="alert-info"></div>
          <!--================ END ALERT -->
          <form id="formAdmin" class="mt-3 custom-form">
            @csrf
            <div class="row">
              <div class="col-md-12 col-sm-12">
                <div class="form-group">
                  <input type="text" class="form-control" placeholder="Username" name="uname">
                  <div class="invalid-feedback">
                    Pesan error username
                  </div>
                </div>
                <div class="form-group">
                  <div class="lay-password-outline">
                    <input type="password" class="form-control password" placeholder="Password" name="password">
                    <a href="javascript:void(0)">
                      <i class="fa fa-eye-slash"></i>
                    </a>
                  </div>
                  <div id="err-passwd" class="invalid-feedback">
                    Pesan error password
                  </div>
                </div>
              </div>
            </div>
          </form>
          <button id="btnLogAdmin" class="button button-hero">Login</button>
        </div>
        <!--============================ END CARD DAFTAR -->
      </div>
    </div>
  </div>
</div>

<script src="{{ asset('assets/vendors/jquery/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('assets/vendors/bootstrap/bootstrap.bundle.min.js') }}"></script>
<script type="text/javascript">
//------------ KIRIM DATA ---------------
$('#btnLogAdmin').on('click', function() {
  $.ajax({
    type: "post",
    url: "{{ url('/miadmin/cekadmin') }}",
    data: $('#formAdmin').serialize(),
    beforeSend: function() {
      $("#btnLogAdmin").attr('disabled', true);
      $("#btnLogAdmin").addClass('wait');
    },
    success: function(data) {
      console.log(data);
      if (data.success) {
        alertBerhasil(data.message);
        $(".form-control").eq(0).removeClass("is-invalid");
        $(".invalid-feedback").eq(0).html('');
        $(".lay-password-outline").removeClass("password-invalid");
        $("#err-passwd").html('');
        $("#btnLogAdmin").attr('disabled', false);
        $("#btnLogAdmin").removeClass('wait');
        window.location.href = "{{ url('/miadmin/homeadmin') }}"
      } else if (!data.success) {
        if (data.errors && data.errors.uname) {
          $(".form-control").eq(0).addClass("is-invalid");
          $(".invalid-feedback").eq(0).html(data.errors.uname);          
        } else {
          $(".form-control").eq(0).removeClass("is-invalid");
          $(".invalid-feedback").eq(0).html('');
          $("#btnLogAdmin").attr('disabled', false);
          $("#btnLogAdmin").removeClass('wait');
        } 
        
        if (data.errors && data.errors.password) {
          $(".lay-password-outline").addClass("password-invalid");
          $("#err-passwd").html(data.errors.password);
        } else {
          $(".lay-password-outline").removeClass("password-invalid");
          $("#err-passwd").html('');
          $("#btnLogAdmin").attr('disabled', false);
          $("#btnLogAdmin").removeClass('wait');
        }
      }
      passwdErr();
      $("#btnLogAdmin").attr('disabled', false);
      $("#btnLogAdmin").removeClass('wait');
    },
    error: function(err) {
      // database offline tulis error disini
      // console.log(err);
      alertGagal("Internal Server Error");
      //------ENABLED BUTTON
      $("#btnLogAdmin").attr('disabled', false);
      $("#btnLogAdmin").removeClass('wait');
    }
  });
});
//------------ END KIRIM DATA ---------------

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

//------------ ALERT FUNCTION ---------------
function alertBerhasil(pesan) {
  let alBerhasil = `
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <div id="text-berhasil">${pesan}</div>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  `
  $('#alert-info').html(alBerhasil)
}

function alertGagal(pesan) {
  let alGagal = `
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <div id="text-berhasil">${pesan}</div>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  `
  $('#alert-info').html(alGagal)
}
//------------ END ALERT FUNCTION ---------------
</script>
</body>
</html>
