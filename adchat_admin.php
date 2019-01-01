<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="refresh" content="1;url=chat_admindetail.php">

    <title>提交回复</title>
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
$_userid=$_COOKIE['u_id'];

$date=date('Y.m.d-H:i:s');
$a=$_POST["text"];
$sql1 = "INSERT INTO chat (userid, adminid,text, time)
	VALUES(".$_POST["userno"].",".$_POST["adminno"].",'$a','$date')
	";
if (mysqli_query($conn, $sql1)) {
    echo "添加成功";
} else {
    echo "Error creating database: " . mysqli_error($conn);
};

?>
</body>
</html>
