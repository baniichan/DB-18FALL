<!doctype html>
<html>
	<head>
		<title>订单详情</title>
		<meta charset="utf-8">
		<style>
			#table
			{
				margin:auto;
				width:80%;
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
		<caption><h2>订单详情</h2></caption>
			<tr class="firstrow">
				<td style="width:10%;">ISBN</td>
				<td style="width:20%;">书名</td>
				<td style="width:5%;">数量</td>
				<td style="width:7%;">姓名</td>
				<td style-"width:10%;">电话</td>
				<td style="width:40%;">地址</td>
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
	$sql1 = "SELECT * FROM orderdetail WHERE OrderNo = $orderno";
	$sql4 = "SELECT address FROM orderall WHERE OrderNo = $orderno";
	$sql3 = "SELECT UserName, Tel FROM userinfo WHERE UserNo = '$userno'";
	$result1 = mysqli_query($conn,$sql1);
	$result4 = mysqli_query($conn,$sql4);
	$result3 = mysqli_query($conn,$sql3);
	/* 显示信息 */
	while (($row1 = mysqli_fetch_array($result1)) && ($row4 = mysqli_fetch_array($result4)) && ($row3 = mysqli_fetch_array($result3))) {
		echo '<tr>';
			echo '<td>' . $row1['ISBN'] . '</td>';
			$isbn = $row1['ISBN'];
			$sql2 = "SELECT BookName FROM bookinfo WHERE ISBN = $isbn";
			$result2 = mysqli_query($conn,$sql2);
			while ($row2 = mysqli_fetch_array($result2)){
				echo '<td>' . $row2['BookName']. '</td>';
			}
			echo '<td>' . $row1['Quantity'] . '</td>';
			echo '<td>' . $row3['UserName'] . '</td>';
			echo '<td>' . $row3['Tel'] . '</td>';
			echo '<td>' . $row4['address'] . '</td>';
		echo '</tr>';
	};
	
	/* 断开连接 */
	mysqli_close($conn);
?>
		</table>
	</body>
</html>

