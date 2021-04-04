<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Login</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?= base_url("assets/dashtemp") ?>/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= base_url("assets/dashtemp") ?>/plugins/custom/font-awesome.min.css">
  <link rel="stylesheet" href="<?= base_url("assets/dashtemp") ?>/plugins/custom/ionicons.min.css">
  <link rel="stylesheet" href="<?= base_url("assets/dashtemp") ?>/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="<?= base_url("assets/dashtemp") ?>/dist/css/custom.css">
  <link rel="stylesheet" href="<?= base_url("assets/dashtemp") ?>/plugins/iCheck/square/blue.css">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-box-body" style="border-radius:10px">
    <div class="login-logo">
      <span class="logo-title" style="color:#444; font-size:25px; font-family:Roboto; font-weight:bold; text-transform:uppercase; letter-spacing:1px">E-HUB</span>
    </div>
    <form action="<?= site_url("login") ?>/doLogin" method="post">
      <div class="form-group has-feedback">
        <input type="text" name="txtusername" class="form-control" placeholder="Username">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="txtpassword" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
        
      <span style="font-size:12px">Prove us you are not a robot</span>
      <div class="row">
        <div class="col-xs-8">
          <input type="text" name="txtl" class="form-control" readonly="" value="<?= $question ?>">
          <input type="hidden" name="txtprovequestion" class="form-control" readonly="" value="<?= $answer ?>">
        </div>
        <div class="col-xs-4">
          <input type="text" name="txtproveanswer" class="form-control" placeholder="Result">
        </div>
      </div>

      <div class="row">
        <div class="col-xs-12">
          <div style="clear:both; height:25px"></div>
          <button type="submit" class="btn btn-success btn-block btn-flat">Sign In</button>
          <div style="clear:both; height:20px"></div>
        </div>
      </div>
    </form>

    <?php
      if(isset($_GET['msg'])) {
    ?>
        <div style="clear:both; height:40px"></div>
        <div class="alert alert-danger alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <?= $_GET['msg'] ?>
        </div>
    <?php
      }
    ?>

    </div>

      <div class="row " style="display:none">
        <div class="col-xs-12">
          <div style="clear:both; height:25px"></div>
          <span>Username: <strong>demo</strong></span>
          <div style="clear:both; height:1px"></div>
          <span>Password: <strong>112233</strong></span>
        </div>
      </div>
</div>

<script src="<?= base_url("assets/dashtemp") ?>/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="<?= base_url("assets/dashtemp") ?>/bootstrap/js/bootstrap.min.js"></script>
<script src="<?= base_url("assets/dashtemp") ?>/plugins/iCheck/icheck.min.js"></script>
</body>
</html>
