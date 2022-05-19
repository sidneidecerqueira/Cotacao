
$(document).ready(function () {
   
    $.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $("#btnSubmit").click(function (event) {
    
    if($("#from_currency").val()!='EUR' && $("#from_currency").val()!='USD' ) 
    {
        alert("Informe a moeda de destino!");
        $("#from_currency").focus();
        return false;
    }
    
    if($("#forma_pgto").val()!=1 && $("#forma_pgto").val()!=2 ) 
    {
        alert("Informe a forma de pagamento!");
        $("#forma_pgto").focus();
        return false;
    }   
       
    event.preventDefault();
    var form = $('#currency-exchange-rate')[0];
    var data = new FormData(form);
    $("#btnSubmit").prop("disabled", true);
    $.ajax({
    type: "POST",
    url: "/currency",
    data: data,
    processData: false,
    contentType: false,
    cache: false,
    timeout: 800000,
    success: function (data) {        
    $("#res_currency").html(data);
    $("#btnSubmit").prop("disabled", false);
    },
    error: function (e) {
    $("#res_currency").html(e.responseText);
    console.log("ERROR : ", e);
    $("#btnSubmit").prop("disabled", false);
    }
    });
    });

    /********máscara money */
    $("#valor").inputmask( 'currency',{"autoUnmask": true,
            radixPoint:",",
            groupSeparator: ".",
            allowMinus: false,
            prefix: 'R$ ',            
            digits: 2,
            digitsOptional: false,
            rightAlign: true,
            unmaskAsNumber: true
    });
   
    });