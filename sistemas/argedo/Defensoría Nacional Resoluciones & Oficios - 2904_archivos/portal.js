function QueuePopulateIMNRC(sipAddress, element)
{
  setTimeout("IMNRC('" + sipAddress + "', document.getElementById('" + element.id + "'));", 100);
}

function ShowHidePrivacyRow(id, group, linkId, expandedText, hiddenText)
{
    var tbl=document.getElementById(id); 
    var childElements=tbl.rows;          
    var expand=false;                    
    for(x=0;x<childElements.length;x++)  
    {
        if(childElements[x].id == group+id)  
        {
            if(childElements[x].className.indexOf('groupHide') != -1)  
            {
                childElements[x].className=childElements[x].className.replace(/groupHide/g, 'groupShow');
                expand=true;
            }
            else
                childElements[x].className=childElements[x].className.replace(/groupShow/g, 'groupHide');
        }
    }

    var link=document.getElementById(linkId); 
    var linkText;

    if(expand)
        linkText=expandedText;
    else
        linkText=hiddenText;

    if(link.innerText != undefined)
        link.innerText = linkText;
    else
        link.textContent = linkText;
}

function AutoExpand(linkId)
{
    var link=document.getElementById(linkId);
    link.click();
}

function imgResizeMaxHW(objid, maxwidth, maxheight) {
	var obj = document.getElementById(objid);
    var oldResize=obj.onresize;
    obj.onresize=null;
	if ((obj != null) && (obj.height > 0) && (obj.width > 0)) {
		try {
			var ratiomax = maxheight/maxwidth;
			var ratioobj = obj.height/obj.width;

			if (ratiomax > ratioobj) { 
				if (obj.width > maxwidth)
					obj.width = maxwidth;
			}
			else { 
				if (obj.height > maxheight)
					obj.height = maxheight;
			}

			imgUndoTrSize(objid);
		}
		catch (e) {
		}
	}
    obj.onresize=oldResize;
}

function imgResizeMax(objid, max) {
	imgResizeMaxHW(objid, max, max);
}

function imgUndoTrSize(objid) {
	if (objid == null)
		return;

	var obj = document.getElementById(objid + '_TR');

	if (obj != null) {
		obj.height = null;
	}
}
function imgUndoSize(objid) {
	imgUndoTrSize(objid);
	imgResizeTbl(objid);
}

function imgResizeTbl(imgid) {
	if (imgid == null)
		return;

	var img = document.getElementById(imgid);
	var tbl = document.getElementById('table' + imgid);
	if (tbl != null && img != null) {
		try {
			tbl.width = img.width;
		} 
		catch (e) {}
	}
}

function SiteDocsUnSelectSplitMenu(ctrl)
{
    ctrl.className = 'ms-vb ms-splitbutton';
    ctrl.hoverInactive = 'ms-vb ms-splitbutton';
    ctrl.hoverActive = 'ms-vb ms-splitbuttonhover ms-unselectedhover';
}

function SiteDocsSelectSplitMenu(ctrl)
{
    ctrl.className = 'ms-vb ms-splitbuttonhover ms-selectednohover';
    ctrl.hoverInactive = 'ms-vb ms-splitbuttonhover ms-selectednohover';
    ctrl.hoverActive = 'ms-vb ms-splitbuttonhover ms-selectedhover';
}

function SiteDocsUnSelectNormalMenu(ctrl)
{
    ctrl.className = 'ms-menubuttoninactivehover';
    ctrl.hoverInactive = 'ms-menubuttoninactivehover';
    ctrl.hoverActive = 'ms-menubuttonactivehover ms-unselectedhover';
}

function SiteDocsSelectNormalMenu(ctrl)
{
    ctrl.className = 'ms-menubuttonactivehover ms-selectednohover';
    ctrl.hoverInactive = 'ms-menubuttonactivehover ms-selectednohover';
    ctrl.hoverActive = 'ms-menubuttonactivehover ms-selectedhover';
}

function SiteDocsChangeMenuText(ctrl, text)
{
    if (ctrl.tagName != "A")
        return;
    if (ctrl.childNodes[0].tagName != "IMG")
    {
        ctrl.childNodes[0].nodeValue = text;
    }
    else
    {
        ctrl.childNodes[1].nodeValue = text;
    }
}

function DocAdjustHeight(obj, minHeight, fallbackHeight)
{
    var height = 0;
    try
    {
        height = obj.contentWindow.document.body.scrollHeight;
    }
    catch(ex)
    {
        height = fallbackHeight;
    }
    if (height > minHeight)
        obj.height=height;
    else
        obj.height=minHeight;
}

function showProperties(tag, elip)
{
    document.getElementById(tag).style.display='';
    elip.style.display='none';
}

function PopulateCallbackMenuItems(results,context)
{
    if(context == null || results == null || results == '')
    {
        return;
    }

    var arrContext = context.split(',');
    if(arrContext.length < 4)
    {
        return;
    }

    var recsep=arrContext[0];
    var fldsep=arrContext[1];
    var menuClientId=arrContext[2];
    var templateClientId=arrContext[3];
    var menu=document.getElementById(menuClientId);
    var template=document.getElementById(templateClientId);
    var records=results.split(recsep);
    var groups=new Object();
    groups['0'] = template;
    for(var i=0;i<records.length;i++)
    {
       var fields=records[i].split(fldsep);
       if (fields.length == 1)
       {
          var parentGroup=groups[fields[0]];
          CAMSep(parentGroup);
          continue;
       }
       var imgUrl=fields[0];
       var title=fields[1];
       var action=fields[2];
       var groupId=fields[3];
       var newGroupId=fields[4];
       var desc=(fields[5].length > 0) ? fields[5] : null;
       var parentGroup=groups[groupId];
       if (newGroupId != '')
       {
          var subMenu=CASubM(parentGroup,title,imgUrl,'',null,desc);
          groups[newGroupId] = subMenu;
       }
       else
       {
          var menuitem=CAMOpt(parentGroup,title,action,imgUrl,'',null,desc);
       }
    }
    MMU_Open(template, menu);
}

function AddToQuickLinksDialog(templateId, baseUrl)
{
   var args = new Array();
   args[0] = document.title;
   args[1] = window.location.href;
   args[2] = (document.getElementById('ServerTemplate')) ? document.getElementById('ServerTemplate').value : '';
   var features = 'resizable=no,status=no,scrollbars=yes,menubar=no,directories=no,location=no,width=750,height=475';
   if (browseris.ie55up)
      features = 'resizable: no; status: no; scroll: yes; help: no; center: yes; dialogWidth: 750px; dialogHeight: 475px;';
   commonShowModalDialog(baseUrl + '_layouts/QuickLinksDialog.aspx', features, null, args);
   var menutemplate = document.getElementById(templateId);
   if (menutemplate) menutemplate.innerHTML = '';
}

function TATWP_jumpMenu(dropDownId)
{
    var el=document.getElementById((dropDownId != undefined) ? dropDownId : "TasksAndToolsDDID");
    if(el != null)
    {
	var href=el.options[el.selectedIndex].value;
        if(href != "0")	
        {
            STSNavigate(href);
        }
    }
}
