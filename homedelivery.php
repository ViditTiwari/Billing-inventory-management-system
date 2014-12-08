<?php
session_start();

include_once 'core/database/config.php';

if(isset($_POST['inputNo']))

{
  $_SESSION['inputNo']=$_POST['inputNo'];
  
  
}
if(isset($_SESSION['inputNo']))
$inputNo = $_SESSION['inputNo'];

?>
<html>
<head>
   <meta charset="utf-8">
    <title>Home Delivery</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/main.css">
    <link href="css/style.css" rel="stylesheet">

</head>
<header>
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="index.php">Dine-in <span class="sr-only">(current)</span></a></li>
        <li><a href="takeaway.php">Take Away</a></li>
        <li class="active"><a href="user_detail.php" class="active">Home Delivery</a></li>
        <li><a href="addnewitems.php">Add New Items</a></li>    
        <li><a href="inventory.php">Inventory</a></li>    
        
       
         
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
</header>
<body>
   
     <div class="container">
     
        <div class="panel panel-default">
         <div class="panel-body" style="text-align:center">
            <strong>HOME DELIVERY</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <?php 
            $table_no = 8;
             //current URL of the Page. cart_update.php redirects back to this URL
            $current_url = base64_encode("http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
            if(isset($inputNo))
            {
            echo '<a href="bill.php?table_no='.$table_no.'&return_url='.$current_url.'&inputNo='.$inputNo.'" class="btn btn-success" >
            PRINT BILL</a>';
            }
            else
              echo "Go to user detail page to see this";

            ?>
        </div>

        </div>
        
       <div class="col-md-12 col-xs-12">
          <div class="col-md-3" id="myScrollspy">
            <ul class="nav nav-tabs nav-stacked affix-top" data-spy="affix" data-offset-top="25">
              <?php
            $results = $mysqli->query("SELECT * FROM category");
           if ($results) { 
            //output results from database
            $ctr=0;
            while($obj = $results->fetch_object())
          {     if($ctr == 0)
                echo '<li class="active"><a href="#'.$obj->category.'">'.$obj->category.'</a></li>';
                 
                else
                echo '<li><a href="#'.$obj->category.'">'.$obj->category.'</a></li>';

                $ctr++;
           }
         }
         ?>
            </ul>
        </div>


          <div class="col-md-6">
             <div class="panel panel1 panel-default">
         <div class="panel-body1" style="text-align:center">
           MENU
        </div>
      </div>
          <div class="products">
          <?php
          
           

          
    
           $results = $mysqli->query("SELECT * FROM menu");
           if ($results) { 
            //output results from database
            $ctr1=1;
            while($obj = $results->fetch_object())
          { 
            if($obj->category_id == $ctr1)
            { $sql = "SELECT category FROM category WHERE category_id='$ctr1'";  
              $result = $mysqli->query($sql);
              $row = $result->fetch_assoc();
              
              echo '<h3 id='.$row["category"].'>'.$row["category"].'</h3>';
              $ctr1++;
            }
            
            echo '<div class="product">'; 
            echo '<form method="post" action="cart_update.php">';
            
            echo '<span class="product-content">'.$obj->item_name ;
            echo '</span>';
            
            echo '<span class="product-info">';
            echo 'Price '.$currency.$obj->price.' | ';
            echo 'Qty <input type="text" name="product_qty" class = "product_qty" value="1" size="3" />&nbsp;&nbsp;';
            echo '<button class="btn btn-success btn-xs">Add To Cart</button>';
            echo '</span>';
            echo '<input type="hidden" name="item_code" value="'.$obj->ID.'" />';
            echo '<input type="hidden" name="table_no" value="'.$table_no.'" />';
            echo '<input type="hidden" name="type" value="add" />';
            echo '<input type="hidden" name="return_url" value="'.$current_url.'" />';
            echo '</form>';
            echo '</div>';
        }
    
        }
       ?>
      </div>
      </div>
    <div class="col-md-3">
      <div class="shopping-cart">
          <h2>Home Delivery Billing Cart</h2>
          <?php

          if(isset($_SESSION["products"]))
          {
              $total = 0;
              echo '<ol>';
              foreach ($_SESSION["products"] as $cart_itm)
              {   if($cart_itm["table_no"] == $table_no)
                 { echo '<li class="cart-itm">';
                  echo '<span class="remove-itm"><a href="cart_update.php?removep='.$cart_itm["code"].'&return_url='.$current_url.'&table_no='.$cart_itm["table_no"].'">&times;</a></span>';
                  echo '<h3>'.$cart_itm["name"].'</h3>';
                  
                  echo '<div class="p-qty">Qty : '.$cart_itm["qty"].'</div>';
                  echo '<div class="p-price">Price :'.$currency.$cart_itm["price"].'</div>';
                  echo '</li>';
                  $subtotal = ($cart_itm["price"]*$cart_itm["qty"]);
                  $total = ($total + $subtotal);
                }
              }
              echo '</ol>';
              echo "<strong>Total : $currency $total</strong>";
              echo '<br>';
              echo '<div class="padding-class"></div>';
              
              echo '<span class="empty-cart"><a href="cart_update.php?emptycart=1&return_url='.$current_url.'&table_no='.$table_no.'" class= "btn btn-danger btn-xs">Empty Cart</a></span>';
          }else{
              echo 'Your Cart is empty';
          }
          ?>
          </div>
      </div>


    </div>

    
    </div>
    



<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="js/bootstrap.js"></script>
</body>
</html>