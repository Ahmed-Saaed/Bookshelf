<?php
    require "../helpers/dbConnection.php";
    require "../helpers/functions.php";
    require "../helpers/checkLogin.php";


  $id = $_GET['id'];

  if(!validate($id, 4)){
    $message = 'invalid Number';
  }else{
    $sql = "select * from orders where id= $id";
    $op = mysqli_query($con , $sql);

      if (mysqli_num_rows($op)==1){

        $sql = "delete from orders where id = $id";
        $op = mysqli_query($con, $sql);

          if($op){
            $message = 'raw deleted';
          }else{
            $message = 'Error occured try again later';
          }
      }else{
        $message = 'Error in order id';
      }
  }

  $_SESSION['message'] = $message;
  header('Location: '.url("Admin/order/index.php"));
?>