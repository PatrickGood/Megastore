<?php

include 'session.php';
$ses_sql= mysqli_query($conn, "SELECT itemID, name, quantity FROM Inventory");


	
	$output = array();

    $index = 1;
    while ($row = mysqli_fetch_assoc($ses_sql)) {
        $field1 = $row['itemID'];
        $field2 = $row['name'];
		$field3 = $row['quantity'];

        $item = array($field1, $field2, $field3);
        $output[] = $item;
        $index++;
    }

    echo json_encode($output);

?>