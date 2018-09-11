<?php
$regiones = "SELECT * FROM acti_region WHERE region_estado = 1";
$regiones = mysql_query($regiones,$dbh);

$regiones2 = "SELECT * FROM regiones WHERE activo = 1";
$regiones2 = mysql_query($regiones2,$dbh2);

$perfiles = "SELECT distinct(atributo1) FROM usuarios";
$perfiles = mysql_query($perfiles,$dbh2);

if(isset($_POST["cmd"]) AND $_POST["cmd"] == "Nuevo")
{
  $pass = md5($_POST["password"]);
  $regionUsuario = ($_POST["sistema"] == 1) ?  $_POST["region2"] : $_POST["region"];

  $sql = "INSERT INTO usuarios (num,nombre,password,nombrecom,atributo1,estado,region,correo,sistema) VALUES (NULL,'".$_POST["nombre"]."','".$pass."','".strtoupper($_POST["nombrecom"])."',".$_POST["atributo1"].",'".$_POST["estado"]."','".$regionUsuario."','".$_POST["correo"]."','".$_POST["sistema"]."')";

  $respuesta = mysql_query($sql,$dbh2);

  $sql2 = "INSERT INTO acceso (acc_usr) values('".$_POST["nombre"]."')";
  mysql_query($sql2,$dbh2);
}
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
      <div class="x_panel" >
        <div class="x_title">
          <h2>Plain Page</h2>
          <div class="clearfix"></div>
        </div>
        <!-- CONTENIDO DE LAS PAGINAS !-->
        <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="POST" action="<?php echo $_SERVER["REQUEST_URI"] ?>">

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cat_nombre">EMAIL <span class="required">*</span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="email" id="correo" name="correo" required="required" class="form-control col-md-7 col-xs-12" onChange="getUserName(this.value)">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cat_nombre">NOMBRE DE USUARIO <span class="required">*</span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" id="nombre" name="nombre" required="required" class="form-control col-md-7 col-xs-12" readonly>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cat_nombre">NOMBRE <span class="required">*</span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" id="nombrecom" name="nombrecom" required="required" class="form-control col-md-7 col-xs-12">
            </div>
          </div>
          
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cat_nombre">SISTEMA <span class="required">*</span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select class="form-control" name="sistema" id="sistema" required onchange="getRegiones(this.value)">
                <option value="" selected>Seleccionar...</option>
                <option value="2">INEDIS</option>
                <option value="1">SEGFAC</option>
                </select>
              </div>
            </div>

          <div class="form-group INEDIS" style="display:none">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cat_nombre">REGION DE USUARIO <span class="required">*</span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select class="form-control" name="region" id="region">
                <option value="" selected>Seleccionar...</option>
                <?php while ($row=mysql_fetch_array($regiones)) { ?>
                  <option value="<?php echo $row["region_id"] ?>"><?php echo $row["region_glosa"] ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>

            <div class="form-group SEGFAC" style="display:none">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cat_nombre">REGION DE USUARIO <span class="required">*</span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select class="form-control" name="region2" id="region2">
                <option value="" selected>Seleccionar...</option>
                <?php while ($row=mysql_fetch_array($regiones2)) { ?>
                  <option value="<?php echo $row["codigo"] ?>"><?php echo $row["nombre"] ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>


            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cat_nombre">PERFIL DE USUARIO <span class="required">*</span></label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <select class="form-control" name="atributo1" id="atributo1" onChange="getMenu(this.value)" required>
                  <option value="" selected>Seleccionar...</option>
                  <!-- <?php while ($row=mysql_fetch_array($perfiles)) { ?>
                    <option value="<?php echo $row["atributo1"] ?>"><?php echo $row["atributo1"] ?></option>
                    <?php } ?> -->
                    <option value="3">OFICINA DE PARTES</option>
                    <option value="5">ENCARGADO CONTABILIDAD</option>
                    <option value="7">SEGUIMIENTO Y CONTROL (ADMINISTRADOR)</option>
                    <option value="8">SEGUIMIENTO Y CONTROL (EJECUTIVO)</option>
                    <option value="31">TESORERO</option>
                    <option value="32">DIRECTOR/A</option>
                    <option value="33">SUB DIRECTOR</option>
                    <option value="34">CONTABLE</option>
                    <option value="35">JEFE DE COMPRAS</option>
                    <option value="36">COMPRADOR</option>
                    <option value="38">INVENTARIO DIRECCION NACIONAL</option>
                    <option value="38">INVENTARIO REGIONES</option>
                    <option value="39">BODEGA REGIONES</option>
                    <option value="37">BODEGA DIRECCION NACIONAL</option>
                    <option value="57">SOLICITUD DE PEDIDO</option>
                  </select>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cat_nombre">ESTADO DE USUARIO <span class="required">*</span></label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <select class="form-control" name="estado" id="estado" required>
                    <option value="" selected>Seleccionar...</option>
                    <option value="A">ACTIVO</option>
                    <option value="B">INACTIVO</option>
                  </select>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cat_nombre">CONTRASEÑA DE USUARIO <span class="required">*</span></label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="password" id="password" name="password" class="form-control col-md-7 col-xs-12" required>
                </div>
              </div>

              <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                  <button type="submit" class="btn btn-success">Crear</button>
                </div>
              </div>

              <input type="hidden" name="cmd" value="Nuevo">

            </form>
            <!-- CONTENIDO DE LAS PAGINAS !-->
          </div>
        </div>
      </div>

      <div class="row resultado">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel" >
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
            <div class="tabla">

            </div>
                <!-- CONTENIDO DE LAS PAGINAS !-->
              </div>
            </div>
          </div>
    </div>

    <script type="text/javascript">
    $(".resultado").hide();
    function getMenu(input)
    {
      var data = ({cmd : "getMenu", perfil : input});

      $.ajax({
        type:"POST",
        url:"obtener_menu.php",
        data:data,
        dataType:"JSON",
        success : function(response){
          var tabla = "<table class='table table-bordered table-condensed table-striped table-hover jambo_table bulk_action'>";
          tabla+="<thead>";
          tabla+="<tr>";
          tabla+="<th>MENU</th>"
          tabla+="</tr>"
          tabla+="</thead>";
          tabla+="<tbody>";
          $.each(response,function(index,value){
            //console.log(value);
            tabla+="<tr>";
            tabla+="<th>"+value+"</th>"
            tabla+="</tr>"
          })
          tabla+="</tbody>";
          tabla+="</table>";
          $(".tabla").html(tabla);
          $(".table").dataTable();
          $(".resultado").fadeIn("slow");
        }
      });
    }

    function getRegiones(input)
    {
      if(input == 2)
      {
        $(".SEGFAC").hide();
        $(".INEDIS").show();
      }else if(input == 1)
      {
          $(".INEDIS").hide();
          $(".SEGFAC").show();
      }else{
        $(".INEDIS").hide();
        $(".SEGFAC").hide();

      }
    }
    </script>
