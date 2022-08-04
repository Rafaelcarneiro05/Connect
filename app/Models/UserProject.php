<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProject extends Model
{
    use HasFactory;
    public $table = 'users_projects';
    protected $guarded = [];
    public $timestamps = true;
    protected $primaryKey = 'project_id';






}
