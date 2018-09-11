<?php
unset($_SESSION["masiva"]);
$totalIds = count($arrid);
//echo $totalIds;
$totalJardines = count($arrid[$totalIds]);
//echo $totalJardines;

	for ($i=1; $i <= $totalIds; $i++) { 
		for ($k=1; $k <= $totalJardines; $k++) { 
			$arr[$i][$k] = $arrcantidad[$i][$k];
			//$_SESSION["arrCantidad"][$i][$k] = $arrcantidad[$i][$k];
			$_SESSION["masiva"][$i][$k] = $arrcantidad[$i][$k];
		}
	}
	//$_SESSION["masiva"] = $arr;
	$arrcantidad = $arr;
?>