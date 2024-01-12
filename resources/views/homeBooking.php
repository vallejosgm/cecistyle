<?php
  if ($_SERVER['HTTP_HOST'] == 'localhost')
  {
    error_reporting(-1);
    ini_set( 'display_errors', 1 );
  }
  session_start();
  include_once($_SERVER['DOCUMENT_ROOT']."/cecistyle/resources/includes/list-stuff.php");
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Ceci'Style</title>
	<link rel="stylesheet" type="text/css" href="../resources/css/app.css">
	<link rel="stylesheet" type="text/css" href="../resources/css/gallery.css">
	<script type="text/javascript" src="../resources/js/lightbox-plus-jquery.min.js"></script>
	<script type="text/javascript" src="../resources/js/gallery-photos.js" defer></script>
</head>
<body>
	<div class="main-wrapper">
		<header>
			<?php 
				echo getLogo();
			?>
		</header>
		<nav class="main-nav">
			<?php 
				echo getNav();
			?>
		</nav>
		<?php 
			echo getBooking('');
		?>
		<footer id="f-cover">
			<?php 
				echo getFooter();
			?>
		</footer>	
	</div>
	<script type="text/javascript" src="../resources/js/script.js"></script>
</body>
</html>