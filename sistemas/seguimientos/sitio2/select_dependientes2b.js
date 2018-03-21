function nuevoAjax()
{ 
	/* Crea el objeto AJAX. Esta funcion es generica para cualquier utilidad de este tipo, por
	lo que se puede copiar tal como esta aqui */
	var xmlhttp=false;
	try
	{
		// Creacion del objeto AJAX para navegadores no IE
		xmlhttp=new ActiveXObject("Msxml2.XMLHTTP");
	}
	catch(e)
	{
		try
		{
			// Creacion del objet AJAX para IE
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		catch(E)
		{
			if (!xmlhttp && typeof XMLHttpRequest!='undefined') xmlhttp=new XMLHttpRequest();
		}
	}
	return xmlhttp; 
}

// Declaro los selects que componen el documento HTML. Su atributo ID debe figurar aqui.
var listadoSelects2=new Array();
listadoSelects2[0]="paises2";
listadoSelects2[1]="estados2";

function buscarEnArray2(array, dato)
{
	// Retorna el indice de la posicion donde se encuentra el elemento en el array o null si no se encuentra
	var x=0;
	while(array[x])
	{
		if(array[x]==dato) return x;
		x++;
	}
	return null;
}

function cargaContenido2b(idSelectOrigen) {
//alert ("Entra");
	// Obtengo la posicion que ocupa el select que debe ser cargado en el array declarado mas arriba
	var posicionSelectDestino=buscarEnArray2(listadoSelects2, idSelectOrigen)+1;

	// Obtengo el select que el usuario modifico
	var selectOrigen=document.getElementById(idSelectOrigen);

	// Obtengo la opcion que el usuario selecciono
	var opcionSeleccionada=selectOrigen.options[selectOrigen.selectedIndex].value;
            var n1=opcionSeleccionada;
			
            var array_palabras = new Array();
            array_palabras=n1.split("|"); 
//            alert(" numero de palabras "+ array_palabras);
       document.form1.documento2.value=array_palabras[0];
//       document.form1.dias.value=array_palabras[1];
	// Si el usuario eligio la opcion "Elige", no voy al servidor y pongo los selects siguientes en estado "Selecciona opcion..."

	if(opcionSeleccionada==0)
	{
		var x=posicionSelectDestino, selectActual=null;
		// Busco todos los selects siguientes al que inicio el evento onChange y les cambio el estado y deshabilito
		while(listadoSelects2[x])
		{
			selectActual=document.getElementById(listadoSelects2[x]);
			selectActual.length=0;
			
			var nuevaOpcion=document.createElement("option"); nuevaOpcion.value=0; nuevaOpcion.innerHTML="Selecciona Opci&oacute;n...";
			selectActual.appendChild(nuevaOpcion);	selectActual.disabled=true;
			x++;
		}
            document.form1.documento2.value="xx";

	}
	// Compruebo que el select modificado no sea el ultimo de la cadena
	else if(idSelectOrigen!=listadoSelects2[listadoSelects2.length-1])
	{
		// Obtengo el elemento del select que debo cargar 
		var idSelectDestino=listadoSelects2[posicionSelectDestino];
		var selectDestino=document.getElementById(idSelectDestino);
		var ocid=document.form1.occompraid.value;
		// Creo el nuevo objeto AJAX y envio al servidor el ID del select a cargar y la opcion seleccionada del select origen
		var ajax=nuevoAjax();
                idSelectDestino="estados2";
		ajax.open("GET", "select_dependientes_proceso2b.php?select="+idSelectDestino+"&opcion="+opcionSeleccionada+"&ocid="+ocid, true);
//           alert(" numero de palabras 2 ->"+ idSelectDestino +" --> "+opcionSeleccionada);

            document.form1.tipo2b.value=opcionSeleccionada;
            document.form1.documento2.value="";


            
        
		ajax.onreadystatechange=function() 
		{ 
			if (ajax.readyState==1)
			{
//                    alert(" numero de palabras 3 ->"+ idSelectDestino +" --> "+opcionSeleccionada);
			// Mientras carga elimino la opcion "Selecciona Opcion..." y pongo una que dice "Cargando..."
				selectDestino.length=0;
				var nuevaOpcion=document.createElement("option"); nuevaOpcion.value=0; nuevaOpcion.innerHTML="Cargando...";
				selectDestino.appendChild(nuevaOpcion); selectDestino.disabled=true;	
			}
			if (ajax.readyState==4)
			{
//                                 alert(" numero de palabras 4 ->"+ idSelectDestino +" --> "+opcionSeleccionada);
                                idSelectDestino="estados2";
				selectDestino.parentNode.innerHTML=ajax.responseText;
			} 
		}
		ajax.send(null);
	}
}