$(document).ready(function() {

    var InputsWrapper = $("#HENDRIK"); //Input boxes wrapper ID
    var Select = $("#HENDRIK2"); //Select box
    var AddButton = $("#AddAnswer"); //Add button ID

    var x = InputsWrapper.length; //initial text box count
    var FieldCount = 2; //to keep track of text box added

    $(AddButton).click(function(e)  //on add input button click
    {
            FieldCount++; //text box added increment
            var FieldCountLow = FieldCount - 1;
            //add input box
            $(InputsWrapper).append('<div class="input-group nieuwantwoord"><span class="input-group-addon widthvraaginput">Antwoord '+FieldCount+':</span><textarea name="antwoord[]" id="Answers'+FieldCount+'" class="form-control allowcode" placeholder="vul hier een antwoord in." onload="initTinyMce()"></textarea>' +
                    '</div>');
            $(Select).append('<option value="'+FieldCountLow+'">Antwoord '+FieldCount+'</option>');
            x++; //text box increment
            var name = 'Answers'+FieldCount;
            jQuery('textarea.allowcode').each(function(){ 
             //   tinyMCE.addEditor(e.id);
    //tinyMCE.EditorManager.execCommand("mceAddEditor",true , ".allowcode");
    
    });
    
    tinyMCE.execCommand('mceAddControl', false, name);
    tinyMCE.triggerSave();
    });
    
    //tinyMCE.addEditor(e.id);
   
});


  function initTinyMce(){
    $(this).tinymce({
                mode : "none",
                theme : "advanced",
                plugins : "spellchecker,preview",
                theme_advanced_buttons1 : "bold,italic,underline,|,sub",
                theme_advanced_buttons2 : "",
                theme_advanced_buttons3 : "",
                theme_advanced_toolbar_location : "top",
                theme_advanced_toolbar_align : "left",
                theme_advanced_statusbar_location : "bottom",
                theme_advanced_resizing : false
    });
  }
                                                                                       





//'<div><input type="text" name="mytext[]" id="field_' + FieldCount + '" value="Text ' + FieldCount + '"/>' +              '</div>'