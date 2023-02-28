import { Button } from 'bootstrap';
import $ from 'jquery'
const path = window.location.pathname

$(document).ready(() =>{
    if( path === '/transaction/retrait' ){

        
        const id_produit = $('#produit-id').text();
        //PRoduit epargne configuration sur depot
        const api_produit = '/api/compte-epargne/individuel/'+id_produit;
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
                    $('#transactionretrait_devise').val(element.devise);
                    $('.devise-solde').text(element.devise);
                }
            },
            error: function (request, status, error) {
                console.log(request.responseText);
            }
        });
        const modal_container = document.getElementById('modal-container');
        const close_btn = document.querySelector('#close-btn');
        close_btn.addEventListener('click',() => {
            modal_container.style.display = "none";
        });
        const modal_text = document.getElementById('modal-text');

        
        window.addEventListener('click',e => {
            if (e.target === modal_container) {
                modal_container.style.display = "none";
            }
        })

        var codeepargnegroupe=$('#code_epargne_client').text();

        $('#transactionretrait_codeepargneclient').val(codeepargnegroupe)

        $('#transactionretrait_typeClient').val('INDIVIDUEL')

        $('#transactionretrait_solde').hide();

        var solde=document.getElementById('solde_cli').innerHTML;
        console.log(solde)

        $('#transactionretrait_Montant').on('keyup',()=>{
            var montant=$('#transactionretrait_Montant').val();

            var soldeactuel =solde - montant

            console.log(soldeactuel);

            $('#transactionretrait_montant_bruite').val(montant);

            if(soldeactuel < 0){
                modal_container.style.display = "block";
                modal_text.textContent = "Solde epuisé";
                $('.btn').hide();
            }else{
                $('#transactionretrait_solde').val(soldeactuel)
                $('.btn').show()
            }
        })

    }
})