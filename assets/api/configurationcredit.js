import $ from 'jquery'

var path = window.location.pathname;
$(document).ready(function(){
    // L'evenememnt se  produit a l'interieur de cette chemin
    if( path === '/configuration/credit/new'){

        $('#configuration_credit_TauxGarantieMaterielle').hide();
        $('#configuration_credit_TauxGarantieFinanciere').hide();
        
        $('#configuration_credit_GarantieMaterielle').on('click',function(){
            $('#configuration_credit_TauxGarantieMaterielle').show();
        });

        $('#configuration_credit_GarantieFinanciere').on('click',function(){
            $('#configuration_credit_TauxGarantieFinanciere').show();
        });
        
    }
})