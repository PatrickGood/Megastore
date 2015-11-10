<?php
include 'session.php';

//get post data from form
$item = $_POST['item_toUpdate'];
$quantity = $_POST['quantity_toAdd'];

//get current item quantity


$ses_sql= mysqli_query($conn, "SELECT quantity FROM Inventory WHERE name ='$item';");
//$row = mysqli_fetch_assoc($ses_sql);

// Mysql_num_row is counting table row
$count= mysqli_num_rows($ses_sql);


// If result matched $myusername and $mypassword, table row must be 1 row
if($count==1){
	$add_to_quantity;

	while ($row = mysqli_fetch_assoc($ses_sql)) {
		$field1 = $row['quantity'];

		$add_to_quantity = $field1 + $quantity;

	}
	mysqli_query($conn, "UPDATE Inventory SET quantity = $add_to_quantity WHERE name ='$item';") or die(mysqli_error());
}

header("location: list_inventory.php");

?>