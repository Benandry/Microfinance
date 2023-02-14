import $ from 'jquery'

const path = window.location.pathname;

$(document).ready(() =>{
    if (path === '/Releve') {
        $("#filtre_releve_Codeclient").on('change',function(){

            var url = "/releve/client/"+$(this).val();
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
                            document.getElementById('codeclient').innerHTML = element.codeepargne;
                            if (element.typeClient === "INDIVIDUEL") {
                                document.getElementById('nom').innerHTML = element.nom_client+" "+element.prenom_client;
                            }
                            else if(element.typeClient === "GROUPE") {
                                document.getElementById('nom').innerHTML = element.nomGroupe
                            }
                            
                            // document.getElementById('prenom').innerHTML = ;
                        
                            $('#filtre_releve_NomClient').val(element.nom_client);
                            $('#filtre_releve_PrenomClient').val(element.prenom_client);
                            $('#filtre_releve_code').val(element.codeclient)
                    }
                },
                error: function (request, status, error) {
                    console.log(request.responseText);
                }
    
            });    
        });  
    }
})