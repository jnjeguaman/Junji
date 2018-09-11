<!-- SIDEBAR !-->
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
<?php if ($_SESSION["admin"]["admin_perfil"] == 1 || $_SESSION["admin"]["admin_perfil"] == 2): ?>
	
	<!-- SECCION 1 !-->
	<div class="menu_section">
		<h3>INVENTARIO</h3>
		<ul class="nav side-menu">
			<?php if ($_SESSION["admin"]["admin_perfil"] == 1 || $_SESSION["admin"]["admin_perfil"] == 2): ?>
				<li><a><i class="fa fa-road"></i> ZONAS <span class="fa fa-chevron-down"></span></a>
				<ul class="nav child_menu" style="display: none">
					<li><a href="?page=zonas&action=crear">CREAR</a></li>
					<li><a href="?page=zonas&action=editar">EDITAR</a></li>
				</ul>
			</li>
			<?php endif ?>
			
			<?php if ($_SESSION["admin"]["admin_perfil"] == 1 || $_SESSION["admin"]["admin_perfil"] == 2): ?>
			<li><a><i class="fa fa-road"></i> SUBZONAS <span class="fa fa-chevron-down"></span></a>
				<ul class="nav child_menu" style="display: none">
					<li><a href="?page=subzonas&action=crear">CREAR</a></li>
					<li><a href="?page=subzonas&action=editar">EDITAR</a></li>
				</ul>
			</li>
			<?php endif ?>
	
			<?php if ($_SESSION["admin"]["admin_perfil"] == 1): ?>
			<li><a><i class="fa fa-cog"></i> CATEGORIAS <span class="fa fa-chevron-down"></span></a>
				<ul class="nav child_menu" style="display: none">
					<li><a href="?page=categorias">CATEGORIAS</a></li>
					<li><a href="?page=subcategorias">SUBCATEGORIAS</a></li>
				</ul>
			</li>
			<?php endif ?>
			
			<?php if ($_SESSION["admin"]["admin_perfil"] == 1): ?>
			<li><a><i class="fa fa-home"></i> CLASIFICACIÓN <span class="fa fa-chevron-down"></span></a>
				<ul class="nav child_menu" style="display: none">
					<li><a href="?page=clasificacion&action=reclasificar">RECLASIFICAR</a></li>
					<li><a href="?page=clasificacion&action=region">CAMBIAR REGION</a></li>
					<li><a href="?page=clasificacion&action=productos">CLASIFICAR PRODUCTOS</a></li>
				</ul>
			</li>
			<?php endif ?>

			<!-- <li><a href="?page=carga&action=inventario"><i class="fa fa-upload"></i> Cargar Planilla</a></li> -->
			<?php if ($_SESSION["admin"]["admin_perfil"] == 1): ?>
			<li><a href="?page=encargados"><i class="fa fa-users"></i>ENCARGADOS</a></li>
			<?php endif ?>

			<?php if ($_SESSION["admin"]["admin_perfil"] == 1): ?>
			<li><a href="?page=guiasinventariables"><i class="fa fa-users"></i>GUÍAS</a></li>
			<?php endif ?>

			<?php if ($_SESSION["admin"]["admin_perfil"] == 1): ?>
			<li><a href="?page=devengo"><i class="fa fa-users"></i>DEVENGO</a></li>
			<?php endif ?>

		</ul>
	</div>
	<!-- FIN SECCION 1 !-->
<?php endif ?>
	
	<?php if ($_SESSION["admin"]["admin_perfil"] == 1 || $_SESSION["admin"]["admin_perfil"] == 2): ?>
	<!-- SECCION 2 !-->
	<div class="menu_section">
		<h3>EXISTENCIA</h3>
		<ul class="nav side-menu">
			<?php if ($_SESSION["admin"]["admin_perfil"] == 1 || $_SESSION["admin"]["admin_perfil"] == 2): ?>
			<li><a href="?page=jardines"><i class="fa fa-home"></i>JARDINES</a>
			</li>
			<?php endif ?>
			
			<?php if ($_SESSION["admin"]["admin_perfil"] == 1): ?>
			<li><a><i class="fa fa-home"></i> Guia de Despacho <span class="fa fa-chevron-down"></span></a>
				<ul class="nav child_menu" style="display: none">
					<li><a href="?page=gd&action=folio">Cambiar Folio</a></li>
					<li><a href="?page=gd&action=anularfolio">Anular Folio</a></li>
					<li><a href="?page=gd&action=anularGuia">Anular Guía</a></li>
				</ul>
			</li>
			<?php endif ?>
			
			<?php if ($_SESSION["admin"]["admin_perfil"] == 1): ?>
			<li><a><i class="fa fa-home"></i> Orden de Compra <span class="fa fa-chevron-down"></span></a>
				<ul class="nav child_menu" style="display: none">
					<li><a href="?page=oc&action=aperturar">Programas</a></li>
					<li><a href="?page=oc&action=aperturarItem">Dirnac y Metro</a></li>
					<li><a href="?page=oc&action=aperturar2">Licitacion</a></li>
					<li><a href="?page=oc&action=multiple">Aperturar Multiple</a></li>
					<li><a href="?page=oc&action=nombre">Cambiar nombre</a></li>
				</ul>
			</li>
			<?php endif ?>
		
		<?php if ($_SESSION["admin"]["admin_perfil"] == 1): ?>
		<li><a><i class="fa fa-home"></i> RT / RC <span class="fa fa-chevron-down"></span></a>
				<ul class="nav child_menu" style="display: none">
					<li><a href="?page=rtrc&action=fecha">Fecha de Ingreso</a></li>
					<li><a href="?page=rtrc&action=anular">Anular ingreso</a></li>
				</ul>
			</li>
			<?php endif ?>

<?php if ($_SESSION["admin"]["admin_perfil"] == 1): ?>
			<li><a href="?page=encargados2"><i class="fa fa-users"></i> Encargados</a></li>
			<?php endif ?>
		</ul>
	</div>
	<!-- FIN SECCION 2 !-->

	<?php if ($_SESSION["admin"]["admin_perfil"] == 1): ?>
	<!-- SECCION 3 !-->
	<div class="menu_section">
		<h3>Usuarios</h3>
		<ul class="nav side-menu">
			<li><a><i class="fa fa-users"></i> Usuarios <span class="fa fa-chevron-down"></span></a>
				<ul class="nav child_menu" style="display: none">
					<li><a href="?page=usuarios&action=crear">Crear</a></li>
					<li><a href="?page=usuarios&action=editar">Editar</a></li>
				</ul>
			</li>
		</ul>
	</div>
	<?php endif ?>
	<!-- FIN SECCION 3 !-->
	
	<?php if ($_SESSION["admin"]["admin_perfil"] == 1 || $_SESSION["admin"]["admin_perfil"] == 2): ?>
	<!-- SECCION 4 !-->
	<div class="menu_section">
		<h3>GENERAL</h3>
		<ul class="nav side-menu">
		<?php if ($_SESSION["admin"]["admin_perfil"] == 1): ?>
			<li><a><i class="fa fa-area-chart"></i> Estadistica <span class="fa fa-chevron-down"></span></a>
				<ul class="nav child_menu" style="display: none">
					<li><a href="?page=estadistica">Estadisticas</a></li>
					<li><a href="?page=estadistica&action=ultimosregistros">Últimos Registros</a></li>
				</ul>
			</li>
			<?php endif ?>
	
	<?php if ($_SESSION["admin"]["admin_perfil"] == 1): ?>
			<li><a><i class="fa fa-area-chart"></i> Parametros <span class="fa fa-chevron-down"></span></a>
				<ul class="nav child_menu" style="display: none">
					<li><a href="?page=parametros&action=crear">Nuevo</a></li>
					<li><a href="?page=parametros&action=editar">Editar</a></li>
				</ul>
			</li>
			<?php endif ?>
	
	<?php if ($_SESSION["admin"]["admin_perfil"] == 1): ?>
			<li><a href="?page=configuracion"><i class="fa fa-cog"></i> Configuración INEDIS</a></li>
			<?php endif ?>

			<?php if ($_SESSION["admin"]["admin_perfil"] == 1 || $_SESSION["admin"]["admin_perfil"] == 2): ?>
			<li><a href="../inv_index.php"><i class="fa fa-home"></i> INEDIS</a></li>
			<?php endif ?>
		</ul>
	</div>
	<!-- FIN SECCION 3 !-->
	<?php endif ?>
<?php endif ?>
</div>