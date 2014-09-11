$(document).ready(function() {

//    $('#frmLogin').bootstrapValidator({
//        container: 'tooltip',
//        feedbackIcons: {
//            valid: 'glyphicon glyphicon-ok',
//            invalid: 'glyphicon glyphicon-remove',
//            validating: 'glyphicon glyphicon-refresh'
//        },
//        fields: {
//            Login: {
//                message: 'The username is not valid',
//                validators: {
//                    notEmpty: {
//                        message: 'Voornaam is verplicht'
//                    },
//                }
//            },
//            Wachtwoord: {
//                message: 'The username is not valid',
//                validators: {
//                    notEmpty: {
//                        message: 'Wachtwoord is verplicht'
//                    },
//                }
//            },
//        }});
    $('#testcreation2').bootstrapValidator({
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            testduration: {
                message: 'The username is not valid',
                validators: {
                    digits: {
                        message: 'Voer de tijd in minuuten in'
                    },
                }
            },
        }});

});


