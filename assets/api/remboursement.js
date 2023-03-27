import $ from 'jquery'

const path = window.location.pathname;

$(document).ready(function(){

    /**
     * La route /modal/remboursement est pour le modal remboursement
     */
    if( path == '/modal/remboursement' ){  
            $('#remboursement_modal_codecredit').hide();
            $('.btn').hide();
            /**
             * Recuperation des informations groupe ou individuel
             */
            $('#remboursement_modal_typeclient').on('change',function(){
                var typeclient=$('#remboursement_modal_typeclient').val();
                console.log('Bonjour a vous');
                // Une fois le client choisir sur type
                    $('#remboursement_modal_codecredit').show();                

                $('#remboursement_modal_codecredit').on('change',function(){

                    var numerocredit=$('#remboursement_modal_codecredit').val();
                    
                    console.log(numerocredit);

                    if(typeclient == 'INDIVIDUEL'){
                        var url_individuel="/modalindividuel/"+numerocredit;
                        $.ajax({
                            url:url_individuel,
                            method:'GET',
                            dataType:"json",
                            contentType:"application/json; charset=utf-8",
                            data : JSON.stringify(numerocredit),
                            success : function(content){
                                for(let j=0;j<content.length;j++){
                                    var individuel=content[j];
    
                                    // console.log(individuel);
                                    var nomclient=individuel.nom_client;
                                    var prenomclient=individuel.prenom_client;
    
                                    document.getElementById('nom').innerHTML=nomclient+" "+prenomclient;
    
                                }
                            }
                        })      
                    }
                    else if(typeclient == 'GROUPE'){
                        var url_groupe="/groupemodal/"+numerocredit;
                        $.ajax({
                            url:url_groupe,
                            method:'GET',
                            dataType:"json",
                            contentType:"application/json; charset=utf-8",
                            data : JSON.stringify(numerocredit),
                            success : function(content){
                                for(let j=0;j<content.length;j++){
                                    var groupe=content[j];
                                    var nomgroupe=groupe.nomGroupe;
                                    console.log(groupe);
    
                                    document.getElementById('nom').innerHTML=nomgroupe;
                                          
                                }
                            }
                        })      
                    }
    
        
                    var url_modal='/remboursement/modal/'+numerocredit;
        
                        $.ajax({
                            url:url_modal,
                            method:'GET',
                            dataType:"json",
                            contentType:"application/json; charset=utf-8",
                            data : JSON.stringify(numerocredit),
                            success : function(content){
                                // console.log('hello world')
                                for(let j=0;j<content.length;j++){
                                    var remboursementmodal=content[j];
                                    console.log(remboursementmodal);
                                    
                                        var resetapayer=parseFloat(remboursementmodal.montanttTotal)-parseFloat(remboursementmodal.montantrembourseModal);
                                        // console.log(resetapayer);
                                        $('#remboursement_modal_numerocredit').val(remboursementmodal.codecredit);
                                        $('#remboursement_modal_penaliteprecedent').val(remboursementmodal.penaliteremboursementModal);
                                        $('#remboursement_modal_montantprecedent').val(remboursementmodal.montantrembourseModal);
                                        if(remboursementmodal.montantrembourseModal == null){
                                            $('#remboursement_modal_restemontant').val(0);
                                        }else{
                                            $('#remboursement_modal_restemontant').val(resetapayer);
                                        }
                                        // consoletypeof(remboursementmodal.montanttTotal);
                                        if(remboursementmodal.penaliteremboursementModal != null){
                                            $('#remboursement_modal_montantdu').val(parseFloat(remboursementmodal.montanttTotal)+parseFloat(remboursementmodal.penaliteremboursementModal)+parseFloat(resetapayer));
                                        }
                                        // $('#remboursement_modal_montantdu').val(parseFloat(remboursementmodal.montanttTotal));
        
                                        if(remboursementmodal.perioderemboursementModal == null){
                                            // console.log(0);
                                            $('#remboursement_modal_periode').val(0);
                                        }
                                        else{
                                            console.log(remboursementmodal.perioderemboursementModal);
                                            $('#remboursement_modal_periode').val(remboursementmodal.perioderemboursementModal);
                                        }
                                        $('#remboursement_modal_capital').val(remboursementmodal.principale);
                                        $('#remboursement_modal_interet').val(remboursementmodal.interet);
                                        $('.btn').show();
                                        
                                        
                                }
                            }
                        }) 
        
                /**
                 * Recuperation des somme des valeurs
                **/
                    var url_somme="/sommeremboursement/somme/"+numerocredit;
                    $.ajax({
                        url:url_somme,
                        method:'GET',
                        dataType:"json",
                        contentType:"application/json; charset=utf-8",
                        data : JSON.stringify(numerocredit),
                        success : function(content){
                            for(let j=0;j<content.length;j++){
                                var sommecredit=content[j];
                                $('#remboursement_modal_crd').val(sommecredit.crd);
                                $('#remboursement_modal_TotalRembourser').val(sommecredit.TotalRembourser);
                                $('#remboursement_modal_TotalaRembourser').val(sommecredit.TotalARembourser);
                            }
                        }
                    })
                    
                })
        
        
            })

    }

    /**
     * la route /remboursement/credit/new est pour le remboursement
     */

    if( path == '/remboursement/credit/new'){
        // var reste= document.getElementById('reste').innerHTML;

        $('.btn').hide();
  
        // Date automatique

        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0');
        var yyy = today.getFullYear();


      
        today = mm + '/' + dd + '/' + yyy;
        today = yyy +'-' +mm + '-' + dd;

        today=yyy+'-'+mm+'-'+dd;
        $("#remboursement_credit_DateRemboursement").val(today);
      
        
        // Ici on va cacher en premier le formulaire caisse
        
        $('#caisse').hide();

        // On va afficher le numero credit du client individuel
        $('#remboursement_credit_TransactionEnLiquide').on('click',function(){
            var transactionliquide= $('#remboursement_credit_TransactionEnLiquide').val();
            if(transactionliquide == 1){
                $('#caisse').show();
            }
            else if(transactionliquide == 0){
                $('#caisse').hide();
            }
        });
        
        $('#remboursement_credit_MontantTotalPaye').on('blur',function(){

            
            // On recupere le montant a payer par le client
            var montant = $('#remboursement_credit_MontantTotalPaye').val();

            // console.log(montant);

            var codecredit=document.getElementById('codecreditremboursement').innerHTML;

            // console.log('code credit'+codecredit);
            
            $('#remboursement_credit_NumeroCredit').val(codecredit);
                var periode = $('#periodeprecedent').text();
                periode++;
                // url
                var url_api='/remboursement/periode/'+codecredit+'/'+periode;
                // console.log(url_api);

                $.ajax({
                    url:url_api,
                    method:'GET',
                    dataType:"json",
                    contentType:"application/json; charset=utf-8",
                    data : JSON.stringify(codecredit,periode),
                    success : function(content){
                        for(let j=0;j<content.length;j++){
                            var remboursement=content[j];
                            // console.log(remboursement);
                            document.getElementById('periode').innerHTML=remboursement.maxperiode;

                            // Si remboursement égal a null
                            // On recupere la periode dans ammortissement

                            if(remboursement.perioderemboursement == null)
                            {
                                $('#remboursement_credit_periode').val(remboursement.periode);

                                    var url_api_ammortissement='/remboursement/ammortissement/'+codecredit+'/'+periode;
                                    // console.log(url_api_ammortissement);                                

                                $.ajax({
                                    url:url_api_ammortissement,
                                    method:'GET',
                                    dataType:"json",
                                    contentType:"application/json; charset=utf-8",
                                    data : JSON.stringify(codecredit,periode),
                                    success : function(content){
                                        // console.log('hello world')
                                        for(let j=0;j<content.length;j++){
                                            var ammortissement=content[j];
                                            console.log(ammortissement);

                                            // On affiche le bouton
                                            $('.btn').show();

                                            // console.log("test"+ammortissement);
                                            $('#remboursement_credit_MontantEcheance').val(ammortissement.montanttTotal);

                                            // on met la periode 1
                                                $('#remboursement_credit_periode').val(periode)
                                                document.getElementById('periode').innerHTML=periode;

                                            // Si le montant n'est pas egal au montant exiger : penalite
                                                var montantexigerammortissement=ammortissement.montanttTotal;
                                                
                                                console.log(montantexigerammortissement);
                                                
                                                // Les 3 types de penalites
                                                // Anticipe
                                                var penalitecapital=(ammortissement.principale*ammortissement.PenalitePayementAntcp/100);
                                                var penaliteammortissementEcheance=((ammortissement.montanttTotal*ammortissement.PenalitePayementAntcp/100));
                                                var penaliteinteret=((ammortissement.interet*ammortissement.PenalitePayementAntcp/100));
                                                // Pourcentage
                                                var penalitecapitalp=(ammortissement.principale*ammortissement.RetardPourcentage/100);
                                                var penaliteammortissementEcheancep=((ammortissement.montanttTotal*ammortissement.RetardPourcentage/100));
                                                var penaliteinteretp=((ammortissement.interet*ammortissement.RetardPourcentage/100));

                                                

                                                if(montant < montantexigerammortissement )
                                                {
                                                    // Pour l'anticipe
                                                    // Si penalite pourcentage == Capital
                                                    if(ammortissement.PenaliteAnticipe == "Capital"){
                                                        $('#remboursement_credit_penalite').val(penalitecapital);
                                                        $('#remboursement_credit_Commentaire').val('RETARD');
                                                    }
                                                     // Si penalite pourcentage == Interet
                                                    else if(ammortissement.PenaliteAnticipe == "Interet"){
                                                        $('#remboursement_credit_penalite').val(penaliteinteret);
                                                        $('#remboursement_credit_Commentaire').val('RETARD');
                                                    }
                                                    // Si penalite pourcentage == Credit Restant
                                                    else if(ammortissement.PenaliteAnticipe == "Credit Restant"){
                                                        $('#remboursement_credit_penalite').val(penaliteammortissementEcheance);
                                                        $('#remboursement_credit_Commentaire').val('RETARD');
                                                    }

                                                    // Pour le pourcentage
                                                      // Si penalite pourcentage == Capital
                                                      if(ammortissement.PenalitePourcentage == "Capital"){
                                                        $('#remboursement_credit_penalite').val(penalitecapitalp);
                                                        $('#remboursement_credit_Commentaire').val('RETARD');
                                                    }
                                                     // Si penalite pourcentage == Interet
                                                    else if(ammortissement.PenalitePourcentage == "Interet"){
                                                        $('#remboursement_credit_penalite').val(penaliteinteretp);
                                                        $('#remboursement_credit_Commentaire').val('RETARD');
                                                    }
                                                    // Si penalite pourcentage == Credit Restant
                                                    else if(ammortissement.PenalitePourcentage == "Credit Restant"){
                                                        $('#remboursement_credit_penalite').val(penaliteammortissementEcheancep);
                                                        $('#remboursement_credit_Commentaire').val('RETARD');
                                                    }

                                                }
                                                else{
                                                    $('#remboursement_credit_penalite').val(0);
                                                    $('#remboursement_credit_Commentaire').val('NORMALE');
                                                }

                                        }
                                    }
                                })    
                                                                
                            }
                            // sinon on incremente le periode
                            else{
                                // Si le montant preciinferieur oi egal ou maontant payes
                                if(remboursement.montanttTotal <= montant ){

                                    var perioderemb=remboursement.perioderemboursement;
                                    perioderemb++;
                                    // console.log(perioderemb);
                                    $('#remboursement_credit_periode').val(perioderemb);
                                    document.getElementById('periode').innerHTML=perioderemb;
                                    $('#remboursement_credit_Commentaire').val('NORMALE');

                                }
                                else{
                                    // Ici on test si le montant paye precedent est normale
                                    var montantprecedentpaye=remboursement.montantrembourse;
                                    var montantprecedentnormale =remboursement.montanttTotal;

                                        if(montantprecedentpaye === montantprecedentnormale ){

                                            var periodepenalite=remboursement.perioderemboursement;
                                            periodepenalite++;

                                            // Les 3 types de penalites
                                            // Anticipe
                                            var penalitecapital=(remboursement.principale*remboursement.PenalitePayementAntcp/100);
                                            var penaliteammortissementEcheance=((remboursement.montanttTotal*remboursement.PenalitePayementAntcp/100));
                                            var penaliteinteret=((remboursement.interet*remboursement.PenalitePayementAntcp/100));
                                            // Pourcentage
                                            var penalitecapitalp=(remboursement.principale*remboursement.RetardPourcentage/100);
                                            var penaliteammortissementEcheancep=((remboursement.montanttTotal*remboursement.RetardPourcentage/100));
                                            var penaliteinteretp=((remboursement.interet*remboursement.RetardPourcentage/100));

                                                                                                // Pour l'anticipe
                                                    // Si penalite pourcentage == Capital
                                                    if(remboursement.PenaliteAnticipe == "Capital"){
                                                        $('#remboursement_credit_penalite').val(penalitecapital);
                                                        $('#remboursement_credit_Commentaire').val('RETARD');
                                                    }
                                                     // Si penalite pourcentage == Interet
                                                    else if(remboursement.PenaliteAnticipe == "Interet"){
                                                        $('#remboursement_credit_penalite').val(penaliteinteret);
                                                        $('#remboursement_credit_Commentaire').val('RETARD');
                                                    }
                                                    // Si penalite pourcentage == Credit Restant
                                                    else if(remboursement.PenaliteAnticipe == "Credit Restant"){
                                                        $('#remboursement_credit_penalite').val(penaliteammortissementEcheance);
                                                        $('#remboursement_credit_Commentaire').val('RETARD');
                                                    }

                                                    // Pour le pourcentage
                                                      // Si penalite pourcentage == Capital
                                                      if(remboursement.PenalitePourcentage == "Capital"){
                                                        $('#remboursement_credit_penalite').val(penalitecapitalp);
                                                        $('#remboursement_credit_Commentaire').val('RETARD');
                                                    }
                                                     // Si penalite pourcentage == Interet
                                                    else if(remboursement.PenalitePourcentage == "Interet"){
                                                        $('#remboursement_credit_penalite').val(penaliteinteretp);
                                                        $('#remboursement_credit_Commentaire').val('RETARD');
                                                    }
                                                    // Si penalite pourcentage == Credit Restant
                                                    else if(remboursement.PenalitePourcentage == "Credit Restant"){
                                                        $('#remboursement_credit_penalite').val(penaliteammortissementEcheancep);
                                                        $('#remboursement_credit_Commentaire').val('RETARD');
                                                    }

                                            
                                            // var penalite=((remboursement.montanttTotal*2/100));
                                            
                                            // $('#remboursement_credit_penalite').val(penalite);
                                            $('#remboursement_credit_periode').val(periodepenalite);
                                            document.getElementById('periode').innerHTML=periodepenalite;
                                            // $('#remboursement_credit_Commentaire').val('RETARD');

                                        }
                                            // Sinon on complete le remboursement ,
                                        else{
                                                // Si le montant precedent n'est pas complet    
                                                // Si le somme des montant sont encore minimum par
                                                // rapport au montant du ,encore penalisé
                                                    var montantprecedent=remboursement.montantrembourse;
                                                    var montantnormale=remboursement.montanttTotal;
                                                    var periodepenaliteretard=remboursement.perioderemboursement;
                                                    var montantTotal=parseFloat(montant);
                                                    var penaliteretarddeuxieme=((remboursement.montanttTotal*2/100));



                                                        if(montantTotal < montantnormale)
                                                        {
                                                            $('#remboursement_credit_penalite').val(penalite);
                                                            $('#remboursement_credit_MontantTotalPaye').val(montantTotal);
                                                            $('#remboursement_credit_periode').val(periodepenaliteretard);
                                                            document.getElementById('periode').innerHTML=periodepenaliteretard;
                                                            $('#remboursement_credit_Commentaire').val('RETARD')


                                                            // Si le remboursement n'a pas encore rembourser
                                                            if(remboursement.penaliteremboursement != null){

                                                                $('#remboursement_credit_penalite').val(parseFloat(penaliteretarddeuxieme)+parseFloat(remboursement.penaliteremboursement));
                                                            }
                                                            else
                                                            {
                                                                $('#remboursement_credit_penalite').val(penaliteretarddeuxieme);
                                                            }

                                                        }
                                                        else
                                                        {
                                                            var periodesanspenalite=remboursement.perioderemboursement;
                
                                                            $('#remboursement_credit_MontantTotalPaye').val(montantTotal);
                                                            $('#remboursement_credit_periode').val(periodesanspenalite);
                                                            document.getElementById('periode').innerHTML=periodesanspenalite;
                                                            $('#remboursement_credit_Commentaire').val('NORMALE');
                                                            $('#remboursement_credit_penalite').val(0);

                                                        }
                                            
                                        }

                                }
                            }

                           
                        }
                    }
                }) 
        });

      
    }
    });