    <?php
  // TOP 10 ACCIONES
  $top10 = array();
  $sql = "SELECT COUNT(log_id) AS Total,log_usr,log_tipo FROM log WHERE log_origen = \"INVENTARIO\" GROUP BY log_usr,log_tipo ORDER BY COUNT(log_id) DESC LIMIT 10";
  $res = mysql_query($sql,$dbh);
  while ($row = mysql_fetch_array($res))
  {
  	$top10[] =  $row;
  }

  // TOTAL DE GUIAS CREADAS / ANULADAS
  $totalGuias ="SELECT COUNT(guia_id) AS Total FROM inv_guia_despacho_encabezado";
  $res = mysql_query($totalGuias,$dbh);
  $row = mysql_fetch_array($res);
  $totalGuias = $row["Total"];

  $totalEfectivo ="SELECT COUNT(guia_id) AS Efectivo FROM inv_guia_despacho_encabezado WHERE guia_estado = 1";
  $res = mysql_query($totalEfectivo,$dbh);
  $row = mysql_fetch_array($res);
  $totalEfectivo = $row["Efectivo"];

  $totalNulos ="SELECT COUNT(guia_id) AS Nulos FROM inv_guia_despacho_encabezado WHERE guia_estado = 0";
  $res = mysql_query($totalNulos,$dbh);
  $row = mysql_fetch_array($res);
  $totalNulos = $row["Nulos"];
  ?>
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
            CONTENIDO

            <ul>
              <li>REPORTE 1 : GUIAS EMITIDAS VALIDAS Y NULAS NACIONAL</li>
              <li>REPORTE 2 : GUIAS EMITIDAS VALIDAS Y NULAS POR REGION</li>
              <li>REPORTE 3 : JARDINES CON MÁS DESPACHOS</li>
            </ul>
            <!-- CONTENIDO DE LAS PAGINAS !-->
          </div>
        </div>
      </div>
    </div>
