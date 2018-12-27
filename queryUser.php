<!DOCTYPE html> 
<html>
	<head>
		<meta charset="utf-8">
		<title>查询用户信息</title>
		<style>
			#table
			{
				margin:auto;
				width:90%;
				border-collapse:collapse;
			}
			#table tr.firstrow
			{
				font-weight:bold;
			}
			#table td
			{
				border: 1px solid DarkGray;
				padding-left:10px;
				padding-top:10px;
				padding-bottom:10px;
				padding-right:5px;
			}
			a:link {color:mediumblue;}      
			a:visited {color:mediumblue;} 
			a:hover {color:darkblue;}
			a:active {color:darkblue;}
		</style>
	</head> 
	<body>
		<table id = "table">
		<caption><h2>用户信息</h2></caption>
			<tr class="firstrow">
				<td style="width:6%">用户编号</td>
				<td style="width:6%">用户名</td>
				<td style="width:6%">姓名</td>
				<td style="width:6%">电话</td>
				<td colspan="3" style="text-align:center;width:50%">地址</td>
				<td style="width:3%">编辑</td>
		</tr>

<?php
	$query = $_POST["UserName"];
	
	$servername = "localhost";
	$username = "root";
	$password = "root";
	$dbname = "book";
	// 创建连接
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	// 设定字符集
	mysqli_set_charset($conn, 'utf8');
	// 检测连接
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());}
/*———————————————————————————————————————————————————————————————————*/
	$result = mysqli_query($conn,"
		SELECT UserNo, UserName FROM account 
		WHERE UserName Like '%$query%'
	");
	// 显示结果
	while ($row = mysqli_fetch_array($result)) {
		echo '<tr>';
			echo '<td>' . $row['UserNo'] . '</td>';
			$_userno = $row['UserNo'];
			echo '<td>' . $row['UserName'] . '</td>';
			$result2 = mysqli_query($conn,"
				SELECT UserName, Tel, Address1, Address2, Address3 FROM userinfo WHERE UserNo = '$_userno'");
			while ($row2 = mysqli_fetch_array($result2)){
				echo '<td>' . $row2['UserName'] . '</td>';
				echo '<td>' . $row2['Tel'] . '</td>';
				echo '<td>' . $row2['Address1'] . '</td>';
				echo '<td>' . $row2['Address2'] . '</td>';
				echo '<td>' . $row2['Address3'] . '</td>';
				echo '<form action="editUser.php" method="post">';
					echo '<input name="UserNo" value=' . $row['UserNo'] . '   type="hidden">';
					echo '<td>'.'<input name="submit" type="submit" value="编辑">'.'</td>';
				echo '</form>';
			}
		echo '</tr>';
	};
/*———————————————————————————————————————————————————————————————————*/
	// 关闭连接
	mysqli_close($conn); 
?>
			
		</table>
	</body> 
</html>