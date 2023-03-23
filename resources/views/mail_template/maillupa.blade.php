<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
		@import url("https://fonts.googleapis.com/css?family=Roboto:400,500");
		body {
			margin: 0px;
			padding: 0px;
		}
		
        .bg-lightGreen {
            background-color: #defae0;
            padding: 4px;
            wide: 100%;
			overflow: auto;
        }
		
        img {
            float: left;
			height: 50px;
			margin-top: 4px;
        }
		
		.roboto-condensed {
			 font-family: "Roboto", sans-serif;
			 font-weight: 700;
		}
		
		.roboto {
			 font-family: "Roboto", sans-serif;
			 font-weight: 400;
		}
    </style>
</head>
<body>
    <div class="bg-lightGreen">
        <img src="https://merintisindonesia.com/assets/img/Logo-MI.png" alt="logo_merintis">
        <h3 style="margin-left: 60px" class="roboto-condensed">MERINTIS INDONESIA</h3>
    </div>
    <h4 class="roboto-condensed">Reset Password Akun Merintis Indonesia</h4>
    <p class="roboto">Berikut adalah token reset password: <b>{{ $token }}</b></p>
    <p class="roboto">Jangan tunjukkan kode kepada siapapun</p>
</body>

        
  