<?php
class MY_Controller extends CI_Controller {

    protected $_userId = null;
    protected $_userType = null;
    protected $_switchedUser = null;
    protected $_currentUserId;

    public function __construct() {
        parent::__construct();

        if($this->uri->rsegment(1) != 'auth' ||
            in_array($this->uri->rsegment(2), ['switchUser', 'switchBack'])) {
            if (!$this->_checkAuth() && $this->uri->rsegment(1) != 'site' && $this->uri->rsegment(2) != 'index')
                redirect('/');
        }

        $this->_switchedUser = $this->authlib->getSwitchedUser() ? $this->authlib->getSwitchedUser() : null;
        $this->_currentUserId = is_null($this->_switchedUser) ? $this->_userId : $this->_switchedUser;
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


    protected function _checkAjax() {
        if(!$this->input->is_ajax_request())
            redirect('/');
    }
}
?>