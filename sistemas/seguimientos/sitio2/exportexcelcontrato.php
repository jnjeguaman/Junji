<?
session_start();
require("inc/config.php");
$nivel = $_SESSION["pfl_user"];
$regionsession = $_SESSION["region"];

$sql2 = "Select * from regiones where codigo=$regionsession";
//echo $sql;
$res2 = mysql_query($sql2);
$row2 = mysql_fetch_array($res2);
$nombreregion=$row2["nombre"];

$id=$_GET["id2"];
$id3=$_GET["id3"];
$sql3="select * from dpp_contratos where cont_id=$id";
$res3 = mysql_query($sql3);
$row3 = mysql_fetch_array($res3);

$empresa=$row3["cont_nombre"];
$rut=$row3["cont_rut"];
$servicio=$row3["cont_nombre1"];

?>
<table berder="0">
<tr>
  <td>Defensoría : </td>
  <td><? echo $nombreregion ?></td>
</tr>
<tr>
  <td>Tipo de Encuesta  : </td>
  <td>Externa</td>
</tr>
<tr>
  <td>Empresa : </td>
  <td><? echo $empresa ?></td>
</tr>
<tr>
  <td>Rut : </td>
  <td><? echo $rut ?></td>
</tr>
<tr>
  <td>Servicio : </td>
  <td><? echo $servicio ?></td>
</tr>

<table>
<table border="0">

<?

  $sql31="select * from dpp_cont_evaext where contevaext_cont_id=$id and contevaext_encu_id=$id3";

  $res31 = mysql_query($sql31);
  $cont=1;

  while ($row31 = mysql_fetch_array($res31)) {
 ?>
   <tr>
     <td>Pregunta</td>
     <td><? echo $row31["contevaext_nombre"] ?></td>
   <tr>
 <?
    $id31=$row31["contevaext_id"];
    $sql32 = "select * from dpp_contevaext_item  where contevaexti_contevaext_id =$id31";
    $res32 = mysql_query($sql32);
    $cont2=1;
    while ($row32 = mysql_fetch_array($res32)) {
?>
      <tr>
        <td><? echo $cont2 ?></td>
        <td><? echo $row32["contevaexti_nombre"] ?></td>
      <tr>

<?

      $cont2++;
    }

    $cont++;

}

?>
</table>
<hr>
<table berder="0">
<tr>
  <td>Defensoría : </td>
  <td><? echo $nombreregion ?></td>
</tr>
<tr>
  <td>Tipo de Encuesta  : </td>
  <td>Interna</td>
</tr>
<tr>
  <td>Empresa : </td>
  <td><? echo $empresa ?></td>
</tr>
<tr>
  <td>Rut : </td>
  <td><? echo $rut ?></td>
</tr>
<tr>
  <td>Servicio : </td>
  <td><? echo $servicio ?></td>
</tr>

<table>

<table border="0">

<?

  $sql31="select * from dpp_cont_evaint where contevaint_cont_id=$id and contevaint_encu_id=$id3";
  // echo $sql31;
  $res31 = mysql_query($sql31);
  $cont=1;

  while ($row31 = mysql_fetch_array($res31)) {
 ?>
   <tr>
     <td>Pregunta</td>
     <td><? echo $row31["contevaint_nombre"] ?></td>
   <tr>
 <?
    $id31=$row31["contevaint_id"];
    $sql32 = "select * from dpp_contevaint_item  where contevainti_contevaint_id =$id31";
    // echo $sql32;
    $res32 = mysql_query($sql32);
    $cont2=1;
    while ($row32 = mysql_fetch_array($res32)) {
?>
      <tr>
        <td><? echo $cont2 ?></td>
        <td><? echo $row32["contevainti_nombre"] ?></td>
      <tr>

<?

      $cont2++;
    }

    $cont++;

}

?>
</table>


