<?php 

    require "../helpers/dbConnection.php";
    require "../helpers/functions.php";
    require "../helpers/checkLogin.php";
    require "../helpers/checkReader.php";


  $userData = $_SESSION['user']['name'] ;
  # Fetch Roles .....
$sql = 'select * from users';
$opu = mysqli_query($con, $sql);

$uData = mysqli_fetch_assoc($opu);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // CODE ......
    $title   = Clean($_POST['title']);
    $author = Clean($_POST['author']);
    $pages = Clean($_POST['pages']);
    $price = Clean($_POST['price']);
    $category = Clean($_POST['category']);
    $description = Clean($_POST['description']);
    $uploadedBy = $_SESSION['user']['name'];
    $user_id  = $_SESSION['user']['id'];
    $user_name  = $_SESSION['user']['name'];

    # Validation ......
    $errors = [];

    # Validate Name
    if (!validate($title, 1)) {
        $errors['Title'] = 'Field Required';
    } elseif (!validate($title, 7)) {
        $errors['Title'] = 'Invalid String';
    }

    # Validate author
    if (!validate($author, 1)) {
        $errors['author'] = 'Field Required';
    }
    if (!validate($pages, 1)) {
        $errors['pages'] = 'Field Required';
    }
    
    if (!validate($description, 1)) {
        $errors['description'] = 'Field Required';
    }


    # Validate image
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
          $desPath = './uploads/'.$FinalName;

          if (move_uploaded_file($tmpPath, $desPath)) {
              $message = 'file uploaded';
                
          } else {
              $message = 'Error In Uploading file';
          }
        }
    }

    if (count($errors) > 0) {
        $_SESSION['Message'] = $errors;
      } else {
        // db ..........
        $sql  = "insert into books (title,author,pages,price,image,category,description,uploadedBy,user_id) values ('$title','$author','$pages','$price','$FinalName','$category','$description','$user_name',$user_id)";

        $op = mysqli_query($con, $sql);

        if ($op) {
            $message = 'Raw Inserted';
        } else {
            $message = 'Error Try Again'.mysqli_error($con);
        
        }
        $_SESSION['Message'] = ['message' => $message];
    }
  }

?>

<!DOCTYPE html>
<html lang="en">

<?php require "./layout/header.php"; ?>

<body>
  <div class="container-scroller ">

    <?php  require '../layout/sidebar.php'; ?>

    <!-- partial:partials/_sidebar.html -->

    <!-- partial -->
    <div class="container-fluid page-body-wrapper my-5">
      <!-- partial:partials/_navbar.html -->
      <?php require '../layout/navbar.php';?>

      <?php 
                            
                            if(isset($_SESSION['Message'])){
                              foreach($_SESSION['Message'] as $error => $value){
                              echo '<div class="alert alert-danger" role="alert">'.$error.' : '.$value.'</div>';
                              }
                              unset($_SESSION['Message']); 
                          ?>

      <?php } ?>

      <div class="main-panel">
        <div class="content-wrapper" style="background: url(../../images/Login_bg.jpg);">

          <div class="row p-4">

            <div class="col-12 grid-margin stretch-card">
              <div class="card" sytle="margin: 30px;">
                <div class="card-body ">
                  <h4 class="card-title">Add Your Book</h4>
                  <p class="card-description"> Add your Book </p>

                  <form class="forms-sample  " action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>"
                    method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="Name1">title</label>
                      <input type="text" name="title" class="form-control" id="title1" placeholder="title">
                    </div>
                    <div class="form-group">
                      <label for="author3">author</label>
                      <input type="text" name="author" class="form-control" id="author" placeholder="author">
                    </div>
                    <div class="form-group">
                      <label for="pages4">pages</label>
                      <input type="number" name="pages" class="form-control" id="pages4" placeholder="pages">
                    </div>

                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text">$</span>
                        </div>
                        <div class="input-group-prepend">
                          <span class="input-group-text">0.00</span>
                        </div>
                        <input type="number" name="price" class="form-control"
                          aria-label="Amount (to the nearest dollar)" />
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="category4">category</label>
                      <input type="text" name="category" class="form-control" id="category4" placeholder="category">
                    </div>
                    <div class="form-group">
                      <label for="description1">description</label>
                      <textarea class="form-control" name="description" id="description" rows="4"></textarea>
                    </div>

                    <div class="form-group">
                      <div class="input-group-dark mb-3">
                        <label class="input-group-dark" for="inputGroupFile01">Upload</label>
                        <input type="file" name="image" class="form-control" id="inputGroupFile01">
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <button class="btn btn-dark">Cancel</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php require "./layout/footer.php"; ?>
</body>

</html>