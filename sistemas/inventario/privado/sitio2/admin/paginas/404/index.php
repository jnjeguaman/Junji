<?php
//Estadisticas varias
$totalUsuarios = "SELECT count(num) as Total FROM usuarios";
$totalUsuarios = mysql_query($totalUsuarios,$dbh2);
$totalUsuarios = mysql_fetch_array($totalUsuarios);
?>
  <!-- page content -->
  <div class="right_col" role="main">

    <!-- top tiles -->
    <div class="row tile_count">
      <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
        <div class="left"></div>
        <div class="right">
          <span class="count_top"><i class="fa fa-user"></i> Total Users</span>
          <div class="count"><?php echo $totalUsuarios["Total"] ?></div>
          <span class="count_bottom"><i class="green">4% </i> From last Week</span>
        </div>
      </div>
    </div>
    <!-- /top tiles -->


    <div class="">
      <div class="page-title">
        <div class="title_left">
          <h3>Plain Page</h3>
        </div>

        <div class="title_right">
          <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Search for...">
              <span class="input-group-btn">
                <button class="btn btn-default" type="button">Go!</button>
              </span>
            </div>
          </div>
        </div>
      </div>
      <div class="clearfix"></div>

      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel" style="height:600px;">
            <div class="x_title">
              <h2>Plain Page</h2>
              <div class="clearfix"></div>
            </div>
            <!-- CONTENIDO DE LAS PAGINAS !-->
            404 NOT FOUND
            <!-- CONTENIDO DE LAS PAGINAS !-->
          </div>
        </div>
      </div>
    </div>
  </div>
