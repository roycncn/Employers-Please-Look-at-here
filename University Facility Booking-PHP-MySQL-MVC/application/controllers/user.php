<?php

/**
 * Login Controller
 * Controls the login processes
 */
class User extends Controller {

    /**
     * Construct this object by extending the basic Controller class
     */
    function __construct() {
        parent::__construct();
    }

    /**
     * Index, default action (shows the login form), when you do login/index
     */
    function index() {
        // create a login model to perform the getFacebookLoginUrl() method
        // $login_model = $this->loadModel('Login');
        // show the view
        $this->view->render('user/index');
    }

    /**
     * The login action, when you do login/login
     */
    function login() {
        // run the login() method in the login-model, put the result in $login_successful (true or false)
        $login_model = $this->loadModel('User');
        // perform the login method, put result (true or false) into $login_successful
        $login_successful = $login_model->login();

        // check login status
        if (Session::get('admin_logged_in') == true||Session::get('user_logged_in') == true) {
            // if YES, then move user to dashboard/index
            header('location: ' . URL . 'dashboard/index');
        } else {
            // if NO, then move user to login/index (login form) again
            header('location: ' . URL . 'user/index');
        }
    }

    /**
     * The logout action, login/logout
     */
    function logout() {
        $login_model = $this->loadModel('User');
        $login_model->logout();
        // redirect user to base URL
        header('location: ' . URL);
    }

    function showProfile() {
        // Auth::handleLogin() makes sure that only logged in users can use this action/method and see that page
        Auth::handleLogin();
        $this->view->render('user/showprofile');
    }

}
