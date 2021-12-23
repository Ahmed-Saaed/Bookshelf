<?php 

  session_start();


$server = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "nti-php-project";
    
   $con =  mysqli_connect($server,$dbUser,$dbPassword,$dbName);

   if(!$con){
       die("Error : ".mysqli_connect_error());
   }

?>