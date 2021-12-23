<?php 
  require "../helpers/dbConnection.php";
  require "../helpers/functions.php";
  require "../helpers/checkLogin.php";


  $id = $_GET['id'];

if(!$_SESSION['user']['id'] === $id){
  require "../helpers/checkAdmin.php";
}

  require "./layout/header.php";

  $sqlr = "select * from roles";
  $opr = mysqli_query($con , $sqlr);

 

  $sql = "select * from users where id = $id";
  $op = mysqli_query($con , $sql);
  
  if($op){
    $Data = mysqli_fetch_assoc($op);
  }else{
    header("Location: ".url("Admin/books/index.php"));
  }

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

    $oldName =  $Data['image'];
    # Validate image
    if(!empty($_FILES['image']['name'])){
      $tmpPath = $_FILES['image']['tmp_name'];
      $imageName = $_FILES['image']['name'];
      $imageSize = $_FILES['image']['size'];
      $imageType = $_FILES['image']['type'];
      
      $ex = explode('.',$imageName);
      $extension = end($ex);
      $fileName = rand().time().'.'.$extension;

      $allowedEx = ['jpg' , 'png'];

              if(in_array($extension,$allowedEx)){
                  $desPath = './image/'.$fileName;
              
                  if(move_uploaded_file($tmpPath,$desPath)){
                      echo 'file uploaded ';
                      unlink('./image/'.$Data['image']);
                  }else{
                      echo 'error occured while uploading file';
                  }
              }
          }else{
              $fileName = $oldName;
          }

  
      if (count($errors) > 0){
        foreach($errors as $error => $value){
          echo '<div class="alert alert-danger" role="alert">'.$error.' : '.$value.'</div>';
        }
      }else{
        $sql = "update  users set name = '$name' , email = '$email' ,gender = '$gender',image = '$fileName', role_id = '$role_id' where id = $id" ;
        $opu = mysqli_query($con,$sql);
            if($opu){
              $message = 'Raw updated';
  
              header("Location: ".url("Admin/index.php"));
          } else {
              $message = 'Error Try Again'.mysqli_error($con);
          
          }
          $_SESSION['Message'] = ['message' => $message];
      }
    }

  

  
?>

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
                              echo var_dump($price);
                              }
                              unset($_SESSION['Message']); 
                          ?>

      <?php } ?>

      <!-- user taple  -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">

                  <form action="<?php $_SERVER['PHP_SELF']."?id = $id";?>" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                      <label>Username</label>
                      <input type="text" name="name" class="form-control p_input" value="<?php echo $Data['name']; ?>">
                    </div>
                    <div class="form-group">
                      <label>Email</label>
                      <input type="email" name="email" class="form-control p_input"
                        value="<?php echo $Data['email']; ?>">
                    </div>

                    <div class="form-group my-5">
                      <label class="mr-2">your gender : </label>
                      <select class="form-control" name="gender" aria-label="choose your gender"
                        value="<?php echo $Data['gender']; ?>">
                        <option value="male">male</option>
                        <option value="female">female</option>
                      </select>
                    </div>

                    <div class="form-group my-3">
                      <label for='role' class="mr-2">your role : </label>
                      <select class="form-control" id="role" name="role_id" aria-label="choose your role"
                        value="<?php echo $roleData['id'];?>">
                        <?php while($roleData = mysqli_fetch_assoc($opr)){ ?>
                        <option value=<?php echo $roleData['id']?>><?php echo $roleData['role']; ?> </option>
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
                    </div>
                    <div class="text-center">
                      <button type="submit" class="btn btn-primary btn-block enter-btn my-3">update</button>
                    </div>
                    <div class="d-flex">
                      <button class="btn btn-facebook col mr-2">
                        <i class="mdi mdi-facebook"></i> Facebook </button>
                      <button class="btn btn-google col">
                        <i class="mdi mdi-google-plus"></i> Google plus </button>
                    </div>
                    <p class="terms my-3">By creating an account you are accepting our<a href="#"> Terms &
                        Conditions</a>
                    </p>
                  </form>

                </div>
              </div>
            </div>
          </div>
          <div class="row ">
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- content-wrapper ends -->
  <!-- partial:partials/_footer.html -->
  <?php require './layout/footer.php'; ?>
</body>

</html>