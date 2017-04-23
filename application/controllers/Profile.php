<?php
class Profile extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->_checkAjax();
        $this->load->model("UsersModel");
    }


    public function index() {
        $this->_ajaxResponse([
            'user' => $this->UsersModel->get($this->_userId)
        ]);
    }


    public function update() {
        log_message("debug", "profile/update");
        if($this->input->post()) {

            $params = [
                'name' => $this->input->post('name', true),
                'surname' => $this->input->post('surname', true)
            ];

            if(trim($this->input->post("password", true)) != '') {
                $this->form_validation
                    ->set_rules(
                        'password',
                        'Password',
                        'max_length[32]'
                    );
                $this->form_validation
                    ->set_rules(
                        "confirm_password",
                        "Confirm Password",
                        'matches[password]'
                    );


                if ($this->form_validation->run() != false) {

                    if (trim($this->input->post("password", true)) != '') {
                        $params['password'] = hash('md5', $this->input->post("password", true));
                    }
                } else {
                    $response = [
                        'status' => false,
                        'error' => validation_errors()
                    ];
                }
            }

            if(!isset($response)) {
                $result = $this->UsersModel->update($this->_userId, $params);
                if ($result) {
                    $response = ['status' => true];
                } else {
                    $response = [
                        'status' => false,
                        'error' => 'Unknown error'
                    ];
                }
            }

            $this->_ajaxResponse($response);
        }
    }
}
?>