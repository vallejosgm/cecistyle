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
	<link type="text/css" rel="stylesheet" href="./resources/css/login.css">
    <link type="text/css" rel="stylesheet" href="./resources/css/calendar.css">
    <link type="text/css" rel="stylesheet" href="./resources/css/booking.css">
    <script src="./resources/js/jquery/3.5.1/jquery.min.js"></script>
	<script type="text/javascript" src="./resources/js/lightbox-plus-jquery.min.js"></script>
</head>
<body>
	<div class="main-wrapper">
		<header class="toogle-show">
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
		
        <div class="contentCal">
            <div class="headerCal">
                <form action="{{ route('apptcreate') }}" method="POST">
                    @csrf
                    <input type="submit" class="createButton" name="createButton" value="Create Event"/>
                </form>
            </div>
            <div class='calendar' id='bodyCal' data-module='secondStepBook'>
                <h2 class='title'>Book An Appoinment</h2>
                <div class='cal-days'>When Do You Want To Come?</div>
                <form action=" {{ route('confirmAppt') }} " method='post'>
                    @csrf
                    <div class='cal-time'>Chosen Day</div>
                    <div class='chosen-day'>{{ $bdate }}</div>
                    @php
                    echo getBoxHoursAvailable($hours_available, $service, $bday, 'Admin');  
                    @endphp
                    <input type='hidden' name='id-service-selected' value={{ $id_service }}>
                    <input type='hidden' id='service-selected' name='service-selected' value={{ $service }}>
                    <input type='hidden' id='date-selected' name='date-selected' value={{ $bday }}>
                    <input type='hidden' name='name-selected' value={{ $nameService }}>
                    <div class='cal-time'></div>
                    <input type='submit' id='secondStep' name='secondStep' value='Next Step' disabled='true'>
                </form>
            </div>
        </div>
        <footer id="f-cover">
			<?php 
				echo getFooter();
			?>
		</footer>	
	</div>
	<script type="text/javascript" src="./resources/js/calendar.js" defer></script>
    
</body>
</html>