import $ from 'jquery'

var path=window.location.pathname;

$(document).ready(function(){
    // Chemin vers le modal
    if(path == '/Decaissement/Modal'){

        // Le bouton validation est vide
        $('.btn').hide();

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
                        $('.btn').show();
                    }
                }
            });

        });
    }

    // Chemin vers le decaissement
    if( path == '/decaissement/credit/crud/new/individuel'){
        $('#decaissement_idepargne').on('change',function(){
            var idepargne=$('#decaissement_idepargne').val();

            // Recuperation du chemin qui contient les infos
            var url_id='/Epargne/Decaissement/Individuel/'+idepargne;

            $.ajax({
                url:url_id,
                method:'GET',
                dataType:"json",
                contentType:"application/json; charset=utf-8",
                data : JSON.stringify(idepargne),   
                success : function(compteerpagne){
                    for(let j=0;j<compteerpagne.length;j++){    
                        var compte=compteerpagne[j];
                        console.log('Bonjour');
                        console.log(compte);

                        $('#decaissement_NumeroCompteEpargne').val(compte.codeepargne);
                    }
                }
            });

        });
    }

});