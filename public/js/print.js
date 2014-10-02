/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function printDiv(divName) {
      var printContents = document.getElementById(divName).innerHTML;     
   var originalContents = document.body.innerHTML;       
   document.body.innerHTML = printContents;      
   window.print();      
   document.body.innerHTML = originalContents;
   }

$(document).ready(function() {
  
  console.log('test');

  $('.printMe').click(function(){
    printDiv('outprint');
  });

});