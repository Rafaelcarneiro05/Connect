
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Folha de Ponto Connect</title>
</head>

<style>
    * {
        margin: 5;
        padding: 0;
        box-sizing: border-box;
        text-decoration: none;
    }
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

    header {
        display: flex;
        flex-direction: column;
        align-items: center;
        color: #cccccc;
    }
    .teste {
    }
    body {
        font-size: 100%;
    }


    
</style>

<body>
    <header>
        <h1><strong>Folha de Ponto</strong></h1>
        <label class="teste">CNN BLACK LTDA</label>
        <label>41.455.500/0001-03</label>
        <label>Praça do Rosario, 1</label>
        <label>Centro, Viçosa/MG</label>
        <h6>{{$datas}}</h6>
    </header>  

    <main>
        <h2>DADOS DO COLABORADOR</h2>
        @foreach ($user as $user)
            <label>Colaborador: {{$user->name}}</label>
            @php
                $teste = $user->name;
            @endphp
            <label>CPF: {{$user->cpf}}</label>
            <label>Tipo de Contrato: {{$user->tipo_contrato}}</label>
        @endforeach
        
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
                    </tr>
                @endforeach
                <tr>
                    <td></td>
                    <td></td>
                    <td><strong>Total de Horas:</strong> </td>
                    <td><strong>{{$horas}}</strong></td>
                </tr>
            </tbody>
        </table>
    </main>

    <footer>
        <br><label>______________________________________________</label><br>
            <label>{{$teste}}</label><br><br>
        <label>______________________________________________</label><br>
        <label>CNN BLACK LTDA</label>
    </footer>

    
</body>
</html>

