<?
header("Content-Type: application/vnd.ms-excel; name='listador'");
header("Content-Disposition: attachment; filename=reportes.xls");

require("inc/config.php");
$regionsession = $_GET["reg"];


?>
    <table border="1">
                        <tr>
                               <td class="Estilo1">N°</td>
                               <td class="Estilo1">Region</td>
                               <td class="Estilo1">Fecha</td>
                               <td class="Estilo1">Nombre</td>
                               <td class="Estilo1">Cargo</td>
                               <td class="Estilo1">Estado</td>
                         </tr>
<?
 $sql="select * from concilia_cc  order by cc_id desc";
//echo $sql;
$res3 = mysql_query($sql);
$cont=1;

while($row3 = mysql_fetch_array($res3)){
     $ccid=$row3["cc_id"];

     $sql="select * from concilia_antecedente where ante_cc_id='$ccid' order by ante_estado asc, ante_fecha desc";
//     echo $sql."<br>";
     $res2 = mysql_query($sql);
     $cont=1;
     while ($row2 = mysql_fetch_array($res2)) {
         $anteestado=$row2["ante_estado"];
         if ($anteestado==1) {
             $estado="Vigente";
         }
         if ($anteestado==2) {
             $estado="Desactivado";
         }

?>
    <tr>
      <td  class="Estilo1"><? echo $cont; ?></td>
      <td  class="Estilo1"><? echo $row3["cc_region"]; ?></td>
      <td  class="Estilo1"><? echo $row2["ante_fecha"]; ?></td>
      <td  class="Estilo1"><? echo $row2["ante_nombre"]; ?></td>
      <td  class="Estilo1"><? echo $row2["ante_cargo"]; ?></td>
      <td  class="Estilo1"><? echo $estado ?></td>
    </tr>
 <?
    $cont++;
     }
}

 ?>



    </table>
















