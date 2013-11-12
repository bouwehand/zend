<?php
/**
 * Created by PhpStorm.
 * User: bas
 * Date: 11/11/13
 * Time: 10:28 AM
 */
 class MasonController extends Zend_Controller_Action {

     /**
      * CheckAjax
      *
      * Checks if request is Ajax, flag for turning it
      * on and off
      *
      * @param  $request    Mixed
      * @return $bool       bool
      *
      */
    protected function CheckAjax ($request) {

        // Disable check with flag
        if ( $request === false ) {
            return true;
        }

        //check
        if( $request->isXmlHttpRequest() ) {
            return true;
        } else return false;
    }


     public function init()
    {
        /* Initialize action controller here */

    }

     /**
      * Action body
      */
     public function indexAction() {

        // get counter from request for pagination
        $request = $this->getRequest();
        // check if is ajaxRequest
        if ( $this->CheckAjax($request) ) {
            // Get the products and die Json
            $products = new Application_Model_ProductMapper();
            $products = $products->fetchJson();
            die($products);
        }
    }
}