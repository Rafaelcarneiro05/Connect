<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Empresas extends Model
{
    use HasFactory;
    use SoftDeletes;
    public $table = 'empresas';
    public $timestamps = true;



    protected $guarded = [];


}
