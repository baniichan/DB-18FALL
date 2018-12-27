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
	</head>

	<body>
		<div id="top" style="height:20px">
			<div style="float:left; text-align:left"><a href="welcome.html">返回个人页</a></div>
			<div style="float:right; text-align:right"><a href="viewshoppingcart.php">查看购物车</a></div>
		</div><br><br>
		<div id="center">
		<form action="chooseSearchMethod.php" method="get">
				<input type="text" name="word" placeholder="请输入关键词">
				<select name="type">
				<option value="bookname">书名搜索</option>
				<option value="author">作者搜索</option>
				<input name="submit" type="submit" value="搜索">
				</select>
		</form>
		</div>
		<table id="type">
			<tr>
				<td><a href="displayAllBook.php">全部分类</a>
				</td><td>分类：</td>
				<td><a href="typeProcess.php?type='诗歌'">诗歌</a></td>
				<td><a href="typeProcess.php?type='散文'">散文</a></td>
				<td><a href="typeProcess.php?type='小说'">小说</a></td>
				<td><a href="typeProcess.php?type='文学'">文学</a></td>
				<td><a href="typeProcess.php?type='历史'">历史</a></td>
				<td><a href="typeProcess.php?type='哲学'">哲学</a></td>
				<td><a href="typeProcess.php?type='艺术'">艺术</a></td>
				<td><a href="typeProcess.php?type='设计'">设计</a></td>
				<td><a href="typeProcess.php?type='教材'">教材</a></td>
				<td><a href="typeProcess.php?type='外国小说'">外国小说</a></td>
				<td><a href="typeProcess.php?type='科技'">科技</a></td>
				<td><a href="typeProcess.php?type='人物传记'">人物传记</a></td>
				<td><a href="typeProcess.php?type='其他'">其他</a></td>
			</tr>
		</table>
		<table id = "table">
		<caption><h2>搜索结果</h2></caption>
			<tr class="firstrow">
				<td class="submit">ISBN</td>
				<td class="info">书名</td>
				<td class="price">价格</td>
				<td class="submit">选择数量</td>
				<td class="submit">购买</td>
				<td class="submit">详细信息</td>
			</tr>
<?php
	session_start();	
	$_GET['author']=$_SESSION['query'];
			
	$wherelist=array();
	$urlist=array();

	if(!empty($_GET['author']))
	{
	$wherelist[]=" author like '%".$_GET['author']."%'";
	$urllist[]="author=".$_GET['author'];

	}

	$where="";
	if(count($wherelist)>0)
	{
	$where=" where ".implode(' and ',$wherelist);
	$url='&'.implode('&',$urllist);
	}

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
	$sql="
		SELECT bookInfo.ISBN, bookInfo.BookName, bookInfo.Price
		FROM bookInfo INNER JOIN author ON bookInfo.ISBN = author.ISBN $where"; 
	$result=mysqli_query($conn,$sql);
	$totalnum=mysqli_num_rows($result);
	//每页显示条数
	$pagesize=10;
	//总共有几页
	$maxpage=ceil($totalnum/$pagesize);
	$page=isset($_GET['page'])?$_GET['page']:1;
	if($page <1)
	{
	$page=1;
	}
	if($page>$maxpage)
	{
	$page=$maxpage;
	}
	$limit=" limit ".($page-1)*$pagesize.",$pagesize";
	$sql1="SELECT bookInfo.ISBN, bookInfo.BookName, bookInfo.Price
		FROM bookInfo INNER JOIN author ON bookInfo.ISBN = author.ISBN {$where} {$limit}";
	$result=mysqli_query($conn,$sql1);

	while ($row = mysqli_fetch_array($result)) {
		echo '<tr>';
			echo '<form action="shoppingcart.php" method="post">';
				echo '<input name="ISBN" value=' . $row['ISBN'] . '   type="hidden">';
				echo '<td>' . $row['ISBN'] . '</td>';
				echo '<td>' . $row['BookName'] . '</td>';
				echo '<td>' . "¥". $row['Price'] . '</td>';
				echo '<td class="submit">' . '<input name="quantity" type="number" min="0">' . '</td>';
				echo '<td class="submit">' . '<input name="submit" type="submit" value="加入购物车">'. '</td>';
			echo '</form>';
		//	每本书的详情
			echo '<form name=form1 action="displayOneBook.php" method="post">';
				echo '<input name="ISBN" value=' . $row['ISBN'] . '   type="hidden">';
				echo  '<td class="submit">' . '<input name="submit" type="submit" value="点击查看">';
			echo '</form>';
		echo '</tr>';
	}	
	
	mysqli_close($conn); 
?>
	</table>				
	<div id = "page"><p>
		当前<?php echo $page?>/<?php echo $maxpage?>页&nbsp;&nbsp;&nbsp;
		<a href="searchBname.php?page=1<?=$url;?>">首页</a>&nbsp;&nbsp;&nbsp;
		<a href="searchBname.php?page=<?=($page-1).$url;?>">上一页</a>&nbsp;&nbsp;&nbsp;
		<a href="searchBname.php?page=<?=($page+1).$url;?>">下一页</a>&nbsp;&nbsp;&nbsp;
		<a href="searchBname.php?page=<?=$maxpage.$url;?>">尾页</a></p>
	</div>
	</body>
</html>