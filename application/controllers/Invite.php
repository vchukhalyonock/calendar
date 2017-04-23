<?php
 class Invite extends MY_Controller {

     public function __construct() {
         parent::__construct();
         $this->_checkAjax();

         $this->load->library('email');
         $this->load->model("UsersModel");
     }

     public function index() {

         $email = $this->input->post('email', true);
         $code = uuid();

         $userId = $this->UsersModel->create([
             'email' => $email,
             'password' => "*",
             'registrationCode' => $code,
             'type' => 'user'
         ]);

         if($userId) {

             $message = $this->load->view(
                 "email/invite",
                 [
                     "link" => site_url("auth/register/" . $code)
                 ],
                 true);

             $this->email
                 ->from($this->config->item("reply_email"))
                 ->to($this->input->post("email", true))
                 ->subject("Invite to calendar")
                 ->message($message);

             if ($this->email->send()) {
                 $response = ["status" => true];
             } else {
                 $this->UsersModel->delete($userId);
                 $response = ["status" => false];
             }
         } else {
             $response = ["status" => false];
         }

         $this->_ajaxResponse($response);
     }
 }
?>