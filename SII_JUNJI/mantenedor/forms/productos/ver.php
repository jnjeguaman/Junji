<?php
$categoria = getCategorias();
?>	

<div class="panel panel-dark">
	<div class="panel-heading">
		<h4 class="panel-title">AGREGAR CATEGORIAS</h4>
	</div>
	<div class="panel-body">
		<div class="form-group">
			<label class="col-sm-3 control-label">CATEGORIA <span class="asterisk">*</span></label>
			<div class="col-sm-9">
				<select name="producto_categoria_id" id="producto_categoria_id" class="form-control" onChange="getProductos(this.value)">
					<option value="" selected>Seleccionar...</option>
					<?php foreach ($categoria as $key => $value): ?>
						<option value="<?php echo $value["categoria_id"] ?>"><?php echo $value["categoria_glosa"] ?></option>
					<?php endforeach ?>
				</select>
			</div>
		</div>
	</div>
</div>

<div class="panel panel-dark resultado" style="display: none;">

</div>
<script type="text/javascript">
	function getProductos(input)
	{
		var data = ({cmd : "getProductos",producto_categoria_id : input});
		$.ajax({
			type:"POST",
			url:"includes/functions.producto.php",
			data:data,
			dataType:"JSON",
			success : function ( response ) {
				
				var totalElementos = 0;
				var tabla = '<div class="panel-heading">';
				tabla += '<div class="panel-btns">';
				tabla += '<a href="" class="panel-minimize tooltips" data-toggle="tooltip" title="Minimize Panel"><i class="fa fa-minus"></i></a>';
				tabla += '<a href="" class="panel-close tooltips" data-toggle="tooltip" title="Close Panel"><i class="fa fa-times"></i></a>';
				tabla += '</div>';
				tabla += '<h4 class="panel-title">LISTADO DE CLIENTES</h4>';
				tabla += '</div>';
				tabla += '<div class="panel-body">';
				tabla += '<table class="table table-striped table-bordered responsive" id="basicTable">';
				tabla += '<thead>';
				tabla += '<th>#</th>';
				tabla += '<th>PRODUCTO</th>';
				tabla += '<th>AFECTO / EXENTO</th>';
				tabla += '<th>NETO</th>';
				tabla += '<th>EDITAR</th>';
				tabla += '</thead>';
				tabla += '<tbody>';
				$.each(response,function(index,value){
					totalElementos++;
					tabla += '<tr>';
					tabla += '<td>'+value.producto_id+'</td>';
					tabla += '<td>'+value.producto_glosa+'</td>';
					if(value.producto_indexe == 0)
					{
						tabla += '<td>AFECTO</td>';
					}else{
						tabla += '<td>EXENTO</td>';
					}
					tabla += '<td>'+value.producto_neto+'</td>';
					tabla += '<td><a href="?pagina=productos&ori=editar&id='+value.producto_id+'" class="btn btn-sm btn-warning">EDITAR <i class="fa fa-pencil"></i></a></td>';
					tabla += '</tr>';
				});
				tabla += '</tbody>';
				tabla += '</table>';
				tabla += '</div>';
				tabla += '</div>';
				if(totalElementos > 0)
				{
					$(".resultado").html(tabla);
					$("#basicTable").DataTable({
						responsive:true
					});
					$(".resultado").css("display","block");
				}else{
					$(".resultado").css("display","none");
				}
			}
		});
	}
</script>