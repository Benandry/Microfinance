import $ from 'jquery'

const path = window.location.pathname;
$(document).ready(() =>{
    
    if (path === '/approbation/credit/new/individuel' || path === '/approbation/credit/new/groupe') {

        $('#approbation_credit_montant').val($('#montant').text());
        $('#approbation_credit_codecredit').val($('#codecredit').text());
    }
})