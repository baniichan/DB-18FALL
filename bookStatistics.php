<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>无标题文档</title>
	<style>
			#table{
				margin:auto;
				width:20%;
				border-collapse:collapse;
			}
			#table td
			{
				border: 1px solid DarkGray;
				padding-left:10px;
				padding-top:5px;
				padding-bottom:5px;
				padding-right:5px;
			}
			#table tr.firstrow
			{
				font-weight:bold;
			}
			a:link {color:mediumblue;}      
			a:visited {color:mediumblue;} 
			a:hover {color:darkblue;}
			a:active {color:darkblue;}
	</style>
</head>

<body>
	<table id="table">
			<caption><h2>统计信息</tr></caption>
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
	// 收录的书目数量
	$sql1 = mysqli_query($conn, "SELECT COUNT(*) AS books FROM bookinfo");
	$res1 = mysqli_fetch_array($sql1);
	$books = $res1['books'];
	// 收录的作者数量
	$sql2 =mysqli_query($conn, "SELECT COUNT(DISTINCT Author) AS authors FROM author");
	$res2 = mysqli_fetch_array($sql2);
	$authors = $res2['authors'];
	// 收录的出版社数量
	$sql3 =mysqli_query($conn, "SELECT COUNT(DISTINCT Press) AS press FROM bookinfo");
	$res3 = mysqli_fetch_array($sql3);
	$press = $res3['press'];
	
	/* 显示结果 */
	echo '<tr>';
		echo '<td>收录的书目数量</td>';
		echo '<td>'. $books. '</td>';
	echo '</tr>';
	echo '<tr>';
		echo '<td>收录的作者数量</td>';
		echo '<td>'. $authors. '</td>';
	echo '</tr>';
	echo '<tr>';
		echo '<td>收录的出版社数量</td>';
		echo '<td>'. $press. '</td>';
	echo '</tr>';
?>
	<tr><td colspan="2" style="text-align:center;font-weight:bold;padding-top:20px;padding-bottom:20px;">各类型图书数量</td></tr>
<?php	
	$conn;
	function countType($query){
		global $conn;
		$sql = mysqli_query($conn, "SELECT COUNT(*) AS res FROM bookinfo WHERE type=$query");
		$res = mysqli_fetch_array($sql);
		$result = $res['res'];
		return $result;
	}

	echo '<tr>';
		echo '<td>诗歌</td>';
		echo '<td>'. countType("'诗歌'"). '</td>';
	echo '</tr>';
	echo '<tr>';
		echo '<td>散文</td>';
		echo '<td>'. countType("'散文'"). '</td>';
	echo '</tr>';
	echo '<tr>';
		echo '<td>小说</td>';
		echo '<td>'. countType("'小说'"). '</td>';
	echo '</tr>';
	echo '<tr>';
		echo '<td>文学</td>';
		echo '<td>'. countType("'文学'"). '</td>';
	echo '</tr>';
	echo '<tr>';
		echo '<td>历史</td>';
		echo '<td>'. countType("'历史'"). '</td>';
	echo '</tr>';
	echo '<tr>';
		echo '<td>哲学</td>';
		echo '<td>'. countType("'哲学'"). '</td>';
	echo '</tr>';
	echo '<tr>';
		echo '<td>艺术</td>';
		echo '<td>'. countType("'设计'"). '</td>';
	echo '</tr>';
	echo '<tr>';
		echo '<td>设计</td>';
		echo '<td>'. countType("'设计'"). '</td>';
	echo '</tr>';
	echo '<tr>';
		echo '<td>教材</td>';
		echo '<td>'. countType("'教材'"). '</td>';
	echo '</tr>';
	echo '<tr>';
		echo '<td>科技</td>';
		echo '<td>'. countType("'科技'"). '</td>';
	echo '</tr>';
	echo '<tr>';
		echo '<td>外国小说</td>';
		echo '<td>'. countType("'外国小说'"). '</td>';
	echo '</tr>';
	echo '<tr>';
		echo '<td>人物传记</td>';
		echo '<td>'. countType("'人物传记'"). '</td>';
	echo '</tr>';
	echo '<tr>';
		echo '<td>其他</td>';
		echo '<td>'. countType("'其他'"). '</td>';
	echo '</tr>';
?>	
	</table>
</body>
</html>