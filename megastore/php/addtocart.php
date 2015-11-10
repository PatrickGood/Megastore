<?php

include 'session.php';


if ($login_session_username != "") {
$itemName = $_GET['itemName'];
$itemID = $_GET['itemNum'];

$quantity = $_POST['quantity'];



$ses_sql= mysqli_query($conn, "SELECT * FROM Cart WHERE username ='$login_session_username' AND itemID = '$itemID';");
// Mysql_num_row is counting table row
$count=mysqli_num_rows($ses_sql);

// If result matched $myusername and $mypassword, table row must be 1 row
if($count==1){
	$ses_sql3= mysqli_query($conn, "SELECT * FROM Cart WHERE username ='$login_session_username' AND itemID = '$itemID';");


	$add_to_quantity = 0;
	while ($row = mysqli_fetch_assoc($ses_sql3)) {
		
		$field1 = $row['desired_quantity'];

		echo "$field1";

		$add_to_quantity = $field1 + $quantity;

		
		$ses_sql2= mysqli_query($conn, "SELECT quantity FROM Inventory WHERE itemID = '$itemID';");
    
		while ($row2 = mysqli_fetch_assoc($ses_sql2)) {
			$field2 = $row2['quantity'];

			if ($add_to_quantity > $field2) {
				echo "<script>alert('There are not enough items in stock! Please select a lower quantity.');window.location.href='shop.php';</script>";
			}
			else {
				mysqli_query($conn, "UPDATE Cart SET Cart.desired_quantity = $add_to_quantity WHERE username ='$login_session_username' AND itemID = '$itemID';") or die(mysqli_error());
				header("location: shop.php");
			}
		}

	}

}

else {
		
		echo "$login_session_username, $itemID, $quantity";
		mysqli_query($conn, "INSERT INTO Cart(username, itemID, desired_quantity)VALUES ('$login_session_username','$itemID','$quantity')") or die(mysqli_error());

		
			 
		header("location: shop.php");
	}
} else {
	echo "<script>alert('You must be a registered user to perform this action!');window.location.href='shop.php';</script>";
}

?>