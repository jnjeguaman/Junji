





<meta name="viewport" content="width=500, initial-scale=1">



<link rel="stylesheet" href="css/bootstrap.min.css"  >



<?

$niv_m = $_SESSION["pfl_user"];

$nivel = $_SESSION["pfl_user"];

//$regionsession = $_SESSION["region"];

if($_SESSION["nom_user"] =="" ){

	?><script language="javascript">location.href='../index.php';</script><?

}

require("inc/config.php");



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

if ($nivel==9) {

 $wheresql="atributo9=1";

}

if ($nivel==10) {

 $wheresql="atributo10=1";

}

if ($nivel==11) {

 $wheresql="atributo11=1";

}

if ($nivel==12) {

 $wheresql="atributo12=1";

}

if ($nivel==13) {

 $wheresql="atributo13=1";

}

if ($nivel==14) {

 $wheresql="atributo14=1";

}

if ($nivel==15) {

 $wheresql="atributo15=1";

}

if ($nivel==16) {

 $wheresql="atributo16=1";

}

if ($nivel==17) {

 $wheresql="atributo17=1";

}

if ($nivel==18) {

 $wheresql="atributo18=1";

}

if ($nivel==19) {

 $wheresql="atributo19=1";

}

if ($nivel==20) {

 $wheresql="atributo20=1";

}

if ($nivel==21) {

 $wheresql="atributo21=1";

}

if ($nivel==22) {

 $wheresql="atributo22=1";

}

if ($nivel==23) {

 $wheresql="atributo23=1";

}

$sql = "Select * from menu where $wheresql  and estado=1 order by num";

$res = mysql_query($sql);

?>





              <table width="100%" border="0" cellspacing="0" cellpadding="0">

                  <tr>

                    <td><img src="images/pix.gif" width="1" height="15"></td>

                  </tr>

                  <tr>

                    <td class="Estilo1">Usuario : <? echo $_SESSION["nom_user"] ?>,</td>

                  </tr>

                  <tr>

                    <td class="Estilo2"><? echo $_SESSION["regionnom"]; ?> </td>

                  </tr>

                  <tr>

                    <td><img src="images/pix.gif" width="1" height="10"></td>

                  </tr>

              </table>





                <table width="100%" border="0" cellspacing="0" cellpadding="0">

                  <tr>

                 <tr>

                    <td class="Estilo1">Secciones : </td>

                  </tr>

                  <tr>

                    <td class="Estilo2">

                    <ul class="nav navbar-nav navbar-left">

                  <?

                      while($row = mysql_fetch_array($res)){

                  ?>

<?

   $nummenu=$row["num"];

//   echo $nummenu." ".$regionsession;

?>





					<li><a href="<? echo  $row["url"] ?>?cod=<? echo  $row["num"] ?>">

                    <? echo $row["nombre"] ?>

					</a></li> <br>





                  



                  <?

                    }

                  ?>

                  					</td>



                  </tr>

              </table>



         <table width="100%" border="0" cellspacing="0" cellpadding="0">

                  <tr>

                    <td><img src="images/pix.gif" width="1" height="15"></td>

                  </tr>

                  <tr>

                    <td class="Estilo1"><a href="salir.php" class="link">Salir Sistema</a></td>

                  </tr>



                  <tr>

                    <td><img src="images/pix.gif" width="1" height="10"></td>

                  </tr>

              </table>





