<?php

class Application_Model_ExMapper
{


    protected $_dbTable;

    public function setDbTable($dbTable)
    {
        if (is_string($dbTable)) {
            $dbTable = new $dbTable();
        }
        if (!$dbTable instanceof Zend_Db_Table_Abstract) {
            throw new Exception('Invalid table data gateway provided');
        }
        $this->_dbTable = $dbTable;
        return $this;
    }

    public function getDbTable()
    {
        if (null === $this->_dbTable) {
            $this->setDbTable('Application_Model_DbTable_Ex');
        }
        return $this->_dbTable;
    }

    public function fetchAll() {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries   = array();
        foreach ($resultSet as $i=>$row) {
            $entries[$i] = $row->toArray();
        }
        return $entries;
    }

    /*
     *
     */
    public function fetchById($id) {
        $adapter = Zend_Db_Table::getDefaultAdapter();
        return $adapter->fetchAll('SELECT * FROM ex WHERE id = ?', $id);
    }

    /*
     *
     */
    public function fetchByDate($date) {
        $adapter = Zend_Db_Table::getDefaultAdapter();
        return $adapter->fetchAll('SELECT * FROM ex WHERE date = ?', $date);
    }

    /*
     *
     */
    public function fetchByUS($id) {
        $adapter = Zend_Db_Table::getDefaultAdapter();
        return $adapter->fetchAll('SELECT * FROM ex WHERE en_us = ?', $id);
    }

    /*
     *
     */
    public function fetchByBP($date) {
        $adapter = Zend_Db_Table::getDefaultAdapter();
        return $adapter->fetchAll('SELECT * FROM ex WHERE en_bp = ?', $date);
    }

    /**
     * Convert Dollar to Pound
     *
     * @param $amount       amount in dollars
     * @param null $date    date of exchange, null latest
     * @return float        amount in Pounds
     */
    public function fetchUStoBP($amount, $date=null) {

        $dateSql = 'WHERE date = ?';

        if($date == null) {
          $dateSql = 'Limit 1';
        }

        $adapter = Zend_Db_Table::getDefaultAdapter();
        $row = current($adapter->fetchAll('SELECT * FROM ex '. $dateSql));
        return $amount / $row['eu_us'] * $row['eu_bp'];
    }

    /**
     * Convert Pound to Dollar
     *
     * @param $amount       amount in Pounds
     * @param null $date    date of exchange, null latest
     * @return float        amount in dollar
     */
    public function fetchBPtoUS($amount, $date=null) {

        $dateSql = 'WHERE date = ?';

        if($date == null) {
            $dateSql = 'Limit 1';
        }

        $adapter = Zend_Db_Table::getDefaultAdapter();
        $row = current($adapter->fetchAll('SELECT * FROM ex '. $dateSql));
        return $amount / $row['eu_bp'] * $row['eu_us'];
    }


    /**
     * Returns the transformation of the currency over the last day
     *
     * @param $currency
     * @param $amount
     * @param $date
     */
    public function getDifference($currency, $date) {
        $lastday = date('Y-m-d', strtotime('-1 day', strtotime($date)));
        $adapter = Zend_Db_Table::getDefaultAdapter();
        $sql = "SELECT * FROM ex WHERE date >= '{$lastday}' AND date <= '{$date}' ORDER BY date DESC";
        $rows = $adapter->fetchAll($sql);
        return $rows[0][$currency] - $rows[1][$currency];
    }
}

