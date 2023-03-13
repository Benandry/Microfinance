import $ from 'jquery'

var path = window.location.pathname;

$(document).ready(function(){
    // L'evenement se produit durant le choix du type client
    if( path == '/DemandeCredit/Modal/'){

        // Les champs code client et groupe sont cachées
        $('#codeclient').hide();
        $('#codegroupe').hide();

        $('#demande_credit_modal_TypeClient').on('change',function(){
            var typeclient=$('#demande_credit_modal_TypeClient').val();

            // Type client individuel

            if(typeclient == 'INDIVIDUEL'){
                $('#codeclient').show();
                $('#codegroupe').hide();
                
                // Si l'utilasateur choisi une client
                $('#demande_credit_modal_CodeClient').on('change',function(){
                    var codeindividuel=$('#demande_credit_modal_CodeClient').val();
                    // console.log("Code client"+codeclient);
                    
                    // Chemin de recuperation du code client
                    var url_individuel='/modaldemandecredit/'+codeindividuel;
                    // console.log(url_individuel);

                    $.ajax({
                        url:url_individuel,
                        method:'GET',
                        dataType:"json",
                        contentType:"application/json; charset=utf-8",
                        data : JSON.stringify(codeindividuel),   
                        success : function(content){
                            for(let j=0;j<content.length;j++){    
                                var individuel=content[j];

                                $('#demande_credit_modal_nom').val(individuel.nom_client)
                                $('#demande_credit_modal_prenom').val(individuel.prenom_client)
                                $('#demande_credit_modal_codeclient').val(individuel.codeclient)
                                // console.log(individuel);
                            }
                        }
                    });

                    
                });
            }
            // Type client groupe
            else if(typeclient == 'GROUPE'){
                $('#codegroupe').show();
                $('#codeclient').hide();

                $('#demande_credit_modal_CodeGroupe').on('change',function(){
                    // Id groupe
                    var idgroupe=$('#demande_credit_modal_CodeGroupe').val();

                    var url_groupe='/demandecreditinfogroupe/'+idgroupe;

                    $.ajax({
                        url:url_groupe,
                        method:'GET',
                        dataType:"json",
                        contentType:"application/json; charset=utf-8",
                        data : JSON.stringify(idgroupe),   
                        success : function(content){
                            for(let j=0;j<content.length;j++){    
                                var groupe=content[j];

                                $('#demande_credit_modal_nomgroupe').val(groupe.nomGroupe);
                                $('#demande_credit_modal_codegroupe').val(groupe.codegroupe);
                                // console.log(individuel);
                            }
                        }
                    });

                })
            }
        })
    }
    // L'evenemement se  produit a l'interieur de cette chemin
    if( path === '/demande/credit/new'){             
                // Cycle de credit
                $('#patrimoine').hide();
                // L'affichage du nom est caché en premier
                    //  $('#individuel').hide();
                    //  $('#groupe').hide();
                    //  $('#garant').hide();
                // L'utilisateur tape sur le champ code client
                $('#demande_credit_codeclient').on('blur',function(){
                    // Code client
                    var codeclient=$('#demande_credit_codeclient').val();
                    var typeclient=$('#demande_credit_TypeClient').val();
                    
                    // Test si le type soit individuel ou groupe

                    // Si client individuel
                    if(typeclient == 'INDIVIDUEL'){

                    // url
                    var url_client='/infodemande/credit/individuel/'+codeclient;
                    // Ajax
                    $.ajax({
                        url:url_client,
                        method:'GET',
                        dataType:"json",
                        contentType:"application/json; charset=utf-8",
                        data : JSON.stringify(codeclient),   
                        success : function(content){
                            for(let j=0;j<content.length;j++){    
                               var individuel=content[j];

                               var codeclient=individuel.codeclient;
                               var nomclient=individuel.nom_client;
                               var prenom=individuel.prenom_client;

                            //    Affichage du nom client
                               document.getElementById('codeclientindividuel').innerHTML=codeclient;
                               document.getElementById('nom').innerHTML=nomclient;
                               document.getElementById('prenom').innerHTML=prenom;

                            // Affichage du bloc nom et prenom
                            $('#individuel').show();
                                
                            }
                        }
                    });
                }
                else if(typeclient == 'GROUPE'){

                    // url
                    var url_groupe='/infodemandecredit/groupe/'+codeclient;
                    // Ajax
                    $.ajax({
                        url:url_groupe,
                        method:'GET',
                        dataType:"json",
                        contentType:"application/json; charset=utf-8",
                        data : JSON.stringify(codeclient),   
                        success : function(content){
                            for(let j=0;j<content.length;j++){    
                                var groupe=content[j];
                                
                                var nomgroupe=groupe.nomGroupe;

                            //    Affichage du nom client
                                document.getElementById('nom_groupe').innerHTML=nomgroupe;

                            // Affichage du bloc nom et prenom
                            $('#groupe').show();
                                
                            }
                        }
                    });
                    
                }
                });

                // Si le produit credit demande des garants
                $('#demande_credit_garant').on('blur',function(){

                    // Recuperation des garants

                    var garant=$('#demande_credit_garant').val();

                    // Url
                    var url_garant='/infogarant/individuelclient/'+garant;

                    // Ajax
                    $.ajax({
                        url:url_garant,
                        method:'GET',
                        dataType:"json",
                        contentType:"application/json; charset=utf-8",
                        data : JSON.stringify(garant),   
                        success : function(content){
                            for(let j=0;j<content.length;j++){    
                                var garant=content[j];
                                console.log(garant.codeclient);

                                // Affichage du nom client

                                var codeclient=garant.codeclient;
                                var nomclient=garant.nom_client;
                                var prenomclient=garant.prenom_client;
                                var cin=garant.cin;

                            // Si les contenu dans le code client,nom client,prenom client,cin sont
                            // vide
                            if(codeclient != ""){

                                document.getElementById('codeclient').innerHTML=codeclient;
                                document.getElementById('nomgarant').innerHTML=nomclient;
                                document.getElementById('prenomgarant').innerHTML=prenomclient;
                                document.getElementById('cin').innerHTML=cin;      
                                $('#garant').show();
                            }
                            else {
                                $('#garant').hide();
                            }
                            }
                        }

                    });


                });

        // On va mettre automatiquement la date machine
                // Date automatique

        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0');
        var yyyy = today.getFullYear();
        
        // today = mm + '/' + dd + '/' + yyyy;
        today = yyyy +'-' +mm + '-' + dd;

        $("#demande_credit_DateDemande").val(today);

          // Si l'utilisateur selectionne individuel on affiche I sinon G
          $('#demande_credit_TypeClient').on('change',function(){
            var client = $('#demande_credit_TypeClient').val();

          })
        

        // Si l'utilisateur selectionne une produit credit
        // Touts les configuration correspondantes sera affiché automatiquement
        $('#demande_credit_ProduitCredit').on('change',function(){

            // on recupere le type client
            var typeclient=document.getElementById('typeclient').innerHTML;

            // On insere la type client

            $('#demande_credit_TypeClient').val(typeclient);

            // Recuperer la derinier id en demande
            var derniernumero=$('#lastnumero').text();
            // Recuperer code agence
            var codeagence = $('#codeagence').text();
            
            // On incremente la derniere id
            derniernumero++;

            // convertir en zerofill
            var pad_last_id=derniernumero.toString().padStart(7,0);

            // on aura le code credit
            var numerocredit=codeagence+pad_last_id;

            if(typeclient == 'INDIVIDUEL'){ 
                $('#demande_credit_codeclient').val('I');
                $('#demande_credit_NumeroCredit').val('I'+numerocredit);
            }
            else if(typeclient == 'GROUPE'){
                $('#demande_credit_codeclient').val('G');
                $('#demande_credit_NumeroCredit').val('G'+numerocredit);

            }  
            
            
            // On recupere le code client
            var codeclient= document.getElementById('codeclient').innerHTML;

            // console.log('code client'+codeclient);

            $('#demande_credit_codeclient').val(codeclient);


            // On recupere le produit credit

            var produitcredit=$('#demande_credit_ProduitCredit').val();

            // On recupere l'url
            var url='/demandecredit/credit/'+produitcredit;

            // Ajax

            $.ajax({
                url:url,
                method:'GET',
                dataType:"json",
                contentType:"application/json; charset=utf-8",
                data : JSON.stringify(produitcredit),
                success : function(content){
                    for(let j=0;j<content.length;j++){
                        var config=content[j];
                        // console.log(config);

                        // Recuperation du taux garantie financiere
                        var tauxgarantiefinanciere=config.TauxGarantieFinanciere;


                        // Afficher le nombre tranche 
                        $('#demande_credit_NombreTranche').val(config.Tranche);
                        // Afficher la methode
                        $('#demande_credit_TypeTranche').val(config.Methode);
                        // Taux interet annuel
                        $('#demande_credit_TauxInteretAnnuel').val(config.InteretNormal);
                        // Plage montant
                        $('#demande_credit_Montant').val(config.MontantMin+'<= Montant <='+config.Montant);

                        // Verification montant taper par l'utilisateur
                        $('#demande_credit_Montant').on('blur',function(){
                            var montant=$('#demande_credit_Montant').val();

                            // Si le montant taper par l'utilisateur n'est pas dans le plage
                            // de [Montantmin,MontantMax]  
                            if(montant < config.MontantMin || montant > config.Montant ){
                                alert('Montant refusé');
                                $('.btn').hide();
                            }
                        });

                            // Test garantie
                            // Si le garantie financiere est vrai
                            if(config.GarantieFinanciere == true){
                                
                                // On affiche le champ à remplir pour le garantie financiere
                                $('#garantiefinanciere').show();

                                // L'utilisateur tape sur le compte epargne
                                $('#demande_credit_CompteEpargne').on('blur',function(){
                                    // On recupere le compte epargne
                                    var compteepargne=$('#demande_credit_CompteEpargne').val();
                                    // Recuperation numero client
                                    var codeclient=$('#demande_credit_codeclient').val();

                                                // url
                                        var url_demande='/api/demandecredit/'+compteepargne;
                                        
                                        // ajax
                                        $.ajax({
                                            url:url_demande,
                                            method:'GET',
                                            dataType:"json",
                                            contentType:"application/json; charset=utf-8",
                                            data : JSON.stringify(compteepargne),
                                            success : function(content){
                                                for(let j=0;j<content.length;j++){
                                                    var garantiefinanciere=content[j];

                                                        // Si le compte epargne n'est pas un depot de garantie
                                                        var compteepargne=garantiefinanciere.nomproduit;
                                                        if( compteepargne != "D\u00e9p\u00f4ts de garantie"){
                                                            alert("Vous n'avez pas de depot de garantie");
                                                            $('.btn').hide();
                                                        }

                                                        // Si le code client taper sur le champ code client est different
                                                        // de celui de
                                                    
                                                        if(codeclient == garantiefinanciere.codeclient){
                                                            $('#demande_credit_SoldeEpargne').val(garantiefinanciere.solde);
                                                        }
                                                        else{
                                                            alert('Deux compte differente');
                                                            $('.btn').hide();
                                                        }

                                                        // Si le solde du compte epargne est inferieur a celui du demande
                                                        var solde=garantiefinanciere.solde;
                                                        var montant=$('#demande_credit_Montant').val();
                                                        // Regle de 3  sur le pourcentage solde
                                                        // montant->100%
                                                        // solde->?
                                                        var pourcentagesolde=solde*100/montant;

                                                        console.log(pourcentagesolde+" "+tauxgarantiefinanciere);

                                                        // Si le pourcetage solde est inferieur au config
                                                        if(pourcentagesolde < tauxgarantiefinanciere){
                                                            alert('Le montant demandé est plus de '+tauxgarantiefinanciere+' % par rapport au demande');
                                                            $('.btn').hide();
                                                        }
                                                         
                                                }
                                            }                    
                                        });

                                })

                             
                            }
                            // Garantie moral
                            if( config.GarantieMoral == true){
                                // On affiche le champ à remplir pour le garantie Moral
                                $('#garantiemorale').show();
                            }
                    }
                }


            })
        });
    }
})