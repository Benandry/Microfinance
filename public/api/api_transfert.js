// api pour les destinataire

$(document).ready(function(){
        
    $("#transfertep_codedestinateur").on('keyup',function(){

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
                        document.getElementById('textdest').innerHTML = "<span id='soldedes'>"+parseInt(element.soldedestinateur)+"</span>";
                        document.getElementById('nomdest').innerHTML = "<span id='nomcldest'>"+element.nom_client+"</span>";
                        document.getElementById('prenomdest').innerHTML = "<span id='prenomcldest'>"+element.prenom_client+"</span>";

                        var solded = $('#soldedes').text();
                        var nom=$('#nomcldest').text();
                        var prenom=$('#prenomcldest').text();
                    
                             $('#transfertep_nomdestinatare').val(nom);
                             $('#transfertep_prenomdestinataire').val(prenom);
                             $('#transfertep_soldedestinataire').val(solded);
                }
            },
            error: function (request, status, error) {
                console.log(request.responseText);
            }

        });    
    });

$('#transfertep_montantdestinataire').on('keyup',function(){
        var Montant=$(this).val();
         var solde = $('#soldedes').text();
         var nouveausolde=parseInt(solde)+parseInt(Montant);
        //  var soldedestinataire = $('#envoyeur').text();

         $('#transfertep_soldedestinataire').val(parseInt(nouveausolde));


    //      var solde=parseInt(montantsolde)-parseInt(Montant);
    //          $('#transfert_codetransaction').val(solde);

    });
    
});


// Envoyeur : on trouve ici les solde des envoyeurs

$(document).ready(function(){

        
    $("#transfertep_codeenvoyeur").on('keyup',function(){

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
                    document.getElementById('text3').innerHTML = "<span id='soldeenvoyeur'>"+parseInt(element.soldedestinateur)+"</span>";
                    document.getElementById('nomenv').innerHTML = "<span id='nomclient'>"+element.nom_client+"</span>";
                    document.getElementById('prenomenv').innerHTML = "<span id='prenomclientenv'>"+(element.prenom_client)+"</span>";

                    var solde=$('#soldeenvoyeur').text();
                    var nomclient=$('#nomclient').text();
                    var prenomclient=$('#prenomclientenv').text();

                    $('#transfertep_nomenvoyeur').val(nomclient);
                    $('#transfertep_prenomenvoyeur').val(prenomclient);
                    $('#transfertep_soldeenvoyeur').val(solde);
                    
                }
            },
            error: function (request, status, error) {
                console.log(request.responseText);
            }

        });    
    });
    

    $('#transfertep_montantdestinataire').on('keyup',function(){
        var Montant=$(this).val();
         var soldeenvoyeur = $('#soldeenvoyeur').text();
         var nouveausolde=parseInt(soldeenvoyeur)-parseInt(Montant);

         $('#transfertep_soldeenvoyeur').val(nouveausolde);
    });
});