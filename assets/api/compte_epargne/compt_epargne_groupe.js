import $ from 'jquery'

var path = window.location.pathname

$(document).ready(() =>{
    if (path === '/compte/epargne/new/groupe') {
        var code_groupe_ = $('#code_groupe').text();

  
        $('#compte_groupe_ep_codeep').val(code_groupe_)

        $("#compte_groupe_ep_produit").on('change',function(){
            var produit = $("#compte_groupe_ep_produit").val()
            
            var url = "/api/individuel/"+produit;
    
            console.log(url);
            $.ajax({
                url: url,
                method: "GET",
                dataType : "json",
                contentType: "application/json; charset=utf-8",
                data : JSON.stringify(produit),
                success: function(result){
                    for (let i = 0; i < result.length; i++) {
                        var element = result[i];
                        console.log(element);
                        document.getElementById('text').innerHTML = "<span id=\'id_prod\'>"+element.Produit_id.toString().padStart(3,0)+"</span>";
                    
                        var id_produits = $('#id_prod').text();
                        
                        $('#compte_groupe_ep_codeepargne').val(code_groupe_+id_produits);
                    }
            
                },
                error: function (request, status, error) {
                    console.log(request.responseText);
                }
    
            });    
        });
    }
})