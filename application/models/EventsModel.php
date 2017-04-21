<?php
class EventsModel extends MY_Model {

    protected $_dataScheme = [
        'name' => [
            'type' => 'string',
            'required' => true
        ],
        'dateFrom' => [
            'type' => 'string',
            'required' => true
        ],
        'timeFrom' => [
            'type' => 'string',
            'required' => true
        ],
        'dateTo' => [
            'type' => 'string',
            'required' => true
        ],
        'timeTo' => [
            'type' => 'string',
            'required' => true
        ],
        'description' => [
            'type' => 'string',
            'null' => true,
            'empty' => true
        ],
        'userId' => [
            'type' => 'int',
            'required' => true
        ],
        'status' => [
            'type' => 'string',
            'required' => true
        ],
        'color' => [
            'type' => 'string',
            'required' => true
        ]
    ];

    public function __construct() {
        parent::__construct();
    }


    public function create($params) {
        try {
            $insParams = $this->_dbValidator($params);
        } catch (Exception $e) {
            log_message("debug", "EventsModel::create : " . $e->getMessage());
            return false;
        }

        try {
            $this->db
                ->insert(
                    $this->_eventsTable,
                    $insParams
                );
        } catch (Exception $e) {
            log_message("debug", "EventsModel::create : " . $e->getMessage());
            return false;
        }

        return $this->db->insert_id();
    }


    public function update($id, $params) {
        try {
            $insParams = $this->_dbValidator($params, true);
        } catch (Exception $e) {
            log_message("debug", "EventsModel::update : " . $e->getMessage());
            return false;
        }

        try {
            $this->db
                ->update(
                    $this->_eventsTable,
                    $insParams,
                    ['id' => intval($id)]
                );
        } catch (Exception $e) {
            log_message("debug", "EventsModel::update : " . $e->getMessage());
            return false;
        }

        return true;
    }


    public function get($id) {
        try {
            $res = $this->db
                ->select("
                    id,
                    name,
                    dateFrom,
                    timeFrom,
                    dateTo,
                    timeTo,
                    description,
                    userId,
                    status,
                    color
                    ")
                ->from($this->_eventsTable)
                ->where('id', intval($id))
                ->limit(1)
                ->get();
        } catch (Exception $e) {
            log_message("debug", "EventsModel::get : " . $e->getMessage());
            return false;
        }

        return $res->row();
    }


    public function delete($id) {
        try {
            $this->db->delete($this->_eventsTable, ['id' => intval($id)]);
        } catch (Exception $e) {
            log_message("debug", "EventsModel::delete : " . $e->getMessage());
            return false;
        }

        return true;
    }

    public function getEvents($userId, $dateFrom, $dateTo) {
        try {
            $res = $this->db
                ->select("
                    id,
                    name,
                    dateFrom,
                    timeFrom,
                    dateTo,
                    timeTo,
                    description,
                    userId,
                    status,
                    color
                    ")
                ->from($this->_eventsTable)
                ->where([
                    'userId' => intval($userId),
                    'dateFrom' => strval($dateFrom),
                    'dateTo' => strval($dateTo)
                ])
                ->get();
        } catch (Exception $e) {
            log_message("debug", "EventsModel::getEvents : " . $e->getMessage());
            return false;
        }

        return $res->result();
    }
}
?>