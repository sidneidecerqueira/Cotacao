<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use AshAllenDesign\LaravelExchangeRates\ExchangeRate;
use Guzzle\Http\Exception\ClientErrorResponseException;
use carbon\Carbon;
use App\Models\Currency;


class CurrencyController extends Controller
{
    public function index_ajx() {

       
        $new_curr = new Currency($_POST['from_currency'],$_POST['forma_pgto'],$_POST['valor']);
        if($new_curr->vlr)
        {
            $calc_compra = $new_curr->calc_currency_m();
        
            $out = view('qualityres', [
                                    'moeda_origem' => "BRL",
                                    'moeda_destino' => $_POST['from_currency'],
                                    'vlr_conversao' => $_POST['valor'],
                                        'forma_pgto' => $new_curr->pgto_nome,
                                'vlr_moeda_destino' => "$ ". $new_curr->cotacao,
                                    'vlr_comprado' => "$ ". $calc_compra,
                                        'tx_pagto' => "R$ ". number_format($new_curr->tx_percent_a, 2, ',', '.'),
                                    'tx_conversao' => "R$ ". number_format($new_curr->tx_percent_b, 2, ',', '.'),
                                    'vlr_utilizado' => "R$ ". number_format($new_curr->vlr_utilizado, 2, ',', '.')
                                    ]);
        }
        else
        {
            $out = $out = view('qualityres_error');
        }

        echo $out;
    } 
    
}
