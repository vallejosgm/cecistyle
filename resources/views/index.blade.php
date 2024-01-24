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
		<?php
			if (isset($_POST['bday'])) {
				echo "<div class='calendar' id='dataJS' data-module='secondStepBook'>";
				#echo getHours($_POST['bday'], $_POST['id_service'], $_POST['service'], $_POST['nameService'],'index.php');
				echo "</div>";
			} else {
				if (isset($_POST['box-hour-value'])) { 
					echo getInfo($_POST['date-selected'], $_POST['box-hour-value'], $_POST['id-service-selected'], $_POST['service-selected'], $_POST['name-selected']);
				} else {
					if (isset($_POST['form_token']) && ($_POST['form_token'] == $_SESSION['form_token'])) {
						$_SESSION['form_token'] == sha1(mt_rand());
						echo getConfirmation($_POST['fullname'], $_POST['email'], $_POST['phone'], $_POST['dHidden'], $_POST['hHidden'],  $_POST['idsHidden'], $_POST['sHidden'], $_POST['comments'], $_POST['nsHidden']);
					} else {
						echo getVideo($video);
						echo getAd("./public/images/ads/ad1.jpg", "10% off!", "In this month of June by your alterations. In this month of June by your alterations. In this month of June by your alterations. In this month of June by your alterations. In this month of June by your alterations. In this month of June by your alterations. In this month of June by your alterations.", "img");
		?>
						<main id="photos-gallery" class="gallery-businness">
							<?php 
								echo getGallery();
							?>
						</main>
							<?php 
								echo getAd("./public/images/ads/ad2.jpg", "10% off!", "In this month of June by your alterations. In this month of June by your alterations. In this month of June by your alterations. In this month of June by your alterations. In this month of June by your alterations. In this month of June by your alterations. In this month of June by your alterations.", "text");
							?>
						<main id="reviews-gallery" class="reviews-businness">
							<?php 
								echo getReviews($options);
							?>
						</main>
						<?php 
							echo getAd("./public/images/ads/ad3.jpg", "10% off!", "In this month of June by your alterations. In this month of June by your alterations. In this month of June by your alterations. In this month of June by your alterations. In this month of June by your alterations. In this month of June by your alterations. In this month of June by your alterations.", "img");
						?>
						<main id="first-booking" class="booking-businness">
							<div class='calendar' id='dataJS' data-module='firstStepBook'>
								<h2 class='title'>Book An Appoinment</h2>
								<div class='cal-days'>When Do You Want To Come?</div>
								<form action='booking' method='post' onsubmit='return validateForm()'>
									@csrf
								<div class='cal-time'>Select A Day</div>
								<?php
									echo getDatePicker('', '', 'today');
								?>
								<div class='cal-time'>Select A Service</div>
								<div class='cal-cover-services'>
									<input type='hidden' name='admin-selected' value='10'>
									<?php
										echo getServicesAvailablesDB($services, '');
									?>
								</div>
								<div class='cal-time'></div>
								<div id='select-service' class='alert-service'>Please Select A Service</div>
									<input type='submit' id='firstStep' name='firstStep' value='Next Step'>
								</form>
							</div>

						</main>
			<?php							
					}
				}
			}
			?>
		<footer id="f-cover">
			<?php 
				echo getFooter();
			?>
		</footer>	
	</div>
	<script type="text/javascript" src="./resources/js/script.js"></script>
</body>
</html>