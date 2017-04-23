
<div class="container">
    <hr>
    <div id="calendar"></div>
</div>

<?php $this->load->view("modals/add_event_form");?>

<?php $this->load->view("modals/send_invite");?>

<?php $this->load->view("modals/profile_form");?>

<?php $this->load->view("modals/manage-users");?>

<script type="text/javascript" src="<?php echo base_url()?>js/calendar.js"></script>