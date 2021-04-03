<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Dynamic Form</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?= base_url("assets/dashtemp") ?>/plugins/timepicker/bootstrap-timepicker.min.css"> <!-- EDITED -->
  <link rel="stylesheet" href="<?= base_url("assets/dashtemp") ?>/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= base_url("assets/dashtemp") ?>/plugins/select2/select2.min.css">
  <link rel="stylesheet" href="<?= base_url("assets/dashtemp") ?>/plugins/custom/font-awesome.min.css">
  <link rel="stylesheet" href="<?= base_url("assets/dashtemp") ?>/plugins/custom/ionicons.min.css">
  <link rel="stylesheet" href="<?= base_url("assets/dashtemp") ?>/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="<?= base_url("assets/dashtemp") ?>/plugins/datatables/dataTables.bootstrap.css">
  <link rel="stylesheet" href="<?= base_url("assets/dashtemp") ?>/dist/css/custom.css">
  <link rel="stylesheet" href="<?= base_url("assets/dashtemp") ?>/dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="<?= base_url("assets/dashtemp") ?>/plugins/datatables/extensions/Button/buttons.dataTables.min.css">
  <script src="<?= base_url("assets/dashtemp") ?>/plugins/jQuery/jquery-2.2.3.min.js"></script>  
  <script type="text/javascript" src="<?=base_url('assets/dashtemp')?>/chart/highcharts.js"></script>
  <script type="text/javascript" src="<?=base_url('assets/dashtemp')?>/chart/exporting.js"></script>
  <script type="text/javascript" src="<?=base_url('assets/dashtemp')?>/chart/highcharts-more.js"></script>
  <script type="text/javascript" src="<?=base_url('assets/dashtemp')?>/chart/solid-gauge.js"></script>
  
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition skin-blue fixed sidebar-mini">
<div class="wrapper">  
  
  <?php
    echo $_header;
    echo $_menu;
    echo $_content;
  ?>
  
</div>

<script src="<?= base_url("assets/dashtemp") ?>/bootstrap/js/bootstrap.min.js"></script>
<script src="<?= base_url("assets/dashtemp") ?>/plugins/select2/select2.full.min.js"></script>
<script src="<?= base_url("assets/dashtemp") ?>/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url("assets/dashtemp") ?>/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="<?= base_url("assets/dashtemp") ?>/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<script src="<?= base_url("assets/dashtemp") ?>/plugins/fastclick/fastclick.js"></script>
<script src="<?= base_url("assets/dashtemp") ?>/plugins/timepicker/bootstrap-timepicker.min.js"></script> <!-- EDITED -->
<script src="<?= base_url("assets/dashtemp") ?>/dist/js/app.min.js"></script>
<script src="<?= base_url("assets/dashtemp") ?>/dist/js/demo.js"></script>
<script src="<?= base_url("assets/dashtemp") ?>/dist/js/bootbox.min.js"></script>
<script src="<?= base_url("assets/dashtemp") ?>/dist/js/custom.js"></script>
<script type="text/javascript" src="<?= base_url("assets/dashtemp") ?>/plugins/datatables/extensions/Button/dataTables.buttons.js"></script>
<script type="text/javascript" src="<?= base_url("assets/dashtemp") ?>/plugins/datatables/extensions/Button/buttons.flash.js"></script>
<script type="text/javascript" src="<?= base_url("assets/dashtemp") ?>/plugins/datatables/extensions/Button/jszip.js"></script>
<script type="text/javascript" src="<?= base_url("assets/dashtemp") ?>/plugins/datatables/extensions/Button/pdfmake.js"></script>
<script type="text/javascript" src="<?= base_url("assets/dashtemp") ?>/plugins/datatables/extensions/Button/vfs_fonts.js"></script>
<script type="text/javascript" src="<?= base_url("assets/dashtemp") ?>/plugins/datatables/extensions/Button/buttons.html5.js"></script>
<script type="text/javascript" src="<?= base_url("assets/dashtemp") ?>/plugins/datatables/extensions/Button/buttons.print.js"></script>
<script type="text/javascript">
  $(function () {
    $(".select2").select2();
  });
  
  /* EDITED */
  $('.timepicker').timepicker({
      showInputs: false
    });
  /* END EDITED */
</script>
</body>
</html>
