<?php
  require 'db.php';
  $connection=db_connect();
  if($_GET['cart']!=""){
  $sql = "SELECT p_id FROM carts WHERE id=1";// Do Your Insert Query
  $result=mysqli_query($connection, $sql);
  $row = mysqli_fetch_row($result);
  $data=$row[0];
  echo $data;
 }
 ?>