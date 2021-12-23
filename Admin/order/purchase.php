<?php 
  require "../helpers/dbConnection.php";
  require "../helpers/functions.php";
  require "../helpers/checkLogin.php";

  

  $user_id = $_SESSION['user']['id'];
  $user_name = $_SESSION['user']['name'];

  
  $sql = "select sum(books.price) as price , cart.id from books inner join cart on books.id = cart.book_id where cart.user_id = $user_id";
  $opc = mysqli_query($con,$sql);
  $fullPrice = mysqli_fetch_assoc($opc);
  $price = $fullPrice['price'] ;
  
  // start : what i have added after the project disccusion "get the count and the book title to add it to the order details";
  
  $sql = "select cart.* ,books.title from cart inner join books on cart.book_id = books.id where cart.user_id = $user_id"; 
  $opa = mysqli_query($con , $sql);
      if($opa){
        $count = mysqli_num_rows($opa);
        $details = mysqli_fetch_assoc($opa);
        $title = $details['title'];
        $cart_id = $details['id'];
      }
  // end : what i have added after the project disccusion
  
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // CODE ......
    $name   = Clean($_POST['name']);
    $credit = Clean($_POST['credit']);


    # Validation ......
    $errors = [];

    # Validate name
    if (!validate($name, 1)) {
        $errors['name'] = 'Field Required';
    }

    # Validate Name
    if (!validate($credit, 1)) {
        $errors['credit'] = 'Field Required';
    } elseif (!validate($credit, 14)) {
        $errors['credit'] = 'Invalid String';
    }




    if (count($errors) > 0) {
        $_SESSION['Message'] = $errors;
      } else {
        // db ..........
        $sql  = "insert into orders (name,account,credit,full_price,status,user_id,cart_id) values ('$name','$user_name','$credit',$price,'pending',$user_id,$cart_id)";

        $op = mysqli_query($con, $sql);

        $sqld = "insert into details (count ,titles,client) values ($count,'$title','$user_name')";
        $opd = mysqli_query($con,$sqld);
        
        if ($op) {
            $message = 'Raw Inserted';



            $sql = "delete from cart where user_id = $user_id"; 
            $op = mysqli_query($con , $sql);



            header("Location: ".url("Admin/cart/index.php"));
        } else {
            $message = 'Error Try Again'.mysqli_error($con);
        
        }
        $_SESSION['Message'] = ['message' => $message];
    }
  }

  

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
                            } 
                          ?>


      <!-- user taple  -->
      <div class="main-panel">
        <div class="content-wrapper" style="background: url(.././images/Login_bg.jpg);">
          <div class="row my-3">
            <h5>total price : <span class="badge bg-info"><?php echo $fullPrice['price'];?> $</span></h5>
          </div>
          <div class="row">

            <div class="content-wrapper full-page-wrapper d-flex align-items-center"
              style="background: url(../../images/Login_bg.jpg);">
              <div class="card col-lg-4 mx-auto">
                <div class="card-body px-5 py-5">
                  <h3 class="card-title text-left mb-3">purchase</h3>
                  <form action="<?php $_SERVER['PHP_SELF'];?>" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                      <label> enter your credit card number * <i class="mdi mdi-credit-card"></i></label>
                      <input type="number" name="credit" min="14" class="form-control p_input">
                    </div>
                    <div class="form-group">
                      <label>name on credit card</label>
                      <input type="text" name="name" class="form-control p_input">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block enter-btn my-2">Get my book <i
                        class="mdi mdi-credit-card"></i></button>
                  </form>
                </div>
              </div>
            </div>





          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- content-wrapper ends -->
  <!-- partial:partials/_footer.html -->
  <?php require "../books/layout/footer.php"; ?>
</body>

</html>