<?php
require_once 'Zend/Db/Table/Abstract.php';
class Application_Model_ProductMapper
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
            $this->setDbTable('Application_Model_DbTable_Product');
        }
        return $this->_dbTable;
    }

    public function fetchAll() {
        $resultSet = $this->getDbTable();
        $resultSet = $this->getDbTable()->fetchAll();

        $entries   = array();

        foreach ($resultSet as $i => $row) {
            $entries[$i] = $row->toArray();
            $entries[$i]['category']= $row->findDependentRowset('Application_Model_DbTable_Category')->toArray();
            $entries[$i]['image']   = $row->findDependentRowset('Application_Model_DbTable_Image')->toArray();
        }
        return $entries;
    }

    public function fetchJson() {
        $resultSet = $this->getDbTable();
        $resultSet = $this->getDbTable()->fetchAll();

        $entries   = array();

        foreach ($resultSet as $i => $row) {
            $entries[$i] = $row->toArray();
            $entries[$i]['category']= $row->findDependentRowset('Application_Model_DbTable_Category')->toArray();
            $entries[$i]['image']   = $row->findDependentRowset('Application_Model_DbTable_Image')->toArray();
        }
        return json_encode($entries);
    }
}

