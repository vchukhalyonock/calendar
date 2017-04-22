<?php
class Calendar extends MY_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model("EventsModel");
    }


    public function createEvent() {
        if(!$this->input->is_ajax_request())
            redirect("/");

        $dateTimeFrom = $this->input->post('dateTimeFrom', true);
        $dateTimeTo = $this->input->post('dateTimeTo', true);

        //03/28/2017 12:00 AM

        $dateFrom = null;
        $timeFrom = null;
        $dateTo = null;
        $timeTo = null;

        dateTimeSplit($dateTimeFrom, $dateFrom, $timeFrom);
        dateTimeSplit($dateTimeTo, $dateTo, $timeTo);

        $params = [
            'name' => $this->input->post('name', true),
            'dateFrom' => $dateFrom,
            'timeFrom' => $timeFrom,
            'dateTo' => $dateTo,
            'timeTo' => $timeTo,
            'description' => $this->input->post('description', true),
            'status' => $this->input->post('status', true),
            'color' => $this->input->post('color', true),
            'userId' => $this->_userId
        ];

        log_message("debug", print_r($params, true));

        $eventId = $this->EventsModel->create($params);
        if($eventId) {
            $response = [
                'status' => true,
                'event' => $this->EventsModel->get($eventId)
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