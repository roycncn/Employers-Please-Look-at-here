<?php

/**
 * Class order
 * The order controller. Here we create, read, update and withdraw order.
 */
class order extends Controller {

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
     * Show all the order.
     */
    public function index() {
        $order_model = $this->loadModel('order');
        $this->view->order = $order_model->getAllOrders();
        $this->view->render('order/index');
    }

    /**
     * This method controls what happens when you move to /order/createForm in your app.
     * Creates a new order. This is usually the target of form submit actions.
     */
    public function createForm() {


        //if POST data from query
        if (isset($_POST) AND ! empty($_POST)) {
            $this->view->order = $_POST;
            $this->view->render('order/create');
        } else {
            $this->view->render('order/create');
        }
    }

    /**
     * This method controls what happens when you move to /order/create in your app.
     * Creates a new order. This is usually the target of form submit actions.
     */
    public function create() {



            $order_model = $this->loadModel('order');
            $order_model->create($_POST);

            header('location: ' . URL . 'order/index');
        }

    /**
     * Withdraw an order
     * @param int $order id of the order
     */
    public function withdraw($ordid) {
        $order_model = $this->loadModel('order');
        $order_model->withdraw($ordid);
        header('location: ' . URL . 'order/index');
    }

    /**
     * Show details of an order
     * @param int $order id of the order
     */
    public function showorder($ordid) {
        $order_model = $this->loadModel('order');
        $this->view->order = $order_model->getOrder($ordid);
        $this->view->render('order/showorder');
    }

}
