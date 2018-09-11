<div  style="background-color:#E0F8E0; position:absolute;  left:530px;top:40px" id="div2">
				<table border="1" width="100%">
					<tr>
						<td class="Estilo2titulo">PREVISUALIZACION</td>
					</tr>
				</table>
				<?php
				print_r($_POST);
				print_r($_FILES);
// LEEMOS EL ARCHIVO
				$extension =  strtoupper(pathinfo($_FILES["wmsCSV"]["name"],PATHINFO_EXTENSION));

				if($extension === "CSV")
				{
					if($_FILES["wmsCSV"]["type"] == "application/vnd.ms-excel")
					{


// -----------------------------------------------

						echo "<pre>";
						$csv = array_map("str_getcsv", file($_FILES["wmsCSV"]["tmp_name"]));
						print_r($csv);
						echo "</pre>";
						$totalElementos = count($csv);
						echo $totalElementos;

// FILA N° 2 ENCABEZADO DE LA GUIA
// FILA 3 EN ADELANTE EL DETALLE DE LOS PRODUCTOS QUE SE AÑADIRAN

// -----------------------------------------------

					}else{
						echo "Formato de archivo no permitido";
					}
				}else{
					echo "Extension no permitida";
				}
				?>
			</div>