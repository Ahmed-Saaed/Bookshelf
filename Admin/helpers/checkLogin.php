<!-- authoerize -->



<?php


    if(!isset($_SESSION['user'])){
      header("Location: ".url("pages/login.php"));
    }

?>