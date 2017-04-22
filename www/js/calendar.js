$(document).ready(function() {

    $('#datetimepickerFrom').datetimepicker({
        format : "DD/MM/YYYY HH:mm"
    });
    $('#datetimepickerTo').datetimepicker({
        format : "DD/MM/YYYY HH:mm"
    });
    $('#cp2').colorpicker();


    $('#eventForm').validator().on('submit', function (e) {
        if (!e.isDefaultPrevented()) {
            $.ajax({
                url : '/calendar/createEvent',
                dataType : "json",
                method : "post",
                data : {
                    name : $('#eventName').val(),
                    dateTimeFrom : $('#dateTimeFrom').val(),
                    dateTimeTo : $('#dateTimeTo').val(),
                    description : $('#eventDescription').val(),
                    status : $('#eventStatus').val(),
                    color : $('#eventColor').val()
                },
                success : function (data) {
                    $('#myModal').modal("hide");
                    if(data.status) {
                        $('#calendar').fullCalendar(
                            'addEventSource',
                            {
                                events : [
                                    {
                                        id : data.event.id,
                                        title : data.event.name,
                                        start : data.event.dateFrom + ' ' + data.event.timeFrom,
                                        end : data.event.dateTo + ' ' + data.event.timeTo
                                    }
                                ],
                                color : data.event.color
                            }
                        );
                    }
                }
            });

            e.preventDefault();
            $(this)[0].reset();
        }
    });

    $('#calendar').fullCalendar({
        // put your options and callbacks here
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
        },
        editable: true,
        dayClick: function(date) {
            //alert('Clicked on: ' + date.format());
            //Format is YYYY-MM-DDTHH:MM:SS

            $('#myModal').modal();
            $('#datetimepickerFrom').data("DateTimePicker").date(date);
            $('#datetimepickerTo').data("DateTimePicker").date(date);

        },
        eventDrop : function (event) {
            //alert(JSON.stringify(event));
            $.ajax({
                url : '/calendar/updateEvent/' + event.id,
                method : "post",
                dataType : "json",
                data : {
                    start : event.start.format(),
                    end : event.end.format()
                },
                success : function () {

                }
            });
        },
        eventResize : function (event) {
            $.ajax({
                url : '/calendar/updateEvent/' + event.id,
                method : "post",
                dataType : "json",
                data : {
                    start : event.start.format(),
                    end : event.end.format()
                },
                success : function () {

                }
            });
        },
        events : function (start, end, timezone, callback) {
            $.ajax({
                url : '/calendar/getEvents',
                method : 'post',
                dataType : "json",
                data : {
                    startDate : start.format(),
                    endDate : end.format()
                },
                success : function(eventData) {
                    var events = [];

                    if(eventData.status) {
                        $.map(eventData.events, function (r) {
                            events.push({
                                id: r.id,
                                title: r.title,
                                start: r.dateFrom + ' ' + r.timeFrom,
                                end: r.dateTo + ' ' + r.timeTo
                            });
                        });
                    }
                    callback(events);
                }
            });
        }
    })

});