import $ from 'jquery'

$(document).ready(() =>{
    /***************************************************Rapport client ************************** */
    /********************************************************************************** */
    $("#trier_rapport_client_search_one_date").on('change',function(){
                        
        $('#two_date').hide();
    });

    $("#trier_rapport_client_date1").on('change',function(){
        $('#one_date').hide(); 
    });
    
    $("#trier_rapport_client_date2").on('change',function(){
        $('#one_date').hide(); 
    });

    /******************************************************************Rapport Groupe**************************** */
    /************************************************************************************************************** */
    $("#filtre_rapport_groupe_one_date_search").on('change',function(){
                        
        $('#two_date').hide();
    });

    $("#filtre_rapport_groupe_Date1").on('change',function(){
        $('#one_date').hide(); 
    });
    
    $("#filtre_rapport_groupe_Date2").on('change',function(){
        $('#one_date').hide(); 
    });

    

    /******************************************************************Rapport Membre du Groupe**************************** */
    /************************************************************************************************************** */

    $("#filtre_rapport_membre_search_on_date").on('change',function(){
                            
        $('#two_date').hide();
    });

    $("#filtre_rapport_membre_Du").on('change',function(){
        $('#one_date').hide(); 
    });
    
    $("#filtre_rapport_membre_Au").on('change',function(){
        $('#one_date').hide(); 
    });


    /******************************************************************Rapport Document identite**************************** */
    /************************************************************************************************************** */


    $('#filtre_rapport_document_identite_one_date_search').on('change',function(){
        $('#two_date').hide();
    });

    $('#filtre_rapport_document_identite_Date1').on('change',function(){
        $('#one_date').hide();
    });
    $('#filtre_rapport_document_identite_Date2').on('change',function(){
        $('#one_date').hide();
    });

})