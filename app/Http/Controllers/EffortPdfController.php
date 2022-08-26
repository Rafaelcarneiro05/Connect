<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Carbon;
use App\Models\Efforts;
use App\Models\User;
use App\Http\Livewire\People\EffortAdmin;


use Session;


class EffortPdfController extends Controller
{
    /*public function index()
    {
        $efforts = Efforts::orderBy('id', 'desc')->get();
        return view('livewire.people.effort_pdf', compact('efforts'));
    }*/

    public static function horasDiarias($id)
    { 
        $esforco = DB::table('efforts')->where([['id', '=', $id]])->first();
        $inicio = Carbon::createFromFormat('Y-m-d H:i:s', $esforco->inicio);
        if($esforco->fim == NULL)
        {
            $final = Carbon::now()->setTimezone('America/Sao_Paulo');
            $final = Carbon::createFromFormat('Y-m-d H:i:s', $final);
        }
        else
        {
            $final = Carbon::createFromFormat('Y-m-d H:i:s', $esforco->fim);
        }
        $segundos = $final->diffInSeconds($inicio);
        return gmdate("H:i:s", $segundos);
    }

    public static function acumuladorSegundos($user_id)
    {
        $esforco = DB::table('efforts')->where([['usuario_id', '=', $user_id]])->get();
         
    }
    

    public function exportPDF($id_user, $from, $to)
    {
        $from = Carbon::create($from);
        $to = Carbon::create($to)->addDays(1);
        
        $efforts = Efforts::where([['usuario_id', '=', $id_user], ['inicio', '>=', $from], ['fim', '<', $to]])->orderBy('id', 'desc')->get();
        $total_segundos = 0;        
        $user = User::where([['id', '=', $id_user]])->get();
        $pdf = PDF::loadView('livewire.people.effort_pdf', ['efforts' => $efforts, 'user' => $user]);
        return $pdf->stream('folha-ponto' . rand(1, 1000) . '.pdf');

    }
}
