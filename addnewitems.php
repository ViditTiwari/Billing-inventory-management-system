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
?>
<html>
<head>
    <title>add new item</title>
    
<link rel="stylesheet" href="css/bootstrap.css">
<link rel="stylesheet" href="css/main.css">
</head>
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
    </div>
    
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