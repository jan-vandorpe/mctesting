$(document).ready(function() {

    $('#ctrlDatePicker').datepicker({
        format: "dd/mm/yyyy",
        startDate: "today",
        language: "nl-BE",
        todayHighlight: true,
        autoclose: true,
        orientation: "top right"
    });


    $('#ctrlDatePicker').datepicker().on('changeDate', function(e) {
        $('#testsessiesel').bootstrapValidator('revalidateField', 'testdatum');
    });

});

