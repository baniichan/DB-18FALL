<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="refresh" content="3;url=deleteBookShow.php"> 
<title>修改图书信息</title>
</head>
	
<body>
	
<?php
	session_start();
	$isbn = $_SESSION['isbn'];	//echo $isbn;
	
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

	/* 更新除作者其他的信息 */
	if($_POST['form']==1)
	{
		//echo $_POST['form'].'<br>';$isbn = $_POST['ISBN'];
		$bookname = $_POST['BookName'];
		$type = $_POST['Type'];
		$press = $_POST['Press'];
		$price = $_POST['Price'];
		$discount = $_POST['Discount'];
		$cn = $_POST['SummaryCN'];
		$en = $_POST['SummaryEN'];
		/*echo $isbn. '<br>';echo $bookname. '<br>';echo $type. '<br>';echo $press. '<br>';echo $price. '<br>';echo $discount. '<br>';echo $cn. '<br>';echo $en. '<br>';*/
		if($bookname!=NULL){
			$sql = "UPDATE bookinfo SET BookName='$bookname' WHERE ISBN='$isbn'";
			if (mysqli_query($conn, $sql))
			{
				echo "书名修改成功！";
				echo "<br>";
			} else {
				echo "修改失败！". "<br>";
				echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			}
		}
		if($type!=NULL){
			$sql2 = "UPDATE bookinfo SET type ='$type' WHERE ISBN='$isbn'";
			if (mysqli_query($conn, $sql2))
			{
				echo "类型修改成功！";
				echo "<br>";
			} else {
				echo "修改失败！". "<br>";
				echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			}
		}
		if($press!=NULL){
			$sql3 = "UPDATE bookinfo SET Press ='$press' WHERE ISBN='$isbn'";
			if (mysqli_query($conn, $sql3))
			{
				echo "出版社修改成功！";
				echo "<br>";
			} else {
				echo "修改失败！". "<br>";
				echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			}
		}
		if($price!=NULL){
			$sql4 = "UPDATE bookinfo SET Price ='$price' WHERE ISBN='$isbn'";
			if (mysqli_query($conn, $sql4))
			{
				echo "价格修改成功！";
				echo "<br>";
			} else {
				echo "修改失败！". "<br>";
				echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			}
		}
		if($discount!=NULL){
			$sql5 = "UPDATE bookinfo SET discount ='$discount' WHERE ISBN='$isbn'";
			if (mysqli_query($conn, $sql5))
			{
				echo "折扣修改成功！";
				echo "<br>";
			} else {
				echo "修改失败！". "<br>";
				echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			}
		}
		if($cn!=NULL){
			$sql6 = "UPDATE bookinfo SET SummaryCN ='$cn' WHERE ISBN='$isbn'";
			if (mysqli_query($conn, $sql6))
			{
				echo "中文简介修改成功！";
				echo "<br>";
			} else {
				echo "修改失败！". "<br>";
				echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			}
		}
		if($en!=NULL){
			$sql7 = "UPDATE bookinfo SET SummaryEN ='$en' WHERE ISBN='$isbn'";
			if (mysqli_query($conn, $sql7))
			{
				echo "英文简介修改成功！";
				echo "<br>";
			} else {
				echo "修改失败！". "<br>";
				echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			}
		}
	}
	
	/* 更新作者 */
	if($_POST['form']==2)
	{
		$authorNo = $_POST['AuthorNo'];
		$author = $_POST['Author'];
		/*	echo $_POST['form'].'<br>';echo $authorNo.'<br>';echo $author.'<br>';	*/
		if($author!=NULL){
			$sql8 = "UPDATE author SET Author ='$author' WHERE ISBN='$isbn' AND AuthorNo='$authorNo'";
			if (mysqli_query($conn, $sql8))
			{
				echo "作者修改成功！";
				echo "<br>";
			} else {
				echo "修改失败！". "<br>";
				echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			}
		}
	}

	/* 关闭连接 */
	mysqli_close($conn);
?>
</body>
</html>