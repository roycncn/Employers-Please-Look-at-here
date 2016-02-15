<?php

/**
 * Class facility
 * The facility controller. Here we create, read, update and delete facility.
 */
class facility extends Controller {

    /**
     * Construct this object by extending the basic Controller class
     */
    public function __construct() {
        parent::__construct();

        // VERY IMPORTANT: All controllers/areas that should only be usable by logged-in users
        // need this line! Otherwise not-logged in users could do actions. If all of your pages should only
        // be usable by logged-in users: Put this line into libs/Controller->__construct
        Auth::handleLogin();
    }

    /**
     * This method controls what happens when you move to /order/index in your app.
     * User select query conditions or admin choose operation
     */
    public function Index() {
            $this->view->render('facility/index');
    }

    /**
     * This method controls what happens when you move to /facility/create in your app.
     * Add a new facility. This is usually the target of form submit actions.
     */
    public function create() {


        //if POST data to facility/create
        if (isset($_POST) AND ! empty($_POST)) {

            $facility_model = $this->loadModel('facility');
            $facility_model->create($_POST);
            header('location: ' . URL . 'facility/updateindex');
        }
                $this->view->render('facility/create');
    }

    /**
     * delete a facility
     */
    public function delete() {
        $facility_model = $this->loadModel('facility');
        $this->view->facility = $facility_model->getAllFacilities();
         if (!isset($_POST) OR empty($_POST)){
            $this->view->render('facility/delete');
         }
        if (isset($_POST) AND ! empty($_POST)) {
            $facility_model->delete($_POST['fid']);
           header('location: ' . URL . 'facility/delete');
        }
    }

    /**
     * update an facility
     */
    public function updateindex() {
            $facility_model = $this->loadModel('facility');
            $this->view->facility = $facility_model->getAllFacilities();
        if (!isset($_POST) OR empty($_POST)) {
            $this->view->render('facility/updateindex');
        }
        if (isset($_POST) AND ! empty($_POST)) {
            $this->view->facility = $facility_model->getFacility($_POST['facility']);
            $this->view->render('facility/update');
        }
    }

    public function update() {
        $facility_model = $this->loadModel('facility');
        $facility_model->update($_POST);
        header('location: ' . URL . 'facility/updateindex');
    }

    /**
     * query available facilities
     */
    public function query() {
        $facility_model = $this->loadModel('facility');
        $this->view->facility = $facility_model->query($_POST);
        if(isset($_SESSION['user_logged_in'])){
        $this->view->render('facility/queryresult');
             }
        if(isset($_SESSION['admin_logged_in'])){
        $this->view->render('facility/adminqueryresult');
             }
    }


}
