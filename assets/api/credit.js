import $ from 'jquery'

$(document).ready(function(){

        // Ici on recuper le nom de l'agent de credit

        $('#demande_credit_codeclient').on('blur',function(){
            $('#demande_credit_Agent').val($('#prenom').text())
    
            // Creation du numero credit
            
            var recuplastnumerocredit=$('#lastnumero').text();

            // recuperation du code agence
            var codeagence=$('#codeagence').text();
            console.log(codeagence)

            // on va boucler le maxId dans la derniere 
            
            recuplastnumerocredit++;

            // On va metter 1  en 0000001
            
            var pad_last_id = recuplastnumerocredit.toString().padStart(7,0)
            // console.log(pad_last_id);

            // Ici on aura une resultat : I0000001
            if($('#demande_credit_TypeClient').val() == 'INDIVIDUEL'){
                $('#demande_credit_NumeroCredit').val('I'+codeagence+pad_last_id);
            }
            else{
                $('#demande_credit_NumeroCredit').val('G'+codeagence+pad_last_id);
            }

            var url_api=  '/api/credit/client/'+$(this).val();

            $.ajax({
                url:url_api,
                method:"GET",
                dataType:"json",
                contentType:"application/json; charset=utf-8",
                success : function(content){
                    for(let j=0;j<content.length;j++){
                        var el=content[j];
                        console.log(el);
                        
                        var codeepargneclient=el.codeepargne

                        console.log(codeepargneclient)
                        
                        // Ici on verra si le client possede une epargne ou non
                        
                        if(codeepargneclient == null){
                            alert("vous n'avez pas de compte epargne")
                        }

                        // Affichage du solde epargne

                        $('#demande_credit_SoldeEpargne').val(el.soldeepargne)
                        
                    }
                }
            })            
        })
        
        // Ici on utilise l'api pour recuperer tous les informatins du configuraion dans
        // la base de donnees
        
        $('#demande_credit_ProduitCredit').on('change',function(){

            var url ='/api/credit/'+$(this).val();

            $.ajax({
                url:url,
                method:"GET",
                dataType:"json",
                contentType : "application/json; charset=utf-8",
                success : function(result){
                    for(let i=0;i<result.length;i++){

                        var element= result[i];

                        console.log(element);

                        // On recupere ici les configuration semblable au choix du client

                        var tranche=parseInt(element.Tranche);
                        var montantminimum=parseInt(element.MontantMinimumCredit)
                        var montantmaximum=parseInt(element.MontantMaximumCredit)
                        var tauxinteretannuel=parseInt(element.TauxInteretAnnuel)
                        var nombretranche=parseInt(element.Tranche)
                        var typetranche=(element.TypeTranche)
                        var caclulInteret=(element.CalculInteret)
                        var Differepaiemement=(element.CalculIntertPourDiffere)
                        console.log(Differepaiemement);
                        
                        $('#demande_credit_NombreTranche').val(tranche);
                        $('#demande_credit_Montant').val('Min: '+montantminimum+' || Max:'+montantmaximum);
                        $('#demande_credit_TauxInteretAnnuel').val(tauxinteretannuel);
                        $('#demande_credit_Tranche').val(nombretranche);
                        $('#demande_credit_TypeTranche').val(typetranche);
                        $('#demande_credit_MethodeCalculInteret').val(caclulInteret)

                        // Test lie epargne
                        document.getElementById('lieep').innerHTML=element.ProduitLieEpargne

                        // si la configuration indique que le produit epargne est false
                        // on ne montre pas le champ solde epargne
                        if(element.ProduitLieEpargne == false){
                            $('#demande_credit_SoldeEpargne').hide()
                        }
                        else{
                            $('#demande_credit_SoldeEpargne').show()
                        }
                    }
                }
            })
        })


        // Configuration : garantie epargne
        $('#garantie_credit_CreditBaseEpargne').on('click',function(){
            var garantieepargne=($(this).val());

            console.log(garantieepargne);

            $('#garantie_credit_MontantCreditDmdIndividuel').attr('disabled',false)
            $('#garantie_credit_MontantCreditDmdGroupe').attr('disabled',false)
            $('#garantie_credit_MontantCrdAnciensCreditenCours').attr('disabled',false)
            $('#garantie_credit_MontantCrdAnciensCreditenCoursGrp').attr('disabled',false)
            $('#garantie_credit_GarantieBaseMontantCredit').attr('disabled',false)
            $('#garantie_credit_DeduireGarantieAuDecaissement').attr('disabled',false)
            $('#garantie_credit_DeduireGarantieAuDecaissementGrp').attr('disabled',false)

        })

        // Configuration : garant et credit

        $('#garantie_credit_MontantExige').hide()
        $('#garantie_credit_regle').hide()
        $('#garantie_credit_MontantGarant').hide()
        $('#garantie_credit_MontantGarantieGrp').hide()
        $('#garantie_credit_reglegrp').hide()

        // garantie credit individuel
        $('#garantie_credit_GarantieObligatoireCreditInd').on('click',function(){
          $('#garantie_credit_MontantExige').show()
          $('#garantie_credit_regle').show()
        })

        // garant credit individuel
        $('#garantie_credit_GarantObligatoireCreditGrp').on('click',function(){
            $('#garantie_credit_MontantGarantieGrp').show()
            $('#garantie_credit_reglegrp').show()
            })
        
})