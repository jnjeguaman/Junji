<?

session_start();

require("inc/config.php");

require("inc/querys.php");

$fechamia=date('Y-m-d');

$annomia=date('Y');

$usuario=$_SESSION["nom_user"];

$regionsession = $_SESSION["region"];



if($_SESSION["nom_user"]=="" ){

	?><script language="javascript">location.href='sesion_perdida.php';</script><?

}





$fecha1=$_POST["fecha1"];

$fecha2=$_POST["fecha2"];

$fecha1b=$_POST["fecha1"];

$fecha2b=$_POST["fecha2"];





$fecha1= substr($fecha1,6,4)."-".substr($fecha1,3,2)."-".substr($fecha1,0,2);

$fecha2= substr($fecha2,6,4)."-".substr($fecha2,3,2)."-".substr($fecha2,0,2);



$folio=$_POST["folio"];

$region=$_POST["region"];

$rut=$_POST["rut"];

$dig=$_POST["dig"];

$nombre=$_POST["nombre"];

$monto=$_POST["monto"];

$moneda=$_POST["moneda"];

$depto=$_POST["depto"];

$numero1=$_POST["numero"];

$tipodoc=$_POST["tipodoc"];

$fpago=$_POST["fpago"];

$iva=$monto*19/119;

$iva=number_format($iva,0,"","");

$neto=$monto-$iva;
$oc = $_POST["oc"];


$archivo1 = $_FILES["archivo1"]["name"];





if ($tipodoc=="n")

 $monto=$monto*1;







//echo substr($a,8,2)."-".substr($a,5,2)."-".substr($a,0,4);









if ($rut<>"" and $nombre<>"" and $usuario<>"") {

//  $sql21="select max(folio1_folio) as foliomio from dpp_folio1 where folio1_region='$regionsession' and folio1_usuario='$usuario' ";

  $sql21="select max(folio1_folio) as foliomio from dpp_folio1 where folio1_region='$regionsession'  ";

//  echo $sql21;

  $result21=mysql_query($sql21);

  $row21=mysql_fetch_array($result21);

  $foliomio=$row21["foliomio"];

  $foliomio=$foliomio+1;





  //exit();

//  if ($regionsession<>15) {

//      $fpago="Cheque";

//  }



  $sql1="insert into dpp_etapas (eta_tipo_doc,eta_tipo_doc2,eta_fecha_ing,eta_fecha_recepcion, eta_fecha_fac,eta_usu_recepcion, eta_folio, eta_region ,eta_rut,eta_dig,eta_cli_nombre,eta_numero, eta_monto, eta_moneda, eta_iva, eta_neto, eta_fpago, eta_monto2,eta_nroorden)

                           values   ('Factura','$tipodoc','$fechamia',  '$fecha1',   '$fecha2',            '$usuario',    '$foliomio', '$region',       '$rut',    '$dig','$nombre', '$numero1' , '$monto', '$moneda' ,  '$iva',  '$neto', '$fpago', '$monto','".strtoupper($oc)."')  ";

//  echo $sql1;

  mysql_query($sql1) or die("<script>location.href='facturas.php?llave=2';</script>");

  

  $sql2="select max(eta_id) as maximo from dpp_etapas where eta_usu_recepcion='$usuario' ";

  //echo $sql2;

  $result2=mysql_query($sql2);

  $row2=mysql_fetch_array($result2);

  $maximo=$row2["maximo"];



  



  $sql22="insert into dpp_folio1 (folio1_folio, folio1_region, folio1_usuario, folio1_fecha, folio1_tipo) values ('$foliomio','$regionsession','$usuario','$fechamia','fac')";

  //echo $sql22;

  mysql_query($sql22);

  //exit();



  $sql3 = "INSERT INTO dpp_facturas ( fac_eta_id, fac_fecha_ing,fac_fecha_recepcion, fac_fecha_fac, fac_usu_recepcion, fac_folio, fac_region, fac_rut, fac_dig, fac_numero, fac_cli_nombre, fac_monto, fac_moneda, fac_nroorden)

                          VALUES   ( '$maximo' , '$fechamia'  , '$fecha1',          '$fecha2',     '$usuario',         '$foliomio', '$region', '$rut', '$dig',    '$numero1', '$nombre', '$monto', '$moneda','".strtoupper($oc)."')";



  //echo $sql3;

  mysql_query($sql3);

  //exit();

$origen="Factura";

//include("mailfactura.php");



// echo "$archivo1  <--";

    if ($archivo1 != "") {

        $archivo1="doc".$annomia."/factura/".$regionsession."_".$maximo."_".$annomia.".PDF";

        // guardamos el archivo a la carpeta files



        $destino =  "../../archivos/docfac/".$archivo1;

     //   $destino =  "../../../archivos2/".$archivo1;

//        echo "<br>".$_FILES['archivo1']['tmp_name']."--".$archivo1."--".$destino;

        if (copy($_FILES['archivo1']['tmp_name'],$destino)) {

            $status = "Archivo subido: <b>".$archivo1."</b>";

            $sql2="update dpp_facturas set fac_archivo='$archivo1' where fac_eta_id=$maximo ";

//            echo "========".$sql2;

            mysql_query($sql2);

        } else {

//            echo "Error en archivo no copiado ";

        }

    }

  

}

//exit();



echo "<script>location.href='facturas.php?llave=1';</script>";





?>





