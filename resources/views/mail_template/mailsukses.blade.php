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
    <h4 class="roboto-condensed">Halo, Sedulur!</h4>
    <p class="roboto">Terima kasih sudah mendaftarkan diri dan bergabung dalam <b>{{ $program }}</b></p>
    <p class="roboto">Berikut kami lampirkan informasi link akses:</p>
    <p class="roboto">
        <b>Jadwal</b><br>
        {{ $jadwal }}
    </p>
    <p class="roboto">
        <b>Link Meeting</b><br>
        <a href="{{ $linkmeet }}">{{ $linkmeet }}</a>
    </p>
    <p class="roboto">
        Terima kasih, sampai jumpa!
    </p>
</body>

        
  