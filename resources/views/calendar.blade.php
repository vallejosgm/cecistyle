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
	<link type="text/css" rel="stylesheet" href="./resources/css/login.css">
    <link type="text/css" rel="stylesheet" href="./resources/css/calendar.css">
    <script src="./resources/js/jquery/3.5.1/jquery.min.js"></script>
	<script type="text/javascript" src="./resources/js/lightbox-plus-jquery.min.js"></script>
</head>
<body>
	<div class="main-wrapper">
		<header class="toogle-show">
			@php 
				echo getLogo();
			@endphp
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
		</header>
		
		
        <div class="contentCal">
            <div class="headerCal">
                <form action="{{ route('apptcreate') }}" method="POST">
                    @csrf
                    <input type="submit" class="createButton" name="createButton" value="Create Event"/>
                </form>
            </div>
            <?php
                if (isset($_POST['createButton']))
              {
                  #echo createRow();
                  echo "<div class='calendar' id='bodyCal' data-module='firstStepBook'>";
                  echo getBooking('admin');
                  echo "</div>";
               } else {
                   if (isset($_POST['admin-selected'])) {
                       echo "<div class='calendar' id='bodyCal' data-module='secondStepBook'>";
                       echo getHours($_POST['bday'], $_POST['id_service'], $_POST['service'], $_POST['nameService'], 'calendar.php');
                       echo "</div>";
                   } else {
                       if (isset($_POST['id-serselected'])) {
                           echo "<div class='calendar' id='bodyCal' data-module='secondStepBook'>";
                           echo createRow($_POST['box-hour-value'], $_POST['id-serselected'], $_POST['service-selected'], $_POST['date-selected'], $_POST['name-selected']);
                           echo "</div>";
                       } else {
                           if (isset($_POST['rowEdit']))
                          {
                                  $id = $_POST['rowID'];
                                  $d = $_POST['dateAppt'];
                                  $hs = $_POST['hs'];
                                  $he = $_POST['he'];
                                  $e = $_POST['email'];
                                  $p = $_POST['phone'];
                                  $fn = $_POST['fn'];
                                  $m = $_POST['mess'];
                                  $is = $_POST['idServ'];
                                  echo editRow($id, $d, $hs, $he, $e, $p, $fn, $m, $is);
                           } else {
                               if (isset($_POST['rowRemove'])) 
                               {
                                   $id = $_POST['rowID'];
                                  $d = $_POST['dateAppt'];
                                  $hs = $_POST['hs'];
                                  $he = $_POST['he'];
                                  $e = $_POST['email'];
                                  $p = $_POST['phone'];
                                  $fn = $_POST['fn'];
                                  $m = $_POST['mess'];
                                  $ns = $_POST['nameServ'];
                                  echo confirmRemove($id, $d, $hs, $he, $e, $p, $fn, $m, $ns);
                               } else {
                                    echo $displayForm;
                                    
                               }
                           }
                       }
                   }
                      
                   }
            ?>
            <footer>
                <span class="copyright">© 2005 All Right Reserved <a href="https://www.cecistyle.org">CeciStyle Corp</a></span>
            </footer>
        </div>
        	
	</div>
	<script type="text/javascript" src="./resources/js/calendar.js" defer></script>
    <script type="text/javascript">
        
            var element = document.getElementById("day_selected");
            if (typeof(element) === "undefined" || element === null) {
                document.getElementById("month").id = "day_selected";
            }
    
            function editFunction(id) { 
                window.location.href = "{{ route('editData') }}?id=" + id;
            }
        
    </script>
</body>
</html>