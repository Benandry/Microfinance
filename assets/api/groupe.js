import $ from 'jquery'

var path = window.location.pathname;

$(document).ready(() =>{
    if(path === '/groupe/new'){

       // {#  Manova an ilay input code Groupe  #}
        var id_groupe =parseInt($('#id_groupe').text());
        id_groupe++;
       // {# Agence #}
        var id_agence =$('#id_agence').text();

         var code_groupe = 'G'+id_agence.padStart(2,0)+''+id_groupe.toString().padStart(7,0);
        
        $('#groupe_codegroupe').val(code_groupe);
    }
})