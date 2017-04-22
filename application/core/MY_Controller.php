<?php
class MY_Controller extends CI_Controller {

    protected $_userId = null;
    protected $_userType = null;

    public function __construct() {
        parent::__construct();

        if($this->uri->rsegment(1) != 'auth') {
            if (!$this->_checkAuth() && $this->uri->rsegment(1) != 'site' && $this->uri->rsegment(2) != 'index')
                redirect('/');
        }
    }

    private function _checkAuth() {
        $user = $this->authlib->getCurrentUser();
        if($user) {
            $this->_userId = $user['id'];
            $this->_userType = $user['info']['type'];
            return true;
        } else {
            return false;
        }
    }

    protected function _HTMLResponse($param = array('view' => '', 'data' => array()))
    {
        $this->load->view('index', $param);
    }


    protected function _ajaxResponse($response = array()) {
        $this->output
            ->set_content_type('application/json')
            ->set_output(
                json_encode(
                    $response
                )
            );
    }
}
?>