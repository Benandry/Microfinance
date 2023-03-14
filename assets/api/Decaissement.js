import $ from 'jquery'

var path=window.location.pathname;

$(document).ready(function(){
    if(path == '/Decaissement/Modal'){
        $('#decaissement_individuel_modal_Client').on('change',function(){
            // Recuperer l'id client 
            var idclient=$('#decaissement_individuel_modal_Client').val();

            // Chemin qui recupere les donnees json
            var url_modaldecaissement='/DecaissementCredit/Modal/individuel/'+idclient;

            $.ajax({
                url:url_modaldecaissement,
                method:'GET',
                dataType:"json",
                contentType:"application/json; charset=utf-8",
                data : JSON.stringify(idclient),   
                success : function(individuel){
                    for(let j=0;j<individuel.length;j++){    
                        var infoindividuel=individuel[j];
                        $('#decaissement_individuel_modal_nomclient').val(infoindividuel.nom_client);
                        $('#decaissement_individuel_modal_prenomclient').val(infoindividuel.prenom_client);
                        $('#decaissement_individuel_modal_numerocredit').val(infoindividuel.NumeroCredit);
                        $('#decaissement_individuel_modal_montantcredit').val(infoindividuel.Montant);
                    }
                }
            });

        });
    }
});