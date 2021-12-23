<!-- partial:partials/_sidebar.html -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
    <a class="sidebar-brand brand-logo" href="index.php"><span>Bookshelf</span></a>
    <a class="sidebar-brand brand-logo-mini" href="index.php"><span>B</span></a>
  </div>
  <ul class="nav">
    <li class="nav-item profile">
      <div class="profile-desc">
        <div class="profile-pic">
          <div class="count-indicator">
            <img class="img-xs rounded-circle " src="../users/image/<?php echo $_SESSION['user']['image']; ?>" alt="">
            <span class="count bg-success"></span>
          </div>
          <div class="profile-name">
            <h5 class="mb-0 font-weight-normal"><?php echo $_SESSION['user']['name'];?></h5>
            <span><?php echo $_SESSION['user']['role'];?></span>
          </div>
        </div>
        <a href="#" id="profile-dropdown" data-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></a>
        <div class="dropdown-menu dropdown-menu-right sidebar-dropdown preview-list" aria-labelledby="profile-dropdown">
          <a href="#" class="dropdown-item preview-item">
            <div class="preview-thumbnail">
              <div class="preview-icon bg-dark rounded-circle">
                <i class="mdi mdi-settings text-primary"></i>
              </div>
            </div>
            <div class="preview-item-content">
              <p class="preview-subject ellipsis mb-1 text-small">Account settings</p>
            </div>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item preview-item">
            <div class="preview-thumbnail">
              <div class="preview-icon bg-dark rounded-circle">
                <i class="mdi mdi-onepassword  text-info"></i>
              </div>
            </div>
            <div class="preview-item-content">
              <p class="preview-subject ellipsis mb-1 text-small">Change Password</p>
            </div>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item preview-item">
            <div class="preview-thumbnail">
              <div class="preview-icon bg-dark rounded-circle">
                <i class="mdi mdi-calendar-today text-success"></i>
              </div>
            </div>
            <div class="preview-item-content">
              <p class="preview-subject ellipsis mb-1 text-small">To-do list</p>
            </div>
          </a>
        </div>
      </div>
    </li>
    <li class="nav-item nav-category">
      <span class="nav-link">Navigation</span>
    </li>


    <?php if($_SESSION['user']['role_id'] == 3){ ?>
    <li class="nav-item menu-items">
      <a class="nav-link" href="<?php echo "http://".$_SERVER['HTTP_HOST']."/nti-php/bookshelf/Admin/index.php" ?>">
        <span class="menu-icon">
          <i class="mdi mdi-speedometer"></i>
        </span>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
    <?php } ?>
    <li class="nav-item menu-items my-2">
      <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
        <span class="menu-icon">
          <i class="mdi mdi-laptop"></i>
        </span>
        <span class="menu-title">Books</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="ui-basic">
        <ul class="nav flex-column sub-menu">
          <?php if($_SESSION['user']['role_id'] != 1){ ?>
          <li class="nav-item my-1"> <a class="nav-link"
              href="<?php echo "http://".$_SERVER['HTTP_HOST']."/nti-php/bookshelf/Admin/books/mybooks.php" ?>">Mybooks</a>
          </li>
          <li class="nav-item my-1"> <a class="nav-link"
              href="<?php echo "http://".$_SERVER['HTTP_HOST']."/nti-php/bookshelf/Admin/books/create.php" ?>">Create</a>
          </li>
          <?php } ?>
          <li class="nav-item my-1"> <a class="nav-link"
              href="<?php echo "http://".$_SERVER['HTTP_HOST']."/nti-php/bookshelf/Admin/books/index.php" ?>">View</a>
          </li>

        </ul>
      </div>
    </li>


    <li class="nav-item menu-items">
      <a class="nav-link"
        href="<?php echo "http://".$_SERVER['HTTP_HOST']."/nti-php/bookshelf/Admin/cart/index.php" ?>">
        <span class="menu-icon">
          <i class="mdi mdi-cart"></i>
        </span>
        <span class="menu-title">cart</span>
      </a>
    </li>

    <?php if($_SESSION['user']['role_id'] == 3){ ?>

    <li class="nav-item menu-items my-2">
      <a class="nav-link"
        href="<?php echo "http://".$_SERVER['HTTP_HOST']."/nti-php/bookshelf/Admin/order/index.php" ?>">
        <span class="menu-icon">
          <i class="mdi mdi-chart-bar"></i>
        </span>
        <span class="menu-title">orders</span>
      </a>
    </li>

    <li class="nav-item menu-items my-2">
      <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
        <span class="menu-icon">
          <i class="mdi mdi-security"></i>
        </span>
        <span class="menu-title">User Pages</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="auth">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href=<?php echo url("Admin/pages/blank-page.php");?>> Blank Page
            </a></li>
          <li class="nav-item"> <a class="nav-link" href=<?php echo url("pages/error-400.php")?>> 404 </a></li>
          <li class="nav-item"> <a class="nav-link" href=<?php echo url("pages/error-500.php")?>> 500 </a></li>
          <li class="nav-item"> <a class="nav-link" href=<?php echo url("pages/login.php")?>> Login </a></li>
          <li class="nav-item"> <a class="nav-link" href=<?php echo url("pages/register.php")?>> Register </a></li>
        </ul>
      </div>
    </li>
    <?php } ?>
  </ul>
</nav>