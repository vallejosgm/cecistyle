<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Mail\laravelEmail;
use App\Mail\adminLaravelEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

class EmailController extends Controller
{
    public function index(Request $request) 
    {
        $sendMailData = [
            'fullname' => $request->input('fullname'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'dHidden' => $request->input('dHidden'),
            'hHidden' => $request->input('hHidden'),
            'idsHidden' => $request->input('idsHidden'),
            'sHidden' => $request->input('sHidden'),
            'comments' => $request->input('comments'),
            'nsHidden' => $request->input('nsHidden')
        ];

        try {
            Mail::to('info@cecistyle.org')->send(new laravelEmail($sendMailData));
            Mail::to('castillocecian@gmail.com')->send(new adminLaravelEmail($sendMailData));
            $emailSent = 'El customer y administrador recibieron un email de confirmation';
        } catch (\Exception $e) {
            $emailSent = 'false';
        }

        if ($sendMailData['sHidden'] == "60") {
            $he = date('H:i', strtotime($sendMailData['hHidden']. ' +60 minutes'));
          } else {
            $he = date('H:i', strtotime($sendMailData['hHidden']. ' +30 minutes'));
          }

        try {
            DB::insert("INSERT INTO apps_no_sign (date_appo, hour_start_appo, hour_end_appo, email, phone,
                fullname, message, id_serv)VALUES (?,?,?,?,?,?,?,?)", [$sendMailData['dHidden'],
            $sendMailData['hHidden'], $he, $sendMailData['email'], $sendMailData['phone'], $sendMailData['fullname'],
            $sendMailData['comments'], $sendMailData['idsHidden']]);
    
            $confirmationMessage = 'Se guardó el appointment en la base de datos';
        } catch (\Exception $e) {
            $confirmationMessage = 'false';
        }
        return view('confirmationBooking')->with(['mailData' => $sendMailData, 
        'confirmationMessage' => $confirmationMessage, 'emailSent' => $emailSent]);
    }
}
