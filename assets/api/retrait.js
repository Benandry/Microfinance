import { Button } from 'bootstrap';
import $ from 'jquery'
const path = window.location.pathname

$(document).ready(() =>{
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