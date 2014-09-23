//initialize tinymce op textarea.allowcode


$(document).ready(function() {

  tinymce.init({menubar: true, skin: 'bootstrap', toolbar: "", statusbar: false, selector: 'textarea.allowcode', paste_as_text: true, plugins: "visualblocks"});


  var $answers = $(".answers"); //antwoorden wrapper
  var $correctAns = $("#correctant"); //correct antw Select box
  var $addButton = $("#AddAnswer"); //Add button ID

  //var x               = $antwoorden.length; //aantal initiele anwtoordvelden
  var count = 2; //minimaal 2 antwoorden aanwezig

  $addButton.click(function(e)  //on add input button click
  {
    ++count;

    //add input box
    var strNewAnswer = '<div class="panel panel-default">';
    strNewAnswer += '<div class="panel-body">'
    strNewAnswer += '<div class="form-group">'
    strNewAnswer += '<label for="antwoord[]" class="col-md-3 control-label">Antwoord ' + count + ':</label>   '
    strNewAnswer += ' <div class="col-md-9">'
    strNewAnswer += '   <textarea name="antwoord[]" id="antwoord' + count + '" class="form-control allowcode" placeholder="vul hier een antwoord in."></textarea> '
    strNewAnswer += '  </div>'
    strNewAnswer += '   </div>'
    strNewAnswer += '   <div class="form-group">'
    strNewAnswer += ' <label class="col-md-3 control-label">Afbeelding antwoord ' + count + ':</label>'
    strNewAnswer += '<div class="col-md-6">'
    strNewAnswer += '<div class="input-group">'
    strNewAnswer += ' <span class="input-group-btn">'
    strNewAnswer += '<span class="btn btn-default btn-file">'
    strNewAnswer += 'Bladeren... '
    strNewAnswer += '    <input type="file" name="answerMedia[]" class="form-control" />'
    strNewAnswer += '   </span>'
    strNewAnswer += ' </span>'
    strNewAnswer += ' <input type="text" class="form-control" readonly>'
    strNewAnswer += ' </div>'
    strNewAnswer += ' </div>'
    strNewAnswer += '</div>'
    strNewAnswer += ' </div></div>';
    console.log(strNewAnswer);
    var $newAnswer = $(strNewAnswer);
    $answers.append($newAnswer);

    //toevoegen option in correct antwoord select
    $correctAns.append('<option value="' + (count - 1) + '">Antwoord ' + count + '</option>');

    //herinitialise tinymce op textarea.allowcode
    tinymce.init({menubar: true, skin: 'bootstrap', toolbar: "", statusbar: false, selector: 'textarea.allowcode', paste_as_text: true, plugins: "visualblocks"});

  });
  
  


});
