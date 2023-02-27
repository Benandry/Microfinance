import $ from 'jquery'

var path = window.location.pathname

$(document).ready(() =>{
     /********Cache les info */
    if (path === '/compte/epargne/new') {
        //Depot de garantie
        const type_compte = $('#compte-type').html();
        
        $('#compte_epargne_produit').children('option').remove();
        if (type_compte === 'garantie') {  
            $.ajax({
                url : '/api/json/produit',
                method : "GET",
                dataType : "json",
                contentType: "application/json; charset=utf-8",
                data : JSON.stringify($(this).val()),
                success : (result) =>  {
                    for(let i = 0; i < result.length; i++){
                        var element = result[i];
                        console.log(element);
                        $('#compte_epargne_produit').append('<option value="'+element.id+'" selected>'+element.nomproduit+'</option>');
                    }
                }
            });
        }else{
            $.ajax({
                url : '/api/json/produit/all',
                method : "GET",
                dataType : "json",
                contentType: "application/json; charset=utf-8",
                data : JSON.stringify($(this).val()),
                success : (result) =>  {
                    $('#compte_epargne_produit').children('option').remove();
                    for(let i = 0; i < result.length; i++){
                        var element = result[i];
                        console.log(element);
                        $('#compte_epargne_produit').append('<option value="'+element.id+'">'+element.nomproduit+' 898898989</option>');
                    }
                }
            });
        }
       




        const modal_container = document.getElementById('modal-container');
        const modal_text = document.getElementById('modal-text');
        const close_btn = document.querySelector('#close-btn');
        close_btn.addEventListener('click',() => {
            modal_container.style.display = "none";
        })

        window.addEventListener('click',e => {
            if (e.target === modal_container) {
                modal_container.style.display = "none";
            }
        })

        $("#compte_epargne_produit").on('change',function(){
            const api_produit = '/api/compte-epargne/individuel/'+$(this).val();
            /** information sur les configuration epargne */
            $('.btn').show();
            $.ajax({
                url : api_produit,
                method : "GET",
                dataType : "json",
                contentType: "application/json; charset=utf-8",
                data : JSON.stringify($(this).val()),
                success : (result) =>  {
                    for(let i = 0; i < result.length; i++){
                        
                        var element = result[i];
                        const year_client = $('#age_client').text();
                        console.log(element);
                        if( element.age_minimum_ouvrir_compte  > year_client ){
                            modal_text.textContent = "On ne peut creer un compte epargne pour cette produits car l'age de client assez moins";
                            modal_container.style.display = "block";
                            modal_text.style.color = "red";
                            $('.btn').hide();
                        }
                    }
                },
                error: function (request, status, error) {
                    console.log(request.responseText);
                }
            });
            // modal_text.textContent = "Produits epargne";
           
        });


        var code_client_ = $('#code_client').text()
        var nom_client_ = $('#nom').text()
        var prenom_client_ = $('#prenom').text()

        $('#compte_epargne_codeep').val(code_client_)
        $('#compte_epargne_nom').val(nom_client_)
        $('#compte_epargne_prenom').val(prenom_client_)

        /***************************Code compte epargne************************ */
        $("#compte_epargne_produit").on('change',function(){

            // Veriifier les produit pour creer un compte epargne 
            var url = "/api/individuel/"+$(this).val();
    
            $.ajax({
                url: url,
                method: "GET",
                dataType : "json",
                contentType: "application/json; charset=utf-8",
                data : JSON.stringify($(this).val()),
                success: function(result){
                    for (let i = 0; i < result.length; i++) {
                        var element = result[i];
                        // console.log(element);
                        document.getElementById('text').innerHTML ="<span id=\'id_prod\'>"+element.Produit_id.toString().padStart(3,0)+"</span>";
                        var id_produits = $('#id_prod').text();
                        $('#compte_epargne_codeepargne').val(code_client_+id_produits);
                    }
            
                },
                error: function (request, status, error) {
                    console.log(request.responseText);
                }
    
            }); 
            
            $('#code_text').text(code_client_)        
        });
    }
    else if(path === "/CompteEpargneDepot" || path ==='/depot/epargne/groupe' || path === '/transaction/retrait/individuel' || path === '/transaction/retrait/groupe')
    {           
        $.ajax({
            url: '/client/epargne/tous',
            method: "GET",
            dataType : "json",
            contentType: "application/json; charset=utf-8",
            data : JSON.stringify(),
            success: function(result){
                $('#form_code').children('option').remove();
                for (let i = 0; i < result.length; i++) {
                    var element = result[i];
                        console.log(element);
                        if(element.typeClient == 'GROUPE'){
                            $('#form_code').append('<option value="'+element.id+'">'+element.nomGroupe+' '+ element.codeepargne+'</option>'); 
                        }else{
                            $('#form_code').append('<option value="'+element.id+'">'+element.nom_client+' '+element.prenom_client+' '+element.codeepargne+'</option>'); 
                        }
                        
                }
            },
            error: function (request, status, error) {
                console.log(request.responseText);
            }

        }); 
    }
     //Information du client pour ouvrir un compte epargne
    if(path === '/ouvrirCompteEpargneClient'){
        $('#form_code').on('change',() => {
            // alert("alert");
            var url = "/api/code-client/"+$('#form_code').val();
                
            $.ajax({
                url: url,
                method: "GET",
                dataType : "json",
                contentType: "application/json; charset=utf-8",
                data : JSON.stringify($(this).val()),
                success: function(result){
                    console.log(result);
                    for (let i = 0; i < result.length; i++) {
                       
                        var element = result[i];
                            // console.log(element);
                            document.getElementById('codeclient').innerHTML = element.codeclient;
                            document.getElementById('nom').innerHTML = element.nom;
                            document.getElementById('prenom').innerHTML = element.prenom;
                            
                    }
                },
                error: function (request, status, error) {
                    console.log(request.responseText);
                }
    
            });    
        })
    }
})