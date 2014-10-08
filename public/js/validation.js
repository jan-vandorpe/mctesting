$(document).ready(function () {

//    $('#frmLogin').bootstrapValidator({
//        container: 'tooltip',
//        feedbackIcons: {
//            valid: 'glyphicon glyphicon-ok',
//            invalid: 'glyphicon glyphicon-remove',
//            validating: 'glyphicon glyphicon-refresh'
//        },
//        fields: {
//            Login: {
//                validators: {
//                    notEmpty: {
//                        message: 'Voornaam is verplicht'
//                    },
//                }
//            },
//            Wachtwoord: {
//                validators: {
//                    notEmpty: {
//                        message: 'Wachtwoord is verplicht'
//                    },
//                }
//            },
//        }});
    /*
     * 
     * createquestion twig
     */
    $('#toevoegenvraag').bootstrapValidator({
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        }, fields: {
            vraag: {
                validators: {
                    notEmpty: {
                        message: 'Geef een vraag in'
                    }
                }
            },
            'antwoord[]': {
                validators: {
                    notEmpty: {
                        message: 'Geef tenminste twee antwoorden'
                    }
                }
            }

        }
    });
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
     * registerUserForm
     */
    $('#gebrreg').bootstrapValidator({
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
                }
            },
            vnaam: {
                validators: {
                    notEmpty: {
                        message: 'Geef de voornaam in'
                    },
                }
            },
            rrnr: {
                validators: {
                    notEmpty: {
                        message: 'Geef de rijksregisternummer in'
                    },
                    regexp: {
                        regexp: '\d{2}.\d{2}.\d{2}-\d{3}.\d{2}',
                        message: 'Het rijksregisternummer moet 11 cijfers bevatten'
                    },
                }
            }
        }
    })
            .find('[name="rrnr"]').mask("00.00.00-000.00");
    ;
    $('#gebrreg').submit(function () {

        $('[name="rrnr"]').unmask();
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
                }
            },
            vnaam: {
                validators: {
                    notEmpty: {
                        message: 'Geef de voornaam in'
                    },
                }
            },
            rrnr: {
                validators: {
                    notEmpty: {
                        message: 'Geef het rijksregisternummer in'
                    },
                    regexp: {
                        regexp: '\d{2}.\d{2}.\d{2}-\d{3}.\d{2}',
                        message: 'Het rijksregisternummer moet 11 <u>cijfers</u> bevatten'
                    },
                }
            }
        }
    })
            .find('[name="rrnr"]').mask("00.00.00-000.00");
    ;

    $('#gebrtoev').submit(function () {

        $('[name="rrnr"]').unmask();
    });
    /*
     * testcreation.html.twig
     */
    $('#testcreation').bootstrapValidator({
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            testname: {
                validators: {
                    notEmpty: {
                        message: 'Voer een testnaam in'
                    }
                }
            },
            testcatselect: {
                feedbackIcons: false,
                validators: {
                    greaterThan: {
                        value: 1,
                        message: 'Selecteer een test'
                    }
                }
            }

        }});
    $('#testcreation2').bootstrapValidator({
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        submitButtons: '#btnNaarStap3',
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
                container: '#messages',
                feedbackIcons: false,
                validators: {
                    choice: {
                        min: 1,
                        message: 'Selecteer tenminste 1 vraag'
                    }
                }
            }

        }})
            .on('error.field.bv', function (e, data) {
                var $panel = data.element.parents('.panelGoesRed');
                $panel.css("border-color", "#a94442");
                $panel.css("box-shadow", "inset 0 1px 1px rgba(0,0,0,.075),0 0 6px #ce8483")
            })
            .on('success.field.bv', function (e, data) {
                var $panel = data.element.parents('.panelGoesRed');
                $panel.css("border-color", "#3c763d");
                $panel.css("box-shadow", "none");
            })

            ;
    $('#testcreation3').bootstrapValidator({
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        submitButtons: '.opslaanOfPubliceren',
        fields: {
            testpasspercentage: {
                feedbackIcons: false,
                validators: {
                    notEmpty: {
                        message: 'Voer een test percentage in'
                    },
                    between: {
                        min: 0,
                        max: 100,
                        message: 'Het slaagpercentage moet tussen 0 of 100% liggen'
                    }
                }
            },
            blabla: {
                feedbackIcons: false,
                selector: ".frmcontrolwidth-slaaginvoeg",
                validators: {
                    notEmpty: {
                        message: 'Voer een test percentage in'
                    },
                    between: {
                        min: 0,
                        max: 100,
                        message: 'Het slaagpercentage moet tussen 0 of 100% liggen'
                    }
                }
            },
        }});
    /*
     * testlink.html.twig
     */
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
            },
            'user[]': {
                container: '#messages',
                feedbackIcons: false,
                validators: {
                    choice: {
                        min: 1,
                        message: 'Selecteer tenminste 1 gebruiker'
                    }
                }
            }
        }
    })
            .on('error.field.bv', function (e, data) {
                var $panel = data.element.parents('.panelGoesRed');
                $panel.css("border-color", "#a94442");
                $panel.css("box-shadow", "inset 0 1px 1px rgba(0,0,0,.075),0 0 6px #ce8483")
            })
            .on('success.field.bv', function (e, data) {
                var $panel = data.element.parents('.panelGoesRed');
                $panel.css("border-color", "#3c763d");
                $panel.css("box-shadow", "none");
            })

            ;
    $('#ctrlDatePicker').on('dp.change dp.show', function (e) {
        // Validate the date when user change it
        $('#testsessiesel').bootstrapValidator('revalidateField', 'testdatum');
    });

    /*
     * newBeheerderform.html.twig
     */
    $('#behtoev').bootstrapValidator({
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
                }
            },
            vnaam: {
                validators: {
                    notEmpty: {
                        message: 'Geef de voornaam in'
                    },
                }
            },
            rrnr: {
                validators: {
                    notEmpty: {
                        message: 'Geef de rijksregisternummer in'
                    },
                    regexp: {
                        regexp: '\d{2}.\d{2}.\d{2}-\d{3}.\d{2}',
                        message: 'Het rijksregisternummer moet 11 cijfers bevatten'
                    },
                }
            },
            email: {
                validators: {
                    notEmpty: {
                        message: 'Geef het emailadres in'
                    },
                    emailAdress: {
                        message: 'Voer een geldig emailadres in'
                    }
                }
            }
        }
    })
            .find('[name="rrnr"]').mask("00.00.00-000.00");
    ;

    $('#behtoev').submit(function () {

        $('[name="rrnr"]').unmask();
    });

    $('#changeUserGroup').bootstrapValidator({
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            selectuser: {
                feedbackIcons: false,
                validators: {
                    greaterThan: {
                        value: 1,
                        message: 'Selecteer een gebruiker'
                    }
                }
            },
            email: {
                validators: {
                    notEmpty: {
                        message: 'Geef het emailadres in'
                    },
                    emailAdress: {
                        message: 'Voer een geldig emailadres in'
                    }
                }
            }
        }
    });
    $('#wijzigww').bootstrapValidator({
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            wachtwoord1: {
                validators: {
                    notEmpty: {
                        message: 'Geef een wachtwoord in'
                    },
                    regexp: {
                        regexp: /^(?=.*[0-9])(?=.*[a-zA-Z])([a-zA-Z0-9]{4,})$/,
                        message: 'Het wachtwoord moet minstens 4 tekens, waaronder minstens 1 cijfer bevatten (geen spatie, geen speciale tekens)'
                    }
                }
            },
            wachtwoord2: {
                validators: {
                    notEmpty: {
                        message: 'Geef het wachtwoord nogmaals in'
                    },
                    identical: {
                        field: 'wachtwoord1',
                        message: 'De wachtwoorden komen niet overeen'
                    },
                    regexp: {
                        regexp: /^(?=.*[0-9])(?=.*[a-zA-Z])([a-zA-Z0-9]{4,})$/,
                        message: ' '
                    }
                }
            }
        }
    });





    $('.popover-markup-trigger').popover({
        html: true,
        content: function () {
            return $(this).parent().find('.content').html();
        },
        trigger: 'manual',
        container: 'body',
        placement: 'top'
    });

    $('.popover-markup-trigger').popover('show');

//    $('.popover-markup-trigger').popover({
//        html: true,
//        content: function () {
//            return $(this).parent().find('.content').html();
//        },
//        trigger: 'focus',
//        container: 'body',
//        placement: 'top'
//    });


});


