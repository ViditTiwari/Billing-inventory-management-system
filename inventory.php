<?php
include_once 'core/init.php';
if(isset($_GET['ingriedient'])&& isset($_GET['init']))
{   
	$ingr_name=$_GET['ingriedient'];
	$init=$_GET['init'];
    echo "bitch";
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
    <body>
        <form action="" method="get">
        <input type="text" placeholder="Ingriedient Name" name="ingriedient">
        <input type="text" placeholder="Initial quantity" name="init">
        <input type="submit" value="submit">
        </form>
       <form action="" method="get">
        <input type="text" placeholder="Ingriedient Name" name="ingriedient">
        <input type="text" placeholder="final quantity" name="final">
        <input type="submit" value="submit">
        </form> 
        <form action="newinventory.php"><input type="submit" value="add new inventory item"></form>
        
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
        
    </body>
</html>