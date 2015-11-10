<?php

include 'session.php';

	
    $output = array();


	
    $ses_sql= mysqli_query($conn, "SELECT * FROM Inventory");
    $index = 1;
    while ($row = mysqli_fetch_assoc($ses_sql)) {
		
        $field1 = $row['itemID'];
        $field2 = $row['name'];
        $field3 = $row['brand'];
        $field4 = $row['item_type'];
        $field5 = $row['quantity'];
        $field6 = $row['price'];
		$field7 = $row['on_promotion'];
		$field8 = $row['promo_price'];
		$field9 = $row['image_path'];
		$field10 = $row['description'];
        $item = array($field1, $field2, $field3, $field4, $field5, $field6, $field7, $field8, $field9, $field10);
        $output[] = $item;

        $index++;
    }

    echo json_encode($output);

?>