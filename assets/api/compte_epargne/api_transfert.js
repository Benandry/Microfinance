import $ from 'jquery'

const path = window.location.pathname

$(document).ready(() =>{
    
    if (path === '/transfertep/new') {
        $("#transfertep_codedestinateur").on('change',function(){

            console.log($(this).val());
            var url = "/api/transfert/"+$(this).val();

            $.ajax({
                url: url,
                method: "GET",
                dataType : "json",
                contentType: "application/json; charset=utf-8",
                data : JSON.stringify($(this).val()),
                success: function(result){
                    for (let i = 0; i < result.length; i++) {
                       
                        var element = result[i];
                        document.getElementById('solde_dest').innerHTML = parseInt(element.soldedestinateur);

                        $('#transfertep_nomdestinatare').val(element.nom_client);
                        $('#transfertep_prenomdestinataire').val(element.prenom_client);
                        $('#transfertep_receveur').val(element.codedestinateur);
                    }
                },
                error: function (request, status, error) {
                    console.log(request.responseText);
                }
    
            });    
        });

        $('#transfertep_montantdestinataire').on('keyup',function(){
            var Montant=$('#transfertep_montantdestinataire').val();

            var soldeenv = document.getElementById('solde_env').innerHTML;
            var soldeactuel = parseInt(soldeenv)-parseInt(Montant);

            $('#transfertep_soldeenvoyeur').val(soldeactuel);

            var soldedest = document.getElementById('solde_dest').innerHTML;
            var soldeactuel = parseInt(soldedest)+parseInt(Montant);
            $('#transfertep_soldedestinataire').val(soldeactuel);
            
        });

        $("#transfertep_codeenvoyeur").on('change',function(){
            console.log($(this).val());
            var url = "/api/transfert/"+$(this).val();
    
            console.log(url);
            $.ajax({
                url: url,
                method: "GET",
                dataType : "json",
                contentType: "application/json; charset=utf-8",
                data : JSON.stringify($(this).val()),
                success: function(result){
                    for (let i = 0; i < result.length; i++) {
                       
                        var element = result[i];
                        console.log(element);
                        document.getElementById('solde_env').innerHTML = +parseInt(element.soldedestinateur);
                        
                        $('#transfertep_nomenvoyeur').val(element.nom_client);
                        $('#transfertep_prenomenvoyeur').val(element.prenom_client);
                        $('#transfertep_expediteur').val(element.codedestinateur);
                        
                    }
                },
                error: function (request, status, error) {
                    console.log(request.responseText);
                }
    
            });    
        });
    }
})