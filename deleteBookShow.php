<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>管理图书</title>
	<style>
			#center
			{
				text-align:center;
				margin-bottom:10px;
			}
			#type
			{
				margin:auto;
				margin-bottom:20px;
			}
			#type td
			{
				padding:10px;
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
				padding-top:5px;
				padding-bottom:5px;
			}
			#table td.ISBN
			{
				width:10%;
			}
			#table td.info
			{
				width:30%;
			}
			#table td.price
			{
				width:3%;
			}
			#table td.submit
			{
				width:5%;
				text-align:center;
			}
			#table td.manipulation
			{
				width:2%;
				margin:auto;
				text-align:center;
			}
			#page{
				text-align:center;
			}
			a:link {color:mediumblue;}      
			a:visited {color:mediumblue;} 
			a:hover {color:darkblue;}
			a:active {color:darkblue;}
		</style>
		<!-- 页码跳转 -->
		<script lang="javascript">
			 function chk(page){
			 if(form.page.value<=0||form.page.value>form.pages.value){
			 alert("请输入有效页码");
			 form.page.focus();
			 return(false);
			 }
			 return(true);
			 }
		</script>
</head>

<body>
		<table id = "table">
		<caption><h2>图书列表</h2></caption>
			<tr class="firstrow">
				<td class="ISBN">ISBN</td>
				<td class="info">书名</td>
				<td class=" manipulation" colspan="2">操作</td>
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
	
	/* 分页需要 */
    $page = 1;	//$page默认为1
    $page = empty($_GET['page'])?1 : $_GET['page'];	// 修改$page的值
    $sql=mysqli_query($conn,"SELECT * FROM bookinfo ");	// 查询bookinfo中的记录数
	$count=mysqli_num_rows($sql);
    $num = 10;	// 每页显示10条记录
    $pageCount = ceil($count / $num);	// 求总页数
    $offset = ($page - 1) * $num;  // 求偏移量

	/* 显示图书记录 */
	$sql =  "SELECT * FROM bookinfo limit " . $offset . ',' . $num;	// 查询book
	$result = mysqli_query($conn,$sql);

	while ($row = mysqli_fetch_array($result)) {
		echo '<tr>';
			echo '<form name=form1 action="displayOneBook.php" method="post">';
				echo '<td>' . $row['ISBN'] . '</td>';
				echo '<td name="bookname">' . $row['BookName'] . '</td>';
			echo '</form>';
			//	该书详情
			echo '<form name=form2 action="deleteBookEdit.php" method="post">';
				echo '<input name="ISBN" value=' . $row['ISBN'] . '   type="hidden">';
				echo'<td>'.'<input name="submit" type="submit" value="编辑">';
			echo '</form>';
			echo '<form name=form3 action="deleteBookDelete.php" method="post">';
				echo '<input name="ISBN" value=' . $row['ISBN'] . '   type="hidden">';
				echo'<td>'.'<input name="submit" type="submit" value="删除">';
			echo '</form>';
		echo '</tr>';
	};
	
	/* 分页需要 */
    $prev = $page - 1;
    $next = $page + 1;
    if($prev<1){	    // 页数限制
        $prev = 1;
    }
    if($next>$pageCount){
        $next = $pageCount;
    }
	
	/* 断开数据库连接 */
	mysqli_close($conn);
?>
	</table>
		
	<!-- 显示分页 -->
	<center><p>
	<form name="page" method="get" action="deleteBookShow.php" onSubmit="return chk(this)">
		当前<input name="page" type="text" size="1" value="<?php echo $page; ?>">/<?php echo $pageCount ?>页&nbsp;&nbsp;&nbsp;
 		<input type="hidden" name="pages" value="<?php echo $pageCount;?>">
		<a href="deleteBookShow.php?page=1">首页</a>&nbsp;&nbsp;&nbsp;  
    	<a href="deleteBookShow.php?page=<?=$prev;?>">上一页</a>&nbsp;&nbsp;&nbsp;
    	<a href="deleteBookShow.php?page=<?=$next;?>">下一页</a>&nbsp;&nbsp;&nbsp;
    	<a href="deleteBookShow.php?page=<?=$pageCount;?>">尾页</a>
	</form>
	</p></center>
</body>
</html>