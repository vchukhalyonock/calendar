<?php
class Users extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->_checkAjax();

        $this->load->model("UsersModel");
    }


    public function index() {
        $users = $this->UsersModel->getAll($this->_userId);
        $data = [];

        foreach ($users as $user) {
            $temp = [];
            $temp[] = $user->id;
            $temp[] = $user->email;
            $temp[] = $user->name;
            $temp[] = $user->surname;
            $temp[] = $this->load->view('actions/user_actions', [], true);
            $data[] = $temp;
            unset($temp);
        }

        $this->_ajaxResponse([
            'data' => $data
        ]);
    }


    public function update($userId) {
        if($this->input->post()) {

            $params = [
                'name' => $this->input->post('name', true),
                'surname' => $this->input->post('surname', true),
                'type' => $this->input->post('type', true)
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
                $result = $this->UsersModel->update($userId, $params);
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