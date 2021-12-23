<?php 

require '../Admin/helpers/dbConnection.php';
require '../Admin/helpers/functions.php';

$errors = [];

  if($_SERVER['REQUEST_METHOD'] === 'POST'){
  $email = clean($_REQUEST['email']);
  $password = clean($_REQUEST['password']);

  if(!validate($email , 1)){
    $errors['email'] = 'please enter the email';
  }elseif(!validate($email ,2)){
    $errors['email'] = 'enter valid email';
  }

  if(!validate($password , 1)){
    $errors['email'] = 'please enter your password';
  }elseif(!validate($password ,3 , 6)){
    $errors['email'] = 'enter a valied password';
  }

  $hpassword = md5($password);

    if (count($errors) > 0){
      foreach($errors as $error => $value){
        echo '<div class="alert alert-danger" role="alert">'.$error.' : '.$value.'</div>';
      }
    }else{

      $sql =  "select * from users where email = '$email' and password = '$hpassword'" ;
      $op = mysqli_query($con , $sql);

      if (mysqli_num_rows($op) == 1){

        // $sql =  "select * from users where email = '$email' and password = '$hpassword'" ;
        $sql =  "select users.* , roles.role from users inner join roles on users.role_id = roles.id where users.email = '$email' and users.password = '$hpassword'" ;
        $op = mysqli_query($con , $sql);

        $userData = mysqli_fetch_assoc($op);

        $_SESSION['user'] = $userData;

        $user = $userData['name'];

        header("Location: ".url("Admin/index.php?title=$user"));
      }else{
        echo '<div class="alert alert-danger" role="alert">'.'user is not registered'.'</div>';
      }
    }
  }
?>


<!DOCTYPE html>
<html lang="en">
<?php require './layout/header.php' ?>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="row w-100 m-0">
        <div class="content-wrapper full-page-wrapper d-flex align-items-center"
          style="background: url(../images/Login_bg.jpg);">
          <div class="card col-lg-4 mx-auto">
            <div class="card-body px-5 py-5">
              <h3 class="card-title text-left mb-3">Login</h3>
              <form action="<?php $_SERVER['PHP_SELF'];?>" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                  <label> email *</label>
                  <input type="email" name="email" class="form-control p_input">
                </div>
                <div class="form-group">
                  <label>Password *</label>
                  <input type="password" name="password" class="form-control p_input">
                </div>
                <div class="form-group d-flex align-items-center justify-content-between">
                  <div class="form-check">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input"> Remember me </label>
                  </div>
                  <a href="./register.php" class="forgot-pass">Forgot password</a>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary btn-block enter-btn my-2">Login</button>
                </div>
                <div class="d-flex">
                  <button class="btn btn-facebook mr-2 col">
                    <i class="mdi mdi-facebook"></i> Facebook </button>
                  <button class="btn btn-google col">
                    <i class="mdi mdi-google-plus"></i> Google plus </button>
                </div>
                <p class="sign-up my-3">Don't have an Account?<a href="./register.php"> Sign Up</a></p>
              </form>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- row ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="../../assets/vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="../../assets/js/off-canvas.js"></script>
  <script src="../../assets/js/hoverable-collapse.js"></script>
  <script src="../../assets/js/misc.js"></script>
  <script src="../../assets/js/settings.js"></script>
  <script src="../../assets/js/todolist.js"></script>
  <!-- endinject -->
</body>

</html>