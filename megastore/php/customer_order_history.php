<?php 
include 'session.php';
?>
<!DOCTYPE HTML>
<html>
<head>

	    <link rel="icon" href="../images/tab.png" width="300%">
    <title>MegaStore </title>

	<meta charset="utf-8">

	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">

	<!-- Optional: Include the jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<!-- Optional: Incorporate the Bootstrap JavaScript plugins -->
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

  <!--JQuery Library-->

  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>

  <link rel="stylesheet" href="../style2.css">
  <link rel="stylesheet" href="../carousel.css">

	<script>

  $(document).ready(function() {

    //use ajax call to see what needs to be hidden from nav bar based on user type
	var my_user = "";
	

 

  $.ajax({ 
        url: 'customer_history.php',
        data: {},
        success: function(output) {
          var response = $.parseJSON(output);//parse returned multidimensional array
          var order = '0';
          if(response.length != 0) {//if array is not empty
            for (var i = 0; i < response.length; i++) {
                if(response[i][0] == order) {
                  $("#history").append("<div class='row'><div class='col-md-6'><h5>"+response[i][3]+"</h5></div><div class='col-md-6'><h5>Quantity: "+response[i][4]+"</h5></div></div>");

                } else {
                  $("#history").append("<div class='row' style='background-color: rgba(166, 195, 19, 0.68); border-radius: 15px; margin-top: 20px; padding-bottom: 5px;'><div class='col-md-6 pull-left'><h3>Order #"+response[i][0]+"</h3></div><div class='col-md-6 pull-right'><h3>Date Placed: "+response[i][5]+"</h3></div></div>");
                  $("#history").append("<div class='row'><div class='col-md-3'><h4>Order total:</h4></div><div class='col-md-3'><h4>$"+response[i][6]+".00</h4></div><div class='col-md-3'><h4>Order status:</h4></div><div class='col-md-3'><h4>"+response[i][7]+"</h4></div></div>");
                  $("#history").append("<div class='row' style='border-bottom: solid thin #cccccc'><div class='col-md-12'><h4>Order Summary</h4></div></div>");
                  $("#history").append("<div class='row'><div class='col-md-6'><h5>"+response[i][3]+"</h5></div><div class='col-md-6'><h5>Quantity: "+response[i][4]+"</h5></div></div>");
                }

                order = response[i][0];
            }
          }
          else {
            $('#history').append("<h2>You Have Not Made Any Orders! <a href='shop.html'>Go Shopping</a></h2>");
          }
        }


    });

});

	</script>

</head>

<body>

    <div class="header">
    <div class="container-fluid_logo">
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
        <nav class="navbar navbar-inverse navbar-static-top" style="width: 8000px align:center">
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
                <li><a href="customer_welcome.php">HOME</a></li>
                <li class="active"><a href="shop.php">SHOP</a></li>

                <ul class="nav navbar-nav navbar-right_login_register">
                  <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">My Account <span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="customer_order_history.php">My Orders</a></li>
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

  <br></br>
  <br></br>
  <br></br>


<div id="history" class="container">

</div>

 <!-- ================================================== -->
    <!-- Wrap the rest of the page in another container to center all the content. -->
      <!-- FOOTER -->
      <hr style="width: 100%; color: black; height: 1px; background-color:black;">
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
