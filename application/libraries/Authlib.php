<?php
class Authlib {

    private $_CI;
    private $_table;

    public function __construct() {
        $this->_CI = get_instance();
        $this->_CI->load->model('UsersModel');
        $this->_table = $this->_CI->UsersModel->getUsersTable();
    }

    public function verify($email, $password) {
        try {
            $res = $this->_CI->db
                ->select("id")
                ->from($this->_table)
                ->where([
                    'email' => strval($email),
                    'password' => strval($password)
                ])
                ->limit(1)
                ->get();
        } catch (Exception $e) {
            log_message("debug", "Authlib::verify : " . $e->getMessage());
            return false;
        }

        if($res->num_rows() > 0)
            $row = $res->row();

        return isset($row) ? $row->id : false;
    }


    public function getByCode($code) {
        try {
            $res = $this->_CI->db
                ->select("id")
                ->from($this->_table)
                ->where('registrationCode', strval($code))
                ->limit(1)
                ->get();
        } catch (Exception $e) {
            log_message("debug", "Authlib::getByCode : " . $e->getMessage());
            return false;
        }

        if($res->num_rows() > 0)
            $row = $res->row();

        return isset($row) ? $row->id : false;
    }

    public function setCurrentUser($userId) {
        $user = $this->_CI->UsersModel->get(intval($userId));
        if($user) {
            $this->_CI->session->set_userdata([
                'user' => [
                    'id' => $user->id,
                    'info' => [
                        'email' => $user->email,
                        'name' => $user->name,
                        'surname' => $user->surname,
                        'type' => $user->type
                    ]
                ]
            ]);
        }
    }

    public function unsetCurrentUser() {
        $this->_CI->session->unset_userdata('user');
    }

    public function getCurrentUser() {
        return $this->_CI->session->userdata("user");
    }
}
?>