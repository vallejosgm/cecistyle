<?php
  if ($_SERVER['HTTP_HOST'] == 'localhost')
  {
    error_reporting(-1);
    ini_set( 'display_errors', 1 );
  }
  include_once($_SERVER['DOCUMENT_ROOT']."/cecistyle/resources/includes/list-stuff.php");
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Ceci'Style</title>
	<link rel="stylesheet" type="text/css" href="./resources/css/app.css">
	<link rel="stylesheet" type="text/css" href="./resources/css/gallery.css">
	<link rel="stylesheet" type="text/css" href="./resources/css/booking.css">
	<script type="text/javascript" src="./resources/js/lightbox-plus-jquery.min.js"></script>
	<script type="text/javascript" src="./resources/js/gallery-photos.js" defer></script>
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
				echo getNav();
			@endphp
		</nav>
		<div class='calendar' id='dataJS' data-module='fourthStepBook'>
			<h2 class='title'>Book An Appoinment</h2>
			@if($confirmationMessage == 'false' && $emailSent == 'false') 
				<div class='cal-days'>Failed Appointment</div>
				<div class='msg-confirmation'>Sorry, an unexpected error occurred while trying to save 
					the Appointment. We ask that you call Ceci'Style at (385) 215-6034 to make an 
					appointment.</div>
			@else 
				<div class='cal-days'>Confirmation's message</div>
				@if($confirmationMessage != 'false' && $emailSent == 'false') 
					<div class='msg-confirmation'>{{ $mailData['fullname'] }}, your appointment has been 
						verified for {{ $mailData['dHidden'] }} at {{ date('h:i a', 
						strtotime($mailData['hHidden'])) }} with a duration of {{ $mailData['sHidden'] }} 
						minutes.</div>
				@else 
					@if($confirmationMessage == 'false' && $emailSent != 'false') 
						<div class='msg-confirmation'>You should receive a reminder and details of your 
							appointment at phone number {{ $mailData['phone'] }} and at {{ $mailData['email'] }}
						</div>
					@else 
						<div class='msg-confirmation'>{{ $mailData['fullname'] }}, your appointment has been 
							verified for {{ $mailData['dHidden'] }} at {{ date('h:i a', 
							strtotime($mailData['hHidden'])) }} with a duration of {{ $mailData['sHidden'] }} 
							minutes. You should receive a reminder and details of your 
							appointment at phone number {{ $mailData['phone'] }} and at {{ $mailData['email'] }}
						</div>
					@endif
				@endif
			@endif
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