<?php
include ('php/connect_DB.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <script type='text/javascript' src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="images/tab.png" width="300%">
    <title>MegaStore </title>

    <!-- Bootstrap core CSS -->

    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="carousel.css" rel="stylesheet">
    <link href="style2.css" rel="stylesheet"> 
  
    <!-- Style for BACK TO TOP ARROW -->
  
<script>
    

  $(document).ready(function() {
  
  //render all store items using ajax call to render_shop.php

  $.ajax({ 
        url: 'php/render_nonuser.php',
        data: {},
        success: function(output) {
          //document.write('<p>Print this after the script tag</p>');
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
     // document.write('<p>Print this after the script response.length' + response.length + '</p>');
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
    //    document.write('<p>Print this after the script response.length10' + i + '</p>');
            
      //  document.write('<p>Print this after the script response.length12' + i + '</p>');
                if(response[i][6] ==1){
                $("#field"+i).append("<img src='images/onsale.png' width='20%'/>");
              }
                $("#field"+i).append("<img style='cursor: pointer;' src=images/" + response[i][8] + " width='50%'/>");
                $("#field"+i).append("<h4>" + response[i][1] + "</h4>");
                $("#field"+i).append("<h5>Description: " + response[i][9] + "</h5>");
                if(response[i][6] ==1){
                  $("#field"+i).append("<h6><strike><b>Regular Price: $" + response[i][5] + "</b><strike></h6>");
                $("#field"+i).append("<h6><b>Sale Price: $" + response[i][7] + "</b></h6>");
              }else{
                $("#field"+i).append("<h6><b>Price: $" + response[i][5] + "</b></h6>");
              }
                $("#outItems").append("<option>"+response[i][1]+"</option>");
                $("#promoItems").append("<option>"+response[i][1]+"</option>");

                if (response[i][4] <= 0) {//if quantity is zero
                  //show that the item is out of stock
                  //if staff or manager is logged in allow update of stock option to be shown
        //document.write('<p>Print this after the script response.lengthin if' + i + '</p>');
                  $("#field"+i).append("<h5 style='color: red;''>OUT OF STOCK</h5>");
                }
                else {
        //document.write('<p>Print this after the script response.length in else' + i + '</p>');
                $("#field"+i).append("<form method='POST' action='falsecart.php?itemName=" + response[i][1] + "&itemNum=" + response[i][0] +"'><input class='quantity' type='number' name='quantity' min='1' max='" + response[i][4] + "'><input class='btn btn-info' type='submit' value='Add To Cart'></form>");
        }
               //document.write('<p>Print this after the script response.length13' + i + '</p>');
               $('#store_items').append("</div>");
               
             }

             $('#store_items').append("</div>");
       //document.write(#inventory);
        }
          
        }
    });
  });
  </script>

  </head>
<!-- NAVBAR
================================================== -->
  <body>
    <div class="header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6">
          <div class="text-center">
      <img src="images/our_logo_2.png" class="logo" padding-left:"2000px"/>
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
                <li class="active"><a href="carousel.php">HOME</a></li>
                
                
                <ul class="nav navbar-nav navbar-right_login">
                <li id="signup"><a href="register.html"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
            <li id="login"><a href="login.html"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
            </ul>
            </div>
          </ul>
          </div>
        </div>

      </div>
    </nav>
  </div>
</div>
    <!-- Carousel
    ================================================== -->
    <div id="myCarousel" class="carousel slide" data-ride="carousel" margin-top: 20px>
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
        <li data-target="#myCarousel" data-slide-to="3"></li>
      </ol>
      <div class="carousel-inner" role="listbox">
        <div class="item active">
          <img class="first-slide" img src="images/slider-frame6.png" alt="First slide" width="460" height="345">
          <div class="container">
            <div class="carousel-caption">
              <!--<h1>Example headline.</h1> -->

              
            </div>
          </div>
        </div>
        <div class="item">
          <img class="second-slide" src="images/slider-frame7.png" alt="Second slide" width="460" height "800">
          <div class="container">
          </div>
        </div>
        <div class="item">
          <img class="third-slide" src="images/slider-frame8.png" alt="Third slide" width="460" height "800">
          <div class="container">
          </div>
        </div>
      </div>
      <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div><!-- /.carousel -->
<!-- Side Containers ============================================== -->

 <div class="store" style="margin-left: 20%">

  <div id="stock">

  </div>

  <div id="store_items" class="container-fluid" >
    <div class="row">
      <div class="col-md-12">
  </div>
</div>
  </div>

</div>


<!-- Actual Store Items -->
 
  

    <!-- ================================================== -->
    <!-- Wrap the rest of the page in another container to center all the content. -->
      <!-- FOOTER -->
            <hr style="width: 100%; color: black; height: 1px; background-color:black; margin-top: 35px" />
      <footer>
        <p align="middle">&copy; MegaStore, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
      </footer>

      <hr>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script type='text/javascript' src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

    <script src="js/bootstrap.min.js"></script>
    <!-- Just to make our placeholder images work.-->
   <script src="js/vendor/holder.js"></script>

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