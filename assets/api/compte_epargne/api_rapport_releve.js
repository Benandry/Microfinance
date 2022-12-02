import $ from 'jquery'

const path = window.location.pathname;

$(document).ready(() =>{
    if (path === '/Releve') {
        $("#filtre_releve_Codeclient").on('keyup',function(){

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
                            document.getElementById('codeclient').innerHTML = element.codeclient;
                            document.getElementById('compte_epargne').innerHTML = $("#filtre_releve_Codeclient").val() ;
                            document.getElementById('nom').innerHTML = element.nom_client;
                            document.getElementById('prenom').innerHTML = element.prenom_client;
                        
                            $('#filtre_releve_NomClient').val(element.nom_client);
                            $('#filtre_releve_PrenomClient').val(element.prenom_client);
                            $('#filtre_releve_code').val(element.codeclient)
                    }
                },
                error: function (request, status, error) {
                    console.log(request.responseText);
                }
    
            });    


            /*********Suggestion par api ********* */
            const url_api = '/api/epargne'
            const value_input = $(this).val();

            $.ajax({
                url: url_api,
                method: "GET",
                dataType : "json",
                contentType: "application/json; charset=utf-8",
                data : JSON.stringify(),
                success: function(result){
                    
                    const getValue = result.filter(i => i.code.toLocaleLowerCase().includes(value_input.toLocaleLowerCase()))

                    var suggestion = ''
                    if( value_input != '' ){
                        getValue.forEach(resultItem =>{
                        
                        suggestion += `<div class="suggestion">${resultItem.code}</div>`
                        })
                    }else{
                        suggestion = '<div class="suggestion"> Pas de compte epargne </div>'
                    }
                    
                    document.getElementById('code_suggest').innerHTML = suggestion
                
            
                },
                error: function (request, status, error) {
                    console.log(request.responseText);
                }

            });


        });  
    }
})