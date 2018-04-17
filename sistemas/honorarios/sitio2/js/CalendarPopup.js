function CalendarPopup() {
	var c;
	if (arguments.length>0) {
		c = new PopupWindow(arguments[0]);
		}
	else {
		c = new PopupWindow();
		c.setSize(150,175);
		}
	c.offsetX = -152;
	c.offsetY = 25;
	c.autoHide();
	// Calendar-specific properties
	c.monthNames = new Array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
	c.monthAbbreviations = new Array("Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic");
	c.dayHeaders = new Array("D","L","M","M","J","V","S");
	c.returnFunction = "CalendarPopup_tmpReturnFunction";
	c.returnMonthFunction = "CalendarPopup_tmpReturnMonthFunction";
	c.returnQuarterFunction = "CalendarPopup_tmpReturnQuarterFunction";
	c.returnYearFunction = "CalendarPopup_tmpReturnYearFunction";
	c.weekStartDay = 0;
	c.isShowYearNavigation = false;
	c.displayType = "date";
	c.disabledWeekDays = new Object();
	c.disabledDatesExpression = "";
	c.yearSelectStartOffset = 2;
	c.currentDate = null;
	c.todayText="Hoy";
	window.CalendarPopup_targetInput = null;
	window.CalendarPopup_dateFormat = "dd/mm/yyyy";
	// Method mappings
	c.setReturnFunction = CalendarPopup_setReturnFunction;
	c.setReturnMonthFunction = CalendarPopup_setReturnMonthFunction;
	c.setReturnQuarterFunction = CalendarPopup_setReturnQuarterFunction;
	c.setReturnYearFunction = CalendarPopup_setReturnYearFunction;
	c.setMonthNames = CalendarPopup_setMonthNames;
	c.setMonthAbbreviations = CalendarPopup_setMonthAbbreviations;
	c.setDayHeaders = CalendarPopup_setDayHeaders;
	c.setWeekStartDay = CalendarPopup_setWeekStartDay;
	c.setDisplayType = CalendarPopup_setDisplayType;
	c.setDisabledWeekDays = CalendarPopup_setDisabledWeekDays;
	c.addDisabledDates = CalendarPopup_addDisabledDates;
	c.setYearSelectStartOffset = CalendarPopup_setYearSelectStartOffset;
	c.setTodayText = CalendarPopup_setTodayText;
	c.showYearNavigation = CalendarPopup_showYearNavigation;
	c.showCalendar = CalendarPopup_showCalendar;
	c.hideCalendar = CalendarPopup_hideCalendar;
	c.getStyles = CalendarPopup_getStyles;
	c.refreshCalendar = CalendarPopup_refreshCalendar;
	c.getCalendar = CalendarPopup_getCalendar;
	c.select = CalendarPopup_select;
	// Return the object
	return c;
	}

// Temporary default functions to be called when items clicked, so no error is thrown
function CalendarPopup_tmpReturnFunction(y,m,d) { 
	if (window.CalendarPopup_targetInput!=null) {
		var dt = new Date(y,m-1,d,0,0,0);
		window.CalendarPopup_targetInput.value = formatDate(dt,window.CalendarPopup_dateFormat);
		}
	else {
		alert('Use setReturnFunction() to define which function will get the clicked results!'); 
		}
	}
function CalendarPopup_tmpReturnMonthFunction(y,m) { 
	alert('Use setReturnMonthFunction() to define which function will get the clicked results!\nYou clicked: year='+y+' , month='+m); 
	}
function CalendarPopup_tmpReturnQuarterFunction(y,q) { 
	alert('Use setReturnQuarterFunction() to define which function will get the clicked results!\nYou clicked: year='+y+' , quarter='+q); 
	}
function CalendarPopup_tmpReturnYearFunction(y) { 
	alert('Use setReturnYearFunction() to define which function will get the clicked results!\nYou clicked: year='+y); 
	}

// Set the name of the functions to call to get the clicked item
function CalendarPopup_setReturnFunction(name) { this.returnFunction = name; }
function CalendarPopup_setReturnMonthFunction(name) { this.returnMonthFunction = name; }
function CalendarPopup_setReturnQuarterFunction(name) { this.returnQuarterFunction = name; }
function CalendarPopup_setReturnYearFunction(name) { this.returnYearFunction = name; }

// Over-ride the built-in month names
function CalendarPopup_setMonthNames() {
	for (var i=0; i<arguments.length; i++) { this.monthNames[i] = arguments[i]; }
	}

// Over-ride the built-in month abbreviations
function CalendarPopup_setMonthAbbreviations() {
	for (var i=0; i<arguments.length; i++) { this.monthAbbreviations[i] = arguments[i]; }
	}

// Over-ride the built-in column headers for each day
function CalendarPopup_setDayHeaders() {
	for (var i=0; i<arguments.length; i++) { this.dayHeaders[i] = arguments[i]; }
	}

// Set the day of the week (0-7) that the calendar display starts on
// This is for countries other than the US whose calendar displays start on Monday(1), for example
function CalendarPopup_setWeekStartDay(day) { this.weekStartDay = day; }

// Show next/last year navigation links
function CalendarPopup_showYearNavigation() { this.isShowYearNavigation = true; }

// Which type of calendar to display
function CalendarPopup_setDisplayType(type) {
	if (type!="date"&&type!="week-end"&&type!="month"&&type!="quarter"&&type!="year") { alert("Invalid display type! Must be one of: date,week-end,month,quarter,year"); return false; }
	this.displayType=type;
	}

// How many years back to start by default for year display
function CalendarPopup_setYearSelectStartOffset(num) { this.yearSelectStartOffset=num; }

// Set which weekdays should not be clickable
function CalendarPopup_setDisabledWeekDays() {
	this.disabledWeekDays = new Object();
	for (var i=0; i<arguments.length; i++) { this.disabledWeekDays[arguments[i]] = true; }
	}
	
// Disable individual dates or ranges
// Builds an internal logical test which is run via eval() for efficiency
function CalendarPopup_addDisabledDates(start, end) {
	if (arguments.length==1) { end=start; }
	if (start==null && end==null) { return; }
	if (this.disabledDatesExpression!="") { this.disabledDatesExpression+= "||"; }
	if (start!=null) { start = parseDate(start); start=""+start.getFullYear()+LZ(start.getMonth()+1)+LZ(start.getDate());}
	if (end!=null) { end=parseDate(end); end=""+end.getFullYear()+LZ(end.getMonth()+1)+LZ(end.getDate());}
	if (start==null) { this.disabledDatesExpression+="(ds<="+end+")"; }
	else if (end  ==null) { this.disabledDatesExpression+="(ds>="+start+")"; }
	else { this.disabledDatesExpression+="(ds>="+start+"&&ds<="+end+")"; }
	}
	
// Set the text to use for the "Today" link
function CalendarPopup_setTodayText(text) {
	this.todayText = text;
	}

// Hide a calendar object
function CalendarPopup_hideCalendar() {
	if (arguments.length > 0) { window.popupWindowObjects[arguments[0]].hidePopup(); }
	else { this.hidePopup(); }
	}

// Refresh the contents of the calendar display
function CalendarPopup_refreshCalendar(index) {
	var calObject = window.popupWindowObjects[index];
	if (arguments.length>1) { 
		calObject.populate(calObject.getCalendar(arguments[1],arguments[2],arguments[3],arguments[4],arguments[5]));
		}
	else {
		calObject.populate(calObject.getCalendar());
		}
	calObject.refresh();
	}

// Populate the calendar and display it
function CalendarPopup_showCalendar(anchorname) {
	if (arguments.length>1) {
		if (arguments[1]==null||arguments[1]=="") {
			this.currentDate=new Date();
			}
		else {
			this.currentDate=new Date(parseDate(arguments[1]));
			}
		}
	this.populate(this.getCalendar());
	this.showPopup(anchorname);
	}

// Simple method to interface popup calendar with a text-entry box
function CalendarPopup_select(inputobj, linkname, format) {
	var selectedDate=(arguments.length>3)?arguments[3]:null;
	if (!window.getDateFromFormat) {
		alert("calendar.select: To use this method you must also include 'date.js' for date formatting");
		return;
		}
	if (this.displayType!="date"&&this.displayType!="week-end") {
		alert("calendar.select: This function can only be used with displayType 'date' or 'week-end'");
		return;
		}
	if (inputobj.type!="text" && inputobj.type!="hidden" && inputobj.type!="textarea") { 
		alert("calendar.select: Input object passed is not a valid form input object"); 
		window.CalendarPopup_targetInput=null;
		return;
		}
	window.CalendarPopup_targetInput = inputobj;
	this.currentDate=null;
	var time=0;
	if (selectedDate!=null) {
		time = getDateFromFormat(selectedDate,format)
		}
	else if (inputobj.value!="") {
		time = getDateFromFormat(inputobj.value,format);
		}
	if (selectedDate!=null || inputobj.value!="") {
		if (time==0) { this.currentDate=null; }
		else { this.currentDate=new Date(time); }
		}
	window.CalendarPopup_dateFormat = format;
	this.showCalendar(linkname);
	}
	
// Get style block needed to display the calendar correctly
function CalendarPopup_getStyles() {
	var result = "";
	result += "<STYLE>\n";
	result += "TD.cal,TD.calday,TD.calmonth,TD.caltoday,A.textlink,.disabledtextlink { font-family:arial; font-size: 8pt; }\n";
	result += "TD.calday{border:solid thin #C0C0C0;border-width:0 0 1 0;}\n";
	result += "TD.calmonth{text-align:right;}\n";
	result += "TD.caltoday{text-align:right;color:white;background-color:#ffffcc;border-width:1;border:solid thing #800000;}\n";
	result += "TD.textlink{border:solid thin #C0C0C0; border-width:1 0 0 0;}\n";
	result += "A.textlink{height:20px;color:black;}\n";
	result += ".disabledtextlink{height:20px;color:#808080;}\n";
	result += "A.cal{text-decoration:none;color:#000000;}\n";
	result += "A.calthismonth{text-decoration:none;color:#000000;}\n";
	result += "A.calothermonth{text-decoration:none; color:#808080;}\n";
	result += ".calnotclickable{color:#808080;}\n";
	result += ".disabled{color:#D0D0D0;text-decoration:line-through;}\n";
	result += "</STYLE>\n";
	return result;
	}

// Return a string containing all the calendar code to be displayed
function CalendarPopup_getCalendar() {
	var now = new Date();
	// Reference to window
	if (this.type == "WINDOW") { var windowref = "window.opener."; }
	else { var windowref = ""; }
	var result = "";
	// If POPUP, write entire HTML document
	if (this.type == "WINDOW") {
		result += "<HTML><HEAD><TITLE>Calendar</TITLE>"+this.getStyles()+"</HEAD><BODY MARGINWIDTH=0 MARGINHEIGHT=0 TOPMARGIN=0 RIGHTMARGIN=0 LEFTMARGIN=0>\n";
		result += '<CENTER><TABLE WIDTH=100% BORDER=0 BORDERWIDTH=0 CELLSPACING=0 CELLPADDING=0>\n';
		}
	else {
		result += '<TABLE WIDTH=144 BORDER=1 BORDERWIDTH=1 BORDERCOLOR="#808080" CELLSPACING=0 CELLPADDING=1>\n';
		result += '<TR><TD ALIGN=CENTER>\n';
		result += '<CENTER>\n';
		}
	var t144="<TABLE WIDTH=144 BORDER=0 BORDERWIDTH=0 CELLSPACING=0 CELLPADDING=0>";
	// Code for DATE display (default)
	// -------------------------------
	if (this.displayType=="date" || this.displayType=="week-end") {
		if (this.currentDate==null) { this.currentDate = now; }
		if (arguments.length > 0) { var month = arguments[0]; }
			else { var month = this.currentDate.getMonth()+1; }
		if (arguments.length > 1) { var year = arguments[1]; }
			else { var year = this.currentDate.getFullYear(); }
		var daysinmonth= new Array(0,31,28,31,30,31,30,31,31,30,31,30,31);
		if ( ( (year%4 == 0)&&(year%100 != 0) ) || (year%400 == 0) ) {
			daysinmonth[2] = 29;
			}
		var current_month = new Date(year,month-1,1);
		var display_year = year;
		var display_month = month;
		var display_date = 1;
		var weekday= current_month.getDay();
		var offset = 0;
		if (weekday >= this.weekStartDay) {
			offset = weekday - this.weekStartDay;
			}
		else {
			offset = 7-this.weekStartDay+weekday;
			}
		if (offset > 0) {
			display_month--;
			if (display_month < 1) { display_month = 12; display_year--; }
			display_date = daysinmonth[display_month]-offset+1;
			}
		var next_month = month+1;
		var next_month_year = year;
		if (next_month > 12) { next_month=1; next_month_year++; }
		var last_month = month-1;
		var last_month_year = year;
		if (last_month < 1) { last_month=12; last_month_year--; }
		var date_class;
		if (this.type!="WINDOW") {
			result += t144;
			}
		result += '<TR BGCOLOR="#c0c0c0">\n';
		var refresh = 'javascript:'+windowref+'CalendarPopup_refreshCalendar';
		var td = '<TD BGCOLOR="#ffffdd" CLASS="cal" ALIGN=CENTER VALIGN=MIDDLE WIDTH=';
		if (this.isShowYearNavigation) {
			result += td+'10><B><A CLASS="cal" href="'+refresh+'('+this.index+','+last_month+','+last_month_year+');"><</A></B></TD>';
			result += td+'58>'+this.monthNames[month-1]+'</TD>';
			result += td+'10><B><A CLASS="cal" href="'+refresh+'('+this.index+','+next_month+','+next_month_year+');">></A></B></TD>';
			result += td+'10> </TD>';
			result += td+'10><B><A CLASS="cal" href="'+refresh+'('+this.index+','+month+','+(year-1)+');"><</A></B></TD>';
			result += td+'36>'+year+'</TD>';
			result += td+'10><B><A CLASS="cal" href="'+refresh+'('+this.index+','+month+','+(year+1)+');">></A></B></TD>';
			}
		else {
			result += td+'22><B><A CLASS="cal" href="'+refresh+'('+this.index+','+last_month+','+last_month_year+');"><<</A></B></TD>\n';
			result += td+'100>'+this.monthNames[month-1]+' '+year+'</TD>\n';
			result += td+'22><B><A CLASS="cal" href="'+refresh+'('+this.index+','+next_month+','+next_month_year+');">>></A></B></TD>\n';
			}
		result += '</TR></TABLE>\n';
		result += '<TABLE WIDTH=120 BORDER=0 CELLSPACING=0 CELLPADDING=1 ALIGN=CENTER>\n';
		result += '<TR>\n';
		var td = '	<TD CLASS="calday" ALIGN=RIGHT WIDTH=14%>';
		for (var j=0; j<7; j++) {
			result += td+this.dayHeaders[(this.weekStartDay+j)%7]+'</TD>\n';
			}
		result += '</TR>\n';
		for (var row=1; row<=6; row++) {
			result += '<TR>\n';
			for (var col=1; col<=7; col++) {
				if (display_month == month) {
					date_class = "calthismonth";
					}
				else {
					date_class = "calothermonth";
					}
				if ((display_month == this.currentDate.getMonth()+1) && (display_date==this.currentDate.getDate()) && (display_year==this.currentDate.getFullYear())) {
					td_class="caltoday";
					}
				else {
					td_class="calmonth";
					}
				var disabled=false;
				if (this.disabledDatesExpression!="") {
					var ds=""+display_year+LZ(display_month)+LZ(display_date);
					eval("disabled=("+this.disabledDatesExpression+")");
					}
				if (disabled || this.disabledWeekDays[col-1]) {
					date_class=(disabled)?"disabled":"calnotclickable";
					result += '	<TD CLASS="'+td_class+'"><SPAN CLASS="'+date_class+'">'+display_date+'</SPAN></TD>\n';
					}
				else {
					var selected_date = display_date;
					var selected_month = display_month;
					var selected_year = display_year;
					if (this.displayType=="week-end") {
						var d = new Date(selected_year,selected_month-1,selected_date,0,0,0,0);
						d.setDate(d.getDate() + (7-col));
						selected_year = d.getYear();
						if (selected_year < 1000) { selected_year += 1900; }
						selected_month = d.getMonth()+1;
						selected_date = d.getDate();
						}
					result += '	<TD CLASS="'+td_class+'"><A HREF="javascript:'+windowref+this.returnFunction+'('+selected_year+','+selected_month+','+selected_date+');'+windowref+'CalendarPopup_hideCalendar(\''+this.index+'\');" CLASS="'+date_class+'">'+display_date+'</A></TD>\n';
					}
				display_date++;
				if (display_date > daysinmonth[display_month]) {
					display_date=1;
					display_month++;
					}
				if (display_month > 12) {
					display_month=1;
					display_year++;
					}
				}
			result += '</TR>';
			}
		var current_weekday = now.getDay() - this.weekStartDay;
		if (current_weekday < 0) {
			current_weekday += 7;
			}
		result += '<TR>\n';
		result += '	<TD COLSPAN=7 ALIGN=CENTER CLASS="textlink">\n';
		if (this.disabledWeekDays[current_weekday+1]) {
			result += '		<SPAN CLASS="disabledtextlink">'+this.todayText+'</SPAN>\n';
			}
		else {
			result += '		<A CLASS="textlink" HREF="javascript:'+windowref+this.returnFunction+'(\''+now.getFullYear()+'\',\''+(now.getMonth()+1)+'\',\''+now.getDate()+'\');'+windowref+'CalendarPopup_hideCalendar(\''+this.index+'\');">'+this.todayText+'</A>\n';
			}
		result += '		<BR>\n';
		result += '	</TD></TR></TABLE></CENTER></TD></TR></TABLE>\n';
	}

	// Code common for MONTH, QUARTER, YEAR
	// ------------------------------------
	if (this.displayType=="month" || this.displayType=="quarter" || this.displayType=="year") {
		if (arguments.length > 0) { var year = arguments[0]; }
		else { 
			if (this.displayType=="year") {	var year = now.getFullYear()-this.yearSelectStartOffset; }
			else { var year = now.getFullYear(); }
			}
		if (this.displayType!="year" && this.isShowYearNavigation) {
			result += t144;
			result += '<TR BGCOLOR="#C0C0C0">\n';
			result += '	<TD BGCOLOR="#C0C0C0" CLASS="cal" WIDTH=22 ALIGN=CENTER VALIGN=MIDDLE><B><A CLASS="cal" HREF="javascript:'+windowref+'CalendarPopup_refreshCalendar('+this.index+','+(year-1)+');"><<</A></B></TD>\n';
			result += '	<TD BGCOLOR="#C0C0C0" CLASS="cal" WIDTH=100 ALIGN=CENTER>'+year+'</TD>\n';
			result += '	<TD BGCOLOR="#C0C0C0" CLASS="cal" WIDTH=22 ALIGN=CENTER VALIGN=MIDDLE><B><A CLASS="cal" HREF="javascript:'+windowref+'CalendarPopup_refreshCalendar('+this.index+','+(year+1)+');">>></A></B></TD>\n';
			result += '</TR></TABLE>\n';
			}
		}
		
	// Code for MONTH display 
	// ----------------------
	if (this.displayType=="month") {
		// If POPUP, write entire HTML document
		result += '<TABLE WIDTH=120 BORDER=0 CELLSPACING=1 CELLPADDING=0 ALIGN=CENTER>\n';
		for (var i=0; i<4; i++) {
			result += '<TR>';
			for (var j=0; j<3; j++) {
				var monthindex = ((i*3)+j);
				result += '<TD WIDTH=33% ALIGN=CENTER><A CLASS="textlink" HREF="javascript:'+windowref+this.returnMonthFunction+'('+year+','+(monthindex+1)+');'+windowref+'CalendarPopup_hideCalendar(\''+this.index+'\');" CLASS="'+date_class+'">'+this.monthAbbreviations[monthindex]+'</A></TD>';
				}
			result += '</TR>';
			}
		result += '</TABLE></CENTER></TD></TR></TABLE>\n';
		}
	
	// Code for QUARTER display
	// ------------------------
	if (this.displayType=="quarter") {
		result += '<BR><TABLE WIDTH=120 BORDER=1 CELLSPACING=0 CELLPADDING=0 ALIGN=CENTER>\n';
		for (var i=0; i<2; i++) {
			result += '<TR>';
			for (var j=0; j<2; j++) {
				var quarter = ((i*2)+j+1);
				result += '<TD WIDTH=50% ALIGN=CENTER><BR><A CLASS="textlink" HREF="javascript:'+windowref+this.returnQuarterFunction+'('+year+','+quarter+');'+windowref+'CalendarPopup_hideCalendar(\''+this.index+'\');" CLASS="'+date_class+'">Q'+quarter+'</A><BR><BR></TD>';
				}
			result += '</TR>';
			}
		result += '</TABLE></CENTER></TD></TR></TABLE>\n';
		}

	// Code for YEAR display
	// ---------------------
	if (this.displayType=="year") {
		var yearColumnSize = 4;
		result += t144;
		result += '<TR BGCOLOR="#C0C0C0">\n';
		result += '	<TD BGCOLOR="#C0C0C0" CLASS="cal" WIDTH=50% ALIGN=CENTER VALIGN=MIDDLE><B><A CLASS="cal" HREF="javascript:'+windowref+'CalendarPopup_refreshCalendar('+this.index+','+(year-(yearColumnSize*2))+');"><<</A></B></TD>\n';
		result += '	<TD BGCOLOR="#C0C0C0" CLASS="cal" WIDTH=50% ALIGN=CENTER VALIGN=MIDDLE><B><A CLASS="cal" HREF="javascript:'+windowref+'CalendarPopup_refreshCalendar('+this.index+','+(year+(yearColumnSize*2))+');">>></A></B></TD>\n';
		result += '</TR></TABLE>\n';
		result += '<TABLE WIDTH=120 BORDER=0 CELLSPACING=1 CELLPADDING=0 ALIGN=CENTER>\n';
		for (var i=0; i<yearColumnSize; i++) {
			for (var j=0; j<2; j++) {
				var currentyear = year+(j*yearColumnSize)+i;
				result += '<TD WIDTH=50% ALIGN=CENTER><A CLASS="textlink" HREF="javascript:'+windowref+this.returnYearFunction+'('+currentyear+');'+windowref+'CalendarPopup_hideCalendar(\''+this.index+'\');" CLASS="'+date_class+'">'+currentyear+'</A></TD>';
				}
			result += '</TR>';
			}
		result += '</TABLE></CENTER></TD></TR></TABLE>\n';
		}
	// Common
	if (this.type == "WINDOW") {
		result += "</BODY></HTML>\n";
		}
	return result;
	}
