import $ from 'jquery'

const path = window.location.pathname;

$(document).ready(function(){
   if(path == '/Modal/Fiche') {
        $('.btn').hide();
        $('#fiche_credit_modal_CodeCredit').on('change',function(){
            // Recuperation dans le champ
            var idcredit=$('#fiche_credit_modal_CodeCredit').val();
            
            // Chemin pour recuperer les donnees venant du json
            var url_modal_fiche='/Fiche/Credit/Modal/'+idcredit;
            // console.log(url_modal_fiche);

            $.ajax({
                url:url_modal_fiche,
                method:'GET',
                dataType:"json",
                contentType:"application/json; charset=utf-8",
                data : JSON.stringify(idcredit),
                success : function(content){
                    for(let j=0;j<content.length;j++){
                        var fiche=content[j];

                       $('#fiche_credit_modal_NumeroCredit').val(fiche.NumeroCredit);
                       $('#fiche_credit_modal_NomClient').val(fiche.nom_client);
                       $('#fiche_credit_modal_PrenomClient').val(fiche.prenom_client);
                       $('#fiche_credit_modal_Codecredit').val(fiche.codeclient);
                       $('.btn').show();
                    }
                }
            })
});
   }
});