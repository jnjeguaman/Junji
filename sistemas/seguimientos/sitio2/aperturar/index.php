<?php
session_start();
$texto = "ADMINISTRACION";
?>
<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ADMINISTRACION JUNJI <?php echo Date("Y") ?></title>

  <link href="css/bootstrap.min.css" rel="stylesheet">

  <link href="fonts/css/font-awesome.min.css" rel="stylesheet">
  <link href="css/animate.min.css" rel="stylesheet">

  <!-- Custom styling plus plugins -->
  <link href="css/custom.css" rel="stylesheet">
  <link href="css/icheck/flat/green.css" rel="stylesheet">
  <link href="js/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />

  <script src="js/jquery.min.js"></script>
  <script src="js/datatables/jquery.dataTables.min.js"></script>


  <!--[if lt IE 9]>
  <script src="../assets/js/ie8-responsive-file-warning.js"></script>
  <![endif]-->

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
    <body class="nav-md">
      <div class="container body">
        <div class="main_container">
          <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
              <!-- otro !-->
              <div class="navbar nav_title" style="border: 0;">
                <a href="./" class="site_title"><i class="fa fa-paw"></i> <span>JUNJI</span></a>
              </div>
              <!-- fin otro !-->
              <div class="clearfix"></div>
              <!-- menu prile quick info -->
              <div class="profile">
                <div class="profile_pic">
                  <img src="images/img.jpg" alt="..." class="img-circle profile_img">
                </div>
                <div class="profile_info">
                  <span>Bienvenido,</span>
                  <h2><?php echo $_SESSION["nombrecom"] ?></h2>
                </div>
              </div>
              <!-- /menu prile quick info -->
              <br />
              <?php include("menu.php") ?>
            </div>
          </div>
          <?php include("top.php") ?>
          <?php include("default.php") ?>
        </div>
      </div>

  <script src="js/bootstrap.min.js"></script>
  <script src="js/custom.js"></script>
  <script src="js/progressbar/bootstrap-progressbar.min.js"></script>
  <script src="js/pace/pace.min.js"></script>
  <script type="text/javascript" src="js/parsley/parsley.min.js"></script>
  <script type="text/javascript">
    $(function(){
      $("table").dataTable();
      $('#demo-form .btn').on('click', function() {
        $('#demo-form').parsley().validate();
        validateFront();
      });
    })
  </script>
</body>

</html>
