<!doctype html>
<html>
	<head>
		<title>全部用户信息</title>
		<meta charset="utf-8">
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
		<caption><h2>全部用户</h2></caption>
			<tr class="firstrow">
				<td style="width:6%">用户编号</td>
				<td style="width:6%">用户名</td>
				<td style="width:6%">姓名</td>
				<td style="width:6%">电话</td>
				<td colspan="3" style="text-align:center;width:50%">地址</td>
				<td style="width:3%">编辑</td>
		</tr>
		
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
	
	/* 查询数据库 */
	$sql1 = "SELECT UserNo, UserName FROM account ORDER BY UserNo ASC";
	$result1 = mysqli_query($conn,$sql1);
	$sql2 = "SELECT UserName, Tel, Address1, Address2, Address3 FROM userinfo ORDER BY UserNo ASC";
	$result2 = mysqli_query($conn,$sql2);
	/* 显示信息 */
	while (($row1 = mysqli_fetch_array($result1)) && ($row2 = mysqli_fetch_array($result2))) {
		echo '<tr>';
				echo '<td>' . $row1['UserNo'] . '</td>';
				echo '<td>' . $row1['UserName'] . '</td>';
				echo '<td>' . $row2['UserName'] . '</td>';
				echo '<td>' . $row2['Tel'] . '</td>';
				echo '<td>' . $row2['Address1'] . '</td>';
				echo '<td>' . $row2['Address2'] . '</td>';
				echo '<td>' . $row2['Address3'] . '</td>';
				echo '<form action="editUser.php" method="post">';
					echo '<input name="UserNo" value=' . $row1['UserNo'] . '   type="hidden">';
					echo '<td>'.'<input name="submit" type="submit" value="编辑">'.'</td>';
				echo '</form>';
		echo '</tr>';
	};
	
	/* 断开连接 */
	mysqli_close($conn);
?>
		</table>
	</body>
</html>

