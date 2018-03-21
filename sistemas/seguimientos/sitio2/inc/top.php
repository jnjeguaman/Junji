<style type="text/css">
<!--
.Estilo3 {
	font-size: 36px;
	font-weight: bold;
	font-style: italic;
	color: #648DFF;
}
-->
</style>

<table width="750" border="0" cellpadding="0" cellspacing="0">
      <!--DWLayoutTable-->
      <tr>
        <td width="100%" height="72" valign="top"><table border="0" cellpadding="0" cellspacing="0"  bgcolor="#F6FCF0">
          <!--DWLayoutTable-->
          <tr>
            <td height="111" colspan="9"><div align="left"><a href="inicio2.php" class="link"><img src="../../inventario/privado/sitio2/junji.png" border=0><span class="Estilo3"></span></div></td>
            <td width="64">
              <table width="100%" border="0" cellspacing="0" cellpadding="0">

  <?php if ($_SESSION["nom_user"] == "SIGEJUN"): ?>
    <tr>
      <td>
        <form action="inicio2.php" method="POST">
          <select name="ur" onchange="this.form.submit()" class="Estilo1">
            <?php 
            $sql3 = "SELECT * FROM regiones ORDER BY codigo ASC";
            $res3 = mysql_query($sql3,$dbh);

            while($row3=mysql_fetch_array($res3)) { ?>
            <option value="<?php echo $row3["codigo"] ?>" <?php if($_SESSION["region"] == $row3["codigo"]){echo"selected";} ?>  ><?php echo $row3["codigo"]." : ".$row3["nombre"] ?></option>
            <? } ?>
          </select>
        </form>
      </td>
    </tr>
  <?php endif ?>

  <?php 
  if(isset($_POST["aur"]))
  {
    //echo "region->".$_POST["ur"];
    $_SESSION["pfl_user"] = $_POST["aur"];
  }

   ?>
   
  <?php if ($_SESSION["nom_user"] == "SIGEJUN"): ?>
    <tr>
      <td>
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
          <select name="aur" onchange="this.form.submit()" class="Estilo1">
            <option value="">Seleccionar Region</option>
            <option value="3" <?php if($_SESSION["pfl_user"] == 3){echo"selected";} ?>>OFICINA DE PARTES</option>
            <option value="5" <?php if($_SESSION["pfl_user"] == 5){echo"selected";} ?>>CONTABILIDAD</option>*
            <option value="7" <?php if($_SESSION["pfl_user"] == 7){echo"selected";} ?>>SEGUIMIENTO Y CONTROL</option>
            <option value="31" <?php if($_SESSION["pfl_user"] == 31){echo"selected";} ?>>TESORERIA</option>
            </select>
          </form>
        </td>
      </tr>
    <?php endif ?>

</table>
            </td>
          </tr>
          <tr>
            <td width="33" height="2"></td>
            <td width="82"></td>
            <td width="82"></td>
            <td width="82"></td>
            <td width="82"></td>
            <td width="82"></td>
            <td width="82"></td>
            <td width="82"></td>
            <td width="82"></td>
            <td></td>
          </tr>
 </table>
