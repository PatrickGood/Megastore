<!DOCTYPE html>
<html lang="en">
  <head>

<script src="../js/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="../css/sweetalert.css">


</head>
<body>

</body>

</html>

<?php
 
 session_start();
 $error = '';
 $username = "prgo222";
 $password = "ukycsdatabase405";
 $server = "MastelottoPlan.backups.uky.edu";

 $conn = mysqli_connect($server, $username, $password, $username);

 $Mpassword = $_POST['password'];
 $Musername = $_POST['username'];

if(!$conn) {
 	die ("Connection failed: " . mysqli_connect_error());

 }
$result = mysqli_query($conn, "SELECT username FROM Users WHERE username = '$Musername' AND password = '$Mpassword'");


$count = mysqli_num_rows($result);




if ($count == 1){
	$_SESSION['user'] = $Musername;

        echo "<meta http-equiv=\"refresh\" content=\"0;URL=user_checker.php\">"; //redirect to browse

}

else {
		echo "<script>swal('Invalid Username/Password Entered', 'Please Try Again!!!!!!'); </script>";
		echo "<meta http-equiv=\"refresh\" content=\"2;URL=../login.html\">"; //redirect to browse
}


mysqli_close($conn);

?>






