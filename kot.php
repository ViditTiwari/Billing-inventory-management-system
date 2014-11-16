<?php

session_start();

include_once 'core/database/config.php';
include_once 'core/init.php';



if(isset($_SESSION["products"]))
          {  $table_no = $_GET["table_no"];
             $return_url = $_GET["return_url"];
             $kot_no=mysql_query("SELECT kot_no FROM present_kot");
             $kot_no=array_first_element($kot_no);
             
             
              foreach ($_SESSION["products"] as $cart_itm)
              {
                  if($cart_itm["table_no"]==$table_no)
                  
                   {    echo $cart_itm["name"];
                        echo '<br>';
                        echo $cart_itm["code"];
                        echo '<br>';
                        echo $cart_itm["qty"];
                        echo '<br>';
                        echo $cart_itm["price"];
                        echo '<br>';
                        echo $cart_itm["table_no"];
                        echo '<br>';
                    
                        {   
                            $Name=$cart_itm["name"];
                            $QTY=$cart_itm["qty"];
                            $TABLE_NO=$cart_itm["table_no"];
                            add_kot_item($Name,$QTY,$TABLE_NO,$kot_no);
                        
                        }
                   }
              }
            $kot_no++;
            mysql_query("UPDATE `present_kot` SET `kot_no`='$kot_no'"); 
           
            
           }

           header('Location: cart_update.php?emptycart=1&return_url='.$return_url.'&table_no='.$table_no.'');
           

           
    
?>