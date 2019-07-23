<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>K&C CAR CARE :: <?php echo isset($title)?$title:'ระบบจัดการลูกค้า'; ?></title>

  <!-- Bootstrap core JavaScript-->
  <script src="<?php echo base_url();?>public/libs/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url();?>public/libs/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Custom fonts for this template-->
  <link href="<?php echo base_url();?>public/libs/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="<?php echo base_url();?>public/libs/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
   <script src="<?php echo base_url();?>public/libs/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url();?>public/libs/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Custom styles for this template-->
  <link href="<?php echo base_url();?>public/css/sb-admin.css" rel="stylesheet">

  <!-- Core plugin JavaScript-->
  <script src="<?php echo base_url();?>public/libs/jquery-easing/jquery.easing.min.js"></script>

  <!-- SweetAlert -->
  <link href="<?php echo base_url();?>public/libs/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet" type="text/css">
  <script src="<?php echo base_url();?>public/libs/sweetalert2/dist/sweetalert2.min.js"></script>
  <!-- mdk Loader -->
  <link href="<?php echo base_url();?>public/libs/mdk-loader/mdk-loader.min.css" rel="stylesheet" type="text/css">
  <script src="<?php echo base_url();?>public/libs/mdk-loader/mdk-loader.min.js"></script>

</head>

<body id="page-top">

  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1 text-success" href="">K&C CAR CARE </a>
    <!-- Navbar -->

    <ul class="navbar-nav ml-auto mr-0 mr-md-3 my-2 my-md-0">
      <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-user-circle fa-fw"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
          <a class="dropdown-item" href="#">ตั่งค่า</a>
          <a class="dropdown-item" href="#">บันทึกกิจกรรม</a>
          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#updateModal">อัพเดทระบบ</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">ออกจากระบบ</a>
        </div>
      </li>
    </ul>

  </nav>

  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="sidebar navbar-nav d-none d-sm-block ">
      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('dashboard')?>">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>หน้าแรก</span>
        </a>
      </li>
      <!-- <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-fw fa-folder"></i>
          <span>Pages</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
          <h6 class="dropdown-header">Login Screens:</h6>
          <a class="dropdown-item" href="">Login</a>
          <a class="dropdown-item" href="">Register</a>
        </div>
      </li> -->
      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('job/add')?>">
          <i class="fas fa-fw fa-car"></i>
          <span>รับรถเข้าซ่อม</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('employees')?>">
          <i class="fas fa-fw fa-user"></i>
          <span>จัดการพนักงาน</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('works')?>">
          <i class="fas fa-tools"></i>
          <span>จัดการข้อมูลงาน</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('cars')?>">
          <i class="fas fa-car"></i>
          <span>จัดการข้อมูลรถ</span></a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-fw fa-folder"></i>
          <span>รายงาน</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
          <a class="dropdown-item" href="">รายงานรถซ่อม</a>
          <a class="dropdown-item" href="">รายงาน</a>
        </div>
      </li>
    </ul>

        <div id="content-wrapper">

          <div class="container-fluid">
