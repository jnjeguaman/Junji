// JavaScript Document
 
// Función para recoger los datos de PHP según el navegador, se usa siempre.
function objetoAjax(){
	var xmlhttp=false;
	try {
		xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
	} catch (e) {
 
	try {
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	} catch (E) {
		xmlhttp = false;
	}
}
 
if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
	  xmlhttp = new XMLHttpRequest();
	}
	return xmlhttp;
}
 
//Función para recoger los datos del formulario y enviarlos por post  
function enviarDatosEmpleado5(a,b){
//    alert("entra");
//  alert(a);

  //instanciamos el objetoAjax
  ajax=objetoAjax();
 
  //uso del medotod POST
  //archivo que realizará la operacion
  //registro.php
  ajax.open("POST", "consulta5.php",true);
  //cuando el objeto XMLHttpRequest cambia de estado, la función se inicia
  ajax.onreadystatechange=function() {
	  //la función responseText tiene todos los datos pedidos al servidor
  	if (ajax.readyState==4) {
  		//mostrar resultados en esta capa
  			var Date =ajax.responseText;
//			alert(Date);
            var elem = Date.split('|');
            
            document.getElementById("ifac").href="";
            document.getElementById("iorden").href="";
            document.getElementById("ires").href="";
            document.getElementById("folio").innerHTML=elem[0];
            document.getElementById("descripcion").innerHTML=elem[1];						
            document.getElementById("numero").innerHTML=elem[2];						
            document.getElementById("fpago").innerHTML=elem[3];									
			document.getElementById("rut").innerHTML=elem[4];									
			document.getElementById("ifac").href+="../../archivos/docfac/"+elem[5];
			document.getElementById('verlink').innerHTML=elem[5];
			document.getElementById("proveedor").innerHTML=elem[6];									
            document.getElementById("iorden").href+="../../archivos/docfac/"+elem[7];
			document.getElementById('verlink2').innerHTML=elem[7];
            document.getElementById('monto').innerHTML=elem[8];		
            document.getElementById("ires").href+="../../archivos/docfac/"+elem[9];
			document.getElementById('verlink3').innerHTML="Ver Resolucion";
			document.getElementById('neto').innerHTML=elem[10];		
			document.getElementById('pago').innerHTML=elem[11];		
						
  //opener.document.getElementById("linkarchivo").href+="../../archivos/docargedo/"+archivo;			
  		//llamar a funcion para limpiar los inputs
		LimpiarCampos();
	}
 }
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores a registro.php para que inserte los datos
	ajax.send("id2="+a+"&tipodoc="+b)
}
 
//función para limpiar los campos
function LimpiarCampos(){
  document.nuevo_empleado.nombre.focus();
}


