<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BookingControlller extends Controller
{
    public function create(Request $request){
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
        return view('/homeBooking', $data);
    }

    public function setHours(Request $request){
        $dateSelected = $request->input('date-selected');
        $boxHourValue = $request->input('box-hour-value');
        $idServiceSelected = $request->input('id-service-selected');
        $serviceSelected = $request->input('service-selected');
        $nameSelected = $request->input('name-selected');
        return view('/hoursBooking', ['dateSelected' => $dateSelected, 'boxHourValue' => $boxHourValue, 'idServiceSelected' => $idServiceSelected, 'serviceSelected' => $serviceSelected, 'nameSelected' => $nameSelected]);
    }
}