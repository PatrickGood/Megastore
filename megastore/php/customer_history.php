<?php



	include "session.php";


    $total_price = 0;
    $output = array();
    //$previous=1;
    //$previous_quantity = 0;
	//$previous_val = 0;
	$ses_sql= mysqli_query($conn, "SELECT Orders.orderID,Orders.username,Orders.status,Orders.o_date, Orders.total_price, Order_Details.itemID, Order_Details.quantity, Order_Details.component_price FROM Orders, Order_Details WHERE Orders.orderID =Order_Details.orderID and Orders.username = '$login_session_username'  ORDER BY Orders.o_date DESC;");
	$index = 1;
    while ($row = mysqli_fetch_assoc($ses_sql)) {
        $field1 = $row['orderID'];
        $field2 = $row['username'];
        $field3 = $row['itemID'];
		
        $field4 = $row['quantity'];
        $field5 = $row['o_date'];
        $field6 = $row['total_price'];
        $field7 = $row['status'];
        if($field7 == 0 )
        {
            $field7 = "Pending";
        }
        else{
            $field7 = "Shipped";
        }
      /*  if($previous == $field1)
        {
            $total_price = $field4*$field6 + $total_price;
        }
        else
        {   
            $total_price =$field6 *$field4;
        }
        */
		//echo " field 1 = $field1,  field 2 = $field2, field 3 = $field3, field 4 = $field4, field 5 =$field5, field 6 =$field6, field 7 =$field7 <br></br>";
        $ses_sql2= mysqli_query($conn, "SELECT Inventory.name FROM Inventory WHERE itemID = '$field3';");
        while ($row2 = mysqli_fetch_assoc($ses_sql2)) {
            $field8 = $row2['name'];

            $item = array($field1, $field2, $field3, $field8, $field4, $field5, $field6, $field7);
            $output[] = $item;
        }
        $previous = $field1;
        //$previous_quantity = $field4;
        //$previous_val = $field6;
        $index++;
    }

    echo json_encode($output);

?>