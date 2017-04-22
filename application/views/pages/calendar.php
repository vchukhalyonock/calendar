
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
                        <button type="submit" class="btn btn-default" id="submitEvent">Submit</button>&nbsp;<button type="button" class="btn btn-danger hidden" id="deleteEvent">Remove</button>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>


<div id="inviteModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Send Invite</h4>
            </div>
            <div class="modal-body">
                <form name="event-form" data-toggle="validator" id="inviteForm">
                    <div class="form-group">
                        <label for="name">Email:</label>
                        <input type="email" class="form-control" id="inviteEmail" name="email" required>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-default" id="submitInvite">Submit</button>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<script type="text/javascript" src="<?php echo base_url()?>js/calendar.js"></script>