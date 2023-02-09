import $ from 'jquery'

var path = window.location.pathname;

$(document).ready(() =>{
    if(path === '/penalite/credit/new'){


        // Si l'utilisateur coche penalite pourcentage durant une periode
        $('#CalculSurArrierePrcpl').hide();
        $('#SurArrierPrcplIntrt').hide();
        $('#SurPrcplIntrtPnltArriere').hide();
        $('#PnltBsSrMntntDuPrTrnches').hide();

        $('#penalite_credit_PnlitePourcntgDurntunPeriod').on('change',function(){
            $('#CalculSurArrierePrcpl').show();
            $('#SurArrierPrcplIntrt').show();
            $('#SurPrcplIntrtPnltArriere').show();
            $('#PnltBsSrMntntDuPrTrnches').hide();
    
        });
    }
})