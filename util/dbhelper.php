<?php

class DbHelper
{
   private $hostname ="127.0.0.1";
   private $username="root";
   private $password ="";
   private $database ="insert";
   private $conn;

   public function __construct()
   {
    $this->conn = new mysqli($this->hostname, $this->username, $this->password, $this->database);
   }

   public function __destruct()
   {
    $this->conn->close();
   }

    public function getAllRecords($table)
    {
        $rows = [];
        $sql = "SELECT * FROM `$table`";
        $query = $this->conn->query($sql);
        while ($row = $query->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }

    public function getRecord($table, $args)
    {
        $keys = array_keys($args);
        $values = array_values($args);
        $condition = [];
        for ($i = 0; $i < count($keys); $i++) {
            $condition[] = "`" . $keys[$i] . "` = '" . $values[$i] . "'";
        }
        $cond = implode(" AND ", $condition);
        $sql = "SELECT * FROM `$table` WHERE $cond";
        $query = $this->conn->query($sql);
        $row = $query->fetch_assoc();
        return $row;
    }

    public function deleteRecord($table, $args)
    {
        $keys = array_keys($args);
        $values = array_values($args);
        $condition = [];
        for ($i = 0; $i < count($keys); $i++) {
            $condition[] = "`" . $keys[$i] . "` = '" . $values[$i] . "'";
        }
        $cond = implode(" AND ", $condition);
        $sql = "DELETE FROM `$table` WHERE $cond";
        $this->conn->query($sql);

        return $this->conn->affected_rows;
    }

    public function addrecord($table, $args)
    {
        $keys = array_keys($args);// get all the keys column names
        $values = array_values($args);// get the all the values inserted to database
        $key = implode("`, `", $keys);// turn the array into a string with specific formating
        $value = implode("', '", $values);
        $sql = "INSERT INTO `$table` (`$key`) VALUES ('$value')";// sql query
        $this->conn->query($sql);//Runs the SQL query using the database connection stored in $this->conn.
        return $this->conn->affected_rows;// Returns the number of rows affected by the query (usually 1 if successful).
    }

    public function updateRecord($table, $args)
    {
        $keys = array_keys($args);
        $values = array_values($args);
        $condition = [];
        for ($i = 1; $i < count($keys); $i++) {
            $condition[] = "`" . $keys[$i] . "` = '" . $values[$i] . "'";
        }
        $sets = implode(", ", $condition);
        $sql = "UPDATE `$table` SET $sets WHERE `$keys[0]` = '$values[0]'";
        $this->conn->query($sql);
        return $this->conn->affected_rows;
    }

    public function join_employee_details_leave()
    {
        $rows = [];
        $sql = "SELECT employees.fname, employees.lname, employees.position, employeedetails.department, employeedetails.salary, COUNT(employeeleaves.id) AS leavecount
        FROM employees
        LEFT JOIN employeeleaves ON employeeleaves.employeeId = employees.id
        LEFT JOIN employeedetails ON employeedetails.employeeId = employees.id
        GROUP BY employees.id
        ";
        $query = $this->conn->query($sql);
        while ($row = $query->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }

}