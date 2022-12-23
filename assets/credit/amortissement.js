import $ from 'jquery';
const path = window.location.pathname;

$(document).ready(() => {

   $('#amortissement_fixe_principale').on('keyup',() =>{
        var total = parseFloat( $('#amortissement_fixe_principale').val()) + parseFloat($('#amortissement_fixe_interet').val());
        $('#amortissement_fixe_montanttTotal').val(total);
   })

   $('#amortissement_fixe_interet').on('keyup',() =>{
        var total = parseFloat( $('#amortissement_fixe_principale').val()) + parseFloat($('#amortissement_fixe_interet').val());
        $('#amortissement_fixe_montanttTotal').val(total);
   })
})
