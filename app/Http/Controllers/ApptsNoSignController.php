<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ApptsNoSign;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ApptsNoSignController extends Controller
{
    public function create()
    {
        $servicesList = DB::select('SELECT id_serv, name_serv, duration_minutes_serv FROM services ORDER BY priority_serv;');    
        $data = [
            'services' => $servicesList,
        ];
        return view('apptCreate', $data);
    }

    public function setHours(Request $request)
    {
        $bday = $request->input('bday');
        $bdate = Carbon::parse($request->input('bday'))->format('l, d F Y'); 
        $id_service = $request->input('id_service');
        $service = $request->input('service');
        $nameService = $request->input('nameService');

        $hours_available = DB::select('SELECT hour_start_appo, hour_end_appo, duration_minutes_serv FROM apps_no_sign, services WHERE (apps_no_sign.id_serv=services.id_serv) AND (date_appo = ? );', [$bday]);

        $data = [
            'bday' => $bday,
            'bdate' => $bdate,
            'id_service' => $id_service,
            'service' => $service,
            'nameService' => $nameService,
            'hours_available' => $hours_available,
        ];
        return view('/apptSetHour', $data); 
    }

    public function confirmData(Request $request)
    {
        $boxHourValues = $request->input('box-hour-value');
        $idSerSelected = $request->input('id-service-selected');
        $serviceSelected = $request->input('service-selected');
        $dateSelected = $request->input('date-selected');
        $nameSelected = $request->input('name-selected');
        
        $hours = array();
        $hourStart = array();
        $hourEnd = array();
        $i = 0;
        $j = 0;
        $k = 0;

        foreach ($boxHourValues as $bhv) {
            $hours[$i] = $bhv;
            $i++;
        }
        
        if($serviceSelected == "60") {
            $hourStart[0] = $hours[0];
            $hourEnd[0] = date('H:i', strtotime($hourStart[0]. ' +60 minutes'));
        } else {
            for ($i = 0; $i < sizeof($hours); $i++) {
                $hourStart[$k] = $hours[$i];
                $j = $i;
                while(array_search(date('H:i', strtotime($hours[$j]. ' +30 minutes')), $hours) !== false) $j++;
                $hourEnd[$k] = date('H:i', strtotime($hours[$j]. ' +30 minutes'));
                $i = $j;
                $k++;
            }
            
        }
            
        $data = [
            'hourStart' => $hourStart,
            'hourEnd' => $hourEnd,
            'idSerSelected' => $idSerSelected,
            'dateSelected' => $dateSelected,
            'nameSelected' => $nameSelected,
        ];
        
        $displayForm = $this->newAppointment($data);

        return view('/apptConfirm')->with('displayForm', $displayForm);
    }

    public function newAppointment($data) 
    {
        $showHours = '';
            
        for ($i = 0; $i < sizeof($data['hourStart']); $i++) 
            $showHours .= 'From '.$data['hourStart'][$i].' To '.$data['hourEnd'][$i].'<br>';

        $email = '';
        $phone = '';
        $name = '';
        $message = '';
        
            
        if ($data['idSerSelected'] == 10) {
            $email = 'castillocecian@gmail.com';
            $phone = '3852262473';
            $name = 'Cecilia';
            $message = 'By Admin';
        }

        $displayForm = "";
        $displayForm .= '<form action='. route('saveAppts') .' method="POST" class="tblAppt">'.csrf_field();
        $displayForm .= ' <div class="column">';
        $displayForm .= '   <div class="column-flex">';
        $displayForm .= '     <h2 class="title" style="margin-top: 0;">Create Appointment</h2>';
        $displayForm .= '   </div>';
        $displayForm .= '   <div class="column-flex">';
        $displayForm .= '     <label for="dateAppt">Date of Appointment</label>';
        $displayForm .= '      <div class="cal-time" name="dateAppt">'.$data['dateSelected'].'</div>';
        $displayForm .= '      <input type="hidden" value="'.$data['dateSelected'].'" name="bday"/>';
        $displayForm .= '   </div>';
        $displayForm .= '   <div class="column-flex">';
        $displayForm .= '     <label for="dateAppt">Hours Detail</label>';
        $displayForm .= '     <div class="cal-time" name="dateAppt">'.$showHours.'</div>';
        for ($i = 0; $i < sizeof($data['hourStart']); $i++) {
            $displayForm .= '      <input type="hidden" value="'.$data['hourStart'][$i].'" name="hoursStartAppt[]"/>';
            $displayForm .= '      <input type="hidden" value="'.$data['hourEnd'][$i].'" name="hoursEndAppt[]"/>';
        }
        $displayForm .= '   </div>';
        $displayForm .= '   <div class="column-flex">';
        $displayForm .= '     <label for="emailAppt">Email</label>';
        $displayForm .= '     <input type="text" value="'.$email.'" name="emailAppt"/>';
        $displayForm .= '   </div>';
        $displayForm .= '   <div class="column-flex">';
        $displayForm .= '     <label for="phoneAppt">Phone Number*</label>';
        $displayForm .= '     <input type="text" value="'.$phone.'" name="phoneAppt"/>';
        $displayForm .= '   </div>';
        $displayForm .= '   <div class="column-flex">';
        $displayForm .= '     <label for="nameAppt">Full Name*</label>';
        $displayForm .= '     <input type="text" value="'.$name.'" name="nameAppt"/>';
        $displayForm .= '   </div>';
        $displayForm .= '   <div class="column-flex">';
        $displayForm .= '     <label for="messageAppt">Message</label>';
        $displayForm .= '     <input type="text" value="'.$message.'" name="messageAppt"/>';
        $displayForm .= '   </div>';
        $displayForm .= '   <div class="column-flex">';
        $displayForm .= '     <label for="idService">Service</label>';
        $displayForm .= '      <div class="cal-time" name="nameService">'.$data['nameSelected'].'</div>';
        $displayForm .= '      <input type="hidden" value="'.$data['idSerSelected'].'" name="idService"/>';
        $displayForm .= '   </div>';
        $displayForm .= '   <div class="column-flex btnSave">';
        $displayForm .= '     <input type="submit" value="Save New" name="sendNew"  class="saveBtn"/>';
        $displayForm .= '   </div>';
        $displayForm .= ' </div>';
        $displayForm .= '</form>';


        return $displayForm;
    }

    public function saveAppts(Request $request)
    {
        $bday = $request->input('bday');
        $hoursStartAppt = $request->input('hoursStartAppt');
        $hoursEndAppt = $request->input('hoursEndAppt');
        $emailAppt = $request->input('emailAppt');
        $phoneAppt = $request->input('phoneAppt');
        $nameAppt = $request->input('nameAppt');
        $messageAppt = $request->input('messageAppt');
        $idService = $request->input('idService');

        DB::beginTransaction();

        try {
            for ($i = 0; $i < sizeof($hoursStartAppt); $i++)
                DB::insert("INSERT INTO apps_no_sign (date_appo, hour_start_appo, hour_end_appo, email, phone,
                fullname, message, id_serv)VALUES (?,?,?,?,?,?,?,?)", [$bday, $hoursStartAppt[$i], $hoursEndAppt[$i], 
                $emailAppt, $phoneAppt, $nameAppt, $messageAppt, $idService]);

            DB::commit(); // Confirma las transacciones si no hubo excepciones
            $confirmationMessage = 'Se guardó el appointment en la base de datos';
        } catch (\Exception $e) {
            DB::rollback(); // Deshace las transacciones en caso de error
            $confirmationMessage = 'false';
            dd($e->getMessage());
        }
        
        return redirect()->route('calendar')->with([
            'confirmationMessage' => $confirmationMessage,
        ]);

    }

    public function confirmRemove(Request $request) {
        $id = $request->input('rowID');
        $d = $request->input('dateAppt');
        $hs = $request->input('hs');
        $he = $request->input('he');
        $e = $request->input('email');
        $p = $request->input('phone');
        $fn = $request->input('fn');
        $m = $request->input('mess');
        $ns = $request->input('nameServ');

        $displayForm = "";
        $displayForm .= '<form action='. route('removeAppts') .' method="POST" class="tblAppt">'.csrf_field();
        $displayForm .= ' <div class="column">';
        $displayForm .= '   <div class="column-flex">';
        $displayForm .= '     <h2 class="title" style="margin-top: 0;">Delete of Appointment</h2>';
        $displayForm .= '   </div>';
        $displayForm .= '   <div class="column-flex">';
        $displayForm .= '     <label for="dateAppt">Date of Appointment</label>';
        $displayForm .= '     <input class="field" type="text" value='.$d.'  name="dateAppt" readonly/>';
        $displayForm .= '   </div>';
        $displayForm .= '   <div class="column-flex">';
        $displayForm .= '     <label  for="hoursStartAppt">Hour Start</label>';
        $displayForm .= '     <input class="field" type="text" value='.$hs.' name="hoursStartAppt" readonly/>';
        $displayForm .= '   </div>';
        $displayForm .= '   <div class="column-flex">';
        $displayForm .= '     <label  for="hourEndAppt">Hour End</label>';
        $displayForm .= '     <input class="field" type="text" value='.$he.' name="hourEndAppt" readonly/>';
        $displayForm .= '   </div>';
        $displayForm .= '   <div class="column-flex">';
        $displayForm .= '     <label  for="emailAppt">Email</label>';
        $displayForm .= '     <input class="field" type="text" value='.$e.' name="emailAppt" readonly/>';
        $displayForm .= '   </div>';
        $displayForm .= '   <div class="column-flex">';
        $displayForm .= '     <label for="phoneAppt">Phone Number</label>';
        $displayForm .= '     <input class="field" type="text" value='.$p.' name="phoneAppt" readonly/>';
        $displayForm .= '   </div>';
        $displayForm .= ' </div>';
        $displayForm .= ' <div class="column">';
        $displayForm .= '   <div class="column-flex">';
        $displayForm .= '     <label for="nameAppt">Full Name</label>';
        $displayForm .= '     <input class="field" type="text" value='.$fn.' name="nameAppt" readonly/>';
        $displayForm .= '   </div>';
        $displayForm .= '   <div class="column-flex">';
        $displayForm .= '     <label for="messageAppt">Message</label>';
        $displayForm .= '     <input class="field" type="text" value="'.$m.'" name="messageAppt" readonly/>';
        $displayForm .= '   </div>';
        $displayForm .= '   <div class="column-flex">';
        $displayForm .= '     <label for="idService">Service</label>';
        $displayForm .= '     <input type="text" value='.$ns.' name="serviceAppt" readonly/>';
        $displayForm .= '   </div>';
        $displayForm .= '   <div class="column" btnSave style="display: inline-grid; justify-content: center;">';
        $displayForm .= '     <span>Do you want delete this record?</span>';
        $displayForm .= '     <input type="submit" value="Yes" name="sendDelete"/>';
        $displayForm .= '   </div>';
        $displayForm .= '     <input type="hidden" value='.$id.' name="idAppt"/>';
        $displayForm .= '</form>';

        
        return view('removeAppts')->with([
            'displayForm' => $displayForm,
        ]); 
    }

    public function removeAppts(Request $request) {
        $id = $request->input('idAppt');

        DB::beginTransaction();
        
        try {
            DB::delete('DELETE FROM apps_no_sign WHERE id_appo = ?', [$id]);
            DB::commit(); // Confirma las transacciones si no hubo excepciones
            $confirmationMessage = 'Se eliminó el appointment en la base de datos';
        } catch (\Exception $e) {
            DB::rollback(); // Deshace las transacciones en caso de error
            $confirmationMessage = 'false';
            dd($e->getMessage());
        }
        
        return redirect()->route('calendar')->with([
            'confirmationMessage' => $confirmationMessage,
        ]);    
    }


}
