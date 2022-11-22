import $ from 'jquery'

var path = window.location.pathname

$(document).ready(() =>{
    if (path === '/ouvrirCompteEpargneEpargneGroupe') {
        $('#info_groupe').css('display','none')
        var url_api = '/api/code-groupe'

        const code_rechercher = document.getElementById('form_code');

        code_rechercher.addEventListener('keyup',()=>{
            const value_input = code_rechercher.value
            
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
                        suggestion = '<div class="suggestion"> Pas de commune</div>'
                    }
                    
                    document.getElementById('code_suggest').innerHTML = suggestion
                
            
                },
                error: function (request, status, error) {
                    console.log(request.responseText);
                }

            }); 

            
            
        })

                /************************************************************************************************************ */
        /*********************************************Api nom et prenom du client a ouvrir un compte */
        /********************************************************************************************************** */

        $('#form_code').on('keyup',()=>{

            var code_groupe_ = $('#form_code').val()
            
            if (code_groupe_.length === 10) {
                var url = '/api/code-groupe/code/'+code_groupe_
                $.ajax({
                    url: url,
                    method: "GET",
                    dataType : "json",
                    contentType: "application/json; charset=utf-8",
                    data : JSON.stringify(code_groupe_),
                    success: function(result){
                        for(let i = 0; i < result.length; i++){
                            var element = result[i]
        
                            if(element !== '' ){
                                //console.log(element)
                                $('#form_nomgroupe').val(element.nom)
                                $('#form_email').val(element.email)
                    
                                $('#code_grp').text(element.code)
                                $('#nom_grp').text(element.nom)
                                $('#email_grp').text(element.email)
                            }else{
                               // console.log(element)
                                 $('#form_nom').val("Pas de client")
                                 $('#form_prenom').val("Pas de client")
                            }
                               
                        }
                    },
                    error: function (request, status, error) {
                        console.log(request.responseText);
                    }
            
                })    
            }
        
        })
  
    }


    if (path === '/compte/epargne/new/groupe') {

        var code_groupe_ = $('#code_groupe').text()
        
        $('#information').css('display','none')
        $('#code_ep_Gr').css('display','none')
        $('#compte_groupe_ep_codegroupe').val(code_groupe_)

        $("#compte_groupe_ep_produit").on('change',function(){
            var produit = $("#compte_groupe_ep_produit").val()
            //alert(produit)
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
                        document.getElementById('text').innerHTML = "<span id=\'type_prod\'>"+element.TypeProd.toString()+"</span><span id=\'id_prod\'>"+element.Produit_id.toString().padStart(4,0)+" </span>";
                    
                        var type_produit = $('#type_prod').text();
                        var id_produits = $('#id_prod').text();
                        
                        $('#compte_groupe_ep_codegroupeepargne').val(code_groupe_+type_produit+id_produits.padStart(5,0));
                    }
            
                },
                error: function (request, status, error) {
                    console.log(request.responseText);
                }
    
            });    
        });
    }
})