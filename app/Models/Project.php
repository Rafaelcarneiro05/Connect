<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    public $table = 'projects';
    public $timestamps = true;
    

    protected $guarded = [];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
