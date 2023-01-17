import $ from 'jquery'

var path = window.location.pathname

$(document).ready(function(){

    if( path === '/remboursement/credit/new' ){
        
        // Ici on va cacher en premier le formulaire caisse
        
        
        // On va afficher le numero credit du client individuel
        $('#remboursement_credit_TransactionEnLiquide').on('click',function(){
            $('#caisse').show();
        })

        
        $('#remboursement_credit_MontantTotalPaye').on('blur',function(){
            
            // On recupere le montant a payer par le client
            var montant = $('#remboursement_credit_MontantTotalPaye').val();

            // console.log(montant);

            var codecredit=document.getElementById('codecreditremboursement').innerHTML;

            // console.log('code credit'+codecredit);
            
            $('#remboursement_credit_NumeroCredit').val(codecredit);

                // url
                var url_api='/remboursement/periode/'+codecredit;
                console.log(url_api);

                $.ajax({
                    url:url_api,
                    method:'GET',
                    dataType:"json",
                    contentType:"application/json; charset=utf-8",
                    data : JSON.stringify(codecredit),
                    success : function(content){
                        console.log('hello world')
                        for(let j=0;j<content.length;j++){
                            var remboursement=content[j];
                            // console.log(remboursement);

                            // $('#montant').val(remboursement.montanttTotal)
                            // document.getElementById('montant').innerHTML=remboursement.montanttTotal;
                            document.getElementById('periode').innerHTML=remboursement.maxperiode;
                            // console.log('maxperiode'+remboursement.maxperiode);

                            // Si remboursement égal a null
                            // On recupere la periode dans ammortissement

                            if(remboursement.perioderemboursement == null)
                            {
                                $('#remboursement_credit_periode').val(remboursement.periode);
                            }
                            // sinon on incremente le periode
                            else{
                                // Si le montant preciinferieur oi egal ou maontant payes
                                if(remboursement.montanttTotal <= montant ){

                                    var perioderemb=remboursement.perioderemboursement;
                                    perioderemb++;
                                    // console.log(perioderemb);
                                    $('#remboursement_credit_periode').val(perioderemb);
                                }
                                else{
                                    // Ici on test si le montant paye precedent est normale
                                    var montantprecedentpaye=remboursement.montantrembourse;
                                    var montantprecedentnormale =remboursement.montanttTotal;

                                        if(montantprecedentpaye == montantprecedentnormale ){

                                            var periodepenalite=remboursement.perioderemboursement;
                                            periodepenalite++;
                                            
                                            var penalite=((remboursement.montanttTotal*2/100));
                                            
                                            $('#remboursement_credit_penalite').val(penalite);
                                            $('#remboursement_credit_periode').val(periodepenalite);
                                        }
                                            // Sinon on complete le remboursement ,
                                        else{
                                                // Si le montant precedent n'est pas complet

                                                
                                                
                                                // Si le somme des montant sont encore minimum par
                                                // rapport au montant du ,encore penalisé
                                                    var montantprecedent=remboursement.montantrembourse;
                                                    var montantnormale=remboursement.montanttTotal;
                                                    var periodepenaliteretard=remboursement.perioderemboursement;
                                                    var montantTotal=parseFloat(montant)+parseFloat(montantprecedent);
                                                    var penaliteretarddeuxieme=((remboursement.montanttTotal*2/100));

                                                    console.log('montant total'+montantTotal);
                                                    console.log('montant precedent'+montantnormale);


                                                        if(montantTotal < montantnormale)
                                                        {
                                                            $('#remboursement_credit_penalite').val(penalite);
                                                            $('#remboursement_credit_MontantTotalPaye').val(montantTotal);
                                                            $('#remboursement_credit_periode').val(periodepenaliteretard);
                                                            $('#remboursement_credit_penalite').val(penaliteretarddeuxieme);

                                                        }
                                                        else
                                                        {
                                                            var periodesanspenalite=remboursement.perioderemboursement;
                                                            periodesanspenalite++;
                
                                                            $('#remboursement_credit_MontantTotalPaye').val(montantTotal);
                                                            $('#remboursement_credit_periode').val(periodesanspenalite);

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