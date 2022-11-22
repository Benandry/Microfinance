// retrait

$(document).ready(function(){
        
    $("#filtre_releve_Codeclient").on('keyup',function(){

        var url = "/api/releve/"+$(this).val();

        console.log(url);
        $.ajax({
            url: url,
            method: "GET",
            dataType : "json",
            contentType: "application/json; charset=utf-8",
            data : JSON.stringify($(this).val()),
            success: function(result){
                for (let i = 0; i < result.length; i++) {
                   
                    var element = result[i];
                    console.log(element);
                        document.getElementById('text').innerHTML = "<span id='nomclient'>"+element.nom_client+"</span>";
                        document.getElementById('other').innerHTML = "<span id='prenomclient'>"+element.prenom_client+"</span>";

                        var nomclient = $('#nomclient').text();
                        var prenomclient = $('#prenomclient').text();
                    
                             $('#filtre_releve_NomClient').val(nomclient);
                             $('#filtre_releve_PrenomClient').val(prenomclient);
                }
            },
            error: function (request, status, error) {
                console.log(request.responseText);
            }

        });    
    });

    $(document).ready(function(){
        $(window).on('load',()=>{
            $('#myModal').modal('show')
        })
    });
    
});