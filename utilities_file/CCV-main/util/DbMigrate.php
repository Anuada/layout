<?php

$servername = "127.0.0.1";
$username = "root";
$password = "";
$database = "elevateher";

# Create connection
$conn = new mysqli($servername, $username, $password);

# Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

# Create the database if it doesn't exist
$createDatabaseSQL = "CREATE DATABASE IF NOT EXISTS $database";
executeQuery($conn, $createDatabaseSQL);

# Close the connection
$conn->close();

# Reconnect with the database
$conn = new mysqli($servername, $username, $password, $database);

# Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

# Function to execute SQL queries
function executeQuery($conn, $sql)
{
    try {
        $conn->query($sql);
        echo "Database Migration Successful\n";
    } catch (Exception $e) {
        echo "...\n";
    }
}

# SQL dump content
$sqlDump = file_get_contents('util/elevateher.sql');

# Split SQL dump into individual queries
$queries = explode(";", $sqlDump);

# Execute each query
foreach ($queries as $query) {
    $query = trim($query);
    if (!empty($query)) {
        executeQuery($conn, $query);
    }
}

# Close connection
$conn->close();