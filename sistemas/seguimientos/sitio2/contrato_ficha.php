<?
session_start();
require("inc/config.php");
require("inc/querys.php");
$nivel = $_SESSION["pfl_user"];
extract($_POST);
extract($_GET);
if ($nivel==23) {
  $regionsession = $region2;
} else {
   $regionsession = $_SESSION["region"];
}
$usuario=$_SESSION["nom_user"];
$regnombre=$_SESSION["regionnom"];
if($_SESSION["nom_user"] =="" ){
	?><script language="javascript">location.href='sesion_perdida.php';</script><?
}
$date_in=date("d-m-Y");
$year=date("Y");
$year2=date("Y");


$sql="select * from dpp_contratos where cont_id=$id";
//echo $sql;
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$evaluara=$row["cont_evaluara"];
$ejec2010=$row["cont_ejec2010"];
?>
<script type="text/javascript" src="jquery/jquery-1.6.4.js"></script>

<script language="JavaScript" type="text/javascript" src="ajax5.js"></script>


<script type="text/javascript">
 //<![CDATA[
$(window).load(function(){
$('tr').bind('mouseover mouseout', function() {
    $(this).toggleClass("hover");
});
$('tr').bind('click', function() {
    $(this).toggleClass("active");

    if (event.target.type !== 'checkbox') {
        $(this).find("input[type=checkbox]").prop("checked", (!$(this).find("input[type=checkbox]").prop("checked")) );
    }
});
});//]]>

</script>
<style type="text/css">
<!--

tr td {
    background:#D8D8D8;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
	font-weight: normal;
}
tr.hover td {
    background: orange;
}
tr.active td {
    background: lightgreen;
}

.Estilo1 {
	font-family: Verdana;
	font-weight: bold;
	font-size: 10px;
	color: #003063;
	text-align: left;
}
.Estilo1d {
	font-family: Verdana;
	font-weight: bold;
	font-size: 10px;
	color: #003063;
	text-align: right !important;;
}
-->
</style>

					<table width="485" border="0" cellspacing="0" cellpadding="0">

                           <tr>
                             <td  valign="center" class="Estilo1"  width="120">Nombre Empresa </td>
                             <td class="Estilo1" colspan=3 >
                                 <? echo $row["cont_nombre"]; ?>
                             </td>
                           </tr>
                            <tr>
                             <td  valign="center" class="Estilo1">Rut Empresa  </td>
                             <td class="Estilo1" colspan=3>
                                 <? echo $row["cont_rut"]."-".$row["cont_dig"]; ?>
                             </td>
                           </tr>
                           <tr>
                             <td  valign="center" class="Estilo1">Nombre Contrato </td>
                             <td class="Estilo1" colspan=3>
                                 <? echo $row["cont_nombre1"]; ?>
                             </td>
                           </tr>
<?
$fechainicio=$row["cont_fechainicio"];
$fechavence=$row["cont_vence"];
$fechainicio=substr($fechainicio,8,2)."-".substr($fechainicio,5,2)."-".substr($fechainicio,0,4);
$fechavence=substr($fechavence,8,2)."-".substr($fechavence,5,2)."-".substr($fechavence,0,4);

?>
                         <tr>
                             <td  valign="center" class="Estilo1">Fecha Inicio </td>
                             <td class="Estilo1" valign="center">
                                 <? echo $fechainicio; ?>                             </td>
                           </tr>


                         <tr>
                             <td  valign="center" class="Estilo1">Fecha Vencimiento</td>
                             <td class="Estilo1" valign="center">
                                 <? echo $fechavence; ?>                             </td>
                           </tr>
<?
$tipomoneda2=$row["cont_tipo2"];
$sql2 = "Select * from dpp_monedas where mone_id=$tipomoneda2";
$res2 = mysql_query($sql2);
$row2 = mysql_fetch_array($res2);
$nombremoneda2=$row2["mone_tipo"];
$montoejecutado22=$row["cont_total"];

?>

                           <tr>
                             <td  valign="center" class="Estilo1">Monto total </td>
                             <td class="Estilo1" colspan=3>
                                 <? echo number_format($row["cont_total"],0,",","."); ?> <? echo $nombremoneda2; ?>
                             </td>
                           </tr>



                         <tr>
                             <td  valign="center" class="Estilo1">Regi&oacute;n</td>
                             <td class="Estilo1"  width="250">
                                 <? echo $row["cont_region"]; ?>
                             </td>
                           </tr>
<?
    $fechahoy = $date_in;
    $dia1 = strtotime($fechahoy);
    $fechabase =$row3["eta_fecha_recepcion"];
    $dia2 = strtotime($fechabase);
    $diff=$dia1-$dia2;
    $diff=intval($diff/(60*60*24));

    $fechainicio=$row["cont_fechainicio"];
$annoactual=date ("Y");
$fechauno=$fechainicio;

$fecha_de_nacimiento = $row["cont_fechainicio"];
$fecha_actual = date ("Y-m-d");
//$fecha_actual = date ("2006-03-05"); //para pruebas



// separamos en partes las fechas
$array_nacimiento = explode ( "-", $fecha_de_nacimiento );
$array_actual = explode ( "-", $fecha_actual );

$anos =  $array_actual[0] - $array_nacimiento[0]; // calculamos años
$meses = $array_actual[1] - $array_nacimiento[1]; // calculamos meses
$dias =  $array_actual[2] - $array_nacimiento[2]; // calculamos días

//ajuste de posible negativo en $días
if ($dias < 0)
{
    --$meses;

    //ahora hay que sumar a $dias los dias que tiene el mes anterior de la fecha actual
    switch ($array_actual[1]) {
           case 1:     $dias_mes_anterior=31; break;
           case 2:     $dias_mes_anterior=31; break;
           case 3:
                if (bisiesto($array_actual[0]))
                {
                    $dias_mes_anterior=29; break;
                } else {
                    $dias_mes_anterior=28; break;
                }
           case 4:     $dias_mes_anterior=31; break;
           case 5:     $dias_mes_anterior=30; break;
           case 6:     $dias_mes_anterior=31; break;
           case 7:     $dias_mes_anterior=30; break;
           case 8:     $dias_mes_anterior=31; break;
           case 9:     $dias_mes_anterior=31; break;
           case 10:     $dias_mes_anterior=30; break;
           case 11:     $dias_mes_anterior=31; break;
           case 12:     $dias_mes_anterior=30; break;
    }

    $dias=$dias + $dias_mes_anterior;
}

//ajuste de posible negativo en $meses
if ($meses < 0)
{
    --$anos;
    $meses=$meses + 12;
}

//echo "<br>Tu edad es: $anos años con $meses meses y $dias días";

function bisiesto($anio_actual){
    $bisiesto=false;
    //probamos si el mes de febrero del año actual tiene 29 días
      if (checkdate(2,29,$anio_actual))
      {
        $bisiesto=true;
    }
    return $bisiesto;
}

$anual=$row["cont_anual"];
$cuotas=$anual/12;
$tmeses=$cuotas*$meses;

$anos2=$anos;
$meses2=$meses;
$dias2=$dias;
?>


                           <tr>
                             <td  valign="center" class="Estilo1">Antiguedad </td>
                             <td class="Estilo1" colspan=3>
                                 <? echo " $anos año - $meses mes " ?>
                             </td>
                           </tr>
<?
$tipomoneda1=$row["cont_tipo1"];
$sql2 = "Select * from dpp_monedas where mone_id=$tipomoneda1";
//echo $sql2;
$res2 = mysql_query($sql2);
$row2 = mysql_fetch_array($res2);
$nombremoneda1=$row2["mone_tipo"];


$tipomoneda3=$row["cont_tipo3"];
$sql2 = "Select * from dpp_monedas where mone_id=$tipomoneda3";
$res2 = mysql_query($sql2);
$row2 = mysql_fetch_array($res2);
$nombremoneda3=$row2["mone_tipo"];




?>




<?
//-------------- calculo del los meses de este año
$annoactual=date ("Y");
$fechauno="$annoactual-01-01";


$fecha_de_nacimiento = $fechauno;
$fecha_actual = date ("Y-m-d");
//$fecha_actual = date ("2006-03-05"); //para pruebas



// separamos en partes las fechas
$array_nacimiento = explode ( "-", $fecha_de_nacimiento );
$array_actual = explode ( "-", $fecha_actual );

$anos =  $array_actual[0] - $array_nacimiento[0]; // calculamos años
$meses = $array_actual[1] - $array_nacimiento[1]; // calculamos meses
$dias =  $array_actual[2] - $array_nacimiento[2]; // calculamos días

//ajuste de posible negativo en $días
if ($dias < 0)
{
    --$meses;

    //ahora hay que sumar a $dias los dias que tiene el mes anterior de la fecha actual
    switch ($array_actual[1]) {
           case 1:     $dias_mes_anterior=31; break;
           case 2:     $dias_mes_anterior=31; break;
           case 3:
                if (bisiesto($array_actual[0]))
                {
                    $dias_mes_anterior=29; break;
                } else {
                    $dias_mes_anterior=28; break;
                }
           case 4:     $dias_mes_anterior=31; break;
           case 5:     $dias_mes_anterior=30; break;
           case 6:     $dias_mes_anterior=31; break;
           case 7:     $dias_mes_anterior=30; break;
           case 8:     $dias_mes_anterior=31; break;
           case 9:     $dias_mes_anterior=31; break;
           case 10:     $dias_mes_anterior=30; break;
           case 11:     $dias_mes_anterior=31; break;
           case 12:     $dias_mes_anterior=30; break;
    }

    $dias=$dias + $dias_mes_anterior;
}

//ajuste de posible negativo en $meses
if ($meses < 0)
{
    --$anos;
    $meses=$meses + 12;
}

//echo "<br>Tu edad es: $anos años con $meses meses y $dias días";


$anual=$row["cont_anual"];
$cuotas=$anual/12;
$tmeses=$cuotas*$meses;


//--------------

$montoanual2=$row["cont_total"];
$montoanual=$row["cont_anual"];
$montomensual=$montoanual/12;
$montoejecutado=$montomensual*$meses;
$diferencia=$montoanual-$montoejecutado;

     $cont_id=$row["cont_id"];
     $sql22 = "Select sum(fac_monto) as facturamonto, avg(fac_valortipo) as promediotipo from dpp_contratos x, dpp_cont_fac y, dpp_facturas z where x.cont_id=$cont_id and x.cont_id=y.confa_cont_id and y.confa_fac_id=fac_id group by y.confa_cont_id order by x.cont_id desc ";
     //echo $sql22;
     $res22=mysql_query($sql22);
     if (!isset($res22)) {
       $row22 = mysql_fetch_array($res22);
//       echo "Entra";
     }

     $facturamonto=$row22["facturamonto"];
     $promediotipo=$row22["promediotipo"];

?>
<!--
                           <tr>
                             <td  valign="center" class="Estilo1">Este año </td>
                             <td class="Estilo1" colspan=3>
                                 <? echo "Antiguedad es: $anos años con $meses meses y $dias días" ?>
                             </td>
                           </tr>



-->




                           </table>

                      </td></tr>
                     <tr><td>
                  <div id="seccion1" style="display:">
                  <br>
		          <table width="488" border="1" cellspacing="0" cellpadding="0">
                           <tr>
                             <td class="Estilo1c" colspan="3">ANEXOS DE CONTRATO</td>
                           </tr>


                           <tr>
                             <td class="Estilo1">Descripción</td>
                             <td class="Estilo1">Monto</td>
                             <td class="Estilo1">Archivo</td>
                           </tr>
<?
$sql3="select * from dpp_contratoanexo where contanexo_cont_id='$id' order by contanexo_id desc ";
//echo $sql3;
$result3=mysql_query($sql3);
$cont3=1;

while ($row3=mysql_fetch_array($result3)) {
?>

                           <tr>
                             <td class="Estilo1"><? echo $row3["contanexo_descip"] ?></td>
                             <td class="Estilo1"><? echo $row3["contanexo_monto"] ?></td>
                             <td class="Estilo1">Archivo </td>
                           </tr>

 <?
}
 ?>


                           <tr>
                             <td colspan=4 align="center"><br></td>
                           </tr>



                         </table>


                        <br>
		          <table width="488" border="1" cellspacing="0" cellpadding="0">
                           <tr>
                             <td class="Estilo1c" colspan="4">1. RESOLUCIONES</td>
                           </tr>
                           <tr>
                             <td valign="center" class="Estilo1">NUMERO</td>
                             <td valign="center" class="Estilo1">MATERIA</td>
                             <td valign="center" class="Estilo1">FECHA</td>
                             <td valign="center" class="Estilo1">ARCHIVO</td>
                           </tr>
<?
                          $sql2 = "Select * from dpp_contratores where conres_cont_id='$id' and conres_materia<>'' order by conres_id desc ";
//                          echo $sql2;
                          $res2 = mysql_query($sql2);
                          while($row2 = mysql_fetch_array($res2)){
                               $eta_tipo_doc3=$row2["eta_tipo_doc3"];
                               $resanno=substr($row2["conres_fecha"],0,4);
                               $archivores="../../archivos/docargedo/fileargedo".$resanno."/resexc/RE_".$row2["conres_numero"]."_".$resanno."_".$regionsession."_1.PDF";
//                               $archivores="../../archivos/docargedo/fileargedo".$resanno."/resexc/RE_".$row2["conres_numero"]."_".$resanno."_".$regionsession."_1.PDF";
                               if (file_exists($archivores)){
                               }else{
                                  $archivores="../../archivos/docargedo/fileargedo".$resanno."/resafec/RA_".$row2["conres_numero"]."_".$resanno."_".$regionsession."_1.PDF";
                               }


?>
                           <tr>
                             <td valign="center" class="Estilo1"><? echo $row2["conres_numero"]; ?></td>
                             <td valign="center" class="Estilo1"><? echo $row2["conres_materia"]; ?></td>
                             <td valign="center" class="Estilo1"><? echo $row2["conres_fecha"]; ?></td>
<!--                             <td valign="center" class="Estilo1"><a href="<? echo $archivores; ?>" class="link" target="_blank" >Ver Resolucion</a></td>  -->
                             <td valign="center" class="Estilo1"><a href="archivos/docfac/<? echo $row2["conres_archivo"]; ?>" class="link" target="_blank" >Ver Resolucion</a></td>

                           </tr>

<?
                          }
?>
                           <tr>
                             <td colspan=4 align="center"><br></td>
                           </tr>
                         </table>
                         <br>
		          <table width="488" border="1" cellspacing="0" cellpadding="0">
                           <tr>
                             <td class="Estilo1c" colspan="4">2. ORDEN DE COMPRA</td>
                           </tr>
                           <tr>
                             <td valign="center" class="Estilo1">NUMERO</td>
                             <td valign="center" class="Estilo1">TIPO</td>
                             <td valign="center" class="Estilo1">FECHA</td>
                             <td valign="center" class="Estilo1">ARCHIVO</td>
                           </tr>
<?
                          $sql2="select * from compra_orden where oc_region='$regionsession' and oc_cont_id='$id' ";
//                          echo $sql2;
                          $res2 = mysql_query($sql2);
                          while($row2 = mysql_fetch_array($res2)){
                               $eta_tipo_doc3=$row2["eta_tipo_doc3"];
?>

                           <tr>
                             <td valign="center" class="Estilo1"><? echo $row2["oc_numero"]; ?></td>
                             <td valign="center" class="Estilo1"><? echo $row2["oc_tipo"]; ?></td>
                             <td valign="center" class="Estilo1"><? echo $row2["oc_fechacompra"]; ?></td>
                             <td valign="center" class="Estilo1"><a href="../../archivos/docfac/<? echo $row2["oc_archivo"]; ?>?read1=<? echo $read1 ?>" class="link" target="_blank"><? echo $row2["oc_archivo"]; ?></a></td>
                           </tr>

<?
                          }
?>
                           <tr>
                             <td colspan=4 align="center"><br></td>
                           </tr>
                         </table>
                         <br>
		          <table width="488" border="1" cellspacing="0" cellpadding="0">
                           <tr>
                             <td class="Estilo1c" colspan="4">3. GARANTIA </td>
                           </tr>
                           <tr>
                             <td valign="center" class="Estilo1">NUMERO</td>
                             <td valign="center" class="Estilo1">MATERIA</td>
                             <td valign="center" class="Estilo1">FECHA</td>
                             <td valign="center" class="Estilo1">ARCHIVO</td>
                           </tr>
<?
                          $sql2 = "select * from dpp_boletasg where boleg_reg='$regionsession' and boleg_cont_id='$id' ";
                          //echo $sql2;
                          $res2 = mysql_query($sql2);
                          while($row2 = mysql_fetch_array($res2)){
                               $eta_tipo_doc3=$row2["eta_tipo_doc3"];
?>
                           <tr>
                             <td valign="center" class="Estilo1"><? echo $row2["boleg_numero"]; ?></td>
                             <td valign="center" class="Estilo1"><? echo $row2["boleg_tipo"]; ?></td>
                             <td valign="center" class="Estilo1"><? echo $row2["boleg_fecha_emision"]; ?></td>
                             <td valign="center" class="Estilo1"><a href="../../archivos/docgarantia/<? echo $row2["boleg_archivo"]; ?>" class="link" target="_blank"><? echo $row2["boleg_archivo"]; ?></a></td>
                           </tr>

<?
                          }
?>
                           <tr>
                             <td colspan=4 align="center"><br></td>
                           </tr>
                         </table>
                         
        <br>
		          <table width="488" border="1" cellspacing="0" cellpadding="0">
                           <tr>
                             <td class="Estilo1c" colspan="4">4. MULTAS</td>
                           </tr>
                           <tr>
                             <td valign="center" class="Estilo1">NUMERO</td>
                             <td valign="center" class="Estilo1">MATERIA</td>
                             <td valign="center" class="Estilo1">FECHA</td>
                             <td valign="center" class="Estilo1">ARCHIVO</td>
                           </tr>
<?
                          $sql2="select * from dpp_contratores x, argedo_documentos y where conres_cont_id='$id' and x.conres_docs_id=y.docs_id";
                        //  $sql2 = "select * from dpp_boletasg where boleg_reg='$regionsession' and boleg_cont_id='$id' ";
                          //echo $sql2;
                          $res2 = mysql_query($sql2);
                          while($row2 = mysql_fetch_array($res2)){
                               $eta_tipo_doc3=$row2["eta_tipo_doc3"];
?>
                           <tr>
                             <td valign="center" class="Estilo1"><? echo $row2["docs_folio"]; ?></td>
                             <td valign="center" class="Estilo1"><? echo $row2["docs_materia"]; ?></td>
                             <td valign="center" class="Estilo1"><? echo substr($row2["docs_fecha"],8,2)."-".substr($row2["docs_fecha"],5,2)."-".substr($row2["docs_fecha"],0,4); ?></td>
                             <td valign="center" class="Estilo1"><a href="../../archivos/docargedo/<? echo $row3["docs_archivo"] ?>" class="link" target="_blank"> VER</a> </td>
                           </tr>

<?
                          }
?>
                           <tr>
                             <td colspan=4 align="center"><br></td>
                           </tr>
                         </table>



