<?php
session_start(); //start session
include_once("core/database/config.php"); //include config file

//empty cart by distroying current session
if(isset($_GET["emptycart"]) && $_GET["emptycart"]==1 && isset($_GET["table_no"]) && isset($_SESSION["products"]))
{
    $return_url = base64_decode($_GET["return_url"]); //return url
    $table_no = $_GET["table_no"];

    
    foreach ($_SESSION["products"] as $cart_itm) //loop through session array var
    {
        if($cart_itm["table_no"]!=$table_no){ //item does,t exist in the list
            $product[] = array('name'=>$cart_itm["name"], 'code'=>$cart_itm["code"], 'qty'=>$cart_itm["qty"], 'price'=>$cart_itm["price"], 'table_no'=>$cart_itm["table_no"]);
        }
        
        //create a new product list for cart
        $_SESSION["products"] = $product;
    }

    header('Location:'.$return_url);
}

//add item in shopping cart
if(isset($_POST["type"]) && $_POST["type"]=='add')
{
    $item_code   = filter_var($_POST["item_code"], FILTER_SANITIZE_STRING); //product code
    $item_qty    = filter_var($_POST["product_qty"], FILTER_SANITIZE_NUMBER_INT); //product qty
    $table_no = filter_var($_POST["table_no"], FILTER_SANITIZE_NUMBER_INT); //table no
    $return_url     = base64_decode($_POST["return_url"]); //return url
    
    
    //MySqli query - get details of item from db using product code
    $results = $mysqli->query("SELECT item_name,price FROM menu WHERE ID ='$item_code' LIMIT 1");
    $obj = $results->fetch_object();
    
    if ($results) { //we have the product info 
        
        //prepare array for the session variable
        $new_product = array(array('name'=>$obj->item_name, 'code'=>$item_code, 'qty'=>$item_qty, 'price'=>$obj->price, 'table_no'=>$table_no));
        
        if(isset($_SESSION["products"])) //if we have the session
        {
            $found = false; //set found item to false
            
            foreach ($_SESSION["products"] as $cart_itm) //loop through session array
            {
                if($cart_itm["code"] == $item_code && $cart_itm["table_no"]==$table_no){ //the item exist in array
                    $new_qty = $cart_itm["qty"] + $item_qty;
                    $product[] = array('name'=>$cart_itm["name"], 'code'=>$cart_itm["code"], 'qty'=>$new_qty, 'price'=>$cart_itm["price"], 'table_no'=>$cart_itm["table_no"]);
                    $found = true;
                }else{
                    //item doesn't exist in the list, just retrive old info and prepare array for session var
                    $product[] = array('name'=>$cart_itm["name"], 'code'=>$cart_itm["code"], 'qty'=>$cart_itm["qty"], 'price'=>$cart_itm["price"], 'table_no'=>$cart_itm["table_no"]);
                }
            }
            
            if($found == false) //we didn't find item in array
            {
                //add new user item in array
                $_SESSION["products"] = array_merge($product, $new_product);
            }else{
                //found user item in array list, and increased the quantity
                $_SESSION["products"] = $product;
            }
            
        }else{
            //create a new session var if does not exist
            $_SESSION["products"] = $new_product;
        }
        
    }
    
    //redirect back to original page
    header('Location:'.$return_url);
}

//remove item from shopping cart
if(isset($_GET["removep"]) && isset($_GET["return_url"]) && isset($_GET["table_no"]) && isset($_SESSION["products"]))
{
    $product_code   = $_GET["removep"]; //get the product code to remove
    $table_no       = $_GET["table_no"];
    $return_url     = base64_decode($_GET["return_url"]); //get return url

    
    foreach ($_SESSION["products"] as $cart_itm) //loop through session array var
    {
        if($cart_itm["code"]!=$product_code || $cart_itm["table_no"]!=$table_no){ //item does,t exist in the list
            $product[] = array('name'=>$cart_itm["name"], 'code'=>$cart_itm["code"], 'qty'=>$cart_itm["qty"], 'price'=>$cart_itm["price"], 'table_no'=>$cart_itm["table_no"]);
        }
        
        //create a new product list for cart
        $_SESSION["products"] = $product;
    }
    
    //redirect back to original page
    header('Location:'.$return_url);
}
