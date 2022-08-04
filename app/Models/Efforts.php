<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Efforts extends Model
{
    use HasFactory;
    public $table = 'efforts';
    protected $guarded = [];
    public $timestamps = true;
}
