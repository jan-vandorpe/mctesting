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

//previewImage function for question
function PreviewImage(inputId, previewId, uploadBox, loop) {
  console.log(inputId, '#' + previewId, '#' + uploadBox, loop + 1);
  var idx = loop + 1;
  var oFReader = new FileReader();
  oFReader.readAsDataURL(document.getElementById(inputId).files[0]);
  oFReader.onload = function(oFREvent) {
    $('#' + previewId).append(
            '<div class="pull-left preview-wrapper" id="imgPreviewNew' + loop + '">\n\
            <figure class="thumbnail preview-figure btn" onclick="removeImage(\'imgPreviewNew' + loop + '\',\'' + uploadBox + '\')">\n\
            <img src="' + oFREvent.target.result + '" class="preview-image thumb">\n\
            <span class="preview-close glyphicon glyphicon-remove-circle" title="verwijder afbeelding"></span>\n\
            </figure>\n\
            </div>'
            );
    $('#' + uploadBox).css("display", "none");
    $('#inputBox').append(
         ' <div class="form-group" id="UploadBox' + idx + '">\n\
            <label class="control-label col-xs-3">Afbeelding toevoegen:</label>\n\
            <div class="col-xs-6">\n\
              <div class="input-group">\n\
                <span class="input-group-btn">\n\
                  <span class="btn btn-default btn-file">\n\
                    Bladeren... \n\
                    <input type="file" name="newQMedia[]" class="form-control uploadImage" id="NewQMedia' + idx + '"/>\n\
                  </span>\n\
                </span>\n\
                <input type="text" class="form-control" readonly>\n\
              </div>\n\
            </div>\n\
            <div class="col-xs-3">\n\
           <input type="button" value="Afbeelding uploaden" id="uploadImgPreview" \n\
          class="btn btn-default" onclick="PreviewImage(\'NewQMedia' + idx + '\', \'questionImgPreview\', \'UploadBox' + idx + '\',' + idx + ');"></div></div>'
            );
    inputButtonBootstrap();
  };
}

function PreviewAnswerImage(inputId, previewId) {
  var oFReader = new FileReader();
  oFReader.readAsDataURL(document.getElementById(inputId).files[0]);
  oFReader.onload = function(oFREvent) {
    document.getElementById(previewId + 'img').src = oFREvent.target.result;
    //inputButton(inputId);
  };
}

function inputButton(inputId) {
  var input = $('#' + inputId),
          numFiles = input.get(0).files ? input.get(0).files.length : 1,
          label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
  input.trigger('fileselect', [numFiles, label]);
  $('#' + inputId).parents('.input-group').find(':text').val(label);
}

function removeImage(previewImg, inputIdBlock) {
  console.log(previewImg, inputIdBlock);
  $('#' + inputIdBlock).remove();
  $('#' + previewImg).hide('slow', function() {
    $('#' + previewImg).remove();
  });
}

function resetInputForm(previewImg, inputId) {
  $('#' + previewImg + 'img').attr("src", '/mctesting/public/images/placeholder.jpg');
  $('#' + inputId).wrap('<form>').closest('form').get(0).reset();
  $('#' + inputId).unwrap();
  $('#' + inputId).parents('.input-group').find(':text').val('');
}


//vvv DOC READY STUFF vvv//
$(document).ready(function() {


  //adds new pics to img preview for question
  var QuestionImgWrapper = $('#questionImgWrapper');
  var AddQuestionPicButton = $('#addQuestionPic');
  var j = 100;
  AddQuestionPicButton.click(function(e) {
    ++j;
    var strNewQPic = '<div class="form-group">';
    strNewQPic += '<div class="pull-right col-xs-3">';
    strNewQPic += '<figure class="">';
    strNewQPic += '<img src="/mctesting/public/images/placeholder.jpg" class="img-thumbnail thumb" id="imagePreviewNew' + j + '"/>';
    strNewQPic += '</figure>';
    strNewQPic += '</div>';
    strNewQPic += '<div class="pull-left col-xs-9">';
    strNewQPic += '<label class="col-xs-4 control-label">Afbeelding:</label>';
    strNewQPic += '<div class="col-xs-8">';
    strNewQPic += '<div class="input-group">';
    strNewQPic += '<span class="input-group-btn">';
    strNewQPic += '<span class="btn btn-default btn-file">';
    strNewQPic += 'Bladeren... ';
    strNewQPic += '<input type="file" name="media[]" class="form-control uploadImage" onchange="PreviewImage(\'QuestionUploadNew' + j + '\',\'imagePreviewNew' + j + '\');" id="QuestionUploadNew' + j + '"/>';
    strNewQPic += '</span>';
    strNewQPic += '</span>';
    strNewQPic += '<input type="text" class="form-control" readonly>';
    strNewQPic += '</div>';
    strNewQPic += '</div>';
    strNewQPic += '</div>';
    strNewQPic += '<div class="pull-left col-xs-9">';
    strNewQPic += '<div class="col-xs-4 control-label"></div>';
    strNewQPic += '<div class="col-xs-8" style="padding-top:0.5em">';
    strNewQPic += '<label class="btn btn-default" for="ImageId' + j + 'delete">';
    strNewQPic += '<input type="checkbox" name="ImageId' + j + 'delete" id="ImageId' + j + 'delete">';
    strNewQPic += '<span> Afbeelding verwijderen</span>';
    strNewQPic += '</label>';
    strNewQPic += '</div>';
    strNewQPic += '</div>';
    strNewQPic += '</div>';
    console.log(j);
    var newQPic = $(strNewQPic);
    QuestionImgWrapper.append(newQPic);
  });

  //remove-answer button event handler attaching
  $removeButtons = $('.remove-answer');
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
  var $editAddButton = $('#editAddAnswer'); //add button on edit form (now also on create form)
  var count = $(".answers > div").length;
  var valCount;

  //adds new answer for editQuestion and createQuestion
  $editAddButton.click(function(e) {
    //count for correct answer dropdown, valCount recounts every trigger, normal count keeps adding up after page load to allow for unique IDs and the like
    valCount = $(".answers > div").length;
    ++valCount;
    ++count;

    //add input box
    var strNewAnswer = '<div class="panel panel-default">';
    strNewAnswer += '<div class="panel-body"><div class="form-group"><label for="antwoord[]" class="col-sm-3 control-label label-padding answer-label">Antwoord ' + count + ':</label>';
    strNewAnswer += '<div class="col-sm-9"><textarea name="antwoord[]" id="antwoord' + count + '" class="form-control allowcode" placeholder="vul hier een antwoord in.">';
    strNewAnswer += '</textarea></div></div><div class="form-group" id="AnswerMediaBlock' + count + '"><div class="pull-right" id="imgPreview' + count + '" style="padding-right:2em">';
    strNewAnswer += '<figure class="thumbnail preview-figure btn" onclick="resetInputForm(\'imgPreview' + count + '\', \'AnswerUpload' + count + '\');"><img id="imgPreview' + count + 'img" src="/mctesting/public/images/placeholder.jpg" class="preview-image thumb">';
    strNewAnswer += '<span class="preview-close glyphicon glyphicon-remove-circle" title="verwijder afbeelding"></span></figure></div>';
    strNewAnswer += '<div class="pull-left col-xs-9"><label class="col-xs-4 control-label">Afbeelding:</label><div class="col-xs-8"> <div class="input-group"> <span class="input-group-btn">';
    strNewAnswer += '<span class="btn btn-default btn-file">Bladeren...<input type="file" name="answerMedia[]" class="form-control uploadImage" ';
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

    //redo count on number of answers
    updateAnswers();

  });
});
