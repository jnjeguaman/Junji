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


$sql21 = "Select * from parametros";
$res21 = mysql_query($sql21);
$row21 = mysql_fetch_array($res21);
$mes21=$row21["para_mes"];
$ano21=$row21["para_anno"];


$sql22 = "Select * from regiones  where codigo=$regionsession";
$res22 = mysql_query($sql22);
$row22 = mysql_fetch_array($res22);
$activo2=$row22["activo2"];



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
.Estilo1ce {
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
	text-align: right;
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
font-size: 15px; font-weight: bold; }
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

function modificaAjax(a,b)  {
	var ajax=nuevoAjax();
    var c= document.form1["var["+a+"]"].value;
//    alert (" dato "+a+" "+c+" "+b);
//    alert (" dato "+tipoDato1);

 	ajax.open("POST", "fpago.php", true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    ajax.send("a="+c);

	ajax.onreadystatechange=function()	{
		if (ajax.readyState==4) {
			// Respuesta recibida. Coloco el texto plano en la capa correspondiente
			//capa.innerHTML=ajax.responseText;
			//b=ajax.responseText;
            document.getElementById(b).innerHTML = ajax.responseText;
            document.form1["var6["+a+"]"].value=ajax.responseText;
//          document.getElementById(c).value =ajax.responseText;
//          document.getElementById(c).value =0;



		}
	}


}


function Validar() {
    var nn=document.forms[0].elements.length;
    var nn=document.form1.cont.value;
//    alert("entra a la funcion "+nn);

    for(i=1; i<nn;i++){
//        v4=document.form1["var4["+i+"]"].value;
          v1=document.form1["var["+i+"]"].checked;
//         alert(v1);
         if (v1) {
            v2=document.form1["var2["+i+"]"].value;
            v3=document.form1["var3["+i+"]"].value;
            v4=document.form1["var4["+i+"]"].value;
            if (v2=='') {
                alert("Campo Id Tesore. Vacio")
                return false;
            }
            if (v3=='') {
                alert("Campo N�Che/TR Vacio")
                return false;
            }
            if (v4=='') {
                alert("Campo Fechas de Cheques Vacio")
                return false;
            }


         }

    }

//      alert("no");
      return true;


}
function comparafecha(a) {
    uno=document.form1["var4["+a+"]"].value;
    dos=document.form1["var5["+a+"]"].value;
    Mes2=document.form1.mes21.value;
    Ano2=document.form1.ano21.value;
    var Dia= new String(uno.substring(uno.lastIndexOf("-")+1,uno.length))
    // Cadena Mes
    var Mes= new String(uno.substring(uno.indexOf("-")+1,uno.lastIndexOf("-")))
    // Cadena D�a
    var Ano= new String(uno.substring(0,uno.indexOf("-")))
    
//    alert(uno+"--"+dos+"-- "+Ano+" "+Mes+" "+Dia);

/* 
SE DESHABILITA VALIDACION MOMENTANEAMENTE
    if (dos>uno) {
        alert("Error Fehca de Cheque menor a Fecha Aprobacion");
        document.form1["var4["+a+"]"].value="";
        
    }
    if (Mes!=Mes2 || Ano!=Ano2) {
        alert("Error Fehca de Cheque No Corresponde a Periodo");
        document.form1["var4["+a+"]"].value="";
    }
    */

    
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
                    <td height="20" colspan="2"><span class="Estilo7">&nbsp;&nbsp;&nbsp;2.- ADMINISTRACI�N PAGO PROVEEDORES  &nbsp;&nbsp;&nbsp;MES : <? echo $mes21."-".$ano21 ?></span></td>
                  </tr>
                       <tr>
                       <td><hr></td><td><hr></td>
                      </tr>
<?
$region=$_GET["region"];
$fecha1=$_GET["fecha1"];
$fecha2=$_GET["fecha2"];
$rut=$_GET["rut"];
$item=$_GET["item"];
$consolidado=$_GET["consolidado"];

$id=$_GET["id"];
$ori=$_GET["ori"];
if ($ori==1) {
    $sql2 = "update dpp_etapas set eta_estado='5' where eta_id=$id";
//    echo $sql2;
    mysql_query($sql2);

}


?>



                   <tr>
                    <td height="50" colspan="3">
             </table>
     <table width="100%" border="0" cellspacing="0" cellpadding="0">
       <form name="form1" action="grabavalida6.php" method="post"  onSubmit="return Validar()">
               <tr>
                             <td class="Estilo1" colspan=4> <a href="valida5b.php" class="link">&nbsp;&nbsp;&nbsp;1.- RECEPCION FISICA A PAGO </a> | <a href="valida7.php" class="link">3.- ENTREGA PAGO A PROVEEDORES </a> <BR>
               </tr>
               <tr>
                <td><br></td>
                </tr>
<?
if ($activo2==1) {

?>

                           <tr>
                             <td  valign="center" class="Estilo1" colspan=4 align="center"><input type="submit" name="boton" class="Estilo2" value="  GRABAR DATOS"> </td>
                             

                           </tr>
<?
}
?>


                      </td>


                       <tr>
                      
                      </tr>
                      <tr>

                      <table border=1>
                        

                        <tr>
                         <td class="Estilo1ce">Fol/Op.</td>
                         <td class="Estilo1ce">Id Tesore.</td>
                         <td class="Estilo1ce">N�Che/TR</td>
                         <td class="Estilo1ce">Fechas__de__Cheques / Transferencia</td>
                         <td class="Estilo1ce">Nombre_Provee.</td>
                         <td class="Estilo1ce">F. Pago</td>
              			<td class="Estilo1ce">N� Doc.</td>
            			<td class="Estilo1ce">A Pagar </td>
                         <td class="Estilo1ce">Recepci�n</td>
                         <td class="Estilo1ce">D�as</td>
                         <!-- <td class="Estilo1ce">Libro SII</td> -->
                         <td class="Estilo1b">Volver</td>
                        </tr>

<?

$sql5="select * from dpp_plazos ";
//echo $sql;
$res5 = mysql_query($sql5);
$row5 = mysql_fetch_array($res5);
$etapa6a=$row5["pla_etapa6a"];
$etapa6b=$row5["pla_etapa6b"];

if ($regionsession==0) {
    $sql="select * from dpp_etapas where eta_estado=6 order by eta_fecha_recepcion";
} else {
    $sql="select * from dpp_etapas where eta_estado=6 and eta_region=$regionsession order by eta_folio desc, eta_fecha_recepcion desc  ";
}

//echo $sql;
$res3 = mysql_query($sql);
$cont=1;

while($row3 = mysql_fetch_array($res3)){
    $fechahoy = $date_in;
    $dia1 = strtotime($fechahoy);
    $fechabase =$row3["eta_fecha_recepcion"];
    $dia2 = strtotime($fechabase);
    $diff=$dia1-$dia2;
    $diff=intval($diff/(60*60*24));
    if ($etapa6a>=$diff)
      $clase="Estilo1cverde";
    if ($etapa6a<$diff and $etapa6b>=$diff )
      $clase="Estilo1camarrillo";
    if ( $etapa6b<$diff)
      $clase="Estilo1crojo";
      
      
    if ($row3["eta_tipo_doc"]=="Factura") {
        $archivo="verdocedit.php";
    }
    if ($row3["eta_tipo_doc"]=="Honorario") {
        $archivo="verdoc2edit.php";
    }
    
    $varitem=$row3["eta_item"];
    $varfecha=$row3["eta_fecha_aprobacionok"];
    $varservicio=$row3["eta_servicio_final"];
    
    if ($row3["eta_fpago"]=="Cheque") {
        $fpago="Ch";
    }
    if ($row3["eta_fpago"]=="Transferencia") {
        $fpago="Tr";
    }
    if ($row3["eta_fpago"]=="") {
        $fpago="No";
    }

    $etatipodoc3=$row3["eta_tipo_doc3"];
    $etatipodoc=$row3["eta_tipo_doc"];

?>
                      

                       <tr>
<?
                      if (($varitem<>"" and $varfecha<>"" and $varservicio<>"" and $etatipodoc3<>'') or $etatipodoc=='Honorario' ) {
?>
                         <td class="Estilo1b"><? echo $row3["eta_folio"]  ?><input type="checkbox" name="var[<? echo $cont ?>]" value="<? echo $row3["eta_id"] ?>" class="Estilo2" > </td>
<?
                      } else {
                          echo "<td class='Estilo1b'>".$row3["eta_folio"]; ?><div id="seccion2" style="display:none"><input type="checkbox" name="var[<? echo $cont ?>]" value="<? echo $row3["eta_id"] ?>" class="Estilo2" ></div>  <?
                      }
                      $fechaa=$row3["eta_fecha_aprobacionok"];
//                      $a=substr($a,8,2)."-".substr($a,5,2)."-".substr($a,0,4);
                      
?>
                         <td class="Estilo1b"><input type="text" name="var2[<? echo $cont ?>]" class="Estilo2" size="6"> </td>
                         <td class="Estilo1b">
                         <input type="text" name="var3[<? echo $cont ?>]" class="Estilo2" size="6" value="">
                         <input type="hidden" name="var5[<? echo $cont ?>]" value="<? echo $fechaa;  ?>"  class="Estilo2" size="6">
                         <input type="hidden" name="var6[<? echo $cont ?>]" value="<? echo $fpago ?>"  class="Estilo2" size="6">
                         <input type="hidden" name="var7[<? echo $cont ?>]" value="<? echo $row3["eta_rut"] ?>"  class="Estilo2" size="6">
                         <input type="hidden" name="var8[<? echo $cont ?>]" value="<? echo $row3["eta_numero"] ?>"  class="Estilo2" size="6">
                         </td>
                         <td class="Estilo1b">
<input type="text" name="var4[<? echo $cont ?>]" class="Estilo2" size="12" value="" id="f_date_c<? echo $cont ?>" readonly="1" onchange="comparafecha(<? echo $cont ?>);">
<img src="calendario.gif" id="f_trigger_c<? echo $cont ?>" style="cursor: pointer; border: 1px solid red;" title="Date selector"
      onmouseover="this.style.background='red';" onMouseOut="this.style.background=''"  />

 <script type="text/javascript">
    Calendar.setup({
        inputField     :    "f_date_c<? echo $cont ?>",     // id of the input field
        ifFormat       :    "%Y-%m-%d",      // format of the input field
        button         :    "f_trigger_c<? echo $cont ?>",  // trigger for the calendar (button ID)
        align          :    "Tl",           // alignment (defaults to "Bl")
        singleClick    :    true
    });
</script>

                         </td>
                         <td class="Estilo1b" title="<? echo $row3["eta_rut"]  ?>"><? echo $row3["eta_cli_nombre"]  ?> </td>
			             <td class="Estilo1c"><div id="online2<? echo $cont ?>"><a href="#" class="link" id="online<? echo $cont ?>" onclick="modificaAjax(<? echo $cont ?>,'online<? echo $cont ?>');"><? echo $fpago ?></a></div> </td>
			             <td class="Estilo1c"><? echo $row3["eta_numero"] ?> </td>
			             <td class="Estilo1c"><? echo number_format($row3["eta_monto"],0,',','.')  ?> </td>
                         <td class="<? echo $clase ?>"><? echo $row3["eta_fecha_recepcion"]  ?> </td>
                         <td class="Estilo1c"><? echo $diff   ?> </td>
                         <!-- <td class="Estilo1ce"><a href="<? echo $archivo ?>?id2=<? echo $row3["eta_id"] ?>" class="link" >SII</a> </td> -->
                         <td class="Estilo1c"><a href="valida6.php?id=<? echo $row3["eta_id"] ?>&ori=1" class="link" title="Volver Recepcion Fisica" onclick="return confirm('Seguro que desea Volver Recepcion Fisica ?')"><img src="imagenes/volver2.jpg" width="20" height="20" border=0></a> </td>
                       </tr>

                        



<?

   $cont++;

}
?>


                      <tr>

                               <input type="hidden" name="cont" value="<? echo $cont ?>" >
                               <input type="hidden" name="mes21" value="<? echo $mes21 ?>" >
                               <input type="hidden" name="ano21" value="<? echo $ano21 ?>" >
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
