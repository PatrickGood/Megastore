<?php

$username = "prgo222";
$password = "ukycsdatabase405";

$server = "MastelottoPlan.backups.uky.edu";
    
// Connecting to the SQL server at cs.uky.edu.
$conn = mysqli_connect($server, $username, $password, $username);
session_start();// Starting Session
// Storing Session
$user_check= $_SESSION['user'];

// SQL Query To Fetch Complete Information Of User
$ses_sql= mysqli_query($conn, "SELECT * FROM Users WHERE username='$user_check'");
$row = mysqli_fetch_assoc($ses_sql);
$login_session_username =$row['username'];
$login_session_fname =$row['fname'];
$login_session_lname =$row['lname'];
$login_session_email =$row['email'];
$login_session_type = $row['u_type'];


if(!isset($login_session_username)){
mysqli_close($conn); // Closing Connection
}
?>