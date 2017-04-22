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
            var url;
            var id = null;
            if($('#eventId')) {
                id = $('#eventId').val();
                url = '/calendar/updateEvent/' + id;
                $('#eventId').remove();
            } else {
                url = '/calendar/createEvent';
            }

            $.ajax({
                url : url,
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
                        if(id != null) {
                            $('#calendar').fullCalendar(
                                'removeEvents',
                                id
                            );
                        }

                        $('#calendar').fullCalendar(
                            'addEventSource',
                            {
                                events : [
                                    {
                                        id : data.event.id,
                                        title : data.event.name,
                                        start : data.event.dateFrom + ' ' + data.event.timeFrom,
                                        end : data.event.dateTo + ' ' + data.event.timeTo,
                                        description : data.event.description,
                                        status : data.event.status
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

            $('#eventForm')[0].reset();
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
                                title: r.name,
                                start: r.dateFrom + ' ' + r.timeFrom,
                                end: r.dateTo + ' ' + r.timeTo,
                                description: r.description,
                                status : r.status,
                                color : r.color
                            });
                        });
                    }
                    callback(events);
                }
            });
        },
        eventClick : function (event) {
            $('#myModal').modal();
            $('#eventForm').append('<input  type="hidden" name="id" id="eventId" value="' + event.id + '"/>');
            $('#datetimepickerFrom').data("DateTimePicker").date(event.start);
            $('#datetimepickerTo').data("DateTimePicker").date(event.end);
            $('#eventName').val(event.title);
            $('#eventDescription').val(event.description);
            $('#eventStatus').val(event.status);
            $('#eventColor').val(event.color);
        }
    })

});