<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cotacao extends Model
{
    use HasFactory;

    const BASE_URL = 'https://economia.awesomeapi.com.br';

    /**
     * Método responsável por consultar a cotação atual das moedas
     * @param string $moedaA
     * @param string $moedaB
     * @return array
     */
    public function consultarCotacao($moedaA)
    {
        
        $moedas_cota = $moedaA.'-BRL';

        return $this->get('/last/'.$moedas_cota);
    }


    public function get($resource)
    {

        $endpoint = self::BASE_URL.$resource;

        //INICIA O CURL
        $curl = curl_init();

        //CONFIGURAÇÕES DO CURL
        curl_setopt_array($curl,[
            CURLOPT_URL => $endpoint,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST=> 'GET'
        ]);

        //RESPONSE
        $response = curl_exec($curl);

        //FECHA A CONEXÃO DO CURL
        curl_close($curl);

        //RETORNA O RESULTADO EM ARRAY
        return json_decode($response, true);
    }



}
