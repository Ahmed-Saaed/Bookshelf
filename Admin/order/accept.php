<?php 

require "../helpers/dbConnection.php";
require "../helpers/functions.php";
require "../helpers/checkLogin.php";
require "../helpers/checkAdmin.php";

$id = $_GET['id'];

$sql = "update orders set status = 'done' where id = $id";
$op = mysqli_query($con , $sql);


if($op){
  header("Location: ".url("Admin/order/index.php"));
}
?>