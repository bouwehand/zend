<?php

class Application_Model_DbTable_Category extends Zend_Db_Table_Abstract {

    protected $_name = 'category';
    protected $_dependentTables = array('Product');

    protected $_referenceMap    = array(
        'Product' => array(
            'columns'           => 'id',
            'refTableClass'     => 'Application_Model_DbTable_Product',
            'refColumns'        => 'category'
        ),
    );

}
