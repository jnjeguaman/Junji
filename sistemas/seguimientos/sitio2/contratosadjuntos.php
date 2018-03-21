<?
session_start();
require("inc/config.php");
require("inc/querys.php");
$nivel = $_SESSION["pfl_user"];
$regionsession = $_SESSION["region"];
$usuario=$_SESSION["nom_user"];
if($_SESSION["nom_user"] =="" ){
	?><script language="javascript">location.href='sesion_perdida.php';</script><?
}
$date_in=date("d-m-Y");
$year=date("Y");
?>
<html>
<head>
<script type="text/javascript" src="librerias/jquery-1.11.3.min.js"></script>
  <script type="text/javascript" src="librerias/jquery.blockUI.js"></script>
  <link rel="stylesheet" type="text/css" href="../../inventario/privado/sitio2/css/font-awesome.min.css">
  <title>CONTRATOS</title>
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
   .Estilo1c {
     font-family: Verdana;
     font-weight: bold;
     font-size: 10px;
     color: #003063;
     text-align: center;
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
    font-weight: bold;
    text-align: center;}
  -->
</style>



</head>
<script type="text/javascript" src="select_dependientes_3_nivelesa.js"></script>
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



  </script>
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




//-->


    function validaGrabar() {

        if(confirm('¿ ESTÁ SEGURO DE PROCEDER CON LA ACCIÓN ?')) {
          blockUI();

        }
        else{
          return false;
        }

      
    }

</script>

<body>
  <div class="navbar-nav">
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


    <table width="529" border="0" cellspacing="0" cellpadding="0">
      <tr>
          <tr>
            <td height="20" colspan="2"><span class="Estilo7">PASO  2: Agregar Archivos y datos anexos.</span></td>
          </tr>

          <tr>
           <td width="487" valign="top" class="Estilo1">

            <?

            if (isset($_GET["llave"]))
             echo "<p>Registros insertados con Exito !";

           $id=$_GET["id"];
           $ori=$_GET["ori"];

           $sql="select * from dpp_contratos where cont_id=$id";
//echo $sql;
           $result=mysql_query($sql);
           $row=mysql_fetch_array($result);
           $evaluara=$row["cont_evaluara"];
           $conttipo=$row["cont_tipo"];
           $contrato=$row["cont_contrato"];


           $fechainicio=$row["cont_fechainicio"];
           $fechavence=$row["cont_vence"];
           $fechainicio=substr($fechainicio,8,2)."-".substr($fechainicio,5,2)."-".substr($fechainicio,0,4);
           $fechavence=substr($fechavence,8,2)."-".substr($fechavence,5,2)."-".substr($fechavence,0,4);


           $sql2="select * from tipocontrato  where id=$conttipo";
//echo $sql;
           $result2=mysql_query($sql2);
           $row2=mysql_fetch_array($result2);
           $tipocontrato=$row2["opcion"];

           if ($ori==''){
            $archivo="contratos.php";
          }
          if ($ori==2){
            $archivo="valida1c.php";
          }


          $id=$_GET["id"];
          $id2=$_GET["id2"];

          if ($_GET["ori2"]==1)  {
            $sql2 = "delete from dpp_contratores where conres_id=$id2";
//    echo $sql2;
            mysql_query($sql2);
//    exit();

          }
          if ($_GET["ori2"]==2)  {
            $sql2="update compra_orden set oc_cont_id=''  where oc_region='$regionsession' and oc_cont_id='$id' ";
//    echo $sql2;
            mysql_query($sql2);
//    exit();

          }
          if ($_GET["ori2"]==3)  {
            $sql2 = "update dpp_boletasg set boleg_cont_id='' where boleg_reg='$regionsession' and boleg_cont_id='$id' ";
//    echo $sql2;
            mysql_query($sql2);
//    exit();

          }


          ?>
          <tr>
            <td colspan=4><hr></td>
          </tr>
          <tr>
            <td><a href="<? echo $archivo ?>" class="link" >Volver</a></td>
          </tr>
          <tr>
            <td><br></td>
          </tr>


          <tr>
            <td height="50" colspan="3">

             <table width="518" border="0" cellspacing="0" cellpadding="0">
              <tr>
               <td  valign="center" class="Estilo1">Rut Empresa  </td>
               <td class="Estilo1" colspan=3>
                <? echo $row["cont_rut"]; ?> -<? echo $row["cont_dig"]; ?>
              </td>
            </tr>
            <tr>
             <td  valign="center" class="Estilo1">Nombre Proveedor Adjudicado </td>
             <td class="Estilo1" colspan=3><? echo $row["cont_nombre"]; ?>
             </td>
           </tr>

           <tr>
             <td  valign="center" class="Estilo1">Descripción Contrato </td>
             <td class="Estilo1" colspan=3><? echo $row["cont_nombre1"]; ?>
             </td>
           </tr>
           <tr>
             <td valign="center" class="Estilo1">Tipo de Contrato</td>
             <td class="Estilo1"><? echo $tipocontrato; ?>
             </td>
           </tr>
           <tr>
             <td colspan=10><hr></td>
           </tr>
           <form name="form1" action="grabacontratoadjuntos.php" method="post"  onsubmit="return validaGrabar()">
             <tr>
               <td  valign="center" class="Estilo1">Fecha Inicio</td>
               <td class="Estilo1" valign="center">
                <input type="text" name="fecha1" class="Estilo2" size="12" value="<? echo $fechainicio; ?>" id="f_date_c1" readonly="1" >
                <img src="calendario.gif" id="f_trigger_c1" style="cursor: pointer; border: 1px solid red;" title="Date selector"
                onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />

                <script type="text/javascript">
                  Calendar.setup({
        inputField     :    "f_date_c1",     // id of the input field
        ifFormat       :    "%d-%m-%Y",      // format of the input field
        button         :    "f_trigger_c1",  // trigger for the calendar (button ID)
        align          :    "Tl",           // alignment (defaults to "Bl")
        singleClick    :    true
      });
    </script>


  </td>
</tr>
<tr>
 <td  valign="center" class="Estilo1">Fecha Término</td>
 <td class="Estilo1" valign="center">
  <input type="text" name="fecha3" class="Estilo2" size="12" value="<? echo $fechavence; ?>" id="f_date_c3" readonly="1" >
  <img src="calendario.gif" id="f_trigger_c3" style="cursor: pointer; border: 1px solid red;" title="Date selector"
  onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />

  <script type="text/javascript">
    Calendar.setup({
        inputField     :    "f_date_c3",     // id of the input field
        ifFormat       :    "%d-%m-%Y",      // format of the input field
        button         :    "f_trigger_c3",  // trigger for the calendar (button ID)
        align          :    "Tl",           // alignment (defaults to "Bl")
        singleClick    :    true
      });
    </script>


  </td>
</tr>
<tr>
 <td  valign="center" class="Estilo1">Monto total </td>
 <td class="Estilo1" colspan=3>
  <input type="text" name="total" class="Estilo2" size="20" value="<? echo $row["cont_total"]; ?>">
  <select name="moneda4" class="Estilo1">

   <?
   $sql2 = "Select * from dpp_monedas ";
   $res2 = mysql_query($sql2);

   while($row2 = mysql_fetch_array($res2)){
     $conttipo2=$row["cont_tipo2"];
     $moneid=$row2["mone_id"];

     ?>
     <option value="<? echo $row2["mone_id"] ?>" <? if ($moneid==$conttipo2) { echo "selected=selected"; } ?> ><? echo $row2["mone_tipo"] ?></option>

     <?
   }
   ?>


 </select>
</td>
</tr>
<tr>
 <td  valign="center" class="Estilo1">Nº de Resolucion</td>
 <td class="Estilo1" colspan=3>
  <input type="text" name="nroresolucion" class="Estilo2" size="20" value="<? echo $row["cont_nroresolucion"]; ?>">

</td>
</tr>

<tr>
 <td colspan=4 align="center"> <input type="submit" value="    Modificar Datos    " > </td>
</tr>

</table>
<input type="hidden" name="id"  value="<? echo $id ?>" >
<input type="hidden" name="ori"  value="<? echo $ori ?>" >
</form>
<hr><br>
<table width="518" border="0" cellspacing="0" cellpadding="0">
 <tr>
   <td valign="center" class="Estilo1" colspan=4>I) Resolución Exenta: <a href="contagregare.php?rut=<? echo $row["cont_rut"]; ?>&id=<? echo $id; ?>" class="link" ></a><a href="buscaresolucion.php?rut=<? echo $row["cont_rut"]; ?>&id=<? echo $id; ?>" class="link" >SELECCIONAR AUTOMATICA ARGEDO</a> <br>
     <a href="contagregare.php?rut=<? echo $row["cont_rut"]; ?>&id=<? echo $id; ?>" class="link" ></a>
   </td>
 </tr>
</table>
<table width="518" border="1" cellspacing="0" cellpadding="0">
 <tr>
   <td valign="center" class="Estilo1">NUMERO</td>
   <td valign="center" class="Estilo1">MATERIA</td>
   <td valign="center" class="Estilo1">FECHA</td>
   <td valign="center" class="Estilo1">ARCHIVO</td>
   <td valign="center" class="Estilo1">ELI.</td>
 </tr>

 <?
 $sql2 = "Select * from dpp_contratores where conres_cont_id='$id' and conres_docs_id=0 order by conres_id desc ";
                    //      echo $sql2;
 $res2 = mysql_query($sql2);
 while($row2 = mysql_fetch_array($res2)){
   $eta_tipo_doc3=$row2["eta_tipo_doc3"];
   $trozos = explode("/", $row2["conres_archivo"]);
   $final = end($trozos);

   ?>
   <tr>
     <td valign="center" class="Estilo1"><? echo $row2["conres_numero"]; ?></td>
     <td valign="center" class="Estilo1"><? echo $row2["conres_materia"]; ?></td>
     <td valign="center" class="Estilo1"><? echo $row2["conres_fecha"]; ?></td>
     <td valign="center" class="Estilo1"><a href="archivos/docfac/<? echo $row2["conres_archivo"]; ?>" class="link" target="_blank" ><? echo $final; ?>..</a></td>
     <td class="Estilo3c"><a href="contratosadjuntos.php?id2=<? echo $row2["conres_id"] ?>&ori2=1&id=<? echo $id; ?>" class="link" onclick="return confirm('Seguro que desea Borrar para siempre?')"><img src="imagenes/b_drop.png" border=0></a></td>



   </tr>

   <?
 }
 ?>

</table>

<br><br>
<table width="518" border="0" cellspacing="0" cellpadding="0">
 <tr>
   <td valign="center" class="Estilo1" colspan=4>II) Ordenes de Compra :
    <a href="buscarordencompra2.php?rut=<? echo $row["cont_rut"]; ?>&id=<? echo $id; ?>&contrato=<? echo $contrato ?>" class="link" >ADJUNTAR NUEVA ORDEN DE COMPRA</a><BR>
    <a href="contagregaorden.php?rut=<? echo $row["cont_rut"]; ?>&id=<? echo $id; ?>" class="link" ></a>
  </td>
</tr>
</table>
<table width="518" border="1" cellspacing="0" cellpadding="0">
 <tr>
   <td valign="center" class="Estilo1">NUMERO</td>
   <td valign="center" class="Estilo1">FECHA</td>
   <td valign="center" class="Estilo1">ARCHIVO</td>
   <td valign="center" class="Estilo1">ELI.</td>
 </tr>

 <?
 $sql2="select * from compra_orden where oc_region='$regionsession' and oc_cont_id='$id' ";
//                          echo $sql2;
 $res2 = mysql_query($sql2);
 while($row2 = mysql_fetch_array($res2)){
   $eta_tipo_doc3=$row2["eta_tipo_doc3"];
   ?>
   <tr>
     <td valign="center" class="Estilo1"><? echo $row2["oc_numero"]; ?></td>
     <td valign="center" class="Estilo1"><? echo $row2["oc_fechacompra"]; ?></td>
     <td valign="center" class="Estilo1"><a href="../../archivos/docfac/<? echo $row2["oc_archivo"]; ?>?read1=<? echo $read1 ?>" class="link" target="_blank"><? echo $row2["oc_archivo"]; ?></a></td>
     <td class="Estilo3c"><a href="contratosadjuntos.php?id2=<? echo $row2["conres_id"] ?>&ori2=2&id=<? echo $id; ?>" class="link" onclick="return confirm('Seguro que desea Borrar ?')"><img src="imagenes/b_drop.png" border=0></a></td>
   </tr>

   <?
 }
 ?>

</table>
<br><br>
<table width="518" border="0" cellspacing="0" cellpadding="0">
 <tr>
   <td valign="center" class="Estilo1" colspan=4>III) Boletas de Garantia : <a href="buscarboletasg.php?rut=<? echo $row["cont_rut"]; ?>&id=<? echo $id; ?>" class="link" >ADJUNTAR NUEVA BOLETA DE GARANTIA</a> </td>
 </tr>
</table>
<table width="518" border="1" cellspacing="0" cellpadding="0">
 <tr>
   <td valign="center" class="Estilo1">NUMERO</td>
   <td valign="center" class="Estilo1">MATERIA</td>
   <td valign="center" class="Estilo1">FECHA</td>
   <td valign="center" class="Estilo1">ARCHIVO</td>
   <td valign="center" class="Estilo1">ELI.</td>
 </tr>

 <?
 $sql2 = "select * from dpp_boletasg where boleg_reg='$regionsession' and boleg_cont_id='$id' ";
                          //echo $sql2;
 $res2 = mysql_query($sql2);
 while($row2 = mysql_fetch_array($res2)){
   $eta_tipo_doc3=$row2["eta_tipo_doc3"];
   ?>
   <tr>
     <td valign="center" class="Estilo1"><? echo $row2["boleg_numero"]; ?></td>
     <td valign="center" class="Estilo1"><? echo $row2["boleg_tipo"]; ?></td>
     <td valign="center" class="Estilo1"><? echo $row2["boleg_fecha_emision"]; ?></td>
     <td valign="center" class="Estilo1"><a href="../../archivos/docgarantia/<? echo $row2["boleg_archivo"]; ?>" class="link" target="_blank"><? echo $row2["boleg_archivo"]; ?></a></td>
     <td class="Estilo3c"><a href="contratosadjuntos.php?id2=<? echo $row2["conres_id"] ?>&ori2=3&id=<? echo $id; ?>" class="link" onclick="return confirm('Seguro que desea Borrar para siempre?')"><img src="imagenes/b_drop.png" border=0></a></td>
   </tr>

   <?
 }
 ?>

</table>
<br><br>
<table width="518" border="0" cellspacing="0" cellpadding="0">
 <tr>
   <td valign="center" class="Estilo1" colspan=4>IV) RESOLUCION MULTA : <a href="buscaresolucion2.php?rut=<? echo $row["cont_rut"]; ?>&id=<? echo $id; ?>&ori=<? echo $ori ?>" class="link" >ADJUNTAR NUEVA RESOLUCION DE MULTA</a> </td>
 </tr>
</table>
<table width="518" border="1" cellspacing="0" cellpadding="0">
 <tr>
  <td class="Estilo1c">Folio</td>
  <td class="Estilo1c">Materia</td>
  <td class="Estilo1c">Fecha</td>
  <td class="Estilo1c">Archivo</td>
</tr>

<?
$sql2="select * from dpp_contratores x, argedo_documentos y where conres_cont_id='$id' and x.conres_docs_id=y.docs_id";
//                         $sql2="select * from dpp_contratores where conres_cont_id='$id' and conres_docs_id<>0 ";
                 //         echo $sql2;
$res2 = mysql_query($sql2);
while($row2 = mysql_fetch_array($res2)){
 $eta_tipo_doc3=$row2["eta_tipo_doc3"];
 ?>
 <tr>
   <td class="Estilo1c"><? echo $row2["docs_folio"]  ?> </td>
   <td class="Estilo1c"><? echo $row2["docs_materia"]  ?> </td>
   <td  class="Estilo1c"><? echo substr($row2["docs_fecha"],8,2)."-".substr($row2["docs_fecha"],5,2)."-".substr($row2["docs_fecha"],0,4)   ?></td>
   <td class="Estilo1c"><a href="../../archivos/docargedo/<? echo $row2["docs_archivo"] ?>" class="link" target="_blank"> VER</a> </td>
 </tr>

 <?
}
?>

</table>

                              <br><br>
           					<table width="518" border="0" cellspacing="0" cellpadding="0">
                           <tr>
                             <td valign="center" class="Estilo1" colspan=4>V) REQUISITO TECNICO : <a href="contrato_tecnico.php?rut=<? echo $row["cont_rut"]; ?>&id=<? echo $id; ?>&ori=<? echo $ori ?>" class="link" >ADJUNTAR REGISTRO TECNICO</a> </td>
                           </tr>
                        </table>

       					<table width="518" border="1" cellspacing="0" cellpadding="0">
                           <tr>
                            <td class="Estilo1c">Supervisor</td>
                            <td class="Estilo1c">Archivo</td>
                           </tr>


                            <tr>
                              <td  valign="top" class="Estilo1" width=70%><? echo $row["cont_supervisor"]; ?>  </td>
                              <td class="Estilo1c"><a href="<? echo $row["cont_ruta"]; ?><? echo $row["cont_archivo"]; ?>?read1=<? echo $read1 ?>" class="link" target="_blank"><? echo $row["cont_archivo"]; ?></a></td>
                            </tr>

                        </table>



<br><br>
<table width="518" border="0" cellspacing="0" cellpadding="0">
 <tr>
   <td valign="center" class="Estilo1" colspan=4>VI) Otros Antecedentes : <a href="contrato_otrosarchivos.php?rut=<? echo $row["cont_rut"]; ?>&id=<? echo $id; ?>&ori=<? echo $ori ?>" class="link" >ADJUNTAR OTROS ANTECEDENTES</a> </td>
 </tr>
</table>
<table width="518" border="1" cellspacing="0" cellpadding="0">
 <tr>
  <td class="Estilo1c">Folio</td>
  <td class="Estilo1c">Descripcion</td>
  <td class="Estilo1c">Fecha</td>
  <td class="Estilo1c">Archivo</td>
</tr>

<?
$sql2="select * from contra_otrosarchivos where contotro_cont_id='$id' ";
//                         $sql2="select * from dpp_contratores where conres_cont_id='$id' and conres_docs_id<>0 ";
                 //         echo $sql2;
$res2 = mysql_query($sql2);
while($row2 = mysql_fetch_array($res2)){
 $eta_tipo_doc3=$row2["eta_tipo_doc3"];
 ?>
 <tr>
   <td class="Estilo1c"><? echo $row2["contotro_id"]  ?> </td>
   <td class="Estilo1c"><? echo $row2["contotro_descripcion"]  ?> </td>
   <td  class="Estilo1c"><? echo substr($row2["contotro_fechasys"],8,2)."-".substr($row2["contotro_fechasys"],5,2)."-".substr($row2["contotro_fechasys"],0,4)   ?></td>
   <td class="Estilo1c"><a href="<? echo $row2["contotro_ruta"] ?><? echo $row2["contotro_archivo"] ?>" class="link" target="_blank"> VER</a> </td>
 </tr>

 <?
}
?>

</table>







</td>


<tr>
 <td colspan="8"><hr></td>
</tr>



<tr>
  <td colspan="8">

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

