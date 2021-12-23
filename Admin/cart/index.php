<?php 
  require "../helpers/dbConnection.php";
  require "../helpers/functions.php";
  require "../helpers/checkLogin.php";
  
  $user_id = $_SESSION['user']['id'];

  $sql = "select books.* , cart.id as cart_id , cart.book_id ,cart.user_id from books inner join cart on cart.book_id = books.id where cart.user_id = $user_id";
  $op = mysqli_query($con , $sql);
  

  $sql = "select sum(books.price) as fprice , cart.id from books inner join cart on books.id = cart.book_id where cart.user_id = $user_id";
  $opc = mysqli_query($con,$sql);
  $fullPrice = mysqli_fetch_assoc($opc);


  $sqlc = "select * from cart where cart.user_id = $user_id";
  $cartOp = mysqli_query($con , $sqlc );


  

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
            <h5>total price : <span class="badge bg-info"><?php echo $fullPrice['fprice'];?> $</span></h5>
          </div>
          <div class="row p-4" style="background: url(../../images/Login_bg.jpg);">
            <?php while($data = mysqli_fetch_assoc($op)){ ?>
            <div class="col-lg-4 grid-margin stretch-card ">

              <div class="card p-3">
                <div class="card" style="width: 18rem;">
                  <!-- <div class="card-body"> -->
                  <img src="../books/uploads/<?php echo $data['image'];?>" class="card-img-top w-50 h-50 my-2"
                    alt="...">

                  <h5 class="card-title mt-1"><?php echo $data['title'];?></h5>
                  <p class="card-text md-1"><?php echo $data['description'];?></p>
                </div>
                <ul class="list-group list-group-flush bg-dark">
                  <li class="list-group-item bg-transparent">author: <?php echo $data['author'];?></li>
                  <li class="list-group-item bg-transparent">price: <?php echo $data['price'];?> $</li>
                  <li class="list-group-item bg-transparent">uploaded By: <?php echo $data['uploadedBy'];?></li>
                </ul>
                <div class="card-body">
                  <a href="delete.php?id=<?php echo $data['cart_id'];?>" class=" btn btn-block btn-danger"><i
                      class="mdi mdi-delete"></i>remove from cart</a>

                  <a href="../order/create.php?id=<?php echo $data['cart_id'];?>"
                    class=" card-link btn btn-block btn-primary">purchase</a>
                </div>
              </div>
            </div>
            <!-- </div> -->
            <?php } ?>

            <?php if (mysqli_num_rows($cartOp) > 1){ ?>
            <a href="../order/purchase.php?id=<?php echo $_SESSION['user']['name'];?>"
              class=" btn btn-block btn-md btn-primary mt-3"><i class="deletemdi mdi-delete"></i>purchase all</a>
            <a href="removeAll.php" class=" btn btn-block btn-md btn-danger "><i class="mdi mdi-delete"></i>remove
              all</a>
            <?php }?>
          </div>
        </div>
      </div>
    </div>

    <?php if(mysqli_num_rows($cartOp) == 0) { 
            $sql = "select * from orders where user_id = $user_id";
            $order_op = mysqli_query($con , $sql);
      ?>
    <div class="row ">
      <div class="row ">
        <div class="col-lg-12 grid-margin stretch-card ">
          <div class="card p-3">
            <div class="card-body ">
              <h4 class="card-title">transaction status</h4>
              <p class="card-description">

              </p>
              <div class="table-responsive">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>id</th>
                      <th>name</th>
                      <th>credit number</th>
                      <th>status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php while ($orderData = mysqli_fetch_assoc($order_op)){ ?>
                    <tr>
                      <td><?php echo $orderData['id']; ?></td>
                      <td><?php echo $orderData['name']; ?></td>
                      <td class="text-danger">
                        <?php echo $orderData['credit']; ?>
                        <i class="mdi mdi-credit-card"></i>
                      </td>
                      <td>
                        <?php if($orderData['status'] === 'pending'){ 
                              echo "<label class='badge badge-info'>Pending</label>";
                              }elseif($orderData['status']=== 'done'){
                                echo "<label class='badge badge-success'>Completed</label>";
                              }else{
                                echo "<label class='badge badge-success'>Completed</label>";
                              }
                              ?>
                      </td>
                      <td>
                        <a class='btn btn-danger' href="../order/cancel.php?id=<?php echo $orderData['id']; ?>">cancel
                          <i class="mdi mdi-cancel"></i></a>
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
      <?php } ?>
    </div>
    <!-- content-wrapper ends -->
    <!-- partial:partials/_footer.html -->
    <?php require "../books/layout/footer.php"; ?>
</body>

</html>