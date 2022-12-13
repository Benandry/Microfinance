//importer jquery
import $ from 'jquery'

const pathname = window.location.pathname;

$(document).ready(() =>{
    if (pathname === '/individuel/new') {
        
        var last_client =parseInt($('#last_client').text());
                
        last_client++;
            
        var pad_last_client = last_client.toString().padStart(7,0)

        // MAnova an ilay agence   
        var get_agence_id = parseInt($('#agence_id').text());
        var  pad_agence_id = get_agence_id.toString().padStart(2,0)
        var code_client_ = 'I'+pad_agence_id+pad_last_client

        $('#individuelclient_codeclient').val(code_client_);
        
        // {# Cacher le champ code client individuel#}
        $('#individuel').attr("style", "display: none");

        /*****Manova an ilay age user */
        $('#individuelclient_date_naissance').on('change',(e)=>{
            var birth_ =  $('#individuelclient_date_naissance').val()
            var year_birth =parseInt(birth_.slice(0,4))
            var year_now = parseInt(new Date().getFullYear())
    
            var age = year_now - year_birth
            $('#age').html(age+' ans  ')
        
        })


                
        /********************************************************************************* */
        /******************************************************************************** */
        /******************************************************************************** */

        const url_api ='/api/commune-madagascar';

        const search_input = document.getElementById('individuelclient_commune')

        search_input.addEventListener('keyup',()=>{

            // const value_input = search_input.value
            
            $.ajax({
                    url: url_api,
                    method: "GET",
                    dataType : "json",
                    contentType: "application/json; charset=utf-8",
                    data : JSON.stringify(),
                    success: (function(result){
                        $(function() {
                            for(let i=0;i<result.length;i++){

                                var element=result[i]

                                console.log(element)

                                // $('#individuelclient_commune').val(element)
                            
                                $("#individuelclient_commune" ).autocomplete({
                                      source : element
                                 });

                                // $('#commune_suggest').val(element)
                                }
                            // var availableTags = [];
                            // $( "#tags" ).autocomplete({
                            //   source : availableTags
                            // });
                          });                            
                    }),

                    // function(result){
                            

                    //         $( "#commune_suggest" ).autocomplete({
                    //             source : element
                    //           });


                    
                        // const getValue = result.filter(i => i.Commune.toLocaleLowerCase().includes(value_input.toLocaleLowerCase()))
                        // console.log(getValue)

                        // var suggestion = ''

                        // if( value_input != ''){
                        //     getValue.forEach(resultItem =>{
                            
                        //         suggestion += `<div class="suggestion">${resultItem.Commune}</div>`
                        //     })
                        // }else{
                        //     suggestion = '<div class="suggestion"> Pas de client</div>'
                        // }

                        // document.getElementById('commune_suggest').innerHTML = suggestion
                        
                
                    // },
                    error: function (request, status, error) {
                        console.log(request.responseText);
                    }

            });    
        })
        /************************************************************************************************* */
        /************************************************************************************************* */
        /************************************************************************************************* */

        // Recuperer l'agence et le code agence de l'utilisateur
        var agences=$('#agence').text()
        var code=$('#code').text()
        console.log(agences)
        console.log(code)

        $('#individuelclient_NomAgence').val(agences)
        $('#individuelclient_CodeAgence').val(code)


    }

})