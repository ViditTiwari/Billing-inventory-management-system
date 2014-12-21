<?php
include_once 'core/init.php';
include_once 'core/database/config.php';
if(isset($_GET['ingriedient'])&& isset($_GET['init']))
{   
	$ingr_name=$_GET['ingriedient'];
	$init=$_GET['init'];
	add_inventory_item_init($ingr_name,$init);
}
  if(isset($_GET['ingriedient'])&& isset($_GET['final'])) 
  {
      $ingr_name=$_GET['ingriedient'];
      $final=$_GET['final'];
    add_inventory_item_final($ingr_name,$final);
}

?>
   <html>
    <head>
        <title>inventory</title>
        <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/main.css">
    </head>
    <header>
    <nav class="navbar navbar-default" role="navigation">
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
        <li><a href="user_detail.php">Home Delivery</a></li>
        <li><a href="addnewitems.php">Add New Items</a></li>    
        <li class="active"><a href="inventory.php">Inventory</a></li>    
        
       
         
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
</header>
    <body>
      <div class="col-md-6" style="text-align:center">
       <pre>
       <h3>Add Inventory</h3>
        <form action="" method="get">
        <?php
$name = 'ingriedient';

$results = $mysqli->query("SELECT `ingr_name` FROM `inventory_backup`");


if ($results) { 
            //output results from database
            while($obj = $results->fetch_object())
             { $a = $obj->ingr_name;
              $result1[]=$a;
              
            }
               }
  // print_r($result1);

$selected = 0;

echo dropdown( $name, $result1, $selected );

/*foreach($resultSet as $value)
{
    echo $value;
}*/


?>
         <input type="number" placeholder="enter added quantity" name="init"> <input type="submit" value="submit">
        </form>
        </pre>
        </div>
        <div class="col-md-6" style="text-align:center">
        <pre>
        <h3>Update Inventory</h3>
       <form action="" method="get">
        <?php
$name = 'ingriedient';

$results = $mysqli->query("SELECT `ingr_name` FROM `inventory_backup`where `ingr_name`<>'chicken'");


if ($results) { 
            //output results from database
            while($obj = $results->fetch_object())
             { $a = $obj->ingr_name;
              $result2[]=$a;
              
            }
               }
  // print_r($result1);

$selected = 0;

echo dropdown( $name, $result2, $selected );

/*foreach($resultSet as $value)
{
    echo $value;
}*/


?>
     <input type="number" placeholder="enter available qty" name="final"> <input type="submit" value="submit">
        </form> 
        </pre>
        </div>
        <div class="container">
            <?php

$query = "SELECT * FROM inventory_backup"; 
$result = mysql_query($query);

echo "<table class='table table-striped table-bordered' style='margin:10px'>"; // start a table tag in the HTML
echo "<tr><th>Item Name</th><th>Initial Quantity</th>	<th>Date Added</th><th>Current Quantity</th><th>Last updated</th></tr>";
while($row = mysql_fetch_array($result)){   //Creates a loop to loop through results
   
echo "<tr><td>" . $row['ingr_name'] . "</td><td>" . $row['init_qty'] . "</td><td>" . $row['date'] . "</td><td>" . $row['current_qty'] . "</td><td>" . $row['last_updated'] . "</td></tr>"; 
}

echo "</table>";
            ?>
        </div>
        
        
    </body>
</html>