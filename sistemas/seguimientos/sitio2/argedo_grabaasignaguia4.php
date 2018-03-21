<?
session_start();
require("inc/config.php");
require("inc/querys.php");
$fechamia=date('Y-m-d');
$usuario=$_SESSION["nom_user"];
$regionsession = $_SESSION["region"];





$cont=$_POST["cont2"];
$var=$_POST["var"];
$destinatario=$_POST["destinatario2"];
$otransporte=$_POST["otransporte"];
$observacion=$_POST["observacion"];
$cont2=1;

$sw2=$_POST["sw2"];

$sql21="SELECT max(inte_numguia) AS numeromio FROM argedo_doc_internos WHERE inte_region='$regionsession' AND inte_estado='2' ";
//echo $sql21;
$result21=mysql_query($sql21);
$row21=mysql_fetch_array($result21);
$numeromio=$row21["numeromio"];
$numeromio=$numeromio+1;


  
while ($cont2<=$cont) {

   $var1=$var[$cont2];
   //echo $var1."----".$destinatario;

   if ($var1<>"" ) {


      $sql1="UPDATE argedo_doc_internos SET inte_numguia='$numeromio', inte_destinatario2='$destinatario', inte_ord_transporte='$otransporte', inte_observacion='$observacion', inte_fechaguia='$fechamia' WHERE inte_id=$var1 ";
      //echo $sql1."<br>";
      mysql_query($sql1);

   }

   $cont2++;
}
//exit();

  echo "<script>location.href='argedo_cartolaregional.php?llave=1';</script>";


?>
