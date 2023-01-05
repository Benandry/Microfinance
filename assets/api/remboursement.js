import $ from 'jquery'

$(document).ready(function(){

    var recupe_codecredit=$('#codecreditremboursement').text()
    // var codecredit=$('#remboursement_codecredit').val(recupe_codecredit)
    console.log(recupe_codecredit)

    // cache tous les elements inutile
    // $('#remboursement_periode').hide()
    // $('#remboursement_principale').hide()
    // $('#remboursement_interet').hide()
    // $('#remboursement_codeclient').hide()
    // $('#remboursement_annuite').hide()
    // $('#remboursement_codecredit').hide()
    // $('#remboursement_typeamortissement').hide()

    
    var url_api='/remboursement_credit/'+recupe_codecredit;

    // $('#remboursement_periode').on('blur',function(){
        $.ajax({
            url:url_api,
            method:'GET',
            dataType:"json",
            contentType:"application/json; charset=utf-8",
            data : JSON.stringify(),
            success :function(data){
                for(let j=0;j<data.length;j++){
                    var clientcredit=data[j];
                    // on recupere la date ici
                    // var date =new Date()
                    // var mois=date.getMonth()+1

                    if(clientcredit.codecreditammortissement == null){
                        // $('#remboursement_periode').val(clientcredit.periode)
                        // $('#remboursement_dateRemborsement').val(clientcredit.dateRemborsement)
                        // $('#remboursement_principale').val(clientcredit.principale)
                        // $('#remboursement_interet').val(clientcredit.interet)
                        // $('#remboursement_montanttTotal').val(clientcredit.montanttTotal)
                        // $('#remboursement_codeclient').val(clientcredit.codeclient)
                        // $('#remboursement_remboursement').val('Montant A payer')
                        // $('#remboursement_annuite').val(clientcredit.remboursementannuite)
                        $('#remboursement_codecredit').val(clientcredit.codecredit)
                        // $('#remboursement_typeamortissement').val(clientcredit.typeamortissement)
                    }

                    // console.log(mois)
                    // console.log(clientcredit.codecredit)
                    // console.log(clientcredit.codecreditammortissement)
                    
                }

                console.log(result);
                for (let i = 0; i < result.length; i++) {
                    var element = result[i];
                
                }
            }
        });
    // })

    })