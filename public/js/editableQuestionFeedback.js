$(document).ready(function() {
      $('.subcats').each(function(idx) {
        if ($(this).children().length === 0) {
          $(this).append('<li class="list-group-item-warning list-group-item">Geen aanpasbare vragen aanwezig.</li>');
        }
      });
    });