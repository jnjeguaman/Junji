<?
$niv_m = $_SESSION["pfl_user"];
$nivel = $_SESSION["pfl_user"];

if($_SESSION["nom_user"] =="" and 1==2){
	?><script language="javascript">location.href='../index.php';</script><?
}
require("inc/config.php");


$sql = "Select * from segdoc_menu where menu_perfil".$nivel."=1 order by menu_orden ";
//echo $sql;
$res = mysql_query($sql);
?>
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<table width="163" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="290" height="64" align="center" valign="top" background="images/izq1.gif">
              <table width="135" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td><img src="images/pix.gif" width="1" height="15"></td>
                  </tr>
                  <tr>
                    <td class="Estilo1">Usuario : <? echo $_SESSION["nom_user"] ?>,</td>
                  </tr>
                  <tr>
                    <td class="Estilo2"><? echo $_SESSION["regionnom"]; ?>, <? echo $_SESSION["uninombresession"] ?> </td>
                  </tr>
                  <tr>
                    <td><img src="images/pix.gif" width="1" height="10"></td>
                  </tr>
              </table></td>
            </tr>
            <tr>
               <tr>
                <td><img src="images/sup.jpg" ></td>
                  </tr>
              <td height="145" align="center" valign="top" ><table width="125" border="0" cellspacing="0" cellpadding="0">
                <!--DWLayoutTable-->

                  <tr>
                <td align="center" background="images/medio.jpg">
                <table width="145" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                 <tr>
                    <td class="Estilo1">Secciones : </td>
                  </tr>

                  <?
                      while($row = mysql_fetch_array($res)){
                  ?>
                  <tr>
                    <td class="Estilo2">

					<a href="<? echo  $row["menu_url"] ?>?cod=<? echo  $row["menu_id"] ?>" class="link"> <!-- linkmenu -->
                    <? echo $row["menu_nombre"] ?>
					</a>
					</td>

                  </tr>

                  

                  <?
                    }
                  ?>
              </table></td>
             <tr>
              <td><img src="images/inf.jpg" ></td>
            </tr>
            </table>
            <tr>
              <td width="270" height="64" align="center" valign="top" background="images/izq1.gif"><table width="125" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td><img src="images/pix.gif" width="1" height="15"></td>
                  </tr>
                  <tr>
                    <td class="Estilo1"><a href="salir.php" class="link">Salir Sistema</a></td>
                  </tr>

                  <tr>
                    <td><img src="images/pix.gif" width="1" height="10"></td>
                  </tr>
              </table></td>
            </tr>


            </tr>
          </table>

