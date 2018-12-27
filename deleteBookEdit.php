<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>修改图书信息</title>
<style>
	#info
	{
		width: 600px;
		height:700px;
		margin:10px;
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
	#edit
	{
		width:500px;
		float:right;
		margin:auto;
	}
</style>
</head>

<body>
<?php
	session_start();
	
	$servername = "localhost";
	$username = "root";
	$password = "root";
	$dbname = "book";

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
	
	$isbn = $_POST["ISBN"];
	$_SESSION['isbn']=$isbn;

	$sql1 = "SELECT bookinfo.BookName, bookinfo.ISBN, bookinfo.Press, bookinfo.SummaryCN, bookinfo.SummaryEN, bookinfo.Price,bookinfo.discount, bookinfo.type, bookinfo.Price FROM bookinfo WHERE bookinfo.ISBN=$isbn";
	$sql2 = "SELECT Author, AuthorNo FROM author WHERE author.ISBN=$isbn";

	$result1 = mysqli_query($conn, $sql1);
	$result2 = mysqli_query($conn, $sql2);
	$i=1;
	while ($row1 = mysqli_fetch_array($result1))  {
		echo "<div id='info'>";
		echo "ISBN:&nbsp;&nbsp;&nbsp;" . $row1['ISBN']."<br>";
		echo "书名:&nbsp;&nbsp;&nbsp" . $row1['BookName']."<br>";
		echo "作者:&nbsp;&nbsp;&nbsp";
		while ($row2 = mysqli_fetch_array($result2)){
			echo $i. '.'.$row2['Author']."&nbsp;&nbsp;&nbsp";
			//echo $i. '.'.$row2['Author'], $row2['AuthorNo']."&nbsp;&nbsp;&nbsp";
			$i++;
		}
		echo '<br>';
		echo "类型:&nbsp;&nbsp;&nbsp" . $row1['type']."<br>";
		echo "出版社:&nbsp;&nbsp;&nbsp " . $row1['Press']."<br>";
		echo "价格:&nbsp;&nbsp;&nbsp¥" . $row1['Price']."<br>";
		echo "折扣:&nbsp;&nbsp;&nbsp¥" . $row1['discount']."<br>";
		echo "中文简介: ";
		echo "<p>". $row1['SummaryCN']."</p>";
		echo "英文简介: ";
		echo "<p>". $row1['SummaryEN']."</p>";
		echo "</div>";
	}
	
	if ($row3=mysqli_query($conn,$sql2))
	{
		$rowcount=mysqli_num_rows($row3);
	}

?>
<div id="edit">
	<h2>编辑图书记录</h2>
		<h4>提示：如果ISBN有误，请删除此记录并重新添加。</h4>
		<form action="deleteBookEdit2.php" method="post">
			<p>书名：
			<input name="BookName" type="text" size="20" maxlength="100"></p>
			<p>类型：
			<input name="Type" type="text" size="20" maxlength="50"></p>
			<p>出版社：
			<input name="Press" type="text" size="20" maxlength="50"></p>
			<p>价格：
			<input name="Price" type="text" size="20" maxlength="10"></p>
			<p>折扣：
			<input name="Discount" type="text" size="20" maxlength="10"></p>
			<p>中文简介：
			<input name="SummaryCN" type="text" size="20" maxlength="1000"></p>
			<p>英文简介：
			<input name="SummaryEN" type="text" size="20" maxlength="1000"></p>
			<input name="form" value="1" type="hidden">
			<p><input name="submit" type="submit" value="提交">
			   <input name="reset" type="reset" value="重置"></p>
			<br>
		</form>
<?php
	$sql3 = "SELECT Author, AuthorNo FROM author WHERE author.ISBN=$isbn";
	$result3 = mysqli_query($conn, $sql3);
	$j=1;
	while ($row3 = mysqli_fetch_array($result3)){
		echo '<form action="deleteBookEdit2.php" method="post">';
			echo '<p>作者'.$j.'：<input name="Author" type="text" size="20" maxlength="20"></p>';
			echo '<input name="AuthorNo" value=' . $row3['AuthorNo'] . '   type="hidden">';
			echo '<input name="form" value="2" type="hidden">';
			echo '<input name="submit" type="submit" value="提交">';
		echo '</form>';
		$j++;
	}
?>
</div>
</body>
</html>