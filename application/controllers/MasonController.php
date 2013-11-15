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

    protected  function getUrlPath () {
        $request = $this->getRequest();
        RETURN DIRECTORY_SEPARATOR
            . $request->getControllerName()
            . DIRECTORY_SEPARATOR
            . $request->getActionName()
            . DIRECTORY_SEPARATOR;
    }


     public function init()
    {
        /* Initialize action controller here */

        // Load an extra helper for this controller

        $this->view->addHelperPath(
            '/home/bas/vhosts/zend/zf_test/application/views/helpers/',
            'Zend_View_Helper_Mason'
        );
    }

     /**
      * Action body
      */
     public function indexAction() {
        // get counter from request for pagination
        $request = $this->getRequest();
        $this->view->urlPath = $this->getUrlPath();

         // check if is ajaxRequest
        if ( $this->CheckAjax($request) ) {
            // Get the products and die Json
            $products = new Application_Model_ProductMapper();
            $products = $products->fetchJson();
            die( $products);
        }
         $this->renderScript('mason/index.phtml');
     }

     public function categoryAction() {

        $request = $this->getRequest();
        $this->view->urlPath = $this->getUrlPath();

         // check if is ajaxRequest
        if ( $this->CheckAjax($request) ) {
            // Get the categories and die JSON
            $categories = new Application_Model_CategoryMapper();
            $categories = $categories->fetchJson();
            die($categories);
        }
        $this->renderScript('mason/index.phtml');
     }
}