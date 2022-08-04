<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Recorrentes extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $table = 'recorrente';
    public $timestamps = true;



    protected $guarded = [];
}
