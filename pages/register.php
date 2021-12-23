<?php 

require '../Admin/helpers/dbConnection.php';
require '../Admin/helpers/functions.php';


    $sqlr = "select * from roles where not id = 3";
    $opr = mysqli_query($con , $sqlr);

    
    $errors = [];
    
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $name = clean($_REQUEST['name']);
        $email = clean($_REQUEST['email']);
        $password = clean($_REQUEST['password']);
        $gender = $_REQUEST['gender'];
        $role_id = $_REQUEST['role_id'];


        
    
      if(!validate($name , 1)){
        $errors['name'] = 'you have to enter your name';
      }

      if(!validate($gender , 1)){
        $errors['gender'] = 'choose a gender';
      }

      if(!validate($role_id , 1)){
        $errors['role'] = 'wrong role_id';
      }
      

      
      if(!validate($email , 1)){
        $errors['email'] = 'please enter the email';
      }elseif(!validate($email ,2)){
        $errors['email'] = 'only valid email ';
      }

      if(!validate($password , 1)){
        $errors['password'] = 'please enter your password';
      }elseif(!validate($password ,3 , 6)){
        $errors['password'] = 'enter a valied password';
      }

      if (!validate($_FILES['image']['name'], 1)) {
        $errors['Image'] = 'Field Required';
    } else {
        $tmpPath = $_FILES['image']['tmp_name'];
        $imageName = $_FILES['image']['name'];
        $imageSize = $_FILES['image']['size'];
        $imageType = $_FILES['image']['type'];

        $exArray = explode('.', $imageName);
        $extension = end($exArray);

        $FinalName = rand().time().'.'. $extension;

        $allowedExtension = ['png', 'jpg'];

        if (!validate($extension, 5)) {
            $errors['Image'] = 'Error In Extension';
        }else{
          $desPath = '../Admins/users/image/'.$FinalName;

          if (move_uploaded_file($tmpPath, $desPath)) {
              $message = 'file uploaded';
                
          } else {
              $message = 'Error In Uploading file';
          }
        }
    }




      $hpassword = md5($password);
    
    
        if (count($errors) > 0){
          foreach($errors as $error => $value){
            echo '<div class="alert alert-danger" role="alert">'.$error.' : '.$value.'</div>';
          }
        }else{
          $sql = "insert into users(name , email , password ,gender ,image, role_id) values ('$name','$email','$hpassword','$gender','$FinalName','$role_id')";
          $op = mysqli_query($con,$sql);
              if($op){
                echo '|| data inserted';
                header("Location: ".url("/Admin/index.php"));
              }else{
                echo 'Error try again'.mysqli_error($con);
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
        <div class="content-wrapper full-page-wrapper d-flex align-items-center "
          style="background: url(../images/Login_bg.jpg);">
          <div class="card col-lg-4 mx-auto">
            <div class="card-body px-5 py-5">
              <h3 class="card-title text-left mb-3">Register</h3>
              <form action="<?php $_SERVER['PHP_SELF'];?>" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                  <label>Username</label>
                  <input type="text" name="name" class="form-control p_input">
                </div>
                <div class="form-group">
                  <label>Email</label>
                  <input type="email" name="email" class="form-control p_input">
                </div>
                <div class="form-group">
                  <label>Password</label>
                  <input type="password" name="password" class="form-control p_input">
                </div>

                <div class="form-group my-5">
                  <label class="mr-2">your gender : </label>
                  <select class="form-control" name="gender" aria-label="choose your gender">
                    <option value="male">male</option>
                    <option value="female">female</option>
                  </select>
                </div>

                <div class="form-group my-3">
                  <label for='role' class="mr-2">your role : </label>
                  <select class="form-control" id="role" name="role_id" aria-label="choose your role">
                    <?php while($roleData = mysqli_fetch_assoc($opr)){ ?>
                    <option value=<?php echo $roleData['id']?>><?php echo $roleData['role'] ?> </option>
                    <?php } ?>
                  </select>
                </div>

                <div class="form-group">
                  <div class="input-group-dark mb-3">
                    <label class="input-group-dark" for="inputGroupFile01">Upload</label>
                    <input type="file" name="image" class="form-control" id="inputGroupFile01">
                  </div>
                </div>

                <div class="form-group d-flex align-items-center justify-content-between">
                  <div class="form-check">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input"> Remember me </label>
                  </div>
                  <a href="#" class="forgot-pass">Forgot password</a>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary btn-block enter-btn my-3">register</button>
                </div>
                <div class="d-flex">
                  <button class="btn btn-facebook col mr-2">
                    <i class="mdi mdi-facebook"></i> Facebook </button>
                  <button class="btn btn-google col">
                    <i class="mdi mdi-google-plus"></i> Google plus </button>
                </div>
                <p class="terms my-3">By creating an account you are accepting our<a href="#"> Terms & Conditions</a>
                </p>
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