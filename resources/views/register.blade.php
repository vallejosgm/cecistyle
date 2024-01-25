@php
    if ($_SERVER['HTTP_HOST'] == 'localhost')
    {
        error_reporting(-1);
        ini_set( 'display_errors', 1 );
    }
    session_start();
    include_once($_SERVER['DOCUMENT_ROOT']."/cecistyle/resources/includes/list-stuff.php");
@endphp

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Ceci'Style</title>
	<link rel="stylesheet" type="text/css" href="./resources/css/app.css">
	<link rel="stylesheet" type="text/css" href="./resources/css/gallery.css">
	<link type="text/css" rel="stylesheet" href="./resources/css/login.css">
	<script type="text/javascript" src="./resources/js/lightbox-plus-jquery.min.js"></script>
</head>
<body>
	<div class="main-wrapper">
		<header>
			@php 
				echo getLogo();
			@endphp
		</header>
		<nav class="main-nav">
			@php
				echo getNav()
			@endphp
		</nav>
        <div>
            @if(Session::has('success'))
                <div>
                    {{ Session::get('success') }}
                </div>
            @endif
            <form action="{{ route('register') }}" method="post">
                @csrf
                <input type="text" name="name" placeholder="Name">
                <input type="text" name="email" placeholder="Email">
                <input type="password" name="password" placeholder="Password">
                <input type="submit" name="login-button" value="Register">
            </form>
        </div>
		<footer id="f-cover">
			<?php 
				echo getFooter();
			?>
		</footer>	
	</div>
	<script type="text/javascript" src="./resources/js/script.js"></script>
</body>
</html>