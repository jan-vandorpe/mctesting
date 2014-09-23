$(document).ready(function() {

    $('#frmLogin').bootstrapValidator({
        container: 'tooltip',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            Login: {
                message: 'The username is not valid',
                validators: {
                    notEmpty: {
                        message: 'Voornaam is verplicht'
                    },
                }
            },
            Wachtwoord: {
                message: 'The username is not valid',
                validators: {
                    notEmpty: {
                        message: 'Wachtwoord is verplicht'
                    },
                }
            },
        }});
    $('#testcreation2').bootstrapValidator({
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            testduration: {
                message: 'Voer duur van de test in minuten in',
                validators: {
                    digits: {
                        message: 'Voer de tijd in minuten in'
                    },
                    notEmpty: {
                        message: 'Voer de tijd in minuten in'
                    }
                }
            },
            'question[]': {
                feedbackIcons: false,
                validators: {
                    choice: {
                        min: 1,
                        message: 'Selecteer tenminste 1 vraag'
                    }
                },
            }

        }});

    $('#subcattoev').bootstrapValidator({
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            newcat: {
                container: '#newcatErrorMessage',
                validators: {
                    notEmpty: {
                        message: 'Geef een naam voor de categorie'
                    }
                }
            }
        }
    });


    $('#testsessiesel').bootstrapValidator({
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            testdatum: {
                feedbackIcons: false,
                container: '#testdatumErrorMessage',
                validators: {
                    date: {
                        format: 'DD/MM/YYYY',
                        message: 'Dit is geen geldige datum (dd/mm/yyyy)'
                    },
                    notEmpty: {
                        message: 'Voer een datum in'
                    }
                }
            },
            testwachtwoord: {
                container: '#testwachtwoordErrorMessage',
                validators: {
                    notEmpty: {
                        message: 'Voer een wachtwoord in'
                    }
                }
            },
            testsetselect: {
                feedbackIcons: false,
                container: '#testsetselectErrorMessage',
                validators: {
                    greaterThan: {
                        value: 1,
                        message: 'Selecteer een test',
                    }
                }
            }
        }
    });
    $('#ctrlDatePicker')
            .on('dp.change dp.show', function(e) {
                // Validate the date when user change it
                $('#testsessiesel').bootstrapValidator('revalidateField', 'testdatum');
            });

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


