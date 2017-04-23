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