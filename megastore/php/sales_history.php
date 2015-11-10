<?php

include 'session.php';

    $output = array();
    $id = $_POST['item'];
    $timespan=$_POST['timespan'];
		
	
if ($timespan == "Week")
{
	$ses_sql;
    if ($id == "All") {
	$ses_sql= mysqli_query($conn, "select Inventory.name, Order_Details.itemID, SUM(Order_Details.quantity) as 'total_items_ordered' from Inventory, Orders, Order_Details Where o_date >= DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND Orders.orderID = Order_Details.orderID AND Inventory.itemID = Order_Details.itemID AND status= 1 GROUP BY Order_Details.itemID");
	}
    else {
	$ses_sql= mysqli_query($conn, "select Inventory.name, Order_Details.itemID, SUM(Order_Details.quantity) as 'total_items_ordered' from Inventory, Orders, Order_Details Where o_date >= DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND Orders.orderID = Order_Details.orderID AND Inventory.itemID = Order_Details.itemID AND status= 1 AND Inventory.name = '$id' GROUP BY Order_Details.itemID");
    }

    while ($row = mysqli_fetch_assoc($ses_sql)) {
		
        $field1 = $row['itemID'];
        
        $field2 = $row['name'];


        $field3 = $row['total_items_ordered'];

        $item = array($field1, $field2, $field3);
        $output[] = $item;

    }

}

else if ($timespan == "Month")
{
	$ses_sql;
    if ($id == "All") {
	$ses_sql= mysqli_query($conn, "select Inventory.name, Order_Details.itemID, SUM(Order_Details.quantity) as 'total_items_ordered' from Inventory, Orders, Order_Details Where o_date >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH) AND Orders.orderID = Order_Details.orderID AND Inventory.itemID = Order_Details.itemID AND status= 1 GROUP BY Order_Details.itemID");
	}
    else {
	$ses_sql= mysqli_query($conn, "select Inventory.name, Order_Details.itemID, SUM(Order_Details.quantity) as 'total_items_ordered' from Inventory, Orders, Order_Details Where o_date >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH) AND Orders.orderID = Order_Details.orderID AND Inventory.itemID = Order_Details.itemID AND status= 1 AND Inventory.name = '$id' GROUP BY Order_Details.itemID");
    }

    while ($row = mysqli_fetch_assoc($ses_sql)) {
        $field1 = $row['itemID'];
        
        $field2 = $row['name'];


        $field3 = $row['total_items_ordered'];

        $item = array($field1, $field2, $field3);
        $output[] = $item;

    }
}

else if ($timespan == "Year")
{
	$ses_sql;
    if ($id == "All") {
	$ses_sql= mysqli_query($conn, "select Inventory.name, Order_Details.itemID, SUM(Order_Details.quantity) as 'total_items_ordered' from Inventory, Orders, Order_Details Where o_date >= DATE_SUB(CURDATE(), INTERVAL 1 YEAR) AND Orders.orderID = Order_Details.orderID AND Inventory.itemID = Order_Details.itemID AND status= 1 GROUP BY Order_Details.itemID");
	}
    else {
	$ses_sql= mysqli_query($conn, "select Inventory.name, Order_Details.itemID, SUM(Order_Details.quantity) as 'total_items_ordered' from Inventory, Orders, Order_Details Where o_date >= DATE_SUB(CURDATE(), INTERVAL 1 YEAR) AND Orders.orderID = Order_Details.orderID AND Inventory.itemID = Order_Details.itemID AND status= 1 AND Inventory.name = '$id' GROUP BY Order_Details.itemID");
    }

    while ($row = mysqli_fetch_assoc($ses_sql)) {
        $field1 = $row['itemID'];
        
        $field2 = $row['name'];


        $field3 = $row['total_items_ordered'];

        $item = array($field1, $field2, $field3);
        $output[] = $item;

    }
}
else {
	$ses_sql;
	
    if ($id == "All") {
	$ses_sql= mysqli_query($conn, "select Inventory.name, Order_Details.itemID, SUM(Order_Details.quantity) as 'total_items_ordered' from Inventory, Orders, Order_Details Where Orders.orderID = Order_Details.orderID AND Inventory.itemID = Order_Details.itemID AND status= 1 GROUP BY Order_Details.itemID");
	}
    else {
	$ses_sql= mysqli_query($conn, "select Inventory.name, Order_Details.itemID, SUM(Order_Details.quantity) as 'total_items_ordered' from Inventory, Orders, Order_Details Where Orders.orderID = Order_Details.orderID AND Inventory.itemID = Order_Details.itemID AND status= 1 AND Inventory.name = '$id' GROUP BY Order_Details.itemID");
    }

    while ($row = mysqli_fetch_assoc($ses_sql)) {
        $field1 = $row['itemID'];
        
        $field2 = $row['name'];


        $field3 = $row['total_items_ordered'];

        $item = array($field1, $field2, $field3);
        $output[] = $item;

    }
}

    echo json_encode($output);

?>