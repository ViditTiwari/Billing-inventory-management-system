<?php
session_start();

include_once 'core/database/config.php';

?>
<html>
<head>
   <meta charset="utf-8">
    <title>index</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/main.css">
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
    <div class="tabbable tabs1 container">
  <ul class="nav nav-tabs">
    <li class="active"><a href="#pane1" data-toggle="tab">Dine-in</a></li>
    <li><a href="#pane2" data-toggle="tab">Home Delivery</a></li>
    <li><a href="#pane3" data-toggle="tab">Take Away</a></li>
  </ul>
  <div class="tab-content">
    <div id="pane1" class="tab-pane active">
      <pre>
     
       TABLE NUMBER   <div class="btn-group tables">
        <a href="#" class="active btn btn-default ">1</a>
       <a href="table2.php" class="btn btn-default">2</a>
       <a href="table3.php" class="btn btn-default">3</a>
       <a href="table4.php" class="btn btn-default">4</a>
       <a href="table5.php" class="btn btn-default">5</a>
       <a href="table6.php" class="btn btn-default">6</a>
        </div>
        </pre>
        <div class="panel panel-default">
         <div class="panel-body" style="text-align:center">
            <strong>TABLE 1</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <?php 
             //current URL of the Page. cart_update.php redirects back to this URL
            $current_url = base64_encode("http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
            echo '<a href = "clear_table.php?table_no=1&return_url='.$current_url.'" class="btn btn-danger" >'
            ?>CLEAR TABLE</a>
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

    
    </div>
    <div id="pane2" class="tab-pane">
    <h4>Pane 2 Content</h4>
      <p> and so on ...</p>
    </div>
    <div id="pane3" class="tab-pane">
      <h4>Pane 3 Content</h4>
    </div>
  </div><!-- /.tab-content -->
</div><!-- /.tabbable -->

            <div class="">
              <div class="row">
                <div class="col-sm-3 col-md-2 sidebar sidebar1">
                  <ul class="nav nav-sidebar">
                    <li class="active"><a href="index.php">HOME</a></li>
                    <li><a href="addnewitems.php">Add New Items</a></li>    
                    <li><a href="inventory.php">Inventory</a></li>    
                    <li><a href="login.php">Login/out</a></li>
                  </ul>
                </div>
                </div>
            </div>    


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="js/bootstrap.js"></script>
</body>
</html>