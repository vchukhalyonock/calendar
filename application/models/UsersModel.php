<?php
class UsersModel extends MY_Model {

    protected $_dataScheme = [
        'email' => [
            'type' => 'string',
            'required' => true
        ],
        'password' => [
            'type' => 'string',
            'required' => true
        ],
        'name' => [
            'type' => 'string',
            'empty' => true,
            'null' => true
        ],
        'surname' => [
            'type' => 'string',
            'empty' => true,
            'null' => true
        ],
        'type' => [
            'type' => 'string'
        ],
        'registrationCode' => [
            'type' => 'string',
            'empty' => true,
            'null' => true
        ]
    ];

    public function __construct() {
        parent::__construct();
    }

    public function create($params = array()) {
        try {
            $insParams = $this->_dbValidator($params);
        } catch (Exception $e) {
            log_message("debug", "UsersModel::create : " . $e->getMessage());
            return false;
        }

        try {
            $this->db
                ->insert(
                    $this->_usersTable,
                    $insParams
                );
        } catch (Exception $e) {
            log_message("debug", "UsersModel::create : " . $e->getMessage());
            return false;
        }

        return $this->db->insert_id();
    }


    public function update($id, $params = array()) {
        try {
            $insParams = $this->_dbValidator($params, true);
        } catch (Exception $e) {
            log_message("debug", "UsersModel::update : " . $e->getMessage());
            return false;
        }

        try {
            $this->db
                ->update(
                    $this->_usersTable,
                    $insParams,
                    ['id' => intval($id)]
                );
        } catch (Exception $e) {
            log_message("debug", "UsersModel::update : " . $e->getMessage());
            return false;
        }

        return true;
    }


    public function delete($id) {
        $this->db->trans_begin();

        try {
            $this->db->delete($this->_usersTable, ['id' => intval($id)]);
        } catch (Exception $e) {
            log_message("debug", "UsersModel::delete : " . $e->getMessage());
            $this->db->trans_rollback();
            return false;
        }

        $this->db->trans_commit();
        return true;
    }


    public function get($id) {
        try {
            $res = $this->db
                ->select("
                    id,
                    email,
                    password,
                    name,
                    surname,
                    type,
                    registrationCode
                    ")
                ->from($this->_usersTable)
                ->where('id', intval($id))
                ->limit(1)
                ->get();
        } catch (Exception $e) {
            log_message("debug", "UsersModel::get : " . $e->getMessage());
            return false;
        }

        return $res->row();
    }


    public function getUsersTable() {
        return $this->_usersTable;
    }

}
?>
