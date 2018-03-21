<?php 
require_once("class.email.php");
$objEmail = new Email();
?>
<!DOCTYPE html>
<html>
<head>
	<title>EMAIL</title>
</head>
<body>
<pre><?php print_r($objEmail->get()) ?></pre>
</body>
</html>