<?php

/**
 * Class Index
 * The index controller
 */
class Index extends Controller {

    /**
     * Construct this object by extending the basic Controller class
     */
    function __construct() {
        parent::__construct();
    }

    /**
     * Handles what happens when user moves to URL/index/index, which is the same like URL/index or in this
     * case even URL (without any controller/action) as this is the default controller-action when user gives no input.
     */
    function index() {


        if (Session::get('admin_logged_in') == true||Session::get('user_logged_in') == true) {
            // if YES, then move user to dashboard/index
            header('location: ' . URL . 'dashboard/index');
        } else {
            // if NO, then move user to login/index (login form) again
            $this->view->render('index/index');
        }



    }

}
