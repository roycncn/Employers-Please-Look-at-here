<?php

/**
 * Class Overview
 * This controller shows the (public) account data of one or all user(s)
 */
class Overview extends Controller {

    /**
     * Construct this object by extending the basic Controller class
     */
    function __construct() {
        parent::__construct();
    }

    /**
     * This method controls what happens when you move to /overview/index in your app.
     * Shows a list of all users.
     */
    function index() {
        $overview_model = $this->loadModel('Overview');
        $this->view->users = $overview_model->getAllUsersProfiles();
        $this->view->admin = $overview_model->getAllAdminProfiles();
        $this->view->render('overview/index');
    }

    /**
     * This method controls what happens when you move to /overview/showuserprofile in your app.
     * Shows the (public) details of the selected user.
     * @param $user_id int id the the user
     */
    function showUserProfile($user_id) {
        if (isset($user_id)) {
            $overview_model = $this->loadModel('Overview');
            $this->view->user = $overview_model->getUserProfile($user_id);
            $this->view->render('overview/showuserprofile');
        } else {
            header('location: ' . URL);
        }
    }

    /**
     * This method controls what happens when you move to /overview/showadminprofile in your app.
     * Shows the (public) details of the selected user.
     * @param $admin_id int id the the admin
     */
    function showAdminProfile($admin_id) {
        if (isset($admin_id)) {
            $overview_model = $this->loadModel('Overview');
            $this->view->admin = $overview_model->getAdminProfile($admin_id);
            $this->view->render('overview/showadminprofile');
        } else {
            header('location: ' . URL);
        }
    }

}
