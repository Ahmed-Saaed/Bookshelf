<?php
    require "../helpers/dbConnection.php";
    require "../helpers/functions.php";
    require "../helpers/checkLogin.php";
    require "../helpers/checkAdmin.php";





  $id = $_GET['id'];

  if(!validate($id, 4)){
    $message = 'invalid Number';
  }else{
    $sql = "select * from users where id= $id";
    $op = mysqli_query($con , $sql);

      if (mysqli_num_rows($op)==1){

        $sql = "delete from users where id = $id";
        $op = mysqli_query($con, $sql);

          if($op){
            $message = 'raw deleted';
          }else{
            $message = 'Error occured try again later';
          }
      }else{
        $message = 'Error in book id';
      }
  }

  $_SESSION['message'] = $message;
  header('Location: '.url("Admin/index.php"));
?>