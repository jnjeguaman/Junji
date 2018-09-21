<?



function conversion($fecha)
{
$tok = strtok ($fecha,"-");
$i=0;
while ($tok) {
    $fecha10[$i]=$tok;
    $tok = strtok ("-");
	$i++;
}
$d=$fecha10[0];
$m=$fecha10[1];
$a=$fecha10[2];
$fecha=$a."-".$m."-".$d;
return $fecha;
}

function reconversion($fecha)
{
$tok = strtok ($fecha,"-");
$i=0;
while ($tok) {
    $fecha10[$i]=$tok;
    $tok = strtok ("-");
	$i++;
}
$a=$fecha10[0];
$m=$fecha10[1];
$d=$fecha10[2];
$fecha=$d."/".$m."/".$a;
return $fecha;
}
function randomkeys($length)
{
    $pattern = "1234567890abcdefghijklmnopqrstuvwxyz";
    $key  = $pattern{rand(0,35)};
    for($i=1;$i<$length;$i++)
    {
        $key .= $pattern{rand(0,35)};
    }
    return $key;
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

function mosfec($fec){
	return substr($fec,6,2)."/".substr($fec,4,2)."/".substr($fec,2,2);
}

?>
