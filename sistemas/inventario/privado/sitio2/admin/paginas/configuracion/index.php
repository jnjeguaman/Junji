<?php
if($_POST["cmd"] == "Actualizar")
{
  $update = "UPDATE inedis_config SET inedis_estado = '".$_POST["inedis_mantenimiento"]."' WHERE inedis_id = 1";
  mysql_query($update,$dbh2);
}

$sql = "SELECT * FROM inedis_config";
$rs = mysql_query($sql,$dbh2);
$row = mysql_fetch_array($rs);


?>
<!-- page content -->
  <div class="right_col" role="main">

    <!-- page content -->

    <div class="">
      <div class="page-title">
        <div class="title_left">
          <h3>CONFIGURACION</h3>
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
              <h2>CONFIGURACION DEL SISTEMA</h2>
              <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="#">Settings 1</a>
                    </li>
                    <li><a href="#">Settings 2</a>
                    </li>
                  </ul>
                </li>
                <li><a class="close-link"><i class="fa fa-close"></i></a>
                </li>
              </ul>
              <div class="clearfix"></div>
            </div>
            <!-- CONTENIDO DE LAS PAGINAS !-->
            <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="POST" action="<?php echo $_SERVER["REQUEST_URI"] ?>">

            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cat_nombre">MANTENIMIENTO <span class="required">*</span></label>
              <div class="col-md-6 col-sm-6 col-xs-12">

              <input type="radio" required="required" id="inedis_mantenimiento" name="inedis_mantenimiento" <?php if($row["inedis_estado"] == 1){echo"checked";} ?> value="1">SI
              <input type="radio" required="required" id="inedis_mantenimiento" name="inedis_mantenimiento" <?php if($row["inedis_estado"] == 0){echo"checked";} ?> value="0">NO
                <!-- <input type="text" id="cat_nombre" name="cat_nombre" required="required" class="form-control col-md-7 col-xs-12"> -->
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <!--<button type="submit" class="btn btn-primary">Cancel</button>1-->
                <button type="submit" class="btn btn-success">ACTUALIZAR <i class="fa fa-refresh"></i></button>
              </div>
            </div>

            <input type="hidden" name="cmd" value="Actualizar">
          </form>
            <!-- CONTENIDO DE LAS PAGINAS !-->
          </div>
        </div>
      </div>
    </div>
  <!-- /page content -->

    
  </div>
  <!-- /page content -->