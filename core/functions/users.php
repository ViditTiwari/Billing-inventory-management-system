<?php
function array_first_element($var)
{
  $row = mysql_fetch_row($var);
 if($row[0])
 {  
 	return $row [0]; 
}
}
function add_menu_item($item_name,$price,$category,$chicken)

{ $category_id = get_category_id($category);
	

  mysql_query("INSERT INTO menu (item_name, price, category_id,chicken) VALUES ('$item_name', '$price', '$category_id','$chicken')");
}

function get_category_id($category)
{ //echo $category;
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
    $chicken=mysql_query("select chicken from menu where id='$ID'");
    $chicken=array_first_element($chicken);
    if($chicken!=0){
         update_inventory($QTY*$chicken);
    }
  mysql_query("INSERT INTO kot (ID,QTY,TABLE_NO,kot_no) VALUES ('$ID','$QTY','$TABLE_NO','$kot_no')");
    

}
function add_to_bill($ID,$QTY,$TABLE_NO,$PRICE,$bill_no)
{
    $type=1;

    if($TABLE_NO==7)
    { 
        $type=2;
      }
    elseif($TABLE_NO==8)
    {
        $type=3;
    }
    
   $chicken=mysql_query("select chicken from menu where id='$ID'");
    $chicken=array_first_element($chicken);
    if($chicken!=0){
         update_inventory($QTY);
    }
    mysql_query("INSERT INTO `bill`(ID,QTY,TABLE_NO,price,bill_no,type) Values('$ID','$QTY','$TABLE_NO','$PRICE','$bill_no','$type')");

    
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
//**********dropdown*********

function dropdown( $name, array $options, $selected=null )
{
    /*** begin the select ***/
    $dropdown = '<select name="'.$name.'" id="'.$name.'">'."\n";

    $selected = $selected;
    /*** loop over the options ***/
    foreach( $options as $key=>$option )
    {
        /*** assign a selected value ***/
        $select = $selected==$key ? ' selected' : null;

        /*** add each option to the dropdown ***/
        $dropdown .= '<option value="'.$option.'"'.$select.'>'.$option.'</option>'."\n";
        

    }

    /*** close the select ***/
    $dropdown .= '</select>'."\n";

    /*** and return the completed dropdown ***/
    return $dropdown;
}

//*********INVENTORY********

function add_inventory_item_init($ingr_name,$init)
    
{
     $ingr_id= get_ingr_id($ingr_name);
    
   mysql_query("INSERT INTO inventory_b(ingr_id, qty_used, `from`) SELECT ingr_id, init_qty-current_qty, date FROM inventory_backup where ingr_name='$ingr_name'");
    
    mysql_query("UPDATE `inventory_backup` SET `init_qty`=current_qty+'$init',date=CURRENT_DATE() WHERE `ingr_name`='$ingr_name'");
    
 
    
}


function get_ingr_id($ingr_name)
{
 $result = mysql_query("SELECT ingr_id FROM item WHERE ingr_name='$ingr_name'");

     $row = mysql_fetch_row($result);
     if($row[0])
     {  
        return $row[0];
     }

}
function add_inventory_item_final($ingr_name,$final)
{
    $ingr_id= get_ingr_id($ingr_name);
   
        mysql_query("UPDATE `inventory_backup` SET `current_qty`='$final',last_updated=CURRENT_DATE() WHERE `ingr_name`='$ingr_name'");
    
}

function add_new_ingr_item($ingr_name)
{
    mysql_query("INSERT INTO `inventory_backup`(`ingr_name`) VALUES ('$ingr_name')");
}

function update_inventory($qty)
{
    $check=mysql_query("SELECT `current_qty` FROM `inventory_backup` WHERE `ingr_name`='chicken'");
    $check=array_first_element($check);
    echo $check;
   // if($check==NULL)
    //{
        mysql_query("UPDATE `inventory_backup` SET `current_qty`=current_qty-'$qty',last_updated=CURRENT_DATE() WHERE `ingr_name`='chicken'");
    
    
}

function add_user_detail($name, $address1, $address2, $pincode,$city,$landmark,$mobno)
{  
  
   mysql_query("INSERT INTO user_detail (Name,addr_1,addr_2,pincode,landmark,city,mob_no) VALUES ('$name','$address1','$address2','$pincode','$landmark','$city','$mobno')");
}

function searchNo($inputNo)
{
  if (!(mysql_num_rows(mysql_query("SELECT * FROM user_detail WHERE mob_no='$inputNo'"))))
    
    return 0;


}
function add_to_user_order($inputNo,$bill_no)
{
  mysql_query("INSERT INTO user_order (mob_no,bill_no) VALUES ('$inputNo','$bill_no')");
}
?>

