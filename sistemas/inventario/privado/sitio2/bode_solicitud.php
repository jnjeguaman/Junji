<div style="width:700px;background-color:#E0F8E0; position:absolute; top:160px; left:0px;" id="div1">

<?php if ($ori == ""): ?>
	<?php require_once("bode_solicitud_listado.php") ?>
<?php endif ?>

<?php if ($ori == 1): ?>
	<?php require_once("bode_solicitud_listado.php") ?>
	<?php require_once("bode_solicitud_detalle.php") ?>
<?php endif ?>

<?php if ($ori == 2): ?>
	<?php require_once("bode_solicitud_listado.php") ?>
	<?php // require_once("bode_solicitud_detalle2.php") ?>
	<?php require_once("bode_solicitud_detalle3.php") ?>
<?php endif ?>

</div>
