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
			<ul id="h-content-item">
                <li><a href="index.php">Home</a></li>
                <li><a href="{{ route('calendar') }}">Calendar</a></li>
                <li>
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        @method('DELETE')
                        <input type="submit" id="logoutbtn" value="Logout">
                    </form>
                </li>
            </ul>
            <div class="nav">
                <input type="checkbox" id="toogle">
                <label id="iomenu" for="toogle">☰</label>
                <div class="menu">
                    <a href="index.php">Home</a>
                    <a href="{{ route('calendar') }}">Calendar</a>
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        @method('DELETE')
                        <input type="submit" id="logoutbtn" value="Logout">
                    </form>
                </div>
            </div>
		</nav>
		<div class="fontAcme">{{ Auth::user()->name }} Welcome to Ceci\'Style!!!</div>
		<footer id="f-cover">
			<?php 
				echo getFooter();
			?>
		</footer>	
	</div>
	<script type="text/javascript" src="./resources/js/script.js"></script>
</body>
</html>