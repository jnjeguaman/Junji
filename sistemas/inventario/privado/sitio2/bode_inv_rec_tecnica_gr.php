  <?php
  session_start();
  if($_SESSION["nom_user"] =="" ){

  ?><script language="javascript">location.href='sesion_perdida.php';</script><?
}
  require("inc/config.php");
  $fechamia=date('Y-m-d');
  $fechaRegistro = Date("d-m-Y H:i:s");
  $hora=date("h:i");
  $horaSys = Date("H:i:s");

  extract($_GET);
  extract($_POST);
  extract($_SESSION);

  $usuario = $_SESSION["nom_user"];


// N° Guia Último Rezhazo
  $ultimoRechazo = "SELECT max(ing_guianumerorrchzo) as maximo FROM bode_ingreso";
  $ultimoRechazo = mysql_query($ultimoRechazo,$dbh);
  $ultimoRechazo = mysql_fetch_array($ultimoRechazo);
  $ultimoRechazo = intval($ultimoRechazo["maximo"]) + 1 ;

  for ($i=0; $i < $f_cont; $i++) { 

    $estado=$f_aprueba[$i];
    if ($cantidad[$i]>$f_cantidad[$i]) {
     $estado='A';
   }
   if($f_cantidad[$i] <> '')
   {
     $otro = $f_cantidad[$i];
   }else{
    $otro = 0;
  }

       //$consulta="UPDATE   `bode_detingreso` set `ding_recep_tecnica`= '$f_aprueba[$i]',`ding_glosa_rechazo`='$f_motivo[$i]', ding_user='$usuario', ding_fecha='$fechamia' where ding_id = '$id_ding[$i]'";
   //OK $consulta="UPDATE  `bode_detingreso` set `ding_recep_tecnica`= '$estado', ding_user='$usuario', ding_fecha='$fechamia', ding_glosa_rechazo = '$f_motivo[$i]', ding_cant_rechazo = '$f_cantidad[$i]' where ding_id = '$id_ding[$i]'";

  $consulta="UPDATE  `bode_detingreso` set `ding_recep_tecnica`= '$estado', ding_user='$usuario', ding_fecha='$fechamia', ding_glosa_rechazo = '$f_motivo[$i]', ding_cant_rechazo = '$f_cantidad[$i]', ding_unidad = (ding_factor * (ding_cantidad-$otro) ),ding_cant_conf = ding_cantidad where ding_id = '$id_ding[$i]'";

//    $consulta="UPDATE   `bode_detingreso` set `ding_recep_tecnica`= '$estado', `ding_glosa_rechazo`='$f_motivo[$i]', ding_user='$usuario', ding_fecha='$fechamia', ding_cant_rechazo = '$f_cantidad' where ding_id = '$id_ding[$i]'";
     //echo $consulta."<br>";
   //echo $consulta."<br>";
  mysql_query($consulta,$dbh);


  if ($f_aprueba[$i]=='R') {
    $log = "INSERT INTO log VALUES(NULL,".$doc_id[$i].",".$f_cantidad[$i].",'RECHAZO PRODUCTO','".$_SESSION["nom_user"]."','".$fechamia."','".$horaSys."','BODEGA','MOVIMIENTOS - INGRESO BODEGA')";
    mysql_query($log,$dbh);
    //Codificacion Guias de Rechazo


     //echo $ultimoRechazo;

   // Actualizacion de la informacion
   //$query = "UPDATE bode_detingreso x, bode_ingreso y, bode_orcom z  SET  y.ing_guiafecharrchzo = '".Date("Y-m-d")."', y.ing_guiaemisorrrchzo='$nombrecom', y.ing_guianumerorrchzo = $ultimoRechazo, y.ing_region='$region' where y.ing_id = ".$ing_id;
    $query = "UPDATE bode_ingreso y SET  y.ing_guiafecharrchzo = '".Date("Y-m-d")."', y.ing_guiaemisorrrchzo='$nombrecom', y.ing_guianumerorrchzo = $ultimoRechazo, y.ing_region='$region' where y.ing_id = ".$ing_id;
    mysql_query($query,$dbh);
   //echo "<br>".$query;

    // FIN

    if ($cantidad[$i]==$f_cantidad[$i]) {

      $consulta="UPDATE bode_detoc set doc_recibidos = doc_recibidos-$cantidad[$i] where doc_id = '$doc_id[$i]'";
        //echo $consulta."<br>";
//      $consulta="UPDATE bode_detoc set doc_recibidos = doc_recibidos-$v_doc_cantidad, doc_estado = '$v_doc_estado' where doc_id = '$f_doc_id[$i]'";
      mysql_query($consulta,$dbh);

      $consulta="UPDATE bode_detoc set doc_tecnicos = doc_tecnicos-$cantidad[$i], doc_rechazados=doc_rechazados+$f_cantidad[$i] where doc_id = '$doc_id[$i]'";
        //echo $consulta."<br>";
//      $consulta="UPDATE bode_detoc set doc_recibidos = doc_recibidos-$v_doc_cantidad, doc_estado = '$v_doc_estado' where doc_id = '$f_doc_id[$i]'";
      mysql_query($consulta,$dbh);
    }
    if ($cantidad[$i]>$f_cantidad[$i]) {

      $consulta="UPDATE bode_detoc set doc_recibidos = doc_recibidos-$f_cantidad[$i] where doc_id = '$doc_id[$i]'";
        //echo $consulta."<br>";
        //exit();
//      $consulta="UPDATE bode_detoc set doc_recibidos = doc_recibidos-$v_doc_cantidad, doc_estado = '$v_doc_estado' where doc_id = '$f_doc_id[$i]'";
      mysql_query($consulta,$dbh);


      $consulta="UPDATE bode_detoc set doc_tecnicos = doc_tecnicos-$cantidad[$i], doc_rechazados=doc_rechazados+$f_cantidad[$i] where doc_id = '$doc_id[$i]'";
     //echo $consulta."<br>";
//      $consulta="UPDATE bode_detoc set doc_recibidos = doc_recibidos-$v_doc_cantidad, doc_estado = '$v_doc_estado' where doc_id = '$f_doc_id[$i]'";
      mysql_query($consulta,$dbh);

      $consulta="UPDATE bode_detoc set doc_final = doc_final+($cantidad[$i]-$f_cantidad[$i]) where doc_id = '$doc_id[$i]'";
     //echo $consulta."<br>";
//      $consulta="UPDATE bode_detoc set doc_recibidos = doc_recibidos-$v_doc_cantidad, doc_estado = '$v_doc_estado' where doc_id = '$f_doc_id[$i]'";
      mysql_query($consulta,$dbh);

    }
    $log = "INSERT INTO log VALUES('NULL',".$doc_id[$i].",".($cantidad[$i] - $f_cantidad[$i]).",'APRUEBA PRODUCTO','".$_SESSION["nom_user"]."','".$fechamia."','".$horaSys."','BODEGA','MOVIMIENTOS - INGRESO BODEGA')";
    mysql_query($log,$dbh);
  }

  if ($f_aprueba[$i]!='R') {

    $log = "INSERT INTO log VALUES(NULL,".$doc_id[$i].",".$f_cantidad[$i].",'APRUEBA PRODUCTO','".$_SESSION["nom_user"]."','".$fechamia."','".$horaSys."','BODEGA','MOVIMIENTOS - INGRESO BODEGA')";
    mysql_query($log,$dbh);

//    $consulta="UPDATE bode_detoc set doc_recibidos = doc_recibidos-$cantidad where doc_id = '$doc_id'";
//     echo $consulta."<br>";
//      $consulta="UPDATE bode_detoc set doc_recibidos = doc_recibidos-$v_doc_cantidad, doc_estado = '$v_doc_estado' where doc_id = '$f_doc_id[$i]'";
//        mysql_query($consulta);

/*
    $consulta="UPDATE bode_detoc set doc_stock = doc_stock+$cantidad where doc_id = '$doc_id'";
//     echo $consulta."<br>";
//      $consulta="UPDATE bode_detoc set doc_recibidos = doc_recibidos-$v_doc_cantidad, doc_estado = '$v_doc_estado' where doc_id = '$f_doc_id[$i]'";
        mysql_query($consulta);
       
*/

        $consulta="UPDATE bode_detoc set doc_tecnicos = doc_tecnicos-$cantidad[$i] where doc_id = '$doc_id[$i]'";
     //echo $consulta."<br>";
//      $consulta="UPDATE bode_detoc set doc_recibidos = doc_recibidos-$v_doc_cantidad, doc_estado = '$v_doc_estado' where doc_id = '$f_doc_id[$i]'";
        mysql_query($consulta,$dbh);

        $consulta="UPDATE bode_detoc set doc_final = doc_final+$cantidad[$i] where doc_id = '$doc_id[$i]'";
     //echo $consulta."<br>";
//      $consulta="UPDATE bode_detoc set doc_recibidos = doc_recibidos-$v_doc_cantidad, doc_estado = '$v_doc_estado' where doc_id = '$f_doc_id[$i]'";
        mysql_query($consulta,$dbh);

      }

 }// end for
 //print_r($_POST);
 ?>
 <!--<script>location.href='bode_inv_indexoc2.php?id=<? //echo $id ?>&id_ing=<? //echo $id_ing ?>&ori=4';</script>!-->
 <script type="text/javascript">
  location.href="bode_inv_indexoc2.php?ori=4&oc_id=<? echo $id ?>&doc_id=<?php echo $doc_id2 ?>&ing_id=<?php echo $ing_id ?>";
</script>