import $ from 'jquery'

var path = window.location.pathname

$(document).ready(function(){

    /**
     * La route /modal/remboursement est pour le modal remboursement
     */
    if( path === '/modal/remboursement' ){
        
        $('#remboursement_modal_codecredit').on('keyup',function(){

            var numerocredit=$('#remboursement_modal_codecredit').val();

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
                                $('#remboursement_modal_penaliteprecedent').val(remboursementmodal.penaliteremboursementModal);
                                $('#remboursement_modal_montantprecedent').val(remboursementmodal.montantrembourseModal);
                                $('#remboursement_modal_restemontant').val(resetapayer);
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
                                
                        }
                    }
                }) 
        })

    }

    /**
     * la route /remboursement/credit/new est pour le remboursement
     */

    if( path === '/remboursement/credit/new' ){
        // var reste= document.getElementById('reste').innerHTML;

        // Date automatique

        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0');
        var yyyy = today.getFullYear();
      
        // today = mm + '/' + dd + '/' + yyyy;
        today = yyyy +'-' +mm + '-' + dd;
        $("#remboursement_credit_DateRemboursement").val(today);
      
        
        // Ici on va cacher en premier le formulaire caisse
        
        
        // On va afficher le numero credit du client individuel
        $('#remboursement_credit_TransactionEnLiquide').on('click',function(){
            $('#caisse').show();
        })

        /*
         *Ici l'utilisateur ecrit le montant a payer par le crediteur 
         */

        $('#remboursement_credit_MontantTotalPaye').on({    
           
            /**
             * Evenement pour les panelite , . . .
            */
           blur:function(){
                           
            // On recupere le montant a payer par le client
            var montant = $('#remboursement_credit_MontantTotalPaye').val();
            
            // alert('comparaison');
            var codecredit=document.getElementById('codecreditremboursement').innerHTML;
            var periode =parseInt(document.getElementById('periodeprecedent').innerHTML)+1;

            // console.log('code credit'+codecredit);
            
            $('#remboursement_credit_NumeroCredit').val(codecredit);

                // url
                var url_api='/remboursement/periode/'+codecredit+'/'+periode;

                $.ajax({
                    url:url_api,
                    method:'GET',
                    dataType:"json",
                    contentType:"application/json; charset=utf-8",
                    data : JSON.stringify(codecredit,periode),
                    success : function(content){
                        // console.log('hello world')
                        for(let j=0;j<content.length;j++){
                            var remboursement=content[j];
                            // console.log(remboursement);
                            $('#remboursement_credit_MontantEcheance').val(remboursement.montanttTotal);

                            // Si remboursement égal a null
                            // On recupere la premier periode dabs la table ammortissement

                            if(remboursement.perioderemboursement == null)
                            {
                                $('#remboursement_credit_periode').val(remboursement.periode);
                                // if(periode == NaN){
                                //     periode = 1;
                                //     var url_api_ammortissement='/remboursement/ammortissement/'+codecredit+'/'+periode;
                                // }
                                // else{
                                    var url_api_ammortissement='/remboursement/ammortissement/'+codecredit+'/'+periode;
                                // }
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
                                            // console.log(ammortissement);
                                            $('#remboursement_credit_MontantEcheance').val(ammortissement.montanttTotal);

                                            // on met la periode 1
                                                $('#remboursement_credit_periode').val(periode)
                                                document.getElementById('periode').innerHTML=periode;

                                            // Si le montant n'est pas egal au montant exiger : penalite
                                                var montantexigerammortissement=ammortissement.montanttTotal;
                                                
                                                console.log(montantexigerammortissement);
                                                var penaliteammortissement=((ammortissement.montanttTotal*2/100))

                                                if(montant < montantexigerammortissement )
                                                {
                                                    $('#remboursement_credit_penalite').val(penaliteammortissement);
                                                    $('#remboursement_credit_Commentaire').val('RETARD');
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
                                            
                                            var penalite=((remboursement.montanttTotal*2/100));
                                            
                                            $('#remboursement_credit_penalite').val(penalite);
                                            $('#remboursement_credit_periode').val(periodepenalite);
                                            document.getElementById('periode').innerHTML=periodepenalite;
                                            $('#remboursement_credit_Commentaire').val('RETARD');

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

        },
        
    });

    /**
     * Ici l'utilisateur ecrit sur le champ piece comptable
     */

        $('#remboursement_credit_PieceCompteble').on('blur',function(){
            var periode = $('#remboursement_credit_periode').val();
            var montantapayer = $('#remboursement_credit_MontantTotalPaye').val();
            var codecredit = document.getElementById('codecreditremboursement').innerHTML;
            var penaliteprecedent = document.getElementById('penalite').innerHTML;
            // alert(periode);

                var url_comparaison = '/remboursement/comparaison/'+codecredit+'/'+periode;
    
                $.ajax({
                    url:url_comparaison,
                    method:'GET',
                    dataType:"json",
                    contentType:"application/json; charset=utf-8",
                    data : JSON.stringify(codecredit,periode),
                    success : function(content){
                        for(let j=0;j<content.length;j++){
                            var comparaison=content[j];
                            /**
                             * Si le penalite est vide
                             */
                                if(penaliteprecedent == null){
                                    /**
                                     * Penalite
                                     */
                                    var penalite=comparaison.montanttotalammort*2/100;
                                    /**
                                     * Si le montant a payer est inferieur au montant payer par le crediteur(se)
                                     */
                                    if(comparaison.montanttotalammort < montantapayer){
                                        $('#remboursement_credit_penalite').val(penalite);
                                    }
                                }
                        }   
                    }
                });

        })

        /**
         * Comparaison
         */
        // $('#remboursement_credit_NumeroCredit').on('blur',function(){
        //     alert("Comparaison");
        // })
      
    }
    });