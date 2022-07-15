<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recorrentes extends Model
{
    use HasFactory;

    public $table = 'recorrente';
    public $timestamps = true;



    protected $guarded = [];
}
