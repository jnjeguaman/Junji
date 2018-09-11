
<div  style="width:630px; height:280px; background-color:#E0F8E0; position:absolute; top:120px; left:850px;" id="div2">

<?php $sql2 = "SELECT * FROM bode_orcom WHERE oc_id = ".$id;
//echo $sql2;
?>
<?php $sql2Resp = mysql_query($sql2) ?>
<?php $row = mysql_fetch_array($sql2Resp); ?>

	<form name="form11" action="inv_grabaori_2oc.php" method="post" onsubmit="return validarrr()">
		<table border=0 width="100%">
			<tr>
				<td  class="Estilo2titulo" colspan="10">FICHA ORDEN DE COMPRA</td>
			</tr>
		</table>
  
	<table border=0 width="100%">
			<tr>
				<td  valign="center" class="Estilo1">GRUPO</td>
				<td  class="Estilo1">
    
    					<select name="grupo" id="grupo" class="Estilo2" onChange="getSubCat(this.value)">
						<option selected value="">Seleccionar...</option>
						<?php
                        $sqlCategoriaResp = mysql_query($sqlCategoria);
						while($row2 = mysql_fetch_array($sqlCategoriaResp)) {
							?>
							<option value="<?php echo $row2["cat_id"] ?>"><?php echo utf8_decode($row2["cat_nombre"]) ?></option>
							<?php } ?>
						</select>
      <br>
                     <input type="text" class="Estilo2" disabled value="<?php echo $row["compra_zona"] ?>">
					</td>

					<td valign="center" class="Estilo1">SUB-GRUPO</td>
					<td class="Estilo1">
     						<select name="subgrupo" id="subgrupo" class="Estilo2" readonly>
							<option value="">Seleccionar...</option>
						</select>
                     <input type="text" class="Estilo2" disabled value="<?php echo $row["compra_glosa"] ?>">
					</td>
				</tr>




					<tr>
						<td  class="Estilo1">CANTIDAD TOTAL</td>
						<td  class="Estilo1">
                     <input type="text" class="Estilo2" disabled value="<?php echo $row["oc_cantidad"] ?>">
						</td>

						<td  class="Estilo1">MONTO TOTAL C / IVA</td>
						<td  class="Estilo1">
							<input type="text" name="total" id="total" class="Estilo2" size="8"  disabled value="<?php echo $row["oc_monto"] ?>">
						</td>

					</tr>

					<tr>
						<td  class="Estilo1">PROGRAMA</td>
						<td  class="Estilo1">
                     <input type="text" class="Estilo2" disabled value="<?php echo $row["oc_prog"] ?>">

						</td>

						<td  class="Estilo1">TIPO CAMBIO</td>
						<td  class="Estilo1">
                     <input type="text" class="Estilo2" disabled value="Pesos" size=8>



							</td>

						</tr>

						<tr>
							<td  class="Estilo1">PROVEEDOR RUT</td>
							<td  class="Estilo1">
                              <input type="text" class="Estilo2" disabled value="<?php echo $row["oc_proveerut"] ?>">-
                              <input type="text" class="Estilo2" disabled value="<?php echo $row["oc_proveedig"] ?>" size=1>

									</td>

									<td  class="Estilo1">TIPO COMPRA</td>
									<td  class="Estilo1">
                                       <input type="text" class="Estilo2" disabled value="<?php echo $row["compra_tipo_compra"] ?>">
									</td>
									</tr>
						<tr>
							<td  class="Estilo1">PROVEEDOR NOMBRE</td>
							<td  class="Estilo1">
                              <input type="text" class="Estilo2" disabled value="<?php echo $row["oc_proveenomb"] ?>" size=30>
						</td>
					</table>
     
     <table>
<table border="0" width="100%">
                           <tr>
                             <td  valign="center" class="Estilo1">Region</td>
                             <td  valign="center" class="Estilo1">Descripcion</td>
                             <td  valign="center" class="Estilo1">Cantidad</td>

                             <td  valign="center" class="Estilo1">Total</td>
                           </tr>

	<form name="form1" action="inv_grabaindexoc2.php" method="post" onsubmit="return validaree()">
 <?
 
$sql3 = "SELECT * FROM bode_detoc WHERE doc_oc_id = ".$id;
//echo $sql3;
$i=0;
$res3 = mysql_query($sql3);
while ($row3 = mysql_fetch_array($res3)) {



?>
                           <tr>
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
     						<table border="0" width="100%">
							<tr>
								<td class="Estilo1c">
        <input type="hidden" name="id" value="<? echo $id ?>"  >
        <input type="hidden" name="oc" value="<? echo $codigo ?>"  >
        <input type="hidden" name="totallinea" value="<? echo $i ?>" >
									<input type="submit" name="submit" class="Estilo2" size="11" value="  Modificar  ">
								</td>

							</tr>
       </table>

	</form>
</div>

