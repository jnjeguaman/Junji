// _lcid="3082" _version="12.0.6211"
// _localBinding
// Version: "12.0.6211"
// Copyright (c) Microsoft Corporation.  All rights reserved.
var g_bWarnBeforeLeave=true;
var g_bResourcesAlreadyChecked=false;
function EncodeForXmlText(value)
{
	return value.replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/\"/g, "&quot;").replace(/\'/g, "&#39;");
}
var g_UrlElements=new Array('a', 'area', 'base', 'bgsound', 'body', 'div', 'img', 'input', 'param', 'table', 'td', 'th', 'span');
var l_ur_rfct, l_ur_wsurl, l_ur_formname, l_ur_fullreport, l_ur_recsready, l_ur_plsWait
function GetSingleNamedNode(nodeCollection, name)
{
	if (!nodeCollection)
	{
		return null;
	}
	for (var i=0;i<nodeCollection.length;i++)
	{
		var node=nodeCollection.item(i);
		if (node && node.nodeName==name)
		{
			return node;
		}
	}
	return null;
}
function GetNodeTextValue(node)
{
	if (node)
	{
		return node.firstChild.nodeValue;
	}
	return '';
}
function HideServerGeneratedMessage()
{
	var messageRow=document.getElementById('consoleErrorMessageRow');
	var messageSeparator=document.getElementById('consoleErrorMessageSeparator');
	if (messageRow && messageSeparator)
	{
		messageRow.style.display='none';
		messageSeparator.style.display='none';
	}
}
function ShowUnapprovedResourcesPage()
{
	window.status=l_chkResStatus;
	showConsoleMessage(l_ur_plsWait, false);
	var documentAll=document.getElementsByTagName('*');
	var urlObjects=new Array(documentAll.length);
	var absoluteUrls=new Array(documentAll.length);
	var urlObjectTypes=new Array(documentAll.length);
	var urlObjectCount=0;
	var soapParameters="";
	var i;
	for (i=0; i < documentAll.length; i++)
	{
		var currentElement=documentAll[i];
		var j;
		for (j=0; j < g_UrlElements.length; j++)
		{
			if (currentElement.tagName.toLowerCase()==g_UrlElements[j].toLowerCase())
			{
				if (currentElement.src !=undefined && currentElement.src !="") {
					soapParameters+="<string>"+EncodeForXmlText(currentElement.src)+"</string>";
					urlObjects[urlObjectCount]=currentElement;
					absoluteUrls[urlObjectCount]=currentElement.src;
					urlObjectTypes[urlObjectCount]=g_UrlElements[j].toLowerCase();
					urlObjectCount++;
				}
				else if (currentElement.lowersrc !=undefined && currentElement.lowersrc !="") {
					soapParameters+="<string>"+EncodeForXmlText(currentElement.lowersrc)+"</string>";
					urlObjects[urlObjectCount]=currentElement;
					absoluteUrls[urlObjectCount]=currentElement.lowersrc;
					urlObjectTypes[urlObjectCount]=g_UrlElements[j].toLowerCase();
					urlObjectCount++;
				}
				else if (currentElement.href !=undefined && currentElement.href !="") {
					if (currentElement.href.split('#')[0].split('?')[0].toLowerCase() !=document.URL.split('#')[0].split('?')[0].toLowerCase()) {
						soapParameters+="<string>"+EncodeForXmlText(currentElement.href)+"</string>";
						urlObjects[urlObjectCount]=currentElement;
						absoluteUrls[urlObjectCount]=currentElement.href;
						urlObjectTypes[urlObjectCount]=g_UrlElements[j].toLowerCase();
						urlObjectCount++;
					}
				}
				else if (currentElement.style.backgroundImage !=undefined && currentElement.style.backgroundImage !="" && currentElement.style.backgroundImage.split(')').length > 1) {
					var imageUrl=currentElement.style.backgroundImage.split('(')[1].split(')')[0];
					soapParameters+="<string>"+EncodeForXmlText(imageUrl)+"</string>";
					urlObjects[urlObjectCount]=currentElement;
					absoluteUrls[urlObjectCount]=imageUrl;
					urlObjectTypes[urlObjectCount]=g_UrlElements[j].toLowerCase();
					urlObjectCount++;
				}
				else if (currentElement.datasrc !=undefined && currentElement.datasrc !="") {
					soapParameters+="<string>"+EncodeForXmlText(currentElement.datasrc)+"</string>";
					urlObjects[urlObjectCount]=currentElement;
					absoluteUrls[urlObjectCount]=currentElement.datasrc;
					urlObjectTypes[urlObjectCount]=g_UrlElements[j].toLowerCase();
					urlObjectCount++;
				}
				else if (currentElement.dynsrc !=undefined && currentElement.dynsrc !="") {
					soapParameters+="<string>"+EncodeForXmlText(currentElement.dynsrc)+"</string>";
					urlObjects[urlObjectCount]=currentElement;
					absoluteUrls[urlObjectCount]=currentElement.dynsrc;
					urlObjectTypes[urlObjectCount]=g_UrlElements[j].toLowerCase();
					urlObjectCount++;
				}
				else if (currentElement.tagName=="SPAN" && currentElement.id==l_ur_rfct && currentElement.getAttribute("fragmentid") !=null && currentElement.getAttribute("fragmentid").length > 0) {
					soapParameters+="<string>"+EncodeForXmlText(currentElement.getAttribute("fragmentid"))+"</string>";
					urlObjects[urlObjectCount]=currentElement;
					absoluteUrls[urlObjectCount]=currentElement.getAttribute("fragmentid");
					urlObjectTypes[urlObjectCount]=g_UrlElements[j].toLowerCase();
					urlObjectCount++;
				}
			}
		}
	}
	var req,e;
	try {
		req=new XMLHttpRequest();
	}
	catch(e) {
		try {
			req=new ActiveXObject("Microsoft.XMLHTTP");
		}
		catch(e) {
		}
	}
	req.open("POST", escapeUrlForCallback(l_ur_wsurl), false);
	req.setRequestHeader("Content-Type", "text/xml; charset=utf-8");
	req.setRequestHeader("SOAPAction", '"http://schemas.microsoft.com/sharepoint/soap/GetObjectStatusCollectionWithExclusions"');
	req.send(
		'<?xml version="1.0" encoding="utf-8"?>'+		'<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">'+		'  <soap:Body>'+		'    <GetObjectStatusCollectionWithExclusions xmlns="http://schemas.microsoft.com/sharepoint/soap/">'+		'      <objectUrls>'+		soapParameters+		'      </objectUrls>'+		'      <thisPageUrl>'+		document.URL.split('#')[0].split('?')[0].toLowerCase()+		'      </thisPageUrl>'+		'    </GetObjectStatusCollectionWithExclusions>'+		'  </soap:Body>'+		'</soap:Envelope>'
	);
	xml=req.responseXML;
	nodes=xml.documentElement.firstChild.firstChild.firstChild.childNodes;
	var allResourcesApproved=true;
	var unrecoverableFailure=false;
	var unrecoverableFailureMessage='';
	if (nodes.length > 0) {
		var firstNodeChildren=nodes.item(0).childNodes;
		var firstNodeObjType=GetSingleNamedNode(firstNodeChildren, "ObjectType");
		if (GetNodeTextValue(firstNodeObjType).toLowerCase()=="unrecoverablefailure")
		{
			unrecoverableFailure=true;
			unrecoverableFailureMessage=GetNodeTextValue(GetSingleNamedNode(firstNodeChildren, "Description"));
		}
	}
	if (!unrecoverableFailure) {
		for (i=0; i < nodes.length; i++)
		{
			var currentNodeChildren=nodes.item(i).childNodes;
			lastMajor=GetSingleNamedNode(currentNodeChildren, "LastMajorVersion");
			lastMinor=GetSingleNamedNode(currentNodeChildren, "LastMinorVersion");
			objType=GetSingleNamedNode(currentNodeChildren, "ObjectType");
			var majorValue=GetNodeTextValue(lastMajor);
			var minorValue=GetNodeTextValue(lastMinor);
			var objTypeValue=GetNodeTextValue(objType);
			var newNode=xml.createElement("MarkupType");
			newNode.appendChild(xml.createTextNode(urlObjectTypes[i]));
			nodes.item(i).appendChild(newNode);
			var absoluteUrlNode=xml.createElement("AbsoluteUrl");
			var absoluteUrlForDisplay=absoluteUrls[i];
			absoluteUrlForDisplay=GetNodeTextValue(GetSingleNamedNode(currentNodeChildren, "PublishingUrl"));
			absoluteUrlNode.appendChild(xml.createTextNode(absoluteUrlForDisplay));
			nodes.item(i).appendChild(absoluteUrlNode);
			if (objTypeValue.toLowerCase() !="undefined" && objTypeValue.toLowerCase() !="accessdenied")
			{
				var urlObj=urlObjects[i];
				var styleObj;
				if (urlObj.runtimeStyle)
				{
					styleObj=urlObj.runtimeStyle;
				}
				else
				{
					styleObj=urlObj.style;
				}
				if (majorValue=="0")
				{
					allResourcesApproved=false;
					styleObj.borderStyle='dashed';
					styleObj.borderWidth='thick';
					styleObj.borderColor='red';
					styleObj.margin='5px 5px 5px 5px';
					if (urlObjectTypes[i]=="a")
					{
						styleObj.top='3';
						styleObj.left='3';
						styleObj.height='3';
					};
				}
				else if (minorValue !="0" && (minorValue/majorValue) > 1)
				{
					allResourcesApproved=false;
					styleObj.borderStyle='dashed';
					styleObj.borderWidth='thick';
					styleObj.borderColor='orange';
					styleObj.margin='5px 5px 5px 5px';
					if (urlObjectTypes[i]=="a")
					{
						styleObj.top='3';
						styleObj.left='3';
						styleObj.height='3';
					};
				}
				else if (urlObj.runtimeStyle)
				{
					urlObj.runtimeStyle.borderStyle=urlObj.style.borderStyle;
					urlObj.runtimeStyle.borderWidth=urlObj.style.borderWidth;
					urlObj.runtimeStyle.borderColor=urlObj.style.borderColor;
					urlObj.runtimeStyle.margin=urlObj.style.margin;
					if (urlObjectTypes[i]=="a")
					{
						urlObj.runtimeStyle.top=urlObj.style.top;
						urlObj.runtimeStyle.left=urlObj.style.left;
						urlObj.runtimeStyle.height=urlObj.style.height;
					};
				}
			}
		}
		if (allResourcesApproved==false) {
			document.forms[l_ur_formname]['MSOShowUnapproved_Xml'].value=xml.xml;
			g_ProcessedXml=xml;
			if (browseris.ie6up) {
				showConsoleMessage(l_ur_fullreport, true);
			} else {
				showConsoleMessage(l_ur_fullreportnors, true);
			}
		} else {
			showConsoleMessage(l_ur_recsready, false);
		}
	}
	else
	{
		showConsoleMessage(unrecoverableFailureMessage, true);
	}
	document.body.style.cursor='default';
	g_bResourcesAlreadyChecked=true;
	window.status='';
}
function showConsoleMessage(message, isWarningOrError)
{
  if (document.getElementById('consoleNegativeMessage') !=null &&
	  document.getElementById('consolePositiveMessage') !=null)
  {
	if (isWarningOrError)
	{
		document.getElementById('consoleNegativeMessage').innerHTML=message;
		document.getElementById('consoleNegativeMessageBar1').style.display='';
		document.getElementById('consoleNegativeMessageBar2').style.display='';
		document.getElementById('consolePositiveMessageBar1').style.display='none';
		document.getElementById('consolePositiveMessageBar2').style.display='none';
	}
	else
	{
		document.getElementById('consolePositiveMessage').innerHTML=message;
		document.getElementById('consolePositiveMessageBar1').style.display='';
		document.getElementById('consolePositiveMessageBar2').style.display='';
		document.getElementById('consoleNegativeMessageBar1').style.display='none';
		document.getElementById('consoleNegativeMessageBar2').style.display='none';
	}
  }
}
function ShowConsoleBlockPadding(leftBackgroundTdId, rightBackgroundTdId)
{
	var leftBackgroundTd=document.getElementById(leftBackgroundTdId);
	var rightBackgroundTd=document.getElementById(rightBackgroundTdId);
	ShowHtmlElement(leftBackgroundTd, true);
	ShowHtmlElement(rightBackgroundTd, true);
}
function ShowHtmlElement(element, makeVisible)
{
	if (element !=null && element.style !=null)
	{
		if (makeVisible) { element.style.display=''; } else { element.style.display='none'; }
	}
}
function AddMPOverhang(leftOverhangId, rightOverhangId) {
	var leftOverhang=document.getElementById(leftOverhangId);
	var rightOverhang=document.getElementById(rightOverhangId);
	if (leftOverhang !=null && leftOverhang.style !=null) {
		leftOverhang.style.position='relative';
		leftOverhang.style.bottom='-7px';
	}
	if (rightOverhang !=null && rightOverhang.style !=null) {
		rightOverhang.style.position='relative';
		rightOverhang.style.bottom='-7px';
	}
}
function ShowConsoleBlockPaddingWithOverhang(leftBackgroundTdId, rightBackgroundTdId, leftOverhangId, rightOverhangId)
{
	ShowConsoleBlockPadding(leftBackgroundTdId, rightBackgroundTdId);
	AddMPOverhang(leftOverhangId, rightOverhangId);
}

