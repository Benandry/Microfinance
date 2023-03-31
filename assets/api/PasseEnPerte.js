import $ from 'jquery';

const path=window.location.pathname;

$(document).ready(function(){
    if( path =='/Passe/En/Perte/'){
        $('.btn').hide();
        $('#passe_en_perte_modal_NumeroCredit').on('change',function(){

            // Recuperer le numero credit
            var idcredit=$('#passe_en_perte_modal_NumeroCredit').val();

            // URL
            var url_perte='/Perte/Credit/'+idcredit;

            // Ajax
            $.ajax({
                url:url_perte,
                method:'GET',
                dataType:"json",
                contentType:"application/json; charset=utf-8",
                data:JSON.stringify(idcredit),
                success:function(content){
                    for(let j=0;j<content.length;j++){
                        var perte=content[j];
                        console.log(perte);
                        $('#passe_en_perte_modal_CodeCredit').val(perte.NumeroCredit);
                        $('#passe_en_perte_modal_CodeClient').val(perte.codeclient);
                        $('#passe_en_perte_modal_NomClient').val(perte.nom_client);
                        $('#passe_en_perte_modal_PrenomClient').val(perte.prenom_client);
                        $('.btn').show();
                    }
                }   
                
            });

        });
    }
    if( path == '/Perte/Credit/'){

        // Recuperer le code credit
        var CodeCredit=document.getElementById('codecredit').innerHTML;

        // Afficher sur la formulaire
        $('#passe_en_perte_NumeroCredit').val(CodeCredit);

        // $('#passe_en_perte_NumeroCredit').hide();

        // $('#passe_en_perte_PasseEnPerte').on('click',function(){
        //     var boutonpasseenperte=$('#passe_en_perte_PasseEnPerte').val();
        //     if( boutonpasseenperte == 1 ){
        //         $('#passe_en_perte_NumeroCredit').show();
        //     }else{
        //         $('#passe_en_perte_NumeroCredit').hide();
        //     }
        // });
    }
});