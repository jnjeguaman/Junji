<?
session_start();
extract($_GET);
extract($_POST);
require("inc/config.php");
require("inc/querys.php");
$nivel = $_SESSION["pfl_user"];
$regionsession = $_SESSION["region"];
if($_SESSION["nom_user"] =="" ){
	?><script language="javascript">location.href='sesion_perdida.php';</script><?
}
$date_in=date("Y-m-d");

?>
<html>
<head>
	<title>Defensoria</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<link href="css/estilos.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" media="all" href="librerias/calendar-win2k-cold-1.css" title="win2k-cold-1" />
    <link href="librerias/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script type="text/javascript" src="librerias/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="librerias/bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="librerias/calendar.js"></script>
	<script type="text/javascript" src="librerias/calendar-setup.js"></script>
	<script type="text/javascript" src="librerias/lang/calendar-en.js"></script>
    <style type="text/css">
         /*tfoot input{
            width: 20px;
        }*/
        tfoot input#input1{
            width: 50px;
        }
        tfoot input#input2{
            width: 80px;
        }
        tfoot input#input3{
            width: 150px;
        }
        tfoot input#input4{
            width: 60px;
        }
        tfoot input#input5{
            width: 80px;
        }
        tfoot input#input6{
            width: 80px;
        }
        tfoot input#input7{
            width: 80px;
        }
        tfoot input#input8{
            width: 80px;
        }
        tfoot input#input9{
            width: 80px;
        }

    </style>
</head>

<body>
        <?

        if (isset($_POST['fecha2a']) && isset($_POST['fecha2b'])) {

            $fecha_filtro_2a=$_POST['fecha2a'];
            $fecha_filtro_2b=$_POST['fecha2b'];
            $fecha_filtro_3a=substr($_POST['fecha2a'],8,2)."-".substr($_POST['fecha2a'],5,2)."-".substr($_POST['fecha2a'],0,4);
            $fecha_filtro_3b=substr($_POST['fecha2b'],8,2)."-".substr($_POST['fecha2b'],5,2)."-".substr($_POST['fecha2b'],0,4);
        }
        else {
            $nuevafecha2=strtotime('-30 day',strtotime($date_in));
            $fecha_filtro_2a=date('Y-m-d',$nuevafecha2 );
            $fecha_filtro_2b=date('Y-m-d');
            $nuevafecha2=strtotime('-30 day',strtotime($date_in));
            $fecha_filtro_3a=date('d-m-Y',$nuevafecha2 );
            $fecha_filtro_3b=date('d-m-Y');
        }
        $where3 = " str_to_date(b.log_fechasys,'%d-%m-%Y') BETWEEN str_to_date('".$fecha_filtro_3a."','%d-%m-%Y') AND str_to_date('".$fecha_filtro_3b."','%d-%m-%Y') AND ";
        //echo $where3."<br>";
        ?>
	<div class="navbar-nav ">
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
				<div class="dash-unit2">


					<table width="100%" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td height="20" colspan="2"><span class="Estilo7">GESTI&Oacute;N DE SET DE PAGOS</span></td>
						</tr>

						<tr>
							<td>
                                <?
                                if ($_SESSION["pfl_user"] == 8) {
                                    ?>
                                    <a href="menuadministracion2.php" class="link">VOLVER</a>
                                    <?
                                }
                                else{
                                    ?>
                                    <a href="menuadministracion.php" class="link">VOLVER</a>
                                    <?
                                }
                                ?>
                            </td>
						</tr>

						<tr>
							<td><hr></td>
						</tr> 

					</table>
					<form action="compra_valida6.php" method="POST" name="form1" id="form1" onsubmit="return valida()">
						<table border="0" width="100%" class="table table-striped">
							<tr>
								<td class="Estilo1">FECHA</td>
								<td>
									<input type="text" name="fecha1" class="Estilo2" size="12" value="<? echo $fecha1 ?>" id="f_date_c2" readonly="1">
									<img src="calendario.gif" id="f_trigger_c2" style="cursor: pointer; border: 1px solid red;" title="Date selector" onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />
									<script type="text/javascript">
										Calendar.setup({
        								inputField     :    "f_date_c2",     // id of the input field
        								ifFormat       :    "%Y-%m-%d",      // format of the input field
		        						button         :    "f_trigger_c2",  // trigger for the calendar (button ID)
        								align          :    "Tl",           // alignment (defaults to "Bl")
        								singleClick    :    true
        							});
        						</script>

        						a

        						<input type="text" name="fecha2" class="Estilo2" size="12" value="<? echo $fecha2 ?>" id="f_date_c3" readonly="1">
        						<img src="calendario.gif" id="f_trigger_c3" style="cursor: pointer; border: 1px solid red;" title="Date selector" onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />
        						<script type="text/javascript">
        							Calendar.setup({
        								inputField     :    "f_date_c3",     // id of the input field
        								ifFormat       :    "%Y-%m-%d",      // format of the input field
		        						button         :    "f_trigger_c3",  // trigger for the calendar (button ID)
        								align          :    "Tl",           // alignment (defaults to "Bl")
        								singleClick    :    true
        							});
        						</script>

        					</td>
        				</tr>

        				<tr>

        					<td  valign="center" class="Estilo1" colspan=4 align="center">
        						<input type="submit" name="boton" class="Estilo2" value="  Consultar  "> <a href="compra_valida6.php"> Limpiar </a> </td>
        					</tr>

        				</table>
        			</form>
        			<hr>
        			<!-- DIAS PROMEDIOS TRANSCURRIDOS ENTRE OFICINA DE PARTES Y RECIBIDOS EN SEGUIMIENTO Y CONTROL -->
        			<?php 

        			if($fecha1 <> '')
        			{
        				$where = "eta_fecha_ing >= '".$fecha1."' AND ";
        			}else{
        				$where = "eta_fecha_ing >= '2017-02-01' AND ";
        			}

        			if($fecha2 <> '')
        			{
        				$where2 = "eta_fecha_ing <= '".$fecha2."' AND ";
        			}else{
        				$where2 = "eta_fecha_ing <= '".$date_in."' AND ";
        			}

        			$sql = "SELECT * FROM dpp_etapas WHERE $where $where2 eta_fecha_ing <> '0000-00-00' AND eta_fecha_recepcion2 <> '0000-00-00' AND eta_region = ".$regionsession;
        			// echo $sql;
        			$res = mysql_query($sql);
        			$total = mysql_num_rows($res);

        			while($row = mysql_fetch_array($res))
        			{
        				$fechahoy = $row["eta_fecha_recepcion2"];
        				$dia1 = strtotime($fechahoy);
        				$fechabase =$row["eta_fecha_ing"];
        				$dia2 = strtotime($fechabase);
        				$diff=$dia1-$dia2;
        				$diff=intval($diff/(60*60*24));
        				$dias += $diff;
        			}

        			$sql2 = "SELECT * FROM dpp_etapas WHERE $where $where2 eta_fecha_recepcion2 <> '0000-00-00' AND eta_fecha_recepcion4 <> '0000-00-00' AND eta_region = ".$regionsession;
        			$res2 = mysql_query($sql2);
        			$total2 = mysql_num_rows($res2);

        			while($row2 = mysql_fetch_array($res2))
        			{
        				$fechahoy = $row2["eta_fecha_recepcion4"];
        				$dia1 = strtotime($fechahoy);
        				$fechabase =$row2["eta_fecha_recepcion2"];
        				$dia2 = strtotime($fechabase);
        				$diff=$dia1-$dia2;
        				$diff=intval($diff/(60*60*24));
        				$dias2 += $diff;
        			}

        			$sql3 = "SELECT * FROM dpp_etapas WHERE $where $where2 eta_fechaguia3 <> '0000-00-00 00:00:00' AND eta_fecha_cheque <> '0000-00-00' AND eta_region = ".$regionsession;
        			$res3 = mysql_query($sql3);
        			$total3 = mysql_num_rows($res3);

        			while($row3 = mysql_fetch_array($res3))
        			{
        				$fechahoy = $row3["eta_fecha_cheque"];
        				$dia1 = strtotime($fechahoy);
        				$fechabase =$row3["eta_fechaguia3"];
        				$dia2 = strtotime($fechabase);
        				$diff=$dia1-$dia2;
        				$diff=intval($diff/(60*60*24));
        				$dias3 += $diff;
        			}

                    $sql4 = "SELECT * FROM dpp_etapas WHERE $where $where2 eta_fecha_ing <> '0000-00-00' AND eta_fecha_cheque <> '0000-00-00' AND eta_region = ".$regionsession;
                    $res4 = mysql_query($sql4);
                    $total4 = mysql_num_rows($res4);

                    while($row4 = mysql_fetch_array($res4))
                    {
                        $fechahoy = $row4["eta_fecha_cheque"];
                        $dia1 = strtotime($fechahoy);
                        $fechabase =$row4["eta_fecha_ing"];
                        $dia2 = strtotime($fechabase);
                        $diff=$dia1-$dia2;
                        $diff=intval($diff/(60*60*24));
                        $dias4 += $diff;
                    }

        			?>

        			<table border="0" width="100%">
        				<tr>
        					<td width="230px" class="alert alert-info" style="text-align: center;">
        						<p style="font-weight: bold;">DIAS PROMEDIOS ENTRE OFICINA DE PARTES Y SEGUIMIENTO Y CONTROL</p><br>
        						<?php echo ($dias <> '') ? ($dias / $total)." DIA(S)" : "SIN INFORMACI&Oacute;N" ?>
        					</td>
        					<td width="50px"></td>
        					<td width="230px" class="alert alert-warning" style="text-align: center;">
        						<p style="font-weight: bold;">DIAS PROMEDIOS ENTRE SEGUIMIENTO Y CONTROL Y CONTABILIDAD</p><br>
        						<?php echo ($dias2 <> '') ? ($dias2 / $total2)." DIA(S)" : "SIN INFORMACI&Oacute;N" ?>
        					</td>
        					<td width="50px"></td>
        					<td width="230px" class="alert alert-danger" style="text-align: center;">
        						<p style="font-weight: bold;">DIAS PROMEDIOS ENTRE CONTABILIDAD Y TESORERIA</p><br>
        						<?php echo ($dias3 <> '') ? ($dias3 / $total3)." DIA(S)" : "SIN INFORMACI&Oacute;N" ?>
        					</td>
                            <td width="50px"></td>
                            <td width="230px" class="alert alert-success" style="text-align: center;">
                                <p style="font-weight: bold;">DIAS PROMEDIOS ENTRE OFICINA DE PARTES Y TESORERIA</p><br>
                                <?php echo ($dias4 <> '') ? ($dias4 / $total4)." DIA(S)" : "SIN INFORMACI&Oacute;N" ?>
                            </td>
        				</tr>
        			</table>

        			<!-- FACTURAS CON PAGOS EN MENOS DE 30 DIAS Ó MÁS-->
        			<?php 
        			$sql4 = "SELECT * FROM dpp_etapas WHERE $where $where2 eta_fecha_cheque <> '0000-00-00' AND eta_region = ".$regionsession." AND eta_fecha_ing >= '2017-02-01'";
        			$res4 = mysql_query($sql4);
        			$contador = 0;
        			$contador2 = 0;
        			while($row4 = mysql_fetch_array($res4))
        			{
        				$fechahoy = $row4["eta_fecha_cheque"];
        				$dia1 = strtotime($fechahoy);
        				$fechabase =$row4["eta_fecha_ing"];
        				$dia2 = strtotime($fechabase);
        				$diff=$dia1-$dia2;
        				$diff=intval($diff/(60*60*24));
        				if($diff <= 30){
                        $contador++;
                    }else{
                        $contador2++;
                    }
                    }
                    ?>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="panel panel-success">
                             <div class="panel-heading">PAGOS INFERIORES A 30 DIAS</div>
                             <div class="panel-body"><?php echo ($contador <> '') ? $contador : "SIN INFORMACI&Oacute;N" ?></div>
                         </div>
                     </div>
                     <div class="col-md-6">
                        <div class="panel panel-danger">
                         <div class="panel-heading">PAGOS SUPERIORES A 30 DIAS</div>
                         <div class="panel-body"><?php echo ($contador2 <> '') ? $contador2 : "SIN INFORMACI&Oacute;N" ?></div>
                     </div>
                 </div>
             </div>

             <hr>
             <table class="table table-striped table-bordered table-hover table-condensed">
                <thead>
                    <tr>
                       <td>TOTAL SET ASIGNADOS</td>
                       <td>MONTO TOTAL</td>
                       <td>EJECUTIVO ASIGNADO</td>
                   </tr>
               </thead>

               <tbody>
                 <?
        			// SET DE PAGOS POR EJECUTIVOS
                 $sql5 = "SELECT COUNT(eta_id) as TotalSet, SUM(eta_monto) as TotalMonto,eta_asignado FROM dpp_etapas WHERE $where $where2 eta_region = ".$regionsession." AND eta_asignado <> '' GROUP BY eta_asignado";
                 $res5 = mysql_query($sql5);
                 while($row5 = mysql_fetch_array($res5)){ ?>
                 <tr>
                    <td><?php echo $row5["TotalSet"] ?></td>
                    <td>$<?php echo number_format($row5["TotalMonto"],0,".",".") ?></td>
                    <td><?php echo $row5["eta_asignado"] ?></td>
                </tr>
                <? } ?>
            </tbody>  
        </table>

        <hr>

        <div class="panel panel-warning" width="100%" id="lista2">
            <div class="panel-heading">DOCUMENTOS DEVUELTOS</div>
                <!-- <div class="panel-body">
                </div> -->
            </div>
        </div>      
                
                    <form action="compra_valida6.php#lista2" method="POST" name="form2" id="form2" onsubmit="return valida2()">
                    <table border="0" cellspacing="5" cellpadding="5">
                        <tbody>
                            <tr>
                                <td>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="input-group">
                                          
                                                <input type="text" name="fecha2a" id="fecha2a" value="<? echo $fecha_filtro_2a ?>" class="form-control" placeholder="Desde..." readonly="1">
                                                <span class="input-group-btn">
                                                    <button class="btn btn-primary" id="f_trigger_c4" style='height:34px'>
                                                        <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>
                                                    </button>
                                                    <script type="text/javascript">
                                                        Calendar.setup({
                                                            inputField     :    "fecha2a",     // id of the input field  
                                                            ifFormat       :    "%Y-%m-%d",
                                                      //    ifFormat       :    "%d-%m-%Y",// format of the input field
                                                            button         :    "f_trigger_c4",  // trigger for the calendar (button ID)
                                                            align          :    "Bl",           // alignment (defaults to "Bl")
                                                            singleClick    :    true
                                                        });
                                                    </script>
                                                </span>

                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="input-group">

                                                <input type="text" name="fecha2b" id="fecha2b" value="<? echo $fecha_filtro_2b ?>" class="form-control" placeholder="Hasta..." readonly="1">
                                                <span class="input-group-btn">
                                                    <button class="btn btn-primary" id="f_trigger_c5" style='height:34px'>
                                                        <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>
                                                    </button>
                                                    <script type="text/javascript">
                                                        Calendar.setup({
                                                            inputField     :    "fecha2b",     // id of the input field  
                                                            ifFormat       :    "%Y-%m-%d",// format of the input field
                                                          //ifFormat       :    "%d-%m-%Y",// format of the input field
                                                            button         :    "f_trigger_c5",  // trigger for the calendar (button ID)
                                                            align          :    "Bl",           // alignment (defaults to "Bl")
                                                            singleClick    :    true
                                                        });
                                                    </script>
                                                </span>

                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="input-group text-center">
                                                <div class="btn-group" role="group" >
                                                    <button class="btn btn-primary" type="submit">Buscar</button>
                                                    <a href="compra_valida6.php" class="btn btn-danger"> Limpiar </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="input-group">
                                            <br>
                                                <a href="reportesexcel6.php?region=<? echo $regionsession ?>&fecha1=<? echo $fecha_filtro_3a ?>&fecha2=<? echo $fecha_filtro_3b ?>" class="link" > Exportar a Excel</a>

                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <?
                                $dias2 = (strtotime($fecha_filtro_2a)-strtotime($fecha_filtro_2b))/86400;
                                $dias2 = abs($dias2); 
                                $dias2 = floor($dias2);
                                ?>
                                <td class="Estilo1"> Últimos <? echo $dias2 ?> días</td>
                            </tr>
                            <tr>
                                <td><br></td>
                            </tr>
                        </tbody>
                    </table>
                    </form>
                    <table border="0" width="100%" class="table table-striped table-bordered table-hover "  id="example">
                        <thead>
                            <tr>
                                <th class="Estilo1">N&deg; Doc.</th>
                                <th class="Estilo1">Orden de Compra</th>
                                <th class="Estilo1">Proveedor</th>
                                <th class="Estilo1">Rut</th>
                                <th class="Estilo1">Fecha Env&iacute;o a Contabilidad</th>
                                <th class="Estilo1">Fecha Devoluci&oacute;n</th>
                                <th class="Estilo1">Fecha Reingreso</th>
                                <th class="Estilo1">Fecha Devengo</th>
                                <th class="Estilo1">Fecha Pago</th>
                                <th class="Estilo1">Motivo Devoluci&oacute;n</th>
                                <th class="Estilo1">Observaciones SYC</th>
                            </tr>
                        </thead>
                        <tfoot style="display: table-header-group;">
                            <tr>
                                <th class="Estilo1">N&deg; Doc.</th>
                                <th class="Estilo1">Orden de Compra</th>
                                <th class="Estilo1">Proveedor</th>
                                <th class="Estilo1">Rut</th>
                                <th class="Estilo1">Fecha Env&iacute;o a Contabilidad</th>
                                <th class="Estilo1">Fecha Devoluci&oacute;n</th>
                                <th class="Estilo1">Fecha Reingreso</th>
                                <th class="Estilo1">Fecha Devengo</th>
                                <th class="Estilo1">Fecha Pago</th>
                                <th class="Estilo1">Motivo Devoluci&oacute;n</th>
                                <th class="Estilo1">Observaciones SYC</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                             

                            $sql_dev="SELECT * FROM dpp_etapas a INNER JOIN dpp_etapa_log b ON a.eta_id = b.log_dpp_eta_id WHERE $where3 eta_region='$regionsession' AND (eta_estado<>'99' AND eta_estado<>'98' AND eta_estado<>'0')";
                            //$sql_dev="SELECT * FROM dpp_etapas a INNER JOIN dpp_etapa_log b ON a.eta_id = b.log_dpp_eta_id WHERE eta_region='$regionsession' ORDER BY a.eta_fecha_ing DESC";
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
                                    <td class="Estilo1"> <a href="verdoc.php?id2=<? echo $eta_id_dev; ?>&ori=6">  <? echo $numero ?></a></td>
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
                        </tbody>
                    </table>

</div>
</div>





</div> 

<script type="text/javascript">
    function valida()
    {
        var fecha1 = document.form1.f_date_c2.value;
        var fecha2 = document.form1.f_date_c3.value;
        if(fecha2 < fecha1)
        {
            alert("Rango de fechas tiene problemas");
            return false;
        }
        return true;
    }
    function valida2()
    {
        var fecha1 = document.form2.fecha2a.value;
        var fecha2 = document.form2.fecha2b.value;
        if(fecha2 < fecha1)
        {
            alert("Rango de fechas tiene problemas");
            return false;
        }
        return true;
    }
</script>



<script type="text/javascript" src="librerias/DataTables/media/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="librerias/DataTables/media/css/dataTables.material.min.css">
<script type="text/javascript" src="librerias/DataTables/media/js/dataTables.material.min.js"></script>

<script>

    $(function(){
        var cont=1

        $('#example tfoot th').each( function () {
            var title = $(this).text();
            //$(this).html( '<input type="text" id="input'+cont+'" placeholder="'+title+'" />' );
        $(this).html( '<input type="text" id="input'+cont+'" placeholder="Buscar..." />' );
        cont++;
    } );

    // DataTable

    var table = $('#example').DataTable({
        "order": [[ 0, "desc" ]],
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros por p&aacute;gina",
            "zeroRecords": "Sin resultados.",
            "info": "Mostrando p&aacute;gina _PAGE_ de _PAGES_",
            "infoEmpty": "Sin informaci&oacute;n disponible",
            "infoFiltered": "(filtered from _MAX_ total records)",
            "paginate":{
                "first": "Primero",
                "last": "&Uacute;ltimo",
                "next": "Siguiente",
                "previous" : "Anterior"
            },
            "search": "Buscar"
        }
    });

    table.columns().every( function () {
        var that = this;
        
        $( 'input', this.footer() ).on( 'keyup change', function () {
            if ( that.search() !== this.value ) {
                that
                .search( this.value )
                .draw();
            }
        } );
    } );


})
</script>



</body>

</html>