

jQuery(document).ready(function($) {

  var $counter = $('input[type="radio"]:checked').length;
  var $originQuestions = $('#questioncount').text();
  console.log($originQuestions);
  

  $(".testafleggenpag input:radio").on("change", function() {
    updateCounter();
  });

  function updateCounter(){
    var $counter = $('input[type="radio"]:checked').length;
    var $remaining = $originQuestions - $counter;
    console.log($counter);
    $('.questioncount').text($remaining);
  }

});
