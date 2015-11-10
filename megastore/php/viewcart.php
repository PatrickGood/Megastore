<?php
include 'session.php';

// Random Number on this page.
$output = array();

$count = 0;
$random_count = 0;

$random = substr(number_format(time() * mt_rand(),0,'',''),0,10);
$ses_sql4 = mysqli_query($conn, "SELECT * FROM Orders WHERE orderID = '$random'") or die(mysqli_error());
$random_count = mysqli_num_rows($ses_sql4);

//$random = 1344409450;
while($random_count == 1){
    $random = substr(number_format(time() * mt_rand(),0,'',''),0,10);
    $ses_sql5 = mysqli_query($conn, "SELECT * FROM Orders where orderID = '$random'") or die(mysqli_error());
    $random_count = mysqli_num_rows($ses_sql5);
}    




$ses_sql= mysqli_query($conn, "SELECT * FROM Cart WHERE Cart.username = '$login_session_username';") or die(mysqli_error());
    
// Mysql_num_row is counting table row
$count=mysqli_num_rows($ses_sql);





// If result matched $myusername and $mypassword, table row must be 1 row
if($count!=0){
		$ses_sql2= mysqli_query($conn, "SELECT * FROM Cart WHERE Cart.username = '$login_session_username';") or die(mysqli_error());
        $index_1 = 1;
        while ($row = mysqli_fetch_assoc($ses_sql2)) {
            $field1 = $row['username'];
            $field2 = $row['itemID'];
            $field3 = $row['desired_quantity'];
            
			
			$ses_sql3= mysqli_query($conn, "SELECT Inventory.name, Inventory.quantity, Inventory.price, Inventory.promo_price, Inventory.on_promotion FROM Inventory WHERE Inventory.itemID = '$field2';") or die(mysqli_error());
            //$query = "SELECT Items.Name, Items.quantity, Items.price, Items.promotion_rate FROM Items WHERE Items.itemID = '$field2';";
            //$answer = mysql_query($query) or die(mysql_error());
            
            while ($row2 = mysqli_fetch_assoc($ses_sql3)) {
                $field4 = $row2['name'];
                $field5 = $row2['price'];
                $field6 = $row2['quantity'];
                $field7 = $row2['promo_price'];
				$field8 = $row2['on_promotion'];
                
                if ($field3 > $field6) {
                    $field3 = 0;
                    mysqli_query($conn, "UPDATE Cart SET Cart.quantity = $field3 WHERE username ='$name' AND itemID = '$field2';") or die(mysqli_error());
                }

                $item = array($field1, $field2, $field4, $field3, $field5, $random, $field7, $field8);
                $output[] = $item; 
            } 
                      

            $index_1++;
        }
} 

else {

    //$output[] = "Your shopping cart is empty!";
    	
}

echo json_encode($output);

?>