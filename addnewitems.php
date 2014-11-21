<?php
include_once 'core/init.php';
if(isset($_GET['ingriedient']))
{   
	$ingr_name=$_GET['ingriedient'];
	add_new_ingr_item($ingr_name);
}
if(isset($_GET['item'])&& isset($_GET['price'])&& isset($_GET['category']))
{   
	$item_name=$_GET['item'];
	$price=$_GET['price'];
	$category=$_GET['category'];
	add_menu_item($item_name,$price,$category);
}
if(isset($_GET['category']))
{   
	$category=$_GET['category'];
	add_category($category);
}
?>
<html>
<head>
    <title>add new item</title>
    
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
        <li class="active"><a href="addnewitems.php">Add New Items</a></li>    
        <li><a href="inventory.php">Inventory</a></li>    
        
      <ul class="nav navbar-nav navbar-right">
        <li><a href="login.php">Login/out</a></li></ul>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
</header>
<body>
  <div class="container">
   <pre>
   <h3>NEW INVENTORY ITEM</h3>
    <form action="" method="get">
       <input type="text" placeholder="Ingiedient name" name="ingriedient">
       <input type="submit" value="submit">
    </form>
</pre>
  
   <pre>
   <h3>NEW MENU ITEM</h3>
    <form action="" method="GET">
        <input type="text"  placeholder="Dish Name" name ="item" >
        <input type="text"  placeholder="Category" name="category" >
        <input type="number"  placeholder="Price" name="price">
        <input value="submit" type="submit">
    </form>
</pre>
   <pre>
   <h3>NEW CATEGORY</h3>
    <form action="" method="GET">
        <input type="text"  placeholder="New Category" name ="category" >
        <input value="submit" type="submit">
    </form>
</pre>
    </div>
    
    
            
</body>

</html>