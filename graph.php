<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>数据可视化查询界面</title>
		



<!--传入年份用的-->
	</head>
	<body>
		<center>
		<h2>类型销量可视化</h2>
		<form action="" name="graph" method="post" enctype="multipart/form-data">
			<p>请输入您要查询的年份：
			<input name="year" type="text" size="6" maxlength="10"></p>
			<button onclick="bar()">绘制柱状图/折线图</button>
			<button onclick="pie()">绘制饼图/漏斗图</button>
			<p> <input name="submit" type="hidden" value="确定"></p>
			<p><a href="manage_order.html">返回</a></p>
		</form>	
		</center>
		<table id="table">
			<caption><h2>其他统计</tr></caption>
			<tr class="firstrow">
				<td style="padding-top:10px;padding-bottom:10px;">项目</td>
				<td style="padding-top:10px;padding-bottom:10px;">数量</td>
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
			// 订单数
			$sql1 = mysqli_query($conn, "SELECT COUNT(*) AS orders FROM orderall");
			$res1 = mysqli_fetch_array($sql1);
			$orders = $res1['orders'];
			echo '<tr>';
				echo '<td>订单总数</td>';
				echo '<td>'. $orders. '</td>';
			echo '</tr>';
		?>
		</table>
	</body>
	<script>
    function bar()
	{
//        document.("表单的name值").action
//        document.("表单的name值").submit
        document.graph.action="graph_bar.php";
        document.graph.submit();
    }

   // function pie() 
	{
        document.graph.action = "graph_pie.php";
        document.graph.submit();
    }
	</script>
</html>

