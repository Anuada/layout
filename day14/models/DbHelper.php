<?php

class DbHelper
{
    private $hostname = "127.0.0.1";
    private $username = "root";
    private $password = "";
    private $database = "database";
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
        $keys = array_keys($args);
        $values = array_values($args);
        $key = implode("`, `", $keys);
        $value = implode("', '", $values);
        $sql = "INSERT INTO `$table` (`$key`) VALUES ('$value')";
        $this->conn->query($sql);
        return $this->conn->affected_rows;
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

    public function fetchSingle($table, $conditions = [])
    {
        $condition = [];

        foreach ($conditions as $key => $value) {
            $condition[] = "`$key` = '" . $this->conn->real_escape_string($value) . "'";
        }

        $whereClause = implode(" AND ", $condition);
        $sql = "SELECT * FROM `$table`" . (!empty($whereClause) ? " WHERE $whereClause" : "") . " LIMIT 1";

        $query = $this->conn->query($sql);

        if ($query && $query->num_rows > 0) {
            return $query->fetch_assoc();
        }

        return null;
    }

    public function fetchData_users($id)
    {
        $sql = "SELECT 
                    account.email,
                    users.fname,
                    users.lname,
                    users.contactNo,
                    users.address,
                    users.userId,
                    account.accountId

                FROM users
                LEFT JOIN account ON users.accountId = account.accountId
                WHERE users.accountId = ?";

        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            die("Prepare failed: " . $this->conn->error);
        }

        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        $fetchData = [];
        while ($row = $result->fetch_assoc()) {
            $fetchData[] = (object) $row;
        }

        $stmt->close();
        return $fetchData;
    }
    // display for the admin page query
    public function fetchData_user()
    {
        $sql = "SELECT 
                    account.email,
                    users.userId,
                    users.fname,
                    users.lname,
                    users.contactNo,
                    users.address,
                    users.accountId,
                    account.accountId
                    
            
                FROM users
                LEFT JOIN account ON users.accountId = account.accountId";

        $result = $this->conn->query($sql);

        $fetchData = [];
        while ($row = $result->fetch_assoc()) {
            $fetchData[] = $row;
        }
        return $fetchData;
    }

  
    
}
