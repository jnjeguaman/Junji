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
$fechamia=date("Y-m-d");
$numero=$_GET["numero"];

echo $numero;

//--- Regla 3 ajuste con ajustados sumatoria si cuadra todo se hace el updates de los ajustados con los ajustes
     $sql=" select sum(sigfe_abono) as m11 from concilia_sigfe where sigfe_estado2='AJUSTADO' and sigfe_estado=1 and sigfe_region='$regionsession' ";
//     $sql=" select sum(sigfe_monto) as m11 from concilia_sigfe where sigfe_estado2='AJUSTADO' and sigfe_estado=1 ";
//     echo $sql."<br>";
     $res2 = mysql_query($sql);
     $row2 = mysql_fetch_array($res2);
     $m11=$row2["m11"];

     $sql=" select sum(sigfe_abono) as m22 from concilia_sigfe where sigfe_estado2='AJUSTE' and sigfe_estado=1 and sigfe_region='$regionsession'";
//     $sql=" select sum(sigfe_monto) as m22 from concilia_sigfe where sigfe_estado2='AJUSTE' and sigfe_estado=1 ";
//     echo $sql."<br>";
     $res2 = mysql_query($sql);
     $row2 = mysql_fetch_array($res2);
     $m22=$row2["m22"]*-1;
//     echo "      $m11----   $m22 <br> ";
     if ($m11==$m22) {
//         echo "entra";
         
        $sql="insert into concilia_indice (indi_carto_id,indi_sigfe_id,indi_fechasys,indi_user,indi_tipo) select '',  sigfe_id,'$fechamia','$usuario' , '3'
        from concilia_sigfe where (sigfe_estado2='AJUSTADO' or sigfe_estado2 ='AJUSTE') and sigfe_estado=1 and sigfe_region='$regionsession' ";
//        echo $sql."<br>";
        mysql_query($sql);

         
        $sql="update concilia_sigfe set sigfe_estado=2 where (sigfe_estado2='AJUSTADO' or sigfe_estado2 ='AJUSTE') and sigfe_estado=1 and sigfe_region='$regionsession' ";
        mysql_query($sql);
//        echo $sql."<br>";



     }
echo "<script>location.href='consolidacion_consolida2.php?numero=$numero';</script>";
 ?>



