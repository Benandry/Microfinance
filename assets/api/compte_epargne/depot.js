import $ from 'jquery'
//import 'jquery-modal'

var path = window.location.pathname

$(document).ready(() =>{

    if (path === '/transaction/new') {
        
        var code_client = $('#code_client').text()
        $('#transaction_codeepargneclient').val(code_client)

        var nom = $('#nom').text()
        $('#transaction_nom').val(nom)

        var nom = $('#prenom').text()
        $('#transaction_prenom').val(nom)

        var solde = $('#solde_cli').text()
        $('#transaction_donneessolde').val(solde)



        var montant_bruit_ = 0
        var commission= 0
        var papeterie = 0

        $('#transaction_montant_bruite').on('keyup',()=>{
            montant_bruit_= $('#transaction_montant_bruite').val();
           // alert(": I010000015")
            console.log(montant_bruit_);
        })

        $('#transaction_commission').val(0)
        $('#transaction_commission').on('change',()=>{
            commission=$('#transaction_commission').val();
            // alert(commission);
        })

        $('#transaction_papeterie').val(0)
        $('#transaction_papeterie').on('keyup',() =>{
            papeterie = $('#transaction_papeterie').val()
            var montant_total = parseInt(montant_bruit_) -(parseInt(commission) + parseInt(papeterie))

                //lert("mETY VEE")
            $('#transaction_Montant').val(montant_total)
            
            //Ajouter valeur sur la formulaire solde
            var solde = montant_total + parseInt($('#solde_cli').text())

            $('#transaction_solde').val(solde)
        })


    }

    if(path === '/CompteEpargneDepot'){

        /***MOdal */
        //************************* api_suggestion **************************
        /******************************************************************** */
        const code_rechercher = document.getElementById('form_code');

        const url_api = '/api/epargne'
        code_rechercher.addEventListener('keyup',()=>{
        const value_input = code_rechercher.value
            
            $.ajax({
                url: url_api,
                method: "GET",
                dataType : "json",
                contentType: "application/json; charset=utf-8",
                data : JSON.stringify(),
                success: function(result){
                    
                    const getValue = result.filter(i => i.code.toLocaleLowerCase().includes(value_input.toLocaleLowerCase()))

                    var suggestion = ''

                    if( value_input != '' ){
                        getValue.forEach(resultItem =>{
                        
                        suggestion += `<div class="suggestion">${resultItem.code}</div>`
                        })
                    }else{
                        suggestion = '<div class="suggestion"> Pas de compte</div>'
                    }
                    
                    document.getElementById('code_suggest').innerHTML = suggestion
                
            
                },
                error: function (request, status, error) {
                    console.log(request.responseText);
                }

            });    
        })



        
        $('#form_code').on('keyup',()=>{
            var code = $('#form_code').val()
            console.log(code);

            if (code.length === 15) {
                var url = '/info/'+code
                $.ajax({
                    url: url,
                    method: "GET",
                    dataType : "json",
                    contentType: "application/json; charset=utf-8",
                    data : JSON.stringify(code),
                    success: function(result){
                        for(let i = 0; i < result.length; i++){
                            var element = result[i]
                            
                            console.log(element);
                            if(element !== '' ){
                                console.log(element)
                                $('#form_nom').val(element.nom_client)
                                $('#form_prenom').val(element.prenom_client)
                                $('#form_produit').val(element.nomproduit)
                                $('#form_code_client').val(element.client_code)
                    
                                $('#code_cli').text(element.client_code)
                                $('#code_ep').text(element.code)
                                $('#produit').text(element.nomproduit)
                                $('#nom_cli').text(element.nom_client)
                                $('#prenom_cli').text(element.prenom_client)
                            }else{
                                console.log(element)
                                $('#form_nom').val("Pas de client")
                                $('#form_prenom').val("Pas de client")
                            }
                               
                        }
                    },
                    error: function (request, status, error) {
                        console.log(request.responseText);
                    }
            
                })    
            }
        
        })

    }
})