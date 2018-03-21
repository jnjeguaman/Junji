<?php
session_start();
require("inc/config.php");
require("inc/querys.php");
$nivel = $_SESSION["pfl_user"];
$regionsession = $_SESSION["region"];
$usuario=$_SESSION["nom_user"];
if($_SESSION["nom_user"] =="" ){
	?><script language="javascript">location.href='sesion_perdida.php';</script><?
}

$fechamia=date('Y-m-d');
$annomia=date('Y');
$fechamia2=date('d-m-Y');
$hora=date("H:i");


?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>bienvenidos</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="css/stylo_defensoriapenal2.css" rel="stylesheet" type="text/css">
<SCRIPT LANGUAGE="Javascript" SRC="grafico/FusionCharts.js"></SCRIPT>

</head>

<body>

<!-- calendar stylesheet -->
  <link rel="stylesheet" type="text/css" media="all" href="librerias/calendar-win2k-cold-1.css" title="win2k-cold-1" />

  <!-- main calendar program -->
  <script type="text/javascript" src="librerias/calendar.js"></script>

  <!-- language for the calendar -->
  <script type="text/javascript" src="librerias/lang/calendar-en.js"></script>

  <!-- the following script defines the Calendar.setup helper function, which makes
       adding a calendar a matter of 1 or 2 lines of code. -->
  <script type="text/javascript" src="librerias/calendar-setup.js"></script>
  
  <script type="text/javascript" src="jquery/jquery-1.6.4.js"></script>

<script>
<!--



function valida() {
  if (document.form2.fecha2.value == '' ) {
      alert ("Fecha Termino Presenta Problemas ");
      return false;
  }


}



-->
</script>
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

$("input").bind( "click", function() {
//    alert($(this).val());
      var a=($(this).val());
      var arreglo=a.split("|");
      
      var a=arreglo[0];
      var dos=arreglo[1];
//      alert(dos);
      
      var c=document.getElementById("a"+a).value;
      var b=document.getElementById("b"+a).checked;

      var d=document.getElementById("d"+a).value;
      var e=document.getElementById("e"+a).checked;

    if  (b && dos==1) {
//         alert(c);
//         alert(b);
         document.form22.totalfactura.value=Math.round(document.form22.totalfactura.value)+Math.round(c);
    }
    if  (!b && dos==1) {
//         alert(c);
//         alert(b);
         document.form22.totalfactura.value=Math.round(document.form22.totalfactura.value)-Math.round(c);
    }
    
    if  (e && dos==2) {
//         alert(e);
//         alert(d);
         document.form33.totalfactura2.value=Math.round(document.form33.totalfactura2.value)+Math.round(d);
    }
    if  (!e && dos==2) {
//         alert(e);
//         alert(d);
         document.form33.totalfactura2.value=Math.round(document.form33.totalfactura2.value)-Math.round(d);
    }


});

});//]]>

<!--
    function suma(a,b) {
       alert(a);
//         alert(document.form22["var["+b+"]"].checked);
         var c= document.form22["var["+b+"]"].checked;
//         alert (c);
         if  (c) {
            document.form22.totalfactura.value=Math.round(document.form22.totalfactura.value)+Math.round(a);
         }
         if  (!c) {
            document.form22.totalfactura.value=Math.round(document.form22.totalfactura.value)-Math.round(a);
         }
//        cantidad=Math.round(document.form22.totalfactura.value/document.form22.cantidad.value);
//        document.form22.totalfactura2.value=cantidad*document.form22.cantidad.value;
//         alert(cantidad);
   }

   -->
</script>
<?
$numero=$_POST["numero"];
$opcion=$_POST["opcion"];

     $sql=" select count(carto_id) as m11 from concilia_cartola where carto_estado='1' ";
     echo $sql."<br>";
     $res2 = mysql_query($sql);
     $row2 = mysql_fetch_array($res2);
     $m11=$row2["m11"];

      $sql=" select count(sigfe_id) as m22 from concilia_sigfe where sigfe_estado=1 ";
     echo $sql."<br>";
     $res2 = mysql_query($sql);
     $row2 = mysql_fetch_array($res2);
     $m22=$row2["m22"];
     
     

    $sql2 = "Select * from regiones where codigo=$regionsession";
    //echo $sql;
    $res2 = mysql_query($sql2);
    $row2 = mysql_fetch_array($res2);
    $activo4=$row2["activo4"];


?>

<div style="width:970px; height:80px; background-color:#EEEEEE; position:absolute; top:0px; left:00px; z-index:3;">
                     <a href="consolidacion_menu.php" class="link" > Volver </a>
<?
if ($activo4<>0) {
?>
 <form name="form2" action="consolidacion_historico.php" method="post"   >
<table border=0 width="50%">
                         <tr>
                             <td  valign="top" class="Estilo1">CUENTA</td>
                             <td class="Estilo1">
                                <select name="numero" class="Estilo1" onchange="this.form.submit()">
                                   <option value="0">Seleccione...</option>
                                 <?
                                    $sql2 = "Select * from concilia_cc where cc_region=$regionsession ";
                                  //echo $sql;
                                  $res2 = mysql_query($sql2);

                                   while($row2 = mysql_fetch_array($res2)){

                                 ?>
                                    <option value="<? echo $row2["cc_numero"] ?>" <? if ($row2["cc_numero"]==$numero) echo "selected=selected" ?> ><? echo $row2["cc_numero"] ?></option>

                                 <?
                                   }
                                 ?>


                               </select>


                             </td>
                           </tr>
</table>
             <input type="radio" name="opcion" value="1" onclick="this.form.submit()"  <? if ($opcion==1) { echo "checked"; } ?>>Procesados
             <input type="radio" name="opcion" value="2" onclick="this.form.submit()"  <? if ($opcion==2) { echo "checked"; } ?>>Manuales
             <input type="radio" name="opcion" value="3" onclick="this.form.submit()"  <? if ($opcion==3) { echo "checked"; } ?>>Solo Sigfe
             <input type="radio" name="opcion" value="7" onclick="this.form.submit()"  <? if ($opcion==3) { echo "checked"; } ?>>Solo Banco
<!--
             <input type="radio" name="opcion" value="4" onclick="this.form.submit()"  <? if ($opcion==4) { echo "checked"; } ?>>Auto sigfe
             <input type="radio" name="opcion" value="5" onclick="this.form.submit()"  <? if ($opcion==5) { echo "checked"; } ?>>Auto Cartola
-->
             <input type="radio" name="opcion" value="6" onclick="this.form.submit()"  <? if ($opcion==6) { echo "checked"; } ?>>Agrupados


             <a href="javascript:void(0)" onclick="window.open('consolidacion_reporte2a1.php?numero=<? echo $numero; ?>','','width=600,height=600,scrollbars=1,location=1')"   class="link">Sigfe</a>
             <a href="javascript:void(0)" onclick="window.open('consolidacion_reporte2c1.php?numero=<? echo $numero; ?>','','width=600,height=600,scrollbars=1,location=1')"   class="link">Cartola</a>
</form>


</div>

<div  style="width:970px; height:530px; background-color:#EEEEEE; position:absolute; top:110px; left:00px;" id="div1">



<table border=0 width="100%">
     <tr>
       <td colspan=6>Cartola</td>
       <td ></td>
       <td colspan=6>SIGFE</td>
     </tr>
     <tr class="">
     <th>SEL</th>
        <th>OP.</th>
        <th>Fecha</th>
        <th>N°</th>
        <th>Descripcion</th>
        <th>Cargo</th>
        <th>Abono</th>
        <th></th>
        <th>Fecha</th>
        <th>N°</th>
        <th>Descripcion</th>
        <th>Cargo</th>
        <th>Abono</th>
    </tr>
	</thead>
    <tbody>

 <tr  class="">
 <td></td>
   <td colspan=2>
   <input type="button" name="limpiarsigfe" value="Limpiar" onclick="ejectua2();" >
   <input type="button" name="enviarsigfe" value="Ir"  onchange="ejectua();">
  </td>
  <td>
   <input type="text" name="numcartola" value="<? echo $numsigfe ?>" size="2" onchange="ejectua();">
  </td>
  <td>
   <input type="text" name="descripcartola" value="<? echo $descripsigfe ?>" size="20" onchange="ejectua();">
  </td>
  <td>
   <input type="text" name="cargoscartola" value="<? echo $cargosigfe ?>" size="4" onchange="ejectua();">
  </td>
  <td>
   <input type="text" name="abonocartola" value="<? echo $abonosigfe ?>" size="4" onchange="ejectua();">
  </td>
   <td colspan=2>
     &nbsp;
   </td>
  <td>
   <input type="text" name="numsigfe" value="<? echo $numsigfe ?>" size="2" onchange="ejectua();">
  </td>
  <td>
   <input type="text" name="descripsigfe" value="<? echo $descripsigfe ?>" size="20" onchange="ejectua();">
  </td>
  <td>
   <input type="text" name="cargosigfe" value="<? echo $cargosigfe ?>" size="4" onchange="ejectua();">
  </td>
  <td>
   <input type="text" name="abonosigfe" value="<? echo $abonosigfe ?>" size="4" onchange="ejectua();">
  </td>

 </tr>

<form name="form22" action="sisap_grabahistorico.php" method="post"   onSubmit="return valida()"  enctype="multipart/form-data">
</form>
<form name="form222" action="consolidacion_historicoelimina2.php" method="POST" onsubmit="return valida()">
<?
//     $sql=" select * from concilia_indice x, concilia_cartola y, concilia_sigfe z where  x.indi_carto_id=y.carto_id and x.indi_sigfe_id=y.sigfe_id  ";

if ($opcion==1) {
     $sql=" select * from concilia_indice x, concilia_sigfe y, concilia_cartola z where (x.indi_tipo='1' or x.indi_tipo='2' or x.indi_tipo='4' or x.indi_tipo='8' ) and x.indi_carto_id=z.carto_id and z.carto_numero='$numero' and z.carto_region='$regionsession'  and x.indi_sigfe_id=y.sigfe_id and y.sigfe_numero='$numero' and (y.sigfe_estado<>3 and z.carto_estado<>3)";
}
if ($opcion==2) {
     $sql=" select * from concilia_indice x, concilia_sigfe y, concilia_cartola z where  x.indi_carto_id=z.carto_id  and z.carto_region='$regionsession' and z.carto_numero='$numero' and x.indi_sigfe_id=y.sigfe_id and y.sigfe_numero='$numero' and (x.indi_tipo=5 or x.indi_tipo=3 ) and (y.sigfe_estado<>3 and z.carto_estado<>3) ";
//     $sql=" select * from concilia_indice x, concilia_sigfe y, concilia_cartola z where  x.indi_carto_id=z.carto_id  and z.carto_region='$regionsession' and z.carto_numero='$numero' and x.indi_sigfe_id=y.sigfe_id and y.sigfe_numero='$numero' and (x.indi_tipo=5 or x.indi_tipo=3 ) and (y.sigfe_estado=2 and z.carto_estado=2) ";
//     $sql=" select * from concilia_indice x, concilia_sigfe y, concilia_cartola z where  x.indi_carto_id=z.carto_id and x.indi_sigfe_id=y.sigfe_id and x.indi_tipo=5 group by x.indi_carto_id ";
}
if ($opcion==3) {
     $sql=" select * from concilia_indice x, concilia_sigfe y where x.indi_sigfe_id=y.sigfe_id and y.sigfe_region='$regionsession' and (x.indi_tipo=3 or x.indi_tipo=7) and y.sigfe_numero='$numero' and (y.sigfe_estado=2) ";
}
if ($opcion==3) {
     $sql=" select * from concilia_indice x, concilia_sigfe y where x.indi_sigfe_id=y.sigfe_id and y.sigfe_region='$regionsession' and (x.indi_tipo=3 or x.indi_tipo=7) and y.sigfe_numero='$numero' and (y.sigfe_estado=2) ";
}


if ($opcion==4) {
     $sql=" select * from concilia_indice x, concilia_sigfe y, concilia_sigfe z where  x.indi_carto_id=z.sigfe_id  and z.sigfe_region='$regionsession' and z.sigfe_numero='$numero' and x.indi_sigfe_id=y.sigfe_id and x.indi_tipo=6 and (y.sigfe_estado<>3) ";
//     $sql=" select * from concilia_indice x, concilia_sigfe y where x.indi_sigfe_id=y.sigfe_id and y.sigfe_region='$regionsession' and x.indi_tipo=6 ";
}
if ($opcion==5) {
     $sql=" select * from concilia_indice x, concilia_cartola y, concilia_cartola z where  x.indi_carto_id=z.carto_id  and z.carto_region='$regionsession' and z.carto_numero='$numero' and x.indi_carto_id=y.carto_id and x.indi_tipo=9 and (y.carto_estado<>3) ";
//     $sql=" select * from concilia_indice x, concilia_sigfe y where x.indi_sigfe_id=y.sigfe_id and y.sigfe_region='$regionsession' and x.indi_tipo=6 ";
}
if ($opcion==6) {
       $sql=" select * from concilia_indice x, concilia_sigfe y, concilia_cartola z where  x.indi_carto_id=z.carto_id  and z.carto_region='$regionsession' and z.carto_numero='$numero' and x.indi_sigfe_id=y.sigfe_id and y.sigfe_numero='$numero' and (x.indi_tipo=8) and (y.sigfe_estado<>3 and z.carto_estado<>3) ";
//     $sql=" select * from concilia_indice x, concilia_sigfe y where x.indi_sigfe_id=y.sigfe_id and y.sigfe_region='$regionsession' and x.indi_tipo=6 ";
}
if ($opcion==7) {
       $sql=" select * from concilia_indice x, concilia_sigfe y, concilia_cartola z where  x.indi_carto_id=z.carto_id  and z.carto_region='$regionsession' and z.carto_numero='$numero' and x.indi_sigfe_id=y.sigfe_id and y.sigfe_numero='$numero' and (x.indi_tipo=8) and (y.sigfe_estado<>3 and z.carto_estado<>3) ";
//     $sql=" select * from concilia_indice x, concilia_sigfe y where x.indi_sigfe_id=y.sigfe_id and y.sigfe_region='$regionsession' and x.indi_tipo=6 ";
}



//    echo "<tr><td>----->".$sql."</td></tr>";
     $res2 = mysql_query($sql);
     $cont=1;
     while ($row2 = mysql_fetch_array($res2)) {
    $gruponuevo=$row2["indi_grupo"];
    if ($gruponuevo<>$grupoviejo and $grupoviejo<>'') {
        echo "<tr  class=''><td colspan=13><br></td></tr>";
    }
    
    
?>
 <tr  class="">
  <td>
 <input type="checkbox" name="var1[<?php echo $cont ?>]" value="<?php echo $row2["indi_id"] ?>">
 <input type="hidden" name="var2[<?php echo $cont ?>]" value="<?=$row2["indi_id"]?>">
 <input type="hidden" name="var3[<?php echo $cont ?>]" value="<?=$row2["indi_sigfe_id"]?>">
 <input type="hidden" name="var4[<?php echo $cont ?>]" value="<?=$row2["indi_carto_id"]?>">
 <input type="hidden" name="var5[<?php echo $cont ?>]" value="<?=$row2["indi_tipo"]?>">
 </td>
   <td>
     <? echo $cont;   ?>- <? echo $row2["indi_carto_id"];   ?>-   <? echo $row2["indi_sigfe_id"];   ?> -   <? echo $row2["indi_tipo"];   ?>
   </td>

   <td><? echo substr($row2["carto_fecha"],8,2)."-".substr($row2["carto_fecha"],5,2)."-".substr($row2["carto_fecha"],0,4) ?></td>
   <td><? echo $row2["carto_operacion"] ?></td>
   <td><? echo $row2["carto_descripcion"] ?></td>
   <td><? echo $row2["carto_cargo"] ?></td>
   <td><? echo $row2["carto_abono"] ?></td>
   <td>&nbsp;&nbsp;&nbsp;</td>
   
   <td><? echo substr($row2["sigfe_fecha"],6,2)."-".substr($row2["sigfe_fecha"],4,2)."-".substr($row2["sigfe_fecha"],0,4) ?></td>
   <td><? echo $row2["sigfe_numdoc"] ?></td>
   <td><? echo $row2["sigfe_bene"] ?></td>
   <td><? echo $row2["sigfe_cargo"] ?></td>
   <td><? echo $row2["sigfe_abono"] ?></td>
   <td>
     <a href="consolidacion_historicoelimina.php?id=<? echo $row2["indi_id"] ?>&idsigfe=<? echo $row2["indi_sigfe_id"] ?>&idcartola=<? echo $row2["indi_carto_id"] ?>&tipo=<? echo $row2["indi_tipo"] ?>" class="link" > ELIMINAR RELACION </a></td>
  </tr>

<?
     $cont++;
    $grupoviejo=$row2["indi_grupo"];
    }
    
}
else {
    echo "<br>PERIODO CERRADO<br>";
}

?>
<tr>
  <td colspan="20" align="right"><button type="submit">ELIMINAR SELECCIONADOS</button></td>
</tr>
    </tbody>
</table>

<input type="hidden" name="totalElementos" value="<?php echo $cont ?>">
</form>

 </div>







</body>
</html>


<script type="text/javascript">
  function valida(){
    return confirm('ESTÁ SEGURO DE PROCEDER CON LA CARGA DE DATOS');
  }
</script>