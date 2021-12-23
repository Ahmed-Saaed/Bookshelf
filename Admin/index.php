<?php 
  require "./helpers/dbConnection.php";
  require "./helpers/functions.php";
  require "./helpers/checkLogin.php";
  require "./helpers/checkAdmin.php";

  require './layout/header.php';

  $sql = "select users.* , roles.role from users inner join roles on users.role_id = roles.id";
  $op = mysqli_query($con , $sql); 
?>

<body>
  <div class="container-scroller">

    <?php require './layout/sidebar.php'; ?>

    <!-- partial:partials/_sidebar.html -->

    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_navbar.html -->
      <?php require './layout/navbar.php';?>
      <!-- partial -->

      <!-- user taple  -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">users dashboard</h4>
                  <p class="card-description">
                  </p>
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th> id </th>
                          <th> name </th>
                          <th> email </th>
                          <th> gender </th>
                          <th> role </th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php while($userData = mysqli_fetch_assoc($op)){ ?>
                        <tr>
                          <td class="py-1"><?php  echo $userData['id']; ?></td>
                          <td> <?php echo  $userData['name']; ?></td>
                          <td><?php echo  $userData['email']; ?></td>
                          <td><?php  echo $userData['gender']; ?></td>
                          <td> <?php  echo $userData['role']; ?></td>
                          <td>
                            <a href="./users/edit.php?id=<?php echo $userData['id']?>"
                              class="card-link btn  btn-primary mx-4 "><i class="mdi mdi-table-edit"></i>Edit</a>
                            <a href="./users/delete.php?id=<?php echo $userData['id']?>"
                              class="card-link btn btn-danger"><i class="mdi mdi-delete"></i>Delete
                            </a>

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