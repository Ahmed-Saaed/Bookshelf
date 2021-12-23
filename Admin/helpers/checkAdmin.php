<?php 

  if($_SESSION['user']['role_id'] != 3) {
    header("Location: ".url("Admin/books/index.php"));
  }

?>