import $ from 'jquery'

var path = window.location.pathname

$(document).ready(() =>{
     /********Cache les info */
    $('#information').css('display','none')
    $('#client_current').css('display','none')

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
                       
                        document.getElementById('text').innerHTML = "<span id=\'type_prod\'>"+element.TypeProd.toString().padStart(1,0)+"</span><span id=\'id_prod\'>"+element.Produit_id.toString().padStart(4,0)+" </span>";
                        
                        
                        var type_produit = $('#type_prod').text();
                        var id_produits = $('#id_prod').text();
                        $('#compte_epargne_codeepargne').val(code_client_+type_produit+id_produits.padStart(5,0));
                    }
            
                },
                error: function (request, status, error) {
                    console.log(request.responseText);
                }
    
            }); 
            
            $('#code_text').text(code_client_)        
        });
    }
})