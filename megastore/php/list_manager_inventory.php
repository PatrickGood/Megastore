<?php
include('session.php');

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

  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>

    
  <script type="text/javascript" src="../js/bootstrapValidator.js"></script>
  <script type="text/javascript" src="../js/bootstrapValidator.min.js"></script>
  <link rel="stylesheet" href="../css/bootstrapValidator.css"/>
  <link rel="stylesheet" href="../css/bootstrapValidator.min.css"/>

  <!--include state picker via Bootstrap form helpers-->
  <script type="text/JavaScript" src="../js/bootstrap-formhelpers.js"></script>
  <script type="text/JavaScript" src="../js/bootstrap-formhelpers.min.js"></script>
  <link rel="stylesheet" href="../css/bootstrap-formhelpers.css"/>
  <link rel="stylesheet" href="../css/bootstrap-formhelpers.min.css"/>
    <!-- Custom styles for this template -->
    <link href="../carousel.css" rel="stylesheet">
    <link href="../style2.css" rel="stylesheet"> 
  
    <!-- Style for BACK TO TOP ARROW -->
	
<script>

  $(document).ready(function() {
  
	//render all store items using ajax call to render_shop.php

  $.ajax({ 
        url: 'render_shop.php',
        data: {},
        success: function(output) {
          var response = $.parseJSON(output);//parse returned multidimensional array
		
          $("#inventory").empty();
		  //document.write('<p>Print this after the script tag</p>');
          /* response[i][0] is item name
          response[i][1] is item image url
          response[i][2] is item number
          response[i][3] is item quantity
          response[i][5] is item promotion rate
          */

          if(response.length != 0) {//if array is not empty
		//document.write('<p>Print this after the script response.length' + response.length + '</p>');
            $('#store_items').append("<div class='row'>");//begin new bootstrap row

            $("#inventory").append("<div class='row'>");
            $("#inventory").append("<div class='col-md-8'><h4>Item Name</h4></div>");
            $("#inventory").append("<div class='col-md-4'><center><h4>Quantity</h4></center></div>");
            $("#inventory").append("</div>");
         //   document.write('<p>Print this after the script response.length' + response.length + '</p>');
            for (var i = 0; i < response.length; i++) {//for every item in store, put in bootstrap column
	        //document.write('<p>Print this after the script response.length' + response[i][1] + '</p>');
              //add items to inventory modal
              $("#inventory").append("<div class='row'>");
              $("#inventory").append("<div class='col-md-8'>"+response[i][1]+"</div>");
              $("#inventory").append("<div class='col-md-4'><center>"+response[i][4]+"</center></div>");
              $("#inventory").append("</div>");

              if (i % 3 == 0) {
                $('#store_items').append("<div class='row'>");//begin new bootstrap row
              }
              //add set item border and style

               $('#store_items').append("<div id=field" + i + " class='col-md-3' style='margin-top: 10px; margin-right: 5px; border-radius: 20px; border: solid thin #cccccc; text-align: center; padding: 5px;'>");
	
			//	document.write('<p>Print this after the script response.length12' + i + '</p>');
                if(response[i][6] ==1){
                $("#field"+i).append("<img src='../images/onsale.png' width='20%'/>");
              }
                $("#field"+i).append("<img style='cursor: pointer;' src=../images/" + response[i][8] + " width='50%'/>");
                $("#field"+i).append("<h4>" + response[i][1] + "</h4>");
                $("#field"+i).append("<h5>Description: " + response[i][9] + "</h5>");
                if(response[i][6] ==1){
                  $("#field"+i).append("<h6><strike><b>Regular Price: $" + response[i][5] + "</b><strike></h6>");
                $("#field"+i).append("<h6><b>Sale Price: $" + response[i][7] + "</b></h6>");
              }else{
                $("#field"+i).append("<h6><b>Price: $" + response[i][5] + "</b></h6>");
              }
                $("#field"+i).append("<h4><b>Stock Quantity: " + response[i][4] + "</b></h4>");
                $("#outItems").append("<option>"+response[i][1]+"</option>");
                $("#promoItems").append("<option>"+response[i][1]+"</option>");

                if (response[i][4] <= 0) {//if quantity is zero
                  //show that the item is out of stock
                  //if staff or manager is logged in allow update of stock option to be shown
				//document.write('<p>Print this after the script response.lengthin if' + i + '</p>');
                  $("#field"+i).append("<img src='../images/soldout.png' width='20%'/>");
                }
                else {
				//document.write('<p>Print this after the script response.length in else' + i + '</p>');
                
				}
               //document.write('<p>Print this after the script response.length13' + i + '</p>');
               $('#store_items').append("</div>");
               
             }

             $('#store_items').append("</div>");
			 //document.write(#inventory);
        }
          
        }
    });
$('#newitemForm')
        .bootstrapValidator({
            message: 'This value is not valid',
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                item_id: {
                  validators: {
                    notEmpty: {
                      message: 'Item ID is requried and can\'t be empty'
                    },
                    stringLength: {
                            min: 3,
                            max: 3,
                            message: 'Item ID must be 3 digits'
                        },
                    regexp: {
                      regexp: /^\d*[0-9](|.\d*[0-9]|,\d*[0-9])?$/,
                      message: 'Item ID must be a numeric value'
                    }
                  }
                },
                item_name: {
                  validators: {
                    notEmpty: {
                      message: 'Item Name is requried and can\'t be empty'
                    },
                    regexp: {
                      regexp: /^([a-zA-Z]+\s)*[a-zA-Z]+$/,
                      message: 'Digits and special characters are invalid'
                    }
                  }
                },
                item_url: {
                  validators: {
                    notEmpty: {
                      message: 'Item Image is required and can\'t be empty'
                    }
                  }
                },
                item_quantity: {
                    validators: {
                    notEmpty: {
                      message: 'Item Quantity is requried and can\'t be empty'
                    }
                  }
                },
                item_price: {
                  validators: {
                    notEmpty: {
                      message: 'Item Price is requried and can\'t be empty'
                    },
                    stringLength: {
                            min: 0,
                            message: 'Price must be greater than 0'
                        },
                    regexp: {
                      regexp: /^\d*[0-9](|.\d*[0-9]|,\d*[0-9])?$/,
                      message: 'Price must be a numeric value'
                    }
                  }
                }
            }
        });
	});
	</script>
	
  </head>
<!-- NAVBAR
================================================== -->
  <body>
    <!-- Staff Modal To add Item to Inventory -->
    <!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">View/Stock Store Items</h4>
      </div>
      <div class="modal-body">

        <h2>Current Inventory</h2>
        <div id="inventory" style="margin-bottom: 50px;">

        </div>
            <div id="new_item" class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Add New Item <span class="glyphicon glyphicon-plus"></span></a>
              <ul class="dropdown-menu" style="width: 85%">
                <form id="newitemForm" method="post" class="form-horizontal" action="addItem.php">
                <li>
                  <div class="form-group row">
                      <label class="col-md-4 control-label">New Item ID</label>
                      <div class="col-md-6">
                          <input type="text" class="form-control" name="item_id" />
                      </div>
                  </div>
                </li>
                <li>
                  <div class="form-group row">
                      <label class="col-md-4 control-label">New Item Name</label>
                      <div class="col-md-6">
                          <input type="text" class="form-control" name="item_name" />
                      </div>
                  </div>
                </li>
                <li>
                  <div class="form-group row">
                      <label class="col-md-4 control-label">New Item Brand</label>
                      <div class="col-md-6">
                          <input type="text" class="form-control" name="item_brand" />
                      </div>
                  </div>
                </li>
                <li>
                  <div class="form-group row">
                      <label class="col-md-4 control-label">New Item Type</label>
                      <div class="col-md-6">
                          <input type="text" class="form-control" name="item_type" />
                      </div>
                  </div>
                </li>
                <li>
                  <div class="form-group row">
                      <label class="col-md-4 control-label">New Item Quantity</label>
                      <div class="col-md-6">
                          <input class="quantity" type="number" name="item_quantity" min="1">
                      </div>
                  </div>
                </li>
                
                <li>
                  <div class="form-group row">
                      <label class="col-md-4 control-label">New Item Price</label>
                      <div class="col-md-6">
                          <input type="text" class="form-control" name="item_price" />
                      </div>
                  </div>
                </li>

                <li>
                  <div class="form-group row">
                      <label class="col-md-4 control-label">New Item On Promo or not</label>
                      <div class="col-md-6">
                          <input type="text" class="form-control" name="item_on_promo" placeholder ="0 or 1 (Yes or No)"  />
                      </div>
                  </div>
                </li>

                <li>
                  <div class="form-group row">
                      <label class="col-md-4 control-label">New Item Promotion Price</label>
                      <div class="col-md-6">
                          <input type="text" class="form-control" name="item_promo_price" />
                      </div>
                  </div>
                </li>
                <li>
                  <div class="form-group row">
                      <label class="col-md-4 control-label">New Item Image</label>
                      <div class="col-md-6">
                          <input type="text" class="form-control" name="item_url" />
                      </div>
                  </div>
                </li>

                <li>
                  <div class="form-group row">
                      <label class="col-md-4 control-label">New Item Description</label>
                      <div class="col-md-6">
                          <input type="text" class="form-control" name="item_description" />
                      </div>
                  </div>
                </li>
                
                <li>
                  <div class="form-group" style="margin-left: 50%">
                      <div class="col-lg-9 col-lg-offset-3">
                          <input type="submit" class="btn btn-primary" value="Add New Item" />
                      </div>
                  </div>
                </li>
                </form>
              </ul>
            </div>

        <h2>Stock Inventory</h2>
        <!--modal form, sends info to updateStock.php to update database-->
        <form id="defaultForm" method="post" class="form-horizontal" action="updateStock.php" style="width: 70%; margin-left: 20px">
          <!--Select Item to update-->
          <div class="form-group">
            <label for="outItems">Select Item:</label>
            <select class="form-control" id="outItems" name='item_toUpdate'></select>
          </div>
          <!--How many items to add-->
          <div class="form-group">
            <label for="outItems">Items to Add:</label>
            <input class='form-control' type='number' name='quantity_toAdd' min='1' style="width: 80px">
          </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <!--Submit Form-->
        <button type="submit" class="btn btn-primary">Stock Item</button>
        </form>
      </div>
    </div>
  </div>
</div>
 <!-- Modal -->
<div class="modal fade" id="myModal_2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Promotions Manager</h4>
      </div>
      <div class="modal-body">
<form id="promoForm" method="post" class="form-horizontal" action="setPromo.php" style="width: 70%; margin-left: 20px">
          <!--Select Item to update-->
          <div class="form-group">
            <label for="outItems">Select Item:</label>
            <select class="form-control" id="promoItems" name='item_toPromote'></select>
          </div>
          <!--How many items to add-->
          <div class="form-group">
            <label for="outItems">Select Promotion Rate:      (Selecting None removes promotion)</label>
            <select class="form-control" id="promoRate" name='promo_rate'>
              <option value="NULL">None</option>
              <option value="25">25% Off</option>
              <option value="50">50% Off</option>
              <option value="75">75% Off</option>
            </select>
          </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        
        <!--Submit Form-->
        <button type="submit" class="btn btn-primary">Set Promo</button>
        </form>
      </div>
    </div>
  </div>
  </div>
</div>
    <div class="header">
    <div class="container-fluid_logo">
      <div class="row">
        <div class="col-md-6">
          <div class="text-center">
      <img src="../images/our_logo_2.png" class="logo" padding-left:"200px"/>
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
                <li><a href="manager_welcome.php">HOME</a></li>
                <li class="active"><a href="list_manager_inventory.php">Manage Inventory</a></li>
				<li><a href="View_Inventory_Employee.php">Ship Orders</a></li>

                <ul class="nav navbar-nav navbar-right_login_register">
                  <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">My Account <span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
                    <li class="dropdown-header">Account Settings</li>
                    <li><a href="change_user.php"><span class="glyphicon glyphicon-wrench"></span>  Change Account Settings</a></li>
                  </ul>
                </li>
            
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
  <?php echo "<h3><b><p align=center class='uppercase'> WELCOME $login_session_type $login_session_fname $login_session_lname TO OUR ONLINE STORE!</p><b></h3>";?>

<div class="store" style="margin-left: 20%">

  <div id="stock">

  </div>

  <div id="store_items" class="container-fluid" >
    <div class="row">
      <div class="col-md-12">
        <button id="stock_btn" type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal" style="margin-top: 20px; margin-left: 5px;">View/Stock Store Items</button>
        <button id="promote_btn" type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal_2" style="margin-top: 20px; margin-left: 5px;">Promotions Manager</button>
  </div>
</div>
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
