import $ from 'jquery'

var path = window.location.pathname;
$(document).ready(function(){
    // L'evenememnt se  produit a l'interieur de cette chemin
    if( path === '/configuration/credit/new'){

        // Avant les deux champs sont hide()
        $('#configuration_credit_TauxGarantieMaterielle').hide();
        $('#configuration_credit_TauxGarantieFinanciere').hide();

        // Penalite
        $('#anticipe').hide();
        $('#pourcentage').hide();

        
        // Si l'utilisateur coche sur garantie materielle 
        $('#configuration_credit_GarantieMaterielle').on('click',function(){
            var garantie=$('#configuration_credit_GarantieMaterielle').val();
            // console.log(garantie);
            // Le champ taux garantie materielle apparaisse
            if(garantie == 1){
                $('#configuration_credit_TauxGarantieMaterielle').show();
            }
           else if(garantie == 0)
            {
                $('#configuration_credit_TauxGarantieMaterielle').hide();
            }
        });

        // Si l'utilisateur coche sur garantie financiere 
        $('#configuration_credit_GarantieFinanciere').on('click',function(){
            
            // Le champ taux garantie financiere apparaisse
        $('#configuration_credit_TauxGarantieMaterielle').hide();
        $('#configuration_credit_TauxGarantieFinanciere').hide();
        
        $('#configuration_credit_GarantieMaterielle').on('click',function(){
            $('#configuration_credit_TauxGarantieMaterielle').show();
        });

        $('#configuration_credit_GarantieFinanciere').on('click',function(){
            $('#configuration_credit_TauxGarantieFinanciere').show();
        });
    });

        // Penalite
            // Choix penalite capital
            $('#configuration_credit_PenaliteAnticipe').on('change',function(){
                $('#anticipe').show();
            });
            $('#configuration_credit_PenalitePourcentage').on('change',function(){
                $('#pourcentage').show();
            });
            
            
    
    }
});
