<?php

namespace App\Http\Controllers;

use App\Models\Empresas;
use App\Models\Financial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\App;

class FinancialPDFController extends Controller
{

    public function index()
    {
        $financials_retorno = Financial::orderBy('data')->get();
        return view('livewire.financial.financial_pdf', compact('financials_retorno'));
    }
    public function exportPDF()
    {

        $financials_retorno = Financial::orderBy('data')->get();
        $pdf = PDF::loadView('livewire.financial.financial_pdf', ['financials_retorno' => $financials_retorno]);
        return $pdf->download('resumo_financeiro' . rand(1, 1000) . '.pdf');

    }
}
