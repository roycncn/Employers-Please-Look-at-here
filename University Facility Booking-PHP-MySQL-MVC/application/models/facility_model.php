<?php

/**
 * NoteModel
 * This is basically a simple CRUD (Create/Read/Update/Delete) demonstration.
 */
class FacilityModel {

    /**
     * Constructor, expects a Database connection
     * @param Database $db The Database object
     */
    public function __construct(Database $db) {
        $this->db = $db;
    }

    /**
     * Getter for all facility information
     * @return array an array with several objects (the results)
     */
    public function getAllFacilities() {  
        $sql = "SELECT * FROM facility ORDER BY fid";
        $query = $this->db->prepare($sql);
        $query->execute();
        // fetchAll() is the PDO method that gets all result rows
        $facility=$query->fetchAll();

        return $facility;
    }
    
    /** 
     * Getter for facility information
     * @return array an array with object (the result)
     */
     public function getFacility($fid) {  
        $sql = "SELECT * FROM facility WHERE fid=:fid";
        $query = $this->db->prepare($sql);
        $query->execute(array(
             ':fid' => $fid
        ));
        // fetchAll() is the PDO method that gets all result rows
        $facility=$query->fetchAll();
        $d=$facility[0]->opentime;
        $e=str_split($d,1);

        for($j=1;$j<13;$j++){if ($e[$j]==0){$f[$j]=$j+8;}}

        $facility[0]->starttime=min($f);
        $facility[0]->endtime=max($f)+1;
        return $facility;
    }

    

     


    
    /**
     * Setter for a order (create)
     * @param string $facility order that will be created
     * @return bool feedback (was the order created properly ?)
     */
    public function create($facility) {


        $starttime=$facility['startTime'];
        $endtime=$facility['endTime'];
        $d='1';


        for ($i=9;$i<=20;$i++){
            if ($i<$starttime||$i>=$endtime){
                $d.=1;
         }else {
              $d.=0;
             }

        }

        $sql = "INSERT INTO facility ( fname, type, location, numOfUser,price, opentime) "
                . "VALUES ( :fname, :type, :location, :numOfUser,:price , :opentime)";
        $query = $this->db->prepare($sql);
        $query->execute(array(
            ':fname' => $facility['fname'],
            ':type' => $facility['type'],
            ':price' => $facility['price'],
            ':location' => $facility['location'],
            ':numOfUser' => $facility['numOfUser'],
            ':opentime' => $d ));

        $count = $query->rowCount();
        if ($count == 1) {
            return true;
        } else {
            $_SESSION["feedback_negative"][] = FEEDBACK_NOTE_CREATION_FAILED;
        }
        // default return
        return false;
    }
    
    /**
     * Setter for a order (create)
     * @param string $facility order that will be created
     * @return bool feedback (was the order created properly ?)
     */
    public function update($facility) {

        $starttime=$facility['startTime'];
        $endtime=$facility['endTime'];
        $d='1';

        for ($i=9;$i<=20;$i++){
            if ($i<$starttime||$i>=$endtime){
                $d.=1;
         }else {
              $d.=0;
             }

        }

        $sql = "UPDATE facility SET fname=:fname , type=:type , location=:location ,price=:price , numOfUser=:numOfUser , opentime=:opentime WHERE fid=:fid";
        $query = $this->db->prepare($sql);
        $query->execute(array(
            ':fid' => $facility['fid'],
            ':fname' => $facility['fname'],
            ':price' => $facility['price'],
            ':type' => $facility['type'],
            ':location' => $facility['location'],
            ':numOfUser' => $facility['numOfUser'],
            ':opentime' => $d));

        $count = $query->rowCount();
        if ($count == 1) {
            return true;
        } else {
            $_SESSION["feedback_negative"][] = FEEDBACK_NOTE_CREATION_FAILED;
        }
        // default return
        return false;
    }

    public function delete($fid) {
     
        $sql = "delete from facility  WHERE fid = :fid";
        $query = $this->db->prepare($sql);
        $query->execute(array(':fid' => $fid));
        $count = $query->rowCount();
        
        
        if ($count == 1) {
            return TRUE;
        } else {
            $_SESSION["feedback_negative"][] = FEEDBACK_NOTE_EDITING_FAILED;
        }
    }
    

    
      public function query($condition) {

        //Convery array to String
        $location = '';
        $location = implode("','",$condition['location']);
        $type=$condition['type'];
       


        $sql_1 = "SELECT fid, opentime, fname, location,price, numOfUser FROM facility WHERE type='$type' AND location in ('$location') ORDER BY location";


        $query = $this->db->prepare($sql_1);
        $query->execute();
        $facility_time = array();


        

        foreach ($query->fetchAll() as $facility) {

            $facility_time[$facility->fid] = new stdClass();
            $facility_time[$facility->fid]->fid = $facility->fid;
            $facility_time[$facility->fid]->fname = $facility->fname;
            $facility_time[$facility->fid]->location = $facility->location;
            $facility_time[$facility->fid]->opentime = $facility->opentime;
            $facility_time[$facility->fid]->minuser = $facility->numOfUser;
            $facility_time[$facility->fid]->price = $facility->price;
            $facility_time[$facility->fid]->type = $condition['type'];
            $facility_time[$facility->fid]->date = $condition['date'];
            

        $sql_2 = "SELECT SUM(useHour) as utime FROM forder where fid=:fid and iswithdraw=0 and useDate=:usedate group by useDate";
        $query = $this->db->prepare($sql_2);
        $query->execute(array(
            ':fid' => $facility->fid ,
            ':usedate' => $condition['date']));
             $time=$query->fetchAll();

            if($time){
            $facility_time[$facility->fid]->avatime = $time[0]->utime|$facility->opentime;
        }else{
             $facility_time[$facility->fid]->avatime = $facility->opentime;
        }
            }


        return $facility_time;
    }





}
