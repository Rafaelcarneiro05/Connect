<?php

namespace App\Http\Controllers;

use App\Models\Recorrentes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CalendarController extends Controller
{
    public function index()
    {
        $events = Recorrentes::select('id','descricao as title','data as start', 'value', 'color')->get();

        return  json_encode($events);

    }

}
