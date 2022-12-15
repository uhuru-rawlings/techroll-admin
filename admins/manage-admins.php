<?php
  include_once("../config.php");
  include_once("../models/Registration.php");
  include_once("../database/Database.php");
  if(!isset($_SESSION['adminuser'])){
    header("Location: ../index.php");
  }
  $_SESSION['active'] = 'admins';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Techroll Blogs | Manage Admins</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="../assets/css/all.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- IonIcons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <link rel="stylesheet" href="../assets/css/style.css">
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
    include_once("../includes/topnav.php");
  ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php
    include_once("../includes/sidenav.php");
  ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Manage Admins</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo BASE_URL.'dashboard.php' ?>">Home</a></li>
              <li class="breadcrumb-item active">Manage Admins</li>
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
            <div class="card-header">Manage Admin</div>
            <div class="card-body">
              <?php
                  if(isset($_GET['success'])){
                      echo "<div class='alert alert-success'>{$_GET['success']}</div>";
                  }else if(isset($_GET['error'])){
                      echo "<div class='alert alert-danger'>{$_GET['error']}</div>";
                  }
              ?>
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
    include_once("../includes/footer.php");
  ?>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="../assets/js/all.min.js"></script>
<script src="../assets/js/tables.js"></script>
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE -->
<script src="../dist/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="../plugins/chart.js/Chart.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../dist/js/pages/dashboard3.js"></script>
</body>
</html>
