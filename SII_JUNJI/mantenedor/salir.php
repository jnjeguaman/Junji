<?php
session_start();
unset($_SESSION["sii"]);
echo "<script>location.replace('./');</script>";
?>