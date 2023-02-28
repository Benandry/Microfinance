import $ from 'jquery'
//import 'jquery-modal'

var path = window.location.pathname;

$(document).ready(() =>{

    if (path === '/transaction/depot') {
        var montant_bruit_ = 0;
        const id_produit = $('#produit-id').text();
        //PRoduit epargne configuration sur depot
        const api_produit = '/api/compte-epargne/individuel/'+id_produit;
        // console.log(api_produit);
        $.ajax({
            url : api_produit,
            method : "GET",
            dataType : "json",
            contentType: "application/json; charset=utf-8",
            data : JSON.stringify($(this).val()),
            success : (result) =>  {
                for(let i = 0; i < result.length; i++){
                    var element = result[i];
                    console.log(element);
                    // $('#transaction_commission').val(element.commission_de_transaction);
                    // $('#transaction_devise').val(element.devise);
                    $('#transaction_devise').val(element.devise);
                    $('.devise-solde').text(element.devise);
                }
            },
            error: function (request, status, error) {
                console.log(request.responseText);
            }
        });



        var code_client = $('#code_client').text()
        $('#transaction_codeepargneclient').val(code_client)

        var nom = $('#nom').text()
        $('#transaction_nom').val(nom)

        var nom = $('#prenom').text()
        $('#transaction_prenom').val(nom)

        var solde = $('#solde_cli').text()
        $('#transaction_donneessolde').val(solde)

        $('#transaction_typeClient').val('INDIVIDUEL')

        $('#transaction_Description').val('DEPOT')



        // $('#transaction_commission').on('change',()=>{
        //     commission=$('#transaction_commission').val();
        // })

        $('#transaction_montant_bruite').on('keyup',()=>{
            montant_bruit_= $('#transaction_montant_bruite').val();

            // var montant_total = parseInt(montant_bruit_) -parseInt($('#transaction_commission').val());

            $('#transaction_Montant').val(montant_bruit_)
            
            //Ajouter valeur sur la formulaire solde
            var solde = parseFloat(montant_bruit_ )+ parseFloat($('#solde_cli').text())

            $('#transaction_solde').val(solde)
        })
    }
    // epargne groupe : ici on recupere toute les informations 
    // concernant le groupe

    if( path === '/transaction/depotgroupe' ){

        var solde_ouverture = 0;
        const id_produit = $('#produit-id').text();
        //PRoduit epargne configuration sur depot
        const api_produit = '/api/compte-epargne/individuel/'+id_produit;
        // alert(api_produit);
        $.ajax({
            url : api_produit,
            method : "GET",
            dataType : "json",
            contentType: "application/json; charset=utf-8",
            data : JSON.stringify($(this).val()),
            success : (result) =>  {
                for(let i = 0; i < result.length; i++){
                    var element = result[i];
                    solde_ouverture = element.solde_ouverture;
                    // $('#transaction_commission').val(element.commission_de_transaction);
                    $('#transaction_devise').val(element.devise);
                    $('.devise-solde').text(element.devise);
                    
                // alert(solde_ouverture);
                }
            },
            error: function (request, status, error) {
                console.log(request.responseText);
            }
        });
        var codegroupe = $('#code_client').text();
        var nomgroupe = $('#nom').text();
        var solde = $('#solde_cli').text();

        $('#transaction_typeClient').val('GROUPE');
        $('#transaction_Description').val('DEPOT');

        $('#transaction_codeepargneclient').val(codegroupe);

        var solde = $('#solde_cli').text()
        $('#transaction_donneessolde').val(solde)
        $('#transaction_nomgroupe').val(nomgroupe)

        $('#transaction_montant_bruite').on('keyup',()=>{
            var montant_bruit_= $('#transaction_montant_bruite').val();

            // var montant_total = parseInt(montant_bruit_) - parseInt( $('#transaction_commission').val())

            $('#transaction_Montant').val(montant_bruit_)
            
            //Ajouter valeur sur la formulaire solde
            var soldegroupe = parseFloat(montant_bruit_) + parseFloat($('#solde_cli').text())

            $('#transaction_solde').val(soldegroupe)
        })
    }
})