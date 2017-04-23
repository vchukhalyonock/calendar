<div id="userProfileModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" id="userProfileFormHeader">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">User Profile</h4>
            </div>
            <div class="modal-body">
                <form name="userProfile-form" data-toggle="validator" id="userProfileForm" data-toggle="validator">
                    <input type="hidden" id="userProfileId"/>
                    <div class="form-group">
                        <label for="userProfileName">Name:</label>
                        <input type="text" class="form-control" id="userProfileName" name="name">
                    </div>

                    <div class="form-group">
                        <label for="userProfileSurame">Surname:</label>
                        <input type="text" class="form-control" id="userProfileSurname" name="surname">
                    </div>

                    <div class="form-group">
                        <label for="userProfilePassword">Password:</label>
                        <input type="password" class="form-control" id="userProfilePassword" name="password">
                    </div>

                    <div class="form-group">
                        <label for="userProfileConfirmPassword">Confirm Password:</label>
                        <input type="password" class="form-control" id="userProfileConfirmPassword" name="confirm-password" data-match="#userProfilePassword">
                    </div>

                    <div class="form-group">
                        <label for="userProfileType">Account Type:</label>
                        <select class="form-control" name="type" id="userProfileType">
                            <option value="user">User</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-default" id="submituserProfile">Submit</button>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>