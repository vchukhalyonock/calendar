$(document).ready(function() {

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
            $('#datetimepickerFrom').datetimepicker();
            $('#datetimepickerTo').datetimepicker();
            $('#cp2').colorpicker();
        }
    })

});