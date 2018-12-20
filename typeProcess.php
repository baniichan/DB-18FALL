<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>无标题文档</title>
	</head>

<body>
	<?php
	session_start();
	$_SESSION['query']=$_GET['type'];
	header('Location: type.php');
?>
	</body>
</html>