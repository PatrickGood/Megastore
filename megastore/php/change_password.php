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
include 'session.php';

$Mpassword = $_POST['password'];


if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
}

else {

	$sql = "UPDATE Users SET password = '$Mpassword' WHERE username = '$login_session_username'";
	if (mysqli_query($conn, $sql)) {
    			
			echo "<script>swal('Password Has been Updated Successfully for $login_session_username.!!'); </script>";
			echo "<meta http-equiv=\"refresh\" content=\"2;URL=change_user.php\">";
			
		}
		 else {
   			 echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
	

	}

mysqli_close($conn);

?>