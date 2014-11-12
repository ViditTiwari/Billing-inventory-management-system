<?php
include_once 'core\init.php';
if(isset($_GET['Name'])&& isset($_GET['QTY'])&& isset($_GET['TABLE_NO']))
{   
	$Name=$_GET['Name'];
	$QTY=$_GET['QTY'];
	$TABLE_NO=$_GET['TABLE_NO'];
	add_kot_item($Name,$QTY,$TABLE_NO);
}
?>
<html>
<head>
    <title>index</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/main.css">
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
        <a href="table1.php" class="btn btn-default ">1</a>
       <a href="tables/table2.php" class="btn btn-default">2</a>
       <a href="tables/table3.php" class="btn btn-default">3</a>
       <a href="tables/table4.php" class="btn btn-default">4</a>
       <a href="tables/table5.php" class="btn btn-default">5</a>
       <a href="tables/table6.php" class="btn btn-default">6</a>
        </div>
        </pre>
      
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