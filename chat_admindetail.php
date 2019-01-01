<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>查看与用户的对话并回复</title>
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

$_adminid=$_COOKIE['a_id'];
session_start();
	if(isset($_SESSION['userid'])){
		$userid=$_SESSION['userid'];
	}
	else{
		$userid=$_POST['userid'];
	}

/*———————————————————————————————————————————————————————————————————*/
echo '<h2 style="text-align:center">和用户'.$userid.'的对话'.'</h2>';	
$sql1 = "SELECT * FROM chat WHERE userid=$userid ";
$result = mysqli_query($conn,$sql1);
while($row = mysqli_fetch_array($result)){
	if ($row['adminid']=='-1'){
		echo "<div style='margin-left:300px;'>";
		echo "<font color=#696969><b>用户： " . $row['userid']."</b></font></br>";
		echo "<font color=#696969>时间： " . $row['time']. "</font></br>";
		echo "<font color=#696969>内容： " . $row['text']."</font></br>";
		echo "____________________________________________<br>";
		echo "</div>";
	}

	else{
		echo "<div style='margin-left:700px;'>";
		echo "<div style='margin-left:280px;>'<b>管理员：" . $row['adminid']."</b></br></div>";
		echo "时间： " . $row['time'].'</br>';
		echo "内容： " . $row['text'].'</br>';
		echo "____________________________________________<br>";
		echo "</div>";
	}
}
	echo '<center>';
	echo '<p><form action="adchat.php" method="post">';
	echo '回复: <input type="text" name="text">';
	echo '<input name="userno" value=' . $userid . '   type="hidden">';
	echo '<input name="adminno" value=' . $_adminid . '   type="hidden">';

	echo '<input name="submit" type="submit" value="回复">'.'</td>';
	echo '</form></p>';
	echo '<p><a href="chat_admin.php">返回</a>';
	echo '</center>';
/*———————————————————————————————————————————————————————————————————*/
// 关闭连接
mysqli_close($conn);
?>

</body>
</html>

