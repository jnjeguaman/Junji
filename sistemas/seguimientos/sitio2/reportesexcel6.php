<?
header("Content-Type: application/vnd.ms-excel; name='listador'");
header("Content-Disposition: attachment; filename=reportes.xls");

require("inc/config.php");
$date_in=date("Y-m-d");
?>
<html>
    <head>
        <title>Defensoria</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

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
        	text-align: left;
        }
        .Estilo1c {
        	font-family: Verdana;
        	font-weight: bold;
        	font-size: 8px;
        	color: #003063;
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
        .Estilo7 {font-size: 12px; font-weight: bold; }
        -->
        </style>

    </head>


    <body>

        <?
        $region=$_GET["region"];
        $fecha1=$_GET["fecha1"];
        $fecha2=$_GET["fecha2"];
        
        ?>


        <table border=1>
            <tr>
                <td class="Estilo1">N&deg; Documento</td>
                <td class="Estilo1">Orden de Compra</td>
                <td class="Estilo1">Proveedor</td>
                <td class="Estilo1">Rut</td>
                <td class="Estilo1">Fecha Env&iacute;o a Contabilidad</td>
                <td class="Estilo1">Fecha Devoluci&oacute;n</td>
                <td class="Estilo1">Fecha Reingreso</td>
                <td class="Estilo1">Fecha Devengo</td>
                <td class="Estilo1">Fecha Pago</td>
                <td class="Estilo1">Motivo Devoluci&oacute;n</td>
                <td class="Estilo1">Observaciones SYC</td>
            </tr>

            <?
            $sw=0;

            $sql_dev="SELECT * FROM dpp_etapas a INNER JOIN dpp_etapa_log b ON a.eta_id = b.log_dpp_eta_id WHERE ";

            if ($region<>"") {
                if ($region==0)
                    $sql_dev.=" a.eta_region<>'' AND ";
                else
                    $sql_dev.=" a.eta_region=$region AND ";
                $sw=1;
            }
            if ($fecha1<>"" and $fecha2<>"" ) {

                $sql_dev.=" str_to_date(b.log_fechasys,'%d-%m-%Y') BETWEEN str_to_date('".$fecha1."','%d-%m-%Y') AND str_to_date('".$fecha2."','%d-%m-%Y') AND ";
                $sw=1;
            }
            


            if ($sw==1){
                $sql_dev.=" (a.eta_estado<>'99' AND a.eta_estado<>'98' AND a.eta_estado<>'0') AND 1=1 ORDER BY a.eta_fecha_ing DESC ";
            }
            if ($sw==0){
                $sql_dev.=" 1=2";
            }



            //echo $sql_dev;
            $res_dev=mysql_query($sql_dev);

            while ($row_dev=mysql_fetch_array($res_dev)) {
                $eta_id_dev=$row_dev['eta_id'];
                $numero=$row_dev['eta_numero'];
                                
                if ($row_dev['eta_nroorden'] == "") {
                    $ocompra="Sin Orden";
                }else {
                    $ocompra=$row_dev['eta_nroorden'];
                }
                $proveedor=$row_dev['eta_cli_nombre'];
                $rutproveedor=$row_dev['eta_rut'];
                $digitoproveedor=$row_dev['eta_dig'];

                if ($row_dev['eta_fecha_recepcion'] == "0000-00-00" || $row_dev['eta_fecha_recepcion'] == null || $row_dev['eta_fecha_recepcion'] == "") {
                    $fechaenvioconta="No Enviado";
                }else {
                    $fechaenvioconta=date( "d-m-Y",strtotime( $row_dev['eta_fecha_recepcion'] ) );
                }

                $fechadevuelto=$row_dev['log_fechasys'];

                if ($row_dev['log_fechaenvio'] == "0000-00-00" || $row_dev['log_fechaenvio'] == null || $row_dev['log_fechaenvio'] == "") {
                    $fechareingreso="No Reingresado";
                }else {
                    $fechareingreso=$row_dev['log_fechaenvio'];
                }

                if ($row_dev['eta_fdevengo'] == "0000-00-00" || $row_dev['eta_fdevengo'] == null || $row_dev['eta_fdevengo'] == "") {
                    $fechadevengo="Por Devengar";
                }else {
                    $fechadevengo=date( "d-m-Y",strtotime( $row_dev['eta_fdevengo'] ) );
                }

                if ($row_dev['eta_fechache'] == "0000-00-00" || $row_dev['eta_fechache'] == null || $row_dev['eta_fechache'] == "") {
                    $fechapago="Por Pagar";
                }else {
                    $fechapago=date( "d-m-Y",strtotime( $row_dev['eta_fechache'] ) );
                }
                                
                $motivodevuelto=$row_dev['log_motivo'];

                if ($row_dev['log_observacion'] == "") {
                                    $observacion="Sin Observacion";
                }else {
                    $observacion=$row_dev['log_observacion'];
                }

                ?>
                <tr>
                    <td class="Estilo1"><? echo $numero ?></td>
                    <td class="Estilo1"><? echo $ocompra ?></td>
                    <td class="Estilo1"><? echo $proveedor ?></td>
                    <td class="Estilo1"><? echo $rutproveedor."-".$digitoproveedor ?></td>
                    <td class="Estilo1"><? echo $fechaenvioconta ?></td>
                    <td class="Estilo1"><? echo $fechadevuelto ?></td>
                    <td class="Estilo1"><? echo $fechareingreso ?></td>
                    <td class="Estilo1"><? echo $fechadevengo ?></td>
                    <td class="Estilo1"><? echo $fechapago ?></td>
                    <td class="Estilo1"><? echo $motivodevuelto ?></td>
                    <td class="Estilo1"><? echo $observacion ?></td>
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>

