import $ from 'jquery'

const path=window.location.pathname;

$(document).ready(function(){
    if(path == '/Reechelonnement/Individuel'){

        var idcredit=$('#reechelonnement_modal_CodeCredit').val();

        $('#reechelonnement_modal_CodeCredit').on('change',function(){
            console.log(idcredit);
        });
    }
});