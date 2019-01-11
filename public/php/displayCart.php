<?php
  require 'db.php';
  $connection=db_connect();
  if($_GET['cart']!=""){
  $sql = "SELECT SUM(no_of_cart) FROM carts WHERE user_id=1";// Do Your Insert Query
  $result=mysqli_query($connection, $sql);
  $row = mysqli_fetch_row($result);
  $data=$row[0];
  echo $data;
 }
 ?>