import { Button } from 'bootstrap';
import $ from 'jquery'
const path = window.location.pathname

$(document).ready(() =>{

    // individuel

    if( path === '/transaction/retrait/individuel' ){
        $('#form_code').on('keyup',()=>{
            var codeepargneclient= $('#form_code').val();

            console.log(codeepargneclient);

            if(codeepargneclient.length == 15){
                const url_api = '/info/'+codeepargneclient;
            $.ajax({
                url: url_api,
                method: "GET",
                dataType : "json",
                contentType: "application/json; charset=utf-8",
                data : JSON.stringify(codeepargneclient),
                success: function(result){
                    for(let i= 0 ; i < result.length ;i++){
                        var element = result[i];
                        console.log(element);

                        $('#form_code_client').val(element.code)
                        $('#form_produit').val(element.nomproduit)
                        $('#form_nom').val(element.nom_client)
                        $('#form_prenom').val(element.prenom_client)

                        document.getElementById('code_ep').innerHTML =element.code;
                        document.getElementById('code_cli').innerHTML =element.client_code;
                        document.getElementById('produit').innerHTML =element.nomproduit;
                        document.getElementById('nom_cli').innerHTML =element.nom_client;
                        document.getElementById('prenom_cli').innerHTML =element.prenom_client;

                        // $('#form_nom').val(element.nomGroupe)
                        // $('#nom_groupe').val(element.nomGroupe)
                        // document.getElementById('nom_groupe').innerHTML=element.nomGroupe;
                    }
                    
                },
                error: function (request, status, error) {
                    console.log(request.responseText);
                }
                
            })    
        }
        })
    }

    if( path === '/transaction/individuel' ){

        var codeepargnegroupe=$('#code_epargne_client').text();

        $('#transactionretrait_codeepargneclient').val(codeepargnegroupe)

        $('#transactionretrait_typeClient').val('INDIVIDUEL')

        $('#transactionretrait_commission').val(0)
        $('#transactionretrait_papeterie').val(0)

        $('#transactionretrait_solde').hide();

        var solde=document.getElementById('solde_cli').innerHTML;
        console.log(solde)

        $('#transactionretrait_Montant').on('keyup',()=>{
            var montant=$('#transactionretrait_Montant').val();

            var soldeactuel =solde - montant

            console.log(soldeactuel);

            $('#transactionretrait_montant_bruite').val(montant);

            if(soldeactuel < 0){
                alert('Solde epuisé')
                $('.btn').hide()
            }else{
                $('#transactionretrait_solde').val(soldeactuel)
                $('.btn').show()
            }
        })

    }

    // groupe

    if( path === '/transaction/retrait/groupe' ){
        $('#form_code').on('keyup',() =>{
            var codegroupe=$('#form_code').val()
            console.log(codegroupe)
            if(codegroupe.length == 15){
                const url_api = '/info/'+codegroupe;
            $.ajax({
                url: url_api,
                method: "GET",
                dataType : "json",
                contentType: "application/json; charset=utf-8",
                data : JSON.stringify(codegroupe),
                success: function(result){
                    for(let i= 0 ; i < result.length ;i++){
                        var element = result[i];
                        console.log(element);

                        $('#form_nom').val(element.nomGroupe)
                        document.getElementById('nom_groupe').innerHTML=element.nomGroupe;
                    }
                    
                },
                error: function (request, status, error) {
                    console.log(request.responseText);
                }
                
            })    
        }
        });

    }

    if (path === '/transaction/retrait') {

        var codeepargnegroupe=$('#code_epargne_groupe').text();

        $('#transactionretrait_codeepargneclient').val(codeepargnegroupe)

        $('#transactionretrait_commission').val(0)
        $('#transactionretrait_papeterie').val(0)

        var solde=document.getElementById('solde_cli').innerHTML;

        $('#transactionretrait_Montant').on('keyup',()=>{
            var montant=$('#transactionretrait_Montant').val();

            var soldeactuel=solde-montant

            $('#transactionretrait_montant_bruite').val(montant);
            if(soldeactuel < 0){
                alert('Solde epuisé')
                $('.btn').hide()
            }else{
                $('#transactionretrait_solde').val(soldeactuel)
                $('.btn').show()
            }
        })    
    }
  
})