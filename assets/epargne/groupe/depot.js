import $ from 'jquery'

var path = window.location.pathname

$(document).ready(() =>{

    if(path === '/depot/epargne/groupe')
    {
        $('#form_code').on('keyup',() =>{

            const code_groupe_ = $('#form_code').val();
            /////Api groupe
            var url = "/api/epargne/groupe/"+code_groupe_;
    
            $.ajax({
                url: url,
                method: "GET",
                dataType : "json",
                contentType: "application/json; charset=utf-8",
                data : JSON.stringify(code_groupe_),
                success: function(result){

                    
                    for (let i = 0; i < result.length; i++) {
                        var element = result[i];
                        
                        document.getElementById('code_groupe').innerHTML = element.code;
                        document.getElementById('nom_groupe').innerHTML = element.nom;
                        document.getElementById('email_groupe').innerHTML = element.email;

                        $('#form_nom').val(element.nom);
                        $('#form_email').val(element.email);
                        $('#form_code_groupe').val(element.codegroupe);
                    }
            
                },
                error: function (request, status, error) {
                    console.log(request.responseText);
                }
    
            }); 


        })


        /*************************Suggestion */


        var url_api = '/api/allcodegroupe';

        const code_rechercher = document.getElementById('form_code');

        code_rechercher.addEventListener('keyup',()=>{
        const value_input = code_rechercher.value;

            $.ajax({
                url: url_api,
                method: "GET",
                dataType : "json",
                contentType: "application/json; charset=utf-8",
                data : JSON.stringify(),
                success: function(result){
                    const getValue = result.filter(i => i.code.toLocaleLowerCase().includes(value_input.toLocaleLowerCase()))
                        var suggestion = ''

                        if( value_input != ''){
                            getValue.forEach(resultItem =>{
                            
                                suggestion += `<div class="suggestion">${resultItem.code}</div>`
                            })
                        }else{
                            suggestion = '<div class="suggestion"> Pas de groupe </div>'
                        }

                        document.getElementById('groupe_suggest').innerHTML = suggestion
            

                    // const getValue = result.filter(i => i.code.toLocaleLowerCase().includes(value_input.toLocaleLowerCase()))

                    // var suggestion = ''

                    // if( value_input != '' ){
                    //     getValue.forEach(resultItem =>{
                        
                    //     suggestion += `<div class="suggestion">${resultItem.code}</div>`
                    //     })
                    // }else{
                    //     suggestion = '<div class="suggestion"> Pas de commune</div>'
                    // }
                    
                    // document.getElementById('code_suggest').innerHTML = suggestion
                
            
                },
                error: function (request, status, error) {
                    console.log(request.responseText);
                }

            }); 
        }); 
    }
})