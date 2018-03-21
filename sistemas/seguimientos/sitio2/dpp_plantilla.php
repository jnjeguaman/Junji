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
	text-align: center;
}
.Estilo1c {
	font-family: Verdana;
	font-weight: bold;
	font-size: 8px;
	color: #003063;
	text-align: right;
}
.Estilo1d {
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
font-size: 14px;
font-weight: bold; }
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


function validaGrabar(){

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

        <div class="col-sm-10 col-lg-10">
                    <div class="dash-unit2">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="20" colspan="2"><span class="Estilo7">CREACION DE PLANTILLA PARA PRORRATEO</span></td>
                  </tr>
                       <tr>
                       <td><hr></td><td><hr></td>
                      </tr>
<?
$id=$_GET["id"];
$sw=$_GET["sw"];

if ($sw==1) {

   $sql="delete from dpp_prorroteo  where prorro_id ='$id' ";
   //echo $sql;
   mysql_query($sql);
   
   $sql="delete from dpp_prorroteodet   where prorrodet_prorro_id  ='$id' ";
   //echo $sql;
   mysql_query($sql);


}


?>
                       <a href="menuadministracion.php" class="link">VOLVER</a> <br>



       </table>
     <table width="100%" border="0" cellspacing="0" cellpadding="0">
       <form name="form1" action="grabaplantilla.php" method="post"  onSubmit="return validaGrabar()">
                           <tr>
                             <td  valign="center" class="Estilo1">Nombre de la Plantilla :</td>
                             <td class="Estilo1" colspan=3>
                              <input type="text" name="nombre" class="Estilo2" size="60"  >
                            <td>
                              

                           </tr>




                      </td>

                      <tr>

                      <table border=1>
                        <tr>
                         <td> </td>
                        </tr>

                        <tr>
                         <td class="Estilo1b">Op. </td>
                         <td class="Estilo1b">Unidades</td>
                         <td class="Estilo1b">Valor</td>
                        </tr>

<?



                                   $cadena = strlen($regionsession);
                                   if ($cadena==1) {
                                       $where="SUBSTRING(num,1,1)='$regionsession' and character_length(num)=3 ";

                                   } else {
                                       $where="SUBSTRING(num,1,2)='$regionsession' and character_length(num)=4 ";
                                   }

                                   $sql4="select * from defensorias  where $where and estado=1 order by nombre";


//echo $sql;
$res3 = mysql_query($sql4);
$cont=1;

while($row3 = mysql_fetch_array($res3)){


?>
                      

                       <tr>
                         <td class="Estilo1b"><input alt="ok" type="checkbox" name="var[<? echo $cont ?>]" value="<? echo $row3["num"] ?>" class="Estilo2" > </td>
                         <input alt="ok" type="hidden" name="var3[<? echo $cont ?>]" value="<? echo $row3["nombre"] ?>" class="Estilo2" >
                         <td class="Estilo1b"><? echo $row3["nombre"]  ?> </td>
                         <td class="Estilo1b"><input alt="ok" type="text" name="var2[<? echo $cont ?>]" value="" class="Estilo2" > </td>

                       </tr>

                        



<?

   $cont++;

}
?>


                      <tr>
                           <tr>
                             <td  valign="center" class="Estilo1" colspan=4 align="center"><input type="submit" name="boton" class="Estilo2" value="   Grabar    "> </td>


                           </tr>


                               <input type="hidden" name="cont" value="<? echo $cont ?>" >
                           </form>


</td>
  </tr>
  
  
                      <table border=1>
<tr></tr>


<br>
<tr class="Estilo8"></tr>

                        <tr>
                         <td class="Estilo1">Nº </td>
                         <td class="Estilo1">Nombre </td>
                         <td class="Estilo1">Ver </td>
                        </tr>
<?

  $sql="select * from dpp_prorroteo where prorro_region='$regionsession' order by prorro_id  ";

//echo $sql;
$res3 = mysql_query($sql);
$cont=1;

while($row3 = mysql_fetch_array($res3)){
$compraorigen=$row3["compra_origen"];
if ($compraorigen==1) {
    $texto="Programado";
} else {
    $texto="No Programado";

}
?>


                       <tr>
 	<td class="Estilo1"><? echo $row3["prorro_id"] ?> </td>
   <td class="Estilo1" title="<? echo $row3["rporro_nombre"]  ?>"><? echo $row3["prorro_nombre"]  ?></td>
   <td class="Estilo1" title="<? echo $row3["rporro_nombre"]  ?>"><a href="dpp_plantillaficha.php?id2=<? echo $row3["prorro_id"] ?>&ori=1" class="link" >VER </a></td>
                         <td class="Estilo3c"><a href="dpp_plantilla.php?id=<? echo $row3["prorro_id"]; ?>&sw=1" class="link" onclick="return confirm('Seguro que desea Borrar ?')"><img src="imagenes/b_drop.png" border=0></a></td>

                       </tr>


<?


}
?>


                      <tr>







</td>
  </tr>


</table>


 
</table>

<img src="images/pix.gif" width="1" height="10">
</body>
</html>

<?
//require("inc/func.php");
?>
