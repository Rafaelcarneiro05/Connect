<?php

namespace App\Http\Controllers;

use App\Http\Livewire\People\EffortAdmin as PeopleEffortAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Carbon;
use App\Models\Efforts;
use App\Http\Livewire\People\EffortAdmin;


class EffortPdfController extends Controller
{
    static $colab;

    public static function folhaPonto($id)
    {
        self::$colab = $id;
        dd(self::$colab);
        redirect()->route("effort_pdf");
    }
    public function colab()
    {
        dd(self::$colab);
        return self::$colab;
    }

    public function index()
    {
        //$colab = self::$colab;
        //dd($colab);
        $efforts = Efforts::orderBy('id', 'desc')->get();
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

    public function exportPDF()
    {
        $colab2 = self::colab();
        //redirect()->route("effort_pdf");
        $efforts = Efforts::where([['usuario_id', '=', $colab2]])->orderBy('id', 'desc')->get();
        $pdf = PDF::loadView('livewire.people.effort_pdf', ['efforts' => $efforts]);
        return $pdf->download('folha-ponto' . rand(1, 1000) . '.pdf');

    }
}
