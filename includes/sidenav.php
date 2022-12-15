<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo BASE_URL.'dashboard.php' ?>" class="brand-link">
      <img src="<?php echo BASE_URL.'dist/img/AdminLTELogo.png' ?>" alt="Hijama Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Techroll</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo BASE_URL.'dist/img/user2-160x160.jpg' ?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <?php
            $conn = new Database();
            $db = $conn -> connection();
            $users = new Registration($db);
            $users -> Email = $_SESSION['adminuser'];
            $login = $users -> getUserProfile();
            if($login){
          ?>
            <a href="#" class="d-block"><?php echo $login['Fname'] ?></a>
          <?php
            }
          ?>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="<?php echo BASE_URL.'dashboard.php' ?>" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
          </li>
          <li class="nav-item <?php if($_SESSION['active'] == 'admins'){ echo 'menu-open'; } ?>">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user-check"></i>
              <p>
                Admins
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo BASE_URL.'admins/create-admins.php' ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Admins</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo BASE_URL.'admins/manage-admins.php' ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Admins</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item <?php if($_SESSION['active'] == 'comments'){ echo 'menu-open'; } ?>">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-comment"></i>
              <p>
                Comments
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo BASE_URL.'comments/manage-comments.php' ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage comments</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item <?php if($_SESSION['active'] == 'messages'){ echo 'menu-open'; } ?>">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-comment"></i>
              <p>
                Messages
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo BASE_URL.'messages/manage.messages.php' ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage messages</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item <?php if($_SESSION['active'] == 'blogs'){ echo 'menu-open'; } ?>">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-blog"></i>
              <p>
                Blogs
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo BASE_URL.'blogs/create-blogs.php' ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Products</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo BASE_URL.'blogs/list-blogs.php' ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Products</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="<?php echo BASE_URL.'logout.php' ?>" class="nav-link">
              <i class="nav-icon fa-solid fa-right-from-bracket"></i>
              <p>
                Logout
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>