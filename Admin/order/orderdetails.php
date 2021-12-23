<?php 

//added after discussion

  require "../helpers/dbConnection.php";
  require "../helpers/functions.php";
  require "../helpers/checkLogin.php";
  require "../helpers/checkAdmin.php";

$id = $_GET['id'];

$sql = "select * from details where client = '$id'";
$op = mysqli_query($con,$sql);

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
                  <h4 class="card-title">order details</h4>
                  <p class="card-description">

                  </p>
                  <div class="table-responsive">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>id</th>
                          <th>title</th>
                          <th>count</th>
                          <th>client</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php while ($data = mysqli_fetch_assoc($op)){ ?>
                        <tr>
                          <td><?php echo $data['id']; ?></td>
                          <td><?php echo $data['count']; ?></td>
                          <td><?php echo $data['titles']; ?></td>
                          <td><?php echo $data['client']; ?></td>
                          <td>
                            <a class='btn btn-primary' href="./index.php?id=<?php echo $data['id']; ?>">ok <i
                                class="mdi mdi-ok"></i></a>
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