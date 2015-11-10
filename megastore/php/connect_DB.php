<?php
/*
This function connects website to database on 
MySQL on multilab server

It includes
host
username
password

*/

$username = "prgo222";
$password = "ukycsdatabase405";

$server = "MastelottoPlan.backups.uky.edu";
    
// Connecting to the SQL server at cs.uky.edu.
$conn = mysqli_connect($server, $username, $password, $username);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


?>
