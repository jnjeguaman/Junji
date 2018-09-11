<div  style="width:630px; height:210px; background-color:#E0F8E0; position:absolute; top:120px; left:850px;" id="div2">
	<div id="seccion1" style="background-color:#E0F8E0;" >
	
	    <!-- Recupera la ORDEN DE COMPRA SELECCIONADA Y LA MUESTRA 		-->
	    <?
		   
		    $sql2 = "SELECT * FROM bode_orcom where  oc_id = '$id'";
//		    $sql2 = "SELECT * FROM bode_orcom,bode_proveedor where oc_pro_id = pro_id and oc_id = '$id_oc'";
//            echo $sql2;
			$res2 = mysql_query($sql2);
			$sw_color=0;
            $oc_id=$id;
			while ($row2 = mysql_fetch_array($res2)) {
				$v_oc_id	            = $row2['oc_id'];
				$v_oc_id2	            = $row2['oc_id2'];
				$v_oc_region	        = $row2['oc_region'];
				$v_oc_nombre_oc	        = $row2['oc_nombre_oc'];
				$v_oc_prog_id	        = $row2['oc_prog_id'];
				$v_oc_fecha	            = $row2['oc_fecha'];
				$v_oc_fecha_recep	    = $row2['oc_fecha_recep'];
				$v_oc_recibido_usu_id	= $row2['oc_recibido_usu_id'];
				$v_oc_pro_id	        = $row2['oc_pro_id'];
				$v_oc_observaciones	    = $row2['oc_observaciones'];
				$v_oc_estado            = $row2['oc_estado'];
				
				$v_pro_rut              = $row2['oc_proveerut'];
				$v_pro_glosa            = $row2['pro_glosa'];
			}
		
		
		?>
	
		<form name="f1" method="POST" action="inv_indexoc3.php">
		<table border="0"  width="100%">
			<tr>
				<td  class="Estilo2titulo" colspan="10">AGREGAR PRODUCTOS A GUIA DE DESPACHO</td>
			</tr>
			<tr>
			    <td class="Estilo1c">Buscar Guia </td>
				<td class="Estilo2">  <input type="text" name="numoc" size=15 value="<? echo $numoc ?>"> </td>
			<tr>
			
			<tr>
			    <td class="Estilo1c">Especificacion </td>
				<td class="Estilo2">  <input type="text" name="especificacion" size=10> </td>

			<tr>
			<tr>
				<td class="Estilo2">  <input type="submit" value="Buscar" size=10> </td>
			<tr>

		</table>
          <input type="hidden" name="oc" value="<? echo $codigo ?>"  >
          <input type="hidden" name="ori" value="<? echo $ori ?>"  >
          <input type="hidden" name="id" value="<? echo $id ?>"  >
  </form>
  
		<hr>
		
		<!-- COMIENZO DEL FORMULARIO -->
		
		
		<form name="f1" method="POST" action="inv_ingresos_gr.php">

		<table border="0"  width="100%">

		</table>
 <table border="0" width="100%">
                           <tr>
                             <td  valign="center" class="Estilo1">Region</td>
                             <td  valign="center" class="Estilo1">Descripcion</td>
                             <td  valign="center" class="Estilo1">Cantidad</td>

                             <td  valign="center" class="Estilo1">Total</td>
                           </tr>

	<form name="form1" action="inv_grabaindexoc2.php" method="post" onsubmit="return validaree()">
 <?

$sql3 = "SELECT * FROM bode_orcom x, bode_detoc y WHERE x.oc_id2 = '$numoc'  and x.oc_id=y.doc_oc_id and y.doc_recibidos>0; ";
//$sql3 = "SELECT * FROM bode_detoc WHERE doc_oc_id = ".$numoc;
echo $sql3;
$i=0;
$res3 = mysql_query($sql3);
while ($row3 = mysql_fetch_array($res3)) {



?>
                           <tr>

                             <td class="Estilo1" colspan=1>
                              <input type="checkbox" name="var7[<? echo $i ?>]" class="Estilo2" size="40"  value="<? echo $row3["doc_id"] ?>" >
                             </td>

                             <td class="Estilo1" colspan=1>

                                                 <select name="var4[<? echo $i ?>]" id="region2" class="Estilo2" >
						<option value="">Seleccionar...</option>
				<?php
                        $j=1;
						while($j<$ii) {
				?>
							<option value="<? echo  $regionN[$j] ?>" <? if ($row3["doc_region"]==$regionN[$j]) { echo  "selected=selected"; } ?> > <? echo $regionG[$j] ?></option>
  			    <?php
                           $j++;
                        }
                ?>
					</select>
                             </td>

                             <td class="Estilo1" colspan=1>
                              <input type="text" name="" class="Estilo2" size="40"  disabled value="<? echo $row3["doc_especificacion"] ?>" >
                              <input type="hidden" name="var5[<? echo $i ?>]" class="Estilo2" size="40"  value="<? echo $row3["doc_id"] ?>" >
                             </td>
                             <td class="Estilo1" colspan=1>
                              <input type="text" name="var2[<? echo $i ?>]" class="Estilo2" size="7"  disabled value="<? echo number_format($row3["doc_cantidad"],0,',','.'); ?>" >
                             </td>
                             <td class="Estilo1" colspan=1>
                              <input type="text" name="var3[<? echo $i ?>]" class="Estilo2" size="7" disabled value="<? echo number_format($row3["doc_valor_unit"],0,',','.'); ?>" >
                             </td>

                            </tr>
<?

  $i=$i+1;
}

 ?>
     </table>
		</form>
	</div>
</div>

<script type="text/javascript">
	function eliminarItem(input) {
		var data = ({cmd : "eliminarItem", compra_id : input});

		$.ajax({
			type:"POST",
			url:"inv_eliminar_compra.php",
			data:data,
			dataType:"JSON",
			cache:false,
			success : function ( response ) {
				console.log(response);
			}
		});
	}
</script>
