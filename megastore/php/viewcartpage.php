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

  $(document).ready(function(){

    //use ajax call to see what needs to be hidden from nav bar based on user type

  //render all store items using ajax call to render_shop.php
  $.ajax({ 
        url: 'viewcart.php',
        data: {},
        success: function(output) {
          var response = $.parseJSON(output);//parse returned multidimensional array

          /* response[i][0] is customer name
          response[i][1] is item number
          response[i][2] is item name
          response[i][3] is item quantity
          response[i][4] is item price
          resonpse[i][5] is order number
          */
          var order_total = 0;
          var price = 0;

          if(response.length != 0) {

            $('#orderNum').append("<h2>Order #" + response[0][5] + "</h2>");

            $('#cart').append("<div class='row'><div class='col-md-4' style='text-align: center'><h3>Item Name</h3></div><div class='col-md-4' style='text-align: center'><h3>Quantity</h3></div><div class='col-md-4' style='text-align: center'><h3>Remove Item</h3></div></div>");

            for (var i = 0; i < response.length; i++) {

              if(parseInt(response[i][7]) == 1){//Note note sure if ths works bhushan might change '1' to 1?
                price = parseInt(response[i][6]);
              } else {
                price = parseInt(response[i][4]);
              }
              
              $('#cart').append("<div class='row'>");
              $('#cart').append("<div class='col-md-4' style='text-align: center'>" + response[i][2] + "</div>");
              if (response[i][3] == '0') {
                $('#cart').append("<div class='col-md-4' style='text-align: center'>Desired Quantity cannot be ordered!</div>");
              }
              else {
                var final_price = price;
                order_total = order_total + (final_price*parseFloat(response[i][3]));
                $('#cart').append("<div class='col-md-4' style='text-align: center'>" + response[i][3] + "</div>");
                
                

              }
              $('#cart').append("<div class='col-md-4' style='text-align: center'><a href='deleteFromCart.php?itemID="+response[i][1]+"'>Remove Item</a></div>");
              $('#cart').append("</div>");
            }
            $('#total').append("$" + order_total);

            if (order_total != 0) {
            $('#view').append("<button type='button' class='btn btn-primary btn-lg pull-right' data-toggle='modal' data-target='#myModal' style='margin-top: 20px; margin-right: 5%;'>Checkout</button>");
            $('#send_total').val(order_total);
          }

            $('#my_order').val(response[0][5]);
          }
          else {
            $('#cart').append("<h2 align='center'>Your Cart is Empty!</h2>");
            $('#cart').append("<h2 align='center'><a href='shop.php'>Go Shopping</a></h2>");
          }
        }
    });
	$('#defaultForm')
        .bootstrapValidator({
            message: 'This value is not valid',
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
              street: {
                validators: {
                    notEmpty: {
                    message: 'Address is required and can\'t be empty'
                    }
                }
              },
				      city: {
                validators: {
                    notEmpty: {
                    message: 'City is requried and can\'t be empty'
                    },
                    regexp: {
                      regexp: /^([a-zA-Z]+\s)*[a-zA-Z]+$/,
                      message: 'Digits and special characters are invalid'
                      }
                    }
                },
				      zip: {
                validators: {
                    notEmpty: {
                    message: 'Zip Code is required and can\'t be empty'
                    },
                    stringLength: {
                      min: 5,
                      max: 5,
                      message: 'Zip code must be 5 digits'
                      },
                    regexp: {
                      regexp: /^\d*[0-9](|.\d*[0-9]|,\d*[0-9])?$/,
                      message: 'Zip code must be a numeric value'
                    }
                    }
                },

			}
		});
				
  });



</script>

</head>

<body>

  <!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Payment Information</h4>
      </div>
      <div class="modal-body">
        <!--modal form, sends info to updateStock.php to update database-->
        <div id="orderNum"></div>
            <div class="row">
        <div class="col-md-6">
            <form id="defaultForm" method="post" class="form-horizontal" action="checkout.php" style="margin-left: 20px">
              <div class="form-group" style="visibility: hidden;">
                <input id="my_order" name='this_order' type='text'>
              </div>
                <div class="form-group">
                    <label>Cardholder's Name</label>
                    <input type="text" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Card Number</label>
                    <input type="text" class="form-control" required>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Exp Month</label>
                            <input type="text" class="form-control" placeholder="MM" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Exp Year</label>
                            <input type="text" class="form-control" placeholder="YYYY" required>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>CVC</label>
                            <input type="text" class="form-control" placeholder="Ex. 331" required>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                  <label>Street</label>
                  <input type="text" class="form-control" name="street" required> </input>
                </div>
				        <div class="form-group">
                  <label>City</label>
                  <input type="text" class="form-control" name="city"  required/>
                </div>
                <div class="form-group">
                  <label>State: </label>
                  <input type="text" class="form-control" name="state"  required/>
                </div>
                
                <div class="form-group">
                  <label>Zip</label>
                  <input type="text" class="form-control" name="zip"  required></input>
                  
                </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
              <label id="total">Order Total: </label>
            </div>
            <div class="form-group" style="visibility: hidden;">
                <input id="send_total" name='my_total' type='text'>
              </div>
        </div>
    </div>
</div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <!--Submit Form-->
        <button type="submit" class="btn btn-primary">Place Order</button>
        </form>
      </div>
    </div>
  </div>
</div>
</div>
<!-- END MODAL -->

  <!-- Modal -->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Un-Registered User</h4>
      </div>
      <div class="modal-body">
        <h1>Must Register before checking out!</h1>
</div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Ok</button>
      </div>
    </div>
  </div>
</div>

<!-- END MODAL -->
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
  <br>
  <br>
</br>
</br>
<div id="view">
  <div id="cart" class="container-fluid" style="margin: 15px">


  </div>
</div>

</body>
</html> 