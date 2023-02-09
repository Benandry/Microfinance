import {Chart } from 'chart.js/auto';

import { getRelativePosition } from 'chart.js/helpers';
import $ from 'jquery';
 /*****Chart JS */

 const path = window.location.pathname;

$(document).ready(() =>{

    if(path === '/')
    {
        const ctx = document.getElementById('myChart');
        const client = $('#client').text();
        const groupe = $('#groupe').text();
        const epargne = $('#epargne').text();
        const agence = $('#agence').text();
        const credit = $('#credit').text();
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Client', 'Groupe', 'Compte Epargne', 'Compte credit','Agence'],
                datasets: [{
                label: 'Nombre total ',
                data: [client, groupe, epargne,credit,agence],
                backgroundColor: [
                    'rgba(255,99,132,0.2)',
                    'rgba(54,162,235,0.2)',
                    'rgba(255,206,86,0.2)',
                    'rgba(185,192,192,0.2)',
                    'rgba(00,192,192,0.2)',
                ],
                fill: false,
                borderColor: '#275d71',
                borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        type: 'linear',
                        min: 0,
                    }
                },
            }
        });


        const ctx2 = document.getElementById('doughnut');
        new Chart(ctx2, {
            type: 'doughnut',
            data: {
                labels: ['Client', 'Groupe', 'Compte Epargne','Compte credit', 'Agence'],
                datasets: [{
                label: 'Nombre total ',
                data: [client, groupe, epargne,credit, agence],
                backgroundColor: [
                    'rgba(255,99,132,0.2)',
                    'rgba(54,162,235,0.2)',
                    'rgba(255,206,86,0.2)',
                    'rgba(185,192,192,0.2)',
                    'rgba(00,192,192,0.2)',
                ],
                fill: false,
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54,162,235,1)',
                    'rgba(255,206,86,1)',
                    'rgba(75,192,192,1)',
                ],
                borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        type: 'linear',
                        min: 0,
                    }
                },
            }
        });
    }
})
 