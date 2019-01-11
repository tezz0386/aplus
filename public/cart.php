<?php 
  require 'db.php';
  $connection=db_connect();
  if($_POST['done']!=""){
  $p_id = $_POST['p_id'];
  $u_id = $_POST['u_id'];
  $insert = "INSERT INTO carts(p_id, u_id) values('$p_id','$u_id')";// Do Your Insert Query
  if(mysqli_query($connection, $insert)) {
   echo "Success";
  } else {
   echo "Cannot Insert";
  }
 }
?>