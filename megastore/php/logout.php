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
    if (isset($_SESSION['user'])) {
		session_destroy();
		echo "<script>swal('You have Logged Out Successfully. !!'); </script>";
		echo "<meta http-equiv=\"refresh\" content=\"5;URL=../carousel.php\">"; //redirect to home
	}

	else {
		echo "<script>swal('No User is Logged In!'); </script>";
		echo "<meta http-equiv=\"refresh\" content=\"3;URL=../carousel.php\">"; //redirect to home
	}


?>