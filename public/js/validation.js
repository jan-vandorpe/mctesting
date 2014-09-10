$(document).ready(function() {

    $('#frmLogin').bootstrapValidator({
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            inputVoornaam: {
                message: 'The username is not valid',
                validators: {
                    notEmpty: {
                        message: 'Voornaam is verplicht'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z]+$/,
                        message: 'Voornaam kan alleen bestaan uit letters van het alfabet'
                    },
                }
            },
            inputNaam: {
                message: 'The username is not valid',
                validators: {
                    notEmpty: {
                        message: 'Naam is verplicht'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z]+$/,
                        message: 'Naam kan alleen bestaan uit letters van het alfabet'
                    },
                }
            },
        }});
});


