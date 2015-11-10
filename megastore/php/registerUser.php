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
include 'connect_DB.php';

$Musername=$_POST['username'];
$Mpassword=$_POST['password'];
$Memail=$_POST['email'];
$firstname=$_POST['fname'];
$lastname=$_POST['lname'];
$Mstreet=$_POST['u_street'];
$Mcity=$_POST['u_city'];
$Mstate=$_POST['u_state'];
$Mzip=$_POST['u_zip'];
$label=$_POST['u_type'];

// This condition makes sure about employee code
// which decides whether they are STAFF or Manager.

if (empty($label))
{
	$label = 'customer';
}
else {
	$secretkey = $_POST['employID'];
	if($secretkey == 'manager')
	{
		$label = 'manager';
	}
	else if ($secretkey == 'staff')
	{
		$label = 'staff';
	}
	else
	{
		$label = 'customer';
	}

}



if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
}
else{
        $result = mysqli_query($conn, "SELECT username
                                        FROM Users
                                        WHERE username = '$Musername'");
        $count = mysqli_num_rows($result);
	if($count != 0){

		echo "<script>swal('UserName is Already Taken! Please Try Again!!!!!!!'); </script>";
		echo "<meta http-equiv=\"refresh\" content=\"2;URL=../register.html\">";


        }
        else
        {
                // next, insert the tuples in the tables
		$sql = "INSERT INTO Users(username, password, email, fname, lname, u_street, u_city, u_state, u_zip, u_type)
			VALUES ('$Musername','$Mpassword', '$Memail', '$firstname', '$lastname', '$Mstreet', '$Mcity','$Mstate','$Mzip','$label')";
		if (mysqli_query($conn, $sql)) {
    			
			echo "<script>swal('Thank You For Registering $firstname $lastname.!!'); </script>";
			echo "<meta http-equiv=\"refresh\" content=\"2;URL=../login.html\">";
			
		}
		 else {
   			 echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
	

	}
}
mysqli_close($conn);






?>
