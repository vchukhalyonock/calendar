<?php
class Calendar extends MY_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model("EventsModel");
    }


    public function createEvent() {
        if(!$this->input->is_ajax_request())
            redirect("/");

        $params = [
            'name' => $this->input->post('name', true),
            'dateFrom' => $this->input->post('dateFrom', true),
            'timeFrom' => $this->input->post('timeFrom', true),
            'dateTo' => $this->input->post('dateTo', true),
            'timeTo' => $this->input->post('timeTo', true),
            'description' => $this->input->post('description', true),
            'status' => $this->input->post('status', true),
            'color' => $this->input->post('color', true),
            'userId' => $this->_userId
        ];

        $eventId = $this->EventsModel->create($params);
        if($eventId) {
            $response = [
                'status' => true,
                'event' => $this->EventsModel->get($eventId);
            ];
        } else {
            $response = [
                'status' => false,
                'event' => $params
            ];
        }

        $this->_ajaxResponse($response);
    }
}
?>