<?php
define("EW_PAGE_ID", "ewlookup", TRUE); // Page ID
?>
<?php 
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg50.php" ?>
<?php include "ewmysql50.php" ?>
<?php include "phpfn50.php" ?>
<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // Always modified
header("Cache-Control: private, no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); // HTTP/1.0
?>
<?php
$LnkFldType = 0;
$LnkCount = 0;
$qs = new cQueryString();
if ($qs->Count > 0) {
	$Sql = $qs->getValue("s");
	$Sql = TEAdecrypt($Sql, EW_RANDOM_KEY);
	$Value = $qs->getConvertedValue("q");
	$Value = ew_AdjustSql($Value);
	$LnkType = $qs->getValue("lt"); // Get link type
	if ($LnkType == "2") { // Auto fill
		$LnkCount = 1;
		$LnkFld = -1;
		$LnkDisp1 = 0;
		$LnkDisp2 = -1;
	} elseif ($LnkType == "1") { // Auto suggest
		$LnkCount = 2;
		$LnkFld = -1;
		$LnkDisp1 = 0;
		$LnkDisp2 = 1;
	} else {
		$LnkCount = $qs->getValue("lc"); // Link field count
		if (!is_numeric($LnkCount)) {
			exit();
		} elseif (intval($LnkCount) <= 0) {
			exit();
		}
		$LnkFld = 0; // Link field default = 0
		$LnkDisp1 = $qs->getConvertedValue("ld1"); // Link display field
		if (!is_numeric($LnkDisp1)) {
			exit();
		} elseif (intval($LnkDisp1) < -1 || intval($LnkDisp1) >= intval($LnkCount)) {
			exit();
		}
		$LnkDisp2 = $qs->getConvertedValue("ld2"); // Link display field 2
		if (!is_numeric($LnkDisp2)) {
			exit();
		} elseif (intval($LnkDisp2) < -1 || intval($LnkDisp2) >= intval($LnkCount)) {
			exit();
		}
		$LnkFldType = $qs->getConvertedValue("lft"); // Link field data type
	}
	if ($Sql <> "") {
		if ($Value <> "") {
			$arValue = explode(",", $Value);
			for ($i = 0; $i < count($arValue); $i++) {
				$arValue[$i] = ew_QuotedValue($arValue[$i], $LnkFldType);
			}
			$Sql = str_replace("@FILTER_VALUE", implode(",", $arValue), $Sql);
		}
		GetLookupValues($Sql);
	}
}

function GetLookupValues($Sql) {
	global $LnkType, $LnkFld, $LnkCount, $LnkDisp1, $LnkDisp2;
	$conn = ew_Connect();
	if ($rs = $conn->Execute($Sql)) {
		$rsarr = $rs->GetRows();
		$rs->Close();
	}
	$conn->Close();

	// Output
	if (is_array($rsarr) && count($rsarr) > 0) {
		if ($LnkType == "2") { // Auto fill
			$i = 0;
			while ($i < count($rsarr[0])-1) {
				$str = $rsarr[0][$i];
				$str = ew_RemoveCrLf($str);
				if (strval($rsarr[0][$i+1]) <> "") {
					$str .= ", " . ew_RemoveCrLf(strval($rsarr[0][$i+1]));
				}
				echo ew_ConvertToUtf8($str) . "\r";
				$i += 2;
			}
		} else {
			$rsarrcnt = count($rsarr);
			for ($i = 0; $i < $rsarrcnt; $i++) {
				if (intval(count($rsarr[$i])/2) == intval($LnkCount)) {

					// Process link field
					if ($LnkType <> "1") {
						$str = $rsarr[$i][$LnkFld];
						$str = ew_RemoveCrLf($str);
						echo ew_ConvertToUtf8($str) . "\r";
					}

					// Process display field
					if (intval($LnkDisp1) >= 0) {
						$str = $rsarr[$i][$LnkDisp1];
						$str = ew_RemoveCrLf($str);
					} else {
						$str = "";
					}
					echo ew_ConvertToUtf8($str) . "\r";

					// Process display field 2
					if (intval($LnkDisp2) >= 0) {
						$str = $rsarr[$i][$LnkDisp2];
						$str = ew_RemoveCrLf($str);
					} else {
						$str = "";
					}
					echo ew_ConvertToUtf8($str) . "\r";
				}
			}
		}
	}
}
?>
