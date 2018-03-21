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
.Estilo1d {
	font-family: Verdana;
	font-weight: bold;
	font-size: 8px;
	color: #003063;
	text-align: center;
}
.Estilo1cverde {
	font-family: Verdana;
	font-weight: bold;
	font-size: 8px;
	color: #009900;
	text-align: center;
}
.Estilo1camarrillo {
	font-family: Verdana;
	font-weight: bold;
	font-size: 8px;
	color: #CCCC00;
	text-align: right;
}
.Estilo1crojo {
	font-family: Verdana;
	font-weight: bold;
	font-size: 8px;
	color: #CC0000;
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
font-size: 14px; font-weight: bold; }
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
  
<SCRIPT LANGUAGE ="JavaScript">


function ChequearTodos(chkbox)
{
  for (var i=0;i < document.forms[0].elements.length;i++){
      var elemento = document.forms[0].elements[i];
      if (elemento.type == "checkbox"){
          elemento.checked = chkbox.checked
      }
  }
}
function muestra() {
     if (document.form1.uno.value == 2) {
       seccion1.style.display="";
     } else {
       seccion1.style.display="none";
     }
}
function valida() {
   if (document.form1.uno.value==0 || document.form1.uno.value=='') {
      alert ("No ha seleccionado una Accion ");
      return false;
  }
   if (document.form1.uno.value==2 && document.form1.justifica.value=='') {
      alert ("No ha Justificado ");
      return false;
  }
}
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
          <div class="col-sm-2 col-lg-2">
            <div class="dash-unit2">

		  <?
		  require("inc/menu_1.php");
		  ?>

            </div>
      </div>

        <div class="col-sm-10 col-lg-10">
                    <div class="dash-unit2">

            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="20" colspan="2"><span class="Estilo7">4. EJECUCIÓN DE CONTRATOS  </span></td>
                  </tr>
                      <tr>
                         <td width="487" valign="top" class="Estilo1">
                       <a href="menucontratos.php" class="link">VOLVER</a> <br>
                      </tr>



			<tr>
                       <td><hr></td><td><hr></td>
                      </tr>
                 <tr>
                    <td height="20" colspan="2"><span class="Estilo2">BÚSQUEDA DE CONTRATO:  </span></td>
                  </tr>




<?

$fecha1=$_GET["fecha1"];
$fecha2=$_GET["fecha2"];
$region2=$_GET["region"];
//echo "--->".$region2;
$rut=$_GET["rut"];
$item=$_GET["item"];
$tipo=$_GET["tipo"];
$estado=$_GET["estado"];
if (!(isset($_GET["estado"]))) {
    $estado=2;
}
if (!(isset($_GET["region"]))) {
    $region=$regionsession;
} else {
    $region=$_GET["region"];
}
$consolidado=$_GET["consolidado"];


if ($nivel==23) {
  $regionsession = $region2;
} else {
   $regionsession = $_SESSION["region"];
}

?>



                   <tr>
                    <td height="50" colspan="3">


     <table width="488" border="0" cellspacing="0" cellpadding="0">
       <form name="form1" action="valida8c.php" method="get">
                         <tr>
                             <td  valign="top" class="Estilo1">Región</td>
                             <td class="Estilo1">
                                <select name="region" class="Estilo1">

                                 <?
                                  if ($regionsession==150 or $nivel==23) {
                                    $sql2 = "Select * from regiones where codigo<20 ";
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
                             <td  valign="center" class="Estilo1">Fechas </td>
                             <td colspan=3 class="Estilo1">
                                  <input type="text" name="fecha1" class="Estilo2" size="12" value="<? echo $fecha1 ?>" id="f_date_c2" readonly="1">
<img src="calendario.gif" id="f_trigger_c2" style="cursor: pointer; border: 1px solid red;" title="Date selector"
      onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />

 <script type="text/javascript">
    Calendar.setup({
        inputField     :    "f_date_c2",     // id of the input field
        ifFormat       :    "%Y-%m-%d",      // format of the input field
        button         :    "f_trigger_c2",  // trigger for the calendar (button ID)
        align          :    "Tl",           // alignment (defaults to "Bl")
        singleClick    :    true
    });
</script>

                                  a
                                  <input type="text" name="fecha2" class="Estilo2" size="12" value="<? echo $fecha1 ?>" id="f_date_c3" readonly="1">
<img src="calendario.gif" id="f_trigger_c3" style="cursor: pointer; border: 1px solid red;" title="Date selector"
      onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />

 <script type="text/javascript">
    Calendar.setup({
        inputField     :    "f_date_c3",     // id of the input field
        ifFormat       :    "%Y-%m-%d",      // format of the input field
        button         :    "f_trigger_c3",  // trigger for the calendar (button ID)
        align          :    "Tl",           // alignment (defaults to "Bl")
        singleClick    :    true
    });
</script>

                              </td>

                           </tr>
                            <tr>
                             <td  valign="top" class="Estilo1">Rut  </td>
                             <td class="Estilo1" colspan=3>
                              <input type="text" name="rut" class="Estilo2" size="11" value="<? echo $rut ?>">
                             </td>
                           </tr>

                         <tr>
                             <td  valign="top" class="Estilo1">Tipo</td>
                             <td class="Estilo1">
                                <select name="tipo" class="Estilo1">

                                 <?
                                    $sql2 = "Select * from contrato order by opcion asc";
                                    echo '<option value="">Todas</option>';
                                  //echo $sql;
                                  $res2 = mysql_query($sql2);

                                   while($row2 = mysql_fetch_array($res2)){

                                 ?>
                                    <option value="<? echo $row2["id"] ?>" <? if ($row2["id"]==$tipo) echo "selected=selected" ?> ><? echo $row2["opcion"] ?></option>

                                 <?
                                   }
                                 ?>


                               </select>


                             </td>
                           </tr>


                            <tr>
                             <td  valign="center" class="Estilo1">ESTADO DEL CONTRATO</td>
                             <td class="Estilo1" colspan=4>
                              <input type="radio" name="estado" class="Estilo2" value="2" <? if($estado=='2') echo 'checked' ?>>VIGENTES<br>
                             <input type="radio" name="estado" class="Estilo2" value="10" <? if($estado=='10') echo 'checked' ?> >PRE-CERRADOS<br>
                              <input type="radio" name="estado" class="Estilo2" value="3" <? if($estado=='3') echo 'checked' ?> >CERRADOS<br>
                             </td>
                           </tr>

                           <tr>
                             <td  valign="center" class="Estilo1" colspan=4 align="center"><input type="submit" name="boton" class="Estilo2" value="  Consultar  "> <a href="valida8c.php"> Limpiar </a> </td>


                           </tr>

                        </form>

                      </td>


                       <tr>
                       <td><hr></td><td><hr></td><td><hr></td><td><hr></td>
                      </tr>
                      <tr>
                      </form>
                      
                      <tr>
                      <td>
                       <a href="valida8cexcel.php?region=<? echo $region ?>&fecha=<? echo $fecha1 ?>&fecha=<? echo $fecha2 ?>&rut=<? echo $rut ?>&tipo=<? echo $tipo ?>&estado=<? echo $estado ?>" class="link" target="_blank">Exportar a Excel</a> <br>
                       </td>
                       </tr>
                     <form name="form1" action="grabavalida8c.php" method="post">
                      <table border=1 class="table table-striped">
                           


                        <tr>
                         <td class="Estilo1d">Nº</td>
                         <td class="Estilo1d">Tipo</td>
                         <td class="Estilo1d">Rut Proveedor</td>
                         <td class="Estilo1d">Nombre Proveedor</td>
                         <td class="Estilo1d">Fecha Vence.</td>
 			 <td class="Estilo1d">Res. Ex.</td>
			 <td class="Estilo1d">Descripción Servicio</td>
                         <td class="Estilo1d">Monto Contratado</td>
                         <td class="Estilo1d">Tipo Moneda</td>
                         <td class="Estilo1d">Monto Ejecutado (Acumulado)</td>
                         <td class="Estilo1d">% Ejec.(Acum)</td>
                         <td class="Estilo1d">VER </td>
                        </tr>

<?

//   $sql5="select * from dpp_contratos where cont_estado=1 order by cont_nombre asc";
$sql5="select * from dpp_plazos_cont ";
//echo $sql;
$res5 = mysql_query($sql5);
$row5 = mysql_fetch_array($res5);
$etapa1a=$row5["placont_fecha1"];
$etapa1b=$row5["placont_fecha2"];
$etapa2a=$row5["placont_monto1"];
$etapa2b=$row5["placont_monto2"];

//$sql="select * from dpp_contratos where cont_estado=1";

$sw=0;

   $sql="select * from dpp_contratos where  ";
if ($region<>"") {
    if ($region==0)
        $sql.=" cont_region<>'' and ";
    else
        $sql.=" cont_region=$region and ";
    $sw=1;
}
if ($fecha1<>"" and $fecha2<>"" ) {
    $sql.=" ( cont_recepcion>='$fecha1' and cont_recepcion<='$fecha2' ) and ";
    $sw=1;
}
if ($rut<>"") {
    $sql.=" cont_rut like '%$rut%' and ";
    $sw=1;
}
if ($tipo<>"") {
    $sql.=" cont_contrato='$tipo' and ";
    $sw=1;
}

if ($estado<>"") {
    $sql.=" cont_estado='$estado' and ";
    $sw=1;
}



if ($sw==1){
    $sql.="  1=1 order by cont_nombre ";
}
if ($sw==0){
    $sql.="  1=2";
}

//echo $sql;
$res3 = mysql_query($sql);
$cont=1;

while($row3 = mysql_fetch_array($res3)){

    $fechahoy = $date_in;
    $dia1 = strtotime($fechahoy);
    $fechabase =$row3["cont_vence"];
    $dia2 = strtotime($fechabase);
    $diff=$dia1-$dia2;
    $diff=intval($diff/(60*60*24))*-1;
    $clase="Estilo1c";
    if ($etapa1a>$diff and $diff>$etapa1b)
      $clase="Estilo1cverde";
    if ( $etapa1b>=$diff )
      $clase="Estilo1crojo";
      

    if ($estado==2) {
     $archivo="vercontrato8.php";
    }
    if ($estado==3) {
     $archivo="vercontrato8b.php";
     }

     $archivo2="vercontrato3.php";
     $cont_id=$row3["cont_id"];
     $facturatotal=0;
     $contratototalNC=0;
     $sql22 = "Select (eta_id) as eta_id,sum(fac_monto) as facturamonto, sum(fac_montotipo) as facturauf, sum(fac_montotipo2) as facturautm, sum(fac_montotipo3) as facturadolar, sum(cont_ejec2010) as cont_ejec2010, sum(w.eta_monto2) as monto2, (w.eta_tipo_doc2) as tipodocumento from dpp_contratos x, dpp_cont_fac y, dpp_facturas z, dpp_etapas w where x.cont_id=$cont_id  and  x.cont_id=y.confa_cont_id and y.confa_fac_id=fac_id and z.fac_estado<10 and z.fac_eta_id=w.eta_id and w.eta_estado=8 and  (w.eta_tipo_doc3='NC' or w.eta_tipo_doc3='NCEL')  group by y.confa_cont_id order by x.cont_id desc ";
//     echo $sql22."<br>";
     $res22=mysql_query($sql22);
     $row22 = mysql_fetch_array($res22);
     $contratototalNC=$row22["monto2"];
     
     $sql22 = "Select (eta_id) as eta_id,sum(fac_monto) as facturamonto, sum(fac_montotipo) as facturauf, sum(fac_montotipo2) as facturautm, sum(fac_montotipo3) as facturadolar, sum(cont_ejec2010) as cont_ejec2010, sum(w.eta_monto2) as monto2, (w.eta_tipo_doc2) as tipodocumento from dpp_contratos x, dpp_cont_fac y, dpp_facturas z, dpp_etapas w where x.cont_id=$cont_id  and  x.cont_id=y.confa_cont_id and y.confa_fac_id=fac_id and z.fac_estado<10 and z.fac_eta_id=w.eta_id and w.eta_estado=8 and  (w.eta_tipo_doc3<>'NC' and w.eta_tipo_doc3<>'NCEL')  group by y.confa_cont_id order by x.cont_id desc ";
//     echo $sql22."<br>";
     $res22=mysql_query($sql22);
     $row22 = mysql_fetch_array($res22);
     $contratototal=$row3["cont_total"];

//     $ejec2010=$row3["cont_ejec2010"];
//     $ejec2010=$row22["cont_ejec2010"];
//     $facturamonto=$row22["facturamonto"];
     $facturamonto=$row22["monto2"];
     $contid2=$row3["cont_id"];
//     echo "---#$contid2-->".$facturamonto;
     $tipodoc=1;

   $tipodocumento=$row22["tipodocumento"];
// esto es para honorarios
//echo "--->".$tipodocumento;
     if (($facturamonto=='' or $tipodocumento=='BH' or $tipodocumento=='bh' or $tipodocumento=='b') and 1==2) {
         $sql22 = "SELECT sum( w.eta_monto2 )AS facturamonto, (0) AS facturauf, (0)AS facturautm, (0) AS cont_ejec2010, sum( w.eta_monto2 )AS monto2
FROM dpp_contratos x, dpp_cont_fac y, dpp_etapas w
WHERE x.cont_id =$contid2
AND x.cont_id = y.confa_cont_id
AND y.confa_eta_id = w.eta_id and w.eta_estado=8 and  (w.eta_tipo_doc3<>'NC' and w.eta_tipo_doc3<>'NCEL')
GROUP BY y.confa_cont_id
ORDER BY x.cont_nombre DESC";
/*
         $sql22 = "SELECT sum( w.eta_monto2 )AS facturamonto, (0) AS facturauf, (0)AS facturautm, (0) AS cont_ejec2010, sum( w.eta_monto2 )AS monto2
FROM dpp_contratos x, dpp_cont_fac y, dpp_honorarios z, dpp_etapas w
WHERE x.cont_id =$contid2
AND x.cont_id = y.confa_cont_id
AND y.confa_fac_id = hono_id
AND z.hono_estado <10
AND z.hono_eta_id = w.eta_id and w.eta_estado=8
GROUP BY y.confa_cont_id
ORDER BY x.cont_id DESC";
*/
//         $sql22 = "Select sum(hono_retencion) as facturamonto, sum(hono_montotipo) as facturauf, sum(hono_montotipo2) as facturautm, sum(hono_montotipo3) as facturadolar, sum(cont_ejec2010) as cont_ejec2010, sum(w.eta_monto) as monto2 from dpp_contratos x, dpp_cont_fac y, dpp_honorarios z, dpp_etapas w where x.cont_id=$cont_id  and  x.cont_id=y.confa_cont_id and y.confa_fac_id=fac_id and z.fac_estado<10 and z.fac_eta_id=w.eta_id  group by y.confa_cont_id order by x.cont_id desc ";
        echo $sql22."<br>";
//        exit();
         $res22=mysql_query($sql22);
         $row22 = mysql_fetch_array($res22);
         $facturamonto=$row22["monto2"];
//         echo "<br>$etaid2<---".$facturamonto;
// para honorario 2 y facturas 1
//     $tipodoc=2;
     $tipodoc=2;
     $tipomoneda2=1;
     }
     $facturauf=$row22["facturauf"];
     $facturautm=$row22["facturautm"];
     $facturadolar=$row22["facturadolar"];
     $valoruf=$row22["valoruf"];
     
     $tipomoneda2=$row3["cont_tipo2"];
//     echo "$facturamonto , $facturauf, $facturautm, $tipomoneda2  <br>  ";
     if ($tipomoneda2==1) {
       $facturatotal=$facturamonto-$contratototalNC;

     }
     if ($tipomoneda2==2) {
       $facturatotal=$facturadolar;

     }

     if ($tipomoneda2==3) {
       $facturatotal=$facturautm;
//       echo "-------> $facturatotal";
     }
     
     
     if ($tipomoneda2==4) {
       $facturatotal=$facturauf;
       $valoruf2=$valoruf2+$row22["valoruf"];
       $facturauf2=$facturauf2+$facturauf;
       
     }
       
       $facturatotal=$facturatotal+$ejec2010;
       $porcentaje=$facturatotal*100/$contratototal;


    $clase2="Estilo1c";
    if ( $porcentaje>=90 )
      $clase2="Estilo1crojo";

       
     $sql23 = "Select * from dpp_monedas where mone_id=$tipomoneda2";
     $res23 = mysql_query($sql23);
     $row23 = mysql_fetch_array($res23);
     $nombremoneda23=$row23["mone_tipo"];
     $nombrecontrato2="";
     $contrato=$row3["cont_contrato"];
     $sql23 = "Select * from contrato where id=$contrato";
     $res23 = mysql_query($sql23);
     $row23 = mysql_fetch_array($res23);
     $nombrecontrato2=$row23["opcion"];
     if ($nombrecontrato2=='') {
         $nombrecontrato2=$row3["cont_contrato"];
     }


?>
                      

                       <tr>
                         <td class="Estilo1b"><? echo $cont  ?> </td>
                         <td class="Estilo1b"><? echo $nombrecontrato2;  ?> </td>
                         <td class="Estilo1b"><? echo $row3["cont_rut"]  ?>-<? echo $row3["cont_dig"]  ?> </td>
                         <td class="Estilo1b"><? echo $row3["cont_nombre"]  ?> </td>
                         <td class="<? echo $clase ?>" ><? echo substr($row3["cont_vence"],8,2)."-".substr($row3["cont_vence"],5,2)."-".substr($row3["cont_vence"],0,4)   ?></td>
                      	 <td class="Estilo1c"><? echo $row3["cont_nroresolucion"]  ?> </td>

       		             <td class="Estilo1b"><? echo $row3["cont_nombre1"]  ?> </td>
 			             <td class="Estilo1c"><? echo number_format($row3["cont_total"],0,',','.')  ?> </td>
                     	 <td class="Estilo1c"><? echo $nombremoneda23  ?> </td>
                         <td class="Estilo1c"><? echo number_format($facturatotal,0,',','.')  ?></td>
                      	 <td class="<? echo $clase2 ?>"><? echo number_format($porcentaje,0,',','.')  ?>%</td>
<!--                         <td class="Estilo1c"><a href="<? echo $archivo ?>?id2=<? echo $row3["cont_id"] ?>&fecha1=<? echo $fecha1 ?>&fecha2=<? echo $fecha2 ?>&rut=<? echo $rut ?>&region2=<? echo $region ?>" class="link" >VER</a> </td> -->
                         <td class="Estilo1c"><a href="vercontrato82.php?id=<? echo $row3["cont_id"] ?>&tipodoc=<? echo $tipodoc; ?>&region2=<? echo $region ?>" class="link" >VER2</a> </td>
                       </tr>

                        



<?

   $cont++;

}
?>


                      <tr>

                               <input type="hidden" name="cont" value="<? echo $cont ?>" >
                           </form>


</td>
  </tr>

 
</table>

<img src="images/pix.gif" width="1" height="10">
</body>
</html>

<?
//require("inc/func.php");
?>
