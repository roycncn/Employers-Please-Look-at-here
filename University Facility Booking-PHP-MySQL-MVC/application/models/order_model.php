<?php

/**
 * OrderModel
 * This is basically a simple CRUD (Create/Read/Update/Delete) demonstration.
 */
class OrderModel {

    /**
     * Constructor, expects a Database connection
     * @param Database $db The Database object
     */
    public function __construct(Database $db) {
        $this->db = $db;
    }

    /**
     * Getter for all order (order are an implementation of example data, in a real world application this
     * would be data that the user has created)
     * @return array an array with several objects (the results)
     */
    public function getAllOrders() {  // to be modified => user_id in database user table
        $sql = "SELECT orderId, ssoid, fid, phoneNumber, bookTime, numOfUser, purpose, price, isPaid, isWithdraw, isCheckIn useHour, useDate FROM forder WHERE ssoid = :ssoid";
        $query = $this->db->prepare($sql);
        $query->execute(array(':ssoid' => $_SESSION['ssoid'])); // user_id to be modified
        // fetchAll() is the PDO method that gets all result rows


        $all_user_order = array();

        foreach ($query->fetchAll() as $order) {

            $all_user_order[$order->orderId] = new stdClass();
            $all_user_order[$order->orderId]->orderId = $order->orderId;
            $all_user_order[$order->orderId]->ssoid = $order->ssoid;
            $all_user_order[$order->orderId]->fid = $order->fid;
            $all_user_order[$order->orderId]->bookTime = $order->bookTime;
            $all_user_order[$order->orderId]->isWithdraw = $order->isWithdraw;

        $sql_1 = "SELECT fname FROM facility WHERE fid = :fid";
        $query = $this->db->prepare($sql_1);
        $query->execute(array(':fid' => $order->fid)); // user_id to be modified
        $result = $query->fetchAll();
            $all_user_order[$order->orderId]->fname = $result[0]->fname;
        }

        return $all_user_order;
    }

    /**
     * Getter for a single order
     * @param int $orderid id of the specific note
     * @return object a single object (the result)
     */
    public function getOrder($orderid) {
        $sql = "SELECT orderID, ssoid, fid, phoneNumber, bookTime, numOfUser, purpose, price, isPaid, isWithdraw, isCheckIn, useHour, useDate FROM forder WHERE orderid = :orderid";
        $query = $this->db->prepare($sql);
        $query->execute(array(':orderid' => $orderid));

          $order=$query->fetchAll();

        $sql_1 = "SELECT fname FROM facility WHERE fid = :fid";
        $query = $this->db->prepare($sql_1);
        $query->execute(array(':fid' => $order[0]->fid)); // user_id to be modified
        $result = $query->fetchAll();

        $order[0]->fname = $result[0]->fname;    
        $d=$order[0]->useHour;
        $e=str_split($d,1);
        for($j=1;$j<13;$j++)
            {if ($e[$j]==1)
                {$f[$j]=$j+8;}
            }

        $order[0]->starttime=min($f);
        $order[0]->endtime=max($f)+1;

        return $order;
        // fetch() is the PDO method that gets a single result
       
    }

    /**
     * Setter for a order (create)
     * @param string $order order that will be created
     * @return bool feedback (was the order created properly ?)
     */
    public function create($order) {
        // clean the input to prevent for example javascript within the notes.
        // $order = strip_tags($order);

        $starttime=$order['startTime'];
        $endtime=$order['endTime'];
        $d='1';

        for ($i=9;$i<=20;$i++){
            if ($i>=$starttime&&$i<$endtime){
                $d.=1;
         }else {
              $d.=0;
             }

        }


        $sql = "INSERT INTO forder (ssoid, fid, phoneNumber, bookTime, numOfUser, purpose, price, useHour, useDate) "
                . "VALUES (:ssoid, :fid, :phoneNumber, :bookTime, :numOfUser, :purpose, :price, :useHour, :useDate)";
        $query = $this->db->prepare($sql);
        $query->execute(array(
            ':ssoid' => $order['ssoid'],
            ':fid' => $order['fid'],
            ':phoneNumber' => $order['phoneNumber'],
            ':bookTime' => $order['bookTime'],
            ':numOfUser' => $order['numOfUser'],
            ':purpose' => $order['purpose'],
            ':price' => $order['price'],
            ':useHour' => $d,
            ':useDate' => $order['useDate']));

        $count = $query->rowCount();
        if ($count == 1) {
            return true;
        } else {
            $_SESSION["feedback_negative"][] = FEEDBACK_NOTE_CREATION_FAILED;
        }
        // default return
        return false;
    }

    public function withdraw($orderId) {
        $sql = "UPDATE forder SET isWithdraw = 1 WHERE orderId = :orderId AND ssoid = :ssoid";
        $query = $this->db->prepare($sql);
        $query->execute(array(':orderId' => $orderId, ':ssoid' => $_SESSION['ssoid']));

        $count = $query->rowCount();
        if ($count == 1) {
            return TRUE;
        } else {
            $_SESSION["feedback_negative"][] = FEEDBACK_NOTE_EDITING_FAILED;
        }
    }

}
