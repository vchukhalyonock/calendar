$(document).ready(function() {

    $('#datetimepickerFrom').datetimepicker();
    $('#datetimepickerTo').datetimepicker();
    $('#cp2').colorpicker();

    /*$('#submitEvent').click(function (event) {
        $('#myModal').modal("hide");

    });*/

    // page is now ready, initialize the calendar...

    $('#calendar').fullCalendar({
        // put your options and callbacks here
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
        },
        dayClick: function(date) {
            //alert('Clicked on: ' + date.format());
            //Format is YYYY-MM-DDTHH:MM:SS

            $('#myModal').modal();
            $('#datetimepickerFrom').data("DateTimePicker").date(date);
            $('#datetimepickerTo').data("DateTimePicker").date(date);

        }
    })

});