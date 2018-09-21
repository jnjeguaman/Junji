﻿function Browseris () {
	var agt=navigator.userAgent.toLowerCase();
	this.osver=1.0;
	if (agt)
	{
		var stOSVer=agt.substring(agt.indexOf("windows ")+11);
		this.osver=parseFloat(stOSVer);
	}
	this.major=parseInt(navigator.appVersion);
	this.nav=((agt.indexOf('mozilla')!=-1)&&((agt.indexOf('spoofer')==-1) && (agt.indexOf('compatible')==-1)));
	this.nav6=this.nav && (this.major==5);
	this.nav6up=this.nav && (this.major >=5);
	this.nav7up=false;
	if (this.nav6up)
	{
		var navIdx=agt.indexOf("netscape/");
		if (navIdx >=0 )
			this.nav7up=parseInt(agt.substring(navIdx+9)) >=7;
	}
	this.ie=(agt.indexOf("msie")!=-1);
	this.aol=this.ie && agt.indexOf(" aol ")!=-1;
	if (this.ie)
		{
		var stIEVer=agt.substring(agt.indexOf("msie ")+5);
		this.iever=parseInt(stIEVer);
		this.verIEFull=parseFloat(stIEVer);
		}
	else
		this.iever=0;
	this.ie4up=this.ie && (this.major >=4);
	this.ie5up=this.ie && (this.iever >=5);
	this.ie55up=this.ie && (this.verIEFull >=5.5);
	this.ie6up=this.ie && (this.iever >=6);
	this.winnt=((agt.indexOf("winnt")!=-1)||(agt.indexOf("windows nt")!=-1));
	this.win32=((this.major >=4) && (navigator.platform=="Win32")) ||
		(agt.indexOf("win32")!=-1) || (agt.indexOf("32bit")!=-1);
	this.mac=(agt.indexOf("mac")!=-1);
	this.w3c=this.nav6up;
	this.safari=(agt.indexOf("safari")!=-1);
	this.safari125up=false;
	if (this.safari && this.major >=5)
	{
		var navIdx=agt.indexOf("safari/");
		if (navIdx >=0)
			this.safari125up=parseInt(agt.substring(navIdx+7)) >=125;
	}
}
var browseris=new Browseris();
var bis=browseris;
function byid(id) { return document.getElementById(id); }
function newE(tag) { return document.createElement(tag); }
function wpf() { return document.forms[MSOWebPartPageFormName]; }
function startReplacement() {}
function GetEventSrcElement(e)
{
	if (browseris.nav)
		return e.target;
	else
		return e.srcElement;
}
function GetEventKeyCode(e)
{
	if (browseris.nav)
		return e.which;
	else
		return e.keyCode;
}
function GetInnerText(e)
{
	if (browseris.safari)
		return e.innerHTML;
	else if (browseris.nav)
		return e.textContent;
	else
		return e.innerText;
}
var UTF8_1ST_OF_2=0xc0   ;
var UTF8_1ST_OF_3=0xe0   ;
var UTF8_1ST_OF_4=0xf0   ;
var UTF8_TRAIL=0x80   ;
var HIGH_SURROGATE_BITS=0xD800 ;
var LOW_SURROGATE_BITS=0xDC00 ;
var SURROGATE_6_BIT=0xFC00 ;
var SURROGATE_ID_BITS=0xF800 ;
var SURROGATE_OFFSET=0x10000;
function escapeProperlyCoreCore(str, bAsUrl, bForFilterQuery, bForCallback)
{
	var strOut="";
	var strByte="";
	var ix=0;
	var strEscaped=" \"%<>\'&";
	if (typeof(str)=="undefined")
		return "";
	for (ix=0; ix < str.length; ix++)
	{
		var charCode=str.charCodeAt(ix);
		var curChar=str.charAt(ix);
		if(bAsUrl && (curChar=='#' || curChar=='?') )
		{
			strOut+=str.substr(ix);
			break;
		}
		if (bForFilterQuery && curChar=='&')
		{
			strOut+=curChar;
			continue;
		}
		if (charCode <=0x7f)
		{
			if (bForCallback)
			{
				strOut+=curChar;
			}
			else
			{
				if ( (charCode >=97 && charCode <=122) ||
					 (charCode >=65 && charCode <=90) ||
					 (charCode >=48 && charCode <=57) ||
					 (bAsUrl && (charCode >=32 && charCode <=95) && strEscaped.indexOf(curChar) < 0))
				{
					strOut+=curChar;
				}
				else if (charCode <=0x0f)
				{
					strOut+="%0"+charCode.toString(16).toUpperCase();
				}
				else if (charCode <=0x7f)
				{
					strOut+="%"+charCode.toString(16).toUpperCase();
				}
			}
		}
		else if (charCode <=0x07ff)
		{
			strByte=UTF8_1ST_OF_2 | (charCode >> 6);
			strOut+="%"+strByte.toString(16).toUpperCase() ;
			strByte=UTF8_TRAIL | (charCode & 0x003f);
			strOut+="%"+strByte.toString(16).toUpperCase();
		}
		else if ((charCode & SURROGATE_6_BIT) !=HIGH_SURROGATE_BITS)
		{
			strByte=UTF8_1ST_OF_3 | (charCode >> 12);
			strOut+="%"+strByte.toString(16).toUpperCase();
			strByte=UTF8_TRAIL | ((charCode & 0x0fc0) >> 6);
			strOut+="%"+strByte.toString(16).toUpperCase();
			strByte=UTF8_TRAIL | (charCode & 0x003f);
			strOut+="%"+strByte.toString(16).toUpperCase();
		}
		else if (ix < str.length - 1)
		{
			var charCode=(charCode & 0x03FF) << 10;
			ix++;
			var nextCharCode=str.charCodeAt(ix);
			charCode |=nextCharCode & 0x03FF;
			charCode+=SURROGATE_OFFSET;
			strByte=UTF8_1ST_OF_4 | (charCode >> 18);
			strOut+="%"+strByte.toString(16).toUpperCase();
			strByte=UTF8_TRAIL | ((charCode & 0x3f000) >> 12);
			strOut+="%"+strByte.toString(16).toUpperCase();
			strByte=UTF8_TRAIL | ((charCode & 0x0fc0) >> 6);
			strOut+="%"+strByte.toString(16).toUpperCase();
			strByte=UTF8_TRAIL | (charCode & 0x003f);
			strOut+="%"+strByte.toString(16).toUpperCase();
		}
	}
	return strOut;
}
function escapeProperly(str)
{
	return escapeProperlyCoreCore(str, false, false, false);
}
function escapeProperlyCore(str, bAsUrl)
{
	return escapeProperlyCoreCore(str, bAsUrl, false, false);
}
function escapeUrlForCallback(str)
{
	var iPound=str.indexOf("#");
	var iQues=str.indexOf("?");
	if ((iPound > 0) && ((iQues==-1) || (iPound < iQues)))
	{
		var strNew=str.substr(0, iPound);
		if (iQues > 0)
		{
			strNew+=str.substr(iQues);
		}
		str=strNew;
	}
	return escapeProperlyCoreCore(str, true, false, true);
}
function PageUrlValidation(url)
{
	if (url.substr(0, 4) !="http" && url.substr(0,1) !="/")
	{
		var L_InvalidPageUrl_Text="Dirección URL de la página no válida: ";
		alert(L_InvalidPageUrl_Text);
		return "";
	}
	else
		return url;
}
function DeferCall()
{
	if (arguments.length==0)
		return null;
	var args=arguments;
	var fn=null;
	if (browseris.ie5up || browseris.nav6up)
	{
		eval("if (typeof("+args[0]+")=='function') { fn="+args[0]+"; }");
	}
	if (fn==null)
		return null;
	if (args.length==1) return fn();
	else if (args.length==2) return fn(args[1]);
	else if (args.length==3) return fn(args[1], args[2]);
	else if (args.length==4) return fn(args[1], args[2], args[3]);
	else if (args.length==5) return fn(args[1], args[2], args[3], args[4]);
	else if (args.length==6) return fn(args[1], args[2], args[3], args[4], args[5]);
	else if (args.length==7) return fn(args[1], args[2], args[3], args[4], args[5], args[6]);
	else if (args.length==8) return fn(args[1], args[2], args[3], args[4], args[5], args[6], args[7]);
	else if (args.length==9) return fn(args[1], args[2], args[3], args[4], args[5], args[6], args[7], args[8]);
	else if (args.length==10) return fn(args[1], args[2], args[3], args[4], args[5], args[6], args[7], args[8], args[9]);
	else
	{
		var L_TooManyDefers_Text="Se han pasado demasiados argumentos a DeferCall";
		alert(L_TooManyDefers_Text);
	}
	return null;
}
var L_ContainIllegalChar_Text="^1 contiene un carácter no válido \'^2\'.";
var L_ContainIllegalString_Text="^1 contiene una subcadena o caracteres no válidos.";
var LegalUrlChars=new Array
(
	false, false, false, false, false, false, false, false,     false, false, false, false, false, false, false, false,
	false, false, false, false, false, false, false, false,     false, false, false, false, false, false, false, false,
	true,  true, false, false, true, false,  false, true,      true,  true, false, true,  true,  true,  true,  true,
	true,  true,  true,  true,  true,  true,  true,  true,      true,  true, false,  true, false,  true, false, false,
	true,  true,  true,  true,  true,  true,  true,  true,      true,  true,  true,  true,  true,  true,  true,  true,
	true,  true,  true,  true,  true,  true,  true,  true,      true,  true,  true, true, false, true,  true,  true,
	true,  true,  true,  true,  true,  true,  true,  true,      true,  true,  true,  true,  true,  true,  true,  true,
	true,  true,  true,  true,  true,  true,  true,  true,      true,  true,  true,  false, false, false, false, false,
	false, false, false, false, false, false, false, false,     false, false, false, false, false, false, false, false,
	false, false, false, false, false, false, false, false,     false, false, false, false, false, false, false, false
);
function AdmBuildParam(stPattern)
{
	var re;
	var i;
	for (i=1; i < AdmBuildParam.arguments.length; i++)
		{
		re=new RegExp("\\^"+i);
		stPattern=stPattern.replace(re, AdmBuildParam.arguments[i]);
		}
	return stPattern;
}
function IndexOfIllegalCharInUrlLeafName(strLeafName)
{
	for(var i=0; i<strLeafName.length; i++)
	{
		var ch=strLeafName.charCodeAt(i);
		if(strLeafName.charAt(i)=='.' && (i==0 || i==(strLeafName.length-1)))
			return i;
		if(ch < 160 && ( strLeafName.charAt(i)=='/' || !LegalUrlChars[ch]) )
			return i;
	}
	return -1;
}
function IndexOfIllegalCharInUrlPath(strPath)
{
	for(var i=0; i<strPath.length; i++)
	{
		var ch=strPath.charCodeAt(i);
		if( ch < 160 && !LegalUrlChars[ch])
			return i;
	}
	return -1;
}
function UrlContainsIllegalStrings(strPath)
{
	if(strPath.indexOf("..") >=0
		|| strPath.indexOf("//") >=0
		|| strPath.indexOf("./") >=0
		|| strPath.indexOf("/.") >=0
		|| strPath.indexOf(".")==0
		|| strPath.lastIndexOf(".")==(strPath.length-1)
		)
	{
		return true;
	}
	return false;
}
function UrlLeafNameValidate(source, args)
{
	var strMessagePrefix="";
	if( typeof(source.MessagePrefix)=="string" )
	{
		strMessagePrefix=source.MessagePrefix;
	}
	else
	{
		strMessagePrefix=source.id;
	}
	var i=IndexOfIllegalCharInUrlLeafName(args.Value);
	if( i >=0 )
	{
		if(typeof(source.errormessage)=="string")
		{
			source.errormessage=AdmBuildParam(L_ContainIllegalChar_Text, strMessagePrefix, args.Value.charAt(i));
		}
		args.IsValid=false;
	}
	else if( UrlContainsIllegalStrings(args.Value) )
	{
		if(typeof(source.errormessage)=="string" )
		{
			source.errormessage=AdmBuildParam(L_ContainIllegalString_Text, strMessagePrefix);
		}
		args.IsValid=false;
	}
	else
	{
		args.IsValid=true;
	}
}
function UrlPathValidate(source, args)
{
	var strMessagePrefix="";
	if( typeof(source.MessagePrefix)=="string" )
	{
		strMessagePrefix=source.MessagePrefix;
	}
	else
	{
		strMessagePrefix=source.id;
	}
	var i=IndexOfIllegalCharInUrlPath(args.Value);
	if( i >=0)
	{
		if(typeof(source.errormessage)=="string")
		{
			source.errormessage=AdmBuildParam(L_ContainIllegalChar_Text, strMessagePrefix, args.Value.charAt(i));
		}
		args.IsValid=false;
	}
	else if( UrlContainsIllegalStrings(args.Value) )
	{
		if(typeof(source.errormessage)=="string" )
		{
			source.errormessage=AdmBuildParam(L_ContainIllegalString_Text, strMessagePrefix);
		}
		args.IsValid=false;
	}
	else
	{
		args.IsValid=true;
	}
}
function IsCheckBoxListSelected(checkboxlist)
{
	if(checkboxlist==null )
		return false;
	var len=checkboxlist.length ;
	if (len==null)
	{
		return checkboxlist.checked;
	}
	else
	{
		for (var i=0; i < len ; i++)
		{
			if (checkboxlist[i].checked)
			{
				return true;
			}
		}
	}
	return false;
}
function STSValidatorEnable(val, bEnable, bSilent)
{
	var objVal=document.getElementById(val);
	if (objVal==null)
		return;
	if (bSilent==true || (objVal.getAttribute("AlwaysEnableSilent")==true))
	{
		objVal.enabled=(bEnable==true);
	}
	else
	{
		ValidatorEnable(objVal, bEnable);
	}
}
function encodeScriptQuote(str)
{
	var strOut="";
	var ix=0;
	for (ix=0; ix < str.length; ix++)
	{
		var ch=str.charAt(ix);
		if (ch=='\'')
			strOut+="%27";
		else
			strOut+=ch;
	}
	return strOut;
}
function STSHtmlEncode(str)
{
	var strOut="";
	var ix=0;
	for (ix=0; ix < str.length; ix++)
	{
		var ch=str.charAt(ix);
		switch (ch)
		{
			case '<':
				strOut+="&lt;";
				break;
			case '>':
				strOut+="&gt;";
				break;
			case '&':
				strOut+="&amp;";
				break;
			case '\"':
				strOut+="&quot;";
				break;
			case '\'':
				strOut+="&#39;";
				break;
			default:
				strOut+=ch;
				break;
		}
   }
   return strOut;
}
function StAttrQuote(st)
{
	st=st.toString();
	st=st.replace(/&/g, '&amp;');
	st=st.replace(/\"/g, '&quot;'); // "
	st=st.replace(/\r/g, '&#13;');
	return '"'+st+'"';
}
function STSScriptEncode(str)
{
	var strOut="";
	var ix=0;
	for (ix=0; ix < str.length; ix++)
	{
		var charCode=str.charCodeAt(ix);
		if (charCode > 0x0fff)
		{
			strOut+=("\\u"+charCode.toString(16).toUpperCase());
		}
		else if (charCode > 0x00ff)
		{
			strOut+=("\\u0"+charCode.toString(16).toUpperCase());
		}
		else if (charCode > 0x007f)
		{
			strOut+=("\\u00"+charCode.toString(16).toUpperCase());
		}
		else
		{
			switch (str.charAt(ix))
			{
			case '\n':
				strOut+="\\n";
				break;
			case '\r':
				strOut+="\\r";
				break;
			case '\"':
				strOut+="\\u0022";
				break;
			case '%':
				strOut+="\\u0025";
				break;
			case '&':
				strOut+="\\u0026";
				break;
			case '\'':
				strOut+="\\u0027";
				break;
			case '(':
				strOut+="\\u0028";
				break;
			case ')':
				strOut+="\\u0029";
				break;
			case '+':
				strOut+="\\u002b";
				break;
			case '/':
				strOut+="\\u002f";
				break;
			case '<':
				strOut+="\\u003c";
				break;
			case '>':
				strOut+="\\u003e";
				break;
			case '\\':
				strOut+="\\\\";
				break;
			default:
				strOut+=str.charAt(ix);
			};
		}
	}
	return strOut;
}
function STSScriptEncodeWithQuote(str)
{
	return '"'+STSScriptEncode(str)+'"';
}
var SPOnError_cachedOriginalOnError=window.onerror;
var L_PleaseWaitForScripts_Text="Espere mientras se cargan las secuencias de comandos...";
var g_pageLoadComplete=false;
var previousRSChange='';
if (document.onreadystatechange !=null)
{
	previousRSChange=document.onreadystatechange;
}
document.onreadystatechange=setLoadComplete;
function setLoadComplete()
{
	if(previousRSChange !=null && previousRSChange !='')
	{
		eval(previousRSChange);
	}
	if(document.readyState=='complete')
	{
		g_pageLoadComplete=true;
		window.status="";
		window.onerror=SPOnError_cachedOriginalOnError;
	}
}
function SPOnError_handleErrors(msg,url,line)
{
	var useErrorHandler=false;
	if(!g_pageLoadComplete && document.readyState !="complete")
	{
		useErrorHandler=true;
	}
	if(useErrorHandler)
	{
		try
		{
			window.status=L_PleaseWaitForScripts_Text;
		}
		catch(e)
		{
		}
		return true;
	}
	else
	{
		if(typeof(SPOnError_cachedOriginalOnError)=="function")
		{
			window.onerror=SPOnError_cachedOriginalOnError;
			return SPOnError_cachedOriginalOnError(msg,url,line);
		}
		else
		{
			window.onerror=null;
			return false;
		}
	}
}
window.onerror=SPOnError_handleErrors;
var L_Language_Text="3082";
var L_ClickOnce1_text="Ya está intentando guardar este elemento. Si lo intenta de nuevo, puede crear información duplicada. ¿Desea volver a guardar este elemento?";
var L_STSRecycleConfirm_Text="¿Confirma que desea enviar este elemento a la Papelera de reciclaje del sitio?";
var L_STSRecycleConfirm1_Text="¿Confirma que desea enviar esta carpeta y todo su contenido a la Papelera de reciclaje del sitio?";
var L_STSDelConfirm_Text="¿Confirma que desea eliminar este elemento?";
var L_STSDelConfirm1_Text="¿Realmente desea eliminar esta carpeta y todo su contenido?";
var L_NewDocLibTb1_Text="No se pudo crear el documento. \nEs posible que la aplicación necesaria no esté instalada correctamente o que no se pueda abrir la plantilla de este biblioteca de documentos.\n\nIntente lo siguiente:\n1. Compruebe el nombre de la plantilla establecido en la Configuración general de esta biblioteca de documentos. Si la aplicación estaba configurada para instalarse la primera vez que se usara, ejecute la aplicación y vuelva a intentar crear un nuevo documento.\n\n2. Si tiene permiso para modificar esta biblioteca de documentos, vaya a su Configuración general y configure la nueva plantilla.";
var L_NewDocLibTb2_Text="La opción 'Nuevo documento' requiere una aplicación compatible con Windows SharePoint Services y Microsoft Internet Explorer 6.0 o posterior. Para agregar un documento a esta biblioteca de documentos, haga clic en el botón 'Cargar documento'.";
var L_NewFormLibTb1_Text="No se puedo crear el documento.\nPuede que la aplicación requerida no esté instalada correctamente o que no pueda abrirse la plantilla de esta biblioteca de documentos.\n\nPruebe lo siguiente:\n1. Compruebe la Configuración general del nombre de la plantilla para esta biblioteca de documentos e instale la aplicación necesaria para abrir dicha plantilla. Si la aplicación se configuró para permitir la instalación la primera vez que se utiliza, ejecútela e intente crear un nuevo documento.\n\n2.  Si tiene permiso para modificar esta biblioteca de documentos, vaya a la Configuración general de la biblioteca y configure una nueva plantilla.";
var L_NewFormLibTb2_Text="Esta característica requiere Microsoft Internet Explorer 6.0 o posterior y un editor XML compatible con Windows SharePoint Services, como Microsoft Office InfoPath.";
var L_ConfirmCheckout_Text="Debe desproteger este elemento antes de hacer cambios. ¿Desea desproteger este elemento ahora?";
var L_CheckOutRetry_Text="Error de desprotección. ¿Desea volver a intentar desprotegerlo desde el servidor?";
var L_CannotEditPropertyForLocalCopy_Text="No puede editar las propiedades de un documento si está desprotegido o se está modificando sin conexión.";
var L_CannotEditPropertyCheckout_Text="No puede editar las propiedades de este documento mientras esté desprotegido o bloqueado por otro usuario.";
var L_NewFormClickOnce1_Text="Nueva carpeta";
var L_EnterValidCopyDest_Text="Escriba una dirección URL de carpeta válida y un nombre de archivo. La dirección URL de la carpeta debe comenzar por 'http:' o 'https:'.";
var L_ConfirmUnlinkCopy_Text="Como este elemento es una copia, aún puede estar recibiendo actualizaciones desde su origen. Debe asegurarse de eliminar este elemento de la lista de elementos de origen para actualizar. De lo contrario, este elemento puede seguir recibiendo actualizaciones. ¿Confirma que desea quitar el vínculo de este elemento?";
var L_CopyingOfflineVersionWarning_Text="Tiene este documento desprotegido localmente. Sólo pueden copiarse las versiones almacenadas en el servidor. Para copiar la versión secundaria más reciente, haga clic en Aceptar. Para copiar la versión actualmente desprotegida, haga clic en Cancelar, proteja el documento y vuelva a intentar la operación de copia.";
var L_Loading_Text="Cargando...";
var L_Loading_Error_Text="Error al recuperar los datos. Actualice la página y vuelva a intentarlo.";
var L_WarnkOnce_text="Este elemento contiene un patrón de frecuencia. Si guarda los cambios no podrá volver al patrón anterior.";
var L_WebFoldersRequired_Text="Espere a que se cargue la vista del explorador. Si la vista del explorador no aparece, puede que el explorador no lo admita.";
var L_WebFoldersError_Text="Su cliente no admite la apertura de esta lista con el Explorador de Windows.";
var L_AccessibleMenu_Text="Menú";
var L_NewBlogPost_Text="Esta característica requiere Microsoft Internet Explorer 6.0 o posterior y un editor de blogs compatible con Windows SharePoint Services, como Microsoft Office Word 2007 o posterior.";
var L_NewBlogPostFailed_Text="No se pudo conectar el programa de blog porque está ocupado o falta. Compruebe el programa y vuelva a intentarlo.";
var recycleBinEnabled=0;
var bIsFileDialogView=false;
var g_ViewIdToViewCounterMap=new Array();
function UpdateAccessibilityUI()
{
	var t1=document.getElementById("TurnOnAccessibility");
	var t2=document.getElementById("TurnOffAccessibility");
	if (IsAccessibilityFeatureEnabled())
	{
		if (t1 !=null)
			t1.style.display="none";
		if (t2 !=null)
			t2.style.display="";
	}
	else
	{
		if (t1 !=null)
			t1.style.display="";
		if (t2 !=null)
			t2.style.display="none";
	}
}
function SetIsAccessibilityFeatureEnabled(f)
{
	if (f)
		document.cookie="WSS_AccessibilityFeature=true;path=;";
	else
		document.cookie="WSS_AccessibilityFeature=false;path=;";
}
function DeleteCookie(sName)
{
	document.cookie=sName+"=; expires=Thu, 01-Jan-70 00:00:01 GMT";
}
function GetCookie(sName)
{
	var aCookie=document.cookie.split("; ");
	for (var i=0; i < aCookie.length; i++)
	{
		var aCrumb=aCookie[i].split("=");
		if (sName==aCrumb[0]) {
			if(aCrumb.length > 1)
				return unescapeProperly(aCrumb[1]);
			else
				return null;
		}
	}
	return null;
}
function IsAccessibilityFeatureEnabled()
{
	return GetCookie("WSS_AccessibilityFeature")=="true";
}
function escapeForSync(str)
{
	var strOut="";
	var ix=0;
	var bDoingUnicode=0;
	var strSyncEscaped="\\&|[]";
	for (ix=0; ix < str.length; ix++)
	{
		var charCode=str.charCodeAt(ix);
		var curChar=str.charAt(ix);
		if (bDoingUnicode && charCode <=0x7f) {
			strOut+="]";
			bDoingUnicode=0;
		}
		if (!bDoingUnicode && charCode > 0x7f) {
			strOut+="[";
			bDoingUnicode=1;
		}
		if(strSyncEscaped.indexOf(curChar) >=0)
			strOut+="|";
		if ( (charCode >=97 && charCode <=122) ||
			 (charCode >=65 && charCode <=90) ||
			 (charCode >=48 && charCode <=57) )
		{
			strOut+=curChar;
		}
		else if (charCode <=0x0f)
		{
			strOut+="%0"+charCode.toString(16).toUpperCase();
		}
		else if (charCode <=0x7f)
		{
			strOut+="%"+charCode.toString(16).toUpperCase();
		}
		else if (charCode <=0x00ff)
		{
			strOut+="00"+charCode.toString(16).toUpperCase();
		}
		else if (charCode <=0x0fff)
		{
			strOut+="0"+charCode.toString(16).toUpperCase();
		}
		else {
			strOut+=charCode.toString(16).toUpperCase();
		}
	}
	if (bDoingUnicode)
		strOut+="]";
	return strOut;
}
var g_rgdwchMinEncoded=new Array([
	0x00000000,
	0x00000080,
	0x00000800,
	0x00010000,
	0x00200000,
	0x04000000,
	0x80000000
	]);
function Vutf8ToUnicode(rgBytes)
{
	var ix=0;
	var strResult="";
	var dwch, wch, uch;
	var nTrailBytes, nTrailBytesOrig;
	while (ix < rgBytes.length)
	{
		if (rgBytes[ix] <=0x007f)
		{
			strResult+=String.fromCharCode(rgBytes[ix++]);
		}
		else
		{
			uch=rgBytes[ix++];
			nTrailBytes=((uch) & 0x20) ? (((uch) & 0x10) ? 3 : 2) : 1;
			dwch=uch & (0xff >>> (2+nTrailBytes));
			while (nTrailBytes && (ix < rgBytes.length))
			{
				--nTrailBytes;
				uch=rgBytes[ix++];
				if (uch==0)
				{
					return strResult;
				}
				if ((uch & 0xC0) !=0x80)
				{
					strResult+='?';
					break;
				}
				dwch=(dwch << 6) | ((uch) & 0x003f);
			}
			if (nTrailBytes)
			{
				strResult+='?';
				break;
			}
			if (dwch < g_rgdwchMinEncoded[nTrailBytesOrig])
			{
				strResult+='?';
				break;
			}
			else if (dwch <=0xffff)
			{
				strResult+=String.fromCharCode(dwch);
			}
			else if (dwch <=0x10ffff)
			{
				dwch -=SURROGATE_OFFSET;
				strResult+=String.fromCharCode(
					HIGH_SURROGATE_BITS | dwch >>> 10);
				strResult+=String.fromCharCode(
					LOW_SURROGATE_BITS | ((dwch) & 0x003FF));
			}
			else
			{
				strResult+='?';
			}
		}
	}
	return strResult;
}
function unescapeProperlyInternal(str)
{
	if (str==null)
		return "null";
	var ix=0, ixEntity=0;
	var strResult="";
	var rgUTF8Bytes=new Array;
	var ixUTF8Bytes=0;
	var hexString, hexCode;
	while (ix < str.length)
	{
		if (str.charAt(ix)=='%')
		{
			if (str.charAt(++ix)=='u')
			{
				hexString="";
				for (ixEntity=0; ixEntity < 4 && ix < str.length;++ixEntity)
				{
					hexString+=str.charAt(++ix);
				}
				while (hexString.length < 4)
				{
					hexString+='0';
				}
				hexCode=parseInt(hexString, 16);
				if (isNaN(hexCode))
				{
					strResult+='?';
				}
				else
				{
					strResult+=String.fromCharCode(hexCode);
				}
			}
			else
			{
				hexString="";
				for (ixEntity=0; ixEntity < 2 && ix < str.length;++ixEntity)
				{
					hexString+=str.charAt(ix++);
				}
				while (hexString.length < 2)
				{
					hexString+='0';
				}
				hexCode=parseInt(hexString, 16);
				if (isNaN(hexCode))
				{
					if (ixUTF8Bytes)
					{
						strResult+=Vutf8ToUnicode(rgUTF8Bytes);
						ixUTF8Bytes=0;
						rgUTF8Bytes.length=ixUTF8Bytes;
					}
					strResult+='?';
				}
				else
				{
					rgUTF8Bytes[ixUTF8Bytes++]=hexCode;
				}
			}
		}
		else
		{
			if (ixUTF8Bytes)
			{
				strResult+=Vutf8ToUnicode(rgUTF8Bytes);
				ixUTF8Bytes=0;
				rgUTF8Bytes.length=ixUTF8Bytes;
			}
			strResult+=str.charAt(ix++);
		}
	}
	if (ixUTF8Bytes)
	{
		strResult+=Vutf8ToUnicode(rgUTF8Bytes);
		ixUTF8Bytes=0;
		rgUTF8Bytes.length=ixUTF8Bytes;
	}
	return strResult;
}
function unescapeProperly(str)
{
	var strResult=null;
	if ((browseris.ie55up || browseris.nav6up) &&
		(typeof(decodeURIComponent) !="undefined"))
	{
		strResult=decodeURIComponent(str);
	}
	else
	{
		strResult=unescapeProperlyInternal(str);
	}
	return strResult;
}
function navigateMailToLink(strUrl)
{
	var strEncoded="";
	for (ix=0; ix < strUrl.length; ix++)
	{
		var curChar=strUrl.charAt(ix);
		var strHexCode;
		var strHexCodeL;
		if (curChar=='%')
		{
			strHexCode=strUrl.charAt(ix+1);
			strHexCode+=strUrl.charAt(ix+2);
			strHexCodeL=strHexCode.toLowerCase();
			if (strHexCodeL=="3a" || strHexCodeL=="2f" ||
				strHexCodeL=="2e" || strHexCodeL=="2d" ||
				strHexCodeL=="3d")
			{
				strEncoded+=curChar;
			}
			else
			{
				strEncoded+=curChar;
				strEncoded+="25";
			}
		}
		else
		{
			strEncoded+=curChar;
		}
	}
	window.location=strEncoded;
}
function newBlogPostOnClient(strProviderId, strBlogUrl, strBlogName)
{
	var stsOpen;
	var fRet;
	stsOpen=StsOpenEnsureEx("SharePoint.OpenDocuments.3");
	if (stsOpen==null)
	{
		alert(L_NewBlogPost_Text);
		return;
	}
	try
	{
		fRet=stsOpen.NewBlogPost(strProviderId, strBlogUrl, strBlogName);
	}
	catch (e)
	{
		alert(L_NewBlogPostFailed_Text);
	}
}
function GetUrlFromWebUrlAndWebRelativeUrl(webUrl, webRelativeUrl)
{
	var retUrl=(webUrl==null || webUrl.length <=0) ? "/" : webUrl;
	if (retUrl.charAt(retUrl.length - 1) !="/")
	{
		retUrl+="/";
	}
	retUrl+=webRelativeUrl;
	return retUrl;
}
var g_updateFormDigestPageLoaded=new Date();
function UpdateFormDigest(serverRelativeWebUrl, updateInterval)
{
	try
	{
		if ((g_updateFormDigestPageLoaded==null) || (typeof(g_updateFormDigestPageLoaded) !="object"))
		{
			return;
		}
		var now=new Date();
		if (now.getTime() - g_updateFormDigestPageLoaded.getTime() < updateInterval)
		{
			return;
		}
		if ((serverRelativeWebUrl==null) || (serverRelativeWebUrl.length <=0))
		{
			return;
		}
		var formDigestElement=document.getElementsByName("__REQUESTDIGEST")[0];
		if ((formDigestElement==null) || (formDigestElement.tagName.toLowerCase() !="input") || (formDigestElement.type.toLowerCase() !="hidden") ||
			(formDigestElement.value==null) || (formDigestElement.value.length <=0))
		{
			return;
		}
		var request=null;
		try
		{
			request=new ActiveXObject("Msxml2.XMLHTTP");
		}
		catch (ex)
		{
			request=null;
		}
		if (request==null)
		{
			try
			{
				request=new XMLHttpRequest();
			}
			catch (ex)
			{
				request=null;
			}
		}
		if (request==null)
		{
			return;
		}
		request.open("POST", GetUrlFromWebUrlAndWebRelativeUrl(serverRelativeWebUrl, "_vti_bin/sites.asmx"), false);
		request.setRequestHeader("Content-Type", "text/xml");
		request.setRequestHeader("SOAPAction", "http://schemas.microsoft.com/sharepoint/soap/GetUpdatedFormDigest");
		request.send("<?xml version=\"1.0\" encoding=\"utf-8\"?>"+			"<soap:Envelope xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xmlns:xsd=\"http://www.w3.org/2001/XMLSchema\" xmlns:soap=\"http://schemas.xmlsoap.org/soap/envelope/\">"+			"  <soap:Body>"+			"    <GetUpdatedFormDigest xmlns=\"http://schemas.microsoft.com/sharepoint/soap/\" />"+			"  </soap:Body>"+			"</soap:Envelope>");
		var responseText=request.responseText;
		if ((responseText==null) || (responseText.length <=0))
		{
			return;
		}
		var startTag='<GetUpdatedFormDigestResult>';
		var endTag='</GetUpdatedFormDigestResult>';
		var startTagIndex=responseText.indexOf(startTag);
		var endTagIndex=responseText.indexOf(endTag, startTagIndex+startTag.length);
		var newFormDigest=null;
		if ((startTagIndex >=0) && (endTagIndex > startTagIndex))
		{
			var newFormDigest=responseText.substring(startTagIndex+startTag.length, endTagIndex);
		}
		if ((newFormDigest==null) || (newFormDigest.length <=0))
		{
			return;
		}
		var oldValue=formDigestElement.value;
		formDigestElement.value=newFormDigest;
	}
	catch (ex)
	{
	}
}
function GetStssyncHandler(szVersion)
{
	var objStssync;
	try
	{
		objStssync=new ActiveXObject("SharePoint.StssyncHandler"+szVersion);
	}
	catch (e)
	{
		objStssync=null;
	}
	return objStssync;
}
function GetStssyncAppNameForType(strType,strDefault)
{
	if (browseris.ie5up && browseris.win32)
	{
		var strAppName;
		var objStssync=null;
		if (strType !="")
		   objStssync=GetStssyncHandler(".3");
		if (!objStssync)
		{
			if (strType !="" && strType !="calendar" && strType !="contacts")
			{
				return false;
			}
			objStssync=GetStssyncHandler(".2");
			if (!objStssync || !(strAppName=objStssync.GetStssyncAppName()))
			{
				return false;
			}
		}
		else if (!(strAppName=objStssync.GetStssyncAppNameForType(strType)))
		{
			return false;
		}
		var L_LinkToBefore_Text="Conectar a ";
		var L_LinkToAfter_Text="";
		return L_LinkToBefore_Text+strAppName+L_LinkToAfter_Text;
	}
	else
	{
		return strDefault;
	}
}
function GetStssyncIconPath(strDefault, strPrefix)
{
	if (browseris.ie5up && browseris.win32)
	{
		var strIconName;
		var objStssync=null;
		objStssync=GetStssyncHandler(".3");
		if (!objStssync)
			return false;
		try
		{
			strIconName=objStssync.GetStssyncIconName();
			return strPrefix+strIconName;
		}
		catch (e)
		{
			return strDefault;
		}
	}
	else
	{
		return strDefault;
	}
}
function GetStssyncAppName(strDefault)
{
	return GetStssyncAppNameForType("",strDefault);
}
function ExportHailStorm(type,weburl,guid,webname,listname,viewurl,passport,listrooturl,folderurl,folderid)
{
	var maxLinkLength=500;
	var maxNameLength=20;
	var link="stssync://sts/?ver=1.1"
+"&type="+escapeProperly(type)
+"&cmd=add-folder"
+"&base-url="+escapeForSync(weburl)
+"&list-url="+escapeForSync("/"+makeAbsUrl(viewurl).substr(weburl.length+1)+"/")
+"&guid="+escapeProperly(guid);
	var names="&site-name="+escapeForSync(webname)
+"&list-name="+escapeForSync(listname);
	var context="";
	if (folderurl)
		context+="&folder-url="+escapeForSync("/"+folderurl.substr(listrooturl.length+1));
	if (folderid)
		context+="&folder-id="+folderid;
	if (link.length+names.length+context.length > maxLinkLength &&
		(webname.length > maxNameLength || listname.length > maxNameLength))
	{
		if (webname.length > maxNameLength)
			webname=webname.substring(0, maxNameLength-1)+"...";
		if (listname.length > maxNameLength)
			listname=listname.substring(0, maxNameLength-1)+"...";
		names="&site-name="+escapeForSync(webname)
+"&list-name="+escapeForSync(listname);
	}
	link=link+names+context;
	var L_StssyncTooLong_Text="El título de esta lista es demasiado largo. Acórtelo y vuelva a intentarlo.";
	if (link.length > maxLinkLength)
		alert(L_StssyncTooLong_Text);
	else
	{
		try
		{
			window.location.href=link;
		}
		catch (e)
		{
		}
	}
}
function GetDiagramLaunchInstalled()
{
	var objDiagramLaunch;
	var bFlag=false;
	try
	{
		objDiagramLaunch=new ActiveXObject("DiagramLaunch.DiagramLauncher");
		var strAppName;
		strAppName=objDiagramLaunch.EnsureDiagramApplication();
	}
	catch (e)
	{
		objDiagramLaunch=null;
	}
	return strAppName;
}
var fSSImporter=false;
var SSImporterObj;
function EnsureSSImporter()
{
	if (!fSSImporter)
	{
		if (browseris.ie5up && browseris.win32)
		{
			var functionBody=				"try"
+"{"
+"    SSImporterObj=new ActiveXObject(\"SharePoint.SpreadsheetLauncher.2\");"
+"    if (SSImporterObj)"
+"        fSSImporter=true;"
+"} catch (e)"
+"{"
+"try"
+"{"
+"    SSImporterObj=new ActiveXObject(\"SharePoint.SpreadsheetLauncher.1\");"
+"    if (SSImporterObj)"
+"        fSSImporter=true;"
+"} catch (e)"
+"{"
+"    fSSImporter=false;"
+"};"
+"};";
			var EnsureSSImportInner=new Function(functionBody);
			EnsureSSImportInner();
		}
	}
	return fSSImporter;
}
function ShowHideSection(sectionid, imgid)
{
	var group=document.getElementById(sectionid);
	var img=document.getElementById(imgid);
	if ((group==null))
		return;
	if (group.style.display !="none")
	{
		group.style.display="none";
		img.src="/_layouts/images/plus.gif";
	}
	else
	{
		group.style.display="";
		img.src="/_layouts/images/minus.gif";
	}
}
function ShowSection(sectionid, imgid)
{
	var group=document.getElementById(sectionid);
	var img=document.getElementById(imgid);
	if ((group==null))
		return;
	if (group.style.display=="none")
	{
		group.style.display="";
		img.src="/_layouts/images/minus.gif";
	}
}
function ShowHideInputFormSection(sectionid, bShow)
{
	var e=document.getElementById(sectionid);
	if (e !=null)
		e.style.display=bShow ? "" : "none";
	for (var i=1; i < 3; i++)
	{
		e=document.getElementById(sectionid+"_tablerow"+i);
		if (e !=null)
			e.style.display=bShow ? "" : "none";
	}
}
function ShowHideInputFormControl(id, bHide, bDisableValidators, bSilent)
{
	var displaySetting="";
	if (bHide==true)
	{
		displaySetting="none";
	}
	var validators=eval(id+'_validators');
	if (validators !=null)
	{
		for(var i=0; i < validators.length; i++)
		{
			STSValidatorEnable(validators[i], !bDisableValidators, bSilent);
		}
	}
	for(var i=1; i<=5; i++)
	{
		var rowId=id+"_tablerow"+i;
		var row=document.getElementById(rowId);
		if ((row !=null) && !browseris.mac)
		{
			row.style.display=displaySetting;
		}
	}
}
function SetControlDisabledStatus(obj, disabledStatus)
{
	try
	{
		if (obj.setAttribute)
			obj.setAttribute('disabled', disabledStatus);
		if (!disabledStatus && obj.removeAttribute)
			obj.removeAttribute('disabled');
	}
	catch(e)
	{
	}
}
function SetControlDisabledStatusRecursively(obj, disabledStatus)
{
	if (obj==null)
		return;
	SetControlDisabledStatus(obj, disabledStatus);
	var objChildren=obj.childNodes;
	for(var i=0; objChildren.length > i; i++)
	{
		SetControlDisabledStatusRecursively(objChildren.item(i), disabledStatus);
	}
}
function SetChildControlsDisabledStatus(obj, disabledStatus)
{
	var objChildren=obj.childNodes;
	for(var i=0; i < objChildren.length; i++)
	{
		SetControlDisabledStatusRecursively(objChildren.item(i), disabledStatus);
	}
}
var g_PNGImageIds;
var g_PNGImageSources;
function displayPNGImage(id,src,width,height,alt)
{
	if (g_PNGImageIds==null)
		g_PNGImageIds=new Array();
	if (g_PNGImageSources==null)
		g_PNGImageSources=new Array();
	var style=null;
	document.write("<IMG id='"+id+"' ");
	if (width && width > 0)
		document.write("width='"+width+"' ");
	if (height && height > 0)
		document.write("height='"+height+"' ");
	document.write("alt='"+alt+"' ");
	if (style)
		document.write("style='"+style+"' ");
	document.write(" src='"+src+"' />");
	g_PNGImageIds.push(id);
	g_PNGImageSources.push(src);
}
function ProcessPNGImages()
{
	var useFilter=browseris.ie &&
				browseris.ie55up &&
				browseris.verIEFull < 7.0;
	if (g_PNGImageIds !=null && useFilter)
	{
		for (var i=0; i < g_PNGImageIds.length; i++)
		{
			var img=document.getElementById(g_PNGImageIds[i]);
			if (img !=null && g_PNGImageSources[i] !=null)
			{
				img.style.filter="progid:DXImageTransform.Microsoft.AlphaImageLoader(src="+g_PNGImageSources[i]+"),sizingMethod=scale);";
				img.src="/_layouts/images/blank.gif";
			}
		}
	}
}
var CTXTYPE_EDITMENU=0;
var CTXTYPE_VIEWSELECTOR=1;
function ContextInfo()
{
	this.listBaseType=null;
	this.listTemplate=null;
	this.listName=null;
	this.view=null;
	this.listUrlDir=null;
	this.HttpPath=null;
	this.HttpRoot=null;
	this.serverUrl=null;
	this.imagesPath=null;
	this.PortalUrl=null;
	this.RecycleBinEnabled=null;
	this.isWebEditorPreview=null;
	this.rootFolderForDisplay=null;
	this.isPortalTemplate=null;
	this.isModerated=false;
	this.recursiveView=false;
	this.displayFormUrl=null;
	this.editFormUrl=null;
	this.newFormUrl=null;
	this.ctxId=null;
	this.CurrentUserId=null;
	this.isForceCheckout=false;
	this.EnableMinorVersions=false;
	this.ModerationStatus=0;
	this.verEnabled=0;
	this.isVersions=0;
	this.WorkflowsAssociated=false;
	this.ContentTypesEnabled=false;
	this.SendToLocationName="";
	this.SendToLocationUrl="";
}
function STSPageUrlValidation(url)
{
	return PageUrlValidation(url);
}
function GetSource(defaultSource)
{
	var source=GetUrlKeyValue("Source");
	if (source=="")
	{
		if (defaultSource !=null && defaultSource !="")
			source=defaultSource;
		else
			source=window.location.href;
	}
	return escapeProperly(STSPageUrlValidation(source));
}
function GetUrlKeyValue(keyName, bNoDecode, url)
{
	var keyValue="";
	if (url==null)
		url=window.location.href+"";
	var ndx=url.indexOf("&"+keyName+"=");
	if (ndx==-1)
		ndx=url.indexOf("?"+keyName+"=");
	if (ndx !=-1)
	{
		ndx2=url.indexOf("&", ndx+1);
		if (ndx2==-1)
			ndx2=url.length;
		keyValue=url.substring(ndx+keyName.length+2, ndx2);
	}
	if (bNoDecode)
		return keyValue;
	else
		return unescapeProperlyInternal(keyValue);
}
function LoginAsAnother(url, bUseSource)
{
	document.cookie="loginAsDifferentAttemptCount=0";
	if (bUseSource=="1")
	{
		GoToPage(url);
	}
	else
	{
		var ch=url.indexOf("?") >=0 ? "&" : "?";
		url+=ch+"Source="+escapeProperly(window.location.href);
		STSNavigate(url);
	}
}
function isPortalTemplatePage(Url)
{
	if (GetUrlKeyValue("PortalTemplate")=="1" ||
		GetUrlKeyValue("PortalTemplate", Url)=="1" ||
		(currentCtx !=null && currentCtx.isPortalTemplate))
		return true;
	else
		return false;
}
function STSNavigate(Url)
{
	if (isPortalTemplatePage(Url))
		window.top.location=STSPageUrlValidation(Url);
	else
		window.location=STSPageUrlValidation(Url);
}
function GoToPage(url)
{
	var ch=url.indexOf("?") >=0 ? "&" : "?";
	var srcUrl=GetSource();
	if (srcUrl !=null && srcUrl !="")
		url+=ch+"Source="+srcUrl;
	STSNavigate(url);
}
function TrimSpaces( str )
{
	var start;
	var end;
	str=str.toString();
	var len=str.length;
	for (start=0; start < len; start++)
	{
		if (str.charAt(start) !=' ')
			break;
	}
	if (start==len)
		return "";
	for (end=len - 1; end > start; end --)
	{
		if (str.charAt(end) !=' ')
			break;
	}
	end++;
	return str.substring(start, end);
}
function TrimWhiteSpaces( str )
{
	var start;
	var end;
	str=str.toString();
	var len=str.length;
	for (start=0; start < len; start++)
	{
		ch=str.charAt(start);
		if (ch!=' ' && ch!='\t' && ch!='\n' && ch!='\r' && ch!='\f')
			break;
	}
	if (start==len)
		return "";
	for (end=len - 1; end > start; end --)
	{
		ch=str.charAt(end);
		if (ch!=' ' && ch!='\t' && ch!='\n' && ch!='\r' && ch!='\f')
			break;
	}
	end++;
	return str.substring(start, end);
}
function GetAttributeFromItemTable(itemTable, strAttributeName, strAttributeOldName)
{
	var attrValue=itemTable !=null ? itemTable.getAttribute(strAttributeName) : null;
	if (attrValue==null && itemTable !=null && strAttributeOldName!=null)
		attrValue=itemTable.getAttribute(strAttributeOldName);
	return attrValue;
}
function GetDiagramLaunchInstalled()
{
	var objDiagramLaunch;
	var bFlag=false;
	try
	{
		objDiagramLaunch=new ActiveXObject("DiagramLaunch.DiagramLauncher");
		var strAppName;
		strAppName=objDiagramLaunch.EnsureDiagramApplication();
	}
	catch (e)
	{
		objDiagramLaunch=null;
	}
	return strAppName;
}
function ShowMtgNavigatorPane()
{
	document.getElementById("MeetingNavigatorPane").style.display="block";
}
function HideMtgNavigatorPane()
{
	document.getElementById("MeetingNavigatorPane").style.display="none";
}
function GetMultipleUploadEnabled()
{
	try
	{
		if (browseris.ie5up && !browseris.mac && (new ActiveXObject('STSUpld.UploadCtl')))
			return true;
	}
	catch(e)
	{
	}
	return false;
}
function SetUploadPageTitle()
{
	if (GetUrlKeyValue("Type")==1)
	{
		document.title=L_NewFormClickOnce1_Text;
		if (browseris.ie || browseris.nav6up)
		{
			var titleElt=document.getElementById("onetidTextTitle");
			if (titleElt !=null)
				titleElt.innerHTML=L_NewFormClickOnce1_Text;
		}
	}
}
function GetSelectedValue (frmElem) {
	if (frmElem && (frmElem.selectedIndex >-1)) {
		return frmElem.options[frmElem.selectedIndex].value
	}
	else
		return "";
}
function GetSelectedText(frmElem) {
	if (frmElem && (frmElem.selectedIndex >-1)) {
		return frmElem.options[frmElem.selectedIndex].text
	}
	else
		return "";
}
function MtgShowTimeZone()
{
	if (GetCookie("MtgTimeZone")=="1")
	{
		MtgToggleTimeZone();
	}
}
function FormatDate(sDate, sTime, eDate, eTime)
{
	var L_Date_Text="<b>Fecha:</b>";
	var L_Time_Text="<b>Hora:</b>";
	var L_DateSeparator=" - ";
	if(browseris.win32 && sDate==eDate)
		L_DateSeparator=" -\u200e ";
	if (sDate==eDate)
	{
		document.write(L_Date_Text+" "+sDate);
		if (sTime !=eTime)
			document.write(" "+L_Time_Text+" "+sTime+L_DateSeparator+eTime);
		else
			document.write(" "+L_Time_Text+" "+sTime);
	}
	else
	{
		document.write(L_Date_Text+" "+sDate+" ("+sTime+")"+L_DateSeparator+eDate+" ("+eTime+")");
	}
}
function GetAlertText(isDetached)
{
	var L_DETACHEDSINGLEEXCEPT_Text="Esta fecha de reunión ya no está asociada con una reunión del programa de agenda o del calendario. Esta fecha de reunión se ha cancelado o el vínculo al área de trabajo se ha eliminado de la reunión programada.";
	var L_DETACHEDCANCELLEDEXCEPT_Text="Esta fecha de reunión se ha cancelado en el programa de agenda y el calendario. Para especificar lo que desea hacer con la información asociada que hay en el área de trabajo, lleve a cabo las siguientes acciones: en el panel Serie de reuniones, señale la fecha de la reunión y en la lista desplegable, haga clic en Mantener, Eliminar o Mover.";
	var L_DETACHEDUNLINKEDSINGLE_Text="Esta fecha de reunión ya no está asociada con una reunión del programa de agenda o del calendario. Para especificar lo que desea hacer con la información asociada que hay en el área de trabajo, lleve a cabo las siguientes acciones: en el panel Serie de reuniones, señale la fecha de la reunión y en la lista desplegable, haga clic en Mantener, Eliminar o Mover.";
	var L_DETACHEDCANCELLEDSERIES_Text="Esta serie de reuniones se ha cancelado en el programa de agenda y calendario.";
	var L_DETACHEDUNLINKEDSERIES_Text="El evento de reunión programada y periódica asociado con esta área de trabajo se ha desvinculado del área de trabajo. Puede mantener o eliminar esta área de trabajo periódica. Si mantiene el área de trabajo, no podrá vincularla a otra reunión programada.";
	var L_DETACHEDSERIESNOWSINGLE_Text="Esta reunión se ha modificado en el programa de agenda y calendario de una reunión periódica a una no periódica. Puede mantener o eliminar esta área de trabajo. Si mantiene el área de trabajo, no podrá vincularla a otra reunión programada.";
	var L_DETACHEDSINGLENOWSERIES_Text="Esta reunión se ha modificado en el programa de agenda y calendario de una reunión no periódica a una periódica. El área de trabajo actual no admite una reunión periódica. En el programa de agenda, quite el vínculo de la reunión del área de trabajo y vuelva a vincularla a una nueva área de trabajo. Esta nueva área admitirá automáticamente las reuniones periódicas.";
	var L_DETACHEDNONGREGORIANCAL_Text="Esta reunión se creó en un programa de agenda y calendario que sólo admite actualizaciones de serie en el área de reuniones. Los cambios que realice a las repeticiones individuales de las reuniones en ese programa no aparecerán en el área de trabajo.";
	var L_DETACHEDPASTEXCPMODIFIED_Text="La reunión ya pasada se ha modificado o cancelado en el programa de agenda y el calendario. Para mantener, eliminar o mover esta reunión en el área de trabajo, utilice el menú desplegable situado junto a la fecha en el panel Serie de reuniones. Para actualizar la fecha de programación de esta reunión en el área de trabajo, utilice el programa de agenda para actualizar esta aparición de reunión.";
	var howOrphaned=isDetached & (0x10 - 1);
	var howDetached=isDetached - howOrphaned;
	if (howOrphaned)
	{
		switch (howOrphaned)
		{
			case 1:	return (g_meetingCount==1) ? L_DETACHEDSINGLEEXCEPT_Text : L_DETACHEDCANCELLEDEXCEPT_Text;
			case 2:	return L_DETACHEDCANCELLEDSERIES_Text;
			case 3: return L_DETACHEDCANCELLEDEXCEPT_Text;
			case 4:	return (g_meetingCount==1) ? L_DETACHEDSINGLEEXCEPT_Text : L_DETACHEDUNLINKEDSINGLE_Text;
			case 5:	return L_DETACHEDUNLINKEDSERIES_Text;
			case 6:	return L_DETACHEDSERIESNOWSINGLE_Text;
			case 7:	return L_DETACHEDSINGLENOWSERIES_Text;
			case 8:	return L_DETACHEDPASTEXCPMODIFIED_Text;
		}
	}
	else if (howDetached)
	{
		switch (howDetached)
		{
			case 16: return L_DETACHEDNONGREGORIANCAL_Text;
		}
	}
	return null;
}
function retrieveCurrentThemeLink()
{
	var cssLink;
	var links=document.getElementsByTagName("link");
	for(var i=0; i<links.length; i++)
	{
		if((links[i].type=="text/css") && (links[i].id=="onetidThemeCSS"))
			cssLink=links[i];
	}
	if(cssLink)
	{
		var re=/(\.\.\/)+/;
		var relativeURL=cssLink.href;
		var newURL=relativeURL.replace(re, "/");
		return newURL;
	}
}
function StBuildParam(stPattern)
{
	var re;
	var i;
	for (i=1; i < StBuildParam.arguments.length; i++)
		{
		re=new RegExp("\\^"+i);
		stPattern=stPattern.replace(re, StBuildParam.arguments[i]);
		}
	return stPattern;
}
JSRequest={
	QueryString : null,
	FileName : null,
	PathName : null,
	EnsureSetup : function()
	{
		if (JSRequest.QueryString !=null) return;
		JSRequest.QueryString=new Array();
		var queryString=window.location.search.substring(1);
		var pairs=queryString.split("&");
		for (var i=0;i<pairs.length;i++)
		{
			var p=pairs[i].indexOf("=");
			if (p > -1)
			{
				var key=pairs[i].substring(0,p);
				var value=pairs[i].substring(p+1);
				JSRequest.QueryString[key]=value;
			}
		}
		var path=JSRequest.PathName=window.location.pathname;
		var p=path.lastIndexOf("/");
		if (p > -1)
		{
			JSRequest.FileName=path.substring(p+1);
		}
		else
		{
			JSRequest.PageName=path;
		}
	}
};
var ExpGroupWPListName="WSS_ExpGroupWPList";
var ExpGroupCookiePrefix="WSS_ExpGroup_";
var ExpGroupCookieDelimiter="&";
var ExpGroupMaxWP=11;
var ExpGroupMaxCookieLength=3960;
var g_ExpGroupQueue=new Array();
var g_ExpGroupInProgress=false;
var g_ExpGroupTable=new Array();
var g_ExpGroupNeedsState=false;
var g_ExpGroupParseStage=false;
function ExpCollGroup(groupName, imgName)
{
	if (document.getElementById("titl"+groupName)==null)
		return;
	viewTable=document.getElementById("titl"+groupName).parentNode;
	if (viewTable==null)
		return;
	tbodyTags=viewTable.getElementsByTagName("TBODY");
	numElts=tbodyTags.length;
	len=groupName.length;
	img=document.getElementById(imgName);
	if (img==null)
		return;
	srcPath=img.src;
	index=srcPath.lastIndexOf("/");
	imgName=srcPath.slice(index+1);
	var fOpen=false;
	if (imgName=='plus.gif')
	{
		fOpen=true;
		displayStr="";
		img.src='/_layouts/images/minus.gif';
	}
	else
	{
		fOpen=false;
		displayStr="none";
		img.src='/_layouts/images/plus.gif';
	}
	for (var i=0;i<numElts;i++)
	{
		var childObj=tbodyTags[i];
		if ( (childObj.id !=null)
					&& (childObj.id.length > len+4)
					&& (groupName==childObj.id.slice(4).substr(0,len)) )
		{
			if (fOpen)
			{
				index=childObj.id.indexOf("_", len+4);
				if (index!=-1)
				{
					index=childObj.id.indexOf("_", index+1);
					if (index!=-1)
						continue;
				}
			}
			childObj.style.display=displayStr;
			if (fOpen && childObj.id.substr(0,4)=="titl")
			{
				imgObj=document.getElementById("img_"+childObj.id.slice(4));
				imgObj.src='/_layouts/images/plus.gif';
			}
		}
	}
	if (!g_ExpGroupParseStage)
	{
		if (g_ExpGroupNeedsState && ExpGroupFetchWebPartID(groupName) !=null)
		{
			if (fOpen)
			{
				AddGroupToCookie(groupName);
			}
			else
			{
				RemoveGroupFromCookie(groupName);
			}
		}
		if (fOpen)
		{
			tbody=document.getElementById("tbod"+groupName+"_");
			if (tbody !=null)
			{
				isLoaded=tbody.getAttribute("isLoaded");
				if (isLoaded=="false")
				{
					ExpGroupFetchData(groupName);
				}
			}
		}
	}
}
function ExpGroupFetchData(groupName)
{
	var loadString="<tr><td></td><td class=\"ms-gbload\">"+L_Loading_Text+"</td></tr>";
	ExpGroupRenderData(loadString, groupName, "false");
	if (!g_ExpGroupInProgress)
	{
		var groupString=ExpGroupFetchGroupString(groupName);
		if (groupString==null)
		{
			var loadString="<tr><td></td><td class=\"ms-gbload\">"+L_Loading_Error_Text+"</td></tr>";
			ExpGroupRenderData(loadString, groupName, "false");
			if (g_ExpGroupQueue.length > 0)
			{
				ExpGroupFetchData(g_ExpGroupQueue.shift());
			}
			return;
		}
		g_ExpGroupInProgress=true;
		if (!ExpGroupCallServer(groupString, groupName))
		{
			if (g_ExpGroupQueue.length > 0)
			{
				ExpGroupFetchData(g_ExpGroupQueue.shift());
			}
		}
	}
	else
	{
		g_ExpGroupQueue.push(groupName);
	}
}
function ExpGroupCallServer(groupString, groupName)
{
	var webPartID=ExpGroupFetchWebPartID(groupName);
	if (webPartID !=null)
	{
		var functionName="ExpGroupCallServer"+webPartID;
		var functionCall=functionName+"('"+groupString+"','"+groupName+"')";
		eval(functionCall);
	}
}
function ExpGroupReceiveData(htmlToRender, groupName)
{
	var ctxId="ctx"+groupName.substring(0, groupName.indexOf("-"));
	var indexBeginCTXName=htmlToRender.indexOf("CTXName=\"");
	if (indexBeginCTXName !=-1)
	{
		if (ctxId !="ctx1")
		{
			htmlToRender=htmlToRender.replace(/ CTXName=\"ctx1\" /g, " CTXName=\""+ctxId+"\" ");
		}
	}
	var needOuterWrap=false;
	if (htmlToRender.length < 4)
	{
		needOuterWrap=true;
	}
	else if (htmlToRender.substring(0,3) !="<tr")
	{
		needOuterWrap=true;
	}
	if (needOuterWrap)
	{
		htmlToRender="<TR><TD>"+htmlToRender+"</TD></TR>";
	}
	ExpGroupRenderData(htmlToRender, groupName, "true");
	g_ExpGroupInProgress=false;
	if (g_ExpGroupQueue.length > 0)
	{
		ExpGroupFetchData(g_ExpGroupQueue.shift());
	}
}
function ExpGroupRenderData(htmlToRender, groupName, isLoaded)
{
	var tbody=document.getElementById("tbod"+groupName+"_");
	var wrapDiv=document.createElement("DIV");
	wrapDiv.innerHTML="<TABLE><TBODY id=\"tbod"+			groupName+"_\" isLoaded=\""+isLoaded+			"\">"+htmlToRender+"</TBODY></TABLE>";
	tbody.parentNode.replaceChild(wrapDiv.firstChild.firstChild,tbody);
}
function ExpGroupFetchGroupString(groupName)
{
	titlTbody=document.getElementById("titl"+groupName);
	if (titlTbody==null)
	{
		return null;
	}
	else
	{
		var groupString=titlTbody.getAttribute("groupString");
		return groupString;
	}
}
function ExpGroupFetchWebPartID(groupName)
{
	var viewCounter=groupName.substring(0, groupName.indexOf("-"));
	var lookupEntry=document.getElementById("GroupByWebPartID"+viewCounter);
	if (lookupEntry==null)
		return null;
	return lookupEntry.getAttribute("webPartID");
}
function RenderActiveX(str)
{
	document.write(str);
}
function OnItem(elm)
{
	DeferCall('OnItemDeferCall', elm);
}
function OnLink(elm)
{
	DeferCall('OnLinkDeferCall', elm);
}
function MMU_PopMenuIfShowing(menuElement)
{
	DeferCall('MMU_PopMenuIfShowingDeferCall', menuElement);
}
function OnMouseOverFilter(elm)
{
	DeferCall('OnMouseOverFilterDeferCall', elm);
}
function MMU_EcbTableMouseOverOut(ecbTable, fMouseOver)
{
	DeferCall('MMU_EcbTableMouseOverOutDeferCall', ecbTable, fMouseOver);
}
function OnMouseOverAdHocFilter(elm, fieldStr)
{
	DeferCall('OnMouseOverAdHocFilterDeferCall', elm, fieldStr);
}
function MMU_EcbLinkOnFocusBlur(menu, ecbLink, fOnFocus)
{
	DeferCall('MMU_EcbLinkOnFocusBlurDeferCall', menu, ecbLink, fOnFocus);
}
function FixTextAlignForBidi(value)
{
	if (!browseris.ie)
		return;
	var cStylesheets=document.styleSheets;
	if (cStylesheets !=null)
	{
		for (var x=0; x < cStylesheets.length; x++) {
			if ((cStylesheets[x] !=null) && (cStylesheets[x].rules !=null))
			{
				for (var y=0; y < cStylesheets[x].rules.length; y++) {
					if (cStylesheets[x].rules[y].selectorText==".ms-vh" ||
						cStylesheets[x].rules[y].selectorText==".ms-vh2" ||
						cStylesheets[x].rules[y].selectorText==".ms-vh-icon" ||
						cStylesheets[x].rules[y].selectorText==".ms-vh-icon-empty" ||
						cStylesheets[x].rules[y].selectorText==".ms-vh2-nograd" ||
						cStylesheets[x].rules[y].selectorText==".ms-vh2-nograd-icon" ||
						cStylesheets[x].rules[y].selectorText==".ms-vh2-nofilter" ||
						cStylesheets[x].rules[y].selectorText==".ms-vh2-nofilter-icon" ||
						cStylesheets[x].rules[y].selectorText==".ms-vhImage") {
						cStylesheets[x].rules[y].style.textAlign=value;
					}
				}
			}
		}
	}
}
var IMNControlObj=null;
var bIMNControlInited=false;
var IMNDictionaryObj=null;
var bIMNSorted=false;
var bIMNOnloadAttached=false;
var IMNOrigScrollFunc=null;
var bIMNInScrollFunc=false;
var IMNSortableObj=null;
var IMNHeaderObj=null;
var IMNNameDictionaryObj=null;
var IMNShowOfflineObj=null;
function EnsureIMNControl()
{
	if (!bIMNControlInited)
	{
		if (browseris.ie5up && browseris.win32)
		{
//@cc_on
//@if (@_jscript_version >=5)
//@            try
//@            {
//@                IMNControlObj=new ActiveXObject("Name.NameCtrl.1");
//@            } catch(e)
//@            {
//@
//@            };
//@else
//@end
		}
		bIMNControlInited=true;
		if (IMNControlObj)
		{
			IMNControlObj.OnStatusChange=IMNOnStatusChange;
		}
	}
	return IMNControlObj;
}
function IMNImageInfo()
{
	this.img=null;
	this.alt='';
}
var L_IMNOnline_Text="Disponible";
var L_IMNOffline_Text="Sin conexión";
var L_IMNAway_Text="Ausente";
var L_IMNBusy_Text="No disponible";
var L_IMNDoNotDisturb_Text="No molestar";
var L_IMNIdle_Text="Puede que siempre";
var L_IMNBlocked_Text="Bloqueado";
var L_IMNOnline_OOF_Text="Disponible (descanso)";
var L_IMNOffline_OOF_Text="Sin conexión (descanso)";
var L_IMNAway_OOF_Text="Ausente (descanso)";
var L_IMNBusy_OOF_Text="No disponible (descanso)";
var L_IMNDoNotDisturb_OOF_Text="No molestar (descanso)";
var L_IMNIdle_OOF_Text="Puede que siempre (descanso)";
function IMNGetStatusImage(state, showoffline)
{
	var img="blank.gif";
	var alt="";
	switch (state)
	{
		case 0:
			img="imnon.png";
			alt=L_IMNOnline_Text;
		break;
		case 11:
			img="imnonoof.png";
			alt=L_IMNOnline_OOF_Text;
		break;
		case 1:
			if (showoffline)
			{
				img="imnoff.png";
				alt=L_IMNOffline_Text;
			}
			else
			{
				img="blank.gif";
				alt="";
			}
		break;
		case 12:
			if (showoffline)
			{
				img="imnoffoof.png";
				alt=L_IMNOffline_OOF_Text;
			}
			else
			{
				img="blank.gif";
				alt="";
			}
		break;
		case 2:
			img="imnaway.png";
			alt=L_IMNAway_Text;
		break;
		case 13:
			img="imnawayoof.png";
			alt=L_IMNAway_OOF_Text;
		break;
		case 3:
			img="imnbusy.png";
			alt=L_IMNBusy_Text;
		break;
		case 14:
			img="imnbusyoof.png";
			alt=L_IMNBusy_OOF_Text;
		break;
		case 4:
			img="imnaway.png";
			alt=L_IMNAway_Text;
		break;
		case 5:
			img="imnbusy.png";
			alt=L_IMNBusy_Text;
		break;
		case 6:
			img="imnaway.png";
			alt=L_IMNAway_Text;
		break;
		case 7:
			img="imnbusy.png";
			alt=L_IMNBusy_Text;
		break;
		case 8:
			img="imnaway.png";
			alt=L_IMNAway_Text;
		break;
		case 9:
			img="imndnd.png";
			alt=L_IMNDoNotDisturb_Text;
		break;
		case 15:
			img="imndndoof.png";
			alt=L_IMNDoNotDisturb_OOF_Text;
		break;
		case 10:
			img="imnbusy.png";
			alt=L_IMNBusy_Text;
		break;
		case 16:
			img="imnidle.png";
			alt=L_IMNIdle_Text;
		break;
		case 17:
			img="imnidleoof.png";
			alt=L_IMNIdle_OOF_Text;
		break;
		case 18:
			img="imnblocked.png";
			alt=L_IMNBlocked_Text;
		break;
		case 19:
			img="imnidlebusy.png";
			alt=L_IMNBusy_Text;
		break;
		case 20:
			img="imnidlebusyoof.png";
			alt=L_IMNBusy_OOF_Text;
		break;
	}
	var imnInfo=new IMNImageInfo();
	imnInfo.img=img;
	imnInfo.alt=alt;
	return imnInfo;
}
function IMNGetHeaderImage()
{
	var imnInfo=new IMNImageInfo();
	imnInfo.img="imnhdr.gif";;
	imnInfo.alt="";
	return imnInfo;
}
function IMNIsOnlineState(state)
{
	if (state==1)
	{
			return false;
	}
	return true;
}
function IMNSortList(j, oldState, state)
{
	var objTable=null;
	var objRow=null;
	if (IMNSortableObj && IMNSortableObj[j])
	{
		objRow=document.getElementById(j);
		while (objRow && !(objRow.tagName=="TR" &&
			   typeof(objRow.Sortable) !="undefined"))
		{
			objRow=objRow.parentNode;
		}
		objTable=objRow;
		while (objTable && objTable.tagName !="TABLE")
		{
			objTable=objTable.parentNode;
		}
		if (objTable !=null && objRow !=null)
		{
			if (objTable.rows[1].style.display=="none")
			{
				for (i=1; i<4; i++)
				{
					objTable.rows[i].style.display="block";
				}
			}
			if (!IMNIsOnlineState(oldState) && IMNIsOnlineState(state))
			{
				objTable.rows[2].style.display="none";
				i=3;
				while (objTable.rows[i].id !="Offline" && objTable.rows[i].innerText < objRow.innerText)
					i++;
				objTable.moveRow(objRow.rowIndex, i);
				if (    objTable.rows[objTable.rows.length - 3].id=="Offline")
				{
					objTable.rows[objTable.rows.length - 2].style.display="block";
				}
			}
			else if (IMNIsOnlineState(oldState) && !IMNIsOnlineState(state))
			{
				if (objRow.rowIndex==3 &&
					objTable.rows[objRow.rowIndex+1].id=="Offline")
				{
					objTable.rows[2].style.display="block";
				}
				if (objTable.rows[objTable.rows.length - 3].id=="Offline")
				{
					objTable.rows[objTable.rows.length - 2].style.display="none";
				}
				i=objTable.rows.length - 2;
				while (objTable.rows[i - 1].id !="Offline" && objTable.rows[i].innerText > objRow.innerText)
					i--;
				objTable.moveRow(objRow.rowIndex, i);
			}
		}
	}
}
function IMNOnStatusChange(name, state, id)
{
	if (IMNDictionaryObj)
	{
		var img=IMNGetStatusImage(state, IMNSortableObj[id] ||
									IMNShowOfflineObj[id]);
		if (IMNDictionaryObj[id] !=state)
		{
			if (bIMNSorted)
				IMNSortList(id, IMNDictionaryObj[id], state);
			IMNUpdateImage(id, img);
			IMNDictionaryObj[id]=state;
		}
	}
}
function IMNUpdateImage(id, imgInfo)
{
	var obj=document.images(id);
	if (obj)
	{
		var img=imgInfo.img;
		var alt=imgInfo.alt;
		var oldImg=obj.src;
		var index=oldImg.lastIndexOf("/");
		var newImg=oldImg.slice(0, index+1);
		newImg+=img;
		if (oldImg==newImg && img !='blank.gif')
			return;
		if (obj.altbase)
		{
			obj.alt=obj.altbase;
		}
		else
		{
			obj.alt=alt;
		}
		var useFilter=browseris.ie &&
					browseris.ie55up &&
					browseris.verIEFull < 7.0;
		var isPng=(newImg.toLowerCase().indexOf(".png") > 0);
		if (useFilter)
		{
			if (isPng)
			{
				obj.style.filter="progid:DXImageTransform.Microsoft.AlphaImageLoader(src="+newImg+"),sizingMethod=scale,enabled=true);";
				obj.src="/_layouts/images/blank.gif";
			}
			else
			{
				obj.style.filter="";
				obj.src=newImg;
			}
		}
		else
		{
			obj.src=newImg;
		}
	}
}
function IMNHandleAccelerator()
{
	if (IMNControlObj)
	{
	   if (event.altKey && event.shiftKey &&
			event.keyCode==121)
		{
		   IMNControlObj.DoAccelerator();
		}
	}
}
function IMNImageOnClick()
{
	if (IMNControlObj)
	{
		IMNShowOOUIKyb();
		IMNControlObj.DoAccelerator();
	}
}
function IMNGetOOUILocation(obj)
{
	var objRet=new Object;
	var objSpan=obj;
	var objOOUI=obj;
	var oouiX=0, oouiY=0, objDX=0;
	var fRtl=document.dir=="rtl";
	while (objSpan && objSpan.tagName !="SPAN" && objSpan.tagName !="TABLE")
	{
		objSpan=objSpan.parentNode;
	}
	if (objSpan)
	{
		var collNodes=objSpan.tagName=="TABLE" ?
			objSpan.rows(0).cells(0).childNodes :
			objSpan.childNodes;
		var i;
		for (i=0; i < collNodes.length;++i)
		{
			if (collNodes.item(i).tagName=="IMG" && collNodes.item(i).id)
			{
				objOOUI=collNodes.item(i);
				break;
			}
			if (collNodes.item(i).tagName=="A" &&
				collNodes.item(i).childNodes.length > 0 &&
				collNodes.item(i).childNodes.item(0).tagName=="IMG" &&
				collNodes.item(i).childNodes.item(0).id)
			{
				objOOUI=collNodes.item(i).childNodes.item(0);
				break;
			}
		}
	}
	obj=objOOUI;
	while (obj)
	{
		if (fRtl)
		{
			if (obj.scrollWidth >=obj.clientWidth+obj.scrollLeft)
				objDX=obj.scrollWidth - obj.clientWidth - obj.scrollLeft;
			else
				objDX=obj.clientWidth+obj.scrollLeft - obj.scrollWidth;
			oouiX+=obj.offsetLeft+objDX;
		}
		else
			oouiX+=obj.offsetLeft - obj.scrollLeft;
		oouiY+=obj.offsetTop - obj.scrollTop;
		obj=obj.offsetParent;
	}
	try
	{
		obj=window.frameElement;
		while (obj)
		{
			if (fRtl)
			{
				if (obj.scrollWidth >=obj.clientWidth+obj.scrollLeft)
					objDX=obj.scrollWidth - obj.clientWidth - obj.scrollLeft;
				else
					objDX=obj.clientWidth+obj.scrollLeft - obj.scrollWidth;
				oouiX+=obj.offsetLeft+objDX;
			}
			else
				oouiX+=obj.offsetLeft - obj.scrollLeft;
			oouiY+=obj.offsetTop - obj.scrollTop;
			obj=obj.offsetParent;
		}
	} catch(e)
	{
	};
	objRet.objSpan=objSpan;
	objRet.objOOUI=objOOUI;
	objRet.oouiX=oouiX;
	objRet.oouiY=oouiY;
	if (fRtl)
		objRet.oouiX+=objOOUI.offsetWidth;
	return objRet;
}
function IMNShowOOUIMouse()
{
	IMNShowOOUI(0);
}
function IMNShowOOUIKyb()
{
	IMNShowOOUI(1);
}
function IMNShowOOUI(inputType)
{
	if (browseris.ie5up && browseris.win32)
	{
		var obj=window.event.srcElement;
		var objSpan=obj;
		var objOOUI=obj;
		var oouiX=0, oouiY=0;
		if (EnsureIMNControl() && IMNNameDictionaryObj)
		{
			var objRet=IMNGetOOUILocation(obj);
			objSpan=objRet.objSpan;
			objOOUI=objRet.objOOUI;
			oouiX=objRet.oouiX;
			oouiY=objRet.oouiY;
			var name=IMNNameDictionaryObj[objOOUI.id];
			if (objSpan)
				objSpan.onkeydown=IMNHandleAccelerator;
			IMNControlObj.ShowOOUI(name, inputType, oouiX, oouiY);
		}
	}
}
function IMNHideOOUI()
{
	if (IMNControlObj)
	{
		IMNControlObj.HideOOUI();
		return false;
	}
	return true;
}
function IMNScroll()
{
	if (!bIMNInScrollFunc)
	{
		bIMNInScrollFunc=true;
		IMNHideOOUI();
	}
	bIMNInScrollFunc=false;
	if(IMNOrigScrollFunc==IMNScroll)
		return true;
	return IMNOrigScrollFunc ? IMNOrigScrollFunc() : true;
}
var imnCount=0;
var imnElems;
var imnElemsCount=0;
var imnMarkerBatchSize=4;
var imnMarkerBatchDelay=40;
function ProcessImn()
{
	if (EnsureIMNControl() && IMNControlObj.PresenceEnabled)
	{
		imnElems=document.getElementsByName("imnmark");
		imnElemsCount=imnElems.length;
		ProcessImnMarkers();
	}
}
function ProcessImnMarkers()
{
	for (i=0;i<imnMarkerBatchSize;++i)
	{
		if (imnCount==imnElemsCount)
			return;
		IMNRC(imnElems[imnCount].sip,imnElems[imnCount]);
		imnCount++;
	}
	setTimeout("ProcessImnMarkers()",imnMarkerBatchDelay);
}
function IMNRC(name, elem)
{
	if (name==null || name=='')
		return;
	if (browseris.ie5up && browseris.win32)
	{
		var obj=(elem) ? elem : window.event.srcElement;
		var objSpan=obj;
		var id=obj.id;
		var fFirst=false;
		if (!IMNDictionaryObj)
		{
			IMNDictionaryObj=new Object();
			IMNNameDictionaryObj=new Object();
			IMNSortableObj=new Object();
			IMNShowOfflineObj=new Object();
			if (!IMNOrigScrollFunc)
			{
				IMNOrigScrollFunc=window.onscroll;
				window.onscroll=IMNScroll;
			}
		}
		if (IMNDictionaryObj)
		{
			if (!IMNNameDictionaryObj[id])
			{
				IMNNameDictionaryObj[id]=name;
				fFirst=true;
			}
			if (typeof(IMNDictionaryObj[id])=="undefined")
			{
				IMNDictionaryObj[id]=1;
			}
			if (!IMNSortableObj[id] &&
				(typeof(obj.Sortable) !="undefined"))
			{
				IMNSortableObj[id]=obj.Sortable;
				if (!bIMNOnloadAttached)
				{
					if (EnsureIMNControl() && IMNControlObj.PresenceEnabled)
						window.attachEvent("onload", IMNSortTable);
					bIMNOnloadAttached=true;
				}
			}
			if (!IMNShowOfflineObj[id] &&
				(typeof(obj.ShowOfflinePawn) !="undefined"))
			{
				IMNShowOfflineObj[id]=obj.ShowOfflinePawn;
			}
			if (fFirst && EnsureIMNControl() && IMNControlObj.PresenceEnabled)
			{
				var state=1, img;
				state=IMNControlObj.GetStatus(name, id);
				if (IMNIsOnlineState(state) || IMNSortableObj[id] ||
					IMNShowOfflineObj[id])
				{
					img=IMNGetStatusImage(state, IMNSortableObj[id] ||
											IMNShowOfflineObj[id]);
					IMNUpdateImage(id, img);
					IMNDictionaryObj[id]=state;
				}
			}
		}
		if (fFirst)
		{
			var objRet=IMNGetOOUILocation(obj);
			objSpan=objRet.objSpan;
			if (objSpan)
			{
				objSpan.onmouseover=IMNShowOOUIMouse;
				objSpan.onfocusin=IMNShowOOUIKyb;
				objSpan.onmouseout=IMNHideOOUI;
				objSpan.onfocusout=IMNHideOOUI;
			}
		}
	}
}
function IMNSortTable()
{
	var id;
	for (id in IMNDictionaryObj)
	{
		IMNSortList(id, 1, IMNDictionaryObj[id]);
	}
	bIMNSorted=true;
}
function IMNRegisterHeader()
{
	if (browseris.ie5up && browseris.win32)
	{
		var obj=window.event.srcElement;
		if (!IMNHeaderObj)
		{
			IMNHeaderObj=new Object();
		}
		if (IMNHeaderObj)
		{
			var id=obj.id;
			if (!IMNHeaderObj[id])
			{
				IMNHeaderObj[id]=id;
				var img;
				img=IMNGetHeaderImage();
				IMNUpdateImage(id, img);
			}
		}
	}
}
var _spBodyOnLoadFunctionNames;
if (_spBodyOnLoadFunctionNames==null)
{
	_spBodyOnLoadFunctionNames=new Array();
	_spBodyOnLoadFunctionNames.push("_spBodyOnLoad");
	_spBodyOnLoadFunctionNames.push("_spRestoreScrollForDiv_rscr");
}
var _spOriginalFormAction;
var _spEscapedFormAction;
var _spFormOnSubmitCalled=false;
var _spBodyOnPageShowRegistered=false;
function _spBodyOnPageShow(evt)
{
	_spFormOnSubmitCalled=false;
}
function _spResetFormOnSubmitCalledFlag( sender,  e)
{
	_spFormOnSubmitCalled=false;
}
function _spBodyOnLoadWrapper()
{
	if (!_spBodyOnPageShowRegistered &&
		typeof(browseris) !="undefined" &&
		!browseris.ie &&
		typeof(window.addEventListener)=='function')
	{
		window.addEventListener('pageshow', _spBodyOnPageShow, false);
		_spBodyOnPageShowRegistered=true;
	}
	if (_spOriginalFormAction==null)
	{
		if (document.forms.length > 0)
		{
			_spOriginalFormAction=document.forms[0].action;
			var url=window.location.href;
			var index=url.indexOf("://");
			if (index >=0)
			{
				var temp=url.substring(index+3);
				index=temp.indexOf("/");
				if (index >=0)
					url=temp.substring(index);
			}
			_spEscapedFormAction=escapeUrlForCallback(url);
			document.forms[0].action=_spEscapedFormAction;
		}
	}
	_spFormOnSubmitCalled=false;
	if (typeof(Sys) !="undefined" &&
		typeof(Sys.Net) !="undefined" &&
		typeof(Sys.Net.WebRequestManager) !="undefined")
	{
		Sys.Net.WebRequestManager.add_invokingRequest(_spResetFormOnSubmitCalledFlag);
	}
	ProcessDefaultOnLoad(_spBodyOnLoadFunctionNames);
}
var _spSuppressFormOnSubmitWrapper=false;
function _spFormOnSubmitWrapper()
{
	if (_spSuppressFormOnSubmitWrapper)
	{
		return true;
	}
	if (_spFormOnSubmitCalled)
	{
		return false;
	}
	if (typeof(_spFormOnSubmit)=="function")
	{
		var retval=_spFormOnSubmit();
		var testval=false;
		if (typeof(retval)==typeof(testval) && retval==testval)
		{
			return false;
		}
	}
	RestoreToOriginalFormAction();
	_spFormOnSubmitCalled=true;
	return true;
}
function RestoreToOriginalFormAction()
{
	if (_spOriginalFormAction !=null)
	{
		if (_spEscapedFormAction==document.forms[0].action)
		{
			document.forms[0].action=_spOriginalFormAction;
		}
		_spOriginalFormAction=null;
		_spEscapedFormAction=null;
	}
}
function DefaultFocus()
{
	if (typeof(_spUseDefaultFocus)!="undefined")
	{
		var elements=document.getElementsByName("_spFocusHere");
		var elem=null;
		if (elements==null || elements.length <=0)
		{
			elem=document.getElementById("_spFocusHere");
		}
		else if (elements !=null && elements.length > 0)
		{
			elem=elements[0];
		}
		if (elem !=null)
		{
			var aLinks=elem.getElementsByTagName("a");
			if (aLinks !=null && aLinks.length > 0)
			{
				try{aLinks[0].focus();}catch(e){}
			}
		}
	}
}
function ProcessDefaultOnLoad(onLoadFunctionNames)
{
	ProcessPNGImages();
	UpdateAccessibilityUI();
	ProcessImn();
	for (var i=0; i < onLoadFunctionNames.length; i++)
	{
		var expr="if(typeof("+onLoadFunctionNames[i]+")=='function'){"+onLoadFunctionNames[i]+"();}";
		eval(expr);
	}
	if (typeof(_spUseDefaultFocus)!="undefined")
		DefaultFocus();
}

