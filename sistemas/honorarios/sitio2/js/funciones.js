//function periodofecha(fechai,fechaf)
//function IsValidTime(x) 
//function reempreturn(texto)
//function esfecha(Cadena)

function periodofecha(fecha1,fecha2)
{
var diai,mesi,anoi,diaf,mesf,anof;
diai = fecha1.substring(0,2);
diaf = fecha2.substring(0,2);
mesi = fecha1.substring(3,5);
mesf = fecha2.substring(3,5);
anoi = fecha1.substring(6,10);
anof = fecha2.substring(6,10);
if (anoi > anof){return true;};
if (anoi < anof){return false;};
if ((anoi = anof) && (mesi > mesf)){return true;};
if ((anoi = anof) && (mesi < mesf)){return false;};
if ((anoi = anof) && (mesi = mesf) && (diai > diaf)){return true;};
if ((anoi = anof) && (mesi = mesf) && !(diai > diaf)){return false;};
}

function esfecha(Cadena) {
var DiaMes = new Array();
DiaMes[1] = 31;
DiaMes[2] = 29;
DiaMes[3] = 31;
DiaMes[4] = 30;
DiaMes[5] = 31;
DiaMes[6] = 30;
DiaMes[7] = 31;
DiaMes[8] = 31;
DiaMes[9] = 30;
DiaMes[10] = 31;
DiaMes[11] = 30;
DiaMes[12] = 31;
dd=Cadena.substring(0,2);
mm=Cadena.substring(3,5); 
yyyy=Cadena.substring(6,10);
if (Cadena.length != 10){return false;};
if (dd !="" && !(dd > 0 && dd < 32)){return false;};
if (mm !="" && !(mm > 0 && mm < 13)){return false;};
if ((dd!="" && mm!="") && dd > DiaMes[mm]){return false;};
if (yyyy !="" && !(yyyy >= 1900 && yyyy <=anio_actual('ano'))){return false;};
if ((mm=="2" || mm=="02" && dd!="" && yyyy!="") && dd > daysInFebruary(yyyy)){return false;};
return true;		
}

function eshora(Cadena2) 
{
if (Cadena2.length != 5){return false;};
hh=Cadena2.substring(0,2);
mm=Cadena2.substring(3,5); 
if (hh < 0  || hh > 23){return false;};
if (mm < 0  || mm > 59){return false;};
return true;
}

function NumFecha(ob)
	{
	var strOb
	if ((event.keyCode< 48 || event.keyCode > 58))
		event.returnValue = false;
	strOb=ob.value;
	if  (strOb.length==2)
		{
		ob.value=strOb+"/";
		}
	if  (strOb.length==5)
		{
		ob.value=strOb+"/";
		}
	if  (strOb.length>=10)
		{
		event.returnValue = false;
		}
	}

function NumDosPuntos(ob)
	{
	var strOb;
	if ((event.keyCode< 48 || event.keyCode > 58))
		event.returnValue = false;
	strOb=ob.value;
	if  (strOb.length==2)
		{
		ob.value=strOb+":";
		}
	if  (strOb.length>=5)
		{
		event.returnValue = false;
		}
	}

function reempreturn(texto)
{
	var r, re, subs;
	var s = texto;
	r = "";
	re = /~/i;
	subs = "";
	var nLen = s.length;
	for (var i=0; i < nLen; i++)
	{
	  subs= s.substring(i,i+1);
	  r = r + subs.replace(re, "\n");
	}
return(r);
}

function y2k(number) { return (number < 1000) ? number + 1900 : number; }
function anio_actual(parametro){
var salida;
var today = new Date();
switch(parametro){
case 'mes':
	var month= (((!month) ? today.getMonth():month))+1;
	salida=eval(month);
	break;
case 'día':
	var day	= ((!day) ? today.getDate():day);
	salida=eval(day);
	break;
case 'ano':
	var year	= ((!year) ? y2k(today.getYear()):year);
	salida=eval(year);
	break;
}
return salida;
}

function daysInFebruary(whichYear) {
    return (whichYear % 4 == 0 && (!(whichYear % 100 == 0) || (whichYear % 400 == 0)) ? 29 : 28);
}

