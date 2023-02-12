import $ from 'jquery'
//import 'jquery-modal'

var path = window.location.pathname;

$(document).ready(() =>{

    if (path === '/transaction/new') {
        
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



        var montant_bruit_ = 0
        var commission= 0
        var papeterie = 0

        $('#transaction_montant_bruite').on('keyup',()=>{
            montant_bruit_= $('#transaction_montant_bruite').val();
           // alert(": I010000015")
            console.log(montant_bruit_);

            papeterie = $('#transaction_papeterie').val()
            var montant_total = parseInt(montant_bruit_) -(parseInt(commission) + parseInt(papeterie))

                //lert("mETY VEE")
            $('#transaction_Montant').val(montant_total)
            
            //Ajouter valeur sur la formulaire solde
            var solde = montant_total + parseInt($('#solde_cli').text())

            $('#transaction_solde').val(solde)
        })

        $('#transaction_commission').val(0)
        $('#transaction_commission').on('change',()=>{
            commission=$('#transaction_commission').val();
            // alert(commission);
        })

        $('#transaction_papeterie').val(0)
        


    }
    // epargne groupe : ici on recupere toute les informations 
    // concernant le groupe

    if( path === '/transaction/depotgroupe' ){
        var codegroupe = $('#code_client').text()
        var nomgroupe = $('#nom').text()
        var solde = $('#solde_cli').text()
        
        // alert(codegroupe+' '+ nomgroupe+' '+solde)

        $('#transaction_nom').val('nom')

        $('#transaction_prenom').val('nom')

        $('#transaction_typeClient').val('GROUPE')

        $('#transaction_Description').val('DEPOT')

        $('#transaction_codeepargneclient').val(codegroupe)

        // $('#transaction_prenom').val(nom)

        var solde = $('#solde_cli').text()
        $('#transaction_donneessolde').val(solde)
        $('#transaction_nomgroupe').val(nomgroupe)



        var montant_bruit_ = 0
        var commission= 0
        var papeterie = 0

        $('#transaction_montant_bruite').on('keyup',()=>{
            // alert('bonsoir')
            montant_bruit_= $('#transaction_montant_bruite').val();
           // alert(": I010000015")
            console.log(montant_bruit_);

            papeterie = $('#transaction_papeterie').val()
            var montant_total = parseInt(montant_bruit_) -(parseInt(commission) + parseInt(papeterie))

                // alert("mETY VEE")
            $('#transaction_Montant').val(montant_total)
            
            //Ajouter valeur sur la formulaire solde
            var soldegroupe = montant_total + parseInt($('#solde_cli').text())

            $('#transaction_solde').val(soldegroupe)
        })

        $('#transaction_commission').val(0)
        $('#transaction_commission').on('change',()=>{
            commission=$('#transaction_commission').val();
            // alert(commission);000000000
        })

        $('#transaction_papeterie').val(0)
        

    }

})