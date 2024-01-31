<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApptsNoSign extends Model
{
    use HasFactory;

    protected $fillable = [
        'date_appo',
        'hour_start_appo',
        'hour_end_appo',
        'email',
        'phone',
        'fullName',
        'message',
        'id_serv',
    ];
}