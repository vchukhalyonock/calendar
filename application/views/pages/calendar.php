
<div class="container">
    <hr>
    <div id="calendar"></div>
</div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit event</h4>
            </div>
            <div class="modal-body">
                <form name="event-form" data-toggle="validator" id="eventForm">
                    <div class="form-group">
                        <label for="name">Event Name:</label>
                        <input type="text" class="form-control" id="eventName" name="name" required>
                    </div>

                    <div class="container">
                        <div class="row">
                            <div class='col-sm-3'>
                                <div class="form-group">
                                    <label for="dateTimeFrom">From:</label>
                                    <div class='input-group date' id='datetimepickerFrom'>
                                        <input type='text' class="form-control" id="dateTimeFrom" name="dateTimeFrom" required/>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class='col-sm-3'>
                                <div class="form-group">
                                    <label for="dateTimeTo">To:</label>
                                    <div class='input-group date' id='datetimepickerTo'>
                                        <input type='text' class="form-control" name="dateTimeTo" id="dateTimeTo" required/>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>


                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea rows="5" class="form-control" name="description" id="eventDescription"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="eventStatus">Event Status:</label>
                        <input type="text" class="form-control" id="eventStatus" name="status" required>
                    </div>

                    <div class="form-group">
                    <div class="container">
                        <div class="row">
                            <div class='col-sm-3'>
                                <label for="eventColor">Color:</label>
                                <div id="cp2" class="input-group colorpicker-component">
                                    <input type="text" value="#00AABB" name="color" id="eventColor" class="form-control" required/>
                                    <span class="input-group-addon"><i></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-default" id="submitEvent">Submit</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<script type="text/javascript">

    /*$.getScript('http://arshaw.com/js/fullcalendar-1.6.4/fullcalendar/fullcalendar.min.js',function(){

        var date = new Date();
        var d = date.getDate();
        var m = date.getMonth();
        var y = date.getFullYear();

        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            editable: true,
            events: [
                {
                    title: 'All Day Event',
                    start: new Date(y, m, 1)
                },
                {
                    title: 'Long Event',
                    start: new Date(y, m, d-5),
                    end: new Date(y, m, d-2)
                },
                {
                    id: 999,
                    title: 'Repeating Event',
                    start: new Date(y, m, d-3, 16, 0),
                    allDay: false
                },
                {
                    id: 999,
                    title: 'Repeating Event',
                    start: new Date(y, m, d+4, 16, 0),
                    allDay: false
                },
                {
                    title: 'Meeting',
                    start: new Date(y, m, d, 10, 30),
                    allDay: false
                },
                {
                    title: 'Lunch',
                    start: new Date(y, m, d, 12, 0),
                    end: new Date(y, m, d, 14, 0),
                    allDay: false
                },
                {
                    title: 'Birthday Party',
                    start: new Date(y, m, d+1, 19, 0),
                    end: new Date(y, m, d+1, 22, 30),
                    allDay: false
                },
                {
                    title: 'Click for Google',
                    start: new Date(y, m, 28),
                    end: new Date(y, m, 29),
                    url: 'http://google.com/'
                }
            ]
        });
    })*/

</script>
<script type="text/javascript" src="<?php echo base_url()?>js/calendar.js"></script>