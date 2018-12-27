<!doctype html>
<html>
<head>

    <meta charset="utf-8">
    <title>已下订单</title>
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
$sql1 = "SELECT orderall.orderno, orderdetail.quantity,orderdetail.totalprice,orderall.year, orderall.month, orderall.day, orderall.hour, orderall.minute, orderall.second, bookinfo.bookname, orderall.address  
FROM bookinfo,orderall, orderdetail 
WHERE orderdetail.ISBN=bookinfo.ISBN AND orderall.Orderno=orderdetail.Orderno AND orderall.userno=" . $_userid . "";

if (mysqli_query($conn, $sql1)) {
    echo "查询成功";
} else {
    echo "Error creating database: " . mysqli_error($conn);
};
// 订单显示
echo '<table border="1" width="900" align="center" cellpadding="10">';	// 表格样式
echo '<caption><h1>订单</h1></caption>';	// 表格标题
echo '<tr>';
echo'<td>订单编号</td>';
echo'<td>时间</td>';
echo'<td>图书</td>';
echo'<td>数量</td>';
echo'<td>总价</td>';
echo'<td>地址</td>';

echo'<td></td>';
echo '</tr>';

while($row = mysqli_fetch_array($result))
{
    //echo '<form action="delete.php" method="post">';
    echo '<tr>';
    echo'<td>'.$row['orderno'].'</td>';
    echo'<td>'.$row['year']."-".$row['month']."-".$row['day']." ".$row['hour'].":".$row['minute'].":".$row['second'].'</td>';
    echo'<td>'.$row['bookname'].'</td>';
    echo'<td>'.$row['amount'].'</td>';
    echo'<td>'.$row['totalprice']."￥".'</td>';
    echo'<td>'.$row['address'].'</td>';

    echo '</tr>';
    //echo '</form>';
}
echo '<p><a href="welcome.html">返回主页</a>';
/*———————————————————————————————————————————————————————————————————*/
// 关闭连接
mysqli_close($conn);
?>

</body>
</html>

