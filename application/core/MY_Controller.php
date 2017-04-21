<?php
class MY_Controller extends CI_Controller {

    protected $_userId;
    protected $_userType;

    public function __construct() {
        parent::__construct();

        if(!$this->_checkAuth() && $this->uri->rsegment(1) != 'site' && $this->uri->rsegment(2) != 'index')
            redirect('/');
    }

    private function _checkAuth() {
        $user = $this->Authlib->getCurrentUser();
        if($user) {
            $this->_userId = $user['id'];
            $this->_userType = $user['info']['type'];
            return true;
        } else {
            return false;
        }
    }
}
?>