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
//
$order_num=$_GET['order_num'];
$username=$_GET['cust_id'];

$itemIDA = array();
$itemNewQuantity = array();
$itemName = array();
$itemNeededQuantity = array();
$flag  = 0;

	$ses_sql= mysqli_query($conn,"select Orders.orderID, Order_Details.itemID, Order_Details.quantity from Orders, Order_Details WHERE Order_Details.orderID = Orders.orderID AND Orders.status = 0 AND Orders.orderID = '$order_num'");
	
	$new_quantity;
	while ($row = mysqli_fetch_assoc($ses_sql)) {
		
		$field1 = $row['itemID'];
		$field2 = $row['quantity'];	
		
		$seq_sql2 = mysqli_query($conn, "select Inventory.name, Inventory.quantity from Inventory where Inventory.itemID = '$field1'");
		while($row2 = mysqli_fetch_assoc($seq_sql2)){

			$field3 = $row2['quantity'];
			$field4 = $row2['name'];
	
			$new_quantity = $field3 - $field2;
			
		}
		if($new_quantity < 0)
		{
			$flag = 1;
			$itemName[] =  $field4;
			$itemNeededQuantity[] = $new_quantity - 2 *$new_quantity;
		}
		else{

			
			$itemIDA[] = $field1;
			$itemNewQuantity[] = $new_quantity;
		}
		
	}
	if($flag == 0){
		for( $i = 0; $i < count($itemIDA); $i++)
		{

			mysqli_query($conn, "UPDATE Inventory SET quantity = '$itemNewQuantity[$i]' WHERE itemID = '$itemIDA[$i]'");
		}

		mysqli_query($conn, "UPDATE Orders SET status = 1 WHERE orderID = '$order_num' AND username = '$username'");
	}
	else{
			echo " <script>swal('";
			for( $i = 0; $i < count($itemName); $i++)
			{
				echo "Shipping Error, Item:$itemName[$i] Needed Quantity: $itemNeededQuantity[$i], To Ship the Order"; 
			}
			echo "');</script>";
			
	}
	echo "<meta http-equiv=\"refresh\" content=\"6;URL= View_Inventory_Employee.php\">";

?>