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
                <input type="submit" class="createButton" name="createButton" value="Create Event"/>
            </div>
            <div class='calendar' id='bodyCal' data-module='firstStepBook'>
                <div class='calendar' id='dataJS' data-module='firstStepBook'>
                    <h2 class='title'>Book An Appoinment</h2>
                    <div class='cal-days'>When Do You Want To Come?</div>
                    <form action='{{ route('setHoursBooking') }}' method='post' onsubmit='return validateForm()'>
                        @csrf
                        <div class='cal-time'>Select A Day</div>
                        @php
                            echo getDatePicker('', '', 'today');
                        @endphp
                        <div class='cal-time'>Select A Service</div>
                        <div class='cal-cover-services'>
                            <input type='hidden' name='admin-selected' value='10'>
                            <?php
                                echo getServicesAvailablesDB($services, 'admin');
                            ?>
                        </div>
                        <div class='cal-time'></div>
                        <div id='select-service' class='alert-service'>Please Select A Service</div>
                            <input type='submit' id='firstStep' name='firstStep' value='Next Step'>
                    </form>
                </div>
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