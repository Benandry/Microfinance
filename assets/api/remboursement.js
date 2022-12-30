import $ from 'jquery'

$(document).ready(function(){
    var recupe_codecredit=$('#codecreditremboursement').text()
    // var codecredit=$('#remboursement_codecredit').val(recupe_codecredit)
    console.log(recupe_codecredit)
    
    var url_api='/remboursement_credit/'+recupe_codecredit;

    $('#remboursement_periode').on('blur',function(){
        $.ajax({
            url:url_api,
            method:'GET',
            dataType:"json",
            contentType:"application/json; charset=utf-8",
            success :function(data){
                for(let j=0;j<data.length;j++){
                    var clientcredit=data[j];
                    console.log(clientcredit);
                }

            }
        });
    })

    })