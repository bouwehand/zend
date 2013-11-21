<?php

class ExController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
    }

    public function indexAction() {

        // Initials
        $date   = '2013-10-24';
        $lastday = date('Y-m-d', strtotime('-1 day', strtotime($date)));
        $ccur   = 'eu';
        $amount = 10;
        $ex = new Application_Model_ExMapper();
        $currencies = array(
            'eu_us',
            'eu_bp',
        );

        //walk trough conversions if one is alright
        foreach ( $currencies as $i => $currency ){
          $differences[$currency] =$ex->getDifference($currency, $date);
        }
        arsort($differences);
        $finalCur = current(array_keys($differences));

        // jeej get new amount
        $row = current($ex->fetchByDate($date));
        $newAmount = $row[$finalCur] * $amount;

        $row = current($ex->fetchByDate($lastday));
        $oldAmount = $row[$finalCur] * $amount;
        die(
            $oldAmount . ' ' . $finalCur . "\r\n" .
            $newAmount . ' ' . $finalCur . "\r\n"

        );
    }
}