<?
session_start();


header("Content-Type: application/vnd.ms-excel; name='listador'");
header("Content-Disposition: attachment; filename=reportes.xls");


require("inc/config.php");
//require("inc/querys.php");
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
.Estilo1bazul {
	font-family: Verdana;
	font-weight: bold;
	font-size: 8px;
	color: #0000FF;
	text-align: left;
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
.Estilo7 {font-size: 12px; font-weight: bold; }
-->
</style>

</head>


<body>

<?
$mes=$_GET["mes"];
$anno=$_GET["anno"];
$region=$_GET["region"];


?>


                      <table border=1>
                        <tr>
                         <td class="Estilo1b">TIPO</td>
                         <td class="Estilo1b">FOLIO</td>
                         <td class="Estilo1b">REGION</td>
                         <td class="Estilo1b">NUMERO</td>
                         <td class="Estilo1b">FECHA DEL DOCUMENTO</td>
                         <td class="Estilo1b">FECHA RENDICION</td>
                         <td class="Estilo1b">RUT</td>
                         <td class="Estilo1b">DV</td>
                         <td class="Estilo1b">NOMBRE</td>
                         <td class="Estilo1b">EXENTO</td>
                         <td class="Estilo1b">NETO</td>
                         <td class="Estilo1b">IVA</td>
                         <td class="Estilo1b">COMBUSTIBLE</td>
                         <td class="Estilo1b">OTROS IMPTOS</td>
                         <td class="Estilo1b">TOTAL</td>
                         <td class="Estilo1b">N° EGRESO</td>
                        </tr>

<?
// r  b  factura
$sw=0;

//   $sql="select hono_nombre, hono_rut,hono_dig, count(hono_rut) as cuentarut, sum(hono_bruto) as hono_bruto, sum(hono_retencion) as hono_retencion, sum(hono_liquido) as hono_liquido from dpp_honorarios where ";
     $sql="select * from dpp_etapas where eta_estado<10 and eta_tipo_doc='Factura'  and (eta_tipo_doc3<>'R' and eta_tipo_doc3<>'B'  and eta_tipo_doc3<>'BH' and eta_tipo_doc3<>'BHS') and ";

if ($region<>"") {
    if ($region==0)
        $sql.=" eta_region<>'' and ";
    else
        $sql.=" eta_region=$region and ";
        $sw=1;
}

if ($mes<>"") {
    $sql.=" month(eta_fdevengo)='$mes' and ";
    $sw=1;
}
if ($anno<>"" ) {
    $sql.=" year(eta_fdevengo)='$anno' and ";
    $sw=1;
}


if ($sw==1){
    $sql.=" 1=1 and eta_estado<10 and eta_item<>21 order by eta_negreso ";
}
if ($sw==0){
    $sql.=" 1=2 ";
}


$res3 = mysql_query($sql);
$cont=1;
$cont1=0;
$sumab=0;
$sumar=0;
$sumal=0;
while($row3 = mysql_fetch_array($res3)){


    $fechahoy = $row3["eta_fecha_aprobacionok"];
    $dia1 = strtotime($fechahoy);
    $fechabase =$row3["eta_fecha_recepcion"];
    $dia2 = strtotime($fechabase);
    $diff=$dia1-$dia2;
    $diff4=$dia2+$diff;
//    echo $diff."--";
    $diff2=intval($diff/(60*60*24));
    $diff2b=$diff2;
//    echo $diff2."<br>";
    $diff3= date('Y-m-d', $diff4);
   if ($diff2>8) {
    $diff5=8*24*60*60;
    //echo $diff5."<br>";
    $diff4=$dia2+$diff5;
    $diff3= date('Y-m-d', $diff4);
    $diff2b=8;
   }
   $cheque=$row3["eta_fechache"];
   $dia3 = strtotime($cheque);
   $diff6=$dia3-$dia2;
//   $diff7=intval($diff6/(60*60*24));

   $diff7=($diff6/(60*60*24));
   $diff7=number_format($diff7,0);
   $diff8=$diff7-$diff2b;

   
   $diff8=$diff7-$diff2b;
   
   if ($diff8>30) {
      $sw=0;
   } else {
      $sw=1;
   }

   if ($diff8>30 and $diff8<=45) {
      $sw2=1;
   } else {
      $sw2=0;
   }

   if ($diff8>45 and $diff8<=60) {
      $sw3=1;
   } else {
      $sw3=0;
   }

   if ($diff8>60) {
      $sw4=1;
   } else {
      $sw4=0;
   }

   if ($diff8>30) {
      $sw5="Justifique";
   } else {
      $sw5="Muy Bueno";
   }

   $pagado=$row3["eta_fecha_retira"];
   $dia4 = strtotime($pagado);
   $diff9=$dia4-$dia2;
   $diff10=intval($diff9/(60*60*24));
   if ($diff10<1)
     $diff10="";
     
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
   if ($vartipodoc2=="bh" or $vartipodoc2=="BH" )
     $vartipodoc="Honorario";
 }
 if ($vartipodoc1=='Honorario') {
     $vartipodoc="Honorario";
 }




?>

                       <tr>
                         <td class="Estilo1b"><? echo $row3["eta_tipo_doc3"];  ?>  </td>
                         <td class="Estilo1b"><? echo $row3["eta_folio"];  ?> </td>
                         <td class="Estilo1b"><? echo $row3["eta_region"];  ?> </td>
                         <td class="Estilo1b"><? echo $row3["eta_numero"];  ?> </td>
                         <td class="Estilo1b"><? echo substr($row3["eta_fecha_fac"],8,2)."-".substr($row3["eta_fecha_fac"],5,2)."-".substr($row3["eta_fecha_fac"],0,4)   ?></td>
                         <td class="Estilo1b"><? echo $row3["eta_rut"];  ?> </td>
                         <td class="Estilo1b"><? echo $row3["eta_dig"];  ?> </td>
                         <td class="Estilo1b"><? echo $row3["eta_cli_nombre"];  ?> </td>
                         <td class="Estilo1b"><? echo $row3["eta_exento"];  ?> </td>
                         <td class="Estilo1b"><? echo $row3["eta_neto"];  ?> </td>
                         <td class="Estilo1b"><? echo $row3["eta_iva"];  ?> </td>
                         <td class="Estilo1b"><? echo $row3["eta_impuesto1"];  ?> </td>
                         <td class="Estilo1b"><? echo $row3["eta_impuesto2"];  ?> </td>
                         <td class="Estilo1b"><? echo $row3["eta_monto2"];  ?> </td>
                         <td class="Estilo1b"><? echo $row3["eta_negreso"];  ?> </td>
                       </tr>

<?
 $cont++;
}
    if ($region==0) {
//       $sql="select * from ff_factura where month(fffac_fechadoc)='$mes' and year(fffac_fecharendicion)='$anno'  ";
       $sql="select * from ff_factura where month(fffac_fecharendicion)='$mes' and year(fffac_fecharendicion)='$anno'  ";
    } else {
       $sql="select * from ff_factura where month(fffac_fecharendicion)='$mes' and year(fffac_fecharendicion)='$anno' and fffac_region=$region ";
    }

//    echo $sql;
     $res3 = mysql_query($sql);
     while($row3 = mysql_fetch_array($res3)){

?>
                       <tr>
                         <td class="Estilo1bazul"><? echo $row3["fffac_tipo"]  ?> </td>
                         <td class="Estilo1bazul"><? echo $row3["fffac_id"]  ?> </td>
                         <td class="Estilo1bazul"><? echo $row3["fffac_region"];  ?> </td>
                         <td class="Estilo1bazul"><? echo $row3["fffac_numero"]  ?> </td>
                         <td class="Estilo1bazul"><? echo substr($row3["fffac_fechadoc"],8,2)."-".substr($row3["fffac_fechadoc"],5,2)."-".substr($row3["fffac_fechadoc"],0,4)   ?></td>
                         <td class="Estilo1bazul"><? echo substr($row3["fffac_fecharendicion"],8,2)."-".substr($row3["fffac_fecharendicion"],5,2)."-".substr($row3["fffac_fecharendicion"],0,4)   ?></td>
                         <td class="Estilo1bazul"><? echo $row3["fffac_rut"]  ?> </td>
                         <td class="Estilo1bazul"><? echo $row3["fffac_dig"]  ?> </td>
                         <td class="Estilo1bazul"><? echo $row3["fffac_nombre"]  ?> </td>
                         <td class="Estilo1bazul"><? echo $row3["fffac_exento"]  ?> </td>
                         <td class="Estilo1bazul"><? echo $row3["fffac_neto"]  ?> </td>
                         <td class="Estilo1bazul"><? echo $row3["fffac_iva"]  ?> </td>
                         <td class="Estilo1bazul"><? echo $row3["fffac_combustible"]  ?> </td>
                         <td class="Estilo1bazul"><? echo $row3["fffac_otro"]  ?> </td>
                         <td class="Estilo1bazul"><? echo $row3["fffac_total"]  ?> </td>
                       </tr>



<?
     }
?>






                        </td>
                      </tr>
                      <tr>





</td>
  </tr>


</table>

