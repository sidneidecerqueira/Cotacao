<!DOCTYPE html>
<html>
<head>
<title>Laravel - Cotação</title> 
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<link rel="stylesheet" href="{{ asset('css/style.css')}}">
<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
<script src="{{ asset('js/lib/maskinput/Inputmask-5.x/dist/jquery.inputmask.js')}}"></script>
<script src="{{ asset('js/scripts.js')}}"></script> 
</head>
<body>
<div class="container mt-5">
<div class="card">
<div class="card-header">
Laravel - Cotação
</div>
<div class="card-body">
<form id="currency-exchange-rate" action="#" method="post" class="form-group">
<div class="row mb-3">
<div class="col-md-2">
<label> 
<select name="from_currency" id="from_currency" class="form-control">
<option value=''>--</option>    
<option value='EUR'>EUR</option>
<option value='USD'>USD</option>
</select>
</label> 
<p class="label_input">Moeda</p>
</div>    
<div class="col-md-3">
<label>    
<input type="text" name="valor" id="valor" class="form-control">
</label>
<p class="label_input">À partir de R$900,00 até R$899.999,00</p> 
</div>

<div class="col-md-7">
<label>    
<select name="forma_pgto" id="forma_pgto" class="form-control">
<option value=''>--</option>
<option value='1'>Boleto</option>
<option value='2'>Cartão de crédito</option>
</select>
</label> 
<p  class="label_input">Forma de pagamento</p>
</div>
</div> 
<div class="row">
    <div class="col-md-4">
    <input type="button" name="submit" id="btnSubmit" class="btn btn-primary " value="Clique para fazer a conversão">
</div>
</div>
</form> 
<div class="row" id="res_currency">
</div>  
</div>
  
<div class="card-footer">

 
</div>
</div>
</div>
</body>
</html>