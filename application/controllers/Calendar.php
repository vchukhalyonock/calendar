<?php
class Calendar extends MY_Controller {

    public function __construct(){
        parent::__construct();
        $this->_checkAjax();
        $this->load->model("EventsModel");
    }


    public function createEvent() {
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


    public function updateEvent($id) {

        if($this->input->post("start") && $this->input->post("end")) {
            $start = $this->input->post("start", true);
            $end = $this->input->post("end", true);

            $startSplit = explode("T", $start);
            $endSplit = explode("T", $end);

            $params = [
                'dateFrom' => $startSplit[0],
                'dateTo' => $endSplit[0],
                'timeFrom' => $startSplit[1],
                'timeTo' => $endSplit[1]
            ];
        } else {
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
        }

        $result = $this->EventsModel->update($id, $params);
        if($result) {
            $response = [
                'status' => true,
                'event' => $this->EventsModel->get($id)
            ];
        } else {
            $response = [
                'status' => false,
                'event' => $params
            ];
        }

        $this->_ajaxResponse($response);
    }


    public function getEvents() {

        $dateFrom = $this->input->post("startDate", true);
        $dateTo = $this->input->post("endDate", true);

        $events = $this->EventsModel->getEvents($this->_userId, $dateFrom, $dateTo);

        $this->_ajaxResponse([
            'status' => true,
            'events' => $events
        ]);
    }


    public function delete($id) {
        $result = $this->EventsModel->delete($id);
        if($result) {
            $response = ['status' => true];
        } else {
            $response = ['status' => false];
        }

        $this->_ajaxResponse($response);
    }
}
?>