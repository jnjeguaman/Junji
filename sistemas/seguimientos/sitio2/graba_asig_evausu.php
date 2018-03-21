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
     $sql1="insert into dpp_cont_evausu (contevausu_cont_id, contevausu_nombre, contevausu_nroitem, contevausu_tipo1, contevausu_campo, contevausu_encu_id )
                    select $idcont,          evausu_nombre,      evausu_nroitem,    evausu_tipo1,      evausu_campo, '$id3' from dpp_evausuario where evausu_id=$var1";

    echo $sql1."<br>";
//    exit();
    mysql_query($sql1);

    $sql2="select max(contevausu_id) as maximo, max(contevausu_nroitem) as numero from dpp_cont_evausu where contevausu_cont_id='$idcont' ";
    echo $sql2."<br>";
    $result2=mysql_query($sql2);
  $row2=mysql_fetch_array($result2);
  $maximo=$row2["maximo"];
  $numero=$row2["numero"];

//  exit();

  $cont3=1;
     //while ($cont3<=$numero) {

         $sql3="insert into dpp_contevausu_item  (contevausui_contevausu_id, contevausui_num, contevausui_nombre, contevausui_puntaje)
                                                    select $maximo,            evausui_num,         evausui_nombre,  evausui_puntaje   from dpp_evausuario_item  where evausui_evausu_id =$var1   ";
         echo $sql3."<br>";
//         exit();
         mysql_query($sql3);

         $cont3++;
      //}
   }
    $cont2++;
 }
 
//exit();
}


echo "<script>location.href='asignarevalucionesusu.php?llave=1&id2=$idcont&id3=$id3';</script>";


?>


