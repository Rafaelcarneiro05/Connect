
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Folha de Ponto Connect</title>
</head>

<style>

@import url('https://fonts.googleapis.com/css2?family=Inter&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');
    * {
        
        padding: 0;
        box-sizing: border-box;
        text-decoration: none;
    }
    table{
        border-collapse: collapse;
        widows: 100%;
        border-radius: 5px;
        text-align: center;
        font-family: 'Roboto', sans-serif;
        font-size: 13px;

    }
    th,td{
        text-align:center;
        padding: 8px;
        border-bottom: solid;
    }
    header {
        margin: 5;
        align-items: center;
        font-family: 'Roboto', sans-serif;

    }
    h1 {
        font-size: 24px;
        text-align: left;
        font-style: bold;
        font-weight: 400;
        line-height: 29px;
        vertical-align: top;
        font-family: 'Roboto', sans-serif;
    }
    h2 {
        font-size: 14px;
        font-style: bold;
        text-align: left;
        line-height: 17px;
        font-weight: 700;
    }
    .endereco {
        font-size: 14px;
        text-align: left;
        line-height: 2px;
        font-weight: 400;
    }
    h6 {
        text-align: left;
        font-weight: 400;
        font-size: 14px;
        line-height: 1px;
    }
    body {
        font-size: 100%;
        font-family: 'Roboto', sans-serif;
    }
    .titulo {
        text-align: left;
        border-top-style: solid;
        background: #B9B5B5;
        font-weight: 400;
        font-size: 14px;
        line-height: 17px;
    }
    .dados {
        font-size: 14px;
        line-height: 10px;
    }
    .tipo {
        border-bottom-style: solid;
        line-height: 10px;
    }

    .total {
        background: #B9B5B5;
    }
    .assisnatura {
        text-align: center;
    }

</style>

<body>
    <header>
        <h1><strong>FOLHA DE PONTO</h1>
        <h2>CNN BLACK LTDA</h2>
        <p class="endereco">41.455.500/0001-03</p>
        <p class="endereco">Praça do Rosario, 1</p>
        <p class="endereco">Centro, Viçosa/MG</p>

    <main>
        
        <section class="dados">   
            <p class="titulo">DADOS DO COLABORADOR</p>
            @foreach ($user as $user)
                <p><strong>Colaborador: </strong> {{$user->name}}</p>
                @php
                    $teste = $user->name;
                @endphp
                <p><strong>CPF: </strong>{{$user->cpf}}</p>
                <p class="tipo"><strong>Tipo de Contrato: </strong>{{$user->tipo_contrato}}</p>
            @endforeach
            <br>
        </section> 
        
        
        <section>
            <table>
                <thead>
                    <tr>
                        <td><b>Inicio</b></td>
                        <td><b>Fim</b></td>
                        <td><b>Trabalhadas</b></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($efforts as $effort)
                        <tr>
                            <td class=>{{date('d/m/Y -  H:i:s',strtotime($effort->inicio))}}</td>
                            <td class=>
                                @if ($effort->fim == NULL)
                                    Em aberto...
                                @else
                                    {{date('d/m/Y - H:i:s',strtotime($effort->fim))}}
                                @endif
                            </td>
                            <td class=>{{App\Http\Controllers\EffortPdfController::horasDiarias($effort->id)}}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td class="total"></td>
                        <td class="total"><strong>Total de Horas:</strong> </td>
                        <td class="total"><strong>{{$horas}}</strong></td>
                    </tr>
                </tbody>
            </table>
        </section>
        <br><br>

        <section>
            <h6>Horas de {{$datas}}</h6>
        </section>

    </main>

    <footer>
        <br><br><br>
        <hr>
        <p class="assisnatura">{{$teste}}</p><br><br>
        <hr>
        <p class="assisnatura">CNN BLACK LTDA</p>
    </footer>

    
</body>
</html>

