<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>选择用户进行对话</title>
</head>
<body>

<?php
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
echo '<center>';
echo "<h2>选择用户进行对话</h2><br>";
$sql1 = "SELECT userid FROM chat group by userid " ;
$result = mysqli_query($conn,$sql1);
while($row = mysqli_fetch_array($result)){
	echo "<p>用户编号: ". $row['userid'].'</p>';
    echo '<form action="chat_admindetail.php" method="post">';
		echo '<input name="userid" value=' . $row['userid'] . '   type="hidden">';
		echo '<p><input name="submit" type="submit" value="回复"></p>';
    echo '</form>';
echo "____________________________________________<br><br>";
}
echo '<p><a href="manage_message.html">返回</a>';
echo '</center>';
/*———————————————————————————————————————————————————————————————————*/
// 关闭连接
mysqli_close($conn);
?>

</body>
</html>

