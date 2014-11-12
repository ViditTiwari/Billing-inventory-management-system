<?php

session_start();

include_once 'core/database/config.php';

if(isset($_SESSION["products"]))
          {
             
              foreach ($_SESSION["products"] as $cart_itm)
              {
                  
                  
                  echo $cart_itm["name"];
                  echo '<br>';
                  echo $cart_itm["code"];
                  echo '<br>';
                  echo $cart_itm["qty"];
                  echo '<br>';
                  echo $cart_itm["price"];
                  echo '<br>';
                  echo 'Table 1, I will make it a session variable, use hard code value for now';
                  echo '<br>';
               
              }

           }

?>