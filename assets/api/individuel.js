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
<<<<<<< HEAD
=======
        $('#individuel').attr("style", "display: none");
>>>>>>> refs/remotes/origin/main

        /*****Manova an ilay age user */
        $('#individuelclient_date_naissance').on('change',(e)=>{
            var birth_ =  $('#individuelclient_date_naissance').val()
            var year_birth =parseInt(birth_.slice(0,4))
            var year_now = parseInt(new Date().getFullYear())
    
            var age = year_now - year_birth
            $('#age').html(age+' ans  ')
        
        })
    }

})