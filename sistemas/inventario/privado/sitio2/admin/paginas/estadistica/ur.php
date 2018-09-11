  <?php
  $sql = "SELECT junji_inventario.log.log_usr,junji_inventario.log.log_tipo,junji_inventario.log.log_origen,junji_inventario.log.log_modulo,junji_inventario.log.log_horasys,junji_inventario.log.log_fechasys,junji_segfac.usuarios.region FROM junji_inventario.log INNER JOIN junji_segfac.usuarios ON junji_inventario.log.log_usr = junji_segfac.usuarios.nombre ORDER BY junji_inventario.log.log_id DESC LIMIT 10";
  $res = mysql_query($sql,$adm);
  ?>
  <!-- page content -->

  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>ESTADISTICAS / REPORTES</h3>
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
            <h2>ESTADISTICAS</h2>
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
          <table class="table table-striped table-hover table-condensed table-bordered jambo_table bulk_action">
            <thead>
              <th>ACCION</th>
              <th>USUARIO</th>
              <th>REGION</th>
              <th>ORIGEN</th>
              <th>MÓDULO</th>
              <th>FECHA</th>
              <th>HORA</th>
            </thead>

            <tbody>
              <?php while($row=mysql_fetch_array($res)) { ?>
                <?php 
                $fecha = $row["log_fechasys"];
                $fecha = explode("-", $fecha);
                $fecha = $fecha[2]."-".$fecha[1]."-".$fecha[0];


                ?>
                <tr>
                  <td><?php echo $row["log_tipo"] ?></td>
                  <td><?php echo $row["log_usr"] ?></td>
                  <td><?php echo $row["region"] ?></td>
                  <td><?php echo $row["log_origen"] ?></td>
                  <td><?php echo $row["log_modulo"] ?></td>
                  <td><?php echo $fecha ?></td>
                  <td><?php echo $row["log_horasys"] ?></td>
                </tr>
                <?php } ?>
              </tbody>
              <tfoot>
                <tr>
                  <td colspan="7" align="left">
                    <form action="paginas/estadistica/reporte1.php" method="POST">
                      <input type="hidden" name="query" value="<?php echo $sql ?>">
                      <button type="submit">EXPORTAR A EXCEL <i class="fa fa-file-excel-o"></i></button>
                    </form>
                  </td>
                </tr>
              </tfoot>
            </table>
            <!-- CONTENIDO DE LAS PAGINAS !-->
          </div>
        </div>
      </div>
    </div>
    <!-- /page content -->