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
		<div class='calendar' id='dataJS' data-module='secondStepBook'>
			@php
					echo getInfo($_POST['date-selected'], $_POST['box-hour-value'], $_POST['id-service-selected'], $_POST['service-selected'], $_POST['name-selected']);
			@endphp
            
		</div>
        <div class='calendar' id='dataJS' data-module='thirdStepBook'>
            <h2 class='title'>Book An Appoinment</h2>
            <div class='cal-days'>Complete your information.</div>
            <form action='confirmBooking' method='post' onsubmit='return on_form_sbmt()'>
                <div class='cal-time'>Your appointment will be the {{ $dateSelected }} at {{ $boxHourValue }} with a duration of {{ $serviceSelected }} minutes.</div>
                <input type='text' class='cal-info-hidden' name='dHidden' value={{ $dateSelected }}>
                <input type='text' class='cal-info-hidden' name='hHidden' value={{ $boxHourValue }}>
                <input type='text' class='cal-info-hidden' name='idsHidden' value={{ $idServiceSelected }}>
                <input type='text' class='cal-info-hidden' name='sHidden' value={{ $serviceSelected }}>
                <input type='text' class='cal-info-hidden' name='nsHidden' value={{ $nameSelected }}>
                <input type='hidden' name='form_token' value='$form_token'>
                <div class='cal-info'>
                    <input type="text" class="info-user" id="fullname" name="fullname" placeholder="Full Name" required>
                    <select class="info-user" name="pronouns">
                        <option value="she">She/Her</option>
                        <option value="he">He/Him</option>
                        <option value="they">They/Them</option>
                        <option value="other">Prefer not to say</option>
                    </select>
                    <input type="text" class="info-user" id="email" name="email" placeholder="username@example.com" required>
                    <input type="text" name="phone_number" id="phone" class="info-user" placeholder="(123) 456-7890" required>
                    <input type="hidden" name="phone" id="phone_number">
                    <textarea type="comments" maxlength="250" id="area-info-user" class="info-user" name="comments" value="" placeholder="Any additional things we need to know prior to your appointment" rows="2" cols="25"></textarea>
                    <div id="txtHint" style="color: orange;"></div>
                </div>
                <input type='submit' id='btnConfirm' value='Confirm'>
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