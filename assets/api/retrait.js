<<<<<<< HEAD

import $ from 'jquery'
const path = window.location.pathname;
$(document).ready(() =>{

=======
import { Button } from 'bootstrap';
import $ from 'jquery'
const path = window.location.pathname

$(document).ready(() =>{

    // individuel

>>>>>>> refs/remotes/origin/main
    if( path === '/transaction/retrait/individuel' ){
        $('#form_code').on('keyup',()=>{
            var codeepargneclient= $('#form_code').val();

            console.log(codeepargneclient);

            if(codeepargneclient.length == 15){
                const url_api = '/info/'+codeepargneclient;
            $.ajax({
                url: url_api,
                method: "GET",
                dataType : "json",
                contentType: "application/json; charset=utf-8",
                data : JSON.stringify(codeepargneclient),
                success: function(result){
                    for(let i= 0 ; i < result.length ;i++){
                        var element = result[i];
                        console.log(element);

                        $('#form_code_client').val(element.code)
                        $('#form_produit').val(element.nomproduit)
                        $('#form_nom').val(element.nom_client)
                        $('#form_prenom').val(element.prenom_client)

                        document.getElementById('code_ep').innerHTML =element.code;
                        document.getElementById('code_cli').innerHTML =element.client_code;
                        document.getElementById('produit').innerHTML =element.nomproduit;
                        document.getElementById('nom_cli').innerHTML =element.nom_client;
                        document.getElementById('prenom_cli').innerHTML =element.prenom_client;

                        // $('#form_nom').val(element.nomGroupe)
                        // $('#nom_groupe').val(element.nomGroupe)
                        // document.getElementById('nom_groupe').innerHTML=element.nomGroupe;
                    }
                    
                },
                error: function (request, status, error) {
                    console.log(request.responseText);
                }
                
            })    
        }
        })
    }

    if( path === '/transaction/individuel' ){

        var codeepargnegroupe=$('#code_epargne_client').text();

        $('#transactionretrait_codeepargneclient').val(codeepargnegroupe)

        $('#transactionretrait_typeClient').val('INDIVIDUEL')

<<<<<<< HEAD
        $('#transactionretrait_commission').val(0)
        $('#transactionretrait_papeterie').val(0)
=======
        $('#transactionretrait_commission').val('0')
        $('#transactionretrait_papeterie').val('0')
>>>>>>> refs/remotes/origin/main

        $('#transactionretrait_solde').hide();

        var solde=document.getElementById('solde_cli').innerHTML;
        console.log(solde)
<<<<<<< HEAD
=======
        var montant_bruit_ = 0
        var commission = 0
        var papeterie = 0
>>>>>>> refs/remotes/origin/main

        $('#transactionretrait_Montant').on('keyup',()=>{
            var montant=$('#transactionretrait_Montant').val();

<<<<<<< HEAD
            var soldeactuel =solde - montant

            console.log(soldeactuel);

            $('#transactionretrait_montant_bruite').val(montant);

=======
            var soldeactuel=solde - montant

                console.log(montant);
                console.log(solde);
            $('#transactionretrait_montant_bruite').val(montant);
>>>>>>> refs/remotes/origin/main
            if(soldeactuel < 0){
                alert('Solde epuisé')
                $('.btn').hide()
            }else{
                $('#transactionretrait_solde').val(soldeactuel)
                $('.btn').show()
            }
        })

    }

    // groupe

    if( path === '/transaction/retrait/groupe' ){
        $('#form_code').on('keyup',() =>{
            var codegroupe=$('#form_code').val()
            console.log(codegroupe)
<<<<<<< HEAD
=======
        //     montant_bruit_ = parseInt(e.target.value);
        // })

        // $('#transactionretrait_commission').on('change',(e)=>{
        //     commission = parseInt(e.target.value)
        // })

        // $('#transactionretrait_papeterie').on('change',(e) =>{
        //     papeterie = parseInt(e.target.value)
        //     montant_total = montant_bruit_ -(commission + papeterie) 

            // $('#transactionretrait_Montant').val(montant_total)  

        //     //Ajouter le valeur du solde

        //     var montantsolde = $('#Montant').text();

        //     var solde=parseInt(montantsolde)-parseInt(montant_total);
        //         $('#transactionretrait_solde').val(solde);
        // })

        // const code_rechercher = document.getElementById('transactionretrait_codeepargneclient');

        // code_rechercher.addEventListener('keyup',()=>{
            //     const value_input = code_rechercher.value
>>>>>>> refs/remotes/origin/main
            if(codegroupe.length == 15){
                const url_api = '/info/'+codegroupe;
            $.ajax({
                url: url_api,
                method: "GET",
                dataType : "json",
                contentType: "application/json; charset=utf-8",
                data : JSON.stringify(codegroupe),
                success: function(result){
                    for(let i= 0 ; i < result.length ;i++){
                        var element = result[i];
                        console.log(element);

                        $('#form_nom').val(element.nomGroupe)
<<<<<<< HEAD
=======
                        // $('#nom_groupe').val(element.nomGroupe)
>>>>>>> refs/remotes/origin/main
                        document.getElementById('nom_groupe').innerHTML=element.nomGroupe;
                    }
                    
                },
                error: function (request, status, error) {
                    console.log(request.responseText);
                }
                
            })    
        }
        });

    }

    if (path === '/transaction/retrait') {

<<<<<<< HEAD
        var codeepargnegroupe=$('#code_epargne_groupe').text();

        $('#transactionretrait_codeepargneclient').val(codeepargnegroupe)

        $('#transactionretrait_commission').val(0)
        $('#transactionretrait_papeterie').val(0)

        var solde=document.getElementById('solde_cli').innerHTML;

        $('#transactionretrait_Montant').on('keyup',()=>{
            var montant=$('#transactionretrait_Montant').val();

            var soldeactuel=solde-montant

            $('#transactionretrait_montant_bruite').val(montant);
            if(soldeactuel < 0){
                alert('Solde epuisé')
                $('.btn').hide()
            }else{
                $('#transactionretrait_solde').val(soldeactuel)
                $('.btn').show()
            }
        })    
=======
            var codeepargnegroupe=$('#code_epargne_groupe').text();

            $('#transactionretrait_codeepargneclient').val(codeepargnegroupe)

            $('#transactionretrait_commission').val('0')
            $('#transactionretrait_papeterie').val('0')

            var solde=document.getElementById('solde_cli').innerHTML;
            console.log(solde)
            // var montant_bruit_ = 0
            // var commission = 0
            // var papeterie = 0

            $('#transactionretrait_Montant').on('keyup',()=>{
                var montant=$('#transactionretrait_Montant').val();

                var soldeactuel=solde-montant

                $('#transactionretrait_montant_bruite').val(montant);
                if(solde <= montant){
                    $('#transactionretrait_solde').val(soldeactuel)
                }else{
                    alert('Solde epuisé')
                    $('.btn').hide()
                }
            })

        //     $('#transactionretrait_typeClient').on('change',function(){
        //     type=$(this).val()
        //     if(type == 'INDIVIDUEL'){
        //         // INDIVIDUEL
        //         $("#transactionretrait_codeepargneclient").on('keyup',(e) => {
        //             var numero = e.target.value;
        //             var url = "/api/transaction/"+numero;
                    
        //             $.ajax({
        //                 url: url,
        //                 method: "GET",
        //                 dataType : "json",
        //                 contentType: "application/json; charset=utf-8",
        //                 data : JSON.stringify(numero),
        //                 success: function(result){
        //                     for (let i = 0; i < result.length; i++) {
                            
        //                         var element = result[i];
        //                         console.log(element);
        //                         document.getElementById('text').innerHTML = "<span id=\'Montant\'>"+parseInt(element.somme_solde)+"</span>";
        //                         document.getElementById('code').innerHTML = element.code;
        //                         document.getElementById('nom').innerHTML = element.nom+" "+element.prenom;
        //                         document.getElementById('solde').innerHTML = element.somme_solde;
        //                     }
                    
        //                 },
        //                 error: function (request, status, error) {
        //                     console.log(request.responseText);
        //                 }
            
        //             });    
        //         });            

        //         // INDIVIDUEL
                
        //     }
        //     if(type == 'GROUPE'){
        //         // GROUPE
        //         $("#transactionretrait_codeepargneclient").on('keyup',(e) => {
        //             var numero = e.target.value;
        //             var url = "/api/transactiongroupe/"+numero;
                    
        //             $.ajax({
        //                 url: url,
        //                 method: "GET",
        //                 dataType : "json",
        //                 contentType: "application/json; charset=utf-8",
        //                 data : JSON.stringify(numero),
        //                 success: function(result){
        //                     for (let i = 0; i < result.length; i++) {
                            
        //                         var element = result[i];
        //                         console.log(element);
        //                         document.getElementById('text').innerHTML = "<span id=\'Montant\'>"+parseInt(element.somme_solde)+"</span>";
        //                         document.getElementById('code').innerHTML = element.code;
        //                         document.getElementById('nom').innerHTML = element.nomgroupe;
        //                         document.getElementById('solde').innerHTML = element.somme_solde;
        //                     }
                    
        //                 },
        //                 error: function (request, status, error) {
        //                     console.log(request.responseText);
        //                 }
            
        //             });    
        //         });            

        //         // GROUPE
        //     }
        // });
    
>>>>>>> refs/remotes/origin/main
    }
  
})