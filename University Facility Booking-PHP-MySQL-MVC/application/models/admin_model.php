<?php

class AdminModel {

    public function __construct(Database $db) {
        $this->db = $db;
    }

    /**
     * Login Process (for Administrator)
     *
     * @return bool success state
     * */
    public function login() {
        //the first step checks 
        if (!isset($_POST['adminid']) OR empty($_POST['adminid'])) {
            $_SESSION["feedback_negative"][] = FEEDBACK_USERNAME_FIELD_EMPTY;
            return false;
        }
        if (!isset($_POST['password']) OR empty($_POST['password'])) {
            $_SESSION["feedback_negative"][] = FEEDBACK_PASSWORD_FIELD_EMPTY;
            return false;
        }


        //ready to verify
        $sth = $this->db->prepare("SELECT adminid,
										adminName,
										password
								 FROM   admin
								 WHERE  adminid= :adminid");
        $sth->execute(array(':adminid' => $_POST['adminid']));
        $count = $sth->rowCount();
        //if ther is NOT such result
        if ($count != 1) {

            $_SESSION["feedback_negative"][] = FEEDBACK_LOGIN_FIELD;
            return false;
        }


        $result = $sth->fetch();

        if ($_POST['password'] === $result->password) {

            // set the user info into session
            Session::init();
            Session::set('admin_logged_in', true);
            Session::set('adminid', $result->adminid);
            Session::set('adminName', $result->adminName);

            //rerurn true to make clear thar the login was successful
            return true;
        } else {
            $_SESSION["feedback_negative"][] = FEEDBACK_PASSWORD_WRONG;
            return false;
        }
    }

    /**
     * Retuen current state of the Admin's login
     *
     * @return bool login state
     * */
    public function isAdminLoginedIn() {

        return $_SESSION['admin_logged_in'];
    }

    /**
     * Log out process, deletes cookie, deletes session
     */
    public function logout() {
        // delete the session
        Session::destroy();
    }

}

?>