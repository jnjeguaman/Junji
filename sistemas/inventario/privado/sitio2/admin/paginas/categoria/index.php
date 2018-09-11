<?php
//Estadisticas
$sql = "SELECT COUNT(DISTINCT(cat_nombre)) as Total FROM acti_categoria";
$res = mysql_query($sql);
$row = mysql_fetch_array($res);
?>
  <!-- page content -->
  <div class="right_col" role="main">

    <div class="row top_tiles">

      <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="tile-stats">
          <div class="icon"><i class="fa fa-caret-square-o-right"></i>
          </div>
          <div class="count"><a href="?page=categorias&action=crear">CREAR</a></div>

          <h3>New Sign ups</h3>
          <p>Lorem ipsum psdea itgum rixt.</p>
        </div>
      </div>


      <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="tile-stats">
          <div class="icon"><i class="fa fa-caret-square-o-right"></i>
          </div>
          <div class="count"><a href="?page=categorias&action=editar">EDITAR</a></div>

          <h3>New Sign ups</h3>
          <p>Lorem ipsum psdea itgum rixt.</p>
        </div>
      </div>
    </div>

    <!-- top tiles -->
    <div class="row tile_count">
      <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
        <div class="left"></div>
        <div class="right">
          <span class="count_top"><i class="fa fa-user"></i> Categorias creadas</span>
          <div class="count"><?php echo $row["Total"] ?></div>
          <span class="count_bottom"><i class="green">4% </i> From last Week</span>
        </div>
      </div>
    </div>
    <!-- /top tiles -->

    <?php if (isset($_REQUEST["action"])): ?>
      <?php include($_REQUEST["action"].".php") ?>
    <?php endif ?>
  </div>
  <!-- /page content -->
