
<h2 class='title'>Book An Appoinment</h2>
<div class='cal-days'>When Do You Want To Come?</div>
  <form action='{{ $destiny }}' method='post'>
    <div class='cal-time'>Chosen Day</div>
    <div class='chosen-day'>{{ $bdate }}</div>

    <input type='hidden' name='{{ $nameKey }}' value='{{ $idService }}'>
    <input type='hidden' id='service-selected' name='service-selected' value='{{ $service }}'>
    <input type='hidden' id='date-selected' name='date-selected' value='{{ $bdate }}'>
    <input type='hidden' name='name-selected' value='{{ $nameService }}'>
    <div class='cal-time'></div>
    <input type='submit' id='secondStep' name='secondStep' value='Next Step' disabled='true'>
   </form>