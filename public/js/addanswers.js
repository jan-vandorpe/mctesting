//initialize tinymce op textarea.allowcode


$(document).ready(function () {

    tinymce.init({ menubar: false, toolbar: "", statusbar: false, selector: 'textarea.allowcode', paste_as_text: true});


    var $answers     = $(".answers"); //antwoorden wrapper
    var $correctAns    = $("#correctant"); //correct antw Select box
    var $addButton      = $("#AddAnswer"); //Add button ID

    //var x               = $antwoorden.length; //aantal initiele anwtoordvelden
    var count          = 2; //minimaal 2 antwoorden aanwezig

    $addButton.click(function (e)  //on add input button click
    {
        ++count;

        //add input box
        var strNewAnswer   = '<div class="input-group nieuwantwoord"><span class="input-group-addon widthvraaginput">Antwoord ' + count + ':</span>';
        strNewAnswer      += '<textarea name="antwoord[]" id="antwoord' + count + '" class="form-control allowcode" placeholder="vul hier een antwoord in."></textarea>';
        strNewAnswer      += '</div>';
        var $newAnswer    = $(strNewAnswer);
        $answers.append($newAnswer);

        //toevoegen option in correct antwoord select
        $correctAns.append('<option value="' + (count - 1) + '">Antwoord ' + count + '</option>');

        //herinitialise tinymce op textarea.allowcode
        tinymce.init({ menubar: false, toolbar: "", statusbar: false, selector: 'textarea.allowcode', paste_as_text: true});

    });


});