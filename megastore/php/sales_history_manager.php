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


  $.ajax({ 
        url: 'get_items_inventory.php',
        data: {},
        success: function(data) {

          var result = $.parseJSON(data);
          for (var i = 0; i < result.length; i++) {
            $("#search_items").append("<option>"+ result[i][1]+"</option>");
          }

        }
    });

var initialString = 'item=All&timespan=All';
  $.ajax({
          type: "POST",
          url: "sales_history.php",
          data: initialString,
          cache: false,
          success: function(data){
            var result = $.parseJSON(data);

            $("#results").empty();

            if(result.length != 0) {//if array is not empty, 0-2

              $("#results").append("<div class='row'>"); //begin new bootstrap row

              $("#results").append("<div class='col-md-4'><h5>ItemID</h5></div>");
              $("#results").append("<div class='col-md-4'><h5>Item Name</h5></div>");
              $("#results").append("<div class='col-md-4'><h5>Total Number Ordered</h5></div>");

              $("#results").append("</div>"); //end bootstrap row

              for (var i = 0; i < result.length; i++) {

                $("#results").append("<div class='row'>"); //begin new bootstrap row

                $("#results").append("<div class='col-md-4'>"+result[i][0]+"</div>");
                $("#results").append("<div class='col-md-4'>"+result[i][1]+"</div>");
                $("#results").append("<div class='col-md-4'>"+result[i][2]+"</div>");

                $("#results").append("</div>"); //end bootstrap row
              }
            }
            else {
              $("#results").append("<h3>This Item has not been Purchased</h3>");
            }
          }
      });

$("#submit").click(function(){

      var my_item = $("#search_items").val();
      var timespan = $("#time").val();
      var array = my_item.split(",", 2);
      

      // Returns successful data submission message when the entered information is stored in database.
      var dataString = 'item='+ array[0] + '&timespan='+timespan;

      //document.write(dataString);

      // AJAX Code To Submit Form.
      $.ajax({
          type: "POST",
          url: "sales_history.php",
          data: dataString,
          cache: false,
          success: function(data){
            var result = $.parseJSON(data);

            

            $("#results").empty();

            if(result.length != 0) {//if array is not empty, 0-2

              $("#results").append("<div class='row'>"); //begin new bootstrap row

              $("#results").append("<div class='col-md-4'><h5>ItemID</h5></div>");
              $("#results").append("<div class='col-md-4'><h5>Item Name</h5></div>");
              $("#results").append("<div class='col-md-4'><h5>Total Number Ordered</h5></div>");

              $("#results").append("</div>"); //end bootstrap row

              for (var i = 0; i < result.length; i++) {

                $("#results").append("<div class='row'>"); //begin new bootstrap row

                $("#results").append("<div class='col-md-4'>"+result[i][0]+"</div>");
                $("#results").append("<div class='col-md-4'>"+result[i][1]+"</div>");
                $("#results").append("<div class='col-md-4'>"+result[i][2]+"</div>");

                $("#results").append("</div>"); //end bootstrap row
              }
            }
            else {
              $("#results").append("<h3>This Item has not been Purchased</h3>");
            }
          }
      });

      return false;
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
                <li class="active"><a href="manager_welcome.php">HOME</a></li>              
                <li><a href="list_manager_inventory.php"> Manage Inventory </a></li>
                <li><a href="View_Inventory_Employee.php">Ship Orders</a></li>
                <li><a href="sales_history_manager.php">Sales statistics</a></li>
                <ul class="nav navbar-nav navbar-right_login_register">
                  
                  
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

<div class="container">
<div class="row">
  <div class="col-md-12">
    <h3>View Sales History</h3>
  </div>
</div>
<div id="form">
     <div class="row">
          <div class="col-md-6">   
                <div class="form-group">
                    <label>Show Sale History for Item #</label>
                        <select id="search_items" name="search_items">
                          <option>All</option>
                        </select>
                </div>
          </div>
          <div class="col-md-6">   
                <div class="form-group">
                    <label>View Item Sales made in the past</label>
                        <select id="time" name="time">
                          <option>All</option>
                          <option>Year</option>
                          <option>Month</option>
                          <option>Week</option>
                        </select>
                </div>
          </div>
      </div>
    <div class="row">
      <div class="col-md-12">
        <input id="submit" type="submit" class="btn btn-primary" value="Search" />
      </div>
    </div>
</div>

<div id="results">

</div>

</div>

</body>
</html> 