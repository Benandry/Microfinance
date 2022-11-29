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
        
})