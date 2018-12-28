<!doctype html>
<html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="refresh" content="3;url=application.php">
	<title>退货</title>
	</head>

	<body>
<?php
	$orderno = $_POST['OrderNo'];
	date_default_timezone_set('PRC');
	$date=date('Y.m.d'); 
	$year=date('Y');
	$month=date('m');
	$day=date('d');
	$hour=date('H');
	$minute=date('i');
	$second=date('s');
	
	/* 连接到数据库 */
	$servername = "localhost";
	$username = "root";
	$password = "root";
	$dbname = "book";
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	mysqli_set_charset($conn, 'utf8');
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
	
	$sql = "UPDATE orderall SET status = '1', returnTime = null WHERE OrderNo = '$orderno'";
	if (mysqli_query($conn, $sql))
	{
		echo '取消退货成功！3秒后自动返回前一页';
		echo "<br>";
	} else {
		echo "取消退货失败！". "<br>";
		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
	
	/* 断开连接 */
	mysqli_close($conn);
?>
	</body>
</html>