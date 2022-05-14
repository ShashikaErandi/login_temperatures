<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Temperature extends Model
{
    use HasFactory;

    public $fillable = [
        'user_id',
        'logged_in_at',
        'city1_temperature',
        'city2_temperature'
    ];
}
