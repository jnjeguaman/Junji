<?php

// PHPMaker 5 configuration for Table dpp_proveedores
$dpp_proveedores = new cdpp_proveedores; // Initialize table object

// Define table class
class cdpp_proveedores {

	// Define table level constants
	var $TableVar;
	var $TableName;
	var $SelectLimit = FALSE;
	var $provee_id;
	var $provee_rut;
	var $provee_dig;
	var $provee_cat_juri;
	var $provee_nombre;
	var $provee_paterno;
	var $provee_materno;
	var $provee_dir;
	var $provee_fono;
	var $fields = array();

	function cdpp_proveedores() {
		$this->TableVar = "dpp_proveedores";
		$this->TableName = "dpp_proveedores";
		$this->SelectLimit = TRUE;
		$this->provee_id = new cField('dpp_proveedores', 'x_provee_id', 'provee_id', "`provee_id`", 3, -1, FALSE);
		$this->fields['provee_id'] =& $this->provee_id;
		$this->provee_rut = new cField('dpp_proveedores', 'x_provee_rut', 'provee_rut', "`provee_rut`", 3, -1, FALSE);
		$this->fields['provee_rut'] =& $this->provee_rut;
		$this->provee_dig = new cField('dpp_proveedores', 'x_provee_dig', 'provee_dig', "`provee_dig`", 200, -1, FALSE);
		$this->fields['provee_dig'] =& $this->provee_dig;
		$this->provee_cat_juri = new cField('dpp_proveedores', 'x_provee_cat_juri', 'provee_cat_juri', "`provee_cat_juri`", 200, -1, FALSE);
		$this->fields['provee_cat_juri'] =& $this->provee_cat_juri;
		$this->provee_nombre = new cField('dpp_proveedores', 'x_provee_nombre', 'provee_nombre', "`provee_nombre`", 200, -1, FALSE);
		$this->fields['provee_nombre'] =& $this->provee_nombre;
		$this->provee_paterno = new cField('dpp_proveedores', 'x_provee_paterno', 'provee_paterno', "`provee_paterno`", 200, -1, FALSE);
		$this->fields['provee_paterno'] =& $this->provee_paterno;
		$this->provee_materno = new cField('dpp_proveedores', 'x_provee_materno', 'provee_materno', "`provee_materno`", 200, -1, FALSE);
		$this->fields['provee_materno'] =& $this->provee_materno;
		$this->provee_dir = new cField('dpp_proveedores', 'x_provee_dir', 'provee_dir', "`provee_dir`", 200, -1, FALSE);
		$this->fields['provee_dir'] =& $this->provee_dir;
		$this->provee_fono = new cField('dpp_proveedores', 'x_provee_fono', 'provee_fono', "`provee_fono`", 200, -1, FALSE);
		$this->fields['provee_fono'] =& $this->provee_fono;
	}

	// Records per page
	function getRecordsPerPage() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_REC_PER_PAGE];
	}

	function setRecordsPerPage($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_REC_PER_PAGE] = $v;
	}

	// Start record number
	function getStartRecordNumber() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_START_REC];
	}

	function setStartRecordNumber($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_START_REC] = $v;
	}

	// Advanced search
	function getAdvancedSearch($fld) {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ADVANCED_SEARCH . "_" . $fld];
	}

	function setAdvancedSearch($fld, $v) {
		if (@$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ADVANCED_SEARCH . "_" . $fld] <> $v) {
			$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ADVANCED_SEARCH . "_" . $fld] = $v;
		}
	}

	// Basic search Keyword
	function getBasicSearchKeyword() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_BASIC_SEARCH];
	}

	function setBasicSearchKeyword($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_BASIC_SEARCH] = $v;
	}

	// Basic Search Type
	function getBasicSearchType() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_BASIC_SEARCH_TYPE];
	}

	function setBasicSearchType($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_BASIC_SEARCH_TYPE] = $v;
	}

	// Search where clause
	function getSearchWhere() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_SEARCH_WHERE];
	}

	function setSearchWhere($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_SEARCH_WHERE] = $v;
	}

	// Single column sort
	function UpdateSort(&$ofld) {
		if ($this->CurrentOrder == $ofld->FldName) {
			$sSortField = $ofld->FldExpression;
			$sLastSort = $ofld->getSort();
			if ($this->CurrentOrderType == "ASC" || $this->CurrentOrderType == "DESC") {
				$sThisSort = $this->CurrentOrderType;
			} else {
				$sThisSort = ($sLastSort == "ASC") ? "DESC" : "ASC";
			}
			$ofld->setSort($sThisSort);
			$this->setSessionOrderBy($sSortField . " " . $sThisSort); // Save to Session
		} else {
			$ofld->setSort("");
		}
	}

	// Session WHERE Clause
	function getSessionWhere() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_WHERE];
	}

	function setSessionWhere($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_WHERE] = $v;
	}

	// Session ORDER BY
	function getSessionOrderBy() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ORDER_BY];
	}

	function setSessionOrderBy($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ORDER_BY] = $v;
	}

	// Session Key
	function getKey($fld) {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_KEY . "_" . $fld];
	}

	function setKey($fld, $v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_KEY . "_" . $fld] = $v;
	}

	// Table level SQL
	function SqlSelect() { // Select
		return "SELECT * FROM `dpp_proveedores`";
	}

	function SqlWhere() { // Where
		return "";
	}

	function SqlGroupBy() { // Group By
		return "";
	}

	function SqlHaving() { // Having
		return "";
	}

	function SqlOrderBy() { // Order By
		return "";
	}

	// SQL variables
	var $CurrentFilter; // Current filter
	var $CurrentOrder; // Current order
	var $CurrentOrderType; // Current order type

	// Report table sql
	function SQL() {
		$sFilter = $this->CurrentFilter;
		$sSort = $this->getSessionOrderBy();
		return ew_BuildSql($this->SqlSelect(), $this->SqlWhere(),
			$this->SqlGroupBy(), $this->SqlHaving(), $this->SqlOrderBy(),
			$sFilter, $sSort);
	}

	// Return table sql with list page filter
	function SelectSQL() {
		$sFilter = $this->getSessionWhere();
		if ($this->CurrentFilter <> "") {
			if ($sFilter <> "") $sFilter .= " AND ";
			$sFilter .= $this->CurrentFilter;
		}
		$sSort = $this->getSessionOrderBy();
		return ew_BuildSql($this->SqlSelect(), $this->SqlWhere(),
			$this->SqlGroupBy(), $this->SqlHaving(), $this->SqlOrderBy(),
			$sFilter, $sSort);
	}

	// Return record count
	function SelectRecordCount() {
		global $conn;
		$cnt = -1;
		if ($this->SelectLimit) {
			$sSelect = $this->SelectSQL();
			if (strtoupper(substr($sSelect, 0, 13)) == "SELECT * FROM") {
				$sSelect = "SELECT COUNT(*) FROM" . substr($sSelect, 13);
				if ($rs = $conn->Execute($sSelect)) {
					if (!$rs->EOF) $cnt = $rs->fields[0];
					$rs->Close();
				}
			}
		}
		if ($cnt == -1) {
			if ($rs = $conn->Execute($this->SelectSQL())) {
				$cnt = $rs->RecordCount();
				$rs->Close();
			}
		}
		return intval($cnt);
	}

	// INSERT statement
	function InsertSQL(&$rs) {
		$names = "";
		$values = "";
		foreach ($rs as $name => $value) {
			$names .= $this->fields[$name]->FldExpression . ",";
			$values .= (is_null($value) ? "NULL" : ew_QuotedValue($value, $this->fields[$name]->FldDataType)) . ",";
		}
		if (substr($names, -1) == ",") $names = substr($names, 0, strlen($names)-1);
		if (substr($values, -1) == ",") $values = substr($values, 0, strlen($values)-1);
		return "INSERT INTO `dpp_proveedores` ($names) VALUES ($values)";
	}

	// UPDATE statement
	function UpdateSQL(&$rs) {
		$SQL = "UPDATE `dpp_proveedores` SET ";
		foreach ($rs as $name => $value) {
			$SQL .= $this->fields[$name]->FldExpression . "=" .
					(is_null($value) ? "NULL" : ew_QuotedValue($value, $this->fields[$name]->FldDataType)) . ",";
		}
		if (substr($SQL, -1) == ",") $SQL = substr($SQL, 0, strlen($SQL)-1);
		if ($this->CurrentFilter <> "")	$SQL .= " WHERE " . $this->CurrentFilter;
		return $SQL;
	}

	// DELETE statement
	function DeleteSQL(&$rs) {
		$SQL = "DELETE FROM `dpp_proveedores` WHERE ";
		$SQL .= EW_DB_QUOTE_START . 'provee_id' . EW_DB_QUOTE_END . '=' .	ew_QuotedValue($rs['provee_id'], $this->provee_id->FldDataType) . ' AND ';
		if (substr($SQL, -5) == " AND ") $SQL = substr($SQL, 0, strlen($SQL)-5);
		if ($this->CurrentFilter <> "")	$SQL .= " AND " . $this->CurrentFilter;
		return $SQL;
	}

	// Key filter for table
	function SqlKeyFilter() {
		return "`provee_id` = @provee_id@";
	}

	// Return url
	function getReturnUrl() {
		if (@$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] <> "") {
			return $_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL];
		} else {
			return "dpp_proveedoreslist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// View url
	function ViewUrl() {
		return $this->KeyUrl("dpp_proveedoresview.php");
	}

	// Edit url
	function EditUrl() {
		return $this->KeyUrl("dpp_proveedoresedit.php");
	}

	// Inline edit url
	function InlineEditUrl() {
		return $this->KeyUrl("dpp_proveedoreslist.php", "a=edit");
	}

	// Copy url
	function CopyUrl() {
		return $this->KeyUrl("dpp_proveedoresadd.php");
	}

	// Inline copy url
	function InlineCopyUrl() {
		return $this->KeyUrl("dpp_proveedoreslist.php", "a=copy");
	}

	// Delete url
	function DeleteUrl() {
		return $this->KeyUrl("dpp_proveedoresdelete.php");
	}

	// Key url
	function KeyUrl($url, $action = "") {
		$sUrl = $url . "?";
		if ($action <> "") $sUrl .= $action . "&";
		if (!is_null($this->provee_id->CurrentValue)) {
			$sUrl .= "provee_id=" . urlencode($this->provee_id->CurrentValue);
		} else {
			return "javascript:alert('Registro invalido! la llave es nula');";
		}
		return $sUrl;
	}

	// Function LoadRs
	// - Load Row based on Key Value
	function LoadRs($sFilter) {
		global $conn;

		// Set up filter (Sql Where Clause) and get Return Sql
		$this->CurrentFilter = $sFilter;
		$sSql = $this->SQL();
		return $conn->Execute($sSql);
	}

	// Load row values from rs
	function LoadListRowValues(&$rs) {
		$this->provee_id->setDbValue($rs->fields('provee_id'));
		$this->provee_rut->setDbValue($rs->fields('provee_rut'));
		$this->provee_dig->setDbValue($rs->fields('provee_dig'));
		$this->provee_cat_juri->setDbValue($rs->fields('provee_cat_juri'));
		$this->provee_nombre->setDbValue($rs->fields('provee_nombre'));
		$this->provee_paterno->setDbValue($rs->fields('provee_paterno'));
		$this->provee_materno->setDbValue($rs->fields('provee_materno'));
		$this->provee_dir->setDbValue($rs->fields('provee_dir'));
		$this->provee_fono->setDbValue($rs->fields('provee_fono'));
	}

	// Render list row values
	function RenderListRow() {
		global $conn, $Security;

		// provee_id
		$this->provee_id->ViewValue = $this->provee_id->CurrentValue;
		$this->provee_id->CssStyle = "";
		$this->provee_id->CssClass = "";
		$this->provee_id->ViewCustomAttributes = "";

		// provee_rut
		$this->provee_rut->ViewValue = $this->provee_rut->CurrentValue;
		$this->provee_rut->CssStyle = "";
		$this->provee_rut->CssClass = "";
		$this->provee_rut->ViewCustomAttributes = "";

		// provee_dig
		$this->provee_dig->ViewValue = $this->provee_dig->CurrentValue;
		$this->provee_dig->CssStyle = "";
		$this->provee_dig->CssClass = "";
		$this->provee_dig->ViewCustomAttributes = "";

		// provee_cat_juri
		if (!is_null($this->provee_cat_juri->CurrentValue)) {
			switch ($this->provee_cat_juri->CurrentValue) {
				case "Natural":
					$this->provee_cat_juri->ViewValue = "Natural";
					break;
				case "Juridica":
					$this->provee_cat_juri->ViewValue = "Juridica";
					break;
				default:
					$this->provee_cat_juri->ViewValue = $this->provee_cat_juri->CurrentValue;
			}
		} else {
			$this->provee_cat_juri->ViewValue = NULL;
		}
		$this->provee_cat_juri->CssStyle = "";
		$this->provee_cat_juri->CssClass = "";
		$this->provee_cat_juri->ViewCustomAttributes = "";

		// provee_nombre
		$this->provee_nombre->ViewValue = $this->provee_nombre->CurrentValue;
		$this->provee_nombre->CssStyle = "";
		$this->provee_nombre->CssClass = "";
		$this->provee_nombre->ViewCustomAttributes = "";

		// provee_paterno
		$this->provee_paterno->ViewValue = $this->provee_paterno->CurrentValue;
		$this->provee_paterno->CssStyle = "";
		$this->provee_paterno->CssClass = "";
		$this->provee_paterno->ViewCustomAttributes = "";

		// provee_materno
		$this->provee_materno->ViewValue = $this->provee_materno->CurrentValue;
		$this->provee_materno->CssStyle = "";
		$this->provee_materno->CssClass = "";
		$this->provee_materno->ViewCustomAttributes = "";

		// provee_dir
		$this->provee_dir->ViewValue = $this->provee_dir->CurrentValue;
		$this->provee_dir->CssStyle = "";
		$this->provee_dir->CssClass = "";
		$this->provee_dir->ViewCustomAttributes = "";

		// provee_fono
		$this->provee_fono->ViewValue = $this->provee_fono->CurrentValue;
		$this->provee_fono->CssStyle = "";
		$this->provee_fono->CssClass = "";
		$this->provee_fono->ViewCustomAttributes = "";

		// provee_id
		$this->provee_id->HrefValue = "";

		// provee_rut
		$this->provee_rut->HrefValue = "";

		// provee_dig
		$this->provee_dig->HrefValue = "";

		// provee_cat_juri
		$this->provee_cat_juri->HrefValue = "";

		// provee_nombre
		$this->provee_nombre->HrefValue = "";

		// provee_paterno
		$this->provee_paterno->HrefValue = "";

		// provee_materno
		$this->provee_materno->HrefValue = "";

		// provee_dir
		$this->provee_dir->HrefValue = "";

		// provee_fono
		$this->provee_fono->HrefValue = "";
	}
	var $CurrentAction; // Current action
	var $EventName; // Event name
	var $EventCancelled; // Event cancelled
	var $CancelMessage; // Cancel message
	var $RowType; // Row Type
	var $CssClass; // Css class
	var $CssStyle; // Css style
	var $RowClientEvents; // Row client events

	// Display Attribute
	function DisplayAttributes() {
		$sAtt = "";
		if (trim($this->CssStyle) <> "") {
			$sAtt .= " style=\"" . trim($this->CssStyle) . "\"";
		}
		if (trim($this->CssClass) <> "") {
			$sAtt .= " class=\"" . trim($this->CssClass) . "\"";
		}
		if ($this->Export == "") {
			if (trim($this->RowClientEvents) <> "") {
				$sAtt .= " " . $this->RowClientEvents;
			}
		}
		return $sAtt;
	}

	// Export
	var $Export;

//	 ----------------
//	  Field objects
//	 ----------------
	function fields($fldname) {
		return $this->fields[$fldname];
	}

	// Table level events
	// Recordset Selecting event
	function Recordset_Selecting(&$filter) {

		// Enter your code here	
	}

	// Recordset Selected event
	function Recordset_Selected(&$rs) {

		//echo "Recordset Selected";
	}

	// Row_Selecting event
	function Row_Selecting(&$filter) {

		// Enter your code here	
	}

	// Row Selected event
	function Row_Selected(&$rs) {

		//echo "Row Selected";
	}

	// Row Rendering event
	function Row_Rendering() {

		// Enter your code here	
	}

	// Row Rendered event
	function Row_Rendered() {

		// To view properties of field class, use:
		//var_dump($this-><FieldName>); 

	}

	// Row Inserting event
	function Row_Inserting(&$rs) {

		// Enter your code here
		// To cancel, set return value to False

		return TRUE;
	}

	// Row Inserted event
	function Row_Inserted(&$rs) {

		//echo "Row Inserted";
	}

	// Row Updating event
	function Row_Updating(&$rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to False

		return TRUE;
	}

	// Row Updated event
	function Row_Updated(&$rsold, &$rsnew) {

		//echo "Row Updated";
	}

	// Row Deleting event
	function Row_Deleting($rs) {

		// Enter your code here
		// To cancel, set return value to False

		return TRUE;
	}

	// Row Deleted event
	function Row_Deleted(&$rs) {

		//echo "Row Deleted";
	}
}
?>
