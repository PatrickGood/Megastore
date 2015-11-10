<?php
include('session.php');


if(isset($_POST['password'])){

  $sql = "UPDATE Users SET password='password' where username=$login_session_username";
  mysqli_query($conn,$sql);

}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../images/tab.png" width="300%">
    <title>MegaStore </title>

    <!-- Bootstrap core CSS -->

    <link href="../css/bootstrap.min.css" rel="stylesheet">


    <!-- Custom styles for this template -->
    <link href="../carousel.css" rel="stylesheet">
    <link href="../style2.css" rel="stylesheet"> 
  
    <!-- Style for BACK TO TOP ARROW -->
  </head>
<!-- NAVBAR
================================================== -->
  <body>
    <div class="header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6">
          <div class="text-center">
      <img src="../images/our_logo_2.png" class="logo" padding-left:"2000px"/>
    </div>
    </div>
    <div class="col-md-6">
      <h2 class="pull-right">The Computer Store</h2>
    </div>
      </div>
  </div>
</div>
    <div class="navbar-wrapper">
     <div class="container">        
        <nav class="navbar navbar-inverse navbar-static-top">
          <div class="container">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
              <ul class="nav navbar-nav">
                <li><a href="../php/customer_welcome.php">HOME</a></li>
                <li class="active"><a href="../php/shop.php">SHOP</a></li>

                <ul class="nav navbar-nav navbar-right_login">
                  <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">My Account <span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="../order_history.html">My Orders</a></li>
                    <li class="divider"></li>
                    <li class="dropdown-header">Account Settings</li>
                    <li><a href="change_user.php"><span class="glyphicon glyphicon-wrench"></span>  Change Account Settings</a></li>
                  </ul>
                </li>
            <li><a href="viewcartpage.php"><span class=" glyphicon glyphicon-shopping-cart"</span> Cart </a></li>
            <li id="login"><a href="logout.php"><span class=" glyphicon glyphicon-off"></span> LogOut</a></li>
            </ul>
            </div>
          </ul>
          </div> 
        </div>

      </div>
    </nav>
  </div>
  <br>
  <br>
</br>
</br>
  <?php echo "<h2><p align=center> $login_session_fname $login_session_lname You can change your password below</p></h2>";?>
<div id="Register">
	<div class="container_sign_up">
    		<form id="defaultForm" method="post" action="change_password.php" class="form-horizontal by-form">
    		<h3>Change your Password</h3>
                <div class="form-group">
                    <label class="col-lg-3 control-label">Username</label>
                    <div class="col-lg-5">
                       <?php echo "<input type='text' class='form-control' name= 'username' value = '$login_session_username' disabled />";?>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-3 control-label">Email address</label>
                    <div class="col-lg-5">
                        <?php echo "<input type='text' class='form-control' name= 'email' value = '$login_session_email' disabled />";?>
                    </div>
                </div>
                
                <div class="form-group" method="post" action="">
                    <label class="col-lg-3 control-label">Your New Password</label>
                    <div class="col-lg-5">
                        <input type="password" class="form-control" name="password" />
                    </div>
                </div>
              
                <div class="form-group">
                    <label class="col-lg-3 control-label">First Name</label>
                    <div class="col-lg-5">
                        <?php echo "<input type='text' class='form-control' name= 'fname' value = '$login_session_fname' disabled />";?>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-3 control-label">Last Name</label>
                    <div class="col-lg-5">
                        <?php echo "<input type='text' class='form-control' name= 'lname' value = '$login_session_lname' disabled />";?>
                    </div>
                </div>

                
                    <br /> 

	                <div class="form-group">                                     
	                    <div class="col-lg-9 col-lg-offset-3">
                            <button type="submit" class="btn btn-lg btn-primary"> <i class="glyphicon glyphicon-ok-sign"></i> Sign Up </button>
	                        
	                    </div>
	               	</div>


<!-- ================================================== -->
    <!-- Wrap the rest of the page in another container to center all the content. -->
      <!-- FOOTER -->
      <hr>
      <footer>
        <p align="middle">&copy; MegaStore, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
      </footer>

      <hr>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script type='text/javascript' src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

    <script src="../js/bootstrap.min.js"></script>
    <!-- Just to make our placeholder images work.-->
   <script src="../js/vendor/holder.js"></script>

    <!-- Style for BACK TO TOP ARROW -->
    <script type="text/javascript">$(document).ready(function(){
      $('body').append('<div id="toTop" class="btn btn-info_top"><span class="glyphicon glyphicon-chevron-up"></span> Back to Top</div>');
      $(window).scroll(function () {
      if ($(this).scrollTop() != 0) {
        $('#toTop').fadeIn();
      } else {
        $('#toTop').fadeOut();
      }
    }); 
    $('#toTop').click(function(){
        $("html, body").animate({ scrollTop: 0 }, 600);
        return false;
    });
});

</script>

  </body>
</html>