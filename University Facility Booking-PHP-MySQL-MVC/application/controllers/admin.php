<?php

/**
 * Class Admin Login
 * Controls the login processes
 */
class admin extends Controller {

    /**
     * Construct this object by extending the basic Controller class
     */
    function __construct() {
        parent::__construct();
    }

    /**
     * Index, Render the admin login 
     */
    function index() {

        //show the view
        $this->view->render('admin/index');
    }

    /**
     *  POST information to Login 
     */
    function login() {

        $admin_model = $this->loadModel('admin');

        $loginsuccessful = $admin_model->login();

        if ($loginsuccessful) {
            //if YES, move to the dashboard
            header('location:' . URL . 'dashboard/index');
        } else {
            //if NO, move the user to login again.
            header('location:' . URL . 'admin/index');
        }
    }

    /**
     * The logout action, login/logout
     */
    function logout() {
        $admin_model = $this->loadModel('admin');
        $admin_model->logout();
        // redirect user to base URL
        header('location: ' . URL);
    }

    /**
     * The showProfile action
     */
    function showProfile() {
        // Auth::handleLogin() makes sure that only logged in users can use this action/method and see that page
        Auth::handleLogin();
        $this->view->render('admin/showprofile');
    }
    
    
        function manageFacility() {
        Auth::handleLogin();
        
        $this->view->render('facility/adminindex');
    }

}

?>