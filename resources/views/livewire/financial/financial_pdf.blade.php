
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
        border-radius: 5px;

    }
    th,td{
        text-align:left;
        padding: 8px;
        border: 1px solid #cccccc;
    }

</style>

<body>
    <h1>Resumo Financeiro Connect</h1>
    <div>
        <table>
            <thead>
                <tr>
                    <td><b>Natureza</b></td>
                    <td><b>Valor</b></td>
                    <td><b>Data</b></td>
                    <td><b>Empresa</b></td>
                </tr>
            </thead>
            <tbody>
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
                        <td class=>{{'R$' .number_format($financial->value, 2,',', '.')}}</td>

                        <td class=>{{$nome_empresa}}</td>

                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</body>
</html>

