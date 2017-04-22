<?php
class Auth extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("UsersModel");
    }

    public function index() {
        redirect('/');
    }

    public function login() {
        $email = $this->input->post("email", true);
        $password = $this->input->post("password", true);

        if($email && $password) {
            $userId = $this->authlib->verify($email, hash("md5", $password));
            if($userId) {
                $this->authlib->setCurrentUser($userId);
            }
        }

        redirect("/");
    }

    public function logout() {
        $this->authlib->unsetCurrentUser();
        redirect("/");
    }


    public function register() {
        if($this->input->post()) {
            $this->form_validation
                ->set_rules(
                    'email',
                    'Email',
                    'required|is_unique[users.email]|min_length[3]|max_length[255]|valid_email'
                );
            $this->form_validation
                ->set_rules(
                    'password',
                    'Password',
                    'required|min_length[3]|max_length[32]'
                );
            $this->form_validation
                ->set_rules(
                    "confirm-password",
                    "Confitm Password",
                    'required|min_length[3]|max_length[32]|matches[password]'
                );

            if($this->form_validation->run() !== FALSE) {
                $params = [
                    'email' => $this->input->post("email", true),
                    'password' => hash("md5", $this->input->post('password', true)),
                    'type' => 'user'
                ];

                $userId = $this->UsersModel->create($params);
                if($userId) {
                    $this->authlib->setCurrentUser($userId);
                    redirect("/");
                }
                else
                    $this->session->set_flashdata("error", "Error during registration.");
            } else {
                $this->session->set_flashdata("error", validation_errors());
                redirect("/");
            }
        } else {
            redirect("/");
        }
    }
}
?>