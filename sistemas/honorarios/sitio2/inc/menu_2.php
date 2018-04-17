<?
$niv_m = $_SESSION["pfl_user"];
$nivel = $_SESSION["pfl_user"];

if (isset($_GET["cod"])) {
//  echo "existe";
//  $_SESSION["cod"]=$_GET["cod"];
  if (!(isset($_SESSION["cod"]))) {
     $_SESSION["cod"]=1;
  }

  if ($_SESSION["cod"]<>$_GET["cod"])
      $_SESSION["cod"]=$_GET["cod"];

} else {
  //echo "no existe";

}
  
if($_SESSION["nom_user"] =="" ){
	?><script language="javascript">location.href='../index.php';</script><?
}
$cod=$_SESSION["cod"];
require("inc/config.php");

/*

if ($nivel==1) {
 $wheresql="atributo1=1";
}
if ($nivel==2) {
 $wheresql="atributo2=1";
}
if ($nivel==3) {
 $wheresql="atributo3=1";
}
if ($nivel==4) {
 $wheresql="atributo4=1";
}
if ($nivel==5) {
 $wheresql="atributo5=1";
}
if ($nivel==6) {
 $wheresql="atributo6=1";
}
if ($nivel==7) {
 $wheresql="atributo7=1";
}
if ($nivel==8) {
 $wheresql="atributo8=1";
}
*/
$sql = "Select * from menu2 where cod=$cod order by num";
//echo $sql;
$res = mysql_query($sql);
?>
<style type="text/css">
<!--
.Estilo2 {	font-family: Verdana;
	font-size: 10px;
	text-align: left;

}
-->
</style>
<table width="163" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="270" height="64" align="center" valign="top" background="images/izq1.gif"><table width="125" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td><img src="images/pix.gif" width="1" height="15"></td>
                  </tr>
                  <tr>
                    <td class="Estilo1">Logeado como : </td>
                  </tr>
                  <tr>
                    <td class="Estilo2"><? echo $_SESSION["nom_user"].",".$_SESSION["company"]; ?> </td>
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
              <td height="115" align="center" valign="top" ><table width="125" border="0" cellspacing="0" cellpadding="0">
                <!--DWLayoutTable-->

                  <tr>
                <td align="center" background="images/medio.jpg"><table width="125" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                 <tr>
                    <td class="Estilo1">Secciones : </td>
                  </tr>

                  <?
                      while($row = mysql_fetch_array($res)){
                  ?>
                  <tr>
                    <td class="Estilo2">

					<a href="<? echo  $row["url"] ?>" class="link">
                    <? echo $row["nombre"] ?>
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
                    <td class="Estilo1"><a href="inicio.php" class="link">Menu Principal</a></td>
                  </tr>

                  <tr>
                    <td><img src="images/pix.gif" width="1" height="10"></td>
                  </tr>
              </table></td>
            </tr>


            </tr>
          </table>

