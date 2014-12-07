<?php
session_start();
include_once 'core/init.php';
include_once 'core/database/config.php';

if(isset($_POST['name'])&& isset($_POST['address1'])&& isset($_POST['pincode'])&& isset($_POST['city'])&& isset($_POST['mobno']))

{
  $name = $_POST['name'];
  $address1 = $_POST['address1'];
  $address2 = $_POST['address2'];
  $pincode = $_POST['pincode'];
  $city = $_POST['city'];
  $landmark = $_POST['landmark'];
  $mobno = $_POST['mobno'];

  add_user_detail($name, $address1, $address2, $pincode,$city,$landmark,$mobno);
  
}

  
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
        <li class="active"><a href="homedelivery.php">Home Delivery</a></li>
        <li><a href="addnewitems.php">Add New Items</a></li>    
        <li><a href="inventory.php">Inventory</a></li>    
        
      <ul class="nav navbar-nav navbar-right">
        <li><a href="login.php">Login/out</a></li></ul>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
</header>

<div class="container">
  
  <div class="col-md-6" style="text-align:center">
    <h4>Search User by Mobile Number</h4>


    
    
    <div class="col-md-2"></div>
    <div class="col-md-8" >
      <form action="" method="POST" class="form-horizontal" id = "search" role="form">

        <div class="form-group">
      <input type="text" class="form-control" id="inputNo" name="inputNo" placeholder="Search Mobile Number" required>
      </form>
  <?php
      if(isset($_POST['inputNo']))
      {

      $inputNo=$_POST['inputNo'];

      if(searchNo($inputNo)===0)
      { echo '<br><br>';
        echo '<div class="panel panel-default">';
        echo '<div class="panel-body" style="text-align:center">';
        echo '<span class ="text-danger"><strong>Mobile No not found in database</strong></span>';
        echo '</div>';
        echo '</div>';
      }
      else
      { 
        echo '<br><br>';
        echo '<div class="panel panel-default">';
        echo '<div class="panel-body" style="text-align:center">';
        $results = $mysqli->query("SELECT * FROM user_detail WHERE mob_no='$inputNo'");
           if ($results) { 
            //output results from database
           while($obj = $results->fetch_object())
           { echo '<span class ="text-success"><strong>User found</strong></span><br><br>';
             echo '<span class ="text-success"><strong>'.$obj->Name.'</strong></span><br>';
             echo '<span class ="text-success"><strong>'.$obj->addr_1.'</strong></span><br>';
             echo '<span class ="text-success"><strong>'.$obj->addr_2.'</strong></span><br>';
             echo '<span class ="text-success"><strong>'.$obj->pincode.'</strong></span><br>';
             echo '<span class ="text-success"><strong>'.$obj->landmark.'</strong></span><br>';
             echo '<span class ="text-success"><strong>'.$obj->city.'</strong></span><br>';
             echo '<span class ="text-success"><strong>'.$obj->mob_no.'</strong></span><br>';

             echo'<form action="homedelivery.php" method="POST" class="form-horizontal" id = "user" role="form">';
             echo'<input type="hidden" class="form-control" id="inputNo" name="inputNo" value = '.$inputNo.'>';
             echo'<input type="submit" class="btn btn-success"  value = "Proceed to Menu">';
             echo'</form>';
             
           }
          }
        echo '</div>';
        echo '</div>';
      }

      }

  ?>
    </div>

  </div>

  </div>
    
    <div class="col-md-6" style="text-align:center">
      <h4>Register New User</h4>
      <form action="" method="POST" class="form-horizontal" id = "register" role="form">
            <div class="form-group">
        <label for="name" class="control-label col-md-4">Name*</label>
        <div class="col-md-6">
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter your Name" required>
        </div>
    </div>
            <div class="form-group">
        <label for="Address Line 1 " class="control-label col-md-4">Address Line 1*</label>
        <div class="col-md-6">
            <input type="text" class="form-control" id="address1" name="address1" placeholder="Enter House No, Street" required>
        </div>
    </div>

          <div class="form-group">
        <label for="Address Line 2 " class="control-label col-md-4">Address Line 2</label>
        <div class="col-md-6">
            <input type="text" class="form-control" id="address2" name="address2" placeholder="Enter Area">
        </div>
    </div>

        <div class="form-group">
        <label for="pincode" class="control-label col-md-4">Pin Code*</label>
        <div class="col-md-6">
            <input type="text" class="form-control" id="pincode" name="pincode"placeholder="Enter Pin Code" required>
        </div>
    </div>

          <div class="form-group">
        <label for="Landmark" class="control-label col-md-4">Landmark</label>
        <div class="col-md-6">
            <input type="text" class="form-control" id="landmark" name="landmark" placeholder="Enter Landmark">
        </div>
    </div>

        <div class="form-group">
        <label for="City" class="control-label col-md-4">City*</label>
        <div class="col-md-6">
            <input type="text" class="form-control" id="city" name="city" placeholder="Enter City" required>
        </div>
    </div>

         <div class="form-group">
        <label for="mobno" class="control-label col-md-4">Mobile No.*</label>
        <div class="col-md-6">
            <input type="text" class="form-control" id="mobno" name="mobno"placeholder="Mobile Number" required>
        </div>
    </div>
      <div class="form-group">
        <div class="col-md-offset-4 col-md-2">
    <input type="submit" class="btn"value="REGISTER">
    </div>
  </div>
</form>
    </div>
<body>
   
    
    



<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="js/bootstrap.js"></script>
</body>
</html>