<?php 
  require "../helpers/dbConnection.php";
  require "../helpers/functions.php";
  require "../helpers/checkLogin.php";
  require "../helpers/checkAdmin.php";
  
  $sql = "select * from orders order by orders.id desc";
  $op = mysqli_query($con , $sql);


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
        <div class="content-wrapper">

          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">transaction status</h4>
                  <p class="card-description">

                  </p>
                  <div class="table-responsive">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>id</th>
                          <th>card name</th>
                          <th>Account name</th>
                          <th>credit number</th>
                          <th>order price</th>
                          <th>approve</th>
                          <th>order details</th>
                          <th>status</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php while ($data = mysqli_fetch_assoc($op)){ ?>
                        <tr>
                          <td><?php echo $data['id']; ?></td>
                          <td><?php echo $data['name']; ?></td>
                          <td><?php echo $data['account']; ?></td>
                          <td class="text-danger">
                            <?php echo $data['credit']; ?>
                            <i class="mdi mdi-credit-card"></i>
                          </td>
                          <td><?php echo $data['full_price']; ?></td>
                          <td>
                            <a class='btn btn-success' href="./accept.php?id=<?php echo $data['id']; ?>"> approve <i
                                class="mdi mdi-approve"></i></a>
                          </td>
                          <td>
                            <a class='btn btn-primary' href="./orderdetails.php?id=<?php echo $data['account'];?>">
                              details
                              <i class="mdi mdi-details"></i></a>
                          </td>
                          <td>
                            <?php if($data['status'] === 'pending'){ 
                              echo "<label class='badge badge-info'>Pending</label>";
                              }elseif($data['status']=== 'done'){
                                echo "<label class='badge badge-success'>Completed</label>";
                              }else{
                                echo "<label class='badge badge-success'>Completed</label>";
                              }
                              ?>
                          </td>
                          <td>
                            <a class='btn btn-danger' href="./cancel.php?id=<?php echo $data['id']; ?>">cancel <i
                                class="mdi mdi-cancel"></i></a>
                          </td>
                        </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>
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