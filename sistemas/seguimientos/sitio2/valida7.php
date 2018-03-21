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
?>
<html>
<head>
<script type="text/javascript" src="librerias/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="librerias/jquery.blockUI.js"></script>
<link rel="stylesheet" type="text/css" href="../../inventario/privado/sitio2/css/font-awesome.min.css">
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

function Validar() {
    var nn=document.forms[0].elements.length;
    var nn2=nn-3;
    var nn3=nn2/4;
//    alert("entra a la funcion "+nn);
    var mensaje="";
    mensaje+="Se han seleccionado las opciones: \n\n";

     for(i=0; i<document.forms[0].elements.length ;i++){
        if (form1.elements[i].checked){
          var nn4=i+4;
          if(form1.elements[nn4].value=="") {
            alert ("no a ingresado fecha ");
            return false;
          }

          mensaje+="\t * " + form1.elements[i].value + "\n";

        }
     }
//      alert(mensaje);
      //return true;


      if(confirm('¿ ESTÁ SEGURO DE PROCEDER CON LA ACCIÓN ?')) {
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

        <div class="col-sm-10 col-lg-10">
                    <div class="dash-unit2">

            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="20" colspan="2"><span class="Estilo7">3.- ENTREGA PAGO A PROVEEDORES </span></td>
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
    $sql2 = "update dpp_etapas set eta_estado='6' where eta_id=$id";
//    echo $sql2;
    mysql_query($sql2);

}

?>



                   <tr>
                    <td height="50" colspan="3">
                    </table>

     <table width="100%" border="0" cellspacing="0" cellpadding="0">
       <form name="form1" action="grabavalida7.php" method="post"  onSubmit="return Validar()">

                           <tr>

                             

                           </tr>



                      </td>


                       <tr>
                      
                      </tr>
                      <tr>
                      <td class="Estilo1" colspan=4> <a href="valida5b.php" class="link">1.- RECEPCION FISICA A PAGO </a> | <a href="valida6.php" class="link">2.-  ADMINISTRACIÓN PAGO PROVEEDORES </a><br>

			<tr>
                      <td  valign="center" class="Estilo1" colspan=8 align="center"><br><input type="submit" name="boton" class="Estilo2" value="  GRABAR DATOS"> </td>
                        </tr>                      


			<table border=1 class="table table-striped table-hover">
                        
                        <tr>
                         
                        </tr>

                        <tr>
                         <td class="Estilo1b">Folio</td>
                         <td class="Estilo1b">Depositado</td>
                         <td class="Estilo1b">Entregado</td>
                         <td class="Estilo1b">Nombre Retira</td>
                         <td class="Estilo1b">Fecha de Entrega</td>
                         <td class="Estilo1b">Nombre Proveedor</td>
                         <td class="Estilo1b">N° Doc. </td>
                         <td class="Estilo1b">Monto </td>
                         <td class="Estilo1b">Fech. Cheque </td>
                         <td class="Estilo1b">Días</td>
                         <td class="Estilo1b">N° Egreso</td>
                         <td class="Estilo1b">Volver</td>
                        </tr>

<?

$sql5="select * from dpp_plazos ";
//echo $sql;
$res5 = mysql_query($sql5);
$row5 = mysql_fetch_array($res5);
$etapa7a=$row5["pla_etapa7a"];
$etapa7b=$row5["pla_etapa7b"];

if ($regionsession==0) {
    $sql="select * from dpp_etapas where eta_estado=7 order by eta_fechache";
} else {
    $sql="select * from dpp_etapas where eta_estado=7 and eta_region=$regionsession order by eta_fechache ";
}


//echo $sql;
$res3 = mysql_query($sql);
$cont=1;

while($row3 = mysql_fetch_array($res3)){
    $fechahoy = $date_in;
    $dia1 = strtotime($fechahoy);
    $fechabase =$row3["eta_fechache"];
    $dia2 = strtotime($fechabase);
    $diff=$dia1-$dia2;
    $diff=intval($diff/(60*60*24));
    if ($etapa7a>=$diff)
      $clase="Estilo1cverde";
    if ($etapa7a<$diff and $etapa7b>=$diff )
      $clase="Estilo1camarrillo";
    if ( $etapa7b<$diff)
      $clase="Estilo1crojo";

    if ($row3["eta_tipo_doc"]=="Factura") {
        $archivo="verdoccontab.php";
    }
    if ($row3["eta_tipo_doc"]=="Honorario") {
        $archivo="verdoc2contab.php";
    }


?>
                      <script>
                        function mostrar(input)
                        {
                            $("#var2_"+input).val('');
                            document.getElementById("var2_"+input).style.display="block";
                        }

                        function ocultar(input,nombre)
                        {
                            $("#var2_"+input).val(nombre);
                            document.getElementById("var2_"+input).style.display="none";
                        }
                      </script>

                       <tr>
                         <td class="Estilo1b"><? echo $row3["eta_folio"]  ?><input type="checkbox" name="var[<? echo $cont ?>]" value="<? echo $row3["eta_id"] ?>" class="Estilo2" > </td>
                         <td class="Estilo1b"><input type="radio" onclick="ocultar(<?php echo $cont ?>,'<?php echo $row3["eta_cli_nombre"] ?>')" name="var5[<? echo $cont ?>]" class="Estilo2" value="Depositado"></td>
                         <td class="Estilo1b"><input type="radio" onclick="mostrar(<?php echo $cont ?>)" name="var5[<? echo $cont ?>]" class="Estilo2" value="Retirado"></td>
                         <td class="Estilo1b"><input type="text" name="var2[<? echo $cont ?>]" id="var2_<?php echo $cont ?>" class="Estilo2" size="14"> </td>
                         <td class="Estilo1b">
                                        <div class="col-md-6">
               <div class="input-group">
                                 <input type="text" name="var3[<? echo $cont ?>]" class="Estilo2" size="12" value="" id="f_date_c<? echo $cont ?>" readonly="1">
                                 <div class="input-group-addon" style="padding: 0px 5px;background:none;border:0px;">
<img src="calendario.gif" id="f_trigger_c<? echo $cont ?>" style="cursor: pointer; border: 1px solid red;" title="Date selector" onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />
</div>
</div>
</div>

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
                         <td class="Estilo1b" title="<? echo $row3["eta_rut"]  ?>"><a href="<? echo $archivo ?>?id2=<? echo $row3["eta_id"] ?>" class="link" ><? echo $row3["eta_cli_nombre"]  ?></a> </td>
                         <td class="Estilo1c"><? echo $row3["eta_numero"] ?> </td>
                         <td class="Estilo1c"><? echo number_format($row3["eta_monto"],0,',','.')  ?> </td>
                         <td class="<? echo $clase ?>"><? echo $row3["eta_fechache"]  ?> </td>
                         <td class="Estilo1c"><? echo $diff   ?> </td>
                         <td class="Estilo1c"><?php echo $row3["eta_negreso"] ?></td>
                         <td class="Estilo1c"><a href="valida7.php?id=<? echo $row3["eta_id"] ?>&ori=1" class="link" title="Volver a Administracion Pago" onclick="return confirm('Seguro que desea Volver a Pago Proveedor?')"><img src="imagenes/volver2.jpg" width="20" height="20" border=0></a> </td>
                       </tr>

                        



<?

   $cont++;

}
?>


                      <tr>

                               <input type="hidden" name="cont" value="<? echo $cont ?>" >
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
