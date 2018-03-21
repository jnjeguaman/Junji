<?
require("inc/config.php");
$sql22="select * from argedo_documentos";
//  echo $sql21;
$result22=mysql_query($sql22);
$cont=1;
while ($row22=mysql_fetch_array($result22)) {
   $fechasis=$row22["docs_fechasis"];
   $fecha2=$row22["docs_fecha"];
   $docsid=$row22["docs_id"];
   $docsdiferencia=$row22["docs_diferencia"];

   $dia1 = strtotime($fechasis);
// $dia1 = strtotime($fechamia);
// $fechabase =$fechabase;
   $dia2 = strtotime($fecha2);
   $diff=$dia2-$dia1;
// echo "$fechahoy -- $fechabase $diff <br>";
   $diff2=(intval($diff/(60*60*24)))*-1;

   if ($docsdiferencia<>$diff2) {
//     echo "$cont) $docsid $docsdiferencia - $diff2 <br>";
     $sql1="update argedo_documentos set docs_diferencia='$diff2' where docs_id=$docsid ";
//   echo $sql1;
//   exit();
     mysql_query($sql1);
     $cont++;
   }
}
?>
