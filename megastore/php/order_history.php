<?php
include 'session.php';
$status=$_POST['order'];
$timespan=$_POST['timespan'];


$output = array();

if ($timespan == "Week")
{	
	
	$ses_sql;
    if ($status == "All") {
		//echo "One";
		//$ses_sql= mysqli_query($conn, "SELECT Orders.orderID,Orders.username,Orders.status,Orders.o_date, Orders.total_price,Order_Details.itemID, Order_Details.quantity, Order_Details.component_price FROM Orders, Order_Details WHERE Orders.orderID = Order_Details.orderID and o_date >= DATE_SUB(CURDATE(), INTERVAL 7 DAY) ORDER BY o_date DESC;");
		//echo "two";
		$ses_sql= mysqli_query($conn, "SELECT Orders.orderID,Orders.username,Orders.status,Orders.total_price, Orders.o_date,Order_Details.itemID, Order_Details.quantity, Order_Details.component_price FROM Orders, Order_Details WHERE Orders.orderID = Order_Details.orderID and o_date >= DATE_SUB(CURDATE(), INTERVAL 7 DAY) ORDER BY o_date DESC");
    
	}
    else {
		$ses_sql= mysqli_query($conn, "SELECT Orders.orderID,Orders.username,Orders.status,Orders.total_price, Orders.o_date,Order_Details.itemID, Order_Details.quantity, Order_Details.component_price FROM Orders, Order_Details WHERE Orders.orderID = Order_Details.orderID and  o_date >= DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND status = '$status' ORDER BY o_date DESC;");//Might have to change
    }
	while ($row = mysqli_fetch_assoc($ses_sql)) {
        $field1 = $row['orderID'];
        $field2 = $row['username'];
        $field3 = $row['itemID'];
        $field4 = $row['quantity'];
        $field5 = $row['o_date'];
        $field6 = $row['component_price'];
        $field7 = $row['status'];
		$field8 = $row['total_price'];
		
		$ses_sql2= mysqli_query($conn, "SELECT name from Inventory WHERE itemID = '$field3'");
		$row2 = mysqli_fetch_assoc($ses_sql2);
		$field9 = $row2['name'];
		
		
		
		
		//echo " dog";//" $field1, $field2, $field3, $field4, $field5,$field6, $field7 /n ";
        $item = array($field1, $field2, $field3, $field4, $field5,$field6, $field7,$field8,$field9);
        $output[] = $item;

     }

    
}
else if ($timespan == "Month") {

	$ses_sql;
    if ($status == "All") {
		//echo "One";
		//$ses_sql= mysqli_query($conn, "SELECT Orders.orderID,Orders.username,Orders.status,Orders.o_date, Orders.total_price,Order_Details.itemID, Order_Details.quantity, Order_Details.component_price FROM Orders, Order_Details WHERE Orders.orderID = Order_Details.orderID and o_date >= DATE_SUB(CURDATE(), INTERVAL 7 DAY) ORDER BY o_date DESC;");
		//echo "two";
		$ses_sql= mysqli_query($conn, "SELECT Orders.orderID,Orders.username,Orders.status,Orders.total_price, Orders.o_date,Order_Details.itemID, Order_Details.quantity, Order_Details.component_price FROM Orders, Order_Details WHERE Orders.orderID = Order_Details.orderID and o_date >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH) ORDER BY o_date DESC");
    
	}
    else {
		$ses_sql= mysqli_query($conn, "SELECT Orders.orderID,Orders.username,Orders.status,Orders.total_price, Orders.o_date,Order_Details.itemID, Order_Details.quantity, Order_Details.component_price FROM Orders, Order_Details WHERE Orders.orderID = Order_Details.orderID and  o_date >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH) AND status = '$status' ORDER BY o_date DESC;");//Might have to change
    }
	while ($row = mysqli_fetch_assoc($ses_sql)) {
        $field1 = $row['orderID'];
        $field2 = $row['username'];
        $field3 = $row['itemID'];
        $field4 = $row['quantity'];
        $field5 = $row['o_date'];
        $field6 = $row['component_price'];
        $field7 = $row['status'];
		$field8 = $row['total_price'];
		
		$ses_sql2= mysqli_query($conn, "SELECT name from Inventory WHERE itemID = '$field3'");
		$row2 = mysqli_fetch_assoc($ses_sql2);
		$field9 = $row2['name'];
		
		
		
		
		//echo " dog";//" $field1, $field2, $field3, $field4, $field5,$field6, $field7 /n ";
        $item = array($field1, $field2, $field3, $field4, $field5,$field6, $field7,$field8,$field9);
        $output[] = $item;

     }

    
}

else if ($timespan == "Year") {
	$ses_sql;
    if ($status == "All") {
		//echo "One";
		//$ses_sql= mysqli_query($conn, "SELECT Orders.orderID,Orders.username,Orders.status,Orders.o_date, Orders.total_price,Order_Details.itemID, Order_Details.quantity, Order_Details.component_price FROM Orders, Order_Details WHERE Orders.orderID = Order_Details.orderID and o_date >= DATE_SUB(CURDATE(), INTERVAL 7 DAY) ORDER BY o_date DESC;");
		//echo "two";
		$ses_sql= mysqli_query($conn, "SELECT Orders.orderID,Orders.username,Orders.status,Orders.total_price, Orders.o_date,Order_Details.itemID, Order_Details.quantity, Order_Details.component_price FROM Orders, Order_Details WHERE Orders.orderID = Order_Details.orderID and o_date >= DATE_SUB(CURDATE(), INTERVAL 1 YEAR) ORDER BY o_date DESC");
    
	}
    else {
		$ses_sql= mysqli_query($conn, "SELECT Orders.orderID,Orders.username,Orders.status,Orders.total_price, Orders.o_date,Order_Details.itemID, Order_Details.quantity, Order_Details.component_price FROM Orders, Order_Details WHERE Orders.orderID = Order_Details.orderID and  o_date >= DATE_SUB(CURDATE(), INTERVAL 1 YEAR) AND status = '$status' ORDER BY o_date DESC;");//Might have to change
    }
	while ($row = mysqli_fetch_assoc($ses_sql)) {
        $field1 = $row['orderID'];
        $field2 = $row['username'];
        $field3 = $row['itemID'];
        $field4 = $row['quantity'];
        $field5 = $row['o_date'];
        $field6 = $row['component_price'];
        $field7 = $row['status'];
		$field8 = $row['total_price'];
		
		$ses_sql2= mysqli_query($conn, "SELECT name from Inventory WHERE itemID = '$field3'");
		$row2 = mysqli_fetch_assoc($ses_sql2);
		$field9 = $row2['name'];
		
		
		
		
		//echo " dog";//" $field1, $field2, $field3, $field4, $field5,$field6, $field7 /n ";
        $item = array($field1, $field2, $field3, $field4, $field5,$field6, $field7,$field8,$field9);
        $output[] = $item;

     }

}
else {
	    
	$ses_sql;
    if ($status == "All") {
		//echo "One";
		//$ses_sql= mysqli_query($conn, "SELECT Orders.orderID,Orders.username,Orders.status,Orders.o_date, Orders.total_price,Order_Details.itemID, Order_Details.quantity, Order_Details.component_price FROM Orders, Order_Details WHERE Orders.orderID = Order_Details.orderID and o_date >= DATE_SUB(CURDATE(), INTERVAL 7 DAY) ORDER BY o_date DESC;");
		//echo "two";
		$ses_sql= mysqli_query($conn, "SELECT Orders.orderID,Orders.username,Orders.status,Orders.total_price, Orders.o_date,Order_Details.itemID, Order_Details.quantity, Order_Details.component_price FROM Orders, Order_Details WHERE Orders.orderID = Order_Details.orderID ORDER BY o_date DESC");
    
	}
    else {
		$ses_sql= mysqli_query($conn, "SELECT Orders.orderID,Orders.username,Orders.status,Orders.total_price, Orders.o_date,Order_Details.itemID, Order_Details.quantity, Order_Details.component_price FROM Orders, Order_Details WHERE Orders.orderID = Order_Details.orderID AND status = '$status' ORDER BY o_date DESC;");//Might have to change
    }
	while ($row = mysqli_fetch_assoc($ses_sql)) {
        $field1 = $row['orderID'];
        $field2 = $row['username'];
        $field3 = $row['itemID'];
        $field4 = $row['quantity'];
        $field5 = $row['o_date'];
        $field6 = $row['component_price'];
        $field7 = $row['status'];
		$field8 = $row['total_price'];
		
		$ses_sql2= mysqli_query($conn, "SELECT name from Inventory WHERE itemID = '$field3'");
		$row2 = mysqli_fetch_assoc($ses_sql2);
		$field9 = $row2['name'];
		
		
		
		
		//echo " dog";//" $field1, $field2, $field3, $field4, $field5,$field6, $field7 /n ";
        $item = array($field1, $field2, $field3, $field4, $field5,$field6, $field7,$field8,$field9);
        $output[] = $item;

     }

}

    echo json_encode($output);

?>