<?php
class Site extends MY_Controller {

    public function __construct(){
        parent::__construct();
    }

    public function index() {
        $this->_HTMLResponse([
            'view' => is_null($this->_userId) ? 'pages/login' : 'pages/calendar',
            'data' => [
                'userId' => $this->_userId,
                'userType' => $this->_userType,
                'error' => $this->session->flashdata("error") ? $this->session->flashdata("error") : null
            ]
        ]);
    }
}
?>