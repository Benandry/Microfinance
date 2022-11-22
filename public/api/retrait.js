///Transaction retrait api////
$(document).ready(() =>{


    $('#transactionretrait_Montant').attr('disabled', 'disabled'); 

    $("#transactionretrait_codeepargneclient").on('keyup',(e) => {
        var numero = e.target.value;
        var url = "/api/transaction/"+numero;
        
        $.ajax({
            url: url,
            method: "GET",
            dataType : "json",
            contentType: "application/json; charset=utf-8",
            data : JSON.stringify(numero),
            success: function(result){
                for (let i = 0; i < result.length; i++) {
                
                    var element = result[i];
                    console.log(element);
                    document.getElementById('text').innerHTML = "<span id=\'Montant\'>"+parseInt(element.somme_solde)+"</span>";
                    document.getElementById('code').innerHTML = element.code;
                    document.getElementById('nom').innerHTML = element.nom+" "+element.prenom;
                    document.getElementById('solde').innerHTML = element.somme_solde;
                }
        
            },
            error: function (request, status, error) {
                console.log(request.responseText);
            }

        });    
    });

       ///****************Montant bruite et net*************** */
       var montant_bruit_ = 0
       var commission = 0
       var papeterie = 0
       $('#transactionretrait_montant_bruite').on('keyup',(e) =>{
           montant_bruit_ = parseInt(e.target.value);
       })

      $('#transactionretrait_commission').on('change',(e)=>{
          commission = parseInt(e.target.value)
      })

      $('#transactionretrait_papeterie').on('change',(e) =>{
          papeterie = parseInt(e.target.value)
          montant_total = montant_bruit_ -(commission + papeterie) 

          $('#transactionretrait_Montant').val(montant_total)  

          //Ajouter le valeur du solde

        var montantsolde = $('#Montant').text();

        var solde=parseInt(montantsolde)-parseInt(montant_total);
            $('#transactionretrait_solde').val(solde);
      })

      $(window).on('load',() =>{
            $('#myModal').modal('show')
       })


       //Suggestion sur less compte epargne depot
    const code_rechercher = document.getElementById('transactionretrait_codeepargneclient');

    const url_api = '/api/code-epargne'
    code_rechercher.addEventListener('keyup',()=>{
        const value_input = code_rechercher.value
        $.ajax({
            url: url_api,
            method: "GET",
            dataType : "json",
            contentType: "application/json; charset=utf-8",
            data : JSON.stringify(),
            success: function(result){

                const getValue = result.filter(i => i.code.toLocaleLowerCase().includes(value_input.toLocaleLowerCase()))
                console.log(getValue);
                var suggestion = ''

                if( value_input != '' ){
                    getValue.forEach(resultItem =>{
                    
                    suggestion += `<div class="suggestion">${resultItem.code}</div>`
                    })
                }else{
                    suggestion = '<div class="suggestion"> Pas de commune</div>'
                }
                
                document.getElementById('commune_suggest').innerHTML = suggestion
            
        
            },
            error: function (request, status, error) {
                console.log(request.responseText);
            }

        })    
    });    
})


    // type client :groupe ou individuel
    $(document).ready(function(){
        $('#transactionretrait_typeClient').on('change',function(){
            type=$(this).val()
            if(type == 'INDIVIDUEL'){
                // INDIVIDUEL
                $("#transactionretrait_codeepargneclient").on('keyup',(e) => {
                    var numero = e.target.value;
                    var url = "/api/transaction/"+numero;
                    
                    $.ajax({
                        url: url,
                        method: "GET",
                        dataType : "json",
                        contentType: "application/json; charset=utf-8",
                        data : JSON.stringify(numero),
                        success: function(result){
                            for (let i = 0; i < result.length; i++) {
                            
                                var element = result[i];
                                console.log(element);
                                document.getElementById('text').innerHTML = "<span id=\'Montant\'>"+parseInt(element.somme_solde)+"</span>";
                                document.getElementById('code').innerHTML = element.code;
                                document.getElementById('nom').innerHTML = element.nom+" "+element.prenom;
                                document.getElementById('solde').innerHTML = element.somme_solde;
                            }
                    
                        },
                        error: function (request, status, error) {
                            console.log(request.responseText);
                        }
            
                    });    
                });            

                // INDIVIDUEL
                
            }
            if(type == 'GROUPE'){
                // GROUPE
                $("#transactionretrait_codeepargneclient").on('keyup',(e) => {
                    var numero = e.target.value;
                    var url = "/api/transactiongroupe/"+numero;
                    
                    $.ajax({
                        url: url,
                        method: "GET",
                        dataType : "json",
                        contentType: "application/json; charset=utf-8",
                        data : JSON.stringify(numero),
                        success: function(result){
                            for (let i = 0; i < result.length; i++) {
                            
                                var element = result[i];
                                console.log(element);
                                document.getElementById('text').innerHTML = "<span id=\'Montant\'>"+parseInt(element.somme_solde)+"</span>";
                                document.getElementById('code').innerHTML = element.code;
                                document.getElementById('nom').innerHTML = element.nomgroupe;
                                document.getElementById('solde').innerHTML = element.somme_solde;
                            }
                    
                        },
                        error: function (request, status, error) {
                            console.log(request.responseText);
                        }
            
                    });    
                });            

                // GROUPE
            }
        });

    });
