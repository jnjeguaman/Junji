<?php
$perfiles = "SELECT distinct(atributo1) FROM usuarios";
$perfiles = mysql_query($perfiles,$dbh2);

$usuarios = "SELECT * FROM usuarios WHERE nombre NOT LIKE 'INEDIS' AND nombre NOT LIKE 'SIGEJUN'";
$usuarios = mysql_query($usuarios,$dbh2);



if($_POST["cmd"] == "Actualizar")
{
  if(empty($_POST["password"]))
  {
    $pass = $_POST["password2"];
  }else{
    $pass = md5($_POST["password"]);
  }
  $region = $_POST["region"];
  $sql = "UPDATE usuarios SET nombre = '".$_POST["nombre"]."', password = '".$pass."', nombrecom = '".$_POST["nombrecom"]."', atributo1 = '".$_POST["atributo1"]."', estado = '".$_POST["estado"]."', region = '".$region."', correo = '".$_POST["correo"]."',sistema = '".$_POST["sistema"]."' WHERE num = ".$_POST["num"];
  $respuesta = mysql_query($sql,$dbh2);

  if($respuesta)
    { ?>
  <div class="alert alert-success" role="alert">
    <i class="fa fa-check"></i>
    Informacion actualizada con Exito!
  </div>
  <? }else{ ?>
  <div class="alert alert-success" role="alert">
    <i class="fa fa-checwarningk"></i>
    Ha ocurrido un error durante la actualizacion!.
  </div>
  <?php }
}

if($_POST["cmd"] == "ActualizarAcceso")
{
  $sql = "UPDATE acceso SET 
  acc_recibido = ".$_POST["acc_recibido"].",
  acc_rt = ".$_POST["acc_rt"].",
  acc_rc = ".$_POST["acc_rc"].",
  acc_ap = ".$_POST["acc_ap"].",
  acc_re = ".$_POST["acc_re"].",
  acc_alt = ".$_POST["acc_alt"].",
  acc_ba = ".$_POST["acc_ba"].",
  acc_aju = ".$_POST["acc_aju"].",
  acc_cont = ".$_POST["acc_cont"].",
  acc_anular_oc = ".$_POST["acc_anular_oc"].",
  acc_anular_gd = ".$_POST["acc_anular_gd"].",
  acc_mj = ".$_POST["acc_mj"].",
  acc_mp = ".$_POST["acc_mp"].",
  acc_md = ".$_POST["acc_md"].",
  acc_mbs = ".$_POST["acc_mbs"].",
  acc_del_inv = ".$_POST["acc_del_inv"].",
  acc_multi_reg = ".$_POST["acc_multi_reg"].",
  acc_adm_inedis = ".$_POST["acc_adm_inedis"].",
  acc_panel_adm = ".$_POST["acc_panel_adm"].",
  acc_aprueba_ing = ".$_POST["acc_aprueba_ing"].",
  acc_rchz_ing = ".$_POST["acc_rchz_ing"].",
  acc_multi_sis = ".$_POST["acc_multi_sis"]."
  WHERE acc_usr = '".$_POST["nombre"]."'
  ";


  if(mysql_query($sql,$dbh2)) { ?>
  <div class="alert alert-success" role="alert">
    <i class="fa fa-check"></i>
    Informacion actualizada con Exito!
  </div>
  <? }else{ ?>
  <div class="alert alert-success" role="alert">
    <i class="fa fa-checwarningk"></i>
    Ha ocurrido un error durante la actualizacion!.
  </div>
  <?php 
  }
}
?>

<div class="">
  <div class="page-title">
    <div class="title_left">
      <h3>USUARIOS > EDITAR</h3>
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

  <?php if (isset($_GET["id"])): ?>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel" >
          <div class="x_title">
            <h2>USUARIOS > EDITAR</h2>

            <div class="clearfix"></div>
          </div>
          <!-- CONTENIDO DE LAS PAGINAS !-->
          <?php
          $detalle = "SELECT * FROM usuarios WHERE num = ".$_GET["id"];
          $detalle = mysql_query($detalle,$dbh2);
          $detalle = mysql_fetch_array($detalle);

          if($detalle["sistema"] == 1)
          {
            $sql = "SELECT * FROM regiones WHERE activo = 1";
            $res = mysql_query($sql,$dbh2);
          }else{
            $sql = "SELECT * FROM acti_region";
            $res = mysql_query($sql,$dbh);
          }
          ?>
          <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="POST" action="<?php echo $_SERVER["REQUEST_URI"] ?>">

            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cat_nombre">EMAIL <span class="required">*</span></label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="email" id="correo" name="correo" required="required" class="form-control col-md-7 col-xs-12" onChange="getUserName(this.value)" value="<?php echo $detalle["correo"] ?>">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cat_nombre">NOMBRE DE USUARIO <span class="required">*</span></label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="nombre" name="nombre" required="required" class="form-control col-md-7 col-xs-12" readonly value="<?php echo $detalle["nombre"] ?>">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cat_nombre">NOMBRE <span class="required">*</span></label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="nombrecom" name="nombrecom" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $detalle["nombrecom"] ?>">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cat_nombre">SISTEMA <span class="required">*</span></label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <!-- <select class="form-control" name="sistema" id="sistema" required onchange="getRegiones(this.value)"> -->
                <select class="form-control" name="sistema" id="sistema" required onchange="this.form.submit()">
                  <option value="" selected>Seleccionar...</option>
                  <option value="2" <?php if($detalle["sistema"] == 2){echo"selected";} ?>>INEDIS</option>
                  <option value="1" <?php if($detalle["sistema"] == 1){echo"selected";} ?>>SEGFAC</option>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cat_nombre">REGION DE USUARIO <span class="required">*</span></label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <select class="form-control" name="region" id="region" required>
                  <option value="" selected>Seleccionar...</option>
                  <?php while ($row=mysql_fetch_array($res)) { ?>
                  <option value="<?php echo ($detalle["sistema"] == 1) ? $row["codigo"] : $row["region_id"] ?>" <?php if($detalle["sistema"] == 1 && $row["codigo"] == $detalle["region"]){echo"selected";}else if($detalle["sistema"] == 2 && $detalle["region"] == $row["region_id"]){echo"selected";} ?>  ><?php echo ($detalle["sistema"] == 1) ? $row["nombre"] : $row["region_glosa"] ?></option>
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
                      <option value="<?php echo $row["atributo1"] ?>" <?php if($row["atributo1"] == $detalle["atributo1"]){echo"selected";}?>><?php echo $row["atributo1"] ?></option>
                      <?php } ?> -->
                      <?php if ($detalle["sistema"] == 1): ?>
                        <option value="3" <?php if($detalle["atributo1"] == 3){echo"selected";}?> >OFICINA DE PARTES</option>
                        <option value="5" <?php if($detalle["atributo1"] == 5){echo"selected";}?> >ENCARGADO CONTABILIDAD</option>
                        <option value="7" <?php if($detalle["atributo1"] == 7){echo"selected";}?> >SEGUIMIENTO Y CONTROL (ADMINISTRADOR)</option>
                        <option value="8" <?php if($detalle["atributo1"] == 8){echo"selected";}?> >SEGUIMIENTO Y CONTROL (EJECUTIVO)</option>
                        <option value="31" <?php if($detalle["atributo1"] == 31){echo"selected";}?> >TESORERO</option>
                        <option value="32" <?php if($detalle["atributo1"] == 32){echo"selected";}?> >DIRECTOR/A</option>
                        <option value="33" <?php if($detalle["atributo1"] == 33){echo"selected";}?> >SUB DIRECTOR</option>
                        <option value="34" <?php if($detalle["atributo1"] == 34){echo"selected";}?> >CONTABLE</option>
                        <option value="35" <?php if($detalle["atributo1"] == 35){echo"selected";}?> >JEFE DE COMPRAS</option>
                        <option value="36" <?php if($detalle["atributo1"] == 36){echo"selected";}?> >COMPRADOR</option>
                      <?php else: ?>
                        <option value="38" <?php if($detalle["atributo1"] == 38){echo"selected";}?> >INVENTARIO DIRECCION NACIONAL</option>
                        <option value="38" <?php if($detalle["atributo1"] == 38){echo"selected";}?> >INVENTARIO REGIONES</option>
                        <option value="39" <?php if($detalle["atributo1"] == 39){echo"selected";}?> >BODEGA REGIONES</option>
                        <option value="37" <?php if($detalle["atributo1"] == 37){echo"selected";}?> >BODEGA DIRECCION NACIONAL</option>
                         <option value="57" <?php if($detalle["atributo1"] == 57){echo"selected";}?> >SOLICITUD DE PEDIDO</option>
                      <?php endif ?>
                      
                      
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cat_nombre">ESTADO DE USUARIO <span class="required">*</span></label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <select class="form-control" name="estado" id="estado" required>
                      <option value="" selected>Seleccionar...</option>
                      <option value="A"<?php if("A" == $detalle["estado"]){echo"selected";}?>>ACTIVO</option>
                      <option value="B"<?php if("B" == $detalle["estado"]){echo"selected";}?>>INACTIVO</option>
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cat_nombre">CONTRASEÑA DE USUARIO <span class="required">*</span></label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="password" id="password" name="password" class="form-control col-md-7 col-xs-12">
                  </div>
                </div>

                <div class="form-group">
                  <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <button type="submit" class="btn btn-success">Actualizar</button>
                  </div>
                </div>

                <input type="hidden" name="cmd" value="Actualizar">
                <input type="hidden" name="num" value="<?php echo $detalle["num"]?>">
                <input type="hidden" name="password2" value="<?php echo $detalle["password"]?>">
              </form>
              <!-- CONTENIDO DE LAS PAGINAS !-->
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel" >
            <div class="x_title">
              <h2>USUARIOS > ACCESO</h2>

              <div class="clearfix"></div>
            </div>
            <!-- CONTENIDO DE LAS PAGINAS !-->
            <!-- BUSCAMOS LOS ACCESOS CONCEDIDOS AL USUARIO -->
            <?php
            $acceso = "SELECT * FROM acceso WHERE acc_usr = '".$detalle["nombre"]."' LIMIT 1";
            $resAcceso = mysql_query($acceso,$dbh2);
            $rowAcceso = mysql_fetch_array($resAcceso);
            ?>

            <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="POST" action="<?php echo $_SERVER["REQUEST_URI"] ?>">

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cat_nombre">RECIBIDOS <span class="required">*</span></label>
                <div class="col-md-6 col-sm-6 col-xs-12">

                  <input type="radio" required="required" id="acc_recibido" name="acc_recibido" <?php if($rowAcceso["acc_recibido"] == 1){echo"checked";} ?> value="1">SI
                  <input type="radio" required="required" id="acc_recibido" name="acc_recibido" <?php if($rowAcceso["acc_recibido"] == 0){echo"checked";} ?> value="0">NO
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cat_nombre">RECEPCION TECNICA <span class="required">*</span></label>
                <div class="col-md-6 col-sm-6 col-xs-12">

                  <input type="radio" required="required" id="acc_rt" name="acc_rt" <?php if($rowAcceso["acc_rt"] == 1){echo"checked";} ?> value="1">SI
                  <input type="radio" required="required" id="acc_rt" name="acc_rt" <?php if($rowAcceso["acc_rt"] == 0){echo"checked";} ?> value="0">NO
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cat_nombre">RECEPCION CONFORME <span class="required">*</span></label>
                <div class="col-md-6 col-sm-6 col-xs-12">

                  <input type="radio" required="required" id="acc_rc" name="acc_rc" <?php if($rowAcceso["acc_rc"] == 1){echo"checked";} ?> value="1">SI
                  <input type="radio" required="required" id="acc_rc" name="acc_rc" <?php if($rowAcceso["acc_rc"] == 0){echo"checked";} ?> value="0">NO
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cat_nombre">MÓDULO APROBACIONES <span class="required">*</span></label>
                <div class="col-md-6 col-sm-6 col-xs-12">

                  <input type="radio" required="required" id="acc_ap" name="acc_ap" <?php if($rowAcceso["acc_ap"] == 1){echo"checked";} ?> value="1">SI
                  <input type="radio" required="required" id="acc_ap" name="acc_ap" <?php if($rowAcceso["acc_ap"] == 0){echo"checked";} ?> value="0">NO
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cat_nombre">MÓDULO RECHAZOS <span class="required">*</span></label>
                <div class="col-md-6 col-sm-6 col-xs-12">

                  <input type="radio" required="required" id="acc_re" name="acc_re" <?php if($rowAcceso["acc_re"] == 1){echo"checked";} ?> value="1">SI
                  <input type="radio" required="required" id="acc_re" name="acc_re" <?php if($rowAcceso["acc_re"] == 0){echo"checked";} ?> value="0">NO
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cat_nombre">MÓDULO ALTAS <span class="required">*</span></label>
                <div class="col-md-6 col-sm-6 col-xs-12">

                  <input type="radio" required="required" id="acc_alt" name="acc_alt" <?php if($rowAcceso["acc_alt"] == 1){echo"checked";} ?> value="1">SI
                  <input type="radio" required="required" id="acc_alt" name="acc_alt" <?php if($rowAcceso["acc_alt"] == 0){echo"checked";} ?> value="0">NO
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cat_nombre">MÓDULO BAJAS <span class="required">*</span></label>
                <div class="col-md-6 col-sm-6 col-xs-12">

                  <input type="radio" required="required" id="acc_ba" name="acc_ba" <?php if($rowAcceso["acc_ba"] == 1){echo"checked";} ?> value="1">SI
                  <input type="radio" required="required" id="acc_ba" name="acc_ba" <?php if($rowAcceso["acc_ba"] == 0){echo"checked";} ?> value="0">NO
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cat_nombre">MÓDULO AJUSTES <span class="required">*</span></label>
                <div class="col-md-6 col-sm-6 col-xs-12">

                  <input type="radio" required="required" id="acc_aju" name="acc_aju" <?php if($rowAcceso["acc_aju"] == 1){echo"checked";} ?> value="1">SI
                  <input type="radio" required="required" id="acc_aju" name="acc_aju" <?php if($rowAcceso["acc_aju"] == 0){echo"checked";} ?> value="0">NO
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cat_nombre">MÓDULO CONTENEDORES <span class="required">*</span></label>
                <div class="col-md-6 col-sm-6 col-xs-12">

                  <input type="radio" required="required" id="acc_cont" name="acc_cont" <?php if($rowAcceso["acc_cont"] == 1){echo"checked";} ?> value="1">SI
                  <input type="radio" required="required" id="acc_cont" name="acc_cont" <?php if($rowAcceso["acc_cont"] == 0){echo"checked";} ?> value="0">NO
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cat_nombre">ANULAR ORDEN DE COMPRA <span class="required">*</span></label>
                <div class="col-md-6 col-sm-6 col-xs-12">

                  <input type="radio" required="required" id="acc_anular_oc" name="acc_anular_oc" <?php if($rowAcceso["acc_anular_oc"] == 1){echo"checked";} ?> value="1">SI
                  <input type="radio" required="required" id="acc_anular_oc" name="acc_anular_oc" <?php if($rowAcceso["acc_anular_oc"] == 0){echo"checked";} ?> value="0">NO
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cat_nombre">ANULAR GUÍA DE DESPACHO <span class="required">*</span></label>
                <div class="col-md-6 col-sm-6 col-xs-12">

                  <input type="radio" required="required" id="acc_anular_gd" name="acc_anular_gd" <?php if($rowAcceso["acc_anular_gd"] == 1){echo"checked";} ?> value="1">SI
                  <input type="radio" required="required" id="acc_anular_gd" name="acc_anular_gd" <?php if($rowAcceso["acc_anular_gd"] == 0){echo"checked";} ?> value="0">NO
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cat_nombre">SUBIR MATRIZ JARDINES <span class="required">*</span></label>
                <div class="col-md-6 col-sm-6 col-xs-12">

                  <input type="radio" required="required" id="acc_mj" name="acc_mj" <?php if($rowAcceso["acc_mj"] == 1){echo"checked";} ?> value="1">SI
                  <input type="radio" required="required" id="acc_mj" name="acc_mj" <?php if($rowAcceso["acc_mj"] == 0){echo"checked";} ?> value="0">NO
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cat_nombre">SUBIR MATRIZ PRODUCTOS <span class="required">*</span></label>
                <div class="col-md-6 col-sm-6 col-xs-12">

                  <input type="radio" required="required" id="acc_mp" name="acc_mp" <?php if($rowAcceso["acc_mp"] == 1){echo"checked";} ?> value="1">SI
                  <input type="radio" required="required" id="acc_mp" name="acc_mp" <?php if($rowAcceso["acc_mp"] == 0){echo"checked";} ?> value="0">NO
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cat_nombre">SUBIR MATRIZ DISTRIBUCIÓN <span class="required">*</span></label>
                <div class="col-md-6 col-sm-6 col-xs-12">

                  <input type="radio" required="required" id="acc_md" name="acc_md" <?php if($rowAcceso["acc_md"] == 1){echo"checked";} ?> value="1">SI
                  <input type="radio" required="required" id="acc_md" name="acc_md" <?php if($rowAcceso["acc_md"] == 0){echo"checked";} ?> value="0">NO
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cat_nombre">DESCARGAR STOCK MATRIZ <span class="required">*</span></label>
                <div class="col-md-6 col-sm-6 col-xs-12">

                  <input type="radio" required="required" id="acc_mbs" name="acc_mbs" <?php if($rowAcceso["acc_mbs"] == 1){echo"checked";} ?> value="1">SI
                  <input type="radio" required="required" id="acc_mbs" name="acc_mbs" <?php if($rowAcceso["acc_mbs"] == 0){echo"checked";} ?> value="0">NO
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cat_nombre">ELIMINAR ITEM DE INVENTARIO <span class="required">*</span></label>
                <div class="col-md-6 col-sm-6 col-xs-12">

                  <input type="radio" required="required" id="acc_del_inv" name="acc_del_inv" <?php if($rowAcceso["acc_del_inv"] == 1){echo"checked";} ?> value="1">SI
                  <input type="radio" required="required" id="acc_del_inv" name="acc_del_inv" <?php if($rowAcceso["acc_del_inv"] == 0){echo"checked";} ?> value="0">NO
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cat_nombre">ACCESO A TODAS LAS REGIONES <span class="required">*</span></label>
                <div class="col-md-6 col-sm-6 col-xs-12">

                  <input type="radio" required="required" id="acc_multi_reg" name="acc_multi_reg" <?php if($rowAcceso["acc_multi_reg"] == 1){echo"checked";} ?> value="1">SI
                  <input type="radio" required="required" id="acc_multi_reg" name="acc_multi_reg" <?php if($rowAcceso["acc_multi_reg"] == 0){echo"checked";} ?> value="0">NO
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cat_nombre">ACCESO A SISTEMAS DE LOGISTICA E INVENTARIO <span class="required">*</span></label>
                <div class="col-md-6 col-sm-6 col-xs-12">

                  <input type="radio" required="required" id="acc_adm_inedis" name="acc_adm_inedis" <?php if($rowAcceso["acc_adm_inedis"] == 1){echo"checked";} ?> value="1">SI
                  <input type="radio" required="required" id="acc_adm_inedis" name="acc_adm_inedis" <?php if($rowAcceso["acc_adm_inedis"] == 0){echo"checked";} ?> value="0">NO
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cat_nombre">ACCESO AL PANEL DE ADMINISTRACION <span class="required">*</span></label>
                <div class="col-md-6 col-sm-6 col-xs-12">

                  <input type="radio" required="required" id="acc_panel_adm" name="acc_panel_adm" <?php if($rowAcceso["acc_panel_adm"] == 1){echo"checked";} ?> value="1">SI
                  <input type="radio" required="required" id="acc_panel_adm" name="acc_panel_adm" <?php if($rowAcceso["acc_panel_adm"] == 0){echo"checked";} ?> value="0">NO
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cat_nombre">APROBAR INGRESO <span class="required">*</span></label>
                <div class="col-md-6 col-sm-6 col-xs-12">

                  <input type="radio" required="required" id="acc_aprueba_ing" name="acc_aprueba_ing" <?php if($rowAcceso["acc_aprueba_ing"] == 1){echo"checked";} ?> value="1">SI
                  <input type="radio" required="required" id="acc_aprueba_ing" name="acc_aprueba_ing" <?php if($rowAcceso["acc_aprueba_ing"] == 0){echo"checked";} ?> value="0">NO
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cat_nombre">RECHAZAR INGRESO <span class="required">*</span></label>
                <div class="col-md-6 col-sm-6 col-xs-12">

                  <input type="radio" required="required" id="acc_rchz_ing" name="acc_rchz_ing" <?php if($rowAcceso["acc_rchz_ing"] == 1){echo"checked";} ?> value="1">SI
                  <input type="radio" required="required" id="acc_rchz_ing" name="acc_rchz_ing" <?php if($rowAcceso["acc_rchz_ing"] == 0){echo"checked";} ?> value="0">NO
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cat_nombre">ACCESO INEDIS-BODEGA <span class="required">*</span></label>
                <div class="col-md-6 col-sm-6 col-xs-12">

                  <input type="radio" required="required" id="acc_multi_sis" name="acc_multi_sis" <?php if($rowAcceso["acc_multi_sis"] == 1){echo"checked";} ?> value="1">SI
                  <input type="radio" required="required" id="acc_multi_sis" name="acc_multi_sis" <?php if($rowAcceso["acc_multi_sis"] == 0){echo"checked";} ?> value="0">NO
                </div>
              </div>

              <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                  <button type="submit" class="btn btn-success">Actualizar</button>
                </div>
              </div>


              <input type="hidden" name="cmd" value="ActualizarAcceso">
              <input type="hidden" name="nombre" value="<?php echo $detalle["nombre"] ?>">
            </form>
            <!-- FIN CONTENIDO !-->
          </div>
        </div>
      </div>

    <?php endif; ?>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel" >
          <div class="x_title">
            <h2>USUARIOS > LISTADO</h2>
            <div class="clearfix"></div>
          </div>
          <!-- CONTENIDO DE LAS PAGINAS !-->
          <table class="table table-striped table-hover table-condensed table-bordered jambo_table bulk_action">
            <thead>
              <tr>
                <th>ID</th>
                <th>USUARIO</th>
                <th>NOMBRE</th>
                <th>EMAIL</th>
                <th>PERFIL</th>
                <th>REGION</th>
                <th>ESTADO</th>
                <th>EDITAR</th>
              </tr>
            </thead>
            <tbody>
              <?php while($row=mysql_fetch_array($usuarios)) { ?>
              <tr>
                <td><?php echo $row["num"] ?></td>
                <td><?php echo $row["nombre"] ?></td>
                <td>
                  <?php if($row["nombrecom"] == ""):?>
                    <font color="red">FALTA NOMBRE</font>
                  <?php else: ?>
                    <?php echo $row["nombrecom"] ?>
                  <?php endif ?>
                </td>
                <td>
                  <?php if($row["correo"] == ""):?>
                    <font color="red">FALTA CORREO ELECTRONICO</font>
                  <?php else: ?>
                    <?php echo $row["correo"] ?>
                  <?php endif ?>
                </td>
                <td><?php echo $row["atributo1"] ?></td>
                <td><?php echo $row["region"] ?></td>
                <td>
                  <?php if($row["estado"] == "A"): ?>
                    <font color="green"><i class="fa fa-check fa-lg"></i> ACTIVO</font>
                  <?php elseif($row["estado"] == "B"): ?>
                    <font color="red"><i class="fa fa-remove fa-lg"></i> DESHABILITADO</font>
                  <?php else: ?>
                  <?php endif ?>
                </td>
                <td><a href="?page=usuarios&action=editar&id=<?php echo $row["num"] ?>" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i></a></td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
          <!-- CONTENIDO DE LAS PAGINAS !-->
        </div>
      </div>
    </div>
  </div>

  <script type="text/javascript">
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