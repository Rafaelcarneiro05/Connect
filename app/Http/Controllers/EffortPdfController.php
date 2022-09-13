<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Carbon;
use App\Models\Efforts;
use App\Models\User;

class EffortPdfController extends Controller
{
    public static function horasDiarias($id)//calcula as horas de cada esforço
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

    public static function isEdited($id)//verifica se o ponto foi editado
    {
        $efforts = Efforts::where([['id', '=', $id]])->first();
        $fim = Carbon::createFromFormat('Y-m-d H:i:s', $efforts->fim);
        if ($efforts->updated_at != $fim)
            {
                return "*";
            }
    }

    public function exportPDF($id_user, $from, $to)
    {
        //tratamento da data
        $data = array(date('d/m/Y',strtotime($from)), date('d/m/Y',strtotime($to)));
        $datas = implode(' a ', $data);
        
        $from = Carbon::create($from);
        $to = Carbon::create($to)->addDays(1);

        //calcula os segundos trabalahdos
        $efforts = Efforts::where([['usuario_id', '=', $id_user], ['inicio', '>=', $from], ['fim', '<', $to]])->orderBy('id', 'desc')->get();
        $total_segundos = 0;
        foreach ($efforts as $effort)//soma dos segundos
        {
            $inicio = Carbon::createFromFormat('Y-m-d H:i:s', $effort->inicio);
            $final = Carbon::createFromFormat('Y-m-d H:i:s', $effort->fim);
            $segundos = $final->diffInSeconds($inicio);
            $total_segundos += $segundos;
        }
        //conversão segunds to hours
        $total_horas[0] = str_pad(intval($total_segundos / 3600) , 2 , '0' , STR_PAD_LEFT);
        $total_horas[1] = str_pad(intval(($total_segundos - ($total_horas[0] * 3600)) / 60) , 2 , '0' , STR_PAD_LEFT);
        $total_horas[2] = str_pad(intval($total_segundos % 60) , 2 , '0' , STR_PAD_LEFT);
        $horas = implode(':',  $total_horas);  
   
        $user = User::where([['id', '=', $id_user]])->get();
        $usuario = DB::table('users')->where([['id', '=', $id_user]])->first();
        $pdf = PDF::loadView('livewire.people.effort_pdf', ['efforts' => $efforts, 'user' => $user, 'horas' => $horas, 'datas' => $datas]);
        return $pdf->stream('folha-ponto - ' . $usuario->name . '.pdf');//stram para abrir o pdf na pagina
    }
}
