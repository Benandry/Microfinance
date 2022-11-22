import $ from 'jquery'

var path = window.location.pathname

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



        var montant_bruit_ = 0
        var commission=0
        var papeterie =0

        $('#transaction_montant_bruite').on('keyup',(e)=>{
            montant_bruit_=e.target.value;
        //    alert(montant_bruit_);
        })

        $('#transaction_commission').val(0)
        $('#transaction_commission').on('change',(e)=>{
            commission=e.target.value;
            // alert(commission);
        })

        $('#transaction_papeterie').val(0)
        $('#transaction_papeterie').on('change',(e) =>{
            papeterie = e.target.value
            montant_total = parseInt(montant_bruit_) -(parseInt(commission) + parseInt(papeterie))

            $('#transaction_Montant').val(montant_total)
        })
        //Ajouter valeur sur la formulaire solde


    }

    if(path === '/CompteEpargneDepot'){
        alert("Bonjour nareo ee")
    }
})