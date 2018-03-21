<?
session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>DOCUMENTOS</title>
		<meta charset="UTF-8">
		<link href="librerias/bootstrap/css/bootstrap.min.css" rel="stylesheet">
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
		.Estilo1cverde {
		  font-family: Verdana;
		  font-weight: bold;
		  font-size: 10px;
		  color: #009900;
		  text-align: right;
		}
		.Estilo1camarrillo {
		  font-family: Verdana;
		  font-weight: bold;
		  font-size: 10px;
		  color: #CCCC00;
		  text-align: right;
		}
		.Estilo1crojo {
		  font-family: Verdana;
		  font-weight: bold;
		  font-size: 10px;
		  color: #CC0000;
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
		.Estilo7 {font-family: Geneva, Arial, Helvetica, sans-serif;
		font-size: 14px;
		font-weight: bold;
		text-align: center; }

		-->
		</style>
		<script type="text/javascript" src="librerias/jquery-1.11.3.min.js"></script>
		<script type="text/javascript" src="librerias/bootstrap/js/bootstrap.min.js"></script>
	</head>
	<body>
		<?
		require_once("inc/config.php");
		$nivelmio = $_SESSION["pfl_user"];
		$id=$_GET['eta_id'];
		?>

		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header text-center">
					<h4 class="modal-title" id="myModalLabel">Historial</h4>
				</div>
				<div class="modal-body">
					

					<table border="2" class="table table-striped">

						<tr>

							<td class="Estilo1" width="200px"> Folio </td>

							<td class="Estilo1" width="200px"> Usuario de Devolucion </td>

							<td class="Estilo1" width="400px"> Fecha de Devolucion </td>

							<td class="Estilo1" width="200px"> Usuario de Envio </td>

							<td class="Estilo1" width="200px"> Fecha de Envio </td>

							<td class="Estilo1" width="200px"> Origen </td>

							<td class="Estilo1" width="200px"> Destino </td>

							<td class="Estilo1" width="200px"> Estado </td>

							<td class="Estilo1" width="600px"> Motivo </td>

						</tr>

						
							<?
							if($nivelmio == 3){

								$sql="	SELECT *
										FROM dpp_etapa_log
										WHERE log_dpp_eta_id = '$id'
										AND (log_origen = '3' OR log_destino = '3') ";

							}

							if($nivelmio == 5){
							
								$sql="	SELECT *
										FROM dpp_etapa_log
										WHERE log_dpp_eta_id = '$id'
										AND (log_origen = '5' OR log_destino = '5') ";

							}

							if($nivelmio == 7 || $nivelmio == 8){
							
								$sql="	SELECT *
										FROM dpp_etapa_log
										WHERE log_dpp_eta_id = '$id'
										AND (log_origen = '7' OR log_destino = '7' or log_origen = '8' or log_destino = '8') ";

							}
							if($nivelmio == 31){
							
								$sql="	SELECT *
										FROM dpp_etapa_log
										WHERE log_dpp_eta_id = '$id'
										AND (log_origen = '31' OR log_destino = '31') ";

							}

							

							$res= mysql_query($sql);

							while($row = mysql_fetch_array($res)){

								$folio=$_GET['eta_folio'];
								$log_eta_id = $row['log_dpp_eta_id'];
								$log_usr = $row['log_usr'];
								$log_fecha = $row['log_fechasys'];
								$log_hora = $row['log_horasys'];
								$log_usrenvio = $row['log_usrenvio'];
								$log_fechaenvio = $row['log_fechaenvio'];
								$log_horaenvio = $row['log_horaenvio'];
								$log_origen = $row['log_origen'];
								$log_destino = $row['log_destino'];
								$log_motivo = $row['log_motivo'];
								$log_estado = $row['log_estado'];

								if($log_origen == 3){
									$log_origenb="Partes";
								}
								if($log_destino == 3){
									$log_destinob="Partes";
								}

								if($log_origen == 5){
									$log_origenb = "Contabilidad";
								}
								if($log_destino == 5){
									$log_destinob = "Contabilidad";
								}

								if($log_origen == 7){
									$log_origenb="Seguimiento y control";
								}
								if($log_destino == 7){
									$log_destinob = "Seguimiento y control";
								}

								if($log_origen == 8){
									$log_origenb="Seguimiento y control";
								}
								if($log_destino == 8){
									$log_destinob = "Seguimiento y control";
								}

								if($log_origen == 31){
									$log_origenb = "Tesoreria";
								}
								if($log_destino == 31){
									$log_destinob = "Tesoreria";
								}

								if($log_motivo == ""){
									$log_motivo = "Revisado";
								}

								if($log_estado == "Devuelto"){
									$clase="Estilo1crojo";
								}

								if($log_estado == "Reenviado"){
									$clase="Estilo1cverde";
								}
								

								?>
								<tr>
									<td class="Estilo1"> <? echo $folio; ?></td>

									<td class="Estilo1"> <? echo $log_usr; ?></td>

									<td class="Estilo1"> <? echo $log_fecha; ?> <? echo $log_hora; ?></td>

									<td class="Estilo1"> 
										<? 
										if($log_usrenvio == ''){
											echo "En Proceso...";
										} 
										else {
											echo $log_usrenvio;
										}
										?>
									</td>

									<td class="Estilo1"> 
										<? 
										if($log_fechaenvio == ''){
											echo "En Proceso...";
										} 
										else {
											echo $log_fechaenvio."<br>";  echo $log_horaenvio;
										}
										?>
									</td>

									<td class="Estilo1"> <? echo $log_origenb; ?></td>

									<td class="Estilo1"> <? echo $log_destinob; ?></td>

									<td class=""><p class="<? echo $clase; ?>"> <? echo $log_estado; ?> </p></td>

									<td class="Estilo1"> <? echo $log_motivo; ?></td>
								</tr>
								<?
							}
							?>
							
						
					</table>



				</div>
				<div class="modal-footer">
					<div class="col-md-12 text-center">
						<button type="button" class="btn btn-default" data-dismiss="modal" onclick="self.close()">Cerrar</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>