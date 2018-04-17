<?php
define("EW_PAGE_ID", "list", TRUE); // Page ID
define("EW_TABLE_NAME", 'dpp_proveedores', TRUE);
?>
<?php 
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg50.php" ?>
<?php include "ewmysql50.php" ?>
<?php include "phpfn50.php" ?>
<?php include "dpp_proveedoresinfo.php" ?>
<?php include "userfn50.php" ?>
<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // Always modified
header("Cache-Control: private, no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); // HTTP/1.0
?>
<?php

// Open connection to the database
$conn = ew_Connect();
?>
<?php

// Common page loading event (in userfn*.php)
Page_Loading();
?>
<?php

// Page load event, used in current page
Page_Load();
?>
<?php
$dpp_proveedores->Export = @$_GET["export"]; // Get export parameter
$sExport = $dpp_proveedores->Export; // Get export parameter, used in header
$sExportFile = $dpp_proveedores->TableVar; // Get export file, used in header
?>
<?php
?>
<?php

// Paging variables
$nStartRec = 0; // Start record index
$nStopRec = 0; // Stop record index
$nTotalRecs = 0; // Total number of records
$nDisplayRecs = 20;
$nRecRange = 10;
$nRecCount = 0; // Record count

// Search filters
$sSrchAdvanced = ""; // Advanced search filter
$sSrchBasic = ""; // Basic search filter
$sSrchWhere = ""; // Search where clause
$sFilter = "";

// Master/Detail
$sDbMasterFilter = ""; // Master filter
$sDbDetailFilter = ""; // Detail filter
$sSqlMaster = ""; // Sql for master record

// Handle reset command
ResetCmd();

// Get basic search criteria
$sSrchBasic = BasicSearchWhere();

// Build search criteria
if ($sSrchAdvanced <> "") {
	if ($sSrchWhere <> "") $sSrchWhere .= " AND ";
	$sSrchWhere .= "(" . $sSrchAdvanced . ")";
}
if ($sSrchBasic <> "") {
	if ($sSrchWhere <> "") $sSrchWhere .= " AND ";
	$sSrchWhere .= "(" . $sSrchBasic . ")";
}

// Save search criteria
if ($sSrchWhere <> "") {
	if ($sSrchBasic == "") ResetBasicSearchParms();
	$dpp_proveedores->setSearchWhere($sSrchWhere); // Save to Session
	$nStartRec = 1; // Reset start record counter
	$dpp_proveedores->setStartRecordNumber($nStartRec);
} else {
	RestoreSearchParms();
}

// Build filter
$sFilter = "";
if ($sDbDetailFilter <> "") {
	if ($sFilter <> "") $sFilter .= " AND ";
	$sFilter .= "(" . $sDbDetailFilter . ")";
}
if ($sSrchWhere <> "") {
	if ($sFilter <> "") $sFilter .= " AND ";
	$sFilter .= "(" . $sSrchWhere . ")";
}

// Set up filter in Session
$dpp_proveedores->setSessionWhere($sFilter);
$dpp_proveedores->CurrentFilter = "";

// Set Up Sorting Order
SetUpSortOrder();

// Set Return Url
$dpp_proveedores->setReturnUrl("dpp_proveedoreslist.php");
?>
<?php include "header.php" ?>
<?php if ($dpp_proveedores->Export == "") { ?>
<script type="text/javascript">
<!--
var EW_PAGE_ID = "list"; // Page id

//-->
</script>
<script type="text/javascript">
<!--
var firstrowoffset = 1; // First data row start at
var lastrowoffset = 0; // Last data row end at
var EW_LIST_TABLE_NAME = 'ewlistmain'; // Table name for list page
var rowclass = 'ewTableRow'; // Row class
var rowaltclass = 'ewTableAltRow'; // Row alternate class
var rowmoverclass = 'ewTableHighlightRow'; // Row mouse over class
var rowselectedclass = 'ewTableSelectRow'; // Row selected class
var roweditclass = 'ewTableEditRow'; // Row edit class

//-->
</script>
<script type="text/javascript">
<!--

// js for DHtml Editor
//-->

</script>
<script type="text/javascript">
<!--

// js for Popup Calendar
//-->

</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<?php } ?>
<?php if ($dpp_proveedores->Export == "") { ?>
<?php } ?>
<?php

// Load recordset
$bExportAll = (defined("EW_EXPORT_ALL") && $dpp_proveedores->Export <> "");
$bSelectLimit = ($dpp_proveedores->Export == "" && $dpp_proveedores->SelectLimit);
if (!$bSelectLimit) $rs = LoadRecordset();
$nTotalRecs = ($bSelectLimit) ? $dpp_proveedores->SelectRecordCount() : $rs->RecordCount();
$nStartRec = 1;
if ($nDisplayRecs <= 0) $nDisplayRecs = $nTotalRecs; // Display all records
if (!$bExportAll) SetUpStartRec(); // Set up start record position
if ($bSelectLimit) $rs = LoadRecordset($nStartRec-1, $nDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;">TABLA: dpp proveedores
</span></p>
<?php if ($dpp_proveedores->Export == "") { ?>
<form name="fdpp_proveedoreslistsrch" id="fdpp_proveedoreslistsrch" action="dpp_proveedoreslist.php" >
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo $dpp_proveedores->getBasicSearchKeyword() ?>">
			<input type="Submit" name="Submit" id="Submit" value="Buscar (*)">&nbsp;
			<a href="dpp_proveedoreslist.php?cmd=reset">Mostrar todo</a>&nbsp;
		</span></td>
	</tr>
	<tr>
	<td><span class="phpmaker"><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="" <?php if ($dpp_proveedores->getBasicSearchType() == "") { ?>checked<?php } ?>>Frase exacta&nbsp;&nbsp;<input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND" <?php if ($dpp_proveedores->getBasicSearchType() == "AND") { ?>checked<?php } ?>>Todas las palabras&nbsp;&nbsp;<input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR" <?php if ($dpp_proveedores->getBasicSearchType() == "OR") { ?>checked<?php } ?>>Cualquier palabra</span></td>
	</tr>
</table>
</form>
<?php } ?>
<?php
if (@$_SESSION[EW_SESSION_MESSAGE] <> "") {
?>
<p><span class="ewmsg"><?php echo $_SESSION[EW_SESSION_MESSAGE] ?></span></p>
<?php
	$_SESSION[EW_SESSION_MESSAGE] = ""; // Clear message
}
?>
<form method="post" name="fdpp_proveedoreslist" id="fdpp_proveedoreslist">
<?php if ($dpp_proveedores->Export == "") { ?>
<table>
	<tr><td><span class="phpmaker">
<a href="dpp_proveedoresadd.php">Agregar</a>&nbsp;&nbsp;
	</span></td></tr>
</table>
<?php } ?>
<?php if ($nTotalRecs > 0) { ?>
<table id="ewlistmain" class="ewTable">
<?php
	$OptionCnt = 0;
	$OptionCnt++; // view
	$OptionCnt++; // edit
	$OptionCnt++; // copy
	$OptionCnt++; // delete
?>
	<!-- Table header -->
	<tr class="ewTableHeader">
		<td valign="top">
<?php if ($dpp_proveedores->Export <> "") { ?>
provee id
<?php } else { ?>
	<a href="dpp_proveedoreslist.php?order=<?php echo urlencode('provee_id') ?>&ordertype=<?php echo $dpp_proveedores->provee_id->ReverseSort() ?>">provee id<?php if ($dpp_proveedores->provee_id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($dpp_proveedores->provee_id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></a>
<?php } ?>
		</td>
		<td valign="top">
<?php if ($dpp_proveedores->Export <> "") { ?>
provee rut
<?php } else { ?>
	<a href="dpp_proveedoreslist.php?order=<?php echo urlencode('provee_rut') ?>&ordertype=<?php echo $dpp_proveedores->provee_rut->ReverseSort() ?>">provee rut<?php if ($dpp_proveedores->provee_rut->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($dpp_proveedores->provee_rut->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></a>
<?php } ?>
		</td>
		<td valign="top">
<?php if ($dpp_proveedores->Export <> "") { ?>
provee dig
<?php } else { ?>
	<a href="dpp_proveedoreslist.php?order=<?php echo urlencode('provee_dig') ?>&ordertype=<?php echo $dpp_proveedores->provee_dig->ReverseSort() ?>">provee dig&nbsp;(*)<?php if ($dpp_proveedores->provee_dig->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($dpp_proveedores->provee_dig->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></a>
<?php } ?>
		</td>
		<td valign="top">
<?php if ($dpp_proveedores->Export <> "") { ?>
provee cat juri
<?php } else { ?>
	<a href="dpp_proveedoreslist.php?order=<?php echo urlencode('provee_cat_juri') ?>&ordertype=<?php echo $dpp_proveedores->provee_cat_juri->ReverseSort() ?>">provee cat juri<?php if ($dpp_proveedores->provee_cat_juri->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($dpp_proveedores->provee_cat_juri->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></a>
<?php } ?>
		</td>
		<td valign="top">
<?php if ($dpp_proveedores->Export <> "") { ?>
provee nombre
<?php } else { ?>
	<a href="dpp_proveedoreslist.php?order=<?php echo urlencode('provee_nombre') ?>&ordertype=<?php echo $dpp_proveedores->provee_nombre->ReverseSort() ?>">provee nombre&nbsp;(*)<?php if ($dpp_proveedores->provee_nombre->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($dpp_proveedores->provee_nombre->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></a>
<?php } ?>
		</td>
		<td valign="top">
<?php if ($dpp_proveedores->Export <> "") { ?>
provee paterno
<?php } else { ?>
	<a href="dpp_proveedoreslist.php?order=<?php echo urlencode('provee_paterno') ?>&ordertype=<?php echo $dpp_proveedores->provee_paterno->ReverseSort() ?>">provee paterno&nbsp;(*)<?php if ($dpp_proveedores->provee_paterno->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($dpp_proveedores->provee_paterno->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></a>
<?php } ?>
		</td>
		<td valign="top">
<?php if ($dpp_proveedores->Export <> "") { ?>
provee materno
<?php } else { ?>
	<a href="dpp_proveedoreslist.php?order=<?php echo urlencode('provee_materno') ?>&ordertype=<?php echo $dpp_proveedores->provee_materno->ReverseSort() ?>">provee materno&nbsp;(*)<?php if ($dpp_proveedores->provee_materno->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($dpp_proveedores->provee_materno->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></a>
<?php } ?>
		</td>
		<td valign="top">
<?php if ($dpp_proveedores->Export <> "") { ?>
provee dir
<?php } else { ?>
	<a href="dpp_proveedoreslist.php?order=<?php echo urlencode('provee_dir') ?>&ordertype=<?php echo $dpp_proveedores->provee_dir->ReverseSort() ?>">provee dir&nbsp;(*)<?php if ($dpp_proveedores->provee_dir->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($dpp_proveedores->provee_dir->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></a>
<?php } ?>
		</td>
		<td valign="top">
<?php if ($dpp_proveedores->Export <> "") { ?>
provee fono
<?php } else { ?>
	<a href="dpp_proveedoreslist.php?order=<?php echo urlencode('provee_fono') ?>&ordertype=<?php echo $dpp_proveedores->provee_fono->ReverseSort() ?>">provee fono&nbsp;(*)<?php if ($dpp_proveedores->provee_fono->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($dpp_proveedores->provee_fono->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></a>
<?php } ?>
		</td>
<?php if ($dpp_proveedores->Export == "") { ?>
<td nowrap>&nbsp;</td>
<td nowrap>&nbsp;</td>
<td nowrap>&nbsp;</td>
<td nowrap>&nbsp;</td>
<?php } ?>
	</tr>
<?php
if (defined("EW_EXPORT_ALL") && $dpp_proveedores->Export <> "") {
	$nStopRec = $nTotalRecs;
} else {
	$nStopRec = $nStartRec + $nDisplayRecs - 1; // Set the last record to display
}
$nRecCount = $nStartRec - 1;
if (!$rs->EOF) {
	$rs->MoveFirst();
	if (!$dpp_proveedores->SelectLimit) $rs->Move($nStartRec - 1); // Move to first record directly
}
$RowCnt = 0;
while (!$rs->EOF && $nRecCount < $nStopRec) {
	$nRecCount++;
	if (intval($nRecCount) >= intval($nStartRec)) {
		$RowCnt++;

	// Init row class and style
	$dpp_proveedores->CssClass = "ewTableRow";
	$dpp_proveedores->CssStyle = "";

	// Init row event
	$dpp_proveedores->RowClientEvents = "onmouseover='ew_MouseOver(this);' onmouseout='ew_MouseOut(this);' onclick='ew_Click(this);'";

	// Display alternate color for rows
	if ($RowCnt % 2 == 0) {
		$dpp_proveedores->CssClass = "ewTableAltRow";
	}
	LoadRowValues($rs); // Load row values
	$dpp_proveedores->RowType = EW_ROWTYPE_VIEW; // Render view
	RenderRow();
?>
	<!-- Table body -->
	<tr<?php echo $dpp_proveedores->DisplayAttributes() ?>>
		<!-- provee_id -->
		<td<?php echo $dpp_proveedores->provee_id->CellAttributes() ?>>
<div<?php echo $dpp_proveedores->provee_id->ViewAttributes() ?>><?php echo $dpp_proveedores->provee_id->ViewValue ?></div>
</td>
		<!-- provee_rut -->
		<td<?php echo $dpp_proveedores->provee_rut->CellAttributes() ?>>
<div<?php echo $dpp_proveedores->provee_rut->ViewAttributes() ?>><?php echo $dpp_proveedores->provee_rut->ViewValue ?></div>
</td>
		<!-- provee_dig -->
		<td<?php echo $dpp_proveedores->provee_dig->CellAttributes() ?>>
<div<?php echo $dpp_proveedores->provee_dig->ViewAttributes() ?>><?php echo $dpp_proveedores->provee_dig->ViewValue ?></div>
</td>
		<!-- provee_cat_juri -->
		<td<?php echo $dpp_proveedores->provee_cat_juri->CellAttributes() ?>>
<div<?php echo $dpp_proveedores->provee_cat_juri->ViewAttributes() ?>><?php echo $dpp_proveedores->provee_cat_juri->ViewValue ?></div>
</td>
		<!-- provee_nombre -->
		<td<?php echo $dpp_proveedores->provee_nombre->CellAttributes() ?>>
<div<?php echo $dpp_proveedores->provee_nombre->ViewAttributes() ?>><?php echo $dpp_proveedores->provee_nombre->ViewValue ?></div>
</td>
		<!-- provee_paterno -->
		<td<?php echo $dpp_proveedores->provee_paterno->CellAttributes() ?>>
<div<?php echo $dpp_proveedores->provee_paterno->ViewAttributes() ?>><?php echo $dpp_proveedores->provee_paterno->ViewValue ?></div>
</td>
		<!-- provee_materno -->
		<td<?php echo $dpp_proveedores->provee_materno->CellAttributes() ?>>
<div<?php echo $dpp_proveedores->provee_materno->ViewAttributes() ?>><?php echo $dpp_proveedores->provee_materno->ViewValue ?></div>
</td>
		<!-- provee_dir -->
		<td<?php echo $dpp_proveedores->provee_dir->CellAttributes() ?>>
<div<?php echo $dpp_proveedores->provee_dir->ViewAttributes() ?>><?php echo $dpp_proveedores->provee_dir->ViewValue ?></div>
</td>
		<!-- provee_fono -->
		<td<?php echo $dpp_proveedores->provee_fono->CellAttributes() ?>>
<div<?php echo $dpp_proveedores->provee_fono->ViewAttributes() ?>><?php echo $dpp_proveedores->provee_fono->ViewValue ?></div>
</td>
<?php if ($dpp_proveedores->Export == "") { ?>
<td nowrap><span class="phpmaker">
<a href="<?php echo $dpp_proveedores->ViewUrl() ?>">Vista</a>
</span></td>
<td nowrap><span class="phpmaker">
<a href="<?php echo $dpp_proveedores->EditUrl() ?>">Editar</a>
</span></td>
<td nowrap><span class="phpmaker">
<a href="<?php echo $dpp_proveedores->CopyUrl() ?>">Copiar</a>
</span></td>
<td nowrap><span class="phpmaker">
<a href="<?php echo $dpp_proveedores->DeleteUrl() ?>">Borrar</a>
</span></td>
<?php } ?>
	</tr>
<?php
	}
	$rs->MoveNext();
}
?>
</table>
<?php if ($dpp_proveedores->Export == "") { ?>
<table>
	<tr><td><span class="phpmaker">
<a href="dpp_proveedoresadd.php">Agregar</a>&nbsp;&nbsp;
	</span></td></tr>
</table>
<?php } ?>
<?php } ?>
</form>
<?php

// Close recordset and connection
if ($rs) $rs->Close();
?>
<?php if ($dpp_proveedores->Export == "") { ?>
<form action="dpp_proveedoreslist.php" name="ewpagerform" id="ewpagerform">
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td nowrap>
<?php if (!isset($Pager)) $Pager = new cPrevNextPager($nStartRec, $nDisplayRecs, $nTotalRecs) ?>
<?php if ($Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">Pagina&nbsp;</span></td>
<!--first page button-->
	<?php if ($Pager->FirstButton->Enabled) { ?>
	<td><a href="dpp_proveedoreslist.php?start=<?php echo $Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="Primero" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="Primero" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($Pager->PrevButton->Enabled) { ?>
	<td><a href="dpp_proveedoreslist.php?start=<?php echo $Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Anterior" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Anterior" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($Pager->NextButton->Enabled) { ?>
	<td><a href="dpp_proveedoreslist.php?start=<?php echo $Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Proximo" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Proximo" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($Pager->LastButton->Enabled) { ?>
	<td><a href="dpp_proveedoreslist.php?start=<?php echo $Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Ultimo" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Ultimo" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;de <?php echo $Pager->PageCount ?></span></td>
	</tr></table>
	<span class="phpmaker">Registros <?php echo $Pager->FromIndex ?> a <?php echo $Pager->ToIndex ?> de <?php echo $Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($sSrchWhere == "0=101") { ?>
	<span class="phpmaker">Porfavor ingrese el criterio de busqueda</span>
	<?php } else { ?>
	<span class="phpmaker">No se encontraron registros</span>
	<?php } ?>
<?php } ?>
		</td>
	</tr>
</table>
</form>
<?php } ?>
<?php if ($dpp_proveedores->Export == "") { ?>
<?php } ?>
<?php if ($dpp_proveedores->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php

// If control is passed here, simply terminate the page without redirect
Page_Terminate();

// -----------------------------------------------------------------
//  Subroutine Page_Terminate
//  - called when exit page
//  - clean up connection and objects
//  - if url specified, redirect to url, otherwise end response
function Page_Terminate($url = "") {
	global $conn;

	// Page unload event, used in current page
	Page_Unload();

	// Global page unloaded event (in userfn*.php)
	Page_Unloaded();

	 // Close Connection
	$conn->Close();

	// Go to url if specified
	if ($url <> "") {
		ob_end_clean();
		header("Location: $url");
	}
	exit();
}
?>
<?php

// Return Basic Search sql
function BasicSearchSQL($Keyword) {
	$sKeyword = ew_AdjustSql($Keyword);
	$sql = "";
	$sql .= "`provee_dig` LIKE '%" . $sKeyword . "%' OR ";
	$sql .= "`provee_cat_juri` LIKE '%" . $sKeyword . "%' OR ";
	$sql .= "`provee_nombre` LIKE '%" . $sKeyword . "%' OR ";
	$sql .= "`provee_paterno` LIKE '%" . $sKeyword . "%' OR ";
	$sql .= "`provee_materno` LIKE '%" . $sKeyword . "%' OR ";
	$sql .= "`provee_dir` LIKE '%" . $sKeyword . "%' OR ";
	$sql .= "`provee_fono` LIKE '%" . $sKeyword . "%' OR ";
	if (substr($sql, -4) == " OR ") $sql = substr($sql, 0, strlen($sql)-4);
	return $sql;
}

// Return Basic Search Where based on search keyword and type
function BasicSearchWhere() {
	global $Security, $dpp_proveedores;
	$sSearchStr = "";
	$sSearchKeyword = ew_StripSlashes(@$_GET[EW_TABLE_BASIC_SEARCH]);
	$sSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	if ($sSearchKeyword <> "") {
		$sSearch = trim($sSearchKeyword);
		if ($sSearchType <> "") {
			while (strpos($sSearch, "  ") !== FALSE)
				$sSearch = str_replace("  ", " ", $sSearch);
			$arKeyword = explode(" ", trim($sSearch));
			foreach ($arKeyword as $sKeyword) {
				if ($sSearchStr <> "") $sSearchStr .= " " . $sSearchType . " ";
				$sSearchStr .= "(" . BasicSearchSQL($sKeyword) . ")";
			}
		} else {
			$sSearchStr = BasicSearchSQL($sSearch);
		}
	}
	if ($sSearchKeyword <> "") {
		$dpp_proveedores->setBasicSearchKeyword($sSearchKeyword);
		$dpp_proveedores->setBasicSearchType($sSearchType);
	}
	return $sSearchStr;
}

// Clear all search parameters
function ResetSearchParms() {

	// Clear search where
	global $dpp_proveedores;
	$sSrchWhere = "";
	$dpp_proveedores->setSearchWhere($sSrchWhere);

	// Clear basic search parameters
	ResetBasicSearchParms();
}

// Clear all basic search parameters
function ResetBasicSearchParms() {

	// Clear basic search parameters
	global $dpp_proveedores;
	$dpp_proveedores->setBasicSearchKeyword("");
	$dpp_proveedores->setBasicSearchType("");
}

// Restore all search parameters
function RestoreSearchParms() {
	global $sSrchWhere, $dpp_proveedores;
	$sSrchWhere = $dpp_proveedores->getSearchWhere();
}

// Set up Sort parameters based on Sort Links clicked
function SetUpSortOrder() {
	global $dpp_proveedores;

	// Check for an Order parameter
	if (@$_GET["order"] <> "") {
		$dpp_proveedores->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
		$dpp_proveedores->CurrentOrderType = @$_GET["ordertype"];

		// Field provee_id
		$dpp_proveedores->UpdateSort($dpp_proveedores->provee_id);

		// Field provee_rut
		$dpp_proveedores->UpdateSort($dpp_proveedores->provee_rut);

		// Field provee_dig
		$dpp_proveedores->UpdateSort($dpp_proveedores->provee_dig);

		// Field provee_cat_juri
		$dpp_proveedores->UpdateSort($dpp_proveedores->provee_cat_juri);

		// Field provee_nombre
		$dpp_proveedores->UpdateSort($dpp_proveedores->provee_nombre);

		// Field provee_paterno
		$dpp_proveedores->UpdateSort($dpp_proveedores->provee_paterno);

		// Field provee_materno
		$dpp_proveedores->UpdateSort($dpp_proveedores->provee_materno);

		// Field provee_dir
		$dpp_proveedores->UpdateSort($dpp_proveedores->provee_dir);

		// Field provee_fono
		$dpp_proveedores->UpdateSort($dpp_proveedores->provee_fono);
		$dpp_proveedores->setStartRecordNumber(1); // Reset start position
	}
	$sOrderBy = $dpp_proveedores->getSessionOrderBy(); // Get order by from Session
	if ($sOrderBy == "") {
		if ($dpp_proveedores->SqlOrderBy() <> "") {
			$sOrderBy = $dpp_proveedores->SqlOrderBy();
			$dpp_proveedores->setSessionOrderBy($sOrderBy);
		}
	}
}

// Reset command based on querystring parameter cmd=
// - RESET: reset search parameters
// - RESETALL: reset search & master/detail parameters
// - RESETSORT: reset sort parameters
function ResetCmd() {
	global $sDbMasterFilter, $sDbDetailFilter, $nStartRec, $sOrderBy;
	global $dpp_proveedores;

	// Get reset cmd
	if (@$_GET["cmd"] <> "") {
		$sCmd = $_GET["cmd"];

		// Reset search criteria
		if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall") {
			ResetSearchParms();
		}

		// Reset Sort Criteria
		if (strtolower($sCmd) == "resetsort") {
			$sOrderBy = "";
			$dpp_proveedores->setSessionOrderBy($sOrderBy);
			$dpp_proveedores->provee_id->setSort("");
			$dpp_proveedores->provee_rut->setSort("");
			$dpp_proveedores->provee_dig->setSort("");
			$dpp_proveedores->provee_cat_juri->setSort("");
			$dpp_proveedores->provee_nombre->setSort("");
			$dpp_proveedores->provee_paterno->setSort("");
			$dpp_proveedores->provee_materno->setSort("");
			$dpp_proveedores->provee_dir->setSort("");
			$dpp_proveedores->provee_fono->setSort("");
		}

		// Reset start position
		$nStartRec = 1;
		$dpp_proveedores->setStartRecordNumber($nStartRec);
	}
}
?>
<?php

// Set up Starting Record parameters based on Pager Navigation
function SetUpStartRec() {
	global $nDisplayRecs, $nStartRec, $nTotalRecs, $nPageNo, $dpp_proveedores;
	if ($nDisplayRecs == 0) return;

	// Check for a START parameter
	if (@$_GET[EW_TABLE_START_REC] <> "") {
		$nStartRec = $_GET[EW_TABLE_START_REC];
		$dpp_proveedores->setStartRecordNumber($nStartRec);
	} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
		$nPageNo = $_GET[EW_TABLE_PAGE_NO];
		if (is_numeric($nPageNo)) {
			$nStartRec = ($nPageNo-1)*$nDisplayRecs+1;
			if ($nStartRec <= 0) {
				$nStartRec = 1;
			} elseif ($nStartRec >= intval(($nTotalRecs-1)/$nDisplayRecs)*$nDisplayRecs+1) {
				$nStartRec = intval(($nTotalRecs-1)/$nDisplayRecs)*$nDisplayRecs+1;
			}
			$dpp_proveedores->setStartRecordNumber($nStartRec);
		} else {
			$nStartRec = $dpp_proveedores->getStartRecordNumber();
		}
	} else {
		$nStartRec = $dpp_proveedores->getStartRecordNumber();
	}

	// Check if correct start record counter
	if (!is_numeric($nStartRec) || $nStartRec == "") { // Avoid invalid start record counter
		$nStartRec = 1; // Reset start record counter
		$dpp_proveedores->setStartRecordNumber($nStartRec);
	} elseif (intval($nStartRec) > intval($nTotalRecs)) { // Avoid starting record > total records
		$nStartRec = intval(($nTotalRecs-1)/$nDisplayRecs)*$nDisplayRecs+1; // Point to last page first record
		$dpp_proveedores->setStartRecordNumber($nStartRec);
	} elseif (($nStartRec-1) % $nDisplayRecs <> 0) {
		$nStartRec = intval(($nStartRec-1)/$nDisplayRecs)*$nDisplayRecs+1; // Point to page boundary
		$dpp_proveedores->setStartRecordNumber($nStartRec);
	}
}
?>
<?php

// Load recordset
function LoadRecordset($offset = -1, $rowcnt = -1) {
	global $conn, $dpp_proveedores;

	// Call Recordset Selecting event
	$dpp_proveedores->Recordset_Selecting($dpp_proveedores->CurrentFilter);

	// Load list page sql
	$sSql = $dpp_proveedores->SelectSQL();
	if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

	// Load recordset
	$conn->raiseErrorFn = 'ew_ErrorFn';	
	$rs = $conn->Execute($sSql);
	$conn->raiseErrorFn = '';

	// Call Recordset Selected event
	$dpp_proveedores->Recordset_Selected($rs);
	return $rs;
}
?>
<?php

// Load row based on key values
function LoadRow() {
	global $conn, $Security, $dpp_proveedores;
	$sFilter = $dpp_proveedores->SqlKeyFilter();
	if (!is_numeric($dpp_proveedores->provee_id->CurrentValue)) {
		return FALSE; // Invalid key, exit
	}
	$sFilter = str_replace("@provee_id@", ew_AdjustSql($dpp_proveedores->provee_id->CurrentValue), $sFilter); // Replace key value

	// Call Row Selecting event
	$dpp_proveedores->Row_Selecting($sFilter);

	// Load sql based on filter
	$dpp_proveedores->CurrentFilter = $sFilter;
	$sSql = $dpp_proveedores->SQL();
	if ($rs = $conn->Execute($sSql)) {
		if ($rs->EOF) {
			$LoadRow = FALSE;
		} else {
			$LoadRow = TRUE;
			$rs->MoveFirst();
			LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$dpp_proveedores->Row_Selected($rs);
		}
		$rs->Close();
	} else {
		$LoadRow = FALSE;
	}
	return $LoadRow;
}

// Load row values from recordset
function LoadRowValues(&$rs) {
	global $dpp_proveedores;
	$dpp_proveedores->provee_id->setDbValue($rs->fields('provee_id'));
	$dpp_proveedores->provee_rut->setDbValue($rs->fields('provee_rut'));
	$dpp_proveedores->provee_dig->setDbValue($rs->fields('provee_dig'));
	$dpp_proveedores->provee_cat_juri->setDbValue($rs->fields('provee_cat_juri'));
	$dpp_proveedores->provee_nombre->setDbValue($rs->fields('provee_nombre'));
	$dpp_proveedores->provee_paterno->setDbValue($rs->fields('provee_paterno'));
	$dpp_proveedores->provee_materno->setDbValue($rs->fields('provee_materno'));
	$dpp_proveedores->provee_dir->setDbValue($rs->fields('provee_dir'));
	$dpp_proveedores->provee_fono->setDbValue($rs->fields('provee_fono'));
}
?>
<?php

// Render row values based on field settings
function RenderRow() {
	global $conn, $Security, $dpp_proveedores;

	// Call Row Rendering event
	$dpp_proveedores->Row_Rendering();

	// Common render codes for all row types
	// provee_id

	$dpp_proveedores->provee_id->CellCssStyle = "";
	$dpp_proveedores->provee_id->CellCssClass = "";

	// provee_rut
	$dpp_proveedores->provee_rut->CellCssStyle = "";
	$dpp_proveedores->provee_rut->CellCssClass = "";

	// provee_dig
	$dpp_proveedores->provee_dig->CellCssStyle = "";
	$dpp_proveedores->provee_dig->CellCssClass = "";

	// provee_cat_juri
	$dpp_proveedores->provee_cat_juri->CellCssStyle = "";
	$dpp_proveedores->provee_cat_juri->CellCssClass = "";

	// provee_nombre
	$dpp_proveedores->provee_nombre->CellCssStyle = "";
	$dpp_proveedores->provee_nombre->CellCssClass = "";

	// provee_paterno
	$dpp_proveedores->provee_paterno->CellCssStyle = "";
	$dpp_proveedores->provee_paterno->CellCssClass = "";

	// provee_materno
	$dpp_proveedores->provee_materno->CellCssStyle = "";
	$dpp_proveedores->provee_materno->CellCssClass = "";

	// provee_dir
	$dpp_proveedores->provee_dir->CellCssStyle = "";
	$dpp_proveedores->provee_dir->CellCssClass = "";

	// provee_fono
	$dpp_proveedores->provee_fono->CellCssStyle = "";
	$dpp_proveedores->provee_fono->CellCssClass = "";
	if ($dpp_proveedores->RowType == EW_ROWTYPE_VIEW) { // View row

		// provee_id
		$dpp_proveedores->provee_id->ViewValue = $dpp_proveedores->provee_id->CurrentValue;
		$dpp_proveedores->provee_id->CssStyle = "";
		$dpp_proveedores->provee_id->CssClass = "";
		$dpp_proveedores->provee_id->ViewCustomAttributes = "";

		// provee_rut
		$dpp_proveedores->provee_rut->ViewValue = $dpp_proveedores->provee_rut->CurrentValue;
		$dpp_proveedores->provee_rut->CssStyle = "";
		$dpp_proveedores->provee_rut->CssClass = "";
		$dpp_proveedores->provee_rut->ViewCustomAttributes = "";

		// provee_dig
		$dpp_proveedores->provee_dig->ViewValue = $dpp_proveedores->provee_dig->CurrentValue;
		$dpp_proveedores->provee_dig->CssStyle = "";
		$dpp_proveedores->provee_dig->CssClass = "";
		$dpp_proveedores->provee_dig->ViewCustomAttributes = "";

		// provee_cat_juri
		if (!is_null($dpp_proveedores->provee_cat_juri->CurrentValue)) {
			switch ($dpp_proveedores->provee_cat_juri->CurrentValue) {
				case "Natural":
					$dpp_proveedores->provee_cat_juri->ViewValue = "Natural";
					break;
				case "Juridica":
					$dpp_proveedores->provee_cat_juri->ViewValue = "Juridica";
					break;
				default:
					$dpp_proveedores->provee_cat_juri->ViewValue = $dpp_proveedores->provee_cat_juri->CurrentValue;
			}
		} else {
			$dpp_proveedores->provee_cat_juri->ViewValue = NULL;
		}
		$dpp_proveedores->provee_cat_juri->CssStyle = "";
		$dpp_proveedores->provee_cat_juri->CssClass = "";
		$dpp_proveedores->provee_cat_juri->ViewCustomAttributes = "";

		// provee_nombre
		$dpp_proveedores->provee_nombre->ViewValue = $dpp_proveedores->provee_nombre->CurrentValue;
		$dpp_proveedores->provee_nombre->CssStyle = "";
		$dpp_proveedores->provee_nombre->CssClass = "";
		$dpp_proveedores->provee_nombre->ViewCustomAttributes = "";

		// provee_paterno
		$dpp_proveedores->provee_paterno->ViewValue = $dpp_proveedores->provee_paterno->CurrentValue;
		$dpp_proveedores->provee_paterno->CssStyle = "";
		$dpp_proveedores->provee_paterno->CssClass = "";
		$dpp_proveedores->provee_paterno->ViewCustomAttributes = "";

		// provee_materno
		$dpp_proveedores->provee_materno->ViewValue = $dpp_proveedores->provee_materno->CurrentValue;
		$dpp_proveedores->provee_materno->CssStyle = "";
		$dpp_proveedores->provee_materno->CssClass = "";
		$dpp_proveedores->provee_materno->ViewCustomAttributes = "";

		// provee_dir
		$dpp_proveedores->provee_dir->ViewValue = $dpp_proveedores->provee_dir->CurrentValue;
		$dpp_proveedores->provee_dir->CssStyle = "";
		$dpp_proveedores->provee_dir->CssClass = "";
		$dpp_proveedores->provee_dir->ViewCustomAttributes = "";

		// provee_fono
		$dpp_proveedores->provee_fono->ViewValue = $dpp_proveedores->provee_fono->CurrentValue;
		$dpp_proveedores->provee_fono->CssStyle = "";
		$dpp_proveedores->provee_fono->CssClass = "";
		$dpp_proveedores->provee_fono->ViewCustomAttributes = "";

		// provee_id
		$dpp_proveedores->provee_id->HrefValue = "";

		// provee_rut
		$dpp_proveedores->provee_rut->HrefValue = "";

		// provee_dig
		$dpp_proveedores->provee_dig->HrefValue = "";

		// provee_cat_juri
		$dpp_proveedores->provee_cat_juri->HrefValue = "";

		// provee_nombre
		$dpp_proveedores->provee_nombre->HrefValue = "";

		// provee_paterno
		$dpp_proveedores->provee_paterno->HrefValue = "";

		// provee_materno
		$dpp_proveedores->provee_materno->HrefValue = "";

		// provee_dir
		$dpp_proveedores->provee_dir->HrefValue = "";

		// provee_fono
		$dpp_proveedores->provee_fono->HrefValue = "";
	} elseif ($dpp_proveedores->RowType == EW_ROWTYPE_ADD) { // Add row
	} elseif ($dpp_proveedores->RowType == EW_ROWTYPE_EDIT) { // Edit row
	} elseif ($dpp_proveedores->RowType == EW_ROWTYPE_SEARCH) { // Search row
	}

	// Call Row Rendered event
	$dpp_proveedores->Row_Rendered();
}
?>
<?php

// Page Load event
function Page_Load() {

	//echo "Page Load";
}

// Page Unload event
function Page_Unload() {

	//echo "Page Unload";
}
?>
