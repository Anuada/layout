<?php

class DbHelper
{
    private $hostname = "127.0.0.1";
    private $username = "root";
    private $password = "";
    private $database = "ccv";
    private $conn;

    public function __construct()
    {
        $this->conn = new mysqli($this->hostname, $this->username, $this->password, $this->database);
    }

    public function __destruct()
    {
        $this->conn->close();
    }

    # Fetch one or more records
    public function fetchRecords($table, $args = null)
    {
        if ($args != null) {
            $key = array_keys($args);
            $value = array_values($args);
            $condition = $this->condition($key, $value, "0", " AND ");
            $sql = "SELECT * FROM `$table` WHERE $condition";
        } else {
            $sql = "SELECT * FROM `$table`";
        }
        $query = $this->conn->query($sql);
        $rows = [];
        while ($row = $query->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }

    //Dashboard for lawyer Booked appointment


    //Viewing Events

    public function youthleader_viewing_events($id)
    {
        $sql = "SELECT 
        leader_upload_events.id,
        leader_upload_events.TypeofEvents AS event,
        leader_upload_events.Description AS des
        
       
    FROM 
        leader_upload_events
   
    WHERE  
        leader_upload_events.Youth_leaderId = '$id';
    ";

        $query = $this->conn->query($sql);
        $Cservices = array();
        while ($row = $query->fetch_assoc()) {
            $Cservices[] = (object) $row;
        }
        return $Cservices;
    }

    #dashboard for youth leader

    public function youth_joining_event($id)
    {
        $sql = "SELECT 
        youth_joining_event.id,
        youth_joining_event.typeof_event AS event,
        users.fname,
        users.lname,
        users.profileImage,
        youth_joining_event.reason,
        youth_joining_event.bookingStatus

    FROM 
        users
    JOIN 
        youth_joining_event ON youth_joining_event.userId = users.accountId 
    WHERE  
        youth_joining_event.youth_leaderId = '$id';
    ";


        $query = $this->conn->query($sql);
        $Cservices = array();
        while ($row = $query->fetch_assoc()) {
            $Cservices[] = (object) $row;
        }
        return $Cservices;
    }



    //users view events
    public function youth_view_event($id)
    {
        $sql = "SELECT 
        youth_joining_event.id,
        youth_joining_event.typeof_event AS event,
        youth_leader.fname,
        youth_leader.lname,
        youth_leader.profileImage,
        youth_joining_event.bookingStatus,
        leader_upload_events.location
    FROM 
        youth_leader
    JOIN 
        youth_joining_event ON youth_joining_event.youth_leaderId = youth_leader.accountId 
    JOIN
        leader_upload_events ON leader_upload_events.youth_leaderId = youth_leader.accountId
    WHERE  
        youth_joining_event.userId = '$id';";

        $query = $this->conn->query($sql);
        $Cservices = array();
        while ($row = $query->fetch_assoc()) {
            $Cservices[] = (object) $row;
        }
        return $Cservices;
    }

    #Delete record/s


    public function deleteRecord($table, $args)
    {
        $key = array_keys($args);
        $value = array_values($args);
        $condition = $this->condition($key, $value, "0", " AND ");
        $sql = "DELETE FROM `$table` WHERE $condition";
        $this->conn->query($sql);
        return $this->conn->affected_rows;
    }

    #Add record/s
    public function addRecord($table, $args)
    {
        $key = array_keys($args);
        $value = array_values($args);
        $keys = implode("`, `", $key);
        $values = implode("', '", $value);
        $sql = "INSERT INTO `$table` (`$keys`) VALUES ('$values')";
        $this->conn->query($sql);
        return $this->conn->affected_rows;
    }

    #Update record/s
    public function updateRecord($table, $args)
    {
        $key = array_keys($args);
        $value = array_values($args);
        $set = $this->condition($key, $value, "1", ", ");
        $sql = "UPDATE `$table` SET $set WHERE `$key[0]` = '$value[0]'";
        $this->conn->query($sql);
        return $this->conn->affected_rows;
    }

    public function getCurrentYear()
    {
        $sql = "SELECT CURRENT_DATE AS `currentDate`";
        $query = $this->conn->query($sql);
        $date = $query->fetch_assoc();
        $year = date("Y", strtotime($date["currentDate"]));
        return $year;
    }

    private function condition($key, $value, $index, $implode)
    {
        $condition = [];
        for ($i = $index; $i < count($key); $i++) {
            $condition[] = "`" . $key[$i] . "` = '" . $value[$i] . "'";
            $cond = implode($implode, $condition);
        }
        return $cond;
    }
}
