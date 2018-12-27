<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="refresh" content="3;url=displayAllUser.php">
<title>修改用户信息</title>
</head>
	
<body>
	
<?php
	$userno = $_POST['UserNo'];
	$name = $_POST['Name'];
	$tel = $_POST['Tel'];
	$address1 = $_POST['Address1'];
	$address2 = $_POST['Address2'];
	$address3 = $_POST['Address3'];
	
	$servername = "localhost";
	$username = "root";
	$password = "root";
	$dbname = "book";

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

	/* 更新用户信息 */
	$conn;
	$fieldName;
	function fieldName($field){
		global $fieldName;
		if($field == "UserName"){
			$fieldName = "姓名";}
		else if($field == "Tel"){
			$fieldName = "电话";}
		else if($field == "Address1"){
			$fieldName = "地址1";}
		else if($field == "Address2"){
			$fieldName = "地址2";}
		else{
			$fieldName = "地址3";}
		return $fieldName;
	}
	function update($field,$newinfo,$userno){
		global $conn;
		global $fieldName;
		if($newinfo != NULL){
			$sql = "UPDATE userinfo SET $field = '$newinfo' WHERE UserNo = '$userno'";
			fieldName($field);
			if (mysqli_query($conn, $sql))
			{
				echo $fieldName.'修改成功！';
				echo "<br>";
			} else {
				echo "修改失败！". "<br>";
				echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			}
		}
	}
	
	update("UserName","$name","$userno");
	update("Tel","$tel","$userno");
	update("Address1","$address1","$userno");
	update("Address2","$address2","$userno");
	update("Address3","$address3","$userno");

	/* 关闭连接 */
	mysqli_close($conn);
?>
</body>
</html>