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



//$order_num = 1091806727;
$order_num = (int)$_POST['this_order'];
$order_total = (float)$_POST['my_total'];
$shipping_address_street = $_POST['street'];
$shipping_address_state = $_POST['state'];
$shipping_address_city = $_POST['city'];
$shipping_address_zip = $_POST['zip'];


	$ses_sql= mysqli_query($conn, "SELECT * FROM Cart WHERE username = '$login_session_username'");

	$index_1 = 1;
	while ($row = mysqli_fetch_assoc($ses_sql)) {

		$field1 = $row['itemID'];
		$field2 = $row['desired_quantity'];
		$field3 = $row['username'];
		
		
		$ses_sql2= mysqli_query($conn, "SELECT Inventory.quantity, Inventory.price,Inventory.on_promotion, Inventory.promo_price FROM Inventory WHERE Inventory.itemID = '$field1';");
		$new_quantity;
		$component_price = 0;
		while ($row2 = mysqli_fetch_assoc($ses_sql2)) {
			$field4 = $row2['quantity'];
			$field5 = $row2['price'];
			$field6 = $row2['on_promotion'];
			$field7 = $row2['promo_price'];
			
			if($field6 == 1)
			{
			
				$component_price = $field7;
			}
			else{
				$component_price = $field5;
			}
			$new_quantity = $field4 - $field2;
			// // // //Add error case check later!!!!!!!!!!!

			//mysqli_query($conn, "UPDATE Inventory SET Inventory.quantity = '$new_quantity' WHERE Inventory.itemID = '$field1';");// or die(mysqli_error());
			
		}//
		 if($index_1 == 1)
		 {
		 
		 mysqli_query($conn, "INSERT INTO Orders(orderID, username, status, o_date, shipping_address_street, shipping_address_state, shipping_address_city, shipping_address_zip, total_price)
		 VALUES ('$order_num', '$login_session_username', 0, NOW(), '$shipping_address_street', '$shipping_address_state', '$shipping_address_city', '$shipping_address_zip', '$order_total');");//or die(mysqli_error());
		 }
		  
         mysqli_query($conn,"INSERT INTO Order_Details(orderID, itemID, quantity, component_price) VALUES ('$order_num', '$field1','$field2', '$component_price')");// or die(mysqli_error());
		

		 $index_1++;
	}
	
    mysqli_query($conn, "DELETE FROM Cart WHERE username = '$login_session_username'");

	echo "<script>swal('You have successfully checked out!', 'We will ship your order as soon as possible');</script>";
	
	echo "<meta http-equiv=\"refresh\" content=\"3;URL= viewcartpage.php\">";

?>
