import $ from 'jquery'

var path = window.location.pathname

$(document).ready(()=>{
    if (path === '/agence/new') {
        
        const url_api ='/api/commune-madagascar';

        const search_input = document.getElementById('agence_commune')

        search_input.addEventListener('keyup',()=>{
        const value_input = search_input.value
            
            $.ajax({
                    url: url_api,
                    method: "GET",
                    dataType : "json",
                    contentType: "application/json; charset=utf-8",
                    data : JSON.stringify(),
                    success: function(result){

                        const getValue = result.filter(i => i.Commune.toLocaleLowerCase().includes(value_input.toLocaleLowerCase()))
                        console.log(getValue)

                        var suggestion = ''

                        if( value_input != ''){
                            getValue.forEach(resultItem =>{
                            
                                suggestion += `<div class="suggestion">${resultItem.Commune}</div>`
                            })
                        }else{
                            suggestion = '<div class="suggestion"> Pas de commune</div>'
                        }

                        document.getElementById('commune_suggest').innerHTML = suggestion
                        
                
                    },
                    error: function (request, status, error) {
                        console.log(request.responseText);
                    }

            });
        })
    }
})