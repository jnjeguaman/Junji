<?
session_start();
require("inc/config.php");
$regionsession = $_SESSION["region"];
extract($_POST);
extract($_GET);
$date_in=date("d-m-Y");
$fechamio=date("Y-m-d");
$annomio=date("Y");
$annomio2=$annomio-1;
$usuario=$_SESSION["nom_user"];

?>

<html>
<head>
<title>Unidades</title>
<link href="css/stylo_defensoriapenal.css" rel="stylesheet" type="text/css">
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
.Estilo1d {
	font-family: Verdana;
	font-weight: bold;
	font-size: 10px;
	color: #003063;
	text-align: right;
}
.Estilo2 {
	font-family: Verdana;
	font-size: 10px;
	text-align: left;
	color: #003063;

}
.Estilo2c {
	font-family: Verdana;
	font-size: 10px;
	color: #003063;
	text-align: center;
}
.Estilo2d {
	font-family: Verdana;
	font-size: 10px;
	text-align: right;
	color: #003063;
}
.Estilo2b {
	font-family: Verdana;
	font-size: 9px;
	text-align: left;
	color: #003063;
}
.Estilo3 {
	font-family: Verdana;
	font-size: 9px;
	text-align: left;
	font-weight: bold;
	color: #003063;
}
.Estilo3c {
	font-family: Verdana;
	font-size: 9px;
	font-weight: bold;
	text-align: center;
	color: #003063;
}
.Estilo3d {
	font-family: Verdana;
	font-size: 9px;
	font-weight: bold;
	text-align: right;
	color: #003063;
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
.Estilo1crojoc {
	font-family: Verdana;
	font-weight: bold;
	font-size: 12px;
	color: #CC0000;
	text-align: center;
}
.link {
	font-family: Geneva, Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
	color: #00659C;
	text-decoration:none;
	text-transform:uppercase;
}
.link:over {
	font-family: Geneva, Arial, Helvetica, sans-serif;
	font-size: 12px;
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
text-align: center; }

}
.Estilo8 {font-family: Geneva, Arial, Helvetica, sans-serif;
font-size: 10px; font-weight: bold; text-align: left;
color: #009900;}

-->
</style>



<script>
function valida2() {
   if (document.buscar.etiqueta.value==''  ) {
      alert ("Nombre presenta problemas ");
      return false;
  }
  return true;
}

function ponPrefijo(pref,aux) {
	opener.document.formul.codigo.value=pref
	opener.document.formul.pvp.value=aux
	window.close()
}

function cerrarventana(){
   window.opener.location.replace('facturasarchivos.php?id=<? echo $id ?>&&id1b=<?php echo $id2 ?>&ori=<?php echo $ori ?>');
//   opener.document.form1.submit();
   window.close();
//alert('cerrando');
}
function muestra(){

 if (document.buscar.alerta.checked==true) {
       seccion1.style.display="";
       seccion2.style.display="";
       seccion3.style.display="";
 } else {
       seccion1.style.display="none";
       seccion2.style.display="none";
       seccion3.style.display="none";
 }



}

</script>
<link href="estilo.css" rel="stylesheet" type="text/css">
</head>
<body>

<?
$archivo1 = $_FILES["archivo1"]['name'];

  if ($archivo1 != "" and $etiqueta!='') {
     $sql2="insert into compra_archivo (arch_etiqueta,  arch_ruta, arch_archivo, arch_user, arch_fechasys, arch_eta_id) values (upper('$etiqueta'),'$ruta','$archivo1','$usuario','$fechamio', '$id2') ";
    // echo $sql2;
    // exit();
     mysql_query($sql2);
        
        
     $sql2="Select max(arch_id) as maximo from compra_archivo where arch_eta_id=$id2";
     // echo "---->".$sql2;
     $sql2=mysql_query($sql2);
     $row2 = mysql_fetch_array($sql2);
     $maximo=$row2['maximo'];



     $ruta="archivos/docfac/".$annomio."/".$regionsession;
     $archivo1="ANT_".$regionsession."_".$maximo."_".$id2."_".$annomio.".PDF";
 //    echo $archivo1;
//   $archivo1="doc".$annomia."/ocompra/OC".$regionsession."_".$numerooc."_".$annomia.".PDF";
     // guardamos el archivo a la carpeta files
     $destino =  "../../archivos/docfac/".$annomio."/".$regionsession."/".$archivo1;
     if (copy($_FILES["archivo1"]['tmp_name'],$destino)) {
        $status = "Archivo subido: <b>".$archivo1."</b>";
        $sql2="update compra_archivo set arch_ruta='$ruta', arch_archivo='$archivo1' where arch_id=$maximo ";
   //     echo $sql2;
        mysql_query($sql2);
     }
     

     $sql2="INSERT INTO alerta_alerta (aler_rel_id, aler_tabla, aler_nombre,    aler_texto,          aler_tipo, aler_nivel, aler_diasprevios, aler_fecharef, aler_user, aler_fechasys)
                               values ('$maximo' , 'bitacora_archivo' ,upper('$etiqueta'),upper('$etiqueta'),'Bitacora',       '1',         '30',       '$fechavb',      '$usuario','$fechamio') ";
 //    echo $sql2."<br><br>";
     mysql_query($sql2);
     
     $sql2="Select max(aler_id) as maximo2 from alerta_alerta where aler_user='$usuario' ";
  //   echo $sql2."<br><br>";
     $sql2=mysql_query($sql2);
     $row2 = mysql_fetch_array($sql2);
     $maximo2=$row2['maximo2'];
     
     $sql2="INSERT INTO  alerta_destino (dest_email, dest_nombre, dest_tipodoc, dest_docuid, dest_nivel, dest_user, dest_fechasys)
                               values ('$mail'  ,upper('$etiqueta'),'Bitacora',   '$maximo',     '1',       '$usuario','$fechamio') ";
 //    echo $sql2."<br><br>";
     mysql_query($sql2);

     $sql2="Select max(dest_id) as maximo3 from alerta_destino where dest_user='$usuario' ";
 //    echo $sql2."<br><br>";
     $sql2=mysql_query($sql2);
     $row2 = mysql_fetch_array($sql2);
     $maximo3=$row2['maximo3'];
     
     $sql2="INSERT INTO alerta_rel_aldes (aldes_aler_id, aldes_dest_id, aldes_user, aldes_fechasys)
                                  values ('$maximo2'  ,'$maximo3',      '$usuario','$fechamio') ";
  //   echo $sql2."<br><br>";
     mysql_query($sql2);



     
   // exit();
   echo "<script>cerrarventana();</script>";
  }


?>
<br>
<form action="bitacora_subirarchivoo.php" name="buscar" method="post" enctype="multipart/form-data"  onSubmit="return valida2()">




<table>
    <tr>
       <td class="Estilo1" width="100">Nombre </td>
       <td>
            <input type="text" name="etiqueta" class="Estilo2" size="20"  > <br>
       </td>
     </tr>
     
     <tr>
       <td class="Estilo1">Archivo </td>
       <td>
                              <input type="file" name="archivo1" class="Estilo2" size="20"  > <br>
                              <a href="../../archivos/docfac/<? echo $row21["oc_archivo"]; ?>?read1=<? echo $read1 ?>" class="link" target="_blank"><? echo $row21["oc_archivo"]; ?></a>
       </td>
    </tr>

      <tr>
         <td  class="Estilo1" colspan=2>
          <br><br>
            <input type="submit" value="Subir Archivo">
         </td>
       </tr>
</table>


        <input type="hidden" name="numerooc" value="<? echo $numerooc ?>" >
        <input type="hidden" name="id" value="<? echo $id ?>" >
        <input type="hidden" name="id2" value="<? echo $id2 ?>" >
        <input type="hidden" name="cont" value="<? echo $cont ?>" >
        <input type="hidden" name="ori" value="<? echo $ori ?>" >
</form>
<br><br>
    <input type="submit" name="Submit" value="Cerrar ventana" onclick="JavaScript: window.close();">

