<?php
class MY_Model extends CI_Model {

    protected $_usersTable = 'users';
    protected $_eventsTable = 'events';
    protected $_dataScheme = [];

    public function __construct() {
        parent::__construct();
    }

    protected function _dbValidator($params = array(), $update = false) {

        return $update ? $this->_dbUpdateValidator($params) : $this->_dbCreateValidator($params);
    }


    private function _dbUpdateValidator($params = array()) {
        $result = [];

        foreach ($params as $key => $value) {
            if(array_key_exists($key, $this->_dataScheme)) {
                if(isset($this->_dataScheme[$key]['null']) && $this->_dataScheme[$key]['null'] && is_null($value)) {
                    $result[$key] = null;
                } elseif ($this->_dataScheme[$key]['type'] == 'string'
                    && (!isset($this->_dataScheme[$key]['empty']) || !$this->_dataScheme[$key]['empty'])
                    && trim(strval($value)) == '') {
                    throw new Exception($key . ' fields is not be empty');
                }
                else
                    $result[$key] = $this->_typeSeparator($this->_dataScheme[$key]['type'], $value);
            }
        }

        return $result;
    }


    private function _dbCreateValidator($params = array()) {
        $result = [];

        foreach ($this->_dataScheme as $key => $value) {

            if($value['required'] && !array_key_exists($key, $params))
                throw new Exception($key . " field required");

            if(isset($value['null']) && $value['null'] && is_null($params[$key]))
                $result[$key] = null;
            else {
                if($value['type'] == 'string'
                    && (!isset($value['empty']) || !$value['empty'])
                    && trim(strval($params[$key])) == '')
                        throw new Exception($key . ' fields is not be empty');
                else
                    $result[$key] = $this->_typeSeparator($value['type'], $params[$key]);
            }

        }
        return $result;
    }


    private function _typeSeparator($type, $value) {
        switch ($type) {
            case 'int':
                return intval($value);
                break;

            case 'float':
                return floatval($value);
                break;

            default:
                return trim(strval($value));
                break;
        }
    }
}
?>