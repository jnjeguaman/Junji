<?
session_start();
require("inc/config.php");
require("inc/querys.php");
$fechamia=date('Y-m-d');
$usuario=$_SESSION["nom_user"];



$cont=$_POST["cont"];
$var=$_POST["var"];
$idcont=$_POST["idcont"];
$id3=$_POST["id3"];

/*
contevaext_cont_id
contevaext_nombre
contevaext_nroitem
contevaext_tipo1
contevaext_campo
*/


//echo substr($a,8,2)."-".substr($a,5,2)."-".substr($a,0,4);



//if ($total<>"" and $texto1<>"" or 1==1) {
if (1==1) {
 $cont2=1;

  while ($cont2<=$cont) {
    $var1=$var[$cont2];
    if ($var1<>'') {
     $sql1="insert into dpp_cont_evaext (contevaext_cont_id, contevaext_nombre, contevaext_nroitem, contevaext_tipo1, contevaext_campo, contevaext_encu_id )
                    select $idcont,          evaext_nombre,      evaext_nroitem,    evaext_tipo1,      evaext_campo, '$id3' from dpp_evaexterna where evaext_id=$var1";

    echo $sql1."<br>";
   // exit();
    mysql_query($sql1);

    $sql2="select max(contevaext_id) as maximo, max(contevaext_nroitem) as numero from dpp_cont_evaext where contevaext_cont_id='$idcont' ";
    echo $sql2."<br>";
    $result2=mysql_query($sql2);
  $row2=mysql_fetch_array($result2);
  $maximo=$row2["maximo"];
  $numero=$row2["numero"];

//  exit();

  $cont3=1;
     //while ($cont3<=$numero) {

         $sql3="insert into dpp_contevaext_item  (contevaexti_contevaext_id, contevaexti_num, contevaexti_nombre, contevaexti_puntaje)
                                                    select $maximo,            evaexti_num,         evaexti_nombre,  evaexti_puntaje   from dpp_evaexterna_item  where evaexti_evaext_id =$var1   ";
         echo $sql3."<br>";
//       exit();
         mysql_query($sql3);

         $cont3++;
      //}
   }
    $cont2++;
 }
 
//exit();
}


echo "<script>location.href='asignarevalucionesext.php?llave=1&id2=$idcont&id3=$id3';</script>";


?>


