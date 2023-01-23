 import $ from 'jquery';
 const path = window.location.pathname;

 $(document).ready(() =>{
    if(path === '/decaissement/credit/crud/new/individuel' || path === '/decaissement/credit/crud/new/groupe'){
        const numero_credit = $('#numero_credit').text();
        const montant_credit = $('#montant_credit').text();

        $('#decaissement_numeroCredit').val(numero_credit);
        $('#decaissement_montantCredit').val(montant_credit);
    }
 })