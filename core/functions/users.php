<?php
function array_first_element($var)
{
  $row = mysql_fetch_row($var);
 if($row[0])
 {  
 	return $row [0]; 
}
}
function add_menu_item($item_name,$price,$category)

{ $category_id = get_category_id($category);
	

  mysql_query("INSERT INTO menu (item_name, price, category_id) VALUES ('$item_name', '$price', '$category_id')");
}

function get_category_id($category)
{ echo $category;
 $result = mysql_query("SELECT category_id FROM category WHERE category='$category'");

 $row = mysql_fetch_row($result);
 if($row[0])
 {  
 	return $row[0];
 }

}

function add_category($category)
{
    mysql_query("INSERT INTO category (category) VALUES ('$category')");
}
function add_kot_item($Name,$QTY,$TABLE_NO,$kot_no)

{ 
    
 $BITCH = mysql_query("SELECT ID FROM menu WHERE item_name='$Name'");
    $row = mysql_fetch_row($BITCH);
    $ID= $row[0];
    
  mysql_query("INSERT INTO kot (ID,QTY,TABLE_NO,kot_no) VALUES ('$ID','$QTY','$TABLE_NO','$kot_no')");
    
}

function add_to_bill($ID,$QTY,$TABLE_NO,$PRICE,$bill_no)
{ 

    mysql_query("INSERT INTO `bill`(ID,QTY,TABLE_NO,price,bill_no) Values('$ID','$QTY','$TABLE_NO','$PRICE','$bill_no')");

  
  
}

function get_table_kot($table_no)
{
    $table=array();
    $table=mysql_query("SELECT (ID,QTY,TABLE_NO,kot_no) FROM kot WHERE TABLE_NO='$table_no'"); /*id to menu*/
           
}

function add_kot_to_kotb($table_no)
{
    mysql_query("insert into kot_backup select * from kot where table_no='$table_no'");
}

function add_kot_to_bill($table_no)
{   
    $bill_no=mysql_query("SELECT bill_no FROM present_bill");
    $bill_no=array_first_element($bill_no);
    if($table_no==7)
    { 
        $type=2;
      }
    elseif($table_no==8)
    {
        $type=3;
    }
    else{
        $type=1;
    }
    mysql_query("INSERT INTO `bill`(ID,QTY,TABLE_NO,price,bill_no,type) SELECT kot.ID, kot.QTY,kot.TABLE_NO,menu.price,present_bill.bill_no,1 FROM present_bill,kot INNER JOIN menu ON kot.id=menu.id WHERE kot.table_no='$table_no'");     
    
    $bill_no++;
     mysql_query("UPDATE `present_bill` SET `bill_no`='$bill_no'"); 
    // $temp=mysql_query("select * from kot where table_no='$table_no'");//insert into bill(ID,QTY,TABLE_NO) SELECT ID,QTY,TABLE_NO FROM kot WHERE TABLE_NO=2
   // mysql_query("insert into bill '$temp'");//UPDATE `bill` SET `price`= menu.price WHERE bill.id = menu.id
}

function delete_all_kot($table_no)
{
    mysql_query("DELETE FROM kot WHERE table_no = '$table_no'");
}
//**********BILL*********



//*********INVENTORY********

function add_inventory_item_init($ingr_name,$init)
{
  $ingr_id= get_ingr_id($ingr_name);
   mysql_query("INSERT INTO inventory (ingr_id,init_qty,date) VALUES ('$ingr_id','$init',CURRENT_DATE())");
}


function get_ingr_id($ingr_name)
{
    echo "$ingr_name";
 $result = mysql_query("SELECT ingr_id FROM item WHERE ingr_name='$ingr_name'");

 $row = mysql_fetch_row($result);
 if($row[0])
 {  
 	return $row[0];
 }

}
function add_inventory_item_final($ingr_name,$final)
{
    
mysql_query("UPDATE `inventory` SET `final_qty`='$final' WHERE date =CURRENT_DATE()");   //&& ingr_id=$ingr_id
    $BITCH = mysql_query("SELECT init_qty-final_qty FROM inventory WHERE date = CURRENT_DATE()");
    $row = mysql_fetch_row($BITCH);
   $ID= $row[0];
    echo "remaining quantity = "+$ID;
}

function add_new_ingr_item($ingr_name)
{
 mysql_query("INSERT INTO item (ingr_name) VALUES ('$ingr_name')");  
}

//*******LOGIN********
?>

