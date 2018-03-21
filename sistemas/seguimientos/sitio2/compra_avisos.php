<?
session_start();
require("inc/config.php");
require("inc/querys.php");
$nivel = $_SESSION["pfl_user"];
$regionsession = $_SESSION["region"];
if($_SESSION["nom_user"] =="" ){
	?><script language="javascript">location.href='sesion_perdida.php';</script><?
}
$date_in=date("Y-m-d");
$annomio=date("Y");
?>
<html>
<head>
<title>Defensoria</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="css/estilos.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.Estilo1 {
	font-family: Verdana;
	font-weight: bold;
	font-size: 10px;
	color: #003063;
	text-align: left;
}
.Estilo1b {
	font-family: Verdana;
	font-weight: bold;
	font-size: 8px;
	color: #003063;
	text-align: left;
}
.Estilo1c {
	font-family: Verdana;
	font-weight: bold;
	font-size: 8px;
	color: #003063;
	text-align: right;
}
.Estilo2 {
	font-family: Verdana;
	font-size: 10px;
	text-align: left;
}
.Estilo2b {
	font-family: Verdana;
	font-size: 9px;
	text-align: left;
}
.link {
	font-family: Geneva, Arial, Helvetica, sans-serif;
	font-size: 10px;
	font-weight: bold;
	color: #00659C;
	text-decoration:none;
	text-transform:uppercase;
}
.link:over {
	font-family: Geneva, Arial, Helvetica, sans-serif;
	font-size: 10px;
	color: #0000cc;
	text-decoration:none;
	text-transform:uppercase;
}
.Estilo4 {
	font-size: 10px;
	font-weight: bold;
}
.Estilo7 {font-family: Geneva, Arial, Helvetica, sans-serif;
font-size: 14px;
font-weight: bold;}
-->
</style>
<link rel="stylesheet" type="text/css" href="select_dependientes.css">
<script type="text/javascript" src="select_dependientes.js"></script>
<script type="text/javascript" src="ajaxclient.js"></script>
</head>
<!-- calendar stylesheet -->
  <link rel="stylesheet" type="text/css" media="all" href="librerias/calendar-win2k-cold-1.css" title="win2k-cold-1" />

  <!-- main calendar program -->
  <script type="text/javascript" src="librerias/calendar.js"></script>

  <!-- language for the calendar -->
  <script type="text/javascript" src="librerias/lang/calendar-en.js"></script>

  <!-- the following script defines the Calendar.setup helper function, which makes
       adding a calendar a matter of 1 or 2 lines of code. -->
  <script type="text/javascript" src="librerias/calendar-setup.js"></script>

<script>
<!--
function ChequearTodos(chkbox) {
//  alert("aqui "+document.form2.elements.length);
  for (var i=0;i < document.form2.elements.length;i++){
      var elemento = document.form2.elements[i];
//      alert("aqui "+elemento);
      if (elemento.type == "checkbox"){
          elemento.checked = chkbox.checked
      }
  }
}
-->
</script>

<body>
    <div class="navbar-nav ">
    <div class="container">
        <div class="navbar-header">



	  <?
	  require("inc/top.php");
	  ?>

   </div>
</div>
</div>


   <div class="container">
         <div class="row">
          <div class="col-sm-3 col-lg-3">
            <div class="dash-unit2">

		  <?
		  require("inc/menu_1.php");
		  ?>

            </div>
      </div>

        <div class="col-sm-9 col-lg-9">
                    <div class="dash-unit2">

            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="20" colspan="2"><span class="Estilo7">AVISO EJECUCION PLAN DE COMPRA</span></td>
                  </tr>
                       <tr>
                       <td><hr></td><td><hr></td>
                      </tr>
<?
$region=$_GET["region"];
$fecha1=$_GET["fecha1"];
$fecha2=$_GET["fecha2"];
$nombre=$_GET["nombre"];
$ccosto=$_GET["ccosto"];
$uniresp=$_GET["uniresp"];
$programado=$_GET["programado"];
$estado=$_GET["estado"];
$year=$_GET["year"];
if (!isset($year)) {
    $year=$annomio;
}

?>

                          <tr>
                             <td  valign="top" class="Estilo1" colspan="2"><a href="compra_menu.php" class="link" >VOLVER </a>  </td>
                          </tr>


                   <tr>
                    <td height="50" colspan="3">
                    </table>
     <table width="100%" border="0" cellspacing="0" cellpadding="0">
       <form name="form1" action="compra_avisos.php" method="get">
                         <tr>
                             <td  valign="top" class="Estilo1">Región</td>
                             <td class="Estilo1">
                                <select name="region" class="Estilo1">

                                 <?
                                  if ($regionsession==0) {
                                    $sql2 = "Select * from regiones ";
                                    echo '<option value="0">Todas</option>';
                                  } else
                                    $sql2 = "Select * from regiones where codigo=$regionsession";
                                  //echo $sql;
                                  $res2 = mysql_query($sql2);

                                   while($row2 = mysql_fetch_array($res2)){

                                 ?>
                                    <option value="<? echo $row2["codigo"] ?>" <? if ($row2["codigo"]==$region) echo "selected=selected" ?> ><? echo $row2["nombre"] ?></option>

                                 <?
                                   }
                                 ?>


                               </select>


                             </td>
                           </tr>
                            <tr>
                             <td  valign="top" class="Estilo1">Nombre Compra  </td>
                             <td class="Estilo1" colspan=3>
                              <input type="text" name="nombre" class="Estilo2" size="15" value="<? echo $rut ?>">
                             </td>
                           </tr>
                            <tr>
                             <td  valign="top" class="Estilo1">Año </td>
                             <td class="Estilo1" colspan=3>
                               <select name="year" class="Estilo1" >
                                  <option value="">Seleccione...</option>
                                  <option value="2010" <? if ($year==2010) echo "selected=selected" ?> >2010</option>
                                  <option value="2011" <? if ($year==2011) echo "selected=selected" ?> >2011</option>
                                  <option value="2012" <? if ($year==2012) echo "selected=selected" ?> >2012</option>
                                  <option value="2013" <? if ($year==2013) echo "selected=selected" ?> >2013</option>
                                  <option value="2014" <? if ($year==2014) echo "selected=selected" ?> >2014</option>
                                  <option value="2015" <? if ($year==2015) echo "selected=selected" ?> >2015</option>
                                  <option value="2016" <? if ($year==2016) echo "selected=selected" ?> >2016</option>
                                  <option value="2017" <? if ($year==2017) echo "selected=selected" ?> >2017</option>
                                  <option value="2018" <? if ($year==2018) echo "selected=selected" ?> >2018</option>
                                  <option value="2019" <? if ($year==2019) echo "selected=selected" ?> >2019</option>
                                  <option value="2020" <? if ($year==2020) echo "selected=selected" ?> >2020</option>
                                  <option value="2021" <? if ($year==2021) echo "selected=selected" ?> >2021</option>

                               </select>

                             </td>
                           </tr>

                         <tr>
                             <td  valign="center" class="Estilo1">Centro de Costo</td>
                             <td class="Estilo1">
                                <select name="ccosto" class="Estilo1">
                                   <option value="">Seleccione...</option>

                                 <?
//                                    $sql2 = "Select * from compra_subcat  where subcat_cat_id =4";
                                    $sql2 = "Select * from compra_compra where compra_region='$regionsession' group by compra_ccosto";
                                  //echo $sql;
                                  $res2 = mysql_query($sql2);

                                   while($row2 = mysql_fetch_array($res2)){

                                 ?>
                                    <option value="<? echo $row2["compra_ccosto"] ?>"  <? if ($row2["compra_ccosto"]==$ccosto) echo 'selected=selected'  ?> ><? echo $row2["compra_ccosto"] ?></option>

                                 <?
                                   }
                                 ?>


                               </select>


                             </td>
                      </tr>
                         <tr>
                             <td  valign="center" class="Estilo1">Unidad Responsable</td>
                             <td class="Estilo1">
                                <select name="uniresp" class="Estilo1">
                                   <option value="">Seleccione...</option>

                                 <?
//                                    $sql2 = "Select * from compra_subcat  where subcat_cat_id =4";
                                    $sql2 = "Select * from compra_compra  where compra_region='$regionsession' group by compra_depto";
                                  //echo $sql;
                                  $res2 = mysql_query($sql2);

                                   while($row2 = mysql_fetch_array($res2)){

                                 ?>
                                    <option value="<? echo $row2["compra_depto"] ?>" <? if ($row2["compra_depto"]==$uniresp) echo 'selected=selected'  ?>  ><? echo $row2["compra_depto"] ?></option>

                                 <?
                                   }
                                 ?>


                               </select>


                             </td>
                      </tr>
                         <tr>
                             <td  valign="center" class="Estilo1">Mes Programado</td>
                             <td class="Estilo1">
                                <select name="programado" class="Estilo1">
                                   <option value="">Seleccione...</option>

                                 <?
                                    $sql2 = "Select * from compra_subcat  where subcat_cat_id =1";
                                  //echo $sql;
                                  $res2 = mysql_query($sql2);

                                   while($row2 = mysql_fetch_array($res2)){

                                 ?>
                                    <option value="<? echo $row2["subcat_nombre"] ?>" <? if ($row2["subcat_nombre"]==$programado) echo 'selected=selected'  ?> ><? echo $row2["subcat_nombre"] ?></option>

                                 <?
                                   }
                                 ?>


                               </select>


                             </td>
                      </tr>


                         <tr>
                             <td  valign="center" class="Estilo1">Estado</td>
                             <td class="Estilo1">
                                <select name="estado" class="Estilo1">
                                   <option value="">Seleccione...</option>

                                 <?
                                    $sql2 = "Select * from compra_subcat  where subcat_cat_id =7";
                                  //echo $sql;
                                  $res2 = mysql_query($sql2);

                                   while($row2 = mysql_fetch_array($res2)){

                                 ?>
                                    <option value="<? echo $row2["subcat_nombre"] ?>" <? if ($row2["subcat_nombre"]==$estado) echo 'selected=selected'  ?> ><? echo $row2["subcat_nombre"] ?></option>

                                 <?
                                   }
                                 ?>


                               </select>


                             </td>
                      </tr>


                           <tr>
                             <td  valign="center" class="Estilo1" colspan=4 align="center"><input type="submit" name="boton" class="Estilo2" value="  Consultar  "> <a href="compra_avisos.php"> Limpiar </a> </td>
                             

                           </tr>

                        </form>

                      </td>


                       <tr>
                       <td><hr></td><td><hr></td><td><hr></td><td><hr></td>
                      </tr>
                      <tr>
       <form name="form2" action="compra_grabaavisos.php" method="post">
                     <table border=1>
                        <tr>
                          <td class="Estilo1b" colspan=2><input type='checkbox' name='checkbox11' value='checkbox' onClick='ChequearTodos(this);'>TODOS</td>
                          <td  valign="center" class="Estilo1" colspan=4 align="center">Mail<input type="text" name="mail" class="Estilo2" > </td>

                        </tr>
                        <tr>
                          <td  valign="center" class="Estilo1" colspan=4 align="center"><input type="submit" name="boton" class="Estilo2" value="  Enviar  ">  </td>
                        </tr>
                        <tr>
                         <td class="Estilo1b">OP.</td>
                         <td class="Estilo1b">Nº</td>
                         <td class="Estilo1b">Nombre</td>
                         <td class="Estilo1b">Centro Costo</td>
                         <td class="Estilo1b">Fecha</td>
                         <td class="Estilo1b">Monto</td>
                         <td class="Estilo1b">Mes Progra.</td>
                         <td class="Estilo1b">Estado</td>
                         <td class="Estilo1b">Ver </td>
                        </tr>



<?
$sw=0;

   $sql="select * from compra_compra where  ";
if ($region<>"") {
    if ($region==0)
        $sql.=" compra_region<>'' and ";
    else
        $sql.=" compra_region=$region and ";
    $sw=1;
}
if ($fecha1<>"" and $fecha2<>"" ) {
    $sql.=" ( compra_fecha>='$fecha1' and compra_fecha<='$fecha2' ) and ";
    $sw=1;
}
if ($nombre<>"") {
    $sql.=" compra_nombre like '%$nombre%' and ";
    $sw=1;
}
if ($ccosto<>"") {
    $sql.=" compra_ccosto='$ccosto' and ";
    $sw=1;
}
if ($uniresp<>"") {
    $sql.=" compra_depto='$uniresp' and ";
    $sw=1;
}
if ($programado<>"") {
    $sql.=" compra_mes='$programado' and ";
    $sw=1;
}

if ($estado<>"") {
    $sql.=" compra_estado='$estado' and ";
    $sw=1;
}



if ($year<>"") {
    $sql.=" year(compra_fecha)='$year' and ";

}



if ($sw==1){
    $sql.=" 1=1 order by compra_id desc ";
}
if ($sw==0){
    $sql.=" 1=2";
}



//echo $sql;
$res3 = mysql_query($sql);
$cont=1;
$cont1=0;
$sumab=0;
$sumar=0;
$sumal=0;
while($row3 = mysql_fetch_array($res3)){
    if ($row3["eta_tipo_doc"]=="Factura") {
        $archivo="verdoc.php";
    }
    if ($row3["eta_tipo_doc"]=="Honorario") {
        $archivo="verdoc2.php";
    }


$vartipodoc1=$row3["eta_tipo_doc"];
 if ($vartipodoc1=='Factura') {
     $vartipodoc2=$row3["eta_tipo_doc2"];
   if ($vartipodoc2=="f")
     $vartipodoc="Factura";
   if ($vartipodoc2=="b")
     $vartipodoc="Boleta Servicio";
   if ($vartipodoc2=="r")
     $vartipodoc="Recibo";
   if ($vartipodoc2=="n")
     $vartipodoc="N.Credito";
   if ($vartipodoc2=="d")
     $vartipodoc="N.Débito";
 }
 if ($vartipodoc1=='Honorario') {
     $vartipodoc="Honorario";
 }






?>
                      

                       <tr>
                         <td class="Estilo1b"><input alt="ok" type="checkbox" name="var[<? echo $cont ?>]" value="<? echo $row3["compra_id"] ?>" class="Estilo2" ></td>
                         <td class="Estilo1b"><? echo $row3["compra_id"]  ?> </td>
                         <td class="Estilo1b"><? echo $row3["compra_nombre"]  ?> </td>
                         <td class="Estilo1b"><? echo $row3["compra_ccosto"]  ?> </td>
                         <td class="Estilo1b"><? echo substr($row3["compra_fecha"],8,2)."-".substr($row3["compra_fecha"],5,2)."-".substr($row3["compra_fecha"],0,4)   ?></td>
                         <td class="Estilo1c"><? echo number_format($row3["compra_total"],0,',','.')  ?> </td>
                         <td class="Estilo1b"><? echo $row3["compra_mes"]  ?> </td>
                         <td class="Estilo1b"><? echo $row3["compra_estado"]  ?> </td>
                         <td class="Estilo1c"><a href="compra_seguimiento2.php?id=<? echo $row3["compra_id"] ?>" class="link" >VER</a> </td>
                       </tr>

                        



<?

   $sumab=$sumab+$row3["hono_bruto"];
   $sumar=$sumar+$row3["hono_retencion"];
   $sumal=$sumal+$row3["hono_liquido"] ;
   $cont++;
   $cont1++;
}
?>
   <input type="hidden" name="cont" value="<? echo $cont ?>" >
</form>

                       <tr>
                         <td class="Estilo1b"> </td>
                         <td class="Estilo1b"> </td>
                         <td class="Estilo1b"> </td>
                         
                        </tr>
                        </td>
                      </tr>
                      <tr>





</td>
  </tr>

 
</table>

<img src="images/pix.gif" width="1" height="10">
</body>
</html>

<?
//require("inc/func.php");
?>
