<?
session_start();
require("inc/config.php");
$fechamia=date('Y-m-d');
$hora=date("h:i");

?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>bienvenidos</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="css/stylo_defensoriapenal.css" rel="stylesheet" type="text/css">

</head>

<body>
<script>
<!--
function pasarut(){
  document.form2.rut2.value=document.form1.rut.value;
}

function verificador() {
var rut = document.form1.rut.value;
//var dig = document.form1.dig.value;
var count = 0;
var count2 = 0;
var factor = 2;
var suma = 0;
var sum = 0;
var digito = 0;
count2 = rut.length - 1;
	while(count < rut.length) {

		sum = factor * (parseInt(rut.substr(count2,1)));
		suma = suma + sum;
		sum = 0;

		count = count + 1;
		count2 = count2 - 1;
		factor = factor + 1;

		if(factor > 7) {
			factor=2;
		}

	}
digito = 11 - (suma % 11);
digito2 = 11 - (suma % 11);

document.form1.dig.value = digito;
document.form2.dig2.value = digito;
//alert(digito);


if (digito == 11) {
	document.form1.dig.value = 0;
    document.form2.dig2.value = 0;
}
if (digito == 10) {
	document.form1.dig.value = "K";
    document.form2.dig2.value = "K";
}

}
function mostrar() {
    if (document.form2.consulta[0].checked!='')  {
       seccion1.style.display="none";
    }
    if (document.form2.consulta[1].checked!='')  {
       seccion1.style.display="";
    }
    if (document.form2.consulta[2].checked!='')  {
       seccion1.style.display="";
    }
    if (document.form2.consulta[3].checked!='')  {
       seccion1.style.display="none";
    }

}

function valida() {
  if (document.form2.nombres.value == '' ) {
      alert ("Nombres Presenta Problemas ");
      return false;
  }
  if (document.form2.paterno.value == '' ) {
      alert ("Apellido Paterno Presenta Problemas ");
      return false;
  }
  if (document.form2.materno.value == '' ) {
      alert ("Apellido Materno Presenta Problemas ");
      return false;
  }

  if (document.form2.consulta[0].checked==''  && document.form2.consulta[1].checked=='' && document.form2.consulta[2].checked=='' && document.form2.consulta[3].checked=='' ) {
      alert ("Tipo Consulta presenta problemas ");
      return false;
  }

  if ((document.form2.consulta[1].checked!='' || document.form2.consulta[2].checked!='') && document.form2.ricrud.value=='' ) {
      alert ("RIC O RUD presenta problemas ");
      return false;
  }

  if ((document.form2.consulta[1].checked!='' || document.form2.consulta[2].checked!='') && (document.form2.sexo[0].checked=='' && document.form2.sexo[1].checked=='') ) {
      alert ("Sexo presenta problemas ");
      return false;
  }
  if ((document.form2.consulta[1].checked!='' || document.form2.consulta[2].checked!='') && (document.form2.usuarioes[0].checked=='' && document.form2.usuarioes[1].checked=='' && document.form2.usuarioes[2].checked==''  && document.form2.usuarioes[3].checked=='' ) ) {
      alert ("El Usuario Es presenta problemas ");
      return false;
  }
  if ((document.form2.consulta[1].checked!='' || document.form2.consulta[2].checked!='') && (document.form2.vez[0].checked=='' && document.form2.vez[1].checked=='' ) ) {
      alert ("Primera Vez Que Viene presenta problemas ");
      return false;
  }
  if ((document.form2.consulta[1].checked!='' || document.form2.consulta[2].checked!='') && document.form2.motivo.value == '' ) {
      alert ("Motivo Presenta Problemas ");
      return false;
  }

  if (document.form2.obs.value == '' ) {
      alert ("Observacion Presenta Problemas ");
      return false;
  }


}

-->
</script>

<table width="100%" height="80" border="0" align="center" cellpadding="0" cellspacing="0" >
<tr>
  <td colspan=10 align=center class="Estilo1titulo">
  SISTEMA ATENCIÓN PUBLICO DPP
   </td>
</tr>
<tr>
<td width="270">
<img src="dpp.JPG" width="225" height="86">
</td>
<?
include("inc/menu_1b.php");
?>
</tr>
</table>
<hr>


<div  style="width:700px; height:530px; background-color:#F2F2F2; position:absolute; top:130px; left:00px;" id="div1">
<?
$sw=$_POST["sw"];
$rut=$_POST["rut"];
$dig=$_POST["dig"];
//if (!isset($year)) {
if (isset($_GET["rut"]) ) {
    $rut=$_GET["rut"];
    $dig=$_GET["dig"];
    $llave=$_GET["llave"];

}
if ($sw==1 or $llave==1) {
     $sql2 = "Select * from sisap_atencion where ate_rut='$rut' group by ate_rut";
//     echo $sql2;
     $res2 = mysql_query($sql2);
     $row2 = mysql_fetch_array($res2);
     $nombres=$row2["ate_nombres"];
     $textono="";
     if ($nombres=='') {
       $textono="RUT No Existe";
     }


}

?>

<table border=0 width="100%">
 <form name="form1" action="sisap_index.php" method="post">
 <tr>
   <td  class="Estilo1" colspan=4>R.U.T.
   <input type="text" name="rut" class="Estilo2" size="12" onkeypress="if (event.keyCode < 47 || event.keyCode > 57) event.returnValue = false;" value="<? echo $rut ?>" > -   <input type="text" name="dig" value="<? echo $dig ?>" size=1  style="text-align:center; background-color:#9F9F9F" readonly >
   &nbsp;&nbsp;&nbsp;&nbsp; <input type="submit" name="boton" class="Estilo2" value="  BUSCAR" onclick="verificador();" > <br>* Sin Puntos, Ni Digito Verificador
   <p><? echo $textono ?></p>  </td>
 </tr>
  <tr>
   <td  class="Estilo1"><br></td>
 </tr>
  <input type="hidden" name="sw" value="1"  >
 </form>
 
 <form name="form2" action="sisap_grabaindex.php" method="post"   onSubmit="return valida()">
 <tr>
   <td  class="Estilo1">NOMBRES</td>
   <td  class="Estilo1">PATERNO</td>
   <td  class="Estilo1">MATERNO</td>
 </tr>

 <tr>
   <td  class="Estilo1"><input type="text" name="nombres" class="Estilo2" size="40" value="<? echo $row2["ate_nombres"] ?>" > </td>
   <td  class="Estilo1"><input type="text" name="paterno" class="Estilo2" size="30" value="<? echo $row2["ate_apellidop"] ?>" > </td>
   <td  class="Estilo1"><input type="text" name="materno" class="Estilo2" size="30" value="<? echo $row2["ate_apellidom"] ?>" > </td>
 </tr>
</table>
<table border=0 width="100%">
 <tr>
   <td  class="Estilo1">TIPO DE CONSULTA </td>
   <td  class="Estilo1" width="500">
     <input type="radio" name="consulta" class="Estilo2" value="Consulta General"  onclick="mostrar();">Consulta General<br>
     <input type="radio" name="consulta" class="Estilo2" value="Visita Programada"  onclick="mostrar();">Visita Programada<br>
     <input type="radio" name="consulta" class="Estilo2" value="Agendar Visita"  onclick="mostrar();">Agendar Visita<br>
     <input type="radio" name="consulta" class="Estilo2" value="Sename"  onclick="mostrar();">Sename<br>
   </td>
 </tr>

 </table>
   <div id="seccion1" style="display:none">

   <table border=0 width="100%">

 <tr>
   <td  class="Estilo1">RIC o RUD</td>
   <td  class="Estilo1"><input type="text" name="ricrud" class="Estilo2" size="30" value="" > </td>
 </tr>
 <tr>
   <td  class="Estilo1">SEXO</td>
   <td  class="Estilo1" width="500">
     <input type="radio" name="sexo" class="Estilo2" value="MASCULINO"  >Maculino
     <input type="radio" name="sexo" class="Estilo2" value="FEMENINO"  >Femenino<br><br>
   </td>
 </tr>
  <tr>
     <td  valign="center" class="Estilo1">EL USUARIO ES</td>
     <td class="Estilo1" colspan=3 width="500">
     <input type="radio" name="usuarioes" class="Estilo2" value="IMPUTADO"  >Imputado
     <input type="radio" name="usuarioes" class="Estilo2" value="FAMILIAR DEL IMPUTADO"  >Familiar Del Imputado<br>
     <input type="radio" name="usuarioes" class="Estilo2" value="VICTIMA"  >Victima
     <input type="radio" name="usuarioes" class="Estilo2" value="OTRO"  >Otro<br><BR>

      </td>
 </tr>
 <tr>
   <td  class="Estilo1">PRIMERA VEZ QUE VIENE</td>
   <td  class="Estilo1" width="500">
     <input type="radio" name="vez" class="Estilo2" value="SI"  >Si
     <input type="radio" name="vez" class="Estilo2" value="NO"  >No<br><br>
   </td>
 </tr>
  <tr>
     <td  valign="center" class="Estilo1">MOTIVO CONSULTA</td>
     <td class="Estilo1" colspan=3 width="500">
         <select name="motivo" class="Estilo1">
            <option value="">Seleccione...</option>
<?
           $sql2 = "Select * from sisap_requerimiento order by req_nombre  ";
           //echo $sql;
           $res2 = mysql_query($sql2);
           while($row2 = mysql_fetch_array($res2)){
?>
            <option value="<? echo $row2["req_nombre"] ?>"><? echo $row2["req_nombre"] ?></option>
<?
           }
?>
        </select>
      </td>
 </tr>

    </table>
 </div>
 <table border=0 width="100%">
 <tr>
     <td  valign="center" class="Estilo1">OBSERVACION </td>
     <td class="Estilo1" colspan=3>
          <textarea name="obs" rows="4" cols="60"><? echo $row["cont_nombre1"]; ?></textarea>
       </td>
  </tr>

 
 <tr>
   <td  class="Estilo1c" colspan=4><input type="submit" class="Estilo2" value="          Grabar  " > <a href="sisap_index.php" class="link">Crear Nueva Atención</a></td> </tr>

</table>
  <input type="hidden" name="rut2" value="<? echo $rut ?>"  >
  <input type="hidden" name="dig2" value="<? echo $dig ?>"  >
    <input type="hidden" name="hora2" value="<? echo $hora ?>"  >
</form>
</div>


<div  style="width:630px; height:200px; background-color:#F2F2F2; position:absolute; top:350px; left:710px; overflow: scroll " id="div2">
<table border=0 width="100%">
 <tr>
   <td  class="Estilo1c" colspan="10">ATENCIONES PENDIENTES PARA CITAS</td>
 </tr>

 <tr>
   <td  class="Estilo1mc">LLEGADA</td>
   <td  class="Estilo1mc">FECHA</td>
   <td  class="Estilo1mc">RUT</td>
   <td  class="Estilo1mc">NOMBRES</td>
   <td  class="Estilo1mc">PATERNO</td>
   <td  class="Estilo1mc">MATERNO</td>
   <td  class="Estilo1mc">MOTIVO</td>
   <td  class="Estilo1mc">USUARIO</td>
 </tr>

<?
     $sql2 = "Select * from sisap_atencion where ate_tipo='VISITA PROGRAMADA' and ate_hora_salida=0 order by ate_id desc";
//     echo $sql2;
     $res2 = mysql_query($sql2);
     while ($row2 = mysql_fetch_array($res2)) {
     $nombres=$row2["ate_nombres"];
?>
 <tr>
   <td  class="Estilo1m"><? echo $row2["ate_hora_ingreso"] ?></td>
   <td  class="Estilo1m"><? echo $row2["ate_fecha"] ?></td>
   <td  class="Estilo1mr"><? echo number_format($row2["ate_rut"],0,',','.') ?>-<? echo $row2["ate_dig"] ?></td>
   <td  class="Estilo1m"><? echo $row2["ate_nombres"] ?></td>
   <td  class="Estilo1m"><? echo $row2["ate_apellidop"] ?></td>
   <td  class="Estilo1m"><? echo $row2["ate_apellidom"] ?></td>
   <td  class="Estilo1m"><? echo $row2["ate_motivo"] ?></td>
   <td  class="Estilo1m"><? echo $row2["ate_user"] ?></td>
 </tr>

<?

    }
?>

</table>
</div>

<div  style="width:630px; height:200px; background-color:#F2F2F2; position:absolute;  top:130px; left:710px;overflow: scroll " id="div3">
<table border=0 width="100%">
 <tr>
   <td  class="Estilo1c" colspan="10">HISTORIAL DE ATENCIONES</td>
 </tr>

 <tr>
   <td  class="Estilo1m">FECHA</td>
   <td  class="Estilo1m">NOMBRES</td>
   <td  class="Estilo1m">PATERNO</td>
   <td  class="Estilo1m">MATERNO</td>
   <td  class="Estilo1m">T.CONSULTA</td>
   <td  class="Estilo1m">MOTIVO</td>
   <td  class="Estilo1m">OBS</td>
   <td  class="Estilo1m">USUARIO</td>
 </tr>

<?
     $sql2 = "Select * from sisap_atencion where ate_rut='$rut' order by ate_id desc";
//     echo $sql2;
     $res2 = mysql_query($sql2);
     while ($row2 = mysql_fetch_array($res2)) {
     $nombres=$row2["ate_nombres"];
?>
 <tr>
   <td  class="Estilo1m"><? echo $row2["ate_fecha"] ?></td>
   <td  class="Estilo1m"><? echo $row2["ate_nombres"] ?></td>
   <td  class="Estilo1m"><? echo $row2["ate_apellidop"] ?></td>
   <td  class="Estilo1m"><? echo $row2["ate_apellidom"] ?></td>
   <td  class="Estilo1m"><? echo $row2["ate_tipo"] ?></td>
   <td  class="Estilo1m"><? echo $row2["ate_motivo"] ?></td>
   <td  class="Estilo1m"><? echo $row2["ate_obs"] ?></td>
   <td  class="Estilo1m"><? echo $row2["ate_user"] ?></td>
 </tr>

<?

    }
?>

</table>
</div>


</body>
</html>

