import $ from 'jquery'

$(document).ready(function(){
    var recupe_codecredit=$('#codecreditremboursement').text()
    // var codecredit=$('#remboursement_codecredit').val(recupe_codecredit)

    
    var url_api='/remboursement_credit/'+recupe_codecredit;

    console.log(url_api);
        $.ajax({
            url: url_api,
            method: "GET",
            dataType : "json",
            contentType: "application/json; charset=utf-8",
            data : JSON.stringify(),
            success: function(result){

                console.log(result);
                for (let i = 0; i < result.length; i++) {
                    var element = result[i];
                
                }
            }
        });
    })