<?php
class Site extends MY_Controller {

    public function __construct(){
        parent::__construct();
    }

    public function index() {
        if(is_null($this->_userId)) {
           $this->_HTMLResponse([
               'view' => 'pages/login',
               'data' => []
           ]);
        } else {
            echo $this->_userId;
        }
    }
}
?>