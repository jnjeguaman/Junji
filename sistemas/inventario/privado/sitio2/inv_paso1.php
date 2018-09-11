


		<table border=0 width="100%">
			<tr>
				<td  class="Estilo2titulo" colspan="10">INGRESO NUEVA COMPRA</td>
			</tr>
		</table>

		<form name="form1" action="junji_guia_compra_grabar.php" method="post"   onSubmit="return validar()"  enctype="multipart/form-data">

			<table border=0 width="100%">

				<tr>
					<td  class="Estilo1">Fecha de Compra</td>
					<td  class="Estilo1">
						<input type="text" name="fecha_compra" class="Estilo2" size="12" value="<?php echo Date("Y-m-d") ?>">
					</td>

					<td  valign="center" class="Estilo1">Fecha de entrega </td>
					<td class="Estilo1" valign="center">
						<input type="text" name="fecha2" class="Estilo2" size="12" value="<?php echo Date("Y-m-d") ?>" id="f_date_c2" >
						<!--<img src="calendario.gif" id="f_trigger_c2" style="cursor: pointer; border: 1px solid red;" title="Date selector"
						onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />!-->
					</td>
				</tr>

				<tr>
					<td  class="Estilo1">N° GUIA / FACTURA</td>
					<td  class="Estilo1">
						<input type="text" name="numero_guia" class="Estilo2" size="12">
					</td>

					<td  valign="center" class="Estilo1">Tipo de compra</td>
					<td  class="Estilo1">
						<select name="tipo_compra" class="Estilo2">
							<option value="">Seleccione...</option>
							<option value="CONVENIO MARCIO">CONVENIO MARCIO</option>
							<option value="LICITACION">LICITACION</option>
							<option value="TRATO DIRECTO">TRATO DIRECTO</option>
						</select>
					</td>
				</tr>

				<tr>
					<td  class="Estilo1">PROVEEDOR</td>
					<td  class="Estilo1">
						<select name="proveedor" class="Estilo2">
							<option value="">Seleccione...</option>
							<option value="TECNODATA S.A">TECNODATA S.A</option>
							<option value="MELLAFE Y SALAS S.A">MELLAFE Y SALAS S.A</option>
							<option value="LAXUS">LAXUS</option>
							<option value="ERGOTEC">ERGOTEC</option>
						</select>
					</td>

					<td  class="Estilo1">ESTADO</td>
					<td  class="Estilo1">
						<select name="estado_guia" class="Estilo2">
							<option value="">Seleccione...</option>
							<option value="1">ENTREGADA</option>
							<option value="0">PENDIENTE</option>
						</select>
					</td>
				</tr>
			</table>
			<hr>
			<table border=0 width="100%">
				<tr>
					<td  class="Estilo2titulo" colspan="10">DESTINO</td>
				</tr>
			</table>

			<table border=0 width="100%">
				<tr>
					<td  class="Estilo1">REGION</td>
					<td  class="Estilo1">
						<select name="destino" class="Estilo2">
							<option value="">Seleccione...</option>
							<option value="DIRECCION NACIONAL">DIRECCION NACIONAL</option>
							<option value="I REGION">I REGION</option>
							<option value="II REGION">II REGION</option>
							<option value="III REGION">III REGION</option>
						</select>
					</td>

					<td  class="Estilo1">PROGRAMA</td>
					<td  class="Estilo1">
						<select name="programa" class="Estilo2">
							<option value="">Seleccione...</option>
							<option value="P1">P1</option>
							<option value="P2">P2</option>
							<option value="GE">GE</option>
							<option value="CECI">CECI</option>
							<option value="CASH">CASH</option>
						</select>
					</td>

				</tr>

				<tr>
					<td  class="Estilo1">ZONA</td>
					<td  class="Estilo1">
						<select name="zona" class="Estilo2">
							<option value="">Seleccione...</option>
							<option value="UNIDAD DE INVENTARIOS">UNIDAD DE INVENTARIOS</option>
							<option value="BODEGA">BODEGA</option>
						</select>
					</td>

					<td  class="Estilo1">DPTO</td>
					<td  class="Estilo1">
						<select name="departamento" class="Estilo2">
							<option value="">Seleccione...</option>
							<option value="UNIDAD DE INVENTARIOS">UNIDAD DE INVENTARIOS</option>
							<option value="BODEGA">BODEGA</option>
							<option value="CENTRAL DE ABASTECIMIENTO">CENTRAL DE ABASTECIMIENTO</option>
						</select>
					</td>

				</tr>

				<tr>
					<td  class="Estilo1">DIRECCION</td>
					<td  class="Estilo1">
						<select name="direccion" class="Estilo2">
							<option value="">Seleccione...</option>
							<option value="DARIO URZUA 1938">DARIO URZUA 1938</option>
							<option value="DARIO URZUA 1989">DARIO URZUA 1989</option>
							<option value="ALAMEDA 1315">ALAMEDA 1315</option>
							<option value="MARCHANT PEREIRA 726">MARCHANT PEREIRA 726</option>
						</select>
					</td>
				</tr>

			</table>
			<hr>
			<!--<table border=0 width="100%">
				<tr>
					<td  class="Estilo2titulo" colspan="10">PRODUCTOS</td>
				</tr>
			</table>

			<table border=0 width="100%">

				<tr>
					<td  class="Estilo1">PRODUCTO</td>
					<td  class="Estilo1">
						<input type="text" name="nombre_producto" class="Estilo2" size="30" >
					</td>

					<td  valign="center" class="Estilo1">CODIGO</td>
					<td class="Estilo1" valign="center">
						<input type="text" name="codigo_producto" class="Estilo2" size="12">
					</td>
				</tr>

				<tr>
					<td  class="Estilo1">PRECIO UNITARIO</td>
					<td  class="Estilo1">
						<input type="text" name="precio_unitario" class="Estilo2" size="12" >
					</td>

					<td  valign="center" class="Estilo1">CANTIDAD COMPRADO</td>
					<td class="Estilo1" valign="center">
						<input type="text" name="stock_comprado" class="Estilo2" size="12">
					</td>
				</tr>

				<tr>
					<td  class="Estilo1">STOCK ENTREGADO</td>
					<td  class="Estilo1">
						<input type="text" name="rut" class="Estilo2" size="12" >
					</td>

					<td  valign="center" class="Estilo1">STOCK RESTANTE</td>
					<td class="Estilo1" valign="center">
						<input type="text" name="stock_entregado" class="Estilo2" size="12">
					</td>


				</tr>

				<tr>
					<td  class="Estilo1">ESTADO</td>
					<td  class="Estilo1">
						<select name="estado_producto" class="Estilo2">
							<option value="">Seleccione...</option>
							<option value="ENTREGADA">ENTREGADA</option>
							<option value="PENDIENTE">PENDIENTE</option>
						</select>
					</td>
				</tr>

				<tr>
					<td class="Estilo1">OBSERVACIONES</td>
					<td class="Estilo1">
						<textarea class="obs_producto"></textarea>
					</td>
				</tr>
			</table>
			<hr>!-->

			<table border=0 width="100%">
				<tr>
					<td  class="Estilo1c">
						<input type="submit" name="submit" class="Estilo2" size="11" value="    Grabar    " >
					</td>
				</tr>
			</table>
		</form>



	<div  style="width:630px; height:280px; background-color:#F2F2F2; position:absolute; top:120px; left:710px;visibility: hidden;" id="div2">

		<table border=0 width="100%">
			<tr>
				<td  class="Estilo2titulo" colspan="10">LISTADO DE PRODUCTOS</td>
			</tr>

			<tr>
				<td  class="Estilo1m">PRODUCTO</td>
				<td  class="Estilo1m">CODIGO</td>
				<td  class="Estilo1m">ESTADO</td>
				<td  class="Estilo1m">VALOR UNITARIO</td>
				<td  class="Estilo1m">STOCK</td>
			</tr>

			<tr>
				<td  class="Estilo1m">REFRIGERADOR</td>
				<td  class="Estilo1m">001</td>
				<td  class="Estilo1m">ENTREGADA</td>
				<td  class="Estilo1m">$335.283</td>
				<td  class="Estilo1m">20</td>
			</tr>

		</div>

