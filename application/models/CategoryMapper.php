<?php
require_once 'Zend/Db/Table/Abstract.php';
class Application_Model_CategoryMapper
{
    protected $_dbTable;


    public function setDbTable($dbTable) {

        if (is_string($dbTable)) {
            $dbTable = new $dbTable();

        }
        if (!$dbTable instanceof Zend_Db_Table_Abstract) {
            throw new Exception('Invalid table data gateway provided');
        }
        $this->_dbTable = $dbTable;
        return $this;
    }

    public function getDbTable() {
        if (null === $this->_dbTable) {
            $this->setDbTable('Application_Model_DbTable_Category');
        }
        return $this->_dbTable;
    }

    public function fetchAll() {
        $resultSet = $this->getDbTable();
        $resultSet = $this->getDbTable()->fetchAll();

        $entries   = array();

        foreach ($resultSet as $i => $row) {
            $entries[$i] = $row->toArray();
        }
        return $entries;
    }

    public function fetchJson() {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries   = array();
        foreach ($resultSet as $row) {
            $entries[] = $row->toArray();
        }
        return json_encode($entries);
    }
}

