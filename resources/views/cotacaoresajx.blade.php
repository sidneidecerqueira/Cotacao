 
<div class="col-md-12 container-cotacao-res">
<h3>Dados da cotação</h3>     
<fieldset class="field_box">
<p>{{ \Carbon\Carbon::parse( $data_cotacao ?? '' )->format('d/m/Y H:i:s')}}</p>  
<p><b>Moeda de origem:</b> {{ $moeda_origem ?? '' }}</p>
<p><b>Moeda de Destino:</b> {{ $moeda_destino?? '' }}</p>
<p><b>Valo para conversão:</b> {{ $vlr_conversao ?? '' }}</p>
<p><b>Forma de pagamento:</b> {{ $forma_pgto ?? '' }}</p>
<p><b>Valor da "Moeda de destino" usada para conversão:</b> {{ $vlr_moeda_destino ?? '' }}</p>
<p><b>Valor comprado em "Moeda de destino":</b> {{ $vlr_comprado ?? '' }} (taxas aplicadas no valor de compra diminuindo no valor total de conversão)"</p>
<p><b>Taxa de pagamento:</b> {{ $tx_pagto ?? '' }}</p>
<p><b>Taxa de conversão:</b> {{ $tx_conversao ?? '' }}</p>
<p><b>Valor utilizado para conversão descontando as taxas:</b> {{ $vlr_utilizado ?? '' }}</p>
</fieldset>
</div>


