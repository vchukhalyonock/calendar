<?php
class MY_Model extends CI_Model {

    protected $_usersTable = 'users';
    protected $_eventsTable = 'events';

    public function __construct() {
        parent::__construct();
    }
}
?>