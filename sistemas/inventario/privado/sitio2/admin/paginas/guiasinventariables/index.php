  <?php
  ini_set("display_errors", 0);
error_reporting(E_ALL);
  require_once('includes/Classes/PHPExcel.php');
  require_once('includes/Classes/PHPExcel/Reader/Excel5.php');

  if(isset($_POST) && $_POST["cmd"] == "Buscar" || $_POST["cmd"] == "Visualizar")
  {
  	$ruta = "../../../../archivos/respaldos/INEDIS/".$_POST["annio"]."/".$_POST["mes"];
  	$archivos = scandir($ruta);
  	$arreglo = array();
  	foreach ($archivos as $key => $value) {
  		if($value <> "." && $value <> "..")
  		{
  			$arreglo[] = $value;
  		}
  	}
  }

  $contador = 0;

  if(isset($_POST) && $_POST["cmd"] == "Visualizar")
  {
  	$ruta = "../../../../archivos/respaldos/INEDIS/".$_POST["annio"]."/".$_POST["mes"];
  	$archivo = $_POST["var1"];
  	$destino = $ruta."/".$archivo;
  	$lineas = array();
  	
  	$buffer = preg_split('/\r\n|\n|\r/', trim(file_get_contents($destino)));
  }
  ?>
  <!-- page content -->
  <div class="right_col" role="main">


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

<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
   <div class="x_panel">
    <div class="x_title">SELECCIONAR PERIODO</div>

    <form action="<?php echo $_SERVER["REQUEST_URI"] ?>" method="POST" data-parsley-validate class="form-horizontal form-label-left">
     <div class="form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12">AÑO <span class="required">*</span></label>
      <div class="col-md-6 col-sm-6 col-xs-12">
       <select class="form-control" name="annio" id="annio">
        <option value="" selected>Seleccionar...</option>
        <?php for($i=2015;$i<=date("Y");$i++) { ?>
        <option value="<?php echo $i ?>" <?php if($_POST["annio"] == $i){echo"selected";} ?>><?php echo $i ?></option>
        <?php } ?>
      </select>
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">MES <span class="required">*</span></label>
    <div class="col-md-6 col-sm-6 col-xs-12">
     <select class="form-control" name="mes" id="mes">
      <option value="" selected>Seleccionar...</option>
      <option value="01" <?php if($_POST["mes"] == "01"){echo"selected";} ?>>ENERO</option>
      <option value="02" <?php if($_POST["mes"] == "02"){echo"selected";} ?>>FEBRERO</option>
      <option value="03" <?php if($_POST["mes"] == "03"){echo"selected";} ?>>MARZO</option>
      <option value="04" <?php if($_POST["mes"] == "04"){echo"selected";} ?>>ABRIL</option>
      <option value="05" <?php if($_POST["mes"] == "05"){echo"selected";} ?>>MAYO</option>
      <option value="06" <?php if($_POST["mes"] == "06"){echo"selected";} ?>>JUNIO</option>
      <option value="07" <?php if($_POST["mes"] == "07"){echo"selected";} ?>>JULIO</option>
      <option value="08" <?php if($_POST["mes"] == "08"){echo"selected";} ?>>AGOSTO</option>
      <option value="09" <?php if($_POST["mes"] == "09"){echo"selected";} ?>>SEPTIEMBRE</option>
      <option value="10" <?php if($_POST["mes"] == "10"){echo"selected";} ?>>OCTUBRE</option>
      <option value="11" <?php if($_POST["mes"] == "11"){echo"selected";} ?>>NOVIEMBRE</option>
      <option value="12" <?php if($_POST["mes"] == "12"){echo"selected";} ?>>DICIEMBRE</option>
    </select>
  </div>
</div>

<div class="form-group">
  <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
   <button type="submit" class="btn btn-success">Buscar</button>
 </div>
</div>

<input type="hidden" name="cmd" value="Buscar">


</form>
</div>
</div>
</div>	

<?php if (sizeof($arreglo) > 0): ?>
  <div class="row">
   <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
     <div class="x_title">SELECCIONAR PERIODO</div>

     <form action="<?php echo $_SERVER["REQUEST_URI"] ?>" method="POST" data-parsley-validate class="form-horizontal form-label-left">
      <table class="table table-striped table-hover table-condensed table-bordered jambo_table bulk_action">
       <thead>
        <th>NOMBRE ARCHIVO</th>
        <td>ÚLTIMA MODIFICACIÓN</td>
        <td>TAMAÑO</td>
        <td>VISUALIZAR</td>
      </thead>

      <tbody>
        <?php foreach ($arreglo as $key => $value): ?>
         <tr <?php if($_POST["var1"] == $value){echo"class='danger'";} ?>>
          <td><?php echo $value ?></td>
          <td><?php echo date("Y-m-d H:i:s",stat("../../../../archivos/respaldos/INEDIS/".$_POST["annio"]."/".$_POST["mes"]."/".$value)["mtime"]) ?></td>
          <td><?php echo filesize("../../../../archivos/respaldos/INEDIS/".$_POST["annio"]."/".$_POST["mes"]."/".$value) ?></td>
          <td>
           <button class="btn btn-info" name="var1" value="<?php echo $value ?>"><i class="fa fa-eye"></i></button>
         </td>
       </tr>
       <?php $contador++; ?>
     <?php endforeach ?>
   </tbody>
   <input type="hidden" name="totalElementos" value="<?php echo $contador ?>">
   <input type="hidden" name="cmd" value="Visualizar">
 </table>
 <input type="hidden" name="annio" value="<?php echo $_POST["annio"] ?>">
 <input type="hidden" name="mes" value="<?php echo $_POST["mes"] ?>">
</form>

</div>
</div>
</div>	
<?php endif ?>


<?php if ($_POST["cmd"] == "Visualizar"): ?>
  <div class="row">
   <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
     <div class="x_title">SELECCIONAR PERIODO</div>

     <table class="table table-striped table-hover table-condensed table-bordered jambo_table bulk_action">
       <thead>
         <th>CODIGO DE INVENTARIO</th>
         <th>DIRECCION</th>
         <th>USUARIO</th>
         <th>N° GUÍA</th>
         <th>ID GUÍA INTERNO</th>
       </thead>
       <tbody>
        <?php foreach ($buffer as $key => $value): ?>
          <?php 
          $texto = explode(";", $value);
          $pizza = explode("AND", $texto[1]);

          ?>
         <tr>
         <td><span class="label label-danger"><?php echo trim(str_replace('inv_codigo = ','',$pizza[1])) ?></span></td>
         <td><?php echo $texto[5] ?></td>
         <td><?php echo $texto[2] ?></td>
          <td><?php echo $texto[3] ?></td>
          <td><?php echo $texto[4] ?></td>
         </tr>
         <?php $contador++; ?>
       <?php endforeach ?>
     </tbody>
   </table>

 </div>
</div>
</div>  
<?php endif ?>





<!-- CONTENIDO DE LAS PAGINAS !-->
</div>
</div>
</div>
</div>
</div>
<!-- /page content -->
