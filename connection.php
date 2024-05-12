<?php

// database configuration
$host = "localhost"; // mysql server host address
$username = "root"; // mysql username
$password = ""; // mysql password
$database_name = "main"; // name of the database to connect to

// establishing a connection to the mysql database
$database = new mysqli($host, $username, $password, $database_name);

// checking if the connection was successful
if ($database->connect_error) {
    // if connection fails, terminate the script and display the error message
    die("connection failed: " . $database->connect_error);
}

//-> connection successful. proceed with database operations.

?>