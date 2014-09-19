$(document).ready(function() {
   
    $('.datepicker').off('focus').datepicker({
        format: "dd/mm/yyyy",
        startDate: "today",
        language: "nl-BE",
        todayHighlight: true,
        autoclose: true,
        orientation: "top right"
    }).click(
    function () {
        $(this).datepicker('show');
    }
)


    $('#ctrlDatePicker').datepicker().on('changeDate', function(e) {
        $('#testsessiesel').bootstrapValidator('revalidateField', 'testdatum');
    });

});

