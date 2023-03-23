import $ from 'jquery'

const path=window.location.pathname;

$(document).ready(function(){
    // Chemin sur le modal
    if(path == '/Reechelonnement/Individuel'){  

            $('.btn').hide();
        $('#reechelonnement_modal_CodeCredit').on('change',function(){
            // Recuperation des id credit
            var idcredit=$('#reechelonnement_modal_CodeCredit').val();
            
            // Recuperation des urls
            var url_reechelonnement='/Reechelonnement/Modal/'+idcredit;

            // Ajax
            $.ajax({
                url:url_reechelonnement,
                method:'GET',
                dataType:"json",
                contentType:"application/json; charset=utf-8",
                data:JSON.stringify(idcredit),
                success:function(content){
                    for(let j=0;j<content.length;j++){
                        var reechelonner=content[j];
                        console.log(reechelonner);
                        $('#reechelonnement_modal_nom').val(reechelonner.nom_client);
                        $('#reechelonnement_modal_prenom').val(reechelonner.prenom_client);
                        $('#reechelonnement_modal_codeclient').val(reechelonner.numeroCredit);
                        $('#reechelonnement_modal_NumeroCredit').val(reechelonner.numeroCredit);
                        $('#reechelonnement_modal_MontantDecaisser').val(reechelonner.montantCredit);
                        $('#reechelonnement_modal_InteretCredit').val(reechelonner.TauxInteretAnnuel);
                        $('#reechelonnement_modal_DernierPeriode').val(reechelonner.dernierperioderemb);
                        $('.btn').show();
                    }   
                }

            });

            // Recuperation des somme des credit deja rembourser
                        // Recuperation des urls
                        var url_somme_credit='/sommecredit/Modal/'+idcredit;

                        // Ajax
                        $.ajax({
                            url:url_somme_credit,
                            method:'GET',
                            dataType:"json",
                            contentType:"application/json; charset=utf-8",
                            data:JSON.stringify(idcredit),
                            success:function(content){
                                for(let j=0;j<content.length;j++){
                                    var sommecredit=content[j];
                                    console.log(sommecredit);
                                    $('#reechelonnement_modal_SommeDejaRembourser').val(sommecredit.sommerembourser);
                                    $('#reechelonnement_modal_Periode').val(sommecredit.NombreTranche);
                                    $('#reechelonnement_modal_ResteCapital').val(sommecredit.totalcapital);
                                    $('#reechelonnement_modal_ResteInteret').val(sommecredit.totalinteret);
                                    $('.btn').show();
                                }   
                            }
            
                        });
            


        });
    }
    // Chemin sur le reechelonnement
    if( path == '/Reechelonnment/Controller/Individuel/' ){
                // Date automatique

                var today = new Date();
                var dd = String(today.getDate()).padStart(2, '0');
                var mm = String(today.getMonth() + 1).padStart(2, '0');
                var yyy = today.getFullYear();
        
        
              
                today = mm + '/' + dd + '/' + yyy;
                today = yyy +'-' +mm + '-' + dd;
        
                today=yyy+'-'+mm+'-'+dd;

                $('#reechelonnement_credit_DateDuJour').val(today);
                //  Recuperer les affichage
                var codeclient=document.getElementById('codeclient').innerHTML;
                var codecredit=document.getElementById('codecredit').innerHTML;
                // Affichege du numero credit sur le formulaire
                $('#reechelonnement_credit_DateReechelonner').on('blur',function(){
                    $('#reechelonnement_credit_NumeroCredit').val(codeclient);
                    $('#reechelonnement_credit_CodeClient').val(codecredit);
                });

        
    }
});