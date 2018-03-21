<?
session_start();
require("inc/config.php");
require("inc/querys.php");
$fechamia=date('Y-m-d');
$anno=date('Y');
$hora=date("h:i:s");
$usuario=$_SESSION["nom_user"];
$regionsession = $_SESSION["region"];

extract($_POST);

if (1==1) {

$sql = "Select * from usuarios where nombre = '$usuario'  ";
//echo $sql;
$res=mysql_query($sql);
$row = mysql_fetch_array($res);
$nombrecom=$row["nombrecom"];


//---- Aqui sacaremos el las glosas, item y codigos contables de las variables item ---- //
if ($item<>'') {
    list($tipo1, $tipo2, $tipo3) = split('[/]', $item);
}
if ($item31<>'') {
    list($tipo311, $tipo312, $tipo313) = split('[/]', $item31);
}
if ($item32<>'') {
    list($tipo321, $tipo322, $tipo323) = split('[/]', $item32);
}
if ($item33<>'') {
    list($tipo331, $tipo332, $tipo333) = split('[/]', $item33);
}
if ($item34<>'') {
    list($tipo341, $tipo342, $tipo343) = split('[/]', $item34);
}
if ($item35<>'') {
    list($tipo351, $tipo352, $tipo353) = split('[/]', $item35);
}
if ($item36<>'') {
    list($tipo361, $tipo362, $tipo363) = split('[/]', $item36);
}
if ($item37<>'') {
    list($tipo371, $tipo372, $tipo373) = split('[/]', $item37);
}
if ($item38<>'') {
    list($tipo381, $tipo382, $tipo383) = split('[/]', $item38);
}
if ($item39<>'') {
    list($tipo391, $tipo392, $tipo393) = split('[/]', $item39);
}
if ($item310<>'') {
    list($tipo3101, $tipo3102, $tipo3103) = split('[/]', $item310);
}
if ($item311<>'') {
    list($tipo3111, $tipo3112, $tipo3113) = split('[/]', $item311);
}
if ($item312<>'') {
    list($tipo3121, $tipo3122, $tipo3123) = split('[/]', $item312);
}
if ($item313<>'') {
    list($tipo3131, $tipo3132, $tipo3133) = split('[/]', $item313);
}
if ($item314<>'') {
    list($tipo3141, $tipo3142, $tipo3143) = split('[/]', $item314);
}
if ($item315<>'') {
    list($tipo3151, $tipo3152, $tipo3153) = split('[/]', $item315);
}


if ($origen==1) {
    $fecha4=substr($fecha4,8,2)."-".substr($fecha4,5,2)."-".substr($fecha4,0,4);
}

//list($tipo1, $tipo2) = split('[/]', $tipog);
//echo "$tipo1  --- $tipo2 ---- $tipo3";
//exit();

//-----  FIN proceso de sacado glosas, item y codigos  ----------------  //

$fecha1= substr($fecha1,6,4)."-".substr($fecha1,3,2)."-".substr($fecha1,0,2);
$fecha2= substr($fecha2,6,4)."-".substr($fecha2,3,2)."-".substr($fecha2,0,2);
$fecha3= substr($fecha3,6,4)."-".substr($fecha3,3,2)."-".substr($fecha3,0,2);
$fecha4= substr($fecha4,6,4)."-".substr($fecha4,3,2)."-".substr($fecha4,0,2);

/*
if ($modalidad=='Reembolso') {
  $sql2="select max(oc_folio) as maximo2 from compra_orden  where oc_region='$regionsession' and year(oc_fechacompra)='$anno' and oc_modalidad='Reembolso'  ";
} else {
  $sql2="select max(oc_folio) as maximo2 from compra_orden  where oc_region='$regionsession' and year(oc_fechacompra)='$anno' and oc_modalidad<>'Reembolso' ";
}
*/

if ($modalidad=='Reembolso') {
   $sql2="select max(oc_folio) as maximo2 from compra_orden  where oc_region='$regionsession' and year(oc_fechacompra)='$anno' and oc_modalidad='Reembolso'";
} else {
   $sql2="select max(oc_folio) as maximo2 from compra_orden  where oc_region='$regionsession' and year(oc_fechacompra)='$anno' and oc_modalidad<>'Reembolso' and oc_tipo='' ";
}
//echo $sql2."<br>";
//exit();
$result=mysql_query($sql2);
$row=mysql_fetch_array($result);
//echo "--->".$row["maximo2"]."<br>";
$maximo=$row["maximo2"]+1;
//exit();
if ($modalidad=='Reembolso') {
  $estado="ACEPTADO";
} else {
  $estado="ACEPTADO";
}

$archivo1="";
/*
if ($modalidad=='Arriendo' or $modalidad=='Consumos Basicos')  ) {
    $archivo1="OC2".$regionsession."_".$numerooc."_".$annomia.".PDF";
    
}
if ($modalidad=='Reembolso')  ) {
    $archivo1="OR".$regionsession."_".$numerooc."_".$annomia.".PDF";

}
*/

//echo $maximo."<br>";
$sql="INSERT INTO compra_orden (oc_numero,      oc_tipo,    oc_modalidad, oc_ccosto, oc_rut, oc_dig, oc_rsocial, oc_monto, oc_moneda, oc_obs, oc_fechacompra, oc_fechaentrega, oc_compra_id, oc_fechasis, oc_user, oc_region, oc_nombre, oc_itemppto, oc_fpago, oc_emitidapor, oc_fehcaenvio, oc_direccion, oc_fono, oc_folio, oc_swiva, oc_total, oc_retencion, oc_nroresolucion, oc_fecharesolucion, oc_tipodes, oc_tipocodigo, oc_tipocodigo2, oc_estado, oc_archivo, oc_certificado, oc_docs_id)
                        VALUES ('$maximo', '$tipoadqui', '$modalidad', '$ccosto', '$rut',   '$dig', '$nombre', '$montototal', '$moneda', '$obs', '$fecha1', '$fecha2',          '$estados', '$fechamia', '$usuario', '$region', '$nombre3', '$item', '$fpago', '$nombrecom', '$fecha3', '$direccion', '$telefono', '$maximo', '$swiva', '$montototal', '$retencion', '$nroresolucion', '$fecha4','$tipo1','$tipo2','$tipo3','$estado', '$archivo1', '$certificado', '$idargedo')";
//echo $sql;
//exit();
mysql_query($sql);

$sql2="select max(oc_id) as maximo from compra_orden  where oc_region='$regionsession' and year(oc_fechacompra)='$anno' ";
$result=mysql_query($sql2);
$row=mysql_fetch_array($result);
$maximo=$row["maximo"];


$total=0;
if ($cantidad>=1) {
  $sql="INSERT INTO compra_ordendet (ocdet_oc_id, ocdet_item, ocdet_ctda, ocdet_detalle, ocdet_unitario, ocdet_total, ocdet_tipo, ocdet_tipocodigo, ocdet_tipocodigo2)
                           VALUES   ('$maximo', '$item1', '$ctda1', '$detalle1', '$valor1', '$total1','$tipo311', '$tipo312', '$tipo313');";
//echo $sql;
//exit();
  mysql_query($sql);
  $total=$total+$total1;
}

if ($cantidad>=2) {
  $sql="INSERT INTO compra_ordendet (ocdet_oc_id, ocdet_item, ocdet_ctda, ocdet_detalle, ocdet_unitario, ocdet_total, ocdet_tipo, ocdet_tipocodigo, ocdet_tipocodigo2)
                           VALUES   ('$maximo', '$item2', '$ctda2', '$detalle2', '$valor2', '$total2','$tipo321', '$tipo322', '$tipo323');";
//echo $sql;
//exit();
  mysql_query($sql);
  $total=$total+$total2;
}

if ($cantidad>=3) {
  $sql="INSERT INTO compra_ordendet (ocdet_oc_id, ocdet_item, ocdet_ctda, ocdet_detalle, ocdet_unitario, ocdet_total, ocdet_tipo, ocdet_tipocodigo, ocdet_tipocodigo2)
                           VALUES   ('$maximo', '$item3', '$ctda3', '$detalle3', '$valor3', '$total3','$tipo331', '$tipo332', '$tipo333');";
//echo $sql;
//exit();
  mysql_query($sql);
  $total=$total+$total3;
}

if ($cantidad>=4) {
  $sql="INSERT INTO compra_ordendet (ocdet_oc_id, ocdet_item, ocdet_ctda, ocdet_detalle, ocdet_unitario, ocdet_total, ocdet_tipo, ocdet_tipocodigo, ocdet_tipocodigo2)
                           VALUES   ('$maximo', '$item4', '$ctda4', '$detalle4', '$valor4', '$total4','$tipo341', '$tipo342', '$tipo343');";
//echo $sql;
//exit();
  mysql_query($sql);
  $total=$total+$total4;
}

if ($cantidad>=5) {
  $sql="INSERT INTO compra_ordendet (ocdet_oc_id, ocdet_item, ocdet_ctda, ocdet_detalle, ocdet_unitario, ocdet_total, ocdet_tipo, ocdet_tipocodigo, ocdet_tipocodigo2)
                           VALUES   ('$maximo', '$item5', '$ctda5', '$detalle5', '$valor5', '$total5','$tipo351', '$tipo352', '$tipo353');";
//echo $sql;
//exit();
  mysql_query($sql);
  $total=$total+$total5;
}

if ($cantidad>=6) {
  $sql="INSERT INTO compra_ordendet (ocdet_oc_id, ocdet_item, ocdet_ctda, ocdet_detalle, ocdet_unitario, ocdet_total, ocdet_tipo, ocdet_tipocodigo, ocdet_tipocodigo2)
                           VALUES   ('$maximo', '$item6', '$ctda6', '$detalle6', '$valor6', '$total6','$tipo361', '$tipo362', '$tipo363');";
//echo $sql;
//exit();
  mysql_query($sql);
  $total=$total+$total6;
}
if ($cantidad>=7) {
  $sql="INSERT INTO compra_ordendet (ocdet_oc_id, ocdet_item, ocdet_ctda, ocdet_detalle, ocdet_unitario, ocdet_total, ocdet_tipo, ocdet_tipocodigo, ocdet_tipocodigo2)
                           VALUES   ('$maximo', '$item7', '$ctda7', '$detalle7', '$valor7', '$total7','$tipo371', '$tipo372', '$tipo373');";
//echo $sql;
//exit();
  mysql_query($sql);
  $total=$total+$total7;
}
if ($cantidad>=8) {
  $sql="INSERT INTO compra_ordendet (ocdet_oc_id, ocdet_item, ocdet_ctda, ocdet_detalle, ocdet_unitario, ocdet_total, ocdet_tipo, ocdet_tipocodigo, ocdet_tipocodigo2)
                           VALUES   ('$maximo', '$item8', '$ctda8', '$detalle8', '$valor8', '$total8','$tipo381', '$tipo382', '$tipo383');";
//echo $sql;
//exit();
  mysql_query($sql);
  $total=$total+$total8;
}
if ($cantidad>=9) {
  $sql="INSERT INTO compra_ordendet (ocdet_oc_id, ocdet_item, ocdet_ctda, ocdet_detalle, ocdet_unitario, ocdet_total, ocdet_tipo, ocdet_tipocodigo, ocdet_tipocodigo2)
                           VALUES   ('$maximo', '$item9', '$ctda9', '$detalle9', '$valor9', '$total9','$tipo391', '$tipo392', '$tipo393');";
//echo $sql;
//exit();
  mysql_query($sql);
  $total=$total+$total9;
}
if ($cantidad>=10) {
  $sql="INSERT INTO compra_ordendet (ocdet_oc_id, ocdet_item, ocdet_ctda, ocdet_detalle, ocdet_unitario, ocdet_total, ocdet_tipo, ocdet_tipocodigo, ocdet_tipocodigo2)
                           VALUES   ('$maximo', '$item10', '$ctda10', '$detalle10', '$valor10', '$total10','$tipo3101', '$tipo3102', '$tipo3103');";
//echo $sql;
//exit();
  mysql_query($sql);
  $total=$total+$total10;
}
if ($cantidad>=11) {
  $sql="INSERT INTO compra_ordendet (ocdet_oc_id, ocdet_item, ocdet_ctda, ocdet_detalle, ocdet_unitario, ocdet_total, ocdet_tipo, ocdet_tipocodigo, ocdet_tipocodigo2)
                           VALUES   ('$maximo', '$item11', '$ctda11', '$detalle11', '$valor11', '$total11','$tipo3111', '$tipo3112', '$tipo3113');";
//echo $sql;
//exit();
  mysql_query($sql);
  $total=$total+$total11;
}
if ($cantidad>=12) {
  $sql="INSERT INTO compra_ordendet (ocdet_oc_id, ocdet_item, ocdet_ctda, ocdet_detalle, ocdet_unitario, ocdet_total, ocdet_tipo, ocdet_tipocodigo, ocdet_tipocodigo2)
                           VALUES   ('$maximo', '$item12', '$ctda12', '$detalle12', '$valor12', '$total12','$tipo3121', '$tipo3122', '$tipo3123');";
//echo $sql;
//exit();
  mysql_query($sql);
  $total=$total+$total12;
}
if ($cantidad>=13) {
  $sql="INSERT INTO compra_ordendet (ocdet_oc_id, ocdet_item, ocdet_ctda, ocdet_detalle, ocdet_unitario, ocdet_total, ocdet_tipo, ocdet_tipocodigo, ocdet_tipocodigo2)
                           VALUES   ('$maximo', '$item13', '$ctda13', '$detalle13', '$valor13', '$total13','$tipo3131', '$tipo3132', '$tipo3133');";
//echo $sql;
//exit();
  mysql_query($sql);
  $total=$total+$total12;
}
if ($cantidad>=14) {
  $sql="INSERT INTO compra_ordendet (ocdet_oc_id, ocdet_item, ocdet_ctda, ocdet_detalle, ocdet_unitario, ocdet_total, ocdet_tipo, ocdet_tipocodigo, ocdet_tipocodigo2)
                           VALUES   ('$maximo', '$item14', '$ctda14', '$detalle14', '$valor14', '$total14','$tipo3141', '$tipo3142', '$tipo3143');";
//echo $sql;
//exit();
  mysql_query($sql);
  $total=$total+$total14;
}
if ($cantidad>=15) {
  $sql="INSERT INTO compra_ordendet (ocdet_oc_id, ocdet_item, ocdet_ctda, ocdet_detalle, ocdet_unitario, ocdet_total, ocdet_tipo, ocdet_tipocodigo, ocdet_tipocodigo2)
                           VALUES   ('$maximo', '$item15', '$ctda15', '$detalle15', '$valor15', '$total15','$tipo3151', '$tipo3152', '$tipo3153');";
//echo $sql;
//exit();
  mysql_query($sql);
  $total=$total+$total15;
}

  $sql="update compra_orden set oc_total=$total' wher oc_id='$maximo';";
//echo $sql;
//exit();
  mysql_query($sql);
  $total=$total+$total15;



  $nombre=trim($nombre);
  $sql1="insert into dpp_proveedores (provee_rut, provee_dig, provee_cat_juri, provee_nombre, provee_fecha, provee_user, provee_fono, provee_dir)
                           values    ('$rut',upper('$dig'),'$tipo',upper('$nombre'),'$fechamia','$usuario','$telefono','$direccion')  ";
// echo $sql1;
// exit();
 mysql_query($sql1);

if ($modalidad<>'Reembolso') {
  $sql1="update dpp_proveedores set provee_fono='$telefono', provee_dir='$direccion' where provee_rut='$rut' ";
}
// echo $sql1;
// exit();
 mysql_query($sql1);




}

//exit();
if ($origen==0) {
  echo "<script>location.href='compra_orden2.php?llave=1';</script>";
}
if ($origen==1) {
  echo "<script>location.href='compra_orden3.php?llave=1';</script>";
}


?>


