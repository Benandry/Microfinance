import $ from 'jquery'

var path = window.location.pathname

$(document).ready(() =>{
     /********Cache les info */
    if (path === '/compte/epargne/new') {
        var code_client_ = $('#code_client').text()
        var nom_client_ = $('#nom').text()
        var prenom_client_ = $('#prenom').text()

        $('#compte_epargne_codeep').val(code_client_)
        $('#compte_epargne_nom').val(nom_client_)
        $('#compte_epargne_prenom').val(prenom_client_)

        /***************************Code compte epargne************************ */
        $("#compte_epargne_produit").on('change',function(){
        
            var url = "/api/individuel/"+$(this).val();
    
            $.ajax({
                url: url,
                method: "GET",
                dataType : "json",
                contentType: "application/json; charset=utf-8",
                data : JSON.stringify($(this).val()),
                success: function(result){
                    for (let i = 0; i < result.length; i++) {
                        var element = result[i];
                        document.getElementById('text').innerHTML ="<span id=\'id_prod\'>"+element.Produit_id.toString().padStart(3,0)+"</span>";
                        var id_produits = $('#id_prod').text();
                        $('#compte_epargne_codeepargne').val(code_client_+id_produits);
                    }
            
                },
                error: function (request, status, error) {
                    console.log(request.responseText);
                }
    
            }); 
            
            $('#code_text').text(code_client_)        
        });
    }
    else if(path === "/CompteEpargneDepot" || path ==='/depot/epargne/groupe' || path === '/transaction/retrait/individuel' || path === '/transaction/retrait/groupe')
    { 
        $('#form_code').on('change',() => {
            // alert("alert");
            var url = "/releve/client/"+$('#form_code').val();
                
            $.ajax({
                url: url,
                method: "GET",
                dataType : "json",
                contentType: "application/json; charset=utf-8",
                data : JSON.stringify($(this).val()),
                success: function(result){
                    console.log(result);
                    for (let i = 0; i < result.length; i++) {
                       
                        var element = result[i];
                            // console.log(element);

                            document.getElementById('compte_epargne').innerHTML = element.codeepargne;
                            document.getElementById('codeclient').innerHTML = element.codeep;
                            if (element.typeClient === "INDIVIDUEL") {
                                document.getElementById('nom').innerHTML = element.nom_client+" "+element.prenom_client;
                            }
                            else if(element.typeClient === "GROUPE") {
                                document.getElementById('nom').innerHTML = element.nomGroupe
                            }
                            
                    }
                },
                error: function (request, status, error) {
                    console.log(request.responseText);
                }
    
            });    
        })
    }
     //Information du client pour ouvrir un compte epargne
    if(path === '/ouvrirCompteEpargneClient'){
        $('#form_code').on('change',() => {
            // alert("alert");
            var url = "/api/code-client/"+$('#form_code').val();
                
            $.ajax({
                url: url,
                method: "GET",
                dataType : "json",
                contentType: "application/json; charset=utf-8",
                data : JSON.stringify($(this).val()),
                success: function(result){
                    console.log(result);
                    for (let i = 0; i < result.length; i++) {
                       
                        var element = result[i];
                            // console.log(element);
                            document.getElementById('codeclient').innerHTML = element.codeclient;
                            document.getElementById('nom').innerHTML = element.nom;
                            document.getElementById('prenom').innerHTML = element.prenom;
                            
                    }
                },
                error: function (request, status, error) {
                    console.log(request.responseText);
                }
    
            });    
        })
    }
})