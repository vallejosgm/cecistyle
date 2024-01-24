<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Mail\laravelEmail;
use App\Mail\adminLaravelEmail;
use Illuminate\Support\Facades\Mail;

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
        Mail::to('info@cecistyle.org')->send(new laravelEmail($sendMailData));
        Mail::to('castillocecian@gmail.com')->send(new adminLaravelEmail($sendMailData));
        
        return view('mail.email-laravel')->with('mailData', $sendMailData);
    }
}
