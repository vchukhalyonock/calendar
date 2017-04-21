<?php
class Auth extends MY_Controller {

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
}
?>