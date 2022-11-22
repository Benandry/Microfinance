// retrait

$(document).ready(function(){
        
    $("#transactionretrait_codeepargneclient").on('keyup',function(){

        var url = "/api/transaction/"+$(this).val();

        console.log(url);
        $.ajax({
            url: url,
            method: "GET",
            dataType : "json",
            contentType: "application/json; charset=utf-8",
            data : JSON.stringify($(this).val()),
            success: function(result){
                for (let i = 0; i < result.length; i++) {
                   
                    var element = result[i];
                    console.log(element);
                        document.getElementById('text').innerHTML = "<span id=\'Montant\'>"+parseInt(element.somme_solde)+"</span>";
                }
        
            },
            error: function (request, status, error) {
                console.log(request.responseText);
            }

        });    
    });

    $('#transactionretrait_Montant').on('keyup',function(){
        var Montant=$(this).val();

     var montantsolde = $('#Montant').text();

         var solde=parseInt(montantsolde)-parseInt(Montant);
             $('#transactionretrait_solde').val(solde);

    });
    
});