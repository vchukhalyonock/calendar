<?php
class Site extends MY_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model("UsersModel");
    }

    public function index() {
        $this->_HTMLResponse([
            'view' => is_null($this->_userId) ? 'pages/login' : 'pages/calendar',
            'data' => [
                'userId' => $this->_userId,
                'userType' => $this->_userType,
                'error' => $this->session->flashdata("error") ? $this->session->flashdata("error") : null,
                'currentUser' => $this->_currentUserId,
                'user' => $this->UsersModel->get($this->_currentUserId)
            ]
        ]);
    }
}
?>