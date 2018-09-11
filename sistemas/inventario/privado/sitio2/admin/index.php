<?php
ini_set("display_errors", 0);
error_reporting(E_ALL);
session_start();
$texto = "ADMINISTRACION";
$jQueryTheme = array(1 => "black-tie", 2 => "blitzer", 3 => "cupertino", 4 => "dark-hive", 5 => "dot-luv", 6 => "eggplant", 7 => "excite-bike", 8 => "flick", 9 => "hot-sneaks", 10 => "humanity", 11 => "le-frog", 12 => "mint-choc", 13 => "overcast", 14 => "pepper-grinder", 15 => "redmond", 16 => "smoothness", 17 => "south-street", 18 => "start", 19 => "sunny", 20 => "swank-purse", 21 => "trontastic", 22 => "ui-darkness", 23 => "ui-lightness", 24 => "vader");
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
  <script src="../librerias/jquery-ui-1.11.4.custom/jquery-ui.min.js"></script>

  <link rel="stylesheet" href="../librerias/jquery-ui-1.11.4.custom/themes/<?php echo $jQueryTheme[2] ?>/jquery-ui.min.css">
  <link rel="stylesheet" type="text/css" href="../librerias/jquery-ui-1.11.4.custom/themes/<?php echo $jQueryTheme[2] ?>/theme.css">

  <!--[if lt IE 9]>
  <script src="../assets/js/ie8-responsive-file-warning.js"></script>
  <![endif]-->

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<?php if (isset($_SESSION["admin"]) AND $_SESSION["admin"]["Conectado"]): ?>
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
                <h2><?php echo $_SESSION["admin"]["admin_user"] ?></h2>
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
  <?php else: ?>
    <?php include("login.php") ?>
  <?php endif; ?>

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
