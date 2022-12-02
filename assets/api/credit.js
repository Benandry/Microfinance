import $ from 'jquery'

$(document).ready(function(){

        // Ici on recuper le nom de l'agent de credit
    
        $('#demande_credit_codeclient').on('keyup',function(){
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

                        // document.getElementById('demande_credit_NombreTranche').innerHTML=parseInt(element.Tranche)
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
                    }
                }
            })
        })
        
})