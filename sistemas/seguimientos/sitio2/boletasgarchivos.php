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
$read1= rand(0,1000000);
$read2= rand(0,1000000);
$read3= rand(0,1000000);
$read4= rand(0,1000000);
?>
<html>
<head>

  <script type="text/javascript" src="librerias/jquery-1.11.3.min.js"></script>
  <script type="text/javascript" src="librerias/jquery.blockUI.js"></script>
  <link rel="stylesheet" type="text/css" href="../../inventario/privado/sitio2/css/font-awesome.min.css">
  <title>Facturas y/o Boletas</title>
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
    font-weight: bold; }
  -->
</style>



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
  

  <script language="javascript">
    <!--
    function limpiar() {
      document.form1.dig.value="";
    }
    function verificador() {
      var rut = document.form1.rut.value;
      var dig = document.form1.dig.value;
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

     if (digito == 11) {
       digito = 0;
     }
     if (digito == 10) {
       digito = "k";
     }
     if (dig!=digito) {
      alert('Rut incorrecto, es  '+digito);
      document.form1.dig.focus();
    } else {
      traerDatos(rut);
//  alert('estoy en el else');
//  llamado();

}
//form.dig.value = digito;
}

function llamado() {
  alert('llamando al un alerta de otra funcion');
}

function nuevoAjax()
{
	/* Crea el objeto AJAX. Esta funcion es generica para cualquier utilidad de este tipo, por
	lo que se puede copiar tal como esta aqui */
	var xmlhttp=false;
	try
	{
		// Creacion del objeto AJAX para navegadores no IE
		xmlhttp=new ActiveXObject("Msxml2.XMLHTTP");
	}
	catch(e)
	{
		try
		{
			// Creacion del objet AJAX para IE
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		catch(E) { xmlhttp=false; }
	}
	if (!xmlhttp && typeof XMLHttpRequest!='undefined') { xmlhttp=new XMLHttpRequest(); }

	return xmlhttp;
}

function traerDatos(tipoDato)  {
	var ajax=nuevoAjax();
//    alert (" dato "+tipoDato);
ajax.open("POST", "buscaclient.php", true);
ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
ajax.send("d="+tipoDato);

ajax.onreadystatechange=function()	{
  if (ajax.readyState==4) {
			// Respuesta recibida. Coloco el texto plano en la capa correspondiente
			//capa.innerHTML=ajax.responseText;
			document.form1.nombre.value=ajax.responseText;

		}
	}
}

function traerDatos2(a,b,c)  {
	var ajax=nuevoAjax();
  tipoDato1=a;
  tipoDato2=b;
  rut=document.form1.rut.value;
    //alert (" dato "+c);
    ajax.open("POST", "buscaclient2.php", true);
    ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	//ajax.send("d="+tipoDato,"e="+rut);
  ajax.send("d="+tipoDato1+"&e="+tipoDato2);

  ajax.onreadystatechange=function()	{
    if (ajax.readyState==4) {
			// Respuesta recibida. Coloco el texto plano en la capa correspondiente
			//capa.innerHTML=ajax.responseText;
			//b=ajax.responseText;
      if (ajax.responseText == 1) {
               //  alert (" No Existe "+b);
             }
             if (ajax.responseText == 0) {
              alert ("Numero de Boleta Existe Para esta proveedor "+c);
//                  document.form1.nboleta1.value=ajax.responseText;
document.getElementById(c).value =ajax.responseText;
//                    document.getElementById(c).value =0;

}

}
}

}



function abreVentana(){
	miPopup = window.open("compra_listaresolucion.php?id=<? echo $id ?>&id2=<? echo $id2 ?>","miwin","width=500,height=500,scrollbars=yes,toolbar=0")
	miPopup.focus()
}


//-->


function validaGrabar() {

  if(confirm('¿ ESTÁ SEGURO DE PROCEDER CON LA CARGA DE DATOS ?')) {
    blockUI();
  }
  else{
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

  <div class="col-sm-9 col-lg-9">
    <div class="dash-unit2">

      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="20" colspan="2"><span class="Estilo7">EDITAR BOLETA DE GARANTÍA</span></td>
        </tr>
        <tr>
         <td><hr></td><td><hr></td>
       </tr>
       <tr>


        <?

        if (isset($_GET["llave"]))
         echo "<p>Registros insertados con Exito !";

       $id=$_GET["id"];
       $id2=$_GET["id2"];
       $sql5="select * from dpp_boletasg where boleg_id=$id";
//echo $sql;
       $res5 = mysql_query($sql5);
       $row5=mysql_fetch_array($res5);
       $boleg_id=$row5["boleg_id"];
       ?>
       <?php if ($_SESSION["pfl_user"] <> 3): ?>

         <td width="487" valign="top" class="Estilo1"><a href="boletasgformulario.php?id=<? echo $boleg_id ?>" class="link" target="_blank">Imprimir Formulario (Registro y Control de Garantia)</a><BR>
           <a href="valida2g.php" class="link">VOLVER</a>
         </td>
       <?php else: ?> 
        <td width="487" valign="top" class="Estilo1"><a href="boletasgarchivos_2.php" class="link">VOLVER</a></td>
      <?php endif ?>

    </tr>
    <tr>
     <td><hr></td><td><hr></td>
   </tr>


   <tr>
    <td height="50" colspan="3">
    </table>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
     <form name="form1" action="documentosg/grababoletasgarchivo.php" method="post"  onsubmit="return validaGrabar()"  enctype="multipart/form-data">

      <tr>
       <td  valign="center" class="Estilo1">Fecha Recepción</td>
       <td class="Estilo1" valign="center">
        <input type="text" name="fecha1" class="Estilo2" size="12" value="<? echo $row5["boleg_fecha_recep"] ?>" id="f_date_c1" readonly="1">
        <img src="calendario.gif" id="f_trigger_c1" style="cursor: pointer; border: 1px solid red;" title="Date selector"
        onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />

        <script type="text/javascript">
          Calendar.setup({
        inputField     :    "f_date_c1",     // id of the input field
        ifFormat       :    "%Y-%m-%d",      // format of the input field
        button         :    "f_trigger_c1",  // trigger for the calendar (button ID)
        align          :    "Tl",           // alignment (defaults to "Bl")
        singleClick    :    true
      });
    </script>

    Folio   <input type="text" name="folio" class="Estilo2" size="10" value="<? echo $row5["boleg_folio"] ?>" >
    <?
    $hora=substr($row5["boleg_hora_recep"],0,2);
    $min=substr($row5["boleg_hora_recep"],3,2);
//echo "$hora : $min ";
//$row5["boleg_hora"]
    ?>
  </td>
</tr>
<tr>
 <td  valign="top" class="Estilo1">Hora de Recepción  </td>
 <td class="Estilo1" colspan=3>Hora:
   <select name="hora" class="Estilo1">
     <option value='01' <? if ($hora=='01') echo "selected=selected" ?> >01</option>
     <option value='02' <? if ($hora=='02') echo "selected=selected" ?> >02</option>
     <option value='03' <? if ($hora=='03') echo "selected=selected" ?> >03</option>
     <option value='04' <? if ($hora=='04') echo "selected=selected" ?> >04</option>
     <option value='05' <? if ($hora=='05') echo "selected=selected" ?> >05</option>
     <option value='06' <? if ($hora=='06') echo "selected=selected" ?> >06</option>
     <option value='07' <? if ($hora=='07') echo "selected=selected" ?> >07</option>
     <option value='08' <? if ($hora=='08') echo "selected=selected" ?> >08</option>
     <option value='09' <? if ($hora=='09') echo "selected=selected" ?> >09</option>
     <option value='10' <? if ($hora=='10') echo "selected=selected" ?> >10</option>
     <option value='11' <? if ($hora=='11') echo "selected=selected" ?> >11</option>
     <option value='12' <? if ($hora=='12') echo "selected=selected" ?> >12</option>
     <option value='13' <? if ($hora=='13') echo "selected=selected" ?> >13</option>
     <option value='14' <? if ($hora=='14') echo "selected=selected" ?> >14</option>
     <option value='15' <? if ($hora=='15') echo "selected=selected" ?> >15</option>
     <option value='16' <? if ($hora=='16') echo "selected=selected" ?> >16</option>
     <option value='17' <? if ($hora=='17') echo "selected=selected" ?> >17</option>
     <option value='18' <? if ($hora=='18') echo "selected=selected" ?> >18</option>
     <option value='19' <? if ($hora=='19') echo "selected=selected" ?> >19</option>
     <option value='20' <? if ($hora=='20') echo "selected=selected" ?> >20</option>
     <option value='21' <? if ($hora=='21') echo "selected=selected" ?> >21</option>
     <option value='22' <? if ($hora=='22') echo "selected=selected" ?> >22</option>
     <option value='23' <? if ($hora=='23') echo "selected=selected" ?> >23</option>
     <option value='00' <? if ($hora=='00') echo "selected=selected" ?> >00</option>
   </select>
   Minutos :
   <select name="min" class="Estilo1">
     <option value='01' <? if ($min=='01') echo "selected=selected" ?>>01</option>
     <option value='02' <? if ($min=='02') echo "selected=selected" ?>>02</option>
     <option value='03' <? if ($min=='03') echo "selected=selected" ?>>03</option>
     <option value='04' <? if ($min=='04') echo "selected=selected" ?>>04</option>
     <option value='05' <? if ($min=='05') echo "selected=selected" ?>>05</option>
     <option value='06' <? if ($min=='06') echo "selected=selected" ?>>06</option>
     <option value='07' <? if ($min=='07') echo "selected=selected" ?>>07</option>
     <option value='08' <? if ($min=='08') echo "selected=selected" ?>>08</option>
     <option value='09' <? if ($min=='09') echo "selected=selected" ?>>09</option>
     <option value='10' <? if ($min=='10') echo "selected=selected" ?>>10</option>
     <option value='11' <? if ($min=='11') echo "selected=selected" ?>>11</option>
     <option value='12' <? if ($min=='12') echo "selected=selected" ?>>12</option>
     <option value='13' <? if ($min=='13') echo "selected=selected" ?>>13</option>
     <option value='14' <? if ($min=='14') echo "selected=selected" ?>>14</option>
     <option value='15' <? if ($min=='15') echo "selected=selected" ?>>15</option>
     <option value='16' <? if ($min=='16') echo "selected=selected" ?>>16</option>
     <option value='17' <? if ($min=='17') echo "selected=selected" ?>>17</option>
     <option value='18' <? if ($min=='18') echo "selected=selected" ?>>18</option>
     <option value='19' <? if ($min=='19') echo "selected=selected" ?>>19</option>
     <option value='20' <? if ($min=='20') echo "selected=selected" ?>>20</option>
     <option value='21' <? if ($min=='21') echo "selected=selected" ?>>21</option>
     <option value='22' <? if ($min=='22') echo "selected=selected" ?>>22</option>
     <option value='23' <? if ($min=='23') echo "selected=selected" ?>>23</option>
     <option value='24' <? if ($min=='24') echo "selected=selected" ?>>24</option>
     <option value='25' <? if ($min=='25') echo "selected=selected" ?>>25</option>
     <option value='26' <? if ($min=='26') echo "selected=selected" ?>>26</option>
     <option value='27' <? if ($min=='27') echo "selected=selected" ?>>27</option>
     <option value='28' <? if ($min=='28') echo "selected=selected" ?>>28</option>
     <option value='29' <? if ($min=='29') echo "selected=selected" ?>>29</option>
     <option value='30' <? if ($min=='30') echo "selected=selected" ?>>30</option>
     <option value='31' <? if ($min=='31') echo "selected=selected" ?>>31</option>
     <option value='32' <? if ($min=='32') echo "selected=selected" ?>>32</option>
     <option value='33' <? if ($min=='33') echo "selected=selected" ?>>33</option>
     <option value='34' <? if ($min=='34') echo "selected=selected" ?>>34</option>
     <option value='35' <? if ($min=='35') echo "selected=selected" ?>>35</option>
     <option value='36' <? if ($min=='36') echo "selected=selected" ?>>36</option>
     <option value='37' <? if ($min=='37') echo "selected=selected" ?>>37</option>
     <option value='38' <? if ($min=='38') echo "selected=selected" ?>>38</option>
     <option value='39' <? if ($min=='39') echo "selected=selected" ?>>39</option>
     <option value='40' <? if ($min=='40') echo "selected=selected" ?>>40</option>
     <option value='41' <? if ($min=='41') echo "selected=selected" ?>>41</option>
     <option value='42' <? if ($min=='42') echo "selected=selected" ?>>42</option>
     <option value='43' <? if ($min=='43') echo "selected=selected" ?>>43</option>
     <option value='44' <? if ($min=='44') echo "selected=selected" ?>>44</option>
     <option value='45' <? if ($min=='45') echo "selected=selected" ?>>45</option>
     <option value='46' <? if ($min=='46') echo "selected=selected" ?>>46</option>
     <option value='47' <? if ($min=='47') echo "selected=selected" ?>>47</option>
     <option value='48' <? if ($min=='48') echo "selected=selected" ?>>48</option>
     <option value='49' <? if ($min=='49') echo "selected=selected" ?>>49</option>
     <option value='50' <? if ($min=='50') echo "selected=selected" ?>>50</option>
     <option value='51' <? if ($min=='51') echo "selected=selected" ?>>51</option>
     <option value='52' <? if ($min=='52') echo "selected=selected" ?>>52</option>
     <option value='53' <? if ($min=='53') echo "selected=selected" ?>>53</option>
     <option value='54' <? if ($min=='54') echo "selected=selected" ?>>54</option>
     <option value='55' <? if ($min=='55') echo "selected=selected" ?>>55</option>
     <option value='56' <? if ($min=='56') echo "selected=selected" ?>>56</option>
     <option value='57' <? if ($min=='57') echo "selected=selected" ?>>57</option>
     <option value='58' <? if ($min=='58') echo "selected=selected" ?>>58</option>
     <option value='59' <? if ($min=='59') echo "selected=selected" ?>>59</option>
     <option value='00' <? if ($min=='00') echo "selected=selected" ?>>00</option>

   </select>

 </td>
</tr>

<tr>
 <td  valign="center" class="Estilo1" colspan=8><hr></td>
</tr>

<tr>
 <td class="Estilo1">Validación</td>
 <td>
   <table width="100%">
     <tr>
       <td class="Estilo1">Validado por entidad bancaria</td>
       <td class="Estilo1">
        <input type="radio" name="boleg_valido" id="boleg_valido" value="1" required <?php if($row5["boleg_valido"]){ echo "checked";} ?>> SI
        <input type="radio" name="boleg_valido" id="boleg_valido" value="0" required <?php if($row5["boleg_valido"]==0){ echo "checked";} ?>> NO
      </td>
    </tr>

    <tr>
     <td class="Estilo1">Fecha Gestion</td>
     <td>
       <input type="text" name="boleg_fgestion" class="Estilo1" size="12" value="<? echo $row5["boleg_fgestion"] ?>" id="boleg_fgestion" required>
       <img src="calendario.gif" id="f_trigger_c4" style="cursor: pointer; border: 1px solid red;" title="Date selector"
       onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />

       <script type="text/javascript">
        Calendar.setup({
          inputField     :    "boleg_fgestion",
          ifFormat       :    "%Y-%m-%d",
          button         :    "f_trigger_c4",
          align          :    "Tl",
          singleClick    :    true
        });
      </script>
    </td>

    <tr>
      <td class="Estilo1">Archivo PDF Certificado</td>
      <td class="Estilo1">
        <input type="file" name="boleg_archivov" id="boleg_archivov">
        <?php if ($row5["boleg_archivov"] <> ""): ?>
          <a href="<?php echo $row5["boleg_rutav"]."/".$row5["boleg_archivov"] ?>" class="link" target="_blank"><?php echo $row5["boleg_archivov"] ?></a>
        <?php endif ?>
      </td>
    </tr>
  </tr>
</table>
</td>
</tr>

<tr>
 <td  valign="center" class="Estilo1" colspan=8><hr></td>
</tr>


<tr>
 <td  valign="center" class="Estilo1">Tipo de Documento</td>
 <td class="Estilo1" colspan=3>
   <? $tipo2b=$row5["boleg_tipo2"] ?>
   <input type="Radio" name="tipo2" class="Estilo2" value="BOLETA GARANTIA" <? if ($tipo2b=='BOLETA GARANTIA') echo 'checked' ?> >BOLETA DE GARANTÍA<br>
   <input type="Radio" name="tipo2" class="Estilo2" value="VALE VISTA" <? if ($tipo2b=='VALE VISTA') echo 'checked' ?> >VALE VISTA<br>
   <input type="Radio" name="tipo2" class="Estilo2" value="POLIZA SEGURO" <? if ($tipo2b=='POLIZA SEGURO') echo 'checked' ?> >POLIZA DE SEGURO<br>
   <input type="Radio" name="tipo2" class="Estilo2" value="OTROS" <? if ($tipo2b=='OTROS') echo 'checked' ?> >OTROS<br>
 </td>
</tr>
<tr>
 <td  valign="center" class="Estilo1" colspan=8><hr></td>
</tr>


<tr>
 <td  valign="center" class="Estilo1">Tipo de Garantía </td>
 <td class="Estilo1" colspan=3>
  <? $tipob=$row5["boleg_tipo"] ?>
  <input type="Radio" name="tipo" class="Estilo2" value="SERIEDAD DE LA OFERTA" <? if ($tipob=='SERIEDAD DE LA OFERTA') echo 'checked' ?> >SERIEDAD DE LA OFERTA<br>
  <input type="Radio" name="tipo" class="Estilo2" value="FIEL CUMPLIMIENTO CONTRATO" <? if ($tipob=='FIEL CUMPLIMIENTO CONTRATO') echo 'checked' ?>  >FIEL CUMPLIMIENTO DE CONTRATO<br>
  <input type="Radio" name="tipo" class="Estilo2" value="ANTICIPO" <? if ($tipob=='ANTICIPO') echo 'checked' ?>>ANTICIPO<br>
  <input type="Radio" name="tipo" class="Estilo2" value="CUMPLIMIENTO OBLIGACIONES LABORALES"  <? if ($tipob=='CUMPLIMIENTO OBLIGACIONES LABORALES') echo 'checked' ?>>CUMPLIMIENTO OBLIGACIONES LABORALES<br>
  <input type="Radio" name="tipo" class="Estilo2" value="CORRECTA EJECUCION DE LA OBRA" <? if ($tipob=='CORRECTA EJECUCION DE LA OBRA') echo 'checked' ?>>CORRECTA EJECUCION DE LA OBRA<br>
  <input type="Radio" name="tipo" class="Estilo2" value="ANTICIPO DE CONTRATO" <? if ($tipob=='ANTICIPO DE CONTRATO') echo 'checked' ?>>ANTICIPO DE CONTRATO<br>
  <input type="Radio" name="tipo" class="Estilo2" value="TODO RIESGO DE CONSTRUCCION Y MONTAJE" <? if ($tipob=='TODO RIESGO DE CONSTRUCCION Y MONTAJE') echo 'checked' ?>>TODO RIESGO DE CONSTRUCCION Y MONTAJE<br>

</td>
</tr>

<tr>
 <td  valign="center" class="Estilo1" colspan=8><hr></td>
</tr>

<?
$idargedo2=$row5["boleg_idargedo"];
$sql6=" select * from argedo_documentos where docs_id=$idargedo2 ";
//echo $sql;
$res6 = mysql_query($sql6);
$row6=mysql_fetch_array($res6);
$docsfolio=$row6["docs_folio"];
$docsarchivo=$row6["docs_archivo"];
$docsfecha=$row6["docs_fecha"];

if ($docarchivo<>'') {
  $docsarchivo="../../archivos/docargedo/".$docsarchivo;
}



?>


<tr>
 <td  valign="center" class="Estilo1">N° Resolución </td>
 <td class="Estilo1" colspan=3>
  <input type="text" name="nroresolucion" class="Estilo2" size="18" value="<? echo $docsfolio ?>" >
  <input type="hidden" name="idargedo" class="Estilo2" size="8"  >
  <a href="#?id=<? echo $id ?>&id2=<? echo $id2 ?>" class="link" onclick="abreVentana()">Asociar Resolucion</a>
</td>
</tr>

<tr>
 <td  valign="center" class="Estilo1">Fecha Resolución</td>
 <td class="Estilo1" valign="center">
  <input type="text" name="fecha4" class="Estilo2" size="12" id="f_date_c4" readonly="1" value="<? echo $docsfecha ?>">


</tr>
<tr>
 <td  valign="center" class="Estilo1">Archivo Resolución</td>
 <td class="Estilo1" valign="center">
   <a href="<? echo $docsarchivo ?>" class="link" id="linkarchivo" target="_blank"><div id="verlink"><? echo $docsarchivo ?></div></a>


 </tr>

 <tr>
   <td  valign="top" class="Estilo1">Número Documento </td>
   <td class="Estilo1" colspan=3>
    <input type="text" name="nrogarantia" class="Estilo2" size="10" value="<? echo $row5["boleg_numero"] ?>" >
  </td>
</tr>
<tr>
 <td  valign="top" class="Estilo1">Institución Emisora</td>
 <td class="Estilo1" colspan=3>
  <input type="text" name="emisora" class="Estilo2" size="40" value="<? echo $row5["boleg_emisora"] ?>" >
</td>
</tr>
<tr>
 <td  valign="top" class="Estilo1">Monto</td>
 <td class="Estilo1" colspan=3>
  <input type="text" name="monto" class="Estilo2" size="15" value="<? echo $row5["boleg_monto"] ?>">
</td>
</tr>

<tr>
 <td  valign="top" class="Estilo1">Tipo Moneda</td>
 <td class="Estilo1" colspan=3>
  <input type="text" name="tipomoneda" class="Estilo2" size="15" value="<? echo $row5["boleg_tipomoneda"] ?>">
</td>
</tr>
<tr>
 <td  valign="center" class="Estilo1">Fecha Emisión</td>
 <td class="Estilo1" valign="center">
  <input type="text" name="fecha2" class="Estilo2" size="12" value="<? echo $row5["boleg_fecha_emision"] ?>" id="f_date_c2" readonly="1">
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


  </td>
</tr>
<tr>
 <td  valign="center" class="Estilo1">Fecha Vencimiento</td>
 <td class="Estilo1" valign="center">
  <input type="text" name="fecha3" class="Estilo2" size="12" value="<? echo $row5["boleg_fecha_vence"] ?>" id="f_date_c3" readonly="1">
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
 <td  valign="top" class="Estilo1">Rut Proveedor </td>
 <td class="Estilo1" colspan=3>
  <input type="text" name="rut" class="Estilo2" size="11" onchange="limpiar()" value="<? echo $row5["boleg_rut"] ?>" > -
  <input type="text" name="dig" class="Estilo2" size="2" value="<? echo $row5["boleg_dig"] ?>" > Rut sin puntos
</td>
</tr>

<tr>
 <td  valign="top" class="Estilo1">Razón Social </td>
 <td class="Estilo1" colspan=3>
  <input type="text" name="nombre" class="Estilo2" size="40" value="<? echo $row5["boleg_nombre"] ?>">
</td>
</tr>
<tr>
 <td  valign="top" class="Estilo1">Rut Tomador  </td>
 <td class="Estilo1" colspan=3>
  <input type="text" name="tomarut" class="Estilo2" size="11" onchange="limpiar2()" value="<? echo $row5["boleg_tomarut"] ?>" > -
  <input type="text" name="tomadig" class="Estilo2" size="2" value="<? echo $row5["boleg_tomadig"] ?>" > Rut sin puntos
</td>
</tr>

<tr>
 <td  valign="top" class="Estilo1">Nombre Tomador </td>
 <td class="Estilo1" colspan=3>
  <input type="text" name="tomanombre" class="Estilo2" size="40" value="<? echo $row5["boleg_tomanombre"] ?>">
</td>
</tr>
<tr>
 <td  valign="top" class="Estilo1">Id Licitacion </td>
 <td class="Estilo1" colspan=3>
  <input type="text" name="idlicitacion" class="Estilo2" size="40" value="<? echo $row5["boleg_idlicitacion"] ?>">
</td>
</tr>

<tr>
 <td>&nbsp;</td>
</tr>



<tr>
 <td  valign="top" class="Estilo1">Glosa de la Garantía  </td>
 <td class="Estilo1" colspan=3>
  <textarea name="glosa" rows="3" cols="25"><? echo $row5["boleg_glosa"] ?></textarea>
</td>
</tr>
<tr>
 <td  valign="top" class="Estilo1">Dirección </td>
 <td class="Estilo1" colspan=3>
  <input type="text" name="direccion" class="Estilo2" size="40" value="<? echo $row5["boleg_direccion"] ?>" maxlength="40">
</td>
</tr>
<tr>
 <td  valign="top" class="Estilo1">Fono </td>
 <td class="Estilo1" colspan=3>
  <input type="text" name="fono2" class="Estilo2" size="40" value="<? echo $row5["boleg_fono2"] ?>">
</td>
</tr>

<tr>
 <td  valign="top" class="Estilo1">Correo Electrónico</td>
 <td class="Estilo1" colspan=3>
  <input type="text" name="correo" class="Estilo2" size="40" value="<? echo $row5["boleg_correo"] ?>">
</td>
</tr>

<tr>
 <td  valign="top" class="Estilo1">Nombre Unidad Contacto </td>
 <td class="Estilo1" colspan=3>
  <input type="text" name="unidad" class="Estilo2" size="40" value="<? echo $row5["boleg_unidad"] ?>">
</td>
</tr>

<tr>
 <td  valign="center" class="Estilo1"><br>  </td>
 <td  valign="center" class="Estilo1"> </td>

</tr>

<tr>
 <td  valign="center" class="Estilo1" colspan=8><hr></td>
</tr>

<tr>
 <td  valign="center" class="Estilo1">Imagen Boleta </td>
 <td class="Estilo1" colspan=3>
  <input type="file" name="archivo1" class="Estilo2" size="20"  ><br>
  <a href="../../archivos/docgarantia/<? echo $row5["boleg_archivo"]; ?>?read1=<? echo $read1 ?>" class="link" target="_blank"><? echo $row5["boleg_archivo"]; ?></a>
</td>
</tr>
<tr>
 <td  valign="center" class="Estilo1">Formulario(Registro y Control) </td>
 <td class="Estilo1" colspan=3>
  <input type="file" name="archivo2" class="Estilo2" size="20"  ><br>
  <a href="../../archivos/docgarantia/<? echo $row5["boleg_archivo2"]; ?>?read2=<? echo $read2 ?>" class="link" target="_blank"><? echo $row5["boleg_archivo2"]; ?></a>
</td>
</tr>

<tr>
 <td  valign="center" class="Estilo1" colspan=8><hr></td>
</tr>
<tr>
 <td  valign="top" class="Estilo1">Email 1 </td>
 <td class="Estilo1" colspan=3>
  <input type="text" name="mail1" class="Estilo2" size="40" value="<? echo $row5["boleg_mail1"] ?>">
</td>
</tr>
<tr>
 <td  valign="top" class="Estilo1">Email 2 </td>
 <td class="Estilo1" colspan=3>
  <input type="text" name="mail2" class="Estilo2" size="40" value="<? echo $row5["boleg_mail2"] ?>">
</td>
</tr>
<tr>
 <td  valign="top" class="Estilo1">Email 3 </td>
 <td class="Estilo1" colspan=3>
  <input type="text" name="mail3" class="Estilo2" size="40" value="<? echo $row5["boleg_mail3"] ?>">
</td>
</tr>
<tr>
 <td  valign="top" class="Estilo1">Email 4 </td>
 <td class="Estilo1" colspan=3>
  <input type="text" name="mail4" class="Estilo2" size="40" value="<? echo $row5["boleg_mail4"] ?>">
</td>
</tr>
<tr>
 <td  valign="top" class="Estilo1">Email 5 </td>
 <td class="Estilo1" colspan=3>
  <input type="text" name="mail5" class="Estilo2" size="40" value="<? echo $row5["boleg_mail5"] ?>">
</td>
</tr>

<tr>
 <td  valign="center" class="Estilo1"><br><br><br>  </td>
 <td  valign="center" class="Estilo1"> </td>

</tr>
<?
if ($nivel<>23) {
  ?>

  <tr>



   <input type="hidden" name="id" value="<? echo $id  ?>">
   <input type="hidden" name="sw" value="1">
   <td colspan=4 align="center"> <input type="submit" value="    GRABAR BOLETA DE GARANTÍA   " > </td>
 </tr>
 <?
}
?>

<tr>
 <td  valign="center" class="Estilo1" colspan=8><hr></td>
</tr>


<tr>
 <td  valign="center" class="Estilo1" colspan=8>Nota: Grabar boleta antes de enviar por e-mail</td>
</tr>





</form>

<form name="form2" action="mail1boletasg.php" method="post"   >
  <table>
   <tr>
     <td  valign="center" class="Estilo1" colspan=8></td>
   </tr>
   <tr>
     <td  valign="top" class="Estilo1">Email 1 </td>
     <td class="Estilo1" colspan=3>
      <input type="checkbox" name="envia1" class="Estilo2" value="1">
      <input type="hidden" name="mail1" class="Estilo2" size="40" value="<? echo $row5["boleg_mail1"] ?>"><? echo $row5["boleg_mail1"] ?>
    </td>
  </tr>
  <tr>
   <td  valign="top" class="Estilo1">Email 2 </td>
   <td class="Estilo1" colspan=3>
    <input type="checkbox" name="envia2" class="Estilo2" value="1">
    <input type="hidden" name="mail2" class="Estilo2" size="40" value="<? echo $row5["boleg_mail2"] ?>"><? echo $row5["boleg_mail2"] ?>
  </td>
</tr>
<tr>
 <td  valign="top" class="Estilo1">Email 3 </td>
 <td class="Estilo1" colspan=3>
  <input type="checkbox" name="envia3" class="Estilo2" value="1">
  <input type="hidden" name="mail3" class="Estilo2" size="40" value="<? echo $row5["boleg_mail3"] ?>"><? echo $row5["boleg_mail3"] ?>
</td>
</tr>
<tr>
 <td  valign="top" class="Estilo1">Email 4 </td>
 <td class="Estilo1" colspan=3>
  <input type="checkbox" name="envia4" class="Estilo2" value="1">
  <input type="hidden" name="mail4" class="Estilo2" size="40" value="<? echo $row5["boleg_mail4"] ?>"><? echo $row5["boleg_mail4"] ?>
</td>
</tr>
<tr>
 <td  valign="top" class="Estilo1">Email 5 </td>
 <td class="Estilo1" colspan=3>
  <input type="checkbox" name="envia5" class="Estilo2" value="1">
  <input type="hidden" name="mail5" class="Estilo2" size="40" value="<? echo $row5["boleg_mail5"] ?>"><? echo $row5["boleg_mail5"] ?>
</td>
</tr>

<tr>
 <td  valign="center" class="Estilo1"><br><br><br>  </td>
 <td  valign="center" class="Estilo1"> </td>

</tr>

<tr>
 <input type="hidden" name="id" value="<? echo $id  ?>">
 <input type="hidden" name="sw" value="1">
 <td colspan=4 align="center"> <input type="submit" value="    Enviar Mail " > </td>
</tr>

</table>
</form>

</td>


<tr>
 <td><hr></td><td><hr></td><td><hr></td><td><hr></td>
</tr>

<tr>
  <td><br></tr>
  </tr>

  <tr>
    <td><br></tr>
    </tr>
    <tr>
      <td><br></tr>
      </tr>
      <tr>
        <td><br></tr>
        </tr>
        <tr>
          <td><br></tr>
          </tr>
          <tr>
            <td><br></tr>
            </tr>
            <tr>



            </td>
          </tr>


        </table>

        <img src="images/pix.gif" width="1" height="10">
      </body>
      </html>

      <?

      ?>
