<?php
    require "../helpers/dbConnection.php";
    require "../helpers/functions.php";
    require "../helpers/checkLogin.php";

  $sql = "delete from cart";
  $op = mysqli_query($con , $sql);

  if($op){
    $message = "cart deleted";
  }else{
    $message = "error: already deleted or it is not there";

  }

  $_SESSION['message'] = $message;
  header('Location: '.url("Admin/cart/index.php"));
?>