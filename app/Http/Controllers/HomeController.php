<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function __invoke()
    {
        $medias = DB::select('SELECT src FROM settings WHERE name="home_video";');
        $video = $medias[0]->src;
        
        $servicesList = DB::select('SELECT id_serv, name_serv, duration_minutes_serv FROM services ORDER BY priority_serv;');
        
        $data = [
            'video' => $video,
            'services' => $servicesList,
        ];
        
        return view('index', $data);    
    }
}
