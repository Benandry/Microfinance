import $ from 'jquery'

var path = window.location.pathname

$(document).ready(() =>{

    if(path === '/depot/epargne/groupe')
    {
        $('#form_code').on('keyup',() =>{

            const code_groupe_ = $('#form_code').val();
            /////Api groupe
            var url = "/api/code-groupe/code/"+code_groupe_;
    
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
                    }

                      //console.log(code_groupe_);


                     const getValue = result.filter(i => i.code.toLocaleLowerCase().includes(code_groupe_.toLocaleLowerCase()))
                        // console.log(getValue)

                        var suggestion = ''

                        if( code_groupe_ != ''){
                            getValue.forEach(resultItem =>{
                            
                                suggestion += `<div class="suggestion">${resultItem.Commune}</div>`
                            })
                        }else{
                            suggestion = '<div class="suggestion"> Pas de groupe </div>'
                        }

                        document.getElementById('groupe_suggest').innerHTML = suggestion
            
                },
                error: function (request, status, error) {
                    console.log(request.responseText);
                }
    
            }); 


        })

    }
})