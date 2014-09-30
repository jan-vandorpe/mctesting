//event
function removeAnswer(e) {
  console.log(e);
  e.parent().parent().remove();
}

$(document).ready(function() {

  //remove answer button event handler attaching
  $removeButtons = $('.remove-answer');
  //console.log($removeButtons);

  $removeButtons.each(function(idx) {
    $(this).click(function() {
      removeAnswer($(this));
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
  console.log(count);

  $editAddButton.click(function(e) {
    ++count;

    //add input box
    var strNewAnswer = '<div class="panel panel-default">';
    strNewAnswer += '<div class="panel-body"><div class="form-group"><label for="antwoord[]" class="col-sm-3 control-label label-padding">Antwoord ' + count + ':</label>';
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
//    console.log($('#antwoord' + count).parent());

    //toevoegen option in correct antwoord select
    $correctAns.append('<option value="' + (count - 1) + '">Antwoord ' + count + '</option>');

    //rerun inputbutton
    inputButtonBootstrap();

    //attach remove handler
    $('.remove-answer').click(function(){
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


  });


  $addButton.click(function(e)  //on add input button click
  {
    ++count;
    var strNewAnswer = '<div class="panel panel-default">';
    strNewAnswer += '<div class="panel-body">';
    strNewAnswer += '<div class="form-group">';
    strNewAnswer += '<label for="antwoord[]" class="col-md-3 control-label">Antwoord ' + count + ':</label>   ';
    strNewAnswer += ' <div class="col-md-9">';
    strNewAnswer += '   <textarea name="antwoord[]" id="antwoord' + count + '" class="form-control allowcode" placeholder="vul hier een antwoord in."></textarea> ';
    strNewAnswer += '  </div>';
    strNewAnswer += '   </div>';
    strNewAnswer += '   <div class="form-group">';
    strNewAnswer += ' <label class="col-md-3 control-label">Afbeelding antwoord ' + count + ':</label>';
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
    strNewAnswer += ' </div>';
    strNewAnswer += '</div><span class="glyphicon glyphicon-floppy-remove remove-answer btn" title="Verwijder antwoord"></span>';
    strNewAnswer += ' </div></div>';
    console.log(strNewAnswer);
    var $newAnswer = $(strNewAnswer);
    $answers.append($newAnswer);
    
    //attach remove handler
    $('.remove-answer').click(function(){
      removeAnswer($(this));
    });

    //toevoegen option in correct antwoord select
    $correctAns.append('<option value="' + (count - 1) + '">Antwoord ' + count + '</option>');

    //rerun inputbutton
    inputButtonBootstrap();


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
