<?php 
  require 'db.php';
  $connection=db_connect();
  if($_POST['done']!=""){
  $p_id = $_POST['p_id'];
  $user_id = $_POST['user_id'];
  $no_of_cart = $_POST['no_of_cart'];
  $insert = "INSERT INTO carts(user_id, p_id, no_of_cart) values('$user_id','$p_id', '$no_of_cart')";// Do Your Insert Query
  if(mysqli_query($connection, $insert)) {
   echo "Success";
  } else {
   echo "Cannot Insert";
  }
 }
?>