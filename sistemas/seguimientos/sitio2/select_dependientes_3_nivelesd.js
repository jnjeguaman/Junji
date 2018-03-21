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
var listadoSelectsd=new Array();
listadoSelectsd[0]="select1d";
listadoSelectsd[1]="select2d";
listadoSelectsd[2]="select3d";

function buscarEnArrayd(array, dato)
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

function cargaContenidod(idSelectOrigen)
  
{
	// Obtengo la posicion que ocupa el select que debe ser cargado en el array declarado mas arriba
	var posicionSelectDestinod=buscarEnArrayd(listadoSelectsd, idSelectOrigen)+1;
	// Obtengo el select que el usuario modifico
	var selectOrigend=document.getElementById(idSelectOrigen);
	// Obtengo la opcion que el usuario selecciono
	var opcionSeleccionadad=selectOrigend.options[selectOrigend.selectedIndex].value;
	// Si el usuario eligio la opcion "Elige", no voy al servidor y pongo los selects siguientes en estado "Selecciona opcion..."
    //      alert("valor 1 "+ opcionSeleccionada +"--"+document.form1.select2.value);	
      //alert("valor = "+opcionSeleccionadab);
      document.form1.ejecutadh.value=document.form1.select2d.value+opcionSeleccionadad;

	if(opcionSeleccionadad==0)
	{
		var x=posicionSelectDestinod, selectActual=null;
		// Busco todos los selects siguientes al que inicio el evento onChange y les cambio el estado y deshabilito
		while(listadoSelectsd[x])
		{
			selectActual=document.getElementById(listadoSelectsd[x]);
			selectActual.length=0;
			
			var nuevaOpcion=document.createElement("option"); nuevaOpcion.value=0; nuevaOpcion.innerHTML="Selecciona Opci&oacute;n...";
			selectActual.appendChild(nuevaOpcion);	selectActual.disabled=true;
			x++;
		}
	}
	// Compruebo que el select modificado no sea el ultimo de la cadena
	else if(idSelectOrigen!=listadoSelectsd[listadoSelectsd.length-1])
	{
		// Obtengo el elemento del select que debo cargar
		var idSelectDestinod=listadoSelectsd[posicionSelectDestinod];
		var selectDestinod=document.getElementById(idSelectDestinod);
		// Creo el nuevo objeto AJAX y envio al servidor el ID del select a cargar y la opcion seleccionada del select origen
		var ajax=nuevoAjax();
		ajax.open("GET", "select_dependientes_3_niveles_procesod.php?select="+idSelectDestinod+"&opcion="+opcionSeleccionadad, true);
		ajax.onreadystatechange=function() 
		{ 
			if (ajax.readyState==1)
			{
				// Mientras carga elimino la opcion "Selecciona Opcion..." y pongo una que dice "Cargando..."
				selectDestinod.length=0;
				var nuevaOpcion=document.createElement("option"); nuevaOpcion.value=0; nuevaOpcion.innerHTML="Cargando...";
				selectDestinod.appendChild(nuevaOpcion); selectDestinod.disabled=true;	
			}
			if (ajax.readyState==4)
			{
				selectDestinod.parentNode.innerHTML=ajax.responseText;
			} 
		}
		ajax.send(null);
	}
}