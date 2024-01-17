<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class BookingControlller extends Controller
{
    public function create(Request $request){
        $bday = $request->input('bday');
        $bdate = Carbon::parse($request->input('bday'))->format('l, d F Y'); 
        $id_service = $request->input('id_service');
        $service = $request->input('service');
        $nameService = $request->input('nameService');
        return view('/homeBooking', ['bday' => $bday, 'bdate' => $bdate, 'id_service' => $id_service, 'service' => $service, 'nameService' => $nameService]);
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