<?php

session_start();

include_once 'core/database/config.php';
include_once 'core/init.php';



if(isset($_SESSION["products"]))
          {
             $kot_no=mysql_query("SELECT kot_no FROM present_kot");
             $kot_no=array_first_element($kot_no);
             
             
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
                
                    {   
                        $Name=$cart_itm["name"];
                        $QTY=$cart_itm["qty"];
                        $TABLE_NO=2;
                        add_kot_item($Name,$QTY,$TABLE_NO,$kot_no);
                    
                    }

              }
            $kot_no++;
            mysql_query("UPDATE `present_kot` SET `kot_no`='$kot_no'"); 
            
           }
    header('Location:table1.php');
?>