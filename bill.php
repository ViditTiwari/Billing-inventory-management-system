<?php

session_start();

include_once 'core/database/config.php';
include_once 'core/init.php';


$inputNo = $_GET['inputNo'];


if(isset($_SESSION["products"]))
          {  $table_no = $_GET["table_no"];
             $return_url = $_GET["return_url"];
           
             $bill_no=mysql_query("SELECT bill_no FROM present_bill");
             $bill_no=array_first_element($bill_no);
             
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
                    
                        {   $ID = $cart_itm["code"];
                            $Name=$cart_itm["name"];
                            $QTY=$cart_itm["qty"];
                            $TABLE_NO=$cart_itm["table_no"];
                            $PRICE = $cart_itm["price"];
                            add_to_bill($ID,$QTY,$TABLE_NO,$PRICE,$bill_no);
                        
                        }
                   }

              }
              if($table_no==8)
                   { 
                    add_to_user_order($inputNo, $bill_no);
                   }
                   unset($_SESSION['inputNo']);
                $bill_no++;
               mysql_query("UPDATE `present_bill` SET `bill_no`='$bill_no'"); 
            
           
            
           }

           header('Location: cart_update.php?emptycart=1&return_url='.$return_url.'&table_no='.$table_no.'');
           

           
    
?>