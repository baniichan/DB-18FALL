<!doctype html>
<html>
	<head>
		<title>订单详情</title>
		<meta charset="utf-8">
		<style>
			#table
			{
				margin:auto;
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
		<table id = "table" style="width:50%;">
		<caption><h2>用户信息</h2></caption>
			<tr class="firstrow">
				<td style="width:10%;">姓名</td>
				<td style-"width:5%;">电话</td>
				<td style="width:60%;">地址</td>
		</tr>	
<?php
	$orderno = $_POST['OrderNo'];
	$userno = $_POST['UserNo'];
	
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
	$sql1 = "SELECT address FROM orderall WHERE OrderNo = $orderno";
	$sql2 = "SELECT UserName, Tel FROM userinfo WHERE UserNo = '$userno'";

	$result1 = mysqli_query($conn,$sql1);
	$result2 = mysqli_query($conn,$sql2);
	/* 显示信息 */
	while (($row1 = mysqli_fetch_array($result1)) && ($row2 = mysqli_fetch_array($result2))) {
		echo '<tr>';
			echo '<td>' . $row2['UserName'] . '</td>';
			echo '<td>' . $row2['Tel'] . '</td>';
			echo '<td>' . $row1['address'] . '</td>';
		echo '</tr>';
	};
?>
		</table>
		<br>
		<table id = "table" style="width:70%">
		<caption><h2>详细订单</h2></caption>
			<tr class="firstrow">
				<td style="width:5%">详单号</td>
				<td style="width:10%;">ISBN</td>
				<td style="width:20%;">书名</td>
				<td style="width:5%;">数量</td>
		</tr>
<?php
	$sql3 = "SELECT * FROM orderdetail WHERE OrderNo = $orderno";
	$result3 = mysqli_query($conn,$sql3);
	while ($row3 = mysqli_fetch_array($result3)){
		echo '<tr>';
			echo '<td>' . $row3['OrderDetailNo'] . '</td>';
			echo '<td>' . $row3['ISBN'] . '</td>';
				$isbn = $row3['ISBN'];
				$sql4 = "SELECT BookName FROM bookinfo WHERE ISBN = $isbn";
				$result4 = mysqli_query($conn,$sql4);
				while ($row4 = mysqli_fetch_array($result4)){
					echo '<td>' . $row4['BookName']. '</td>';
				}
			echo '<td>' . $row3['Quantity'] . '</td>';
		echo '</tr>';
	}
?>
		</table>
	</body>
</html>

