import $ from 'jquery'

var path = window.location.pathname

$(document).ready(() =>{
    /*********************************************************** */
    /******************************Pour ouvrir un compte individuel client ************************ */
    if (path === '/ouvrirCompteEpargneClient') {
        /**************************************************************** */
        //************************* api_suggestion **************************
        /******************************************************************** */
        const code_rechercher = document.getElementById('form_code');

        const url_api = '/api/code-client'
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

            var code_client = $('#form_code').val()
            if (code_client.length === 10) {
                var url = '/api/code-client/'+code_client
                $.ajax({
                    url: url,
                    method: "GET",
                    dataType : "json",
                    contentType: "application/json; charset=utf-8",
                    data : JSON.stringify(code_client),
                    success: function(result){
                        for(let i = 0; i < result.length; i++){
                            var element = result[i]
        
                            if(element !== '' ){
                                console.log(element)
                                $('#form_nom').val(element.nom)
                                $('#form_prenom').val(element.prenom)
                    
                                $('#code_cli').text(element.codeclient)
                                $('#nom_cli').text(element.nom)
                                $('#prenom_cli').text(element.prenom)
                            }else{
                                console.log(element)
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
<<<<<<< HEAD
=======
        /*************************************Cacher les formulaire nom et prenom ********* */
        $('#info_client').css('display','hide')
>>>>>>> refs/remotes/origin/main
           
   
    }
})