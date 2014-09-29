/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


//previewImage function
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
    </div>');
    $('#' + uploadBox).css("display", "none");
    $('#inputBox').append(
            '<div class="form-group" id="UploadBox' + idx + '">\n\
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
    //rerun inputbutton.js
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
//    document.getElementById(previewId).src = oFREvent.target.result;
  };
}
;

function PreviewAnswerImage(inputId, previewId) {
  var oFReader = new FileReader();
  oFReader.readAsDataURL(document.getElementById(inputId).files[0]);
  oFReader.onload = function(oFREvent) {
    document.getElementById(previewId + 'img').src = oFREvent.target.result;
  };
}

function removeImage(previewImg, inputIdBlock) {
  console.log(previewImg, inputIdBlock);
  $('#' + inputIdBlock).remove();
  $('#' + previewImg).remove();
}
;

function resetInputForm(previewImg, inputId) {
  $('#' + previewImg + 'img').attr("src", '/mctesting/public/images/placeholder.jpg');
  $('#' + inputId).wrap('<form>').closest('form').get(0).reset();
  $('#' + inputId).unwrap();
  $('#' + inputId).parents('.input-group').find(':text').val('');
  $('#' + previewImg).append('');
}

//delete img input
function imgInputDelete(butts) {
  console.log(butts);
  $(butts).empty();
}
;

$(document).ready(function() {

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


    //rerun inputbutton.js
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
  });

});