<script src="librerias/jquery-1.11.3.min.js"></script>
<script src="librerias/jquery.blockUI.js"></script>
<?
if(!isset($_SESSION)) 
{ 
  session_start(); 
}
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
      <!-- <img src="../../../header.jpg"> -->
      INEDIS
    </td>
  </tr>
  <tr>
    <td width="230" align="center">
      <a href="inv_index.php"><img src="junji.png" ></a>
    </td>
    <?
    $menuId = array();
    while($row = mysql_fetch_array($res)){
      $menu_id["/sistemas/inventario/privado/sitio2/".$row["menu_url"]] = $row["menu_id"];
      ?>
      <td>
       <a href="<? echo  $row["menu_url"] ?>?cod=<? echo  $row["menu_id"] ?>" class="button" id="menu_junji_<? echo  $row["menu_id"] ?>" ><? echo $row["menu_nombre"] ?></a>
     </td>
     <?
   }
   ?>
   <td>
    &nbsp;&nbsp;&nbsp;
  </td>
  <td class="Estilo2">
    <ul style="list-style:none;padding:0;margin:0">

      <li>Usuario : <? echo $_SESSION["nom_user"] ?></li>
      <li><a href="dashboard">DASHBOARD</a></li>
      <?php if ($_SESSION["Acceso"]["acc_panel_adm"] == 1): ?>
        <li><a href="admin">ADMINISTRACION</a></li>
      <?php endif ?>
      <li><a href="salir.php" class="link" target="_parent">CERRAR SESI&Oacute;N</a></li>

      <li>
        <?php if ($_SESSION["Acceso"]["acc_multi_reg"] == 1): ?>
          <form method="POST" action="inicio.php"> 
            <select name="ur" onchange="this.form.submit()" class="Estilo1">
              <option value="">Seleccionar Region</option>
              <?php for ($i=1; $i <= 16; $i++) { ?>
                <option value="<?php echo $i ?>" <?php if($_SESSION["region"] == $i){echo "selected";}?>><?php echo $i ?></option>
                <? } ?>
              </select>
            </form>
          <?php endif ?>

          <?php if ($_SESSION["Acceso"]["acc_adm_inedis"] == 1): ?>
            <form method="POST" action="inicio.php"> 
              <select name="ur" onchange="this.form.submit()" class="Estilo1">
                <option value="">Seleccionar Region</option>
                <?php for ($i=1; $i <= 16; $i++) { ?>
                  <option value="<?php echo $i ?>" <?php if($_SESSION["region"] == $i){echo "selected";}?>><?php echo $i ?></option>
                  <? } ?>
                </select>
<br>
                <select name="ns" onchange="this.form.submit()" class="Estilo1">
                  <option value="">Seleccionar...</option>
                  <option value="35" <?php if($_SESSION["pfl_user"] == 35){echo"selected";} ?>>INVENTARIO</option>
                  <option value="37" <?php if($_SESSION["pfl_user"] == 37){echo"selected";} ?>>LOGISTICA</option>
                </select>
              </form>
            <?php endif ?>

            <?php if ($_SESSION["Acceso"]["acc_multi_sis"] == 1): ?>
              <?php if ($_SESSION["region"] <> 16): ?>
                <form method="POST" action="inicio.php"> 
                <select name="ns" onchange="this.form.submit()" class="Estilo1">
                  <option value="">Seleccionar...</option>
                  <option value="38" <?php if($_SESSION["pfl_user"] == 38){echo"selected";} ?>>INVENTARIO</option>
                  <option value="39" <?php if($_SESSION["pfl_user"] == 39){echo"selected";} ?>>LOGISTICA</option>
                </select>
              </form>
            <?php else: ?>
              <form method="POST" action="inicio.php"> 
                <select name="ns" onchange="this.form.submit()" class="Estilo1">
                  <option value="">Seleccionar...</option>
                  <?php if ($_SESSION["nom_user"] == "mzamora" || $_SESSION["nom_user"] == "dvaldes"): ?>
                  <option value="23" <?php if($_SESSION["pfl_user"] == 23){echo"selected";} ?>>INVENTARIO</option>
                <?php else: ?>
                <option value="35" <?php if($_SESSION["pfl_user"] == 35){echo"selected";} ?>>INVENTARIO</option>
                <?php endif ?>
                  <?php if ($_SESSION["nom_user"] == "iyanez"): ?>
                  <option value="51" <?php if($_SESSION["pfl_user"] == 51){echo"selected";} ?>>LOGISTICA</option>
                  <?php else: ?>
                    <option value="37" <?php if($_SESSION["pfl_user"] == 37){echo"selected";} ?>>LOGISTICA</option>
                    
                  <?php endif ?>
                </select>
              </form>
              <?php endif ?>
            <?php endif ?>

            <?php if ($_SESSION["nom_user"] == "auditor"): ?>
               <form method="POST" action="inicio.php"> 
                <select name="ns" onchange="this.form.submit()" class="Estilo1">
                  <option value="">Seleccionar...</option>
                  <option value="23" <?php if($_SESSION["pfl_user"] == 23){echo"selected";} ?>>INVENTARIO</option>
                  <option value="53" <?php if($_SESSION["pfl_user"] == 53){echo"selected";} ?>>LOGISTICA</option>
                </select>
              </form>
            <?php endif ?>
          </li>
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

    function blockUI() {
      $.blockUI({ css: {
        border: 'none',
        padding: '15px',
        backgroundColor: '#000',
        '-webkit-border-radius': '10px',
        '-moz-border-radius': '10px',
        opacity: .5,
        color: '#fff'
      },
      message:"Espere un momento porfavor <i class='fa fa-spinner fa-spin'></i>" });
    }

    function unBlockUI() {
      $.unblockUI();
    }
  </script>
