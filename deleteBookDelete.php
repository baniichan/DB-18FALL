<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="refresh" content="3;url=deleteBookShow"> 
<title>删除图书记录</title>
</head>

<body>
<?php
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
/*———————————————————————————————————————————————————————————————————*/
	$sql = "DELETE FROM bookinfo 
	WHERE ISBN=".$_POST["ISBN"]."
	";
	
	if (mysqli_query($conn, $sql)) {
    	echo "删除成功";
	} 
	else {
    	echo "Error creating database: " . mysqli_error($conn);
	};
	
	echo '<p>3秒后返回</p>';
/*———————————————————————————————————————————————————————————————————*/	
	// 关闭连接
	mysqli_close($conn); 
?>
</body>
</html>