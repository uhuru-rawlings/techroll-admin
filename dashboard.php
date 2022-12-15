<?php
  include_once("config.php");
  include_once("database/Database.php");
  include_once("models/Registration.php");
  include_once("models/Blogs.php");
  include_once("models/Messages.php");
  if(!isset($_SESSION['adminuser'])){
    header("Location: index.php");
  }
  $_SESSION['active'] = "home";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Hijama | Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="assets/css/all.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- IonIcons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/custom.css">
</head>
<!--
`body` tag options:

  Apply one or more of the following classes to to the body tag
  to get the desired effect

  * sidebar-collapse
  * sidebar-mini
-->
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <?php
    include_once("includes/topnav.php");
  ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php
    include_once("includes/sidenav.php");
  ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Home</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="card">
          <div class="card-header">Admins</div>
          <div class="card-body">
              <table class="table">
                  <thead>
                      <tr>
                          <th>Full Name</th>
                          <th>Email</th>
                          <th>Phone</th>
                          <th>Status</th>
                          <th>Last Login</th>
                          <th>Action</th>
                      </tr>
                  </thead>
                  <tbody>
                      <?php
                          $conn = new Database();
                          $db = $conn -> connection();
                          $users = new Registration($db);
                          $user = $users -> getUsers();
                          if($user){
                              foreach($user as $user){
                      ?>
                      <tr>
                          <td><?php echo $user['Fname']." ".$user['Lname'] ?></td>
                          <td><?php echo $user['Email']?></td>
                          <td><?php echo $user['Phone']?></td>
                          <td><?php echo $user['status']?></td>
                          <td><?php echo $user['last_login']?></td>
                          <td>
                            <a href="update-admins.php?edit=<?php echo $user['id']?>" class="text-success">Edit</a>
                            <br>
                            <a href="manage-admins-func.php?delete=<?php echo $user['id']?>" class="text-danger">Delete</a>
                          </td>
                      </tr>
                      <?php
                              }
                          }
                      ?>
                  </tbody>
              </table>
          </div>
        </div>
        <div class="card mt-4">
          <div class="card-header">Latest Blogs</div>
          <div class="card-body">
              <div class="row">
                  <?php
                      $conn = new Database();
                      $db   = $conn -> connection();
                      $blogs = new Blogs($db);
                      $results = $blogs -> latestBlogs();
                      if($results){
                          foreach($results as $results){
                  ?>
                          <div class="col-sm-6 p-4 bg-soft-primary blogs_texts">
                              <div class="card">
                                  <div class="card-header">
                                      <h3><?php echo $results['Blog_Tittle']; ?></h3>
                                  </div>
                                  <div class="card-body">
                                      <p><?php echo $results['Blogs_Body']; ?></p>
                                  </div>
                                  <div class="card-footer">
                                      <div class="row d-flex">
                                          <a href=""><button class="btn btn-primary">Preview</button></a>
                                          <a href="blogs/manage-blogs.php?edit=<?php echo $results['id']; ?>"><button class="btn btn-info">Edit</button></a>
                                          <a href="blogs/delete-blogs.fun.php?delete=<?php echo $results['id']; ?>"><button class="btn btn-danger">Delete</button></a>
                                      </div>
                                  </div>
                              </div>
                          </div>
                  <?php
                          }
                      }
                  ?>
              </div>
          </div>
        </div>
        <div class="card mt-4">
          <div class="card-header">Latest Messages</div>
          <div class="card-body">
              <div class="row">
                  <?php
                      $conn = new Database();
                      $db   = $conn -> connection();
                      $messages = new Messages($db);
                      $results = $messages -> latestMessages();
                      if($results){
                          foreach($results as $results){
                  ?>
                          <div class="col-sm-6 p-4 bg-soft-primary blogs_texts" id="messages">
                              <div class="card">
                                  <div class="card-header">
                                      <h3><?php echo $results['Subject']; ?></h3>
                                  </div>
                                  <div class="card-body">
                                      <div>
                                          <span>Name: <?php echo $results['Name']; ?></span>
                                              <br>
                                          <span>
                                              Email: <a href="mailto:<?php echo $results['Email']; ?>"><?php echo $results['Email']; ?></a>
                                          </span>
                                              <br>
                                          <span>
                                              Phone: <a href="tel:<?php echo $results['phone']; ?>"><?php echo $results['phone']; ?></a>
                                          </span>
                                              <br>
                                          <span>
                                              Date: <?php echo $results['date_added']; ?>
                                          </span>
                                      </div>
                                      <p><?php echo $results['message_content']; ?></p>
                                  </div>
                                  <div class="card-footer">
                                      <div class="row d-flex">
                                          <a href="mark-read-fun.php?message=<?php echo $results['id']; ?>"><button class="btn btn-primary">Mark Read</button></a>
                                      </div>
                                  </div>
                              </div>
                          </div>
                  <?php
                          }
                      }
                  ?>
              </div>
          </div>
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <?php
    include_once("includes/footer.php");
  ?>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="assets/js/tables.js"></script>
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE -->
<script src="dist/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard3.js"></script>
<script src="assets/js/all.min.js"></script>
</body>
</html>
