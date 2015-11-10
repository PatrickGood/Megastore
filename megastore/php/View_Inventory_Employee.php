<?php
include 'session.php';

?>
<!DOCTYPE html PUBLIC "-//W3C//Dtd XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/Dtd/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<meta content="text/html;charset=utf-8" http-equiv="Content-Type">
<meta content="utf-8" http-equiv="encoding">
    <link rel="icon" href="../images/tab.png" width="300%">
    <title>MegaStore </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">

    <!-- Optional: Include the jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Optional: Incorporate the Bootstrap JavaScript plugins -->
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
  <!--JQuery Library-->
  <!--Bootstrap validation helpers-->
    <script type="text/javascript" src="../js/bootstrapValidator.js"></script>
    <script type="text/javascript" src="../js/bootstrapValidator.min.js"></script>
    <link rel="stylesheet" href="../css/bootstrapValidator.css"/>
    <link rel="stylesheet" href="../css/bootstrapValidator.min.css"/>

    <!--include state picker via Bootstrap form helpers-->
    <script type="text/JavaScript" src="../js/bootstrap-formhelpers.js"></script>
    <script type="text/JavaScript" src="../js/bootstrap-formhelpers.min.js"></script>
    <link rel="stylesheet" href="../css/bootstrap-formhelpers.css"/>
    <link rel="stylesheet" href="../css/bootstrap-formhelpers.min.css"/>

  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>

    
    <link href="../style2.css" rel="stylesheet"> 
    <link href="../carousel.css" rel="stylesheet">
  <script>


  $(document).ready(function() {

var initialData = 'order=All&timespan=All';

$.ajax({
          type: "POST",
          url: "order_history.php",
          data: initialData,
          cache: false,
          success: function(data){
            var result = $.parseJSON(data);

            $("#results").empty();
			
            if(result.length != 0) {//if array is not empty

              $("#results").append("<div class='row'>"); //begin new bootstrap row

              $("#results").append("<div class='col-md-2'><h5>Order #</h5></div>");
              $("#results").append("<div class='col-md-2'><h5>CustomerID</h5></div>");
              $("#results").append("<div class='col-md-1'><h5>ItemID</h5></div>");
              $("#results").append("<div class='col-md-1'><h5>Quantity</h5></div>");
              $("#results").append("<div class='col-md-2'><h5>Order Date</h5></div>");
              $("#results").append("<div class='col-md-1'><h5>Total</h5></div>");
              $("#results").append("<div class='col-md-2'><h5>Status</h5></div>");

              $("#results").append("</div>"); //end bootstrap row

            for (var i = 0; i < result.length; i++) {

                $("#results").append("<div class='row'>"); //begin new bootstrap row

                $("#results").append("<div class='col-md-2'>" + result[i][0] + "</div>");
                $("#results").append("<div class='col-md-2'>" + result[i][1] + "</div>");
                $("#results").append("<div class='col-md-1'>" + result[i][2] + "</div>");
                $("#results").append("<div class='col-md-1'>" + result[i][3] + "</div>");
                $("#results").append("<div class='col-md-2'>" + result[i][4] + "</div>");
                $("#results").append("<div class='col-md-1'>$" + result[i][5] + ".00</div>");
                 if (result[i][6] == '0') {
                  $("#results").append("<div class='col-md-2'>" + "Pending" + "</div>");
                  $("#results").append("<div class='col-md-1'><a id='ship' class='ship_btn' href='ship_order.php?order_num="+result[i][0] + "&cust_id="+result[i][1]+"'>Ship Order</a></div>");
                }
                else{
                  $("#results").append("<div class='col-md-2'>" + "Shipped" + "</div>");
                }
                

                $("#results").append("</div>"); //end bootstrap row
              }
            }
            else {
              $("#results").append("<h2>No Orders Exist</h2>");
            }
          }
      });

$("#submit").click(function(){
      
      var status = $("input[name=order_type]:checked").val();
      var time = $("#time").val();
      // Returns successful data submission message when the entered information is stored in database.
      var dataString = 'order='+ status + '&timespan='+ time;

      // AJAX Code To Submit Form.
      $.ajax({
          type: "POST",
          url: "order_history.php",
          data: dataString,
          cache: false,
          success: function(data){
            var result = $.parseJSON(data);

            $("#results").empty();

            if(result.length != 0) {//if array is not empty

              $("#results").append("<div class='row'>"); //begin new bootstrap row

              $("#results").append("<div class='col-md-2'><h5>Order #</h5></div>");
              $("#results").append("<div class='col-md-2'><h5>CustomerID</h5></div>");
              $("#results").append("<div class='col-md-1'><h5>ItemID</h5></div>");
              $("#results").append("<div class='col-md-1'><h5>Quantity</h5></div>");
              $("#results").append("<div class='col-md-2'><h5>Order Date</h5></div>");
              $("#results").append("<div class='col-md-1'><h5>Total</h5></div>");
              $("#results").append("<div class='col-md-2'><h5>Status</h5></div>");

              $("#results").append("</div>"); //end bootstrap row

              for (var i = 0; i < result.length; i++) {

                $("#results").append("<div class='row'>"); //begin new bootstrap row

                $("#results").append("<div class='col-md-2'>" + result[i][0] + "</div>");
                $("#results").append("<div class='col-md-2'>" + result[i][1] + "</div>");
                $("#results").append("<div class='col-md-1'>" + result[i][2] + "</div>");
                $("#results").append("<div class='col-md-1'>" + result[i][3] + "</div>");
                $("#results").append("<div class='col-md-2'>" + result[i][4] + "</div>");
                $("#results").append("<div class='col-md-1'>$" + result[i][5] + ".00</div>");
                //$("#results").append("<div class='col-md-2'>" + result[i][6] + "</div>");
                if (result[i][6] == '0') {
                  $("#results").append("<div class='col-md-2'>" + "Pending" + "</div>");
                  $("#results").append("<div class='col-md-1'><a id='ship' class='ship_btn' href='ship_order.php?order_num="+result[i][0] + "&cust_id="+result[i][1]+"'>Ship Order</a></div>");
                }
                else{
                  $("#results").append("<div class='col-md-2'>" + "Shipped" + "</div>");
                }
                

                $("#results").append("</div>"); //end bootstrap row
              }
            }
            else {
              $("#results").append("<h2>No Orders Exist</h2>");
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
                <li class="active"><a href="staff_welcome.php">HOME</a></li>              
                
                <li><a href="View_Inventory_Employee.php">Ship Orders</a></li>
                
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
</div>
<br>
</br>
<br>
</br>


<div class="container">
<div class="row">
  <div class="col-md-12">
    <h3>Manage Orders</h3>
  </div>
</div>
<div id="form">
     <div class="row">
        <div class="col-md-6">   
                <div class="form-group">
                    <label>View Orders made in the past</label>
                        <select id="time" name="time">
                          <option>All</option>
                          <option>Year</option>
                          <option>Month</option>
                          <option>Week</option>
                        </select>
                </div>
          </div>
          <div class="col-md-6">
                <div class="form-group">
                  <div>
                        <label class="radio-inline" style="font-weight: bold">Select Order Type: </label>
                        <label class="radio-inline"><input type="radio" name="order_type" value="0">Pending Orders</label>
                        <label class="radio-inline"><input type="radio" name="order_type" value="1">Shipped Orders</label>
                        <label class="radio-inline"><input type="radio" name="order_type" value="All" checked>All Orders</label>
                  </div>
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