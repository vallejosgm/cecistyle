<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class CalendarController extends Controller
{
    private function getAppt($months, $years)
    {
        $appts = [];
        

        for ($j = 0; $j < 12; $j++) {
            $result = DB::select("SELECT `id_appo`, `date_appo`, `hour_start_appo`, `hour_end_appo`, 
            `services`.`id_serv` AS 'idService', `services`.`name_serv` AS 'nameService', 
            CONCAT(CAST(`services`.`name_serv` AS CHAR), ' ', CAST(`fullName` AS CHAR), ' ', 
            CAST(`message` AS CHAR)) AS 'Description', `email`, `phone`, `fullName`, DAY(`date_appo`) AS 'Day', 
            MONTH(`date_appo`) AS 'Month', `message`  FROM `apps_no_sign`, `services` 
            WHERE `apps_no_sign`.`id_serv` = `services`.`id_serv` AND (YEAR(`date_appo`) = ? 
            AND MONTH(`date_appo`) = ?) ORDER BY YEAR(`date_appo`), MONTH(`date_appo`), DAY(`date_appo`), 
            `hour_start_appo`;", [$years[$j], $months[$j]]);
            // Asegúrate de que la consulta haya devuelto resultados antes de intentar acceder a ellos
            if (!empty($result)) {
                $appts[$j] = $result;
            } else {
                $appts[$j] = null; // O maneja este caso según tus necesidades
            }
        }
        // Pasa los resultados a la vista
        return $appts;
    }
    
    public function index() {

        $displayForm = "";
        $months = [];
        $years = [];
        $appts = [];
        date_default_timezone_set("America/Denver");
        $today = date_create(date("Y-m-d"));
        $monthSelected = "";
        $dayselected = "";
        $date = date_create(date("Y-m-d"));
        $dateTemp = date_create(date("Y-m-d"));
        $months[6] = date_format($date,"m");
        $years[6] = date_format($date,"Y");
        $dayNoRepeat = '';

        for($i = 0; $i < 6; $i++) {
            if (date_format($date,"m") == 3 && date_format($date,"d") > 28) {
                date_sub($date,date_interval_create_from_date_string("32 days"));
            }
            else {
                date_sub($date,date_interval_create_from_date_string("30 days"));
            }  
            $months[5-$i] = date_format($date,"m");
            $years[5-$i] = date_format($date,"Y");
            if (date_format($dateTemp,"m") == 1 && date_format($dateTemp,"d") > 28) {
                date_add($dateTemp,date_interval_create_from_date_string("28 days"));
            }
            else {
                date_add($dateTemp,date_interval_create_from_date_string("30 days"));
            } 
            $months[$i+7] = date_format($dateTemp,"m");
            $years[$i+7] = date_format($dateTemp,"Y");
        }

        

        $appts = $this->getAppt($months, $years);
        //dd($appts);
        
        $displayForm .= '<div class="bodyCal" id="bodyCal"  data-module="calendar">';
        for($k = 0; $k < 12; $k++) {
            if ($appts[$k] !== null && sizeof($appts[$k]) != 0) {
                if ($months[$k] == date_format($today,"m")) $monthSelected = "month";
                else $monthSelected = "";
                $displayForm .= '      <div class="titleMonth" id="'.$monthSelected.'">'.date('M', strtotime('1-'.$months[$k].'-'.$years[$k])).' '.$years[$k].'</div>';
                $displayForm .= '        <div class="eventsCal">';
                foreach($appts[$k] as $x => $val) {
                    $displayForm .= '<form action='. route('confirmRemove') .' method="POST">'.csrf_field();
                    $displayForm .= '          <div class="eventCal">';
                    if ($months[$k] == date_format($today,"m") && $val->Day == date_format($today,"d")) $daySelected = "day_selected";
                    else $daySelected = "";
                    if($dayNoRepeat == $val->Day.'-'.$months[$k].'-'.$years[$k]) {
                        $displayForm .= '            <div class="cal dayWeek"></div>';
                        $displayForm .= '            <div class="cal dayWeek"></div>';
                    } else {
                        $displayForm .= '            <div class="cal dayWeek" id="'.$daySelected.'">'.$val->Day.'</div>';
                        $displayForm .= '            <div class="cal dayWeek">'.date('D', strtotime($val->Day.'-'.$months[$k].'-'.$years[$k])).'</div>';
                        $dayNoRepeat = $val->Day.'-'.$months[$k].'-'.$years[$k];
                    }
                    $displayForm .= '            <div class="cal hour startAppt">'.date_format(date_create($val->hour_start_appo),"H:i").'</div>';
                    $displayForm .= '            <div class="cal hour endAppt">'.date_format(date_create($val->hour_end_appo),"H:i").'</div>';
                    $displayForm .= '            <div class="cal detailAppt">'.$val->Description.'</div>';
                    $displayForm .= '            <input type="hidden" value="'.$val->id_appo.'" name="rowID"/>';
                    $displayForm .= '            <input type="hidden" value="'.$val->date_appo.'" name="dateAppt"/>';
                    $displayForm .= '            <input type="hidden" value="'.$val->hour_start_appo.'" name="hs"/>';
                    $displayForm .= '            <input type="hidden" value="'.$val->hour_end_appo.'" name="he"/>';
                    $displayForm .= '            <input type="hidden" value="'.$val->email.'" name="email"/>';
                    $displayForm .= '            <input type="hidden" value="'.$val->phone.'" name="phone"/>';
                    $displayForm .= '            <input type="hidden" value="'.$val->fullName.'" name="fn"/>';
                    $displayForm .= '            <input type="hidden" value="'.$val->message.'" name="mess"/>';
                    $displayForm .= '            <input type="hidden" value="'.$val->idService.'" name="idServ"/>';
                    $displayForm .= '            <input type="hidden" value="'.$val->nameService.'" name="nameServ"/>';
                    $displayForm .= '            <button type="submit" name="rowRemove" class="cal btn remove">&#x2613;</button>';
                    $displayForm .= '            <button type="submit" name="rowEdit" class="cal btn edit" onclick="editFunction()">&#x270E;</button>';
                    $displayForm .= '          </div>';
                    $displayForm .= '</form>';
                }

                $displayForm .= '        </div>';
            }
        
        }
        
        $displayForm .= '      </div>';
        $displayForm .= '<script type="text/JavaScript"> 
                            var element =  document.getElementById("day_selected");
                            if (typeof(element) == "undefined" || element == null) document.getElementById("month").id = "day_selected";
                            function editFunction() { window.location.href ='. route('editData') .';}
                        </script>';

        return view('calendar', ['displayForm' => $displayForm]);
    }

    
}
