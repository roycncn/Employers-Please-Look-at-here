<?php

/**
 * OverviewModel
 * Handles data for overviews (pages that show user profiles / lists)
 */
class OverviewModel {

    /**
     * Constructor, expects a Database connection
     * @param Database $db The Database object
     */
    public function __construct(Database $db) {
        $this->db = $db;
    }

    /**
     * Gets an array that contains all the users in the database. The array's keys are the user ids.
     * Each array element is an object, containing a specific user's data.
     * @return array The profiles of all users
     */
    public function getAllUsersProfiles() {
        $sth = $this->db->prepare("SELECT ssoid, sname FROM users");
        $sth->execute();

        $all_users_profiles = array();

        foreach ($sth->fetchAll() as $user) {
            // a new object for every user. This is eventually not really optimal when it comes
            // to performance, but it fits the view style better
            $all_users_profiles[$user->ssoid] = new stdClass();
            $all_users_profiles[$user->ssoid]->ssoid = $user->ssoid;
            $all_users_profiles[$user->ssoid]->sname = $user->sname;
        }
        return $all_users_profiles;
    }

    /**
     * Gets an array that contains all the admin in the database. The array's keys are the admin ids.
     * Each array element is an object, containing a specific user's data.
     * @return array The profiles of all admin /Just for TEST/
     */
    public function getAllAdminProfiles() {
        $sth = $this->db->prepare("SELECT adminid, adminName FROM admin");
        $sth->execute();

        $all_admin_profiles = array();

        foreach ($sth->fetchAll() as $admin) {
            // a new object for every user. This is eventually not really optimal when it comes
            // to performance, but it fits the view style better
            $all_admin_profiles[$admin->adminid] = new stdClass();
            $all_admin_profiles[$admin->adminid]->adminid = $admin->adminid;
            $all_admin_profiles[$admin->adminid]->adminName = $admin->adminName;
        }
        return $all_admin_profiles;
    }

    /**
     * Gets a user's profile data, according to the given $ssoid
     * @param int $ssoid The user's id
     * @return object/null The selected user's profile
     */
    public function getUserProfile($ssoid) {
        $sql = "SELECT ssoid, sname
                FROM users WHERE ssoid = :ssoid";
        $sth = $this->db->prepare($sql);
        $sth->execute(array(':ssoid' => $ssoid));

        $user = $sth->fetch();
        $count = $sth->rowCount();


        return $user;
    }

    /**
     * Gets a admin's profile data, according to the given $ssoid
     * @param int $ssoid The user's id
     * @return object/null The selected user's profile
     */
    public function getAdminProfile($adminid) {
        $sql = "SELECT adminid, adminName
                FROM admin WHERE adminid = :adminid";
        $sth = $this->db->prepare($sql);
        $sth->execute(array(':adminid' => $adminid));

        $admin = $sth->fetch();
        $count = $sth->rowCount();


        return $admin;
    }

}
