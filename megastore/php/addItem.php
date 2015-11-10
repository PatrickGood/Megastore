<?php
include 'session.php';


$id=$_POST['item_id'];
$name=$_POST['item_name'];
$brand=$_POST['item_brand'];
$type=$_POST['item_type'];
$quantity=$_POST['item_quantity'];
$price=$_POST['item_price'];
$on_promo=$_POST['item_on_promo'];
$promo_price=$_POST['item_promo_price'];
$url=$_POST['item_url'];
$description=$_POST['item_description'];


echo "$id \n";
echo "$name \n";
echo "$brand \n";
echo "$type \n";
echo "$quantity \n";
echo "$price \n";
echo "$on_promo \n";
echo "$promo_price \n";
echo "$url \n";
echo "$description \n";
mysqli_query($conn, "INSERT INTO Inventory(itemID, name, brand, item_type, quantity, price, on_promotion, promo_price, image_path, description)
			 	VALUES ('$id','$name', '$brand', '$type', '$quantity', '$price', '$on_promo', '$promo_price', '$url', '$description');") or die(mysqli_error());

header("location: list_inventory.php");///change this!!!

?>