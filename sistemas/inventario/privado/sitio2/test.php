<?php

// CORRECCION MONETARIA
$costoAdquisicion = 295860;
$IPC = 3.9/100;
$correccionMonetaria = round($IPC * $costoAdquisicion);
$vidaUtilConsumida = 2;
$vidaUtil = 6;
$nuevaVidaUtil = $vidaUtilConsumida + 1;

echo "COSTO DE ADQUISICION : ".$costoAdquisicion."<br>";
echo "CORRECION MONETARIA : ".$correccionMonetaria."<br>";

$valorActualizadoFinal = $costoAdquisicion + $correccionMonetaria;
echo "VALOR ACTUALIZADO FINAL : ".$valorActualizadoFinal."<br>";

$correccionMonetariaDepreciacion = floor($correccionMonetaria / $vidaUtilConsumida);
echo "CORRECCION MONETARIA DEPRECIACION : ".$correccionMonetariaDepreciacion."<br>";

$depreciacionDelAno = round($valorActualizadoFinal / $vidaUtil);
echo "DEPRECIACION DEL AÑO : ".$depreciacionDelAno."<br>";

$depreciacionDelAnoActualizada = $depreciacionDelAno * ($vidaUtilConsumida + 1);
echo "DEPRECIACION DEL AÑO ACTUALIZADA: ".$depreciacionDelAnoActualizada."<br>";

$depreciacionTotal = $depreciacionDelAno + $depreciacionDelAnoActualizada;
echo "DEPRECIACION TOTAL: ".$depreciacionTotal."<br>";

$depreciacionTotal2 = $depreciacionTotal - $depreciacionDelAno - $correccionMonetariaDepreciacion;
echo "DEPRECIACION TOTAL: ".$depreciacionTotal2."<br>";

/*
$encode = "599-75-CM16";
$decode = "+FrWfrEgtDsMy5aPDTCArg==";
echo "CODIFICAR : ".$encode."<br>";
echo "CODIFICADO : ".$decode."<br>";
echo "RESULTADO : ".base64_encode(md5($encode));
*/
/*echo "INSERT INTO indicador VALUES ";
for ($i=1990; $i <= 2020; $i++) { 
echo "
(0, ".$i.", 'inicial', ' -0,3', ' -0,5', ' -0,5', ' -0,1', ' 0,3', ' 0,8', ' 1,2', ' 1,5', ' 1,9', ' 1,9', ' 2,2', ' 2,5', 1),
(0, ".$i.", 'ene', '', ' -0,2', ' -0,2', ' 0,2', ' 0,6', ' 1,1', ' 1,6', ' 1,8', ' 2,2', ' 2,3', ' 2,6', ' 2,8', 1),
(0, ".$i.", 'feb', '', '', ' 0,0', ' 0,4', ' 0,8', ' 1,3', ' 1,8', ' 2,0', ' 2,4', ' 2,4', ' 2,7', ' 3,0', 1),
(0, ".$i.", 'mar', '', '', '', ' 0,4', ' 0,8', ' 1,3', ' 1,8', ' 2,0', ' 2,4', ' 2,4', ' 2,7', ' 3,0', 1),
(0, ".$i.", 'abr', '', '', '', '', ' 0,4', ' 0,9', ' 1,3', ' 1,6', ' 2,0', ' 2,0', ' 2,3', ' 2,6', 1),
(0, ".$i.", 'may', '', '', '', '', '', ' 0,5', ' 1,0', ' 1,2', ' 1,6', ' 1,6', ' 1,9', ' 2,2', 1),
(0, ".$i.", 'jun', '', '', '', '', '', '', ' 0,4', ' 0,7', ' 1,0', ' 1,1', ' 1,4', ' 1,7', 1),
(0, ".$i.", 'jul', '', '', '', '', '', '', '', ' 0,2', ' 0,6', ' 0,7', ' 1,0', ' 1,2', 1),
(0, ".$i.", 'ago', '', '', '', '', '', '', '', '', ' 0,4', ' 0,4', ' 0,7', ' 1,0', 1),
(0, ".$i.", 'sep', '', '', '', '', '', '', '', '', '', ' 0,1', ' 0,3', ' 0,6', 1),
(0, ".$i.", 'oct', '', '', '', '', '', '', '', '', '', '', ' 0,3', ' 0,5', 1),
(0, ".$i.", 'nov', '', '', '', '', '', '', '', '', '', '', '', ' 0,3', 1),
(0, ".$i.", 'dic', '', '', '', '', '', '', '', '', '', '', '', ' 0,0', 1),
";
}
*/
?>