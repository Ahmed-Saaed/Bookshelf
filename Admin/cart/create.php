<?php

require "../helpers/dbConnection.php";
require "../helpers/functions.php";
require "../helpers/checkLogin.php";

$id = $_GET['id'];
$user_id = $_SESSION['user']['id'];






$sql = "insert into cart (book_id , user_id) values ('$id' , '$user_id')";
$op = mysqli_query($con,$sql);

if($op){
  $message = 'Added to cart';
  
  header("Location: ".url("Admin/books"));
}else{
  $message = 'Error Try Again'.mysqli_error($con);
}

$_SESSION['Message'] = ['message' => $message];

?>




<!DOCTYPE html>
<html lang="en">

<?php require "../books/layout/header.php"; ?>

<body>
  <div class="container-scroller">

    <?php require '../layout/sidebar.php'; ?>

    <!-- partial:partials/_sidebar.html -->

    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_navbar.html -->
      <?php require '../layout/navbar.php';?>
      <!-- partial -->
      <?php 
                            
                            if(isset($_SESSION['Message'])){
                              foreach($_SESSION['Message'] as $error => $value){
                              echo '<div class="alert alert-danger" role="alert">'.$error.' : '.$value.'</div>';
                              
                              }
                              unset($_SESSION['Message']); 
                          ?>

      <?php } ?>
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">



          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row ">
  </div>
  </div>
  <!-- content-wrapper ends -->
  <!-- partial:partials/_footer.html -->
  <?php require "../books/layout/footer.php"; ?>
</body>

</html>