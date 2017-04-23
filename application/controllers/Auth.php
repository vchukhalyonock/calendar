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
        if($this->uri->rsegment(3)) {
            $user = $this->UsersModel->getByCode($this->uri->rsegment(3));
            if($user) {
                if($this->input->post()) {
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

                    if($this->form_validation->run() !== false) {
                        $params = [
                            'password' => hash("md5", $this->input->post('password', true))
                        ];

                        $result = $this->UsersModel->update($user->id, $params);
                        if($result) {
                            $this->authlib->setCurrentUser($user->id);
                            redirect("/");
                        } else {
                            $this->session->set_flashdata("error", "Unable to set password");
                            redirect('/auth/register/' . $this->uri->rsegment(3));
                        }
                    } else {
                        $this->session->set_flashdata("error", validation_errors());
                        redirect('/auth/register/' . $this->uri->rsegment(3));
                    }
                }

                $this->_HTMLResponse([
                    'view' => 'pages/set_password',
                    'data' => [
                        'code' => $this->uri->rsegment(3),
                        'userId' => $this->_userId,
                        'userType' => $this->_userType
                    ]
                ]);
            }
            else
                redirect("/");
        } else {
            if ($this->input->post()) {
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

                if ($this->form_validation->run() !== FALSE) {
                    $params = [
                        'email' => $this->input->post("email", true),
                        'password' => hash("md5", $this->input->post('password', true)),
                        'type' => 'user'
                    ];

                    $userId = $this->UsersModel->create($params);
                    if ($userId) {
                        $this->authlib->setCurrentUser($userId);
                        redirect("/");
                    } else
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
}
?>