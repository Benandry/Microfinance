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
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Client', 'Groupe', 'Compte Epargne', 'Agence'],
                datasets: [{
                label: 'Nombre total ',
                data: [client, groupe, epargne, agence],
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
    }
})
 