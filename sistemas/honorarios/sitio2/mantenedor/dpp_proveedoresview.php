<?php
define("EW_PAGE_ID", "view", TRUE); // Page ID
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
if (@$_GET["provee_id"] <> "") {
	$dpp_proveedores->provee_id->setQueryStringValue($_GET["provee_id"]);
} else {
	Page_Terminate("dpp_proveedoreslist.php"); // Return to list page
}

// Get action
if (@$_POST["a_view"] <> "") {
	$dpp_proveedores->CurrentAction = $_POST["a_view"];
} else {
	$dpp_proveedores->CurrentAction = "I"; // Display form
}
switch ($dpp_proveedores->CurrentAction) {
	case "I": // Get a record to display
		if (!LoadRow()) { // Load record based on key
			$_SESSION[EW_SESSION_MESSAGE] = "No se encontraron registros"; // Set no record message
			Page_Terminate("dpp_proveedoreslist.php"); // Return to list
		}
}

// Set return url
$dpp_proveedores->setReturnUrl("dpp_proveedoresview.php");

// Render row
$dpp_proveedores->RowType = EW_ROWTYPE_VIEW;
RenderRow();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--
var EW_PAGE_ID = "view"; // Page id

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<p><span class="phpmaker">Vista TABLA: dpp proveedores
<br><br>
<a href="dpp_proveedoreslist.php">Volver a la lista</a>&nbsp;
<a href="dpp_proveedoresadd.php">Agregar</a>&nbsp;
<a href="<?php echo $dpp_proveedores->EditUrl() ?>">Editar</a>&nbsp;
<a href="<?php echo $dpp_proveedores->CopyUrl() ?>">Copiar</a>&nbsp;
<a href="<?php echo $dpp_proveedores->DeleteUrl() ?>">Borrar</a>&nbsp;
</span>
</p>
<?php
if (@$_SESSION[EW_SESSION_MESSAGE] <> "") {
?>
<p><span class="ewmsg"><?php echo $_SESSION[EW_SESSION_MESSAGE] ?></span></p>
<?php
	$_SESSION[EW_SESSION_MESSAGE] = ""; // Clear message
}
?>
<p>
<form>
<table class="ewTable">
	<tr class="ewTableRow">
		<td class="ewTableHeader">provee id</td>
		<td<?php echo $dpp_proveedores->provee_id->CellAttributes() ?>>
<div<?php echo $dpp_proveedores->provee_id->ViewAttributes() ?>><?php echo $dpp_proveedores->provee_id->ViewValue ?></div>
</td>
	</tr>
	<tr class="ewTableAltRow">
		<td class="ewTableHeader">provee rut</td>
		<td<?php echo $dpp_proveedores->provee_rut->CellAttributes() ?>>
<div<?php echo $dpp_proveedores->provee_rut->ViewAttributes() ?>><?php echo $dpp_proveedores->provee_rut->ViewValue ?></div>
</td>
	</tr>
	<tr class="ewTableRow">
		<td class="ewTableHeader">provee dig</td>
		<td<?php echo $dpp_proveedores->provee_dig->CellAttributes() ?>>
<div<?php echo $dpp_proveedores->provee_dig->ViewAttributes() ?>><?php echo $dpp_proveedores->provee_dig->ViewValue ?></div>
</td>
	</tr>
	<tr class="ewTableAltRow">
		<td class="ewTableHeader">provee cat juri</td>
		<td<?php echo $dpp_proveedores->provee_cat_juri->CellAttributes() ?>>
<div<?php echo $dpp_proveedores->provee_cat_juri->ViewAttributes() ?>><?php echo $dpp_proveedores->provee_cat_juri->ViewValue ?></div>
</td>
	</tr>
	<tr class="ewTableRow">
		<td class="ewTableHeader">provee nombre</td>
		<td<?php echo $dpp_proveedores->provee_nombre->CellAttributes() ?>>
<div<?php echo $dpp_proveedores->provee_nombre->ViewAttributes() ?>><?php echo $dpp_proveedores->provee_nombre->ViewValue ?></div>
</td>
	</tr>
	<tr class="ewTableAltRow">
		<td class="ewTableHeader">provee paterno</td>
		<td<?php echo $dpp_proveedores->provee_paterno->CellAttributes() ?>>
<div<?php echo $dpp_proveedores->provee_paterno->ViewAttributes() ?>><?php echo $dpp_proveedores->provee_paterno->ViewValue ?></div>
</td>
	</tr>
	<tr class="ewTableRow">
		<td class="ewTableHeader">provee materno</td>
		<td<?php echo $dpp_proveedores->provee_materno->CellAttributes() ?>>
<div<?php echo $dpp_proveedores->provee_materno->ViewAttributes() ?>><?php echo $dpp_proveedores->provee_materno->ViewValue ?></div>
</td>
	</tr>
	<tr class="ewTableAltRow">
		<td class="ewTableHeader">provee dir</td>
		<td<?php echo $dpp_proveedores->provee_dir->CellAttributes() ?>>
<div<?php echo $dpp_proveedores->provee_dir->ViewAttributes() ?>><?php echo $dpp_proveedores->provee_dir->ViewValue ?></div>
</td>
	</tr>
	<tr class="ewTableRow">
		<td class="ewTableHeader">provee fono</td>
		<td<?php echo $dpp_proveedores->provee_fono->CellAttributes() ?>>
<div<?php echo $dpp_proveedores->provee_fono->ViewAttributes() ?>><?php echo $dpp_proveedores->provee_fono->ViewValue ?></div>
</td>
	</tr>
</table>
</form>
<p>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
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

// Page Load event
function Page_Load() {

	//echo "Page Load";
}

// Page Unload event
function Page_Unload() {

	//echo "Page Unload";
}
?>
