<?php
session_start();

include_once 'core/database/config.php';

?>
<html>
<head>
   <meta charset="utf-8">
    <title>Take Away</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/main.css">
    <link href="css/style.css" rel="stylesheet">

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
        <li class="active"><a href="takeaway.php">Take Away</a></li>
        <li><a href="homedelivery.php">Home Delivery</a></li>
        <li><a href="addnewitems.php">Add New Items</a></li>    
        <li><a href="inventory.php">Inventory</a></li>    
        
      <ul class="nav navbar-nav navbar-right">
        <li><a href="login.php">Login/out</a></li></ul>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
</header>
<body>
   
    
    



<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="js/bootstrap.js"></script>
</body>
</html>