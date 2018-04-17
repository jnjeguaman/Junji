<?php
define("EW_PAGE_ID", "edit", TRUE); // Page ID
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

// Load key from QueryString
if (@$_GET["provee_id"] <> "") {
	$dpp_proveedores->provee_id->setQueryStringValue($_GET["provee_id"]);
}

// Create form object
$objForm = new cFormObj();
if (@$_POST["a_edit"] <> "") {
	$dpp_proveedores->CurrentAction = $_POST["a_edit"]; // Get action code
	LoadFormValues(); // Get form values
} else {
	$dpp_proveedores->CurrentAction = "I"; // Default action is display
}

// Check if valid key
if ($dpp_proveedores->provee_id->CurrentValue == "") Page_Terminate($dpp_proveedores->getReturnUrl()); // Invalid key, exit
switch ($dpp_proveedores->CurrentAction) {
	case "I": // Get a record to display
		if (!LoadRow()) { // Load Record based on key
			$_SESSION[EW_SESSION_MESSAGE] = "No se encontraron registros"; // No record found
			Page_Terminate($dpp_proveedores->getReturnUrl()); // Return to caller
		}
		break;
	Case "U": // Update
		$dpp_proveedores->SendEmail = TRUE; // Send email on update success
		if (EditRow()) { // Update Record based on key
			$_SESSION[EW_SESSION_MESSAGE] = "Actualizacion satisfactoria"; // Update success
			Page_Terminate($dpp_proveedores->getReturnUrl()); // Return to caller
		} else {
			RestoreFormValues(); // Restore form values if update failed
		}
}

// Render the record
$dpp_proveedores->RowType = EW_ROWTYPE_EDIT; // Render as edit
RenderRow();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--
var EW_PAGE_ID = "edit"; // Page id

//-->
</script>
<script type="text/javascript">
<!--

function ew_ValidateForm(fobj) {
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_provee_rut"];
		if (elm && !ew_HasValue(elm)) {
			if (!ew_OnError(elm, "Porfavor ingrese el campo requerido - provee rut"))
				return false;
		}
		elm = fobj.elements["x" + infix + "_provee_rut"];
		if (elm && !ew_CheckInteger(elm.value)) {
			if (!ew_OnError(elm, "Numero entero incorrecto - provee rut"))
				return false; 
		}
		elm = fobj.elements["x" + infix + "_provee_dig"];
		if (elm && !ew_HasValue(elm)) {
			if (!ew_OnError(elm, "Porfavor ingrese el campo requerido - provee dig"))
				return false;
		}
		elm = fobj.elements["x" + infix + "_provee_cat_juri"];
		if (elm && !ew_HasValue(elm)) {
			if (!ew_OnError(elm, "Porfavor ingrese el campo requerido - provee cat juri"))
				return false;
		}
		elm = fobj.elements["x" + infix + "_provee_nombre"];
		if (elm && !ew_HasValue(elm)) {
			if (!ew_OnError(elm, "Porfavor ingrese el campo requerido - provee nombre"))
				return false;
		}
		elm = fobj.elements["x" + infix + "_provee_paterno"];
		if (elm && !ew_HasValue(elm)) {
			if (!ew_OnError(elm, "Porfavor ingrese el campo requerido - provee paterno"))
				return false;
		}
		elm = fobj.elements["x" + infix + "_provee_materno"];
		if (elm && !ew_HasValue(elm)) {
			if (!ew_OnError(elm, "Porfavor ingrese el campo requerido - provee materno"))
				return false;
		}
	}
	return true;
}

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
<script type="text/javascript">
<!--
var ew_MultiPagePage = "Pagina"; // multi-page Page Text
var ew_MultiPageOf = "de"; // multi-page Of Text
var ew_MultiPagePrev = "Anterior"; // multi-page Prev Text
var ew_MultiPageNext = "Proximo"; // multi-page Next Text

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<p><span class="phpmaker">Editar TABLA: dpp proveedores<br><br><a href="<?php echo $dpp_proveedores->getReturnUrl() ?>">Volver atras</a></span></p>
<?php
if (@$_SESSION[EW_SESSION_MESSAGE] <> "") {
?>
<p><span class="ewmsg"><?php echo $_SESSION[EW_SESSION_MESSAGE] ?></span></p>
<?php
	$_SESSION[EW_SESSION_MESSAGE] = ""; // Clear message
}
?>
<form name="fdpp_proveedoresedit" id="fdpp_proveedoresedit" action="dpp_proveedoresedit.php" method="post" onSubmit="return ew_ValidateForm(this);">
<p>
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table class="ewTable">
	<tr class="ewTableRow">
		<td class="ewTableHeader">provee id</td>
		<td<?php echo $dpp_proveedores->provee_id->CellAttributes() ?>><span id="cb_x_provee_id">
<div<?php echo $dpp_proveedores->provee_id->ViewAttributes() ?>><?php echo $dpp_proveedores->provee_id->EditValue ?></div>
<input type="hidden" name="x_provee_id" id="x_provee_id" value="<?php echo ew_HtmlEncode($dpp_proveedores->provee_id->CurrentValue) ?>">
</span></td>
	</tr>
	<tr class="ewTableAltRow">
		<td class="ewTableHeader">provee rut<span class='ewmsg'>&nbsp;*</span></td>
		<td<?php echo $dpp_proveedores->provee_rut->CellAttributes() ?>><span id="cb_x_provee_rut">
<input type="text" name="x_provee_rut" id="x_provee_rut" title="" size="30" value="<?php echo $dpp_proveedores->provee_rut->EditValue ?>"<?php echo $dpp_proveedores->provee_rut->EditAttributes() ?>>
</span></td>
	</tr>
	<tr class="ewTableRow">
		<td class="ewTableHeader">provee dig<span class='ewmsg'>&nbsp;*</span></td>
		<td<?php echo $dpp_proveedores->provee_dig->CellAttributes() ?>><span id="cb_x_provee_dig">
<input type="text" name="x_provee_dig" id="x_provee_dig" title="" size="30" maxlength="3" value="<?php echo $dpp_proveedores->provee_dig->EditValue ?>"<?php echo $dpp_proveedores->provee_dig->EditAttributes() ?>>
</span></td>
	</tr>
	<tr class="ewTableAltRow">
		<td class="ewTableHeader">provee cat juri<span class='ewmsg'>&nbsp;*</span></td>
		<td<?php echo $dpp_proveedores->provee_cat_juri->CellAttributes() ?>><span id="cb_x_provee_cat_juri">
<?php
$arwrk = $dpp_proveedores->provee_cat_juri->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($dpp_proveedores->provee_cat_juri->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " checked" : "";
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<input type="radio" name="x_provee_cat_juri" id="x_provee_cat_juri" title="" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $dpp_proveedores->provee_cat_juri->EditAttributes() ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
?>
</span></td>
	</tr>
	<tr class="ewTableRow">
		<td class="ewTableHeader">provee nombre<span class='ewmsg'>&nbsp;*</span></td>
		<td<?php echo $dpp_proveedores->provee_nombre->CellAttributes() ?>><span id="cb_x_provee_nombre">
<input type="text" name="x_provee_nombre" id="x_provee_nombre" title="" size="30" maxlength="40" value="<?php echo $dpp_proveedores->provee_nombre->EditValue ?>"<?php echo $dpp_proveedores->provee_nombre->EditAttributes() ?>>
</span></td>
	</tr>
	<tr class="ewTableAltRow">
		<td class="ewTableHeader">provee paterno<span class='ewmsg'>&nbsp;*</span></td>
		<td<?php echo $dpp_proveedores->provee_paterno->CellAttributes() ?>><span id="cb_x_provee_paterno">
<input type="text" name="x_provee_paterno" id="x_provee_paterno" title="" size="30" maxlength="40" value="<?php echo $dpp_proveedores->provee_paterno->EditValue ?>"<?php echo $dpp_proveedores->provee_paterno->EditAttributes() ?>>
</span></td>
	</tr>
	<tr class="ewTableRow">
		<td class="ewTableHeader">provee materno<span class='ewmsg'>&nbsp;*</span></td>
		<td<?php echo $dpp_proveedores->provee_materno->CellAttributes() ?>><span id="cb_x_provee_materno">
<input type="text" name="x_provee_materno" id="x_provee_materno" title="" size="30" maxlength="40" value="<?php echo $dpp_proveedores->provee_materno->EditValue ?>"<?php echo $dpp_proveedores->provee_materno->EditAttributes() ?>>
</span></td>
	</tr>
	<tr class="ewTableAltRow">
		<td class="ewTableHeader">provee dir<span class='ewmsg'>&nbsp;*</span></td>
		<td<?php echo $dpp_proveedores->provee_dir->CellAttributes() ?>><span id="cb_x_provee_dir">
<input type="text" name="x_provee_dir" id="x_provee_dir" title="" size="30" maxlength="70" value="<?php echo $dpp_proveedores->provee_dir->EditValue ?>"<?php echo $dpp_proveedores->provee_dir->EditAttributes() ?>>
</span></td>
	</tr>
	<tr class="ewTableRow">
		<td class="ewTableHeader">provee fono<span class='ewmsg'>&nbsp;*</span></td>
		<td<?php echo $dpp_proveedores->provee_fono->CellAttributes() ?>><span id="cb_x_provee_fono">
<input type="text" name="x_provee_fono" id="x_provee_fono" title="" size="30" maxlength="50" value="<?php echo $dpp_proveedores->provee_fono->EditValue ?>"<?php echo $dpp_proveedores->provee_fono->EditAttributes() ?>>
</span></td>
	</tr>
</table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="  Editar  ">
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

// Load form values
function LoadFormValues() {

	// Load from form
	global $objForm, $dpp_proveedores;
	$dpp_proveedores->provee_id->setFormValue($objForm->GetValue("x_provee_id"));
	$dpp_proveedores->provee_rut->setFormValue($objForm->GetValue("x_provee_rut"));
	$dpp_proveedores->provee_dig->setFormValue($objForm->GetValue("x_provee_dig"));
	$dpp_proveedores->provee_cat_juri->setFormValue($objForm->GetValue("x_provee_cat_juri"));
	$dpp_proveedores->provee_nombre->setFormValue($objForm->GetValue("x_provee_nombre"));
	$dpp_proveedores->provee_paterno->setFormValue($objForm->GetValue("x_provee_paterno"));
	$dpp_proveedores->provee_materno->setFormValue($objForm->GetValue("x_provee_materno"));
	$dpp_proveedores->provee_dir->setFormValue($objForm->GetValue("x_provee_dir"));
	$dpp_proveedores->provee_fono->setFormValue($objForm->GetValue("x_provee_fono"));
}

// Restore form values
function RestoreFormValues() {
	global $dpp_proveedores;
	$dpp_proveedores->provee_id->CurrentValue = $dpp_proveedores->provee_id->FormValue;
	$dpp_proveedores->provee_rut->CurrentValue = $dpp_proveedores->provee_rut->FormValue;
	$dpp_proveedores->provee_dig->CurrentValue = $dpp_proveedores->provee_dig->FormValue;
	$dpp_proveedores->provee_cat_juri->CurrentValue = $dpp_proveedores->provee_cat_juri->FormValue;
	$dpp_proveedores->provee_nombre->CurrentValue = $dpp_proveedores->provee_nombre->FormValue;
	$dpp_proveedores->provee_paterno->CurrentValue = $dpp_proveedores->provee_paterno->FormValue;
	$dpp_proveedores->provee_materno->CurrentValue = $dpp_proveedores->provee_materno->FormValue;
	$dpp_proveedores->provee_dir->CurrentValue = $dpp_proveedores->provee_dir->FormValue;
	$dpp_proveedores->provee_fono->CurrentValue = $dpp_proveedores->provee_fono->FormValue;
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
	} elseif ($dpp_proveedores->RowType == EW_ROWTYPE_ADD) { // Add row
	} elseif ($dpp_proveedores->RowType == EW_ROWTYPE_EDIT) { // Edit row

		// provee_id
		$dpp_proveedores->provee_id->EditCustomAttributes = "";
		$dpp_proveedores->provee_id->EditValue = $dpp_proveedores->provee_id->CurrentValue;
		$dpp_proveedores->provee_id->CssStyle = "";
		$dpp_proveedores->provee_id->CssClass = "";
		$dpp_proveedores->provee_id->ViewCustomAttributes = "";

		// provee_rut
		$dpp_proveedores->provee_rut->EditCustomAttributes = "";
		$dpp_proveedores->provee_rut->EditValue = $dpp_proveedores->provee_rut->CurrentValue;

		// provee_dig
		$dpp_proveedores->provee_dig->EditCustomAttributes = "";
		$dpp_proveedores->provee_dig->EditValue = ew_HtmlEncode($dpp_proveedores->provee_dig->CurrentValue);

		// provee_cat_juri
		$dpp_proveedores->provee_cat_juri->EditCustomAttributes = "";
		$arwrk = array();
		$arwrk[] = array("Natural", "Natural");
		$arwrk[] = array("Juridica", "Juridica");
		$dpp_proveedores->provee_cat_juri->EditValue = $arwrk;

		// provee_nombre
		$dpp_proveedores->provee_nombre->EditCustomAttributes = "";
		$dpp_proveedores->provee_nombre->EditValue = ew_HtmlEncode($dpp_proveedores->provee_nombre->CurrentValue);

		// provee_paterno
		$dpp_proveedores->provee_paterno->EditCustomAttributes = "";
		$dpp_proveedores->provee_paterno->EditValue = ew_HtmlEncode($dpp_proveedores->provee_paterno->CurrentValue);

		// provee_materno
		$dpp_proveedores->provee_materno->EditCustomAttributes = "";
		$dpp_proveedores->provee_materno->EditValue = ew_HtmlEncode($dpp_proveedores->provee_materno->CurrentValue);

		// provee_dir
		$dpp_proveedores->provee_dir->EditCustomAttributes = "";
		$dpp_proveedores->provee_dir->EditValue = ew_HtmlEncode($dpp_proveedores->provee_dir->CurrentValue);

		// provee_fono
		$dpp_proveedores->provee_fono->EditCustomAttributes = "";
		$dpp_proveedores->provee_fono->EditValue = ew_HtmlEncode($dpp_proveedores->provee_fono->CurrentValue);
	} elseif ($dpp_proveedores->RowType == EW_ROWTYPE_SEARCH) { // Search row
	}

	// Call Row Rendered event
	$dpp_proveedores->Row_Rendered();
}
?>
<?php

// Update record based on key values
function EditRow() {
	global $conn, $Security, $dpp_proveedores;
	$sFilter = $dpp_proveedores->SqlKeyFilter();
	if (!is_numeric($dpp_proveedores->provee_id->CurrentValue)) {
		return FALSE;
	}
	$sFilter = str_replace("@provee_id@", ew_AdjustSql($dpp_proveedores->provee_id->CurrentValue), $sFilter); // Replace key value
	$dpp_proveedores->CurrentFilter = $sFilter;
	$sSql = $dpp_proveedores->SQL();
	$conn->raiseErrorFn = 'ew_ErrorFn';
	$rs = $conn->Execute($sSql);
	$conn->raiseErrorFn = '';
	if ($rs === FALSE)
		return FALSE;
	if ($rs->EOF) {
		$EditRow = FALSE; // Update Failed
	} else {

		// Save old values
		$rsold =& $rs->fields;
		$rsnew = array();

		// Field provee_id
		// Field provee_rut

		$dpp_proveedores->provee_rut->SetDbValueDef($dpp_proveedores->provee_rut->CurrentValue, 0);
		$rsnew['provee_rut'] =& $dpp_proveedores->provee_rut->DbValue;

		// Field provee_dig
		$dpp_proveedores->provee_dig->SetDbValueDef($dpp_proveedores->provee_dig->CurrentValue, "");
		$rsnew['provee_dig'] =& $dpp_proveedores->provee_dig->DbValue;

		// Field provee_cat_juri
		$dpp_proveedores->provee_cat_juri->SetDbValueDef($dpp_proveedores->provee_cat_juri->CurrentValue, "");
		$rsnew['provee_cat_juri'] =& $dpp_proveedores->provee_cat_juri->DbValue;

		// Field provee_nombre
		$dpp_proveedores->provee_nombre->SetDbValueDef($dpp_proveedores->provee_nombre->CurrentValue, "");
		$rsnew['provee_nombre'] =& $dpp_proveedores->provee_nombre->DbValue;

		// Field provee_paterno
		$dpp_proveedores->provee_paterno->SetDbValueDef($dpp_proveedores->provee_paterno->CurrentValue, "");
		$rsnew['provee_paterno'] =& $dpp_proveedores->provee_paterno->DbValue;

		// Field provee_materno
		$dpp_proveedores->provee_materno->SetDbValueDef($dpp_proveedores->provee_materno->CurrentValue, "");
		$rsnew['provee_materno'] =& $dpp_proveedores->provee_materno->DbValue;

		// Field provee_dir
		$dpp_proveedores->provee_dir->SetDbValueDef($dpp_proveedores->provee_dir->CurrentValue, "");
		$rsnew['provee_dir'] =& $dpp_proveedores->provee_dir->DbValue;

		// Field provee_fono
		$dpp_proveedores->provee_fono->SetDbValueDef($dpp_proveedores->provee_fono->CurrentValue, "");
		$rsnew['provee_fono'] =& $dpp_proveedores->provee_fono->DbValue;

		// Call Row Updating event
		$bUpdateRow = $dpp_proveedores->Row_Updating($rsold, $rsnew);
		if ($bUpdateRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$EditRow = $conn->Execute($dpp_proveedores->UpdateSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($dpp_proveedores->CancelMessage <> "") {
				$_SESSION[EW_SESSION_MESSAGE] = $dpp_proveedores->CancelMessage;
				$dpp_proveedores->CancelMessage = "";
			} else {
				$_SESSION[EW_SESSION_MESSAGE] = "Actualizacion cancelada";
			}
			$EditRow = FALSE;
		}
	}

	// Call Row Updated event
	if ($EditRow) {
		$dpp_proveedores->Row_Updated($rsold, $rsnew);
	}
	$rs->Close();
	return $EditRow;
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
