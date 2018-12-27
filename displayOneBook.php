<html>
<head>
<title>详细信息</title>
<style>
	#info
	{
		width: 550px;
		height:700px;
		margin-top:40px;
		margin-left:90px;
		float:left;
		line-height:200%;
		overflow:auto;
	}
	#info p
	{
		width:500px;
		text-indent:35px;
		text-align:justify;
	}
	#info span
	{
		color:red;
	}
	.hang
	{
		width:500px;
		float:right;
		margin-right:90px;

	}
	#back{
		text-align:right;
	}
	#table{
		margin-top:-30px;
		width:100%;
		border-collapse:collapse;
	}
	#table td
	{
		border: 1px solid DarkGray;
		padding-left:10px;
		padding-top:5px;
		padding-bottom:5px;
	}
</style>
</head>
<body>
<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "book";

$_userid = $_COOKIE['u_id'];
// 创建连接
$conn = mysqli_connect($servername, $username, $password, $dbname);
// 设定字符集
mysqli_set_charset($conn, 'utf8');
//检测连接
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
	
$isbn = $_POST["ISBN"];
$a='douban/'.$isbn.'.jpg';
$sql1 = "SELECT bookinfo.BookName, bookinfo.ISBN, bookinfo.SummaryCN, bookinfo.SummaryEN, bookinfo.Price,bookinfo.discount, bookinfo.type, bookinfo.Price, bookinfo.Press 
FROM bookinfo WHERE bookinfo.ISBN=$isbn";
$sql2 = "SELECT Author, AuthorNo FROM author WHERE author.ISBN=$isbn";

$result1 = mysqli_query($conn, $sql1);
$result2 = mysqli_query($conn, $sql2);
$i=1;
while ($row = mysqli_fetch_array($result1)) {
	echo "<div id='info'>";
	echo "ISBN:&nbsp;&nbsp;&nbsp;" . $row['ISBN']."<br>";
	echo "书名:&nbsp;&nbsp;&nbsp" . $row['BookName']."<br>";
	echo "作者:&nbsp;&nbsp;&nbsp";
	while ($row2 = mysqli_fetch_array($result2)){
		echo $i. '.'.$row2['Author']."&nbsp;&nbsp;&nbsp";
		//echo $i. '.'.$row2['Author'], $row2['AuthorNo']."&nbsp;&nbsp;&nbsp";
		$i++;
	}
	echo "<br>";
	echo "类型:&nbsp;&nbsp;&nbsp" . $row['type']."<br>";
	echo "出版社:&nbsp;&nbsp;&nbsp " . $row['Press']."<br>";
    if ($row['discount'] == 1) {
        echo "价格:&nbsp;&nbsp;&nbsp¥" . $row['Price'];
        echo "<br>";
    } else {
		echo "原价:&nbsp;&nbsp;&nbsp¥ " . $row['Price'] . "&nbsp;&nbsp;&nbsp";
        echo "<span>今日有折扣！折扣价:&nbsp;&nbsp;&nbsp<strong>¥ " . $row['Price'] * $row['discount'].'</strong></span>';
        echo "<br>";
    }
	echo "中文简介: ";
	echo "<p>". $row['SummaryCN']."</p>";
	echo "英文简介: ";
	echo "<p>". $row['SummaryEN']."</p>";
	echo "</div>";
}

echo '<div class="hang">';
	echo '<p id="back"><a href="displayAllBook.php">查看所有书</a></p>';
	echo "<img width='35%' height='250px' src='$a' alt='图书图片'>";	// 图片
	// 加入购物车
	echo '<form action="shoppingcart.php" method="post">';
	echo '<input name="ISBN" value=' . $isbn . '   type="hidden">';
	echo "<br>选择数量" . '<input name="quantity" type="number">';
	echo '<input name="submit" type="submit" value="加入购物车">';
	echo '</form>';
	// 推荐该类型中销量最高的五本书
	$sql2 = "
		SELECT bookinfo.BookName, bookinfo.ISBN, SUM(Quantity) as TotalQuantity
		FROM bookinfo, orderdetail
		WHERE bookinfo.ISBN = orderdetail.ISBN and  bookinfo.type =
			(SELECT bookinfo.type 
	  		 FROM bookinfo 
			 WHERE bookinfo.ISBN=" . $isbn . " )
			 GROUP BY bookinfo.ISBN 
			 ORDER BY SUM(orderdetail.Quantity) DESC";
	$result2 = mysqli_query($conn, $sql2);
	$i = 1;
	echo '<table id="table">';	// 表格样式
	echo '<caption><h2>本类型销量排行榜：</h2></caption>';	// 表格标题
	echo '<tr><td>排名</td><td>书名</td><td>销量</td><td>本书详情</td></tr>';
	while ($row = mysqli_fetch_row($result2)) {
		echo '<form action="displayOneBook.php" method="post">';
		echo '<tr>';
		echo '<td bgcolor="#f0f8ff">'.$i.'</td>';
		echo '<td bgcolor="#add8e6">'.$row['0'] .'</td>';
		echo '<td bgcolor="#5f9ea0">'.$row['2'] .'</td>';
		echo '<input name="ISBN" value=' . $row['1'] . '   type="hidden">';
		echo '<td>' . '<input name="submit" type="submit" value="点击查看">'. '</td>';
		$i++;
		echo "<br>";
		echo '</tr>';
		echo '</form>';
	}
	echo '</table>';
echo '</div>';
	
	//$row = mysqli_fetch_row($result2);
	// 推荐该类型中销量最高的，且用户没买过的，非该页面显示书的三本书
	// 留待下次


// 关闭连接
mysqli_close($conn);


/* 每个需要链接到这个页面的把底下的改改粘过去
echo '<form name=form1 action="displayOneBook.php" method="post">';
echo '<input name="ISBN" value=' . $row['ISBN'] . '   type="hidden">'; // 制作提交内容
echo  '<input name="submit" type="submit" value="该书详情">';
echo '</form>';

<a href="displayOneBook.php" onclick="form1.submit();">该书详情 </a>
*/

?>

</body>

</html>
