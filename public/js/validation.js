$(document).ready(function () {

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


    /*
     * Category.html.twig
     */
    $('#cattoev').bootstrapValidator({
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            newcat: {
                validators: {
                    notEmpty: {
                        message: 'Geef een naam voor de categorie'
                    }
                }
            }
        }
    });
    $('#subcattoev').bootstrapValidator({
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            subcat: {
                validators: {
                    notEmpty: {
                        message: 'Geef een naam voor de subcategorie'
                    }
                }
            }
        }
    });


    /*
     * newuserform.html.twig
     */
    $('#gebrtoev').bootstrapValidator({
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            fnaam: {
                validators: {
                    notEmpty: {
                        message: 'Geef de familienaam in'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z_]+$/,
                        message: 'De familienaam kan enkel letters bevatten'
                    }
                }
            },
            vnaam: {
                validators: {
                    notEmpty: {
                        message: 'Geef de voornaam in'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z_]+$/,
                        message: 'De voornaam kan enkel letters bevatten'
                    }
                }
            },
            rrnr: {
                validators: {
                    notEmpty: {
                        message: 'Geef de rijksregisternummer in'
                    },
                    digits: {
                        message: 'Voer enkel cijfers in'
                    },
                    stringLength: {
                        min: 11,
                        max: 11,
                        message: 'Het rijksregisternummer moet 11 cijfers bevatten'
                    },
                }
            }
        }
    });

    /*
     * testcreation.html.twig
     */
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
    $('#testsessiesel').bootstrapValidator({
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            testdatum: {
                feedbackIcons: false,
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
                validators: {
                    notEmpty: {
                        message: 'Voer een wachtwoord in'
                    }
                }
            },
            testsetselect: {
                feedbackIcons: false,
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
            .on('dp.change dp.show', function (e) {
                // Validate the date when user change it
                $('#testsessiesel').bootstrapValidator('revalidateField', 'testdatum');
            });
});


