
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
    <h1>Folha de Ponto</h1>
    <label>CNN BLACK LTDA </label><br>
    <label>41455500000103</label> <br>
    <label>PRACA DO ROSARIO, 1, CENTRO, Viçosa</label><br>
    

    <div>
        <table>
            <thead>
                <tr>
                    <td><b>Dia</b></td>
                    <td><b>inicio</b></td>
                    <td><b>fim</b></td>
                    <td><b>Trabalhadas</b></td>
                </tr>
            </thead>
            <tbody>
                @foreach ($efforts as $effort)
                    <tr>
                        <td class=>{{date('d/m/Y',strtotime($effort->inicio))}}</td>
                        <td class=>{{date('H:i:s',strtotime($effort->inicio))}}</td>
                        <td class=>
                            @if ($effort->fim == NULL)
                                Em aberto...
                            @else
                                {{date('H:i:s',strtotime($effort->fim))}}
                            @endif
                        </td>
                        <td class=>{{App\Http\Controllers\EffortPdfController::horasDiarias($effort->id)}}</td>

                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</body>
</html>

