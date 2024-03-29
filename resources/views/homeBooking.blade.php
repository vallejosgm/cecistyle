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
        echo getNav()
      @endphp
    </nav>
    <div class='calendar' id='dataJS' data-module='secondStepBook'>
      <h2 class='title'>Book An Appoinment</h2>
      <div class='cal-days'>When Do You Want To Come?</div>
      <form action='hoursBooking' method='post'>
        @csrf
        <div class='cal-time'>Chosen Day</div>
        <div class='chosen-day'>{{ $bdate }}</div>
        @php
          echo getBoxHoursAvailable($hours_available, $service, $bday, 'booking');  
        @endphp
        <input type='hidden' name='id-service-selected' value={{ $id_service }}>
        <input type='hidden' id='service-selected' name='service-selected' value={{ $service }}>
        <input type='hidden' id='date-selected' name='date-selected' value={{ $bday }}>
        <input type='hidden' name='name-selected' value={{ $nameService }}>
        <div class='cal-time'></div>
        <input type='submit' id='secondStep' name='secondStep' value='Next Step' disabled='true'>
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