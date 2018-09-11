<!DOCTYPE html>
<html>
<head>
	<title>INEDIS</title>
	<meta charset="UTF-8">
	<link href="css/stylo_defensoriapenal.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
	<script src="librerias/jquery-1.11.3.min.js"></script>

</head>

<body>
	<div style="background-color:#FFFFFF; position:absolute; content:''; z-index:3;">
		<?php include("inc/menu_1b.php"); ?>
	</div>

	<div style="width:100%; background-color:#E0F8E0; position:absolute; top:120px; left:0px;" id="div1">






		<table width="100%" border="0" cellspacing="0" cellpadding="0">

			<tr>
				<td height="50" colspan="3">
					<form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="POST" onSubmit="return valida()">
						<table border="1">
							<tr>
								<td class="Estilo1mc">ORDEN DE COMPRA : <input type="text" size="3" name="oc1" id="oc1" value="<?php echo $oc1 ?>">-<input type="text" size="3" id="oc2" name="oc2" value="<?php echo $oc2 ?>">-<input type="text" size="3" id="oc3" name="oc3" value="<?php echo $oc3 ?>"> <button type="submit" name="submit" value="BUSCAR">Buscar <i class="fa fa-search"></i></button></td>
							</tr>
						</table>
					</form>
					<?php if(isset($submit) && $submit == "BUSCAR") {include("devengo_ori1.php"); }?>
					<?php if($ori == 2) { include("devengo_ori2.php"); }?>
					<?php if($ori == 4) { include("devengo_ori4.php"); }?>
					<?php if($_POST["ori"] == 3) { include("devengo_ori3.php"); }?>
				</tr>

			</table>


		</div>

		<script type="text/javascript">

										$("#toggle").click(function(event)
										{
											if($("#toggle").is(":checked"))
											{
												$(':checkbox').each(function() {
													this.checked = true;                        
												});
											}else{
												$(':checkbox').each(function() {
													this.checked = false;                        
												});
											}
										});

										function valida(){
											var prefijoOC = $("#oc1").val();
											var correlativoOC = $("#oc2").val();
											var sufijoOC = $("#oc3").val();

											if(prefijoOC == "")
											{
												alert("INGRESE EL PREFIJO DE LA ORDEN DE COMPRA");
												$("#oc1").focus();
												return false;
											}else if(correlativoOC == "")
											{
												alert("INGRESE EL CORRELATIVO DE LA ORDEN DE COMPRA");
												$("#oc2").focus();
												return false;
											}else if(sufijoOC == "")
											{
												alert("INGRESE EL SUFIJO DE LA ORDEN DE COMPRA");
												$("#oc3").focus();
												return false;
											}else{
												return true;
											}
										}
									</script>


	</body>
	</html>	