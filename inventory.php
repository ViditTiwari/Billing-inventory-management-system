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
        <li><a href="homedelivery.php">Home Delivery</a></li>
        <li><a href="addnewitems.php">Add New Items</a></li>    
        <li class="active"><a href="inventory.php">Inventory</a></li>    
        
      <ul class="nav navbar-nav navbar-right">
        <li><a href="login.php">Login/out</a></li></ul>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
</header>
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
        
        
        
    </body>
</html>