<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Financial extends Model
{
    public $table = 'financials';
    public $timestamps = true;
    use HasFactory;


    protected $guarded = [];

}
