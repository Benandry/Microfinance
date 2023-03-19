import $ from 'jquery'

const path=window.location.pathname;

$(document).ready(function(){
    if( path == '/Approbation/Modal/')
    {   
        $('#approbation_modal_CodeCredit').on('change',function(){
            // Recuperation de l'id credit taper par l'utilisateur
            var codecredit=$('#approbation_modal_CodeCredit').val();
            // console.log(codecredit);

            var url_approbation='/Approbation/ModalApprobation/Credit/'+codecredit;

            $.ajax({
                url:url_approbation,
                method:'GET',
                dataType:"json",
                contentType:"application/json; charset=utf-8",
                data : JSON.stringify(codecredit),   
                success : function(content){
                    for(let i=0;i<content.length;i++){
                        var approbation=content[i];
                        // console.log(approbation);
                        $('#approbation_modal_NumeroCredit').val(approbation.NumeroCredit);
                        $('#approbation_modal_Cycle').val(approbation.cycles);
                        $('#approbation_modal_NombreTranche').val(approbation.NombreTranche);
                        $('#approbation_modal_TauxInteretAnnuel').val(approbation.TauxInteretAnnuel);
                        $('#approbation_modal_TypeTranche').val(approbation.TypeTranche);
                        $('#approbation_modal_Montant').val(approbation.Montant);
                        $('#approbation_modal_CodeClient').val(approbation.codeclient);
                        $('#approbation_modal_NomClient').val(approbation.nom_client);
                        $('#approbation_modal_PrenomClient').val(approbation.prenom_client);
                    }
                }
            });
        });
    }
});