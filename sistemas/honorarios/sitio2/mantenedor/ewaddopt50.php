<?php
define("EW_PAGE_ID", "ewaddopt", TRUE); // Page ID
?>
<?php 
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg50.php" ?>
<?php include "ewmysql50.php" ?>
<?php include "phpfn50.php" ?>
<?php
$bError = FALSE;
$qs = new cQueryString();
if ($qs->Count > 0) {
	$LookupTableName = $qs->getConvertedValue("ltn");
	$LinkFieldName = $qs->getConvertedValue("lfn");
	$DisplayFieldName = $qs->getConvertedValue("dfn");
	$DisplayField2Name = $qs->getConvertedValue("df2n");
	$ParentFieldName = $qs->getConvertedValue("pfn");
	$LinkField = $qs->getConvertedValue("lf");
	if ($DisplayFieldName == $LinkFieldName) {
		$DisplayField = $LinkField;
	} else {
		$DisplayField = $qs->getConvertedValue("df");
	}
	if ($DisplayField2Name == $LinkFieldName) {
		$DisplayField2 = $LinkField;
	} elseif ($DisplayField2Name == $DisplayFieldName) {
		$DisplayField2 = $DisplayField;
	} else {
		$DisplayField2 = $qs->getConvertedValue("df2");
	}
	$ParentField = $qs->getConvertedValue("pf");
	$LinkFieldQuote = str_replace("\'", "'", $qs->getConvertedValue("lfq"));
	$DisplayFieldQuote = str_replace("\'", "'", $qs->getConvertedValue("dfq"));
	$DisplayField2Quote = str_replace("\'", "'", $qs->getConvertedValue("df2q"));
	$ParentFieldQuote = str_replace("\'", "'", $qs->getConvertedValue("pfq"));
} else {
	ob_end_clean();
	echo "Parametro invalido";
	exit();
}
if ($LookupTableName == "") {
	ob_end_clean();
	echo "Falta el nombre de la tabla de busqueda";
	exit();
}
if ($DisplayFieldName == "") {
	ob_end_clean();
	echo "Falta exhibicion del nombre del campo";
	exit();
}
$bUseParentField = ($ParentFieldName <> "" && $ParentField <> "");
$bUseLinkField = ($LinkFieldName <> "" && $LinkField <> "");
$bUseDisplayField = ($DisplayFieldName <> "" && $DisplayFieldName <> $LinkFieldName);
if ($bUseDisplayField) {
	if ($bUseParentField && $ParentFieldName == $DisplayFieldName) {
		$DisplayField = $ParentField;
	}
	$bUseDisplayField = ($DisplayField <> "");
}
$bUseDisplayField2 = ($DisplayField2Name <> "" && $DisplayField2Name <> $LinkFieldName && $DisplayField2Name <> $DisplayFieldName);
if ($bUseDisplayField2) {
	if ($bUseParentField && $ParentFieldName == $DisplayField2Name) {
		$DisplayField2 = $ParentField;
	}
	$bUseDisplayField2 = ($DisplayField2 <> "");
}
$sSql = "";
if ($bUseLinkField) {
	$sSql .= EW_DB_QUOTE_START . $LinkFieldName . EW_DB_QUOTE_END;
}
if ($bUseDisplayField) {
	if ($sSql <> "") $sSql .= ", ";
	$sSql .= EW_DB_QUOTE_START . $DisplayFieldName . EW_DB_QUOTE_END;
}
if ($bUseDisplayField2) {
	if ($sSql <> "") $sSql .= ", ";
	$sSql .= EW_DB_QUOTE_START . $DisplayField2Name . EW_DB_QUOTE_END;
}
$sSql = "SELECT DISTINCT " . $sSql . " FROM " . EW_DB_QUOTE_START . $LookupTableName . EW_DB_QUOTE_END;
$Where = "";
if ($bUseLinkField) {
	$Where = EW_DB_QUOTE_START . $LinkFieldName . EW_DB_QUOTE_END . "=" . $LinkFieldQuote . ew_AdjustSql($LinkField) . $LinkFieldQuote;
}
if ($bUseDisplayField) {
	if ($Where <> "") $Where .= " AND ";
	$Where .= EW_DB_QUOTE_START . $DisplayFieldName . EW_DB_QUOTE_END . "=" . $DisplayFieldQuote . ew_AdjustSql($DisplayField) . $DisplayFieldQuote;
}
if ($bUseDisplayField2) {
	if ($Where <> "") $Where .= " AND ";
	$Where .= EW_DB_QUOTE_START . $DisplayField2Name . EW_DB_QUOTE_END . "=" . $DisplayField2Quote . ew_AdjustSql($DisplayField2) . $DisplayField2Quote;
}
$sSql .= " WHERE " . $Where;
$conn = ew_Connect();
$rs = $conn->Execute($sSql);
if ($rs === FALSE) {
	ob_end_clean();
	echo $conn->ErrorMsg();
	exit();
}
if ($rs->EOF) { // Add new option
	$rs->Close();
	$FieldList = "";
	$ValueList = "";
	if ($bUseParentField) {
		if ($FieldList <> "") $FieldList .= ",";
		$FieldList .= EW_DB_QUOTE_START . $ParentFieldName . EW_DB_QUOTE_END;
		if ($ValueList <> "") $ValueList .= ",";
		$tmpValue = ew_AdjustSql($ParentField);
		$tmpValue = ($tmpValue != "") ? $ParentFieldQuote . $tmpValue . $ParentFieldQuote : "NULL";
		$ValueList .= $tmpValue;
	}
	if ($bUseLinkField) {
		if ($FieldList <> "") $FieldList .= ",";
		$FieldList .= EW_DB_QUOTE_START . $LinkFieldName . EW_DB_QUOTE_END;
		if ($ValueList <> "") $ValueList .= ",";
		$tmpValue = ew_AdjustSql($LinkField); 
		$tmpValue = ($tmpValue != "") ? $LinkFieldQuote . $tmpValue . $LinkFieldQuote : "NULL";
		$ValueList .= $tmpValue;
	}
	if ($bUseDisplayField) {
		if ($FieldList <> "") $FieldList .= ",";
		$FieldList .= EW_DB_QUOTE_START . $DisplayFieldName . EW_DB_QUOTE_END;
		if ($ValueList <> "") $ValueList .= ",";
		$tmpValue = ew_AdjustSql($DisplayField); 
		$tmpValue = ($tmpValue != "") ? $DisplayFieldQuote . $tmpValue . $DisplayFieldQuote : "NULL";
		$ValueList .= $tmpValue;
	}
	if ($bUseDisplayField2) {
		if ($FieldList <> "") $FieldList .= ",";
		$FieldList .= EW_DB_QUOTE_START . $DisplayField2Name . EW_DB_QUOTE_END;
		if ($ValueList <> "") $ValueList .= ",";
		$tmpValue = ew_AdjustSql($DisplayField2);
		$tmpValue = ($tmpValue != "") ? $DisplayField2Quote . $tmpValue . $DisplayField2Quote : "NULL";
		$ValueList .=  $tmpValue;
	}
	$res = $conn->Execute("INSERT INTO " . EW_DB_QUOTE_START . $LookupTableName . EW_DB_QUOTE_END . " (" . $FieldList . ") VALUES (" . $ValueList . ")");
	if ($res === FALSE) {
		ob_end_clean();
		echo $conn->ErrorMsg();
		exit();
	}
} else {
	$rs->Close();
	ob_end_clean();
	echo "La opcion ya existe";
	exit();
}
if ($LinkField == "") { // Get new link field value
	$sSql = "SELECT " . EW_DB_QUOTE_START . $LinkFieldName . EW_DB_QUOTE_END . " FROM " . EW_DB_QUOTE_START . $LookupTableName . EW_DB_QUOTE_END . " WHERE " . $Where;
	if ($rs = $conn->Execute($sSql)) {
		if (!$rs->EOF) {
			$LinkField = $rs->fields[0];
			if ($DisplayFieldName == $LinkFieldName) $DisplayField = $LinkField;
			if ($DisplayField2Name == $LinkFieldName) $DisplayField2 = $LinkField;
		}
		$rs->Close();
	}
}
$conn->Close();
ob_end_clean();
echo "OK\r";
echo ew_ConvertToUtf8($LinkField) . "\r";
echo ew_ConvertToUtf8($DisplayField) . "\r";
echo ew_ConvertToUtf8($DisplayField2);
exit();
?>
