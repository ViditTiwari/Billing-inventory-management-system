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
        <li class="active"><a href="index.php">Dine-in <span class="sr-only">(current)</span></a></li>
        <li><a href="takeaway.php">Take Away</a></li>
        <li><a href="user_detail.php">Home Delivery</a></li>
        <li><a href="addnewitems.php">Add New Items</a></li>    
        <li><a href="inventory.php">Inventory</a></li>    
        
       
         
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
</header>
<body>
   
     <div class="container-fluid">
      <pre >
     
       TABLE NUMBER   <div class="btn-group tables" >
        <a href="index.php" class="btn btn-default ">1</a>
       <a href="table2.php" class="btn btn-default">2</a>
       <a href="table3.php" class="btn btn-default">3</a>
       <a href="table4.php" class="active btn btn-default">4</a>
       <a href="table5.php" class="btn btn-default">5</a>
       <a href="table6.php" class="btn btn-default">6</a>
        </div>
        </pre>
        <div class="panel panel-default">
         <div class="panel-body" style="text-align:center">
            <strong>TABLE 4</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <?php 
            $table_no = 4;
             //current URL of the Page. cart_update.php redirects back to this URL
            $current_url = base64_encode("http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
            echo '<a href = "clear_table.php?table_no='.$table_no.'&return_url='.$current_url.'" class="btn btn-danger" >'
            ?>CLEAR TABLE</a>
        </div>

        </div>
        
       <div class="col-md-12 col-xs-12">
          <div class="col-md-2" id="myScrollspy">
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
          
           

          
    
           $results = $mysqli->query("SELECT * FROM menu ORDER BY category_id");
           if ($results) { 
            //output results from database
            $ctr1=1;
               echo '<div id="wrap"> ';  
               echo '<h1 id="header"><form class="filterform" action="#"></form></h1>' ;
               echo '<div id="list">' ;
               
               
            while($obj = $results->fetch_object())
                
          { 
                 
                
    
               echo '<div class="entry">';
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
           echo '<input type="hidden" name="table_no" value='.$table_no.' />';
            echo '<input type="hidden" name="type" value="add" />';
            echo '<input type="hidden" name="return_url" value="'.$current_url.'" />';
            echo '</form>';
            echo '</div>';
            echo '</div>';
            
        }
    
        }
            echo '</div>';
            echo '</div>';
            
       ?>
      </div>
      </div>
      
      
            
    <div class="col-md-2">
      <div class="shopping-cart">
          <h2>Your KOT Cart</h2>
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
              echo '<span class="check-out-txt"> <a href="kot.php?table_no='.$table_no.'&return_url='.$current_url.'" class= "btn btn-primary btn-xs">Print KOT</a></span>';
              echo '<span class="empty-cart"><a href="cart_update.php?emptycart=1&return_url='.$current_url.'&table_no='.$table_no.'" class= "btn btn-danger btn-xs">Empty Cart</a></span>';
          }else{
              echo 'Your Cart is empty';
          }
          ?>
          </div>
      </div>

      <div class="col-md-2">
      <div class="shopping-cart">
          <h2>Done KOT</h2>
          <?php
          
          $results = $mysqli->query("SELECT * FROM kot WHERE TABLE_NO = $table_no");
              if (mysqli_num_rows ($results)>0 ) { 
              echo '<ol>';

               $total1=0;
               
                //output results from database
               $ctr=0;
                  
              while ($obj = $results->fetch_object())
              {  
                  echo '<li class="cart-itm">';
                  

                  
                  $results1 = $mysqli->query("SELECT * FROM menu WHERE ID ='$obj->ID'");
                  $obj1 = $results1->fetch_object();
                  echo '<h3>'.$obj1->item_name.'</h3>';
                  echo '<div class="p-qty">Qty : '.$obj->QTY.'</div>';
                  echo '<div class="p-price">Price :'.$currency.$obj1->price.'</div>';
                  
                  echo '</li>';
                  
                  $subtotal1 = ($obj1->price*$obj->QTY);
                  $total1 = ($total1 + $subtotal1);
                  $ctr++;
                
              }
              echo '</ol>';
              echo "<strong>Total : $currency $total1</strong>";
              echo '<br>';
              
          }else{
              echo 'Done KOT is empty';
          }

          ?>
          </div>
      </div>
    </div>

    
    </div>
    




    <script src="js/bootstrap.js"></script>
</body>
</html>