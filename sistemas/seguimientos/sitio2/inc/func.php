
<script language="javascript">
function find_deudor(rut1,rut2){
    if(rut2 == "k" || rut2 == "K"){
	    var rut_1 = rut1 + "-" + "k";
    	var rut_2 = rut1 + "-" + "K";
	}else{
    	var rut_1 = rut1 + "-" + rut2;
	    var rut_2 = rut1 + "-" + rut2;
	}
	var resultado = "No se encontro";
	<?
	$sqld = "select * from cob_deu order by DEU_RUT ";
	$resd = mysql_query($sqld,$dbh);
	while($rowd = mysql_fetch_array($resd)){
    $nom = $rowd["DEU_NOM"]." ".$rowd["DEU_PAT"]." ".$rowd["DEU_MAT"];
    $rut = $rowd["DEU_RUT"];
    ?>
    if(rut_1 == "<? echo $rut; ?>" || rut_2 == "<? echo $rut; ?>"){  resultado = '<? echo $nom ?>';   }
    <?
    }
	?>
	return resultado;
}
function find_cliente(rut1,rut2){
    if(rut2 == "k" || rut2 == "K"){
	    var rut_1 = rut1 + "-" + "k";
    	var rut_2 = rut1 + "-" + "K";
	}else{
    	var rut_1 = rut1 + "-" + rut2;
	    var rut_2 = rut1 + "-" + rut2;
	}
	var resultado = "No se encontro";
	<?
	$sqld = "select * from cob_cli order by CLI_RUT ";
	$resd = mysql_query($sqld);
	while($rowd = mysql_fetch_array($resd)){
    $nom = $rowd["CLI_NOM"];
    $rut = $rowd["CLI_RUT"];
    ?>
    if(rut_1 == "<? echo $rut; ?>" || rut_2 == "<? echo $rut; ?>"){  resultado = "<? echo $nom; ?>";   }
    <?
    }
	?>
	return resultado;
}
</script>