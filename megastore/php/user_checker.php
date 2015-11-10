<?php

include('session.php');

if($login_session_type == 'customer'){
	echo "<meta http-equiv=\"refresh\" content=\"0;URL=customer_welcome.php\">";
	echo "<h2><p align=right> Welcome $login_session_fname $login_session_lname $login_session_type to our online store</p></h2>";
}
if($login_session_type == 'staff'){
	echo "<meta http-equiv=\"refresh\" content=\"0;URL=staff_welcome.php\">";
	echo "<h2><p align=right> Welcome $login_session_fname $login_session_lname $login_session_type to our online store</p></h2>";
}
if($login_session_type == 'manager'){
	echo "<meta http-equiv=\"refresh\" content=\"0;URL=manager_welcome.php\">";
	echo "<h2><p align=right> Welcome $login_session_fname $login_session_lname $login_session_type to our online store</p></h2>";
}

?>