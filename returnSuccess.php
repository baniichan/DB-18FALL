<!doctype html>
<html>
	<head>
		<title>已完成的订单</title>
		<meta charset="utf-8">
		<style>
			#link
			{
				text-align:center;
				font-size:18px;
				margin:10px;
				margin-top:40px;
			}
			#table
			{
				margin:auto;
				width:50%;
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
		<a href="manage_order.html" style="margin-left:10px;">返回</a>
		<div id = "link">
			<a href="completedOrder.php">成功交易的订单</a>&nbsp;&nbsp;&nbsp;
			<a href="returnSuccess.php">退货订单</a>
		</div>
		<table id = "table">
		<caption><h2>退货的订单</h2></caption>
			<tr class="firstrow">
				<td style="width:8%">订单号</td>
				<td style="width:8%">用户编号</td>
				<td style="width:15%">退货时间</td>
				<td style="width:6%">订单详情</td>
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
	$sql1 = "SELECT * FROM orderall WHERE status = '4'";
	$result1 = mysqli_query($conn,$sql1);
	/* 显示信息 */
	while ($row1 = mysqli_fetch_array($result1)) {
		echo '<tr>';
			echo '<td>' . $row1['OrderNo'] . '</td>';
			echo '<td>' . $row1['UserNo'] . '</td>';
			echo '<td>' . $row1['returnTime'].'</td>';
			echo '<form action="orderdetail.php" method="post">';
				echo '<input name="OrderNo" value=' . $row1['OrderNo'] . '   type="hidden">';
			echo '<input name="UserNo" value=' . $row1['UserNo'] . '   type="hidden">';
				echo '<td>'.'<input name="submit" type="submit" value="查看">'.'</td>';
			echo '</form>';
		echo '</tr>';
	};
	
	/* 断开连接 */
	mysqli_close($conn);
?>
		</table>
	</body>
</html>

