<?php

include 'session.php';

$myitem = $_GET['itemID'];


echo "$myitem";

mysqli_query($conn, "DELETE FROM Cart WHERE username = '$login_session_username' AND itemID = '$myitem';") or die(mysqli_error());



header("location: viewcartpage.php");
?>