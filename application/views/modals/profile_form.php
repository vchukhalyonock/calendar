<div id="profileModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" id="profileFormHeader">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Profile</h4>
            </div>
            <div class="modal-body">
                <form name="profile-form" data-toggle="validator" id="profileForm" data-toggle="validator">
                    <div class="form-group">
                        <label for="profileName">Name:</label>
                        <input type="text" class="form-control" id="profileName" name="name">
                    </div>

                    <div class="form-group">
                        <label for="profileSurame">Surname:</label>
                        <input type="text" class="form-control" id="profileSurname" name="surname">
                    </div>

                    <div class="form-group">
                        <label for="profilePassword">Password:</label>
                        <input type="password" class="form-control" id="profilePassword" name="password">
                    </div>

                    <div class="form-group">
                        <label for="profileConfirmPassword">Confirm Password:</label>
                        <input type="password" class="form-control" id="profileConfirmPassword" name="confirm-password" data-match="#profilePassword">
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-default" id="submitProfile">Submit</button>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>