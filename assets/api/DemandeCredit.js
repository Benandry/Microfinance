import $ from 'jquery'

var path = window.location.pathname;
$(document).ready(function(){
    // L'evenememnt se  produit a l'interieur de cette chemin
    if( path === '/demande/credit/new'){

        // On va mettre automatiquement la date machine
                // Date automatique

        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0');
        var yyyy = today.getFullYear();
        
        // today = mm + '/' + dd + '/' + yyyy;
        today = yyyy +'-' +mm + '-' + dd;
        $("#demande_credit_DateDemande").val(today);

          // Si l'utilisateur selectionne individuel on affiche I sinon G
          $('#demande_credit_TypeClient').on('change',function(){
            var client = $('#demande_credit_TypeClient').val();
            if(client == 'INDIVIDUEL'){ 
                $('#demande_credit_codeclient').val('I');
            }
            else if(client == 'GROUPE'){
                $('#demande_credit_codeclient').val('G');
            }  

          })
        

        // Si l'utilisateur selectionne une produit credit
        // Touts les configuration correspondantes sera affiché automatiquement
        $('#demande_credit_ProduitCredit').on('change',function(){
            
            // On recupere le produit credit

            var produitcredit=$('#demande_credit_ProduitCredit').val();

            // On recupere l'url
            var url='/demandecredit/credit/'+produitcredit;

            // Ajax

            $.ajax({
                url:url,
                method:'GET',
                dataType:"json",
                contentType:"application/json; charset=utf-8",
                data : JSON.stringify(produitcredit),
                success : function(content){
                    for(let j=0;j<content.length;j++){
                        var config=content[j];

                        console.log(config);

                        // Afficher le nombre tranche 
                        $('#demande_credit_NombreTranche').val(config.Tranche);
                        // Afficher la methode
                        $('#demande_credit_TypeTranche').val(config.Methode);
                        // Taux interet annuel
                        $('#demande_credit_TauxInteretAnnuel').val(config.InteretNormal);
                        // Plage montant
                        $('#demande_credit_Montant').val(config.MontantMin+'<= Montant <='+config.Montant);

                        // Verification montant taper par l'utilisateur
                        $('#demande_credit_Montant').on('blur',function(){
                            var montant=$('#demande_credit_Montant').val();

                            // Si le montant taper par l'utilisateur n'est pas dans le plage
                            // de [Montantmin,MontantMax]  
                            if(montant < config.MontantMin || montant > config.Montant ){
                                alert('Montant refusé');

                            }
                        });

                            // Test garantie
                            // Si le garantie financiere est vrai
                            if(config.GarantieFinanciere == true){

                                // Recuperation numero client
                                var codeclient=$('#demande_credit_codeclient').val();
                                // L'utilisateur tape sur le compte epargne
                                $('#demande_credit_CompteEpargne').on('blur',function(){
                                    // On recupere le compte epargne
                                    var compteepargne=$('#demande_credit_CompteEpargne').val();

                                                // url
                                        var url_demande='/api/demandecredit/'+compteepargne;
                                        
                                        // ajax
                                        $.ajax({
                                            url:url_demande,
                                            method:'GET',
                                            dataType:"json",
                                            contentType:"application/json; charset=utf-8",
                                            data : JSON.stringify(compteepargne),
                                            success : function(content){
                                                for(let j=0;j<content.length;j++){
                                                    var garantiefinanciere=content[j];
                                                        console.log(garantiefinanciere);
                                                        // Si le code client taper sur le champ code client est different
                                                        // de celui de 
                                                        if(codeclient == garantiefinanciere.codeclient){
                                                            $('#demande_credit_SoldeEpargne').val(garantiefinanciere.solde);
                                                        }
                                                        else{
                                                            alert('Deux compte differente');
                                                            $('.btn').hide();
                                                        }
                                                }
                                            }                    
                                        });

                                })

                             
                            }
                    }
                }


            })
        });
    }
})