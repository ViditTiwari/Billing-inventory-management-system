<?php

session_start();

include_once 'core/database/config.php';

?>

<html>
    <head>
      <meta charset="utf-8">
        <title>table 1</title>
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
    </head>

    <body>
      <div class="container-fluid">   
        <div class="panel panel-default">
         <div class="panel-body" style="text-align:center">
            <strong>TABLE 1</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
             <button type="button" class="btn btn-danger ">CLEAR TABLE</button>
        </div>

        </div>
        
       <div class="col-md-12 col-xs-12">
          <div class="col-md-3"></div>

          <div class="col-md-6">
             <div class="panel panel1 panel-default">
         <div class="panel-body1" style="text-align:center">
           MENU
        </div>
      </div>
          <div class="products">
          <?php
           //current URL of the Page. cart_update.php redirects back to this URL
           $current_url = base64_encode("http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);

          
    
           $results = $mysqli->query("SELECT * FROM menu");
           if ($results) { 
            //output results from database
            while($obj = $results->fetch_object())
          {
            
            echo '<div class="product">'; 
            echo '<form method="post" action="cart_update.php">';
            
            echo '<span class="product-content">'.$obj->item_name ;
            echo '</span>';
            
            echo '<span class="product-info">';
            echo 'Price '.$currency.$obj->price.' | ';
            echo 'Qty <input type="text" name="product_qty" value="1" size="3" />';
            echo '<button class="add_to_cart">Add To Cart</button>';
            echo '</span>';
            echo '<input type="hidden" name="item_code" value="'.$obj->ID.'" />';
            echo '<input type="hidden" name="table_no" value="table 1" />';
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
          <h2>Your KOT Cart</h2>
          <?php
          if(isset($_SESSION["products"]))
          {
              $total = 0;
              echo '<ol>';
              foreach ($_SESSION["products"] as $cart_itm)
              {   if($cart_itm["table_no"] == 1)
                 { echo '<li class="cart-itm">';
                  echo '<span class="remove-itm"><a href="cart_update.php?removep='.$cart_itm["code"].'&return_url='.$current_url.'&table_no='.$cart_itm["table_no"].'">&times;</a></span>';
                  echo '<h3>'.$cart_itm["name"].'</h3>';
                  echo '<div class="p-code">P code : '.$cart_itm["code"].'</div>';
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
              echo '<span class="check-out-txt"> <a href="kot.php?table_no=1&return_url='.$current_url.'">Print KOT</a></span>';
              echo '<span class="empty-cart"><a href="cart_update.php?emptycart=1&return_url='.$current_url.'&table_no=1">Empty Cart</a></span>';
          }else{
              echo 'Your Cart is empty';
          }
          ?>
          </div>
      </div>
    </div>

        
      </body>
    
</html>