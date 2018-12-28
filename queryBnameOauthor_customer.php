<!DOCTYPE html> 
<html>
	<head>
		<meta charset="utf-8">
		<title>图书数据库管理系统</title>
		<style>
			#table{
				margin:auto;
				width:75%;
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
			<caption><h2>查询结果</tr></caption>
			<tr class="firstrow">
				<td>ISBN</td>
				<td>书名</td>
				<td>作者</td>
				<td>出版社</td>
				<td>类型</td>
				<td>详情</td>
			</tr>

<?php
	$a=$_POST["bookname"];
	$b=$_POST["authorname"];
/*———————————————————————————————————————————————————————————————————*/
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
	$sql = "
		SELECT bookInfo.ISBN, bookInfo.BookName, author.Author, bookInfo.Press, bookInfo.type
		FROM bookInfo INNER JOIN author ON bookInfo.ISBN = author.ISBN
		WHERE (((bookInfo.BookName is null) or (bookInfo.BookName Like '%$a%')) and ((author.Author is null) or(author.Author Like '%$b%')));
	";
	$result = mysqli_query($conn,$sql);	// mysqli_query，在数据库上执行查询。
	// 显示结果
	while ($row = mysqli_fetch_array($result)) {
		echo '<tr>';
			echo '<td style="width:10%;">' . $row['ISBN'] . '</td>';
			$isbn = $row['ISBN'];
			echo '<td style="width:20%;">' . $row['BookName'] . '</td>';
			echo '<td style="width:15%;">';
				$result2 = mysqli_query($conn,"SELECT Author from author WHERE ISBN = $isbn ");
				while($row2 = mysqli_fetch_array($result2)){
					echo $row2['Author']. '&nbsp;&nbsp;';
				}
			echo '</td>';
			echo '<td style="width:15%;">' . $row['Press'] . '</td>';
			echo '<td style="width:10%;">' . $row['type'] . '</td>';
		//	该书详情
			echo '<form name=form1 action="deleteBookEdit.php" method="post">';
				echo '<input name="ISBN" value=' . $row['ISBN'] . '   type="hidden">';
				echo  '<td style="width:5%;">' . '<input name="submit" type="submit" value="查看/编辑">';
			echo '</form>';
		echo '</tr>';
	};
/*———————————————————————————————————————————————————————————————————*/			
	mysqli_close($conn); 
?>
			
		</table>
	</body> 
</html>