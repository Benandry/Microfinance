import $ from 'jquery'

const path=window.location.pathname;

$(document).ready(function(){
    if(path == '/Reechelonnement/Individuel'){

        
        $('#reechelonnement_modal_CodeCredit').on('change',function(){
            var idcredit=$('#reechelonnement_modal_CodeCredit').val();
            console.log(idcredit);
        });
    }
});