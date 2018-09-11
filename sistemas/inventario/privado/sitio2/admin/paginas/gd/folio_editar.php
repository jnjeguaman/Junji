<?php
$sql = "SELECT * FROM bode_orcom WHERE oc_id = ".$_GET["id"];
$res = mysql_query($sql,$dbh);
$row = mysql_fetch_array($res);

if(isset($_POST["cmd"]) AND $_POST["cmd"] == "Actualizar")
{
	$update = "UPDATE bode_orcom SET oc_folioguia = ".$_POST["oc_folioguia"]." WHERE oc_id = ".$_POST["oc_id"];
	mysql_query($update,$dbh);
	echo "<script>window.location.href='?page=gd&action=folio';</script>";
}
?>
<div class="page-title">
	<div class="title_left">
		<h3><?php echo $texto ?> > GUIA DE DESPACHO</h3>
	</div>

	<div class="title_right">
		<div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
			<div class="input-group">
				<input type="text" class="form-control" placeholder="Search for...">
				<span class="input-group-btn">
					<button class="btn btn-default" type="button">Go!</button>
				</span>
			</div>
		</div>
	</div>
</div>

<div class="clearfix"></div>

<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">REGION DE DESTINO</div>
			<form action="<?php echo $_SERVER["REQUEST_URI"] ?>" method="POST" data-parsley-validate class="form-horizontal form-label-left">
				
				<div class="form-group">
					<label class="control-label col-md-3 col-sm-3 col-xs-12" for="cat_nombre">FOLIO <span class="required">*</span></label>
					<div class="col-md-6 col-sm-6 col-xs-12">
						<input type="text" id="oc_folioguia" name="oc_folioguia" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $row["oc_folioguia"] ?>" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
					</div>
				</div>

				
				<div class="form-group">
					<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
						<button type="submit" class="btn btn-success">Actualizar</button>
					</div>
				</div>

				<input type="hidden" name="cmd" value="Actualizar">
				<input type="hidden" name="oc_id" value="<?php echo $row["oc_id"] ?>">
			</form>

		</div>
	</div>
</div>
