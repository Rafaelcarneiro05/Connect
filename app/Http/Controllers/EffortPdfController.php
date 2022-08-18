<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Carbon;
use App\Models\Efforts;


class EffortPdfController extends Controller
{
    public function index()
    {
        $efforts = Efforts::orderBy('id', 'desc')->get();
        //dd($efforts);
        return view('livewire.people.effort_pdf', compact('efforts'));
    }

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

    public static function teste()
    {
        dd("daleeee");
    }

    public function exportPDF()
    {

        $efforts = Efforts::orderBy('id', 'desc')->get();
        $pdf = PDF::loadView('livewire.people.effort_pdf', ['efforts' => $efforts]);
        return $pdf->stream('folha-ponto' . rand(1, 1000) . '.pdf');

    }
}
