<?php

include 'session.php';

$item = $_POST['item_toPromote'];
$promo_rate = $_POST['promo_rate'];


$seq_sql = mysqli_query($conn, "SELECT price FROM Inventory WHERE name = '$item'");
$row = mysqli_fetch_assoc($seq_sql);
$regPrice = $row['price'];


$new_price = 0;


if($promo_rate == 25){
	
	$new_price = (float)($regPrice - 0.25* $regPrice);
	
	mysqli_query($conn, "UPDATE Inventory SET on_promotion = 1,promo_price = '$new_price' WHERE name = '$item'");

}
elseif($promo_rate == 50){
	
	$new_price = (float)($regPrice - 0.50* $regPrice);
	mysqli_query($conn, "UPDATE Inventory SET on_promotion = 1 , promo_price = '$new_price' WHERE name = '$item'");	
}
elseif ($promo_rate == 75) {
	
	$new_price = (float)($regPrice - 0.75* $regPrice);
	mysqli_query($conn, "UPDATE Inventory SET on_promotion = 1 ,promo_price = '$new_price' WHERE name = '$item'");
}
else
{
	mysqli_query($conn, "UPDATE Inventory SET on_promotion = 0 WHERE name = '$item'");
}
header("location: list_manager_inventory.php");////change this manager file!!!

?>