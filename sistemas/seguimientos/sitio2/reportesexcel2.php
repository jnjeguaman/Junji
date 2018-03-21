<?
session_start();

header("Content-Type: application/vnd.ms-excel; name='listador'");

header("Content-Disposition: attachment; filename=reportes.xls");


require("inc/config.php");


$date_in=date("Y-m-d");
?>


<?
$region=$_GET["region"];
$fecha1=$_GET["fecha1"];
$fecha2=$_GET["fecha2"];
$rut=$_GET["rut"];
$documento=$_GET["documento"];
$nombre=$_GET["nombre"];
$glosa=$_GET["glosa"];
$folio=$_GET["folio"];
$estado=$_GET["estado"];
$licitacion=$_GET["licitacion"];

?>

                      <table border=1>
                        <tr>
                         <td class="Estilo1b">Nun</td>
                         <td class="Estilo1b">Rut</td>
                         <td class="Estilo1b">Nombre</td>
                         <td class="Estilo1b">Recep.</td>
                         <td class="Estilo1b">Venci.</td>
                         <td class="Estilo1b">Motivo</td>
                         <td class="Estilo1b">Tipo</td>
                         <td class="Estilo1b">Glosa</td>
                         <td class="Estilo1b">Monto</td>
                         <td class="Estilo1b">Nro. Doc.</td>
                         <td class="Estilo1b">Folio</td>
			             <td class="Estilo1b">Estado</td>
                         <td class="Estilo1b">ID Licitacion</td>
                        </tr>

<?
$sw=0;

   $sql="select * from dpp_boletasg where ";

   if($licitacion <> "")
   {
    $sql.=" boleg_idlicitacion = '".$licitacion."' and ";
    $sw=1;
   }
   
if ($region<>"") {
    if ($region==0)
        $sql.=" boleg_reg<>'' and ";
    else
        $sql.=" boleg_reg=$region and ";
    $sw=1;
}
if ($fecha1<>"" and $fecha2<>"" ) {
    $sql.=" ( boleg_fecha_recep>='$fecha1' and boleg_fecha_recep<='$fecha2' ) and ";
    $sw=1;
}
if ($rut<>"") {
    $sql.=" boleg_rut like '%$rut%' and ";
    $sw=1;
}
if ($documento<>"") {
    $sql.=" boleg_numero like '%$documento%' and ";
    $sw=1;
}
if ($nombre<>"") {
    $sql.=" boleg_nombre like '%$nombre%' and ";
    $sw=1;
}
if ($folio<>"") {
    $sql.=" boleg_folio='$folio' and ";
    $sw=1;
}
if ($glosa<>"") {
    $sql.=" boleg_glosa like '%$glosa%' and ";
    $sw=1;
}
if ($estado<>"") {
    $sql.=" boleg_estado like '$estado' and ";
    $sw=1;
}

if ($sw==1){
    $sql.=" 1=1 order by boleg_folio desc";
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
    if ($row3["boleg_estado"]==1) {
        $estado2="Recepción";
    }
    if ($row3["boleg_estado"]==2) {
        $estado2="Custodia";
    }
    if ($row3["boleg_estado"]==3) {
        $estado2="Recepción";
    }
    if ($row3["boleg_estado"]==4) {
        $estado2="Por Devolver";
    }
    if ($row3["boleg_estado"]==5) {
        $estado2="Devuelto";
    }
    if ($row3["boleg_estado"]==6) {
        $estado2="Rechazado";
    }
    if ($row3["boleg_estado"]==7) {
        $estado2="Cobrado";
    }
    if ($row3["boleg_estado"]==8) {
        $estado2="Por Cobrar";
    }




?>


                       <tr>
                         <td class="Estilo1b"><? echo $cont  ?> </td>
                         <td class="Estilo1b"><? echo $row3["boleg_rut"]  ?>-<? echo $row3["boleg_dig"]  ?> </td>
                         <td class="Estilo1b"><? echo $row3["boleg_nombre"]  ?> </td>
                         <td class="Estilo1b"><? echo substr($row3["boleg_fecha_recep"],8,2)."-".substr($row3["boleg_fecha_recep"],5,2)."-".substr($row3["boleg_fecha_recep"],0,4)   ?></td>
                         <td class="Estilo1b"><? echo substr($row3["boleg_fecha_vence"],8,2)."-".substr($row3["boleg_fecha_vence"],5,2)."-".substr($row3["boleg_fecha_vence"],0,4)   ?></td>
                         <td class="Estilo1b"><? echo $row3["boleg_tipo"]  ?> </td>
                         <td class="Estilo1b"><? echo $row3["boleg_tipo2"]  ?> </td>
                         <td class="Estilo1b"><? echo $row3["boleg_glosa"]  ?> </td>
                         <td class="Estilo1c"><? echo number_format($row3["boleg_monto"],0,',','.')  ?> </td>
                         <td class="Estilo1b"><? echo $row3["boleg_numero"]  ?> </td>
                         <td class="Estilo1b"><? echo $row3["boleg_folio"]  ?> </td>
                         <td class="Estilo1b"><? echo $estado2  ?> </td>
                         <td class="Estilo1b"><?php echo $row3["boleg_idlicitacion"] ?></td>



                       </tr>




<?

  $cont++;
}
?>






</td>
  </tr>


</table>
