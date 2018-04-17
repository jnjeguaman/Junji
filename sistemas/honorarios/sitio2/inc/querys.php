<?

function id_cob_cli(){
	$sql1 = "Select CLI_ID from cob_cli order by CLI_ID ";
	$res1 = mysql_query($sql1);
	while($row1 = mysql_fetch_array($res1)){
		$nuevoid = $row1["CLI_ID"];
	}
	$nuevoid++;
	return $nuevoid;
}
function id_cob_tip_doc(){
	$sql1 = "Select DOC_ID from cob_tip_doc order by DOC_ID ";
	$res1 = mysql_query($sql1);
	while($row1 = mysql_fetch_array($res1)){
		$nuevoid = $row1["DOC_ID"];
	}
	$nuevoid++;
	return $nuevoid;
}
function id_cob_cob(){
	$sql1 = "Select COB_ID from cob_cob order by COB_ID ";
	$res1 = mysql_query($sql1);
	while($row1 = mysql_fetch_array($res1)){
		$nuevoid = $row1["COB_ID"];
	}
	$nuevoid++;
	return $nuevoid;
}
function id_cob_jud(){
	$sql1 = "Select JUD_ID from cob_jud order by JUD_ID ";
	$res1 = mysql_query($sql1);
	while($row1 = mysql_fetch_array($res1)){
		$nuevoid = $row1["JUD_ID"];
	}
	$nuevoid++;
	return $nuevoid;
}
function id_cob_caj(){
	$sql1 = "Select CAJ_NUM from cob_caj_hea order by CAJ_NUM ";
	$res1 = mysql_query($sql1);
	while($row1 = mysql_fetch_array($res1)){
		$nuevoid = $row1["CAJ_NUM"];
	}
	$nuevoid++;
	return $nuevoid;
}
function id_cob_pro(){
	$sql1 = "Select PRO_ID from cob_pro order by PRO_ID ";
	$res1 = mysql_query($sql1);
	while($row1 = mysql_fetch_array($res1)){
		$nuevoid = $row1["PRO_ID"];
	}
	$nuevoid++;
	return $nuevoid;
}
function id_cob_tip_tra(){
	$sql1 = "Select TRA_ID from cob_tip_tra order by TRA_ID ";
	$res1 = mysql_query($sql1);
	while($row1 = mysql_fetch_array($res1)){
		$nuevoid = $row1["TRA_ID"];
	}
	$nuevoid++;
	return $nuevoid;
}
function id_cob_rel(){
	$sql1 = "Select REL_ID from cob_rel order by REL_ID ";
	$res1 = mysql_query($sql1);
	while($row1 = mysql_fetch_array($res1)){
		$nuevoid = $row1["REL_ID"];
	}
	$nuevoid++;
	return $nuevoid;
}
function contarregistros($tabla){
	$sql1 = "Select * from ".$tabla." ";
	$res1 = mysql_query($sql1);
	while($row1 = mysql_fetch_array($res1)){
		$contador++;
	}
	return $contador;
}
function mostrarnombre($rut){
	$sql1 = "Select CLI_NOM from cob_cli where CLI_RUT = '".$rut."' ";
	$res1 = mysql_query($sql1);
	while($row1 = mysql_fetch_array($res1)){
		$val = $row1["CLI_NOM"];
	}
	return $val;
}
function mostrarnombre2($rut){
	$sql1 = "Select DEU_NOM,DEU_PAT from cob_deu where DEU_RUT = '".$rut."' ";
	$res1 = mysql_query($sql1);
	while($row1 = mysql_fetch_array($res1)){
		$val = $row1["DEU_NOM"]." ".$row1["DEU_PAT"];
	}
	return $val;
}
function mostrarcomuna2($rut)
{
	//$sql1 = "Select DEU_COM from cob_deu where DEU_RUT = '".$rut."' ";
	//$res1 = mysql_query($sql1);
	//while($row1 = mysql_fetch_array($res1)){
	//	$val = $row1["DEU_COM"];
	//}
	//return $val;
}  function muestrafecha($fecha){
	$fechadevuelta = substr($fecha,6,2)."/".substr($fecha,4,2)."/".substr($fecha,0,4);
	return $fechadevuelta;
}
function comonumero($num){
	$val = str_replace(",",".",number_format($num));
	return $val;
}
function fechador(){
	echo date("d")." de ";
	if(date("m") == "01"){ echo "Enero"; } 
	if(date("m") == "02"){ echo "Febrero"; } 
	if(date("m") == "03"){ echo "Marzo"; } 
	if(date("m") == "04"){ echo "Abril"; } 
	if(date("m") == "05"){ echo "Mayo"; } 
	if(date("m") == "06"){ echo "Junio"; } 
	if(date("m") == "07"){ echo "Julio"; } 
	if(date("m") == "08"){ echo "Agosto"; } 
	if(date("m") == "09"){ echo "Septiembre"; } 
	if(date("m") == "10"){ echo "Octubre"; } 
	if(date("m") == "11"){ echo "Noviembre"; } 
	if(date("m") == "12"){ echo "Diciembre"; } 
	echo " del ".date("Y");
}
function nummes($mes){	
	if($mes == 1){   return "01";  }
	if($mes == 2){   return "02";  }
	if($mes == 3){   return "03";  }
	if($mes == 4){   return "04";  }
	if($mes == 5){   return "05";  }
	if($mes == 6){   return "06";  }
	if($mes == 7){   return "07";  }
	if($mes == 8){   return "08";  }
	if($mes == 9){   return "09";  }
	if($mes == 10){   return "10";  }
	if($mes == 11){   return "11";  }	
	if($mes == 12){   return "12";  }
}
function mostrar_gestiones($deu,$cli){
	$sql = "Select * from cob_ope where DEU_RUT = '$deu' and CLI_RUT = '$cli' ";
	$res = mysql_query($sql);
	?>
	
	<table width="700" border="0" cellspacing="0" cellpadding="0">
	  <tr><td colspan="4" class="Estilo2">Gestiones realizadas al deudor</td></tr>
	  <tr bgcolor="#EFF3F7">
		<td>Fecha</td>
		<td>Documento</td>
		<td>Tramite</td>
		<td>Observación</td>
	  </tr>
	  <tr>
		   <td colspan="13" bgcolor="#000000"><img src="images/pix2.gif" width="700" height="1"></td>
      </tr>
	  <?
	  while($row = mysql_fetch_array($res)){
		?>
			   
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

		<?
	}
}

function gestiones($cliente,$deudor){
	$sqlgest = "Select * from cob_ope ";
	$sqlgest .= " Left join cob_tip_doc     on cob_ope.DOC_ID   = cob_tip_doc.DOC_ID ";
	$sqlgest .= " Left join cob_tip_tra     on cob_ope.TRA_ID   = cob_tip_tra.TRA_ID ";
	$sqlgest .= " where cob_ope.CLI_RUT = '$cliente' and cob_ope.DEU_RUT = '$deudor' ";
	$sqlgest .= " Order By cob_ope.OPE_FEC ";
	$resgest = mysql_query($sqlgest);
	?>
	<table width="700" border="0" cellspacing="0" cellpadding="0">
	  <tr><td colspan="4" class="Estilo2">&nbsp;</td></tr>
	  <tr><td colspan="13" bgcolor="#000000"><img src="images/pix2.gif" width="700" height="1"></td></tr>
	  <tr><td colspan="4" class="Estilo2"><strong>Gestiones realizadas al deudor</strong></td>
	  </tr>
	  <tr><td colspan="13" bgcolor="#000000"><img src="images/pix2.gif" width="700" height="1"></td></tr>
	  <tr bgcolor="#EFF3F7" class="Estilo2">
		<td width="111">Fecha</td>
		<td width="181">Documento</td>
		<td width="171">Tramite</td>
		<td width="237">Observación</td>
	  </tr>
	  <tr><td colspan="13" bgcolor="#000000"><img src="images/pix2.gif" width="700" height="1"></td></tr>
	  <?
	  while($rowgest = mysql_fetch_array($resgest)){
	  	$aux = "di2";
		$tramite = $rowgest["TRA_NOM"];
		$documento = $rowgest["DOC_NOM"];
		$fecha = substr($rowgest["OPE_FEC"],0,10);
		$obs = $rowgest["OPE_OBS"];
		?>
		  <tr class="Estilo2">
			<td valign="top">&nbsp;<? echo mosfec($fecha); ?></td>
			<td valign="top">&nbsp;<? echo $documento; ?></td>
			<td valign="top">&nbsp;<? echo $tramite; ?></td>
			<td valign="top">&nbsp;<? echo $obs; ?></td>
		  </tr>
	      <tr><td colspan="13" bgcolor="#cccccc"><img src="images/pix2.gif" width="700" height="1"></td></tr>
		<?
	  }
	if($aux == ""){
		?><tr><td colspan="4" class="Estilo2">&nbsp;No se han realizado gestiones</td></tr><?
	}
	?>
	  <tr><td colspan="4" class="Estilo2">&nbsp;</td></tr>
	  <tr><td colspan="4" class="Estilo2">&nbsp;</td></tr>
	  <tr><td colspan="4" class="Estilo2">&nbsp;</td></tr>
	</table>
	<?
}

function mosfec($fec){
	return substr($fec,6,2)."/".substr($fec,4,2)."/".substr($fec,2,2);
}

function RELACIONES($deudor,$cliente){
	$sql = "Select * from cob_rel where DEU_RUT = '$deudor' and CLI_RUT = '$cliente' ";
	$res = mysql_query($sql);
	while($row = mysql_fetch_array($res)){
		$aux = "si";
		$id = $row["REL_ID"];
		$sql2 = "Update cob_rel set REL_EST = 'A' where REL_ID = '$id' ";
		//echo $sql2;
		$res2 = mysql_query($sql2); 
	}	
	if($aux == ""){
		$sql2 = "Insert into cob_rel ( DEU_RUT , CLI_RUT ,REL_EST ) values ";
		$sql2 .= " ( '$deudor','$cliente','A' ) ";
		//echo $sql2;
		$res2 = mysql_query($sql2); 
	}
}

?>
