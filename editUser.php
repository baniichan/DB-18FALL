<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>修改用户信息</title>
	<style>
		#info
		{
			width: 400px;
			height:700px;
			margin:10px;
			margin-top:100px;
			margin-left:200px;
			float:left;
			line-height:500%;
			overflow:auto;
		}
		#info p
		{
			width:400px;
			text-indent:35px;
			text-align:justify;
		}
		#edit
		{
			width:500px;
			float:right;
			line-height:400%;
			margin-top:90px;
		}
	</style>
</head>

<body>
<?php
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
	
	$userno = $_POST["UserNo"];

	$sql1 = "SELECT UserNo, UserName FROM account WHERE UserNo = $userno ORDER BY UserNo ASC";

	$result1 = mysqli_query($conn, $sql1);
	while ($row1 = mysqli_fetch_array($result1))  {
		echo "<div id='info'>";
		echo "用户编号:&nbsp;&nbsp;&nbsp;" . $row1['UserNo']."<br>";
		echo "用户名:&nbsp;&nbsp;&nbsp;" . $row1['UserName']."<br>";
		$result2 = mysqli_query($conn,"
				SELECT UserName, Tel, Address1, Address2, Address3 FROM userinfo WHERE UserNo = '$userno'");
			while ($row2 = mysqli_fetch_array($result2)){
			echo "姓名:&nbsp;&nbsp;&nbsp;" . $row2['UserName']."<br>";
			echo "电话:&nbsp;&nbsp;&nbsp;" . $row2['Tel']."<br>";
			echo "地址1:&nbsp;&nbsp;&nbsp;" . $row2['Address1']."<br>";
			echo "地址2:&nbsp;&nbsp;&nbsp;" . $row2['Address2']."<br>";
			echo "地址3:&nbsp;&nbsp;&nbsp;" . $row2['Address3']."<br>";
			}
		echo "</div>";
	}
	
?>
		<div id="edit">
			<h2>编辑用户信息</h2>
				<form action="editUser2.php" method="post">
					<p>姓名：&nbsp;&nbsp;
					<input name="Name" type="text" size="20" maxlength="10"></p>
					<p>电话：&nbsp;&nbsp;
					<input name="Tel" type="text" size="20" maxlength="11"></p>
					<p>地址1：
					<input name="Address1" type="text" size="50" maxlength="55"></p>
					<p>地址2：
					<input name="Address2" type="text" size="50" maxlength="55"></p>
					<p>地址3：
					<input name="Address3" type="text" size="50" maxlength="55"></p>
					<?php echo '<input name="UserNo" value=' . $userno . ' type="hidden">' ?>
					<p><input name="submit" type="submit" value="提交">&nbsp;&nbsp;&nbsp;
			  		 <input name="reset" type="reset" value="重置"></p>
				</form>
		</div>
	</body>
</html>