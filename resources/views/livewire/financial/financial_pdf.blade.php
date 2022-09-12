
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Resumo Financeiro Connenct</title>
</head>

<style>
    table{
        border-collapse: collapse;
        widows: 100%;
        border-radius: 4px;

    }
    th,td{
        font-size: 10.5px;
        text-align:left;
        padding: 6px;
        border: 1px solid #cccccc;
    }

    .container {
        font-size: 10px;
        position: absolute;
        width: 100px;
        height: 100px;

        right: -25px;
}
</style>

<body>
    @php

        $from = session()->get('financial_brief_from_explodido_pdf');

        $to = session()->get('financial_brief_to_explodido_pdf');

        $cashflow = session()->get('financial_brief_cash_flow_pdf');

        $balanco_entr = session()->get('financial_brief_cbalanco_entr_pdf');

        $balanco_saida = session()->get('financial_brief_balanco_saida_pdf');

        $balanco_taxa = session()->get('financial_brief_balanco_taxa_pdf');

        $soma = session()->get('financial_brief_soma_pdf');

        $soma_usdt = session()->get('financial_brief_soma_usdt_pdf');

        $soma_euro = session()->get('financial_brief_soma_euro_pdf');

        $soma_btc = session()->get('financial_brief_soma_btc_pdf');

        $soma_bnb = session()->get('financial_brief_soma_bnb_pdf');



    @endphp
    <h1>Resumo Financeiro Connect</h1>
    <br>
    @if ($cashflow)
        <h2>Fluxo de {{$cashflow}}</h2>
    @endif

    <hr>
    @if ($from)
        <h3>Períoodo Referente:&nbsp; {{$from}} a {{$to}}</h3>
    @endif
    <div>
        <table>
            <thead>
                <tr>
                    <th>Data</th>
                    <th>Natureza</th>
                    <th>Categoria</th>
                    <th>Descição</th>
                    <th>Fonte</th>
                    <th>Moeda</th>
                    <th>Cotação</th>
                    <th>Fração</th>
                    <th>Taxa</th>
                    <th>Observação</th>
                    <th>Empresa</th>
                    <th>Valor</th>

                </tr>
            </thead>
            <tbody>

                @php
                   $financials_retorno = session()->get('financial_brief_financials_retorno_pdf');
                @endphp

                @foreach ($financials_retorno as $financial)
                @php

                    $nome_empresa = '';
                        if(!is_null($financial->empresas_id)){
                            $empresa_to = DB::table('empresas')->where('id', '=', $financial->empresas_id)->first();
                            $nome_empresa = $empresa_to->name;
                        }
                @endphp
                    <tr>
                        <td class=>{{date('d/m/Y',strtotime($financial->data))}}</td>
                        <td class=>{{$financial->cashflow}} </td>
                        <td class=>{{$financial->saida}} </td>
                        <td class=>{{$financial->descricao}} </td>
                        <td class=>{{$financial->fonte}} </td>
                        <td class=>{{$financial->moeda}} </td>
                        <td class=>{{$financial->cotacaoEmBRL}} </td>
                        <td class=>{{$financial->fracao}} </td>
                        <td class=>{{$financial->taxa}} </td>
                        <td class=>{{$financial->observacao}} </td>
                        <td class=>{{$nome_empresa}}</td>
                        <td class=>{{'R$' .number_format($financial->value, 2,',', '.')}}</td>

                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="container">
            <div>
                Entrada: {{'R$: ' .number_format($balanco_entr, 2,',', '.')}}
            </div>
            <div>
                Saída: {{'R$: ' .number_format($balanco_saida, 2,',', '.')}}
            </div>
            <div>
                Taxas: {{'R$: ' .number_format($balanco_taxa, 2,',', '.')}}
            </div>

            <div>
                @php
                if ( empty($cashflow) ) {
                    echo 'Final: R$: '.number_format($soma, 2,',', '.'),
                    "<br>", "Final: USDT: " .number_format($soma_usdt, 8,',', '.'),
                    "<br>", 'Final: EURO: ' .number_format($soma_euro, 8,',', '.'),
                    "<br>", 'Final: BTC: ' .number_format($soma_btc, 8,',', '.'),
                    "<br>", 'Final: BNB: ' .number_format($soma_bnb, 8,',', '.');


                }
                @endphp
            </div>



        </div>


    </div>
</body>
</html>

