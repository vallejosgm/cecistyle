<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_serv'.
        'name_serv',
        'description_serv',
        'duration_minutes_serv',
        'priority_serv' 
    ];
}
