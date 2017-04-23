$(document).ready(function() {

    $('#datetimepickerFrom').datetimepicker({
        format : "DD/MM/YYYY HH:mm"
    });
    $('#datetimepickerTo').datetimepicker({
        format : "DD/MM/YYYY HH:mm"
    });
    $('#cp2').colorpicker();

    $('#inviteForm').validator().on('submit', function (e) {
        if(!e.isDefaultPrevented()) {
            $.ajax({
                url : '/invite/',
                dataType : "json",
                method : "post",
                data : {
                    email : $("#inviteEmail").val()
                },
                success : function (data) {

                }
            });

            e.preventDefault();
            $(this)[0].reset();
            $('#inviteModal').modal("hide");
        }
    });


    $('#eventForm').validator().on('submit', function (e) {
        if (!e.isDefaultPrevented()) {
            var url = '/calendar/createEvent/';
            var id = null;
            if($('#eventId').length > 0) {
                id = $('#eventId').val();
                url = '/calendar/updateEvent/' + id;
                $('#eventId').remove();
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

    $('#deleteEvent').click(function (e) {
       var result = confirm("Are you sure?");
       if(result) {
           var id = null;
           if($('#eventId')) {
               id = $('#eventId').val();
               $('#eventId').remove();
               $.ajax({
                   url : '/calendar/delete/' + id,
                   method : "post",
                   dataType : "json",
                   success : function (data) {
                       if(data.status) {
                           $('#calendar').fullCalendar(
                               'removeEvents',
                               id
                           );
                       }
                   }
               });
           };

           $('#myModal').modal("hide");
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
            $('#deleteEvent').addClass("hidden");
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
                        $('#calendar').fullCalendar('removeEvents');
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
            $('#deleteEvent').removeClass("hidden");
            $('#eventId').remove();
            $('#eventForm').append('<input  type="hidden" name="id" id="eventId" value="' + event.id + '"/>');
            $('#datetimepickerFrom').data("DateTimePicker").date(event.start);
            $('#datetimepickerTo').data("DateTimePicker").date(event.end);
            $('#eventName').val(event.title);
            $('#eventDescription').val(event.description);
            $('#eventStatus').val(event.status);
            $('#eventColor').val(event.color);
        }
    });
    
    
    $('#profileLink').click(function (e) {
        $.ajax({
            url : "/profile/",
            dataType : "json",
            success : function (res) {
                $('#profileModal').modal();
                $('#profileName').val(res.user.name);
                $('#profileSurname').val(res.user.surname);
            }
        });

        e.preventDefault();
    });

    $('#profileForm').validator().on("submit", function (e) {
        if (!e.isDefaultPrevented()) {
            $.ajax({
                url: '/profile/update',
                dataType: 'json',
                method: 'post',
                data: {
                    name: $('#profileName').val(),
                    surname: $('#profileSurname').val(),
                    password: $('#profilePassword').val(),
                    confirm_password : $("#profileConfirmPassword").val()
                },
                success: function (res) {
                    if (res.status) {
                        $('#profileModal').modal("hide");
                    } else {
                        if (res.error != undefined) {
                            $('#profileFormHeader').append('<div class="alert alert-danger">' + res.error + '</div>');
                        }
                    }
                }
            });
        }
        e.preventDefault();
    });


    var dTable = $('#manageUsersTable').dataTable({
        ajax : '/users/'
    });


    $('#userProfileForm').validator().on("submit", function (e) {
        if (!e.isDefaultPrevented()) {
            $.ajax({
                url: '/users/update/' + $('#userProfileId').val(),
                dataType: 'json',
                method: 'post',
                data: {
                    name: $('#userProfileName').val(),
                    surname: $('#userProfileSurname').val(),
                    password: $('#userProfilePassword').val(),
                    confirm_password : $("#userProfileConfirmPassword").val(),
                    type : $('#userProfileType').val()
                },
                success: function (res) {
                    if (res.status) {
                        $('#userProfileModal').modal("hide");
                        dTable.api().ajax.reload();
                    } else {
                        if (res.error != undefined) {
                            $('#userProfileFormHeader').append('<div class="alert alert-danger">' + res.error + '</div>');
                        }
                    }
                }
            });
        }
        e.preventDefault();
    });
});


function openManageUsers() {
    $('#manageUsersModal').modal();
    $('.deleteUserLink').click(function (e) {
        var url = $(this).attr("href");
        var table = $('#manageUsersTable').DataTable();
        var aObj = $(this);
        var result = confirm("Are you sure?");
        if(result) {
            $.ajax({
                url: url,
                dataType: "json",
                success: function (res) {
                    if (res.status) {
                        table
                            .row(aObj.parents('tr'))
                            .remove()
                            .draw();
                    }
                }
            });
        }
        e.preventDefault();
    });
    $('.editUserLink').click(function (e) {
        var url = $(this).attr("href");
        $('#userProfileModal').modal();
        $.ajax({
            url : url,
            dataType : "json",
            success : function (res) {
                if(res) {
                    $('#userProfileModal').modal();
                    $('#userProfileName').val(res.user.name);
                    $('#userProfileSurname').val(res.user.surname);
                    $('#userProfileId').val(res.user.id);

                    $('#userProfileType option')
                        .removeAttr('selected')
                        .filter('[value="' + res.user.type + '"]')
                        .attr('selected', true);
                }
            }
        });
        e.preventDefault();
    });
}