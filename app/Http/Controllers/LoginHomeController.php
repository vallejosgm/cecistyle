<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginHomeController extends Controller
{
    public function index() {
        return view('loginHome');
    }
}
