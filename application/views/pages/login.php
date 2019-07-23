<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Car Fix Management :: Login</title>

  <!-- Custom fonts for this template-->
  <link href="<?php echo base_url();?>public/libs/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="<?php echo base_url();?>public/css/sb-admin.css" rel="stylesheet">
  <!-- Bootstrap core JavaScript-->
  <script src="<?php echo base_url();?>public/libs/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url();?>public/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="<?php echo base_url();?>public/libs/jquery-easing/jquery.easing.min.js"></script>
  <!-- Loadder   -->
  <link href="<?php echo base_url();?>public/libs/mdk-loader/mdk-loader.css" rel="stylesheet">
  <script src="<?php echo base_url();?>public/libs/mdk-loader/mdk-loader.js"></script>
  <!-- SweetAlert2 -->
  <link href="<?php echo base_url();?>public/libs/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">
  <script src="<?php echo base_url();?>public/libs/sweetalert2/dist/sweetalert2.min.js"></script>
</head>

<body class="bg-dark">

  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">เข้าสู่ระบบ</div>
      <div class="card-body">
        <form id="loginFrm" action="<?php echo base_url('api/login')?>" method="post">
          <div class="form-group">
            <div class="form-label-group">
              <input type="text" name="us" id="inputUsername" class="form-control" placeholder="Username" required="required" autofocus="autofocus">
              <label for="inputUsername">Username</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="password" name="ps" id="inputPassword" class="form-control" placeholder="Password" required="required">
              <label for="inputPassword">Password</label>
            </div>
          </div>
          <button class="btn btn-primary btn-block" type="submit">Login</button>
        </form>
      </div>
    </div>
  </div>

<script type="text/javascript">
$("#loginFrm").submit(function(e) {
    e.preventDefault(); // avoid to execute the actual submit of the form.

    var form = $(this);
    var url = form.attr('action');
    $.ajax({
        type: "POST",
        url: url,
        data: form.serialize(), // serializes the form's elements.
        dataType:'json',
        success: function(res)
        {
            console.log(res);
            if(res.code == 0){
                window.location.href="<?php echo base_url('dashboard')?>";
            }else{
                swal({
                    type: 'error',
                    title: 'ผิดพลาด !!!',
                    text: res.msg,
                });
            }
        },
        error:function(e){
            console.log(e);
        }
    });
});
</script>
</body>
</html>
