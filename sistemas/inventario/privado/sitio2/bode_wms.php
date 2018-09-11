<?php
extract($_POST);
?>
<style type="text/css">
	li.wms{
		float: left;
	}
	ul.wms{
		list-style-type: none;
		margin: 0;
		padding: 0;
		overflow: hidden;
	}
	a{
		text-decoration: none;
		color: #FFF;

	}
</style>
<div style="width:100%;background-color:#E0F8E0; position:absolute; top:160px; left:0px;" id="div1">
	<ul class="wms">
		<li class="wms button"><a href="bode_inv_indexoc4.php?cmd=WMS&ori=1" disabled>* CARGA G/D AUTOMÁTICO</a></li>
		<li class="wms button"><a href="bode_inv_indexoc4.php?cmd=WMS&ori=2">CARGA G/D MANUAL</a></li>
		<li class="wms button"><a href="bode_inv_indexoc4.php?cmd=WMS&ori=3">CARGA RECIBIDO MANUAL</a></li>
		<li class="wms button"><a href="bode_inv_indexoc4.php?cmd=WMS&ori=4">* CARGA RECIBIDO AUTOMÁTICO</a></li>
	</ul>
	<hr>
<?php
if($cmd == "WMS" && $ori == 1) {
	require_once("bode_wms_ori1.php");
}

if($cmd == "WMS" && $ori == 2) {
	require_once("bode_wms_ori2.php");
}

if($cmd == "WMS" && $ori == 3) {
	require_once("bode_wms_ori3.php");
}

if($cmd == "WMS" && $ori == 4) {
	require_once("bode_wms_ori4.php");
}

?>
	</div>
