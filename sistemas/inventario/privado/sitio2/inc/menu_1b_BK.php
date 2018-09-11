<?
session_start();
extract($_GET);
extract($_POST);
extract($_SESSION);

$niv_m = $_SESSION["pfl_user"];
$nivel = $_SESSION["pfl_user"];
if($_SESSION["nom_user"] ==""  ){
	?><script language="javascript">location.href='salir.php';</script><?
}
require("inc/config.php");
$sql = "Select * from menu where menu_perfil".$nivel."=1 order by menu_orden ";
//echo $sql;
$res = mysql_query($sql);

 // BUSCAMOS LOS ACCESOS
$sqla = "SELECT * FROM acceso WHERE acc_usr = '".$_SESSION["nom_user"]."' LIMIT 1";
$sqlar = mysql_query($sqla,$dbh2);
$sqlarow = mysql_fetch_array($sqlar);
$_SESSION["Acceso"] =  $sqlarow;

?>
<!--<link href="css/estilo.css" rel="stylesheet" type="text/css">!-->
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" >
  <tr>
    <td colspan="<?php echo mysql_num_rows($res) + 3 ?>" align=center class="Estilo1titulo">
      INEDIS
    </td>
  </tr>
  <tr>
    <td width="230">
      <a href="inicio.php"><img src="junji.jpg" width="223" height="80"></a>
    </td>
    <?
    $menuId = array();
    while($row = mysql_fetch_array($res)){
      $menu_id["/sistemas/inventario/privado/sitio2/".$row["menu_url"]] = $row["menu_id"];
      ?>
      <td >
       <a href="<? echo  $row["menu_url"] ?>?cod=<? echo  $row["menu_id"] ?>" class="button" id="menu_junji_<? echo  $row["menu_id"] ?>" ><? echo $row["menu_nombre"] ?></a>

     </td>
     <?
   }
   ?>
   <td>
    &nbsp;&nbsp;&nbsp;
  </td>
  <td class="Estilo2">
    Usuario:<? echo $_SESSION["nom_user"] ?><br>
    <a href="dashboard">Dashboard</a><br>
    <!-- <a href="admin4/production" target="_blank">ADMIN</a><br> -->
    <a href="salir.php" class="link">CERRAR SESI&Oacute;N</a>
  
  <?php if ($_SESSION["nom_user"] == "auditor"): ?>
    <form method="POST" action="inicio.php"> 
      <select name="ur" onchange="this.form.submit()" class="Estilo1mc">
        <option value="">Seleccionar Region</option>
        <?php for ($i=1; $i <= 16; $i++) { ?>
          <option value="<?php echo $i ?>" <?php if($_SESSION["region"] == $i){echo "selected";}?>><?php echo $i ?></option>
          <? } ?>
        </select>

        <select name="ns" onchange="this.form.submit()" class="Estilo1mc">
          <option value="">Seleccionar...</option>
          <option value="23" <?php if($_SESSION["pfl_user"] == 23){echo"selected";} ?>>Inventario</option>
          <option value="53" <?php if($_SESSION["pfl_user"] == 53){echo"selected";} ?>>Logistica</option>
        </select>

      </form>
  <?php endif ?>
    
    <?php if ($_SESSION["nom_user"] == "INEDIS" || $_SESSION["nom_user"] == "pcastaneda"): ?>
     <form method="POST" action="inicio.php"> 
      <select name="ur" onchange="this.form.submit()" class="Estilo1mc">
        <option value="">Seleccionar Region</option>
        <?php for ($i=1; $i <= 16; $i++) { ?>
          <option value="<?php echo $i ?>" <?php if($_SESSION["region"] == $i){echo "selected";}?>><?php echo $i ?></option>
          <? } ?>
        </select>

        <select name="ns" onchange="this.form.submit()" class="Estilo1mc">
          <option value="">Seleccionar...</option>
          <option value="35" <?php if($_SESSION["pfl_user"] == 35){echo"selected";} ?>>Inventario</option>
          <option value="37" <?php if($_SESSION["pfl_user"] == 37){echo"selected";} ?>>Logistica</option>
        </select>
      </form>
    <?php endif ?>

    <?php if ($_SESSION["switch"] == 1): ?>
      <form method="POST" action="inicio.php"> 
        <select name="ns" onchange="this.form.submit()" class="Estilo1mc">
          <option value="">Seleccionar...</option>
          <option value="38" <?php if($_SESSION["pfl_user"] == 38){echo"selected";} ?>>Inventario</option>
          <option value="39" <?php if($_SESSION["pfl_user"] == 39){echo"selected";} ?>>Logistica</option>
        </select>
      </form>
    <?php endif ?>

    <?php if ($_SESSION["pfl_user"] == 55 || $_SESSION["pfl_user"] == 56): ?>
      <form method="POST" action="inicio.php"> 
<select name="ur" onchange="this.form.submit()" class="Estilo1mc">
        <option value="">Seleccionar Region</option>
        <?php for ($i=1; $i <= 16; $i++) { ?>
          <option value="<?php echo $i ?>" <?php if($_SESSION["region"] == $i){echo "selected";}?>><?php echo $i ?></option>
          <? } ?>
        </select>
      </form>
    <?php endif ?>

    <!-- <li style="padding:3px"><a href="admin4/production/" target="_blank">Admin</a></li> -->
  </ul>
  
  
</td>
</tr>
</table>
<script type="text/javascript">
  $(function(){
    var url = "<?php echo $menu_id[$_SERVER["PHP_SELF"]] ?>";
    $("#menu_junji_"+url).addClass("menu_junji");

    $('input').keyup(function(){
      $(this).val($(this).val().toUpperCase());
    });

  })
</script>
