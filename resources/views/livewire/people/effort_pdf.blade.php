
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Folha de Ponto Connenct</title>
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

    <table>
        <thead>
            <tr>
                <td><b>
                    <label>CNN BLACK LTDA </label><br>
                    <label>Praça do Rosario, 1, Centro, Viçosa</label><br>
                    <label>41.455.500/0001-03</label> <br>                    
                </b></td>

                <td>
                    @foreach ($user as $user)
                        <label>Colaborador: {{$user->name}}</label><br>
                        <label>CPF: {{$user->cpf}}</label><br>
                        <label>Data de Admissão: {{$user->admission_date}}</label><br>
                    @endforeach                    
                </td>
            </tr>
        </thead>
    </table><br><br>

    <table>
        <thead>
            <tr>
                <td><b>Dia</b></td>
                <td><b>Inicio</b></td>
                <td><b>Fim</b></td>
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
                    {{App\Http\Controllers\EffortPdfController::acumuladorSegundos($effort->id)}}
                </tr>
            @endforeach
            <tr>
                <td></td>
                <td></td>
                <td>Total de Horas:</td>
                <td>180h</td>
            </tr>
        </tbody>
    </table>
</body>
</html>

