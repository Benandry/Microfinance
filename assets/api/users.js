import $ from 'jquery'
const path = window.location.pathname


$(document).ready(() => {
    if (path === '/inscription') {
        // $account_caisse = $('#user_edit_caisse').innerHTML;
       var  account_caisse = document.getElementById('registration_form_caisse');
       var  label_caisse = document.getElementById('label-caisse');

       label_caisse.addEventListener('click',() => {  
            if(label_caisse.textContent == 'Compte Caisse :'){
                account_caisse.style.display = 'block';
                label_caisse.textContent = "Listes comptes caisses ";
            }
            else{
                account_caisse.style.display = 'none';
                label_caisse.textContent = 'Compte Caisse :';
            }
       });
    }

    const regex = /^\/users\/([0-9])\/edit$/;
    var path_regex = regex.test(path)

    if (path_regex) {
        
        var  account_caisse = document.getElementById('user_edit_caisse');
        var  label_caisse = document.getElementById('label-caisse');

        label_caisse.addEventListener('click',() => {
            if(label_caisse.textContent == 'Compte Caisse :'){
                account_caisse.style.display = 'block';
                label_caisse.textContent = "Listes comptes caisses ";
            }
            else{
                account_caisse.style.display = 'none';
                label_caisse.textContent = 'Compte Caisse :';
            }
        });

    }
});
// 