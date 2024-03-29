/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';

// start the Stimulus application
import './bootstrap';
import { Tooltip, Toast, Popover } from 'bootstrap';
import './credit/decaissement';
import './credit/amortissement';
import './credit/approbation';
import './api/retrait';
import './api/individuel';
import './api/users';
import './api/groupe';
import './api/Garant.js';
import './api/configurationcredit';
import './api/DemandeCredit';
import './api/remboursement';
import './api/penalitecredit';
import './api/Decaissement';
import './api/PasseEnPerte';
import './api/FicheCredit';
import './api/Reechelonnement';
import './api/approbation';
import './api/agence';
import './api/jquery-3.6.0';
import './api/jquery-ui';
import './api/all_rapport';
import './api/compte_epargne/compt_epargne_groupe';
import './api/compte_epargne/compte_epargne_individuel';
import './api/compte_epargne/api_rapport_releve';
import './api/compte_epargne/api_transfert';
import './api/dashboard';

//Import les api retrait ////
import './api/compte_epargne/depot'

//import les jspdf
import jsPDF from 'jspdf';
import domtoimage from "dom-to-image";



import $ from 'jquery';
import 'jquery-modal/jquery.modal'
// import 'jquery-modal';


import jsZip from 'jszip'; 
import 'pdfmake';
import 'datatables.net-buttons-dt';
import 'datatables.net-dt';
import 'datatables.net-buttons/js/buttons.html5';
import 'datatables.net-buttons/js/buttons.print';
import 'datatables.net-bs5';
import '@fortawesome/fontawesome-free/js/all';


window.JSZip = jsZip;

//*******************Variable sur le chemiin *****************/
const path = window.location.pathname;

$(document).ready(function(){

    /*******Lancer modal  */
        

    $(".table1").DataTable({
        dom:  "Bfrtip",
        buttons: [
            {
                "orientation":  "landscape",
                "extend":  "pdfHtml5",
                "pageSize":  "A3"
            },
            {
                "extend":  "excelHtml5"
            },
            ,'print'
        ],
        language: {
            search: "Rechercher&nbsp;",
            lengthMenu: "Afficher _MENU_ &eacute;l&eacute;ments",
            info: "Affichage de  _START_ a _END_ sur _TOTAL_ elements",
            paginate: {
                first:      "Premier",
                previous:   "Pr&eacute;c&eacute;dent",
                next:       "Suivant",
                last:       "Dernier"
            }
        },
        order : true,
        info : true,
        responsive : {
            "details":  true
        },
    });

    $(".table2").DataTable({
        dom: 'ftip',
        language: {
            search: "Rechercher&nbsp;",
            lengthMenu: "Afficher _MENU_ &eacute;l&eacute;ments",
            info: "Affichage de  _START_ a _END_ sur _TOTAL_ elements",
            paginate: {
                first:      "Premier",
                previous:   "Pr&eacute;c&eacute;dent",
                next:       "Suivant",
                last:       "Dernier"
            }
        }
      
    });


    $('#filtre_rapport_transaction_date1').on('keyup',()=>{
        $('#two_date').hide()
    })

    $('#filtre_rapport_transaction_Au').on('keyup',()=>{
        $('#one_date').hide()
    }) 
    $('#filtre_rapport_transaction_Du').on('keyup',()=>{
        $('#one_date').hide()
    })

    $('#individuelclient_date_naissance').on('change',(e)=>{
        var birth_ = e.target.value
        var year_birth =parseInt(birth_.slice(0,4))
        var year_now = parseInt(new Date().getFullYear())

        var age = year_now - year_birth
        $('#age').html(age+' ans  ')
       
    })

        /**********Utilisateur sur indivuduelle client******************** */
        var user_log_ = parseInt($('#user').text())
    
        $('#individuelclient_user option').each(() => {
            // alert($(this).val())
            if (user_log_ === parseInt($(this).val())) {
                $(this).attr('selected','selected')
                $(this).val(user_log_)
            }
            
        });

        // {# Cacher le champ code client#}
        $('#code').attr("style", "display: none");

        $("#filtre_rapport_solde_date1").on('change',function(){
            $('#two_date').hide();
        });

        $("#filtre_rapport_solde_Du").on('change',function(){
            $('#one_date').hide(); 
        });
        
        $("#filtre_rapport_solde_Au").on('change',function(){
            $('#one_date').hide(); 
        });


        $("#rapportcompteepargnetrie_datearrete").on('change',function(){
                        
            $('#two_date').hide();
        });

        $("#rapportcompteepargnetrie_datedebut").on('change',function(){
            $('#one_date').hide(); 
        });
        
        $("#rapportcompteepargnetrie_datefin").on('change',function(){
            $('#one_date').hide(); 
        });

        

        ///Rapport credit iray mantolo
        $("#rapport_credit_datearrete").on('change',function(){
            $('#two_date').hide();
        });

        $("#rapport_credit_datedebut").on('change',function(){
            $('#one_date').hide(); 
        });
        
        $("#rapport_credit_datefin").on('change',function(){
            $('#one_date').hide(); 
        });
        

        if(path === '/Patrimoineindividuel/patr'){
            $('#patrimoine_IdClient').val($('#id-client-ind').text());
        }

        if(path === '/agence/new'){
            let max_id_ = $('#id-max').text().padStart(2,0);
            $('#agence_codeAgence').val(max_id_);
        }

        if(path == '/Compte/Caisse/new')
        {
            const id = $('#id-max-caisse').text().padStart(3,0);
            $('#compte_caisse_codecaisse').val(id);
        }

        var carte = new jsPDF();
        /***imprimer la carte de client */
        const carte_print = document.querySelector('#carte-epargne').innerHTML;
        const code_imprimer = document.querySelector('#code_imprimer').textContent;

        // alert(code_epargne);
        const date = new Date()

        console.log(code_imprimer.length);
        $('#imprimer-carte').on('click',() => {
            console.log("carte_print");
            // Convertir le contenu HTML en PDF
            carte.html(carte_print, {
              callback: function (doc) {
                //font
                doc.setFont("times", "normal");
                // Add new page
                doc.addPage();

                // Enregistrer le fichier PDF
                if(code_imprimer.length === 10){
                    doc.save(`carte-client-${code_imprimer}${date.getFullYear()}.pdf`);
                }
                else if(code_imprimer.length === 13) {
                    doc.save(`carte-epargne-${code_imprimer}${date.getFullYear()}.pdf`);
                }

              },
              margin: [10, 10, 10, 10],
              autoPaging: 'text',
              x: 0,
              y: 0,
              width: 190, //target width in the PDF document
              windowWidth: 675 //window width in CSS pixels
            });
        })


        // alert("alert zalah ");

        // $('#imprimer-carte').on('click',() => {
        //     alert("alert zalah ");

        //     const render = node => {
                
        //         domtoimage.toPng(node)
        //         .then(function (dataUrl) {
        //                 var img = new Image();
        //                 img.src = dataUrl;
        //                 document.body.appendChild(img);
        //         })
        //         .catch(error => {
        //             console.error(error,"Error zoky eee");
        //         })
        //     }
        //     const node = document.querySelector('#carte-epargne');
        //     render(node);
        // });
        
});

