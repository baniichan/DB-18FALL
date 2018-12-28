<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="refresh" content="3;url=showAllOrder_Customer.php">
    <title>退单</title>
</head>

<body>
<?php
$orderno = $_POST['OrderNo'];
date_default_timezone_set('PRC');
$date=date('Y.m.d');
$year=date('Y');
$month=date('m');
$day=date('d');
$hour=date('H');
$minute=date('i');
$second=date('s');
$applicationTime = $year."年".$month."月".$day."日".$hour.":".$minute.":".$second;

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

$sql = "UPDATE orderall SET status = '3', applicationTime = '$applicationTime' WHERE OrderNo = '$orderno'";
if (mysqli_query($conn, $sql))
{
    echo '修改订单状态成功！3秒后自动返回前一页';
    echo "<br>";
} else {
    echo "修改订单状态失败！". "<br>";
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

/* 断开连接 */
mysqli_close($conn);
?>
</body>
</html>