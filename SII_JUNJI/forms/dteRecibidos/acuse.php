<?php
extract($_GET);

if($action == 1)
{
	require_once("acuse_1.php");
}else if($action == 2)
{
	require_once("acuse_2.php");
}else if($action == 3){
	require_once("acuse_3.php");
}else{
	require_once("404.php");
}
?>