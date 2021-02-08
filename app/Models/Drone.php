<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Drone extends Model
{
    use HasFactory;

    protected $table = "drone";

    protected $fillable = [
        'image',
        'name',
        'address',
        'battery',
        'max_speed',
        'average_speed',
        'status',
    ];
}
