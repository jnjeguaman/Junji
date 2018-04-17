<?php
define("EW_PAGE_ID", "delete", TRUE); // Page ID
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

// Load Key Parameters
$sKey = "";
$bSingleDelete = TRUE; // Initialize as single delete
$arRecKeys = array();
$nKeySelected = 0; // Initialize selected key count
$sFilter = "";
if (@$_GET["provee_id"] <> "") {
	$dpp_proveedores->provee_id->setQueryStringValue($_GET["provee_id"]);
	if (!is_numeric($dpp_proveedores->provee_id->QueryStringValue)) {
		Page_Terminate($dpp_proveedores->getReturnUrl()); // Prevent sql injection, exit
	}
	$sKey .= $dpp_proveedores->provee_id->QueryStringValue;
} else {
	$bSingleDelete = FALSE;
}
if ($bSingleDelete) {
	$nKeySelected = 1; // Set up key selected count
	$arRecKeys[0] = $sKey;
} else {
	if (isset($_POST["key_m"])) { // Key in form
		$nKeySelected = count($_POST["key_m"]); // Set up key selected count
		$arRecKeys = ew_StripSlashes($_POST["key_m"]);
	}
}
if ($nKeySelected <= 0) Page_Terminate($dpp_proveedores->getReturnUrl()); // No key specified, exit

// Build filter
foreach ($arRecKeys as $sKey) {
	$sFilter .= "(";

	// Set up key field
	$sKeyFld = $sKey;
	if (!is_numeric($sKeyFld)) {
		Page_Terminate($dpp_proveedores->getReturnUrl()); // Prevent sql injection, exit
	}
	$sFilter .= "`provee_id`=" . ew_AdjustSql($sKeyFld) . " AND ";
	if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
}
if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

// Set up filter (Sql Where Clause) and get Return Sql
// Sql constructor in dpp_proveedores class, dpp_proveedoresinfo.php

$dpp_proveedores->CurrentFilter = $sFilter;

// Get action
if (@$_POST["a_delete"] <> "") {
	$dpp_proveedores->CurrentAction = $_POST["a_delete"];
} else {
	$dpp_proveedores->CurrentAction = "I"; // Display record
}
switch ($dpp_proveedores->CurrentAction) {
	case "D": // Delete
		$dpp_proveedores->SendEmail = TRUE; // Send email on delete success
		if (DeleteRows()) { // delete rows
			$_SESSION[EW_SESSION_MESSAGE] = "Borrado satisfactorio"; // Set up success message
			Page_Terminate($dpp_proveedores->getReturnUrl()); // Return to caller
		}
}

// Load records for display
$rs = LoadRecordset();
$nTotalRecs = $rs->RecordCount(); // Get record count
if ($nTotalRecs <= 0) { // No record found, exit
	$rs->Close();
	Page_Terminate($dpp_proveedores->getReturnUrl()); // Return to caller
}
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--
var EW_PAGE_ID = "delete"; // Page id

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<p><span class="phpmaker">Borrar desde TABLA: dpp proveedores<br><br><a href="<?php echo $dpp_proveedores->getReturnUrl() ?>">Volver atras</a></span></p>
<?php
if (@$_SESSION[EW_SESSION_MESSAGE] <> "") {
?>
<p><span class="ewmsg"><?php echo $_SESSION[EW_SESSION_MESSAGE] ?></span></p>
<?php
	$_SESSION[EW_SESSION_MESSAGE] = ""; // Clear message
}
?>
<form action="dpp_proveedoresdelete.php" method="post">
<p>
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($arRecKeys as $sKey) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($sKey) ?>">
<?php } ?>
<table class="ewTable">
	<tr class="ewTableHeader">
		<td valign="top">provee id</td>
		<td valign="top">provee rut</td>
		<td valign="top">provee dig</td>
		<td valign="top">provee cat juri</td>
		<td valign="top">provee nombre</td>
		<td valign="top">provee paterno</td>
		<td valign="top">provee materno</td>
		<td valign="top">provee dir</td>
		<td valign="top">provee fono</td>
	</tr>
<?php
$nRecCount = 0;
$i = 0;
while (!$rs->EOF) {
	$nRecCount++;

	// Set row class and style
	$dpp_proveedores->CssClass = "ewTableRow";
	$dpp_proveedores->CssStyle = "";

	// Display alternate color for rows
	if ($nRecCount % 2 <> 1) {
		$dpp_proveedores->CssClass = "ewTableAltRow";
	}

	// Get the field contents
	LoadRowValues($rs);

	// Render row value
	$dpp_proveedores->RowType = EW_ROWTYPE_VIEW; // view
	RenderRow();
?>
	<tr<?php echo $dpp_proveedores->DisplayAttributes() ?>>
		<td<?php echo $dpp_proveedores->provee_id->CellAttributes() ?>>
<div<?php echo $dpp_proveedores->provee_id->ViewAttributes() ?>><?php echo $dpp_proveedores->provee_id->ViewValue ?></div>
</td>
		<td<?php echo $dpp_proveedores->provee_rut->CellAttributes() ?>>
<div<?php echo $dpp_proveedores->provee_rut->ViewAttributes() ?>><?php echo $dpp_proveedores->provee_rut->ViewValue ?></div>
</td>
		<td<?php echo $dpp_proveedores->provee_dig->CellAttributes() ?>>
<div<?php echo $dpp_proveedores->provee_dig->ViewAttributes() ?>><?php echo $dpp_proveedores->provee_dig->ViewValue ?></div>
</td>
		<td<?php echo $dpp_proveedores->provee_cat_juri->CellAttributes() ?>>
<div<?php echo $dpp_proveedores->provee_cat_juri->ViewAttributes() ?>><?php echo $dpp_proveedores->provee_cat_juri->ViewValue ?></div>
</td>
		<td<?php echo $dpp_proveedores->provee_nombre->CellAttributes() ?>>
<div<?php echo $dpp_proveedores->provee_nombre->ViewAttributes() ?>><?php echo $dpp_proveedores->provee_nombre->ViewValue ?></div>
</td>
		<td<?php echo $dpp_proveedores->provee_paterno->CellAttributes() ?>>
<div<?php echo $dpp_proveedores->provee_paterno->ViewAttributes() ?>><?php echo $dpp_proveedores->provee_paterno->ViewValue ?></div>
</td>
		<td<?php echo $dpp_proveedores->provee_materno->CellAttributes() ?>>
<div<?php echo $dpp_proveedores->provee_materno->ViewAttributes() ?>><?php echo $dpp_proveedores->provee_materno->ViewValue ?></div>
</td>
		<td<?php echo $dpp_proveedores->provee_dir->CellAttributes() ?>>
<div<?php echo $dpp_proveedores->provee_dir->ViewAttributes() ?>><?php echo $dpp_proveedores->provee_dir->ViewValue ?></div>
</td>
		<td<?php echo $dpp_proveedores->provee_fono->CellAttributes() ?>>
<div<?php echo $dpp_proveedores->provee_fono->ViewAttributes() ?>><?php echo $dpp_proveedores->provee_fono->ViewValue ?></div>
</td>
	</tr>
<?php
	$rs->MoveNext();
}
$rs->Close();
?>
</table>
<p>
<input type="submit" name="Action" id="Action" value="Confirmacion de Borrado">
</form>
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

// ------------------------------------------------
//  Function DeleteRows
//  - Delete Records based on current filter
function DeleteRows() {
	global $conn, $Security, $dpp_proveedores;
	$DeleteRows = TRUE;
	$sWrkFilter = $dpp_proveedores->CurrentFilter;

	// Set up filter (Sql Where Clause) and get Return Sql
	// Sql constructor in dpp_proveedores class, dpp_proveedoresinfo.php

	$dpp_proveedores->CurrentFilter = $sWrkFilter;
	$sSql = $dpp_proveedores->SQL();
	$conn->raiseErrorFn = 'ew_ErrorFn';
	$rs = $conn->Execute($sSql);
	$conn->raiseErrorFn = '';
	if ($rs === FALSE) {
		return FALSE;
	} elseif ($rs->EOF) {
		$_SESSION[EW_SESSION_MESSAGE] = "No se encontraron registros"; // No record found
		$rs->Close();
		return FALSE;
	}
	$conn->BeginTrans();

	// Clone old rows
	$rsold = ($rs) ? $rs->GetRows() : array();
	if ($rs) $rs->Close();

	// Call row deleting event
	if ($DeleteRows) {
		foreach ($rsold as $row) {
			$DeleteRows = $dpp_proveedores->Row_Deleting($row);
			if (!$DeleteRows) break;
		}
	}
	if ($DeleteRows) {
		$sKey = "";
		foreach ($rsold as $row) {
			$sThisKey = "";
			if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
			$sThisKey .= $row['provee_id'];
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$DeleteRows = $conn->Execute($dpp_proveedores->DeleteSQL($row)); // Delete
			$conn->raiseErrorFn = '';
			if ($DeleteRows === FALSE)
				break;
			if ($sKey <> "") $sKey .= ", ";
			$sKey .= $sThisKey;
		}
	} else {

		// Set up error message
		if ($dpp_proveedores->CancelMessage <> "") {
			$_SESSION[EW_SESSION_MESSAGE] = $dpp_proveedores->CancelMessage;
			$dpp_proveedores->CancelMessage = "";
		} else {
			$_SESSION[EW_SESSION_MESSAGE] = "Borrar cancelado";
		}
	}
	if ($DeleteRows) {
		$conn->CommitTrans(); // Commit the changes
	} else {
		$conn->RollbackTrans(); // Rollback changes
	}

	// Call recordset deleted event
	if ($DeleteRows) {
		foreach ($rsold as $row) {
			$dpp_proveedores->Row_Deleted($row);
		}	
	}
	return $DeleteRows;
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
