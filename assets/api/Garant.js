import $ from 'jquery';

var path = window.location.pathname;

$(document).ready(function(){
    
    // L'utilisateur choisi le client 

    $('#modal_garant_nom').on('change',function(){
        var individuel=$('#modal_garant_nom').val();
        // alert(individuel);

        $('#modal_garant_codeclient');
    });
});
