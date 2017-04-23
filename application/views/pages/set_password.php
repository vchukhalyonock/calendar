<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">

                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">

                            <form id="register-form" action="<?php echo base_url()?>auth/register/<?php echo $code?>" data-toggle="validator" method="post" role="form">

                                <div class="form-group">
                                    <?php echo form_error('password'); ?>
                                    <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password" required>
                                </div>
                                <div class="form-group">
                                    <?php echo form_error('confirm-password'); ?>
                                    <input type="password" name="confirm-password" id="confirm-password" tabindex="2" class="form-control" placeholder="Confirm Password" required data-match="#password">
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6 col-sm-offset-3">
                                            <input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Set Password">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>