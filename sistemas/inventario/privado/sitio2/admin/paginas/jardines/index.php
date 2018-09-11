  <?php 
  // ESTADISTICA
  $array = array();
  $sql = "SELECT COUNT(jardin_id) as Total, jardin_region as Region FROM jardines GROUP BY jardin_region";
  $res = mysql_query($sql);
  while($row = mysql_fetch_array($res))
  {
    $array[] = $row;
  }

  ?>
  <!-- page content -->
  <div class="right_col" role="main">

      <div class="row tile_count">
      <?php foreach ($array as $key => $value): ?>
        <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
        <div class="left"></div>
        <div class="right">
          <span class="count_top"><i class="fa fa-user"></i> Jardines creadas</span>
          <div class="count"><?php echo $value["Total"] ?></div>
          <span class="count_bottom"><i class="green"><?php echo $value["Region"] ?></i> Region</span>
        </div>
      </div>
      <?php endforeach ?>
      </div>

      <div class="row top_tiles">

      <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="tile-stats">
          <div class="icon"><i class="fa fa-plus"></i>
          </div>
          <div class="count"><a href="?page=jardines&action=crear">CREAR</a></div>

          <h3>New Sign ups</h3>
          <p>Lorem ipsum psdea itgum rixt.</p>
        </div>
      </div>


      <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="tile-stats">
          <div class="icon"><i class="fa fa-pencil-square-o"></i>
          </div>
          <div class="count"><a href="?page=jardines&action=editar">EDITAR</a></div>

          <h3>New Sign ups</h3>
          <p>Lorem ipsum psdea itgum rixt.</p>
        </div>
      </div>
    </div>
  
  <?php if (isset($_REQUEST["action"])): ?>
      <?php include($_REQUEST["action"].".php") ?>
    <?php endif ?>
    
  </div>
  <!-- /page content -->
