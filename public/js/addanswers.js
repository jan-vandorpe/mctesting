//event
function removeAnswer(e) {
  console.log(e);
  e.parent().parent().hide('slow', function() {
    e.parent().parent().remove();
    updateAnswers();
    $("#correctant").children().last().remove();
  });

}
function resetInput(e) {
  var $el = e.parent().find('input[type="file"]');
  $el.wrap('<form>').closest('form').get(0).reset();
  $el.unwrap();
  $el.parents('.input-group').find(':text').val('');
}
function isEven(n) {
  n = Number(n);
  return n === 0 || !!(n && !(n % 2));
}

function updateAnswers() {
  console.log($('.answer-label').text());
  var $aLabels = $('.answer-label').text(function(index) {
    return "Antwoord " + (index + 1) + ":";
  });
}


function inputButtonBootstrap() {
  $(document).on('change', '.btn-file :file', function() {
    var input = $(this),
            numFiles = input.get(0).files ? input.get(0).files.length : 1,
            label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
    input.trigger('fileselect', [numFiles, label]);
  });

  $(document).ready(function() {
    $('.btn-file :file').on('fileselect', function(event, numFiles, label) {

      var input = $(this).parents('.input-group').find(':text'),
              log = numFiles > 1 ? numFiles + ' files selected' : label;

      if (input.length) {
        input.val(log);
      } else {
        if (log)
          alert(log);
      }

    });
  });
}



//vvv DOC READY STUFF vvv//
$(document).ready(function() {

  //remove answer button event handler attaching
  $removeButtons = $('.remove-answer');
  $removeButtons.each(function(idx) {
    $(this).click(function() {
      removeAnswer($(this));
    });
  });

  //event handlers on input resets on createquestion
  $resets = $('.reset-input');
  $resets.each(function() {
    $(this).click(function() {
      resetInput($(this));
    });
  });

  //initialize tinymce op textarea.allowcode
  tinymce.init({
    menubar: true,
    skin: 'bootstrap',
    toolbar: "",
    statusbar: true,
    selector: 'textarea.allowcode',
    paste_as_text: true,
    plugins: "visualblocks"
  });


  var $answers = $(".answers"); //antwoorden wrapper
  var $correctAns = $("#correctant"); //correct antw Select box
  var $addButton = $("#AddAnswer"); //Add button ID
  var $editAddButton = $('#editAddAnswer'); //add button on edit form

  //var x               = $antwoorden.length; //aantal initiele anwtoordvelden
  var count = $(".answers > div").length;
  var valCount
  console.log(count);

  $editAddButton.click(function(e) {
    valCount = $(".answers > div").length;
    ++valCount;
    ++count;

    //add input box
    var strNewAnswer = '<div class="panel panel-default">';
    strNewAnswer += '<div class="panel-body"><div class="form-group"><label for="antwoord[]" class="col-sm-3 control-label label-padding answer-label">Antwoord ' + count + ':</label>';
    strNewAnswer += '<div class="col-sm-9"><textarea name="antwoord[]" id="antwoord' + count + '" class="form-control allowcode" placeholder="vul hier een antwoord in.">';
    strNewAnswer += '</textarea></div></div><div class="form-group" id="AnswerMediaBlock' + count + '"><div class="pull-right" id="imgPreview' + count + '" style="padding-right:2em">';
    strNewAnswer += '<figure class="thumbnail preview-figure btn" onclick="resetInputForm(\'imgPreview' + count + '\', \'AnswerUpload' + count + '\');"><img id="imgPreview' + count + 'img" src="/mctesting/images/placeholder.jpg" class="preview-image thumb">';
    strNewAnswer += '<span class="preview-close glyphicon glyphicon-remove-circle" title="verwijder afbeelding"></span></figure></div>';
    strNewAnswer += '<div class="pull-left col-xs-9"><label class="col-xs-4 control-label">Afbeelding:</label><div class="col-xs-8"> <div class="input-group"> <span class="input-group-btn">';
    strNewAnswer += '<span class="btn btn-default btn-file">Bladeren...<input type="file" name="answerMedia[]" class="form-control uploadImage" ',
            strNewAnswer += 'onchange="PreviewAnswerImage(\'AnswerUpload' + count + '\', \'imgPreview' + count + '\');" id="AnswerUpload' + count + '"/> </span> </span><input type="text" class="form-control" readonly value="" id="inputText' + count + '"></div></div>\n\
                     </div></div><span class="glyphicon glyphicon-floppy-remove remove-answer btn" title="Verwijder antwoord"></span></div></div>';
    var $newAnswer = $(strNewAnswer);
    $answers.append($newAnswer);

    //toevoegen option in correct antwoord select
    $correctAns.append('<option value="' + (valCount - 1) + '">Antwoord ' + valCount + '</option>');

    //rerun inputbutton
    inputButtonBootstrap();

    //attach remove handler
    $('.remove-answer').click(function() {
      removeAnswer($(this));
    });

    //herinitialise tinymce op textarea.allowcode
    tinymce.init({
      menubar: true,
      skin: 'bootstrap',
      toolbar: "",
      statusbar: true,
      selector: 'textarea.allowcode',
      paste_as_text: true,
      plugins: "visualblocks"
    });

    updateAnswers();

  });


  $addButton.click(function(e)  //on add input button click
  {
    ++count;
    valCount = $(".answers > div").length;

    var strNewAnswer = '<div class="panel panel-default">';
    strNewAnswer += '<div class="panel-body">';
    strNewAnswer += '<div class="form-group">';
    strNewAnswer += '<label for="antwoord[]" class="col-md-3 control-label answer-label">Antwoord ' + count + ':</label>   ';
    strNewAnswer += ' <div class="col-md-9">';
    strNewAnswer += '   <textarea name="antwoord[]" id="antwoord' + count + '" class="form-control allowcode" placeholder="vul hier een antwoord in."></textarea> ';
    strNewAnswer += '  </div>';
    strNewAnswer += '   </div>';
    strNewAnswer += '   <div class="form-group">';
    strNewAnswer += ' <label class="col-md-3 control-label">Afbeelding:</label>';
    strNewAnswer += '<div class="col-md-6">';
    strNewAnswer += '<div class="input-group">';
    strNewAnswer += ' <span class="input-group-btn">';
    strNewAnswer += '<span class="btn btn-default btn-file">';
    strNewAnswer += 'Bladeren... ';
    strNewAnswer += '    <input type="file" name="answerMedia[]" class="form-control" />';
    strNewAnswer += '   </span>';
    strNewAnswer += ' </span>';
    strNewAnswer += ' <input type="text" class="form-control" readonly>';
    strNewAnswer += ' </div>';
    strNewAnswer += ' </div><div class="btn btn-default reset-input">reset</div>';
    strNewAnswer += '</div><span class="glyphicon glyphicon-floppy-remove remove-answer btn" title="Verwijder antwoord"></span>';
    strNewAnswer += ' </div></div>';
    //console.log(strNewAnswer);
    var $newAnswer = $(strNewAnswer);
    $answers.append($newAnswer);

    //attach remove handler
    $('.remove-answer').click(function() {
      removeAnswer($(this));
    });
    //attach input reset handler
    $('.reset-input').click(function() {
      resetInput($(this));
    });


    //toevoegen option in correct antwoord select
    $correctAns.append('<option value="' + (valCount - 1) + '">Antwoord ' + valCount + '</option>');

    //rerun inputbutton
    inputButtonBootstrap();

    updateAnswers();

    //herinitialise tinymce op textarea.allowcode
    tinymce.init({
      menubar: true,
      skin: 'bootstrap',
      toolbar: "",
      statusbar: true,
      selector: 'textarea.allowcode',
      paste_as_text: true,
      plugins: "visualblocks"
    });

  });



}
);
