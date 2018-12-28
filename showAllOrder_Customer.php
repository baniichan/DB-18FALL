<!doctype html>
<html>
<head>
    <title>订单详情</title>
    <meta charset="utf-8">
    <style>
        #table
        {
            margin:auto;
            width:70%;
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
            padding-top:10px;
            padding-bottom:10px;
            padding-right:5px;
        }
        a:link {color:mediumblue;}
        a:visited {color:mediumblue;}
        a:hover {color:darkblue;}
        a:active {color:darkblue;}
    </style>
</head>

<body>
<a href="welcome.html" style="margin-left:10px;">返回个人页</a>
<table id = "table">
    <caption><h2>待发货订单</h2></caption>
    <tr class="firstrow">
        <td style="width:12%">订单号</td>
        <td style="width:27%">下单时间</td>
        <td style="width:40%;">配送地址</td>
        <td style="width:12%">订单详情</td>
        <td style="width:6%">退单</td>

    </tr>

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
//时间
date_default_timezone_set('PRC');
$date=date('Y.m.d-H.i.s');
// 检测连接
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());}


$sql2 = "SELECT * FROM orderall WHERE UserNo = $_userid and status='0'";
$result2 = mysqli_query($conn,$sql2);


while ($row1 = mysqli_fetch_array($result2)) {
    echo '<tr>';
    echo '<td>' . $row1['OrderNo'] . '</td>';
    echo '<td>' . $row1['Year'] ."年". $row1['Month'] ."月". $row1['Day'] ."日 ". $row1['hour'] .":". $row1['minute'] .":". $row1['second'] .'</td>';
    echo '<td>' . $row1['address'] . '</td>';
    echo '<form action="orderdetail.php" method="post">';
    echo '<input name="OrderNo" value=' . $row1['OrderNo'] . '   type="hidden">';
    echo '<input name="UserNo" value=' . $row1['UserNo'] . '   type="hidden">';
    echo '<td>'.'<input name="submit" type="submit" value="查看">'.'</td>';
    echo '</form>';
    echo '<form action="withdrawOrder_Customer.php" method="post">';
    echo '<input name="OrderNo" value=' . $row1['OrderNo'] . '   type="hidden">';
    echo '<td>'.'<input name="submit" type="submit" value="退单">'.'</td>';
    echo '</form>';
    echo '</tr>';
};

    ?>
</table>
<table id = "table">
    <caption><h2>待收货订单</h2></caption>
    <tr class="firstrow">
        <td style="width:8%">订单号</td>
        <td style="width:27%">下单时间</td>
        <td style="width:40%;">配送地址</td>
        <td style="width:12%">订单详情</td>
        <td style="width:6%">收货</td>

    </tr>

<?php
$sql1 = "SELECT * FROM orderall WHERE UserNo = $_userid and status='1'";
$result1 = mysqli_query($conn,$sql1);
while ($row1 = mysqli_fetch_array($result1)) {
    echo '<tr>';
    echo '<td>' . $row1['OrderNo'] . '</td>';
    echo '<td>' . $row1['Year'] ."年". $row1['Month'] ."月". $row1['Day'] ."日 ". $row1['hour'] .":". $row1['minute'] .":". $row1['second'] .'</td>';
    echo '<td>' . $row1['address'] . '</td>';
    echo '<form action="orderdetail.php" method="post">';
    echo '<input name="OrderNo" value=' . $row1['OrderNo'] . '   type="hidden">';
    echo '<input name="UserNo" value=' . $row1['UserNo'] . '   type="hidden">';
    echo '<td>'.'<input name="submit" type="submit" value="查看">'.'</td>';
    echo '</form>';
    echo '<form action="delivery_Customer.php" method="post">';
    echo '<input name="OrderNo" value=' . $row1['OrderNo'] . '   type="hidden">';
    echo '<td>'.'<input name="submit" type="submit" value="确认">'.'</td>';
    echo '</form>';
    echo '</tr>';
};


?>
</table>
	
<table id = "table">
    <caption><h2>申请退货的订单</h2></caption>
    <tr class="firstrow">
        <td style="width:8%">订单号</td>
        <td style="width:20%">下单时间</td>
        <td style="width:40%;">配送地址</td>
        <td style="width:20%">申请时间</td>
        <td style="width:10%">订单详情</td>

    </tr>

    <?php

    $sql3 = "SELECT * FROM orderall WHERE UserNo = $_userid and status='3'";
    $result3 = mysqli_query($conn,$sql3);


    while ($row1 = mysqli_fetch_array($result3)) {
        echo '<tr>';
        echo '<td>' . $row1['OrderNo'] . '</td>';
        echo '<td>' . $row1['Year'] ."年". $row1['Month'] ."月". $row1['Day'] ."日 ". $row1['hour'] .":". $row1['minute'] .":". $row1['second'] .'</td>';
        echo '<td>' . $row1['address'] . '</td>';
        echo '<td>' . $row1['applicationTime'] . '</td>';
        echo '<form action="orderdetail.php" method="post">';
        echo '<input name="OrderNo" value=' . $row1['OrderNo'] . '   type="hidden">';
        echo '<input name="UserNo" value=' . $row1['UserNo'] . '   type="hidden">';
        echo '<td>'.'<input name="submit" type="submit" value="查看">'.'</td>';

        echo '</tr>';
    };

    ?>
</table>

<table id = "table">
    <caption><h2>交易成功的订单</h2></caption>
    <tr class="firstrow">
        <td style="width:8%">订单号</td>
        <td style="width:20%">下单时间</td>
        <td style="width:40%;">配送地址</td>
        <td style="width:20%">收货时间</td>
        <td style="width:10%">订单详情</td>

    </tr>

    <?php

    $sql3 = "SELECT * FROM orderall WHERE UserNo = $_userid and status='2'";
    $result3 = mysqli_query($conn,$sql3);


    while ($row1 = mysqli_fetch_array($result3)) {
        echo '<tr>';
        echo '<td>' . $row1['OrderNo'] . '</td>';
        echo '<td>' . $row1['Year'] ."年". $row1['Month'] ."月". $row1['Day'] ."日 ". $row1['hour'] .":". $row1['minute'] .":". $row1['second'] .'</td>';
        echo '<td>' . $row1['address'] . '</td>';
        echo '<td>' . $row1['ReceivingTime'] . '</td>';
        echo '<form action="orderdetail.php" method="post">';
        echo '<input name="OrderNo" value=' . $row1['OrderNo'] . '   type="hidden">';
        echo '<input name="UserNo" value=' . $row1['UserNo'] . '   type="hidden">';
        echo '<td>'.'<input name="submit" type="submit" value="查看">'.'</td>';

        echo '</tr>';
    };

    ?>
</table>

<table id = "table">
    <caption><h2>已退货订单</h2></caption>
    <tr class="firstrow">
        <td style="width:8%">订单号</td>
        <td style="width:27%">下单时间</td>
        <td style="width:40%;">配送地址</td>
        <td style="width:12%">订单详情</td>

    </tr>

    <?php

    $sql4 = "SELECT * FROM orderall WHERE UserNo = $_userid and status='4'";
    $result4 = mysqli_query($conn,$sql4);


    while ($row1 = mysqli_fetch_array($result4)) {
        echo '<tr>';
        echo '<td>' . $row1['OrderNo'] . '</td>';
        echo '<td>' . $row1['Year'] ."年". $row1['Month'] ."月". $row1['Day'] ."日 ". $row1['hour'] .":". $row1['minute'] .":". $row1['second'] .'</td>';
        echo '<td>' . $row1['address'] . '</td>';
        echo '<form action="orderdetail.php" method="post">';
        echo '<input name="OrderNo" value=' . $row1['OrderNo'] . '   type="hidden">';
        echo '<input name="UserNo" value=' . $row1['UserNo'] . '   type="hidden">';
        echo '<td>'.'<input name="submit" type="submit" value="查看">'.'</td>';

        echo '</tr>';
    };

    ?>


</table>
<?php
// 关闭连接
mysqli_close($conn);
?>
</body>
</html>
