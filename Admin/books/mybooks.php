<?php 
  require "../helpers/dbConnection.php";
  require "../helpers/functions.php";
  require "../helpers/checkLogin.php";
  
  $user_id = $_SESSION['user']['id'];

  $sql = "select * from books where books.user_id = $user_id";
  $op = mysqli_query($con , $sql);

?>


<!DOCTYPE html>
<html lang="en">

<?php require "./layout/header.php"; ?>

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
      <!-- user taple  -->
      <div class="main-panel">
        <div class="content-wrapper" style="background: url(../../images/Login_bg.jpg);">
          <div class="row">
            <?php while($data = mysqli_fetch_assoc($op)){ ?>
            <div class="col-lg-4 grid-margin stretch-card ">
              <div class="card">
                <div class="card-body">
                  <div class="card-dark">
                    <img src="./uploads/<?php echo $data['image'];?>" class="card-img-top" alt="...">
                    <div class="card-body">
                      <h5 class="card-title"><?php echo $data['title'];?></h5>
                      <p class="card-text"><?php echo $data['description'];?></p>
                    </div>
                    <ul class="list-group list-group-flush bg-dark">
                      <li class="list-group-item bg-dark">author: <?php echo $data['author'];?></li>
                      <li class="list-group-item bg-dark">pages: <?php echo $data['price'];?></li>
                      <li class="list-group-item bg-dark">category: <?php echo $data['category'];?> </li>
                      <li class="list-group-item bg-dark">uploaded by: <?php echo $data['uploadedBy'];?> </li>
                    </ul>
                    <div class="card-body">
                      <a href="edit.php?id=<?php echo $data['id']?>"
                        class="card-link btn btn-block btn-primary mx-4 "><i class="mdi mdi-table-edit"></i>Edit</a>
                      <a href="delete.php?id=<?php echo $data['id']?>" class="card-link btn btn-block btn-danger"><i
                          class="mdi mdi-delete"></i>Delete</a>
                      <a href="../cart/create.php?id=<?php echo $data['id']?>"
                        class="card-link btn btn-block btn-success my-2"><i class="mdi mdi-cart"></i> Add to
                        cart</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <?php }?>
          </div>
        </div>
      </div>
    </div>
    <div class="row ">
    </div>
  </div>
  <!-- content-wrapper ends -->
  <!-- partial:partials/_footer.html -->
  <?php require "./layout/footer.php"; ?>
</body>

</html>