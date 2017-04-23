<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('elements/header');?>
<body>
<?php if($data['currentUser'] != $data['userId']):?>
    <div class="container">
        <h1>Events of the User "<?php echo $data['user']->email;?>"</h1>
    </div>
<?php endif;?>

<?php if(!is_null($data['userId'])) $this->load->view('menu/up_menu')?>

<?php $this->load->view($view, $data)?>

<?php $this->load->view('elements/footer');?>
</body>
</html>