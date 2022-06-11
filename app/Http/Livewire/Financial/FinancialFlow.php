<?php

namespace App\Http\Livewire\Financial;

use App\Models\Financial;
use Livewire\Component;

use function Ramsey\Uuid\v1;

class FinancialFlow extends Component
{

    public $cashflow = 'entrada';
    public $saida = 'despesas';
    public $descricao;
    public $valor;
    public $moeda = 'brl';
    public $fonte;
    public $observacao;
    public $data;
    public $cotacaoEmBRL;
    public $taxa;
    public $fracao;


    public function entrada()
    {
        if ($this->cashflow == 'entrada') {
        }
    }

    public function saida()
    {
        if ($this->cashflow == 'saida') {
            $this->validate([
                'descricao' => 'string'
            ]);
        }
    }


    //VALIDAÇÃO MODEDAS 

    public function store()

    {



        //converte valor do formato 15.120,00 para 15120.00

        $valor_tratado = str_replace('.', '', $this->valor);
        $valor_tratado = str_replace(',', '.', $valor_tratado);



        Financial::create([
            'cashflow' => $this->cashflow,
            'value' => $valor_tratado,
            'saida' => $this->saida,
            'descricao' => $this->descricao,
            'data' => $this->data,
            'moeda' => $this->moeda,
            'observacao' => $this->observacao,
            'fonte' => $this->fonte,
            'cotacaoEmBRL' => $this->cotacaoEmBRL,
            'taxa' => $this->taxa,
            'fracao' => $this->fracao,

        ]);


        $this->emit(event: 'save');
    }



    public function render()
    {


        //faz requisição HTTP get à Tatum API, na carteira Wallet-Xpud, solicitando um endereço na Blockchain , considerando a tatum_seed
        //faz requisição HTTP get à Tatum API, na carteira Wallet-Xpud, solicitando um endereço na Blockchain , considerando a tatum_seed

        $HttpClient = new \GuzzleHttp\Client(['verify' => false]);






        //SOLICITA COTACAO BITCOIN/BRL neste momento À COINMARKETCAP
        //SOLICITA COTACAO BITCOIN/BRL neste momento À COINMARKETCAP

        //consulta configurações do COINMARKETCAP
        $coinmarketcap_settings = CoinmarketcapConfiguracoes::first();

        try {

            $returned__ = $HttpClient->get('https://pro-api.coinmarketcap.com/v1/cryptocurrency/quotes/latest?symbol=BTC&convert=BRL', [
                'headers' => [
                    'X-CMC_PRO_API_KEY' => $coinmarketcap_settings->api_key
                ]
            ]);

            $cotacao_BTC_BRL = $returned__->getBody();
            $cotacao_BTC_BRLTratado = json_decode((string) $cotacao_BTC_BRL);

            $cotacao_BTC_BRL__ = $cotacao_BTC_BRLTratado->data->BTC->quote->BRL->price; //double


        } catch (\Exception $e) {

            //trata erro ao conectar-se à API COINMARKETCAP

            //retorna  à view, fala que o serviço está indisponível e pede para tentar em alguns instantes
            return redirect()->route('site.forma.de.pagamento')->withErrors([
                'api_tatum_indisponivel_ou_credenciais_invalidas' => trans('site.api_tatum_indisponivel_ou_credenciais_invalidas')
            ]);
        }


        return view('livewire.financial.financial-flow');
    }
}
