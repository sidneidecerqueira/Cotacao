<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cotacao;

class Currency extends Model
{
    use HasFactory;

    var $moeda_destino;
    var $pgto_cod;
    var $pgto_nome;
    var $tx_percent_a; //taxa tipo de pagamento
    var $tx_percent_b; //taxa valor de compra
    var $vlr_utilizado;
    var $vlr;
    var $cotacao;
    var $msg;
    var $data_cotacao;    

    function __construct($moeda_destino, $pgto_cod, $vlr_in)
    {
        $vlr =  $this->verifica_vlr($vlr_in);
       
        if($vlr)
        {
            $this->moeda_destino = $moeda_destino;
            $this->vlr = $vlr;
            $this->pgto_cod = $pgto_cod;
            $this->tx_percent_a = $this->tx_forma_pagto($pgto_cod,$vlr);
            $this->tx_percent_b = $this->tx_vlr_compra($vlr);
            $meio_pgto = $this->forma_pgto();
            $this->pgto_nome = $meio_pgto[$pgto_cod];
            /*
                busca valor da cotação passando a moeda, ex: USD, EUR
            */        
            $getCotacao = new Cotacao;
            $getdadosCotacao = $getCotacao->consultarCotacao($_POST['from_currency']);        
            $dados = $getdadosCotacao[$_POST['from_currency'].'BRL'] ?? [];
            $this->data_cotacao = $dados['create_date'];
            $this->cotacao = $dados['bid'];
        }      
    }

    function calc_currency_m()
    {
        $res = 0.00;        
        $tx_pagto = $this->tx_percent_a;
        $tx_vlr   = $this->tx_percent_b;
        $tx_aplicar = number_format($tx_pagto + $tx_vlr, 2, '.', '');
        $vlr_res = number_format($this->vlr - $tx_aplicar, 2, '.', '');
        $this->vlr_utilizado = $this->vlr - $tx_aplicar;
        $vlr_Cotacao = $vlr_res / $this->cotacao;        
        return $vlr_Cotacao;
    }

    private function tx_forma_pagto($forma_pagto,$vlr)
    {
        $tx[1]=1.37; // taxa boleto
        $tx[2]=7.73; // taxa cartão de crédito
        $vr = ($vlr * $tx[$forma_pagto]) / 100;
        $vr =  number_format($vr, 2, '.', '');
        return $vr;
    }
    
    private function tx_vlr_compra($vlr_compra)
    {
        $vlr_limite = 3700.01;
        $tx_c = 2; //% 
        
        if($vlr_compra > $vlr_limite)
        $tx_c = 1;

        $vr_a = ($vlr_compra * $tx_c) / 100;
        $vr_a =  number_format($vr_a, 2, '.', '');

        return $vr_a;
    }
    function forma_pgto()
    {
        $arr_pgto = array();
        $arr_pgto = array(
                            1 => 'Boleto',
                            2 => 'Cartão de Crédito'
                         );
        
        return $arr_pgto; 
    }

    function verifica_vlr($vlr)
    {
        $vlr_format = str_replace("R$ ","",str_replace(",",".",str_replace(".","",$vlr)));
        if($vlr_format >= 900 and $vlr_format <= 899999.00)
        {
            return $vlr_format;
        }
        else
        {
            $this->msg = " Valor inválido!";
            return false;
        }
    }
}
