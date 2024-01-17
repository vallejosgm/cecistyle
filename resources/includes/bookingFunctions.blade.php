<?php
function getHours($d, $ids, $ds, $ns, $destiny) {
    $nameKey = 'id-service-selected';
    if ($destiny != 'hoursBooking') $nameKey = 'id-serselected';
    $return = '';
    $return .= "  <h2 class='title'>Book An Appoinment</h2>";
    $return .= "  <div class='cal-days'>When Do You Want To Come?</div>";
    #$return .= "  <form action='".$destiny."' method='post'>";
    $return .= "  <form action='booking/hoursBooking' method='post'>";
    $return .= "    <div class='cal-time'>Chosen Day</div>";
    $return .= "    <div class='chosen-day'>".date_format(date_create($d),"D, d M Y")."</div>";
    $gHA = getHoursAvailableDB($d);
    $return .=      getBoxHoursAvailable($gHA, $ds, $d, $destiny);
    $return .= "    <input type='hidden' name='".$nameKey."' value='".$ids."'>";
    $return .= "    <input type='hidden' id='service-selected' name='service-selected' value='".$ds."'>";
    $return .= "    <input type='hidden' id='date-selected' name='date-selected' value='".$d."'>";
    $return .= "    <input type='hidden' name='name-selected' value='".$ns."'>";
    $return .= "    <div class='cal-time'></div>";
    $return .= "    <input type='submit' id='secondStep' name='secondStep' value='Next Step' disabled='true'>";
    $return .= "   </form>";


    $return .= "</div>";

    return $return; 
  }

  function getInfo($d, $h, $ids, $s, $ns) {
    $return = '';
    $form_token = sha1(mt_rand());
    $_SESSION['form_token'] = $form_token;

    $return .= "<div class='calendar' id='dataJS' data-module='thirdStepBook'>";
    $return .= "<h2 class='title'>Book An Appoinment</h2>";
    $return .= "  <div class='cal-days'>Complete your information.</div>";
    $return .= "<form action='booking/setHours' method='post' onsubmit='return on_form_sbmt()'>";
    $return .= "  <div class='cal-time'>Your appointment will be the $d at ".date('h:i a', strtotime($h))." with a duration of $s minutes.</div>";
    $return .= "  <input type='text' class='cal-info-hidden' name='dHidden' value='$d'>";
    $return .= "  <input type='text' class='cal-info-hidden' name='hHidden' value='$h'>";
    $return .= "  <input type='text' class='cal-info-hidden' name='idsHidden' value='$ids'>";
    $return .= "  <input type='text' class='cal-info-hidden' name='sHidden' value='$s'>";
    $return .= "  <input type='text' class='cal-info-hidden' name='nsHidden' value='$ns'>";
    $return .= "  <input type='hidden' name='form_token' value='$form_token'>";
    $return .= "  <div class='cal-info'>";
    $return .= '    <input type="text" class="info-user" id="fullname" name="fullname" placeholder="Full Name" required>';
    $return .= '    <select class="info-user" name="pronouns">';
    $return .= '      <option value="she">She/Her</option>';
    $return .= '      <option value="he">He/Him</option>';
    $return .= '      <option value="they">They/Them</option>';
    $return .= '      <option value="other">Prefer not to say</option>';
    $return .= '    </select>';
    $return .= '    <input type="text" class="info-user" id="email" name="email" placeholder="username@example.com" required>';
    $return .= '    <input type="text" name="phone_number" id="phone" class="info-user" placeholder="(123) 456-7890" required>';
    $return .= '    <input type="hidden" name="phone" id="phone_number">';
    $return .= '    <textarea type="comments" maxlength="250" id="area-info-user" class="info-user" name="comments" value="" placeholder="Any additional things we need to know prior to your appointment" rows="2" cols="25"></textarea>';
    $return .= '    <div id="txtHint" style="color: orange;"></div>';
    $return .= "  </div>";
    $return .= "  <input type='submit' id='btnConfirm' value='Confirm'>";
    $return .= "</form>";
    $return .= "</div>";

    return $return; 
  }

  function getConfirmation($f, $e, $p, $d, $h, $ids, $ds, $m, $ns) {
    $return = '';
    
    $return .= "<div class='calendar' id='dataJS' data-module='fourthStepBook'>";
    $return .= "<h2 class='title'>Book An Appoinment</h2>";
    if (saveAppointmentDB($d, $h, $e, $p, $f, $m, $ids, $ds)==true){
      #if (sendmail($f, $e, $d, $h, $ns, $p, $m, true) == true) {
        #$message = $f.", your appointment has been verified for ".$d." at ".date('h:i a', strtotime($h))." with a duration of ".$ds." minutes. You should receive a reminder and details of your appointment at phone number ".$p.", and at ".$e.".";
        #sendmail($f, $e, $d, $h, $ns, $p, $m, false);
      #} else {
        $message = $f.", your appointment has been verified for ".$d." at ".date('h:i a', strtotime($h))." with a duration of ".$ds." minutes.";  
      #}
      $return .= "<div class='cal-days'>Confirmation's message</div>";
      $return .= "<div class='msg-confirmation'>".$message."</div>";
    } else {
      $return .= "<div class='cal-days'>Failed Appointment</div>";
      $return .= "<div class='msg-confirmation'>Sorry, an unexpected error occurred while trying to save the Appointment. We ask that you call Ceci'Style at (385) 215-6034 to make an appointment.</div>";  
    }
    $return .= "</div>";

    return $return; 
  }

  function getBooking($creator) {
    $goPage = "booking";
    if($creator == "admin") $goPage = "calendar.php";
    $return = '';

    $return .= "<div class='calendar' id='dataJS' data-module='firstStepBook'>";
    $return .= "  <h2 class='title'>Book An Appoinment</h2>";
    $return .= "  <div class='cal-days'>When Do You Want To Come?</div>";
    #$return .= "  <form action='".$goPage."' method='post' onsubmit='return validateForm()'>";
    $return .= "  <form action='booking' method='post' onsubmit='return validateForm()'>";
    $return .= "   @csrf";  
    $return .= "    <div class='cal-time'>Select A Day</div>";
    $return .= getDatePicker('', '', 'today');
    $return .= "    <div class='cal-time'>Select A Service</div>";
    $return .= "    <div class='cal-cover-services'>";
    $return .= "      <input type='hidden' name='admin-selected' value='10'>";
    $return .= getServicesAvailablesDB(getServicesDB($creator), $creator);
    $return .= "    </div>";
    $return .= "    <div class='cal-time'></div>";
    $return .= "    <div id='select-service' class='alert-service'>Please Select A Service</div>";
    $return .= "     <input type='submit' id='firstStep' name='firstStep' value='Next Step'>";
    $return .= "  </form>";
    $return .= "</div>";

    return $return;
  }

  function getHoursAvailableDB($d) {
    $con = connectToDB();
    $sql = 'SELECT hour_start_appo, hour_end_appo, duration_minutes_serv FROM tbl_app_no_sign, tbl_service WHERE (tbl_app_no_sign.id_serv=tbl_service.id_serv) AND (date_appo = "'.$d.'");';
    $results = mysqli_query($con, $sql);
    if(!mysqli_num_rows($results)) return false;
    while ($record = mysqli_fetch_array($results, MYSQLI_ASSOC))
    {
      $aHoursDuration[] = $record;
    }

    mysqli_close($con);
    return $aHoursDuration;
  }

  function getBoxHoursAvailable($busyHours, $durationService, $dateAppo, $destiny) {
    $displayBox = '';
    list($arrayHoursDay, $arrayHoursAvailable) = hoursOpenByDay($dateAppo);#To limit hours by days (Saturday, Sunday, and Another day)
    if(date('l', strtotime($dateAppo)) == "Sunday") {#Whether or not there are hours available
        return noHoursAvailable($displayBox, $destiny);#Store closed
    } else { #Mark like busy at non-free hours
        date_default_timezone_set("America/Denver");
        $arrayHoursAvailable = markTodayBusy($dateAppo, $arrayHoursDay, $arrayHoursAvailable); #If the day is today, Mark like busy hours before currently and two hours more ahead.
        if ($busyHours != false) $arrayHoursAvailable = markBusyHours($busyHours, $arrayHoursDay, $arrayHoursAvailable, $durationService, $dateAppo);
        #If busyHours is false => All hours are free
        $arrayHoursAvailableWithFilter = array_filter($arrayHoursAvailable, function($v) { return $v == '';});#Draw box in 3 by row
        if (count($arrayHoursAvailableWithFilter) == 0) return noHoursAvailable($displayBox, $destiny);#If day is full => Hours free is empty
        return getHoursLikeBoxes($arrayHoursAvailableWithFilter, $displayBox, $arrayHoursDay, $destiny);#If there are free hours => draw hours like boxes
    }

    return $displayBox;
  }

  function hoursOpenByDay($dateAppo) {
    if(date('l', strtotime($dateAppo)) == "Saturday") {
      $arrayHoursDay = array(0 => "09:00", 1 => "09:30", 2 => "10:00", 3 => "10:30", 4 => "11:00", 5 => "11:30", 6 => "12:00", 7 => "12:30", 8 => "13:00");
      $arrayHoursAvailable = array("", "", "", "", "", "", "", "", "");
    } else {
        if(date('l', strtotime($dateAppo)) == "Sunday") {
            $arrayHoursDay = array();
            $arrayHoursAvailable = array();
        } else {
            $arrayHoursDay = array(0 => "09:00", 1 => "09:30", 2 => "10:00", 3 => "10:30", 4 => "11:00", 5 => "11:30", 6 => "12:00", 7 => "12:30", 8 => "13:00", 9 => "13:30", 10 => "14:00", 11 => "14:30", 12 => "15:00", 13 => "15:30", 14 => "16:00", 15 => "16:30", 16 => "17:00", 17 => "17:30", 18 => "18:00", 19 => "18:30");
            $arrayHoursAvailable = array("", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "");     
        }
    }

    return array($arrayHoursDay, $arrayHoursAvailable);
  }

  function noHoursAvailable($displayBox, $destiny) {
    $nameBtn = 'Book an appointment';
    if ($destiny != 'index.php') $nameBtn = 'Create Event';
    $displayBox .= "<div class='cal-time'>There are no hours available for this date. Click on the '".$nameBtn."' button and select another date.</div>";
    $displayBox .= "<div class='cover-contenthours'></div>";

    return $displayBox;
  }

  function markTodayBusy($dateAppo, $arrayHoursDay, $arrayHoursAvailable) {
    date_default_timezone_set("America/Denver"); #TimeZone Utah
    $today = date_create(date("Y-m-d H:i")); #Date of Today
    if(date_format($today,"Y-m-d") == $dateAppo) { #If appointment is today, then...
        $timeToday = date_create($today->format("H:i")); #Hours and Minutes today
        for ($i = 0; $i < sizeof($arrayHoursDay); $i++) { #Iterate all Hours Available
            #$timeArray = date_create($arrayHoursDay[$i]); 
            $timeArray = date_create($arrayHoursDay[$i]); 
            $diffHourArrayAndCurrently = date_diff($timeToday, $timeArray); #Diffrences between times
            $diffHourArrayAndCurrentlyMinutes = (($diffHourArrayAndCurrently->h * 60) + ($diffHourArrayAndCurrently->i)); #Diffrences between times in Minutes
            if (!($timeToday <= $timeArray) || (($timeToday < $timeArray) && ($diffHourArrayAndCurrentlyMinutes <= 120))){ #If time Currrently is greater than array time OR If time Currrently is lower than array time, but the diffrences is less than 120 minutes, then...
                $arrayHoursAvailable[$i] = "busy"; #Mark array time like busy
            }
        }
    }
    return $arrayHoursAvailable;
  }

  function markBusyHours($busyHours, $arrayHoursDay, $arrayHoursAvailable, $durationService, $dateAppo) {
    $j=0;
    foreach ($busyHours as $key => $value) {
        $j = array_search(substr($value["hour_start_appo"], 0, -3), $arrayHoursDay); #I get initial index to mark like busy on $arrayHoursDay
        $interval = date_diff(date_create($value["hour_start_appo"]), date_create($value["hour_end_appo"])); #difference in minutes between start and end hours 
        $quantityThirtyMinutes = (($interval->h * 60) + ($interval->i))/30; #The difference in minutes total and divided in package of 30 minutes
        for($i = 0; $i < $quantityThirtyMinutes; $i++) $arrayHoursAvailable[$j + $i] = "busy"; #Put busy on $arrayHoursDay
    }

    if($durationService == "60") {
        for ($i=0; $i < count($arrayHoursAvailable); $i++) { 
          if (($arrayHoursAvailable[$i] == "busy") && ($i != 0)) {
            $arrayHoursAvailable[$i - 1] = "busy";
          }
        }
    }

    return $arrayHoursAvailable;
  }

  function getHoursLikeBoxes($arrayHoursAvailableWithFilter, $displayBox, $arrayHoursDay, $destiny) {
    $ti = 'radio';
    $ni = 'box-hour-value';
    if ($destiny == 'calendar.php') {
        $ti = 'checkbox';
        $ni = 'box-hour-value[]'; 
    } 
    $i = 1;
    $j = 1;
    $k = 1;
    $countMultThree = intval(count($arrayHoursAvailableWithFilter)/3);
    $restMultThree = count($arrayHoursAvailableWithFilter)%3;
    foreach ($arrayHoursAvailableWithFilter as $key => $value) {
        if($j <= $countMultThree) {
            if($i % 3 == 1) $displayBox .= "<div class='content-hours'>";
            
                $displayBox .= "    <input type='".$ti."' class='box-hour-hidden' id='hour".$key."' name='".$ni."' value='".$arrayHoursDay[$key]."'>";
                $displayBox .= "    <label class='box-hour' id='box-hour".$key."' for='hour".$key."'>".date('h:i a', strtotime($arrayHoursDay[$key]))."</label>";    
              
            if($i % 3 == 0) {
                $displayBox .= "</div>";
                if($j <= $countMultThree) $j++;    
            } 
            $i++;
        } else {
            if(($j > ($countMultThree)) && ($restMultThree > 0)) {
                if($k == 1) $displayBox .= "<div class='content-hours'>";
                $displayBox .= "    <input type='".$ti."' class='box-hour-hidden' id='hour".$key."' name='".$ni."' value='".$arrayHoursDay[$key]."'>";
                $displayBox .= "    <label class='box-hour' id='box-hour".$key."' for='hour".$key."'>".date('h:i a', strtotime($arrayHoursDay[$key]))."</label>";
                if($k == $restMultThree)  $displayBox .= "</div>";
                $k++;
            }
        }
    }

    return $displayBox;
  }

  function saveAppointmentDB($d, $h, $e, $p, $fn, $m, $ids, $ds) {
    $return = false;
    $con = connectToDB();
    if ($ds == "60") {
      $he = date('H:i', strtotime($h. ' +60 minutes'));
    } else {
      $he = date('H:i', strtotime($h. ' +30 minutes'));
    }
     
    $sql = "INSERT INTO `tbl_app_no_sign` (`date_appo`, `hour_start_appo`, `hour_end_appo`, `email`, `phone`, `fullname`, `message`, `id_serv`) VALUES ('".$d."', '".$h."', '".$he."', '".$e."', ".$p.", '".$fn."', '".$m."', ".$ids.");";
    //RUN THE COMMAND
    if(mysqli_query($con, $sql) == true) $return = true;
    else $return = false;

    //CLOSING CONNECTION
    mysqli_close($con);

   return $return; 
  }

  function getDatePicker($d, $dis, $min) {
    if($d=='') $d = date("Y-m-d");
    if($min!='') $min = date("Y-m-d");
    $return = '';

    $return .= '<div class="nativeDatePicker">';
    $return .= '  <input type="date" id="bday" name="bday" value="'.$d.'" min="'.$min.'" required '.$dis.'>';
    $return .= '  <span class="validity"></span>';
    $return .= '</div>';
    $return .= '<div class="fallbackDatePicker">';
    $return .= '<span>';
    $return .= '  <label for="day">Day:</label>';
    $return .= '  <select id="day" name="day"></select>';
    $return .= '</span>';
    $return .= '<span>';
    $return .= '  <label for="month">Month:</label>';
    $return .= '  <select id="month" name="month">';
    $return .= '    <option selected>January</option>';
    $return .= '    <option>February</option>';
    $return .= '    <option>March</option>';
    $return .= '    <option>April</option>';
    $return .= '    <option>May</option>';
    $return .= '    <option>June</option>';
    $return .= '    <option>July</option>';
    $return .= '    <option>August</option>';
    $return .= '    <option>September</option>';
    $return .= '    <option>October</option>';
    $return .= '    <option>November</option>';
    $return .= '    <option>December</option>';
    $return .= '  </select>';
    $return .= '</span>';
    $return .= '<span>';
    $return .= '  <label for="year">Year:</label>';
    $return .= '  <select id="year" name="year"></select>';
    $return .= '</span>';
    $return .= '</div>';

    return $return;
  }

  function getServicesAvailablesDB($aServices, $creator) {
    $vii = '3';
    $vin = 'Wedding dress alterations';
    if ($creator == 'admin') {
      $vii = '10';
      $vin = 'Admin';  
    }
    $displayServices = '';
    $i = 0;
    $displayServices .= "        <input type='hidden' id='id_service' name='id_service' value='".$vii."'>";
    $displayServices .= "        <input type='hidden' id='name_service' name='nameService' value='".$vin."'>";
    foreach ($aServices as $key => $value) {
      $displayServices .= "      <div class='cover-services-columns'>";
      $displayServices .= "        <input type='radio' onclick='handleClick(this);' id='".$value['id_serv']."' name='service' value='".$value['duration_minutes_serv']."' data-name='".$value['name_serv']."'>";
      #if($i == 0) {$displayServices .= "checked>";} else {$displayServices .= ">";}
      $displayServices .= "        <label for='".$value['id_serv']."'>".$value['name_serv']."</label>";
      $displayServices .= "      </div>";
      $i = 1;
    }
    return $displayServices;
  }

  function getServicesDB($creator) {
    $con = connectToDB();
    $sql = 'SELECT id_serv, name_serv, duration_minutes_serv FROM tbl_service ';
    if($creator == "admin") $sql .= 'ORDER BY priority_serv DESC;';
    else $sql .= 'WHERE id_serv <> 10 ORDER BY priority_serv;';
    $results = mysqli_query($con, $sql);
    if(!mysqli_num_rows($results)) return false;
    while ($record = mysqli_fetch_array($results, MYSQLI_ASSOC))
    {
      $services[] = $record;
    }

    mysqli_close($con);
    
    return $services;
  }
?>