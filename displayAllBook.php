<!-- 2018.12.20/zdq/ -->
<!doctype html>
<html>
	<head>
		<title>图书购买</title>
		<meta charset="utf-8">
		<!-- 样式 -->
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
				width:75%;
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
			#table td.info
			{
				width:20%;
			}
			#table td.price
			{
				width:3%;
			}
			#table td.submit
			{
				width:10%;
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
		<div id="top" style="height:20px">
			<div style="float:left; text-align:left"><a href="welcome.html">返回个人页</a></div>
			<div style="float:right; text-align:right"><a href="viewshoppingcart.php">查看购物车</a></div>
		</div><br>
		<div id="center"><p>
		<form action="chooseSearchMethod.php" method="get">
				<input type="text" name="word" placeholder="请输入关键词">
				<select name="type">
				<option value="bookname">书名搜索</option>
				<option value="author">作者搜索</option>
				<input name="submit" type="submit" value="搜索">
				</select></p>
		</form>
		</div>
		
		<table id="type">
			<tr>
				<td><a href="displayAllBook.php">全部分类</a>
				</td><td>分类：</td>
				<td><a href="type.php?type='诗歌'">诗歌</a></td>
				<td><a href="type.php?type='散文'">散文</a></td>
				<td><a href="type.php?type='小说'">小说</a></td>
				<td><a href="type.php?type='文学'">文学</a></td>
				<td><a href="type.php?type='历史'">历史</a></td>
				<td><a href="type.php?type='哲学'">哲学</a></td>
				<td><a href="type.php?type='艺术'">艺术</a></td>
				<td><a href="type.php?type='设计'">设计</a></td>
				<td><a href="type.php?type='教材'">教材</a></td>
				<td><a href="type.php?type='外国小说'">外国小说</a></td>
				<td><a href="type.php?type='科技'">科技</a></td>
				<td><a href="type.php?type='人物传记'">人物传记</a></td>
				<td><a href="type.php?type='其他'">其他</a></td>
			</tr>
		</table>
			
		<table id = "table">
		<caption><h2>全部分类</h2></caption>
			<tr class="firstrow">
				<td class="submit">ISBN</td>
				<td class="info">书名</td>
				<td class="price">价格</td>
				<td class="submit">选择数量</td>
				<td class="submit">购买</td>
				<td class="submit">详细信息</td>
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
			echo '<form action="shoppingcart.php" method="post">';
				echo '<td>' . $row['ISBN'] . '</td>';
				echo '<td name="bookname">' . $row['BookName'] . '</td>';
				echo '<td name="discountprice">' . $row['Price']*  $row['discount']. "¥" .'</td>';
				echo '<input name="ISBN" value=' . $row['ISBN'] . '   type="hidden">';
				echo '<td class="submit">' . '<input name="quantity" type="number" min="0">' . '</td>';
				echo '<td class="submit">' . '<input name="submit" type="submit" value="加入购物车">'. '</td>';
			echo '</form>';
			//	该书详情
			echo '<form name=form1 action="displayOneBook.php" method="post">';
				echo '<input name="ISBN" value=' . $row['ISBN'] . '   type="hidden">';
				echo  '<td class="submit">' . '<input name="submit" type="submit" value="点击查看">';
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
	<form name="page" method="get" action="displayAllBook.php" onSubmit="return chk(this)">
		当前<input name="page" type="text" size="1" value="<?php echo $page; ?>">/<?php echo $pageCount ?>页&nbsp;&nbsp;&nbsp;
 		<input type="hidden" name="pages" value="<?php echo $pageCount;?>">
		<a href="displayAllBook.php?page=1">首页</a>&nbsp;&nbsp;&nbsp;  
    	<a href="displayAllBook.php?page=<?=$prev;?>">上一页</a>&nbsp;&nbsp;&nbsp;
    	<a href="displayAllBook.php?page=<?=$next;?>">下一页</a>&nbsp;&nbsp;&nbsp;
    	<a href="displayAllBook.php?page=<?=$pageCount;?>">尾页</a>
	</form>
	</p></center>
    
	</body>
</html>

