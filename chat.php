<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>与管理员交流</title>
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
// 检测连接
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

/*———————————————————————————————————————————————————————————————————*/
echo '<h2 style="text-align:center">和管理员的对话'.'</h2>';
$sql1 = "SELECT * FROM chat WHERE userid=$_userid  ";
$result = mysqli_query($conn, $sql1);
while ($row = mysqli_fetch_array($result)) {
    if ($row['adminid'] == '-1') {
		echo "<div style='margin-left:300px;'>";
       	echo "<b>用户</b>";
        echo "<br>";
        echo  $row['time'];
        echo "<br>";
        echo "聊天内容： " . $row['text'] ;
        echo "<br>";
        echo "____________________________________________<br>";
		echo '</div>';
    } else {
		echo "<div style='margin-left:700px;'>";
        echo "<b>管理员：" . $row['adminid'] . "</b>";
        echo "<br>";
        echo  $row['time'];
        echo "<br>";
        echo "聊天内容： " . $row['text'];
        echo "<br>";
        echo "____________________________________________<br>";
		echo "</div>";
    }
}
echo '<center>';
echo '<p><form action="adchat.php" method="post">';
echo '回复: <input type="text" name="text">';
echo '<input name="adminno" value="-1"   type="hidden">';
echo '<input name="userno" value= '.$_userid.' type="hidden">';
echo '<br>';
echo '<input name="submit" type="submit" value="回复">';
echo '</form></p>';
echo '<p><a href="welcome.html">返回</a>';
echo '</center>';
/*———————————————————————————————————————————————————————————————————*/
// 关闭连接
mysqli_close($conn);
?>

</body>
</html>

