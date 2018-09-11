<?php
//Estadisticas
$categorias = "SELECT COUNT(DISTINCT(acti_subzona_glosa)) as Nombres FROM acti_subzona";
$categorias = mysql_query($categorias);
$categorias = mysql_fetch_array($categorias);
$categorias = $categorias["Nombres"];
?>
  <!-- page content -->
  <div class="right_col" role="main">

    <div class="row top_tiles">

      <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="tile-stats">
          <div class="icon"><i class="fa fa-caret-square-o-right"></i>
          </div>
          <div class="count"><a href="?page=subzonas&action=crear">CREAR</a></div>

          <h3>New Sign ups</h3>
          <p>Lorem ipsum psdea itgum rixt.</p>
        </div>
      </div>


      <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="tile-stats">
          <div class="icon"><i class="fa fa-caret-square-o-right"></i>
          </div>
          <div class="count"><a href="?page=subzonas&action=editar">EDITAR</a></div>

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
          <span class="count_top"><i class="fa fa-user"></i> Sub-categorias creadas</span>
          <div class="count"><?php echo $categorias ?></div>
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
