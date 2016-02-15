<?php

/**
 * LoginModel
 *
 * Handles the user's login / logout / registration stuff
 */
class UserModel {

    /**
     * Constructor, expects a Database connection
     * @param Database $db The Database object
     */
    public function __construct(Database $db) {
        $this->db = $db;
    }

    /**
     * Login process (for DEFAULT user accounts).
     *
     * @return bool success state
     */
    public function login() {
        // we do negative-first checks here
        if (!isset($_POST['ssoid']) OR empty($_POST['ssoid'])) {
            $_SESSION["feedback_negative"][] = FEEDBACK_USERNAME_FIELD_EMPTY;
            return false;
        }
        if (!isset($_POST['password']) OR empty($_POST['password'])) {
            $_SESSION["feedback_negative"][] = FEEDBACK_PASSWORD_FIELD_EMPTY;
            return false;
        }


        //ready to verify
        $sth = $this->db->prepare("SELECT ssoid,
                                          sname,
                                          password
                                   FROM   users
                                   WHERE  ssoid = :ssoid");


        $sth->execute(array(':ssoid' => $_POST['ssoid']));
        $count = $sth->rowCount();
        // if there's NOT one result
        if ($count != 1) {

            // was FEEDBACK_USER_DOES_NOT_EXIST before, but has changed to FEEDBACK_LOGIN_FAILED
            // to prevent potential attackers showing if the user exists

            $_SESSION["feedback_negative"][] = FEEDBACK_LOGIN_FAILED;
            return false;
        }

        // fetch one row (we only have one result)
        $result = $sth->fetch();

        // check if hash of provided password matches the hash in the database (A php5.5 function)
        if ($_POST['password'] === $result->password) {



            // login process, write the user data into session
            Session::init();
            Session::set('user_logged_in', true);
            Session::set('sname', $result->sname);
            Session::set('ssoid', $result->ssoid);


            // return true to make clear the login was successful
            return true;
        } else {

            $_SESSION["feedback_negative"][] = FEEDBACK_PASSWORD_WRONG;
            return false;
        }

        // default return
        return false;
    }

    /**
     * Log out process, deletes cookie, deletes session
     */
    public function logout() {
        // delete the session
        Session::destroy();
    }

    /**
     * Returns the current state of the user's login
     * @return bool user's login status
     */
    public function isUserLoggedIn() {
        return Session::get('user_logged_in');
    }

}
